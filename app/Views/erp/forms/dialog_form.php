<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\FormsModel;
use App\Models\FormsfieldModel;
use App\Models\FormscompletedfieldsModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();			
$FormsModel = new FormsModel();
$FormsfieldModel = new FormsfieldModel();
$FormscompletedfieldsModel = new FormscompletedfieldsModel();
$get_animate = '';
if($request->getGet('field_id')){
?>

<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Main.xin_creat_form_builder');?>
  </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'add_form_key', 'id' => 'xin-form', 'autocomplete' => 'off');?>
<?php $hidden = array('user_id' => 0);?>
<?= form_open('erp/forms/add_new_form', $attributes, $hidden);?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="form_name">
          <?= lang('Main.xin_form_name');?>
          <span class="text-danger">*</span> </label>
        <div class="input-group">
          <div class="input-group-prepend"><span class="input-group-text"> <i class="fab fa-wpforms"></i></span></div>
          <input type="text" class="form-control" placeholder="<?= lang('Main.xin_form_name');?>" name="form_name" id="form_name">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-light" data-dismiss="modal">
  <?= lang('Main.xin_close');?>
  </button>
  <button type="submit" class="btn btn-primary"><?= lang('Main.xin_add');?></button>
</div>
<?php echo form_close(); ?> 
<script type="text/javascript">
$(document).ready( function () {
    Ladda.bind('button[type=submit]');
	/* Add data */
	$("#xin-form").submit(function(e){
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=1&type=add_record&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
				} else {
					// On page load: datatable
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
});
</script>
<?php }
?>
