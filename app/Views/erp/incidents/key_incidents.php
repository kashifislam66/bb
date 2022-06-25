<?php 
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\AssetsModel;
use App\Models\ConstantsModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');

$UsersModel = new UsersModel();
$RolesModel = new RolesModel();	
$SystemModel = new SystemModel();		
$ConstantsModel = new ConstantsModel();
$xin_system = erp_company_settings();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
	$category_info = $ConstantsModel->where('company_id', $user_info['company_id'])->where('type','incident_type')->findAll();
} else {
	$company_id = $usession['sup_user_id'];
	$category_info = $ConstantsModel->where('company_id', $usession['sup_user_id'])->where('type','incident_type')->findAll();
}
$staff_info = $UsersModel->where('company_id', $company_id)->where('user_type','staff')->findAll();
/* Awards view
*/
$get_animate = '';
?>
<?php if(in_array('incident1',staff_role_resource()) || in_array('incident_type1',staff_role_resource()) || $user_info['user_type'] == 'company') {?>

<div id="smartwizard-2" class="border-bottom smartwizard-example sw-main sw-theme-default mt-2">
  <ul class="nav nav-tabs step-anchor">
    <?php if(in_array('incident1',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
    <li class="nav-item active"> <a href="<?= site_url('erp/incidents-list');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-award"></span>
      <?= lang('Main.xin_incidents');?>
      <div class="text-muted small">
        <?= lang('Main.xin_add');?>
        <?= lang('Main.xin_incidents');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('incident_type1',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/incident-type');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon fas fa-tasks"></span>
      <?= lang('Main.xin_incident_type');?>
      <div class="text-muted small">
        <?= lang('Main.xin_add');?>
        <?= lang('Main.xin_incident_type');?>
      </div>
      </a> </li>
    <?php } ?>
  </ul>
</div>
<hr class="border-light m-0 mb-3">
<?php } ?>
<div class="row m-b-1 animated fadeInRight">
  <div class="col-md-12">
    <?php if(in_array('incident2',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
    <div id="add_form" class="collapse add-form <?php echo $get_animate;?>" data-parent="#accordion" style="">
      <?php $attributes = array('name' => 'add_incident', 'id' => 'xin-form', 'autocomplete' => 'off');?>
      <?php $hidden = array('_user' => 1);?>
      <?php echo form_open_multipart('erp/incidents/add_incident', $attributes, $hidden);?>
      <div class="row">
        <div class="col-md-8">
          <div class="card mb-2">
            <div id="accordion">
              <div class="card-header">
                <h5>
                  <?= lang('Main.xin_add_new');?>
                  <?= lang('Main.xin_incident');?>
                </h5>
                <div class="card-header-right"> <a  data-toggle="collapse" href="#add_form" aria-expanded="false" class="collapsed btn btn-sm waves-effect waves-light btn-primary m-0"> <i data-feather="minus"></i>
                  <?= lang('Main.xin_hide');?>
                  </a> </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <?php if($user_info['user_type'] == 'company'){?>
                  <?php $staff_info = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->findAll();?>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Dashboard.dashboard_employee');?> <span class="text-danger">*</span>
                      </label>
                      <select class="form-control" name="employee_id" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.dashboard_employee');?>">
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>">
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?php $colmd = 'col-md-6'?>
                  <?php } else {?>
                  <?php $colmd = 'col-md-12'?>
                  <?php } ?>
                  <div class="<?= $colmd?>">
                    <div class="form-group">
                      <label for="award_type">
                        <?= lang('Main.xin_incident_type');?> <span class="text-danger">*</span>
                      </label>
                      <select name="incident_type_id" class="form-control" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_incident_type');?>">
                        <option value=""></option>
                        <?php foreach($category_info as $assets_category) {?>
                        <option value="<?= $assets_category['constants_id']?>">
                        <?= $assets_category['category_name']?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="xin_title">
                        <?= lang('Dashboard.xin_title');?> <span class="text-danger">*</span>
                      </label>
                      <input type="text" class="form-control" placeholder="<?= lang('Dashboard.xin_title');?>" name="title">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="incident_date">
                        <?= lang('Main.xin_e_details_date');?> <span class="text-danger">*</span>
                      </label>
                      <div class="input-group">
                        <input class="form-control date" placeholder="<?= lang('Main.xin_incident_date');?>" name="incident_date" type="text" value="">
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="time">
                        <?= lang('Main.xin_time');?>
                      </label>
                      <div class="input-group">
                        <input class="form-control time_dropdown_add" placeholder="<?= lang('Main.xin_incident_time');?>" name="incident_time" type="text">
                      </div>
                    </div>
                  </div>
                  <input type="hidden" value="0" name="notify_send_to[]" />
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="incident_description">
                        <?= lang('Main.xin_incident_description');?> <span class="text-danger">*</span>
                      </label>
                      <textarea class="form-control" placeholder="<?= lang('Main.xin_incident_description');?>" name="incident_description" cols="30" rows="2" id="incident_description"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="reset" class="btn btn-light" href="#add_form" data-toggle="collapse" aria-expanded="false">
                <?= lang('Main.xin_reset');?>
                </button>
                &nbsp;
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h5>
                <?= lang('Main.xin_incident_document');?>
              </h5>
            </div>
            <div class="card-body py-2">
              <div class="row">
                <div class="col-md-12">
                  <label for="incident_file">
                    <?= lang('Main.xin_attachment');?>
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
            </div>
          </div>
        </div>
      </div>
      <?= form_close(); ?>
    </div>
    <?php } ?>
    <div class="card user-profile-list <?php echo $get_animate;?>">
      <div class="card-header">
        <h5>
          <?= lang('Main.xin_list_all');?>
          <?= lang('Main.xin_incidents');?>
        </h5>
        <?php if(in_array('incident2',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
        <div class="card-header-right"> <a  data-toggle="collapse" href="#add_form" aria-expanded="false" class="collapsed btn waves-effect waves-light btn-primary btn-sm m-0"> <i data-feather="plus"></i>
          <?= lang('Main.xin_add_new');?>
          </a> </div>
        <?php } ?>
      </div>
      <div class="card-body">
        <div class="box-datatable table-responsive">
          <table class="datatables-demo table table-striped table-bordered" id="xin_table">
            <thead>
              <tr>
                <th width="">
                  <?= lang('Main.xin_incident_type');?></th>
                <th><i class="fa fa-user small"></i>
                  <?= lang('Dashboard.dashboard_employee');?></th>
                <th> <?= lang('Dashboard.xin_title');?></th>
                <th> <?= lang('Main.xin_e_details_date');?></th>
                <th> <?= lang('Main.xin_time');?></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
.hide-calendar .ui-datepicker-calendar { display:none !important; }
.hide-calendar .ui-priority-secondary { display:none !important; }
</style>
