<?php
use CodeIgniter\I18n\Time;
use App\Models\SystemModel;
use App\Models\JobsModel;
use App\Models\UsersModel;
use App\Models\ShiftModel;
use App\Models\LanguageModel;
use App\Models\ConstantsModel;
use App\Models\TimesheetModel;
use App\Models\StaffapprovalsModel;


$SystemModel = new SystemModel();
$JobsModel = new JobsModel();
$UsersModel = new UsersModel();
$ShiftModel = new ShiftModel();
$LanguageModel = new LanguageModel();
$ConstantsModel = new ConstantsModel();
$TimesheetModel = new TimesheetModel();
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
$office_shifts = $ShiftModel->where('company_id',$company_id)->orderBy('office_shift_id', 'ASC')->findAll();
// new levels
$level_option = staff_reporting_manager_info($usession['sup_user_id'],'attendance_settings');
$skip_specific = skip_specific_approval_info('attendance_settings');
$iskip_specific = $skip_specific['skip_specific_approval'];

?>

<div class="row">
  <div class="col-xl-12 col-md-12">
    <?php $attributes = array('name' => 'update_attendance_alert', 'id' => 'update-attendance-alert', 'autocomplete' => 'off');?>
    <?php $hidden = array('user_id' => 0);?>
    <?= form_open_multipart('erp/notifications/update_attendance_alert', $attributes, $hidden);?>
    <div class="card">
      <div class="card-header">
        <h5>
          <?= lang('Main.xin_attendance_alert_list');?><br />
          <button type="submit" style="display:none;" class="approve-all btn btn-light-primary btn-sm">Approve All</button>
        </h5>
      </div>
      <div class="card-body table-border-style">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th><div class="form-check">
                    <input class="form-check-input check-all" type="checkbox" value="all" id="flexCheckChecked" name="check_all">
                    <label class="form-check-label" for="flexCheckChecked"> All </label>
                  </div>
                </th>
                <th><?= lang('Dashboard.dashboard_employee');?></th>
                <th><?= lang('Employees.xin_employee_office_shift');?></th>
                <th><?= lang('Employees.xin_shift_in_time');?></th>
                <th><?= lang('Employees.xin_shift_out_time');?></th>
                <th><?= lang('Main.xin_e_details_date');?></th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $com_alert = staff_approval_notification_attendance_info('attendance_settings');
			  if($iskip_specific == 1){
				if($level_option['total_levels'] > 1){
					if($level_option['level1']==$usession['sup_user_id']){
					   foreach($com_alert['attendance_alert_data'] as $_attendance_arr):
					   foreach($_attendance_arr as $_attendance):
					  
							$attendance_date = set_date_format($_attendance['attendance_date']);
							// user info
							$iuser_info = $UsersModel->where('user_id', $_attendance['employee_id'])->first();
							if($iuser_info){
								$user_detail = $iuser_info['first_name'].' '.$iuser_info['last_name'];
							} else {
								$user_detail = '--';
							}
							$check_levels
							 = $StaffapprovalsModel
							 ->where('company_id', $company_id)
							 ->where('staff_id', $usession['sup_user_id'])
							 ->where('module_key_id', $_attendance['time_attendance_id'])
							 ->where('module_option', 'attendance_settings')
							 ->countAllResults();
							if($check_levels < 1) {
								$change_status = '';
								$make_approve = '<br><span class="badge bg-light-primary m-l-10">My pending approval</span>';
							} else {
								$change_status = '<br><span class="badge bg-light-success m-l-10">Already changed the status</span>';
								$make_approve = '';
							}
					  ?>
					  <tr>
						<td><div class="form-check">
							<input class="form-check-input check-option" type="checkbox" value="<?= $_attendance['time_attendance_id'];?>" name="attendance_val[<?= $_attendance['time_attendance_id'];?>]">
						  </div></td>
						<td><?= $user_detail;?></td>
						<td><?php foreach($office_shifts as $office_shift) {?>
						  <?php if($office_shift['office_shift_id']==$_attendance['shift_id']){?>
						  <?= $office_shift['shift_name']?>
						  <?php }?>
						  <?php } ?></td>
						<td><?php 
							$clock_in_time = strtotime($_attendance['clock_in']);
							echo $fclckIn = date("h:i A", $clock_in_time);
							?></td>
						<td><?php 
							$clock_out_time = strtotime($_attendance['clock_out']);
							echo $fclckOut = date("h:i A", $clock_out_time);
							?></td>
						<td><?= $attendance_date;?></td>
						<td><span data-toggle="tooltip" data-placement="top" data-state="primary" title="<?= lang('Main.xin_edit');?>">
						  <button type="button" class="btn btn-sm btn-link" data-toggle="modal" data-target=".edit-modal-data" data-field_id="<?= uencode($_attendance['time_attendance_id']);?>">Edit</button>
						  </span><a class="btn btn-sm btn-link" href="<?= site_url().'erp/view-attendance-details/'.uencode($_attendance['time_attendance_id']);?>">View Request</a> <?= $make_approve.$change_status;?></td>
					  </tr>
					  <?php
                      endforeach;
					endforeach;
					} else if($level_option['level2']==$usession['sup_user_id']){
					   foreach($com_alert['attendance_alert_data'] as $_attendance_arr):
					   foreach($_attendance_arr as $_attendance):
					  
							$attendance_date = set_date_format($_attendance['attendance_date']);
							// user info
							$iuser_info = $UsersModel->where('user_id', $_attendance['employee_id'])->first();
							if($iuser_info){
								$user_detail = $iuser_info['first_name'].' '.$iuser_info['last_name'];
							} else {
								$user_detail = '--';
							}
							// check levels															
							$check_levels
							 = $StaffapprovalsModel
							 ->where('company_id', $company_id)
							 ->where('staff_id', $usession['sup_user_id'])
							 ->where('module_key_id', $_attendance['time_attendance_id'])
							 ->where('module_option', 'attendance_settings')
							 ->countAllResults();
							// if($check_levels > 0){
							 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
								->where('staff_id!=',$usession['sup_user_id'])
								->where('staff_id',$level_option['level1'])
								 ->where('module_key_id', $_attendance['time_attendance_id'])
								->where('module_option','attendance_settings')->where('status',1)->countAllResults();
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
								$link = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn btn-sm btn-link" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'.uencode($_attendance['time_attendance_id']).'">Edit</button></span><a class="btn btn-sm btn-link" href="'.site_url().'erp/view-attendance-details/'.uencode($_attendance['time_attendance_id']).'">View Request</a>'.$make_approve;
							} else {
								$link = '<span class="badge bg-light-warning">1st level approval is pending</span>';
							}
					  ?>
					  <tr>
						<td><div class="form-check">
							<input class="form-check-input check-option" type="checkbox" value="<?= $_attendance['time_attendance_id'];?>" name="attendance_val[<?= $_attendance['time_attendance_id'];?>]">
						  </div></td>
						<td><?= $user_detail;?></td>
						<td><?php foreach($office_shifts as $office_shift) {?>
						  <?php if($office_shift['office_shift_id']==$_attendance['shift_id']){?>
						  <?= $office_shift['shift_name']?>
						  <?php }?>
						  <?php } ?></td>
						<td><?php 
							$clock_in_time = strtotime($_attendance['clock_in']);
							echo $fclckIn = date("h:i A", $clock_in_time);
							?></td>
						<td><?php 
							$clock_out_time = strtotime($_attendance['clock_out']);
							echo $fclckOut = date("h:i A", $clock_out_time);
							?></td>
						<td><?= $attendance_date;?></td>
						<td><?= $link.$change_status;?></td>
					  </tr>
					  <?php
                      endforeach;
					endforeach;
					} else if($level_option['level3']==$usession['sup_user_id']){
					   foreach($com_alert['attendance_alert_data'] as $_attendance_arr):
					   foreach($_attendance_arr as $_attendance):
					  echo $level_option['level3'].'__'.$usession['sup_user_id'];
							$attendance_date = set_date_format($_attendance['attendance_date']);
							// user info
							$iuser_info = $UsersModel->where('user_id', $_attendance['employee_id'])->first();
							if($iuser_info){
								$user_detail = $iuser_info['first_name'].' '.$iuser_info['last_name'];
							} else {
								$user_detail = '--';
							}
							// check levels															
							$check_levels
							 = $StaffapprovalsModel
							 ->where('company_id', $company_id)
							 ->where('staff_id', $usession['sup_user_id'])
							 ->where('module_key_id', $_attendance['time_attendance_id'])
							 ->where('module_option', 'attendance_settings')
							 ->countAllResults();
							// if($check_levels > 0){
							 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
								->where('staff_id!=',$usession['sup_user_id'])
								->where('staff_id',$level_option['level2'])
								 ->where('module_key_id', $_attendance['time_attendance_id'])
								->where('module_option','attendance_settings')->where('status',1)->countAllResults();
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
								$link = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn btn-sm btn-link" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'.uencode($_attendance['time_attendance_id']).'">Edit</button></span><a class="btn btn-sm btn-link" href="'.site_url().'erp/view-attendance-details/'.uencode($_attendance['time_attendance_id']).'">View Request</a>'.$make_approve;
							} else {
								$link = '<span class="badge bg-light-warning">2nd level approval is pending</span>';
							}
					  ?>
					  <tr>
						<td><div class="form-check">
							<input class="form-check-input check-option" type="checkbox" value="<?= $_attendance['time_attendance_id'];?>" name="attendance_val[<?= $_attendance['time_attendance_id'];?>]">
						  </div></td>
						<td><?= $user_detail;?></td>
						<td><?php foreach($office_shifts as $office_shift) {?>
						  <?php if($office_shift['office_shift_id']==$_attendance['shift_id']){?>
						  <?= $office_shift['shift_name']?>
						  <?php }?>
						  <?php } ?></td>
						<td><?php 
							$clock_in_time = strtotime($_attendance['clock_in']);
							echo $fclckIn = date("h:i A", $clock_in_time);
							?></td>
						<td><?php 
							$clock_out_time = strtotime($_attendance['clock_out']);
							echo $fclckOut = date("h:i A", $clock_out_time);
							?></td>
						<td><?= $attendance_date;?></td>
						<td><?= $link.$change_status;?></td>
					  </tr>
					  <?php
                      endforeach;
					endforeach;
					} else if($level_option['level4']==$usession['sup_user_id']){
					   foreach($com_alert['attendance_alert_data'] as $_attendance_arr):
					   foreach($_attendance_arr as $_attendance):
					  
							$attendance_date = set_date_format($_attendance['attendance_date']);
							// user info
							$iuser_info = $UsersModel->where('user_id', $_attendance['employee_id'])->first();
							if($iuser_info){
								$user_detail = $iuser_info['first_name'].' '.$iuser_info['last_name'];
							} else {
								$user_detail = '--';
							}
							// check levels															
							$check_levels
							 = $StaffapprovalsModel
							 ->where('company_id', $company_id)
							 ->where('staff_id', $usession['sup_user_id'])
							 ->where('module_key_id', $_attendance['time_attendance_id'])
							 ->where('module_option', 'attendance_settings')
							 ->countAllResults();
							// if($check_levels > 0){
							 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
								->where('staff_id!=',$usession['sup_user_id'])
								->where('staff_id',$level_option['level3'])
								 ->where('module_key_id', $_attendance['time_attendance_id'])
								->where('module_option','attendance_settings')->where('status',1)->countAllResults();
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
								$link = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn btn-sm btn-link" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'.uencode($_attendance['time_attendance_id']).'">Edit</button></span><a class="btn btn-sm btn-link" href="'.site_url().'erp/view-attendance-details/'.uencode($_attendance['time_attendance_id']).'">View Request</a>'.$make_approve;
							} else {
								$link = '<span class="badge bg-light-warning">3rd level approval is pending</span>';
							}
					  ?>
					  <tr>
						<td><div class="form-check">
							<input class="form-check-input check-option" type="checkbox" value="<?= $_attendance['time_attendance_id'];?>" name="attendance_val[<?= $_attendance['time_attendance_id'];?>]">
						  </div></td>
						<td><?= $user_detail;?></td>
						<td><?php foreach($office_shifts as $office_shift) {?>
						  <?php if($office_shift['office_shift_id']==$_attendance['shift_id']){?>
						  <?= $office_shift['shift_name']?>
						  <?php }?>
						  <?php } ?></td>
						<td><?php 
							$clock_in_time = strtotime($_attendance['clock_in']);
							echo $fclckIn = date("h:i A", $clock_in_time);
							?></td>
						<td><?php 
							$clock_out_time = strtotime($_attendance['clock_out']);
							echo $fclckOut = date("h:i A", $clock_out_time);
							?></td>
						<td><?= $attendance_date;?></td>
						<td><?= $link.$change_status;?></td>
					  </tr>
					  <?php
                      endforeach;
					endforeach;
					} else if($level_option['level5']==$usession['sup_user_id']){
					   foreach($com_alert['attendance_alert_data'] as $_attendance_arr):
					   foreach($_attendance_arr as $_attendance):
					  
							$attendance_date = set_date_format($_attendance['attendance_date']);
							// user info
							$iuser_info = $UsersModel->where('user_id', $_attendance['employee_id'])->first();
							if($iuser_info){
								$user_detail = $iuser_info['first_name'].' '.$iuser_info['last_name'];
							} else {
								$user_detail = '--';
							}
							// check levels															
							$check_levels
							 = $StaffapprovalsModel
							 ->where('company_id', $company_id)
							 ->where('staff_id', $usession['sup_user_id'])
							 ->where('module_key_id', $_attendance['time_attendance_id'])
							 ->where('module_option', 'attendance_settings')
							 ->countAllResults();
							// if($check_levels > 0){
							 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
								->where('staff_id!=',$usession['sup_user_id'])
								->where('staff_id',$level_option['level4'])
								 ->where('module_key_id', $_attendance['time_attendance_id'])
								->where('module_option','attendance_settings')->where('status',1)->countAllResults();
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
								$link = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn btn-sm btn-link" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'.uencode($_attendance['time_attendance_id']).'">Edit</button></span><a class="btn btn-sm btn-link" href="'.site_url().'erp/view-attendance-details/'.uencode($_attendance['time_attendance_id']).'">View Request</a>'.$make_approve;
							} else {
								$link = '<span class="badge bg-light-warning">4th level approval is pending</span>';
							}
					  ?>
					  <tr>
						<td><div class="form-check">
							<input class="form-check-input check-option" type="checkbox" value="<?= $_attendance['time_attendance_id'];?>" name="attendance_val[<?= $_attendance['time_attendance_id'];?>]">
						  </div></td>
						<td><?= $user_detail;?></td>
						<td><?php foreach($office_shifts as $office_shift) {?>
						  <?php if($office_shift['office_shift_id']==$_attendance['shift_id']){?>
						  <?= $office_shift['shift_name']?>
						  <?php }?>
						  <?php } ?></td>
						<td><?php 
							$clock_in_time = strtotime($_attendance['clock_in']);
							echo $fclckIn = date("h:i A", $clock_in_time);
							?></td>
						<td><?php 
							$clock_out_time = strtotime($_attendance['clock_out']);
							echo $fclckOut = date("h:i A", $clock_out_time);
							?></td>
						<td><?= $attendance_date;?></td>
						<td><?= $link.$change_status;?></td>
					  </tr>
					  <?php
                      endforeach;
					endforeach;
					}
					} else {
						   foreach($com_alert['attendance_alert_data'] as $_attendance_arr):
						   foreach($_attendance_arr as $_attendance):
						  
								$attendance_date = set_date_format($_attendance['attendance_date']);
								// user info
								$iuser_info = $UsersModel->where('user_id', $_attendance['employee_id'])->first();
								if($iuser_info){
									$user_detail = $iuser_info['first_name'].' '.$iuser_info['last_name'];
								} else {
									$user_detail = '--';
								}
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_attendance['time_attendance_id'])
								 ->where('module_option', 'attendance_settings')
								 ->countAllResults();
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary m-l-10">My pending approval</span>';
								} else {
									$change_status = '<br><span class="badge bg-light-success m-l-10">Already changed the status</span>';
									$make_approve = '';
								}
						  ?>
						  <tr>
							<td><div class="form-check">
								<input class="form-check-input check-option" type="checkbox" value="<?= $_attendance['time_attendance_id'];?>" name="attendance_val[<?= $_attendance['time_attendance_id'];?>]">
							  </div></td>
							<td><?= $user_detail;?></td>
							<td><?php foreach($office_shifts as $office_shift) {?>
							  <?php if($office_shift['office_shift_id']==$_attendance['shift_id']){?>
							  <?= $office_shift['shift_name']?>
							  <?php }?>
							  <?php } ?></td>
							<td><?php 
								$clock_in_time = strtotime($_attendance['clock_in']);
								echo $fclckIn = date("h:i A", $clock_in_time);
								?></td>
							<td><?php 
								$clock_out_time = strtotime($_attendance['clock_out']);
								echo $fclckOut = date("h:i A", $clock_out_time);
								?></td>
							<td><?= $attendance_date;?></td>
							<td><span data-toggle="tooltip" data-placement="top" data-state="primary" title="<?= lang('Main.xin_edit');?>">
							  <button type="button" class="btn btn-sm btn-link" data-toggle="modal" data-target=".edit-modal-data" data-field_id="<?= uencode($_attendance['time_attendance_id']);?>">Edit</button>
							  </span><a class="btn btn-sm btn-link" href="<?= site_url().'erp/view-attendance-details/'.uencode($_attendance['time_attendance_id']);?>">View Request</a> <?= $make_approve.$change_status;?></td>
						  </tr>
						  <?php
						  endforeach;
						endforeach;
					}
				} else {
					   foreach($com_alert['attendance_alert_data'] as $_attendance_arr):
					   foreach($_attendance_arr as $_attendance):
					  		$old_level = staff_reporting_manager_old_level($_attendance['employee_id'],'attendance_settings');
							if($old_level['level1']==$usession['sup_user_id']){
								$attendance_date = set_date_format($_attendance['attendance_date']);
								// user info
								$iuser_info = $UsersModel->where('user_id', $_attendance['employee_id'])->first();
								if($iuser_info){
									$user_detail = $iuser_info['first_name'].' '.$iuser_info['last_name'];
								} else {
									$user_detail = '--';
								}
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_attendance['time_attendance_id'])
								 ->where('module_option', 'attendance_settings')
								 ->countAllResults();
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary m-l-10">My pending approval</span>';
								} else {
									$change_status = '<br><span class="badge bg-light-success m-l-10">Already changed the status</span>';
									$make_approve = '';
								}
						  ?>
						  <tr>
							<td><div class="form-check">
								<input class="form-check-input check-option" type="checkbox" value="<?= $_attendance['time_attendance_id'];?>" name="attendance_val[<?= $_attendance['time_attendance_id'];?>]">
							  </div></td>
							<td><?= $user_detail;?></td>
							<td><?php foreach($office_shifts as $office_shift) {?>
							  <?php if($office_shift['office_shift_id']==$_attendance['shift_id']){?>
							  <?= $office_shift['shift_name']?>
							  <?php }?>
							  <?php } ?></td>
							<td><?php 
								$clock_in_time = strtotime($_attendance['clock_in']);
								echo $fclckIn = date("h:i A", $clock_in_time);
								?></td>
							<td><?php 
								$clock_out_time = strtotime($_attendance['clock_out']);
								echo $fclckOut = date("h:i A", $clock_out_time);
								?></td>
							<td><?= $attendance_date;?></td>
							<td><span data-toggle="tooltip" data-placement="top" data-state="primary" title="<?= lang('Main.xin_edit');?>">
							  <button type="button" class="btn btn-sm btn-link" data-toggle="modal" data-target=".edit-modal-data" data-field_id="<?= uencode($_attendance['time_attendance_id']);?>">Edit</button>
							  </span><a class="btn btn-sm btn-link" href="<?= site_url().'erp/view-attendance-details/'.uencode($_attendance['time_attendance_id']);?>">View Request</a> <?= $make_approve.$change_status;?></td>
						  </tr>
						  <?php
							} else if($old_level['level2']==$usession['sup_user_id']){
								$attendance_date = set_date_format($_attendance['attendance_date']);
								// user info
								$iuser_info = $UsersModel->where('user_id', $_attendance['employee_id'])->first();
								if($iuser_info){
									$user_detail = $iuser_info['first_name'].' '.$iuser_info['last_name'];
								} else {
									$user_detail = '--';
								}
								// check levels															
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_attendance['time_attendance_id'])
								 ->where('module_option', 'attendance_settings')
								 ->countAllResults();
								// if($check_levels > 0){
								 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
									->where('staff_id!=',$usession['sup_user_id'])
									->where('staff_id',$old_level['level1'])
									 ->where('module_key_id', $_attendance['time_attendance_id'])
									->where('module_option','attendance_settings')->where('status',1)->countAllResults();
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
									$link = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn btn-sm btn-link" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'.uencode($_attendance['time_attendance_id']).'">Edit</button></span><a class="btn btn-sm btn-link" href="'.site_url().'erp/view-attendance-details/'.uencode($_attendance['time_attendance_id']).'">View Request</a>'.$make_approve;
								} else {
									$link = '<span class="badge bg-light-warning">1st level approval is pending</span>';
								}
						  ?>
						  <tr>
							<td><div class="form-check">
								<input class="form-check-input check-option" type="checkbox" value="<?= $_attendance['time_attendance_id'];?>" name="attendance_val[<?= $_attendance['time_attendance_id'];?>]">
							  </div></td>
							<td><?= $user_detail;?></td>
							<td><?php foreach($office_shifts as $office_shift) {?>
							  <?php if($office_shift['office_shift_id']==$_attendance['shift_id']){?>
							  <?= $office_shift['shift_name']?>
							  <?php }?>
							  <?php } ?></td>
							<td><?php 
								$clock_in_time = strtotime($_attendance['clock_in']);
								echo $fclckIn = date("h:i A", $clock_in_time);
								?></td>
							<td><?php 
								$clock_out_time = strtotime($_attendance['clock_out']);
								echo $fclckOut = date("h:i A", $clock_out_time);
								?></td>
							<td><?= $attendance_date;?></td>
							<td><?= $link.$change_status;?></td>
						  </tr>
						  <?php
							} else if($old_level['level3']==$usession['sup_user_id']){
								$attendance_date = set_date_format($_attendance['attendance_date']);
								// user info
								$iuser_info = $UsersModel->where('user_id', $_attendance['employee_id'])->first();
								if($iuser_info){
									$user_detail = $iuser_info['first_name'].' '.$iuser_info['last_name'];
								} else {
									$user_detail = '--';
								}
								// check levels															
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_attendance['time_attendance_id'])
								 ->where('module_option', 'attendance_settings')
								 ->countAllResults();
								// if($check_levels > 0){
								 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
									->where('staff_id!=',$usession['sup_user_id'])
									->where('staff_id',$old_level['level2'])
									 ->where('module_key_id', $_attendance['time_attendance_id'])
									->where('module_option','attendance_settings')->where('status',1)->countAllResults();
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
									$link = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn btn-sm btn-link" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'.uencode($_attendance['time_attendance_id']).'">Edit</button></span><a class="btn btn-sm btn-link" href="'.site_url().'erp/view-attendance-details/'.uencode($_attendance['time_attendance_id']).'">View Request</a>'.$make_approve;
								} else {
									$link = '<span class="badge bg-light-warning">2nd level approval is pending</span>';
								}
						  ?>
						  <tr>
							<td><div class="form-check">
								<input class="form-check-input check-option" type="checkbox" value="<?= $_attendance['time_attendance_id'];?>" name="attendance_val[<?= $_attendance['time_attendance_id'];?>]">
							  </div></td>
							<td><?= $user_detail;?></td>
							<td><?php foreach($office_shifts as $office_shift) {?>
							  <?php if($office_shift['office_shift_id']==$_attendance['shift_id']){?>
							  <?= $office_shift['shift_name']?>
							  <?php }?>
							  <?php } ?></td>
							<td><?php 
								$clock_in_time = strtotime($_attendance['clock_in']);
								echo $fclckIn = date("h:i A", $clock_in_time);
								?></td>
							<td><?php 
								$clock_out_time = strtotime($_attendance['clock_out']);
								echo $fclckOut = date("h:i A", $clock_out_time);
								?></td>
							<td><?= $attendance_date;?></td>
							<td><?= $link.$change_status;?></td>
						  </tr>
						  <?php
							}
                      endforeach;
					endforeach;
				}
			?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?= form_close(); ?>
  </div>
</div>
