<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\ShiftModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();			
$ShiftModel = new ShiftModel();
$get_animate = '';
if($request->getGet('type') === 'shift_time' && $request->getGet('field_id')){
$ifield_id = udecode($field_id);
$result = $ShiftModel->where('office_shift_id', $ifield_id)->first();
$day = $request->getGet('time_val');
?>

<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Employees.xin_edit_office_shift');?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <?= lang('Main.xin_below_required_info');?>
    </small> </h5>
    
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'edit_office_shift', 'id' => 'edit_office_shift', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id, 'time_val' => $day);?>
<?php echo form_open('erp/application/update_office_shift', $attributes, $hidden);?>
<?php

if($day == 'Monday') {
	if($result['monday_in_time']==''){
		$shift_time_in = '';
		$shift_time_out = '';
	} else {
		$shift_time_in = $result['monday_in_time'];
		$shift_time_out = $result['monday_out_time'];
	}
} else if($day == 'Tuesday') {
	if($result['tuesday_in_time']==''){
		$shift_time_in = '';
		$shift_time_out = '';
	} else {
		$shift_time_in = $result['tuesday_in_time'];
		$shift_time_out = $result['tuesday_out_time'];
	}
} else if($day == 'Wednesday') {
	if($result['wednesday_in_time']==''){
		$shift_time_in = '';
		$shift_time_out = '';
	} else {
		$shift_time_in = $result['wednesday_in_time'];
		$shift_time_out = $result['wednesday_out_time'];
	}
} else if($day == 'Thursday') {
	if($result['thursday_in_time']==''){
		$shift_time_in = '';
		$shift_time_out = '';
	} else {
		$shift_time_in = $result['thursday_in_time'];
		$shift_time_out = $result['thursday_out_time'];
	}
} else if($day == 'Friday') {
	if($result['friday_in_time']==''){
		$shift_time_in = '';
		$shift_time_out = '';
	} else {
		$shift_time_in = $result['friday_in_time'];
		$shift_time_out = $result['friday_out_time'];
	}
} else if($day == 'Saturday') {
	if($result['saturday_in_time']==''){
		$shift_time_in = '';
		$shift_time_out = '';
	} else {
		$shift_time_in = $result['saturday_in_time'];
		$shift_time_out = $result['saturday_out_time'];
	}
} else if($day == 'Sunday') {
	if($result['sunday_in_time']==''){
		$shift_time_in = '';
		$shift_time_out = '';
	} else {
		$shift_time_in = $result['sunday_in_time'];
		$shift_time_out = $result['sunday_out_time'];
	}
} else {
	$shift_time_in = '';
	$shift_time_out = '';
}
?>
<div class="modal-body">
	<div class="row">
    	<div class="col-md-12">
        <div class="alert alert-primary" role="alert">
            <strong><?= lang('Main.xin_shift_day').': '.$request->getGet('time_val');?></strong>
            </div>
        </div>
    </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="shift_name">
          <?= lang('Employees.xin_shift_in_time');?>
         </label>
        <div class="input-group">
          <input class="form-control etimepicker clear-13" placeholder="<?= lang('Employees.xin_shift_in_time');?>" readonly name="in_time" type="text" value="<?= $shift_time_in;?>">
          <div class="input-group-append clear-time" data-clear-id="13"><span class="input-group-text text-danger"><i class="fas fa-trash-alt"></i></span></div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="shift_name">
          <?= lang('Employees.xin_shift_out_time');?>
          </label>
        <div class="input-group">
          <input class="form-control etimepicker clear-13" placeholder="<?= lang('Employees.xin_shift_out_time');?>" readonly name="out_time" type="text" value="<?= $shift_time_out;?>">
          <div class="input-group-append clear-time" data-clear-id="13"><span class="input-group-text text-danger"><i class="fas fa-trash-alt"></i></span></div>
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
 $(document).ready(function(){
								
	// Clock
	$('.etimepicker_oldver').bootstrapMaterialDatePicker({
		date: false,
		shortTime: true,
		format: 'HH:mm'
	});
	// default time
	$('.etimepicker').timepicker({
		defaultTime: '',
		minuteStep: 15,
		secondStep:30,
		showSeconds: false,
		maxHours:24,
		showMeridian: false
	});
	//$('.etimepicker').timepicker();
	
	Ladda.bind('button[type=submit]');
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });
	/* Edit data */
	$("#edit_office_shift").submit(function(e){
		/*Form Submit*/
		e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=3&type=edit_record&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					Ladda.stopAll();
					toastr.error(JSON.error);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
				} else {
					
					toastr.success(JSON.result);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
					setTimeout(function(){
						$('.view-modal-data').modal('toggle');
						window.location = '';
					}, 2000);
				}
			}
		});
	});
	$(".clear-time").click(function(){
		var clear_id  = $(this).data('clear-id');
		$(".clear-"+clear_id).val('');
	});
});	
</script>
<?php } ?>
