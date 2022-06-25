<?php
namespace App\Controllers\Erp;
use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\SystemModel;
use App\Models\MainModel;
use App\Models\UsersModel;
use App\Models\ConstantsModel;
use App\Models\MembershipModel;
use App\Models\InvoicepaymentsModel;
use App\Models\CompanymembershipModel;
use App\Models\CompanysettingsModel;

class Razorpay extends BaseController {

	public function __construct() {
		$this->session   = \Config\Services::session();
	}
	
	// initialized cURL Request
	private function curl_handler($payment_id, $amount)  {
		
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');
		$SystemModel = new SystemModel();
		$xin_super_system = $SystemModel->where('setting_id', 1)->first();
		$url            = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
		$key_id         = $xin_super_system['razorpay_keyid'];
		$key_secret     = $xin_super_system['razorpay_key_secret'];
		$fields_string  = "amount=$amount";
		//cURL Request
		$ch = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		return $ch;
	}   
	// callback method
	public function callback() {   
			
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$InvoicepaymentsModel = new InvoicepaymentsModel();
			if (!empty($this->request->getPost('razorpay_payment_id')) && !empty($this->request->getPost('merchant_order_id'))) {
			$razorpay_payment_id    = $this->request->getPost('razorpay_payment_id');
			$merchant_order_id      = $this->request->getPost('merchant_order_id');
			$membership_id      = $this->request->getPost('membership_id');
			$subscription_id      = $this->request->getPost('subscription_id');
			$membership_type      = $this->request->getPost('membership_type');
			$plan_duration      = $this->request->getPost('plan_duration');
			$description      = $this->request->getPost('merchant_product_info_id');
			$this->session->set('razorpay_payment_id', $this->request->getPost('razorpay_payment_id'));
			$this->session->set('merchant_order_id', $this->request->getPost('merchant_order_id'));
			$currency_code = 'INR';
			$amount = $this->request->getPost('merchant_total');
			$iamount = $amount / 100;
			$success = false;
			$error = '';
			try {                
				$ch = $this->curl_handler($razorpay_payment_id, $amount);
				//execute post
				$result = curl_exec($ch);
				$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				if ($result === false) {
					$success = false;
					$error = 'Curl error: '.curl_error($ch);
				} else {
					$response_array = json_decode($result, true);
					//Check success response
					if ($http_status === 200 and isset($response_array['error']) === false) {
						$success = true;
						
					} else {
						$success = false;
					if (!empty($response_array['error']['code'])) {
						$error = $response_array['error']['code'].':'.$response_array['error']['description'];
					} else {
						$error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
					}
					}
				}
				//close curl connection
				curl_close($ch);
			} catch (Exception $e) {
				$success = false;
				$error = 'Request to Razorpay Failed';
			}
			if ($success === true) {
				$data = [
					'invoice_id'  => $razorpay_payment_id,
					'company_id' => $usession['sup_user_id'],
					'membership_id'  => $membership_id,
					'subscription_id'  => $subscription_id,
					'membership_type'  => $membership_type,
					'subscription'  => $plan_duration,
					'description'  => $description,
					'membership_price'  => $iamount,
					'payment_method'  => 'Razorpay',
					'invoice_month'  => date('Y-m'),
					'transaction_date'  => date('Y-m-d h:i:s'),
					'created_at' => date('Y-m-d h:i:s'),
					'receipt_url'  => 'razorpay invoice',
					'source_info'  => 'razorpay',
				];
			  $InvoicepaymentsModel = new InvoicepaymentsModel();
			  $InvoicepaymentsModel->insert($data);
			  $data2 = array(
				'membership_id'  => $membership_id,
				'subscription_type'  => $plan_duration,
				'update_at' => date('Y-m-d h:i:s'),
				);
				$MainModel = new MainModel();
				$MainModel->update_company_membership($data2,$usession['sup_user_id']);
				if(!empty($this->session->get('ci_subscription_keys'))) {
					$this->session->unset('ci_subscription_keys');
				}
				$session->setFlashdata('payment_made_successfully',lang('Membership.payment_made_successfully'));
		  		return redirect()->to(site_url('erp/my-subscription'));
			} else {
				return redirect()->to($this->request->getPost('merchant_furl_id'));
			}
		} else {
			echo 'An error occured. Contact site administrator, please!';
		}
	}
	
	public function success() {
		$data['title'] = 'Razorpay Success | Tutsmake.com';
		echo "<h4>Your transaction is successful</h4>";  
		echo "<br/>";
		echo "Transaction ID: ".$this->session->get('razorpay_payment_id');
		echo "<br/>";
		echo "Order ID: ".$this->session->get('merchant_order_id');
		return redirect()->to(site_url('erp/subscription-list'));
	}  
	
	public function failed() {
		//echo 'failed';exit;
		$data['title'] = 'Razorpay Failed | Tutsmake.com';  
		echo "<h4>Your transaction got Failed</h4>";            
		echo "<br/>";
		echo "Transaction ID: ".$this->session->get('razorpay_payment_id');
		echo "<br/>";
		echo "Order ID: ".$this->session->get('merchant_order_id');
		return redirect()->to(site_url('erp/subscription-list'));
	}
}