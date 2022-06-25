<?php
use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\MainModel;
use App\Models\ShiftModel;
use App\Models\LeaveModel;
use App\Models\TimesheetModel;
use App\Models\ConstantsModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\StaffdetailsModel;
use App\Models\OvertimerequestModel;

$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$MainModel = new MainModel();
$ShiftModel = new ShiftModel();
$LeaveModel = new LeaveModel();
$ConstantsModel = new ConstantsModel();
$TimesheetModel = new TimesheetModel();
$DepartmentModel = new DepartmentModel();
$DesignationModel = new DesignationModel();
$StaffdetailsModel = new StaffdetailsModel();
$OvertimerequestModel = new OvertimerequestModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$xin_system = erp_company_settings();
$ci_erp_settings = $SystemModel->where('setting_id', 1)->first();

$urecord = $_REQUEST['U'];
$start_date = $_REQUEST['S'];
$end_date = $_REQUEST['E'];
//echo $urecord;
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($urecord!='all'){
$staff_info = udecode($urecord);
$seg_user_id = $staff_info;
// die($seg_user_id);
if($user_info['user_type'] == 'staff'){
	$timesheet_data = $TimesheetModel->where('company_id', $user_info['company_id'])->where('employee_id', $seg_user_id)->first();
	$user_data = $UsersModel->where('company_id', $user_info['company_id'])->where('user_id', $seg_user_id)->first();
	// userdata
	$company_id = $user_info['company_id'];
	$employee_detail = $StaffdetailsModel->where('user_id', $seg_user_id)->first();
	$idesignations = $DesignationModel->where('company_id', $user_info['company_id'])->where('designation_id',$employee_detail['designation_id'])->first();
	$leave_types = $ConstantsModel->where('company_id',$user_info['company_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
} else {
	$timesheet_data = $TimesheetModel->where('company_id', $usession['sup_user_id'])->where('employee_id', $seg_user_id)->first();
	// print_r($timesheet_data);
	$user_data = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_id', $seg_user_id)->first();
	// userdata
	$company_id = $usession['sup_user_id'];
	$employee_detail = $StaffdetailsModel->where('user_id', $seg_user_id)->first();
	$idesignations = $DesignationModel->where('company_id', $usession['sup_user_id'])->where('designation_id',$employee_detail['designation_id'])->first();
	$leave_types = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
}
if($idesignations){
	$designation_name = $idesignations['designation_name'];
} else {
	$designation_name = '';
}

$daterange_attendance_report = timesheet_overtime_report($start_date,$end_date,$staff_info);

?>
<div class="row justify-contendddt-md-center"> 
  <!-- [ Attendance view ] start -->
  <div class="col-md-12"> 
    <!-- [ Attendance view ] start -->
    <div class="container">
      <div>
        <div class="card" id="printTable">
          <div class="card-header">
            <h5><img class="img-fluid" width="171" height="30" src="<?= base_url();?>/public/uploads/logo/other/<?= $ci_erp_settings['other_logo'];?>" alt=""></h5>
          </div>
          <div class="card-body pb-0">
          <h6 class="text-primary"><?= lang('Main.xin_timesheet_report');?>:</h6>
            <div class="row invoive-info d-pdrint-inline-flex ">
              
                <div class="col-md-6">
                    <div class="media user-about-block align-items-center mt-0">
                      <div class="position-relative d-inline-block"> <img class="img-radius img-fluid wid-80" src="<?= staff_profile_photo($seg_user_id);?>" alt="<?= $user_data['first_name'].' '.$user_data['last_name'];?>"> </div>
                      <div class="media-body ml-3">
                        <h6 class="mb-1">
                          <?= $user_data['first_name'].' '.$user_data['last_name'];?>
                        </h6>
                        <p class="mb-0 text-muted">
                          <?= $designation_name;?>
                        </p>
                        <p class="mb-0 text-muted">
                          <?= $user_data['email'];?>
                        </p>
                      </div>
                    </div>
              </div>
              </div>
              <div class="row invoive-info d-pdrint-inline-flex ">
              <div class="col-md-8">
                    <table class="table table-responsive invoice-table invoice-order table-borderless table-xs">
                        <tbody>
                            <tr class="text-primary">
                                <th><?= lang('Main.xin_from');?> :</th>
                                <td><?= set_date_format($start_date);?></td>
                            </tr>
                            <tr class="text-primary">
                                <th><?= lang('Main.xin_to');?> :</th>
                                <td><?= set_date_format($end_date);?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <style type="text/css">
			.text-transform th{text-transform:capitalize !important; font-weight:600; }
			</style>
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="table-responsive">
                  <table class="table invoice-detail-table table-xs">
                    <thead>
                      <tr>
                        <th></th>
                        <th colspan="3" align="center" style="border-bottom:1px solid #ccc; border-left:1px solid #ccc; border-right:1px solid #ccc;"><?= lang('Main.xin_overtime_additional_work_hours');?></th>
                        <th colspan="4" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;"><?= lang('Main.xin_types_of_leave');?></th>
                        <th colspan="6">&nbsp;</th>
                      </tr>
                      <tr class="text-transform">
                        <th><?= lang('Main.xin_regular_hours');?></th>
                        <th><?= lang('Main.xin_straight_title');?></th>
                        <th><?= lang('Main.xin_time_ahalf_title');?></th>
                        <th><?= lang('Main.xin_double_title');?></th>
                        <?php foreach($leave_types as $ileave_type):?>
                        <th><?= $ileave_type['category_name'];?></th>
                        <?php endforeach;?>
						<th>Holidays</th>
                        <th><?= lang('Main.xin_overtime_standby_hrs');?></th>
                        <th><?= lang('Main.xin_overtime_work_through_lunch');?></th>
                        <th><?= lang('Main.xin_overtime_out_of_town_title');?></th>
                        <th><?= lang('Main.xin_overtime_salaried_employee');?></th>
                        <th><?= lang('Main.xin_unpaid_leave');?></th>
                        <th><?= lang('Main.xin_hours_worked');?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
						$iiexp_min =0;						
						$double_hour =0; $double_minute=0; $salaried_hour =0; $salaried_minute=0; $outtown_hour =0; $outtown_minute=0;
						$timehalf_hour=0; $timehalf_minute=0; $strt_hour = 0; $strt_minute =0;$minute = 0; $hour = 0;$time1 = 0;
						$lunch_hour =0; $lunch_minute=0; $standby_hour =0; $standby_minute=0;
					   ?>
                      <?php foreach($daterange_attendance_report as $drange_report):?>
                      <?php
					 
					  	$clock_in = strtotime($drange_report->clock_in);
						$clock_out = strtotime($drange_report->clock_out);
						$iclock_in = date("h:i a", $clock_in);
						$iclock_out = date("h:i a", $clock_out);
						$onehr = strtotime('+1 hour');
						//$total_work = strtotime($drange_report->total_work);
						//$ftotal_work = $total_work-$onehr;
						// $TimeRemoved = substr($clock_in,0,5) - $onehr;
						$ficlock_in = date("h:i", strtotime('+1 hours', $clock_in));
						$ficlock_in = $drange_report->request_date.' '.$ficlock_in.':00';
						$clock_out2 = $drange_report->clock_out;
						
						$total_work_cin = date_create($ficlock_in);
						$total_work_cout = date_create($clock_out2);
						$interval_cin = date_diff($total_work_cin, $total_work_cout);
						$hours_in   = $interval_cin->format('%h');
						$minutes_in = $interval_cin->format('%i');			
						$total_work = $hours_in .":".$minutes_in;
						$overtime_opt = $drange_report->total_hours;
						if($drange_report->overtime_reason == 5){
							$additional_hrs = $overtime_opt;
							$lunch_hrs = '00:00';
							$out_of_town_hrs = '00:00';
							$salaried_employee_hrs = '00:00';
							$standby_hrs = '00:00';
						} else if($drange_report->overtime_reason == 4){
							$salaried_employee_hrs = $overtime_opt;
							$lunch_hrs = '00:00';
							$out_of_town_hrs = '00:00';
							$additional_hrs = '00:00';
							$standby_hrs = '00:00';
						} else if($drange_report->overtime_reason == 3){
							$out_of_town_hrs = $overtime_opt;
							$lunch_hrs = '00:00';
							$additional_hrs = '00:00';
							$salaried_employee_hrs = '00:00';
							$standby_hrs = '00:00';
						} else if($drange_report->overtime_reason == 2){
							$lunch_hrs = $overtime_opt;
							$additional_hrs = '00:00';
							$out_of_town_hrs = '00:00';
							$salaried_employee_hrs = '00:00';
							$standby_hrs = '00:00';
						} else if($drange_report->overtime_reason == 1){
							$standby_hrs = $overtime_opt;
							$lunch_hrs = '00:00';
							$out_of_town_hrs = '00:00';
							$salaried_employee_hrs = '00:00';
							$standby_hrs = '00:00';
						}
						//straight
						if($drange_report->straight == 0){
							$straight = '00:00';
						} else {
							$straight = $drange_report->straight;
						}
						//time_a_half
						if($drange_report->time_a_half == 0){
							$time_a_half = '00:00';
						} else {
							$time_a_half = $drange_report->time_a_half;
						}
						//double_overtime
						if($drange_report->double_overtime == 0){
							$double_overtime = '00:00';
						} else {
							$double_overtime = $drange_report->double_overtime;
						}
						//total_hours
						$time_arr =  $drange_report->total_hours;
						$time1 = explode_time($time_arr);
						$hour += floor($time1 / 3600);
						$minute += strval(floor(($time1 % 3600) / 60));
						
						if ($minute == 0) {
							$minute = "00";
						} else {
							$minute = $minute;
						}
						//straight_hours
						$strt_time1 = explode_time($straight);
						$strt_hour += floor($strt_time1 / 3600);
						$strt_minute += strval(floor(($strt_time1 % 3600) / 60));
						
						if ($strt_minute == 0) {
							$strt_minute = "00";
						} else {
							$strt_minute = $strt_minute;
						}
						//time_a_half
						$timehalf_time1 = explode_time($time_a_half);
						$timehalf_hour += floor($timehalf_time1 / 3600);
						$timehalf_minute += strval(floor(($timehalf_time1 % 3600) / 60));
						
						if ($timehalf_minute == 0) {
							$timehalf_minute = "00";
						} else {
							$timehalf_minute = $timehalf_minute;
						}
						//double_overtime
						$double_time1 = explode_time($double_overtime);
						$double_hour += floor($double_time1 / 3600);
						$double_minute += strval(floor(($double_time1 % 3600) / 60));
						
						if ($double_minute == 0) {
							$double_minute = "00";
						} else {
							$double_minute = $double_minute;
						}
						//salaried_employee_hrs
						$salaried_time1 = explode_time($salaried_employee_hrs);
						$salaried_hour += floor($salaried_time1 / 3600);
						$salaried_minute += strval(floor(($salaried_time1 % 3600) / 60));
						
						if ($salaried_minute == 0) {
							$salaried_minute = "00";
						} else {
							$salaried_minute = $salaried_minute;
						}
						//out_of_town_hrs
						$outtown_time1 = explode_time($out_of_town_hrs);
						$outtown_hour += floor($outtown_time1 / 3600);
						$outtown_minute += strval(floor(($outtown_time1 % 3600) / 60));
						
						if ($outtown_minute == 0) {
							$outtown_minute = "00";
						} else {
							$outtown_minute = $outtown_minute;
						}
						//lunch_hrs
						$lunch_time1 = explode_time($lunch_hrs);
						$lunch_hour += floor($lunch_time1 / 3600);
						$lunch_minute += strval(floor(($lunch_time1 % 3600) / 60));
						
						if ($lunch_minute == 0) {
							$lunch_minute = "00";
						} else {
							$lunch_minute = $lunch_minute;
						}
						//standby_hrs
						$standby_time1 =  $drange_report->total_hours;
						$time_stand = explode_time($standby_time1);
						$standby_hour += floor($time_stand / 3600);
						$standby_minute += strval(floor(($time_stand % 3600) / 60));
						
						if ($standby_minute == 0) {
							$standby_minute = "00";
						} else {
							$standby_minute = $standby_minute;
						}
					  ?>
                       <?php endforeach;?>
                       <?php
					    
						//straight_hours
						$strt_fhour = mins_to_hours($strt_minute,$strt_hour);
						//time_a_half
						$timehalf_fhour = mins_to_hours($timehalf_minute,$timehalf_hour);
						//double_overtime
						$double_fhour = mins_to_hours($double_minute,$double_hour);
						//salaried_employee_hrs
						$salaried_fhour = mins_to_hours($salaried_minute,$salaried_hour);
						//out_of_town_hrs
						$outtown_fhour = mins_to_hours($outtown_minute,$outtown_hour);
						//lunch_hrs
						$lunch_fhour = mins_to_hours($lunch_minute,$lunch_hour);
						//lunch_hrs
						$standby_fhour = mins_to_hours($standby_minute,$standby_hour);
						$fhour = "00:00";
						$timesheet_reult = $TimesheetModel->where('company_id', $company_id)->where('status', 'Approved')->where('employee_id', $seg_user_id)->where('attendance_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)) .'"')->findAll();
						
						if(!empty($timesheet_reult)) {
						foreach($timesheet_reult as $timshet) {
							// print_r($timshet->total_work); 
							$regular =  $timshet['total_work'];
							$time_regular = explode_time($regular);
							$regular_hour += floor($time_regular / 3600);
							$regular_minute += strval(floor(($time_regular % 3600) / 60));

							
							
							if ($regular_minute == 0) {
								$regular_minute = "00";
							} else {
								$regular_minute = $regular_minute;
							}
						}
						// die();
						//total_hours
						$fhour = mins_to_hours($regular_minute,$regular_hour);
					} 
					  // holidays
					  $db      = \Config\Database::connect();
					
					  $period = new DatePeriod(
						  new DateTime($start_date),
						  new DateInterval('P1D'),
						  new DateTime($end_date)
					 );
					 $no_of_days = 0;
					 $employee_detail = $StaffdetailsModel->where('user_id',$seg_user_id)->first();
					 $office_shift = $ShiftModel->where('office_shift_id', $employee_detail['office_shift_id'])->first();
					 foreach ($period as $key => $value) {
					  
						  $day =  $value->format('l'); 
						  $check_date =  $value->format('Y-m-d'); 
						 
						  $ibuilder = $db->table('ci_holidays');
						  $ibuilder->where('"'. $check_date. '" BETWEEN start_date AND end_date');
						  $ibuilder->where('company_id', $company_id);
						  $ibuilder->where('is_publish', 1);
						  $queryh = $ibuilder->get();
						  $HolidayCount = $queryh->getNumRows();
						  if($HolidayCount > 0) {
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
		
									$clock_in2 = $check_date.' '.$in_time.':00';
									$clock_out2 = $check_date.' '.$out_time.':00';
									$break_start2 = $check_date.' '.$break_start.':00';
									$break_out2 = $check_date.' '.$break_out.':00';
									
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
							  
						
					  //$value->format('Y-m-d')       
					  }
					  $holidays = sprintf('%02d:%02d',
								($no_of_days / 3600),
								($no_of_days / 60 % 60),
								$no_of_days % 60);

					   ?>
                      <tr>
                      <td><?= $fhour;?></td>
                        <td><?= $strt_fhour;?></td>
                        <td><?= $timehalf_fhour;?></td>
                        <td><?= $double_fhour;?></td>
                        <?php
                        	$total=0;$leave_cnt=0; $total_leave_cnt=0;
							foreach($leave_types as $ileave_type):
                        		$leave_info = $LeaveModel->where('company_id',$company_id)
								->where('leave_type_id', $ileave_type['constants_id'])
								->where('employee_id', $seg_user_id)->where('status', 2)
								->countAllResults();
								//is leave
								if($leave_info > 0):
									$leave_rec = $LeaveModel->where('company_id',$company_id)
									->where('leave_type_id', $ileave_type['constants_id'])
									->where('employee_id', $seg_user_id)->where('status', 2)
									->findAll();
									//if($leave_rec):
									foreach($leave_rec as $leave_rc):
										$leave_cnt = $leave_rc['leave_hours'];
									endforeach;
									//else:
										//$leave_cnt = 0;
									//endif;
								else:
									$leave_cnt = 0;
								endif;
								$total_leave_cnt += $leave_cnt;
								/*$total_leave_cnt += $leave_cnt;*/
								if($leave_cnt == 0){
									$ileave_cnt = '00:00';
									//$iileave_cnt = strtotime($ileave_cnt);
									//$ieleavecnt += gmdate("H:i", $iileave_cnt);
									
								} else {
									$ileave_cnt = $leave_cnt.':00';
									//$iileave_cnt = strtotime($ileave_cnt);
									//$ieleavecnt += gmdate("H:i", $iileave_cnt);
								}
							?>
							<td><?= $ileave_cnt;?></td>
							<?php endforeach;?>
                            <td><?= $holidays;?></td>
							<td><?= $standby_fhour;?></td>
							<td><?= $lunch_fhour;?></td>
							<td><?= $outtown_fhour;?></td>
							<td><?= $salaried_fhour;?></td>
							<td><?= '00:00';?></td>
							<?php
							if($total_leave_cnt == 0){
								$ileave_type_cnt = '00:00';
							} else {
								$ileave_type_cnt = $total_leave_cnt.':00';
							}
							// Declare an array containing times
							$time = array(
								$fhour, 
								// $strt_fhour, $timehalf_fhour, $double_fhour,
								$ileave_type_cnt,
								$lunch_fhour,
								$outtown_fhour,$salaried_fhour,$holidays
								
							);
							// $sum = strtotime('00:00:00');
							$total = 0;
							 ?>
							<td>
                            <?php
								foreach( $time as $element ) {
								// echo "<pre>";	print_r($element); 	echo "</pre>";
									// Converting the time into seconds
									$temp = explode(":", $element);
									$total+= (int) $temp[0] * 3600;
									$total+= (int) $temp[1] * 60;
									  
									// Sum the time with previous value
								}
								  
								
								$formatted = sprintf('%02d:%02d',
								($total / 3600),
								($total / 60 % 60),
								$total % 60);
								echo $formatted;
								// Printing the result
							
							?>
							
							</td>
						  </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php /*?><div class="row text-center d-print-none">
          <div class="col-sm-12 invoice-btn-group text-center">
            <button type="button" class="btn btn-print-invoice waves-effect waves-light btn-success m-b-10">
            <?= lang('Main.xin_print');?>
            </button>
           </div>
        </div><?php */?>
      </div>
    </div>
    <!-- [ Attendance view ] end --> 
  </div>
</div>
<?php } else {?>
<?php
if($user_info['user_type'] == 'staff'){
	$user_data = $UsersModel->where('company_id', $user_info['company_id'])->findAll();
	// userdata
	$company_id = $user_info['company_id'];
	$leave_types = $ConstantsModel->where('company_id',$user_info['company_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
} else {
	$user_data = $UsersModel->where('company_id', $usession['sup_user_id'])->findAll();
	// userdata
	$company_id = $usession['sup_user_id'];
	$leave_types = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
}
?>
<div class="row justify-contendddt-md-center"> 
  <!-- [ Attendance view ] start -->
  <div class="col-md-12"> 
    <!-- [ Attendance view ] start -->
    <div class="container">
      <div>
        <div class="card" id="printTable">
          <div class="card-header">
            <h5><img class="img-fluid" width="171" height="30" src="<?= base_url();?>/public/uploads/logo/other/<?= $ci_erp_settings['other_logo'];?>" alt=""></h5>
          </div>
          <div class="card-body pb-0">
          <h6 class="text-primary"><?= lang('Main.xin_timesheet_report');?><br /><?= lang('Main.xin_all_employees');?></h6>
              <div class="row invoive-info d-pdrint-inline-flex ">
              <div class="col-md-8">
                    <table class="table table-responsive invoice-table invoice-order table-borderless table-xs">
                        <tbody>
                            <tr class="text-primary">
                                <th><?= lang('Main.xin_from');?> :</th>
                                <td><?= set_date_format($start_date);?></td>
                            </tr>
                            <tr class="text-primary">
                                <th><?= lang('Main.xin_to');?> :</th>
                                <td><?= set_date_format($end_date);?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <style type="text/css">
			.text-transform th{text-transform:capitalize !important; font-weight:600; }
			</style>
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="table-responsive">
                  <table class="table invoice-detail-table table-xs">
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th colspan="3" align="center" style="border-bottom:1px solid #ccc; border-left:1px solid #ccc; border-right:1px solid #ccc;"><?= lang('Main.xin_overtime_additional_work_hours');?></th>
                        <th colspan="4" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;"><?= lang('Main.xin_types_of_leave');?></th>
                        <th colspan="6">&nbsp;</th>
                      </tr>
                      <tr class="text-transform">
                        <th><?= lang('Main.xin_all_employees');?></th>
                        <th><?= lang('Main.xin_regular_hours');?></th>
                        <th><?= lang('Main.xin_straight_title');?></th>
                        <th><?= lang('Main.xin_time_ahalf_title');?></th>
                        <th><?= lang('Main.xin_double_title');?></th>
                        <?php foreach($leave_types as $ileave_type):?>
                        <th><?= $ileave_type['category_name'];?></th>
                        <?php endforeach;?>
						<th>Holidays</th>
                        <th><?= lang('Main.xin_overtime_standby_hrs');?></th>
                        <th><?= lang('Main.xin_overtime_work_through_lunch');?></th>
                        <th><?= lang('Main.xin_overtime_out_of_town_title');?></th>
                        <th><?= lang('Main.xin_overtime_salaried_employee');?></th>
                        <th><?= lang('Main.xin_unpaid_leave');?></th>
                        <th><?= lang('Main.xin_hours_worked');?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
					   $iiexp_min =0;  $holidays =0;
						$double_hour =0; $double_minute=0; $salaried_hour =0; $salaried_minute=0; $outtown_hour =0; $outtown_minute=0;
						$timehalf_hour=0; $timehalf_minute=0; $strt_hour = 0; $strt_minute =0;$minute = 0; $hour = 0;$time1 = 0;
						$lunch_hour =0; $lunch_minute=0; $standby_hour =0; $standby_minute=0;
					  ?>
                      <?php foreach($user_data as $user_info_id) { 
					  		$icount_hr = $StaffdetailsModel->where('user_id', $user_info_id['user_id'])->where('not_part_of_system_reports', 1)->countAllResults();
                          if($icount_hr != 1):
						  $fhour = "00:00";
						  $timesheet_days = 0;
						  $timesheet_reults = $TimesheetModel->where('company_id', $company_id)->where('status', 'Approved')->where('employee_id', $user_info_id['user_id'])->where('attendance_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)) .'"')->findAll();
						//   print_r($timesheet_reults); die(); 
						  if(!empty($timesheet_reults)) {
							
							  foreach($timesheet_reults as $timshet):
								  // print_r($timshet->total_work);
								  $regular =  $timshet['total_work'];
								  		$tempp = explode(":", $regular);
										$timesheet_days+= (int) $tempp[0] * 3600;
										$timesheet_days+= (int) $tempp[1] * 60;
								
							  endforeach;
							 
						  } 
						  // holidays
					$db      = \Config\Database::connect();
					
					$period = new DatePeriod(
						new DateTime($start_date),
						new DateInterval('P1D'),
						new DateTime($end_date)
				   );
				   $no_of_days = 0;
				   $employee_detail = $StaffdetailsModel->where('user_id', $user_info_id['user_id'])->first();
				   $office_shift = $ShiftModel->where('office_shift_id', $employee_detail['office_shift_id'])->first();
				   foreach ($period as $key => $value) {
					
						$day =  $value->format('l'); 
						$check_date =  $value->format('Y-m-d'); 
						
						$ibuilder = $db->table('ci_holidays');
						$ibuilder->where('"'. $check_date. '" BETWEEN start_date AND end_date');
						$ibuilder->where('company_id', $company_id);
						$ibuilder->where('is_publish', 1);
						$queryh = $ibuilder->get();
						$HolidayCount = $queryh->getNumRows();
							if($HolidayCount > 0) {
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
			
										$clock_in2 = $check_date.' '.$in_time.':00';
										$clock_out2 = $check_date.' '.$out_time.':00';
										$break_start2 = $check_date.' '.$break_start.':00';
										$break_out2 = $check_date.' '.$break_out.':00';
										
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
							
					
					//$value->format('Y-m-d')       
					}
					$holidays = sprintf('%02d:%02d',
								($no_of_days / 3600),
								($no_of_days / 60 % 60),
								$no_of_days % 60);
					$fhour = sprintf('%02d:%02d',
								($timesheet_days / 3600),
								($timesheet_days / 60 % 60),
								$timesheet_days % 60);
					// $holidays =  $i*7 . ":00"; 
					?>
                      <?php $daterange_attendance_report = timesheet_overtime_report($start_date,$end_date,$user_info_id['user_id']); ?>
                      <?php foreach($daterange_attendance_report as $drange_report):?>
                      <?php
					 
					  	$clock_in = strtotime($drange_report->clock_in);
						$clock_out = strtotime($drange_report->clock_out);
						$iclock_in = date("h:i a", $clock_in);
						$iclock_out = date("h:i a", $clock_out);
						$onehr = strtotime('+1 hour');
						//$total_work = strtotime($drange_report->total_work);
						//$ftotal_work = $total_work-$onehr;
						// $TimeRemoved = substr($clock_in,0,5) - $onehr;
						$ficlock_in = date("h:i", strtotime('+1 hours', $clock_in));
						$ficlock_in = $drange_report->request_date.' '.$ficlock_in.':00';
						$clock_out2 = $drange_report->clock_out;
						
						$total_work_cin = date_create($ficlock_in);
						$total_work_cout = date_create($clock_out2);
						$interval_cin = date_diff($total_work_cin, $total_work_cout);
						$hours_in   = $interval_cin->format('%h');
						$minutes_in = $interval_cin->format('%i');			
						$total_work = $hours_in .":".$minutes_in;
						$overtime_opt = $drange_report->total_hours;
						if($drange_report->overtime_reason == 5){
							$additional_hrs = $overtime_opt;
							$lunch_hrs = '00:00';
							$out_of_town_hrs = '00:00';
							$salaried_employee_hrs = '00:00';
							$standby_hrs = '00:00';
						} else if($drange_report->overtime_reason == 4){
							$salaried_employee_hrs = $overtime_opt;
							$lunch_hrs = '00:00';
							$out_of_town_hrs = '00:00';
							$additional_hrs = '00:00';
							$standby_hrs = '00:00';
						} else if($drange_report->overtime_reason == 3){
							$out_of_town_hrs = $overtime_opt;
							$lunch_hrs = '00:00';
							$additional_hrs = '00:00';
							$salaried_employee_hrs = '00:00';
							$standby_hrs = '00:00';
						} else if($drange_report->overtime_reason == 2){
							$lunch_hrs = $overtime_opt;
							$additional_hrs = '00:00';
							$out_of_town_hrs = '00:00';
							$salaried_employee_hrs = '00:00';
							$standby_hrs = '00:00';
						} else if($drange_report->overtime_reason == 1){
							$standby_hrs = $overtime_opt;
							$lunch_hrs = '00:00';
							$out_of_town_hrs = '00:00';
							$salaried_employee_hrs = '00:00';
							$standby_hrs = '00:00';
						}
						//straight
						if($drange_report->straight == 0){
							$straight = '00:00';
						} else {
							$straight = $drange_report->straight;
						}
						//time_a_half
						if($drange_report->time_a_half == 0){
							$time_a_half = '00:00';
						} else {
							$time_a_half = $drange_report->time_a_half;
						}
						//double_overtime
						if($drange_report->double_overtime == 0){
							$double_overtime = '00:00';
						} else {
							$double_overtime = $drange_report->double_overtime;
						}
						//total_hours
						$time_arr =  $drange_report->total_hours;
						$time1 = explode_time($time_arr);
						$hour += floor($time1 / 3600);
						$minute += strval(floor(($time1 % 3600) / 60));
						
						if ($minute == 0) {
							$minute = "00";
						} else {
							$minute = $minute;
						}
						//straight_hours
						$strt_time1 = explode_time($straight);
						$strt_hour += floor($strt_time1 / 3600);
						$strt_minute += strval(floor(($strt_time1 % 3600) / 60));
						
						if ($strt_minute == 0) {
							$strt_minute = "00";
						} else {
							$strt_minute = $strt_minute;
						}
						//time_a_half
						$timehalf_time1 = explode_time($time_a_half);
						$timehalf_hour += floor($timehalf_time1 / 3600);
						$timehalf_minute += strval(floor(($timehalf_time1 % 3600) / 60));
						
						if ($timehalf_minute == 0) {
							$timehalf_minute = "00";
						} else {
							$timehalf_minute = $timehalf_minute;
						}
						//double_overtime
						$double_time1 = explode_time($double_overtime);
						$double_hour += floor($double_time1 / 3600);
						$double_minute += strval(floor(($double_time1 % 3600) / 60));
						
						if ($double_minute == 0) {
							$double_minute = "00";
						} else {
							$double_minute = $double_minute;
						}
						//salaried_employee_hrs
						$salaried_time1 = explode_time($salaried_employee_hrs);
						$salaried_hour += floor($salaried_time1 / 3600);
						$salaried_minute += strval(floor(($salaried_time1 % 3600) / 60));
						
						if ($salaried_minute == 0) {
							$salaried_minute = "00";
						} else {
							$salaried_minute = $salaried_minute;
						}
						//out_of_town_hrs
						$outtown_time1 = explode_time($out_of_town_hrs);
						$outtown_hour += floor($outtown_time1 / 3600);
						$outtown_minute += strval(floor(($outtown_time1 % 3600) / 60));
						
						if ($outtown_minute == 0) {
							$outtown_minute = "00";
						} else {
							$outtown_minute = $outtown_minute;
						}
						//lunch_hrs
						$lunch_time1 = explode_time($lunch_hrs);
						$lunch_hour += floor($lunch_time1 / 3600);
						$lunch_minute += strval(floor(($lunch_time1 % 3600) / 60));
						
						if ($lunch_minute == 0) {
							$lunch_minute = "00";
						} else {
							$lunch_minute = $lunch_minute;
						}
						//standby_hrs
						$standby_time1 =  $drange_report->total_hours;
						$time_stand = explode_time($standby_time1);
						$standby_hour += floor($time_stand / 3600);
						$standby_minute += strval(floor(($time_stand % 3600) / 60));
						
						if ($standby_minute == 0) {
							$standby_minute = "00";
						} else {
							$standby_minute = $standby_minute;
						}
						// $standby_time1 = explode_time($standby_hrs);
						// $standby_hour += floor($standby_time1 / 3600);
						// $standby_minute += strval(floor(($standby_time1 % 3600) / 60));
						
						// if ($standby_minute == 0) {
						// 	$standby_minute = "00";
						// } else {
						// 	$standby_minute = $standby_minute;
						// }
					  ?>
                       <?php endforeach;?>
                       <?php
					   $cnt_overtime = $OvertimerequestModel->where('company_id',$company_id)->where('staff_id',$user_info_id['user_id'])->where('is_approved',1)->countAllResults();
					   if($cnt_overtime > 0) {

						 
						  
					// echo $db->getLastQuery();
							// echo "<pre>";print_r($period);echo "</pre>";
							
					
							//total_hours
							
							//straight_hours
							$strt_fhour = mins_to_hours($strt_minute,$strt_hour);
							//time_a_half
							$timehalf_fhour = mins_to_hours($timehalf_minute,$timehalf_hour);
							//double_overtime
							$double_fhour = mins_to_hours($double_minute,$double_hour);
							//salaried_employee_hrs
							$salaried_fhour = mins_to_hours($salaried_minute,$salaried_hour);
							//out_of_town_hrs
							$outtown_fhour = mins_to_hours($outtown_minute,$outtown_hour);
							//lunch_hrs
							$lunch_fhour = mins_to_hours($lunch_minute,$lunch_hour);
							//lunch_hrs
							$standby_fhour = mins_to_hours($standby_minute,$standby_hour);
							

					
						//total_hours
						
					   } else {
						 
						   $strt_fhour = '00:00';
						   $timehalf_fhour = '00:00';
						   $double_fhour = '00:00';
						   $salaried_fhour = '00:00';
						   $outtown_fhour = '00:00';
						   $lunch_fhour = '00:00';
						   $standby_fhour = '00:00';
						   
					   }
					   
					   ?>
					  
                      <tr>
                      	<td><?= $user_info_id['first_name'].' '.$user_info_id['last_name'];?></td>
                        <td><?= $fhour;?></td>
                        <td><?= $strt_fhour;?></td>
                        <td><?= $timehalf_fhour;?></td>
                        <td><?= $double_fhour;?></td>
                        <?php
                        	$total=0;$leave_cnt=0; $total_leave_cnt=0;
							foreach($leave_types as $ileave_type):
                        		$leave_info = $LeaveModel->where('company_id',$company_id)
								->where('leave_type_id', $ileave_type['constants_id'])
								->where('employee_id', $user_info_id['user_id'])->where('status', 2)
								->countAllResults();
								//is leave
								if($leave_info > 0):
									$leave_rec = $LeaveModel->where('company_id',$company_id)
									->where('leave_type_id', $ileave_type['constants_id'])
									->where('employee_id', $user_info_id['user_id'])->where('status', 2)
									->findAll();
									//if($leave_rec):
									foreach($leave_rec as $leave_rc):
										$leave_cnt = $leave_rc['leave_hours'];
									endforeach;
									//else:
										//$leave_cnt = 0;
									//endif;
								else:
									$leave_cnt = 0;
								endif;
								$total_leave_cnt += $leave_cnt;
								/*$total_leave_cnt += $leave_cnt;*/
								if($leave_cnt == 0){
									$ileave_cnt = '00:00';
									//$iileave_cnt = strtotime($ileave_cnt);
									//$ieleavecnt += gmdate("H:i", $iileave_cnt);
									
								} else {
									$ileave_cnt = $leave_cnt.':00';
									//$iileave_cnt = strtotime($ileave_cnt);
									//$ieleavecnt += gmdate("H:i", $iileave_cnt);
								}
							?>
							<td><?= $ileave_cnt;?></td>
							<?php endforeach;?>
                            <td><?= $holidays;?></td>
							<td><?= $standby_fhour;?></td>
							<td><?= $lunch_fhour;?></td>
							<td><?= $outtown_fhour;?></td>
							<td><?= $salaried_fhour;?></td>
							<td><?= '00:00';?></td>
							<?php
							if($total_leave_cnt == 0){
								$ileave_type_cnt = '00:00';
							} else {
								$ileave_type_cnt = $total_leave_cnt.':00';
							}
							// print_r($ileave_type_cnt);
							// Declare an array containing times
							$time = array(
								$fhour, 
								// $strt_fhour, $timehalf_fhour, $double_fhour,
								$ileave_type_cnt,
								$lunch_fhour,
								$outtown_fhour,$salaried_fhour,$holidays
								
							);
							// $sum = strtotime('00:00:00');
							$total = 0;
							 ?>
							<td>
                            <?php
								foreach( $time as $element ) {
								// echo "<pre>";	print_r($element); 	echo "</pre>";
									// Converting the time into seconds
									$temp = explode(":", $element);
									$total+= (int) $temp[0] * 3600;
									$total+= (int) $temp[1] * 60;
									  
									// Sum the time with previous value
								}
								  
								
								$formatted = sprintf('%02d:%02d',
								($total / 3600),
								($total / 60 % 60),
								$total % 60);
								echo $formatted;
								// Printing the result
							
							?>
							</td>
						  </tr>
                          <?php endif; } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php /*?><div class="row text-center d-print-none">
          <div class="col-sm-12 invoice-btn-group text-center">
            <button type="button" class="btn btn-print-invoice waves-effect waves-light btn-success m-b-10">
            <?= lang('Main.xin_print');?>
            </button>
           </div>
        </div><?php */?>
      </div>
    </div>
    <!-- [ Attendance view ] end --> 
  </div>
</div>
<?php }?>
<style type="text/css">
.container {     max-width: 1517px !important; }
</style>