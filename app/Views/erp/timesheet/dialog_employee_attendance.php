<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\ShiftModel;
use App\Models\TimesheetModel;
use App\Models\StaffdetailsModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();			
$ShiftModel = new ShiftModel();
$TimesheetModel = new TimesheetModel();
$StaffdetailsModel = new StaffdetailsModel();
$get_animate = '';
if($request->getGet('data') === 'edit_attendance' && $request->getGet('field_id')){
$ifield_id = udecode($field_id);
$result = $TimesheetModel->where('time_attendance_id', $ifield_id)->first();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
$user_detail = $StaffdetailsModel->where('user_id', $result['employee_id'])->first();
//$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$office_shifts = $ShiftModel->where('company_id',$user_info['company_id'])->orderBy('office_shift_id', 'ASC')->findAll();
} else {
	$office_shifts = $ShiftModel->where('company_id',$usession['sup_user_id'])->orderBy('office_shift_id', 'ASC')->findAll();
}
?>


<div class="modal-header">
    <h5 class="modal-title">
        <?= lang('Attendance.xin_edit_attendance');?>
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
<?php $attributes = array('name' => 'edit_attendance', 'id' => 'edit_employe_attendance', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?php echo form_open('erp/timesheet/update_attendance_record', $attributes, $hidden);?>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <?php $office_shift = $ShiftModel->where('office_shift_id',$user_detail['office_shift_id'])->first(); ?>
                <div class="col-md-12" id="shift_ajx">
                    <div class="form-group">
                        <label for="office_shift_id" class="control-label">
                            <?= lang('Employees.xin_employee_office_shift');?>
                        </label>
                        <span class="text-danger">*</span>
                        <select class="form-control" name="office_shift_id_m" data-plugin="select_hrm"
                            data-placeholder="<?= lang('Employees.xin_employee_office_shift');?>">
                            <option value="">
                                <?= lang('Employees.xin_employee_office_shift');?>
                            </option>
                            <?php foreach($office_shifts as $office_shift) {?>
                            <option value="<?= $office_shift['office_shift_id']?>"
                                <?php if($office_shift['office_shift_id']==$user_detail['office_shift_id']){?>
                                selected="selected" <?php }?>>
                                <?= $office_shift['shift_name']?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
			$clock_in_time = strtotime($result['clock_in']);
			$fclckIn = date("h:i A", $clock_in_time);
			?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="clock_in">
                            <?= lang('Employees.xin_shift_in_time');?> <span class="text-danger">*</span>
                        </label>
                        <div class="input-group ">
                            <input class="form-control time_dropdown"
                                placeholder="<?= lang('Employees.xin_shift_in_time');?>" 
                                name="clock_in_m" value="<?php echo $fclckIn;?>">
                            <!-- <div class="input-group-append"><span class="input-group-text"><i
                                        class="fas fa-clock"></i></span></div> -->
                        </div>
                    </div>
                </div>
                <?php
			$clock_out_time = strtotime($result['clock_out']);
            if(!empty($clock_out_time)) {
                $fclckOut = date("h:i a", $clock_out_time);
                } else {
                    $fclckOut = "00:00";	
                }
			?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="clock_out">
                            <?= lang('Employees.xin_shift_out_time');?> <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input class="form-control time_dropdown"
                                placeholder="<?= lang('Employees.xin_shift_out_time');?>" 
                                name="clock_out_m" type="text" value="<?php echo $fclckOut;?>">
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="status_ajx">
                    <div class="form-group">
                        <label for="status" class="control-label">
                            <?= lang('Projects.xin_status');?>
                        </label>
                        <span class="text-danger">*</span>
                        <select class="form-control" name="status" data-plugin="select_hrm"
                            data-placeholder="<?= lang('Projects.xin_status');?>">
                            <option value="">
                                <?= lang('Projects.xin_status');?>
                            </option>
                            
                            <option value="Pending" <?php if($result['status']=="Pending"){?> selected="selected" <?php }?>>Pending</option>
                            <option value="Not Approved" <?php if($result['status']=="Not Approved"){?> selected="selected" <?php }?>>Not Approved</option>
                            <option value="Approved" <?php if($result['status']=="Approved"){?> selected="selected" <?php }?>>Approved</option>
                          
                        </select>
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
    jQuery(".employee_id").change(function() {
        jQuery.get(main_url + "timesheet/is_shift/" + jQuery(this).val(), function(data, status) {
            jQuery('#shift_ajx').html(data);
        });
       
    });
    $(".time_dropdown").timeselect({
        'step': 1,
        autocompleteSettings: {
            autoFocus: true
        }
    });
    // attendance date
    $('.attendance_date_e').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
        clearButton: true,
		switchOnClick: true,
        format: 'YYYY-MM-DD'
    });
    Ladda.bind('button[type=submit]');
    $('.timepicker_oldv').bootstrapMaterialDatePicker({
        date: false,
        format: 'HH:mm'
    });
   
     

  
   
    $('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
    $('[data-plugin="select_hrm"]').select2({
        width: '100%'
    });
    /* Edit Attendance*/
    $("#edit_employe_attendance").submit(function(e) {

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
                            url: "<?php echo site_url("erp/timesheet/timesheet_attendance_employee_list") ?>",
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