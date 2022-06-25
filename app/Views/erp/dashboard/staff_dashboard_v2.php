<?php
use CodeIgniter\I18n\Time;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\FormsModel;
use App\Models\SystemModel;
use App\Models\ConstantsModel;
use App\Models\LeaveModel;
use App\Models\ShiftModel;
use App\Models\TicketsModel;
use App\Models\ProjectsModel;
use App\Models\TravelModel;
use App\Models\PolicyModel;
use App\Models\WarningModel;
use App\Models\StaffapprovalsModel;
use App\Models\LeaveadjustModel;
use App\Models\SuggestionsModel;
use App\Models\DesignationModel;
use App\Models\TransactionsModel;
use App\Models\StaffdetailsModel;
use App\Models\AnnouncementModel;
use App\Models\OvertimerequestModel;
use App\Models\FormscompletedfieldsModel;
use App\Models\BalanceHistoryModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$LeaveModel = new LeaveModel();
$ShiftModel = new ShiftModel();
$FormsModel = new FormsModel();
$TravelModel = new TravelModel();
$PolicyModel = new PolicyModel();
$WarningModel = new WarningModel();
$TicketsModel = new TicketsModel();
$ProjectsModel = new ProjectsModel();
$ConstantsModel = new ConstantsModel();
$LeaveadjustModel = new LeaveadjustModel();
$DesignationModel = new DesignationModel();
$TransactionsModel = new TransactionsModel();
$StaffdetailsModel = new StaffdetailsModel();
$AnnouncementModel = new AnnouncementModel();
$SuggestionsModel = new SuggestionsModel();
$StaffapprovalsModel = new StaffapprovalsModel();
$OvertimerequestModel = new OvertimerequestModel();
$FormscompletedfieldsModel = new FormscompletedfieldsModel();
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
// forms designer
$staff_forms = $FormsModel->where('company_id', $_company_id)->where('status', 1)->findAll();
// policies
$get_policy_cnt = $PolicyModel->where('company_id',$_company_id)->orderBy('policy_id', 'ASC')->countAllResults();
$get_policy = $PolicyModel->where('company_id',$_company_id)->orderBy('policy_id', 'ASC')->findAll();

$announcements = $AnnouncementModel->where('company_id',$_company_id)->orderBy('announcement_id', 'DESC')->findAll(8);
// print_r($announcements); die();
$cnt_announcements = $AnnouncementModel->where('company_id',$_company_id)->orderBy('announcement_id', 'DESC')->countAllResults();
// suggestions
$suggestions = $SuggestionsModel->where('company_id',$_company_id)->orderBy('suggestion_id', 'DESC')->findAll(8);
$cnt_suggestions = $SuggestionsModel->where('company_id',$_company_id)->orderBy('suggestion_id', 'DESC')->countAllResults();

//upcoming birthday
$curr_date = date('Y-m-d');
$date_of_leaving = $StaffdetailsModel->where('company_id', $_company_id)->where('date_of_birth',$curr_date)->findAll();
$count_birthday = $StaffdetailsModel->where('company_id', $_company_id)->where('date_of_birth',$curr_date)->countAllResults();
// leave types
$leave_types = $ConstantsModel->where('company_id',$_company_id)->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
$employee_detail = $StaffdetailsModel->where('user_id', $usession['sup_user_id'])->first();
//reporting manager info
$rep_manager = $StaffdetailsModel->where('reporting_manager', $usession['sup_user_id'])->countAllResults();
$rep_manager_info = $StaffdetailsModel->where('reporting_manager', $usession['sup_user_id'])->first();
// shift info
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
            <div class="row align-items-center m-b-10 mdash-row">
              <div class="col-sm col-12">
                <h6 class="m-b-5">
                  <?= lang('Dashboard.dashboard_welcome');?>
                  <?= $user_info['first_name'].' '.$user_info['last_name'];?>
                </h6>
                <h6 class="m-b-0 text-primary">
                  <?= $shift_val;?>
                </h6>
              </div>
              <div class="col-sm col-12 mt-sm-0 mt-2 ps-sm-0">
                <h6 class="m-b-5">
                  <div id= "clock" onload="currentTime()"></div>
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
            <div class="row align-items-center text-md-center">
              <div class="col pe-0">
                <div class="custom-control custom-switch d-flex">
                  <input type="checkbox" class="custom-control-input me-2 mt-1" id="work_from_home" name="work_from_home" value="1">
                  <label class="custom-control-label" for="work_from_home">
                    <?= lang('Main.xin_work_from_home');?>
                  </label>
                </div>
              </div>
              <div class="col text-right">
                <h6 class="mb-md-2 mb-0">
                  <button type="submit" class="btn waves-effect waves-light btn-sm btn-success">
                  <?= lang('Attendance.dashboard_clock_in');?>
                  <i class="fas fa-long-arrow-alt-right m-r-10"></i></button>
                </h6>
              </div>
            </div>
            <?= form_close(); ?>
            <?php } else {?>
            <div class="row align-items-center text-center"  >
              <div class="col" >
                <?php $attributes = array('name' => 'hr_lunchbreak', 'id' => 'hr_lunchbreak', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
                <?php $hidden = array('token' => uencode($usession['sup_user_id']));?>
                <?= form_open('erp/timesheet/set_lunch_break', $attributes, $hidden);?>
                <?php $attendance_value = attendance_time_checks_value();?>
                <?php $iiclock_in = $attendance_value[0]->clock_in;?>
                <?php $signed_time = strtotime($iiclock_in); ?>
                <?php if($attendance_value[0]->lunch_breakin == 0){?>
                <input type="hidden" value="lunch_breakin" name="clock_state" id="clock_state">
                <input type="hidden" value="<?= uencode($attendance_value[0]->time_attendance_id);?>" name="time_id" id="time_id">
                <h6 class="m-b-0"  <?php if($xin_system['is_lunch_break']=="No"){ ?> style="display:none;" <?php } ?>>
                  <button type="submit" class="btn waves-effect waves-light btn-sm btn-success">
                  <?= lang('Main.xin_lunch_out');?>
                  <i class="fas fa-long-arrow-alt-right m-r-10"></i></button>
                </h6>
                <p>
                  <?= lang('Main.xin_you_signed_today_at');?>
                  <?= date('g:i a', $signed_time);?>
                </p>
                <?php } else if($attendance_value[0]->lunch_breakout != 0 && $attendance_value[0]->lunch_breakout != ''){?>
                <h6 class="m-b-0 text-success"> <i class="fas fa-mug-hot m-r-5"></i>
                  <?= lang('Main.xin_back_from_lunch');?>
                </h6>
                <p>
                  <?= lang('Main.xin_you_signed_today_at');?>
                  <?= date('g:i a', $signed_time);?>
                </p>
                <?php } else {?>
                <input type="hidden" value="lunch_breakout" name="clock_state" id="clock_state">
                <input type="hidden" value="<?= uencode($attendance_value[0]->time_attendance_id);?>" name="time_id" id="time_id">
                <h6 class="m-b-0">
                  <button type="submit" class="btn waves-effect waves-light btn-sm btn-success">
                  <?= lang('Main.xin_back_from_lunch');?>
                  <i class="fas fa-long-arrow-alt-down m-r-10"></i></button>
                </h6>
                <p>
                  <?= lang('Main.xin_you_signed_today_at');?>
                  <?= date('g:i a', $signed_time);?>
                </p>
                <?php } ?>
                <?= form_close(); ?>
              </div>
              <div class="col">
                <?php $attributes = array('name' => 'hr_clocking', 'id' => 'hr_clocking', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
                <?php $hidden = array('token' => uencode($usession['sup_user_id']));?>
                <?= form_open('erp/timesheet/set_clocking', $attributes, $hidden);?>
                <?php $attendance_value = attendance_time_checks_value();?>
                <input type="hidden" value="clock_out" name="clock_state" id="clock_state">
                <input type="hidden" value="<?= uencode($attendance_value[0]->time_attendance_id);?>" name="time_id" id="time_id">
                <h6 class="m-b-0">
                  <button class="btn waves-effect waves-light btn-sm btn-danger" type="submit">
                  <?= lang('Attendance.dashboard_clock_out');?>
                  <i class="fas fa-long-arrow-alt-down m-r-10"></i></button>
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
                  <button type="submit" class="btn waves-effect waves-light btn-sm btn-success">
                  <?= lang('Attendance.dashboard_clock_in');?>
                  <i class="fas fa-long-arrow-alt-right m-r-10"></i></button>
                  <?php else:?>
                  <button type="button" disabled="disabled" class="btn waves-effect waves-light btn-sm btn-success">
                  <?= lang('Attendance.dashboard_clock_in');?>
                  <i class="fas fa-long-arrow-alt-right m-r-10"></i></button>
                  <?php endif;?>
                </h6>
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="work_from_home" name="work_from_home" value="1">
                  <label class="custom-control-label" for="work_from_home">
                    <?= lang('Main.xin_work_from_home');?>
                  </label>
                </div>
                <!-- <p class="text-danger"><?= lang('Main.xin_you_havnt_loggedin_today');?></p>--> 
              </div>
              <div class="col">
                <h6 class="m-b-0">
                  <button class="btn waves-effect waves-light btn-sm btn-secondary" type="button" disabled="disabled">
                  <?= lang('Attendance.dashboard_clock_out');?>
                  <i class="fas fa-long-arrow-alt-down m-r-10"></i></button>
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
            <input type="hidden" value="<?= uencode($attendance_value[0]->time_attendance_id);?>" name="time_id" id="time_id">
            <div class="row align-items-center text-center">
              <div class="col">
                <h6 class="m-b-0">
                  <button type="button" disabled="disabled" class="btn waves-effect waves-light btn-sm btn-success">
                  <?= lang('Attendance.dashboard_clock_in');?>
                  <i class="fas fa-long-arrow-alt-right m-r-10"></i></button>
                </h6>
              </div>
              <div class="col">
                <h6 class="m-b-0">
                  <button class="btn waves-effect waves-light btn-sm btn-secondary" type="submit">
                  <?= lang('Attendance.dashboard_clock_out');?>
                  <i class="fas fa-long-arrow-alt-down m-r-10"></i></button>
                </h6>
              </div>
            </div>
            <?= form_close(); ?>
            <?php } ?>
            <?php endif;?>
            <h6 class="pt-badge badge-light-success">
              <?= $designation_name;?>
            </h6>
          </div>
          <a href="<?= site_url('erp/attendance-list');?>" class="btn btn-primary btn-sm btn-round">
          <?= lang('Attendance.dashboard_my_attendance');?>
          <i class="fas fa-long-arrow-alt-right m-r-10"></i></a> </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="card">
          <div class="card-header">
            <h5>
              <?= lang('Dashboard.left_announcements');?>
            </h5>
          </div>
          <div class="row">
            <div class="col-xl-12 col-md-12">
              <div class="activity-scroll" >
                <div class="card-body">
                  <div class="tab-pane fade show active m-l-15" id="utab" role="tabpanel">
                    <?php if($cnt_announcements > 0){?>
                    <?php foreach($announcements as $_announcement) { 
                      if((in_array($employee_detail['department_id'], explode(',',$_announcement['department_id'])) OR in_array('all', explode(',',$_announcement['department_id']))) AND (in_array($usession['sup_user_id'], explode(',',$_announcement['audience_id'])) OR in_array('all', explode(',',$_announcement['audience_id'])))){
                     ?>
                    <div class="widget-timeline m-b-25">
                      <div class="media">
                        <div class="mr-0 photo-table"> <i class="fas fa-circle text-success f-10 m-r-10"></i> </div>
                        <div class="media-body"> <a href="<?= site_url().'erp/announcement-view/'.uencode($_announcement['announcement_id']);?>">
                          <h6 class="d-inline-block m-0">
                            <?= $_announcement['title'];?>
                          </h6>
                          <span class="text-muted float-right f-13"><i class="fas fa-calendar-alt m-r-2"></i>
                          <?= set_date_format($_announcement['start_date']);?>
                          </span>
                          <p class="text-muted m-0">
                            <?= $_announcement['summary'];?>
                          </p>
                          </a> </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php } } else {?>
                    <div class="text-center m-b-25">
                      <?= lang('Main.xin_no_company_announcements_available');?>
                      <i class="text-mute fas fa-bullhorn m-r-2"></i> </div>
                    <?php } ?>
                  </div>
                  <?php if($cnt_announcements > 0){?>
                  <div class="text-center"> <a href="<?= site_url('erp/news-list');?>" class="b-b-primary text-primary">
                    <?= lang('Main.xin_view_all');?>
                    </a> </div>
                  <?php } else {?>
                  <div class="text-center"> <a href="<?= site_url('erp/news-list');?>" class="b-b-primary text-primary">
                    <?= lang('Main.xin_add_new').' '.lang('Dashboard.left_announcement');?>
                    </a> </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-12 col-md-12">
        <div class="card latest-update-card">
            <div class="card-header">
                <h5>My Forms</h5>
                <div class="card-header-right"> <a href="<?= site_url('erp/forms-builder');?>"><span>All Forms</span></a> </div>
            </div>
            <?php $attributes = array('name' => 'fill_form', 'id' => 'fill-form', 'autocomplete' => 'off', 'method' => "GET");?>
			  <?php $hidden = array('token' => 1);?>
              <?= form_open('erp/user-submited-form', $attributes, $hidden);?>
            <div class="card-body">
            	<div class="row">
              <div class="col-md-12">
                <div class="form-group">
              <label for="form_to_fill">
				<?= lang('Main.xin_select_form_to_fill');?> 
              </label>
              <select class="form-control fill-form" required name="form_id" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_select_form_to_fill');?>">
                <option value="">
                <?= lang('Main.xin_select_form_to_fill');?>
                </option>
                <?php foreach($staff_forms as $istaff_form) { ?>
                <?php $exp_assigned_to = explode(',',$istaff_form['assigned_to']);?>
                <?php if(in_array('all',$exp_assigned_to) || in_array($usession['sup_user_id'],$exp_assigned_to)){ ?>
                    <option value="<?= uencode($istaff_form['forms_id']);?>">
                    <?= $istaff_form['form_name'];?>
                    </option>
                <?php } }?>
              </select>
              </div>
              </div>
              </div>
				<?php /*?><?php foreach($staff_forms as $istaff_form) { $formcreated_at = set_date_format($istaff_form['created_at']);?>
                <?php $exp_assigned_to = explode(',',$istaff_form['assigned_to']);?>
                <?php if(in_array('all',$exp_assigned_to) || in_array($usession['sup_user_id'],$exp_assigned_to)){ ?>
                <?php
                // form completed fields
                $count_completed_form = $FormscompletedfieldsModel->where('company_id',$_company_id)->where("form_id",$istaff_form['forms_id'])->where("staff_id",$usession['sup_user_id'])->countAllResults();
                if($count_completed_form > 0){
                $completed_form = $FormscompletedfieldsModel->where('company_id',$_company_id)->where("form_id",$istaff_form['forms_id'])->where("staff_id",$usession['sup_user_id'])->first();
                $formupdated_at = set_date_format($completed_form['created_at']);
                if($completed_form['status']==1):
                    $formstatus = '<span class="badge bg-light-success">'.lang('Main.xin_accepted').'</span>';
                    $status_icon = '<i class="feather icon-user-check bg-light-success update-icon"></i>';
                else:
                    $formstatus = '<span class="badge bg-light-warning">'.lang('Main.xin_pending').'</span>';
                    $status_icon = '<i class="feather icon-user-x bg-light-warning update-icon"></i>';
                endif;
                $formsubmited = '<a target="_blank" href="'.site_url('erp/user-submited-form').'/'.uencode($completed_form['completed_field_id']).'">'.lang('Main.xin_form_submited_view').'</a>';
                $formsubmitedtitle = '<span class="text-success">'.lang('Main.xin_form_submited_title').'</span>';
                } else {
                    $formupdated_at = '';
                    $formsubmited = '';
                    $formstatus = '<span class="badge bg-light-warning">'.lang('Main.xin_pending').'</span>';
                    $status_icon = '<i class="feather icon-user-x bg-light-warning update-icon"></i>';
                    $formsubmitedtitle = '<span class="text-danger">'.lang('Main.xin_form_notsubmited_title').'</span>';
                }
                ?>
                <div class="row p-t-20 pb-sm-4 pb-3">
                    <div class="col-sm-auto col-5 text-end update-meta">
                        <small class="text-mute m-b-0 d-inline-flex"><?= $formcreated_at;?></small>
                        <?= $status_icon;?>
                    </div>
                    <div class="col-sm col-7 ps-sm-3 ps-0">
                        <?php if($count_completed_form < 1){?>
                        <a href="<?= site_url('erp/submit-form/').uencode($istaff_form['forms_id']);?>">
                            <h6><?= $istaff_form['form_name'];?> <i class="feather icon-external-link"></i></h6>
                        </a>
                        <?php } else {?>
                            <h6><?= $istaff_form['form_name'];?></h6>
                        <?php } ?>
                        <p class="text-muted m-b-0"><?= $formsubmited;?> <span class="text-mute"> <?= $formsubmitedtitle;?></span></p>
                        <p class="text-muted m-b-0"><?= $formstatus;?></p>
                    </div>
                </div>
                <?php } ?>    
                <?php } ?><?php */?>
            </div>
            <div class="card-footer text-right btn-wrap">
            <button type="submit" class="btn btn-primary">
            <?= lang('Main.xin_fill_form');?>
            </button>
          </div>
          <?= form_close(); ?>
        </div>
    </div>
    </div>
  </div>
  <div class="col-xl-6 col-md-12">
   <!-- My Alerts -->
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="card marketing-card table-card">
          <div class="card-header">
            <h5>
              <?= lang('Main.xin_my_alerts');?>
            </h5>
          </div>
          <div class="pro-scroll">
            <div class="card-body p-b-0">
               <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <tbody>
                        <?php $com_level_option = staff_reporting_manager_info($usession['sup_user_id'],'complaint_settings');?>
                    	<?php $com_alert = staff_approval_notification_complaints_info('complaint_settings');?>
                        <?php if($com_level_option['level1']==$usession['sup_user_id'] || $com_level_option['level2']==$usession['sup_user_id'] || $com_level_option['level3']==$usession['sup_user_id'] || $com_level_option['level4']==$usession['sup_user_id'] || $com_level_option['level5']==$usession['sup_user_id']) { ?>
                        <?php if($com_alert['get_alert_cnt'] > 0): //echo '<pre>'; print_r($com_alert);?>
                    	<tr>
                            <td class=""><i class="feather icon-bell text-danger"></i> Complaint Alert (<?= $com_alert['get_alert_cnt'];?>) 
                            </td>
                            <td><a href="<?= site_url('erp/complaint-alert-list/').uencode($com_alert['get_alert_cnt']);?>"> View Detail</a></td>
                        </tr>
                        <?php  endif; } ?>
                        <?php $leave_level_option = staff_reporting_manager_info($usession['sup_user_id'],'leave_settings');?>
                        <?php $leave_alert = staff_approval_notification_leave_info('leave_settings');?>
                        <?php if($leave_level_option['level1']==$usession['sup_user_id'] || $leave_level_option['level2']==$usession['sup_user_id'] || $leave_level_option['level3']==$usession['sup_user_id'] || $leave_level_option['level4']==$usession['sup_user_id'] || $leave_level_option['level5']==$usession['sup_user_id']) { ?>
                        <?php if($leave_alert['get_leave_alert_cnt'] > 0):?>
                        
                    	<tr>
                            <td class=""><i class="feather icon-bell text-primary"></i> Leave Alert (<?= $leave_alert['get_leave_alert_cnt'];?>) </td>
                            <td class=""> 
                            <a href="<?= site_url('erp/leave-alert-list/').uencode($leave_alert['get_leave_alert_cnt']);?>"> View Detail </a></td>
                        </tr>
                        <?php  endif; }?>
                        <?php $leave_adjust_level_option = staff_reporting_manager_info($usession['sup_user_id'],'leave_adjustment_settings');?>
                        <?php $leave_adjust_alert = staff_approval_notification_leave_adjust_info('leave_adjustment_settings');?>
                        <?php if($leave_adjust_alert['get_leave_adjust_alert_cnt'] > 0):?>
                        <?php if($leave_adjust_level_option['level1']==$usession['sup_user_id'] || $leave_adjust_level_option['level2']==$usession['sup_user_id'] || $leave_adjust_level_option['level3']==$usession['sup_user_id'] || $leave_adjust_level_option['level4']==$usession['sup_user_id'] || $leave_adjust_level_option['level5']==$usession['sup_user_id']) { ?>
                    	<tr>
                            <td><i class="feather icon-bell text-success"></i> Leave Adjustment Alert (<?= $leave_adjust_alert['get_leave_adjust_alert_cnt'];?>) </td>
                            <td><a href="<?= site_url('erp/leave-adjustment-alert-list/').uencode($leave_adjust_alert['get_leave_adjust_alert_cnt']);?>"> View Detail </a></td>
                        </tr>
                        <?php } endif;?>
                        <?php $travel_level_option = staff_reporting_manager_info($usession['sup_user_id'],'travel_settings');?>
                    	<?php $travel_alert = staff_approval_notification_travel_info('travel_settings');?>
                        <?php if($travel_alert['get_travel_alert_cnt'] > 0):?>
                        <?php if($travel_level_option['level1']==$usession['sup_user_id'] || $travel_level_option['level2']==$usession['sup_user_id'] || $travel_level_option['level3']==$usession['sup_user_id'] || $travel_level_option['level4']==$usession['sup_user_id'] || $travel_level_option['level5']==$usession['sup_user_id']) { ?>
                    	<tr>
                            <td><i class="feather icon-bell text-warning"></i> Travel Alert (<?= $travel_alert['get_travel_alert_cnt'];?>) </td>
                            <td>
                            <a href="<?= site_url('erp/travel-alert-list/').uencode($travel_alert['get_travel_alert_cnt']);?>"> View Detail </a></td>
                        </tr>
                        <?php } endif;?>
                        <?php $overtime_level_option = staff_reporting_manager_info($usession['sup_user_id'],'overtime_request_settings');?>
                        <?php $overtime_alert = staff_approval_notification_overtime_info('overtime_request_settings');?>
                        <?php if($overtime_alert['get_overtime_alert_cnt'] > 0):?>
                        <?php if($overtime_level_option['level1']==$usession['sup_user_id'] || $overtime_level_option['level2']==$usession['sup_user_id'] || $overtime_level_option['level3']==$usession['sup_user_id'] || $overtime_level_option['level4']==$usession['sup_user_id'] || $overtime_level_option['level5']==$usession['sup_user_id']) { ?>
                    	<tr>
                            <td><i class="feather icon-bell text-info"></i> Overtime Request Alert (<?= $overtime_alert['get_overtime_alert_cnt'];?>) 
                            </td>
                            <td>
                            <a href="<?= site_url('erp/overtime-request-alert-list/').uencode($overtime_alert['get_overtime_alert_cnt']);?>"> View Detail </a></td>
                        </tr>
                        <?php } endif;?>
                        <?php $incident_level_option = staff_reporting_manager_info($usession['sup_user_id'],'incident_settings');?>
                        <?php $incident_alert = staff_approval_notification_incident_info('incident_settings');?>
                        <?php if($incident_alert['get_incident_alert_cnt'] > 0):?>
                        <?php if($incident_level_option['level1']==$usession['sup_user_id'] || $incident_level_option['level2']==$usession['sup_user_id'] || $incident_level_option['level3']==$usession['sup_user_id'] || $incident_level_option['level4']==$usession['sup_user_id'] || $incident_level_option['level5']==$usession['sup_user_id']) { ?>
                    	<tr>
                            <td><i class="feather icon-bell text-success"></i> Incident Alert (<?= $incident_alert['get_incident_alert_cnt'];?>) 
                            </td>
                            <td>
                            <a href="<?= site_url('erp/incident-alert-list/').uencode($incident_alert['get_incident_alert_cnt']);?>"> View Detail </a></td>
                        </tr>
                        <?php } endif;?>
                        <?php $transfer_level_option = staff_reporting_manager_info($usession['sup_user_id'],'transfer_settings');?>
                        <?php $transfer_alert = staff_approval_notification_transfer_info('transfer_settings');?>
                        <?php if($transfer_alert['get_transfer_alert_cnt'] > 0):?>
                        <?php if($transfer_level_option['level1']==$usession['sup_user_id'] || $transfer_level_option['level2']==$usession['sup_user_id'] || $transfer_level_option['level3']==$usession['sup_user_id'] || $transfer_level_option['level4']==$usession['sup_user_id'] || $transfer_level_option['level5']==$usession['sup_user_id']) { ?>
                    	<tr>
                            <td><i class="feather icon-bell text-success"></i> Transfer Alert (<?= $transfer_alert['get_transfer_alert_cnt'];?>) 
                            </td>
                            <td>
                            <a href="<?= site_url('erp/transfer-alert-list/').uencode($transfer_alert['get_transfer_alert_cnt']);?>"> View Detail </a></td>
                        </tr>
                        <?php } endif;?>
                        <?php $resignation_level_option = staff_reporting_manager_info($usession['sup_user_id'],'resignation_settings');?>
                        <?php $resignation_alert = staff_approval_notification_resignation_info('resignation_settings');?>
                        <?php if($resignation_alert['get_resignation_alert_cnt'] > 0):?>
                        <?php if($resignation_level_option['level1']==$usession['sup_user_id'] || $resignation_level_option['level2']==$usession['sup_user_id'] || $resignation_level_option['level3']==$usession['sup_user_id'] || $resignation_level_option['level4']==$usession['sup_user_id'] || $resignation_level_option['level5']==$usession['sup_user_id']) { ?>
                    	<tr>
                            <td><i class="feather icon-bell text-danger"></i> Resignation Alert (<?= $resignation_alert['get_resignation_alert_cnt'];?>) 
                            </td>
                            <td>
                            <a href="<?= site_url('erp/resignation-alert-list/').uencode($resignation_alert['get_resignation_alert_cnt']);?>"> View Detail </a></td>
                        </tr>
                        <?php } endif;?>
                        <?php $attendance_level_option = staff_reporting_manager_info($usession['sup_user_id'],'attendance_settings');?>
                        <?php $attendance_alert = staff_approval_notification_attendance_info('attendance_settings');?>
                        <?php if($attendance_alert['get_attendance_alert_cnt'] > 0):?>
                        <?php if($attendance_level_option['level1']==$usession['sup_user_id'] || $attendance_level_option['level2']==$usession['sup_user_id'] || $attendance_level_option['level3']==$usession['sup_user_id'] || $attendance_level_option['level4']==$usession['sup_user_id'] || $attendance_level_option['level5']==$usession['sup_user_id']) { ?>
                    	<tr>
                            <td><i class="feather icon-bell text-success"></i> Attendance Submitted Alert (<?= $attendance_alert['get_attendance_alert_cnt'];?>) 
                            </td>
                            <td>
                            <a href="<?= site_url('erp/attendance-alert-list/').uencode($attendance_alert['get_attendance_alert_cnt']);?>"> View Detail </a></td>
                        </tr>
                        <?php } endif;?>
                    </tbody>
                </table>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5>
              <?= lang('Main.xin_leave_summary');?>
            </h5>
            <div class="card-header-right"> <button type="button" data-toggle="modal" data-target=".view-modal-data" class="btn dropdown-toggle">
                    <i class="feather icon-maximize"></i>
                </button> <a href="<?= site_url('erp/leave-list');?>?type=apply"><span>
              <?= lang('Main.xin_apply_for_leave');?>
              </span></a> </div>
          </div>
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
							// Total Entitled = Entitled + Carried Over
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
    <div class="card">
        <div class="card-body widget-last-task">
            <p class="m-b-10"><?= lang('Main.xin_on_leave_today');?></p>
            <?php
            	$on_leave_status = on_leave_status();
				$today_leave = $on_leave_status['today_leave'];
				$tomorrow_leave = $on_leave_status['tomorrow_leave'];
			?>
            <ul class="list-unstyled m-b-5">
            	<?php foreach($today_leave as $today_leave_users): ?>
                <li class="d-inline-block"><img src="<?= staff_profile_photo($today_leave_users['euser_id']);?>" alt="<?= $today_leave_users['full_name'];?>" class="img-radius wid-30" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?= $today_leave_users['full_name'];?>"></li>
                <?php endforeach;?>
            </ul>
            <p class="m-b-10 "><?= lang('Main.xin_on_leave_tomorrow');?></p>
            <ul class="list-unstyled  m-b-5">
                <?php foreach($tomorrow_leave as $tomorrow_leave_users): ?>
                <li class="d-inline-block"><img src="<?= staff_profile_photo($tomorrow_leave_users['euser_id']);?>" alt="<?= $tomorrow_leave_users['full_name'];?>" class="img-radius wid-30" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?= $tomorrow_leave_users['full_name'];?>"></li>
                <?php endforeach;?>
            </ul>                        
        </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="card new-cust-card user-Messages-card">
          <div class="card-header">
            <h5>
              <?= lang('Main.xin_hr_suggestions');?>
            </h5>
          </div>
          <div class="pro-scroll" style="height:215px;position:relative;">
            <div class="card-body">
                  <div class="tab-pane fade show active m-l-15" id="utab" role="tabpanel">
                    <?php if($cnt_suggestions > 0){?>
                    <?php foreach($suggestions as $_suggestion) { ?>
                    <div class="widget-timeline m-b-25">
                      <div class="media">
                        <div class="mr-0 photo-table"> <i class="fas fa-circle text-success f-10 m-r-10"></i> </div>
                        <div class="media-body"> <a href="<?= site_url().'erp/suggestion-view/'.uencode($_suggestion['suggestion_id']);?>">
                          <h6 class="d-inline-block m-0">
                            <?= $_suggestion['title'];?>
                          </h6>
                          <span class="text-muted float-right f-13"><i class="fas fa-calendar-alt m-r-2"></i>
                          <?= set_date_format($_suggestion['created_at']);?>
                          </span>
                          </a> </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php } else {?>
                    <div class="text-center m-b-25">
                      <?= lang('Main.xin_no_company_suggestion_available');?>
                      <i class="text-mute fas fa-bullhorn m-r-2"></i> </div>
                    <?php } ?>
                  </div>
                  <?php if($cnt_suggestions > 0){?>
                  <div class="text-center"> <a href="<?= site_url('erp/suggestions');?>" class="b-b-primary text-primary">
                    <?= lang('Main.xin_view_all');?>
                    </a> </div>
                  <?php } else {?>
                  <div class="text-center"> <a href="<?= site_url('erp/suggestions');?>" class="b-b-primary text-primary">
                    <?= lang('Main.xin_add_new').' '.lang('Main.xin_hr_suggestion');?>
                    </a> </div>
                  <?php } ?>
                </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
    	<div class="col-xl-8 col-md-8 col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h5><?= lang('Main.xin_company_policies');?></h5>
                </div>
                <div class="card-body">
                    <div id="carouselExampleIndicatorscaption" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
								<?php $pl=0;foreach($get_policy as $_policy): ?>
                                <?php
								$attachment_ext = pathinfo($_policy['attachment'], PATHINFO_EXTENSION);
									if($attachment_ext == 'pdf') {
									if($pl == 1){
										$pl_active = 'active';
									} else {
										$pl_active = '';
									}
								?>
                                <li data-target="#carouselExampleIndicatorscaption" data-slide-to="<?= $pl;?>" class="<?= $pl_active;?>"></li>
								<?php } $pl++; endforeach;?>
							</ol>
                            <div class="carousel-inner">
                            <?php $pi=1;foreach($get_policy as $_policy): ?>
                            <?php
								$attachment_ext = pathinfo($_policy['attachment'], PATHINFO_EXTENSION);
								if($attachment_ext == 'pdf') {
								if($pi == 1){
									$pi_active = 'active';
								} else {
									$pi_active = '';
								}
							?>
                            <div class="carousel-item <?= $pi_active;?>">
                                <a href="javascript:void();" data-toggle="modal" data-target=".edit-modal-data" data-field_id="<?= uencode($_policy['policy_id']);?>"><img class="img-fluid d-block w-100" src="<?= base_url();?>/public/assets/images/pdf_icon.png" alt="<?= $_policy['title'];?>"></a>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5 class="text-white"><a href="javascript:void();" data-toggle="modal" data-target=".edit-modal-data" data-field_id="<?= uencode($_policy['policy_id']);?>" class="text-white"><?= $_policy['title'];?></a></h5>
                                </div>
                            </div>
                           	<?php } $pi++; endforeach;?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicatorscaption" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
                        <a class="carousel-control-next" href="#carouselExampleIndicatorscaption" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>
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

  if(hh == 0){
      hh = 12;
  }
  if(hh > 12){
      hh = hh - 12;
      session = "PM";
   }

   hh = (hh < 10) ? "0" + hh : hh;
   mm = (mm < 10) ? "0" + mm : mm;
   ss = (ss < 10) ? "0" + ss : ss;
    
   let time = hh + ":" + mm + ":" + ss + " " + session;

  document.getElementById("clock").innerText = time; 
  let t = setTimeout(function(){ currentTime() }, 1000);
}
currentTime();
</script>
<style type="text/css">
.carousel-caption {
    bottom: 20px !important;
	padding-bottom: 0px !important;
}
.carousel-indicators {
    bottom: -10px !important;
}
</style>