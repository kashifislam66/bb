<?php
use CodeIgniter\I18n\Time;
//TimeHRM _ Notifications - Helper
if( !function_exists('skip_specific_approval_info') ){
	function skip_specific_approval_info($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		$new_notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($new_notify_level_cnt > 0){
			$new_notify_level_data = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
			$return_val = array('skip_specific_approval' => $new_notify_level_data['skip_specific_approval']);
		} else {
			$return_val = array('skip_specific_approval' => 0);
		}
		return $return_val;
	}
}
		
if( !function_exists('staff_reporting_manager_info') ){
	function staff_reporting_manager_info($session_staff_id, $module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check reporting managers default
		$employee_detail = $StaffdetailsModel->where('company_id', $company_id)->where('user_id', $session_staff_id)->first();
		$employee_level_cnt = $StaffdetailsModel->where('company_id', $company_id)->where('approval_level01', $usession['sup_user_id'])
		->orWhere('approval_level02', $usession['sup_user_id'])
		->orWhere('approval_level03', $usession['sup_user_id'])
		->countAllResults();
		// check notifications and approvals
		//opt
		$new_notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($new_notify_level_cnt > 0){
			$new_notify_level_data = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
			if($new_notify_level_data['skip_specific_approval'] !=0) {
				// check notifications and approvals
				$notify_level_cnt = $NotificationsModel->where('company_id',$company_id)
				->where('module_options', $module_option)
				->where("(module_options = '$module_option' and approval_level01 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level02 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level03 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level04 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level05 = '$session_staff_id')")->countAllResults();
				if($notify_level_cnt > 0) {
					$notify_level = $NotificationsModel->where('company_id',$company_id)
					->where('module_options', $module_option)
					->where("(module_options = '$module_option' and approval_level01 = '$session_staff_id') OR
					(module_options = '$module_option' and approval_level02 = '$session_staff_id') OR
					(module_options = '$module_option' and approval_level03 = '$session_staff_id') OR
					(module_options = '$module_option' and approval_level04 = '$session_staff_id') OR
					(module_options = '$module_option' and approval_level05 = '$session_staff_id')")->first();
					$upon_submission = $notify_level['notify_upon_submission'];
					$upon_approval = $notify_level['notify_upon_approval'];
					$level01 = $notify_level['approval_level01'];
					$level02 = $notify_level['approval_level02'];
					$level03 = $notify_level['approval_level03'];
					$level04 = $notify_level['approval_level04'];
					$level05 = $notify_level['approval_level05'];
					if($level01!=0) {
						$app_level = 1;
					} if($level02!=0) {
						$app_level = 2;
					} if($level03!=0) {
						$app_level = 3;
					} if($level04!=0) {
						$app_level = 4;
					} if($level05!=0) {
						$app_level = 5;
					}
					$manager_arr = array('upon_submission'=>$upon_submission,'upon_approval'=>$upon_approval,'level1'=>$level01,'level2'=>$level02,'level3'=>$level03,'level4'=>$level04,'level5'=>$level05,'total_levels'=>$app_level);
				} else {
					$manager_arr = array('upon_submission'=>0,'upon_approval'=>0,'level1'=>0,'level2'=>0,'level3'=>0, 'level4'=>0,'level5'=>0,'total_levels'=>0);
				}
			} else {
				if($employee_level_cnt > 0) {
			
					$employee_detail = $StaffdetailsModel->where('company_id', $company_id)
					->where('approval_level01', $usession['sup_user_id'])
					->orWhere('approval_level02', $usession['sup_user_id'])
					->orWhere('approval_level03', $usession['sup_user_id'])->first();
					// Method 2
					$app_level1 =0; $app_level2 =0; $app_level3 =0;
					if($employee_detail['approval_level01']!=0) {
						$app_level1 = 1;
					} if($employee_detail['approval_level02']!=0) {
						$app_level2 = 1;
					} if($employee_detail['approval_level03']!=0) {
						$app_level3 = 1;
					}
					
					$ftotal = $app_level1 + $app_level2 + $app_level3;
					$manager_arr = array('level1'=>$employee_detail['approval_level01'],'level2'=>$employee_detail['approval_level02'],'level3'=>$employee_detail['approval_level03'],'level4'=>0,'level5'=>0,'upon_submission'=>0,'upon_approval'=>0,'total_levels'=>$ftotal);
				} else {
					$manager_arr = array('upon_submission'=>0,'upon_approval'=>0,'level1'=>0,'level2'=>0,'level3'=>0, 'level4'=>0,'level5'=>0,'total_levels'=>0);
				}
			}
		} else {
			if($employee_level_cnt > 0) {
			
				$employee_detail = $StaffdetailsModel->where('company_id', $company_id)
				->where('approval_level01', $usession['sup_user_id'])
				->orWhere('approval_level02', $usession['sup_user_id'])
				->orWhere('approval_level03', $usession['sup_user_id'])->first();
				// Method 2
				$app_level1 =0; $app_level2 =0; $app_level3 =0;
				if($employee_detail['approval_level01']!=0) {
					$app_level1 = 1;
				} if($employee_detail['approval_level02']!=0) {
					$app_level2 = 1;
				} if($employee_detail['approval_level03']!=0) {
					$app_level3 = 1;
				}
				
				$ftotal = $app_level1 + $app_level2 + $app_level3;
				$manager_arr = array('level1'=>$employee_detail['approval_level01'],'level2'=>$employee_detail['approval_level02'],'level3'=>$employee_detail['approval_level03'],'level4'=>0,'level5'=>0,'upon_submission'=>0,'upon_approval'=>0,'total_levels'=>$ftotal);
			} else {
				$manager_arr = array('upon_submission'=>0,'upon_approval'=>0,'level1'=>0,'level2'=>0,'level3'=>0, 'level4'=>0,'level5'=>0,'total_levels'=>0);
			}
		}
		return $manager_arr;
	}
}
if( !function_exists('staff_reporting_manager_old_level') ){
	function staff_reporting_manager_old_level($staff_id, $module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$usession = $session->get('sup_username');
		$session_staff_id = $usession['sup_user_id'];
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check reporting managers default
		//$staff_cnt = $StaffdetailsModel->whereIn('user_id', $_complaint['complaint_against'])->where('user_id',$usession['sup_user_id'])->countAllResults();
		if($module_option == 'complaint_settings'){
			$employee_level_cnt = $StaffdetailsModel->where('company_id', $company_id)->whereIn('user_id', $staff_id)->countAllResults();
		} else {
			$employee_level_cnt = $StaffdetailsModel->where('company_id', $company_id)->where('user_id', $staff_id)->countAllResults();
		}
		// check notifications and approvals
		if($employee_level_cnt > 0) {
	
			if($module_option == 'complaint_settings'){
				$employee_detail = $StaffdetailsModel->where('company_id', $company_id)->whereIn('user_id', $staff_id)->first();
			} else {
				$employee_detail = $StaffdetailsModel->where('company_id', $company_id)->where('user_id', $staff_id)->first();
			}
			
			
			$app_level1 =0; $app_level2 =0; $app_level3 =0;
			if($employee_detail['approval_level01']!=0) {
				$app_level1 = 1;
			} if($employee_detail['approval_level02']!=0) {
				$app_level2 = 1;
			} if($employee_detail['approval_level03']!=0) {
				$app_level3 = 1;
			}
			
			$ftotal = $app_level1 + $app_level2 + $app_level3;
			$manager_arr = array('level1'=>$employee_detail['approval_level01'],'level2'=>$employee_detail['approval_level02'],'level3'=>$employee_detail['approval_level03'],'level4'=>0,'level5'=>0,'upon_submission'=>0,'upon_approval'=>0,'total_levels'=>$ftotal);
		} else {
			$manager_arr = array('upon_submission'=>0,'upon_approval'=>0,'level1'=>0,'level2'=>0,'level3'=>0, 'level4'=>0,'level5'=>0,'total_levels'=>0);
		}
		return $manager_arr;
	}
}
if( !function_exists('staff_approval_notification_complaints_info') ){
	function staff_approval_notification_complaints_info($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$LeaveModel = new \App\Models\LeaveModel();
		$TravelModel = new \App\Models\TravelModel();
		$LeaveadjustModel = new \App\Models\LeaveadjustModel();
		$ComplaintsModel = new \App\Models\ComplaintsModel();
		$IncidentsModel = new \App\Models\IncidentsModel();
		$TransfersModel = new \App\Models\TransfersModel();
		$ResignationsModel = new \App\Models\ResignationsModel();
		$OvertimerequestModel = new \App\Models\OvertimerequestModel();
		
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		$employee_level_cnt = $StaffdetailsModel->where('company_id', $company_id)->where('approval_level01', $usession['sup_user_id'])
		->orWhere('approval_level02', $usession['sup_user_id'])
		->orWhere('approval_level03', $usession['sup_user_id'])
		->countAllResults();
		$new_notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		$session_staff_id = $usession['sup_user_id'];
		if($new_notify_level_cnt > 0){
			$new_notify_level_data = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
			if($new_notify_level_data['skip_specific_approval'] !=0) {
				// check notifications and approvals
				$notify_level_cnt = $NotificationsModel->where('company_id',$company_id)
				->where('module_options', $module_option)
				->where("(module_options = '$module_option' and approval_level01 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level02 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level03 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level04 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level05 = '$session_staff_id')")->countAllResults();
				//->where("assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'")->findAll();
				
				if($notify_level_cnt > 0) {
					if($module_option == 'complaint_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						$module_data_cnt = $ComplaintsModel->where('company_id',$company_id)->where('status',0)->countAllResults();
						$module_alert_data[] = $ComplaintsModel->where('company_id',$company_id)->where('status',0)->findAll();
						$get_alert_cnt = array('get_alert_cnt'=>$module_data_cnt, 'complaint_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					}
				} else {
					$get_alert_cnt = array('get_alert_cnt'=>0,'complaint_alert_data'=>0);
					return $get_alert_cnt;
				}
			} else {
				if($employee_level_cnt > 0) {
					$employee_detail = $StaffdetailsModel->where('company_id', $company_id)
						->where('approval_level01', $usession['sup_user_id'])
						->orWhere('approval_level02', $usession['sup_user_id'])
						->orWhere('approval_level03', $usession['sup_user_id'])->findAll();
					// check module
					// complaint
					if($module_option == 'complaint_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						foreach($employee_detail as $nw_rec){
							$user_id = $nw_rec['user_id'];
							$module_data_cnt += $ComplaintsModel->where('company_id',$company_id)->where('status',0)->where("complaint_against like '%$user_id' or complaint_against like '$user_id%' or complaint_against = '$user_id'")->countAllResults();
							$module_alert_data[] = $ComplaintsModel->where('company_id',$company_id)->where('status',0)->where("complaint_against like '%$user_id' or complaint_against like '$user_id%' or complaint_against = '$user_id'")->findAll();
						}
						$get_alert_cnt = array('get_alert_cnt'=>$module_data_cnt, 'complaint_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					} else {
						$get_alert_cnt = array('get_alert_cnt'=>0,'complaint_alert_data'=>0);
						return $get_alert_cnt;
					}
				} else {
					$get_alert_cnt = array('get_alert_cnt'=>0,'complaint_alert_data'=>0);
					return $get_alert_cnt;
				}
				//return $get_alert_cnt;
			}
		}
	}
}
if( !function_exists('staff_approval_notification_attendance_info') ){
	function staff_approval_notification_attendance_info($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$TimesheetModel = new \App\Models\TimesheetModel();
		
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		$employee_level_cnt = $StaffdetailsModel->where('company_id', $company_id)->where('approval_level01', $usession['sup_user_id'])
		->orWhere('approval_level02', $usession['sup_user_id'])
		->orWhere('approval_level03', $usession['sup_user_id'])
		->countAllResults();
		$new_notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		$session_staff_id = $usession['sup_user_id'];
		if($new_notify_level_cnt > 0){
			$new_notify_level_data = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', 'attendance_settings')
			->first();
			if($new_notify_level_data['skip_specific_approval'] !=0) {
				// check notifications and approvals
				$notify_level_cnt = $NotificationsModel->where('company_id',$company_id)
				->where('module_options', $module_option)
				->where("(module_options = '$module_option' and approval_level01 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level02 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level03 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level04 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level05 = '$session_staff_id')")->countAllResults();
				if($notify_level_cnt > 0) {
					if($module_option == 'attendance_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						$module_data_cnt = $TimesheetModel->where('company_id',$company_id)->where('status','Pending')->countAllResults();
						$module_alert_data[] = $TimesheetModel->where('company_id',$company_id)->where('status','Pending')->findAll();
						$get_alert_cnt = array('get_attendance_alert_cnt'=>$module_data_cnt, 'attendance_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					}  else {
						$get_alert_cnt = array('get_attendance_alert_cnt'=>0,'attendance_alert_data'=>0);
						return $get_alert_cnt;
					}
				} else {
					$get_alert_cnt = array('get_attendance_alert_cnt'=>0,'attendance_alert_data'=>0);
					return $get_alert_cnt;
				}
			} else {
				if($employee_level_cnt > 0) {
					$employee_detail = $StaffdetailsModel->where('company_id', $company_id)
						->where('approval_level01', $usession['sup_user_id'])
						->orWhere('approval_level02', $usession['sup_user_id'])
						->orWhere('approval_level03', $usession['sup_user_id'])->findAll();
					// check module
					// complaint
					if($module_option == 'attendance_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						foreach($employee_detail as $nw_rec){
							$user_id = $nw_rec['user_id'];
							$module_data_cnt = $TimesheetModel->where('company_id',$company_id)->where('employee_id', $user_id)->where('status','Pending')->countAllResults();
							$module_alert_data[] = $TimesheetModel->where('company_id',$company_id)->where('employee_id', $user_id)->where('status','Pending')->findAll();
						}
						$get_alert_cnt = array('get_attendance_alert_cnt'=>$module_data_cnt, 'attendance_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					} else {
						$get_alert_cnt = array('get_attendance_alert_cnt'=>0,'attendance_alert_data'=>0);
						return $get_alert_cnt;
					}
				} else {
					$get_alert_cnt = array('get_attendance_alert_cnt'=>0,'attendance_alert_data'=>0);
					return $get_alert_cnt;
				}
				//return $get_alert_cnt;
			}
		}
	}
}
if( !function_exists('staff_approval_notification_leave_info') ){
	function staff_approval_notification_leave_info($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$LeaveModel = new \App\Models\LeaveModel();
		$TravelModel = new \App\Models\TravelModel();
		$LeaveadjustModel = new \App\Models\LeaveadjustModel();
		$ComplaintsModel = new \App\Models\ComplaintsModel();
		$IncidentsModel = new \App\Models\IncidentsModel();
		$TransfersModel = new \App\Models\TransfersModel();
		$ResignationsModel = new \App\Models\ResignationsModel();
		$OvertimerequestModel = new \App\Models\OvertimerequestModel();
		
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		$employee_level_cnt = $StaffdetailsModel->where('company_id', $company_id)->where('approval_level01', $usession['sup_user_id'])
		->orWhere('approval_level02', $usession['sup_user_id'])
		->orWhere('approval_level03', $usession['sup_user_id'])
		->countAllResults();
		$new_notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		$session_staff_id = $usession['sup_user_id'];
		if($new_notify_level_cnt > 0){
			$new_notify_level_data = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', 'leave_settings')
			->first();
			if($new_notify_level_data['skip_specific_approval'] !=0) {
				// check notifications and approvals
				$notify_level_cnt = $NotificationsModel->where('company_id',$company_id)
				->where('module_options', $module_option)
				->where("(module_options = '$module_option' and approval_level01 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level02 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level03 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level04 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level05 = '$session_staff_id')")->countAllResults();
				if($notify_level_cnt > 0) {
					if($module_option == 'leave_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						$module_data_cnt = $LeaveModel->where('company_id',$company_id)->where('status',1)->countAllResults();
						$module_alert_data[] = $LeaveModel->where('company_id',$company_id)->where('status',1)->findAll();
						$get_alert_cnt = array('get_leave_alert_cnt'=>$module_data_cnt, 'leave_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					}  else {
						$get_alert_cnt = array('get_leave_alert_cnt'=>0,'leave_alert_data'=>0);
						return $get_alert_cnt;
					}
				} else {
					$get_alert_cnt = array('get_leave_alert_cnt'=>0,'leave_alert_data'=>0);
					return $get_alert_cnt;
				}
			} else {
				if($employee_level_cnt > 0) {
					$employee_detail = $StaffdetailsModel->where('company_id', $company_id)
						->where('approval_level01', $usession['sup_user_id'])
						->orWhere('approval_level02', $usession['sup_user_id'])
						->orWhere('approval_level03', $usession['sup_user_id'])->findAll();
					// check module
					// complaint
					if($module_option == 'leave_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						foreach($employee_detail as $nw_rec){
							$user_id = $nw_rec['user_id'];
							$module_data_cnt += $LeaveModel->where('company_id',$company_id)->where('status',1)->where('employee_id', $user_id)->countAllResults();
							$module_alert_data[] = $LeaveModel->where('company_id',$company_id)->where('status',1)->where('employee_id', $user_id)->findAll();
						}
						$get_alert_cnt = array('get_leave_alert_cnt'=>$module_data_cnt, 'leave_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					} else {
						$get_alert_cnt = array('get_leave_alert_cnt'=>0,'leave_alert_data'=>0);
						return $get_alert_cnt;
					}
				} else {
					$get_alert_cnt = array('get_leave_alert_cnt'=>0,'leave_alert_data'=>0);
					return $get_alert_cnt;
				}
				//return $get_alert_cnt;
			}
		}			
		
	}
}
if( !function_exists('staff_approval_notification_leave_adjust_info') ){
	function staff_approval_notification_leave_adjust_info($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$LeaveModel = new \App\Models\LeaveModel();
		$TravelModel = new \App\Models\TravelModel();
		$LeaveadjustModel = new \App\Models\LeaveadjustModel();
		$ComplaintsModel = new \App\Models\ComplaintsModel();
		$IncidentsModel = new \App\Models\IncidentsModel();
		$TransfersModel = new \App\Models\TransfersModel();
		$ResignationsModel = new \App\Models\ResignationsModel();
		$OvertimerequestModel = new \App\Models\OvertimerequestModel();
		
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		$employee_level_cnt = $StaffdetailsModel->where('company_id', $company_id)->where('approval_level01', $usession['sup_user_id'])
		->orWhere('approval_level02', $usession['sup_user_id'])
		->orWhere('approval_level03', $usession['sup_user_id'])
		->countAllResults();
		$new_notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		$session_staff_id = $usession['sup_user_id'];
		if($new_notify_level_cnt > 0){
			$new_notify_level_data = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
			if($new_notify_level_data['skip_specific_approval'] !=0) {
				// check notifications and approvals
				$notify_level_cnt = $NotificationsModel->where('company_id',$company_id)
				->where('module_options', $module_option)
				->where("(module_options = '$module_option' and approval_level01 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level02 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level03 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level04 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level05 = '$session_staff_id')")->countAllResults();
				if($notify_level_cnt > 0) {
					$com_level_option = $NotificationsModel
					->where('company_id', $company_id)
					->where('module_options', $module_option)
					->where('approval_level01', $session_staff_id)
					->orWhere('approval_level02', $session_staff_id)
					->orWhere('approval_level03', $session_staff_id)
					->orWhere('approval_level04', $session_staff_id)
					->orWhere('approval_level05', $session_staff_id)
					->first();
					if($module_option == 'leave_adjustment_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						$module_data_cnt = $LeaveadjustModel->where('company_id',$company_id)->where('status',0)->countAllResults();
						$module_alert_data[] = $LeaveadjustModel->where('company_id',$company_id)->where('status',0)->findAll();
						$get_alert_cnt = array('get_leave_adjust_alert_cnt'=>$module_data_cnt, 'leave_adjust_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					} else {
						$get_alert_cnt = array('get_leave_adjust_alert_cnt'=>0,'leave_adjust_alert_data'=>0);
						return $get_alert_cnt;
					}
				} else {
					$get_alert_cnt = array('get_leave_adjust_alert_cnt'=>0,'leave_adjust_alert_data'=>0);
					return $get_alert_cnt;
				}
			} else {
				if($employee_level_cnt > 0) {
					$employee_detail = $StaffdetailsModel->where('company_id', $company_id)
						->where('approval_level01', $usession['sup_user_id'])
						->orWhere('approval_level02', $usession['sup_user_id'])
						->orWhere('approval_level03', $usession['sup_user_id'])->findAll();
					// check module
					// complaint
					if($module_option == 'leave_adjustment_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						foreach($employee_detail as $nw_rec){
							$user_id = $nw_rec['user_id'];
							$module_data_cnt += $LeaveadjustModel->where('company_id',$company_id)->where('status',0)->where('employee_id', $user_id)->countAllResults();
							$module_alert_data[] = $LeaveadjustModel->where('company_id',$company_id)->where('status',0)->where('employee_id', $user_id)->findAll();
						}
						$get_alert_cnt = array('get_leave_adjust_alert_cnt'=>$module_data_cnt, 'leave_adjust_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					} else {
						$get_alert_cnt = array('get_leave_adjust_alert_cnt'=>0,'leave_adjust_alert_data'=>0);
						return $get_alert_cnt;
					}
				} else {
					$get_alert_cnt = array('get_leave_adjust_alert_cnt'=>0,'leave_adjust_alert_data'=>0);
					return $get_alert_cnt;
				}
				//return $get_alert_cnt;
			}
		}			
		
	}
}
if( !function_exists('staff_approval_notification_travel_info') ){
	function staff_approval_notification_travel_info($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$LeaveModel = new \App\Models\LeaveModel();
		$TravelModel = new \App\Models\TravelModel();
		$LeaveadjustModel = new \App\Models\LeaveadjustModel();
		$ComplaintsModel = new \App\Models\ComplaintsModel();
		$IncidentsModel = new \App\Models\IncidentsModel();
		$TransfersModel = new \App\Models\TransfersModel();
		$ResignationsModel = new \App\Models\ResignationsModel();
		$OvertimerequestModel = new \App\Models\OvertimerequestModel();
		
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		$employee_level_cnt = $StaffdetailsModel->where('company_id', $company_id)->where('approval_level01', $usession['sup_user_id'])
		->orWhere('approval_level02', $usession['sup_user_id'])
		->orWhere('approval_level03', $usession['sup_user_id'])
		->countAllResults();
		$new_notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		$session_staff_id = $usession['sup_user_id'];
		if($new_notify_level_cnt > 0){
			$new_notify_level_data = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
			if($new_notify_level_data['skip_specific_approval'] !=0) {
				// check notifications and approvals
				$notify_level_cnt = $NotificationsModel->where('company_id',$company_id)
				->where('module_options', $module_option)
				->where("(module_options = '$module_option' and approval_level01 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level02 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level03 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level04 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level05 = '$session_staff_id')")->countAllResults();
				if($notify_level_cnt > 0) {
					$com_level_option = $NotificationsModel
					->where('company_id', $company_id)
					->where('module_options', $module_option)
					->where('approval_level01', $session_staff_id)
					->orWhere('approval_level02', $session_staff_id)
					->orWhere('approval_level03', $session_staff_id)
					->orWhere('approval_level04', $session_staff_id)
					->orWhere('approval_level05', $session_staff_id)
					->first();
					if($module_option == 'travel_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						$module_data_cnt = $TravelModel->where('company_id',$company_id)->where('status',0)->countAllResults();
						$module_alert_data[] = $TravelModel->where('company_id',$company_id)->where('status',0)->findAll();
						$get_alert_cnt = array('get_travel_alert_cnt'=>$module_data_cnt, 'travel_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					} else {
						$get_alert_cnt = array('get_travel_alert_cnt'=>0,'travel_alert_data'=>0);
						return $get_alert_cnt;
					}
				} else {
					$get_alert_cnt = array('get_travel_alert_cnt'=>0,'travel_alert_data'=>0);
					return $get_alert_cnt;
				}
			} else {
				if($employee_level_cnt > 0) {
					$employee_detail = $StaffdetailsModel->where('company_id', $company_id)
						->where('approval_level01', $usession['sup_user_id'])
						->orWhere('approval_level02', $usession['sup_user_id'])
						->orWhere('approval_level03', $usession['sup_user_id'])->findAll();
					// check module
					// complaint
					if($module_option == 'travel_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						foreach($employee_detail as $nw_rec){
							$user_id = $nw_rec['user_id'];
							$module_data_cnt += $TravelModel->where('company_id',$company_id)->where('status',0)->where('employee_id', $user_id)->countAllResults();
							$module_alert_data[] = $TravelModel->where('company_id',$company_id)->where('status',0)->where('employee_id', $user_id)->findAll();
						}
						$get_alert_cnt = array('get_travel_alert_cnt'=>$module_data_cnt, 'travel_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					} else {
						$get_alert_cnt = array('get_travel_alert_cnt'=>0,'travel_alert_data'=>0);
						return $get_alert_cnt;
					}					
				} else {
					$get_alert_cnt = array('get_travel_alert_cnt'=>0,'travel_alert_data'=>0);
					return $get_alert_cnt;
				}
				//return $get_alert_cnt;
			}
		}			
		
	}
}
if( !function_exists('staff_approval_notification_overtime_info') ){
	function staff_approval_notification_overtime_info($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$LeaveModel = new \App\Models\LeaveModel();
		$TravelModel = new \App\Models\TravelModel();
		$LeaveadjustModel = new \App\Models\LeaveadjustModel();
		$ComplaintsModel = new \App\Models\ComplaintsModel();
		$IncidentsModel = new \App\Models\IncidentsModel();
		$TransfersModel = new \App\Models\TransfersModel();
		$ResignationsModel = new \App\Models\ResignationsModel();
		$OvertimerequestModel = new \App\Models\OvertimerequestModel();
		
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		$employee_level_cnt = $StaffdetailsModel->where('company_id', $company_id)->where('approval_level01', $usession['sup_user_id'])
		->orWhere('approval_level02', $usession['sup_user_id'])
		->orWhere('approval_level03', $usession['sup_user_id'])
		->countAllResults();
		$new_notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		$session_staff_id = $usession['sup_user_id'];
		if($new_notify_level_cnt > 0){
			$new_notify_level_data = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
			if($new_notify_level_data['skip_specific_approval'] !=0) {
				// check notifications and approvals
				$notify_level_cnt = $NotificationsModel->where('company_id',$company_id)
				->where('module_options', $module_option)
				->where("(module_options = '$module_option' and approval_level01 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level02 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level03 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level04 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level05 = '$session_staff_id')")->countAllResults();
				if($notify_level_cnt > 0) {
					$com_level_option = $NotificationsModel
					->where('company_id', $company_id)
					->where('module_options', $module_option)
					->where('approval_level01', $session_staff_id)
					->orWhere('approval_level02', $session_staff_id)
					->orWhere('approval_level03', $session_staff_id)
					->orWhere('approval_level04', $session_staff_id)
					->orWhere('approval_level05', $session_staff_id)
					->first();
					if($module_option == 'overtime_request_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						$module_data_cnt = $OvertimerequestModel->where('company_id',$company_id)->where('is_approved',0)->countAllResults();
						$module_alert_data[] = $OvertimerequestModel->where('company_id',$company_id)->where('is_approved',0)->findAll();
						$get_alert_cnt = array('get_overtime_alert_cnt'=>$module_data_cnt, 'overtime_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					} else {
						$get_alert_cnt = array('get_overtime_alert_cnt'=>0,'overtime_alert_data'=>0);
						return $get_alert_cnt;
					}
				} else {
					$get_alert_cnt = array('get_overtime_alert_cnt'=>0,'overtime_alert_data'=>0);
					return $get_alert_cnt;
				}
			} else {
				if($employee_level_cnt > 0) {
					$employee_detail = $StaffdetailsModel->where('company_id', $company_id)
						->where('approval_level01', $usession['sup_user_id'])
						->orWhere('approval_level02', $usession['sup_user_id'])
						->orWhere('approval_level03', $usession['sup_user_id'])->findAll();
					// check module
					// complaint
					if($module_option == 'overtime_request_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						foreach($employee_detail as $nw_rec){
							$user_id = $nw_rec['user_id'];
							$module_data_cnt += $OvertimerequestModel->where('company_id',$company_id)->where('is_approved',0)->where('staff_id', $user_id)->countAllResults();
							$module_alert_data[] = $OvertimerequestModel->where('company_id',$company_id)->where('is_approved',0)->where('staff_id', $user_id)->findAll();
						}
						$get_alert_cnt = array('get_overtime_alert_cnt'=>$module_data_cnt, 'overtime_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					} else {
						$get_alert_cnt = array('get_overtime_alert_cnt'=>0,'overtime_alert_data'=>0);
						return $get_alert_cnt;
					}					
				} else {
					$get_alert_cnt = array('get_overtime_alert_cnt'=>0,'overtime_alert_data'=>0);
					return $get_alert_cnt;
				}
				//return $get_alert_cnt;
			}
		}			
		
	}
}
if( !function_exists('staff_approval_notification_incident_info') ){
	function staff_approval_notification_incident_info($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$LeaveModel = new \App\Models\LeaveModel();
		$TravelModel = new \App\Models\TravelModel();
		$LeaveadjustModel = new \App\Models\LeaveadjustModel();
		$ComplaintsModel = new \App\Models\ComplaintsModel();
		$IncidentsModel = new \App\Models\IncidentsModel();
		$TransfersModel = new \App\Models\TransfersModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$OvertimerequestModel = new \App\Models\OvertimerequestModel();
		
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		$employee_level_cnt = $StaffdetailsModel->where('company_id', $company_id)->where('approval_level01', $usession['sup_user_id'])
		->orWhere('approval_level02', $usession['sup_user_id'])
		->orWhere('approval_level03', $usession['sup_user_id'])
		->countAllResults();
		$new_notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		$session_staff_id = $usession['sup_user_id'];
		if($new_notify_level_cnt > 0){
			$new_notify_level_data = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
			if($new_notify_level_data['skip_specific_approval'] !=0) {
				// check notifications and approvals
				$notify_level_cnt = $NotificationsModel->where('company_id',$company_id)
				->where('module_options', $module_option)
				->where("(module_options = '$module_option' and approval_level01 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level02 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level03 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level04 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level05 = '$session_staff_id')")->countAllResults();
				if($notify_level_cnt > 0) {
					if($module_option == 'incident_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						// module incident
						$module_data_cnt = $IncidentsModel->where('company_id',$company_id)->where('status',0)->countAllResults();
						$module_alert_data[] = $IncidentsModel->where('company_id',$company_id)->where('status',0)->findAll();		
						$get_alert_cnt = array('get_incident_alert_cnt'=>$module_data_cnt, 'incident_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					} else {
						$get_alert_cnt = array('get_incident_alert_cnt'=>0,'incident_alert_data'=>0,'get_incident_key'=>0);
						return $get_alert_cnt;
					}					
				} else {
					$get_alert_cnt = array('get_incident_alert_cnt'=>0,'incident_alert_data'=>0,'get_incident_key'=>0);
					return $get_alert_cnt;
				}
			} else {
				if($employee_level_cnt > 0) {
					$employee_detail = $StaffdetailsModel->where('company_id', $company_id)
						->where('approval_level01', $usession['sup_user_id'])
						->orWhere('approval_level02', $usession['sup_user_id'])
						->orWhere('approval_level03', $usession['sup_user_id'])->findAll();
					// check module
					// complaint
					if($module_option == 'incident_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						foreach($employee_detail as $nw_rec){
							$user_id = $nw_rec['user_id'];
							$module_data_cnt += $IncidentsModel->where('company_id',$company_id)->where('status',0)->where('employee_id', $user_id)->countAllResults();
							$module_alert_data[] = $IncidentsModel->where('company_id',$company_id)->where('status',0)->where('employee_id', $user_id)->findAll();
						}
						$get_alert_cnt = array('get_incident_alert_cnt'=>$module_data_cnt, 'incident_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					} else {
						$get_alert_cnt = array('get_incident_alert_cnt'=>0,'incident_alert_data'=>0);
						return $get_alert_cnt;
					}					
				} else {
					$get_alert_cnt = array('get_incident_alert_cnt'=>0,'incident_alert_data'=>0);
					return $get_alert_cnt;
				}
				//return $get_alert_cnt;
			}
		}			
		
	}
}
if( !function_exists('staff_approval_notification_transfer_info') ){
	function staff_approval_notification_transfer_info($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$LeaveModel = new \App\Models\LeaveModel();
		$TravelModel = new \App\Models\TravelModel();
		$LeaveadjustModel = new \App\Models\LeaveadjustModel();
		$ComplaintsModel = new \App\Models\ComplaintsModel();
		$IncidentsModel = new \App\Models\IncidentsModel();
		$TransfersModel = new \App\Models\TransfersModel();
		$ResignationsModel = new \App\Models\ResignationsModel();
		$OvertimerequestModel = new \App\Models\OvertimerequestModel();
		
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		$employee_level_cnt = $StaffdetailsModel->where('company_id', $company_id)->where('approval_level01', $usession['sup_user_id'])
		->orWhere('approval_level02', $usession['sup_user_id'])
		->orWhere('approval_level03', $usession['sup_user_id'])
		->countAllResults();
		$new_notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		$session_staff_id = $usession['sup_user_id'];
		if($new_notify_level_cnt > 0){
			$new_notify_level_data = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
			if($new_notify_level_data['skip_specific_approval'] !=0) {
				// check notifications and approvals
				$notify_level_cnt = $NotificationsModel->where('company_id',$company_id)
				->where('module_options', $module_option)
				->where("(module_options = '$module_option' and approval_level01 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level02 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level03 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level04 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level05 = '$session_staff_id')")->countAllResults();
				if($notify_level_cnt > 0) {
					$com_level_option = $NotificationsModel
					->where('company_id', $company_id)
					->where('module_options', $module_option)
					->where('approval_level01', $session_staff_id)
					->orWhere('approval_level02', $session_staff_id)
					->orWhere('approval_level03', $session_staff_id)
					->orWhere('approval_level04', $session_staff_id)
					->orWhere('approval_level05', $session_staff_id)
					->first();
					if($module_option == 'transfer_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						$module_data_cnt = $TransfersModel->where('company_id',$company_id)->where('status',0)->countAllResults();
						$module_alert_data[] = $TransfersModel->where('company_id',$company_id)->where('status',0)->findAll();
						$get_alert_cnt = array('get_transfer_alert_cnt'=>$module_data_cnt, 'transfer_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					} else {
						$get_alert_cnt = array('get_transfer_alert_cnt'=>0,'transfer_alert_data'=>0);
						return $get_alert_cnt;
					}
				} else {
					$get_alert_cnt = array('get_transfer_alert_cnt'=>0,'transfer_alert_data'=>0);
					return $get_alert_cnt;
				}
			} else {
				if($employee_level_cnt > 0) {
					$employee_detail = $StaffdetailsModel->where('company_id', $company_id)
						->where('approval_level01', $usession['sup_user_id'])
						->orWhere('approval_level02', $usession['sup_user_id'])
						->orWhere('approval_level03', $usession['sup_user_id'])->findAll();
					// check module
					// complaint
					if($module_option == 'transfer_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						foreach($employee_detail as $nw_rec){
							$user_id = $nw_rec['user_id'];
							$module_data_cnt += $TransfersModel->where('company_id',$company_id)->where('status',0)->where('employee_id', $user_id)->countAllResults();
							$module_alert_data[] = $TransfersModel->where('company_id',$company_id)->where('status',0)->where('employee_id', $user_id)->findAll();
						}
						$get_alert_cnt = array('get_transfer_alert_cnt'=>$module_data_cnt, 'transfer_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					} else {
						$get_alert_cnt = array('get_transfer_alert_cnt'=>0,'transfer_alert_data'=>0);
						return $get_alert_cnt;
					}					
				} else {
					$get_alert_cnt = array('get_transfer_alert_cnt'=>0,'transfer_alert_data'=>0);
					return $get_alert_cnt;
				}
				//return $get_alert_cnt;
			}
		}			
		
	}
}
if( !function_exists('staff_approval_notification_resignation_info') ){
	function staff_approval_notification_resignation_info($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$LeaveModel = new \App\Models\LeaveModel();
		$TravelModel = new \App\Models\TravelModel();
		$LeaveadjustModel = new \App\Models\LeaveadjustModel();
		$ComplaintsModel = new \App\Models\ComplaintsModel();
		$IncidentsModel = new \App\Models\IncidentsModel();
		$TransfersModel = new \App\Models\TransfersModel();
		$ResignationsModel = new \App\Models\ResignationsModel();
		$OvertimerequestModel = new \App\Models\OvertimerequestModel();
		
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		$employee_level_cnt = $StaffdetailsModel->where('company_id', $company_id)->where('approval_level01', $usession['sup_user_id'])
		->orWhere('approval_level02', $usession['sup_user_id'])
		->orWhere('approval_level03', $usession['sup_user_id'])
		->countAllResults();
		$new_notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		$session_staff_id = $usession['sup_user_id'];
		if($new_notify_level_cnt > 0){
			$new_notify_level_data = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
			if($new_notify_level_data['skip_specific_approval'] !=0) {
				// check notifications and approvals
				$notify_level_cnt = $NotificationsModel->where('company_id',$company_id)
				->where('module_options', $module_option)
				->where("(module_options = '$module_option' and approval_level01 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level02 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level03 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level04 = '$session_staff_id') OR
				(module_options = '$module_option' and approval_level05 = '$session_staff_id')")->countAllResults();
				if($notify_level_cnt > 0) {
					$com_level_option = $NotificationsModel
					->where('company_id', $company_id)
					->where('module_options', $module_option)
					->where('approval_level01', $session_staff_id)
					->orWhere('approval_level02', $session_staff_id)
					->orWhere('approval_level03', $session_staff_id)
					->orWhere('approval_level04', $session_staff_id)
					->orWhere('approval_level05', $session_staff_id)
					->first();
					if($module_option == 'resignation_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						$module_data_cnt = $ResignationsModel->where('company_id',$company_id)->where('status',0)->countAllResults();
						$module_alert_data[] = $ResignationsModel->where('company_id',$company_id)->where('status',0)->findAll();
						$get_alert_cnt = array('get_resignation_alert_cnt'=>$module_data_cnt, 'resignation_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					} else {
						$get_alert_cnt = array('get_resignation_alert_cnt'=>0,'resignation_alert_data'=>0);
						return $get_alert_cnt;
					}
				} else {
					$get_alert_cnt = array('get_resignation_alert_cnt'=>0,'resignation_alert_data'=>0);
					return $get_alert_cnt;
				}
			} else {
				if($employee_level_cnt > 0) {
					$employee_detail = $StaffdetailsModel->where('company_id', $company_id)
						->where('approval_level01', $usession['sup_user_id'])
						->orWhere('approval_level02', $usession['sup_user_id'])
						->orWhere('approval_level03', $usession['sup_user_id'])->findAll();
					// check module
					// complaint
					if($module_option == 'resignation_settings') {
						$module_data_cnt =0;
						$module_alert_data = array();
						foreach($employee_detail as $nw_rec){
							$user_id = $nw_rec['user_id'];
							$module_data_cnt += $ResignationsModel->where('company_id',$company_id)->where('status',0)->where('employee_id', $user_id)->countAllResults();
							$module_alert_data[] = $ResignationsModel->where('company_id',$company_id)->where('status',0)->where('employee_id', $user_id)->findAll();
						}
						$get_alert_cnt = array('get_resignation_alert_cnt'=>$module_data_cnt, 'resignation_alert_data' => $module_alert_data);
						return $get_alert_cnt;
					} else {
						$get_alert_cnt = array('get_resignation_alert_cnt'=>0,'resignation_alert_data'=>0);
						return $get_alert_cnt;
					}
				} else {
					$get_alert_cnt = array('get_resignation_alert_cnt'=>0,'resignation_alert_data'=>0);
					return $get_alert_cnt;
				}
				//return $get_alert_cnt;
			}
		}			
		
	}
}
if( !function_exists('top_level_notify_upon_submission_complaints') ){
	function top_level_notify_upon_submission_complaints($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$ComplaintsModel = new \App\Models\ComplaintsModel();
		
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
			$notify_upon_submission = explode(',',$notify_level['notify_upon_submission']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $ComplaintsModel->where('company_id',$company_id)->where('status',0)->countAllResults();
				$get_data = $ComplaintsModel->where('company_id',$company_id)->where('status',0)->orderBy('complaint_id', 'ASC')->findAll();
				foreach($get_data as $_complaint):
				$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_complaint['complaint_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->countAllResults();
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_complaint):
						// notificaiton for him/herself
						if(in_array($usession['sup_user_id'],explode(',',$_complaint['complaint_against']))){
							$staff_cnt = $StaffdetailsModel->whereIn('user_id', $_complaint['complaint_against'])->where('user_id',$usession['sup_user_id'])->countAllResults();
						} else {
							$staff_cnt = 0;
						}
						// notificaiton for manager
						$manager_cnt = $StaffdetailsModel->whereIn('user_id', $_complaint['complaint_against'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
						//staff
						if($staff_cnt > 0){
							$option_self = 'self';
						} else {
							$option_self = 'No';
						}
						//manager
						if($manager_cnt > 0){
							$option_manager = 'manager';
						} else {
							$option_manager = 'No';
						}
						
					if (in_array($usession['sup_user_id'], $notify_upon_submission) || in_array($option_self, $notify_upon_submission) || in_array($option_manager, $notify_upon_submission)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('staff_id',$usession['sup_user_id'])->where('module_key_id',$_complaint['complaint_id'])->where('module_status',0)->countAllResults();
					if($notify_status_cnt < 1) {
						//check status
						if($_complaint['status']==0){
							$edate = set_date_format($_complaint['created_at']);
						}
						$iuser = $UsersModel->where('user_id', $_complaint['complaint_from'])->first();
						if($iuser){
							$ol = $iuser['first_name'].' '.$iuser['last_name'];
						} else {
							$ol = '--';
						}
						$ifield[] = $_complaint['complaint_id'];
						$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_complaint['complaint_from']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-complaint-info/'.uencode($_complaint['complaint_id']).'?value=true&status=0">'.$ol.' posted a new complaint.</a></p>
								<span><small class="text-warning"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-complaint-info/'.uencode($_complaint['complaint_id']).'?value=true&status=0" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>'; 
					}
					} else {
						$get_notify_cnt = array('top_complaint_submission_alert_cnt'=>0, 'top_complaint_submission_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_complaint_submission_alert_cnt'=>$total_notify_cnt, 'top_complaint_submission_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_complaint_submission_alert_cnt'=>0, 'top_complaint_submission_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_complaint_submission_alert_cnt'=>0, 'top_complaint_submission_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}		
	}
}
if( !function_exists('top_level_notify_upon_approval_complaints') ){
	function top_level_notify_upon_approval_complaints($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$ComplaintsModel = new \App\Models\ComplaintsModel();
		
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',1)->where('approval_level',1)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',1)->where('approval_level',1)->findAll();
				foreach($get_data as $_approval):
				$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $ComplaintsModel->where('company_id',$company_id)->where('complaint_id',$_approval['module_key_id'])->first();
					if(in_array($usession['sup_user_id'],explode(',',$get_data['complaint_against']))){
						$staff_cnt = $StaffdetailsModel->whereIn('user_id', $get_data['complaint_against'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					} else {
						$staff_cnt = 0;
					}
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->whereIn('user_id', $get_data['complaint_against'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					if($notify_status_cnt < 1) {
						
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-complaint-info/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' approved the complaint.</a></p>
								<span><small class="text-success"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-complaint-info/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_complaint_approval_alert_cnt'=>0, 'top_complaint_approval_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_complaint_approval_alert_cnt'=>$total_notify_cnt, 'top_complaint_approval_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_complaint_approval_alert_cnt'=>0, 'top_complaint_approval_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_complaint_approval_alert_cnt'=>0, 'top_complaint_approval_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}
	}
}

if( !function_exists('top_level_notify_upon_reject_complaints') ){
	function top_level_notify_upon_reject_complaints($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$ComplaintsModel = new \App\Models\ComplaintsModel();
		
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',2)->where('approval_level',2)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',2)->where('approval_level',2)->findAll();
				foreach($get_data as $_approval):
				$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $ComplaintsModel->where('company_id',$company_id)->where('complaint_id',$_approval['module_key_id'])->first();
					if(in_array($usession['sup_user_id'],explode(',',$get_data['complaint_against']))){
						$staff_cnt = $StaffdetailsModel->whereIn('user_id', $get_data['complaint_against'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					} else {
						$staff_cnt = 0;
					}
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->whereIn('user_id', $get_data['complaint_against'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					if($notify_status_cnt < 1) {
						
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-complaint-info/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' rejected the complaint.</a></p>
								<span><small class="text-	"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-complaint-info/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_complaint_reject_alert_cnt'=>0, 'top_complaint_reject_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_complaint_reject_alert_cnt'=>$total_notify_cnt, 'top_complaint_reject_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_complaint_reject_alert_cnt'=>0, 'top_complaint_reject_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_complaint_reject_alert_cnt'=>0, 'top_complaint_reject_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}
	}
}
if( !function_exists('top_level_notify_upon_submission_leave') ){
	function top_level_notify_upon_submission_leave($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$LeaveModel = new \App\Models\LeaveModel();
		$ConstantsModel = new \App\Models\ConstantsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_submission = explode(',',$notify_level['notify_upon_submission']);
				// check modules data
					// for submission
					$notify_status_cnt = 0;							
					$iget_notify_cnt = $LeaveModel->where('company_id',$company_id)->where('status',1)->countAllResults();
					$get_data = $LeaveModel->where('company_id',$company_id)->where('status',1)->findAll();
					foreach($get_data as $_leave):
					$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_leave['leave_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					endforeach;
					if($iget_notify_cnt > 0){
						$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
						$get_data_info = '';
						$ifield = array();
						foreach($get_data as $_leave):
						// notificaiton for him/herself
						$staff_cnt = $StaffdetailsModel->where('user_id', $_leave['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
						// notificaiton for manager
						$manager_cnt = $StaffdetailsModel->where('user_id', $_leave['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
						//staff
						if($staff_cnt > 0){
							$option_self = 'self';
						} else {
							$option_self = 'No';
						}
						//manager
						if($manager_cnt > 0){
							$option_manager = 'manager';
						} else {
							$option_manager = 'No';
						}
						
					if (in_array($usession['sup_user_id'], $notify_upon_submission) || in_array($option_self, $notify_upon_submission) || in_array($option_manager, $notify_upon_submission)) {
						$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('staff_id',$usession['sup_user_id'])->where('module_key_id',$_leave['leave_id'])->where('module_status',1)->countAllResults();
						if($notify_status_cnt < 1) {
							//check status
							if($_leave['status']==1){
								$edate = set_date_format($_leave['created_at']);
							}
							$iuser = $UsersModel->where('user_id', $_leave['employee_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_leave['leave_id'];
							$get_data_info .= '<div class="cart-item">
								<img src="'.staff_profile_photo($_leave['employee_id']).'" alt="1" class="rounded me-3 border">
								<div class="cart-desc">
									<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-leave-info/'.uencode($_leave['leave_id']).'?value=true&status=0">'.$ol.' applied for a leave.</a></p>
									<span><small class="text-warning"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
									<a href="'.site_url().'erp/view-leave-info/'.uencode($_leave['leave_id']).'?value=true&status=0" 
									class="text-primary float-end btn btn-link btn-sm">View</a>
								</div>
							</div>'; 
						}
						} else {
							$get_notify_cnt = array('top_leave_submission_alert_cnt'=>0, 'top_leave_submission_alert_data' => 0,'key_id' => 0);
							return $get_notify_cnt;
						}
						endforeach;
					$get_notify_cnt = array('top_leave_submission_alert_cnt'=>$total_notify_cnt, 'top_leave_submission_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_leave_submission_alert_cnt'=>0, 'top_leave_submission_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_leave_submission_alert_cnt'=>0, 'top_leave_submission_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}
		
		
	}
}
if( !function_exists('top_level_notify_upon_approval_leave') ){
	function top_level_notify_upon_approval_leave($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$LeaveModel = new \App\Models\LeaveModel();
		$ConstantsModel = new \App\Models\ConstantsModel();
		$StaffapprovalsModel  = new \App\Models\StaffapprovalsModel ();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',2)->where('approval_level',1)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',2)->where('approval_level',1)->findAll();
				foreach($get_data as $_approval):
				$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',2)->countAllResults();
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $LeaveModel->where('company_id',$company_id)->where('leave_id',$_approval['module_key_id'])->first();
					$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',2)->countAllResults();
					if($notify_status_cnt < 1) {
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-leave-info/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' approved the leave request.</a></p>
								<span><small class="text-success"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-leave-info/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_leave_approval_alert_cnt'=>0, 'top_leave_approval_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_leave_approval_alert_cnt'=>$total_notify_cnt, 'top_leave_approval_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_leave_approval_alert_cnt'=>0, 'top_leave_approval_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_leave_approval_alert_cnt'=>0, 'top_leave_approval_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}		
	}
}

if( !function_exists('top_level_notify_upon_reject_leave') ){
	function top_level_notify_upon_reject_leave($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$LeaveModel = new \App\Models\LeaveModel();
		$ConstantsModel = new \App\Models\ConstantsModel();
		$StaffapprovalsModel  = new \App\Models\StaffapprovalsModel ();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',2)->where('approval_level',2)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',2)->where('approval_level',2)->findAll();
				foreach($get_data as $_approval):
				$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',2)->countAllResults();
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $LeaveModel->where('company_id',$company_id)->where('leave_id',$_approval['module_key_id'])->first();
					$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',2)->countAllResults();
					if($notify_status_cnt < 1) {
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-leave-info/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' rejected the leave request.</a></p>
								<span><small class="text-danger"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-leave-info/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_leave_reject_alert_cnt'=>0, 'top_leave_reject_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_leave_reject_alert_cnt'=>$total_notify_cnt, 'top_leave_reject_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_leave_reject_alert_cnt'=>0, 'top_leave_reject_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_leave_reject_alert_cnt'=>0, 'top_leave_reject_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}		
	}
}
if( !function_exists('top_level_notify_upon_submission_leave_adjust') ){
	function top_level_notify_upon_submission_leave_adjust($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$LeaveadjustModel = new \App\Models\LeaveadjustModel();
		$ConstantsModel = new \App\Models\ConstantsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_submission = explode(',',$notify_level['notify_upon_submission']);
				// check modules data
					// for submission
					$notify_status_cnt = 0;
					$iget_notify_cnt = $LeaveadjustModel->where('company_id',$company_id)->where('status',0)->countAllResults();
					$get_data = $LeaveadjustModel->where('company_id',$company_id)->where('status',0)->orderBy('adjustment_id', 'ASC')->findAll();
					foreach($get_data as $_adjust):
					$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_adjust['adjustment_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->countAllResults();
					endforeach;
					if($iget_notify_cnt > 0){
						$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
						$get_data_info = '';
						$ifield = array();
						foreach($get_data as $_adjust):
						// notificaiton for him/herself
						$staff_cnt = $StaffdetailsModel->where('user_id', $_adjust['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
						// notificaiton for manager
						$manager_cnt = $StaffdetailsModel->where('user_id', $_adjust['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
						//staff
						if($staff_cnt > 0){
							$option_self = 'self';
						} else {
							$option_self = 'No';
						}
						//manager
						if($manager_cnt > 0){
							$option_manager = 'manager';
						} else {
							$option_manager = 'No';
						}
						
					if (in_array($usession['sup_user_id'], $notify_upon_submission) || in_array($option_self, $notify_upon_submission) || in_array($option_manager, $notify_upon_submission)) {
						$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('staff_id',$usession['sup_user_id'])->where('module_key_id',$_adjust['adjustment_id'])->where('module_status',0)->countAllResults();
						if($notify_status_cnt < 1) {
							//check status
							if($_adjust['status']==0){
								$edate = '<span class="text-warning">'.set_date_format($_adjust['created_at']).'</span>';
							}
							$iuser = $UsersModel->where('user_id', $_adjust['employee_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_adjust['adjustment_id'];
							$get_data_info .= '<div class="cart-item">
								<img src="'.staff_profile_photo($_adjust['employee_id']).'" alt="1" class="rounded me-3 border">
								<div class="cart-desc">
									<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-leave-adjustment/'.uencode($_adjust['adjustment_id']).'?value=true&status=0">'.$ol.' applied for a leave adjustment.</a></p>
									<span><small class="text-warning"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
									<a href="'.site_url().'erp/view-leave-adjustment/'.uencode($_adjust['adjustment_id']).'?value=true&status=0" 
									class="text-primary float-end btn btn-link btn-sm">View</a>
								</div>
							</div>'; 
						}
						} else {
							$get_notify_cnt = array('top_leave_adjust_submission_alert_cnt'=>0, 'top_leave_adjust_submission_alert_data' => 0,'key_id' => 0);
							return $get_notify_cnt;
						}
						endforeach;
					$get_notify_cnt = array('top_leave_adjust_submission_alert_cnt'=>$total_notify_cnt, 'top_leave_adjust_submission_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_leave_adjust_submission_alert_cnt'=>0, 'top_leave_adjust_submission_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_leave_adjust_submission_alert_cnt'=>0, 'top_leave_adjust_submission_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}		
	}
}
if( !function_exists('top_level_notify_upon_approval_leave_adjust') ){
	function top_level_notify_upon_approval_leave_adjust($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$LeaveadjustModel = new \App\Models\LeaveadjustModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',1)->where('approval_level',1)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',1)->where('approval_level',1)->findAll();
				foreach($get_data as $_approval):
				$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $LeaveadjustModel->where('company_id',$company_id)->where('adjustment_id',$_approval['module_key_id'])->first();
					$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					if($notify_status_cnt < 1) {
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-leave-adjustment/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' approved the leave adjustment request.</a></p>
								<span><small class="text-success"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-leave-adjustment/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_leave_adjust_approval_alert_cnt'=>0, 'top_leave_adjust_approval_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_leave_adjust_approval_alert_cnt'=>$total_notify_cnt, 'top_leave_adjust_approval_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_leave_adjust_approval_alert_cnt'=>0, 'top_leave_adjust_approval_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_leave_adjust_approval_alert_cnt'=>0, 'top_leave_adjust_approval_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}
	}
}


if( !function_exists('top_level_notify_upon_reject_leave_adjust') ){
	function top_level_notify_upon_reject_leave_adjust($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$LeaveadjustModel = new \App\Models\LeaveadjustModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',2)->where('approval_level',2)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',2)->where('approval_level',2)->findAll();
				foreach($get_data as $_approval):
				$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $LeaveadjustModel->where('company_id',$company_id)->where('adjustment_id',$_approval['module_key_id'])->first();
					$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					if($notify_status_cnt < 1) {
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-leave-adjustment/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' rejected the leave adjustment request.</a></p>
								<span><small class="text-danger"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-leave-adjustment/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_leave_adjust_reject_alert_cnt'=>0, 'top_leave_adjust_reject_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_leave_adjust_reject_alert_cnt'=>$total_notify_cnt, 'top_leave_adjust_reject_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_leave_adjust_reject_alert_cnt'=>0, 'top_leave_adjust_reject_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_leave_adjust_reject_alert_cnt'=>0, 'top_leave_adjust_reject_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}
	}
}
if( !function_exists('top_level_notify_upon_submission_travel') ){
	function top_level_notify_upon_submission_travel($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$TravelModel = new \App\Models\TravelModel();
		$ConstantsModel = new \App\Models\ConstantsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_submission = explode(',',$notify_level['notify_upon_submission']);
				// check modules data
					// for submission
					$notify_status_cnt = 0;
					$iget_notify_cnt = $TravelModel->where('company_id',$company_id)->where('status',0)->countAllResults();
					$get_data = $TravelModel->where('company_id',$company_id)->where('status',0)->orderBy('travel_id', 'ASC')->findAll();
					foreach($get_data as $_travel):
					$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_travel['travel_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->countAllResults();
					endforeach;
					if($iget_notify_cnt > 0){
						$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
						$get_data_info = '';
						$ifield = array();
						foreach($get_data as $_travel):
						// notificaiton for him/herself
						$staff_cnt = $StaffdetailsModel->where('user_id', $_travel['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
						// notificaiton for manager
						$manager_cnt = $StaffdetailsModel->where('user_id', $_travel['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
						//staff
						if($staff_cnt > 0){
							$option_self = 'self';
						} else {
							$option_self = 'No';
						}
						//manager
						if($manager_cnt > 0){
							$option_manager = 'manager';
						} else {
							$option_manager = 'No';
						}
						
					if (in_array($usession['sup_user_id'], $notify_upon_submission) || in_array($option_self, $notify_upon_submission) || in_array($option_manager, $notify_upon_submission)) {
						$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('staff_id',$usession['sup_user_id'])->where('module_key_id',$_travel['travel_id'])->where('module_status',0)->countAllResults();
						if($notify_status_cnt < 1) {
							//check status
							if($_travel['status']==0){
								$edate = '<span class="text-warning">'.set_date_format($_travel['created_at']).'</span>';
							}
							$iuser = $UsersModel->where('user_id', $_travel['employee_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_travel['travel_id'];
							$get_data_info .= '<div class="cart-item">
								<img src="'.staff_profile_photo($_travel['employee_id']).'" alt="1" class="rounded me-3 border">
								<div class="cart-desc">
									<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-travel-info/'.uencode($_travel['travel_id']).'?value=true&status=0">'.$ol.' sent request for travel</a></p>
									<span><small class="text-warning"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
									<a href="'.site_url().'erp/view-travel-info/'.uencode($_travel['travel_id']).'?value=true&status=0" 
									class="text-primary float-end btn btn-link btn-sm">View</a>
								</div>
							</div>';
						}
						} else {
							$get_notify_cnt = array('top_travel_submission_alert_cnt'=>0, 'top_travel_submission_alert_data' => 0,'key_id' => 0);
							return $get_notify_cnt;
						}
						endforeach;
					$get_notify_cnt = array('top_travel_submission_alert_cnt'=>$total_notify_cnt, 'top_travel_submission_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_travel_submission_alert_cnt'=>0, 'top_travel_submission_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_travel_submission_alert_cnt'=>0, 'top_travel_submission_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}		
	}
}
if( !function_exists('top_level_notify_upon_approval_travel') ){
	function top_level_notify_upon_approval_travel($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$TravelModel = new \App\Models\TravelModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',1)->where('approval_level',1)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',1)->where('approval_level',1)->findAll();
				foreach($get_data as $_approval):
				$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $TravelModel->where('company_id',$company_id)->where('travel_id',$_approval['module_key_id'])->first();
					$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					if($notify_status_cnt < 1) {
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-travel-info/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' approved the travel request.</a></p>
								<span><small class="text-success"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-travel-info/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_travel_approval_alert_cnt'=>0, 'top_travel_approval_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_travel_approval_alert_cnt'=>$total_notify_cnt, 'top_travel_approval_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_travel_approval_alert_cnt'=>0, 'top_travel_approval_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_travel_approval_alert_cnt'=>0, 'top_travel_approval_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}
		
		
	}
}
if( !function_exists('top_level_notify_upon_reject_travel') ){
	function top_level_notify_upon_reject_travel($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$TravelModel = new \App\Models\TravelModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',2)->where('approval_level',2)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',2)->where('approval_level',2)->findAll();
				foreach($get_data as $_approval):
				$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $TravelModel->where('company_id',$company_id)->where('travel_id',$_approval['module_key_id'])->first();
					$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					if($notify_status_cnt < 1) {
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-travel-info/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' rejected the travel request.</a></p>
								<span><small class="text-danger"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-travel-info/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_travel_reject_alert_cnt'=>0, 'top_travel_reject_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_travel_reject_alert_cnt'=>$total_notify_cnt, 'top_travel_reject_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_travel_reject_alert_cnt'=>0, 'top_travel_reject_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_travel_reject_alert_cnt'=>0, 'top_travel_reject_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}
		
		
	}
}
if( !function_exists('top_level_notify_upon_submission_overtime') ){
	function top_level_notify_upon_submission_overtime($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$OvertimerequestModel = new \App\Models\OvertimerequestModel();
		$ConstantsModel = new \App\Models\ConstantsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_submission = explode(',',$notify_level['notify_upon_submission']);
				// check modules data
					// for submission
					$notify_status_cnt = 0;
					$iget_notify_cnt = $OvertimerequestModel->where('company_id',$company_id)->where('is_approved',0)->countAllResults();
					$get_data = $OvertimerequestModel->where('company_id',$company_id)->where('is_approved',0)->orderBy('time_request_id', 'ASC')->findAll();
					foreach($get_data as $_overtime):
					$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_overtime['time_request_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->countAllResults();
					endforeach;
					if($iget_notify_cnt > 0){
						$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
						$get_data_info = '';
						$ifield = array();
						foreach($get_data as $_overtime):
						// notificaiton for him/herself
						$staff_cnt = $StaffdetailsModel->where('user_id', $_overtime['staff_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
						// notificaiton for manager
						$manager_cnt = $StaffdetailsModel->where('user_id', $_overtime['staff_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
						//staff
						if($staff_cnt > 0){
							$option_self = 'self';
						} else {
							$option_self = 'No';
						}
						//manager
						if($manager_cnt > 0){
							$option_manager = 'manager';
						} else {
							$option_manager = 'No';
						}
						
					if (in_array($usession['sup_user_id'], $notify_upon_submission) || in_array($option_self, $notify_upon_submission) || in_array($option_manager, $notify_upon_submission)) {
						$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('staff_id',$usession['sup_user_id'])->where('module_key_id',$_overtime['time_request_id'])->where('module_status',0)->countAllResults();
						if($notify_status_cnt < 1) {
							//check status
							if($_overtime['is_approved']==0){
								$edate = set_date_format($_overtime['created_at']);
							}
							$iuser = $UsersModel->where('user_id', $_overtime['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_overtime['time_request_id'];
							$get_data_info .= '<div class="cart-item">
								<img src="'.staff_profile_photo($_overtime['staff_id']).'" alt="1" class="rounded me-3 border">
								<div class="cart-desc">
									<p class="mb-0">
									<a class="text-body" href="'.site_url().'erp/view-overtime-info/'.uencode($_overtime['time_request_id']).'?value=true&status=0">'.$ol.' sent request for overtime</a></p>
									<span><small class="text-warning"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
									<a href="'.site_url().'erp/view-overtime-info/'.uencode($_overtime['time_request_id']).'?value=true&status=0" 
									class="text-primary float-end btn btn-link btn-sm">View</a>
								</div>
							</div>';
						}
						} else {
							$get_notify_cnt = array('top_overtime_submission_alert_cnt'=>0, 'top_overtime_submission_alert_data' => 0,'key_id' => 0);
							return $get_notify_cnt;
						}
						endforeach;
					$get_notify_cnt = array('top_overtime_submission_alert_cnt'=>$total_notify_cnt, 'top_overtime_submission_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_overtime_submission_alert_cnt'=>0, 'top_overtime_submission_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_overtime_submission_alert_cnt'=>0, 'top_overtime_submission_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}		
	}
}
if( !function_exists('top_level_notify_upon_approval_overtime') ){
	function top_level_notify_upon_approval_overtime($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$OvertimerequestModel = new \App\Models\OvertimerequestModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',1)->where('approval_level',1)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',1)->where('approval_level',1)->findAll();
				foreach($get_data as $_approval):
				$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $OvertimerequestModel->where('company_id',$company_id)->where('time_request_id',$_approval['module_key_id'])->first();
					$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['staff_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['staff_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					if($notify_status_cnt < 1) {
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-overtime-info/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' approved the overtime request.</a></p>
								<span><small class="text-success"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-overtime-info/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_overtime_approval_alert_cnt'=>0, 'top_overtime_approval_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_overtime_approval_alert_cnt'=>$total_notify_cnt, 'top_overtime_approval_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_overtime_approval_alert_cnt'=>0, 'top_overtime_approval_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_overtime_approval_alert_cnt'=>0, 'top_overtime_approval_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}		
	}
}
if( !function_exists('top_level_notify_upon_reject_overtime') ){
	function top_level_notify_upon_reject_overtime($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$OvertimerequestModel = new \App\Models\OvertimerequestModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',2)->where('approval_level',2)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',2)->where('approval_level',2)->findAll();
				foreach($get_data as $_approval):
				$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $OvertimerequestModel->where('company_id',$company_id)->where('time_request_id',$_approval['module_key_id'])->first();
					$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['staff_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['staff_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					if($notify_status_cnt < 1) {
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-overtime-info/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' rejected the overtime request.</a></p>
								<span><small class="text-danger"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-overtime-info/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_overtime_reject_alert_cnt'=>0, 'top_overtime_reject_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_overtime_reject_alert_cnt'=>$total_notify_cnt, 'top_overtime_reject_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_overtime_reject_alert_cnt'=>0, 'top_overtime_reject_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_overtime_reject_alert_cnt'=>0, 'top_overtime_reject_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}		
	}
}
if( !function_exists('top_level_notify_upon_submission_incident') ){
	function top_level_notify_upon_submission_incident($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$IncidentsModel = new \App\Models\IncidentsModel();
		$ConstantsModel = new \App\Models\ConstantsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_submission = explode(',',$notify_level['notify_upon_submission']);
				// check modules data
				//if (in_array($usession['sup_user_id'], $notify_upon_submission)) {
					// for submission
					$notify_status_cnt = 0;
					$iget_notify_cnt = $IncidentsModel->where('company_id',$company_id)->where('status',0)->countAllResults();
					$get_data = $IncidentsModel->where('company_id',$company_id)->where('status',0)->orderBy('incident_id', 'ASC')->findAll();
					foreach($get_data as $_incident):
					$notify_status_cnt += $NotificationstatusModel->where('module_option','incident_settings')->where('module_key_id',$_incident['incident_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->countAllResults();
					endforeach;
					if($iget_notify_cnt > 0){
						$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
						$get_data_info = '';
						$ifield = array();
						foreach($get_data as $_incident):
							// notificaiton for him/herself
							$staff_cnt = $StaffdetailsModel->where('user_id', $_incident['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
							// notificaiton for manager
							$manager_cnt = $StaffdetailsModel->where('user_id', $_incident['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
							//staff
							if($staff_cnt > 0){
								$option_self = 'self';
							} else {
								$option_self = 'No';
							}
							//manager
							if($manager_cnt > 0){
								$option_manager = 'manager';
							} else {
								$option_manager = 'No';
							}
							
						if (in_array($usession['sup_user_id'], $notify_upon_submission) || in_array($option_self, $notify_upon_submission) || in_array($option_manager, $notify_upon_submission)) {
							$notify_status_cnt = $NotificationstatusModel->where('module_option','incident_settings')->where('staff_id',$usession['sup_user_id'])->where('module_key_id',$_incident['incident_id'])->where('module_status',0)->countAllResults();
							if($notify_status_cnt < 1) {
								//check status
								if($_incident['status']==0){
									$edate = set_date_format($_incident['created_at']);
								}
								$iuser = $UsersModel->where('user_id', $_incident['employee_id'])->first();
								if($iuser){
									$ol = $iuser['first_name'].' '.$iuser['last_name'];
								} else {
									$ol = '--';
								}
								$ifield[] = $_incident['incident_id'];
								$get_data_info .= '<div class="cart-item">
									<img src="'.staff_profile_photo($_incident['employee_id']).'" alt="1" class="rounded me-3 border">
									<div class="cart-desc">
										<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-incident-info/'.uencode($_incident['incident_id']).'?value=true&status=0">'.$ol.' added incident information</a></p>
										<span><small class="text-warning"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
										<a href="'.site_url().'erp/view-incident-info/'.uencode($_incident['incident_id']).'?value=true&status=0" 
										class="text-primary float-end btn btn-link btn-sm">View</a>
									</div>
								</div>';
							}
						} else {
							$get_notify_cnt = array('top_incident_submission_alert_cnt'=>0, 'top_incident_submission_alert_data' => 0, 'key_id'=>0);
							return $get_notify_cnt;
						}
						endforeach;
					$get_notify_cnt = array('top_incident_submission_alert_cnt'=>$total_notify_cnt, 'top_incident_submission_alert_data' => $get_data_info, 'key_id'=>$ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_incident_submission_alert_cnt'=>0, 'top_incident_submission_alert_data' => 0, 'key_id'=>0);
					return $get_notify_cnt;
				}
		} else {
			$get_notify_cnt = array('top_incident_submission_alert_cnt'=>0, 'top_incident_submission_alert_data' => 0, 'key_id'=>0);
			return $get_notify_cnt;
		}
		
	}
}
if( !function_exists('top_level_notify_upon_approval_incident') ){
	function top_level_notify_upon_approval_incident($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$IncidentsModel = new \App\Models\IncidentsModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option','incident_settings')->where('status',1)->where('approval_level',1)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option','incident_settings')->where('status',1)->where('approval_level',1)->findAll();
				foreach($get_data as $_approval):
					if($_approval['approval_level']==1){
				$notify_status_cnt += $NotificationstatusModel->where('module_option','incident_settings')->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					}
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
						// notificaiton for him/herself
						$get_data = $IncidentsModel->where('company_id',$company_id)->where('incident_id',$_approval['module_key_id'])->first();
						$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
						// notificaiton for manager
						$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
						//staff
						if($staff_cnt > 0){
							$option_self = 'self';
						} else {
							$option_self = 'No';
						}
						//manager
						if($manager_cnt > 0){
							$option_manager = 'manager';
						} else {
							$option_manager = 'No';
						}
						
					if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
						$notify_status_cnt = $NotificationstatusModel->where('module_option','incident_settings')->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
						if($notify_status_cnt < 1) {
							// check approval
							//more info
							$edate = set_date_format($_approval['updated_at']);
							$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
								if($iuser){
									$ol = $iuser['first_name'].' '.$iuser['last_name'];
								} else {
									$ol = '--';
								}
								$ifield[] = $_approval['module_key_id'];
								$get_data_info .= '<div class="cart-item">
								<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
								<div class="cart-desc">
									<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-incident-info/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' approved the incident request.</a></p>
									<span><small class="text-success"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
									<a href="'.site_url().'erp/view-incident-info/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
									class="text-primary float-end btn btn-link btn-sm">View</a>
								</div>
							</div>';
						}
						} else {
							$get_notify_cnt = array('top_incident_approval_alert_cnt'=>0, 'top_incident_approval_alert_data' => 0,'key_id'=>0);
							return $get_notify_cnt;
						}
					endforeach;
					
					$get_notify_cnt = array('top_incident_approval_alert_cnt'=>$total_notify_cnt, 'top_incident_approval_alert_data' => $get_data_info, 'key_id'=>$ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_incident_approval_alert_cnt'=>0, 'top_incident_approval_alert_data' => 0,'key_id'=>0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_incident_approval_alert_cnt'=>0, 'top_incident_approval_alert_data' => 0,'key_id'=>0);
				return $get_notify_cnt;
			}		
	}
}
if( !function_exists('top_level_notify_upon_reject_incident') ){
	function top_level_notify_upon_reject_incident($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$IncidentsModel = new \App\Models\IncidentsModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option','incident_settings')->where('status',2)->where('approval_level',2)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option','incident_settings')->where('status',2)->where('approval_level',2)->findAll();
				foreach($get_data as $_approval):
					if($_approval['approval_level']==1){
				$notify_status_cnt += $NotificationstatusModel->where('module_option','incident_settings')->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					}
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
						// notificaiton for him/herself
						$get_data = $IncidentsModel->where('company_id',$company_id)->where('incident_id',$_approval['module_key_id'])->first();
						$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
						// notificaiton for manager
						$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
						//staff
						if($staff_cnt > 0){
							$option_self = 'self';
						} else {
							$option_self = 'No';
						}
						//manager
						if($manager_cnt > 0){
							$option_manager = 'manager';
						} else {
							$option_manager = 'No';
						}
						
					if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
						$notify_status_cnt = $NotificationstatusModel->where('module_option','incident_settings')->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
						if($notify_status_cnt < 1) {
							// check approval
							//more info
							$edate = set_date_format($_approval['updated_at']);
							$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
								if($iuser){
									$ol = $iuser['first_name'].' '.$iuser['last_name'];
								} else {
									$ol = '--';
								}
								$ifield[] = $_approval['module_key_id'];
								$get_data_info .= '<div class="cart-item">
								<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
								<div class="cart-desc">
									<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-incident-info/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' rejected the incident request.</a></p>
									<span><small class="text-danger"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
									<a href="'.site_url().'erp/view-incident-info/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
									class="text-primary float-end btn btn-link btn-sm">View</a>
								</div>
							</div>';
						}
						} else {
							$get_notify_cnt = array('top_incident_reject_alert_cnt'=>0, 'top_incident_reject_alert_data' => 0,'key_id'=>0);
							return $get_notify_cnt;
						}
					endforeach;
					
					$get_notify_cnt = array('top_incident_reject_alert_cnt'=>$total_notify_cnt, 'top_incident_reject_alert_data' => $get_data_info, 'key_id'=>$ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_incident_reject_alert_cnt'=>0, 'top_incident_reject_alert_data' => 0,'key_id'=>0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_incident_reject_alert_cnt'=>0, 'top_incident_reject_alert_data' => 0,'key_id'=>0);
				return $get_notify_cnt;
			}		
	}
}
if( !function_exists('top_level_notify_upon_submission_transfer') ){
	function top_level_notify_upon_submission_transfer($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$TransfersModel = new \App\Models\TransfersModel();
		$ConstantsModel = new \App\Models\ConstantsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_submission = explode(',',$notify_level['notify_upon_submission']);
				// check modules data
			//	if (in_array($usession['sup_user_id'], $notify_upon_submission)) {
					// for submission
					$notify_status_cnt = 0;
					$iget_notify_cnt = $TransfersModel->where('company_id',$company_id)->where('status',0)->countAllResults();
					$get_data = $TransfersModel->where('company_id',$company_id)->where('status',0)->orderBy('transfer_id', 'ASC')->findAll();
					foreach($get_data as $_transfer):
					$notify_status_cnt += $NotificationstatusModel->where('module_option','transfer_settings')->where('module_key_id',$_transfer['transfer_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->countAllResults();
					endforeach;
					if($iget_notify_cnt > 0){
						$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
						$get_data_info = '';
						$ifield = array();
						foreach($get_data as $_transfer):
							// notificaiton for him/herself
							$staff_cnt = $StaffdetailsModel->where('user_id', $_transfer['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
							// notificaiton for manager
							$manager_cnt = $StaffdetailsModel->where('user_id', $_transfer['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
							//staff
							if($staff_cnt > 0){
								$option_self = 'self';
							} else {
								$option_self = 'No';
							}
							//manager
							if($manager_cnt > 0){
								$option_manager = 'manager';
							} else {
								$option_manager = 'No';
							}
							
						if (in_array($usession['sup_user_id'], $notify_upon_submission) || in_array($option_self, $notify_upon_submission) || in_array($option_manager, $notify_upon_submission)) {
							$notify_status_cnt = $NotificationstatusModel->where('module_option','transfer_settings')->where('staff_id',$usession['sup_user_id'])->where('module_key_id',$_transfer['transfer_id'])->where('module_status',0)->countAllResults();
							if($notify_status_cnt < 1) {
								//check status
								if($_transfer['status']==0){
									$check_status = 'Transfer Information submitted';
									$edate = '<span class="text-warning">'.set_date_format($_transfer['created_at']).'</span>';
								}
								$iuser = $UsersModel->where('user_id', $_transfer['added_by'])->first();
								if($iuser){
									$ol = $iuser['first_name'].' '.$iuser['last_name'];
								} else {
									$ol = '--';
								}
								$ifield[] = $_transfer['transfer_id'];
								$get_data_info .= '<div class="cart-item">
									<img src="'.staff_profile_photo($_transfer['added_by']).'" alt="1" class="rounded me-3 border">
									<div class="cart-desc">
										<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-transfer-info/'.uencode($_transfer['transfer_id']).'?value=true&status=0">'.$ol.' submitted transfers information</a></p>
										<span><small class="text-warning"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
										<a href="'.site_url().'erp/view-transfer-info/'.uencode($_transfer['transfer_id']).'?value=true&status=0" 
										class="text-primary float-end btn btn-link btn-sm">View</a>
									</div>
								</div>';
							}
						} else {
							$get_notify_cnt = array('top_transfer_submission_alert_cnt'=>0, 'top_transfer_submission_alert_data' => 0,'key_id' => 0);
							return $get_notify_cnt;
						}
						endforeach;
					$get_notify_cnt = array('top_transfer_submission_alert_cnt'=>$total_notify_cnt, 'top_transfer_submission_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_transfer_submission_alert_cnt'=>0, 'top_transfer_submission_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_transfer_submission_alert_cnt'=>0, 'top_transfer_submission_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}
		
		
	}
}
if( !function_exists('top_level_notify_upon_approval_transfer') ){
	function top_level_notify_upon_approval_transfer($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$TransfersModel = new \App\Models\TransfersModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option','transfer_settings')->where('status',1)->where('approval_level',1)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option','transfer_settings')->where('status',1)->where('approval_level',1)->findAll();
				foreach($get_data as $_approval):
				$notify_status_cnt += $NotificationstatusModel->where('module_option','transfer_settings')->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $TransfersModel->where('company_id',$company_id)->where('transfer_id',$_approval['module_key_id'])->first();
					$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option','transfer_settings')->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					if($notify_status_cnt < 1) {
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-transfer-info/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' approved the transfer request.</a></p>
								<span><small class="text-success"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-transfer-info/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_transfer_approval_alert_cnt'=>0, 'top_transfer_approval_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_transfer_approval_alert_cnt'=>$total_notify_cnt, 'top_transfer_approval_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_transfer_approval_alert_cnt'=>0, 'top_transfer_approval_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_transfer_approval_alert_cnt'=>0, 'top_transfer_approval_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}
	}
}
if( !function_exists('top_level_notify_upon_reject_transfer') ){
	function top_level_notify_upon_reject_transfer($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$TransfersModel = new \App\Models\TransfersModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option','transfer_settings')->where('status',2)->where('approval_level',2)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option','transfer_settings')->where('status',2)->where('approval_level',2)->findAll();
				foreach($get_data as $_approval):
				$notify_status_cnt += $NotificationstatusModel->where('module_option','transfer_settings')->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $TransfersModel->where('company_id',$company_id)->where('transfer_id',$_approval['module_key_id'])->first();
					$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option','transfer_settings')->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					if($notify_status_cnt < 1) {
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-transfer-info/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' rejected the transfer request.</a></p>
								<span><small class="text-danger"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-transfer-info/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_transfer_reject_alert_cnt'=>0, 'top_transfer_reject_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_transfer_reject_alert_cnt'=>$total_notify_cnt, 'top_transfer_reject_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_transfer_reject_alert_cnt'=>0, 'top_transfer_reject_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_transfer_reject_alert_cnt'=>0, 'top_transfer_reject_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}
	}
}
if( !function_exists('top_level_notify_upon_submission_resignation') ){
	function top_level_notify_upon_submission_resignation($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$ResignationsModel = new \App\Models\ResignationsModel();
		$ConstantsModel = new \App\Models\ConstantsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_submission = explode(',',$notify_level['notify_upon_submission']);
				// check modules data
					// for submission
					$notify_status_cnt = 0;
					$iget_notify_cnt = $ResignationsModel->where('company_id',$company_id)->where('status',0)->countAllResults();
					$get_data = $ResignationsModel->where('company_id',$company_id)->where('status',0)->orderBy('resignation_id', 'ASC')->findAll();
					foreach($get_data as $_resignation):
					$notify_status_cnt += $NotificationstatusModel->where('module_option','resignation_settings')->where('module_key_id',$_resignation['resignation_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->countAllResults();
					endforeach;
					if($iget_notify_cnt > 0){
						$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
						$get_data_info = '';
						$ifield = array();
						foreach($get_data as $_resignation):
						// notificaiton for him/herself
						$staff_cnt = $StaffdetailsModel->where('user_id', $_resignation['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
						// notificaiton for manager
						$manager_cnt = $StaffdetailsModel->where('user_id', $_resignation['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
						//staff
						if($staff_cnt > 0){
							$option_self = 'self';
						} else {
							$option_self = 'No';
						}
						//manager
						if($manager_cnt > 0){
							$option_manager = 'manager';
						} else {
							$option_manager = 'No';
						}
						
					if (in_array($usession['sup_user_id'], $notify_upon_submission) || in_array($option_self, $notify_upon_submission) || in_array($option_manager, $notify_upon_submission)) {
						$notify_status_cnt = $NotificationstatusModel->where('module_option','resignation_settings')->where('staff_id',$usession['sup_user_id'])->where('module_key_id',$_resignation['resignation_id'])->where('module_status',0)->countAllResults();
						if($notify_status_cnt < 1) {
							//check status
							if($_resignation['status']==0){
								$edate = set_date_format($_resignation['created_at']);
							}
							$iuser = $UsersModel->where('user_id', $_resignation['employee_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_resignation['resignation_id'];
							$get_data_info .= '<div class="cart-item">
								<img src="'.staff_profile_photo($_resignation['employee_id']).'" alt="1" class="rounded me-3 border">
								<div class="cart-desc">
									<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-resignation-info/'.uencode($_resignation['resignation_id']).'?value=true&status=0">'.$ol.' submitted a resignation request</a></p>
									<span><small class="text-warning"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
									<a href="'.site_url().'erp/view-resignation-info/'.uencode($_resignation['resignation_id']).'?value=true&status=0" 
									class="text-primary float-end btn btn-link btn-sm">View</a>
								</div>
							</div>';
						}
						} else {
							$get_notify_cnt = array('top_resignation_submission_alert_cnt'=>0, 'top_resignation_submission_alert_data' => 0,'key_id' => 0);
							return $get_notify_cnt;
						}
						endforeach;
					$get_notify_cnt = array('top_resignation_submission_alert_cnt'=>$total_notify_cnt,'top_resignation_submission_alert_data' => $get_data_info,'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_resignation_submission_alert_cnt'=>0, 'top_resignation_submission_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_resignation_submission_alert_cnt'=>0, 'top_resignation_submission_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}		
	}
}
if( !function_exists('top_level_notify_upon_approval_resignation') ){
	function top_level_notify_upon_approval_resignation($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$ResignationsModel = new \App\Models\ResignationsModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',1)->where('approval_level',1)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',1)->where('approval_level',1)->findAll();
				foreach($get_data as $_approval):
				$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $ResignationsModel->where('company_id',$company_id)->where('resignation_id',$_approval['module_key_id'])->first();
					$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					if($notify_status_cnt < 1) {
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-resignation-info/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' approved the resignation request.</a></p>
								<span><small class="text-success"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-resignation-info/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_resignation_approval_alert_cnt'=>0, 'top_resignation_approval_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_resignation_approval_alert_cnt'=>$total_notify_cnt,'top_resignation_approval_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_resignation_approval_alert_cnt'=>0, 'top_resignation_approval_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_resignation_approval_alert_cnt'=>0, 'top_resignation_approval_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}
	}
}
if( !function_exists('top_level_notify_upon_reject_resignation') ){
	function top_level_notify_upon_reject_resignation($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$ResignationsModel = new \App\Models\ResignationsModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',2)->where('approval_level',2)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option',$module_option)->where('status',2)->where('approval_level',2)->findAll();
				foreach($get_data as $_approval):
				$notify_status_cnt += $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $ResignationsModel->where('company_id',$company_id)->where('resignation_id',$_approval['module_key_id'])->first();
					$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_option)->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					if($notify_status_cnt < 1) {
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-resignation-info/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' rejected the resignation request.</a></p>
								<span><small class="text-danger"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-resignation-info/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_resignation_reject_alert_cnt'=>0, 'top_resignation_reject_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_resignation_reject_alert_cnt'=>$total_notify_cnt,'top_resignation_reject_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_resignation_reject_alert_cnt'=>0, 'top_resignation_reject_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_resignation_reject_alert_cnt'=>0, 'top_resignation_reject_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}
	}
}
if( !function_exists('top_level_notify_upon_submission_attendance') ){
	function top_level_notify_upon_submission_attendance($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$TimesheetModel = new \App\Models\TimesheetModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_submission = explode(',',$notify_level['notify_upon_submission']);
				// check modules data
					// for submission
					$notify_status_cnt = 0;
					$iget_notify_cnt = $TimesheetModel->where('company_id',$company_id)->where('status','Pending')->countAllResults();
					$get_data = $TimesheetModel->where('company_id',$company_id)->where('status','Pending')->orderBy('time_attendance_id', 'ASC')->findAll();
					foreach($get_data as $_attendance):
					$notify_status_cnt += $NotificationstatusModel->where('module_option','attendance_settings')->where('module_key_id',$_attendance['time_attendance_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->countAllResults();
					endforeach;
					if($iget_notify_cnt > 0){
						$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
						$get_data_info = '';
						$ifield = array();
						foreach($get_data as $_attendance):
						// notificaiton for him/herself
						$staff_cnt = $StaffdetailsModel->where('user_id', $_attendance['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
						// notificaiton for manager
						$manager_cnt = $StaffdetailsModel->where('user_id', $_attendance['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
						//staff
						if($staff_cnt > 0){
							$option_self = 'self';
						} else {
							$option_self = 'No';
						}
						//manager
						if($manager_cnt > 0){
							$option_manager = 'manager';
						} else {
							$option_manager = 'No';
						}
						
					if (in_array($usession['sup_user_id'], $notify_upon_submission) || in_array($option_self, $notify_upon_submission) || in_array($option_manager, $notify_upon_submission)) {
						$notify_status_cnt = $NotificationstatusModel->where('module_option','attendance_settings')->where('staff_id',$usession['sup_user_id'])->where('module_key_id',$_attendance['time_attendance_id'])->where('module_status',0)->countAllResults();
						if($notify_status_cnt < 1) {
							//
							$edate = set_date_format($_attendance['attendance_date']);
							$iuser = $UsersModel->where('user_id', $_attendance['employee_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_attendance['time_attendance_id'];
							$get_data_info .= '<div class="cart-item">
								<img src="'.staff_profile_photo($_attendance['employee_id']).'" alt="1" class="rounded me-3 border">
								<div class="cart-desc">
									<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-attendance-details/'.uencode($_attendance['time_attendance_id']).'?value=true&status=0">'.$ol.' submitted an attendance request</a></p>
									<span><small class="text-warning"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
									<a href="'.site_url().'erp/view-attendance-details/'.uencode($_attendance['time_attendance_id']).'?value=true&status=0" 
									class="text-primary float-end btn btn-link btn-sm">View</a>
								</div>
							</div>';
						}
						} else {
							$get_notify_cnt = array('top_attendance_submission_alert_cnt'=>0, 'top_attendance_submission_alert_data' => 0,'key_id' => 0);
							return $get_notify_cnt;
						}
						endforeach;
					$get_notify_cnt = array('top_attendance_submission_alert_cnt'=>$total_notify_cnt, 'top_attendance_submission_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_attendance_submission_alert_cnt'=>0, 'top_attendance_submission_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_attendance_submission_alert_cnt'=>0, 'top_attendance_submission_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}
	}
}
if( !function_exists('top_level_notify_upon_approval_attendance') ){
	function top_level_notify_upon_approval_attendance($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$TimesheetModel = new \App\Models\TimesheetModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option','attendance_settings')->where('status',1)->where('approval_level',1)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option','attendance_settings')->where('status',1)->where('approval_level',1)->findAll();
				foreach($get_data as $_approval):
					if($_approval['approval_level'] ==1){
				$notify_status_cnt += $NotificationstatusModel->where('module_option','attendance_settings')->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					}
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $TimesheetModel->where('company_id',$company_id)->where('time_attendance_id',$_approval['module_key_id'])->first();
					$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option','attendance_settings')->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					if($notify_status_cnt < 1) {
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-attendance-details/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' approved the attendance request.</a></p>
								<span><small class="text-success"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-attendance-details/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_attendance_approval_alert_cnt'=>0, 'top_attendance_approval_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_attendance_approval_alert_cnt'=>$total_notify_cnt, 'top_attendance_approval_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_attendance_approval_alert_cnt'=>0, 'top_attendance_approval_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_attendance_approval_alert_cnt'=>0, 'top_attendance_approval_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}
	}
}
if( !function_exists('top_level_notify_upon_reject_attendance') ){
	function top_level_notify_upon_reject_attendance($module_option){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$TimesheetModel = new \App\Models\TimesheetModel();
		$StaffapprovalsModel = new \App\Models\StaffapprovalsModel();
		$NotificationsModel = new \App\Models\NotificationsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// check notifications and approvals
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $company_id)
		->where('module_options', $module_option)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $company_id)
			->where('module_options', $module_option)
			->first();
				$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
				// check modules data
				// for submission
				$notify_status_cnt = 0;
				$iget_notify_cnt = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option','attendance_settings')->where('status',2)->where('approval_level',2)->countAllResults();
				$get_data = $StaffapprovalsModel->where('company_id',$company_id)->where('module_option','attendance_settings')->where('status',2)->where('approval_level',2)->findAll();
				foreach($get_data as $_approval):
					if($_approval['approval_level'] ==1){
				$notify_status_cnt += $NotificationstatusModel->where('module_option','attendance_settings')->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					}
				endforeach;
				if($iget_notify_cnt > 0){
					$total_notify_cnt = $iget_notify_cnt - $notify_status_cnt;
					$get_data_info = '';
					$ifield = array();
					foreach($get_data as $_approval):
					// notificaiton for him/herself
					$get_data = $TimesheetModel->where('company_id',$company_id)->where('time_attendance_id',$_approval['module_key_id'])->first();
					$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['employee_id'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
					//staff
					if($staff_cnt > 0){
						$option_self = 'self';
					} else {
						$option_self = 'No';
					}
					//manager
					if($manager_cnt > 0){
						$option_manager = 'manager';
					} else {
						$option_manager = 'No';
					}
					
				if (in_array($usession['sup_user_id'], $notify_upon_approval) || in_array($option_self, $notify_upon_approval) || in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option','attendance_settings')->where('module_key_id',$_approval['module_key_id'])->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->countAllResults();
					if($notify_status_cnt < 1) {
						// check approval
						//more info
						$edate = set_date_format($_approval['updated_at']);
						$iuser = $UsersModel->where('user_id', $_approval['staff_id'])->first();
							if($iuser){
								$ol = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$ol = '--';
							}
							$ifield[] = $_approval['module_key_id'];
							$get_data_info .= '<div class="cart-item">
							<img src="'.staff_profile_photo($_approval['staff_id']).'" alt="1" class="rounded me-3 border">
							<div class="cart-desc">
								<p class="mb-0"><a class="text-body" href="'.site_url().'erp/view-attendance-details/'.uencode($_approval['module_key_id']).'?value=true&status=1">'.$ol.' rejected the attendance request.</a></p>
								<span><small class="text-danger"><i class="far fa-calendar-check m-r-2"></i> '.$edate.'</small></span>
								<a href="'.site_url().'erp/view-attendance-details/'.uencode($_approval['module_key_id']).'?value=true&status=1" 
								class="text-primary float-end btn btn-link btn-sm">View</a>
							</div>
						</div>';
					}
					} else {
						$get_notify_cnt = array('top_attendance_reject_alert_cnt'=>0, 'top_attendance_reject_alert_data' => 0,'key_id' => 0);
						return $get_notify_cnt;
					}
					endforeach;
					
					$get_notify_cnt = array('top_attendance_reject_alert_cnt'=>$total_notify_cnt, 'top_attendance_reject_alert_data' => $get_data_info, 'key_id' => $ifield);
					return $get_notify_cnt;
				} else {
					$get_notify_cnt = array('top_attendance_reject_alert_cnt'=>0, 'top_attendance_reject_alert_data' => 0,'key_id' => 0);
					return $get_notify_cnt;
				}
			} else {
				$get_notify_cnt = array('top_attendance_reject_alert_cnt'=>0, 'top_attendance_reject_alert_data' => 0,'key_id' => 0);
				return $get_notify_cnt;
			}
	}
}
if( !function_exists('top_level_notifications_info') ){
		function top_level_notifications_info(){
			
			// complaints submission alert
			$top_complaint_submission_alert_data = top_level_notify_upon_submission_complaints('complaint_settings');
			$complaint_submission_count = $top_complaint_submission_alert_data['top_complaint_submission_alert_cnt'];
			$complaint_submission_data = $top_complaint_submission_alert_data['top_complaint_submission_alert_data'];
			// complaints approval alert
			$top_complaint_approval_alert_data = top_level_notify_upon_approval_complaints('complaint_settings');
			$complaint_approval_count = $top_complaint_approval_alert_data['top_complaint_approval_alert_cnt'];
			$complaint_approval_data = $top_complaint_approval_alert_data['top_complaint_approval_alert_data'];
			
			// leave submission alert
			$top_leave_alert_submission_data = top_level_notify_upon_submission_leave('leave_settings');
			$leave_submission_count = $top_leave_alert_submission_data['top_leave_submission_alert_cnt'];
			$leave_submission_data = $top_leave_alert_submission_data['top_leave_submission_alert_data'];
			// leave approval alert
			$top_leave_alert_approval_data = top_level_notify_upon_approval_leave('leave_settings');
			$leave_approval_count = $top_leave_alert_approval_data['top_leave_approval_alert_cnt'];
			$leave_approval_data = $top_leave_alert_approval_data['top_leave_approval_alert_data'];
			
			// leave adjustment submission alert
			$top_leave_adjust_alert_submission_data = top_level_notify_upon_submission_leave_adjust('leave_adjustment_settings');
			$leave_adjust_submission_count = $top_leave_adjust_alert_submission_data['top_leave_adjust_submission_alert_cnt'];
			$leave_adjust_submission_data = $top_leave_adjust_alert_submission_data['top_leave_adjust_submission_alert_data'];
			// leave adjustment approval alert
			$top_leave_adjust_alert_approval_data = top_level_notify_upon_approval_leave_adjust('leave_adjustment_settings');
			$leave_adjust_approval_count = $top_leave_adjust_alert_approval_data['top_leave_adjust_approval_alert_cnt'];
			$leave_adjust_approval_data = $top_leave_adjust_alert_approval_data['top_leave_adjust_approval_alert_data'];
			
			// travel submission alert
			$top_travel_alert_submission_data = top_level_notify_upon_submission_travel('travel_settings');
			$travel_submission_count = $top_travel_alert_submission_data['top_travel_submission_alert_cnt'];
			$travel_submission_data = $top_travel_alert_submission_data['top_travel_submission_alert_data'];
			// travel approval alert
			$top_travel_alert_approval_data = top_level_notify_upon_approval_travel('travel_settings');
			$travel_approval_count = $top_travel_alert_approval_data['top_travel_approval_alert_cnt'];
			$travel_approval_data = $top_travel_alert_approval_data['top_travel_approval_alert_data'];
			
			// overtime submission alert
			$top_overtime_alert_submission_data = top_level_notify_upon_submission_overtime('overtime_request_settings');
			$overtime_submission_count = $top_overtime_alert_submission_data['top_overtime_submission_alert_cnt'];
			$overtime_submission_data = $top_overtime_alert_submission_data['top_overtime_submission_alert_data'];
			// overtime approval alert
			$top_overtime_alert_approval_data = top_level_notify_upon_approval_overtime('overtime_request_settings');
			$overtime_approval_count = $top_overtime_alert_approval_data['top_overtime_approval_alert_cnt'];
			$overtime_approval_data = $top_overtime_alert_approval_data['top_overtime_approval_alert_data'];
			
			// incident submission alert
			$top_incident_alert_submission_data = top_level_notify_upon_submission_incident('incident_settings');
			$incident_submission_count = $top_incident_alert_submission_data['top_incident_submission_alert_cnt'];
			$incident_submission_data = $top_incident_alert_submission_data['top_incident_submission_alert_data'];
			// incident approval alert
			$top_incident_alert_approval_data = top_level_notify_upon_approval_incident('incident_settings');
			$incident_approval_count = $top_incident_alert_approval_data['top_incident_approval_alert_cnt'];
			$incident_approval_data = $top_incident_alert_approval_data['top_incident_approval_alert_data'];
			
			// transfer submission alert
			$top_transfer_alert_submission_data = top_level_notify_upon_submission_transfer('transfer_settings');
			$transfer_submission_count = $top_transfer_alert_submission_data['top_transfer_submission_alert_cnt'];
			$transfer_submission_data = $top_transfer_alert_submission_data['top_transfer_submission_alert_data'];
			// transfer approval alert
			$top_transfer_alert_approval_data = top_level_notify_upon_approval_transfer('transfer_settings');
			$transfer_approval_count = $top_transfer_alert_approval_data['top_transfer_approval_alert_cnt'];
			$transfer_approval_data = $top_transfer_alert_approval_data['top_transfer_approval_alert_data'];
			
			// resignation submission alert
			$top_resignation_alert_submission_data = top_level_notify_upon_submission_resignation('resignation_settings');
			$resignation_submission_count = $top_resignation_alert_submission_data['top_resignation_submission_alert_cnt'];
			$resignation_submission_data = $top_resignation_alert_submission_data['top_resignation_submission_alert_data'];
			// resignation approval alert
			$top_resignation_alert_approval_data = top_level_notify_upon_approval_resignation('resignation_settings');
			$resignation_approval_count = $top_resignation_alert_approval_data['top_resignation_approval_alert_cnt'];
			$resignation_approval_data = $top_resignation_alert_approval_data['top_resignation_approval_alert_data'];
			
			// attendance submission alert
			$top_attendance_alert_submission_data = top_level_notify_upon_submission_attendance('attendance_settings');
			$attendance_submission_count = $top_attendance_alert_submission_data['top_attendance_submission_alert_cnt'];
			$attendance_submission_data = $top_attendance_alert_submission_data['top_attendance_submission_alert_data'];
			// attendance approval alert
			$top_attendance_alert_approval_data = top_level_notify_upon_approval_attendance('attendance_settings');
			$attendance_approval_count = $top_attendance_alert_approval_data['top_attendance_approval_alert_cnt'];
			$attendance_approval_data = $top_attendance_alert_approval_data['top_attendance_approval_alert_data'];
			//Rejection
			// complaints rejection alert
			$top_complaint_reject_alert_data = top_level_notify_upon_reject_complaints('complaint_settings');
			$complaint_reject_count = $top_complaint_reject_alert_data['top_complaint_reject_alert_cnt'];
			$complaint_reject_data = $top_complaint_reject_alert_data['top_complaint_reject_alert_data'];
			// leave rejection alert
			$top_leave_reject_alert_data = top_level_notify_upon_reject_leave('leave_settings');
			$leave_reject_count = $top_leave_reject_alert_data['top_leave_reject_alert_cnt'];
			$leave_reject_data = $top_leave_reject_alert_data['top_leave_reject_alert_data'];
			
			// leave adjustment rejection alert
			$top_leave_adjust_reject_alert_data = top_level_notify_upon_reject_leave_adjust('leave_adjustment_settings');
			$leave_adjust_reject_count = $top_leave_adjust_reject_alert_data['top_leave_adjust_reject_alert_cnt'];
			$leave_adjust_reject_data = $top_leave_adjust_reject_alert_data['top_leave_adjust_reject_alert_data'];
			// travel rejection alert
			$top_travel_reject_alert_data = top_level_notify_upon_reject_travel('travel_settings');
			$travel_reject_count = $top_travel_reject_alert_data['top_travel_reject_alert_cnt'];
			$travel_reject_data = $top_travel_reject_alert_data['top_travel_reject_alert_data'];
			// overtime rejection alert
			$top_level_notify_upon_reject_overtime = top_level_notify_upon_reject_overtime('overtime_request_settings');
			$overtime_reject_count = $top_level_notify_upon_reject_overtime['top_overtime_reject_alert_cnt'];
			$overtime_reject_data = $top_level_notify_upon_reject_overtime['top_overtime_reject_alert_data'];
			// incident rejection alert
			$top_level_notify_upon_reject_incident = top_level_notify_upon_reject_incident('incident_settings');
			$incident_reject_count = $top_level_notify_upon_reject_incident['top_incident_reject_alert_cnt'];
			$incident_reject_data = $top_level_notify_upon_reject_incident['top_incident_reject_alert_data'];
			// transfer rejection alert
			$top_level_notify_upon_reject_transfer = top_level_notify_upon_reject_transfer('transfer_settings');
			$transfer_reject_count = $top_level_notify_upon_reject_transfer['top_transfer_reject_alert_cnt'];
			$transfer_reject_data = $top_level_notify_upon_reject_transfer['top_transfer_reject_alert_data'];
			// resignation rejection alert
			$top_level_notify_upon_reject_resignation = top_level_notify_upon_reject_resignation('resignation_settings');
			$resignation_reject_count = $top_level_notify_upon_reject_resignation['top_resignation_reject_alert_cnt'];
			$resignation_reject_data = $top_level_notify_upon_reject_resignation['top_resignation_reject_alert_data'];
			// attendance rejection alert
			$top_level_notify_upon_reject_attendance = top_level_notify_upon_reject_attendance('attendance_settings');
			$attendance_reject_count = $top_level_notify_upon_reject_attendance['top_attendance_reject_alert_cnt'];
			$attendance_reject_data = $top_level_notify_upon_reject_attendance['top_attendance_reject_alert_data'];
			
			
			/// top notifications count
			$reject_total = $complaint_reject_count + $leave_reject_count + $leave_adjust_reject_count + $travel_reject_count + $overtime_reject_count + $incident_reject_count + $transfer_reject_count + $resignation_reject_count + $attendance_reject_count;
			$notify_total = $complaint_submission_count + $complaint_approval_count + $leave_submission_count + $leave_approval_count + $leave_adjust_submission_count + $leave_adjust_approval_count + $travel_submission_count + $travel_approval_count + $overtime_submission_count + $overtime_approval_count + $incident_submission_count + $incident_approval_count + $transfer_submission_count + $transfer_approval_count + $resignation_submission_count + $resignation_approval_count + $attendance_submission_count + $attendance_approval_count + $reject_total;
			
			$get_notify_cnt = array(
			'itop_complaint_alert_cnt'=>$complaint_submission_count, 'itop_complaint_alert_data' => $complaint_submission_data,'complaint_approval_count'=>$complaint_approval_count, 'complaint_approval_data' => $complaint_approval_data, 'itop_leave_alert_cnt'=>$leave_submission_count, 'itop_leave_alert_data' => $leave_submission_data,'leave_approval_count'=>$leave_approval_count, 'leave_approval_data' => $leave_approval_data, 'itop_leave_adjust_alert_cnt'=>$leave_adjust_submission_count, 'itop_leave_adjust_alert_data' => $leave_adjust_submission_data,'itop_leave_adjust_approval_alert_cnt'=>$leave_adjust_approval_count, 'itop_leave_adjust_approval_alert_data' => $leave_adjust_approval_data,'itop_travel_alert_cnt'=>$travel_submission_count, 'itop_travel_alert_data' => $travel_submission_data, 'travel_approval_count'=>$travel_approval_count, 'travel_approval_data' => $travel_approval_data, 'itop_overtime_alert_cnt'=>$overtime_submission_count, 'itop_overtime_alert_data' => $overtime_submission_data,'overtime_approval_count'=>$overtime_approval_count, 'overtime_approval_data' => $overtime_approval_data, 'itop_incident_alert_cnt'=>$incident_submission_count, 'itop_incident_alert_data' => $incident_submission_data, 'incident_approval_count'=>$incident_approval_count, 'incident_approval_data' => $incident_approval_data, 'itop_transfer_alert_cnt'=>$transfer_submission_count, 'itop_transfer_alert_data' => $transfer_submission_data, 'transfer_approval_count'=>$transfer_approval_count, 'transfer_approval_data' => $transfer_approval_data, 'itop_resignation_alert_cnt'=>$resignation_submission_count, 'itop_resignation_alert_data' => $resignation_submission_data, 'resignation_approval_count'=>$resignation_approval_count, 'resignation_approval_data' => $resignation_approval_data, 'attendance_submission_count' => $attendance_submission_count, 'attendance_submission_data' => $attendance_submission_data,  'attendance_approval_count' => $attendance_approval_count, 'attendance_approval_data' => $attendance_approval_data, 
			
			'complaint_reject_count' => $complaint_reject_count, 'complaint_reject_data' => $complaint_reject_data, 'leave_reject_count' => $leave_reject_count, 'leave_reject_data' => $leave_reject_data, 'leave_adjust_reject_count' => $leave_adjust_reject_count, 'leave_adjust_reject_data' => $leave_adjust_reject_data, 'travel_reject_count' => $travel_reject_count, 'travel_reject_data' => $travel_reject_data, 'overtime_reject_count' => $overtime_reject_count, 'overtime_reject_data' => $overtime_reject_data, 'incident_reject_count' => $incident_reject_count, 'incident_reject_data' => $incident_reject_data, 'transfer_reject_count' => $transfer_reject_count, 'transfer_reject_data' => $transfer_reject_data, 'resignation_reject_count' => $resignation_reject_count, 'resignation_reject_data' => $resignation_reject_data, 'attendance_reject_count' => $attendance_reject_count, 'attendance_reject_data' => $attendance_reject_data, 'inotify_total' => $notify_total);
			return $get_notify_cnt;
		}
}



