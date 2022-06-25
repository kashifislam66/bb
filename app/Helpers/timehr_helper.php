<?php
use CodeIgniter\I18n\Time;
//TimeHRM - Helper
if( !function_exists('dashboard_profile_completeness') ){

	function dashboard_profile_completeness(){
				
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$ShiftModel = new \App\Models\ShiftModel();
		$RolesModel = new \App\Models\RolesModel();
		$ConstantsModel = new \App\Models\ConstantsModel();
		$DesignationModel = new \App\Models\DesignationModel();
		$DepartmentModel = new \App\Models\DepartmentModel();		
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$departments = $DepartmentModel->where('company_id',$usession['sup_user_id'])->countAllResults();
		$designations = $DesignationModel->where('company_id',$usession['sup_user_id'])->countAllResults();
		$office_shifts = $ShiftModel->where('company_id',$usession['sup_user_id'])->countAllResults();
		$roles = $RolesModel->where('company_id',$usession['sup_user_id'])->countAllResults();
		$competencies = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','competencies')->countAllResults();
		$competencies2 = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','competencies2')->countAllResults();
		$fcompetencies = $competencies + $competencies2;
		if($roles > 0): $roles = 1; endif;
		if($fcompetencies > 1): $fcompetencies = 1; else: $fcompetencies = 0; endif;
		if($departments > 0): $departments = 1; endif;
		if($designations > 0): $designations = 1; endif;
		if($office_shifts > 0): $office_shifts = 1; endif;
		
		$val = $roles + $fcompetencies + $departments + $designations + $office_shifts;
		$total_val = $val * 20;
		$data = array('departments' => $departments,'designations' => $designations,'office_shifts' => $office_shifts,'roles' => $roles,'competencies' => $fcompetencies,'percent' => $total_val);
		return $data;
	}
}
if( !function_exists('attendance_time_checks') ){

	function attendance_time_checks(){
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$today_date = date('Y-m-d');
		$UsersModel = new \App\Models\UsersModel();
		$TimesheetModel = new \App\Models\TimesheetModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$get_data = $TimesheetModel->where('company_id',$user_info['company_id'])->where('employee_id',$usession['sup_user_id'])->where('attendance_date',$today_date)->where('clock_out','')->orderBy('time_attendance_id', 'DESC')->countAllResults();
		if($get_data > 0): $get_data = 1; else: $get_data = 0; endif;
		return $get_data;
	}
}
if( !function_exists('attendance_time_checks_value') ){
	// attendance_time_checks_value
	function attendance_time_checks_value(){	

		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$builder = $db->table('ci_timesheet');
		$builder->where('company_id', $user_info['company_id']);
		$builder->where('employee_id', $usession['sup_user_id']);
		$builder->where('clock_out', '');
		$builder->orderBy('time_attendance_id', 'DESC');
		$builder->limit(1);
		$query = $builder->get();
		return $query->getResult();
	}
}

if( !function_exists('check_user_attendance') ){

	function check_user_attendance(){
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$today_date = date('Y-m-d');
		$UsersModel = new \App\Models\UsersModel();
		$TimesheetModel = new \App\Models\TimesheetModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$get_data = $TimesheetModel->where('company_id',$user_info['company_id'])->where('employee_id',$usession['sup_user_id'])->where('attendance_date',$today_date)->orderBy('time_attendance_id', 'DESC')->countAllResults();
		if($get_data > 0): $get_data = 1; else: $get_data = 0; endif;
		return $get_data;
	}
}

if( !function_exists('user_attendance_kiosk') )
{
	function user_attendance_kiosk($user_id = 0)
	{	
		$today_date = date('Y-m-d');
		$UsersModel = new \App\Models\UsersModel();
		$TimesheetModel = new \App\Models\TimesheetModel();
		$user_info = $UsersModel->where('user_id', $user_id)->first();
		$get_data = $TimesheetModel->where('company_id',$user_info['company_id'])->where('employee_id',$user_id)->where('attendance_date',$today_date)->orderBy('time_attendance_id', 'DESC')->countAllResults();
		if($get_data > 0): $get_data = 1; else: $get_data = 0; endif;
		return $get_data;
	}
}

if (!function_exists('debug')) {
    function debug($arr, $exit = true)
    {
	     print "<pre>";
	     print_r($arr);
	     print "</pre>";
	     if($exit)
	      exit;
	}
}

function createBase64($string) {
    $urlCode = base64_encode($string);
    return str_replace(array('+','/','='),array('-','_',''),$urlCode);
}

function decodeBase64($base64ID) {
    $data = str_replace(array('-','_'),array('+','/'),$base64ID);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
            $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}

if( !function_exists('check_user_attendance_value') ){
	// check_user_attendance
	function check_user_attendance_value(){	

		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$usession = $session->get('sup_username');
		$today_date = date('Y-m-d');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$builder = $db->table('ci_timesheet');
		$builder->where('company_id', $user_info['company_id']);
		$builder->where('employee_id', $usession['sup_user_id']);
		$builder->where('attendance_date', $today_date);
		$builder->orderBy('time_attendance_id', 'DESC');
		$builder->limit(1);
		$query = $builder->get();
		return $query->getResult();
	}
}

if( !function_exists('check_user_attendance_value_kiosk') )
{
	// check_user_attendance
	function check_user_attendance_value_kiosk($user_id = 0)
	{	
		$db = \Config\Database::connect();
		$UsersModel = new \App\Models\UsersModel();
		$today_date = date('Y-m-d');
		$user_info = $UsersModel->where('user_id', $user_id)->first();
		$builder = $db->table('ci_timesheet');
		$builder->where('company_id', $user_info['company_id']);
		$builder->where('employee_id', $user_id);
		$builder->where('attendance_date', $today_date);
		$builder->orderBy('time_attendance_id', 'DESC');
		$builder->limit(1);
		$query = $builder->get();
		return $query->getResult();
	}
}


if( !function_exists('check_user_attendance_clockout_value') ){
	// check_user_attendance
	function check_user_attendance_clockout_value(){	

		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$usession = $session->get('sup_username');
		$today_date = date('Y-m-d');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$builder = $db->table('ci_timesheet');
		$builder->where('company_id', $user_info['company_id']);
		$builder->where('employee_id', $usession['sup_user_id']);
		$builder->where('attendance_date', $today_date);
		$builder->where('clock_out', '');
		$builder->orderBy('time_attendance_id', 'DESC');
		$builder->limit(1);
		$query = $builder->get();
		return $query->getResult();
	}
}

if(!function_exists('check_user_attendance_clockout_value_kiosk') ){
	// check_user_attendance
	function check_user_attendance_clockout_value_kiosk($user_id = 0)
	{	
		$db = \Config\Database::connect();
		$UsersModel = new \App\Models\UsersModel();
		$today_date = date('Y-m-d');
		$user_info = $UsersModel->where('user_id', $user_id)->first();
		$builder = $db->table('ci_timesheet');
		$builder->where('company_id', $user_info['company_id']);
		$builder->where('employee_id', $user_info['user_id']);
		$builder->where('attendance_date', $today_date);
		$builder->where('clock_out', '');
		$builder->orderBy('time_attendance_id', 'DESC');
		$builder->limit(1);
		$query = $builder->get();
		return $query->getResult();
	}
}


if( !function_exists('user_attendance_monthly_value') ){
	// user_attendance_monthly_value
	function user_attendance_monthly_value($attendance_date,$user_id){	

		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$UsersModel = new \App\Models\UsersModel();
		$TimesheetModel = new \App\Models\TimesheetModel();
		$user_info = $UsersModel->where('user_id', $user_id)->first();
		$get_data = $TimesheetModel->where('company_id',$user_info['company_id'])->where('employee_id',$user_id)->where('attendance_date',$attendance_date)->orderBy('time_attendance_id', 'DESC')->countAllResults();
		if($get_data > 0): $get_data = 1; else: $get_data = 0; endif;
		return $get_data;
	}
}
// single user
if( !function_exists('staff_profile_photo') ){
	function staff_profile_photo($user_id){
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$user_info = $UsersModel->where('user_id', $user_id)->first();
		if($user_info['user_type'] != 'customer'){
			if($user_info['profile_photo'] == '' || $user_info['profile_photo'] == 'no'){
				if($user_info['gender']==1) {
					$user_img = base_url().'/public/uploads/users/default/default_profile.jpg';
				} else {
					$user_img = base_url().'/public/uploads/users/default/default_profile.jpg';
				}
			} else {
				$user_img = base_url().'/public/uploads/users/thumb/'.$user_info['profile_photo'];
			}
		} else {
			if($user_info['profile_photo'] == '' || $user_info['profile_photo'] == 'no'){
				if($user_info['gender']==1) {
					$user_img = base_url().'/public/uploads/users/default/default_profile.jpg';
				} else {
					$user_img = base_url().'/public/uploads/users/default/default_profile.jpg';
				}
			} else {
				$user_img = base_url().'/public/uploads/clients/thumb/'.$user_info['profile_photo'];
			}
		}
		return $user_img;
	}
}
// multi users with profile photo
// multi users with profile photo
if( !function_exists('multi_user_profile_photo') ){
	function multi_user_profile_photo($multi_user){
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		
		$ol = '';
		foreach($multi_user as $user_id) {
			// get staff info
			if($user_id!=0){
				$assigned_to = $UsersModel->where('user_id', $user_id)->where('user_type','staff')->first();
				if($assigned_to){
					$assigned_name = $assigned_to['first_name'].' '.$assigned_to['last_name'];
					if($assigned_to['profile_photo'] == ''){
						if($assigned_to['gender']==1) {
							$user_img = base_url().'/public/uploads/users/default/default_profile.jpg';
						} else {
							$user_img = base_url().'/public/uploads/users/default/default_profile.jpg';
						}
						$ol .= '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="'.$assigned_name.'"><span class="mb-1"><img src="'.$user_img.'" class="img-fluid img-radius wid-30 mr-1" alt=""></span></a>';
					} else {
						$user_img = base_url().'/public/uploads/users/thumb/'.$assigned_to['profile_photo'];
						$ol .= '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="'.$assigned_name.'"><span class="mb-1"><img src="'.$user_img.'" class="img-fluid img-radius wid-30 mr-1" alt=""></span></a>';
					}
					$ol .= '';
				} else {
					$ol .= '';
				}
			}
			$ol .= '';
		}
		$ol .= '';
		return $ol;
	}
}
// multi users only names
if( !function_exists('multi_users_info') ){
	function multi_users_info($multi_user){
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		
		$ol = ''; $i=0;
		foreach($multi_user as $user_id) {
			// get staff info
			if($user_id) {
				if($user_id!=0){
					$assigned_to = $UsersModel->where('user_id', $user_id)->where('user_type','staff')->first();
					if($assigned_to) {
					$assigned_name = $assigned_to['first_name'].' '.$assigned_to['last_name'];
					$ol .= $i.': '.$assigned_name.'<br>';
					} else {
						$ol .= '';
					}
				}
			} else {
				$ol .= '';
			}
			$ol .= '';
			$i++;
		}
		$ol .= '';
		return $ol;
	}
}
// company membership || expiry
if( !function_exists('user_company_info') ){
	function user_company_info(){
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$UsersModel = new \App\Models\UsersModel();
				
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'company'){
			$company_id = $usession['sup_user_id'];
		} else if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else if($user_info['user_type'] == 'customer'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		return $company_id;
	}
}
// company membership || expiry
if( !function_exists('company_membership_details') ){
	function company_membership_details(){
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		//use CodeIgniter\I18n\Time;
		//new \App\I18n\Time();
		$UsersModel = new \App\Models\UsersModel();
		$MembershipModel = new \App\Models\MembershipModel();
		$CompanymembershipModel = new \App\Models\CompanymembershipModel();
	
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
					
		$company_membership = $CompanymembershipModel->where('company_id', $usession['sup_user_id'])->first();
		$subs_plan = $MembershipModel->where('membership_id', $company_membership['membership_id'])->first();
		
		if($subs_plan['plan_duration']==1){
			if($subs_plan['membership_id']==1){
				$time = Time::parse($company_membership['update_at'], 'Asia/Karachi');
				$add_time = $time->addMonths(1);
				$now = Time::now('Asia/Karachi');
				$itime = Time::parse($add_time, 'Asia/Karachi');
				$diff_days = $now->difference($itime);
				$plan_msg = lang('Membership.xin_trial_is_expiring').' '.$diff_days->getDays().' '.lang('Leave.xin_leave_days');
				$remaing_days = $diff_days->getDays();
			} else {
				$time = Time::parse($company_membership['update_at'], 'Asia/Karachi');
				$add_time = $time->addMonths(1);
				$now = Time::now('Asia/Karachi');
				$itime = Time::parse($add_time, 'Asia/Karachi');
				$diff_days = $now->difference($itime);
				$plan_msg = lang('Membership.xin_plan_is_expiring').' '.$diff_days->getDays().' '.lang('Leave.xin_leave_days');
				$remaing_days = $diff_days->getDays();
			}
			$plan_duration = lang('Membership.xin_subscription_monthly');
		} else if($subs_plan['plan_duration']==2){
			if($subs_plan['membership_id']==1){
				$time = Time::parse($company_membership['update_at'], 'Asia/Karachi');
				$add_time = $time->addYears(1);
				$now = Time::now('Asia/Karachi');
				$itime = Time::parse($add_time, 'Asia/Karachi');
				$diff_days = $now->difference($itime);
				$plan_msg = lang('Membership.xin_trial_is_expiring').' '.$diff_days->getDays().' '.lang('Leave.xin_leave_days');
				$remaing_days = $diff_days->getDays();
			} else {
				$time = Time::parse($company_membership['update_at'], 'Asia/Karachi');
				$add_time = $time->addYears(1);
				$now = Time::now('Asia/Karachi');
				$itime = Time::parse($add_time, 'Asia/Karachi');
				$diff_days = $now->difference($itime);
				$plan_msg = lang('Membership.xin_plan_is_expiring').' '.$diff_days->getDays().' '.lang('Leave.xin_leave_days');
				$remaing_days = $diff_days->getDays();
			}
			$plan_duration = lang('Membership.xin_subscription_yearly');
		} else if($subs_plan['plan_duration']==3){
			if($subs_plan['membership_id']==1){
				$plan_msg = lang('Main.xin_you_are_using_lifetime_plan');
			} else {
				$plan_msg = lang('Main.xin_you_are_using_lifetime_plan');
			}
			$time_diff = '';
			$plan_duration = lang('Main.xin_plan_lifetime');
			$remaing_days = 300*100;
		} else if($subs_plan['plan_duration']==4){
			if($subs_plan['membership_id']==1){
				$time = Time::parse($company_membership['update_at'], 'Asia/Karachi');
				$add_time = $time->addDays(7);
				$now = Time::now('Asia/Karachi');
				$itime = Time::parse($add_time, 'Asia/Karachi');
				$diff_days = $now->difference($itime);
				$plan_msg = lang('Membership.xin_trial_is_expiring').' '.$diff_days->getDays().' '.lang('Leave.xin_leave_days');
				$remaing_days = $diff_days->getDays();
			} else {
				$time = Time::parse($company_membership['update_at'], 'Asia/Karachi');
				$add_time = $time->addDays(7);
				$now = Time::now('Asia/Karachi');
				$itime = Time::parse($add_time, 'Asia/Karachi');
				$diff_days = $now->difference($itime);
				$plan_msg = lang('Membership.xin_plan_is_expiring').' '.$diff_days->getDays().' '.lang('Leave.xin_leave_days');
				$remaing_days = $diff_days->getDays();
			}
			$plan_duration = lang('Main.xin_plan_weekly');
		} else if($subs_plan['plan_duration']==5){
			if($subs_plan['membership_id']==1){
				$time = Time::parse($company_membership['update_at'], 'Asia/Karachi');
				$add_time = $time->addDays(14);
				$now = Time::now('Asia/Karachi');
				$itime = Time::parse($add_time, 'Asia/Karachi');
				$diff_days = $now->difference($itime);
				$plan_msg = lang('Membership.xin_trial_is_expiring').' '.$diff_days->getDays().' '.lang('Leave.xin_leave_days');
				$remaing_days = $diff_days->getDays();
			} else {
				$time = Time::parse($company_membership['update_at'], 'Asia/Karachi');
				$add_time = $time->addDays(14);
				$now = Time::now('Asia/Karachi');
				$itime = Time::parse($add_time, 'Asia/Karachi');
				$diff_days = $now->difference($itime);
				$plan_msg = lang('Membership.xin_plan_is_expiring').' '.$diff_days->getDays().' '.lang('Leave.xin_leave_days');
				$remaing_days = $diff_days->getDays();
			}
			$plan_duration = lang('Main.xin_14days');
		}
		$plan_data = array('plan_msg' => $plan_msg,'plan_duration' => $plan_duration,'diff_days' => $remaing_days);
		return $plan_data;
	}
}
// company membership || In-Active|Active
if( !function_exists('company_membership_activation') ){
	function company_membership_activation(){
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		//use CodeIgniter\I18n\Time;
		//new \App\I18n\Time();
		$UsersModel = new \App\Models\UsersModel();
		$MembershipModel = new \App\Models\MembershipModel();
		$CompanymembershipModel = new \App\Models\CompanymembershipModel();
	
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'company'){
			$company_id = $usession['sup_user_id'];
		} else if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else if($user_info['user_type'] == 'customer'){
			$company_id = $user_info['company_id'];
		}
		
		$company_membership = $CompanymembershipModel->where('company_id', $company_id)->first();
		$subs_plan = $MembershipModel->where('membership_id', $company_membership['membership_id'])->first();
		
		if($subs_plan['plan_duration']==1){
			$time = Time::parse($company_membership['update_at'], 'Asia/Karachi');
			$add_time = $time->addMonths(1);
			$now = Time::now('Asia/Karachi');
			$itime = Time::parse($add_time, 'Asia/Karachi');
			$diff_days = $now->difference($itime);
			$time_diff = $itime->isAfter($now);
			return $time_diff;
		} else if($subs_plan['plan_duration']==2){
			$time = Time::parse($company_membership['update_at'], 'Asia/Karachi');
			$add_time = $time->addYears(1);
			$now = Time::now('Asia/Karachi');
			$itime = Time::parse($add_time, 'Asia/Karachi');
			$diff_days = $now->difference($itime);
			$time_diff = $itime->isAfter($now);
			return $time_diff;
		} else if($subs_plan['plan_duration']==4){
			$time = Time::parse($company_membership['update_at'], 'Asia/Karachi');
			$add_time = $time->addDays(7);
			$now = Time::now('Asia/Karachi');
			$itime = Time::parse($add_time, 'Asia/Karachi');
			$diff_days = $now->difference($itime);
			$time_diff = $itime->isAfter($now);
			return $time_diff;
		} else if($subs_plan['plan_duration']==5){
			$time = Time::parse($company_membership['update_at'], 'Asia/Karachi');
			$add_time = $time->addDays(14);
			$now = Time::now('Asia/Karachi');
			$itime = Time::parse($add_time, 'Asia/Karachi');
			$diff_days = $now->difference($itime);
			$time_diff = $itime->isAfter($now);
			return $time_diff;
		} else {
			return 1;
		}
	}
}
if( !function_exists('notification_data') ){
	function notification_data(){
	}
}
if( !function_exists('erp_company_settings') ){
	function erp_company_settings(){
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');

		$UsersModel = new \App\Models\UsersModel();
		$CompanysettingsModel = new \App\Models\CompanysettingsModel();
		//if(!empty($usession)){
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'company'){
			$company_id = $usession['sup_user_id'];
		} else if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else if($user_info['user_type'] == 'customer'){
			$company_id = $user_info['company_id'];
		} else if($user_info['user_type'] == 'candidate'){
			$company_id = $user_info['company_id'];
		}
		
		$company_settings = $CompanysettingsModel->where('company_id', $company_id)->first();
		return $company_settings;
	}
}

if( !function_exists('generate_timezone_list') ){
function generate_timezone_list()
	{
		static $regions = array(
			DateTimeZone::AFRICA,
			DateTimeZone::AMERICA,
			DateTimeZone::ANTARCTICA,
			DateTimeZone::ASIA,
			DateTimeZone::ATLANTIC,
			DateTimeZone::AUSTRALIA,
			DateTimeZone::EUROPE,
			DateTimeZone::INDIAN,
			DateTimeZone::PACIFIC,
		);
	
		$timezones = array();
		foreach( $regions as $region )
		{
			$timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
		}
	
		$timezone_offsets = array();
		foreach( $timezones as $timezone )
		{
			$tz = new DateTimeZone($timezone);
			$timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
		}
	
		// sort timezone by offset
		asort($timezone_offsets);
	
		$timezone_list = array();
		foreach( $timezone_offsets as $timezone => $offset )
		{
			$offset_prefix = $offset < 0 ? '-' : '+';
			$offset_formatted = gmdate( 'H:i', abs($offset) );
	
			$pretty_offset = "UTC${offset_prefix}${offset_formatted}";
	
			$timezone_list[$timezone] = "(${pretty_offset}) $timezone";
		}
	
		return $timezone_list;
	}
}
if( !function_exists('timehrm_mail_data') ){

	function timehrm_mail_data($from,$from_name,$to,$subject,$body){
	  
		
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$SystemModel = new \App\Models\SystemModel();
		$UsersModel = new \App\Models\UsersModel();
		$EmailconfigModel = new \App\Models\EmailconfigModel();
		
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$email_config = $EmailconfigModel->where('email_config_id', 1)->first();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		
		if($xin_system['email_type']=="codeigniter"){
			//default email config
			$email = \Config\Services::email();
			//$email->mailType("html");
			$email->setFrom($from,$from_name);
			$email->setTo($to);
			$email->setSubject($subject);
			$email->setMessage($body);
			$email->send();
		
		} elseif($xin_system['email_type']=="smtp"){
			//default smtp config
			
			$email = \Config\Services::email();
			
			$config['protocol'] = 'sendmail';
            $config['mailPath'] = '/usr/sbin/sendmail';
            $config['charset']  = 'iso-8859-1';
            $config['wordWrap'] = true;
            $config['SMTPHost']     = $email_config['smtp_host'];
    		$config['SMTPUser']     = $email_config['smtp_username'];
    		$config['SMTPPass']     = $email_config['smtp_password'];
    		$config['SMTPPort']     = $email_config['smtp_port'];
			$config['SMTPCrypto']   = $email_config['smtp_secure'];

    		$email->initialize($config);
			$email->setFrom($from,$from_name);
			$email->setTo($to);
			$email->setSubject($subject);
			$email->setMessage($body);
			$email->send();
		
		} elseif($xin_system['email_type']=="phpmail"){
		
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			
			// More headers
			$headers .= 'From: ' .$from. "\r\n";
			
			mail($to,$subject,$body,$headers); 
		
		}
	  
	}
}
if( !function_exists('account_statement_report') ){

	function account_statement_report($start_date,$end_date,$get_id){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$AccountsModel = new \App\Models\AccountsModel();
		$TransactionsModel = new \App\Models\TransactionsModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		
		$builder = $db->table('ci_finance_transactions');
		$builder->where('transaction_date BETWEEN "'. $start_date. '" and "'. $end_date.'"');
		$builder->where('account_id', $get_id);
		$builder->where('company_id', $company_id);
		$query = $builder->get();
		$transaction_data = $query->getResult();
		
		return $transaction_data;
	}
}
if( !function_exists('training_report') ){

	function training_report($start_date,$end_date,$status){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$TrainingModel = new \App\Models\TrainingModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		if($status == 'all_status'){
			$training_data = $TrainingModel->where('company_id', $company_id)->where('start_date >=',$start_date)->where('finish_date <=' ,$end_date)->findAll();
		} else {
			$training_data = $TrainingModel->where('company_id', $company_id)->where('start_date >=',$start_date)->where('finish_date <=' ,$end_date)->where('training_status' ,$status)->findAll();
		}
		
		return $training_data;
	}
}
if( !function_exists('leave_report') ){

	function leave_report($start_date,$end_date,$status){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$LeaveModel = new \App\Models\LeaveModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		if($status == 'all_status'){
			$leave_data = $LeaveModel->where('company_id', $company_id)->where('from_date >=',$start_date)->where('to_date <=' ,$end_date)->findAll();
		} else {
			$leave_data = $LeaveModel->where('company_id', $company_id)->where('from_date >=',$start_date)->where('to_date <=' ,$end_date)->where('status' ,$status)->findAll();
		}
		
		return $leave_data;
	}
}
if( !function_exists('invoice_report') ){

	function invoice_report($start_date,$end_date,$status){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$AccountsModel = new \App\Models\AccountsModel();
		$TransactionsModel = new \App\Models\TransactionsModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		
		$builder = $db->table('ci_invoices');
		if($status == 'all_status'){
			$builder->where('invoice_date BETWEEN "'. $start_date. '" and "'. $end_date.'"');
			$builder->where('company_id', $company_id);
		} else {
			$builder->where('invoice_date BETWEEN "'. $start_date. '" and "'. $end_date.'"');
			$builder->where('status', $status);
			$builder->where('company_id', $company_id);
		}
		
		$query = $builder->get();
		$transaction_data = $query->getResult();
		
		return $transaction_data;
	}
}
if( !function_exists('daterange_attendance_report') ){

	function daterange_attendance_report($start_date,$end_date,$staff_id){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$TimesheetModel = new \App\Models\TimesheetModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		
		$builder = $db->table('ci_timesheet');
		$builder->where('attendance_date BETWEEN "'. $start_date. '" and "'. $end_date.'"');
		$builder->where('employee_id', $staff_id);
		$builder->where('company_id', $company_id);
		
		$query = $builder->get();
		$attendance_data = $query->getResult();
		
		return $attendance_data;
	}
}
if( !function_exists('timesheet_overtime_report') ){

	function timesheet_overtime_report($start_date,$end_date,$staff_id){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$OvertimerequestModel = new \App\Models\OvertimerequestModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		
		$builder = $db->table('ci_timesheet_request');
		$builder->where('request_date BETWEEN "'. $start_date. '" and "'. $end_date.'"');
		$builder->where('staff_id', $staff_id);
		$builder->where('company_id', $company_id);
		$builder->where('is_approved', 1);
		
		$query = $builder->get();
		$attendance_data = $query->getResult();
		
		return $attendance_data;
	}
}
if( !function_exists('purchases_report') ){

	function purchases_report($start_date,$end_date,$status){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$PurchasesModel = new \App\Models\PurchasesModel();
		//$TransactionsModel = new \App\Models\TransactionsModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		
		$builder = $db->table('ci_stock_purchases');
		if($status == 'all_status'){
			$builder->where('purchase_date BETWEEN "'. $start_date. '" and "'. $end_date.'"');
			$builder->where('company_id', $company_id);
		} else {
			$builder->where('purchase_date BETWEEN "'. $start_date. '" and "'. $end_date.'"');
			$builder->where('status', $status);
			$builder->where('company_id', $company_id);
		}
		
		$query = $builder->get();
		$purchases_data = $query->getResult();
		
		return $purchases_data;
	}
}
if( !function_exists('sales_report') ){

	function sales_report($start_date,$end_date,$status){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$AccountsModel = new \App\Models\AccountsModel();
		$TransactionsModel = new \App\Models\TransactionsModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		
		$builder = $db->table('ci_stock_orders');
		if($status == 'all_status'){
			$builder->where('invoice_date BETWEEN "'. $start_date. '" and "'. $end_date.'"');
			$builder->where('company_id', $company_id);
		} else {
			$builder->where('invoice_date BETWEEN "'. $start_date. '" and "'. $end_date.'"');
			$builder->where('status', $status);
			$builder->where('company_id', $company_id);
		}
		
		$query = $builder->get();
		$transaction_data = $query->getResult();
		
		return $transaction_data;
	}
}
if( !function_exists('currency_converter_values') ){

	function currency_converter_values() {	
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		
		$url = 'https://api.exchangerate-api.com/v4/latest/'.$xin_system['default_currency'];
	//	$to_currency = $toCurrency;
		$url=file_get_contents($url);
		$url = json_decode($url);
		$rates = $url->rates;
		return $rates;
	}
}
if( !function_exists('currency_converted_values') ){

	function currency_converted_values() {	
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$currency_val = unserialize($xin_system['currency_converter']);
		
		$converted=0;
		foreach($currency_val as $_val=>$_key){
			if($_val == $xin_system['default_currency']){
				echo $converted = $_key;
			} 
		}
	}
}
if( !function_exists('currency_converter') ){

	function currency_converter($amount) {	
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$xin_system = erp_company_settings();
		$xin_super_system = $SystemModel->where('setting_id', 1)->first();
		$currency_val = unserialize($xin_super_system['currency_converter']);
		$i=0;
		$converted =0;
		foreach($currency_val as $_val=>$_key){
			if($_val == $xin_system['default_currency']){
				$converted = $_key * $amount;
				return $converted;
			}
			$i++;
		}
	}
}
if( !function_exists('staff_projects') ){

	function staff_projects($id){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$ProjectsModel = new \App\Models\ProjectsModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$company_id = $user_info['company_id'];
		
		$data = $ProjectsModel->where('company_id',$company_id)->where("assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'")->findAll();
		
		return $data;
	}
}
if( !function_exists('assigned_staff_projects') ){

	function assigned_staff_projects($id){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$ProjectsModel = new \App\Models\ProjectsModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$company_id = $user_info['company_id'];
		
		$data = $ProjectsModel->where('company_id',$company_id)->where("assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'")->findAll();
		
		return $data;
	}
}
if( !function_exists('assigned_staff_projects_board') ){

	function assigned_staff_projects_board($id){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$ProjectsModel = new \App\Models\ProjectsModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$company_id = $user_info['company_id'];
		
		$not_started_projects = $ProjectsModel->where('company_id',$company_id)->where('status',0)->where("assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'")->findAll();
		$inprogress_projects = $ProjectsModel->where('company_id',$company_id)->where('status',1)->where("assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'")->findAll();
		$completed_projects = $ProjectsModel->where('company_id',$company_id)->where('status',2)->where("assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'")->findAll();
		$cancelled_projects = $ProjectsModel->where('company_id',$company_id)->where('status',3)->where("assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'")->findAll();
		$hold_projects = $ProjectsModel->where('company_id',$company_id)->where('status',4)->where("assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'")->findAll();
		$data = array('not_started_projects'=>$not_started_projects,'inprogress_projects'=>$inprogress_projects,'completed_projects'=>$completed_projects,'cancelled_projects'=>$cancelled_projects,'hold_projects'=>$hold_projects);
		return $data;
	}
}
if( !function_exists('assigned_staff_tasks') ){

	function assigned_staff_tasks($id){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$TasksModel = new \App\Models\TasksModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$company_id = $user_info['company_id'];
		
		$data = $TasksModel->where('company_id',$company_id)->where('task_type','project')->where("assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'")->findAll();
		
		return $data;
	}
}
if( !function_exists('assigned_staff_general_tasks') ){

	function assigned_staff_general_tasks($id){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$TasksModel = new \App\Models\TasksModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$company_id = $user_info['company_id'];
		
		$data = $TasksModel->where('company_id',$company_id)->where('task_type','general')->where("assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'")->findAll();
		
		return $data;
	}
}
if( !function_exists('assigned_staff_tasks_board') ){

	function assigned_staff_tasks_board($id){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$TasksModel = new \App\Models\TasksModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$company_id = $user_info['company_id'];
		
		$not_started_tasks = $TasksModel->where('company_id',$company_id)->where('task_status',0)->where("assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'")->findAll();
		$inprogress_tasks = $TasksModel->where('company_id',$company_id)->where('task_status',1)->where("assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'")->findAll();
		$completed_tasks = $TasksModel->where('company_id',$company_id)->where('task_status',2)->where("assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'")->findAll();
		$cancelled_tasks = $TasksModel->where('company_id',$company_id)->where('task_status',3)->where("assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'")->findAll();
		$hold_tasks = $TasksModel->where('company_id',$company_id)->where('task_status',4)->where("assigned_to like '%$id,%' or assigned_to like '%,$id%' or assigned_to = '$id'")->findAll();
		$data = array('not_started_tasks'=>$not_started_tasks,'inprogress_tasks'=>$inprogress_tasks,'completed_tasks'=>$completed_tasks,'cancelled_tasks'=>$cancelled_tasks,'hold_tasks'=>$hold_tasks);
		
		return $data;
	}
}
if( !function_exists('assigned_staff_training') ){

	function assigned_staff_training($id){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$TrainingModel = new \App\Models\TrainingModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$company_id = $user_info['company_id'];
		
		$data = $TrainingModel->where('company_id',$company_id)->where("employee_id like '%$id,%' or employee_id like '%,$id%' or employee_id = '$id'")->findAll();
		
		return $data;
	}
}
if( !function_exists('assigned_staff_events') ){

	function assigned_staff_events($id){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$EventsModel = new \App\Models\EventsModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$company_id = $user_info['company_id'];
		
		$data = $EventsModel->where('company_id',$company_id)->where("employee_id like '%$id,%' or employee_id like '%,$id%' or employee_id = '$id'")->findAll();
		
		return $data;
	}
}
if( !function_exists('assigned_staff_conference') ){

	function assigned_staff_conference($id){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$MeetingModel = new \App\Models\MeetingModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$company_id = $user_info['company_id'];
		
		$data = $MeetingModel->where('company_id',$company_id)->where("employee_id like '%$id,%' or employee_id like '%,$id%' or employee_id = '$id'")->findAll();
		
		return $data;
	}
}
if( !function_exists('count_leads_followup') ){

	function count_leads_followup($lead_id){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$LeadsfollowupModel = new \App\Models\LeadsfollowupModel();
		
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		
		$count_result = $LeadsfollowupModel->where('company_id',$company_id)->where('lead_id',$lead_id)->countAllResults();
		
		return $count_result;
	}
}
if( !function_exists('timehrm_sms_data') ){

	function timehrm_sms_data($recipient,$sms_body){
		// get db
		$db      = \Config\Database::connect();	
		// get session
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$UsersModel = new \App\Models\UsersModel();
		$SystemModel = new \App\Models\SystemModel();
		$SmstemplatesModel = new \App\Models\SmstemplatesModel();
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$service_plan_id = $xin_system['sms_service_plan_id'];
		$bearer_token = $xin_system['sms_bearer_token'];
		
		$send_from = $xin_system['sms_from'];
		$recipient_phone_numbers = $recipient; //May be several, separate with a comma `,`.
		$message = $sms_body;
		
		// Check recipient_phone_numbers for multiple numbers and make it an array.
		if(stristr($recipient_phone_numbers, ',')){
		  $recipient_phone_numbers = explode(',', $recipient_phone_numbers);
		}else{
		  $recipient_phone_numbers = [$recipient_phone_numbers];
		}
		
		// Set necessary fields to be JSON encoded
		$content = [
		  'to' => array_values($recipient_phone_numbers),
		  'from' => $send_from,
		  'body' => $message
		];
		
		$data = json_encode($content);
		
		$ch = curl_init("https://us.sms.api.sinch.com/xms/v1/{$service_plan_id}/batches");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
		curl_setopt($ch, CURLOPT_XOAUTH2_BEARER, $bearer_token);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		$result = curl_exec($ch);
		
		if(curl_errno($ch)) {
			//echo 'Curl error: ' . curl_error($ch);
		} else {
			//echo $result;
		}
		curl_close($ch);
		 //return $result;
			
			return $data;
	}
}
if( !function_exists('format_size_units') ){
	function format_size_units($bytes) {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
	}
}

if( !function_exists('staff_aniiversary_calendar') ){
	// check_user_attendance
	function staff_aniiversary_calendar(){	

		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$usession = $session->get('sup_username');
		$today_date = date('Y-m-d');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		//$builder = $db->table('ci_erp_users_details');
		$data = $StaffdetailsModel
		->where('company_id',$company_id)
		->where("date_of_joining",date("Y-m-d",strtotime('+1 year')))
		->findAll();
		return $data;
	}
}
if( !function_exists('cal_days_in_year') ){
	function cal_days_in_year($year){
		$days=0; 
		for($month=1;$month<=12;$month++){ 
			$days = $days + cal_days_in_month(CAL_GREGORIAN,$month,$year);
		 }
	 return $days;
	}
}
if( !function_exists('read_json_for_form') ){
	function read_json_for_form($form_id){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$FormsfieldModel = new \App\Models\FormsfieldModel();
		$StaffdetailsModel = new \App\Models\StaffdetailsModel();
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		$formfields = $FormsfieldModel
		->where('company_id',$company_id)
		->where("form_id",$form_id)
		->findAll();
		$json = [] ;
		foreach ($formfields as $formfield) {
			//if (isset($fields)) foreach ($fields as $field) {
				$json[] = json_decode($formfield['json_data']);
			//}
		}
		return json_encode($json);
	}
}
if( !function_exists('read_json_for_completed_form') ){
	function read_json_for_completed_form($form_id){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();
		$FormsModel = new \App\Models\FormsModel();
		$FormsfieldModel = new \App\Models\FormsfieldModel();
		$FormscompletedfieldsModel = new \App\Models\FormscompletedfieldsModel();
		
		$usession = $session->get('sup_username');

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		
		$builder = $db->table('ci_form_fields');
		$builder->select('*');
		$builder->join('ci_form_completed_fields', 'ci_form_fields.form_field_id = ci_form_completed_fields.field_key');
		$builder->where('ci_form_fields.form_id', $form_id);
		$query = $builder->get();
		$formscompleted = $query->getResult();
		return $formscompleted;
	}
}
if( !function_exists('chat_time_ago') ){
	function chat_time_ago($timestamp){
		//$time_now = mktime(date('h')+0,date('i')+30,date('s'));
		$datetime1=new DateTime("now");
		$datetime2=date_create($timestamp);
		$diff=date_diff($datetime1, $datetime2);
		$timemsg='';
		if($diff->y > 0){
			$timemsg = $diff->y ." <sup>year".($diff->y > 1?"s":'')."</sup>";
	
		}
		else if($diff->m > 0){
			$timemsg = $diff->m . " <sup>month".($diff->m > 1?"s":'')."</sup>";
		}
		else if($diff->d > 0){
			$timemsg = $diff->d ." <sup>day".($diff->d > 1?"s":'')."</sup>";
		}
		else if($diff->h > 0){
			$timemsg = $diff->h ." <sup>hr".($diff->h > 1?"s":'')."</sup>";
		}
		else if($diff->i > 0){
			$timemsg = $diff->i ." <sup>min".($diff->i > 1?"s":'')."</sup>";
		}
		else if($diff->s > 0){
			$timemsg = $diff->s ." <sup>sec".($diff->s > 1?"s":'')."</sup>";
		}
	
		$timemsg = $timemsg;
		return $timemsg;
	}
}
if( !function_exists('notifications_mark_all_as_read') ){
	function notifications_submission_mark_all_as_read($module_option){
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
		$multi_level_notifications = top_level_notifications_info();
		if($module_option == 'incident_settings') {
			$top_level_notify_upon_submission_incident = top_level_notify_upon_submission_incident('incident_settings');
			$incident_submission_count = $top_level_notify_upon_submission_incident['top_incident_submission_alert_cnt'];
			$key_field_id = $top_level_notify_upon_submission_incident['key_id'];	
			
			$top_incident_alert_approval_data = top_level_notify_upon_approval_incident('incident_settings');
			$incident_approval_count = $top_incident_alert_approval_data['top_incident_approval_alert_cnt'];
			$akey_field_id = $top_incident_alert_approval_data['key_id'];	
			if($incident_submission_count > 0) {
				foreach($key_field_id as $field_id) {
					update_notifications_read_status_pending('incident_settings',$field_id);
				}
			}
			if($incident_approval_count > 0) {
				foreach($akey_field_id as $afield_id) {
					update_notifications_read_status_approved('incident_settings',$afield_id);
				}
			}
		}
		if($module_option == 'complaint_settings') {
			$top_complaint_submission_alert_data = top_level_notify_upon_submission_complaints('complaint_settings');
			$complaint_submission_count = $top_complaint_submission_alert_data['top_complaint_submission_alert_cnt'];
			$key_field_id = $top_complaint_submission_alert_data['key_id'];	
			
			$top_complaint_approval_alert_data = top_level_notify_upon_approval_complaints('complaint_settings');
			$complaint_approval_count = $top_complaint_approval_alert_data['top_complaint_approval_alert_cnt'];
			$akey_field_id = $top_complaint_approval_alert_data['key_id'];	
			if($complaint_submission_count > 0) {
				foreach($key_field_id as $field_id) {
					update_notifications_read_status_pending('complaint_settings',$field_id);
				}
			}
			if($complaint_approval_count > 0) {
				foreach($akey_field_id as $afield_id) {
					update_notifications_read_status_approved('complaint_settings',$afield_id);
				}
			}
		}
		if($module_option == 'leave_settings') {
			$top_leave_alert_submission_data = top_level_notify_upon_submission_leave('leave_settings');
			$leave_submission_count = $top_leave_alert_submission_data['top_leave_submission_alert_cnt'];
			$key_field_id = $top_leave_alert_submission_data['key_id'];	
			
			$top_leave_alert_approval_data = top_level_notify_upon_approval_leave('leave_settings');
			$leave_approval_count = $top_leave_alert_approval_data['top_leave_approval_alert_cnt'];
			$akey_field_id = $top_leave_alert_approval_data['key_id'];	
			if($leave_submission_count > 0) {
				foreach($key_field_id as $field_id) {
					update_notifications_read_status_pending('leave_settings',$field_id);
				}
			}
			if($leave_approval_count > 0) {
				foreach($akey_field_id as $afield_id) {
					update_notifications_read_status_approved('leave_settings',$afield_id);
				}
			}
		}
		if($module_option == 'leave_adjustment_settings') {
			$top_leave_adjust_alert_submission_data = top_level_notify_upon_submission_leave_adjust('leave_adjustment_settings');
			$leave_adjust_submission_count = $top_leave_adjust_alert_submission_data['top_leave_adjust_submission_alert_cnt'];
			$key_field_id = $top_leave_adjust_alert_submission_data['key_id'];	
			
			$top_leave_adjust_alert_approval_data = top_level_notify_upon_approval_leave_adjust('leave_adjustment_settings');
			$leave_adjust_approval_count = $top_leave_adjust_alert_approval_data['top_leave_adjust_approval_alert_cnt'];
			$akey_field_id = $top_leave_adjust_alert_approval_data['key_id'];	
			if($leave_adjust_submission_count > 0) {
				foreach($key_field_id as $field_id) {
					update_notifications_read_status_pending('leave_adjustment_settings',$field_id);
				}
			}
			if($leave_adjust_approval_count > 0) {
				foreach($akey_field_id as $afield_id) {
					update_notifications_read_status_approved('leave_adjustment_settings',$afield_id);
				}
			}
		}
		if($module_option == 'overtime_request_settings') {
			$top_overtime_alert_submission_data = top_level_notify_upon_submission_overtime('overtime_request_settings');
			$overtime_submission_count = $top_overtime_alert_submission_data['top_overtime_submission_alert_cnt'];
			$key_field_id = $top_overtime_alert_submission_data['key_id'];	
			
			$top_overtime_alert_approval_data = top_level_notify_upon_approval_overtime('overtime_request_settings');
			$overtime_approval_count = $top_overtime_alert_approval_data['top_overtime_approval_alert_cnt'];
			$akey_field_id = $top_overtime_alert_approval_data['key_id'];	
			if($overtime_submission_count > 0) {
				foreach($key_field_id as $field_id) {
					update_notifications_read_status_pending('overtime_request_settings',$field_id);
				}
			}
			if($overtime_approval_count > 0) {
				foreach($akey_field_id as $afield_id) {
					update_notifications_read_status_approved('overtime_request_settings',$afield_id);
				}
			}
		}
		if($module_option == 'transfer_settings') {
			$top_transfer_alert_submission_data = top_level_notify_upon_submission_transfer('transfer_settings');
			$transfer_submission_count = $top_transfer_alert_submission_data['top_transfer_submission_alert_cnt'];
			$key_field_id = $top_transfer_alert_submission_data['key_id'];	
			
			$top_transfer_alert_approval_data = top_level_notify_upon_approval_transfer('transfer_settings');
			$transfer_approval_count = $top_transfer_alert_approval_data['top_transfer_approval_alert_cnt'];
			$akey_field_id = $top_transfer_alert_approval_data['key_id'];	
			if($transfer_submission_count > 0) {
				foreach($key_field_id as $field_id) {
					update_notifications_read_status_pending('transfer_settings',$field_id);
				}
			}
			if($transfer_approval_count > 0) {
				foreach($akey_field_id as $afield_id) {
					update_notifications_read_status_approved('transfer_settings',$afield_id);
				}
			}
		}
		if($module_option == 'resignation_settings') {
			$top_resignation_alert_submission_data = top_level_notify_upon_submission_resignation('resignation_settings');
			$resignation_submission_count = $top_resignation_alert_submission_data['top_resignation_submission_alert_cnt'];
			$key_field_id = $top_resignation_alert_submission_data['key_id'];	
			
			$top_resignation_alert_approval_data = top_level_notify_upon_approval_resignation('resignation_settings');
			$resignation_approval_count = $top_resignation_alert_approval_data['top_resignation_approval_alert_cnt'];
			$akey_field_id = $top_resignation_alert_approval_data['key_id'];	
			if($resignation_submission_count > 0) {
				foreach($key_field_id as $field_id) {
					update_notifications_read_status_pending('resignation_settings',$field_id);
				}
			}
			if($resignation_approval_count > 0) {
				foreach($akey_field_id as $afield_id) {
					update_notifications_read_status_approved('resignation_settings',$afield_id);
				}
			}
		}
		if($module_option == 'travel_settings') {
			$top_travel_alert_submission_data = top_level_notify_upon_submission_travel('travel_settings');
			$travel_submission_count = $top_travel_alert_submission_data['top_travel_submission_alert_cnt'];
			$key_field_id = $top_travel_alert_submission_data['key_id'];	
			
			$top_travel_alert_approval_data = top_level_notify_upon_approval_travel('travel_settings');
			$travel_approval_count = $top_travel_alert_approval_data['top_travel_approval_alert_cnt'];
			$akey_field_id = $top_travel_alert_approval_data['key_id'];	
			if($travel_submission_count > 0) {
				foreach($key_field_id as $field_id) {
					update_notifications_read_status_pending('travel_settings',$field_id);
				}
			}
			if($travel_approval_count > 0) {
				foreach($akey_field_id as $afield_id) {
					update_notifications_read_status_approved('travel_settings',$afield_id);
				}
			}
		}
		if($module_option == 'attendance_settings') {
			$top_attendance_alert_submission_data = top_level_notify_upon_submission_attendance('attendance_settings');
			$attendance_submission_count = $top_attendance_alert_submission_data['top_attendance_submission_alert_cnt'];
			$key_field_id = $top_attendance_alert_submission_data['key_id'];	
			
			$top_attendance_alert_approval_data = top_level_notify_upon_approval_attendance('attendance_settings');
			$attendance_approval_count = $top_attendance_alert_approval_data['top_attendance_approval_alert_cnt'];
			$akey_field_id = $top_attendance_alert_approval_data['key_id'];	
			if($attendance_submission_count > 0) {
				foreach($key_field_id as $field_id) {
					update_notifications_read_status_pending('attendance_settings',$field_id);
				}
			}
			if($attendance_approval_count > 0) {
				foreach($akey_field_id as $afield_id) {
					update_notifications_read_status_approved('attendance_settings',$afield_id);
				}
			}
		}
		
		////
	}
}
if( !function_exists('update_notifications_read_status_pending') ){
	function update_notifications_read_status_pending($module_options,$ifield_id){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();	
		$LeaveModel = new \App\Models\LeaveModel();
		$TravelModel = new \App\Models\TravelModel();
		$TransfersModel = new \App\Models\TransfersModel();
		$TimesheetModel = new \App\Models\TimesheetModel();
		$IncidentsModel = new \App\Models\IncidentsModel();		
		$ComplaintsModel = new \App\Models\ComplaintsModel();
		$LeaveadjustModel = new \App\Models\LeaveadjustModel();	
		$ResignationsModel = new \App\Models\ResignationsModel();
		$OvertimerequestModel = new \App\Models\OvertimerequestModel();
		
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
		
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $user_info['company_id'])
		->where('module_options', $module_options)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $user_info['company_id'])
			->where('module_options', $module_options)
			->first();
			$notify_upon_submission = explode(',',$notify_level['notify_upon_submission']);
			$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
			if($module_options == 'incident_settings'){
				// notificaiton for him/herself
				$data_cnt = $IncidentsModel->where('company_id',$user_info['company_id'])->where('incident_id',$ifield_id)->where('status',0)->countAllResults();
				if($data_cnt > 0){
					$get_data = $IncidentsModel->where('company_id',$user_info['company_id'])->where('incident_id',$ifield_id)->where('status',0)->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_submission) 
					|| in_array($option_self, $notify_upon_submission) 
					|| in_array($option_manager, $notify_upon_submission)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 0,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'complaint_settings'){
				// notificaiton for him/herself
				$data_cnt = $ComplaintsModel->where('company_id',$user_info['company_id'])->where('complaint_id',$ifield_id)->where('status',0)->countAllResults();
				if($data_cnt > 0){
					$get_data = $ComplaintsModel->where('company_id',$user_info['company_id'])->where('complaint_id',$ifield_id)->where('status',0)->first();
					$staff_cnt = $StaffdetailsModel->whereIn('user_id', $get_data['complaint_against'])->where('user_id',$usession['sup_user_id'])->countAllResults();
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
					if (in_array($usession['sup_user_id'], $notify_upon_submission) 
					|| in_array($option_self, $notify_upon_submission) 
					|| in_array($option_manager, $notify_upon_submission)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 0,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'leave_settings'){
				// notificaiton for him/herself
				$data_cnt = $LeaveModel->where('company_id',$user_info['company_id'])->where('leave_id',$ifield_id)->where('status',1)->countAllResults();
				if($data_cnt > 0){
					$get_data = $LeaveModel->where('company_id',$user_info['company_id'])->where('leave_id',$ifield_id)->where('status',1)->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_submission) 
					|| in_array($option_self, $notify_upon_submission) 
					|| in_array($option_manager, $notify_upon_submission)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 1,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'leave_adjustment_settings'){
				// notificaiton for him/herself
				$data_cnt = $LeaveadjustModel->where('company_id',$user_info['company_id'])->where('adjustment_id',$ifield_id)->where('status',0)->countAllResults();
				if($data_cnt > 0){
					$get_data = $LeaveadjustModel->where('company_id',$user_info['company_id'])->where('adjustment_id',$ifield_id)->where('status',0)->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_submission) 
					|| in_array($option_self, $notify_upon_submission) 
					|| in_array($option_manager, $notify_upon_submission)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 0,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'travel_settings'){
				// notificaiton for him/herself
				$data_cnt = $TravelModel->where('company_id',$user_info['company_id'])->where('travel_id',$ifield_id)->where('status',0)->countAllResults();
				if($data_cnt > 0){
					$get_data = $TravelModel->where('company_id',$user_info['company_id'])->where('travel_id',$ifield_id)->where('status',0)->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_submission) 
					|| in_array($option_self, $notify_upon_submission) 
					|| in_array($option_manager, $notify_upon_submission)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 0,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'overtime_request_settings'){
				// notificaiton for him/herself
				$data_cnt = $OvertimerequestModel->where('company_id',$user_info['company_id'])->where('time_request_id',$ifield_id)->where('is_approved',0)->countAllResults();
				if($data_cnt > 0){
					$get_data = $OvertimerequestModel->where('company_id',$user_info['company_id'])->where('time_request_id',$ifield_id)->where('is_approved',0)->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_submission) 
					|| in_array($option_self, $notify_upon_submission) 
					|| in_array($option_manager, $notify_upon_submission)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 0,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'transfer_settings'){
				// notificaiton for him/herself
				$data_cnt = $TransfersModel->where('company_id',$user_info['company_id'])->where('transfer_id',$ifield_id)->where('status',0)->countAllResults();
				if($data_cnt > 0){
					$get_data = $TransfersModel->where('company_id',$user_info['company_id'])->where('transfer_id',$ifield_id)->where('status',0)->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_submission) 
					|| in_array($option_self, $notify_upon_submission) 
					|| in_array($option_manager, $notify_upon_submission)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 0,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'resignation_settings'){
				// notificaiton for him/herself
				$data_cnt = $ResignationsModel->where('company_id',$user_info['company_id'])->where('resignation_id',$ifield_id)->where('status',0)->countAllResults();
				if($data_cnt > 0){
					$get_data = $ResignationsModel->where('company_id',$user_info['company_id'])->where('resignation_id',$ifield_id)->where('status',0)->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_submission) 
					|| in_array($option_self, $notify_upon_submission) 
					|| in_array($option_manager, $notify_upon_submission)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 0,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'attendance_settings'){
				// notificaiton for him/herself
				$data_cnt = $TimesheetModel->where('company_id',$user_info['company_id'])->where('time_attendance_id',$ifield_id)->where('status','Pending')->countAllResults();
				if($data_cnt > 0){
					$get_data = $TimesheetModel->where('company_id',$user_info['company_id'])->where('time_attendance_id',$ifield_id)->where('status','Pending')->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_submission) 
					|| in_array($option_self, $notify_upon_submission) 
					|| in_array($option_manager, $notify_upon_submission)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',0)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 0,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			///
			
		}
	}
}
if( !function_exists('update_notifications_read_status_approved') ){
	function update_notifications_read_status_approved($module_options,$ifield_id){
		$db      = \Config\Database::connect();
		// get session
		$session = \Config\Services::session();
		$UsersModel = new \App\Models\UsersModel();	
		$LeaveModel = new \App\Models\LeaveModel();
		$TravelModel = new \App\Models\TravelModel();
		$TransfersModel = new \App\Models\TransfersModel();
		$TimesheetModel = new \App\Models\TimesheetModel();
		$IncidentsModel = new \App\Models\IncidentsModel();		
		$ComplaintsModel = new \App\Models\ComplaintsModel();
		$LeaveadjustModel = new \App\Models\LeaveadjustModel();	
		$ResignationsModel = new \App\Models\ResignationsModel();
		$OvertimerequestModel = new \App\Models\OvertimerequestModel();
		
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
		
		$notify_level_cnt = $NotificationsModel
		->where('company_id', $user_info['company_id'])
		->where('module_options', $module_options)
		->countAllResults();
		if($notify_level_cnt > 0){
			$notify_level = $NotificationsModel
			->where('company_id', $user_info['company_id'])
			->where('module_options', $module_options)
			->first();
			$notify_upon_submission = explode(',',$notify_level['notify_upon_submission']);
			$notify_upon_approval = explode(',',$notify_level['notify_upon_approval']);
			if($module_options == 'incident_settings'){
				// notificaiton for him/herself
				$data_cnt = $IncidentsModel->where('company_id',$user_info['company_id'])->where('incident_id',$ifield_id)->where('status',1)->countAllResults();
				if($data_cnt > 0){
					$get_data = $IncidentsModel->where('company_id',$user_info['company_id'])->where('incident_id',$ifield_id)->where('status',1)->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_approval) 
					|| in_array($option_self, $notify_upon_approval) 
					|| in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 1,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'complaint_settings'){
				// notificaiton for him/herself
				$data_cnt = $ComplaintsModel->where('company_id',$user_info['company_id'])->where('complaint_id',$ifield_id)->where('status',1)->countAllResults();
				if($data_cnt > 0){
					$get_data = $ComplaintsModel->where('company_id',$user_info['company_id'])->where('complaint_id',$ifield_id)->where('status',1)->first();
					$staff_cnt = $StaffdetailsModel->where('user_id', $get_data['complaint_from'])->where('user_id',$usession['sup_user_id'])->countAllResults();
					// notificaiton for manager
					$manager_cnt = $StaffdetailsModel->where('user_id', $get_data['complaint_from'])->where('reporting_manager',$usession['sup_user_id'])->countAllResults();
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
					if (in_array($usession['sup_user_id'], $notify_upon_approval) 
					|| in_array($option_self, $notify_upon_approval) 
					|| in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 1,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'leave_settings'){
				// notificaiton for him/herself
				$data_cnt = $LeaveModel->where('company_id',$user_info['company_id'])->where('leave_id',$ifield_id)->where('status',2)->countAllResults();
				if($data_cnt > 0){
					$get_data = $LeaveModel->where('company_id',$user_info['company_id'])->where('leave_id',$ifield_id)->where('status',2)->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_approval) 
					|| in_array($option_self, $notify_upon_approval) 
					|| in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',2)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 2,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'leave_adjustment_settings'){
				// notificaiton for him/herself
				$data_cnt = $LeaveadjustModel->where('company_id',$user_info['company_id'])->where('adjustment_id',$ifield_id)->where('status',1)->countAllResults();
				if($data_cnt > 0){
					$get_data = $LeaveadjustModel->where('company_id',$user_info['company_id'])->where('adjustment_id',$ifield_id)->where('status',1)->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_approval) 
					|| in_array($option_self, $notify_upon_approval) 
					|| in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 1,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'travel_settings'){
				// notificaiton for him/herself
				$data_cnt = $TravelModel->where('company_id',$user_info['company_id'])->where('travel_id',$ifield_id)->where('status',1)->countAllResults();
				if($data_cnt > 0){
					$get_data = $TravelModel->where('company_id',$user_info['company_id'])->where('travel_id',$ifield_id)->where('status',1)->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_approval) 
					|| in_array($option_self, $notify_upon_approval) 
					|| in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 1,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'overtime_request_settings'){
				// notificaiton for him/herself
				$data_cnt = $OvertimerequestModel->where('company_id',$user_info['company_id'])->where('time_request_id',$ifield_id)->where('is_approved',1)->countAllResults();
				if($data_cnt > 0){
					$get_data = $OvertimerequestModel->where('company_id',$user_info['company_id'])->where('time_request_id',$ifield_id)->where('is_approved',1)->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_approval) 
					|| in_array($option_self, $notify_upon_approval) 
					|| in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 1,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'transfer_settings'){
				// notificaiton for him/herself
				$data_cnt = $TransfersModel->where('company_id',$user_info['company_id'])->where('transfer_id',$ifield_id)->where('status',1)->countAllResults();
				if($data_cnt > 0){
					$get_data = $TransfersModel->where('company_id',$user_info['company_id'])->where('transfer_id',$ifield_id)->where('status',1)->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_approval) 
					|| in_array($option_self, $notify_upon_approval) 
					|| in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 1,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'resignation_settings'){
				// notificaiton for him/herself
				$data_cnt = $ResignationsModel->where('company_id',$user_info['company_id'])->where('resignation_id',$ifield_id)->where('status',1)->countAllResults();
				if($data_cnt > 0){
					$get_data = $ResignationsModel->where('company_id',$user_info['company_id'])->where('resignation_id',$ifield_id)->where('status',1)->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_approval) 
					|| in_array($option_self, $notify_upon_approval) 
					|| in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 1,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
			if($module_options == 'attendance_settings'){
				// notificaiton for him/herself
				$data_cnt = $TimesheetModel->where('company_id',$user_info['company_id'])->where('time_attendance_id',$ifield_id)->where('status','Approved')->countAllResults();
				if($data_cnt > 0){
					$get_data = $TimesheetModel->where('company_id',$user_info['company_id'])->where('time_attendance_id',$ifield_id)->where('status','Approved')->first();
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
					if (in_array($usession['sup_user_id'], $notify_upon_approval) 
					|| in_array($option_self, $notify_upon_approval) 
					|| in_array($option_manager, $notify_upon_approval)) {
					$notify_status_cnt = $NotificationstatusModel->where('module_option',$module_options)->where('staff_id',$usession['sup_user_id'])->where('module_status',1)->where('module_key_id',$ifield_id)->countAllResults();
						if($notify_status_cnt > 0){
						} else {
							$data2 = [
								'staff_id'  => $usession['sup_user_id'],
								'module_key_id'  => $ifield_id,
								'module_option'  => $module_options,
								'module_status'  => 1,
								'is_read'  => 1
							];
							$NotificationstatusModel->insert($data2);
						}
					}
				}
			}
		}
	}
}
