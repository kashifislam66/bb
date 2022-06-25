<?php
use CodeIgniter\I18n\Time;
use App\Models\UsersModel;
use App\Models\LeaveModel;
use App\Models\ConstantsModel;
use App\Models\StaffdetailsModel;
use App\Models\OvertimerequestModel;
use App\Models\BalanceHistoryModel;

$UsersModel = new UsersModel();
$LeaveModel = new LeaveModel();
$ConstantsModel = new ConstantsModel();
$StaffdetailsModel = new StaffdetailsModel();
$OvertimerequestModel = new OvertimerequestModel();
$BalanceHistoryModel = new BalanceHistoryModel();

$request = \Config\Services::request();
$session = \Config\Services::session();
$usession = $session->get('sup_username');
$db = \Config\Database::connect();

if($request->getGet('type') === 'leave_summary' && $field_id){
$staff_id = $request->getGet('staff_id');	
$user_info = $UsersModel->where('user_id', $staff_id)->first();
if($user_info['user_type'] == 'staff'){
	$_company_id = $user_info['company_id'];
} else {
	$_company_id = $usession['sup_user_id'];
}
$employee_detail = $StaffdetailsModel->where('user_id', $staff_id)->first();
$leave_types = $ConstantsModel->where('company_id',$_company_id)->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
?>

<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Main.xin_leave_summary');?>
  </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<div class="modal-body">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
          
          <?php
		  $report_user_id =  $usession['sup_user_id'];
          $user_info = $UsersModel->where('user_id', $report_user_id)->first();
          $company_detail = $UsersModel->where('user_id',  $user_info['company_id'])->first();
          
          if($user_info['user_type'] == 'staff'){
              $_company_id = $user_info['company_id'];
          }
          else{
              $_company_id = $user_info['user_id'];
          }
          
          $employee_detail = $StaffdetailsModel->where('user_id', $report_user_id)->first();
          
          $leave_types = $ConstantsModel->where('company_id',$_company_id)->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
		  // quota assignment year
      $summary_year = date('Y');
			$ejoining_date = Time::parse($employee_detail['date_of_joining']);
      $date = $summary_year .'-'. $company_detail['fiscal_date'];
      $date_end =  $summary_year+1 .'-'. $company_detail['fiscal_date'];

      // strtotime()
      $curr_date = Time::parse(date('Y-m-d',strtotime($date)));
      //$curr_date = Time::parse(date($summary_year.'-m-d'));
      $diff_year_quota = $ejoining_date->difference($curr_date);
      $fyear_quota = $diff_year_quota->getYears();
      $quota_year = '+'.$diff_year_quota->getYears().' years';
      $y = strtotime($employee_detail['date_of_joining']." year");
      $iquota_year = date($summary_year, strtotime($quota_year, strtotime($employee_detail['date_of_joining'])));
      $joining_date_emp = date ( "Y",strtotime($employee_detail['date_of_joining']) ); 
		  ?>
          <div class="row">
            <div class="col-xl-12 col-md-12">
              <div class="activity-scroldl" >
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-xs">
                      <thead>
                        <tr>
						  <th>Leave Type</th>
                          <th>Leave Duration Type</th>
                          <th>Year</th>
                          <th>Total Entitled</th>
                          <th>Entitled</th>
                          <th>Accrued</th>
                          <th>Carried Over</th>
                          <th>Taken</th>
                          <th>Pending Approval</th>
                          <th>Leave Adjustment</th>
                          <th>Balance</th>
                          <th>Current Balance</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
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
								  if(isset($ieleave_option['quota_assign'][$fyear_quota],)) {
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
							 AND `employee_id` = '.$report_user_id.' 
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
							 AND `employee_id` = '.$report_user_id.' 
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
							   WHERE `staff_id` =  '.$report_user_id.'
								 AND `compensation_type` = 1 
								 AND `is_approved` = 1 
								 AND request_date BETWEEN "'.$date.'" AND "'.$date_end.'"';
								
								 $cnt_overtime  = $db->query($query_overtime)->getNumRows();
								
								 if($cnt_overtime > 0){
									 // Declare an array containing times
									 $ittotal_entitled = $total_entitled.':00';
									 $exp_hr = explode(':',$ittotal_entitled);
									 $newibanked_hours = overtime_request_banked_hours($report_user_id);    
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
									
									  $ts1 = strtotime($date);
									   $today = strtotime(date("Y-m-d"));
									 $ts2 =    strtotime("+1 month", $today);
									  $year1 = date('Y', $ts1);
									  $year2 = date('Y', $ts2);
									 $month1 = date('m', $ts1);
									 $month2 = date('m', $ts2);
									 // die();
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
						 
										 // Balance = Total Entitled - Taken
										 $balance = ($sictotal_entitled+$total_adjust)-$taken_leave;
										 // Current Balance = Accrued + Carried Over - Taken
										 $current_balance = ($rem_leave+$carry_limit+$total_adjust)-$taken_leave;
										 
									 ?>
									 <tr>
									   <td><strong>
										 <?= $ltype['category_name'];?>
										 </strong></td>
									   <td><?= lang('Main.xin_hourly');?></td>
									   <td><?= $iquota_year;?></td>
									   <td><?= $sictotal_entitled;?></td>
									   <td><?= $iquota_assigned_hours;?></td>
									   <td><?= $rem_leave;?></td>
									   <td><?= $carry_limit;?></td>
									   <td><?= $taken_leave;?></td>
									   <td><?= $pending_leave;?></td>
									   <td><?= $total_adjust;?></td>
									   <td><?= $balance;?></td>
									   <td><?= $current_balance;?></td>
									 </tr>
									 <?php } ?>
						
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-light" data-dismiss="modal">
  <?= lang('Main.xin_close');?>
  </button>
</div>
<style type="text/css">
.modal-lg, .modal-xl {
    max-width: 1110px !important;
}
</style>
<?php } ?>
