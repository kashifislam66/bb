<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\TerminationModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();		
$TerminationModel = new TerminationModel();	
$SystemModel = new SystemModel();
$xin_system = $SystemModel->where('setting_id', 1)->first();
/* Assets view
*/
$get_animate = '';
if($request->getGet('data') === 'termination' && $request->getGet('field_id')){
$termination_id = udecode($field_id);
$result = $TerminationModel->where('termination_id', $termination_id)->first();
?>

<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Main.xin_edit_termination');?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <?= lang('Main.xin_below_required_info');?>
    </small> </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'edit_termination', 'id' => 'edit_termination', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?php echo form_open('erp/termination/update_termination', $attributes, $hidden);?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="notice_date">
          <?= lang('Employees.xin_notice_date');?> <span class="text-danger">*</span>
        </label>
        <div class="input-group">
          <input class="form-control d_date" placeholder="<?= lang('Employees.xin_notice_date');?>" name="notice_date" type="text" value="<?php echo $result['notice_date'];?>">
          <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="resignation_date">
          <?= lang('Main.xin_termination_date');?> <span class="text-danger">*</span>
        </label>
        <div class="input-group">
          <input class="form-control d_date" placeholder="<?= lang('Main.xin_termination_date');?>" name="termination_date" type="text" value="<?php echo $result['termination_date'];?>">
          <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="notice_date">
          <?= lang('Main.dashboard_xin_status');?> <span class="text-danger">*</span>
        </label>
        <select class="form-control" name="status" data-plugin="select_hrm" data-placeholder="<?= lang('Main.dashboard_xin_status');?>">
          <option value="">
          <?= lang('dashboard_xin_status');?>
          </option>
          <option value="0" <?php if($result['status']=='0'):?> selected <?php endif; ?>>
          <?= lang('Main.xin_pending');?>
          </option>
          <option value="1" <?php if($result['status']=='1'):?> selected <?php endif; ?>>
          <?= lang('Main.xin_accepted');?>
          </option>
          <option value="2" <?php if($result['status']=='2'):?> selected <?php endif; ?>>
          <?= lang('Main.xin_rejected');?>
          </option>
        </select>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="reason">
          <?= lang('Employees.xin_resignation_reason');?> <span class="text-danger">*</span>
        </label>
        <textarea class="form-control textarea" placeholder="<?= lang('Employees.xin_resignation_reason');?>" name="reason" cols="30" rows="4"><?php echo $result['reason'];?></textarea>
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
		$('.d_date').bootstrapMaterialDatePicker({
			weekStart: 0,
			time: false,
			clearButton: false,
			switchOnClick: true,
			format: 'YYYY-MM-DD'
		});

		/* Edit data */
		$("#edit_termination").submit(function(e){
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
						var xin_table = $('#xin_table').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("erp/termination/termination_list") ?>",
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
						$('.view-modal-data').modal('toggle');
						Ladda.stopAll();
					}
				}
			});
		});
	});	
  </script>
<?php } else if($request->getGet('type') === 'file_progress' && $request->getGet('field_id')){
$ifield_id = udecode($field_id);
$istaff = $TerminationModel->where('termination_id', $ifield_id)->first();
?>
<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Dashboard.left_terminations');?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <? //= $task_sign;?>
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
            <?php //foreach($result as $istaff){?>
            <?php $user_info = $UsersModel->where('user_id', $istaff['employee_id'])->first(); ?>
            <?php
				if($istaff['is_signed']==1){
					$signedinfo = '<span class="badge badge-light-success">'.lang('Main.xin_signed').'</span>';
					$signed_download_link = '<a href="'.site_url().'download?type=pdf_files/termination/signed/&filename='.uencode($istaff['signed_file']).'">'.lang('Main.xin_download').'</a>';
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
            <?php //} ?>
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
