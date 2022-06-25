<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\LeaveadjustModel;
use App\Models\ConstantsModel;
use App\Models\StaffdetailsModel;
use App\Models\StaffapprovalsModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$LeaveadjustModel = new LeaveadjustModel();
$ConstantsModel = new ConstantsModel();
$StaffdetailsModel = new StaffdetailsModel();
$StaffapprovalsModel = new StaffapprovalsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

///
$segment_id = $request->uri->getSegment(3);
$ifield_id = udecode($segment_id);
$result = $LeaveadjustModel->where('adjustment_id', $ifield_id)->first();

$user_info = $UsersModel->where('user_id', $result['employee_id'])->first();
$ltype = $ConstantsModel->where('constants_id', $result['leave_type_id'])->where('type','leave_type')->first();

$iuser_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($iuser_info['user_type'] == 'staff'){
	$company_id = $iuser_info['company_id'];
	$leave_types = $ConstantsModel->where('company_id',$iuser_info['company_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
} else {
	$company_id = $usession['sup_user_id'];
	$leave_types = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
}
$employee_detail = $StaffdetailsModel->where('user_id', $result['employee_id'])->first();
// get approvals data
$approval_cnt = $StaffapprovalsModel->where('company_id', $company_id)->where('staff_id', $usession['sup_user_id'])->where('module_key_id', $ifield_id)->where('module_option', 'leave_adjustment_settings')->countAllResults();
$approvals_data = $StaffapprovalsModel->where('company_id', $company_id)->where('module_key_id', $ifield_id)->where('module_option', 'leave_adjustment_settings')->findAll();
$level_option = staff_reporting_manager_info($usession['sup_user_id'],'leave_adjustment_settings');
//check approval levels
$skip_specific = skip_specific_approval_info('leave_adjustment_settings');
$iskip_specific = $skip_specific['skip_specific_approval'];
if($iskip_specific == 1){
	$total_levels = $level_option['total_levels'];
} else {
	$old_level = staff_reporting_manager_old_level($result['employee_id'],'leave_adjustment_settings');
	$total_levels = $old_level['total_levels'];
}
?>

<div class="row">
  <div class="col-xl-4 col-lg-12 task-detail-right">
    <div class="card">
      <div class="card-header">
        <h5>
          <?= lang('Main.xin_update_status');?>
        </h5>
        <small class="text-primary text-center">
        <?= $total_levels;?>
        Level Approval</small> </div>
      <?php if($result['status'] != 2){ ?>
      <?php if($approval_cnt < 1) {?>
      <?php if($level_option['level1']==$usession['sup_user_id'] || $level_option['level2']==$usession['sup_user_id'] || $level_option['level3']==$usession['sup_user_id'] || $level_option['level4']==$usession['sup_user_id'] || $level_option['level5']==$usession['sup_user_id'] || $user_info['user_type'] == 'company') { ?>
      <?php $attributes = array('name' => 'update_status', 'id' => 'update_status', 'autocomplete' => 'off');?>
      <?php $hidden = array('user_id' => 1, 'token_status' => $segment_id);?>
      <?php echo form_open('erp/leave/update_leave_adjustment_status', $attributes, $hidden);?>
      <?php } ?>
      <div class="card-body">
        <div class="row mt-2 mb-2">
          <div class="col-md-12"> <span class=" txt-primary"> <i class="fas fa-chart-line"></i> <strong>
            <?= lang('Main.dashboard_xin_status');?>
            <span class="text-danger">*</span> </strong> </span> </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <select class="form-control"  name="status" data-plugin="select_hrm" data-placeholder="<?= lang('Main.dashboard_xin_status');?>">
              <option value="">
              <?= lang('Main.dashboard_xin_status');?>
              </option>
              <option value="1">
              <?= lang('Main.xin_approved');?>
              </option>
              <option value="2">
              <?= lang('Main.xin_rejected');?>
              </option>
            </select>
          </div>
        </div>
      </div>
      <?php if($level_option['level1']==$usession['sup_user_id'] || $level_option['level2']==$usession['sup_user_id'] || $level_option['level3']==$usession['sup_user_id'] || $level_option['level4']==$usession['sup_user_id'] || $level_option['level5']==$usession['sup_user_id'] || $user_info['user_type'] == 'company') { ?>
      <div class="card-footer text-right">
        <button type="submit" class="btn btn-success">
        <?= lang('Main.xin_update_status');?>
        </button>
      </div>
      <?= form_close(); ?>
      <?php } ?>
      <?php } else {?>
      <div class="card-body">
        <div class="alert alert-primary" role="alert"> Already changed the status </div>
      </div>
      <?php } ?>
      <?php } else {?>
      <div class="card-body">
        <div class="alert alert-danger" role="alert"> Request has been rejected. </div>
      </div>
      <?php } ?>
    </div>
    <div class="card latest-update-card">
      <div class="card-header">
        <h5>Approval Status</h5>
        <small class="text-primary text-center">
        <?= $total_levels;?>
        Level Approval</small> </div>
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
              <p class="text-muted m-b-0 d-inline-flex">
                <?= $formstatus;?>
              </p>
              <?= $status_icon;?>
            </div>
            <div class="col"> <a href="#!">
              <h6>
                <?= $ol?>
              </h6>
              </a>
              <p class="text-muted m-b-0">
                <?= set_date_format($app_data['updated_at']);?>
              </p>
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
          <?= lang('Main.xin_leave_adjustment');?>
        </h5>
      </div>
      <?php $staff_info = $UsersModel->where('company_id', $company_id)->where('user_type','staff')->findAll();?>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table m-b-0 f-14 b-solid requid-table">
            <tbody class="text-muted">
              <tr>
                <td><i class="fas fa-user-check m-r-5"></i>
                  <?= lang('Dashboard.dashboard_employee');?>
                  :</td>
                <td class="text-right"><span class="float-right"><?php echo $user_info['first_name'].''.$user_info['last_name'];?></span></td>
              </tr>
              <tr>
                <td><i class="fas fa-tasks m-r-5"></i>
                  <?= lang('Main.xin_request_leave_adjustment');?>
                  :</td>
                <td class="text-right"><?php echo $ltype['category_name'];?></td>
              </tr>
              <tr>
                <td><i class="fas fa-user-clock m-r-5"></i>
                  <?= lang('Main.xin_hours_to_adjust');?>
                  :</td>
                <td class="text-right"><?php 
                    echo $result['adjust_hours'];?></td>
              </tr>
              <tr>
                <td><i class="far fa-calendar-alt m-r-5"></i>
                  <?= lang('Leave.xin_applied_on');?>
                  :</td>
                <td class="text-right"><?= set_date_format($result['created_at']);?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row mt-2 mb-2">
          <div class="col-md-12"> <span class=" txt-primary"><strong>
            <?= lang('Main.xin_reason_leave_adjustment');?>
            </strong> </span> </div>
        </div>
        <div class="row mt-2 m-b-15">
          <div class="col-md-12">
            <?php 
				echo $result['reason_adjustment'];?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
