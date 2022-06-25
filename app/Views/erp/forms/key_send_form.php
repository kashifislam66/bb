<?php 
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\ConstantsModel;
use App\Models\FormsModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');

$UsersModel = new UsersModel();
$RolesModel = new RolesModel();
$FormsModel = new FormsModel();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$forms = $FormsModel->where('company_id',$user_info['company_id'])->orderBy('forms_id', 'ASC')->findAll();
} else {
	$forms = $FormsModel->where('company_id',$usession['sup_user_id'])->orderBy('forms_id', 'ASC')->findAll();
}
/*
* Send Employee Form - View Page
*/
?>
<div id="smartwizard-2" class="border-bottom smartwizard-example sw-main sw-theme-default mt-2">
  <ul class="nav nav-tabs step-anchor">
    <li class="nav-item clickable"> <a href="<?= site_url('erp/forms-builder');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon fab fa-wpforms"></span>
      <?= lang('Main.xin_forms_builder');?>
      <div class="text-muted small">
        <?= lang('Main.xin_set_up');?>
        <?= lang('Main.xin_forms');?>
      </div>
      </a> </li>
    <li class="nav-item active"> <a href="<?= site_url('erp/send-form-list');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon fas fa-user-check"></span>
      <?= lang('Main.xin_send_employee_form');?>
      <div class="text-muted small">
        <?= lang('Main.xin_send_form_to_employees');?>
      </div>
      </a> </li>    
  </ul>
</div>
<div class="row m-b-1 animated fadeInRight">
  <div class="col-md-12">
    <div class="row m-b-1 animated fadeInRight">
      <?php if(in_array('leave_adjustment1',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header with-elements"> <span class="card-header-title mr-2"><strong>
            <?= lang('Main.xin_send_employee_form');?>
            </strong>
            </span> </div>
          <?php $attributes = array('name' => 'add_send_form', 'id' => 'xin-form', 'autocomplete' => 'off');?>
          <?php $hidden = array('user_id' => 0);?>
          <?= form_open('erp/forms/add_send_form', $attributes, $hidden);?>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="leave_type" class="control-label">
                    <?= lang('Main.xin_select_form');?>
                    </label>
                  <select class="form-control" name="form_id" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_select_form');?>">
                    <?php foreach($forms as $_form):?>
                    <option value="<?= $_form['forms_id'];?>">
                    <?= $_form['form_name'];?>
                    </option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
            </div>
			<?php if($user_info['user_type'] == 'company'){?>
            <?php $staff_info = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->findAll();?>
            <input type="hidden" value="0" name="employee_id[]" />
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="employees" class="control-label">
                    <?= lang('Main.xin_send_to_employees');?>
                    </label>
                  <select multiple="multiple" class="form-control" name="employee_id[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_form_choose_an_employees');?>">
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
             <input type="hidden" value="0" name="employee_id[]" />
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label for="employees" class="control-label">
                    <?= lang('Main.xin_send_to_employees');?>
                     </label>
                    <select multiple="multiple" class="form-control" name="employee_id[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_form_choose_an_employees');?>">
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
                  <label for="form_name">
                    <?= lang('Main.xin_deadline_form');?>
                   </label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"> <i class="fab fa-wpforms"></i></span></div>
                    <input type="text" class="form-control date" placeholder="<?= lang('Main.xin_deadline_form');?>" name="form_deadline" value="<?= date('Y-m-d');?>">
                  </div>
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
            <?= lang('Main.xin_send_employee_form');?>
            </span> </div>
          <div class="card-body">
            <div class="box-datatable table-responsive">
              <table class="datatables-demo table table-striped table-bordered" id="xin_table">
                <thead>
                  <tr>
                    <th><?= lang('Main.xin_request_adjustment');?></th>
                    <th><?= lang('Dashboard.dashboard_employee');?></th>
                    <th><?= lang('Main.xin_deadline_form');?></th>
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
