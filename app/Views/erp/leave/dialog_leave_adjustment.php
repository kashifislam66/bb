<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\LeaveadjustModel;
use App\Models\ConstantsModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$UsersModel = new UsersModel();	
$LeaveadjustModel = new LeaveadjustModel();		
$ConstantsModel = new ConstantsModel();
$get_animate = '';
if($request->getGet('data') === 'leave_adjustment' && $request->getGet('field_id')){
$category_id = udecode($field_id);
$result = $LeaveadjustModel->where('adjustment_id', $category_id)->first();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$leave_types = $ConstantsModel->where('company_id',$user_info['company_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
} else {
	$leave_types = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
}
?>

<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Main.xin_edit_leave_adjustment');?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <?= lang('Main.xin_below_required_info');?>
    </small> </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php if($result['status']=='0'):?>
<?php $attributes = array('name' => 'update_leave_adjustment', 'id' => 'update_leave_adjustment', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?= form_open('erp/leave/update_leave_adjustment', $attributes, $hidden);?>
<?php endif;?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="leave_type" class="control-label">
          <?= lang('Main.xin_request_leave_adjustment');?>
          <span class="text-danger">*</span> </label>
        <select class="form-control" name="leave_type" data-plugin="select_hrm" data-placeholder="<?= lang('Leave.xin_leave_type');?>">
          <option value=""></option>
          <?php foreach($leave_types as $ileave_type):?>
          <option value="<?= $ileave_type['constants_id'];?>" <?php if($result['leave_type_id'] == $ileave_type['constants_id']){?> selected="selected"<?php } ?>>
          <?= $ileave_type['category_name'];?>
          </option>
          <?php endforeach;?>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="hours_to_adjust">
          <?= lang('Main.xin_hours_to_adjust');?>
          <span class="text-danger">*</span> </label>
        <div class="input-group">
          <a href="javascript:void(0);"><div class="input-group-prepend" id="mminus"> <span class="input-group-text">-</span> </div></a>
          <input type="text" class="form-control madj-hours" name="hours_to_adjust" placeholder="<?= lang('Main.xin_hours_to_adjust');?>" value="<?= $result['adjust_hours'];?>">
          <a href="javascript:void(0);"><div class="input-group-append" id="madd"> <span class="input-group-text">+</span> </div></a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="adjustment_reason">
          <?= lang('Main.xin_reason_leave_adjustment');?>
          <span class="text-danger">*</span> </label>
        <textarea class="form-control textarea" placeholder="<?= lang('Main.xin_reason_leave_adjustment');?>" name="adjustment_reason"><?= $result['reason_adjustment'];?>
</textarea>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-light" data-dismiss="modal">
  <?= lang('Main.xin_close');?>
  </button>
  <?php if($result['status']=='0'):?>
  <button type="submit" class="btn btn-primary">
  <?= lang('Main.xin_update');?>
  </button>
  <?php endif;?>
</div>
<?= form_close(); ?>
<script type="text/javascript">

$(document).ready(function(){ 
	
	//add hours
	$("#madd").click(function () {
		var currentVal = parseInt($(".madj-hours").val());
		if (!isNaN(currentVal)) {
			$(".madj-hours").val(currentVal + 1);
		}
	});
	//minus hours
	$("#mminus").click(function () {
		var currentVal = parseInt($(".madj-hours").val());
		if (!isNaN(currentVal)) {
			$(".madj-hours").val(currentVal - 1);
		}
	});

	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' }); 	 
	Ladda.bind('button[type=submit]');

	/* Edit data */
	$("#update_leave_adjustment").submit(function(e){
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');		
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=1&type=edit_record&form="+action,
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
							url : "<?= site_url("erp/leave/leave_adjustment_list") ?>",
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					xin_table.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					$('.view-modal-data').modal('toggle');
					Ladda.stopAll();
				}
			}
		});
	});
});	
  </script>
<?php }
?>
