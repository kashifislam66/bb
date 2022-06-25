<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\DepartmentModel;
use App\Models\StaffdetailsModel;
use App\Models\SignaturedocumentsModel;
use App\Models\StaffsignaturedocumentsModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();			
$DepartmentModel = new DepartmentModel();
$StaffdetailsModel = new StaffdetailsModel();
$SignaturedocumentsModel = new SignaturedocumentsModel();
$StaffsignaturedocumentsModel = new StaffsignaturedocumentsModel();
$get_animate = '';
if($request->getGet('data') === 'document' && $request->getGet('field_id')){
$ifield_id = udecode($field_id);
$result = $SignaturedocumentsModel->where('document_id', $ifield_id)->first();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();

?>

<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Main.xin_edit_signature_file');?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <?= lang('Main.xin_below_required_info');?>
    </small> </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'edit_document', 'id' => 'edit_document', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?= form_open('erp/files/update_document', $attributes, $hidden);?>
<div class="modal-body">
  <div class="row">
    <div  class="col-md-12">
      <div class="form-group">
        <label for="name">
          <?= lang('Employees.xin_document_name');?>
          <span class="text-danger">*</span> </label>
        <input type="text" class="form-control" name="document_name" placeholder="<?= lang('Employees.xin_document_name');?>" value="<?= $result['document_name'];?>">
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
<?= form_close(); ?>
<script type="text/javascript">
$(document).ready(function(){
						
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });	  
	 Ladda.bind('button[type=submit]');
	/* Edit data */
	$("#edit_document").submit(function(e){
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
					// On page load: datatable
					var xin_table_document2 = $('#xin_table_document').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?= site_url("erp/files/signature_documents_list") ?>",
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
					xin_table_document2.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
						$('input[name="csrf_token"]').val(JSON.csrf_hash);
					}, true);
					$('.view-modal-data').modal('toggle');
					Ladda.stopAll();
				}
			}
		});
	});
});	
</script>
<?php } else if($request->getGet('data') === 'file_progress' && $request->getGet('field_id')){
$ifield_id = udecode($field_id);
$result = $StaffsignaturedocumentsModel->where('signature_file_id', $ifield_id)->findAll();
$request_file = $SignaturedocumentsModel->where('document_id', $ifield_id)->first();
if($request_file['signature_task']==1):
	$task_sign = '<span class="badge badge-light-success">'.lang('Main.xin_onboarding_file').'</span>';
else:
	$task_sign = '<span class="badge badge-light-danger">'.lang('Main.xin_offboarding_file').'</span>';
endif;
?>
<div class="modal-header">
  <h5 class="modal-title">
    <?= $request_file['document_name'];?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <?= $task_sign;?>
    </small> </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<div class="modal-body">
<div style="height:385px;position:relative;overflow:auto;">
    <div class="box-datatable table-responsive">
          <table class="table table-striped table-bordered dataTable" id="xin_table_modal_progress" style="width:100%;">
            <thead>
              <tr>
                <th><?= lang('Dashboard.dashboard_employee');?></th>
                <th><?= lang('Main.xin_download');?></th>
                <th width="100"><?= lang('Main.xin_created_at');?></th>
                <th width="100"><?= lang('Main.xin_signed_updated_at');?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($result as $istaff){?>
            <?php $user_info = $UsersModel->where('user_id', $istaff['staff_id'])->first(); ?>
            <?php
				if($istaff['is_signed']==1){
					$signedinfo = '<span class="badge badge-light-success">'.lang('Main.xin_signed').'</span>';
					$signed_download_link = '<a href="'.site_url().'download?type=pdf_files/files/signed/&filename='.uencode($istaff['signed_file']).'">'.lang('Main.xin_download').'</a>';
					$signed_date = '<i class="feather icon-calendar"></i> '.set_date_format($istaff['signed_date']);
				} else {
					$signedinfo = '<span class="badge badge-light-warning">'.lang('Main.xin_notsigned').'</span>';
					$signed_date = '--';
					$signed_download_link = '--';
				}
				$created_at = set_date_format($istaff['created_at']);
			?>
            <tr>
                <td><div class="d-inline-block align-middle">
                    <img src="<?= base_url().'/public/uploads/users/thumb/'.$user_info['profile_photo'];?>" alt="" class="img-radius align-top m-r-15" style="width:40px;">
                    <div class="d-inline-block">
                        <h6 class="m-b-0"><?= $user_info['first_name'].' '.$user_info['last_name'];?></h6>
                        <p class="m-b-0"><?= $signedinfo;?></p>
                    </div>
                </div></td>
                <td><?= $signed_download_link;?></td>
                <td width="100"><i class="feather icon-calendar"></i> <?= $created_at;?></td>
                <td width="100"><?= $signed_date;?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
    </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-light" data-dismiss="modal">
  <?= lang('Main.xin_close');?>
  </button>
</div>
<script type="text/javascript">
$(document).ready( function () {
    $('#xin_table_modal_progress').DataTable();
});
</script>
<?php }
?>
