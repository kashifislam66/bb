<?php
use CodeIgniter\I18n\Time;
use App\Models\SystemModel;
use App\Models\JobsModel;
use App\Models\UsersModel;
use App\Models\LanguageModel;
use App\Models\ConstantsModel;
use App\Models\OvertimerequestModel;
use App\Models\StaffapprovalsModel;


$SystemModel = new SystemModel();
$JobsModel = new JobsModel();
$UsersModel = new UsersModel();
$LanguageModel = new LanguageModel();
$ConstantsModel = new ConstantsModel();
$OvertimerequestModel = new OvertimerequestModel();
$StaffapprovalsModel = new StaffapprovalsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$router = service('router');
$request = \Config\Services::request();
$locale = service('request')->getLocale();

$segment_id = $request->uri->getSegment(3);
$alert_count = udecode($segment_id);
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}
// new levels
$level_option = staff_reporting_manager_info($usession['sup_user_id'],'overtime_request_settings');
$skip_specific = skip_specific_approval_info('overtime_request_settings');
$iskip_specific = $skip_specific['skip_specific_approval'];

?>

<div class="row">
  <div class="col-xl-12 col-md-12">
    <div class="card marketing-card table-card">
      <div class="card-header">
        <h5>
          <?= lang('Main.xin_overtime_alert_list');?>
        </h5>
      </div>
      <div class="pro-scroll">
        <div class="card-body p-b-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th><?= lang('Dashboard.dashboard_employee');?></th>
                    <th><?= lang('Main.xin_e_details_date');?></th>
                    <th><?= lang('Employees.xin_shift_in_time');?></th>
                    <th><?= lang('Employees.xin_shift_out_time');?></th>
                    <th><?= lang('Attendance.xin_overtime_thours');?></th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $com_alert = staff_approval_notification_overtime_info('overtime_request_settings');
				// New Approvals
				if($iskip_specific == 1){
					if($level_option['total_levels'] > 1){
						if($level_option['level1']==$usession['sup_user_id']){
							foreach($com_alert['overtime_alert_data'] as $_overtime_arr):
							foreach($_overtime_arr as $_overtime):
							
								//get user info
								$iuser = $UsersModel->where('user_id', $_overtime['staff_id'])->first();
								if($iuser){
									$uname = $iuser['first_name'].' '.$iuser['last_name'];
								} else {
									$uname = '--';
								}
								$clock_in_time = strtotime($_overtime['clock_in']);
								$fclckIn = date("h:i a", $clock_in_time);
								
								$clock_out_time = strtotime($_overtime['clock_out']);
								$fclckOut = date("h:i a", $clock_out_time);
								$attendance_date = set_date_format($_overtime['request_date']);
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_overtime['time_request_id'])
								 ->where('module_option', 'overtime_request_settings')
								 ->countAllResults();
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<br><span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								?>
							<tr>
							  <td><?= $uname;?></td>
							  <td><?= $attendance_date;?></td>
							  <td><?= $fclckIn;?></td>
							  <td><?= $fclckOut;?></td>
							  <td><?= $_overtime['total_hours'];?></td>
							  <td><a href="<?= site_url().'erp/view-overtime-info/'.uencode($_overtime['time_request_id']);?>">View Overtime</a><?= $make_approve.$change_status;?></td>
							</tr>
							<?php
                            endforeach;endforeach;
						} else if($level_option['level2']==$usession['sup_user_id']){
							foreach($com_alert['overtime_alert_data'] as $_overtime_arr):
							foreach($_overtime_arr as $_overtime):
							
								//get user info
								$iuser = $UsersModel->where('user_id', $_overtime['staff_id'])->first();
								if($iuser){
									$uname = $iuser['first_name'].' '.$iuser['last_name'];
								} else {
									$uname = '--';
								}
								$clock_in_time = strtotime($_overtime['clock_in']);
								$fclckIn = date("h:i a", $clock_in_time);
								
								$clock_out_time = strtotime($_overtime['clock_out']);
								$fclckOut = date("h:i a", $clock_out_time);
								$attendance_date = set_date_format($_overtime['request_date']);
								// check levels															
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_overtime['time_request_id'])
								 ->where('module_option', 'overtime_request_settings')
								 ->countAllResults();
								// if($check_levels > 0){
								 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
									->where('staff_id!=',$usession['sup_user_id'])
									->where('staff_id',$level_option['level1'])
									 ->where('module_key_id', $_overtime['time_request_id'])
									->where('module_option','overtime_request_settings')->where('status',1)->countAllResults();
								// status
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								// pending approval
								if($approval_data_cnt > 0){
									$link = '<a href="'.site_url().'erp/view-overtime-info/'.uencode($_overtime['time_request_id']).'">View Overtime</a>'.$make_approve;
								} else {
									$link = '<span class="badge bg-light-warning">1st level approval is pending</span>';
								}
								?>
							<tr>
							  <td><?= $uname;?></td>
							  <td><?= $attendance_date;?></td>
							  <td><?= $fclckIn;?></td>
							  <td><?= $fclckOut;?></td>
							  <td><?= $_overtime['total_hours'];?></td>
							  <td><?= $link;?><br /><?= $change_status;?></td>
							</tr>
							<?php
                            endforeach;endforeach;
						} else if($level_option['level3']==$usession['sup_user_id']){
							foreach($com_alert['overtime_alert_data'] as $_overtime_arr):
							foreach($_overtime_arr as $_overtime):
							
								//get user info
								$iuser = $UsersModel->where('user_id', $_overtime['staff_id'])->first();
								if($iuser){
									$uname = $iuser['first_name'].' '.$iuser['last_name'];
								} else {
									$uname = '--';
								}
								$clock_in_time = strtotime($_overtime['clock_in']);
								$fclckIn = date("h:i a", $clock_in_time);
								
								$clock_out_time = strtotime($_overtime['clock_out']);
								$fclckOut = date("h:i a", $clock_out_time);
								$attendance_date = set_date_format($_overtime['request_date']);
								// check levels															
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_overtime['time_request_id'])
								 ->where('module_option', 'overtime_request_settings')
								 ->countAllResults();
								// if($check_levels > 0){
								 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
									->where('staff_id!=',$usession['sup_user_id'])
									->where('staff_id',$level_option['level2'])
									 ->where('module_key_id', $_overtime['time_request_id'])
									->where('module_option','overtime_request_settings')->where('status',1)->countAllResults();
								// status
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								// pending approval
								if($approval_data_cnt > 0){
									$link = '<a href="'.site_url().'erp/view-overtime-info/'.uencode($_overtime['time_request_id']).'">View Overtime</a>'.$make_approve;
								} else {
									$link = '<span class="badge bg-light-warning">2nd level approval is pending</span>';
								}
								?>
							<tr>
							  <td><?= $uname;?></td>
							  <td><?= $attendance_date;?></td>
							  <td><?= $fclckIn;?></td>
							  <td><?= $fclckOut;?></td>
							  <td><?= $_overtime['total_hours'];?></td>
							  <td><?= $link;?><br /><?= $change_status;?></td>
							</tr>
							<?php
                            endforeach;endforeach;
						} else if($level_option['level4']==$usession['sup_user_id']){
							foreach($com_alert['overtime_alert_data'] as $_overtime_arr):
							foreach($_overtime_arr as $_overtime):
							
								//get user info
								$iuser = $UsersModel->where('user_id', $_overtime['staff_id'])->first();
								if($iuser){
									$uname = $iuser['first_name'].' '.$iuser['last_name'];
								} else {
									$uname = '--';
								}
								$clock_in_time = strtotime($_overtime['clock_in']);
								$fclckIn = date("h:i a", $clock_in_time);
								
								$clock_out_time = strtotime($_overtime['clock_out']);
								$fclckOut = date("h:i a", $clock_out_time);
								$attendance_date = set_date_format($_overtime['request_date']);
								// check levels															
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_overtime['time_request_id'])
								 ->where('module_option', 'overtime_request_settings')
								 ->countAllResults();
								// if($check_levels > 0){
								 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
									->where('staff_id!=',$usession['sup_user_id'])
									->where('staff_id',$level_option['level3'])
									 ->where('module_key_id', $_overtime['time_request_id'])
									->where('module_option','overtime_request_settings')->where('status',1)->countAllResults();
								// status
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								// pending approval
								if($approval_data_cnt > 0){
									$link = '<a href="'.site_url().'erp/view-overtime-info/'.uencode($_overtime['time_request_id']).'">View Overtime</a>'.$make_approve;
								} else {
									$link = '<span class="badge bg-light-warning">3rd level approval is pending</span>';
								}
								?>
							<tr>
							  <td><?= $uname;?></td>
							  <td><?= $attendance_date;?></td>
							  <td><?= $fclckIn;?></td>
							  <td><?= $fclckOut;?></td>
							  <td><?= $_overtime['total_hours'];?></td>
							  <td><?= $link;?><br /><?= $change_status;?></td>
							</tr>
							<?php
                            endforeach;endforeach;
						} else if($level_option['level5']==$usession['sup_user_id']){
							foreach($com_alert['overtime_alert_data'] as $_overtime_arr):
							foreach($_overtime_arr as $_overtime):
							
								//get user info
								$iuser = $UsersModel->where('user_id', $_overtime['staff_id'])->first();
								if($iuser){
									$uname = $iuser['first_name'].' '.$iuser['last_name'];
								} else {
									$uname = '--';
								}
								$clock_in_time = strtotime($_overtime['clock_in']);
								$fclckIn = date("h:i a", $clock_in_time);
								
								$clock_out_time = strtotime($_overtime['clock_out']);
								$fclckOut = date("h:i a", $clock_out_time);
								$attendance_date = set_date_format($_overtime['request_date']);
								// check levels															
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_overtime['time_request_id'])
								 ->where('module_option', 'overtime_request_settings')
								 ->countAllResults();
								// if($check_levels > 0){
								 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
									->where('staff_id!=',$usession['sup_user_id'])
									->where('staff_id',$level_option['level4'])
									 ->where('module_key_id', $_overtime['time_request_id'])
									->where('module_option','overtime_request_settings')->where('status',1)->countAllResults();
								// status
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								// pending approval
								if($approval_data_cnt > 0){
									$link = '<a href="'.site_url().'erp/view-overtime-info/'.uencode($_overtime['time_request_id']).'">View Overtime</a>'.$make_approve;
								} else {
									$link = '<span class="badge bg-light-warning">4th level approval is pending</span>';
								}
								?>
							<tr>
							  <td><?= $uname;?></td>
							  <td><?= $attendance_date;?></td>
							  <td><?= $fclckIn;?></td>
							  <td><?= $fclckOut;?></td>
							  <td><?= $_overtime['total_hours'];?></td>
							  <td><?= $link;?><br /><?= $change_status;?></td>
							</tr>
							<?php
                            endforeach;endforeach;
						}
					} else {
						foreach($com_alert['overtime_alert_data'] as $_overtime_arr):
							foreach($_overtime_arr as $_overtime):
							//get user info
							$iuser = $UsersModel->where('user_id', $_overtime['staff_id'])->first();
							if($iuser){
								$uname = $iuser['first_name'].' '.$iuser['last_name'];
							} else {
								$uname = '--';
							}
							$clock_in_time = strtotime($_overtime['clock_in']);
							$fclckIn = date("h:i a", $clock_in_time);
							
							$clock_out_time = strtotime($_overtime['clock_out']);
							$fclckOut = date("h:i a", $clock_out_time);
							$attendance_date = set_date_format($_overtime['request_date']);
							$check_levels
							 = $StaffapprovalsModel
							 ->where('company_id', $company_id)
							 ->where('staff_id', $usession['sup_user_id'])
							 ->where('module_key_id', $_overtime['time_request_id'])
							 ->where('module_option', 'overtime_request_settings')
							 ->countAllResults();
							if($check_levels < 1) {
								$change_status = '';
								$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
							} else {
								$change_status = '<br><span class="badge bg-light-success">Already changed the status</span>';
								$make_approve = '';
							}
							?>
						<tr>
						  <td><?= $uname;?></td>
						  <td><?= $attendance_date;?></td>
						  <td><?= $fclckIn;?></td>
						  <td><?= $fclckOut;?></td>
						  <td><?= $_overtime['total_hours'];?></td>
						  <td><a href="<?= site_url().'erp/view-overtime-info/'.uencode($_overtime['time_request_id']);?>">View Overtime</a><?= $make_approve.$change_status;?></td>
						</tr>
						<?php
						endforeach;endforeach;
					}
				} else {
					foreach($com_alert['overtime_alert_data'] as $_overtime_arr):
						foreach($_overtime_arr as $_overtime):
							$old_level = staff_reporting_manager_old_level($_overtime['staff_id'],'overtime_request_settings');
							if($old_level['level1'] == $usession['sup_user_id']){
								//get user info
								$iuser = $UsersModel->where('user_id', $_overtime['staff_id'])->first();
								if($iuser){
									$uname = $iuser['first_name'].' '.$iuser['last_name'];
								} else {
									$uname = '--';
								}
								$clock_in_time = strtotime($_overtime['clock_in']);
								$fclckIn = date("h:i a", $clock_in_time);
								
								$clock_out_time = strtotime($_overtime['clock_out']);
								$fclckOut = date("h:i a", $clock_out_time);
								$attendance_date = set_date_format($_overtime['request_date']);
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_overtime['time_request_id'])
								 ->where('module_option', 'overtime_request_settings')
								 ->countAllResults();
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<br><span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								?>
							<tr>
							  <td><?= $uname;?></td>
							  <td><?= $attendance_date;?></td>
							  <td><?= $fclckIn;?></td>
							  <td><?= $fclckOut;?></td>
							  <td><?= $_overtime['total_hours'];?></td>
							  <td><a href="<?= site_url().'erp/view-overtime-info/'.uencode($_overtime['time_request_id']);?>">View Overtime</a><?= $make_approve.$change_status;?></td>
							</tr>
						<?php
							} else if($old_level['level2'] == $usession['sup_user_id']){
								//get user info
								$iuser = $UsersModel->where('user_id', $_overtime['staff_id'])->first();
								if($iuser){
									$uname = $iuser['first_name'].' '.$iuser['last_name'];
								} else {
									$uname = '--';
								}
								$clock_in_time = strtotime($_overtime['clock_in']);
								$fclckIn = date("h:i a", $clock_in_time);
								
								$clock_out_time = strtotime($_overtime['clock_out']);
								$fclckOut = date("h:i a", $clock_out_time);
								$attendance_date = set_date_format($_overtime['request_date']);
								// check levels															
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_overtime['time_request_id'])
								 ->where('module_option', 'overtime_request_settings')
								 ->countAllResults();
								// if($check_levels > 0){
								 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
									->where('staff_id!=',$usession['sup_user_id'])
									->where('staff_id',$level_option['level1'])
									 ->where('module_key_id', $_overtime['time_request_id'])
									->where('module_option','overtime_request_settings')->where('status',1)->countAllResults();
								// status
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								// pending approval
								if($approval_data_cnt > 0){
									$link = '<a href="'.site_url().'erp/view-overtime-info/'.uencode($_overtime['time_request_id']).'">View Overtime</a>'.$make_approve;
								} else {
									$link = '<span class="badge bg-light-warning">1st level approval is pending</span>';
								}
								?>
							<tr>
							  <td><?= $uname;?></td>
							  <td><?= $attendance_date;?></td>
							  <td><?= $fclckIn;?></td>
							  <td><?= $fclckOut;?></td>
							  <td><?= $_overtime['total_hours'];?></td>
							  <td><?= $link;?><br /><?= $change_status;?></td>
							</tr>
							<?php } else if($old_level['level3'] == $usession['sup_user_id']){
								//get user info
								$iuser = $UsersModel->where('user_id', $_overtime['staff_id'])->first();
								if($iuser){
									$uname = $iuser['first_name'].' '.$iuser['last_name'];
								} else {
									$uname = '--';
								}
								$clock_in_time = strtotime($_overtime['clock_in']);
								$fclckIn = date("h:i a", $clock_in_time);
								
								$clock_out_time = strtotime($_overtime['clock_out']);
								$fclckOut = date("h:i a", $clock_out_time);
								$attendance_date = set_date_format($_overtime['request_date']);
								// check levels															
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_overtime['time_request_id'])
								 ->where('module_option', 'overtime_request_settings')
								 ->countAllResults();
								// if($check_levels > 0){
								 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
									->where('staff_id!=',$usession['sup_user_id'])
									->where('staff_id',$level_option['level2'])
									 ->where('module_key_id', $_overtime['time_request_id'])
									->where('module_option','overtime_request_settings')->where('status',1)->countAllResults();
								// status
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								// pending approval
								if($approval_data_cnt > 0){
									$link = '<a href="'.site_url().'erp/view-overtime-info/'.uencode($_overtime['time_request_id']).'">View Overtime</a>'.$make_approve;
								} else {
									$link = '<span class="badge bg-light-warning">2nd level approval is pending</span>';
								}
								?>
							<tr>
							  <td><?= $uname;?></td>
							  <td><?= $attendance_date;?></td>
							  <td><?= $fclckIn;?></td>
							  <td><?= $fclckOut;?></td>
							  <td><?= $_overtime['total_hours'];?></td>
							  <td><?= $link;?><br /><?= $change_status;?></td>
							</tr>
							<?php
							}
						endforeach;endforeach;
				}
			?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
