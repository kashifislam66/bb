<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\ConstantsModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();			
$ConstantsModel = new ConstantsModel();
$get_animate = '';
if($request->getGet('data') === 'leave_type' && $request->getGet('field_id')){
$category_id = udecode($field_id);
$result = $ConstantsModel->where('constants_id', $category_id)->where('type','leave_type')->first();
?>
<?php $ileave_option = unserialize($result['field_one']);?>
<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Leave.xin_edit_leave_type');?>
    <span class="font-weight-light">
    <?= lang('Main.xin_information');?>
    </span> <br>
    <small class="text-muted">
    <?= lang('Main.xin_below_required_info');?>
    </small> </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'update_constants_type', 'id' => 'update_constants_type', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'token' => $field_id);?>
<?= form_open('erp/types/update_leave_type', $attributes, $hidden);?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="name">
          <?= lang('Leave.xin_leave_type');?>
          <span class="text-danger">*</span> </label>
        <input type="text" class="form-control" name="name" placeholder="<?= lang('Leave.xin_leave_type');?>" value="<?= $result['category_name'];?>">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="gender" class="control-label">
          <?= lang('Leave.left_requires_approval');?>
        </label>
        <select class="form-control" name="requires_approval" data-plugin="select_hrm" data-placeholder="<?= lang('Leave.left_requires_approval');?>">
          <option value="1" <?php if($result['field_two'] == 1):?> selected="selected"<?php endif;?>>
          <?= lang('Main.xin_yes');?>
          </option>
          <option value="0" <?php if($result['field_two'] == 0):?> selected="selected"<?php endif;?>>
          <?= lang('Main.xin_no');?>
          </option>
        </select>
        <small class="form-text text-muted"><?= lang('Leave.left_requires_approval_text');?></small>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="gender" class="control-label">
          <?= lang('Main.xin_enable_leave_accrual');?>
        </label>
        <select class="form-control" name="extra_options[enable_leave_accrual]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_enable_leave_accrual');?>">
          <option value="1" <?php if(isset($ileave_option['enable_leave_accrual'])){if($ileave_option['enable_leave_accrual'] == 1):?> selected="selected"<?php endif; }?>>
          <?= lang('Main.xin_yes');?>
          </option>
          <option value="0" <?php if(isset($ileave_option['enable_leave_accrual'])){if($ileave_option['enable_leave_accrual'] == 0):?> selected="selected"<?php endif;}?>>
          <?= lang('Main.xin_no');?>
          </option>
        </select>
      </div>
    </div>
   </div>
  <hr />
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="gender" class="control-label">
          <?= lang('Main.xin_leave_carry_over');?>
        </label>
        <select class="form-control" name="extra_options[is_carry]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_leave_carry_over');?>">
          <option value="1" <?php if(isset($ileave_option['is_carry'])){if($ileave_option['is_carry'] == 1):?> selected="selected"<?php endif; }?>>
          <?= lang('Main.xin_yes');?>
          </option>
          <option value="0" <?php if(isset($ileave_option['is_carry'])){if($ileave_option['is_carry'] == 0):?> selected="selected"<?php endif;}?>>
          <?= lang('Main.xin_no');?>
          </option>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="name">
          <?= lang('Main.xin_leave_carry_over_limit');?>
          <span class="text-danger">*</span> </label>
        <input type="text" class="form-control" name="extra_options[carry_limit]" placeholder="<?= lang('Main.xin_leave_carry_over_limit');?>" value="<?php if(isset($ileave_option['carry_limit'])) { echo $ileave_option['carry_limit']; }?>">
      </div>
    </div>
  </div>
  <hr />
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="gender" class="control-label">
          <?= lang('Main.xin_leave_negative_quota');?>
        </label>
        <select class="form-control" name="extra_options[is_negative_quota]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_leave_negative_quota');?>">
          <option value="1" <?php if(isset($ileave_option['is_negative_quota'])) { if($ileave_option['is_negative_quota'] == 1):?> selected="selected"<?php endif; }?>>
          <?= lang('Main.xin_yes');?>
          </option>
          <option value="0" <?php if(isset($ileave_option['is_negative_quota'])) {if($ileave_option['is_negative_quota'] == 0):?> selected="selected"<?php endif; }?>>
          <?= lang('Main.xin_no');?>
          </option>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="name">
          <?= lang('Main.xin_leave_negative_quota_limit');?>
          <span class="text-danger">*</span> </label>
        <input type="text" class="form-control" name="extra_options[negative_limit]" placeholder="<?= lang('Main.xin_leave_negative_quota_limit');?>" value="<?php if(isset($ileave_option['negative_limit'])) { echo $ileave_option['negative_limit']; }?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="gender" class="control-label">
          <?= lang('Main.xin_per_year_quota_assignment');?>
        </label>
        <select class="form-control" name="extra_options[is_quota]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_per_year_quota_assignment');?>">
          <option value="1" <?php if(isset($ileave_option['is_quota'])) { if($ileave_option['is_quota'] == 1):?> selected="selected"<?php endif; }?>>
          <?= lang('Main.xin_yes');?>
          </option>
          <?php /*?><option value="0" <?php if(isset($ileave_option['is_quota'])) { if($ileave_option['is_quota'] == 0):?> selected="selected"<?php endif; }?>>
          <?= lang('Main.xin_no');?>
          </option><?php */?>
        </select><br /><br />
        <div class="accordion" id="accordionExample">
            <div class="heading-one" id="headingOne">
                <h5 class="mb-0"><a href="#!" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">+ <?= lang('Main.xin_show_options');?></a></h5>
            </div>
            <div id="collapseOne" class="card-body collapse" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
                <div class="table-responsive">
                    <table class="table table-xs">
                        <thead>
                            <tr>
                                <th><?= lang('Main.xin_year');?></th>
                                <th><?= lang('Main.xin_quota_assignment');?></th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php for ($x = 0; $x <= 49; $x++) { ?>
                            <?php
								$xcount = $x + 1;
								if($x == 49){
									$yr_title = lang('Main.xin_year50');
								} else {
									$yr_title = lang('Main.xin_year').' '.$xcount;
								}
								if(isset($ileave_option['quota_assign'][$x])) {
									$quota_assign = $ileave_option['quota_assign'][$x];
								} else {
									$quota_assign = 0;
								}
							?>
                            <tr>
                                <td><?= $yr_title;?></td>
                                <td><input class="form-control form-control-sm leave-total-hours" type="text" name="extra_options[quota_assign][<?= $x;?>]" value="<?= $quota_assign;?>" maxlength="4" size="2"/></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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
<?= form_close(); ?>
<script type="text/javascript">
$(document).ready(function(){ 

	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' }); 	 
	Ladda.bind('button[type=submit]');

	/* Edit data */
	$("#update_constants_type").submit(function(e){
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
							url : "<?= site_url("erp/types/leave_type_list") ?>",
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
