<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
// get type||variable
$get_type = $request->getVar('type',FILTER_SANITIZE_STRING);
?>
<?php if(in_array('attendance',staff_role_resource()) || in_array('upattendance1',staff_role_resource()) || in_array('monthly_time',staff_role_resource()) || in_array('overtime_req1',staff_role_resource())|| $user_info['user_type'] == 'company') {?>

<div id="smartwizard-2" class="border-bottom smartwizard-example sw-main sw-theme-default mt-2">
  <ul class="nav nav-tabs step-anchor">
    <?php if(in_array('attendance',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/attendance-list');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-clock"></span>
      <?= lang('Dashboard.left_attendance');?>
      <div class="text-muted small">
        <?= lang('Main.xin_view');?>
        <?= lang('Dashboard.left_attendance');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('upattendance1',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/manual-attendance');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-edit"></span>
      <?= lang('Dashboard.left_update_attendance');?>
      <div class="text-muted small">
        <?= lang('Main.xin_add_edit');?>
        <?= lang('Dashboard.left_attendance');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('monthly_time',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/monthly-attendance');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-calendar"></span>
      <?= lang('Dashboard.xin_month_timesheet_title');?>
      <div class="text-muted small">
        <?= lang('Main.xin_view');?>
        <?= lang('Dashboard.xin_month_timesheet_title');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('upattendance1',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/update-attendance-view');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-calendar"></span>
      <?= lang('Dashboard.left_update_attendance_employee');?>
      <div class="text-muted small">
        <?= lang('Main.xin_view');?>
        <?= lang('Dashboard.xin_month_timesheet_title');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('overtime_req1',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
    <li class="nav-item active"> <a href="<?= site_url('erp/overtime-request');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-plus-square"></span>
      <?= lang('Dashboard.xin_overtime_request');?>
      <div class="text-muted small">
        <?= lang('Main.xin_set_up');?>
        <?= lang('Dashboard.xin_overtime_request');?>
      </div>
      </a> </li>
    <?php } ?>
  </ul>
</div>
<hr class="border-light m-0 mb-3">
<?php } ?>
<div class="row m-b-1">
  <?php if(in_array('overtime_req2',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
  <div id="add_form" class="collapse add-form <?php if($get_type=='apply'):?>show<?php endif;?>" data-parent="#accordion" style="">
    <div id="accordion">
      <div class="card">
        <div class="card-header">
          <h5>
            <?= lang('Attendance.xin_add_overtime_request');?>
          </h5>
          <div class="card-header-right"> <a  data-toggle="collapse" href="#add_form" aria-expanded="false" class="collapsed btn btn-sm waves-effect waves-light btn-primary m-0"> <i data-feather="minus"></i>
            <?= lang('Main.xin_hide');?>
            </a> </div>
        </div>
        <?php $attributes = array('name' => 'add_attendance', 'id' => 'add_attendance', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
		<?php $hidden = array('_method' => 'ADD');?>
        <?php echo form_open('erp/timesheet/add_overtime', $attributes, $hidden);?>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
            <div class="row">
              <?php if($user_info['user_type'] == 'company'){?>
              <?php $staff_info = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->findAll();?>
              
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="first_name">
                      <?= lang('Dashboard.dashboard_employee');?>
                      <span class="text-danger">*</span> </label>
                    <select class="form-control" name="employee_id" data-plugin="select_hrm"
                            data-placeholder="<?= lang('Dashboard.dashboard_employee');?>">
                      <?php foreach($staff_info as $staff) {?>
                      <option value="<?= $staff['user_id']?>">
                      <?= $staff['first_name'].' '.$staff['last_name'] ?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              <?php } else {  
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
			 $result = $query->getResult(); ?>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="first_name">
                      <?= lang('Dashboard.dashboard_employee');?>
                      <span class="text-danger">*</span> </label>
                    <select class="form-control" name="employee_id" data-plugin="select_hrm"
                            data-placeholder="<?= lang('Dashboard.dashboard_employee');?>">
                      <option value="<?= $usession['sup_user_id']?>">
                      <?= get_name($usession['sup_user_id']); ?>
                      </option>
                      <?php if(!empty($result)) { 
                              foreach($result as $staff) { 
                                if(get_name($staff->user_id) != "") { ?>
                      <option value="<?= $staff->user_id?>">
                      <?= get_name($staff->user_id); ?>
                      </option>
                      <?php } } }  ?>
                    </select>
                  </div>
                </div>
              <?php } ?>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date">
                      <?= lang('Main.xin_e_details_date');?>
                      <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <input class="form-control date"
                                placeholder="<?= lang('Main.xin_e_details_date');?>" readonly="true"
                                name="attendance_date_m" type="text">
                      <div class="input-group-append"><span class="input-group-text"><i
                                        class="fas fa-calendar-alt"></i></span></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="clock_in">
                      <?= lang('Employees.xin_shift_in_time');?>
                      <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <input class="form-control time_dropdown_add"
                                placeholder="<?= lang('Employees.xin_shift_in_time');?>" name="clock_in_m" type="text">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="clock_out">
                      <?= lang('Employees.xin_shift_out_time');?>
                      <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <input class="form-control time_dropdown_add"
                                placeholder="<?= lang('Employees.xin_shift_out_time');?>" name="clock_out_m"
                                type="text">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="first_name">
                      <?= lang('Main.xin_overtime_reason');?>
                      <span class="text-danger">*</span> </label>
                    <select class="form-control overtime_reason" id="overtime_reason" name="overtime_reason"
                            data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_overtime_reason');?>">
                      <option value="">
                      <?= lang('Main.xin_overtime_reason');?>
                      </option>
                      <option value="1">
                      <?= lang('Main.xin_overtime_standby_pay');?>
                      </option>
                      <option value="2">
                      <?= lang('Main.xin_overtime_work_through_lunch');?>
                      </option>
                      <option value="3">
                      <?= lang('Main.xin_overtime_out_of_town');?>
                      </option>
                      <option value="4">
                      <?= lang('Main.xin_overtime_salaried_employee');?>
                      </option>
                      <option value="5">
                      <?= lang('Main.xin_overtime_additional_work_hours');?>
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12 additional-work-hours" style="display:none;">
                  <div class="form-group">
                    <label for="first_name">
                      <?= lang('Main.xin_select_option_additional_work_hours');?>
                      <span class="text-danger">*</span> </label>
                    <select class="form-control" name="additional_work_hours" data-plugin="select_hrm"
                            data-placeholder="<?= lang('Main.xin_select_option_additional_work_hours');?>">
                      <option value="">
                      <?= lang('Main.xin_select_option_additional_work_hours');?>
                      </option>
                      <option value="1">
                      <?= lang('Main.xin_straight_overtime');?>
                      </option>
                      <option value="2">
                      <?= lang('Main.xin_time_ahalf_overtime');?>
                      </option>
                      <option value="3">
                      <?= lang('Main.xin_double_overtime');?>
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="first_name">
                      <?= lang('Main.xin_compensation_type');?>
                      <span class="text-danger">*</span> </label>
                    <select class="form-control" name="compensation_type" data-plugin="select_hrm"
                            data-placeholder="<?= lang('Main.xin_compensation_type');?>">
                      <option value="">
                      <?= lang('Main.xin_compensation_type');?>
                      </option>
                      <option  id="banked_class" value="1">
                      <?= lang('Main.xin_banked');?>
                      </option>
                      <option value="2">
                      <?= lang('Main.xin_payout');?>
                      </option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="date">
                      <?= lang('Main.xin_description');?>
                    </label>
                    <textarea class="form-control" placeholder="<?= lang('Main.xin_description');?>"
                            name="description" type="text"></textarea>
                  </div>
                </div>
              </div>
            </div>
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
        <?= form_close(); ?>
      </div>
    </div>
  </div>
  <?php } ?>
  <div class="col-md-12">
    <div class="card mb-4 user-profile-list">
      <div class="card-header">
        <h5>
          <?= lang('Dashboard.xin_overtime_request');?>
        </h5>
        <?php if(in_array('overtime_req2',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
        <div class="card-header-right">
          <div class="card-header-right"> <a  data-toggle="collapse" href="#add_form" aria-expanded="false" class="collapsed btn waves-effect waves-light btn-primary btn-sm m-0"> <i data-feather="plus"></i>
            <?= lang('Main.xin_add_new');?>
            </a> </div>
        </div>
        <?php } ?>
      </div>
      <div class="card-body">
        <div class="box-datatable table-responsive">
          <table class="datatables-demo table table-striped table-bordered" id="xin_table">
            <thead>
              <tr>
                <th><?= lang('Dashboard.dashboard_employee');?></th>
                <th><?= lang('Main.xin_e_details_date');?></th>
                <th><?= lang('Employees.xin_shift_in_time');?></th>
                <th><?= lang('Employees.xin_shift_out_time');?></th>
                <th><?= lang('Attendance.xin_overtime_thours');?></th>
                <th><?= lang('Main.dashboard_xin_status');?></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
