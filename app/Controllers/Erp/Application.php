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
namespace App\Controllers\Erp;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Files\UploadedFile;
 
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\MainModel;
use App\Models\ShiftModel;
use App\Models\TimesheetModel;
use App\Models\StaffdetailsModel;
use App\Models\FrontendcontentModel;

class Application extends BaseController {

	public function erp_calendar()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			$session->setFlashdata('err_not_logged_in',lang('Dashboard.err_not_logged_in'));
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		if($user_info['user_type'] != 'company'){
			if(!in_array('system_calendar',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.xin_system_calendar').' | '.$xin_system['application_name'];
		$data['path_url'] = 'employees';
		$data['breadcrumbs'] = lang('Dashboard.xin_system_calendar');

		$data['subview'] = view('erp/erp_calendar/erp_calendar', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	
	public function reports()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			$session->setFlashdata('err_not_logged_in',lang('Dashboard.err_not_logged_in'));
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		if($user_info['user_type'] != 'company'){
			if(!in_array('system_reports',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.xin_system_reports').' | '.$xin_system['application_name'];
		$data['path_url'] = 'employees';
		$data['breadcrumbs'] = lang('Dashboard.xin_system_reports');

		$data['subview'] = view('erp/reports_imports/reports', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function staff_import()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			return redirect()->to(site_url('erp/desk'));
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_import_employees').' | '.$xin_system['application_name'];
		$data['path_url'] = 'import_data';
		$data['breadcrumbs'] = lang('Main.xin_import_employees');

		$data['subview'] = view('erp/reports_imports/staff_import', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function attendance_import()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			return redirect()->to(site_url('erp/desk'));
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.left_import_attendance').' | '.$xin_system['application_name'];
		$data['path_url'] = 'import_data';
		$data['breadcrumbs'] = lang('Main.left_import_attendance');

		$data['subview'] = view('erp/reports_imports/attendance_import', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function employee_approvals()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			return redirect()->to(site_url('erp/desk'));
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_approvals_employees').' | '.$xin_system['application_name'];
		$data['path_url'] = 'employee_approvals';
		$data['breadcrumbs'] = lang('Main.xin_approvals_employees');

		$data['subview'] = view('erp/employees/employee_approvals', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function shift_calendar()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			return redirect()->to(site_url('erp/desk'));
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_shift_calendar').' | '.$xin_system['application_name'];
		$data['path_url'] = 'shift_calendar';
		$data['breadcrumbs'] = lang('Main.xin_shift_calendar');

		$data['subview'] = view('erp/timesheet/shift_calendar', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function company_settings()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			$session->setFlashdata('err_not_logged_in',lang('Dashboard.err_not_logged_in'));
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		if($user_info['user_type'] != 'company'){
			if(!in_array('company_settings',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.dashboard_employees').' | '.$xin_system['application_name'];
		$data['path_url'] = 'employees';
		$data['breadcrumbs'] = lang('Dashboard.dashboard_employees');

		$data['subview'] = view('erp/settings/company_settings', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function company_constants()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			return redirect()->to(site_url('erp/desk'));
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.dashboard_employees').' | '.$xin_system['application_name'];
		$data['path_url'] = 'employees';
		$data['breadcrumbs'] = lang('Dashboard.dashboard_employees');

		$data['subview'] = view('erp/settings/company_constants', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function org_chart()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			return redirect()->to(site_url('erp/desk'));
		}
		if($user_info['user_type'] != 'company'){
			if(!in_array('org_chart',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.xin_org_chart_title').' | '.$xin_system['application_name'];
		$data['path_url'] = 'chart';
		$data['breadcrumbs'] = lang('Dashboard.xin_org_chart_title');

		$data['subview'] = view('erp/chart/key_chart', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function frontend_settings()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_frontend_settings').' | '.$xin_system['application_name'];
		$data['path_url'] = 'frontend_settings';
		$data['breadcrumbs'] = lang('Main.xin_frontend_settings');

		$data['subview'] = view('erp/settings/frontend_settings', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	// |||add record|||
	public function add_approvals() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();

			$approval_level01 = $this->request->getPost('approval_level01',FILTER_SANITIZE_STRING);
			$approval_level02 = $this->request->getPost('approval_level02',FILTER_SANITIZE_STRING);
			$approval_level03 = $this->request->getPost('approval_level03',FILTER_SANITIZE_STRING);
			if(isset($approval_level01) && !empty($approval_level01)){
				$approval_level01 = $approval_level01;
			} else {
				$approval_level01 = 0;
			}
			if(isset($approval_level02) && !empty($approval_level02)){
				$approval_level02 = $approval_level02;
			} else {
				$approval_level02 = 0;
			}
			if(isset($approval_level03) && !empty($approval_level03)){
				$approval_level03 = $approval_level03;
			} else {
				$approval_level03 = 0;
			}				
			$UsersModel = new UsersModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
			
			$data = [
				'approval_level01'  => $approval_level01,
				'approval_level02'  => $approval_level02,
				'approval_level03'  => $approval_level03,
			];
			$MainModel = new MainModel();
			$result = $MainModel->update_employee_record($data,$id);	
			$Return['csrf_hash'] = csrf_hash();	
			if ($result == TRUE) {
				$Return['result'] = lang('Main.xin_approvals_specific_employees_updated_success');
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
	// Validate and update info in database
	public function upload_employees() {
	
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');		
	
		if ($this->request->getPost('type') === 'imp_employees') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$UsersModel = new UsersModel();
			$SystemModel = new SystemModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
				$company_info = $UsersModel->where('company_id', $company_id)->first();
			} else {
				$company_id = $usession['sup_user_id'];
				$company_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			}
			//validate whether uploaded file is a csv file
   			$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
			if($_FILES['file']['name']==='') {
				$Return['error'] = lang('Main.xin_employee_imp_allowed_size');
			} else {
				if(in_array($_FILES['file']['type'],$csvMimes)){
					if(is_uploaded_file($_FILES['file']['tmp_name'])){
						
						// check file size
						if(filesize($_FILES['file']['tmp_name']) > 10240) {
							$Return['error'] = lang('Main.xin_error_employees_import_size');
						} else {
						
							//open uploaded csv file with read only mode
							$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
							
							//skip first line
							fgetcsv($csvFile);
							$options = array('cost' => 12);
							
							//parse data from csv file line by line
							while(($line = fgetcsv($csvFile)) !== FALSE){
								
								$password_hash = password_hash($line[5], PASSWORD_BCRYPT, $options);
								$data = [
								'first_name' => $line[1],
								'last_name'  => $line[2],
								'username'  => $line[3],
								'email'  => $line[4],
								'password'  => $password_hash,
								'user_type'  => 'staff',
								'user_role_id' => $line[7],
								'gender' => $line[8],
								
								'contact_number'  => $line[9],
								'country'  => 0,
								
								'address_1'  => '',
								'address_2'  => '',
								'city'  =>'',
								'profile_photo'  => '',
								'state'  => '',
								'zipcode' => '',
								
								'company_name' => $company_info['company_name'],
								'trading_name' => '',
								'registration_no' => '',
								'government_tax' => '',
								'company_type_id'  => 0,
								'last_login_date' => '0',
								'last_logout_date' => '0',
								'last_login_ip' => '0',
								'is_logged_in' => '0',
								'is_active'  => 1,
								'company_id'  => $company_id,
								'created_at' => date('d-m-Y h:i:s')
							];
							$StaffdetailsModel = new StaffdetailsModel();
							$result = $UsersModel->insert($data);
							$user_id = $UsersModel->insertID();
							// employee details
							$data2 = [
								'company_id' => $company_id,
								'user_id' => $user_id,
								'employee_id'  => $line[0],
								'department_id'  => $line[10],
								'designation_id'  => $line[11],
								'office_shift_id' => $line[6],
								'date_of_joining' => date('Y-m-d'),
								'date_of_leaving' => '',
								'date_of_birth' => '',
								'marital_status' => 0,
								'religion_id' => 0,
								'blood_group' => '',
								'citizenship_id' => 0,
								'basic_salary'  => $line[12],
								'hourly_rate'  => 0,
								'salay_type' => 1,
								'role_description' => 'Enter role description here..',
								'bio' => 'Enter staff bio here..',
								'experience' => 0,
								'fb_profile' => '',
								'twitter_profile' => '',
								'gplus_profile' => '',
								'linkedin_profile' => '',
								'account_title' => '',
								'account_number' => '',
								'bank_name' => '',
								'iban' => '',
								'swift_code' => '',
								'bank_branch' => '',
								'contact_full_name' => '',
								'contact_phone_no' => '',
								'contact_email' => '',
								'contact_address' => '',
								'job_type' => 1,
								'leave_options' => '',
								'created_at' => date('d-m-Y h:i:s')
							];
							$StaffdetailsModel->insert($data2);
							}
							//close opened csv file
							fclose($csvFile);
				
							$Return['result'] = lang('Main.xin_success_employees_import');
						}
					} else{
						$Return['error'] = lang('Main.xin_error_not_employee_import');
					}
				}
			}
			if($Return['error']!=''){
				$this->output($Return);
			}
			$this->output($Return);
			exit;
		}
	}
	// Validate and update info in database
	public function upload_attendance() {
	
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');
	
		if ($this->request->getPost('type') === 'imp_attendance') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$UsersModel = new UsersModel();
			$SystemModel = new SystemModel();
			$StaffdetailsModel = new StaffdetailsModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
				$company_info = $UsersModel->where('company_id', $company_id)->first();
			} else {
				$company_id = $usession['sup_user_id'];
				$company_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			}
			//validate whether uploaded file is a csv file
   			$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
			if($_FILES['file']['name']==='') {
				$Return['error'] = lang('Main.xin_employee_imp_allowed_size');
			} else {
				if(in_array($_FILES['file']['type'],$csvMimes)){
					if(is_uploaded_file($_FILES['file']['tmp_name'])){
						
						// check file size
						if(filesize($_FILES['file']['tmp_name']) > 10240) {
							$Return['error'] = lang('Main.xin_error_employees_import_size');
						} else {
						
							//open uploaded csv file with read only mode
							$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
							
							//skip first line
							fgetcsv($csvFile);
							
							//parse data from csv file line by line
							while(($line = fgetcsv($csvFile)) !== FALSE){
								
								$attendance_date = $line[1];
								$clock_in = $line[2];
								$clock_out = $line[3];
								$clock_in2 = $attendance_date.' '.$clock_in;
								$clock_out2 = $attendance_date.' '.$clock_out;
								
								//total work
								$cout = date_create($clock_in2);
								$cin = date_create($clock_out2);
								
								$interval_cin = date_diff($cout, $cin);
								$hours_in   = $interval_cin->format('%h');
								$minutes_in = $interval_cin->format('%i');			
								$total_work = $hours_in .":".$minutes_in;
								
								$employee_id = $user_info = $StaffdetailsModel->where('employee_id', $line[0])->first();
								if($employee_id){
									$fuser_id = $employee_id['user_id'];
									$fshift_id = $employee_id['office_shift_id'];
								} else {
									$fuser_id = '0';
									$fshift_id = '0';
								}
							
								$data = array(
								'employee_id' => $fuser_id,
								'company_id'  => $company_id,
								'attendance_date' => $attendance_date,
								'clock_in' => $clock_in2,
								'clock_in_ip_address' => '::1',
								'clock_out' => $clock_out2,
								'clock_in_out' => 0,
								'clock_out_ip_address' => '::1',
								'clock_in_latitude' => 1,
								'clock_in_longitude' => 1,
								'clock_out_latitude' => 1,
								'clock_out_longitude' => 1,
								'time_late' => $clock_in2,
								'total_work' => $total_work,
								'total_rest' => '',
								'early_leaving' => $clock_out2,
								'overtime' => $clock_out2,
								'shift_id' => $fshift_id,
								'work_from_home' => $line[4],
								'lunch_breakin' => 0,
								'lunch_breakout' => 0,
								'attendance_status' => 'Present',
								'clock_in_out' => '0'
								);
								$TimesheetModel = new TimesheetModel();
								$result = $TimesheetModel->insert($data);
								$Return['result'] = lang('Main.xin_success_employees_import');
						 }
							 //close opened csv file
							fclose($csvFile);
				
							$Return['result'] = lang('Main.xin_success_attendance_import');
						}
					} else{
						$Return['error'] = lang('Main.xin_error_not_employee_import');
					}
				}
			}
			if($Return['error']!=''){
				$this->output($Return);
			}
			$this->output($Return);
			exit;
		}
	}
	// Validate and update info in database
	public function update_frontend_content() {
	
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');		
		$FrontendcontentModel = new FrontendcontentModel();
	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$validation->setRules([
					'about_short' => 'required',
					'youtube_url' => 'required',
				],
				[   // Errors
					'about_short' => [
						'required' => lang('Main.xin_frontend_about_error'),
					],
					'youtube_url' => [
						'required' => lang('Main.xin_youtube_link_field_error'),
					]
				]
			);
			$validation->withRequest($this->request)->run();
			//check error
			if ($validation->hasError('about_short')) {
				$Return['error'] = $validation->getError('about_short');
			} else if ($validation->hasError('youtube_url')) {
				$Return['error'] = $validation->getError('youtube_url');
			}
			if($Return['error']!=''){
				$this->output($Return);
			}
					
			$about_short = $this->request->getPost('about_short',FILTER_SANITIZE_STRING);
			$youtube_url = $this->request->getPost('youtube_url',FILTER_SANITIZE_STRING);
			$fb_profile = $this->request->getPost('fb_profile',FILTER_SANITIZE_STRING);
			$twitter_profile = $this->request->getPost('twitter_profile',FILTER_SANITIZE_STRING);
			$linkedin_profile = $this->request->getPost('linkedin_profile',FILTER_SANITIZE_STRING);
			
			$id = 1;
			$data = [
				'about_short' => $about_short,
				'youtube_url' => $youtube_url,
				'fb_profile' => $fb_profile,
				'twitter_profile' => $twitter_profile,
				'linkedin_profile' => $linkedin_profile,
			];
			$result = $FrontendcontentModel->update($id,$data);
			$Return['csrf_hash'] = csrf_hash();	
			if ($result == TRUE) {
				$Return['result'] = lang('Main.xin_frontend_content_updated');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
			exit;
		}
	}
	// read record
	public function read_shift_time()
	{
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		$id = $request->getGet('field_id');
		$data = [
				'field_id' => $id,
			];
		if($session->has('sup_username')){
			return view('erp/timesheet/dialog_shift_calendar_time', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// read record
	public function read_shift_assign()
	{
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		$id = $request->getGet('field_id');
		$data = [
				'field_id' => $id,
			];
		if($session->has('sup_username')){
			return view('erp/timesheet/dialog_shift_calendar_time', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// |||edit record|||
	public function update_office_shift() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			
			$in_time = $this->request->getPost('in_time',FILTER_SANITIZE_STRING);
			$out_time = $this->request->getPost('out_time',FILTER_SANITIZE_STRING);
			$day = $this->request->getPost('time_val',FILTER_SANITIZE_STRING);
			$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
			if($day == 'Monday') {
				$data = [
					'monday_in_time'  => $in_time,
					'monday_out_time'  => $out_time,
				];
			} elseif($day == 'Tuesday') {
				$data = [
					'tuesday_in_time'  => $in_time,
					'tuesday_out_time'  => $out_time,
				];
			} elseif($day == 'Wednesday') {
				$data = [
					'wednesday_in_time'  => $in_time,
					'wednesday_out_time'  => $out_time,
				];
			} else if($day == 'Thursday') {
				$data = [
					'thursday_in_time'  => $in_time,
					'thursday_out_time'  => $out_time,
				];
			} else if($day == 'Friday') {
				$data = [
					'friday_in_time'  => $in_time,
					'friday_out_time'  => $out_time,
				];
			} else if($day == 'Saturday') {
				$data = [
					'saturday_in_time'  => $in_time,
					'saturday_out_time'  => $out_time,
				];
			} else if($day == 'Sunday') {
				$data = [
					'sunday_in_time'  => $in_time,
					'sunday_out_time'  => $out_time,
				];
			}
			$ShiftModel = new ShiftModel();
			$result = $ShiftModel->update($id, $data);
			$Return['csrf_hash'] = csrf_hash();	
			if ($result == TRUE) {
				$Return['result'] = lang('Success.employee_update_shift_success');
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
	// |||edit record|||
	public function update_staff_shift() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			
			$office_shift_id = $this->request->getPost('office_shift_id',FILTER_SANITIZE_STRING);
			$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
			// employee details
			$data2 = [
				'office_shift_id'  => $office_shift_id,
			];
			$MainModel = new MainModel();
			$result = $MainModel->update_employee_record($data2,$id);
			$Return['csrf_hash'] = csrf_hash();	
			if ($result == TRUE) {
				$Return['result'] = lang('Success.employee_update_shift_success');
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
