<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\IncidentsModel;
use App\Models\ConstantsModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();		
$IncidentsModel = new IncidentsModel();	
$SystemModel = new SystemModel();
$ConstantsModel = new ConstantsModel();
$xin_system = $SystemModel->where('setting_id', 1)->first();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$category_info = $ConstantsModel->where('company_id', $user_info['company_id'])->where('type','incident_type')->findAll();
} else {
	$category_info = $ConstantsModel->where('company_id', $usession['sup_user_id'])->where('type','incident_type')->findAll();
}
$xin_system = erp_company_settings();
/* Assets view
*/
$get_animate = '';
if($request->getGet('data') === 'incident' && $request->getGet('field_id')){
$incident_id = udecode($field_id);
$result = $IncidentsModel->where('incident_id', $incident_id)->first();
?>

<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Main.xin_edit_incident');?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <?= lang('Main.xin_below_required_info');?>
    </small> </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'edit_incident', 'id' => 'edit_incident', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?php echo form_open('erp/incidents/update_incident', $attributes, $hidden);?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="award_type">
          <?= lang('Main.xin_incident_type');?>
          <span class="text-danger">*</span> </label>
        <select name="incident_type_id" class="form-control" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_incident_type');?>">
          <option value=""></option>
          <?php foreach($category_info as $_category) {?>
          <option value="<?= $_category['constants_id']?>" <?php if($_category['constants_id']==$result['incident_type_id']):?> selected="selected"<?php endif;?>>
          <?= $_category['category_name']?>
          </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="xin_title">
          <?= lang('Dashboard.xin_title');?>
          <span class="text-danger">*</span> </label>
        <input type="text" class="form-control" placeholder="<?= lang('Dashboard.xin_title');?>" name="title" value="<?php echo $result['title'];?>">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="incident_date">
          <?= lang('Main.xin_e_details_date');?>
          <span class="text-danger">*</span> </label>
        <div class="input-group">
          <input class="form-control edate" placeholder="<?= lang('Main.xin_incident_date');?>" name="incident_date" type="text" value="<?php echo $result['incident_date'];?>">
          <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="time">
          <?= lang('Main.xin_time');?>
          <span class="text-danger">*</span> </label>
        <div class="input-group">
          <input class="form-control time_dropdown" placeholder="<?= lang('Main.xin_incident_time');?>" name="incident_time" type="text" value="<?php echo $result['incident_time'];?>">
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="incident_file">
          <?= lang('Main.xin_incident_document');?>
        </label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="incident_file">
          <label class="custom-file-label">
            <?= lang('Main.xin_choose_file');?>
          </label>
          <small>
          <?= lang('Main.xin_company_file_type');?>
          </small> </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class='form-group'>
        <label for="logo">&nbsp;</label>
        <?php if($result['incident_file']!='' && $result['incident_file']!='no file') {?>
        <img src="<?php echo base_url().'/public/uploads/incidents/'.$result['incident_file'];?>" class="d-block" width="70px" id="u_file"> <a href="<?php echo site_url()?>download?type=awards&filename=<?php echo uencode($result['incident_file']);?>">
        <?= lang('Main.xin_download');?>
        </a>
        <?php } else {?>
        <p>&nbsp;</p>
        <?php } ?>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="incident_description">
          <?= lang('Main.xin_incident_description');?>
          <span class="text-danger">*</span> </label>
        <textarea class="form-control" placeholder="<?= lang('Main.xin_incident_description');?>" name="incident_description" cols="30" rows="2" id="incident_description"><?php echo $result['description'];?></textarea>
      </div>
    </div>
  </div>
</div>
<!--</div>-->
<div class="modal-footer">
  <button type="button" class="btn btn-light" data-dismiss="modal">
  <?= lang('Main.xin_close');?>
  </button>
  <button type="submit" class="btn btn-primary">
  <?= lang('Main.xin_update');?>
  </button>
</div>
<?php echo form_close(); ?>
<style type="text/css">
.hide-calendar .ui-datepicker-calendar { display:none !important; }
.hide-calendar .ui-priority-secondary { display:none !important; }
.ui-datepicker-div { top:500px !important; }
</style>
<script type="text/javascript">
 $(document).ready(function(){	
		Ladda.bind('button[type=submit]');
		$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
		$('[data-plugin="select_hrm"]').select2({ width:'100%' });	 
		// Award Date
		$('.edate').bootstrapMaterialDatePicker({
			weekStart: 0,
			time: false,
			clearButton: false,
			switchOnClick: true,
			format: 'YYYY-MM-DD'
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

    $(".time_dropdown").timeselect({
        'step': 1,
        autocompleteSettings: {
            autoFocus: true
        }
    });
		$("#edit_incident").submit(function(e){
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
							url : "<?php echo site_url("erp/incidents/incidents_list") ?>",
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
