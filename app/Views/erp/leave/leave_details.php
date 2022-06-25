<?php
use CodeIgniter\I18n\Time;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\LeaveModel;
use App\Models\ConstantsModel;
use App\Models\StaffdetailsModel;
use App\Models\LeaveadjustModel;
use App\Models\StaffapprovalsModel;
use App\Models\OvertimerequestModel;
use App\Models\BalanceHistoryModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$LeaveModel = new LeaveModel();
$ConstantsModel = new ConstantsModel();
$LeaveadjustModel = new LeaveadjustModel();
$OvertimerequestModel = new OvertimerequestModel();
$StaffdetailsModel = new StaffdetailsModel();
$StaffapprovalsModel = new StaffapprovalsModel();
$BalanceHistoryModel = new BalanceHistoryModel();

$session = \Config\Services::session();
$db = \Config\Database::connect();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

///
$segment_id = $request->uri->getSegment(3);
$ifield_id = udecode($segment_id);
$result = $LeaveModel->where('leave_id', $ifield_id)->first();
$user_info = $UsersModel->where('user_id', $result['employee_id'])->first();
$ltype = $ConstantsModel->where('constants_id', $result['leave_type_id'])->where('type','leave_type')->first();

$iuser_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($iuser_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
	$leave_types = $ConstantsModel->where('company_id',$iuser_info['company_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
} else {
	$company_id = $usession['sup_user_id'];
	$leave_types = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
}
$employee_detail = $StaffdetailsModel->where('user_id', $result['employee_id'])->first();
// get approvals data
$approval_cnt = $StaffapprovalsModel->where('company_id', $company_id)->where('staff_id', $usession['sup_user_id'])->where('module_key_id', $ifield_id)->where('module_option', 'leave_settings')->countAllResults();
$approvals_data = $StaffapprovalsModel->where('company_id', $company_id)->where('module_key_id', $ifield_id)->where('module_option', 'leave_settings')->findAll();
$level_option = staff_reporting_manager_info($usession['sup_user_id'],'leave_settings');
$staff_id = $result['employee_id'];
//check approval levels
$skip_specific = skip_specific_approval_info('leave_settings');
$iskip_specific = $skip_specific['skip_specific_approval'];
if($iskip_specific == 1){
	$total_levels = $level_option['total_levels'];
} else {
	$old_level = staff_reporting_manager_old_level($result['employee_id'],'leave_settings');
	$total_levels = $old_level['total_levels'];
}
?>

<div class="row">
  <div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h5><?= lang('Leave.xin_leave_details');?></h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
                <div class="h6 m-0"><i class="material-icons-two-tone f-20 text-primary">account_circle</i> <?= lang('Dashboard.dashboard_employee');?> :</div>
                <div><?php echo $user_info['first_name'].''.$user_info['last_name'];?></div>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <div class="h6 m-0"><i class="material-icons-two-tone f-20 text-primary">history_edu</i> <?= lang('Leave.xin_leave_type');?> :</div>
                <div><?php echo $ltype['category_name'];?></div>
            </li>
            <?php if($result['from_date'] != ''):?>
            <li class="list-group-item d-flex justify-content-between">
                <div class="h6 m-0"><i class="material-icons-two-tone f-20 text-primary">event_note</i> <?= lang('Projects.xin_start_date');?> :</div>
                <div><?= set_date_format($result['from_date']);?></div>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <div class="h6 m-0"><i class="material-icons-two-tone f-20 text-primary">event_note</i> <?= lang('Projects.xin_end_date');?> :</div>
                <div><?= set_date_format($result['to_date']);?></div>
            </li>
            <?php endif;?>
            <?php if($result['from_date'] == '' && $result['particular_date'] != ''):?>
            <li class="list-group-item d-flex justify-content-between">
                <div class="h6 m-0"><i class="material-icons-two-tone f-20 text-primary">event_note</i> <?= lang('Main.xin_particular_date');?> :</div>
                <div><?= set_date_format($result['particular_date']);?></div>
            </li>
            <?php endif;?>
            <li class="list-group-item d-flex justify-content-between">
                <div class="h6 m-0"><i class="material-icons-two-tone f-20 text-primary">arrow_circle_down</i> <?= lang('Main.xin_attachment');?> :</div>
                <div>
                <?php if($result['leave_attachment']!='' && $result['leave_attachment']!='NULL'):?>
                <a href="<?= site_url()?>download?type=leave&filename=<?php echo uencode($result['leave_attachment']);?>">
                <?= lang('Main.xin_download');?>
                </a>
                <?php else:?> No Attachment
                <?php endif;?>
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <div class="h6 m-0"><i class="material-icons-two-tone f-20 text-primary">more_time</i> <?= lang('Main.xin_leave_hours');?> :</div>
                <div><?= $result['leave_hours'];?></div>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <div class="h6 m-0"><i class="material-icons-two-tone f-20 text-primary">event_note</i> <?= lang('Leave.xin_applied_on');?> :</div>
                <div><?= set_date_format($result['created_at']);?></div>
            </li>
        </ul>
    </div>
    <?php if($level_option['level1']==$usession['sup_user_id'] || $level_option['level2']==$usession['sup_user_id'] || $level_option['level3']==$usession['sup_user_id'] || $level_option['level4']==$usession['sup_user_id'] || $level_option['level5']==$usession['sup_user_id'] || $user_info['user_type'] == 'company') { ?>
    <div class="card">
      <div class="card-header">
        <h5><?= lang('Leave Approval');?></h5>
        <small class="text-primary text-center"><?= $total_levels;?> Level Approval</small>
      </div>
      <?php if($result['status'] != 3){ ?>
      <?php if($approval_cnt < 1) {?>
			  
              <?php $attributes = array('name' => 'update_status', 'id' => 'update_status', 'autocomplete' => 'off');?>
			  <?php $hidden = array('user_id' => 1, 'token_status' => $segment_id);?>
              <?php echo form_open('erp/leave/update_leave_status', $attributes, $hidden);?>
              <div class="card-body">
                <div class="row mt-2 mb-2">
                  <div class="col-md-12"> <span class=" txt-primary"> <i class="fas fa-chart-line"></i> <strong>
                    <?= lang('Main.dashboard_xin_status');?> <span class="text-danger">*</span>
                    </strong> </span> </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <select class="form-control" name="status" data-plugin="select_hrm" data-placeholder="<?= lang('Main.dashboard_xin_status');?>">
                          <option value="">
                          <?= lang('Main.dashboard_xin_status');?>
                          </option>
                          <option value="2">
                          <?= lang('Main.xin_approved');?>
                          </option>
                          <option value="3">
                          <?= lang('Main.xin_rejected');?>
                          </option>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="remarks">
                      <?= lang('Recruitment.xin_remarks');?>
                    </label>
                    <textarea class="form-control textarea" placeholder="<?= lang('Recruitment.xin_remarks');?>" name="remarks" id="remarks"><?php echo $result['remarks'];?></textarea>
                  </div>
                </div>
              </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">
                <?= lang('Main.xin_update_status');?>
                </button>
              </div>
              <?= form_close(); ?>
              
          <?php } else {?>
          <div class="card-body">
            <div class="alert alert-primary" role="alert">
                Already changed the status
            </div>
        </div>
        <?php } ?>
      <?php } else {?>
      	<div class="card-body">
      	<div class="alert alert-danger" role="alert">
            Request has been rejected.
        </div>
        </div>
      <?php } ?>
    </div>
    <?php } ?>
    <div class="card latest-update-card">
      <div class="card-header">
        <h5>Approval Status</h5>
        <small class="text-primary text-center"><?= $total_levels;?> Level Approval</small>
      </div>
      <div class="card-body">
        <div class="latest-update-box">
          <?php $fl=1;foreach($approvals_data as $app_data):?>
          <?php
				$iuser = $UsersModel->where('user_id', $app_data['staff_id'])->where('user_type','staff')->first();
				if($iuser){
					$ol = $iuser['first_name'].' '.$iuser['last_name'];
					$pic = staff_profile_photo($iuser['user_id']);
				} else {
					$ol = '';
					$pic = '';
				}
				if($app_data['status']==1):
					$formstatus = '<span class="badge bg-light-warning">'.lang('Main.xin_pending').'</span>';
					$status_icon = '<i class="feather icon-check bg-light-warning update-icon"></i>';
					$status_label = lang('Main.xin_pending');
				elseif($app_data['status']==2):
					$formstatus = '<span class="badge bg-light-success">'.lang('Main.xin_accepted').'.</span>';
					$status_icon = '<i class="feather icon-x bg-light-success update-icon"></i>';	
					$status_label = lang('Main.xin_accepted');
				else:
					$formstatus = '<span class="badge bg-light-danger">'.lang('Main.xin_rejected').'</span>';
					$status_icon = '<i class="feather icon-plus bg-light-danger update-icon"></i>';
					$status_label = lang('Main.xin_rejected');
				endif;
				//check levels
				if($fl==1){
					$level_label = 'First Level Approval '.$status_label;
				} else if($fl==1){
					$level_label = 'Second Level Approval '.$status_label;
				} else if($fl==1){
					$level_label = 'Third Level Approval '.$status_label;
				} else if($fl==1){
					$level_label = 'Fourth Level Approval '.$status_label;
				} else if($fl==1){
					$level_label = 'Fifth Level Approval '.$status_label;
				}
			?>
          <div class="row p-t-20 p-b-30">
            <div class="col-auto text-end update-meta">
              <p class="text-muted m-b-0 d-inline-flex">
                <?= $formstatus;?>
              </p>
              <?= $status_icon;?>
            </div>
            <div class="col"> <a href="#!">
              <h6>
                <img src="<?= $pic;?>" alt="1" class="img-radius wid-20 align-top m-r-4"> <?= $ol?>
              </h6>
              </a>
              <p class="text-muted m-b-0">
                <?= set_date_format($app_data['updated_at']);?>
              </p>
            </div>
          </div>
          <?php $fl++;endforeach;?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">
        <h5>
          <?= lang('Main.xin_leave_summary');?>
        </h5>
      </div>
      <?php
        $report_user_id =  $staff_id;
        $user_info = $UsersModel->where('user_id', $report_user_id)->first();
        $company_detail = $UsersModel->where('user_id',  $user_info['company_id'])->first();
        
        if($user_info['user_type'] == 'staff'){
            $_company_id = $user_info['company_id'];
        }
        else{
            $_company_id = $user_info['user_id'];
        }
        
        $employee_detail = $StaffdetailsModel->where('user_id', $report_user_id)->first();
        
		  // quota assignment year
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
                          <th><?= lang('Main.xin_leave_adjustment');?></th>
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
