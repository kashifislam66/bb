<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
?>
<div class="row m-b-1 <?php //echo $get_animate;?>">

  <div class="col-md-4">
    <div class="card">
      <div class="card-header with-elements">
        <h5>
          <?= lang('Main.xin_add_new');?>
          <?= lang('Main.xin_hr_suggestion');?>
        </h5>
      </div>
      <?php $attributes = array('name' => 'add_suggestion', 'id' => 'xin-form', 'autocomplete' => 'off');?>
      <?php $hidden = array('user_id' => 1);?>
      <?= form_open('erp/suggestions/add_suggestion', $attributes, $hidden);?>
      <div class="card-body">
        <div class="form-group">
          <label for="title">
            <?= lang('Dashboard.xin_title');?> <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" name="title" placeholder="<?= lang('Dashboard.xin_title');?>">
        </div>
        <div class="form-group">
          <label for="message">
            <?= lang('Main.xin_description');?>
           </label>
          <textarea class="form-control" placeholder="<?= lang('Main.xin_description');?>" name="description" id="description"></textarea>
        </div>
        <div class="form-group">
          <fieldset class="form-group">
            <label for="attachment">
              <?= lang('Main.xin_attachment');?>
            </label>
            <input type="file" class="form-control-file" id="attachment" name="attachment">
            <small>
            <?= lang('Main.xin_company_file_type');?>
            </small>
          </fieldset>
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

  <div class="<?php echo $colmdval;?>">
    <div class="card user-profile-list">
      <div class="card-header">
        <h5>
          <?= lang('Main.xin_list_all');?>
          <?= lang('Main.xin_hr_suggestions');?>
        </h5>
        <?php //if(in_array('policy5',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
        
        <?php //} ?>
      </div>
      <div class="card-body">
        <div class="box-datatable table-responsive">
          <table class="datatables-demo table table-striped table-bordered" id="xin_table">
            <thead>
              <tr>
                <th width="230"><?= lang('Dashboard.xin_title');?></th>
                <th><i class="fa fa-user"></i>
                  <?= lang('Main.xin_created_at');?></th>
                <th><i class="fa fa-calendar"></i>
                  <?= lang('Main.xin_added_by');?></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
