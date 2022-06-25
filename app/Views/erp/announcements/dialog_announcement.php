<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\DepartmentModel;
use App\Models\AnnouncementModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();			
$DepartmentModel = new DepartmentModel();
$AnnouncementModel = new AnnouncementModel();
$get_animate = '';
if($request->getGet('data') === 'announcement' && $request->getGet('field_id')){
$ifield_id = udecode($field_id);
$result = $AnnouncementModel->where('announcement_id', $ifield_id)->first();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
   $staff_info = $UsersModel->where('company_id', $user_info['company_id'])->where('user_type','staff')->findAll();
} else {
	$staff_info = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->findAll();
}
?>

<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Dashboard.xin_edit_news');?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <?= lang('Main.xin_below_required_info');?>
    </small> </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'edit_announcement', 'id' => 'edit_announcement', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?php echo form_open_multipart('erp/announcements/update_announcement', $attributes, $hidden);?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="title">
          <?= lang('Dashboard.xin_title');?>
          <span class="text-danger">*</span> </label>
        <input class="form-control" placeholder="<?= lang('Dashboard.xin_title');?>" name="title" type="text" value="<?php echo $result['title'];?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="start_date">
          <?= lang('Projects.xin_start_date');?>
          <span class="text-danger">*</span> </label>
        <div class="input-group">
          <input class="form-control d_date" name="start_date" type="text" placeholder="<?= lang('Projects.xin_start_date');?>" value="<?php echo $result['start_date'];?>">
          <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="end_date">
          <?= lang('Projects.xin_end_date');?>
          <span class="text-danger">*</span> </label>
        <div class="input-group">
          <input class="form-control d_date" placeholder="<?= lang('Projects.xin_end_date');?>" name="end_date" type="text" value="<?php echo $result['end_date'];?>">
          <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="summary">
          <?= lang('Main.xin_summary');?>
          <span class="text-danger">*</span> </label>
        <textarea class="form-control" placeholder="<?= lang('Main.xin_summary');?>" name="summary" cols="30" rows="1" id="summary"><?php echo $result['summary'];?></textarea>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="description">
          <?= lang('Main.xin_description');?>
        </label>
        <textarea class="form-control meditor" placeholder="<?= lang('Main.xin_description');?>" name="description" cols="30" rows="5"><?php echo $result['description'];?></textarea>
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
		$(".meditor").kendoEditor({
			resizable: {
				content: true,
				toolbar: true
			}
		});
		$('.d_date').bootstrapMaterialDatePicker({
			weekStart: 0,
			time: false,
			clearButton: false,
			switchOnClick: true,
			format: 'YYYY-MM-DD'
		});
		/* Edit data */
		$("#edit_announcement").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
		fd.append("form", action);
		e.preventDefault();
		$.ajax({
			url: e.target.action,
			type: "POST",
			data:  fd,
			contentType: false,
			cache: false,
			processData:false,
			success: function(JSON)
			{
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
				} else {
					// On page load: datatable
					var xin_table = $('#xin_table').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("erp/announcements/announcement_list") ?>",
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
					$('.edit-modal-data').modal('toggle');
					Ladda.stopAll();
				}
			},
			error: function() 
			{
				toastr.error(JSON.error);
				$('input[name="csrf_token"]').val(JSON.csrf_hash);
				Ladda.stopAll();
			} 	        
	   });
	});
});	
</script>
<?php }
?>
