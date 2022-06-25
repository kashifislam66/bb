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

class Paystack extends BaseController
{

    private function getPaymentInfo($ref) {
		
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');
		$SystemModel = new SystemModel();
		$xin_super_system = $SystemModel->where('setting_id', 1)->first();
		
        $result = array();
        $url = 'https://api.paystack.co/transaction/verify/'.$ref;
        $ch = curl_init();
		$secretkey = $xin_super_system['paystack_key_secret'];
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer '.$secretkey]
        );
        $request = curl_exec($ch);
        curl_close($ch);
        //
        $result = json_decode($request, true);
        //
        return $result['data'];

    }

    public function verify_payment($ref) {
		
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');
		$SystemModel = new SystemModel();
		$xin_super_system = $SystemModel->where('setting_id', 1)->first();
		
        $result = array();
        $url = 'https://api.paystack.co/transaction/verify/'.$ref;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //
		$secretkey = $xin_super_system['paystack_key_secret'];
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '.$secretkey]
        );
        $request = curl_exec($ch);
        curl_close($ch);
        //
        if ($request) {
            $result = json_decode($request, true);
            // print_r($result);
            if($result){
				$ireferrer = $result['data']['metadata']['referrer'];
				$explode = explode("upgrade-subscription/",$ireferrer);
				$token = udecode($explode[1]);
				/*echo '<br>';
				echo $explode[1];
				echo '<br>';
				echo '<pre>'; print_r($result);  exit;*/
                if($result['data']){
                    //something came in
                    if($result['data']['status'] == 'success'){
						// REFERENE ID
						$reference_id = $result['data']['reference'];
                        // CALCULATION
						$UsersModel = new UsersModel();
						$SystemModel = new SystemModel();
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
						$data = [
							'invoice_id'  => $reference_id,
							'company_id' => $usession['sup_user_id'],
							'membership_id'  => $result['membership_id'],
							'subscription_id'  => $result['subscription_id'],
							'membership_type'  => $result['membership_type'],
							'subscription'  => $result['plan_duration'],
							'description'  => $result['description'],
							'membership_price'  => $final_subs_price,
							'payment_method'  => 'Paystack',
							'invoice_month'  => date('Y-m'),
							'transaction_date'  => date('Y-m-d h:i:s'),
							'created_at' => date('Y-m-d h:i:s'),
							'receipt_url'  => 'paystack invoice',
							'source_info'  => 'paystack',
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

                    }else{
                        // the transaction was not successful, do not deliver value'
                        // print_r($result);  //uncomment this line to inspect the result, to check why it failed.
						$session->setFlashdata('unauthorized_module',lang('Main.xin_pay_transaction_status_error'));
                        return redirect()->to(site_url('erp/desk'));

                    }
                }
                else{

                    $session->setFlashdata('unauthorized_module',lang('Main.xin_pay_transaction_status_error'));
                   return redirect()->to(site_url('erp/desk'));
                }

            }else{
                //print_r($result);
                //die("Something went wrong while trying to convert the request variable to json. Uncomment the print_r command to see what is in the result variable.");
				$session->setFlashdata('unauthorized_module',lang('Main.xin_pay_transaction_status_error'));
                return redirect()->to(site_url('erp/desk'));
            }
        }else{
            //var_dump($request);
            //die("Something went wrong while executing curl. Uncomment the var_dump line above this line to see what the issue is. Please check your CURL command to make sure everything is ok");
			$session->setFlashdata('unauthorized_module',lang('Main.xin_pay_transaction_status_error'));
            return redirect()->to(site_url('erp/desk'));
        }

    }
}
?>
