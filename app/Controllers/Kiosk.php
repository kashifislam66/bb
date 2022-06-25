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
 
use App\Models\UsersModel;
use App\Models\KioskModel;
use App\Models\ShiftModel;
use App\Models\StaffdetailsModel;
use App\Models\TimesheetModel;

class Kiosk extends BaseController {

	public function __construct()
	{
		//date_default_timezone_set("America/Los_Angeles");
	}

	public function index($company_id = '')
	{
		$data = [];
		$company_id = udecode($company_id);
		$UsersModel = new UsersModel();
		$session = \Config\Services::session();
		$db = \Config\Database::connect();
        
		$users = $UsersModel->where('company_id',$company_id)->where('is_active',1)->findAll();
		if(empty($users)){
			exit("There are no users for this company");
		}
		$total_employees = count($users);
		$present_employees = [];
		$absent_employees = [];
		$employees_on_leave = [];
		// echo "<pre>";
		// print_r($users);
		foreach($users as $key => $value){

			$builder = $db->table('ci_leave_applications');
			$builder->where('"'.date("Y-m-d"). '" BETWEEN from_date AND to_date');
			$builder->where('employee_id', $value['user_id']);
			$builder->where('status!=', 3);
			$query = $builder->get();
			$FieldCount = $query->getNumRows();
			if($FieldCount > 0) {
				array_push($employees_on_leave, $value);
				continue;
			}

			$TimesheetModel = new TimesheetModel();
			$kiosk = $TimesheetModel->where('employee_id', $value['user_id'])->where('attendance_date', date("Y-m-d"))->orderBy('time_attendance_id','DESC')->limit(1)->first();
			if(empty($kiosk) || !empty($kiosk['clock_out'])){
                array_push($absent_employees, $value);
			}
			if(!empty($kiosk['clock_in']) && empty($kiosk['clock_out'])){
				$value['sign_in_time'] = $kiosk['clock_in'];
                array_push($present_employees, $value);
			}
		}
        $present_employees_no = count($present_employees);
        $absent_employees_no = count($absent_employees)+count($employees_on_leave);
        $present_percentage = ($present_employees_no/100)*$total_employees;
        $absent_percentage = ($absent_employees_no/100)*$total_employees;
        $data['present_percentage'] = $present_percentage*100;
        $data['absent_percentage'] = $absent_percentage*100;
        $data['present_employees'] = $present_employees;
		$data['absent_employees'] = $absent_employees;
		$data['employees_on_leave'] = $employees_on_leave;
		$data['company_id'] = $company_id;

		$SystemModel = new \App\Models\SystemModel();
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['system_timezone'] = (!empty($xin_system['system_timezone']))?$xin_system['system_timezone']:"America/Vancouver";

		return view('kiosk/index', $data); 
	}

	public function set_clocking() 
	{
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();

		$Return = array('result'=>'', 'error'=>'','signed_in'=>false,'signed_out'=>false);
		$formData = $this->request->getPost();
		//debug($formData);

        $UsersModel = new UsersModel();
		$user = $UsersModel->where('kiosk_code', $formData['kiosk_code'])->first();
		if(empty($user)){
			$Return['error'] = "Please enter a valid code.";
			$this->output($Return);
		}
		$user_id = $user['user_id'];
		
		$UsersModel = new UsersModel();
		$ShiftModel = new ShiftModel();
		$StaffdetailsModel = new StaffdetailsModel();
		$user_info = $UsersModel->where('user_id', $user_id)->first();
		$staff_details = $StaffdetailsModel->where('user_id', $user_id)->first();
		$company_id = $user_info['company_id'];
		$employee_id = $user_id;
		$office_shift_id = $staff_details['office_shift_id'];
		
		$clock_state = $this->request->getPost('clock_state',FILTER_SANITIZE_STRING);
		$ip_address = $request->getIPAddress();
		$work_from_home = 0;
		//time|today
		$nowtime = date("Y-m-d H:i:s");
		$today_date = date('Y-m-d');
		// set rules
		if($clock_state=='clock_in') {
			// check holiday
			$db = \Config\Database::connect();
			$ibuilder = $db->table('ci_holidays');
			//echo $today_date; exit;
			$ibuilder->where('"'. $today_date. '" BETWEEN start_date AND end_date');
			$ibuilder->where('company_id', $company_id);
			$ibuilder->where('is_publish', 1);
			$queryh = $ibuilder->get();
			$HolidayCount = $queryh->getNumRows();
			if($HolidayCount > 0) {
				$Return['error'] = lang('Main.xin_already_holiday_date').' '.$today_date;
				if($Return['error']!=''){
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
					$this->output($Return);
				}
			}

			$check_user_attendance = user_attendance_kiosk($user_id);
			
			if($check_user_attendance < 1) {
				$total_rest = '';
			} 
			else{
				$cin = date_create($nowtime);
				// $now = new DateTime();			
				$check_user_attendance_value = check_user_attendance_value_kiosk($user_id);
				$endtime = date_create($check_user_attendance_value[0]->clock_out); 
				$begintime = date_create($check_user_attendance_value[0]->clock_in);

				if ($cin > $begintime && $cin < $endtime)
				{
					$Return['error'] = lang('Main.xin_change_attendance_date_error').' '.$today_date;
					if($Return['error']!=''){
						$this->output($Return);
					}
				} 
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
				'clock_in_latitude' => 1,
				'clock_in_longitude'  => 1,
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
			if ($result == TRUE) {
				$Return['signed_in'] = true;
				$Return['result'] = lang('Main.xin_clockin_success');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
		} else if($clock_state=='clock_out') {
			$clockout_value = check_user_attendance_clockout_value_kiosk($user_id);
			// print_r($clockout_value); die();
			$cout = date_create($clockout_value[0]->clock_in);
			$cin = date_create($nowtime);

			// lunch_break code
			$lunch_breakin = date_create($clockout_value[0]->lunch_breakin);
			$lunch_breakout = date_create($clockout_value[0]->lunch_breakout);
			
			$interval_cin = date_diff($cout, $cin);
			// print_r($interval_cin); echo "interval_cin<br>"; die();
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
					$CompanysettingsModel = new \App\Models\CompanysettingsModel();
					$xin_system = $CompanysettingsModel->where('company_id', $company_id)->first();
					if($xin_system['is_lunch_break']=="No"){ 
					$employee_detail = $StaffdetailsModel->where('user_id', $employee_id)->first();
					$office_shift = $ShiftModel->where('office_shift_id', $employee_detail['office_shift_id'])->first();
						$day = strtolower(date ('l'));
						$day_lunch_break = $day .'_lunch_break';
						$day_lunch_break_out = $day .'_lunch_break_out';
						if($office_shift) {
							$day_lunch_break =	$office_shift[$day_lunch_break];
							$day_lunch_break_out =	$office_shift[$day_lunch_break_out];
							if($day_lunch_break != "" && $day_lunch_break_out != "") {
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
				'clock_out_latitude' => 1,
				'clock_out_longitude' => 1,
				'clock_in_out' => '0',
				'early_leaving' => $nowtime,
				'overtime' => $nowtime,
				'total_work' => $total_work
			);

			$TimesheetModel = new TimesheetModel();
			$timeSheet = $TimesheetModel->where('company_id', $company_id)->where('employee_id', $user_id)->where('attendance_date', date('Y-m-d'))->orderBy('time_attendance_id','DESC')->limit(1)->first();
			//debug($timeSheet);
			if(!empty($timeSheet)){
                $TimesheetModel = new TimesheetModel();
				$result = $TimesheetModel->update($timeSheet['time_attendance_id'], $data);
				if ($result == TRUE) {
					$Return['signed_out'] = true;
					$Return['result'] = lang('Main.xin_clockout_success');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
			}
			else{
				$Return['error'] = "Invalid request for sign out.";
				$this->output($Return);
			}
		}
		$this->output($Return);
		exit;
	}

	// set clock in - clock out > attendance
	public function set_lunch_break() {
		
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();

		$Return = array('result'=>'', 'error'=>'','lunch_in'=>false,'lunch_out'=>false);
		$formData = $this->request->getPost();
	
        $UsersModel = new UsersModel();
		$user = $UsersModel->where('kiosk_code', $formData['kiosk_code'])->first();
		if(empty($user)){
			$Return['error'] = "Please enter a valid code.";
			$this->output($Return);
		}
		$user_id = $user['user_id'];
		
		$UsersModel = new UsersModel();
		$ShiftModel = new ShiftModel();
		$StaffdetailsModel = new StaffdetailsModel();
		$user_info = $UsersModel->where('user_id', $user_id)->first();
		$staff_details = $StaffdetailsModel->where('user_id', $user_id)->first();
		$company_id = $user_info['company_id'];
		$employee_id = $user_id;
		$office_shift_id = $staff_details['office_shift_id'];
		$TimesheetModel = new TimesheetModel();
		$timeSheet = $TimesheetModel->where('company_id', $company_id)->where('employee_id', $user_id)->where('attendance_date', date('Y-m-d'))->orderBy('time_attendance_id','DESC')->limit(1)->first();
		
		
		if(empty($timeSheet)){
			$Return['error'] = "Please first Sign in";
			$this->output($Return);
		}
		$clock_state = $this->request->getPost('clock_state',FILTER_SANITIZE_STRING);
		
		$ip_address = $request->getIPAddress();
		$work_from_home = 0;
		//time|today
		$nowtime = date("Y-m-d H:i:s");
		$today_date = date('Y-m-d');
			// set rules
			if($clock_state=='lunch_in') {
				if(!empty($timeSheet['lunch_breakin'])) {
					$Return['error'] = "You already do a break";
					$this->output($Return);
				}
				
				$data = array(
					'lunch_breakin' => $nowtime,
					'lunch_breakout' => 0
				);
				// $id = udecode($this->request->getPost('time_id'));
				$TimesheetModel = new TimesheetModel();
				$result = $TimesheetModel->update($timeSheet['time_attendance_id'], $data);
					
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['lunch_in'] = true;
					$Return['result'] = lang('Main.xin_lunch_out');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
			} else if($clock_state=='lunch_out') {

				if(empty($timeSheet['lunch_breakin'])) {
					$Return['error'] = "Please First Lunch in";
					$this->output($Return);
				}
				if(!empty($timeSheet['lunch_breakout'])) {
					$Return['error'] = "You already do a break";
					$this->output($Return);
				}
				$data = array(
					'lunch_breakout' => $nowtime
				);
				// $id = udecode($this->request->getPost('time_id'));
				$TimesheetModel = new TimesheetModel();
				$result = $TimesheetModel->update($timeSheet['time_attendance_id'], $data);
				if ($result == TRUE) {
					$Return['lunch_out'] = true;
					$Return['result'] = lang('Main.xin_back_from_lunch');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
			}
			$Return['csrf_hash'] = csrf_hash();
			$this->output($Return);
			exit;
		
	}

	public function process_add($kiosk_code='',$type=0) 
    {
    	$data = [];
    	$data['response'] = false;
    	$data['error_title'] = '';
    	$data['error_msg'] = '';
    	$data['success_msg'] = '';
		$session = \Config\Services::session();
		$UsersModel = new UsersModel();
		$KioskModel = new KioskModel();
		$date = date("Y-m-d");
		$user = $UsersModel->where('kiosk_code', $kiosk_code)->first();
		if(empty($user)){
            $data['error_title'] = 'Invalid Code';
    	    $data['error_msg'] = 'Please enter a valid code';
    	    echo json_encode($data); exit;
		}
		$user_id = $user['user_id'];
        $currentTime = date('h:i A', strtotime(date("Y-m-d H:i:s")));

		$kiosk = $KioskModel->where('user_id', $user_id)->where('date', date("Y-m-d"))->orderBy('id','DESC')->limit(1)->first();
		
		if(!empty($kiosk['sign_out_time']) || empty($kiosk)){
			if($type==1){
				$insert = [];
	            $insert['user_id'] = $user_id;
	            $insert['date'] = date("Y-m-d");
	            $insert['sign_in_time'] = $currentTime;
	            $KioskModel = new KioskModel();
	            $KioskModel->insert($insert);
	            $data['success_msg'] = 'You are signed in successfully.';
			}
			else{
				$data['error_title'] = 'Sign In';
    	        $data['error_msg'] = 'Please sign in first.';
    	        echo json_encode($data); exit;
			}
		}
		elseif(!empty($kiosk) && empty($kiosk['sign_out_time'])){
		
			$update_id = $kiosk['id'];
			if($type==2){
				$update = [];
	            $update['user_id'] = $user_id;
	            $update['date'] = date("Y-m-d");
	            $update['sign_out_time'] = $currentTime;
	            $KioskModel = new KioskModel();
	            $KioskModel->update($update_id,$update);
	            $data['success_msg'] = 'You are signed out successfully.';
			}
			else{
                $data['error_title'] = 'Signed In';
    	        $data['error_msg'] = 'You are already signed in.';
    	        echo json_encode($data); exit;
			}
		}
		$data['response'] = true;
		echo json_encode($data);
	}

}
