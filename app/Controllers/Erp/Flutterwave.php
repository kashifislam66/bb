<?php

namespace App\Controllers\Erp;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Files\UploadedFile;
 
use App\Models\MainModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\MembershipModel;
use App\Models\ConstantsModel;
use App\Models\InvoicepaymentsModel;

class Flutterwave extends BaseController
{
	public function verify_payments() {
		
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');
		$SystemModel = new SystemModel();
		$xin_super_system = $SystemModel->where('setting_id', 1)->first();
	//	if ($this->request->getPost('type') === 'pay')
		//{
			$customer_email = $this->request->getPost('email',FILTER_SANITIZE_STRING);
			$amount = $this->request->getPost('amount',FILTER_SANITIZE_STRING);
			$icurrency = $this->request->getPost('currency',FILTER_SANITIZE_STRING);
			$curl = curl_init();

			$currency = $icurrency;
			$txref = "rave" . uniqid(); // ensure you generate unique references per transaction.
			// get your public key from the dashboard.
			$PBFPubKey = $xin_super_system['flutterwave_public_key']; 
			$redirect_url = site_url('erp/flutterwave/payment_status'); // Set your own redirect URL
			
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => json_encode([
				'amount'=>$amount,
				'customer_email'=>$customer_email,
				'currency'=>$currency,
				'txref'=>$txref,
				'PBFPubKey'=>$PBFPubKey,
				'redirect_url'=>$redirect_url,
			  ]),
			  CURLOPT_HTTPHEADER => [
				"content-type: application/json",
				"cache-control: no-cache"
			  ],
			));
			
			$response = curl_exec($curl);
			$err = curl_error($curl);
			
			if($err){
			  // there was an error contacting the rave API
			  die('Curl returned error: ' . $err);
			}
			
			$transaction = json_decode($response);
			
			if(!$transaction->data && !$transaction->data->link){
			  // there was an error from the API
			  print_r('API returned error: ' . $transaction->message);
			}
			
			// redirect to page so User can pay
			
			header('Location: ' . $transaction->data->link);
	}
	// flutterwave payment process
	public function payment_status() {
		
		if (isset($_GET['txref'])) {
			
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			
			$SystemModel = new SystemModel();
			$xin_super_system = $SystemModel->where('setting_id', 1)->first();
		
			$ref = $_GET['txref'];
			$token = udecode($_GET['token']);
			 // CALCULATION
			$UsersModel = new UsersModel();
			$ConstantsModel = new ConstantsModel();
			$MembershipModel = new MembershipModel();
			$result = $MembershipModel->where('membership_id', $token)->first();		
			$xin_super_system = $SystemModel->where('setting_id', 1)->first();
			$subscription_tax = $ConstantsModel->where('type','subscription_tax')->where('constants_id', $xin_super_system['tax_type'])->first();
			$converted = currency_converter($result['price']);
			// tax
			if($xin_super_system['enable_tax'] == 1):
				if($subscription_tax['field_two']=='fixed'){
					$tax_rate = $subscription_tax['field_one'];
					$membership_price = currency_converter($result['price']);
					$final_subs_price = $membership_price  + $tax_rate;
				} else {
					$p_rate = $subscription_tax['field_one'];
					$membership_price = currency_converter($result['price']);
					$tax_rate = $membership_price / 100 * $p_rate;
					$final_subs_price = $membership_price  + $tax_rate;
				}
			else:
				$tax_rate = 0;
				$membership_price = currency_converter($result['price']);
				$converted = currency_converter($result['price']);
				$final_subs_price = currency_converter($result['price']);
			endif;
			$amount = $final_subs_price; //Get the correct amount of your product
		//	$currency = "NGN"; //Correct Currency from Server
	
			$query = array(
				"SECKEY" => $xin_super_system['flutterwave_secret_key'],
				"txref" => $ref
			);
	
			$data_string = json_encode($query);
					
			$ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	
			$response = curl_exec($ch);
	
			$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
			$header = substr($response, 0, $header_size);
			$body = substr($response, $header_size);
	
			curl_close($ch);
	
			$resp = json_decode($response, true);
	
			$paymentStatus = $resp['data']['status'];
			$chargeResponsecode = $resp['data']['chargecode'];
			$chargeAmount = $resp['data']['amount'];
			$chargeCurrency = $resp['data']['currency'];
	
			if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)) {
			 
				$data = [
					'invoice_id'  => $ref,
					'company_id' => $usession['sup_user_id'],
					'membership_id'  => $result['membership_id'],
					'subscription_id'  => $result['subscription_id'],
					'membership_type'  => $result['membership_type'],
					'subscription'  => $result['plan_duration'],
					'description'  => $result['description'],
					'membership_price'  => $final_subs_price,
					'payment_method'  => 'Flutterwave',
					'invoice_month'  => date('Y-m'),
					'transaction_date'  => date('Y-m-d h:i:s'),
					'created_at' => date('Y-m-d h:i:s'),
					'receipt_url'  => 'Flutterwave invoice',
					'source_info'  => 'Flutterwave',
				];
			  $InvoicepaymentsModel = new InvoicepaymentsModel();
			  $InvoicepaymentsModel->insert($data);
			  $data2 = array(
				'membership_id'  => $result['membership_id'],
				'subscription_type'  => $result['plan_duration'],
				'update_at' => date('Y-m-d h:i:s'),
				);
				$MainModel = new MainModel();
				$MainModel->update_company_membership($data2,$usession['sup_user_id']);
				$session->setFlashdata('payment_made_successfully',lang('Membership.payment_made_successfully'));
				return redirect()->to(site_url('erp/my-subscription'));
			} else {
			  //Dont Give Value and return to Failure page
			  // var_dump($resp);
			 echo 'error'; exit;
			}
		} else {
     	 die('No reference supplied');
		}
    }
}
?>
