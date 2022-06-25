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
use CodeIgniter\I18n\Time;
 
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\MainModel;
use App\Models\ShiftModel;
use App\Models\LeaveModel;
use App\Models\ConstantsModel;
use App\Models\TimesheetModel;
use App\Models\StaffapprovalsModel;
use App\Models\NotificationsModel;

class Notifications extends BaseController {
	
	public function index()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			$session->setFlashdata('err_not_logged_in',lang('Dashboard.err_not_logged_in'));
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company'){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		$data['title'] = lang('Main.xin_notify_settings').' | '.$xin_system['application_name'];
		$data['path_url'] = 'notification_settings';
		$data['breadcrumbs'] = lang('Main.xin_notify_settings');

		$data['subview'] = view('erp/notifications/key_notifications', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function attendance_view_notify()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();		
		$segment_id = $request->uri->getSegment(3);
		$ifield_id = udecode($segment_id);
		if(!$session->has('sup_username')){ 
			$session->setFlashdata('err_not_logged_in',lang('Dashboard.err_not_logged_in'));
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		
		if($user_info['user_type']=='staff'){
			//get request
			$status = $this->request->getGET('status');
			if($status == 0){
				update_notifications_read_status_pending('attendance_settings',$ifield_id);
			} else {
				update_notifications_read_status_approved('attendance_settings',$ifield_id);
			}
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_attendance_details').' | '.$xin_system['application_name'];
		$data['path_url'] = 'notification_settings';
		$data['breadcrumbs'] = lang('Main.xin_attendance_details');

		$data['subview'] = view('erp/notifications/alertlist/attendance_view_notify', $data);
		return view('erp/layout/layout_main', $data); //page load
	}	
	public function attendance_alert_list()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
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
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_attendance_alert_list').' | '.$xin_system['application_name'];
		$data['path_url'] = 'notification_attendance';
		$data['breadcrumbs'] = lang('Main.xin_attendance_alert_list');

		$data['subview'] = view('erp/notifications/alertlist/attendance_alert_list', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function leave_alert_list()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
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
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_leave_alert_list').' | '.$xin_system['application_name'];
		$data['path_url'] = 'notification_settings';
		$data['breadcrumbs'] = lang('Main.xin_leave_alert_list');

		$data['subview'] = view('erp/notifications/alertlist/leave_alert_list', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function leave_adjust_alert_list()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
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
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_leave_adjust_alert_list').' | '.$xin_system['application_name'];
		$data['path_url'] = 'notification_settings';
		$data['breadcrumbs'] = lang('Main.xin_leave_adjust_alert_list');

		$data['subview'] = view('erp/notifications/alertlist/leave_adjust_alert_list', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function complaints_alert_list()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
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
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_complaint_alert_list').' | '.$xin_system['application_name'];
		$data['path_url'] = 'notification_settings';
		$data['breadcrumbs'] = lang('Main.xin_complaint_alert_list');

		$data['subview'] = view('erp/notifications/alertlist/complaints_alert_list', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function travel_alert_list()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
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
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_travel_alert_list').' | '.$xin_system['application_name'];
		$data['path_url'] = 'notification_settings';
		$data['breadcrumbs'] = lang('Main.xin_travel_alert_list');

		$data['subview'] = view('erp/notifications/alertlist/travel_alert_list', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function overtime_alert_list()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
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
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_overtime_alert_list').' | '.$xin_system['application_name'];
		$data['path_url'] = 'notification_settings';
		$data['breadcrumbs'] = lang('Main.xin_overtime_alert_list');

		$data['subview'] = view('erp/notifications/alertlist/overtime_request_alert_list', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function incidents_alert_list()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
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
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_incident_alert_list').' | '.$xin_system['application_name'];
		$data['path_url'] = 'notification_settings';
		$data['breadcrumbs'] = lang('Main.xin_incident_alert_list');

		$data['subview'] = view('erp/notifications/alertlist/incidents_alert_list', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function transfer_alert_list()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
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
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_transfer_alert_list').' | '.$xin_system['application_name'];
		$data['path_url'] = 'notification_settings';
		$data['breadcrumbs'] = lang('Main.xin_transfer_alert_list');

		$data['subview'] = view('erp/notifications/alertlist/transfer_alert_list', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function resignation_alert_list()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
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
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_resignation_alert_list').' | '.$xin_system['application_name'];
		$data['path_url'] = 'notification_settings';
		$data['breadcrumbs'] = lang('Main.xin_resignation_alert_list');

		$data['subview'] = view('erp/notifications/alertlist/resignation_alert_list', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	// |||update record|||
	public function update_erp_notification_settings() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			$MainModel = new MainModel();
			$UsersModel = new UsersModel();
			$SystemModel = new SystemModel();
			$NotificationsModel = new NotificationsModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			$company_id = $usession['sup_user_id'];
			$module_option = $this->request->getPost('module_option',FILTER_SANITIZE_STRING);
			if($module_option == 'leave_settings'){
				$imodule_option = 'leave_settings';
			} else if($module_option == 'leave_adjustment_settings'){
				$imodule_option = 'leave_adjustment_settings';
			} else if($module_option == 'travel_settings'){
				$imodule_option = 'travel_settings';
			} else if($module_option == 'overtime_request_settings'){
				$imodule_option = 'overtime_request_settings';
			} else if($module_option == 'incident_settings'){
				$imodule_option = 'incident_settings';
			} else if($module_option == 'transfer_settings'){
				$imodule_option = 'transfer_settings';
			} else if($module_option == 'resignation_settings'){
				$imodule_option = 'resignation_settings';
			} else if($module_option == 'complaint_settings'){
				$imodule_option = 'complaint_settings';
			} else if($module_option == 'attendance_settings'){
				$imodule_option = 'attendance_settings';
			}
			$count_notify = $NotificationsModel->where('company_id', $company_id)->where('module_options', $imodule_option)->countAllResults();
			$notify_upon_submission = $this->request->getPost('notify_upon_submission',FILTER_SANITIZE_STRING);
			$notify_upon_submission_ids = implode(',',$notify_upon_submission);
			///
			$notify_upon_approval = $this->request->getPost('notify_upon_approval',FILTER_SANITIZE_STRING);
			$notify_upon_approval_ids = implode(',',$notify_upon_approval);
				
			if($count_notify > 0){
				$data = [
				'notify_upon_submission'  => $notify_upon_submission_ids,
				'notify_upon_approval'  => $notify_upon_approval_ids,
				'updated_at'  => date('d-m-Y h:i:s'),
				];
				$result = $MainModel->update_notification_settings($data,$imodule_option,$company_id);
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_notify_updated');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
				$this->output($Return);
				exit;
			} else {
				$data = [
				'company_id'  => $company_id,
				'module_options'  => $module_option,
				'notify_upon_submission'  => $notify_upon_submission_ids,
				'notify_upon_approval'  => $notify_upon_approval_ids,
				'approval_method'  => 0,
				'approval_level'  => 0,
				'approval_level01'  => 0,
				'approval_level02'  => 0,
				'approval_level03'  => 0,
				'approval_level04'  => 0,
				'approval_level05'  => 0,
				'skip_specific_approval'  => 0,
				'added_at'  => date('d-m-Y h:i:s'),
				'updated_at'  => date('d-m-Y h:i:s'),
				];
				$result = $NotificationsModel->insert($data);
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_notify_updated');
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
	// |||update record|||
	public function update_erp_approval_settings() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'approval_levels' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_approval_level_field_error')
					]
				],
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "approval_levels" => $validation->getError('approval_levels'),
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$MainModel = new MainModel();
				$UsersModel = new UsersModel();
				$SystemModel = new SystemModel();
				$NotificationsModel = new NotificationsModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				$company_id = $usession['sup_user_id'];
				$module_option = $this->request->getPost('module_option',FILTER_SANITIZE_STRING);
				if($module_option == 'leave_settings'){
					$imodule_option = 'leave_settings';
				} else if($module_option == 'leave_adjustment_settings'){
					$imodule_option = 'leave_adjustment_settings';
				} else if($module_option == 'travel_settings'){
					$imodule_option = 'travel_settings';
				} else if($module_option == 'overtime_request_settings'){
					$imodule_option = 'overtime_request_settings';
				} else if($module_option == 'incident_settings'){
					$imodule_option = 'incident_settings';
				} else if($module_option == 'transfer_settings'){
					$imodule_option = 'transfer_settings';
				} else if($module_option == 'resignation_settings'){
					$imodule_option = 'resignation_settings';
				} else if($module_option == 'complaint_settings'){
					$imodule_option = 'complaint_settings';
				} else if($module_option == 'attendance_settings'){
					$imodule_option = 'attendance_settings';
				}
				$count_notify = $NotificationsModel->where('company_id', $company_id)->where('module_options', $imodule_option)->countAllResults();
				$method_multi_level = $this->request->getPost('method_multi_level',FILTER_SANITIZE_STRING);
				$approval_levels = $this->request->getPost('approval_levels',FILTER_SANITIZE_STRING);
				$approval_levelone = $this->request->getPost('approval_level01',FILTER_SANITIZE_STRING);
				$approval_leveltwo = $this->request->getPost('approval_level02',FILTER_SANITIZE_STRING);
				$approval_levelthree = $this->request->getPost('approval_level03',FILTER_SANITIZE_STRING);
				$approval_levelfour = $this->request->getPost('approval_level04',FILTER_SANITIZE_STRING);
				$approval_levelfive = $this->request->getPost('approval_level05',FILTER_SANITIZE_STRING);
				
				if($approval_levels==1 && isset($approval_levelone) && !empty($approval_levelone)){
					$approval_levelone = $approval_levelone;
					$approval_leveltwo = 0;
					$approval_levelthree = 0;
					$approval_levelfour = 0;
					$approval_levelfive = 0;
				} else if($approval_levels==2 && isset($approval_leveltwo) && !empty($approval_leveltwo)){
					$approval_levelone = $approval_levelone;
					$approval_leveltwo = $approval_leveltwo;
					$approval_levelthree = 0;
					$approval_levelfour = 0;
					$approval_levelfive = 0;
				} else if($approval_levels==3 && isset($approval_levelthree) && !empty($approval_levelthree)){
					$approval_levelone = $approval_levelone;
					$approval_leveltwo = $approval_leveltwo;
					$approval_levelthree = $approval_levelthree;
					$approval_levelfour = 0;
					$approval_levelfive = 0;
				} else if($approval_levels==4 && isset($approval_levelfour) && !empty($approval_levelfour)){
					$approval_levelone = $approval_levelone;
					$approval_leveltwo = $approval_leveltwo;
					$approval_levelthree = $approval_levelthree;
					$approval_levelfour = $approval_levelfour;
					$approval_levelfive = 0;
				} else if($approval_levels==5 && isset($approval_levelfive) && !empty($approval_levelfive)){
					$approval_levelone = $approval_levelone;
					$approval_leveltwo = $approval_leveltwo;
					$approval_levelthree = $approval_levelthree;
					$approval_levelfour = $approval_levelfour;
					$approval_levelfive = $approval_levelfive;
				} else {
					$approval_levelone = 0;
					$approval_leveltwo = 0;
					$approval_levelthree = 0;
					$approval_levelfour = 0;
					$approval_levelfive = 0;
				}
				
				$skip_specific_approval = $this->request->getPost('skip_specific_approval',FILTER_SANITIZE_STRING);
					
				if($count_notify > 0){
					$data = [
					'approval_method'  => $method_multi_level,
					'approval_level'  => $approval_levels,
					'approval_level01'  => $approval_levelone,
					'approval_level02'  => $approval_leveltwo,
					'approval_level03'  => $approval_levelthree,
					'approval_level04'  => $approval_levelfour,
					'approval_level05'  => $approval_levelfive,
					'skip_specific_approval'  => $skip_specific_approval,
					'updated_at'  => date('d-m-Y h:i:s'),
					];
					$result = $MainModel->update_notification_settings($data,$imodule_option,$company_id);
					$Return['csrf_hash'] = csrf_hash();	
					if ($result == TRUE) {
						$Return['result'] = lang('Main.xin_notify_updated');
					} else {
						$Return['error'] = lang('Main.xin_error_msg');
					}
					$this->output($Return);
					exit;
				} else {
					$data = [
					'company_id'  => $company_id,
					'module_options'  => $module_option,
					'notify_upon_submission'  => 0,
					'notify_upon_approval'  => 0,
					'approval_method'  => $method_multi_level,
					'approval_level'  => $approval_levels,
					'approval_level01'  => $approval_levelone,
					'approval_level02'  => $approval_leveltwo,
					'approval_level03'  => $approval_levelthree,
					'approval_level04'  => $approval_levelfour,
					'approval_level05'  => $approval_levelfive,
					'skip_specific_approval'  => $skip_specific_approval,
					'added_at'  => date('d-m-Y h:i:s'),
					'updated_at'  => date('d-m-Y h:i:s'),
					];
					$result = $NotificationsModel->insert($data);
					$Return['csrf_hash'] = csrf_hash();	
					if ($result == TRUE) {
						$Return['result'] = lang('Main.xin_notify_updated');
					} else {
						$Return['error'] = lang('Main.xin_error_msg');
					}
					$this->output($Return);
					exit;
				}	
			}
		} else {
			$Return['error'] = lang('Main.xin_error_msg');
			$this->output($Return);
			exit;
		}
	}
	// |||update record|||
	public function update_attendance_status_record() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'status' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "status" => $validation->getError('status'),
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$status = $this->request->getPost('status',FILTER_SANITIZE_STRING);
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
				} else {
					$company_id = $usession['sup_user_id'];
				}
				$TimesheetModel = new TimesheetModel();
				$StaffapprovalsModel = new StaffapprovalsModel();
				// get approvals
				$skip_specific = skip_specific_approval_info('attendance_settings');
				$iskip_specific = $skip_specific['skip_specific_approval'];
				if($iskip_specific == 1){
					$level_option = staff_reporting_manager_info($usession['sup_user_id'],'attendance_settings');
					$total_levels = $level_option['total_levels'];
				} else {
					$result = $TimesheetModel->where('time_attendance_id', $id)->first();
					$old_level = staff_reporting_manager_old_level($result['employee_id'],'attendance_settings');
					$total_levels = $old_level['total_levels'];
				}
				// check approvals
				$approval_cnt = $StaffapprovalsModel->where('company_id', $company_id)->where('module_key_id', $id)->where('module_option', 'attendance_settings')->countAllResults();
				$iapproval_cnt = $approval_cnt+1;

				if($user_info['user_type'] == 'company'){
					$data = [
						'status'  => $status,
					];
					$TimesheetModel = new TimesheetModel();
					$result = $TimesheetModel->update($id,$data);
				} else {
					if($iapproval_cnt == $total_levels){	
						$data2 = [
							'company_id'  => $company_id,
							'staff_id'  => $usession['sup_user_id'],
							'module_key_id'  => $id,
							'module_option'  => 'attendance_settings',
							'status'  => 1,
							'approval_level'  => 1,
							'updated_at' => date('d-m-Y h:i:s')
						];
						$StaffapprovalsModel->insert($data2);
						$data = [
							'status'  => $status,
						];
						$TimesheetModel = new TimesheetModel();
						$result = $TimesheetModel->update($id,$data);
					} else {
						if($iapproval_cnt < $total_levels){
							if($status == 'Not Approved') {
								$data = [
									'status'  => $status,
								];
								$TimesheetModel = new TimesheetModel();
								$TimesheetModel->update($id,$data);
								
								$data2 = [
									'company_id'  => $company_id,
									'staff_id'  => $usession['sup_user_id'],
									'module_key_id'  => $id,
									'module_option'  => 'attendance_settings',
									'status'  => 2,
									'approval_level'  => 2,
									'updated_at' => date('d-m-Y h:i:s')
								];
							} else {					
								$data2 = [
									'company_id'  => $company_id,
									'staff_id'  => $usession['sup_user_id'],
									'module_key_id'  => $id,
									'module_option'  => 'attendance_settings',
									'status'  => 1,
									'approval_level'  => 0,
									'updated_at' => date('d-m-Y h:i:s')
								];
							}
							$result = $StaffapprovalsModel->insert($data2);
						} else {
							$Return['result'] = 'Approval level finished.';
							$this->output($Return);
						}
					}
				}
				
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_updated_status');
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
	public function mark_all_as_read() {
		
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		
		notifications_submission_mark_all_as_read('incident_settings');
		notifications_submission_mark_all_as_read('complaint_settings');
		notifications_submission_mark_all_as_read('leave_settings');
		notifications_submission_mark_all_as_read('leave_adjustment_settings');
		notifications_submission_mark_all_as_read('overtime_request_settings');
		notifications_submission_mark_all_as_read('transfer_settings');
		notifications_submission_mark_all_as_read('resignation_settings');
		notifications_submission_mark_all_as_read('travel_settings');
		notifications_submission_mark_all_as_read('attendance_settings');
		echo lang('Main.xin_marked_notify_as_read');
	 }
	 
	 public function update_attendance_alert() {
		 
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			$UsersModel = new UsersModel();
			$TimesheetModel = new TimesheetModel();
			$attendance_val = $this->request->getPost('attendance_val',FILTER_SANITIZE_STRING);
			$status = 'Approved';
			$StaffapprovalsModel = new StaffapprovalsModel();
			// get approvals
			$level_option = staff_reporting_manager_info($usession['sup_user_id'],'attendance_settings');
			$total_levels = $level_option['total_levels'];
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			// print_r($explode); die();
			foreach($attendance_val as $time_attendance_id) {
				// check approvals
				$approval_cnt = $StaffapprovalsModel->where('company_id', $company_id)->where('module_key_id', $time_attendance_id)->where('module_option', 'attendance_settings')->countAllResults();
				$iapproval_cnt = $approval_cnt+1;
				if($iapproval_cnt == $total_levels){	
					$data2 = [
						'company_id'  => $company_id,
						'staff_id'  => $usession['sup_user_id'],
						'module_key_id'  => $time_attendance_id,
						'module_option'  => 'attendance_settings',
						'status'  => 1,
						'updated_at' => date('d-m-Y h:i:s')
					];
					$StaffapprovalsModel->insert($data2);
					$data = [
						'status'  => $status,
					];
					$TimesheetModel = new TimesheetModel();
					$result = $TimesheetModel->update($time_attendance_id,$data);
				}
			}
			if ($result == TRUE) {
				$Return['result'] = lang('Main.xin_Staus_changed_successfully');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
					
		} else {
			$Return['error'] = lang('Main.xin_error_msg');
		}
		$Return['csrf_hash'] = csrf_hash();
		$this->output($Return);
		exit;
	}
	public function update_employe_attendance_add()
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
			return view('erp/notifications/alertlist/dialog_employee_attendance', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
}
