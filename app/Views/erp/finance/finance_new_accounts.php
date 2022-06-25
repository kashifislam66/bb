<?php 
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\PayeesModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');

$UsersModel = new UsersModel();
$RolesModel = new RolesModel();
$SystemModel = new SystemModel();
$xin_system = erp_company_settings();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
/*
* Finance||Accounts - View Page
*/
?>
<div class="row m-b-1">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header with-elements">
        <h5>
          <?= lang('Main.xin_add_new');?>
          <?= lang('Finance.xin_account');?>
        </h5>
      </div>
      <?php $attributes = array('name' => 'add_new_account', 'id' => 'add_new_account', 'autocomplete' => 'off');?>
      <?php $hidden = array('user_id' => 1);?>
      <?php echo form_open('erp/finance/add_new_account', $attributes, $hidden);?>
      <div class="card-body">
        <div class="form-group">
          <label for="account_name">
            <?= lang('Employees.xin_account_title');?> <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" name="account_name" placeholder="<?= lang('Employees.xin_account_title');?>">
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
  <div class="col-md-8">
    <div class="card user-profile-list">
      <div class="card-header with-elements">
        <h5>
          <?= lang('Main.xin_list_all');?>
          <?= lang('Finance.xin_accounts');?>
        </h5>
      </div>
      <div class="card-body">
        <div class="box-datatable table-responsive">
          <table class="datatables-demo table table-striped table-bordered" id="new_accounts">
            <thead>
              <tr>
                <th><?= lang('Employees.xin_account_title');?></th>
                <th>&nbsp;</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
