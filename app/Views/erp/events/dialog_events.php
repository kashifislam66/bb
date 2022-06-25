<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\EventsModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();			
$EventsModel = new EventsModel();
$get_animate = '';
if($request->getGet('data') === 'event' && $request->getGet('field_id')){
$ifield_id = udecode($field_id);
$result = $EventsModel->where('event_id', $ifield_id)->first();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
?>

<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Conference.xin_edit_event');?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <?= lang('Main.xin_below_required_info');?>
    </small> </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'edit_event', 'id' => 'edit_event', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?php echo form_open('erp/events/update_event', $attributes, $hidden);?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="title">
          <?= lang('Conference.xin_event_title');?> <span class="text-danger">*</span>
        </label>
        <input class="form-control" placeholder="<?= lang('Conference.xin_event_title');?>" name="event_title" type="text" value="<?php echo $result['event_title'];?>">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="start_date">
          <?= lang('Conference.xin_hr_event_date');?> <span class="text-danger">*</span>
        </label>
        <div class="input-group">
          <input class="form-control mdate" name="event_date" type="text" value="<?php echo $result['event_date'];?>">
          <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="end_date">
        <?php
        $clock_event_time = strtotime($result['event_time']);
        $fclckIn = date("h:i A", $clock_event_time);
			  ?>
          <?= lang('Conference.xin_hr_event_time');?> <span class="text-danger">*</span>
        </label>
        <div class="input-group">
          <input class="form-control time_dropdown" name="event_time" type="text" value="<?php echo $fclckIn; ?>">
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="event_color">
          <?= lang('Conference.xin_event_color');?>
        </label>
        <div class="input-group mhr_color" title="<?= lang('Conference.xin_event_color');?>"> <span class="input-group-append"> <span class="input-group-text colorpicker-input-addon"><i></i></span> </span>
          <input class="form-control mhr_color" type="text" value="<?php echo $result['event_color'];?>" name="event_color">
        </div>
      </div>
    </div>
      <div class="col-md-12">
        <div class="form-group">
          <label><?= lang('Main.xin_event_in_calendar');?></label>
            <div class="custom-control custom-switch">
                <input type="checkbox" name="is_show_calendar" class="custom-control-input input-light-primary" id="customevent2" value="1" <?php if($result['is_show_calendar']==1):?> checked="checked"<?php endif;?>>
                <label class="custom-control-label" for="customevent2"><?= lang('Main.xin_event_in_calendar_info');?></label>
            </div>
          
        </div>
      </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="description">
          <?= lang('Conference.xin_hr_event_note');?> <span class="text-danger">*</span>
        </label>
        <textarea class="form-control textarea" placeholder="<?= lang('Conference.xin_hr_event_note');?>" name="event_note" cols="30" rows="3" id="event_note2"><?php echo $result['event_note'];?></textarea>
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
	
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });	 
	Ladda.bind('button[type=submit]');
	$('.mhr_color').colorpicker();
	// Date
	$('.mdate').bootstrapMaterialDatePicker({
		weekStart: 0,
		time: false,
		clearButton: false,
		switchOnClick: true,
		format: 'YYYY-MM-DD'
	});
	$('.mtimepicker').bootstrapMaterialDatePicker({
		date: false,
		shortTime: true,
		format: 'HH:mm'
	});
  $(".time_dropdown").timeselect({
        'step': 1,
        autocompleteSettings: {
            autoFocus: true
        }
    });
  
	/* Edit*/
	$("#edit_event").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=2&type=edit_record&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
				} else {
					
					var xin_table = $('#xin_table').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("erp/events/events_list") ?>",
							type : 'GET'
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
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					xin_table.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
					$('.edit-modal-data').modal('toggle');
				}
			}
		});
	});
});	
</script>
<?php } elseif($request->getGet('type') === 'new_event_record'){
//$ifield_id = udecode($field_id);
//$result = $EventsModel->where('event_id', $ifield_id)->first();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
?>

<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Conference.xin_edit_event');?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <?= lang('Main.xin_below_required_info');?>
    </small> </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'add_new_event', 'id' => 'add_new_event', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => 0);?>
<?php echo form_open('erp/events/add_event', $attributes, $hidden);?>
<div class="modal-body">
	 <?php if($user_info['user_type'] == 'company'){?>
        <?php $staff_info = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->findAll();?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" value="0" name="employee_id[]" />
              <label for="first_name">
                <?= lang('Dashboard.dashboard_employees');?>
              </label>
              <select class="form-control" multiple="multiple" name="employee_id[]" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.dashboard_employees');?>">
                <option value=""></option>
                <?php foreach($staff_info as $staff) {?>
                <option value="<?= $staff['user_id']?>">
                <?= $staff['first_name'].' '.$staff['last_name'] ?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <?php } ?>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="title">
          <?= lang('Conference.xin_event_title');?> <span class="text-danger">*</span>
        </label>
        <input class="form-control" placeholder="<?= lang('Conference.xin_event_title');?>" name="event_title" type="text" value="">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="start_date">
          <?= lang('Conference.xin_hr_event_date');?> <span class="text-danger">*</span>
        </label>
        <div class="input-group">
          <input class="form-control mdate" name="event_date" type="text" placeholder="<?= lang('Conference.xin_hr_event_date');?>">
          <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="end_date">
          <?= lang('Conference.xin_hr_event_time');?> <span class="text-danger">*</span>
        </label>
        <div class="input-group">
          <input class="form-control time_dropdown" name="event_time" type="text" placeholder="<?= lang('Conference.xin_hr_event_time');?>">
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="event_color">
          <?= lang('Conference.xin_event_color');?>
        </label>
        <div class="input-group mhr_color" title="<?= lang('Conference.xin_event_color');?>"> <span class="input-group-append"> <span class="input-group-text colorpicker-input-addon"><i></i></span> </span>
          <input class="form-control mhr_color" type="text" value="" name="event_color">
        </div>
      </div>
    </div>
      <div class="col-md-12">
        <div class="form-group">
          <label><?= lang('Main.xin_event_in_calendar');?></label>
            <div class="custom-control custom-switch">
                <input type="checkbox" name="is_show_calendar" class="custom-control-input input-light-primary" id="customevent2" value="1" checked="checked">
                <label class="custom-control-label" for="customevent2"><?= lang('Main.xin_event_in_calendar_info');?></label>
            </div>
          
        </div>
      </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="description">
          <?= lang('Conference.xin_hr_event_note');?> <span class="text-danger">*</span>
        </label>
        <textarea class="form-control textarea" placeholder="<?= lang('Conference.xin_hr_event_note');?>" name="event_note" cols="30" rows="3" id="event_note2"></textarea>
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
  $(".time_dropdown").timeselect({
        'step': 1,
        autocompleteSettings: {
            autoFocus: true
        }
    });

	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });	 
	Ladda.bind('button[type=submit]');
	$('.mhr_color').colorpicker();
	// Date
	$('.mdate').bootstrapMaterialDatePicker({
		weekStart: 0,
		time: false,
		clearButton: false,
		switchOnClick: true,
		format: 'YYYY-MM-DD'
	});
	$('.mtimepicker').bootstrapMaterialDatePicker({
		date: false,
		shortTime: true,
		format: 'HH:mm'
	});
	/* Edit*/
	$("#add_new_event").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=2&type=add_record&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
				} else {
					toastr.success(JSON.result);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
					setTimeout(function(){
						$('.edit-modal-data').modal('toggle');
						window.location = '';
					}, 2000);
					
					
				}
			}
		});
	});
});	
</script>
<?php }?>
