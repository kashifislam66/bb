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
?>

<?php if(in_array('attendance',staff_role_resource()) || in_array('upattendance1',staff_role_resource()) || in_array('monthly_time',staff_role_resource()) || in_array('overtime_req1',staff_role_resource())|| $user_info['user_type'] == 'company') {?>

<div id="smartwizard-2" class="border-bottom smartwizard-example sw-main sw-theme-default mt-2">
    <ul class="nav nav-tabs step-anchor">
        <?php if(in_array('attendance',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
        <li class="nav-item clickable"> <a href="<?= site_url('erp/attendance-list');?>" class="mb-3 nav-link"> <span
                    class="sw-done-icon feather icon-check-circle"></span> <span
                    class="sw-icon feather icon-clock"></span>
                <?= lang('Dashboard.left_attendance');?>
                <div class="text-muted small">
                    <?= lang('Main.xin_view');?>
                    <?= lang('Dashboard.left_attendance');?>
                </div>
            </a> </li>
        <?php } ?>
        <?php if(in_array('upattendance1',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
        <li class="nav-item clickable"> <a href="<?= site_url('erp/manual-attendance');?>" class="mb-3 nav-link"> <span
                    class="sw-done-icon feather icon-check-circle"></span> <span
                    class="sw-icon feather icon-edit"></span>
                <?= lang('Dashboard.left_update_attendance');?>
                <div class="text-muted small">
                    <?= lang('Main.xin_add_edit');?>
                    <?= lang('Dashboard.left_attendance');?>
                </div>
            </a> </li>
        <?php } ?>
        <?php if(in_array('monthly_time',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
        <li class="nav-item clickable"> <a href="<?= site_url('erp/monthly-attendance');?>" class="mb-3 nav-link"> <span
                    class="sw-done-icon feather icon-check-circle"></span> <span
                    class="sw-icon feather icon-calendar"></span>
                <?= lang('Dashboard.xin_month_timesheet_title');?>
                <div class="text-muted small">
                    <?= lang('Main.xin_view');?>
                    <?= lang('Dashboard.xin_month_timesheet_title');?>
                </div>
            </a> </li>
        <?php } ?>
        <?php if(in_array('upattendance1',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
        <li class="nav-item active"> <a href="<?= site_url('erp/update-attendance-view');?>" class="mb-3 nav-link">
                <span class="sw-done-icon feather icon-check-circle"></span> <span
                    class="sw-icon feather icon-calendar"></span>
                <?= lang('Dashboard.left_update_attendance_employee');?>
                <div class="text-muted small">
                    <?= lang('Main.xin_view');?>
                    <?= lang('Dashboard.xin_month_timesheet_title');?>
                </div>
            </a> </li>
        <?php } ?>
        <?php if(in_array('overtime_req1',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
        <li class="nav-item clickable"> <a href="<?= site_url('erp/overtime-request');?>" class="mb-3 nav-link"> <span
                    class="sw-done-icon feather icon-check-circle"></span> <span
                    class="sw-icon feather icon-plus-square"></span>
                <?= lang('Dashboard.xin_overtime_request');?>
                <div class="text-muted small">
                    <?= lang('Main.xin_set_up');?>
                    <?= lang('Dashboard.xin_overtime_request');?>
                </div>
            </a> </li>
        <?php } ?>
    </ul>
</div>
<?php if($session->get('status_changed')){?>
<div class="alert alert-primary alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?= $session->get('status_changed');?>
</div>
<?php } ?>
<hr class="border-light m-0 mb-3">
<?php } ?>
<div class="row m-b-1">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header with-elements">
                <h5>
                    <?= lang('Main.xin_filter');?>
                    <?= lang('Dashboard.left_attendance');?>
                </h5>
            </div>
            <?php $attributes = array('name' => 'update_attendance_report', 'id' => 'update_attendance_report', 'autocomplete' => 'off');?>
            <?php $hidden = array('user_id' => 1);?>
            <?php echo form_open('erp/timesheet/timesheet_attendance_employee_list', $attributes, $hidden);?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date">
                                        Start Date
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control date" placeholder="Start Date"
                                            id="attendance_date_start" name="attendance_date_start" type="text"
                                            value="<?php echo date('Y-m-d');?>">
                                        <div class="input-group-append"><span class="input-group-text"><i
                                                    class="fas fa-calendar-alt"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date">
                                        End Date
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control date" placeholder="End Date"
                                            id="attendance_date_end" name="attendance_date_end" type="text"
                                            value="<?php echo date('Y-m-d');?>">
                                        <div class="input-group-append"><span class="input-group-text"><i
                                                    class="fas fa-calendar-alt"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status">
                                    <?= lang('Projects.xin_status');?>
                                    </label>
                                    <select class="form-control mb-4" id="status" name="status"
                                        data-placeholder="<?= lang('Projects.xin_status');?>">
                                        <option value="Pending">Pending</option>
                                        <option value="Not Approved">Not Approved</option>
                                        <option value="Approved">Approved</option>

                                    </select>
                                </div>
                            </div>
                            <?php if($user_info['user_type'] == 'company'){?>
                            <?php $staff_info = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->findAll();?>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="first_name">
                                        <?= lang('Dashboard.dashboard_employee');?>
                                    </label>
                                    <select class="form-control" name="employee_id" id="employee_id"
                                        data-plugin="select_hrm"
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

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="first_name">
                                        <?= lang('Dashboard.dashboard_employee');?>
                                        <span class="text-danger">*</span> </label>
                                    <select class="form-control" name="employee_id" id="employee_id"
                                        data-plugin="select_hrm"
                                        data-placeholder="<?= lang('Dashboard.dashboard_employee');?>">
                                        <option value="<?= $usession['sup_user_id']?>">
                                            <?= get_name($usession['sup_user_id']); ?></option>
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
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        <?= lang('Main.xin_filter');?>
                    </button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card user-profile-list mb-4">
                <div class="card-header">
                    <h5>
                        <?= lang('Main.xin_view');?>
                        <?= lang('Dashboard.left_attendance');?>
                    </h5>

                    <div class="col-md-6">
                        <select class="form-control mb-4" id="status_select" name="status_select"
                            data-placeholder="<?= lang('Projects.xin_status');?>">
                            <option value="">
                                <?= lang('Projects.xin_status');?>
                            </option>

                            <option value="Pending">Pending</option>
                            <option value="Not Approved">Not Approved</option>
                            <option value="Approved">Approved</option>

                        </select>
                    </div>
                    <input type="hidden" name="hidden_values" value="" class="store_checked_values">

                </div>
                <div class="card-body">
                    <div class="box-datatable table-responsive">
                        
                        <table class="datatables-demo table table-striped table-bordered" id="xin_table">
                        
                            <thead>
                            <!-- <div class="checked_all_box"></div> -->
                                <tr>
                                    <th><input type="checkbox" class="checked_all_box"></th>
                                    <th><?= lang('Dashboard.dashboard_employee');?></th>
                                    <th><?= lang('Main.xin_e_details_date');?></th>
                                    <th><?= lang('Employees.xin_shift_in_time');?></th>
                                    <th><?= lang('Employees.xin_shift_out_time');?></th>
                                    <th><?= lang('Attendance.dashboard_total_work');?></th>
                                    <th><?= lang('Projects.xin_status');?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>