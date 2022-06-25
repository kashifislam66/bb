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
use App\Models\TimesheetModel;
use App\Models\StaffdetailsModel;
use App\Models\StaffapprovalsModel;
use App\Models\OvertimerequestModel;

class Timesheet extends BaseController {

	public function timesheet_dashboard()
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

		$data['subview'] = view('erp/timesheet/timesheet_dashboard', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function attendance()
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
			if(!in_array('attendance',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.left_attendance').' | '.$xin_system['application_name'];
		$data['path_url'] = 'timesheet_attendance';
		$data['breadcrumbs'] = lang('Dashboard.left_attendance');

		$data['subview'] = view('erp/timesheet/timesheet_attendance', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	
	public function attendance_view()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$TimesheetModel = new TimesheetModel();
		$request = \Config\Services::request();
		$ifield_id = udecode($request->uri->getSegment(3));
		$date_info = $request->uri->getSegment(4);
		$attendance_date = udecode($date_info);
		
		$isegment_val = $TimesheetModel->where('employee_id', $ifield_id)->first();
		$isegment_date = $TimesheetModel->where('attendance_date', $attendance_date)->first();
		if(!$isegment_val || !$isegment_date){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			return redirect()->to(site_url('erp/desk'));
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.xin_hrm_dashboard').' | '.$xin_system['application_name'];
		$data['path_url'] = 'timesheet_attendance';
		$data['breadcrumbs'] = lang('Dashboard.xin_hrm_dashboard');

		$data['subview'] = view('erp/timesheet/timesheet_attendance_view', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
	public function update_attendance()
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
		if($user_info['user_type'] != 'company'){
			if(!in_array('upattendance1',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.left_update_attendance').' | '.$xin_system['application_name'];
		$data['path_url'] = 'timesheet_update';
		$data['breadcrumbs'] = lang('Dashboard.left_update_attendance');

		$data['subview'] = view('erp/timesheet/timesheet_update', $data);
		return view('erp/layout/layout_main', $data); //page load
	}

	public function update_attendance_view()
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
		if($user_info['user_type'] != 'company'){
			if(!in_array('upattendance1',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.left_update_attendance').' | '.$xin_system['application_name'];
		$data['path_url'] = 'timesheet_attendance_employee';
		$data['breadcrumbs'] = lang('Dashboard.left_update_attendance');

		$data['subview'] = view('erp/timesheet/timesheet_attendance_employee', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function monthly_timesheet()
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
		if($user_info['user_type'] != 'company'){
			if(!in_array('monthly_time',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.xin_month_timesheet_title').' | '.$xin_system['application_name'];
		$data['path_url'] = 'empty';
		$data['breadcrumbs'] = lang('Dashboard.xin_month_timesheet_title');

		$data['subview'] = view('erp/reports/attendance_report', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
	public function monthly_timesheet_filter()
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
		if($user_info['user_type'] != 'company'){
			if(!in_array('monthly_time',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.xin_month_timesheet_title').' | '.$xin_system['application_name'];
		$data['path_url'] = 'empty';
		$data['breadcrumbs'] = lang('Dashboard.xin_month_timesheet_title');

		$data['subview'] = view('erp/timesheet/timesheet_monthly', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function timesheet_calendar()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Employees.xin_employee_details').' | '.$xin_system['application_name'];
		$data['path_url'] = 'employee_details';
		$data['breadcrumbs'] = lang('Employees.xin_employee_details');

		$data['subview'] = view('erp/timesheet/timesheet_calendar', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function overtime_request()
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
		if($user_info['user_type'] != 'company'){
			if(!in_array('overtime_req1',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.xin_overtime_request').' | '.$xin_system['application_name'];
		$data['path_url'] = 'overtime_request';
		$data['breadcrumbs'] = lang('Dashboard.xin_overtime_request');

		$data['subview'] = view('erp/timesheet/timesheet_overtime_request', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function overtime_view()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$ifield_id = udecode($request->uri->getSegment(3));
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
		/*if($user_info['user_type'] != 'company'){
			if(!in_array('overtime_req1',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}*/
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type']=='staff'){
			//get request
			$status = $this->request->getGET('status');
			if($status == 0){
				update_notifications_read_status_pending('overtime_request_settings',$ifield_id);
			} else {
				update_notifications_read_status_approved('overtime_request_settings',$ifield_id);
			}
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.xin_overtime_request').' | '.$xin_system['application_name'];
		$data['path_url'] = 'overtime_request';
		$data['breadcrumbs'] = lang('Dashboard.xin_overtime_request');

		$data['subview'] = view('erp/timesheet/timesheet_overtime_request_details', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	
	// record list
	public function attendance_list() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$TimesheetModel = new TimesheetModel();
		$ShiftModel = new ShiftModel();
		$MainModel = new MainModel();
		$StaffdetailsModel = new StaffdetailsModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$get_data = $UsersModel->where('user_id',$usession['sup_user_id'])->where('user_type','staff')->findAll();
		} else {
			$get_data = $UsersModel->where('company_id',$usession['sup_user_id'])->where('user_type','staff')->where('is_active',1)->findAll();
		}
		$data = array();
		$attendance_date = date('Y-m-d');
		foreach($get_data as $r) {
			
			//
			$get_day = strtotime($attendance_date);
			$day = date('l', $get_day);
			// get user info
			//$iuser_info = $UsersModel->where('user_id', $r['user_id'])->first();
			$user_detail = $StaffdetailsModel->where('user_id', $r['user_id'])->first();
			// shift info
			$office_shift = $ShiftModel->where('office_shift_id',$user_detail['office_shift_id'])->first();
			if($office_shift){
				
			if($day == 'Monday') {
				if($office_shift['monday_in_time']==''){
					$in_time = '00:00:00';
					$out_time = '00:00:00';
				} else {
					$in_time = $office_shift['monday_in_time'];
					$out_time = $office_shift['monday_out_time'];
				}
			} else if($day == 'Tuesday') {
				if($office_shift['tuesday_in_time']==''){
					$in_time = '00:00:00';
					$out_time = '00:00:00';
				} else {
					$in_time = $office_shift['tuesday_in_time'];
					$out_time = $office_shift['tuesday_out_time'];
				}
			} else if($day == 'Wednesday') {
				if($office_shift['wednesday_in_time']==''){
					$in_time = '00:00:00';
					$out_time = '00:00:00';
				} else {
					$in_time = $office_shift['wednesday_in_time'];
					$out_time = $office_shift['wednesday_out_time'];
				}
			} else if($day == 'Thursday') {
				if($office_shift['thursday_in_time']==''){
					$in_time = '00:00:00';
					$out_time = '00:00:00';
				} else {
					$in_time = $office_shift['thursday_in_time'];
					$out_time = $office_shift['thursday_out_time'];
				}
			} else if($day == 'Friday') {
				if($office_shift['friday_in_time']==''){
					$in_time = '00:00:00';
					$out_time = '00:00:00';
				} else {
					$in_time = $office_shift['friday_in_time'];
					$out_time = $office_shift['friday_out_time'];
				}
			} else if($day == 'Saturday') {
				if($office_shift['saturday_in_time']==''){
					$in_time = '00:00:00';
					$out_time = '00:00:00';
				} else {
					$in_time = $office_shift['saturday_in_time'];
					$out_time = $office_shift['saturday_out_time'];
				}
			} else if($day == 'Sunday') {
				if($office_shift['sunday_in_time']==''){
					$in_time = '00:00:00';
					$out_time = '00:00:00';
				} else {
					$in_time = $office_shift['sunday_in_time'];
					$out_time = $office_shift['sunday_out_time'];
				}
			}
			} else {
				$in_time = '00:00:00';
				$out_time = '00:00:00';
			}
			// check clock_in
			$check_in_row = $MainModel->attendance_first_in_check($r['user_id'],$attendance_date);
			if($check_in_row > 0){
				// for clock-in
				$attendance = $TimesheetModel->where('employee_id', $r['user_id'])->where('attendance_date', $attendance_date)->first();
				// clock in time
				$clock_in_time = strtotime($attendance['clock_in']);
				$fclock_in = date("h:i a", $clock_in_time);
				//time diff > total time late
				$office_time_new = strtotime($in_time.' '.$attendance_date);
				$clock_in_time_new = strtotime($attendance['clock_in']);
				$ioffice_time_new = date_create($in_time.' '.$attendance_date);
				$iclock_in_time = date_create($attendance['clock_in']);
				if($clock_in_time_new <= $office_time_new) {
					$total_time_l = '00:00';
				} else {
					$interval_late = date_diff($iclock_in_time, $ioffice_time_new);//$office_time_new->date_diff($office_time_new);
					$hours_l   = $interval_late->format('%h');
					$minutes_l = $interval_late->format('%i');			
					$total_time_l = $hours_l ."h ".$minutes_l."m";
				}
				if($total_time_l=='') {
					$total_time_l = '00:00';
				} else {
					$total_time_l = $total_time_l;
				}
				// total hours worked
				$total_hrs = $TimesheetModel->where('employee_id', $r['user_id'])->where('attendance_date', $attendance_date)->where('total_work !=', '')->findAll();
				$hrs_old_int1 = 0;
				$Total = '';
				$Trest = '';
				$total_time_rs = '';
				$hrs_old_int_res1 = '';
				foreach ($total_hrs as $hour_work){		
					// total work			
					$timee = $hour_work['total_work'].':00';
					$str_time =$timee;
		
					$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
					
					sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
					
					$hrs_old_seconds = $hours * 3600 + $minutes * 60 + $seconds;
					
					$hrs_old_int1 += $hrs_old_seconds;
					
					$Total = gmdate("H:i", $hrs_old_int1);	
				}
				if($Total=='') {
					$total_work = '00:00';
				} else {
					$total_work = $Total;
				}
				 
				// total rest > 
				$total_rest = $TimesheetModel->where('employee_id', $r['user_id'])->where('attendance_date', $attendance_date)->where('total_rest !=', '')->findAll();
				foreach ($total_rest as $rest){			
					// total rest
					$str_time_rs = $rest['total_rest'].':00';
					//$str_time_rs =$timee_rs;
		
					$str_time_rs = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time_rs);
					
					sscanf($str_time_rs, "%d:%d:%d", $hours_rs, $minutes_rs, $seconds_rs);
					
					$hrs_old_seconds_rs = $hours_rs * 3600 + $minutes_rs * 60 + $seconds_rs;
					
					$hrs_old_int_res1 = $hrs_old_seconds_rs;
					
					$total_time_rs = gmdate("H:i", $hrs_old_int_res1);
				}
			
				// check attendance status
				$status = '<span class="badge badge-light-success">'.$attendance['attendance_status'].'</span>';
				if($total_time_rs=='') {
					$Trest = '00:00';
				} else {
					$Trest = $total_time_rs;
				}
				
			} else {
				$fclock_in = '00:00';
				$total_time_l = '00:00';
				$total_work = '00:00';
				$Trest = '00:00';
				$view_info = '';
				$fclock_in_ip = $fclock_in;
				// ||leave check
				$leave_date_chck = $MainModel->leave_date_check($r['user_id'],$attendance_date);
				// ||holiday check
				$holiday_date_check = $MainModel->holiday_date_check($attendance_date);
				if($office_shift){
					if($office_shift['monday_in_time'] == '' && $day == 'Monday') {
						$status = '<span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';	
					} else if($office_shift['tuesday_in_time'] == '' && $day == 'Tuesday') {
						$status = '<span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';	
					} else if($office_shift['wednesday_in_time'] == '' && $day == 'Wednesday') {
						$status = '<span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';	
					} else if($office_shift['thursday_in_time'] == '' && $day == 'Thursday') {
						$status = '<span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';	
					} else if($office_shift['friday_in_time'] == '' && $day == 'Friday') {
						$status = '<span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';	
					} else if($office_shift['saturday_in_time'] == '' && $day == 'Saturday') {
						$status = '<span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';	
					} else if($office_shift['sunday_in_time'] == '' && $day == 'Sunday') {
						$status = '<span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';	
					} else if($holiday_date_check['holiday_count'] > 0){ // holiday
						$status = '<span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';
					} else if($leave_date_chck['leave_count'] > 0){ // on leave
						$status = '<span class="badge badge-light-info">'.lang('Leave.left_on_leave').'</span>';
					} else {
						$status = '<span class="badge badge-light-danger">'.lang('Attendance.attendance_absent').'</span>';
					}
				} else {
					$status = '<span class="badge badge-light-danger">'.lang('Main.xin_noshift').'</span>';
				}
				 
			}
			// if checkout||| limit-1
			$check_out_row = $MainModel->attendance_first_out_check($r['user_id'],$attendance_date);
			if($check_out_row>0){
				/* early time */
				$early_time = strtotime($out_time.' '.$attendance_date);
				// check clock in time
				$first_out = $MainModel->attendance_first_out($r['user_id'],$attendance_date);
				//$first_out = $TimesheetModel->where('employee_id', $r['user_id'])->where('attendance_date', $attendance_date)->orderBy('time_attendance_id', 'DESC')->limit(1)->first();
				// clock out time
				$clock_out = strtotime($first_out[0]->clock_out);
				if ($first_out[0]->clock_out!='') {
					$clock_out2 = date("h:i a", $clock_out);
					$fclock_out = $clock_out2;
					//time diff > // early leaving
					$early_new_time = strtotime($out_time.' '.$attendance_date);
					$clock_out_time_new = strtotime($first_out[0]->clock_out);
					$ioffice_time_new = date_create($out_time.' '.$attendance_date);
					$iclock_in_time = date_create($first_out[0]->clock_out);
					if($early_new_time <= $clock_out_time_new) {
						$total_time_e = '00:00';
					} else {
						$interval_lateo = date_diff($ioffice_time_new, $iclock_in_time);
						$hours_e   = $interval_lateo->format('%h');
						$minutes_e = $interval_lateo->format('%i');			
						$total_time_e = $hours_e ."h ".$minutes_e."m";
					}	
				} else {
					$clock_out2 =  '00:00';
					$total_time_e = '00:00';
					//$overtime2 = '00:00';
					$fclock_out = $clock_out2;
				}
				$view_info = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Attendance.xin_attendance_details').'"><a target="_blank" href="'.site_url('erp/attendance-info').'/'.uencode($r['user_id']).'/'.uencode($attendance_date).'" target="_blank"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light"><i class="feather icon-arrow-right"></i></button></a></span>';
			} else {
				$clock_out2 =  '00:00';
				$total_time_e = '00:00';
				//$overtime2 = '00:00';
				$view_info = '';
				$fclock_out = $clock_out2;
			}
			$employee_name = $r['first_name'].' '.$r['last_name'];
			
			
			$staff_name = '<div class="d-inline-block align-middle">
				<img src="'.staff_profile_photo($r['user_id']).'" alt="user image" class="img-radius align-top m-r-15" style="width:40px;">
				<div class="d-inline-block">
					<h6 class="m-b-0">'.$employee_name.'</h6>
					<p class="m-b-0">'.$r['email'].'</p>
				</div>
			</div>';
			$links = '
				'.$staff_name.'
				<div class="overlay-edit">
					'.$view_info.'
				</div>
			';
			$Trest = '';
			$data[] = array(
				$links,
				$attendance_date,
				$status,
				$fclock_in,
				$fclock_out,
				$total_time_l,
				$total_time_e,
				$total_work,
				//$Trest,				
			);
		}			
			
		$output = array(
		   //"draw" => $draw,
		   "data" => $data
		);
		echo json_encode($output);
		exit();
	}
	// record list

	
	public function timesheet_attendance_employee_list() {
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$TimesheetModel = new TimesheetModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$get_data = array();
		
		if ($this->request->getGet('user')) {
			$uid = $this->request->getGet('user');
			$date_start = $this->request->getGet('date_start');
			$date_end = $this->request->getGet('date_end');
			$status = $this->request->getGet('status');
			
			$get_data[] = $TimesheetModel->where('employee_id',$uid)->where('status',$status)->where('attendance_date BETWEEN "'. date('Y-m-d', strtotime($date_start)). '" and "'. date('Y-m-d', strtotime($date_end)) .'"')->findAll();
			// print_r($TimesheetModel->getLastQuery()->getQuery()); die();
		} else if($user_info['user_type'] == 'staff'){
			$db = \Config\Database::connect();
			$sql = "SELECT  user_id
			FROM    (SELECT * FROM `ci_erp_users_details`
			ORDER BY user_id) reporting_manager,
			(SELECT @pv := '".$user_info['user_id']."') initialisation
			WHERE   FIND_IN_SET(reporting_manager, @pv)
			AND     LENGTH(@pv := CONCAT(@pv, ',', user_id))";
			$query =  $db->query($sql);
			$get_users = $query->getResult();
			
			$get_data[] = $TimesheetModel->where('company_id',$user_info['company_id'])->where('employee_id',$user_info['user_id'])->orderBy('time_attendance_id', 'ASC')->findAll();
			foreach($get_users as $users) {
				$get_data[] = $TimesheetModel->where('company_id',$user_info['company_id'])->where('employee_id',$users->user_id)->orderBy('time_attendance_id', 'ASC')->findAll();
			}
		} else {
			$get_data[] = $TimesheetModel->where('company_id',$usession['sup_user_id'])->orderBy('time_attendance_id', 'ASC')->findAll();
		}

		
		$data = array();
		foreach($get_data as $get_dataa) {
			if(!empty($get_dataa)) {
			
	  			foreach($get_dataa as $r) {					
		  		
			if(in_array('upattendance3',staff_role_resource()) || $user_info['user_type'] == 'company') {	
			$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. uencode($r['time_attendance_id']) . '"><i class="feather icon-edit"></i></button></span>';
			} else {
				$edit = '';
			}
			if(in_array('upattendance4',staff_role_resource()) || $user_info['user_type'] == 'company') {
				$delete = '<span data-toggle="tooltip" data-placement="top" data-state="danger" title="'.lang('Main.xin_delete').'"><button type="button" class="btn icon-btn btn-sm btn-light-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. uencode($r['time_attendance_id']) . '"><i class="feather icon-trash-2"></i></button></span>';
			} else {
				$delete = '';
			}
		
			
			//get user info
			$iuser = $UsersModel->where('user_id', $r['employee_id'])->first();
			if($iuser){
				$uname = $iuser['first_name'].' '.$iuser['last_name'];
				$profile_photo = $iuser['profile_photo'];
				$email = $iuser['email'];
				$fname = '<div class="d-inline-block align-middle">
					<img src="'.staff_profile_photo($r['employee_id']).'" alt="user image" class="img-radius align-top m-r-15" style="width:40px;">
					<div class="d-inline-block">
						<h6 class="m-b-0">'.$uname.'</h6>
						<p class="m-b-0">'.$email.'</p>
					</div>
				</div>';
				$combhr = $edit.$delete;
			} else {
				$uname = '';
				$email = '';
				$combhr = $delete;
				$fname = '--';
				$profile_photo = '';
			}
			$clock_in_time = strtotime($r['clock_in']);
			$fclckIn = date("h:i a", $clock_in_time);
			
			$clock_out_time = strtotime($r['clock_out']);
			if(!empty($clock_out_time)) {
				$fclckOut = date("h:i a", $clock_out_time);
				} else {
					$fclckOut = "00:00";	
				}
			// $fclckOut = date("h:i a", $clock_out_time);
			$attendance_date = set_date_format($r['attendance_date']);	
			$checkbox = '<input type="checkbox" value="'.$r['time_attendance_id'].'" class="editor-active">';
			$ifname = '
				'.$fname.'
				<div class="overlay-edit">
					'.$combhr.'
				</div>';					 			  				
			$data[] = array(
				$checkbox,
				$ifname,
				$attendance_date,
				$fclckIn,
				$fclckOut,
				$r['total_work'],
				$r['status'],
			);
		}
	}
	}
          $output = array(
               "csrf_hash" => csrf_hash(),
			   "data" => $data
            );
		//  $output['csrf_hash'] = csrf_hash();	
		  $this->output($output);
         // echo json_encode($output);
          exit();

	}
	public function update_attendance_list() {

		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$TimesheetModel = new TimesheetModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$get_data = $TimesheetModel->where('company_id',$user_info['company_id'])->orderBy('time_attendance_id', 'ASC')->findAll();
		} else {
			$get_data = $TimesheetModel->where('company_id',$usession['sup_user_id'])->orderBy('time_attendance_id', 'ASC')->findAll();
		}
		if ($this->request->getGet('user')) {
			if($user_info['user_type'] == 'staff'){
				$uid = $usession['sup_user_id'];
			} else {
				$uid = $this->request->getGet('user');
			}
			$date = $this->request->getGet('date');
			$get_data = $TimesheetModel->where('employee_id',$uid)->where('attendance_date',$date)->findAll();
		}
		$data = array();
		
          foreach($get_data as $r) {						
		  		
			if(in_array('upattendance3',staff_role_resource()) || $user_info['user_type'] == 'company') {	
			$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. uencode($r['time_attendance_id']) . '"><i class="feather icon-edit"></i></button></span>';
			} else {
				$edit = '';
			}
			if(in_array('upattendance4',staff_role_resource()) || $user_info['user_type'] == 'company') {
				$delete = '<span data-toggle="tooltip" data-placement="top" data-state="danger" title="'.lang('Main.xin_delete').'"><button type="button" class="btn icon-btn btn-sm btn-light-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. uencode($r['time_attendance_id']) . '"><i class="feather icon-trash-2"></i></button></span>';
			} else {
				$delete = '';
			}
			
			//get user info
			$iuser = $UsersModel->where('user_id', $r['employee_id'])->first();
			if($iuser){
				$uname = $iuser['first_name'].' '.$iuser['last_name'];
				$profile_photo = $iuser['profile_photo'];
				$email = $iuser['email'];
				$fname = '<div class="d-inline-block align-middle">
					<img src="'.staff_profile_photo($r['employee_id']).'" alt="user image" class="img-radius align-top m-r-15" style="width:40px;">
					<div class="d-inline-block">
						<h6 class="m-b-0">'.$uname.'</h6>
						<p class="m-b-0">'.$email.'</p>
					</div>
				</div>';
				$combhr = $edit.$delete;
			} else {
				$uname = '';
				$email = '';
				$combhr = $delete;
				$fname = '--';
				$profile_photo = '';
			}
			$clock_in_time = strtotime($r['clock_in']);
			$fclckIn = date("h:i a", $clock_in_time);
			
			$clock_out_time = strtotime($r['clock_out']);
			$fclckOut = date("h:i a", $clock_out_time);
			$attendance_date = set_date_format($r['attendance_date']);	
			$ifname = '
				'.$fname.'
				<div class="overlay-edit">
					'.$combhr.'
				</div>';					 			  				
			$data[] = array(
				$ifname,
				$attendance_date,
				$fclckIn,
				$fclckOut,
				$r['total_work'],
			);
		}
          $output = array(
               "csrf_hash" => csrf_hash(),
			   "data" => $data
            );
		//  $output['csrf_hash'] = csrf_hash();	
		  $this->output($output);
         // echo json_encode($output);
          exit();
     }
	// record list
	public function overtime_request_list() {

		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$OvertimerequestModel = new OvertimerequestModel();
		$get_data = array();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$db = \Config\Database::connect();
			$sql = "SELECT  user_id
			FROM    (SELECT * FROM `ci_erp_users_details`
			ORDER BY user_id) reporting_manager,
			(SELECT @pv := '".$user_info['user_id']."') initialisation
			WHERE   FIND_IN_SET(reporting_manager, @pv)
			AND     LENGTH(@pv := CONCAT(@pv, ',', user_id))";
			$query =  $db->query($sql);
			$get_users = $query->getResult();
			$get_data[] = $OvertimerequestModel->where('staff_id',$usession['sup_user_id'])->orderBy('time_request_id', 'ASC')->findAll();
			foreach($get_users as $users) {
				$get_data[] = $OvertimerequestModel->where('staff_id',$users->user_id)->orderBy('time_request_id', 'ASC')->findAll();
			}
		} else {
			$get_data[] = $OvertimerequestModel->where('company_id',$usession['sup_user_id'])->orderBy('time_request_id', 'ASC')->findAll();
		}
		$data = array();
		
		foreach($get_data as $get_dataa) {
			if(!empty($get_dataa)) {
			
	  			foreach($get_dataa as $r) {							
		  			
				/*if(in_array('overtime_req3',staff_role_resource()) || $user_info['user_type'] == 'company') {
					$view = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_view').'"><button type="button" class="btn icon-btn btn-sm btn-light-success waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. uencode($r['time_request_id']) . '" data-opt_type="request_edit"><i class="feather icon-eye"></i></button></span>';
				} else {
					$view = '';
				}*/
				if(in_array('overtime_req3',staff_role_resource()) || $user_info['user_type'] == 'company') {
					$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. uencode($r['time_request_id']) . '" data-opt_type="request_view"><i class="feather icon-edit"></i></button></span>';
				} else {
					$edit = '';
				}
				if(in_array('overtime_req4',staff_role_resource()) || $user_info['user_type'] == 'company') {
					$delete = '<span data-toggle="tooltip" data-placement="top" data-state="danger" title="'.lang('Main.xin_delete').'"><button type="button" class="btn icon-btn btn-sm btn-light-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. uencode($r['time_request_id']) . '"><i class="feather icon-trash-2"></i></button></span>';
				} else {
					$delete = '';
				}
				//if(in_array('overtime_req3',staff_role_resource()) || $user_info['user_type'] == 'company') {
				$view = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_view_details').'"><a href="'.site_url().'erp/view-overtime-info/'.uencode($r['time_request_id']).'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light"><span class="fa fa-arrow-circle-right"></span></button></a></span>';
				
				
				//get user info
				$iuser = $UsersModel->where('user_id', $r['staff_id'])->first();
				if($iuser){
					$uname = $iuser['first_name'].' '.$iuser['last_name'];
					$fname = '<div class="d-inline-block align-middle">
						<img src="'.staff_profile_photo($r['staff_id']).'" alt="user image" class="img-radius align-top m-r-15" style="width:40px;">
						<div class="d-inline-block">
							<h6 class="m-b-0">'.$uname.'</h6>
							<p class="m-b-0">'.$iuser['email'].'</p>
						</div>
					</div>';
					$combhr = $view.$edit.$delete;
				} else {
					$combhr = $view.$delete;	
					$fname = '--';
				}
				$clock_in_time = strtotime($r['clock_in']);
				$fclckIn = date("h:i a", $clock_in_time);
				
				$clock_out_time = strtotime($r['clock_out']);
				$fclckOut = date("h:i a", $clock_out_time);
				$attendance_date = set_date_format($r['request_date']);	
				// status
				if($r['is_approved'] == 0){
					$status = '<span class="badge badge-light-warning">'.lang('Main.xin_pending').'</span>';
				} else if($r['is_approved'] == 1){
					$status = '<span class="badge badge-light-success">'.lang('Main.xin_accepted').'</span>';
				} else {
					$status = '<span class="badge badge-light-danger">'.lang('Main.xin_rejected').'</span>';
				}
				$ifname = '
					'.$fname.'
					<div class="overlay-edit">
						'.$combhr.'
					</div>';					 			  				
				$data[] = array(
					$ifname,
					$attendance_date,
					$fclckIn,
					$fclckOut,
					$r['total_hours'],
					$status
				);
			}
			}
		}
          $output = array(
               "csrf_hash" => csrf_hash(),
			   "data" => $data
            );
		//  $output['csrf_hash'] = csrf_hash();	
		  $this->output($output);
         // echo json_encode($output);
          exit();
     }
	// |||add record|||
	public function add_attendance() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'attendance_start_date' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Success.xin_attendance_date_field_error')
					]
				],
				'attendance_end_date' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Success.xin_attendance_date_field_error')
					]
				]
			];
			
			if(!$this->validate($rules)){
				$ruleErrors = [
					"attendance_start_date" => $validation->getError('attendance_start_date'),
					"attendance_end_date" => $validation->getError('attendance_end_date'),
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$Return['csrf_hash'] = csrf_hash();
						$this->output($Return);
					}
				}
			} else {

				$clock_in = $this->request->getPost('clock_in_m',FILTER_SANITIZE_STRING);
				$clock_out = $this->request->getPost('clock_out_m',FILTER_SANITIZE_STRING);
				/*if(preg_match("/((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))/", $clock_in) == false || preg_match("/((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))/", $clock_out) == false) {
					$Return['error'] = "Invalid Time";
					if($Return['error']!=''){
					$this->output($Return);
					}
				}*/
				// die("dfsf");
				$clock_in = date("H:i", strtotime($clock_in));
				$clock_out = date("H:i", strtotime($clock_out));
				$today_date = date('Y-m-d');
				$attendance_start_date = $this->request->getPost('attendance_start_date',FILTER_SANITIZE_STRING);
				$attendance_end_date = $this->request->getPost('attendance_end_date',FILTER_SANITIZE_STRING);
				$office_shift_id_m = $this->request->getPost('office_shift_id_m',FILTER_SANITIZE_STRING);
				
				$employee_id = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
				
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $employee_id)->first();
					
				if($attendance_start_date !='' && $attendance_end_date !='') {
					
					
				}
		
				
			
				//check
				if(($office_shift_id_m=='' || $office_shift_id_m==0) && $this->request->getPost('clock_in_m',FILTER_SANITIZE_STRING)==''){
					$Return['error'] = lang('Main.xin_select_officeshift_timeinout');
					if($Return['error']!=''){
						$Return['csrf_hash'] = csrf_hash();
						$this->output($Return);
					}
				}
				$clock_in = date("H:i", strtotime($clock_in));
				$clock_out = date("H:i", strtotime($clock_out));
				
				
				$ShiftModel = new ShiftModel();
				$UsersModel = new UsersModel();
				$StaffdetailsModel = new StaffdetailsModel();
				$user_info = $UsersModel->where('user_id', $employee_id)->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
					//$employee_id = $usession['sup_user_id'];
					$employee_id = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
				}  else {
					$company_id = $usession['sup_user_id'];
					$employee_id = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
					//$employee_id = implode(',',$employee_ids);	
				}
				
				
				$start_date = '2021-11-06';
				$end_date = '2021-11-09';
				//$dates = array();
				$dates = date_range($attendance_start_date,$attendance_end_date);
				foreach( $dates as  $idate ) {
					
					$attendance_date =  $idate;
					//$Return['error'] = 'here..'.$attendance_date;
					if($Return['error']!=''){
						$Return['csrf_hash'] = csrf_hash();
						$this->output($Return);
					}
					// print_r($user_info); die();
					$db = \Config\Database::connect();
					$sql = "SELECT time_attendance_id
					FROM `ci_timesheet`
					WHERE employee_id = ".$user_info['user_id']." AND company_id = ".$user_info['company_id']." AND attendance_date BETWEEN CAST('".$attendance_start_date."' AS DATE) AND CAST('".$attendance_end_date."' AS DATE)";
					$query =  $db->query($sql);
					$result = $query->getNumRows();
					if($result > 0) {
						$Return['error'] = lang('You Already Apply attendance on this Date');
								if($Return['error']!=''){
									$Return['csrf_hash'] = csrf_hash();
									$this->output($Return);
								}
					}
					

					$holiday = "SELECT * FROM ci_holidays 
					WHERE  company_id = ".$user_info['company_id']." 
					 AND start_date BETWEEN '".$attendance_start_date."' AND '".$attendance_end_date."' 
					OR '".$attendance_start_date."' BETWEEN start_date AND end_date";
					$query_holiday =  $db->query($holiday);
					$HolidayCount = $query_holiday->getNumRows();
					// print_r($db->getLastQuery()->getQuery()); die();
					if($HolidayCount > 0) {
						$Return['error'] = lang('Main.xin_already_holiday_date').' '.$attendance_date;
						if($Return['error']!=''){
							$Return['csrf_hash'] = csrf_hash();
							$this->output($Return);
						}
					}
					// die("dfsd");
					// leave application
					$leave = "SELECT leave_id
					FROM `ci_leave_applications`
					WHERE employee_id = ".$user_info['user_id']." AND company_id = ".$user_info['company_id']." 
					 AND (from_date BETWEEN '".$attendance_start_date."' AND '".$attendance_end_date."' 
					 OR '".$attendance_start_date."' BETWEEN from_date AND to_date)";
				
					$query_leave =  $db->query($leave);
					$FieldCount = $query_leave->getNumRows();
					// print_r($db->getLastQuery()->getQuery()); die();
					if($FieldCount > 0) {
						$Return['error'] = lang('Main.xin_cant_apply_leave_offdays').' '.$attendance_date;
						if($Return['error']!=''){
							$Return['csrf_hash'] = csrf_hash();
							$this->output($Return);
						}
					}
					// get day
					$get_day = strtotime($attendance_date);
					$day = date('l', $get_day);
					foreach($employee_id as $istaff){	
					
						$TimesheetModel = new TimesheetModel();
						
						
						if($office_shift_id_m!='' && $office_shift_id_m!=0){
							
							// d_ attendance
							$dcheck = $TimesheetModel->where('company_id',$company_id)->where('attendance_date',$attendance_date)->where('employee_id',$istaff)->countAllResults();
							if($dcheck > 0){
								$Return['error'] = lang('Main.xin_change_attendance_date_error').' '.$attendance_date;
								if($Return['error']!=''){
									$this->output($Return);
								}
							}
							$employee_detail = $StaffdetailsModel->where('user_id', $istaff)->first();
							$office_shift = $ShiftModel->where('office_shift_id', $employee_detail['office_shift_id'])->first();
							
							if($day == 'Monday') {
								if($office_shift['monday_in_time']==''){
									$in_time = '00:00';
									$out_time = '00:00';
									$break_start = '00:00';
									$break_out = '00:00';
									$Return['error'] = lang('No shift on this day/date').': '.$day.' '.$attendance_date;
									if($Return['error']!=''){
										$this->output($Return);
									}
								} else {
									$in_time = $office_shift['monday_in_time'];
									$out_time = $office_shift['monday_out_time'];
									$break_start = $office_shift['monday_lunch_break'];
									$break_out = $office_shift['monday_lunch_break_out'];
									
								}
							} else if($day == 'Tuesday') {
								if($office_shift['tuesday_in_time']==''){
									$in_time = '00:00';
									$out_time = '00:00';
									$break_start = '00:00';
									$break_out = '00:00';
									$Return['error'] = lang('No shift on this day/date').': '.$day.' '.$attendance_date;
									if($Return['error']!=''){
										$this->output($Return);
									}
								} else {
									$in_time = $office_shift['tuesday_in_time'];
									$out_time = $office_shift['tuesday_out_time'];
									$break_start = $office_shift['tuesday_lunch_break'];
									$break_out = $office_shift['tuesday_lunch_break_out'];
								}
							} else if($day == 'Wednesday') {
								if($office_shift['wednesday_in_time']==''){
									$in_time = '00:00';
									$out_time = '00:00';
									$break_start = '00:00';
									$break_out = '00:00';
									$Return['error'] = lang('No shift on this day/date').': '.$day.' '.$attendance_date;
									if($Return['error']!=''){
										$this->output($Return);
									}
								} else {
									$in_time = $office_shift['wednesday_in_time'];
									$out_time = $office_shift['wednesday_out_time'];
									$break_start = $office_shift['wednesday_lunch_break'];
									$break_out = $office_shift['wednesday_lunch_break_out'];
								}
							} else if($day == 'Thursday') {
								if($office_shift['thursday_in_time']==''){
									$in_time = '00:00';
									$out_time = '00:00';
									$break_start = '00:00';
									$break_out = '00:00';
									$Return['error'] = lang('No shift on this day/date').': '.$day.' '.$attendance_date;
									if($Return['error']!=''){
										$this->output($Return);
									}
								} else {
									$in_time = $office_shift['thursday_in_time'];
									$out_time = $office_shift['thursday_out_time'];
									$break_start = $office_shift['thursday_lunch_break'];
									$break_out = $office_shift['thursday_lunch_break_out'];
								}
							} else if($day == 'Friday') {
								if($office_shift['friday_in_time']==''){
									$in_time = '00:00';
									$out_time = '00:00';
									$break_start = '00:00';
									$break_out = '00:00';
									$Return['error'] = lang('No shift on this day/date').': '.$day.' '.$attendance_date;
									if($Return['error']!=''){
										$this->output($Return);
									}
								} else {
									$in_time = $office_shift['friday_in_time'];
									$out_time = $office_shift['friday_out_time'];
									$break_start = $office_shift['friday_lunch_break'];
									$break_out = $office_shift['friday_lunch_break_out'];
								}
							} else if($day == 'Saturday') {
								if($office_shift['saturday_in_time']==''){
									$in_time = '00:00';
									$out_time = '00:00';
									$break_start = '00:00';
									$break_out = '00:00';
									$Return['error'] = lang('No shift on this day/date').': '.$day.' '.$attendance_date;
									if($Return['error']!=''){
										$this->output($Return);
									}
								} else {
									$in_time = $office_shift['saturday_in_time'];
									$out_time = $office_shift['saturday_out_time'];
									$break_start = $office_shift['saturday_lunch_break'];
									$break_out = $office_shift['saturday_lunch_break_out'];
								}
							} else if($day == 'Sunday') {
								if($office_shift['sunday_in_time']==''){
									$in_time = '00:00';
									$out_time = '00:00';
									$break_start = '00:00';
									$break_out = '00:00';
									$Return['error'] = lang('No shift on this day/date').': '.$day.' '.$attendance_date;
									if($Return['error']!=''){
										$this->output($Return);
									}
								} else {
									$in_time = $office_shift['sunday_in_time'];
									$out_time = $office_shift['sunday_out_time'];
									$break_start = $office_shift['sunday_lunch_break'];
									$break_out = $office_shift['sunday_lunch_break_out'];
								}
							}
							
							$clock_in2 = $attendance_date.' '.$in_time.':00';
							$clock_out2 = $attendance_date.' '.$out_time.':00';
							$break_start2 = $attendance_date.' '.$break_start.':00';
							$break_out2 = $attendance_date.' '.$break_out.':00';
							
							$total_work_cin = date_create($clock_in2);
							$total_work_cout = date_create($clock_out2);
							$break_start2_cin = date_create($break_start2);
							$break_out2_cout = date_create($break_out2);
							$interval_break = date_diff($break_start2_cin, $break_out2_cout);
							
							$interval_cin = date_diff($total_work_cin, $total_work_cout);
							
							$hours_in   = $interval_cin->format('%h'); 
							$hours_break   = $interval_break->format('%h');
							
							$minutes_in = $interval_cin->format('%i');
							$minutes_break =  $interval_break->format('%i');
							$in_time_minuts = strtotime($hours_in .":".$minutes_in);
							$break_time_minuts = strtotime($hours_break .":".$minutes_break);
							$start_t = ($in_time_minuts-$break_time_minuts)/3600;

							// print_r();   die();			
							$total_work = floor($start_t) . ':' . ( ($start_t-floor($start_t)) * 60 );
						} else {
							$clock_in2 = $attendance_date.' '.$clock_in.':00';
							$clock_out2 = $attendance_date.' '.$clock_out.':00';
							///
							$ex_strclockin = strtotime($clock_in2);
							$ex_strclockout = strtotime($clock_out2);
							// d_ attendance
							/*$dcheck = $TimesheetModel->where('company_id',$company_id)->where('attendance_date',$attendance_date)->where('employee_id',$istaff)->countAllResults();
							if($dcheck > 0){
								$time_first = $TimesheetModel->where('company_id',$company_id)->where('attendance_date',$attendance_date)->where('employee_id',$istaff)->first();
								$ex_time = $time_first['clock_out'];
								$ex_strtime = strtotime($ex_time);
								$iex_strtime = date('h:i a',$ex_strtime);
								if($ex_strclockin < $ex_strtime || $ex_strclockout < $ex_strtime) {
									$Return['error'] = lang('Main.xin_change_attendance_date_time_error').' '.$iex_strtime;
									if($Return['error']!=''){
										$this->output($Return);
									}
								}
							}*/
							
							
							$total_work_cin = date_create($clock_in2);
							$total_work_cout = date_create($clock_out2);
							$interval_cin = date_diff($total_work_cin, $total_work_cout);
							
							$hours_in   = $interval_cin->format('%h');
							$minutes_in = $interval_cin->format('%i');			
							$total_work = $hours_in .":".$minutes_in;
						}
						$data = [
							'company_id' => $company_id,
							'employee_id'  => $istaff,
							'attendance_date'  => $attendance_date,
							'clock_in'  => $clock_in2,
							'clock_in_ip_address' => 1,
							'clock_out'  => $clock_out2,
							'clock_out_ip_address'  => 1,
							'clock_in_out'  => 0,
							'clock_in_latitude' => 1,
							'clock_in_longitude'  => 1,
							'clock_out_latitude'  => 1,
							'clock_out_longitude'  => 1,
							'time_late'  => $clock_in2,
							'early_leaving'  => $clock_out2,
							'overtime' => $clock_out2,
							'total_work'  => $total_work,
							'total_rest'  => 0,
							'shift_id'  => $office_shift_id_m,
							'work_from_home'  => 0,
							'lunch_breakin'  => 0,
							'lunch_breakout'  => 0,
							'attendance_status'  => 'Present',
						];
						
						$result = $TimesheetModel->insert($data);	
					}
				}
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_attendance_added_msg');
				} else {
					$Return['error'] = lang('Main.xin_error_msg').' Error';
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
	
	// |||add record|||
	public function add_overtime() 
	{
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'attendance_date_m' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Success.xin_attendance_date_field_error')
					]
				],
				'clock_in_m' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Success.xin_clock_in_field_error')
					]
				],
				'clock_out_m' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Success.xin_clock_out_field_error')
					]
				],
				'overtime_reason' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'compensation_type' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			
			if(!$this->validate($rules)){
				$ruleErrors = [
					"attendance_date_m" => $validation->getError('attendance_date_m'),
					"clock_in_m" => $validation->getError('clock_in_m'),
					"clock_out_m" => $validation->getError('clock_out_m'),
					"overtime_reason" => $validation->getError('overtime_reason'),
					"compensation_type" => $validation->getError('compensation_type'),
					// "description" => $validation->getError('description')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$attendance_date = $this->request->getPost('attendance_date_m',FILTER_SANITIZE_STRING);
				$clock_in = $this->request->getPost('clock_in_m',FILTER_SANITIZE_STRING);
				$clock_out = $this->request->getPost('clock_out_m',FILTER_SANITIZE_STRING);

				if(preg_match("/((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))/", $clock_in) == false || preg_match("/((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))/", $clock_out) == false) {
					$Return['error'] = "Invalid Time";
					if($Return['error']!=''){
					$this->output($Return);
					}
				}

				$clock_in = date("H:i", strtotime($clock_in));
                $clock_out = date("H:i", strtotime($clock_out));
				$description = $this->request->getPost('description',FILTER_SANITIZE_STRING);
				//extra
				$overtime_reason = $this->request->getPost('overtime_reason',FILTER_SANITIZE_STRING);
				$additional_work_hours = $this->request->getPost('additional_work_hours',FILTER_SANITIZE_STRING);
				$compensation_type = $this->request->getPost('compensation_type',FILTER_SANITIZE_STRING);
				$employee_id = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);

				if($overtime_reason == 5 && $additional_work_hours === '') {
					$Return['error'] = lang('Main.xin_select_option_additional_work_hours');
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
				$timeSheet_date_in = date_create($attendance_date .' '. $clock_in.':00');
				$timeSheet_date_out = date_create($attendance_date .' '. $clock_out.':00');
				$timeSheet_date_in = date_format($timeSheet_date_in,'H:i');
				$timeSheet_date_out = date_format($timeSheet_date_out,'H:i');
				$db = \Config\Database::connect();
				$UsersModel = new UsersModel();
				$ShiftModel = new ShiftModel();
				$StaffdetailsModel = new StaffdetailsModel();
				$TimesheetModel = new TimesheetModel();
				$user_info = $UsersModel->where('user_id', $employee_id)->first();
				$employee_detail = $StaffdetailsModel->where('user_id', $employee_id)->first();
				$office_shift = $ShiftModel->where('office_shift_id', $employee_detail['office_shift_id'])->first();
				// validation check
				$check_date = date_create($attendance_date);
				$today_date = strtolower(date_format($check_date,'Y-m-d'));
				$ibuilder = $db->table('ci_holidays');
				//echo $today_date; exit;
				$ibuilder->where('"'. $today_date. '" BETWEEN start_date AND end_date');
				$ibuilder->where('company_id', $user_info['company_id']);
				$ibuilder->where('is_publish', 1);
				$queryh = $ibuilder->get();
				$HolidayCount = $queryh->getNumRows();
				if($HolidayCount == 0) {
				
				// print_r($check_date); die();
				$day = strtolower(date_format($check_date,'l'));
				$shift_in_time = $day .'_in_time';
				$shift_out_time = $day .'_out_time';
				$shift_lunch_time_start = $day .'_lunch_break';
				$shift_lunch_time_end = $day .'_lunch_break_out';
				
				if($office_shift) {
						
							$shift_in_time =	$office_shift[$shift_in_time];
							$shift_out_time =	$office_shift[$shift_out_time];
							$shift_lunch_time_start =	$office_shift[$shift_lunch_time_start];
							$shift_lunch_time_end =	$office_shift[$shift_lunch_time_end];
						
							if($shift_in_time != "" && $shift_out_time !="" && $overtime_reason != 2) {

								$shift_in_time = date_create($attendance_date.' '.$shift_in_time. ':00');
								$shift_out_time = date_create($attendance_date.' '.$shift_out_time. ':00');
								$shift_in_time = date_format($shift_in_time,'H:i');
								$shift_out_time = date_format($shift_out_time,'H:i');
						
								if((  $timeSheet_date_in >= $shift_in_time  && $timeSheet_date_in <= $shift_out_time ) || (  $timeSheet_date_out >= $shift_in_time  &&  $timeSheet_date_out <= $shift_out_time ) ) {
							
									$Return['error'] = lang('Cannot apply overtime during shift hours');
									if($Return['error']!=''){
										$Return['csrf_hash'] = csrf_hash();
										$this->output($Return);
									}

								}
							} elseif($shift_lunch_time_start != "" && $shift_lunch_time_end !="" && $overtime_reason == 2 ) {
								$shift_lunch_time_start = date_create($attendance_date.' '.$shift_lunch_time_start. ':00');
								$shift_lunch_time_end = date_create($attendance_date.' '.$shift_lunch_time_end. ':00');
								$shift_lunch_time_start = date_format($shift_lunch_time_start,'H:i');
								$shift_lunch_time_end = date_format($shift_lunch_time_end,'H:i');
								if( ($timeSheet_date_in >= $shift_lunch_time_start    &&   $timeSheet_date_out  <= $shift_lunch_time_end  ) && (  $timeSheet_date_out >= $shift_lunch_time_start  &&  $timeSheet_date_out <= $shift_lunch_time_end  )) {
									
								}else {
									$Return['error'] = lang('You Apply work through lunch in shift timing');
									if($Return['error']!=''){
										$Return['csrf_hash'] = csrf_hash();
										$this->output($Return);
									}
								}
							}
				}
				}

				// end validation check
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
					$employee_id = $user_info['user_id'];
				} else {
					$company_id = $usession['sup_user_id'];
					$employee_id = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
				}
				$clock_in2 = $attendance_date.' '.$clock_in.':00';
				$clock_out2 = $attendance_date.' '.$clock_out.':00';
				
				$total_work_cin = date_create($clock_in2);
				$total_work_cout = date_create($clock_out2);
				$interval_cin = date_diff($total_work_cin, $total_work_cout);
				$hours_in   = $interval_cin->format('%h');
				$minutes_in = $interval_cin->format('%i');
				$original = $hours_in .":".$minutes_in;			
				$total_work = $hours_in .":".$minutes_in;
				if($overtime_reason == 5 && $additional_work_hours != '') {
					if($additional_work_hours == 2){
						date_default_timezone_set ("UTC");
						$secs = strtotime($total_work ) - strtotime("00:00");
						$add_work=1;
						$timeahalf = date("H:i",$secs * $add_work);
						$double_overtime = 0;
						$straight = 0;
					} else if($additional_work_hours==3){
						date_default_timezone_set ("UTC");
						$secs = strtotime($total_work ) - strtotime("00:00");
						$add_work=1;
						$timeahalf = 0;
						$double_overtime = date("H:i",$secs * $add_work);
						$straight = 0;
					} else {
						$timeahalf = 0;
						$double_overtime = 0;
						$straight = $total_work;
					}
				} else {
					$timeahalf = 0;
					$double_overtime = 0;
					$straight = 0;
					$total_work = $total_work;
				}
				if($compensation_type == 1){
					$compensation_banked = $total_work;
				} else {
					$compensation_banked = '';
				}
				if($additional_work_hours == "") {
					$additional_work_hours = 0;
				}
				$data = [
					'company_id' => $company_id,
					'staff_id'  => $employee_id,
					'request_date'  => $attendance_date,
					'clock_in'  => $clock_in2,
					'request_month' => date('Y-m'),
					'clock_out'  => $clock_out2,
					'overtime_reason'  => $overtime_reason,
					'additional_work_hours'  => $additional_work_hours,
					'compensation_type'  => $compensation_type,
					'straight'  => $straight,
					'time_a_half'  => $timeahalf,
					'double_overtime'  => $double_overtime,
					'total_hours'  => $total_work,
					'request_reason'  => $description,
					'compensation_banked'  => $compensation_banked,
					'is_approved'  => 0,
					'created_at'  => date('d-m-Y h:i:s')
				];
				// print_r($data); die();
				$OvertimerequestModel = new OvertimerequestModel();
				$result = $OvertimerequestModel->insert($data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_overtime_added_msg');
				} else {
					$Return['error'] = lang('Main.xin_error_msg').' Error';
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
	// |||edit record|||
	public function update_attendance_record() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'office_shift_id_m' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_shift_error_field')
					]
				],
				'clock_in_m' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Success.xin_clock_in_field_error')
					]
				],
				'clock_out_m' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Success.xin_clock_out_field_error')
					]
				]
			];
			
			if(!$this->validate($rules)){
				$ruleErrors = [
					"office_shift_id_m" => $validation->getError('office_shift_id_m'),
					"clock_in_m" => $validation->getError('clock_in_m'),
					"clock_out_m" => $validation->getError('clock_out_m')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				
				$office_shift_id_m = $this->request->getPost('office_shift_id_m',FILTER_SANITIZE_STRING);
				$clock_in = $this->request->getPost('clock_in_m',FILTER_SANITIZE_STRING);
				$clock_out = $this->request->getPost('clock_out_m',FILTER_SANITIZE_STRING);
				if(preg_match("/((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))/", $clock_in) == false || preg_match("/((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))/", $clock_out) == false) {
					$Return['error'] = "Invalid Time";
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
				// die("dfsf");
				$clock_in = date("H:i", strtotime($clock_in));
				$clock_out = date("H:i", strtotime($clock_out));
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				$status = $this->request->getPost('status',FILTER_SANITIZE_STRING);
				$UsersModel = new UsersModel();
				$ShiftModel = new ShiftModel();
				$StaffdetailsModel = new StaffdetailsModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
				//	$employee_id = $usession['sup_user_id'];
				} else {
					$company_id = $usession['sup_user_id'];
					//$employee_id = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
				}
				$TimesheetModel = new TimesheetModel();
				$result = $TimesheetModel->where('time_attendance_id', $id)->first();
				$employee_detail = $StaffdetailsModel->where('user_id', $result['employee_id'])->first();
				$office_shift = $ShiftModel->where('office_shift_id', $employee_detail['office_shift_id'])->first();
				
				$clock_in2 = $result['attendance_date'].' '.$clock_in.':00';
				$clock_out2 = $result['attendance_date'].' '.$clock_out.':00';
				// 
				
				$total_work_cin = date_create($clock_in2);
				$total_work_cout = date_create($clock_out2);
				$interval_cin = date_diff($total_work_cin, $total_work_cout);
				$hours_in   = $interval_cin->format('%h');
				$minutes_in = $interval_cin->format('%i');
				$secounds_in = $interval_cin->format('%s');
				$total_work = $hours_in .":".$minutes_in;
				$day = strtolower(date_format($total_work_cin,'l')); 
				// check break 
						$day_lunch_break = $day .'_lunch_break';
						$day_lunch_break_out = $day .'_lunch_break_out';
						// 
						if($office_shift) {
							$day_lunch_break =	$office_shift[$day_lunch_break];
							$day_lunch_break_out =	$office_shift[$day_lunch_break_out];
							if($day_lunch_break != "" && $day_lunch_break_out !="") {
								$lunch_start = date_create($result['attendance_date'].' '.$day_lunch_break. ':00');
							
								$lunch_end = date_create($result['attendance_date'].' '.$day_lunch_break_out. ':00');
								
								// $lunch_diffrence = date_diff($lunch_start, $lunch_end);
								if($total_work_cin <  $lunch_start && $total_work_cout > $lunch_end) {
									$lunch_diffrence = date_diff($lunch_start, $lunch_end);
									$hours_break   = $lunch_diffrence->format('%h');
									$minutes_break = $lunch_diffrence->format('%i');
									$secounds_break = $lunch_diffrence->format('%s');

									$in_time_minuts = $hours_in .":".$minutes_in .":".$secounds_in;
									$break_time_minuts = $hours_break .":".$minutes_break .":".$secounds_break;
									$break_time_minuts_year = date_create(date($result['attendance_date'].' '.$break_time_minuts));
									$in_time_minuts_year = date_create(date($result['attendance_date'].' '.$in_time_minuts));
									$difreence_break_in = date_diff($in_time_minuts_year, $break_time_minuts_year);
									// print_r($difreence_break_in->format('%h:%i:%s'));echo "difreence_break_in<br>";
												
									$total_work = $difreence_break_in->format('%h:%i');
								} elseif($total_work_cin >= $lunch_start && $total_work_cout <= $lunch_end) {
									$Return['error'] = 'There is break, Please chose valid time ';
									if($Return['error']!=''){

										$Return['csrf_hash'] = csrf_hash();
										$this->output($Return);
									}
								}
								
								
							}
						}
							
				
					
				$data = [
					'company_id' => $company_id,
					//'employee_id'  => $employee_id,
					'status'  => $status,
					'clock_in'  => $clock_in2,
					'clock_out'  => $clock_out2,
					'time_late'  => $clock_in2,
					'early_leaving'  => $clock_out2,
					'overtime' => $clock_out2,
					'total_work'  => $total_work,
					'shift_id'  => $office_shift_id_m,
					'attendance_status'  => 'Present',
				];
				// print_r($data); die();
				
				$result = $TimesheetModel->update($id, $data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_attendance_updated_msg');
				} else {
					$Return['error'] = lang('Main.xin_error_msg').' Error';
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
	// |||edit record|||
	public function update_overtime_record() {
			
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
				$OvertimerequestModel = new OvertimerequestModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
				} else {
					$company_id = $usession['sup_user_id'];
				}
				$StaffapprovalsModel = new StaffapprovalsModel();

				// get approvals
				$skip_specific = skip_specific_approval_info('overtime_request_settings');
				$iskip_specific = $skip_specific['skip_specific_approval'];
				if($iskip_specific == 1){
					$level_option = staff_reporting_manager_info($usession['sup_user_id'],'overtime_request_settings');
					$total_levels = $level_option['total_levels'];
				} else {
					$result = $OvertimerequestModel->where('time_request_id', $id)->first();
					$old_level = staff_reporting_manager_old_level($result['staff_id'],'overtime_request_settings');
					$total_levels = $old_level['total_levels'];
				}
				// check approvals
				$approval_cnt = $StaffapprovalsModel->where('company_id', $company_id)->where('module_key_id', $id)->where('module_option', 'overtime_request_settings')->countAllResults();
				$iapproval_cnt = $approval_cnt+1;
				/*$Return['error'] = $iapproval_cnt.'.....'.$total_levels;
				if($Return['error']!=''){
					$this->output($Return);
				}*/
				if($user_info['user_type'] == 'company'){
					$data = [
					'is_approved'  => $status
					];
					$OvertimerequestModel = new OvertimerequestModel();
					$result = $OvertimerequestModel->update($id, $data);
				} else {
					if($iapproval_cnt == $total_levels){	
						$data2 = [
							'company_id'  => $company_id,
							'staff_id'  => $usession['sup_user_id'],
							'module_key_id'  => $id,
							'module_option'  => 'overtime_request_settings',
							'status'  => $status,
							'approval_level'  => 1,
							'updated_at' => date('d-m-Y h:i:s')
						];
						$StaffapprovalsModel->insert($data2);
						$data = [
							'is_approved'  => $status
						];
						$OvertimerequestModel = new OvertimerequestModel();
						$result = $OvertimerequestModel->update($id, $data);
					} else {
						if($iapproval_cnt < $total_levels){
							if($status == 2) {
								$data = [
									'is_approved'  => $status
								];
								$OvertimerequestModel = new OvertimerequestModel();
								$OvertimerequestModel->update($id, $data);
								$data2 = [
									'company_id'  => $company_id,
									'staff_id'  => $usession['sup_user_id'],
									'module_key_id'  => $id,
									'module_option'  => 'overtime_request_settings',
									'status'  => $status,
									'approval_level'  => 2,
									'updated_at' => date('d-m-Y h:i:s')
								];
								$result = $StaffapprovalsModel->insert($data2);
							} else {
								$data2 = [
									'company_id'  => $company_id,
									'staff_id'  => $usession['sup_user_id'],
									'module_key_id'  => $id,
									'module_option'  => 'overtime_request_settings',
									'status'  => $status,
									'approval_level'  => 0,
									'updated_at' => date('d-m-Y h:i:s')
								];
								$result = $StaffapprovalsModel->insert($data2);
							}							
						} else {
							$Return['result'] = 'Approval level finished.';
							$this->output($Return);
						}
					}
				}	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_overtime_status_updated_msg');
				} else {
					$Return['error'] = lang('Main.xin_error_msg').'';
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
	// |||add record|||
	public function confirm_overtime_record() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'attendance_date_m' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Success.xin_attendance_date_field_error')
					]
				],
				'clock_in_m' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Success.xin_clock_in_field_error')
					]
				],
				'clock_out_m' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Success.xin_clock_out_field_error')
					]
				],
				'overtime_reason' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'compensation_type' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			
			if(!$this->validate($rules)){
				$ruleErrors = [
					"attendance_date_m" => $validation->getError('attendance_date_m'),
					"clock_in_m" => $validation->getError('clock_in_m'),
					"clock_out_m" => $validation->getError('clock_out_m'),
					"overtime_reason" => $validation->getError('overtime_reason'),
					"compensation_type" => $validation->getError('compensation_type'),
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$attendance_date = $this->request->getPost('attendance_date_m',FILTER_SANITIZE_STRING);

				$clock_in = $this->request->getPost('clock_in_m',FILTER_SANITIZE_STRING);
				$clock_out = $this->request->getPost('clock_out_m',FILTER_SANITIZE_STRING);

				if(preg_match("/((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))/", $clock_in) == false || preg_match("/((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))/", $clock_out) == false) {
				  $Return['error'] = "Invalid Time";
					if($Return['error']!=''){
					 $this->output($Return);
					}
				}
				// die("dfsf");
				$clock_in = date("H:i", strtotime($clock_in));
				$clock_out = date("H:i", strtotime($clock_out));

				$description = $this->request->getPost('description',FILTER_SANITIZE_STRING);
				//extra
				$overtime_reason = $this->request->getPost('overtime_reason',FILTER_SANITIZE_STRING);
				$additional_work_hours = $this->request->getPost('additional_work_hours',FILTER_SANITIZE_STRING);
				$compensation_type = $this->request->getPost('compensation_type',FILTER_SANITIZE_STRING);
				$status = $this->request->getPost('status',FILTER_SANITIZE_STRING);
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				
				if($overtime_reason == 5 && $additional_work_hours === '') {
					$Return['error'] = lang('Main.xin_select_option_additional_work_hours');
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
					//$employee_id = $usession['sup_user_id'];
				} else {
					$company_id = $usession['sup_user_id'];
					//$employee_id = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
				}
				$clock_in2 = $attendance_date.' '.$clock_in.':00';
				$clock_out2 = $attendance_date.' '.$clock_out.':00';
				
				$total_work_cin = date_create($clock_in2);
				$total_work_cout = date_create($clock_out2);
				$interval_cin = date_diff($total_work_cin, $total_work_cout);
				$hours_in   = $interval_cin->format('%h');
				$minutes_in = $interval_cin->format('%i');
				$original = $hours_in .":".$minutes_in;			
				$total_work = $hours_in .":".$minutes_in;
				if($overtime_reason == 5 && $additional_work_hours != '') {
					if($additional_work_hours == 2){
						date_default_timezone_set ("UTC");
						$secs = strtotime($total_work ) - strtotime("00:00");
						$add_work=1;
						$timeahalf = date("H:i",$secs * $add_work);
						$double_overtime = 0;
						$straight = 0;
					} else if($additional_work_hours==3){
						date_default_timezone_set ("UTC");
						$secs = strtotime($total_work ) - strtotime("00:00");
						$add_work=1;
						$timeahalf = 0;
						$double_overtime = date("H:i",$secs * $add_work);
						$straight = 0;
					} else {
						$timeahalf = 0;
						$double_overtime = 0;
						$straight = $total_work;
					}
				} else {
					$timeahalf = 0;
					$double_overtime = 0;
					$straight = 0;
					$total_work = $total_work;
				}
				if($compensation_type == 1){
					$compensation_banked = $total_work;
				} else {
					$compensation_banked = '';
				}
				$data = [
					'request_date'  => $attendance_date,
					'clock_in'  => $clock_in2,
					'request_month' => date('Y-m'),
					'clock_out'  => $clock_out2,
					'overtime_reason'  => $overtime_reason,
					'additional_work_hours'  => $additional_work_hours,
					'compensation_type'  => $compensation_type,
					'straight'  => $straight,
					'time_a_half'  => $timeahalf,
					'double_overtime'  => $double_overtime,
					'total_hours'  => $total_work,
					'compensation_banked'  => $compensation_banked,
					'request_reason'  => $description,
					'is_approved'  => $status,
				];
				$OvertimerequestModel = new OvertimerequestModel();
				$result = $OvertimerequestModel->update($id, $data);
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_attendance_updated_msg');
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
	// read record
	public function update_attendance_add()
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
			return view('erp/timesheet/dialog_attendance', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
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
			return view('erp/timesheet/dialog_employee_attendance', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// read record
	public function read_overtime_request()
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
			return view('erp/timesheet/dialog_overtime_request', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// delete record
	public function delete_overtime() {
		
		if($this->request->getPost('type')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$id = udecode($this->request->getPost('_token',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$OvertimerequestModel = new OvertimerequestModel();
			$result = $OvertimerequestModel->where('time_request_id', $id)->delete($id);
			if ($result == TRUE) {
				$Return['result'] = lang('Success.ci_overtime_deleted_msg');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
	public function staff_working_status_chart() {
		
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
				
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();		
		$TimesheetModel = new TimesheetModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$current_date = date('Y-m-d');
		if($user_info['user_type'] == 'staff'){
			$total_staff = $UsersModel->where('company_id', $user_info['company_id'])->where('user_type','staff')->countAllResults();
			$working = $TimesheetModel->where('company_id',$user_info['company_id'])->where('attendance_date', $current_date)->countAllResults();
		} else {
			$total_staff = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->countAllResults();
			$working = $TimesheetModel->where('company_id',$usession['sup_user_id'])->where('attendance_date', $current_date)->countAllResults();
		}
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('absent'=>'', 'working'=>'','absent_label'=>'', 'working_label'=>'');
		
		// get actual data
		//$employee_w = $working / $total_staff * 100;
		// absent
		$abs = $total_staff - $working;
		//$employee_ab = $abs / $total * 100;
		$Return['absent'] = $abs;
		$Return['absent_label'] = lang('xin_absent');
		$Return['total'] = $total_staff;
		$Return['total_label'] = lang('Employees');
		// working
		$Return['working_label'] = lang('xin_emp_working');
		$Return['working'] = $working;
		$this->output($Return);
		exit;
	}
	// delete record
	public function delete_attendance() {
		
		if($this->request->getPost('type')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$id = udecode($this->request->getPost('_token',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$TimesheetModel = new TimesheetModel();
			$result = $TimesheetModel->where('time_attendance_id', $id)->delete($id);
			if ($result == TRUE) {
				$Return['result'] = lang('Success.ci_attendance_deleted_msg');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}

	public function approved_attendance() {
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$TimesheetModel = new TimesheetModel();
		$status = $request->getGet('status');
		$attendance_id = $request->getGet('id');
		$explode = explode(',', $attendance_id);
		// print_r($explode); die();
		foreach($explode as $employee_id) {
			$data = [
				'status' => $status,
			];
			$result = $TimesheetModel->update($employee_id, $data);
		}
		if ($result == TRUE) {
			$Return['result'] = lang('Main.xin_Staus_changed_successfully');
		} else {
			$Return['error'] = lang('Main.xin_error_msg');
		}
		// $Return['csrf_hash'] = $this->security->get_csrf_hash();
			$Return['csrf_hash'] = csrf_hash();
			$this->output($Return);
			exit;
	}

	// set clock in - clock out > attendance
	public function set_clocking() {
		
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	

		if ($this->request->getPost('type') === 'set_clocking') {
			
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			$UsersModel = new UsersModel();
			$ShiftModel = new ShiftModel();
			$StaffdetailsModel = new StaffdetailsModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			$staff_details = $StaffdetailsModel->where('user_id', $usession['sup_user_id'])->first();
			$company_id = $user_info['company_id'];
			$employee_id = $usession['sup_user_id'];
			$office_shift_id = $staff_details['office_shift_id'];
			//$office_shifts = $ShiftModel->where('company_id', $company_id)->where('office_shift_id', $office_shift_id)->first();
			
			
			$clock_state = $this->request->getPost('clock_state',FILTER_SANITIZE_STRING);
			$work_from_home = $this->request->getPost('work_from_home',FILTER_SANITIZE_STRING);
			$latitude = $this->request->getPost('latitude',FILTER_SANITIZE_STRING);
			$longitude = $this->request->getPost('longitude',FILTER_SANITIZE_STRING);
			$time_id = $this->request->getPost('time_id',FILTER_SANITIZE_STRING);
			$ip_address = $request->getIPAddress();
			if($work_from_home!=1){
				$work_from_home = 0;
			} else {
				$work_from_home = $work_from_home;
			}
			//time|today
			$nowtime = date("Y-m-d H:i:s");
			$today_date = date('Y-m-d');
			// set rules
			
			if($clock_state=='clock_in') {
				// check holiday
				$db      = \Config\Database::connect();
				$ibuilder = $db->table('ci_holidays');
				$ibuilder->where('"'. $today_date. '" BETWEEN start_date AND end_date');
				$ibuilder->where('company_id', $company_id);
				$ibuilder->where('is_publish', 1);
				$queryh = $ibuilder->get();
				$HolidayCount = $queryh->getNumRows();
				if($HolidayCount > 0) {
					$Return['error'] = lang('Main.xin_already_holiday_date').' '.$today_date;
					if($Return['error']!=''){
						$Return['csrf_hash'] = csrf_hash();
						$this->output($Return);
					}
				}
				
				// leave application
				$builder = $db->table('ci_leave_applications');
				$builder->where('"'. $today_date. '" BETWEEN from_date AND to_date');
				$builder->where('employee_id', $employee_id);
				$builder->where('status!=', 3);
				$query = $builder->get();
				$FieldCount = $query->getNumRows();
				if($FieldCount > 0) {
					$Return['error'] = lang('Main.xin_cant_apply_leave_offdays').' '.$today_date;
					if($Return['error']!=''){
						$Return['csrf_hash'] = csrf_hash();
						$this->output($Return);
					}
				}
				
				$check_user_attendance = check_user_attendance();
				
				if($check_user_attendance < 1) {
					$total_rest = '';
				} else {
					
					// check already leave 
					
					// $Return['error'] = lang('Main.xin_change_attendance_date_error').' '.$today_date;
					// if($Return['error']!=''){
					// 	$this->output($Return);
					// }
				
					$cin = date_create($nowtime);
					// $now = new DateTime();			
					$check_user_attendance_value = check_user_attendance_value();
					$endtime = date_create($check_user_attendance_value[0]->clock_out); 
					$begintime = date_create($check_user_attendance_value[0]->clock_in);
					// print_r($now); die();
					if ($cin > $begintime && $cin < $endtime)
					{
						$Return['error'] = lang('Main.xin_change_attendance_date_error').' '.$today_date;
						if($Return['error']!=''){
							$this->output($Return);
						}
					} 
						
					// die();
					$cout = date_create($check_user_attendance_value[0]->clock_out);
					
					
					$interval_cin = date_diff($cin, $cout);
					$hours_in   = $interval_cin->format('%h');
					$minutes_in = $interval_cin->format('%i');			
					$total_rest = $hours_in .":".$minutes_in;
				}
				$data = [
					'company_id' => $company_id,
					'employee_id'  => $employee_id,
					'attendance_date'  => $today_date,
					'clock_in'  => $nowtime,
					'clock_in_ip_address' => $ip_address,
					'clock_out'  => '',
					'clock_out_ip_address'  => 1,
					'clock_in_out'  => 0,
					'clock_in_latitude' => $latitude,
					'clock_in_longitude'  => $longitude,
					'clock_out_latitude'  => 1,
					'clock_out_longitude'  => 1,
					'time_late'  => $nowtime,
					'early_leaving'  => $nowtime,
					'overtime' => $nowtime,
					'total_work'  => '00:00',
					'total_rest'  => $total_rest,
					'shift_id'  => $office_shift_id,
					'work_from_home'  => $work_from_home,
					'lunch_breakin'  => 0,
					'lunch_breakout'  => 0,
					'attendance_status'  => 'Present',
				];
				$TimesheetModel = new TimesheetModel();
				$result = $TimesheetModel->insert($data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_clockin_success');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
			} else if($clock_state=='clock_out') {
				
				$clockout_value = check_user_attendance_clockout_value();
				$cout = date_create($clockout_value[0]->clock_in);
				$cin = date_create($nowtime);

				// lunch_break code
				$lunch_breakin = date_create($clockout_value[0]->lunch_breakin);
				$lunch_breakout = date_create($clockout_value[0]->lunch_breakout);
				
				$interval_cin = date_diff($cout, $cin);
				$hours_in   = $interval_cin->format('%h');
				$minutes_in = $interval_cin->format('%i');
				$secounds_in = $interval_cin->format('%s');
				$total_work = $interval_cin->format('%h:%i');
				if($lunch_breakin != "" && $lunch_breakout != "") {
				$interval_break = date_diff($lunch_breakin, $lunch_breakout);
				$hours_break   = $interval_break->format('%h');
				$minutes_break = $interval_break->format('%i');
				$secounds_break = $interval_break->format('%s');

				$in_time_minuts = $hours_in .":".$minutes_in .":".$secounds_in;
				$break_time_minuts = $hours_break .":".$minutes_break .":".$secounds_break;
				$break_time_minuts_year = date_create(date('2022-01-01 '.$break_time_minuts));
				$in_time_minuts_year = date_create(date('2022-01-01 '.$in_time_minuts));
				$difreence_break_in = date_diff($in_time_minuts_year, $break_time_minuts_year);
				// print_r($difreence_break_in->format('%h:%i:%s'));echo "difreence_break_in<br>";
							
				$total_work = $difreence_break_in->format('%h:%i');
				} else if($lunch_breakin != "" && $lunch_breakout == "") {
					$Return['error'] = "Please first click back from lunch ";
					if($Return['error']!='') {
						$this->output($Return);
					}
				} else {
					$xin_system = erp_company_settings();
					if($xin_system['is_lunch_break']=="No"){ 
					$employee_detail = $StaffdetailsModel->where('user_id', $employee_id)->first();
					$office_shift = $ShiftModel->where('office_shift_id', $employee_detail['office_shift_id'])->first();
						$day = strtolower(date ('l'));
						$day_lunch_break = $day .'_lunch_break';
						$day_lunch_break_out = $day .'_lunch_break_out';
						if($office_shift) {
							$day_lunch_break =	$office_shift[$day_lunch_break];
							$day_lunch_break_out =	$office_shift[$day_lunch_break_out];
							if($day_lunch_break != "" && $day_lunch_break_out !="") {
								$lunch_start = date_create('2022-01-01 '.$day_lunch_break. ':00');
								$lunch_end = date_create('2022-01-01 '.$day_lunch_break_out. ':00');
								// $lunch_diffrence = date_diff($lunch_start, $lunch_end);
								if(date_format($cout,'H') <  date_format($lunch_start,'H') && date_format($cin,'H') > date_format($lunch_end,'H')) {
									$lunch_diffrence = date_diff($lunch_start, $lunch_end);
									$hours_break   = $lunch_diffrence->format('%h');
									$minutes_break = $lunch_diffrence->format('%i');
									$secounds_break = $lunch_diffrence->format('%s');

									$in_time_minuts = $hours_in .":".$minutes_in .":".$secounds_in;
									$break_time_minuts = $hours_break .":".$minutes_break .":".$secounds_break;
									$break_time_minuts_year = date_create(date('2022-01-01 '.$break_time_minuts));
									$in_time_minuts_year = date_create(date('2022-01-01 '.$in_time_minuts));
									$difreence_break_in = date_diff($in_time_minuts_year, $break_time_minuts_year);
									// print_r($difreence_break_in->format('%h:%i:%s'));echo "difreence_break_in<br>";
												
									$total_work = $difreence_break_in->format('%h:%i');
								}
								
							}
						}
					} 
				}
				
				
				$data = array(
					'employee_id' => $employee_id,
					'clock_out' => $nowtime,
					'clock_out_ip_address' => $ip_address,
					'clock_out_latitude' => $latitude,
					'clock_out_longitude' => $longitude,
					'clock_in_out' => '0',
					'early_leaving' => $nowtime,
					'overtime' => $nowtime,
					'total_work' => $total_work
				);
			// 	print_r($data);echo "data";
				
			// die();
				$id = udecode($this->request->getPost('time_id'));
				
				$TimesheetModel = new TimesheetModel();
				$result = $TimesheetModel->update($id, $data);
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_clockout_success');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
			}
			$Return['csrf_hash'] = csrf_hash();
			$this->output($Return);
			exit;
		}
	}
	// set clock in - clock out > attendance
	public function set_lunch_break() {
		
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		if ($this->request->getPost('type') === 'set_lunchbreak') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			$UsersModel = new UsersModel();
			$ShiftModel = new ShiftModel();
			$StaffdetailsModel = new StaffdetailsModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			$staff_details = $StaffdetailsModel->where('user_id', $usession['sup_user_id'])->first();
			$company_id = $user_info['company_id'];
			$employee_id = $usession['sup_user_id'];			
			
			$clock_state = $this->request->getPost('clock_state',FILTER_SANITIZE_STRING);			
			//time|today
			$nowtime = date("Y-m-d H:i:s");
			$today_date = date('Y-m-d');
			// set rules
			if($clock_state=='lunch_breakin') {
				
				$data = array(
					'lunch_breakin' => $nowtime,
					'lunch_breakout' => 0
				);
				$id = udecode($this->request->getPost('time_id'));
				$TimesheetModel = new TimesheetModel();
				$result = $TimesheetModel->update($id, $data);
					
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_lunch_out');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
			} else if($clock_state=='lunch_breakout') {
				
				$data = array(
					'lunch_breakout' => $nowtime
				);
				$id = udecode($this->request->getPost('time_id'));
				$TimesheetModel = new TimesheetModel();
				$result = $TimesheetModel->update($id, $data);
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_back_from_lunch');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
			}
			$Return['csrf_hash'] = csrf_hash();
			$this->output($Return);
			exit;
		}
	}
	public function is_shift() {
		
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		$id = $request->uri->getSegment(4);
		
		$data = array(
			'user_id' => $id
			);
		if($session->has('sup_username')){
			return view('erp/employees/get_shifts', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	 }
}
