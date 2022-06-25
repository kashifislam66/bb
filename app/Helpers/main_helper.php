<?php
use CodeIgniter\I18n\Time;
//Process String
if( !function_exists('super_user_role_resource') ){

	function super_user_role_resource(){
				
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SuperroleModel = new \App\Models\SuperroleModel();
		
		$user = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$role_user = $SuperroleModel->where('role_id', $user['user_role_id'])->first();
		$role_resources_ids = explode(',',$role_user['role_resources']);
		return $role_resources_ids;
	}
}
if( !function_exists('set_date_format') ){
	//set currency sign
	function set_date_format($date) {
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		
		if($user_info['user_type'] == 'super_user'){
			
			$xin_system = $SystemModel->where('setting_id', 1)->first();
			// date format
			if($xin_system['date_format_xi']=='Y-m-d'){
				$d_format = date("Y-m-d", strtotime($date));
			} else if($xin_system['date_format_xi']=='Y-d-m'){
				$d_format = date("Y-d-m", strtotime($date));
			} else if($xin_system['date_format_xi']=='d-m-Y'){
				$d_format = date("d-m-Y", strtotime($date));
			} else if($xin_system['date_format_xi']=='m-d-Y'){
				$d_format = date("m-d-Y", strtotime($date));
			} else if($xin_system['date_format_xi']=='Y/m/d'){
				$d_format = date("Y/m/d", strtotime($date));
			} else if($xin_system['date_format_xi']=='Y/d/m'){
				$d_format = date("Y/d/m", strtotime($date));
			} else if($xin_system['date_format_xi']=='d/m/Y'){
				$d_format = date("d/m/Y", strtotime($date));
			} else if($xin_system['date_format_xi']=='m/d/Y'){
				$d_format = date("m/d/Y", strtotime($date));
			} else if($xin_system['date_format_xi']=='Y.m.d'){
				$d_format = date("Y.m.d", strtotime($date));
			} else if($xin_system['date_format_xi']=='Y.d.m'){
				$d_format = date("Y.d.m", strtotime($date));
			} else if($xin_system['date_format_xi']=='d.m.Y'){
				$d_format = date("d.m.Y", strtotime($date));
			} else if($xin_system['date_format_xi']=='m.d.Y'){
				$d_format = date("m.d.Y", strtotime($date));
			} else if($xin_system['date_format_xi']=='F j, Y'){
				$d_format = date("F j, Y", strtotime($date));
			} else {
				$d_format = date('Y-m-d');
			}
		} else {
			$xin_system = erp_company_settings();
			// date format
			if($xin_system['date_format_xi']=='Y-m-d'){
				$d_format = date("Y-m-d", strtotime($date));
			} else if($xin_system['date_format_xi']=='Y-d-m'){
				$d_format = date("Y-d-m", strtotime($date));
			} else if($xin_system['date_format_xi']=='d-m-Y'){
				$d_format = date("d-m-Y", strtotime($date));
			} else if($xin_system['date_format_xi']=='m-d-Y'){
				$d_format = date("m-d-Y", strtotime($date));
			} else if($xin_system['date_format_xi']=='Y/m/d'){
				$d_format = date("Y/m/d", strtotime($date));
			} else if($xin_system['date_format_xi']=='Y/d/m'){
				$d_format = date("Y/d/m", strtotime($date));
			} else if($xin_system['date_format_xi']=='d/m/Y'){
				$d_format = date("d/m/Y", strtotime($date));
			} else if($xin_system['date_format_xi']=='m/d/Y'){
				$d_format = date("m/d/Y", strtotime($date));
			} else if($xin_system['date_format_xi']=='Y.m.d'){
				$d_format = date("Y.m.d", strtotime($date));
			} else if($xin_system['date_format_xi']=='Y.d.m'){
				$d_format = date("Y.d.m", strtotime($date));
			} else if($xin_system['date_format_xi']=='d.m.Y'){
				$d_format = date("d.m.Y", strtotime($date));
			} else if($xin_system['date_format_xi']=='m.d.Y'){
				$d_format = date("m.d.Y", strtotime($date));
			} else if($xin_system['date_format_xi']=='F j, Y'){
				$d_format = date("F j, Y", strtotime($date));
			} else {
				$d_format = date('Y-m-d');
			}
		}
		
		return $d_format;
	}
}
if( !function_exists('set_frontend_date_format') ){
	//set currency sign
	function set_frontend_date_format($date) {
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('cand_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$CompanysettingsModel = new \App\Models\CompanysettingsModel();
		
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		//$xin_system = erp_company_settings();
		// date format
		if($xin_system['date_format_xi']=='Y-m-d'){
			$d_format = date("Y-m-d", strtotime($date));
		} else if($xin_system['date_format_xi']=='Y-d-m'){
			$d_format = date("Y-d-m", strtotime($date));
		} else if($xin_system['date_format_xi']=='d-m-Y'){
			$d_format = date("d-m-Y", strtotime($date));
		} else if($xin_system['date_format_xi']=='m-d-Y'){
			$d_format = date("m-d-Y", strtotime($date));
		} else if($xin_system['date_format_xi']=='Y/m/d'){
			$d_format = date("Y/m/d", strtotime($date));
		} else if($xin_system['date_format_xi']=='Y/d/m'){
			$d_format = date("Y/d/m", strtotime($date));
		} else if($xin_system['date_format_xi']=='d/m/Y'){
			$d_format = date("d/m/Y", strtotime($date));
		} else if($xin_system['date_format_xi']=='m/d/Y'){
			$d_format = date("m/d/Y", strtotime($date));
		} else if($xin_system['date_format_xi']=='Y.m.d'){
			$d_format = date("Y.m.d", strtotime($date));
		} else if($xin_system['date_format_xi']=='Y.d.m'){
			$d_format = date("Y.d.m", strtotime($date));
		} else if($xin_system['date_format_xi']=='d.m.Y'){
			$d_format = date("d.m.Y", strtotime($date));
		} else if($xin_system['date_format_xi']=='m.d.Y'){
			$d_format = date("m.d.Y", strtotime($date));
		} else if($xin_system['date_format_xi']=='F j, Y'){
			$d_format = date("F j, Y", strtotime($date));
		} else {
			$d_format = date('Y-m-d');
		}
		
		return $d_format;
	}
}
if ( ! function_exists('leave_halfday_cal'))
{
	function leave_halfday_cal($employee_id,$leave_type_id) {
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$LeaveModel = new \App\Models\LeaveModel();
		$leave_halfday_cal = $LeaveModel->where('employee_id', $employee_id)->where('leave_type_id', $leave_type_id)->where('is_half_day', 1)->where('status', 2)->findAll();
		$hlfcount =0;
		foreach($leave_halfday_cal as $lhalfday):
			$hlfcount += 0.5;
		endforeach;
		return $hlfcount;
	}
}
if( !function_exists('date_range') ){
	function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d' ) {
	
		$dates = array();
		$current = strtotime($first);
		$last = strtotime($last);
	
		while( $current <= $last ) {
	
			$dates[] = date($output_format, $current);
			$current = strtotime($step, $current);
		}
	
		return $dates;
	}
}
// erp_date_difference
if( !function_exists('erp_date_difference') ){
	function erp_date_difference($datetime1,$datetime2) {
		
		$idatetime1 = date_create($datetime1);
		$idatetime2 = date_create($datetime2);
		$interval = date_diff($idatetime1, $idatetime2);
		$no_of_days = $interval->format('%a') +1;
				
		return $no_of_days;
	}
}
if( !function_exists('erp_leave_date_difference') ){
	function erp_leave_date_difference($luser_id,$datetime1,$datetime2) {
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$LeaveModel = new \App\Models\LeaveModel();
		$UsersModel = new \App\Models\UsersModel();
		$ShiftModel = new \App\Models\ShiftModel();
		$ConstantsModel = new \App\Models\ConstantsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
						
		$idatetime1 = date_create($datetime1);
		$idatetime2 = date_create($datetime2);
		$interval = date_diff($idatetime1, $idatetime2);
		$no_of_days = 0;
		$time = strtotime('00:00');
		///start/end date check as weekday or off_shift
		$user_info = $UsersModel->where('user_id', $luser_id)->first();
		$employee_detail = $StaffdetailsModel->where('user_id', $luser_id)->first();
		$office_shift = $ShiftModel->where('office_shift_id', $employee_detail['office_shift_id'])->first();
		$db      = \Config\Database::connect();	
		
		$dates = date_range($datetime1,$datetime2);
		foreach( $dates as  $idate ) {
			$ibuilder = $db->table('ci_holidays');
						$ibuilder->where('"'. $idate. '" BETWEEN start_date AND end_date');
						$ibuilder->where('company_id', $user_info['company_id']);
						$ibuilder->where('is_publish', 1);
						$queryh = $ibuilder->get();
						$HolidayCount = $queryh->getNumRows();
			// print_r($idate); die();
			$stridate = strtotime($idate);
			if($HolidayCount == 0) {
				 
			
					$day = date('l', $stridate);
					
					if($office_shift) {
						if($day == 'Monday') {
							if($office_shift['monday_in_time']==''){
								$in_time = '00:00';
								$out_time = '00:00';
								$break_start = '00:00';
								$break_out = '00:00';
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
							} else {
								$in_time = $office_shift['sunday_in_time'];
								$out_time = $office_shift['sunday_out_time'];
								$break_start = $office_shift['sunday_lunch_break'];
								$break_out = $office_shift['sunday_lunch_break_out'];
							}
						}

							$clock_in2 = $idate.' '.$in_time.':00';
							$clock_out2 = $idate.' '.$out_time.':00';
							$break_start2 = $idate.' '.$break_start.':00';
							$break_out2 = $idate.' '.$break_out.':00';
							
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
							$total_work = floor($start_t) . ':' . ( ($start_t-floor($start_t)) * 60 );
							$temp = explode(":", $total_work);
							$no_of_days+= (int) $temp[0] * 3600;
							$no_of_days+= (int) $temp[1] * 60;
							

					}
			}
			
		}
		$formatted = sprintf('%02d',
								($no_of_days / 3600),
								($no_of_days / 60 % 60),
								$no_of_days % 60);
					// die($formatted);
		return $formatted;
	}
}
function AddTimeToStr($aElapsedTimes) {
		$totalHours = 0;
		$totalMinutes = 0;
		
		foreach($aElapsedTimes as $time) {
		$timeParts = explode(":", $time);
		$h = $timeParts[0];
		$m = $timeParts[1];
		$totalHours += $h;
		$totalMinutes += $m;
		}
		
		$additionalHours = floor($totalMinutes / 60);
		$minutes = $totalMinutes % 60;
		$hours = $totalHours + $additionalHours;
		
		$strMinutes = strval($minutes);
		if ($minutes < 10) {
		  $strMinutes = "0" . $minutes;
		}
		
		$strHours = strval($hours);
		if ($hours < 10) {
		  $strHours = "0" . $hours;
		}
		
		return $strMinutes;
}
if( !function_exists('explode_time') ){
	function explode_time($time) { //explode time and convert into seconds
		$time = explode(':', $time);
		$time = $time[0] * 3600 + $time[1] * 60;
		return $time;
	}
}
if( !function_exists('time_to_hhour') ){
	function time_to_hhour($time) { //convert seconds to hh:mm
		$hour = floor($time / 3600);
		$minute = strval(floor(($time % 3600) / 60));
		if ($minute == 0) {
			$minute = "00";
		} else {
			if($minute > 59){
				$minute = $minute;
			} else {
				$minute = 0;
			}
		}
		$hour = $minute;
		$time = $hour;// . ":" . $minute;
		return $time;
	}
}
if( !function_exists('mins_to_hours') ){
	function mins_to_hours($minute,$hour) {
		
		$minute = floor($minute / 60).':'.($minute -   floor($minute / 60) * 60);
		$iminute = explode(':',$minute);
		$fhminute = $iminute[0];
		$fminute = $iminute[1];
		$fhour = $hour + $fhminute.':'.$fminute;
				
		return $fhour;
	}
}
if( !function_exists('erp_date_difference_mn') ){
	function erp_date_difference_mn($datetime1,$datetime2) {
		
		$idatetime1 = date_create($datetime1);
		$idatetime2 = date_create($datetime2);
		$interval = date_diff($idatetime1, $idatetime2);
		$no_of_days = $interval->format('%a') +1;
				
		return $no_of_days;
	}
}
if ( ! function_exists('count_employee_leave'))
{
	function count_employee_leave($employee_id,$leave_type_id,$month) {
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$LeaveModel = new \App\Models\LeaveModel();
		$res_leave = $LeaveModel->where('employee_id', $employee_id)->where('leave_type_id', $leave_type_id)->where('from_date!=', '')->where('leave_month', $month)->where('status', 2)->findAll();
		$tinc = 0;
		foreach($res_leave as $ires_leave):
			//$no_of_days = erp_date_difference($ires_leave['from_date'],$ires_leave['to_date']);
			$no_of_days = erp_leave_date_difference($employee_id,$ires_leave['from_date'],$ires_leave['to_date']);
			if($no_of_days < 2){
				$tinc +=1;
			} else {
				$tinc += $no_of_days;
			}
		endforeach;
		return $tinc;
	}
}
if ( ! function_exists('count_employee_leave_hours'))
{
	function count_employee_leave_hours($employee_id,$leave_type_id,$month) {
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$LeaveModel = new \App\Models\LeaveModel();
		$res_leave = $LeaveModel->where('employee_id', $employee_id)->where('leave_type_id', $leave_type_id)->where('leave_hours!=', '')->where('leave_month', $month)->where('status', 2)->findAll();
		$tinc = 0;
		foreach($res_leave as $ires_leave):
			$tinc += $ires_leave['leave_hours'];
		endforeach;
		return $tinc;
	}
}
if ( ! function_exists('count_approved_leave_hours'))
{
	function count_approved_leave_hours($employee_id,$leave_type_id,$month,$leave_year) {
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$LeaveModel = new \App\Models\LeaveModel();
		$res_leave = $LeaveModel->where('employee_id', $employee_id)->where('leave_type_id', $leave_type_id)->where('leave_month', $month)->where('leave_year', $leave_year)->where('status', 2)->findAll();
		$tinc = 0;
		foreach($res_leave as $ires_leave):
			$tinc += $ires_leave['leave_hours'];
		endforeach;
		return $tinc;
	}
}
if ( ! function_exists('final_staff_leave_accruals'))
{
	function final_staff_leave_accruals($employee_id,$leave_type_id,$leave_year) {
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$LeaveModel = new \App\Models\LeaveModel();
		$UsersModel = new \App\Models\UsersModel();
		$ConstantsModel = new \App\Models\ConstantsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$staff_info = $StaffdetailsModel->where('user_id', $employee_id)->first();
		$date_of_joining = $staff_info['date_of_joining'];
		$is_accrual_pause = $staff_info['is_accrual_pause'];
		$pause_start_date = $staff_info['pause_start_date'];
		$pause_start_end = $staff_info['pause_start_end'];
		$fmonth = date('n',strtotime($date_of_joining));
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		if($staff_info['leave_options'] == '') {
			$ileave_option = 0;
		} else {
			$ileave_option = unserialize($staff_info['leave_options']);
		}
		$rem_leave = 0;
		$months = array(1 => 'Ja', 2 => 'Fe', 3 => 'Mar', 4 => 'Ap', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Au', 9 => 'Se', 10 => 'Oc', 11 => 'No', 12 => 'De');
		$ifield_one = $ConstantsModel->where('company_id',$company_id)->where('constants_id',$leave_type_id)->where('type','leave_type')->first();
		//$ipause_months = $staff_info['pause_months'];
		if($is_accrual_pause == 1) {
			$pause_hrs = erp_leave_date_difference($employee_id,$pause_start_date,$pause_start_end);
			$ipause_hrs = $pause_hrs * 7;
		} else {
			$ipause_hrs =0;
		}
		if(isset($ifield_one['enable_leave_accrual']) && $ifield_one['enable_leave_accrual'] == 1){
			foreach($months as $key=>$val) {
				if($key >= $fmonth){
					//if (!in_array($key, $ipause_months)){
						$count_l = count_employee_leave_hours($employee_id,$leave_type_id,$key);
						$rem_leave += $ileave_option[$leave_type_id][$key]-$count_l;
					//}
				}
			}
			$rem_leave = $rem_leave - $ipause_hrs;
		} else {
			$rem_leave = 0;
		}
		
		return $rem_leave;
	}
}
if ( ! function_exists('check_negative_leaves'))
{
	function check_negative_leaves($leave_type_id) {
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$UsersModel = new \App\Models\UsersModel();
		$ConstantsModel = new \App\Models\ConstantsModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		$res_leave = $ConstantsModel->where('company_id', $company_id)->where('constants_id', $leave_type_id)->where('type','leave_type')->first();
		$ileave_option = unserialize($res_leave['field_one']);
		if($ileave_option['is_negative_quota'] == 1):
			$negative_limit = $ileave_option['negative_limit'];
		else:
			$negative_limit = 0;
		endif;
		return $negative_limit;
	}
}
if ( ! function_exists('check_leave_carry_over_limit'))
{
	function check_leave_carry_over_limit($employee_id,$leave_type_id,$leave_year) {
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$UsersModel = new \App\Models\UsersModel();
		$LeaveModel = new \App\Models\LeaveModel();
		$ConstantsModel = new \App\Models\ConstantsModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		$employee_detail = $StaffdetailsModel->where('user_id', $employee_id)->first();
		// quota assignment year
		$ejoining_date = Time::parse($employee_detail['date_of_joining']);
		$curr_date    = Time::parse(date('Y-m-d'));
		$diff_year_quota = $ejoining_date->difference($curr_date);
		$fyear_quota = $diff_year_quota->getYears();
		// check leave - last year
		$itinc = final_staff_leave_accruals($employee_id,$leave_type_id,$leave_year);
		
		$res_leave = $ConstantsModel->where('company_id', $company_id)->where('constants_id', $leave_type_id)->where('type','leave_type')->first();
		$ileave_option = unserialize($res_leave['field_one']);
		if($ileave_option['is_carry'] == 1):
			$icarry_limit = $ileave_option['carry_limit'];
			if($icarry_limit > $itinc){
				$carry_limit = $itinc;
			} else {
				$carry_limit = $icarry_limit;
			}
		else:
			$carry_limit = 0;
		endif;
		return $carry_limit;
	}
}
if ( ! function_exists('count_sameday_leave'))
{
	function count_sameday_leave($employee_id,$sameday) {
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$LeaveModel = new \App\Models\LeaveModel();
		$res_leave = $LeaveModel->where('employee_id', $employee_id)->where('from_date', $sameday)->where('status', 2)->countAllResults();
		return $res_leave;
	}
}
if ( ! function_exists('overtime_request_banked_hours'))
{
	function overtime_request_banked_hours($employee_id) {
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$OvertimerequestModel = new \App\Models\OvertimerequestModel();
		$res_leave = $OvertimerequestModel->where('staff_id', $employee_id)->where('compensation_type', 1)->where('is_approved', 1)->findAll();
		$tinc = '00:00';
		$hrs_old_int1 = 0;
		$Total = '';
		$Trest = '';
		$total_time_rs = '';
		$hrs_old_int_res1 = '';
		foreach($res_leave as $ires_leave):
			// Converting the time into seconds
			$timee = $ires_leave['compensation_banked'].':00';
			//$timee = $hour_work['total_work'].':00';
			$str_time =$timee;

			$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
			
			sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
			
			$hrs_old_seconds = $hours * 3600 + $minutes * 60 + $seconds;
			
			$hrs_old_int1 += $hrs_old_seconds;
			
			$Total = gmdate("H:i", $hrs_old_int1);
		endforeach;
		return $Total;
	}
}
if( !function_exists('total_hours_worked_payslip') ){

	function total_hours_worked_payslip($id,$attendance_date){
				
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$TimesheetModel = new \App\Models\TimesheetModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		$attendance = $TimesheetModel->where('company_id',$company_id)->where('employee_id', $id)->like('attendance_date', $attendance_date)->findAll();
		$mn_count = 0;
		$pcount = 0;
	  foreach($attendance as $hours_worked):
			// Converting the time into seconds
			$timee = $hours_worked['total_work'];
			$itimee = explode(':',$timee);
			//$timee = $hour_work['total_work'].':00';
			$str_time1 =$itimee[0];
			$str_time2 =$itimee[1];			
			$pcount += $str_time1;
			$mn_count += $str_time2;
			
		endforeach;
		//
		if($mn_count > 59){
			$nmn_count = $mn_count / 60;
			$inmn_count = explode('.',$nmn_count);
			$imn_count = $inmn_count[0];
		} else {
			$imn_count = 0;
		}
		
		$final_hrs = $pcount + $imn_count;
		
		return $final_hrs;
	}
}
if ( ! function_exists('on_leave_status'))
{
	function on_leave_status() {
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$UsersModel = new \App\Models\UsersModel();
		$LeaveModel = new \App\Models\LeaveModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$today_date = array(date('Y-m-d'));
		$tomorrow_date = array(date('Y-m-d', strtotime("+1 days")));
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		//reporting manager info
		//$rep_manager = $StaffdetailsModel->where('reporting_manager', $usession['sup_user_id'])->countAllResults();
		//$rep_manager_info = $StaffdetailsModel->where('reporting_manager', $usession['sup_user_id'])->first();
		
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
			$res_leave = $LeaveModel->where('company_id', $company_id)->where('status', 2)->findAll();
		} else {
			$company_id = $usession['sup_user_id'];
			$res_leave = $LeaveModel->where('company_id', $company_id)->where('status', 2)->findAll();
		}
				
		//today_leave
		$today_leave = array();
		foreach($res_leave as $ires_leave):
			if (in_array($ires_leave['from_date'], $today_date) || in_array($ires_leave['to_date'], $today_date)){
				//get leave users
				$leave_users = $UsersModel->where('user_id', $ires_leave['employee_id'])->findAll();
				foreach($leave_users as $lusers):
					$full_name = $lusers['first_name'].' '.$lusers['last_name'];
					$today_leave[] = array('euser_id'=>$ires_leave['employee_id'], 'full_name'=>$full_name);
				endforeach;
			}
		endforeach;
		$tomorrow_leave = array();
		foreach($res_leave as $tires_leave):
			if (in_array($tires_leave['from_date'], $tomorrow_date) || in_array($tires_leave['to_date'], $tomorrow_date)){
				//get leave users
				$leave_users = $UsersModel->where('user_id', $tires_leave['employee_id'])->findAll();
				foreach($leave_users as $lusers):
					$tfull_name = $lusers['first_name'].' '.$lusers['last_name'];
					$tomorrow_leave[] = array('euser_id'=>$tires_leave['employee_id'], 'full_name'=>$tfull_name);
				endforeach;
			}
		endforeach;
		$leave_status_arr = array('today_leave'=>$today_leave, 'tomorrow_leave'=>$tomorrow_leave);
		return $leave_status_arr;
	}
}
// generate employee id
if( !function_exists('generate_random_employeeid') ){
	function generate_random_employeeid($length = 6) {
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
// generate subscription id
if( !function_exists('generate_subscription_id') ){
	function generate_subscription_id($length = 10) {
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
// generate code
if( !function_exists('generate_random_code') ){
	function generate_random_code($length = 6) {
		$characters = '01Ikro23JKW2ElOK32IKlqwe902LOK789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}

if( !function_exists('get_name') ){
	function get_name($value = "") {
		$UsersModel = new \App\Models\UsersModel();
		
		// get userinfo and role
		$user_info = $UsersModel->where('user_id', $value)->where('is_active', 1)->first();
		if(!empty($user_info)) {
		return $user_info['first_name'].' '.$user_info['last_name'];
		} else {
			return "";
		}
	}
}

if( !function_exists('staff_role_resource') ){
// get user role > links > all
	function staff_role_resource(){
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$RolesModel = new \App\Models\RolesModel();
		
		// get userinfo and role
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$role_user = $RolesModel->where('role_id', $user_info['user_role_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$role_resources_ids = explode(',',$role_user['role_resources']);
		} else {
			$role_resources_ids = array(0,0);
		}
		return $role_resources_ids;
	}
}
// get selected module
if( !function_exists('select_module_class') ){
	function select_module_class($mClass,$mMethod) {
		$arr = array();
		// dashboard
		if($mClass=='\App\Controllers\Erp\Dashboard') {
			$arr['desk_active'] = 'active';
			$arr['super_open'] = '';
			return $arr;
		} else if($mMethod=='constants' || $mMethod=='email_templates' || $mClass=='\App\Controllers\Erp\Languages') {
			$arr['constants_active'] = 'active';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Companies' && $mMethod=='company_details') {
			$arr['companies_active'] = 'active';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Membership' && $mMethod=='membership_details') {
			$arr['membership_active'] = 'active';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Users' && $mMethod=='user_details') {
			$arr['users_active'] = 'active';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Membershipinvoices' && $mMethod=='billing_details') {
			$arr['billing_details_active'] = 'active';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Projects' && $mMethod=='client_project_details') {
			$arr['client_project_active'] = 'active';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Tasks' && $mMethod=='client_task_details') {
			$arr['client_task_active'] = 'active';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Invoices' && $mMethod=='invoice_details') {
			$arr['invoice_details_active'] = 'active';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Department' && $mMethod=='index') {
			$arr['department_active'] = 'active';
			$arr['core_style_ul'] = 'style="display: block;"';
			$arr['corehr_open'] = 'active';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Designation' && $mMethod=='index') {
			$arr['designation_active'] = 'active';
			$arr['core_style_ul'] = 'style="display: block;"';
			$arr['corehr_open'] = 'active';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Announcements' && $mMethod=='index') {
			$arr['announcements_active'] = 'active';
			$arr['core_style_ul'] = 'style="display: block;"';
			$arr['corehr_open'] = 'active';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Policies' && $mMethod=='index') {
			$arr['policies_active'] = 'active';
			$arr['core_style_ul'] = 'style="display: block;"';
			$arr['corehr_open'] = 'active';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Timesheet' && $mMethod=='attendance') {
			$arr['attnd_active'] = 'active';
			$arr['attendance_open'] = 'active';
			$arr['attendance_style_ul'] = 'style="display: block;"';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Timesheet' && $mMethod=='update_attendance') {
			$arr['upd_attnd_active'] = 'active';
			$arr['attendance_open'] = 'active';
			$arr['attendance_style_ul'] = 'style="display: block;"';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Timesheet' && $mMethod=='monthly_timesheet') {
			$arr['timesheet_active'] = 'active';
			$arr['attendance_open'] = 'active';
			$arr['attendance_style_ul'] = 'style="display: block;"';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Timesheet' && $mMethod=='overtime_request') {
			$arr['overtime_request_act'] = 'active';
			$arr['attendance_open'] = 'active';
			$arr['attendance_style_ul'] = 'style="display: block;"';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Talent' && $mMethod=='performance_indicator') {
			$arr['indicator_active'] = 'active';
			$arr['talent_open'] = 'active';
			$arr['talent_style_ul'] = 'style="display: block;"';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Talent' && $mMethod=='performance_appraisal') {
			$arr['appraisal_active'] = 'active';
			$arr['talent_open'] = 'active';
			$arr['talent_style_ul'] = 'style="display: block;"';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Trackgoals' && $mMethod=='index') {
			$arr['goal_track_active'] = 'active';
			$arr['talent_open'] = 'active';
			$arr['talent_style_ul'] = 'style="display: block;"';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Trackgoals' && $mMethod=='goals_calendar') {
			$arr['goals_calendar_active'] = 'active';
			$arr['talent_open'] = 'active';
			$arr['talent_style_ul'] = 'style="display: block;"';
			return $arr;
		} else if($mClass=='\App\Controllers\Erp\Types' && $mMethod=='competencies') {
			$arr['competencies_active'] = 'active';
			$arr['talent_open'] = 'active';
			$arr['talent_style_ul'] = 'style="display: block;"';
			return $arr;
		}  else if($mClass=='\App\Controllers\Erp\Types' && $mMethod=='goal_type') {
			$arr['tracking_type_active'] = 'active';
			$arr['talent_open'] = 'active';
			$arr['talent_style_ul'] = 'style="display: block;"';
			return $arr;
		}
	}
}
// get timezone
if( !function_exists('all_timezones') ){	
	function all_timezones() {
	$timezones = array(
		'Pacific/Midway'       => "(GMT-11:00) Midway Island",
		'US/Samoa'             => "(GMT-11:00) Samoa",
		'US/Hawaii'            => "(GMT-10:00) Hawaii",
		'US/Alaska'            => "(GMT-09:00) Alaska",
		'US/Pacific'           => "(GMT-08:00) Pacific Time (US &amp; Canada)",
		'America/Tijuana'      => "(GMT-08:00) Tijuana",
		'US/Arizona'           => "(GMT-07:00) Arizona",
		'US/Mountain'          => "(GMT-07:00) Mountain Time (US &amp; Canada)",
		'America/Chihuahua'    => "(GMT-07:00) Chihuahua",
		'America/Mazatlan'     => "(GMT-07:00) Mazatlan",
		'America/Mexico_City'  => "(GMT-06:00) Mexico City",
		'America/Monterrey'    => "(GMT-06:00) Monterrey",
		'Canada/Saskatchewan'  => "(GMT-06:00) Saskatchewan",
		'US/Central'           => "(GMT-06:00) Central Time (US &amp; Canada)",
		'US/Eastern'           => "(GMT-05:00) Eastern Time (US &amp; Canada)",
		'US/East-Indiana'      => "(GMT-05:00) Indiana (East)",
		'America/Bogota'       => "(GMT-05:00) Bogota",
		'America/Lima'         => "(GMT-05:00) Lima",
		'America/Caracas'      => "(GMT-04:30) Caracas",
		'Canada/Atlantic'      => "(GMT-04:00) Atlantic Time (Canada)",
		'America/La_Paz'       => "(GMT-04:00) La Paz",
		'America/Santiago'     => "(GMT-04:00) Santiago",
		'Canada/Newfoundland'  => "(GMT-03:30) Newfoundland",
		'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
		'Greenland'            => "(GMT-03:00) Greenland",
		'Atlantic/Stanley'     => "(GMT-02:00) Stanley",
		'Atlantic/Azores'      => "(GMT-01:00) Azores",
		'Atlantic/Cape_Verde'  => "(GMT-01:00) Cape Verde Is.",
		'Africa/Casablanca'    => "(GMT) Casablanca",
		'Europe/Dublin'        => "(GMT) Dublin",
		'Europe/Lisbon'        => "(GMT) Lisbon",
		'Europe/London'        => "(GMT) London",
		'Africa/Monrovia'      => "(GMT) Monrovia",
		'Europe/Amsterdam'     => "(GMT+01:00) Amsterdam",
		'Europe/Belgrade'      => "(GMT+01:00) Belgrade",
		'Europe/Berlin'        => "(GMT+01:00) Berlin",
		'Europe/Bratislava'    => "(GMT+01:00) Bratislava",
		'Europe/Brussels'      => "(GMT+01:00) Brussels",
		'Europe/Budapest'      => "(GMT+01:00) Budapest",
		'Europe/Copenhagen'    => "(GMT+01:00) Copenhagen",
		'Europe/Ljubljana'     => "(GMT+01:00) Ljubljana",
		'Europe/Madrid'        => "(GMT+01:00) Madrid",
		'Europe/Paris'         => "(GMT+01:00) Paris",
		'Europe/Prague'        => "(GMT+01:00) Prague",
		'Europe/Rome'          => "(GMT+01:00) Rome",
		'Europe/Sarajevo'      => "(GMT+01:00) Sarajevo",
		'Europe/Skopje'        => "(GMT+01:00) Skopje",
		'Europe/Stockholm'     => "(GMT+01:00) Stockholm",
		'Europe/Vienna'        => "(GMT+01:00) Vienna",
		'Europe/Warsaw'        => "(GMT+01:00) Warsaw",
		'Europe/Zagreb'        => "(GMT+01:00) Zagreb",
		'Europe/Athens'        => "(GMT+02:00) Athens",
		'Europe/Bucharest'     => "(GMT+02:00) Bucharest",
		'Africa/Cairo'         => "(GMT+02:00) Cairo",
		'Africa/Harare'        => "(GMT+02:00) Harare",
		'Europe/Helsinki'      => "(GMT+02:00) Helsinki",
		'Europe/Istanbul'      => "(GMT+02:00) Istanbul",
		'Asia/Jerusalem'       => "(GMT+02:00) Jerusalem",
		'Europe/Kiev'          => "(GMT+02:00) Kyiv",
		'Europe/Minsk'         => "(GMT+02:00) Minsk",
		'Europe/Riga'          => "(GMT+02:00) Riga",
		'Europe/Sofia'         => "(GMT+02:00) Sofia",
		'Europe/Tallinn'       => "(GMT+02:00) Tallinn",
		'Europe/Vilnius'       => "(GMT+02:00) Vilnius",
		'Asia/Baghdad'         => "(GMT+03:00) Baghdad",
		'Asia/Kuwait'          => "(GMT+03:00) Kuwait",
		'Africa/Nairobi'       => "(GMT+03:00) Nairobi",
		'Asia/Riyadh'          => "(GMT+03:00) Riyadh",
		'Europe/Moscow'        => "(GMT+03:00) Moscow",
		'Asia/Tehran'          => "(GMT+03:30) Tehran",
		'Asia/Baku'            => "(GMT+04:00) Baku",
		'Europe/Volgograd'     => "(GMT+04:00) Volgograd",
		'Asia/Muscat'          => "(GMT+04:00) Muscat",
		'Asia/Tbilisi'         => "(GMT+04:00) Tbilisi",
		'Asia/Yerevan'         => "(GMT+04:00) Yerevan",
		'Asia/Kabul'           => "(GMT+04:30) Kabul",
		'Asia/Karachi'         => "(GMT+05:00) Karachi",
		'Asia/Tashkent'        => "(GMT+05:00) Tashkent",
		'Asia/Kolkata'         => "(GMT+05:30) Kolkata",
		'Asia/Kathmandu'       => "(GMT+05:45) Kathmandu",
		'Asia/Yekaterinburg'   => "(GMT+06:00) Ekaterinburg",
		'Asia/Almaty'          => "(GMT+06:00) Almaty",
		'Asia/Dhaka'           => "(GMT+06:00) Dhaka",
		'Asia/Novosibirsk'     => "(GMT+07:00) Novosibirsk",
		'Asia/Bangkok'         => "(GMT+07:00) Bangkok",
		'Asia/Jakarta'         => "(GMT+07:00) Jakarta",
		'Asia/Krasnoyarsk'     => "(GMT+08:00) Krasnoyarsk",
		'Asia/Chongqing'       => "(GMT+08:00) Chongqing",
		'Asia/Hong_Kong'       => "(GMT+08:00) Hong Kong",
		'Asia/Kuala_Lumpur'    => "(GMT+08:00) Kuala Lumpur",
		'Australia/Perth'      => "(GMT+08:00) Perth",
		'Asia/Singapore'       => "(GMT+08:00) Singapore",
		'Asia/Taipei'          => "(GMT+08:00) Taipei",
		'Asia/Ulaanbaatar'     => "(GMT+08:00) Ulaan Bataar",
		'Asia/Urumqi'          => "(GMT+08:00) Urumqi",
		'Asia/Irkutsk'         => "(GMT+09:00) Irkutsk",
		'Asia/Seoul'           => "(GMT+09:00) Seoul",
		'Asia/Tokyo'           => "(GMT+09:00) Tokyo",
		'Australia/Adelaide'   => "(GMT+09:30) Adelaide",
		'Australia/Darwin'     => "(GMT+09:30) Darwin",
		'Asia/Yakutsk'         => "(GMT+10:00) Yakutsk",
		'Australia/Brisbane'   => "(GMT+10:00) Brisbane",
		'Australia/Canberra'   => "(GMT+10:00) Canberra",
		'Pacific/Guam'         => "(GMT+10:00) Guam",
		'Australia/Hobart'     => "(GMT+10:00) Hobart",
		'Australia/Melbourne'  => "(GMT+10:00) Melbourne",
		'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
		'Australia/Sydney'     => "(GMT+10:00) Sydney",
		'Asia/Vladivostok'     => "(GMT+11:00) Vladivostok",
		'Asia/Magadan'         => "(GMT+12:00) Magadan",
		'Pacific/Auckland'     => "(GMT+12:00) Auckland",
		'Pacific/Fiji'         => "(GMT+12:00) Fiji",
		);
		return $timezones;
	}
	}
	if( !function_exists('secret_key') ){	
		function secret_key($string='') {
			$data = 'J87JUHYTG5623GHrhej789kjhyrRe34k';
			$data = str_replace(['+','/','='],['-','_',''],$data);
			return $data;
		}
	}
	if( !function_exists('safe_b64encode') ){	
		function safe_b64encode($string='') {
			$data = base64_encode($string);
			$data = str_replace(['+','/','='],['-','_',''],$data);
			return $data;
		}
	}
	if( !function_exists('safe_b64decode') ){
		function safe_b64decode($string='') {
			$data = str_replace(['-','_'],['+','/'],$string);
			$mod4 = strlen($data) % 4;
			if ($mod4) {
				$data .= substr('====', $mod4);
			}
			return base64_decode($data);
		}
	}
	if( !function_exists('uencode') ){
		function uencode($value=false){ 
			if(!$value) return false;
			$iv_size = openssl_cipher_iv_length('aes-256-cbc');
			$iv = openssl_random_pseudo_bytes($iv_size);
			$crypttext = openssl_encrypt($value, 'aes-256-cbc', secret_key(), OPENSSL_RAW_DATA, $iv);
			return safe_b64encode($iv.$crypttext); 
		}
	}
	if( !function_exists('udecode') ){
		function udecode($value=false){
			if(!$value) return false;
			$crypttext = safe_b64decode($value);
			$iv_size = openssl_cipher_iv_length('aes-256-cbc');
			$iv = substr($crypttext, 0, $iv_size);
			$crypttext = substr($crypttext, $iv_size);
			if(!$crypttext) return false;
			$decrypttext = openssl_decrypt($crypttext, 'aes-256-cbc', secret_key(), OPENSSL_RAW_DATA, $iv);
			return rtrim($decrypttext);
		}
	}
	
	//// file helper
	if( !function_exists('filesrc') ){
		function filesrc($fileName, $type ='full'){
			
			$path = './public/uploads/users/';
			if($type!='full')
				$path .= $type.'/';
			return $path . $fileName;	
		}
	}
	if( !function_exists('filecsrc') ){
		function filecsrc($fileName, $type ='full'){
			
			$path = './public/uploads/clients/';
			if($type!='full')
				$path .= $type.'/';
			return $path . $fileName;	
		}
	}
	if( !function_exists('langfilesrc') ){
		function langfilesrc($fileName, $type ='full'){
			
			$path = './public/uploads/languages_flag/temp/';
			if($type!='full')
				$path .= $type.'/';
			return $path . $fileName;	
		}
	}
	if( !function_exists('convertNumberToWord') ){
		function convertNumberToWord($num = false) {
			$num = str_replace(array(',', ' '), '' , trim($num));
			if(! $num) {
				return false;
			}
			$num = (int) $num;
			$words = array();
			$list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
				'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
			);
			$list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
			$list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
				'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
				'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
			);
			$num_length = strlen($num);
			$levels = (int) (($num_length + 2) / 3);
			$max_length = $levels * 3;
			$num = substr('00' . $num, -$max_length);
			$num_levels = str_split($num, 3);
			for ($i = 0; $i < count($num_levels); $i++) {
				$levels--;
				$hundreds = (int) ($num_levels[$i] / 100);
				$hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
				$tens = (int) ($num_levels[$i] % 100);
				$singles = '';
				if ( $tens < 20 ) {
					$tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
				} else {
					$tens = (int)($tens / 10);
					$tens = ' ' . $list2[$tens] . ' ';
					$singles = (int) ($num_levels[$i] % 10);
					$singles = ' ' . $list1[$singles] . ' ';
				}
				$words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
			} //end for loop
			$commas = count($words);
			if ($commas > 1) {
				$commas = $commas - 1;
			}
			return implode(' ', $words);
		}
	}
	if( !function_exists('erp_paid_invoices') ){

		function erp_paid_invoices($invoice_month){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$InvoicesModel = new \App\Models\InvoicesModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$paid_invoice = $InvoicesModel->where('company_id',$company_id)->where('invoice_month', $invoice_month)->where('status', 1)->findAll();
			$pinc = 0;
			foreach($paid_invoice as $pinvoice){
				$pinc += $pinvoice['grand_total'];
			}
			
			return $pinc;
		}
	}
	if( !function_exists('company_paid_invoices') ){

		function company_paid_invoices($invoice_month){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$InvoicepaymentsModel = new \App\Models\InvoicepaymentsModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			$paid_invoice = $InvoicepaymentsModel->where('invoice_month', $invoice_month)->findAll();
			$pinc = 0;
			foreach($paid_invoice as $pinvoice){
				$pinc += $pinvoice['membership_price'];
			}
			
			return $pinc;
		}
	}
	if( !function_exists('client_paid_invoices') ){

		function client_paid_invoices($invoice_month){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$InvoicesModel = new \App\Models\InvoicesModel();
			$paid_invoice = $InvoicesModel->where('client_id',$usession['sup_user_id'])->where('invoice_month', $invoice_month)->where('status', 1)->findAll();
			$pinc = 0;
			foreach($paid_invoice as $pinvoice){
				$pinc += $pinvoice['grand_total'];
			}
			
			return $pinc;
		}
	}
	if( !function_exists('erp_unpaid_invoices') ){

		function erp_unpaid_invoices($invoice_month){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$InvoicesModel = new \App\Models\InvoicesModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$paid_invoice = $InvoicesModel->where('company_id',$company_id)->where('invoice_month', $invoice_month)->where('status', 0)->findAll();
			$pinc = 0;
			foreach($paid_invoice as $pinvoice){
				$pinc += $pinvoice['grand_total'];
			}
			
			return $pinc;
		}
	}
	if( !function_exists('client_unpaid_invoices') ){

		function client_unpaid_invoices($invoice_month){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$InvoicesModel = new \App\Models\InvoicesModel();
			$paid_invoice = $InvoicesModel->where('client_id',$usession['sup_user_id'])->where('invoice_month', $invoice_month)->where('status', 0)->findAll();
			$pinc = 0;
			foreach($paid_invoice as $pinvoice){
				$pinc += $pinvoice['grand_total'];
			}
			
			return $pinc;
		}
	}
	if( !function_exists('erp_payroll') ){

		function erp_payroll($salary_month){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$PayrollModel = new \App\Models\PayrollModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$paid_amount = $PayrollModel->where('company_id',$company_id)->where('salary_month', $salary_month)->findAll();
			$pinc = 0;
			$pamn =0;
			foreach($paid_amount as $pamount){
				$pamn += $pamount['net_salary'];
			}
			
			return $pamn;
		}
	}
	if( !function_exists('staff_payroll') ){

		function staff_payroll($salary_month,$staff_id){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$PayrollModel = new \App\Models\PayrollModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$paid_amount = $PayrollModel->where('company_id',$company_id)->where('salary_month', $salary_month)->where('staff_id', $staff_id)->findAll();
			$pinc = 0;
			$pamn =0;
			foreach($paid_amount as $pamount){
				$pamn += $pamount['net_salary'];
			}
			
			return $pamn;
		}
	}
	if( !function_exists('total_expense') ){

		function total_expense(){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$TransactionsModel = new \App\Models\TransactionsModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$expense = $TransactionsModel->where('company_id',$company_id)->where('transaction_type', 'expense')->findAll();
			$exp_amn = 0;
			foreach($expense as $pamount){
				$exp_amn += $pamount['amount'];
			}
			
			return $exp_amn;
		}
	}
	if( !function_exists('total_deposit') ){

		function total_deposit(){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$TransactionsModel = new \App\Models\TransactionsModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$expense = $TransactionsModel->where('company_id',$company_id)->where('transaction_type', 'income')->findAll();
			$exp_amn = 0;
			foreach($expense as $pamount){
				$exp_amn += $pamount['amount'];
			}
			
			return $exp_amn;
		}
	}
	if( !function_exists('total_payroll') ){

		function total_payroll(){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$PayrollModel = new \App\Models\PayrollModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$paid_amount = $PayrollModel->where('company_id',$company_id)->findAll();
			$pinc = 0;
			$pamn = 0;
			foreach($paid_amount as $pamount){
				$pamn += $pamount['net_salary'];
			}
			if($pamn > 0){
				$pamn = $pamn;
			} else {
				$pamn = 0;
			}
			return $pamn;
		}
	}
	if (!function_exists('payroll_this_month'))
	{
		function payroll_this_month() {
				// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$PayrollModel = new \App\Models\PayrollModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$paid_amount = $PayrollModel->where('company_id',$company_id)->where('salary_month', date('Y-m'))->findAll();
			$pinc = 0;
			$pamn = 0;
			foreach($paid_amount as $pamount){
				$pamn += $pamount['net_salary'];
			}
			if($pamn > 0){
				$pamn = $pamn;
			} else {
				$pamn = 0;
			}
			return $pamn;
		}
	}
	if( !function_exists('staff_total_payroll') ){

		function staff_total_payroll(){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$PayrollModel = new \App\Models\PayrollModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$paid_amount = $PayrollModel->where('company_id',$company_id)->where('staff_id', $usession['sup_user_id'])->findAll();
			$pinc = 0;
			$pamn = 0;
			foreach($paid_amount as $pamount){
				$pamn += $pamount['net_salary'];
			}
			if($pamn > 0){
				$pamn = $pamn;
			} else {
				$pamn = 0;
			}
			return $pamn;
		}
	}
	if (!function_exists('staff_payroll_this_month'))
	{
		function staff_payroll_this_month() {
				// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$PayrollModel = new \App\Models\PayrollModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$paid_amount = $PayrollModel->where('company_id',$company_id)->where('salary_month', date('Y-m'))->where('staff_id', $usession['sup_user_id'])->findAll();
			$pinc = 0;
			$pamn = 0;
			foreach($paid_amount as $pamount){
				$pamn += $pamount['net_salary'];
			}
			if($pamn > 0){
				$pamn = $pamn;
			} else {
				$pamn = 0;
			}
			return $pamn;
		}
	}
	if( !function_exists('erp_total_paid_invoices') ){

		function erp_total_paid_invoices(){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$InvoicesModel = new \App\Models\InvoicesModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$paid_invoice = $InvoicesModel->where('company_id',$company_id)->where('status', 1)->findAll();
			$pinc = 0;
			foreach($paid_invoice as $pinvoice){
				$pinc += $pinvoice['grand_total'];
			}
			
			return $pinc;
		}
	}
	if( !function_exists('erp_total_unpaid_invoices') ){

		function erp_total_unpaid_invoices(){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$InvoicesModel = new \App\Models\InvoicesModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$paid_invoice = $InvoicesModel->where('company_id',$company_id)->where('status', 0)->findAll();
			$pinc = 0;
			foreach($paid_invoice as $pinvoice){
				$pinc += $pinvoice['grand_total'];
			}
			
			return $pinc;
		}
	}
	if( !function_exists('client_total_unpaid_invoices') ){

		function client_total_unpaid_invoices(){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$InvoicesModel = new \App\Models\InvoicesModel();
			$paid_invoice = $InvoicesModel->where('client_id',$usession['sup_user_id'])->where('status', 0)->findAll();
			$pinc = 0;
			foreach($paid_invoice as $pinvoice){
				$pinc += $pinvoice['grand_total'];
			}
			
			return $pinc;
		}
	}
	if( !function_exists('client_total_paid_invoices') ){

		function client_total_paid_invoices(){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$InvoicesModel = new \App\Models\InvoicesModel();
			$paid_invoice = $InvoicesModel->where('client_id',$usession['sup_user_id'])->where('status', 1)->findAll();
			$pinc = 0;
			foreach($paid_invoice as $pinvoice){
				$pinc += $pinvoice['grand_total'];
			}
			
			return $pinc;
		}
	}
	if( !function_exists('total_membership_payments') ){

		function total_membership_payments(){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$InvoicepaymentsModel = new \App\Models\InvoicepaymentsModel();
			$paid_invoice = $InvoicepaymentsModel->orderBy('membership_invoice_id','ASC')->findAll();
			$pinc = 0;
			foreach($paid_invoice as $pinvoice){
				$pinc += $pinvoice['membership_price'];
			}
			
			return $pinc;
		}
	}
	if( !function_exists('staff_total_expense') ){

		function staff_total_expense(){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$TransactionsModel = new \App\Models\TransactionsModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$expense = $TransactionsModel->where('company_id',$company_id)->where('transaction_type', 'expense')->where('staff_id', $usession['sup_user_id'])->findAll();
			$exp_amn = 0;
			foreach($expense as $pamount){
				$exp_amn += $pamount['amount'];
			}
			
			return $exp_amn;
		}
	}
	if( !function_exists('staff_leave') ){

		function staff_leave(){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$LeaveModel = new \App\Models\LeaveModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$leave = $LeaveModel->where('company_id',$company_id)->where('employee_id', $usession['sup_user_id'])->countAllResults();			
			return $leave;
		}
	}
	if( !function_exists('staff_overtime_request') ){

		function staff_overtime_request(){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$OvertimerequestModel = new \App\Models\OvertimerequestModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$overtime_req = $OvertimerequestModel->where('company_id',$company_id)->where('staff_id', $usession['sup_user_id'])->countAllResults();			
			return $overtime_req;
		}
	}
	if( !function_exists('staff_travel_request') ){

		function staff_travel_request(){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$TravelModel = new \App\Models\TravelModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$travel_req = $TravelModel->where('company_id',$company_id)->where('employee_id', $usession['sup_user_id'])->countAllResults();			
			return $travel_req;
		}
	}
	if( !function_exists('staff_awards') ){

		function staff_awards(){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$AwardsModel = new \App\Models\AwardsModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$awards = $AwardsModel->where('company_id',$company_id)->where('employee_id', $usession['sup_user_id'])->countAllResults();			
			return $awards;
		}
	}
	if( !function_exists('staff_assets') ){

		function staff_assets(){
					
			// get session
			$session = \Config\Services::session();
			$usession = $session->get('sup_username');
			
			$UsersModel = new \App\Models\UsersModel();
			$AssetsModel = new \App\Models\AssetsModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$assets = $AssetsModel->where('company_id',$company_id)->where('employee_id', $usession['sup_user_id'])->countAllResults();			
			return $assets;
		}
	}
	if( !function_exists('time_ago') ){
		function time_ago($time_ago)
		{
			$time_ago = strtotime($time_ago);
			$cur_time   = time();
			$time_elapsed   = $cur_time - $time_ago;
			$seconds    = $time_elapsed ;
			$minutes    = round($time_elapsed / 60 );
			$hours      = round($time_elapsed / 3600);
			$days       = round($time_elapsed / 86400 );
			$weeks      = round($time_elapsed / 604800);
			$months     = round($time_elapsed / 2600640 );
			$years      = round($time_elapsed / 31207680 );
			// Seconds
			if($seconds <= 60){
				return lang('Main.xin_just_now');
			}
			//Minutes
			else if($minutes <=60){
				if($minutes==1){
					return lang('Main.xin_one_minute_ago');
				}
				else{
					return "$minutes ".lang('Main.xin_minutes_ago');
				}
			}
			//Hours
			else if($hours <=24){
				if($hours==1){
					return lang('Main.xin_an_hour_ago');
				}else{
					return "$hours ".lang('Main.xin_hours_ago');
				}
			}
			//Days
			else if($days <= 7){
				if($days==1){
					return lang('Main.xin_yesterday');
				}else{
					return "$days ".lang('Main.xin_days_ago');
				}
			}
			//Weeks
			else if($weeks <= 4.3){
				if($weeks==1){
					return lang('Main.xin_a_week_ago');
				}else{
					return "$weeks ".lang('Main.xin_weeks_ago');
				}
			}
			//Months
			else if($months <=12){
				if($months==1){
					return lang('Main.xin_a_month_ago');
				}else{
					return "$months ".lang('Main.xin_months_ago');
				}
			}
			//Years
			else{
				if($years==1){
					return lang('Main.xin_one_year_ago');
				}else{
					return "$years ".lang('Main.xin_years_go');
				}
			}
		}
	}
	//////////////////////
	///Subscriptions invoice report
	if( !function_exists('company_sales_amount_current_month') ){

		function company_sales_amount_current_month(){
					
			$paid_amount = company_paid_invoices(date('Y-m'));
			
			return $paid_amount;
		}
	}
	if( !function_exists('company_sales_amount_last_month') ){

		function company_sales_amount_last_month(){
			
			$last_month = date('Y-m', strtotime(date('Y-m')." -1 month"));
			$paid_amount = company_paid_invoices($last_month);
			
			return $paid_amount;
		}
	}
	if( !function_exists('company_sales_amount_this_year') ){

		function company_sales_amount_this_year(){
			
			$Return = array('invoice_amount'=>'', 'paid_invoice'=>'','unpaid_invoice'=>'', 'paid_inv_label'=>'','unpaid_inv_label'=>'');
			
			$invoice_month = array();
			$paid_invoice = 0;
			$someArray = array();
			$j=0;
			for ($i = 0; $i <= 11; $i++) 
			{
			   $months = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));		   
			   $paid_amount = company_paid_invoices($months);
			   $paid_invoice += $paid_amount;
			  // $invoice_month[] = $months;		   
			}
			$Return['paid_invoice'] = $paid_invoice;
			return $paid_invoice;
		}
	}

	if( !function_exists('checkCarryBalnce') ){
		// function checkCarryBalnce($ieleave_option,$iquota_year,$joining_date_emp,$iassigned_hours,$_company_id,$user_info['user_id'],$constants_id,$summary_year,$fyear_quota) {
		function checkCarryBalnce($_company_id) {
				
			$db = \Config\Database::connect();
			$session = \Config\Services::session();
			$LeaveModel = new \App\Models\LeaveModel();
			$BalanceHistoryModel = new \App\Models\BalanceHistoryModel();
			$LeaveadjustModel = new \App\Models\LeaveadjustModel();
			$OvertimerequestModel = new \App\Models\OvertimerequestModel();
			$UsersModel = new \App\Models\UsersModel();
			$StaffdetailsModel = new \App\Models\StaffdetailsModel();
			$ConstantsModel = new \App\Models\ConstantsModel();
			
			$summary_year = date('Y')-1;
			$history = $BalanceHistoryModel->where('year',$summary_year)->where('company_id',$_company_id)->first();
			if(empty($history)) {
			$user = $UsersModel->where('user_id', $_company_id)->first();
			$date = $summary_year .'-'. $user['fiscal_date'];
			$date_end =  $summary_year+1 .'-'. $user['fiscal_date'];

			$company_details = $UsersModel->where('company_id',  $_company_id)->findAll();
			foreach($company_details as $user_info) {
				if($user_info['user_type'] == 'staff'){
					$_company_id = $user_info['company_id'];
				}
				else{
					$_company_id = $user_info['user_id'];
				}
				$employee_detail = $StaffdetailsModel->where('user_id', $user_info['user_id'])->first();
				$leave_types = $ConstantsModel->where('company_id',$_company_id)->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();

				// quota assignment year
				$ejoining_date = Time::parse($employee_detail['date_of_joining']);
				

				// strtotime()
				$curr_date = Time::parse(date('Y-m-d',strtotime($date)));
				//$curr_date = Time::parse(date($summary_year.'-m-d'));
				$diff_year_quota = $ejoining_date->difference($curr_date);
				$fyear_quota = $diff_year_quota->getYears();
				$quota_year = '+'.$diff_year_quota->getYears().' years';
				$y = strtotime($employee_detail['date_of_joining']." year");
				$iquota_year = date($summary_year, strtotime($quota_year, strtotime($employee_detail['date_of_joining'])));
				$joining_date_emp = date ( "Y",strtotime($employee_detail['date_of_joining']) ); 

				$rem_leave = 0;
				$taken_leave = 0;
				$pending_leave = 0;

				if($employee_detail['leave_options'] == '') {
					$ileave_option = 0;
				} else {
					$ileave_option = unserialize($employee_detail['leave_options']);
				}
				$fmonth = date('n',strtotime($employee_detail['date_of_joining']));
				$months = array(1 => 'Ja', 2 => 'Fe', 3 => 'Mar', 4 => 'Ap', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Au', 9 => 'Se', 10 => 'Oc', 11 => 'No', 12 => 'De');
				if($employee_detail['assigned_hours'] == '') {
					$iassigned_hours = 0;
				} else {
					$iassigned_hours = unserialize($employee_detail['assigned_hours']);
				}

				foreach($leave_types as $ltype)
				{
				   
					$ieleave_option = unserialize($ltype['field_one']);
					// print_r($ieleave_option);
					if(isset($iassigned_hours[$ltype['constants_id']])) {
					  $iiiassigned_hours = $iassigned_hours[$ltype['constants_id']];
					  if($iiiassigned_hours == 0){
						if(isset($ieleave_option['quota_assign']) && $ieleave_option['is_quota'] == 1) {
						 if(isset($ieleave_option['quota_assign'][$fyear_quota])) {
						   $iiiassigned_hours = $ieleave_option['quota_assign'][$fyear_quota];
						 } else {
						   $iiiassigned_hours = 0;
						 }
						 } else {
						   $iiiassigned_hours = 0;
						 }
					  }
					 } //else {
					 if(isset($ieleave_option['quota_assign']) && $ieleave_option['is_quota'] == 1) {
					 if(isset($ieleave_option['quota_assign'][$fyear_quota])) {
					   $iquota_assigned_hours = $ieleave_option['quota_assign'][$fyear_quota];
					 } else {
					   $iquota_assigned_hours = 0;
					 }
					 } else {
					   $iquota_assigned_hours = 0;
					 }
					  // 
					 //}
					 if(isset($ieleave_option['is_carry'])){if($ieleave_option['is_carry'] == 1) {  
					   if(isset($ieleave_option['carry_limit'])) {
						 if($summary_year > $joining_date_emp  ) {
							$bal = $BalanceHistoryModel->where('year',$summary_year-1)->where('company_id',$_company_id)->where('leave_type',$ltype['category_name'])->where('user_id',$report_user_id)->first();
							if(!empty($bal)) {
							 $carry_limit_balance = $ieleave_option['carry_limit'];
							 if($carry_limit_balance < $bal['balance']) {
								$carry_limit =   $ieleave_option['carry_limit'];
							  
							  } else {
								$carry_limit = $bal['balance'];
							  }
							} else {
							 $carry_limit = 0;
							}
						 } else {
						  $carry_limit = 0;
						 }
					   } else {
						 $carry_limit = 0;
					   }
					 } else {
					   $carry_limit = 0;
					 }
				   }
					// leave taken
					// $taken_leave = 
					$taken_leave_query = 'SELECT 
				   SUM(leave_hours) AS leave_hours 
				  FROM
					`ci_leave_applications` 
				  WHERE `company_id` =  '.$_company_id.'
					AND `employee_id` = '.$user_info['user_id'].' 
					AND `leave_type_id` = '.$ltype['constants_id'].' 
					AND `status` = 2 
					AND (from_date BETWEEN "'.$date.'" AND "'.$date_end.'" OR "'.$date.'" BETWEEN from_date AND to_date)';
					$taken_leave  = $db->query($taken_leave_query)->getResult();
					$taken_leave  =  $taken_leave[0]->leave_hours;
	
					$pending_leave_query = 'SELECT 
				   SUM(leave_hours) AS leave_hours 
				  FROM
					`ci_leave_applications` 
				  WHERE `company_id` =  '.$_company_id.'
					AND `employee_id` = '.$user_info['user_id'].' 
					AND `leave_type_id` = '.$ltype['constants_id'].' 
					AND `status` = 1 
					AND (from_date BETWEEN "'.$date.'" AND "'.$date_end.'" OR "'.$date.'" BETWEEN from_date AND to_date)';
					$pending_leave  = $db->query($pending_leave_query)->getResult();
					$pending_leave  =  $pending_leave[0]->leave_hours;
	
					if($taken_leave == "") {
					  $taken_leave = 0;
					} 
	
					if($pending_leave == "") {
					  $pending_leave = 0;
					}
	
				   // entitled_total
					$total_entitled = $iquota_assigned_hours + $carry_limit;
					$ictotal_entitled = $total_entitled;
					if($ltype['constants_id'] == 199){
						$query_overtime = 'SELECT 
						* 
					  FROM
						`ci_timesheet_request` 
					  WHERE `staff_id` =  '.$user_info['user_id'].'
						AND `compensation_type` = 1 
						AND `is_approved` = 1 
						AND request_date BETWEEN "'.$date.'" AND "'.$date_end.'"';
					   
						$cnt_overtime  = $db->query($query_overtime)->getNumRows();
					   
						if($cnt_overtime > 0){
							// Declare an array containing times
							$ittotal_entitled = $total_entitled.':00';
							$exp_hr = explode(':',$ittotal_entitled);
							$newibanked_hours = overtime_request_banked_hours($user_info['user_id']);    
							$iexpbanked_hours = explode(':',$newibanked_hours);                 
							$ictotal_entitled = $iexpbanked_hours[0] + $exp_hr[0].':'.$iexpbanked_hours[1];
						}
					}
					if(isset($ieleave_option['enable_leave_accrual']) && $ieleave_option['enable_leave_accrual'] == 1){
					  if(isset($ieleave_option['quota_assign']) && $ieleave_option['is_quota'] == 1) {
						if(isset($ieleave_option['quota_assign'][$fyear_quota])) {
						  $squota_assign = $ieleave_option['quota_assign'][$fyear_quota];
						 
						  $sdiv_days = $squota_assign / 12;
						  if(date_create($date_end) >= date_create(date('Y-m-d'))  ) {
							// 
							$ts1 = strtotime($date);
							$today = strtotime(date("Y-m-d"));
							$ts2 =    strtotime("+1 month", $today);
							$year1 = date('Y', $ts1);
							$year2 = date('Y', $ts2);
							$month1 = date('m', $ts1);
							$month2 = date('m', $ts2);
	
							$diff =  (($year2 - $year1) * 12) + ($month2 - $month1);
							$sdiv_days = $sdiv_days *abs($diff);
						   
						  } elseif(date_create($date) <= date_create($employee_detail['date_of_joining']) && date_create($date_end) >= date_create($employee_detail['date_of_joining'])) {
							
							$ts1 = strtotime($employee_detail['date_of_joining']);
							$ts2 = strtotime($date_end);
							$year1 = date('Y', $ts1);
							$year2 = date('Y', $ts2);
							$month1 = date('m', $ts1);
							$month2 = date('m', $ts2);
							$diff =  (($year2 - $year1) * 12) + ($month2 - $month1);
							$sdiv_days = $sdiv_days *abs($diff);
						  } else {
				
							$sdiv_days = $sdiv_days * 12;
						  }
						  if(is_float($sdiv_days)){
							$rem_leave = number_format($sdiv_days, 1);
							// $diff
						   
						  } else {
						   
							$rem_leave = $sdiv_days;
						  }
						  
						} else {
						  $rem_leave = 0;
						}
						} else {
						  $rem_leave = 0;
						}
					} else {
					  $rem_leave = 0;
					}
	
					// leave adjustment
					$leave_adjust_count = $LeaveadjustModel->where('company_id',$_company_id)->where('employee_id',$report_user_id)->where('leave_type_id',$ltype['constants_id'])->where('status', 1)->where('DATE_FORMAT(STR_TO_DATE(created_at, "%d-%m-%Y"), "%Y-%m-%d") BETWEEN "'.$date.'" AND "'.$date_end.'"')->countAllResults();
					$leave_adjustment = $LeaveadjustModel->where('company_id',$_company_id)->where('employee_id',$report_user_id)->where('leave_type_id',$ltype['constants_id'])->where('status', 1)->where('DATE_FORMAT(STR_TO_DATE(created_at, "%d-%m-%Y"), "%Y-%m-%d") BETWEEN "'.$date.'" AND "'.$date_end.'"')->findAll();
					$total_adjust = 0;
					foreach($leave_adjustment as $ladjust){
						$total_adjust += $ladjust['adjust_hours'];
					}
					//$sictotal_entitled = $ictotal_entitled + $rem_leave + $total_adjust;
					$sictotal_entitled = $ictotal_entitled;

					$balance = ($sictotal_entitled+$total_adjust)-$taken_leave;
					$current_balance = ($rem_leave+$carry_limit+$total_adjust)-$taken_leave;
					$data = [
						'year'=> $summary_year,
						'leave_type'=> $ltype['category_name'],
						'user_id'=> $user_info['user_id'],
						'balance'=> $current_balance,
						'company_id'=> $_company_id
					];
					$result = $BalanceHistoryModel->insert($data);
					
				// echo "<pre>";
                // echo $summary_year;
				// echo "summary_year";
				// echo "<br>";
				// echo $ltype['category_name'];
				// echo "ltype";
				// echo "<br>";
				
				// echo $balance;
				// echo "balance";
				// echo "<br>";
				// echo $user_info['user_id'];
				// echo "user_id";
				// echo "<br>";
				// echo "</pre>";
				// echo "------------------";
			}
		
			
			

			

			
			
			}
			// die("dsfdsfsdfsdfsfsd");
		}
		return $result;
	}
	// 
	}
