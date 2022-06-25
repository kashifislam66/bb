<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\LeaveModel;
use App\Models\ConstantsModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$LeaveModel = new LeaveModel();
$ConstantsModel = new ConstantsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$leave_types = $ConstantsModel->where('company_id',$user_info['company_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
} else {
	$leave_types = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
}
if($user_info['user_type'] == 'staff'){
	$leave_types = $ConstantsModel->where('company_id',$user_info['company_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
	$total_leave = $LeaveModel->where('employee_id',$usession['sup_user_id'])->countAllResults();
	$leave_pending = $LeaveModel->where('employee_id',$usession['sup_user_id'])->where('status', 1)->countAllResults();
	$total_accepted = $LeaveModel->where('employee_id',$usession['sup_user_id'])->where('status', 2)->countAllResults();
	$total_rejected = $LeaveModel->where('employee_id',$usession['sup_user_id'])->where('status', 3)->countAllResults();
} else {
	$leave_types = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
	$total_leave = $LeaveModel->where('company_id',$usession['sup_user_id'])->orderBy('leave_id', 'ASC')->countAllResults();
	$leave_pending = $LeaveModel->where('company_id',$usession['sup_user_id'])->where('status', 1)->countAllResults();
	$total_accepted = $LeaveModel->where('company_id',$usession['sup_user_id'])->where('status', 2)->countAllResults();
	$total_rejected = $LeaveModel->where('company_id',$usession['sup_user_id'])->where('status', 3)->countAllResults();
}
$get_animate = '';
// get type||variable
$get_type = $request->getVar('type',FILTER_SANITIZE_STRING);
?>
<?php if(in_array('leave2',staff_role_resource()) || in_array('leave_calendar',staff_role_resource()) || in_array('leave_type1',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>

<div id="smartwizard-2" class="border-bottom smartwizard-example sw-main sw-theme-default mt-2">
  <ul class="nav nav-tabs step-anchor">
    <?php if(in_array('leave2',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
    <li class="nav-item active"> <a href="<?= site_url('erp/leave-list');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-plus-square"></span>
      <?= lang('Dashboard.xin_manage_leaves');?>
      <div class="text-muted small">
        <?= lang('Main.xin_set_up');?>
        <?= lang('Leave.left_leave');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('leave_type1',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/leave-type');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon fas fa-tasks"></span>
      <?= lang('Leave.xin_leave_type');?>
      <div class="text-muted small">
        <?= lang('Main.xin_add');?>
        <?= lang('Leave.xin_leave_type');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('leave_calendar',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/leave-calendar');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-calendar"></span>
      <?= lang('Dashboard.xin_acc_calendar');?>
      <div class="text-muted small">
        <?= lang('Leave.xin_leave_calendar');?>
      </div>
      </a> </li>
    <?php } ?>
  </ul>
</div>
<hr class="border-light m-0 mb-3">
<?php } ?>
<div class="row">
  <div class="col-md-6 col-sm-6 col-xl-3">
    <div class="card prod-p-card background-pattern">
      <div class="card-body">
        <div class="row align-items-center m-b-0">
          <div class="col">
            <h6 class="m-b-5">
              <?= lang('Dashboard.xin_total_leaves');?>
            </h6>
            <h3 class="m-b-0">
              <?= $total_leave;?>
            </h3>
          </div>
          <div class="col-auto"> <i class="fas fa-money-bill-alt text-primary"></i> </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xl-3">
    <div class="card prod-p-card bg-primary background-pattern-white">
      <div class="card-body">
        <div class="row align-items-center m-b-0">
          <div class="col">
            <h6 class="m-b-5 text-white">
              <?= lang('Main.xin_approved');?>
            </h6>
            <h3 class="m-b-0 text-white">
              <?= $total_accepted;?>
            </h3>
          </div>
          <div class="col-auto"> <i class="fas fa-database text-white"></i> </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xl-3">
    <div class="card prod-p-card bg-primary background-pattern-white">
      <div class="card-body">
        <div class="row align-items-center m-b-0">
          <div class="col">
            <h6 class="m-b-5 text-white">
              <?= lang('Main.xin_rejected');?>
            </h6>
            <h3 class="m-b-0 text-white">
              <?= $total_rejected;?>
            </h3>
          </div>
          <div class="col-auto"> <i class="fas fa-dollar-sign text-white"></i> </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xl-3">
    <div class="card prod-p-card background-pattern">
      <div class="card-body">
        <div class="row align-items-center m-b-0">
          <div class="col">
            <h6 class="m-b-5">
              <?= lang('Main.xin_pending');?>
            </h6>
            <h3 class="m-b-0">
              <?= $leave_pending;?>
            </h3>
          </div>
          <div class="col-auto"> <i class="fas fa-tags text-primary"></i> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row m-b-1 animated fadeInRight">
<div class="col-md-12">
<?php if(in_array('leave3',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
<div id="add_form" class="collapse add-form <?php if($get_type=='apply'):?>show<?php endif;?>" data-parent="#accordion" style="">
  <?php $attributes = array('name' => 'add_leave', 'id' => 'xin-form', 'autocomplete' => 'off');?>
  <?php $hidden = array('_user' => 1);?>
  <?php echo form_open('erp/leave/add_leave', $attributes, $hidden);?>
  <div class="row">
    <div class="col-md-8">
      <div class="card mb-2">
        <div id="accordion">
          <div class="card-header">
            <h5>
              <?= lang('Main.xin_add');?>
              <?= lang('Leave.left_leave');?>
            </h5>
            <div class="card-header-right"> <a  data-toggle="collapse" href="#add_form" aria-expanded="false" class="collapsed btn btn-sm waves-effect waves-light btn-primary m-0"> <i data-feather="minus"></i>
              <?= lang('Main.xin_hide');?>
              </a> </div>
          </div>
          <div class="card-body">
            <div class="row">
              <?php if($user_info['user_type'] == 'company'){?>
              <?php $staff_info = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->findAll();?>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="employees" class="control-label">
                    <?= lang('Dashboard.dashboard_employee');?> <span class="text-danger">*</span>
                  </label>
                  <select class="form-control staff-id" name="employee_id" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.dashboard_employee');?>">
                    <?php foreach($staff_info as $staff) {?>
                    <option value="<?= $staff['user_id']?>">
                    <?= $staff['first_name'].' '.$staff['last_name'] ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <?php $colmd = 'col-md-6'?>
              <?php } else { ?>
                <?php 
              $db = \Config\Database::connect();
              $sql = "SELECT  user_id,
              company_id,
              reporting_manager 
      FROM    (SELECT * FROM `ci_erp_users_details`
               ORDER BY user_id) reporting_manager,
              (SELECT @pv := '".$user_info['user_id']."') initialisation
      WHERE   FIND_IN_SET(reporting_manager, @pv)
      AND     LENGTH(@pv := CONCAT(@pv, ',', user_id))";
      $query =  $db->query($sql);
     $result = $query->getResult();
     if(!empty($result)) {
                 ?>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="employees" class="control-label">
                    <?= lang('Dashboard.dashboard_employee');?> <span class="text-danger">*</span>
                  </label>
                  <select class="form-control staff-id" name="employee_id" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.dashboard_employee');?>">
                  <option value="<?= $usession['sup_user_id']?>">
                    <?= get_name($usession['sup_user_id']); ?>
                    </option>
                  <?php foreach($result as $staff) {
                    if(get_name($staff->user_id) != "") { ?>
                    <option value="<?= $staff->user_id?>">
                    <?= get_name($staff->user_id); ?>
                    </option>
                    <?php } } ?>
                  </select>
                </div>
              </div>
              <?php $colmd = 'col-md-6'; } else { ?>
              <?php $colmd = 'col-md-12'?>
              <input type="hidden" class="staff-id" name="employee_id" value="<?= $usession['sup_user_id'];?>" />
              <?php } } ?>
              <div class="<?= $colmd?>">
                <div class="form-group" id="employee_ajax">
                  <label for="leave_type" class="control-label">
                    <?= lang('Leave.xin_leave_type');?> <span class="text-danger">*</span>
                  </label>
                  <select class="form-control leave-type" name="leave_type" data-plugin="select_hrm" data-placeholder="<?= lang('Leave.xin_leave_type');?>">
                    <option value=""></option>
                    <?php foreach($leave_types as $ileave_type):?>
                    <option value="<?= $ileave_type['constants_id'];?>">
                    <?= $ileave_type['category_name'];?>
                    </option>
                    <?php endforeach;?>
                  </select><br />
                  <span id="summary_leave" class="summary-leave" style="display:none;" data-toggle="tooltip" data-placement="top" data-state="primary" title="<?= lang('Main.xin_view_leave_type_summary');?>"></span>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-12">
              	<div class="alert alert-success" role="alert">
                    <?= lang('Main.xin_select_leave_days');?>
                </div>
              </div>
            </div>
            
              <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="start_date">
                    <?= lang('Projects.xin_start_date');?> <span class="text-danger">*</span>
                  </label>
                  <div class="input-group">
                    <input class="form-control date eto-clear" placeholder="<?= lang('Projects.xin_start_date');?>" name="start_date" type="text" value="">
                    <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="end_date">
                    <?= lang('Projects.xin_end_date');?> <span class="text-danger">*</span>
                  </label>
                  <div class="input-group">
                    <input class="form-control date eto-clear" placeholder="<?= lang('Projects.xin_end_date');?>" name="end_date" type="text" value="">
                    <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="end_date">
                    <?= lang('Main.xin_clear_date');?>
                  </label>
                  <button type="button" class="btn icon-btn btn-light-danger clear-date"><?= lang('Main.xin_clear');?></button>
                </div>
              </div>
             </div>
             <div class="row">
              <div class="col-md-12">
              	<div class="alert alert-warning" role="alert">
                    <?= lang('Main.xin_select_leave_hours');?>
                </div>
              </div>
            </div>
             <div class="row">
             <div class="col-md-4">
                <div class="form-group">
                  <label for="start_date">
                    <?= lang('Main.xin_particular_date');?> <span class="text-danger">*</span>
                  </label>
                  <div class="input-group">
                    <input class="form-control date" placeholder="<?= lang('Main.xin_particular_date');?>" name="particular_date" type="text" value="<?= date('Y-m-d');?>">
                    <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
                  </div>
                </div>
              </div>
              <div class="col-md-4" style="display:none;">
                <div class="form-group">
                  <label for="employees" class="control-label">
                    <?= lang('Main.xin_leave_period');?> <span class="text-danger">*</span>
                  </label>
                  <select class="form-control" id="leave_hours" name="leave_hours" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_leave_period');?>">
                    <option value="">
                    <?= lang('Main.xin_leave_period');?>
                    </option>
                    <option value="1">
                    <?= lang('Main.xin_1hour');?>
                    </option>
                    <option value="2">
                    <?= lang('Main.xin_2hours');?>
                    </option>
                    <option value="3">
                    <?= lang('Main.xin_3hours');?>
                    </option>
                    <option value="4">
                    <?= lang('Main.xin_4hours');?>
                    </option>
                    <option value="5">
                    <?= lang('Main.xin_5hours');?>
                    </option>
                    <option value="6">
                    <?= lang('Main.xin_6hours');?>
                    </option>
                    <option value="7">
                    <?= lang('Main.xin_7hours');?>
                    </option>
                    <option value="11">
                    <?= lang('Main.xin_others');?>
                    </option>
                  </select>
                </div>
              </div>
              <div class="row timerow">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="clock_in">
                            <?= lang('Employees.xin_shift_in_time');?>
                        </label>
                        <div class="input-group">
                            <input class="form-control live_time_dropdown time-check"
                                placeholder="<?= lang('Employees.xin_shift_in_time');?>" name="clock_in_m" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="clock_out">
                            <?= lang('Employees.xin_shift_out_time');?>
                        </label>
                        <div class="input-group">
                            <input class="form-control live_time_dropdown time-check"
                                placeholder="<?= lang('Employees.xin_shift_out_time');?>" name="clock_out_m"
                                type="text">
                        </div>
                    </div>
                </div>
            </div>
              <div class="col-lg-4 col-md-6 col-sm-6 morehr-val" style="display:none;">
              		<label for="employees" class="control-label">
                    <?= lang('Main.xin_leave_hours');?> <span class="text-danger">*</span>
                  </label>
                    <div class="input-group">
                        <input class="form-control" name="dec_leave_hours" placeholder="<?= lang('Main.xin_leave_hours');?>" type="text" value="0.5">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="feather icon-clock"></i>
                            </span>
                        </div>
                        <small><?= lang('Main.xin_enter_leave_hours_detail');?></small>
                    </div>
                </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="description">
                    <?= lang('Recruitment.xin_remarks');?>
                  </label>
                  <textarea class="form-control textarea" placeholder="<?= lang('Recruitment.xin_remarks');?>" name="remarks" rows="2"></textarea>
                </div>
              </div>
              <?php /*?><div class="col-md-12">
                <div class="form-group">
                  <label for="summary">
                    <?= lang('Leave.xin_leave_reason');?> <span class="text-danger">*</span>
                  </label>
                  <textarea class="form-control" placeholder="<?= lang('Leave.xin_leave_reason');?>" name="reason" cols="30" rows="2" id="reason"></textarea>
                </div>
              </div><?php */?>
            </div>
          </div>
          <div class="card-footer text-right">
            <button type="reset" class="btn btn-light" href="#add_form" data-toggle="collapse" aria-expanded="false">
            <?= lang('Main.xin_reset');?>
            </button>
            &nbsp;
            <button type="submit" class="btn btn-primary">
            <?= lang('Main.xin_save');?>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h5>
            <?= lang('Leave.xin_leave_attachment');?>
          </h5>
        </div>
        <div class="card-body py-2">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <fieldset class="form-group">
                  <label for="attachment">
                    <?= lang('Main.xin_attachment');?>
                  </label>
                  <input type="file" class="form-control-file" id="attachment" name="attachment">
                  <small>
                  <?= lang('Leave.xin_leave_file_type');?>
                  </small>
                </fieldset>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <?= form_close(); ?>
</div>
<?php } ?>
<div class="card user-profile-list <?php echo $get_animate;?>">
  <div class="card-header">
    <h5>
      <?= lang('Main.xin_list_all');?>
      <?= lang('Leave.left_leave');?>
    </h5>
    <?php if(in_array('leave3',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
    <div class="card-header-right"> <a  data-toggle="collapse" href="#add_form" aria-expanded="false" class="collapsed btn waves-effect waves-light btn-primary btn-sm m-0"> <i data-feather="plus"></i>
      <?= lang('Main.xin_add_new');?>
      </a> </div>
    <?php } ?>
  </div>
  <div class="card-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="xin_table">
        <thead>
          <tr>
            <th><?= lang('Dashboard.dashboard_employee');?></th>
            <th><?= lang('Leave.xin_leave_type');?></th>
            <th><?= lang('Main.xin_leave_hours');?></th>
            <th><i class="fa fa-calendar"></i>
              <?= lang('Leave.xin_leave_duration');?></th>
            <th><i class="fa fa-calendar"></i>
              <?= lang('Leave.xin_applied_on');?></th>
            <th><?= lang('Main.dashboard_xin_status');?></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
<?php /*?><div class="row">
  <div class="col-xl-6 col-md-12">
    <div class="card">
      <div class="card-body">
        <h6>
          <?= lang('Dashboard.xin_leave_status');?>
        </h6>
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col">
            <div id="leave-status-chart"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-md-12">
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="card">
          <div class="card-body">
            <h6>
              <?= lang('Leave.xin_leave_type_status');?>
            </h6>
            <div class="row d-flex justify-content-center align-items-center">
              <div class="col">
                <div id="leave-type-chart"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><?php */?>
