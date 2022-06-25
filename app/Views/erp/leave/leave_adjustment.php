<?php 
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\ConstantsModel;
use App\Models\AssetscategoryModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');

$UsersModel = new UsersModel();
$RolesModel = new RolesModel();
$ConstantsModel = new ConstantsModel();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$leave_types = $ConstantsModel->where('company_id',$user_info['company_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
} else {
	$leave_types = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
}
/*
* Leave Adjustment - View Page
*/
?>
<?php if(in_array('leave2',staff_role_resource()) || in_array('leave_calendar',staff_role_resource()) || in_array('leave_type1',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>

<div id="smartwizard-2" class="border-bottom smartwizard-example sw-main sw-theme-default mt-2">
  <ul class="nav nav-tabs step-anchor">
    <?php if(in_array('leave2',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/leave-list');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-plus-square"></span>
      <?= lang('Dashboard.xin_manage_leaves');?>
      <div class="text-muted small">
        <?= lang('Main.xin_set_up');?>
        <?= lang('Leave.left_leave');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('leave_type1',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/leave-type');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon fas fa-tasks"></span>
      <?= lang('Leave.xin_leave_type');?>
      <div class="text-muted small">
        <?= lang('Main.xin_add');?>
        <?= lang('Leave.xin_leave_type');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('leave_adjustment',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
    <li class="nav-item active"> <a href="<?= site_url('erp/leave-adjustment');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon fas fa-sliders-h"></span>
      <?= lang('Main.xin_leave_adjustment');?>
      <div class="text-muted small">
        <?= lang('Main.xin_set_up');?>
        <?= lang('Main.xin_leave_adjustment');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('leave_calendar',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/leave-calendar');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-calendar"></span>
      <?= lang('Dashboard.xin_acc_calendar');?>
      <div class="text-muted small">
        <?= lang('Leave.xin_leave_calendar');?>
      </div>
      </a> </li>
    <?php } ?>
  </ul>
</div>

<?php } ?>
<div class="row m-b-1 animated fadeInRight">
  <div class="col-md-12">
    <div class="row m-b-1 animated fadeInRight">
      <?php if(in_array('leave_adjustment1',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header with-elements"> <span class="card-header-title mr-2"><strong>
            <?= lang('Main.xin_set_up');?>
            </strong>
            <?= lang('Main.xin_leave_adjustment');?>
            </span> </div>
          <?php $attributes = array('name' => 'add_leave_adjustment', 'id' => 'xin-form', 'autocomplete' => 'off');?>
          <?php $hidden = array('user_id' => 0);?>
          <?= form_open('erp/leave/add_leave_adjustment', $attributes, $hidden);?>
          <div class="card-body">
            <?php if($user_info['user_type'] == 'company'){?>
            <?php $staff_info = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->findAll();?>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="employees" class="control-label">
                    <?= lang('Dashboard.dashboard_employee');?>
                    <span class="text-danger">*</span> </label>
                  <select class="form-control staff-id" name="employee_id" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.dashboard_employee');?>">
                    <?php foreach($staff_info as $staff) {?>
                    <option value="<?= $staff['user_id']?>">
                    <?= $staff['first_name'].' '.$staff['last_name'] ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <?php } else {
              $db = \Config\Database::connect();
			 $sql = "SELECT  user_id,
			 company_id,
			 reporting_manager 
			 FROM    (SELECT * FROM `ci_erp_users_details`
			 ORDER BY user_id) reporting_manager,
			 (SELECT @pv := '".$user_info['user_id']."') initialisation
			 WHERE   FIND_IN_SET(reporting_manager, @pv)
			 AND     LENGTH(@pv := CONCAT(@pv, ',', user_id))";
			 $query =  $db->query($sql);
			 $result = $query->getResult(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label for="employees" class="control-label">
                    <?= lang('Dashboard.dashboard_employee');?>
                    <span class="text-danger">*</span> </label>
                    <select class="form-control staff-id" name="employee_id" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.dashboard_employee');?>">
                            <option value="<?= $usession['sup_user_id']?>">
                                <?= get_name($usession['sup_user_id']); ?></option>
                            <?php if(!empty($result)) { 
                              foreach($result as $staff) { 
                                if(get_name($staff->user_id) != "") { ?>
                            <option value="<?= $staff->user_id?>">
                                <?= get_name($staff->user_id); ?>
                            </option>
                            <?php } } }  ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="leave_type" class="control-label">
                    <?= lang('Main.xin_request_leave_adjustment');?>
                    <span class="text-danger">*</span> </label>
                  <select class="form-control" name="leave_type" data-plugin="select_hrm" data-placeholder="<?= lang('Leave.xin_leave_type');?>">
                    <option value=""></option>
                    <?php foreach($leave_types as $ileave_type):?>
                    <option value="<?= $ileave_type['constants_id'];?>">
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
                  <div class="input-group"> <a href="javascript:void(0);">
                    <div class="input-group-prepend" id="minus"> <span class="input-group-text">-</span> </div>
                    </a>
                    <input type="text" class="form-control adj-hours" name="hours_to_adjust" placeholder="<?= lang('Main.xin_hours_to_adjust');?>" value="0">
                    <a href="javascript:void(0);">
                    <div class="input-group-append" id="add"> <span class="input-group-text">+</span> </div>
                    </a> </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="adjustment_reason">
                    <?= lang('Main.xin_reason_leave_adjustment');?>
                    <span class="text-danger">*</span> </label>
                  <textarea class="form-control textarea" placeholder="<?= lang('Main.xin_reason_leave_adjustment');?>" name="adjustment_reason" id="adjustment_reason"></textarea>
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
      <?php $colmd = 'col-md-8'; } else { ?>
      <?php $colmd = 'col-md-12'; } ?>
      <div class="<?= $colmd;?>">
        <div class="card user-profile-list">
          <div class="card-header with-elements"> <span class="card-header-title mr-2"><strong>
            <?= lang('Main.xin_list_all');?>
            </strong>
            <?= lang('Main.xin_leave_adjustment');?>
            </span> </div>
          <div class="card-body">
            <div class="box-datatable table-responsive">
              <table class="datatables-demo table table-striped table-bordered" id="xin_table">
                <thead>
                  <tr>
                    <th><i class="fas fa-braille"></i>
                      <?= lang('Dashboard.dashboard_employee');?></th>
                    <th><?= lang('Main.xin_request_adjustment');?></th>
                    <th><?= lang('Main.xin_adjustment_hours');?></th>
                    <th> <?= lang('Main.xin_created_at');?></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
