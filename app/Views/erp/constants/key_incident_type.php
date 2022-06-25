<?php 
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\AssetsModel;
use App\Models\AssetscategoryModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');

$UsersModel = new UsersModel();
$RolesModel = new RolesModel();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
/*
* Incident type - View Page
*/
?>
<?php if(in_array('incident1',staff_role_resource()) || in_array('incident_type1',staff_role_resource()) || $user_info['user_type'] == 'company') {?>

<div id="smartwizard-2" class="border-bottom smartwizard-example sw-main sw-theme-default mt-2">
  <ul class="nav nav-tabs step-anchor">
    <?php if(in_array('incident1',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/incidents-list');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-award"></span>
      <?= lang('Main.xin_incidents');?>
      <div class="text-muted small">
        <?= lang('Main.xin_add');?>
        <?= lang('Main.xin_incidents');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('incident_type1',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
    <li class="nav-item active"> <a href="<?= site_url('erp/incident-type');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon fas fa-tasks"></span>
      <?= lang('Main.xin_incident_types');?>
      <div class="text-muted small">
        <?= lang('Main.xin_add');?>
        <?= lang('Main.xin_incident_types');?>
      </div>
      </a> </li>
    <?php } ?>
  </ul>
</div>
<hr class="border-light m-0 mb-3">
<?php } ?>
<div class="row m-b-1 animated fadeInRight">
  <div class="col-md-12">
    <div class="row m-b-1 animated fadeInRight">
      <?php if(in_array('incident_type2',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header with-elements"> <span class="card-header-title mr-2"><strong>
            <?= lang('Main.xin_add_new');?>
            </strong>
            <?= lang('Main.xin_incident_type');?>
            </span> </div>
          <div class="card-body">
            <?php $attributes = array('name' => 'add_incident_type', 'id' => 'xin-form', 'autocomplete' => 'off');?>
            <?php $hidden = array('user_id' => 0);?>
            <?= form_open('erp/types/add_incident_type', $attributes, $hidden);?>
            <div class="form-group">
              <label for="name">
                <?= lang('Main.xin_incident_type');?>
                <span class="text-danger">*</span> </label>
              <input type="text" class="form-control" name="name" placeholder="<?= lang('Main.xin_incident_type');?>">
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
      <?php $colmdval = 'col-md-8';?>
      <?php } else {?>
      <?php $colmdval = 'col-md-12';?>
      <?php } ?>
      <div class="<?= $colmdval;?>">
        <div class="card user-profile-list">
          <div class="card-header with-elements"> <span class="card-header-title mr-2"><strong>
            <?= lang('Main.xin_list_all');?>
            </strong>
            <?= lang('Main.xin_incident_types');?>
            </span> </div>
          <div class="card-body">
            <div class="box-datatable table-responsive">
              <table class="datatables-demo table table-striped table-bordered" id="xin_table">
                <thead>
                  <tr>
                    <th><i class="fas fa-braille"></i>
                      <?= lang('Main.xin_incident_type');?></th>
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
