<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\OvertimerequestModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();			
$OvertimerequestModel = new OvertimerequestModel();
$get_animate = '';
if($request->getGet('data') === 'add_attendance' && $request->getGet('field_id')){
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
?>

<div class="modal-header">
    <h5 class="modal-title">
        <?= lang('Attendance.xin_add_overtime_request');?>
        <span class="font-weight-light">
            <?= lang('Main.xin_information');?>
        </span> <br>
        <small class="text-muted">
            <?= lang('Main.xin_below_required_info_add_record');?>
        </small>
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span>
    </button>
</div>
<?php $attributes = array('name' => 'add_attendance', 'id' => 'add_attendance', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'ADD');?>
<?php echo form_open('erp/timesheet/add_overtime', $attributes, $hidden);?>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <?php if($user_info['user_type'] == 'company'){?>
            <?php $staff_info = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->findAll();?>
            <div class="row">
                <div class="col-md-12">
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
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="first_name">
                            <?= lang('Dashboard.dashboard_employee');?>
                            <span class="text-danger">*</span> </label>
                        <select class="form-control" name="employee_id" data-plugin="select_hrm"
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
            </div>
                <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="date">
                            <?= lang('Main.xin_e_details_date');?>
                            <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input class="form-control attendance_date_m"
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
             
                <div class="col-md-12">
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
                            <?= lang('Main.xin_description');?></label>
                        <textarea class="form-control" placeholder="<?= lang('Main.xin_description');?>"
                            name="description" type="text"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-dismiss="modal">
        <?= lang('Main.xin_close');?>
    </button>
    <button type="submit" class="btn btn-primary">
        <?= lang('Main.xin_save');?>
    </button>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
$(document).ready(function() {

    // Clock
    $('.timepicker_m_oldver').bootstrapMaterialDatePicker({
        date: false,
        format: 'HH:mm'
    });
    // default time
    $('.timepicker_m').timepicker({
        defaultTime: '',
        minuteStep: 1,
        //secondStep:30,
        //showSeconds: false,
        maxHours: 24,
        showMeridian: true,
    });

    $(".time_dropdown_add").timeselect({
        'step': 1,
        autocompleteSettings: {
            autoFocus: true
        }
    });

    Ladda.bind('button[type=submit]');
    // attendance date
    $('.attendance_date_m').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
        clearButton: true,
		switchOnClick: true,
        format: 'YYYY-MM-DD'
    });
    $(".overtime_reason").change(function() {
        var overtime_reason = $(this).val();
        if (overtime_reason == 1) {
          //  $("#banked_class").prop('disabled',true);
          if ($("#banked_class").parent().is(':not(.check-wrap-sapn)')){
           $("#banked_class").wrap("<div class='check-wrap-sapn'></div>");
          }
           
        }else {
          // $("#banked_class").prop('disabled',false);
          if ($("#banked_class").parent().is('.check-wrap-sapn')){
            $("#banked_class").unwrap();
          }
          
        }
        if (overtime_reason == 5) {
            $('.additional-work-hours').show();
        } else {
            $('.additional-work-hours').hide();
        }
    });
    $('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
    $('[data-plugin="select_hrm"]').select2({
        width: '100%'
    });
    /* Add Attendance*/
    $("#add_attendance").submit(function(e) {

        /*Form Submit*/
        e.preventDefault();
        var obj = $(this),
            action = obj.attr('name');
        $('.save').prop('disabled', true);
        $.ajax({
            type: "POST",
            url: e.target.action,
            data: obj.serialize() + "&is_ajax=4&type=add_record&form=" + action,
            cache: false,
            success: function(JSON) {
                if (JSON.error != '') {
                    toastr.error(JSON.error);
                    $('input[name="csrf_token"]').val(JSON.csrf_hash);
                    $('.save').prop('disabled', false);
                    Ladda.stopAll();
                } else {
                    $('.view-modal-data').modal('toggle');
                    var xin_table = $('#xin_table').dataTable({
                        "bDestroy": true,
                        "ajax": {
                            url: "<?php echo site_url("erp/timesheet/overtime_request_list") ?>",
                            type: 'GET'
                        },
                        "language": {
                            "lengthMenu": dt_lengthMenu,
                            "zeroRecords": dt_zeroRecords,
                            "info": dt_info,
                            "infoEmpty": dt_infoEmpty,
                            "infoFiltered": dt_infoFiltered,
                            "search": dt_search,
                            "paginate": {
                                "first": dt_first,
                                "previous": dt_previous,
                                "next": dt_next,
                                "last": dt_last
                            },
                        },
                        "fnDrawCallback": function(settings) {
                            $('[data-toggle="tooltip"]').tooltip();
                        }
                    });
                    xin_table.api().ajax.reload(function() {
                        toastr.success(JSON.result);
                    }, true);
                    $('input[name="csrf_token"]').val(JSON.csrf_hash);
                    Ladda.stopAll();
                }
            }
        });
    });
});
</script>
<?php
} elseif($request->getGet('data') === 'view_attendance' && $request->getGet('field_id')){
$ifield_id = udecode($field_id);
$result = $OvertimerequestModel->where('time_request_id', $ifield_id)->first();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();

if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}
$clock_in_time = strtotime($result['clock_in']);
$fclckIn = date("h:i a", $clock_in_time);

$clock_out_time = strtotime($result['clock_out']);
$fclckOut = date("h:i a", $clock_out_time);		
?>
<div class="modal-header">
    <h5 class="modal-title">
        <?= lang('Main.xin_view_update_overtime_request');?>
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <?php $staff_info = $UsersModel->where('company_id', $company_id)->where('user_type','staff')->findAll();?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">
                            <?= lang('Dashboard.dashboard_employee');?>
                        </label>
                        <br />
                        <?php foreach($staff_info as $staff) {?>
                        <?php if($staff['user_id']==$result['staff_id']):?>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        <?php endif;?>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date">
                            <?= lang('Main.xin_e_details_date');?>
                        </label>
                        <br />
                        <?= $result['request_date'];?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="clock_in">
                            <?= lang('Employees.xin_shift_in_time');?>
                        </label>
                        <br />
                        <?= $fclckIn;?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="clock_out">
                            <?= lang('Employees.xin_shift_out_time');?>
                        </label>
                        <br />
                        <?= $fclckOut;?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="first_name">
                            <?= lang('Main.xin_overtime_reason');?>
                        </label>
                        <br />
                        <?php
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
			?>
                    </div>
                </div>
                <?php if($result['overtime_reason']==5):?>
                <div class="col-md-4 additional-work-hours">
                    <div class="form-group">
                        <label for="first_name">
                            <?= lang('Main.xin_overtime_additional_work_hours');?>
                        </label>
                        <br />
                        <?php
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
			?>
                    </div>
                </div>
                <?php endif;?>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="first_name">
                            <?= lang('Main.xin_compensation_type');?>
                        </label>
                        <br />
                        <?php
				if($result['compensation_type'] == 1){
					$compensation_type = lang('Main.xin_banked');
				} else if($result['compensation_type'] == 2){
					$compensation_type = lang('Main.xin_payout');
				} else {
					$compensation_type = lang('Main.xin_banked');
				}
				echo $compensation_type;
			?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="date">
                            <?= lang('Main.xin_description');?>
                        </label>
                        <br />
                        <?= $result['request_reason'];?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="status">
                            <?= lang('Main.dashboard_xin_status');?>
                        </label>
                        <br />
                        <?php
				if($result['is_approved'] == 0){
					$is_approved = lang('Main.xin_pending');
				} else if($result['is_approved'] == 1){
					$is_approved = lang('Main.xin_accepted');
				} else {
					$is_approved = lang('Main.xin_rejected');
				}
				echo $is_approved;
			?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-dismiss="modal">
        <?= lang('Main.xin_close');?>
    </button>
</div>
<script type="text/javascript">
$(document).ready(function() {
    // attendance date
    $('.attendance_date_e').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
        clearButton: true,
		switchOnClick: true,
        format: 'YYYY-MM-DD'
    });
    Ladda.bind('button[type=submit]');
    $('.timepicker_oldver').bootstrapMaterialDatePicker({
        date: false,
        format: 'HH:mm'
    });
    // default time
    $('.timepicker').timepicker({
        defaultTime: '',
        minuteStep: 15,
        secondStep: 30,
        showSeconds: false,
        maxHours: 24,
        showMeridian: false
    });
    $('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
    $('[data-plugin="select_hrm"]').select2({
        width: '100%'
    });
  
    /* Edit Attendance*/
    $("#edit_attendance").submit(function(e) {

        /*Form Submit*/
        e.preventDefault();
        var obj = $(this),
            action = obj.attr('name');
        $('.save').prop('disabled', true);
        $.ajax({
            type: "POST",
            url: e.target.action,
            data: obj.serialize() + "&is_ajax=3&type=edit_record&form=" + action,
            cache: false,
            success: function(JSON) {
                if (JSON.error != '') {
                    toastr.error(JSON.error);
                    $('input[name="csrf_token"]').val(JSON.csrf_hash);
                    $('.save').prop('disabled', false);
                    Ladda.stopAll();
                } else {
                    $('.edit-modal-data').modal('toggle');
                    var xin_table2 = $('#xin_table').dataTable({
                        "bDestroy": true,
                        "ajax": {
                            url: "<?php echo site_url("erp/timesheet/overtime_request_list") ?>",
                            type: 'GET'
                        },
                        "language": {
                            "lengthMenu": dt_lengthMenu,
                            "zeroRecords": dt_zeroRecords,
                            "info": dt_info,
                            "infoEmpty": dt_infoEmpty,
                            "infoFiltered": dt_infoFiltered,
                            "search": dt_search,
                            "paginate": {
                                "first": dt_first,
                                "previous": dt_previous,
                                "next": dt_next,
                                "last": dt_last
                            },
                        },
                        "fnDrawCallback": function(settings) {
                            $('[data-toggle="tooltip"]').tooltip();
                        }
                    });
                    xin_table2.api().ajax.reload(function() {
                        toastr.success(JSON.result);
                    }, true);
                    $('input[name="csrf_token"]').val(JSON.csrf_hash);
                    Ladda.stopAll();
                }
            }
        });
    });
});
</script>
<?php } elseif($request->getGet('data') === 'edit_attendance' && $request->getGet('field_id')){
$ifield_id = udecode($field_id);
$result = $OvertimerequestModel->where('time_request_id', $ifield_id)->first();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();

if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}	
?>
<?php $staff_info = $UsersModel->where('company_id', $company_id)->where('user_type','staff')->findAll();?>
<div class="modal-header">
    <h5 class="modal-title">
        <?= lang('Attendance.xin_edit_overtime_request');?>
        <span class="font-weight-light">
            <?= lang('Main.xin_information');?>
        </span> <br>
        <small class="text-muted">
            <?= lang('Main.xin_below_required_info');?>
        </small>
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span>
    </button>
</div>
<?php $attributes = array('name' => 'edit_attendance', 'id' => 'edit_attendance', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?php echo form_open('erp/timesheet/confirm_overtime_record', $attributes, $hidden);?>
<div class="modal-body"> <strong>
        <?= lang('Dashboard.dashboard_employee');?>
        : </strong>
    <?php foreach($staff_info as $staff) {?>
    <?php if($staff['user_id']==$result['staff_id']):?>
    <?= $staff['first_name'].' '.$staff['last_name'] ?>
    <?php endif;?>
    <?php } ?>
    <br />
    <br />
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date">
                            <?= lang('Main.xin_e_details_date');?>
                            <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input class="form-control attendance_date_e"
                                placeholder="<?= lang('Main.xin_e_details_date');?>" readonly="true"
                                name="attendance_date_m" type="text" value="<?= $result['request_date'];?>">
                            <div class="input-group-append"><span class="input-group-text"><i
                                        class="fas fa-calendar-alt"></i></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="clock_in">
                            <?= lang('Employees.xin_shift_in_time');?>
                            <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <?php $exp_clockin = explode(' ',$result['clock_in']); 
                            $exp_clockin = date_create($exp_clockin[1]); 
                            $exp_clockin = date_format($exp_clockin,'h:i A'); ?>
                            <input class="form-control time_dropdown"
                                placeholder="<?= lang('Employees.xin_shift_in_time');?>" name="clock_in_m" type="text"
                                value="<?= $exp_clockin;?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="clock_out">
                            <?= lang('Employees.xin_shift_out_time');?>
                            <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <?php $exp_clockout = explode(' ',$result['clock_out']); 
                            $exp_clockout = date_create($exp_clockout[1]); 
                            $exp_clockout = date_format($exp_clockout,'h:i A');
                            ?>
                            <input class="form-control time_dropdown"
                                placeholder="<?= lang('Employees.xin_shift_out_time');?>" name="clock_out_m" type="text"
                                value="<?= $exp_clockout;?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">
                            <?= lang('Main.xin_overtime_reason');?>
                            <span class="text-danger">*</span> </label>
                        <select class="form-control overtime_reason" name="overtime_reason" data-plugin="select_hrm"
                            data-placeholder="<?= lang('Main.xin_overtime_reason');?>">
                            <option value="">
                                <?= lang('Main.xin_overtime_reason');?>
                            </option>
                            <option value="1" <?php if($result['overtime_reason'] == 1){?> selected="selected"
                                <?php } ?>>
                                <?= lang('Main.xin_overtime_standby_pay');?>
                            </option>
                            <option value="2" <?php if($result['overtime_reason'] == 2){?> selected="selected"
                                <?php } ?>>
                                <?= lang('Main.xin_overtime_work_through_lunch');?>
                            </option>
                            <option value="3" <?php if($result['overtime_reason'] == 3){?> selected="selected"
                                <?php } ?>>
                                <?= lang('Main.xin_overtime_out_of_town');?>
                            </option>
                            <option value="4" <?php if($result['overtime_reason'] == 4){?> selected="selected"
                                <?php } ?>>
                                <?= lang('Main.xin_overtime_salaried_employee');?>
                            </option>
                            <option value="5" <?php if($result['overtime_reason'] == 5){?> selected="selected"
                                <?php } ?>>
                                <?= lang('Main.xin_overtime_additional_work_hours');?>
                            </option>
                        </select>
                    </div>
                </div>
                <?php 
			if($result['overtime_reason']==5):
				$idisplay = 'style="display:block;"';
			else:
				$idisplay = 'style="display:none;"';
			endif;
		?>
                <div class="col-md-6 additional-work-hours" <?= $idisplay;?>>
                    <div class="form-group">
                        <label for="first_name">
                            <?= lang('Main.xin_select_option_additional_work_hours');?>
                            <span class="text-danger">*</span> </label>
                        <select class="form-control" name="additional_work_hours" data-plugin="select_hrm"
                            data-placeholder="<?= lang('Main.xin_select_option_additional_work_hours');?>">
                            <option value="">
                                <?= lang('Main.xin_select_option_additional_work_hours');?>
                            </option>
                            <option value="1" <?php if($result['additional_work_hours'] == 1){?> selected="selected"
                                <?php } ?>>
                                <?= lang('Main.xin_straight_overtime');?>
                            </option>
                            <option value="2" <?php if($result['additional_work_hours'] == 2){?> selected="selected"
                                <?php } ?>>
                                <?= lang('Main.xin_time_ahalf_overtime');?>
                            </option>
                            <option value="3" <?php if($result['additional_work_hours'] == 3){?> selected="selected"
                                <?php } ?>>
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
                            <option value="1" <?php if($result['additional_work_hours'] == 1){?> selected="selected"
                                <?php } ?>>
                                <?= lang('Main.xin_banked');?>
                            </option>
                            <option value="2" <?php if($result['additional_work_hours'] == 2){?> selected="selected"
                                <?php } ?>>
                                <?= lang('Main.xin_payout');?>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="date">
                            <?= lang('Main.xin_description');?>
                            <span class="text-danger"></span></label>
                        <textarea class="form-control" placeholder="<?= lang('Main.xin_description');?>"
                            name="description" type="text" rows="3"><?= $result['request_reason'];?>
</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="status">
                            <?= lang('Main.dashboard_xin_status');?>
                        </label>
                        <select class="form-control" name="status" data-plugin="select_hrm"
                            data-placeholder="<?= lang('Main.dashboard_xin_status');?>">
                            <option value="0" <?php if($result['is_approved']==0):?> selected <?php endif; ?>>
                                <?= lang('Main.xin_pending');?>
                            </option>
                            <option value="1" <?php if($result['is_approved']==1):?> selected <?php endif; ?>>
                                <?= lang('Main.xin_accepted');?>
                            </option>
                            <option value="2" <?php if($result['is_approved']==2):?> selected <?php endif; ?>>
                                <?= lang('Main.xin_rejected');?>
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-dismiss="modal">
        <?= lang('Main.xin_close');?>
    </button>
    <button type="submit" class="btn btn-primary">
        <?= lang('Main.xin_update');?>
    </button>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
$(document).ready(function() {
    // attendance date
    $('.attendance_date_e').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
        clearButton: true,
		switchOnClick: true,
        format: 'YYYY-MM-DD'
    });
    Ladda.bind('button[type=submit]');
    $('.timepicker_oldver').bootstrapMaterialDatePicker({
        date: false,
        format: 'HH:mm'
    });
    // default time
    $('.etimepicker').timepicker({
        defaultTime: '',
        minuteStep: 15,
        secondStep: 30,
        showSeconds: false,
        maxHours: 24,
        showMeridian: false
    });

    $(".time_dropdown").timeselect({
        'step': 1,
        autocompleteSettings: {
            autoFocus: true
        }
    });

    $('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
    $('[data-plugin="select_hrm"]').select2({
        width: '100%'
    });
  
    /* Edit Attendance*/
    $("#edit_attendance").submit(function(e) {

        /*Form Submit*/
        e.preventDefault();
        var obj = $(this),
            action = obj.attr('name');
        $('.save').prop('disabled', true);
        $.ajax({
            type: "POST",
            url: e.target.action,
            data: obj.serialize() + "&is_ajax=3&type=edit_record&form=" + action,
            cache: false,
            success: function(JSON) {
                if (JSON.error != '') {
                    toastr.error(JSON.error);
                    $('input[name="csrf_token"]').val(JSON.csrf_hash);
                    $('.save').prop('disabled', false);
                    Ladda.stopAll();
                } else {
                    $('.edit-modal-data').modal('toggle');
                    var xin_table2 = $('#xin_table').dataTable({
                        "bDestroy": true,
                        "ajax": {
                            url: "<?php echo site_url("erp/timesheet/overtime_request_list") ?>",
                            type: 'GET'
                        },
                        "language": {
                            "lengthMenu": dt_lengthMenu,
                            "zeroRecords": dt_zeroRecords,
                            "info": dt_info,
                            "infoEmpty": dt_infoEmpty,
                            "infoFiltered": dt_infoFiltered,
                            "search": dt_search,
                            "paginate": {
                                "first": dt_first,
                                "previous": dt_previous,
                                "next": dt_next,
                                "last": dt_last
                            },
                        },
                        "fnDrawCallback": function(settings) {
                            $('[data-toggle="tooltip"]').tooltip();
                        }
                    });
                    xin_table2.api().ajax.reload(function() {
                        toastr.success(JSON.result);
                    }, true);
                    $('input[name="csrf_token"]').val(JSON.csrf_hash);
                    Ladda.stopAll();
                }
            }
        });
    });
});
</script>
<?php }
?>