<?php
use App\Models\ConstantsModel;
use App\Models\CountryModel;
use App\Models\MembershipModel;
use App\Models\CompanymembershipModel;
use App\Models\MainModel;
use App\Models\SystemModel;
$ConstantsModel = new ConstantsModel();
$CountryModel = new CountryModel();
$MembershipModel = new MembershipModel();
$MainModel = new MainModel();
$SystemModel = new SystemModel();
$CompanymembershipModel = new CompanymembershipModel();
$xin_system = $SystemModel->where('setting_id', 1)->first();
$company_types = $ConstantsModel->where('type','company_type')->orderBy('constants_id', 'ASC')->findAll();
$all_countries = $CountryModel->orderBy('country_id', 'ASC')->findAll();
$membership_plans = $MembershipModel->orderBy('membership_id', 'ASC')->findAll();
/* Company list
*/	
$get_animate ='';	
?>

<div id="add_form" class="collapse add-form <?php echo $get_animate;?>" data-parent="#accordion" style="">
  <?php $attributes = array('name' => 'add_company', 'id' => 'xin-form', 'autocomplete' => 'off');?>
  <?php $hidden = array('user_id' => 0);?>
  <?= form_open_multipart('erp/companies/add_company', $attributes, $hidden);?>
  <div id="accordion">
    <div class="row">
      <div class="col-md-8">
        <div class="card mb-2">
          <div class="card-header">
            <h5>
              <?= lang('Main.xin_add_new');?>
              <?= lang('Company.module_company_title');?>
            </h5>
            <div class="card-header-right"> <a  data-toggle="collapse" href="#add_form" aria-expanded="false" class="collapsed btn btn-sm waves-effect waves-light btn-primary m-0"> <i data-feather="minus"></i>
              <?= lang('Main.xin_hide');?>
              </a> </div>
          </div>
          <div class="card-body">
            <div class="form-body">
              <h5><?= lang('Main.xin_employee_basic_title');?></h5>
              <hr />
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="company_name">
                      <?= lang('Company.xin_company_name');?>
                      <span class="text-danger">*</span> </label>
                    <input class="form-control" placeholder="<?= lang('Company.xin_company_name');?>" name="company_name" type="text">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">
                      <?= lang('Company.xin_company_type');?>
                      <span class="text-danger">*</span> </label>
                    <select class="form-control form-select" name="company_type" data-plugin="select_hrm" data-placeholder="<?= lang('Company.xin_company_type');?>">
                      <option value="">
                      <?= lang('Main.xin_select_one');?>
                      </option>
                      <?php foreach($company_types as $ctype) {?>
                      <option value="<?= $ctype['constants_id'];?>">
                      <?= $ctype['category_name'];?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="first_name">
                      <?= lang('Main.contact_first_name_error');?>
                      <span class="text-danger">*</span> </label>
                    <input class="form-control" placeholder="<?= lang('Main.contact_first_name_error');?>" name="first_name" type="text">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="last_name">
                      <?= lang('Main.contact_last_name_error');?>
                      <span class="text-danger">*</span> </label>
                    <input class="form-control" placeholder="<?= lang('Main.contact_last_name_error');?>" name="last_name" type="text">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="address">
                      <?= lang('Main.xin_country');?>
                      <span class="text-danger">*</span> </label>
                    <select class="form-control form-select" name="country" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_country');?>">
                      <option value="">
                      <?= lang('Main.xin_select_one');?>
                      </option>
                      <?php foreach($all_countries as $country) {?>
                      <option value="<?= $country['country_id'];?>">
                      <?= $country['country_name'];?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <h5><?= lang('Main.xin_employee_other_info');?></h5>
              <hr />
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">
                      <?= lang('Main.xin_email');?>
                      <span class="text-danger">*</span> </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_email');?>" name="email" type="text">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="username">
                      <?= lang('Main.dashboard_username');?>
                      <span class="text-danger">*</span> </label>
                    <input class="form-control" placeholder="<?= lang('Main.dashboard_username');?>" name="username" type="text">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="password">
                      <?= lang('Main.xin_employee_password');?>
                      <span class="text-danger">*</span> </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_employee_password');?>" name="password" type="text">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="contact_number">
                      <?= lang('Main.xin_contact_number');?>
                      <span class="text-danger">*</span> </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_contact_number');?>" name="contact_number" type="text">
                  </div>
                </div>
              </div>
              <h5><?= lang('Membership.xin_membership_plan');?></h5>
              <hr />
              <div class="row text-center">
              	<?php foreach($membership_plans as $plans) {?>
                <?php
				if($plans['plan_duration']==1){
					$plan_duration = lang('Membership.xin_subscription_monthly');
				} else if($plans['plan_duration']==2){
					$plan_duration = lang('Membership.xin_subscription_yearly');
				} else {
					$plan_duration = lang('Membership.xin_subscription_unlimit');
				}
				?>
                <div class="col-xl-4 col-lg-4 col-sm-4">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="membership_type" class="form-check-input" id="<?= $plans['membership_id'];?>" value="<?= $plans['membership_id'];?>">
                        <label class="form-check-label" for="<?= $plans['membership_id'];?>"><img src="<?= base_url();?>/public/assets/images/pages/<?= $plans['plan_icon'];?>" for="<?= $plans['membership_id'];?>" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                    </div>
                    <p class="mb-0 text-muted"><?= number_to_currency($plans['price'], $xin_system['default_currency'],null,2);?> <?= $plans['membership_type'];?></p>
                    <p class="mb-2 text-muted"><?= $plan_duration;?></p>
                </div>
                <?php } ?>
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
              <?= lang('Company.xin_company_logo');?>
            </h5>
          </div>
          <div class="card-body py-2">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="logo">
                    <?= lang('Company.xin_company_logo');?>
                    <span class="text-danger">*</span> </label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="file">
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
    </div>
  </div>
  <?= form_close(); ?>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card user-profile-list">
      <div class="card-header">
        <h5>
          <?= lang('Main.xin_list_all');?>
          <?= lang('Company.xin_companies');?>
        </h5>
        <div class="card-header-right"> <a  data-toggle="collapse" href="#add_form" aria-expanded="false" class="collapsed btn waves-effect waves-light btn-primary btn-sm m-0"> <i data-feather="plus"></i>
          <?= lang('Main.xin_add_new');?>
          </a> </div>
      </div>
      <div class="card-body">
        <div class="dt-responsive table-responsive">
          <table id="xin_table" class="table nowrap">
            <thead>
              <tr>
                <th><?= lang('Company.xin_company_name');?></th>
                <th><?= lang('Company.xin_company_type');?></th>
                <th><?= lang('Membership.xin_membership_type');?></th>
                <th><?= lang('Main.xin_country');?></th>
                <th><?= lang('Main.dashboard_xin_status');?></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
