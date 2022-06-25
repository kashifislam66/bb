<?php
use App\Models\RolesModel;
use App\Models\ShiftModel;
use App\Models\UsersModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\StaffdetailsModel;

$RolesModel = new RolesModel();
$ShiftModel = new ShiftModel();
$UsersModel = new UsersModel();
$DepartmentModel = new DepartmentModel();
$DesignationModel = new DesignationModel();
$StaffdetailsModel = new StaffdetailsModel();
$session = \Config\Services::session();
$usession = $session->get('sup_username');

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}
$staff_info = $UsersModel->where('company_id', $company_id)->where('user_type', 'staff')->orderBy('user_id','ASC')->findAll();
$xin_system = erp_company_settings();
$approval_levels_ids = unserialize($xin_system['approval_levels']);
//echo $approval_levels_ids['level1'];
/* Employee Approvals view
*/
?>
<?php //if(in_array('92',$role_resources_ids)) { ?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5>
          <?= lang('Main.xin_approvals_specific_employees');?>
        </h5>
      </div>
    <?php $attributes = array('name' => 'add_approvals', 'id' => 'xin-form', 'autocomplete' => 'off');?>
    <?php $hidden = array('user_id' => 0);?>
    <?= form_open_multipart('erp/application/add_approvals', $attributes, $hidden);?>
    <input type="hidden" name="approvals[]" value="0" />
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="first_name">
                <?= lang('Main.xin_approval_level01');?>
              </label>
              <select class="form-control" name="approvals[level1]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_choose_an_employee');?>">
                <option value="">
                <?= lang('Main.xin_choose_an_employee');?>
                </option>
                <?php foreach($staff_info as $staff) {?>
                <option value="<?= $staff['user_id']?>" <?php if(isset($approval_levels_ids['level1'])): if($approval_levels_ids['level1']==$staff['user_id']):?> selected="selected"<?php endif; endif; ?>>
                <?= $staff['first_name'].' '.$staff['last_name'] ?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="first_name">
                <?= lang('Main.xin_approval_level02');?>
              </label>
              <select class="form-control" name="approvals[level2]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_choose_an_employee');?>">
                <option value="">
                <?= lang('Main.xin_choose_an_employee');?>
                </option>
                <?php foreach($staff_info as $staff) {?>
                <option value="<?= $staff['user_id']?>" <?php if(isset($approval_levels_ids['level2'])): if($approval_levels_ids['level2']==$staff['user_id']):?> selected="selected" <?php endif; endif; ?>>
                <?= $staff['first_name'].' '.$staff['last_name'] ?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="first_name">
                <?= lang('Main.xin_approval_level03');?>
              </label>
              <select class="form-control" name="approvals[level3]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_choose_an_employee');?>">
                <option value="">
                <?= lang('Main.xin_choose_an_employee');?>
                </option>
                <?php foreach($staff_info as $staff) {?>
                <option value="<?= $staff['user_id']?>" <?php if(isset($approval_levels_ids['level3'])): if($approval_levels_ids['level3']==$staff['user_id']):?> selected="selected" <?php endif; endif; ?>>
                <?= $staff['first_name'].' '.$staff['last_name'] ?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer text-right">
          <button type="submit" class="btn btn-primary">
          <?= lang('Main.xin_save');?>
          </button>
        </div>
        <?= form_close(); ?>
    </div>
  </div>
</div>
</div>
