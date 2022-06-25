<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the TimeHRM License
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.timehrm.com/license.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to timehrm.official@gmail.com so we can send you a copy immediately.
 *
 * @author   TimeHRM
 * @author-email  timehrm.official@gmail.com
 * @copyright  Copyright © timehrm.com All Rights Reserved
 */
namespace App\Controllers;
use App\Controllers\BaseController;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Files\UploadedFile;
 
use App\Models\MainModel;
use App\Models\SystemModel;
use App\Models\UsersModel;
use App\Models\CompanyModel;
use App\Models\CountryModel;
use App\Models\ConstantsModel;
use App\Models\MembershipModel;
use App\Models\SuperroleModel;
use App\Models\EmailtemplatesModel;
use App\Models\CompanysettingsModel;
use App\Models\CompanymembershipModel;

class Keyhrm extends BaseController {

	// register
	public function register()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		/*if($session->has('sup_username')){ 
			return redirect()->to(site_url('erp/desk?module=dashboard'));
		}*/
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Login.xin_login_title');
		return view('frontend/register',$data);
	}
	// thankyou
	public function thankyou()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		/*if($session->has('sup_username')){ 
			return redirect()->to(site_url('erp/desk?module=dashboard'));
		}*/
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Login.xin_login_title');
		return view('frontend/thankyou',$data);
	}
	// confirm mail
	public function confirm()
	{		
		$session = \Config\Services::session();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$EmailtemplatesModel = new EmailtemplatesModel();
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$email = udecode($_GET['v']);
		$iuser = $UsersModel->where('email', $email)->first();
		$data = [
			'is_active' => 1,
		];
		$UsersModel->update($iuser['user_id'], $data);	
		$data['title'] = $xin_system['application_name'].' | '.lang('Login.xin_login_title');
		return view('frontend/confirm',$data);
	}
	// contact
	public function contact()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		/*if($session->has('sup_username')){ 
			return redirect()->to(site_url('erp/desk?module=dashboard'));
		}*/
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Login.xin_login_title');
		return view('frontend/contact',$data);
	}
	// pricing
	public function pricing()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		/*if($session->has('sup_username')){ 
			return redirect()->to(site_url('erp/desk?module=dashboard'));
		}*/
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Login.xin_login_title');
		return view('frontend/pricing',$data);
	}
	// features
	public function features()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		/*if($session->has('sup_username')){ 
			return redirect()->to(site_url('erp/desk?module=dashboard'));
		}*/
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Login.xin_login_title');
		return view('frontend/features',$data);
	}
	// page_content
	public function page_content()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		/*if($session->has('sup_username')){ 
			return redirect()->to(site_url('erp/desk?module=dashboard'));
		}*/
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Login.xin_login_title');
		return view('frontend/page_content',$data);
	}
	
	// |||contact form|||
	public function send_contact() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'contact') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'full_name' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Asset.xin_error_cat_name_field')
					]
				],
				'email' => [
					'rules'  => 'required|valid_email',
					'errors' => [
						'required' => lang('Asset.xin_error_cat_name_field')
					]
				],
				'subject' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Asset.xin_error_cat_name_field')
					]
				],
				'message' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Asset.xin_error_cat_name_field')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "full_name" => $validation->getError('full_name'),
					"email" => $validation->getError('email'),
					"subject" => $validation->getError('subject'),
					"message" => $validation->getError('message')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$full_name = $this->request->getPost('full_name',FILTER_SANITIZE_STRING);	
				$email = $this->request->getPost('email',FILTER_SANITIZE_STRING);
				$subject = $this->request->getPost('subject',FILTER_SANITIZE_STRING);
				$message = $this->request->getPost('message',FILTER_SANITIZE_STRING);	
					
				$SystemModel = new SystemModel();
				$EmailtemplatesModel = new EmailtemplatesModel();
				$xin_system = $SystemModel->where('setting_id', 1)->first();
			
				$Return['csrf_hash'] = csrf_hash();	
				$Return['result'] = lang('Frontend.xin_sent_msg_successfully');
				if($xin_system['enable_email_notification'] == 1){
					// Send mail start
					$itemplate = $EmailtemplatesModel->where('template_id', 8)->first();
					$isubject = $itemplate['subject'];
					$ibody = html_entity_decode($itemplate['message']);
					$fbody = str_replace(array("{full_name}","{subject}","{email}","{message}","{site_name}"),array($full_name,$subject,$email,$message,$xin_system['company_name']),$ibody);
					timehrm_mail_data($email,$xin_system['company_name'],$xin_system['email'],$isubject,$fbody);
					// Send mail end
				}
				$this->output($Return);
				exit;
			}
		} else {
			$Return['error'] = lang('Main.xin_error_msg');
			$this->output($Return);
			exit;
		}
	}
	
	public function setup_trial() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$validation->setRules([
					'first_name' => 'required',
					'last_name' => 'required',
					'company_name' => 'required',					
					'contact_number' => 'required',
					'email' => 'required|valid_email|is_unique[ci_erp_users.email]',
					'password' => 'required|min_length[6]',
				],
				[   // Errors
					'first_name' => [
						'required' => lang('Main.xin_contact_error_first_name'),
					],
					'last_name' => [
						'required' => lang('Main.xin_contact_error_last_name'),
					],
					'company_name' => [
						'required' => lang('Company.xin_error_name_field'),
					],
					'email' => [
						'required' => lang('Main.xin_error_cemail_field'),
						'valid_email' => lang('Main.xin_employee_error_invalid_email'),
						'is_unique' => lang('Main.xin_already_exist_error_email'),
					],
					'contact_number' => [
						'required' => lang('Main.xin_error_contact_field'),
					],
					'password' => [
						'required' => lang('Main.xin_employee_error_password'),
						'min_length' => lang('Login.xin_min_error_password')
					]
				]
			);
			
			$validation->withRequest($this->request)->run();
			//check error
			if($validation->hasError('first_name')) {
				$Return['error'] = $validation->getError('first_name');
			} elseif($validation->hasError('last_name')){
				$Return['error'] = $validation->getError('last_name');
			} elseif ($validation->hasError('company_name')) {
				$Return['error'] = $validation->getError('company_name');
			} elseif($validation->hasError('email')){
				$Return['error'] = $validation->getError('email');
			} elseif($validation->hasError('contact_number')){
				$Return['error'] = $validation->getError('contact_number');
			} elseif($validation->hasError('password')){
				$Return['error'] = $validation->getError('password');
			} 
			if($Return['error']!=''){
				$this->output($Return);
			}
			$first_name = $this->request->getPost('first_name',FILTER_SANITIZE_STRING);
			$last_name = $this->request->getPost('last_name',FILTER_SANITIZE_STRING);
			$company_name = $this->request->getPost('company_name',FILTER_SANITIZE_STRING);
			$company_type = 3;
			$trading_name = '';
			$registration_no = '';
			$contact_number = $this->request->getPost('contact_number',FILTER_SANITIZE_STRING);
			$email = $this->request->getPost('email',FILTER_SANITIZE_STRING);
			$xin_gtax = '';
			$membership_type = 1;
			$address_1 = '';
			$address_2 = '';
			$city = '';
			$state = '';
			$zipcode = '';
			$country = 230;	
			$uname = explode('@',$email);
			$username = generate_random_employeeid();//$this->request->getPost('username',FILTER_SANITIZE_STRING);
			$password = $this->request->getPost('password',FILTER_SANITIZE_STRING);
			
			$options = array('cost' => 12);
			$password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
			$data = [
				'company_id' => 0,
				'company_name' => $company_name,
				'first_name' => $first_name,
				'last_name'  => $last_name,
				'company_type_id'  => $company_type,
				'trading_name'  => $trading_name,
				'user_type'  => 'company',
				'registration_no'  => $registration_no,
				'contact_number'  => $contact_number,
				'email'  => $email,
				'government_tax' => $xin_gtax,
				'address_1'  => $address_1,
				'address_2'  => $address_2,
				'city'  => $city,
				'profile_photo'  => 'no',
				'state'  => $state,
				'zipcode' => $zipcode,
				'country'  => $country,
				'username'  => $username,
				'password'  => $password_hash,
				'user_role_id' => 0,
				'gender' => 1,
				'last_login_date' => '0',
				'last_logout_date' => '0',
				'last_login_ip' => '0',
				'is_logged_in' => '0',
				'is_active'  => 2,
				'added_by'  => 1,
				'created_at' => date('d-m-Y h:i:s')
			];
			
			$UsersModel = new UsersModel();
			$result = $UsersModel->insert($data);	
			$user_id = $UsersModel->insertID();
			$SystemModel = new SystemModel();
			$MembershipModel = new MembershipModel();
			$CompanysettingsModel = new CompanysettingsModel();
			$CompanymembershipModel = new CompanymembershipModel();
			$EmailtemplatesModel = new EmailtemplatesModel();
			$xin_system = $SystemModel->where('setting_id', 1)->first();
			$membership_info = $MembershipModel->where('membership_id', $membership_type)->first();
			$data2 = array(
				'company_id'  => $user_id,
				'membership_id'  => $membership_type,
				'subscription_type'  => $membership_info['plan_duration'],
				'update_at'  => date('d-m-Y h:i:s'),
				'created_at'  => date('d-m-Y h:i:s')
			);
			$CompanymembershipModel->insert($data2);
			$setup_modules = 'a:18:{s:9:"re_module";s:1:"4";s:11:"recruitment";s:1:"1";s:7:"payroll";s:1:"1";s:7:"finance";s:1:"1";s:6:"travel";s:1:"1";s:8:"fmanager";s:1:"1";s:5:"asset";s:1:"1";s:6:"events";s:1:"1";s:11:"performance";s:1:"1";s:5:"award";s:1:"1";s:8:"holidays";s:1:"1";s:12:"visitor_book";s:1:"1";s:8:"training";s:1:"1";s:5:"polls";s:1:"1";s:11:"suggestions";s:1:"1";s:7:"warning";s:1:"1";s:11:"resignation";s:1:"1";s:11:"termination";s:1:"1";}';
			$setup_langs = 'a:2:{i:0;s:2:"en";i:1;s:2:"fr";}';
			$data3 = array(
				'company_id'  => $user_id,
				'default_currency'  => 'USD',
				'default_currency_symbol'  => 'USD',
				'notification_position'  => 'toast-top-center',
				'notification_close_btn'  => 'true',
				'notification_bar'  => 'true',
				'date_format_xi'  => 'Y-m-d',
				'default_language'  => 'en',
				'system_timezone'  => 'Asia/Bishkek',
				'enable_ip_address'  => 0,
				'ip_address'  => 0,
				'paypal_email'  => 'paypal@example.com',
				'paypal_sandbox'  => 'yes',
				'paypal_active'  => 'yes',
				'stripe_secret_key'  => 'stripe_secret_key',
				'stripe_publishable_key'  => 'stripe_publishable_key',
				'stripe_active'  => 'yes',
				'invoice_terms_condition'  => 'invoice terms condition..',
				'setup_modules'  => $setup_modules,
				'setup_languages'  => $setup_langs,
				'is_enable_ml_payroll'  => 0,
				'bank_account'  => 'NL14 TEST 0405 3997 07',
				'vat_number'  => '223206623TEST02',
				'updated_at'  => date('d-m-Y h:i:s')
			);
			$CompanysettingsModel->insert($data3);
			$Return['csrf_hash'] = csrf_hash();	
			if ($result == TRUE) {
				$Return['result'] = lang('Company.xin_success_add_company');
				if($xin_system['enable_email_notification'] == 1){
					$full_name = $first_name.' '.$last_name;
					// Send mail start
					$itemplate = $EmailtemplatesModel->where('template_id', 4)->first();
					$isubject = $itemplate['subject'];
					$ibody = html_entity_decode($itemplate['message']);
					$fbody = str_replace(array("{user_name}","{user_username}","{user_password}","{site_name}","{site_url}","{user_id}"),array($full_name,$username,$password,$xin_system['company_name'],site_url(),uencode($email)),$ibody);
					timehrm_mail_data($xin_system['email'],$xin_system['company_name'],$email,$isubject,$fbody);
					// Send mail end
				}
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
			exit;
		} else {
			$Return['error'] = lang('Main.xin_error_msg');
			$this->output($Return);
			exit;
		}
	} 
}
