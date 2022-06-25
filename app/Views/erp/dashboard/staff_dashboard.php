<?php
use CodeIgniter\I18n\Time;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\ConstantsModel;
use App\Models\LeaveModel;
use App\Models\ShiftModel;
use App\Models\TicketsModel;
use App\Models\ProjectsModel;
use App\Models\DesignationModel;
use App\Models\TransactionsModel;
use App\Models\StaffdetailsModel;
use App\Models\AnnouncementModel;
use App\Models\BalanceHistoryModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$LeaveModel = new LeaveModel();
$ShiftModel = new ShiftModel();
$TicketsModel = new TicketsModel();
$ProjectsModel = new ProjectsModel();
$ConstantsModel = new ConstantsModel();
$DesignationModel = new DesignationModel();
$TransactionsModel = new TransactionsModel();
$StaffdetailsModel = new StaffdetailsModel();
$AnnouncementModel = new AnnouncementModel();
$BalanceHistoryModel = new BalanceHistoryModel();

$session = \Config\Services::session();
$db = \Config\Database::connect();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$xin_system = erp_company_settings();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$total_staff = $UsersModel->where('company_id', $user_info['company_id'])->where('user_type','staff')->countAllResults();
	$total_projects = $ProjectsModel->where('company_id',$user_info['company_id'])->countAllResults();
	$total_tickets = $TicketsModel->where('company_id',$user_info['company_id'])->countAllResults();
	$open = $TicketsModel->where('company_id',$user_info['company_id'])->where('ticket_status', 1)->countAllResults();
	$closed = $TicketsModel->where('company_id',$user_info['company_id'])->where('ticket_status', 2)->countAllResults();
	$_company_id = $user_info['company_id'];
} else {
	$total_staff = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->countAllResults();
	$total_projects = $ProjectsModel->where('company_id',$usession['sup_user_id'])->countAllResults();
	$total_tickets = $TicketsModel->where('company_id',$usession['sup_user_id'])->countAllResults();
	$open = $TicketsModel->where('company_id',$usession['sup_user_id'])->where('ticket_status', 1)->countAllResults();
	$closed = $TicketsModel->where('company_id',$usession['sup_user_id'])->where('ticket_status', 2)->countAllResults();
	$_company_id = $usession['sup_user_id'];
}
$announcements = $AnnouncementModel->where('company_id',$_company_id)->orderBy('announcement_id', 'DESC')->findAll(8);
$cnt_announcements = $AnnouncementModel->where('company_id',$_company_id)->orderBy('announcement_id', 'DESC')->countAllResults();
//upcoming birthday
$curr_date = date('Y-m-d');
$date_of_leaving = $StaffdetailsModel->where('company_id', $_company_id)->where('date_of_birth',$curr_date)->findAll();
$count_birthday = $StaffdetailsModel->where('company_id', $_company_id)->where('date_of_birth',$curr_date)->countAllResults();
// leave types
$leave_types = $ConstantsModel->where('company_id',$_company_id)->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
$employee_detail = $StaffdetailsModel->where('user_id', $usession['sup_user_id'])->first();
$office_shifts = $ShiftModel->where('company_id', $_company_id)->where('office_shift_id', $employee_detail['office_shift_id'])->first();
$idesignations = $DesignationModel->where('company_id', $_company_id)->where('designation_id',$employee_detail['designation_id'])->first();
if($idesignations){
	$designation_name = $idesignations['designation_name'];
} else {
	$designation_name = '';
}
$att_date =  date('d-M-Y');
$get_day = strtotime($att_date);
$day = date('l', $get_day);
if($office_shifts){
	if($day == 'Monday') {
		if($office_shifts['monday_in_time'] == '') {
			$shift_val = lang('Attendance.attendance_today').': <span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';
		} else {
			$monday_in_time = strtotime($office_shifts['monday_in_time']);
			$imonday_in_time = date("h:i a", $monday_in_time);
			$monday_out_time = strtotime($office_shifts['monday_out_time']);
			$imonday_out_time = date("h:i a", $monday_out_time);
			$shift_val = lang('Dashboard.dashboard_my_office_shift').': '.$imonday_in_time .' ' .lang('Employees.dashboard_to').' ' .$imonday_out_time;
		}
	} else if($day == 'Tuesday') {	
		if($office_shifts['tuesday_in_time'] == '') {
			$shift_val = lang('Attendance.attendance_today').': <span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';
		} else {
			$tuesday_in_time = strtotime($office_shifts['tuesday_in_time']);
			$ituesday_in_time = date("h:i a", $tuesday_in_time);
			$tuesday_out_time = strtotime($office_shifts['tuesday_out_time']);
			$ituesday_out_time = date("h:i a", $tuesday_out_time);
			$shift_val = lang('Dashboard.dashboard_my_office_shift').': '.$ituesday_in_time .' ' . lang('Employees.dashboard_to').' '.$ituesday_out_time;
		}
	} else if($day == 'Wednesday') {
		if($office_shifts['wednesday_in_time'] == '') {
			$shift_val = lang('Attendance.attendance_today').': <span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';
		} else {
			$wednesday_in_time = strtotime($office_shifts['wednesday_in_time']);
			$iwednesday_in_time = date("h:i a", $wednesday_in_time);
			$wednesday_out_time = strtotime($office_shifts['wednesday_out_time']);
			$iwednesday_out_time = date("h:i a", $wednesday_out_time);
			$shift_val = lang('Dashboard.dashboard_my_office_shift').': '.$iwednesday_in_time .' ' . lang('Employees.dashboard_to').' ' .$iwednesday_out_time;
		}
	} else if($day == 'Thursday') {	
		if($office_shifts['thursday_in_time'] == '') {
			$shift_val = lang('Attendance.attendance_today').': <span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';
		} else {
			$thursday_in_time = strtotime($office_shifts['thursday_in_time']);
			$ithursday_in_time = date("h:i a", $thursday_in_time);
			$thursday_out_time = strtotime($office_shifts['thursday_out_time']);
			$ithursday_out_time = date("h:i a", $thursday_out_time);
			$shift_val = lang('Dashboard.dashboard_my_office_shift').': '.$ithursday_in_time .' ' . lang('Employees.dashboard_to').' ' .$ithursday_out_time;
		}
	} else if($day == 'Friday') {	
		if($office_shifts['friday_in_time'] == '') {
			$shift_val = lang('Attendance.attendance_today').': <span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';
		} else {
			$friday_in_time = strtotime($office_shifts['friday_in_time']);
			$ifriday_in_time = date("h:i a", $friday_in_time);
			$friday_out_time = strtotime($office_shifts['friday_out_time']);
			$ifriday_out_time = date("h:i a", $friday_out_time);
			$shift_val = lang('Dashboard.dashboard_my_office_shift').': '.$ifriday_in_time .' ' . lang('Employees.dashboard_to').' ' .$ifriday_out_time;
		}
	} else if($day == 'Saturday') {	
		if($office_shifts['saturday_in_time'] == '') {
			$shift_val = lang('Attendance.attendance_today').': <span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';
		} else {
			$saturday_in_time = strtotime($office_shifts['saturday_in_time']);
			$isaturday_in_time = date("h:i a", $saturday_in_time);
			$saturday_out_time = strtotime($office_shifts['saturday_out_time']);
			$isaturday_out_time = date("h:i a", $saturday_out_time);
			$shift_val = lang('Dashboard.dashboard_my_office_shift').': '.$isaturday_in_time .' ' . lang('Employees.dashboard_to').' ' .$isaturday_out_time;
		}
	} else if($day == 'Sunday') {	
		if($office_shifts['sunday_in_time'] == '') {
			$shift_val = lang('Attendance.attendance_today').': <span class="badge badge-light-success">'.lang('Dashboard.left_holiday').'</span>';
		} else {
			$sunday_in_time = strtotime($office_shifts['sunday_in_time']);
			$isunday_in_time = date("h:i a", $sunday_in_time);
			$sunday_out_time = strtotime($office_shifts['sunday_out_time']);
			$isunday_out_time = date("h:i a", $sunday_out_time);
			$shift_val = lang('Dashboard.dashboard_my_office_shift').': '.$isunday_in_time .' ' . lang('Employees.dashboard_to').' ' .$isunday_out_time;
		}	
	}
} else {
	$shift_val = '';
}

?>
<div class="row">
    <div class="col-xl-6 col-md-12">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card proj-t-card">
                    <div class="card-body">
                        <div class="row align-items-center m-b-10">
                            <div class="col-auto">
                            </div>
                            <div class="col p-l-0">
                                <h6 class="m-b-5"><?= lang('Dashboard.dashboard_welcome');?>
                                    <?= $user_info['first_name'].' '.$user_info['last_name'];?></h6>
                                <h6 class="m-b-0 text-primary"><?= $shift_val;?></h6>
                            </div>
                            <div class="col p-l-0">
                                <h6 class="m-b-5">
                                    <div id="clock" onload="currentTime()"></div>
                                </h6>
                            </div>
                        </div>
                        <?php if($xin_system['enable_ip_address']==0):?>

                        <?php if(attendance_time_checks() < 1) { ?>
                        <?php $attributes = array('name' => 'hr_clocking', 'id' => 'hr_clocking', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
                        <?php $hidden = array('token' => uencode($usession['sup_user_id']));?>
                        <?= form_open('erp/timesheet/set_clocking', $attributes, $hidden);?>
                        <input type="hidden" value="clock_in" name="clock_state" id="clock_state">
                        <input type="hidden" value="" name="time_id" id="time_id">
                        <div class="row align-items-center text-center">
                            <div class="col">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="work_from_home"
                                        name="work_from_home" value="1">
                                    <label class="custom-control-label"
                                        for="work_from_home"><?= lang('Main.xin_work_from_home');?></label>
                                </div>
                            </div>
                            <div class="col">
                                <h6 class="m-b-10">
                                    <button type="submit"
                                        class="btn waves-effect waves-light btn-sm btn-success"><?= lang('Attendance.dashboard_clock_in');?>
                                        <i class="fas fa-long-arrow-alt-right m-r-10"></i></button>
                                </h6>
                            </div>

                        </div>
                        <?= form_close(); ?>
                        <?php } else {?>

                        <div class="row align-items-center text-center">
                            <div class="col">
                                <?php $attributes = array('name' => 'hr_lunchbreak', 'id' => 'hr_lunchbreak', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
                                <?php $hidden = array('token' => uencode($usession['sup_user_id']));?>
                                <?= form_open('erp/timesheet/set_lunch_break', $attributes, $hidden);?>
                                <?php $attendance_value = attendance_time_checks_value();?>
                                <?php $iiclock_in = $attendance_value[0]->clock_in;?>
                                <?php $signed_time = strtotime($iiclock_in); ?>
                                <?php if($attendance_value[0]->lunch_breakin == 0){?>
                                <input type="hidden" value="lunch_breakin" name="clock_state" id="clock_state">
                                <input type="hidden" value="<?= uencode($attendance_value[0]->time_attendance_id);?>"
                                    name="time_id" id="time_id">
                                <h6 class="m-b-0" <?php if($xin_system['is_lunch_break']=="No"){ ?>
                                    style="display:none;" <?php } ?>>
                                    <button type="submit"
                                        class="btn waves-effect waves-light btn-sm btn-success"><?= lang('Main.xin_lunch_out');?>
                                        <i class="fas fa-long-arrow-alt-right m-r-10"></i></button>
                                </h6>
                                <p><?= lang('Main.xin_you_signed_today_at');?> <?= date('g:i a', $signed_time);?></p>
                                <?php } else if($attendance_value[0]->lunch_breakout != 0 && $attendance_value[0]->lunch_breakout != ''){?>
                                <h6 class="m-b-0 text-success">
                                    <i class="fas fa-mug-hot m-r-5"></i><?= lang('Main.xin_back_from_lunch');?>
                                </h6>
                                <p><?= lang('Main.xin_you_signed_today_at');?> <?= date('g:i a', $signed_time);?></p>
                                <?php } else {?>
                                <input type="hidden" value="lunch_breakout" name="clock_state" id="clock_state">
                                <input type="hidden" value="<?= uencode($attendance_value[0]->time_attendance_id);?>"
                                    name="time_id" id="time_id">
                                <h6 class="m-b-0">
                                    <button type="submit"
                                        class="btn waves-effect waves-light btn-sm btn-success"><?= lang('Main.xin_back_from_lunch');?>
                                        <i class="fas fa-long-arrow-alt-down m-r-10"></i></button>
                                </h6>
                                <p><?= lang('Main.xin_you_signed_today_at');?> <?= date('g:i a', $signed_time);?></p>
                                <?php } ?>
                                <?= form_close(); ?>
                            </div>
                            <div class="col">
                                <?php $attributes = array('name' => 'hr_clocking', 'id' => 'hr_clocking', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
                                <?php $hidden = array('token' => uencode($usession['sup_user_id']));?>
                                <?= form_open('erp/timesheet/set_clocking', $attributes, $hidden);?>
                                <?php $attendance_value = attendance_time_checks_value();?>
                                <input type="hidden" value="clock_out" name="clock_state" id="clock_state">
                                <input type="hidden" value="<?= uencode($attendance_value[0]->time_attendance_id);?>"
                                    name="time_id" id="time_id">
                                <h6 class="m-b-0">
                                    <button class="btn waves-effect waves-light btn-sm btn-danger"
                                        type="submit"><?= lang('Attendance.dashboard_clock_out');?> <i
                                            class="fas fa-long-arrow-alt-down m-r-10"></i></button>
                                </h6>
                                <p>&nbsp;</p>
                                <?= form_close(); ?>
                            </div>
                        </div>


                        <?php } ?>

                        <?php else:?>

                        <?php if(attendance_time_checks() < 1) { ?>
                        <?php $attributes = array('name' => 'hr_clocking', 'id' => 'hr_clocking', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
                        <?php $hidden = array('token' => uencode($usession['sup_user_id']));?>
                        <?= form_open('erp/timesheet/set_clocking', $attributes, $hidden);?>
                        <input type="hidden" value="clock_in" name="clock_state" id="clock_state">
                        <input type="hidden" value="" name="time_id" id="time_id">
                        <div class="row align-items-center text-center">
                            <div class="col">
                                <h6 class="m-b-10">
                                    <?php if($request->getIPAddress()==$xin_system['enable_ip_address']):?>
                                    <button type="submit"
                                        class="btn waves-effect waves-light btn-sm btn-success"><?= lang('Attendance.dashboard_clock_in');?>
                                        <i class="fas fa-long-arrow-alt-right m-r-10"></i></button>
                                    <?php else:?>
                                    <button type="button" disabled="disabled"
                                        class="btn waves-effect waves-light btn-sm btn-success"><?= lang('Attendance.dashboard_clock_in');?>
                                        <i class="fas fa-long-arrow-alt-right m-r-10"></i></button>
                                    <?php endif;?>
                                </h6>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="work_from_home"
                                        name="work_from_home" value="1">
                                    <label class="custom-control-label"
                                        for="work_from_home"><?= lang('Main.xin_work_from_home');?></label>
                                </div>
                                <!-- <p class="text-danger"><?= lang('Main.xin_you_havnt_loggedin_today');?></p>-->
                            </div>
                            <div class="col">
                                <h6 class="m-b-0">
                                    <button class="btn waves-effect waves-light btn-sm btn-secondary" type="button"
                                        disabled="disabled"><?= lang('Attendance.dashboard_clock_out');?> <i
                                            class="fas fa-long-arrow-alt-down m-r-10"></i></button>
                                </h6>
                                <p class="text-danger">&nbsp;</p>
                            </div>
                        </div>
                        <?= form_close(); ?>
                        <?php } else {?>
                        <?php $attributes = array('name' => 'hr_clocking', 'id' => 'hr_clocking', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
                        <?php $hidden = array('token' => uencode($usession['sup_user_id']));?>
                        <?= form_open('erp/timesheet/set_clocking', $attributes, $hidden);?>
                        <?php $attendance_value = attendance_time_checks_value();?>
                        <input type="hidden" value="clock_out" name="clock_state" id="clock_state">
                        <input type="hidden" value="<?= uencode($attendance_value[0]->time_attendance_id);?>"
                            name="time_id" id="time_id">
                        <div class="row align-items-center text-center">
                            <div class="col">
                                <h6 class="m-b-0">
                                    <button type="button" disabled="disabled"
                                        class="btn waves-effect waves-light btn-sm btn-success"><?= lang('Attendance.dashboard_clock_in');?>
                                        <i class="fas fa-long-arrow-alt-right m-r-10"></i></button>
                                </h6>
                            </div>
                            <div class="col">
                                <h6 class="m-b-0">
                                    <button class="btn waves-effect waves-light btn-sm btn-secondary"
                                        type="submit"><?= lang('Attendance.dashboard_clock_out');?> <i
                                            class="fas fa-long-arrow-alt-down m-r-10"></i></button>
                                </h6>
                            </div>
                        </div>
                        <?= form_close(); ?>
                        <?php } ?>

                        <?php endif;?>
                        <h6 class="pt-badge badge-light-success"><?= $designation_name;?></h6>
                    </div>
                    <a href="<?= site_url('erp/attendance-list');?>"
                        class="btn btn-primary btn-sm btn-round"><?= lang('Attendance.dashboard_my_attendance');?> <i
                            class="fas fa-long-arrow-alt-right m-r-10"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card prod-p-card background-pattern">
                            <div class="card-body">
                                <div class="row align-items-center m-b-0">
                                    <div class="col">
                                        <h6 class="m-b-5"><?= lang('Dashboard.xin_overtime_request');?></h6>
                                        <h3 class="m-b-0">
                                            <?= staff_overtime_request();?>
                                        </h3>
                                    </div>
                                    <div class="col-auto"> <i class="fas fa-money-bill-alt text-primary"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card prod-p-card bg-primary background-pattern-white">
                            <div class="card-body">
                                <div class="row align-items-center m-b-0">
                                    <div class="col">
                                        <h6 class="m-b-5 text-white"><?= lang('Dashboard.dashboard_travel_request');?>
                                        </h6>
                                        <h3 class="m-b-0 text-white">
                                            <?= staff_travel_request();?>
                                        </h3>
                                    </div>
                                    <div class="col-auto"> <i class="fas fa-database text-white"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>
                            <?= lang('Dashboard.left_announcements');?>
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="activity-scroll" style="height:230px;position:relative;">
                                <div class="card-body">
                                    <div class="tab-pane fade show active m-l-15" id="utab" role="tabpanel">
                                        <?php if($cnt_announcements > 0){?>
                                        <?php foreach($announcements as $_announcement) { ?>
                                        <div class="widget-timeline m-b-25">
                                            <div class="media">
                                                <div class="mr-0 photo-table">
                                                    <i class="fas fa-circle text-success f-10 m-r-10"></i>
                                                </div>
                                                <div class="media-body">
                                                    <a
                                                        href="<?= site_url().'erp/announcement-view/'.uencode($_announcement['announcement_id']);?>">
                                                        <h6 class="d-inline-block m-0"><?= $_announcement['title'];?>
                                                        </h6>
                                                        <span class="text-muted float-right f-13"><i
                                                                class="fas fa-calendar-alt m-r-2"></i>
                                                            <?= set_date_format($_announcement['start_date']);?></span>
                                                        <p class="text-muted m-0"><?= $_announcement['summary'];?></p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php } else {?>
                                        <div class="text-center m-b-25">
                                            <?= lang('Main.xin_no_company_announcements_available');?> <i
                                                class="text-mute fas fa-bullhorn m-r-2"></i>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php if($cnt_announcements > 0){?>
                                    <div class="text-center">
                                        <a href="<?= site_url('erp/news-list');?>"
                                            class="b-b-primary text-primary"><?= lang('Main.xin_view_all');?></a>
                                    </div>
                                    <?php } else {?>
                                    <div class="text-center">
                                        <a href="<?= site_url('erp/news-list');?>"
                                            class="b-b-primary text-primary"><?= lang('Main.xin_add_new').' '.lang('Dashboard.left_announcement');?></a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php /*?><div class="row">
                    <div class="col-sm-6">
                        <div class="card prod-p-card bg-primary background-pattern-white">
                            <div class="card-body">
                                <div class="row align-items-center m-b-0">
                                    <div class="col">
                                        <h6 class="m-b-5 text-white"><?= lang('Dashboard.dashboard_my_awards');?></h6>
                                        <h3 class="m-b-0 text-white">
                                            <?= staff_awards();?>
                                        </h3>
                                    </div>
                                    <div class="col-auto"> <i class="fas fa-dollar-sign text-white"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card prod-p-card background-pattern">
                            <div class="card-body">
                                <div class="row align-items-center m-b-0">
                                    <div class="col">
                                        <h6 class="m-b-5"><?= lang('Dashboard.xin_total_assets');?></h6>
                                        <h3 class="m-b-0">
                                            <?= staff_assets();?>
                                        </h3>
                                    </div>
                                    <div class="col-auto"> <i class="fas fa-tags text-primary"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><?php */?>
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h6><?= lang('Dashboard.left_ticket_priority');?></h6>
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col">
                                        <div id="staff-ticket-priority-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-12">
        <?php /*?><div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            <?= lang('Main.xin_my_alerts');?>
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="activity-scrolld" style="height:230px;position:relative;">
                                <div class="card-body">
                                    <div class="tab-pane fade show active m-l-15" id="utab" role="tabpanel">
                                        <?php if($cnt_announcements > 0){?>
                                        <?php foreach($announcements as $_announcement) { ?>
                                        <div class="widget-timeline m-b-25">
                                            <div class="media">
                                                <div class="mr-0 photo-table">
                                                    <i class="fas fa-circle text-success f-10 m-r-10"></i>
                                                </div>
                                                <div class="media-body">
                                                    <a
                                                        href="<?= site_url().'erp/announcement-view/'.uencode($_announcement['announcement_id']);?>">
                                                        <h6 class="d-inline-block m-0"><?= $_announcement['title'];?>
                                                        </h6>
                                                        <span class="text-muted float-right f-13"><i
                                                                class="fas fa-calendar-alt m-r-2"></i>
                                                            <?= set_date_format($_announcement['start_date']);?></span>
                                                        <p class="text-muted m-0"><?= $_announcement['summary'];?></p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php } else {?>
                                        <div class="text-center m-b-25">
                                            <?= lang('Main.xin_no_company_announcements_available');?> <i
                                                class="text-mute fas fa-bullhorn m-r-2"></i>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php if($cnt_announcements > 0){?>
                                    <div class="text-center">
                                        <a href="<?= site_url('erp/news-list');?>"
                                            class="b-b-primary text-primary"><?= lang('Main.xin_view_all');?></a>
                                    </div>
                                    <?php } else {?>
                                    <div class="text-center">
                                        <a href="<?= site_url('erp/news-list');?>"
                                            class="b-b-primary text-primary"><?= lang('Main.xin_add_new').' '.lang('Dashboard.left_announcement');?></a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><?php */?>
        <?php /*?><div class="card">
            <div class="card-body widget-last-task">
                <p class="m-b-10">On Leave Today</p>
                <ul class="list-unstyled m-b-25">
                    <li class="d-inline-block"><img src="assets/images/user/avatar-2.jpg" alt="user-image"
                            class="img-radius wid-30" data-toggle="tooltip" data-placement="top" title=""
                            data-original-title="User"></li>
                    <li class="d-inline-block"><img src="assets/images/user/avatar-3.jpg" alt="user-image"
                            class="img-radius wid-30" data-toggle="tooltip" data-placement="top" title=""
                            data-original-title="User"></li>
                    <li class="d-inline-block"><img src="assets/images/user/avatar-2.jpg" alt="user-image"
                            class="img-radius wid-30" data-toggle="tooltip" data-placement="top" title=""
                            data-original-title="User"></li>
                    <li class="d-inline-block"><img src="assets/images/user/avatar-3.jpg" alt="user-image"
                            class="img-radius wid-30" data-toggle="tooltip" data-placement="top" title=""
                            data-original-title="User"></li>
                </ul>
                <p class="m-b-10 ">On Leave Tomorrow</p>
                <ul class="list-unstyled  m-b-25">
                    <li class="d-inline-block"><img src="assets/images/user/avatar-2.jpg" alt="user-image"
                            class="img-radius wid-30" data-toggle="tooltip" data-placement="top" title=""
                            data-original-title="User"></li>
                    <li class="d-inline-block"><img src="assets/images/user/avatar-2.jpg" alt="user-image"
                            class="img-radius wid-30" data-toggle="tooltip" data-placement="top" title=""
                            data-original-title="User"></li>
                    <li class="d-inline-block"><img src="assets/images/user/avatar-3.jpg" alt="user-image"
                            class="img-radius wid-30" data-toggle="tooltip" data-placement="top" title=""
                            data-original-title="User"></li>
                </ul>
            </div>
        </div><?php */?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            <?= lang('Main.xin_leave_summary');?>
                        </h5>
                        <div class="card-header-right">
                            <a
                                href="<?= site_url('erp/leave-list');?>"><span><?= lang('Main.xin_apply_for_leave');?></span></a>
                        </div>
                    </div>
                    <?php
		  // quota assignment year
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
                            <div class="activity-scroldl" style="height:230px;position:relative;">
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
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card new-cust-card user-Messages-card">
                    <div class="card-header">
                        <h5>
                            <?= lang('Main.xin_birthday_buddies');?>
                        </h5>
                    </div>
                    <div class="pro-scroll" style="height:215px;position:relative;">
                        <div class="card-body p-b-0">
                            <?php
                foreach($date_of_leaving as $_staff):
                    $_staff_info = $UsersModel->where('user_id', $_staff['user_id'])->first();
                    if($_staff_info){
                        $idesignations = $DesignationModel->where('designation_id',$_staff['designation_id'])->first();
                        if($idesignations) {
                            $staff_position = $idesignations['designation_name'];
                        } else {
                            $staff_position = '---';
                        }
                    ?>
                            <div class="row m-b-10">
                                <div class="col-auto p-r-0">
                                    <div class="u-img">
                                        <img src="<?= staff_profile_photo($_staff['user_id']);?>" alt=""
                                            class="img-radius profile-img">
                                        <span class="tot-msg text-success bg-success"><i
                                                class="text-white fas fa-birthday-cake m-r-2"></i></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <a href="<?= site_url('erp/employee-details').'/'.uencode($_staff['user_id']);?>">
                                        <h6 class="m-b-5"><?= $_staff_info['first_name'].' '.$_staff_info['last_name']?>
                                        </h6>
                                    </a>
                                    <h6 class="text-muted m-b-0 m-t-5"><i class="fas fa-address-card"></i>
                                        <?= $staff_position;?></h6>
                                </div>
                            </div>
                            <?php } ?>
                            <?php endforeach;?>
                            <?php if($count_birthday < 1) {?>
                            <div class="text-center">
                                <?= lang('Main.xin_no_birthday_buddies');?> <i
                                    class="text-mute fas fa-birthday-cake m-r-2"></i>
                            </div>

                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function currentTime() {
    let date = new Date();
    let hh = date.getHours();
    let mm = date.getMinutes();
    let ss = date.getSeconds();
    let session = "AM";

    if (hh == 0) {
        hh = 12;
    }
    if (hh > 12) {
        hh = hh - 12;
        session = "PM";
    }

    hh = (hh < 10) ? "0" + hh : hh;
    mm = (mm < 10) ? "0" + mm : mm;
    ss = (ss < 10) ? "0" + ss : ss;

    let time = hh + ":" + mm + ":" + ss + " " + session;

    document.getElementById("clock").innerText = time;
    let t = setTimeout(function() {
        currentTime()
    }, 1000);
}
currentTime();
</script>