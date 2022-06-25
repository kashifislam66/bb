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
 
use App\Models\JobsModel;
use App\Models\SystemModel;
use App\Models\UsersModel;
use App\Models\CompanyModel;
use App\Models\CountryModel;
use App\Models\ConstantsModel;
use App\Models\SuperroleModel;
use App\Models\EmailtemplatesModel;
use App\Models\JobcandidatesModel;

class Jobs extends BaseController {

	public function index()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Jobs');
		$data['path_url'] = 'candidate';
		$data['subview'] = view('frontend/jobs/home', $data);
		return view('frontend/jobs/layout/job_layout', $data); //page load
	}
	public function job_view()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Jobs');
		$data['path_url'] = 'candidate';
		$data['subview'] = view('frontend/jobs/jobs_view', $data);
		return view('frontend/jobs/layout/job_layout', $data); //page load
	}
	public function search_jobs()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Jobs');
		$data['path_url'] = 'candidate';
		$data['subview'] = view('frontend/jobs/search_jobs', $data);
		return view('frontend/jobs/layout/job_layout', $data); //page load
	}
	public function search_by_type()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Jobs');
		$data['path_url'] = 'candidate';
		$data['subview'] = view('frontend/jobs/search_by_type', $data);
		return view('frontend/jobs/layout/job_layout', $data); //page load
	}
	public function signup()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Jobs');
		$data['path_url'] = 'candidate';
		$data['subview'] = view('frontend/jobs/signup', $data);
		return view('frontend/jobs/layout/job_layout', $data); //page load
	}
	public function signin()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Jobs');
		$data['path_url'] = 'candidate';
		$data['subview'] = view('frontend/jobs/signin', $data);
		return view('frontend/jobs/layout/job_layout', $data); //page load
	}
	public function jobs_dashboard()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('cand_username');
		if(!$session->has('cand_username')){ 
			return redirect()->to(site_url('signin'));
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Jobs');
		$data['path_url'] = 'candidate';
		$data['subview'] = view('frontend/jobs/jobs_dashboard', $data);
		return view('frontend/jobs/layout/job_dash_layout', $data); //page load
	}
	public function my_profile()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('cand_username');
		if(!$session->has('cand_username')){ 
			return redirect()->to(site_url('signin'));
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Jobs');
		$data['path_url'] = 'candidate';
		$data['subview'] = view('frontend/jobs/my_profile', $data);
		return view('frontend/jobs/layout/job_dash_layout', $data); //page load
	}
	public function change_password()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('cand_username');
		if(!$session->has('cand_username')){ 
			return redirect()->to(site_url('signin'));
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Jobs');
		$data['path_url'] = 'candidate';
		$data['subview'] = view('frontend/jobs/change_password', $data);
		return view('frontend/jobs/layout/job_dash_layout', $data); //page load
	}
	public function jobs_interviews()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('cand_username');
		if(!$session->has('cand_username')){ 
			return redirect()->to(site_url('signin'));
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Jobs');
		$data['path_url'] = 'candidate';
		$data['subview'] = view('frontend/jobs/jobs_interviews', $data);
		return view('frontend/jobs/layout/job_dash_layout', $data); //page load
	}
	public function rejected_applications()
	{		
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('cand_username');
		if(!$session->has('cand_username')){ 
			return redirect()->to(site_url('signin'));
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = $xin_system['application_name'].' | '.lang('Jobs');
		$data['path_url'] = 'candidate';
		$data['subview'] = view('frontend/jobs/rejected_applications', $data);
		return view('frontend/jobs/layout/job_dash_layout', $data); //page load
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
		$data['path_url'] = 'candidate';
		$data['subview'] = view('frontend/jobs/page_content', $data);
		return view('frontend/jobs/layout/job_layout', $data); //page load
	}
	public function register_candidate() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$validation->setRules([
					'first_name' => 'required',
					'last_name' => 'required',
					'email' => 'required|valid_email|is_unique[ci_erp_users.email]',
					'username' => 'required|min_length[6]|is_unique[ci_erp_users.username]',
					'password' => 'required|min_length[6]',
					'contact_number' => 'required',
					'country' => 'required'
				],
				[   // Errors
					'first_name' => [
						'required' => lang('Main.xin_employee_error_first_name'),
					],
					'last_name' => [
						'required' => lang('Main.xin_employee_error_last_name'),
					],
					'email' => [
						'required' => lang('Main.xin_employee_error_email'),
						'valid_email' => lang('Main.xin_employee_error_invalid_email'),
						'is_unique' => lang('Main.xin_already_exist_error_email'),
					],
					'username' => [
						'required' => lang('Main.xin_employee_error_username'),
						'min_length' => lang('Main.xin_min_error_username'),
						'is_unique' => lang('Main.xin_already_exist_error_username')
					],
					'password' => [
						'required' => lang('Main.xin_employee_error_password'),
						'min_length' => lang('Login.xin_min_error_password')
					],
					'contact_number' => [
						'required' => lang('Main.xin_error_contact_field'),
					],
					'country' => [
						'required' => lang('Main.xin_error_country_field'),
					]
				]
			);
			
			$validation->withRequest($this->request)->run();
			//check error
			if ($validation->hasError('first_name')) {
				$Return['error'] = $validation->getError('first_name');
			} elseif($validation->hasError('last_name')){
				$Return['error'] = $validation->getError('last_name');
			} elseif($validation->hasError('email')){
				$Return['error'] = $validation->getError('email');
			} elseif($validation->hasError('username')){
				$Return['error'] = $validation->getError('username');
			} elseif($validation->hasError('password')){
				$Return['error'] = $validation->getError('password');
			} elseif($validation->hasError('country')){
				$Return['error'] = $validation->getError('country');
			} elseif($validation->hasError('contact_number')){
				$Return['error'] = $validation->getError('contact_number');
			}
			if($Return['error']!=''){
				$this->output($Return);
			}
			$image = service('image');
			$validated = $this->validate([
				'file' => [
					'uploaded[file]',
					'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
					'max_size[file,4096]',
				],
			]);
			if (!$validated) {
				$Return['error'] = lang('Users.xin_user_photo_field');
			} else {
				$avatar = $this->request->getFile('file');
				$file_name = $avatar->getName();
				$avatar->move('public/uploads/users/');
				$image->withFile(filesrc($file_name))
				->fit(100, 100, 'center')
				->save('public/uploads/users/thumb/'.$file_name);
			}
			if($Return['error']!=''){
				$this->output($Return);
			}
			$first_name = $this->request->getPost('first_name',FILTER_SANITIZE_STRING);
			$last_name = $this->request->getPost('last_name',FILTER_SANITIZE_STRING);
			$email = $this->request->getPost('email',FILTER_SANITIZE_STRING);
			$username = $this->request->getPost('username',FILTER_SANITIZE_STRING);
			$password = $this->request->getPost('password',FILTER_SANITIZE_STRING);
			$contact_number = $this->request->getPost('contact_number',FILTER_SANITIZE_STRING);
			$country = $this->request->getPost('country',FILTER_SANITIZE_STRING);
			$gender = $this->request->getPost('gender',FILTER_SANITIZE_STRING);
			$address_1 = '';
			$address_2 = '';
			$city = '';
			$state = '';
			$zipcode ='';
			// company info
			$UsersModel = new UsersModel();
			$SystemModel = new SystemModel();
			$EmailtemplatesModel = new EmailtemplatesModel();
			//$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			
			$company_name = '';
			$company_type = '';
			$xin_gtax = '';
			$trading_name = '';
			$registration_no = '';
			
			$options = array('cost' => 12);
			$password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
			$xin_system = $SystemModel->where('setting_id', 1)->first();
			$data = [
				'first_name' => $first_name,
				'last_name'  => $last_name,
				'email'  => $email,
				'user_type'  => 'candidate',
				'username'  => $username,
				'password'  => $password_hash,
				'contact_number'  => $contact_number,
				'country'  => $country,
				'user_role_id' => 0,
				'address_1'  => $address_1,
				'address_2'  => $address_2,
				'city'  => $city,
				'profile_photo'  => $file_name,
				'state'  => $state,
				'zipcode' => $zipcode,
				'gender' => $gender,
				'company_name' => $company_name,
				'trading_name' => $trading_name,
				'registration_no' => $registration_no,
				'government_tax' => $xin_gtax,
				'company_type_id'  => $company_type,
				'last_login_date' => '0',
				'last_logout_date' => '0',
				'last_login_ip' => '0',
				'is_logged_in' => '0',
				'is_active'  => 1,
				'company_id'  => 0,
				'added_by'  => 0,
				'created_at' => date('d-m-Y h:i:s')
			];
			$UsersModel = new UsersModel();
			$result = $UsersModel->insert($data);	
			$Return['csrf_hash'] = csrf_hash();	
			if ($result == TRUE) {
				$Return['result'] = lang('Users.xin_success_user_added');
				if($xin_system['enable_email_notification'] == 1){
					// Send mail start
					$itemplate = $EmailtemplatesModel->where('template_id', 5)->first();
					$isubject = $itemplate['subject'];
					$ibody = html_entity_decode($itemplate['message']);
					$fbody = str_replace(array("{site_name}","{user_password}","{user_username}","{site_url}"),array($xin_system['company_name'],$password,$username,site_url()),$ibody);
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
	public function user_login() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		
		$UsersModel = new UsersModel();
			
		if ($this->request->getMethod() === 'post') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'iusername' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Login.xin_employee_error_username')
					]
				],
				'password' => [
					'rules'  => 'required|min_length[6]',
					'errors' => [
						'required' => lang('Main.xin_employee_error_password'),
						'min_length' => lang('Login.xin_min_error_password')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "iusername" => $validation->getError('iusername'),
                    "password" => $validation->getError('password'),
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$username = $this->request->getPost('iusername',FILTER_SANITIZE_STRING);
				$password = $this->request->getPost('password',FILTER_SANITIZE_STRING);		
				
				$data = array(
					'username' => $username,
					'password' => $password
				);
				$throttler = \Config\Services::throttler();
				$is_allow = $throttler->check('auth',5,MINUTE);
				$iuser = $UsersModel->where('username', $username)->where('is_active',1)->first();
				if($is_allow) {
					if($iuser){
						if(password_verify($password,$iuser['password'])){
							// check company membership plan expiry date
							$user_info = $UsersModel->where('user_id', $iuser['user_id'])->first();
							
							$session_data = array(
							'cand_user_id' => $iuser['user_id'],
							'cand_username' => $iuser['username'],
							'cand_email' => $iuser['email'],
							);
							// Add user data in session
							$session->set('cand_username', $session_data);
							$session->set('cand_user_id', $session_data);
							$Return['result'] = lang('Login.xin_success_logged_in');
							
							// get user session record
							$ipaddress = $request->getIPAddress(); 
							$last_data = array(
								'last_login_date' => date('d-m-Y H:i:s'),
								'last_login_ip' => $ipaddress,
								'is_logged_in' => '1'
							); 
							
							$id = $iuser['user_id']; // user id
							// update last login record
							$UsersModel->update($id, $last_data);
							$Return['csrf_hash'] = csrf_hash();
							$this->output($Return);
							
						} else {
							$Return['error'] = lang('Login.xin_error_invalid_credentials');
							/*Return*/
							$Return['csrf_hash'] = csrf_hash();
							$this->output($Return);
						}
					} else {
						$Return['error'] = lang('Login.xin_error_invalid_credentials');
						/*Return*/
						$Return['csrf_hash'] = csrf_hash();
						$this->output($Return);
					}
					////
				} else {
					$session->setFlashdata('err_not_logged_in',lang('Login.xin_error_max_attempts'));
					$Return['error'] = lang('Login.xin_error_max_attempts');
					/*Return*/
					$Return['csrf_hash'] = csrf_hash();
					$this->output($Return);
				}
			}
		} else {
			$Return['error'] = lang('Main.xin_error_msg');
			$this->output($Return);
			exit;
		}
		
	}	
	
	// |||add record|||
	public function apply_job() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('cand_username');
		if(!$session->has('cand_username')){ 
			return redirect()->to(site_url('signin'));
		}	
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'cover_letter' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'file_cv' => [
					'rules'  => 'uploaded[file_cv]|mime_in[file_cv,image/jpg,image/jpeg,image/gif,image/png]|max_size[file_cv,3072]',
					'errors' => [
						'uploaded' => lang('Success.xin_resume_field_error'),
						'mime_in' => 'wrong size'
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "cover_letter" => $validation->getError('cover_letter'),
					"file_cv" => $validation->getError('file_cv')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				// upload file
				$file_cv = $this->request->getFile('file_cv');
				$file_name = $file_cv->getName();
				$file_cv->move('public/uploads/candidates/');
				
				$cover_letter = $this->request->getPost('cover_letter',FILTER_SANITIZE_STRING);
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				
				$JobsModel = new JobsModel();
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['cand_user_id'])->first();
				$staff_id = $usession['cand_user_id'];
				$job_info = $JobsModel->where('job_id', $id)->first();
				$data = [
					'company_id' => $job_info['company_id'],
					'job_id'  => $id,
					'staff_id'  => $staff_id,
					'designation_id'  => $job_info['designation_id'],
					'message'  => $cover_letter,
					'job_resume'  => $file_name,
					'application_status'  => 0,
					'application_remarks'  => 'application remarks here',
					'created_at' => date('d-m-Y h:i:s')
				];
				$JobcandidatesModel = new JobcandidatesModel();
				$result = $JobcandidatesModel->insert($data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_job_apply_success_msg');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
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
	
	// update record
	public function update_profile() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('cand_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$validation->setRules([
					'first_name' => 'required',
					'last_name' => 'required',
					'email' => 'required|valid_email',
					'username' => 'required',
					'contact_number' => 'required',
					'country' => 'required',
					'address_1' => 'required',
					'city' => 'required',
					'state' => 'required',
					'zipcode' => 'required'
				],
				[   // Errors
					'first_name' => [
						'required' => lang('Main.xin_employee_error_first_name'),
					],
					'last_name' => [
						'required' => lang('Main.xin_employee_error_last_name'),
					],
					'email' => [
						'required' => lang('Main.xin_employee_error_email'),
						'valid_email' => lang('Main.xin_employee_error_invalid_email'),
					],
					'username' => [
						'required' => lang('Main.xin_employee_error_username'),
					],
					'contact_number' => [
						'required' => lang('Main.xin_error_contact_field'),
					],
					'country' => [
						'required' => lang('Main.xin_error_country_field'),
					],
					'address_1' => [
						'required' => lang('Success.xin_address_field_error'),
					],
					'city' => [
						'required' => lang('Main.xin_error_field_text'),
					],
					'state' => [
						'required' => lang('Main.xin_error_field_text'),
					],
					'zipcode' => [
						'required' => lang('Main.xin_error_field_text'),
					]
				]
			);
			
			$validation->withRequest($this->request)->run();
			//check error
			if ($validation->hasError('first_name')) {
				$Return['error'] = $validation->getError('first_name');
			} elseif($validation->hasError('last_name')){
				$Return['error'] = $validation->getError('last_name');
			} elseif($validation->hasError('email')){
				$Return['error'] = $validation->getError('email');
			} elseif($validation->hasError('username')){
				$Return['error'] = $validation->getError('username');
			} elseif($validation->hasError('contact_number')){
				$Return['error'] = $validation->getError('contact_number');
			} elseif($validation->hasError('country')){
				$Return['error'] = $validation->getError('country');
			} elseif($validation->hasError('city')){
				$Return['error'] = $validation->getError('city');
			} elseif($validation->hasError('state')){
				$Return['error'] = $validation->getError('state');
			} elseif($validation->hasError('zipcode')){
				$Return['error'] = $validation->getError('zipcode');
			} elseif($validation->hasError('address_1')){
				$Return['error'] = $validation->getError('address_1');
			} 
			if($Return['error']!=''){
				$this->output($Return);
			}
			
			$first_name = $this->request->getPost('first_name',FILTER_SANITIZE_STRING);
			$last_name = $this->request->getPost('last_name',FILTER_SANITIZE_STRING);
			$email = $this->request->getPost('email',FILTER_SANITIZE_STRING);
			$username = $this->request->getPost('username',FILTER_SANITIZE_STRING);
			$contact_number = $this->request->getPost('contact_number',FILTER_SANITIZE_STRING);
			$country = $this->request->getPost('country',FILTER_SANITIZE_STRING);
			$gender = $this->request->getPost('gender',FILTER_SANITIZE_STRING);
			$address_1 = $this->request->getPost('address_1',FILTER_SANITIZE_STRING);
			$address_2 = $this->request->getPost('address_2',FILTER_SANITIZE_STRING);
			$city = $this->request->getPost('city',FILTER_SANITIZE_STRING);
			$state = $this->request->getPost('state',FILTER_SANITIZE_STRING);
			$zipcode = $this->request->getPost('zipcode',FILTER_SANITIZE_STRING);

			$id = $usession['cand_user_id'];	
			$data = [
				'first_name' => $first_name,
				'last_name'  => $last_name,
				'email'  => $email,
				'username'  => $username,
				'contact_number'  => $contact_number,
				'country'  => $country,
				'address_1'  => $address_1,
				'address_2'  => $address_2,
				'city'  => $city,
				'state'  => $state,
				'zipcode' => $zipcode,
				'gender' => $gender,
			];
			$UsersModel = new UsersModel();
			$result = $UsersModel->update($id, $data);	
			$Return['csrf_hash'] = csrf_hash();	
			if ($result == TRUE) {
				$Return['result'] = lang('Success.ci_personal_information_updated_msg');
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
	// update record
	public function update_profile_photo() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('cand_username');
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			$image = service('image');
			// set rules
			$validated = $this->validate([
				'file' => [
					'uploaded[file]',
					'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
					'max_size[file,4096]',
				],
			]);
			if (!$validated) {
				$Return['error'] = lang('Main.xin_error_profile_picture_field');
			} else {
				$avatar = $this->request->getFile('file');
				$file_name = $avatar->getName();
				$avatar->move('public/uploads/users/');
				$image->withFile(filesrc($file_name))
				->fit(100, 100, 'center')
				->save('public/uploads/users/thumb/'.$file_name);
			}
			if($Return['error']!=''){
				$this->output($Return);
			}
			$id = $usession['cand_user_id'];	
			if ($validated) {
				$UsersModel = new UsersModel();
					
				
				$Return['result'] = 'Profile picture updated.';
				$data = [
					'profile_photo'  => $file_name
				];
				$result = $UsersModel->update($id, $data);
				$Return['csrf_hash'] = csrf_hash();	
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
	
	// update record
	public function update_password() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('cand_username');
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$validation->setRules([
					//'current_password' => 'required|is_not_unique[xin_users.password]',
					'new_password' => 'required|min_length[6]',
					'confirm_password' => 'required|matches[new_password]',
				],
				[   // Errors
					'new_password' => [
						'required' => lang('Main.xin_error_new_password_field'),
						'min_length' => lang('Main.xin_error_new_password_short_field'),
					],
					'confirm_password' => [
						'required' => lang('Main.xin_error_confirm_password_field'),
						'matches' => lang('Main.xin_error_confirm_password_matches_field'),
					]
				]
			);
			$UsersModel = new UsersModel();
			$validation->withRequest($this->request)->run();
			$user_info = $UsersModel->where('user_id', $usession['cand_user_id'])->first();
			//check error
			$new_password = $this->request->getPost('new_password',FILTER_SANITIZE_STRING);
			if($validation->hasError('new_password')){
				$Return['error'] = $validation->getError('new_password');
			} elseif($validation->hasError('confirm_password')){
				$Return['error'] = $validation->getError('confirm_password');
			}
			if($Return['error']!=''){
				$this->output($Return);
			}
			
			
			$options = array('cost' => 12);
			$password_hash = password_hash($new_password, PASSWORD_BCRYPT, $options);
			$id = $usession['cand_user_id'];	
			$data = [
				'password' => $password_hash,
			];
			
			$result = $UsersModel->update($id, $data);	
			$Return['csrf_hash'] = csrf_hash();	
			if ($result == TRUE) {
				$Return['result'] = lang('Main.xin_success_new_password_field');
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
