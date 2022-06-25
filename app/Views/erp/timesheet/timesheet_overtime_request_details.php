<?php
use CodeIgniter\I18n\Time;
use App\Models\SystemModel;
use App\Models\JobsModel;
use App\Models\UsersModel;
use App\Models\LanguageModel;
use App\Models\ConstantsModel;
use App\Models\StaffapprovalsModel;
use App\Models\OvertimerequestModel;

$SystemModel = new SystemModel();
$JobsModel = new JobsModel();
$UsersModel = new UsersModel();
$LanguageModel = new LanguageModel();
$ConstantsModel = new ConstantsModel();
$StaffapprovalsModel = new StaffapprovalsModel();
$OvertimerequestModel = new OvertimerequestModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$router = service('router');
$request = \Config\Services::request();
$locale = service('request')->getLocale();

$segment_id = $request->uri->getSegment(3);
$ifield_id = udecode($segment_id);

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}
$result = $OvertimerequestModel->where('company_id', $company_id)->where('time_request_id', $ifield_id)->first();
$clock_in_time = strtotime($result['clock_in']);
$fclckIn = date("h:i a", $clock_in_time);

$clock_out_time = strtotime($result['clock_out']);
$fclckOut = date("h:i a", $clock_out_time);	
// get approvals data
$approval_cnt = $StaffapprovalsModel->where('company_id', $company_id)->where('staff_id', $usession['sup_user_id'])->where('module_key_id', $ifield_id)->where('module_option', 'overtime_request_settings')->countAllResults();
$approvals_data = $StaffapprovalsModel->where('company_id', $company_id)->where('module_key_id', $ifield_id)->where('module_option', 'overtime_request_settings')->findAll();
$level_option = staff_reporting_manager_info($usession['sup_user_id'],'overtime_request_settings');
//check approval levels
$skip_specific = skip_specific_approval_info('overtime_request_settings');
$iskip_specific = $skip_specific['skip_specific_approval'];
if($iskip_specific == 1){
	$total_levels = $level_option['total_levels'];
} else {
	$old_level = staff_reporting_manager_old_level($result['staff_id'],'overtime_request_settings');
	$total_levels = $old_level['total_levels'];
}
?>

<div class="row">
  <div class="col-xl-4 col-lg-12 task-detail-right">
  <?php if($level_option['level1']==$usession['sup_user_id'] || $level_option['level2']==$usession['sup_user_id'] || $level_option['level3']==$usession['sup_user_id'] || $level_option['level4']==$usession['sup_user_id'] || $level_option['level5']==$usession['sup_user_id'] || $user_info['user_type'] == 'company') { ?>
    <div class="card">
      <div class="card-header">
        <h5><?= lang('Main.xin_update_status');?></h5>
        <small class="text-primary text-center"><?= $total_levels;?> Level Approval</small>
      </div>
      <?php if($result['is_approved'] != 2){ ?>
      	  <?php if($approval_cnt < 1) {?>
      <?php //if(in_array('overtime_req3',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
      <?php $attributes = array('name' => 'update_overtime_status', 'id' => 'update_overtime_status', 'autocomplete' => 'off');?>
      <?php $hidden = array('token' => $segment_id);?>
      <?php echo form_open('erp/timesheet/update_overtime_record', $attributes, $hidden);?>
      <?php //} ?>
      <div class="card-body">
        <div class="row mt-2 mb-2">
          <div class="col-md-12"> <span class=" txt-primary"> <i class="fas fa-chart-line"></i> <strong>
            <?= lang('Main.dashboard_xin_status');?> <span class="text-danger">*</span>
            </strong> </span> </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <select name="status" class="form-control" data-plugin="select_hrm" data-placeholder="<?= lang('Main.dashboard_xin_status');?>">
                <option value="">
                <?= lang('Main.dashboard_xin_status');?>
                </option>
                <option value="1">
                <?= lang('Main.xin_accepted');?>
                </option>
                <option value="2">
                <?= lang('Main.xin_rejected');?>
                </option>
              </select>
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
            <p class="text-primary text-center"><?= $total_levels;?> Level Approval</p>
        </div>
        <div class="card-body">
            <div class="latest-update-box">
            	<?php foreach($approvals_data as $app_data):?>
                <?php
					$iuser = $UsersModel->where('user_id', $app_data['staff_id'])->where('user_type','staff')->first();
					if($iuser){
						$ol = $iuser['first_name'].' '.$iuser['last_name'].'</li>';
					} else {
						$ol = '';
					}
					if($app_data['status']==1):
						$formstatus = '<span class="badge bg-light-success">'.lang('Main.xin_accepted').'</span>';
						$status_icon = '<i class="feather icon-check bg-light-success update-icon"></i>';
					elseif($app_data['status']==2):
						$formstatus = '<span class="badge bg-light-danger">'.lang('Main.xin_rejected').'.</span>';
						$status_icon = '<i class="feather icon-x bg-light-danger update-icon"></i>';	
					else:
						$formstatus = '<span class="badge bg-light-warning">'.lang('Main.xin_pending').'</span>';
						$status_icon = '<i class="feather icon-plus bg-light-warning update-icon"></i>';
					endif;
				?>
                <div class="row p-t-20 p-b-30">
                    <div class="col-auto text-end update-meta">
                        <p class="text-muted m-b-0 d-inline-flex"><?= $formstatus;?></p>
                        <?= $status_icon;?>
                    </div>
                    <div class="col">
                        <a href="#!">
                            <h6><?= $ol?></h6>
                        </a>
                        <p class="text-muted m-b-0"><?= set_date_format($app_data['updated_at']);?></p>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
  </div>
  <div class="col-xl-8 col-lg-12">
    <div class="card">
      <div class="card-header">
        <h5 class=""><i class="fas fa-clock m-r-5"></i>
          <?= lang('Dashboard.xin_overtime_request');?>
        </h5>
      </div>
      <?php $staff_info = $UsersModel->where('company_id', $company_id)->where('user_type','staff')->findAll();?>
      <div class="card-body">
        <div class="table-responsive">
              <table class="table m-b-0 f-14 b-solid requid-table">
                <tbody class="text-muted">
                  <tr>
                    <td><?= lang('Dashboard.dashboard_employee');?></td>
                    <td>
                      <?php foreach($staff_info as $staff) {?>
					<?php if($staff['user_id']==$result['staff_id']):?>
                    <?= $staff['first_name'].' '.$staff['last_name'] ?>
                    <?php endif;?>
                    <?php } ?></td>
                  </tr>
                  <tr>
                    <td><?php echo lang('Main.xin_e_details_date');?></td>
                    <td class="text-danger">
                      <?= $result['request_date'];?></td>
                  </tr>
                  <tr>
                    <td><?php echo lang('Employees.xin_shift_in_time');?></td>
                    <td><?= $fclckIn;?></td>
                  </tr>
                  <tr>
                    <td><?php echo lang('Employees.xin_shift_out_time');?></td>
                    <td><?= $fclckOut;?></td>
                  </tr>
                  <tr>
                    <td><?php echo lang('Main.xin_overtime_reason');?></td>
                    <td><?php
						if($result['overtime_reason'] == 1){
							$overtime_reason = lang('Main.xin_overtime_standby_pay');
						} else if($result['overtime_reason'] == 2){
							$overtime_reason = lang('Main.xin_overtime_work_through_lunch');
						} else if($result['overtime_reason'] == 3){
							$overtime_reason = lang('Main.xin_overtime_out_of_town');
						} else if($result['overtime_reason'] == 4){
							$overtime_reason = lang('Main.xin_overtime_salaried_employee');
						} else if($result['overtime_reason'] == 5){
							$overtime_reason = lang('Main.xin_overtime_additional_work_hours');
						} else {
							$overtime_reason = lang('Main.xin_overtime_standby_pay');
						}
						echo $overtime_reason;
					?></td>
                  </tr>
                  <?php if($result['overtime_reason']==5):?>
                  <tr>
                    <td><?php echo lang('Main.xin_overtime_additional_work_hours');?></td>
                    <td><?php
						if($result['additional_work_hours'] == 1){
							$additional_work_hours = lang('Main.xin_straight_overtime');
						} else if($result['additional_work_hours'] == 2){
							$additional_work_hours = lang('Main.xin_time_ahalf_overtime');
						} else if($result['additional_work_hours'] == 3){
							$additional_work_hours = lang('Main.xin_double_overtime');
						} else {
							$additional_work_hours = lang('Main.xin_straight_overtime');
						}
						echo $additional_work_hours;
					?></td>
                  </tr>
                  <?php endif;?>
                  <tr>
                    <td><?php echo lang('Main.xin_compensation_type');?></td>
                    <td> <?php
						if($result['compensation_type'] == 1){
							$compensation_type = lang('Main.xin_banked');
						} else if($result['compensation_type'] == 2){
							$compensation_type = lang('Main.xin_payout');
						} else {
							$compensation_type = lang('Main.xin_banked');
						}
						echo $compensation_type;
					?></td>
                  </tr>
                  <tr>
                    <td><?php echo lang('Main.dashboard_xin_status');?></td>
                    <td><?php
						if($result['is_approved'] == 0){
							$is_approved = lang('Main.xin_pending');
						} else if($result['is_approved'] == 1){
							$is_approved = lang('Main.xin_accepted');
						} else {
							$is_approved = lang('Main.xin_rejected');
						}
						echo $is_approved;
					?></td>
                  </tr>
                  
                </tbody>
              </table>
            </div>
            <div class="m-b-30 m-t-15">
              <h6><?php echo lang('Main.xin_description');?></h6>
              <hr>
              <?= html_entity_decode($result['request_reason']);?>
            </div>
      </div>
    </div>
  </div>
</div>
