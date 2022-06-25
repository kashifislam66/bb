<?php
use App\Models\MainModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\CountryModel;
use App\Models\LanguageModel;
use App\Models\ConstantsModel;
use App\Models\MembershipModel;
use App\Models\CompanysettingsModel;
use App\Models\CompanymembershipModel;

$MainModel = new MainModel();
$UsersModel = new UsersModel();
$SystemModel = new SystemModel();
$CountryModel = new CountryModel();
$LanguageModel = new LanguageModel();
$ConstantsModel = new ConstantsModel();
$MembershipModel = new MembershipModel();
$CompanysettingsModel = new CompanysettingsModel();
$CompanymembershipModel = new CompanymembershipModel();

$all_countries = $CountryModel->orderBy('country_id', 'ASC')->findAll();
$membership_plans = $MembershipModel->orderBy('membership_id', 'ASC')->findAll();
$language = $LanguageModel->where('is_active', 1)->orderBy('language_id', 'ASC')->findAll();
$company_types = $ConstantsModel->where('type','company_type')->orderBy('constants_id', 'ASC')->findAll();
/* Company Details view
*/		
$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$segment_id = $request->uri->getSegment(3);
$field_id = udecode($segment_id);
/////
$xin_system = $SystemModel->where('setting_id', 1)->first();
$result = $UsersModel->where('user_id', $field_id)->first();
//echo "<pre>"; print_r($result); exit;
$company_membership = $CompanymembershipModel->where('company_id', $field_id)->first();
$xin_com_system = $CompanysettingsModel->where('company_id', $field_id)->first();
if($result['is_active'] == 1){
	$status = '<span class="badge badge-light-success"><em class="icon ni ni-check-circle"></em> '.lang('Main.xin_employees_active').'</span>';
	$status_label = '<i class="fas fa-certificate text-success bg-icon"></i><i class="fas fa-check front-icon text-white"></i>';
} else {
	$status = '<span class="badge badge-light-danger"><em class="icon ni ni-cross-circle"></em> '.lang('Main.xin_employees_inactive').'</span>';
	$status_label = '<i class="fas fa-certificate text-danger bg-icon"></i><i class="fas fa-times-circle front-icon text-white"></i>';
}
$setup_modules = unserialize($xin_com_system['setup_modules']);
?>
<?php $subs_plan = $MembershipModel->where('membership_id', $company_membership['membership_id'])->first(); ?>

<div class="row">
  <div class="col-xl-4 co-12">
    <div class="card user-card user-card-1">
      <div class="card-body pb-0">
        <div class="float-right">
          <?= $status;?>
        </div>
        <input type="hidden" id="client_id" value="<?= $segment_id;?>" />
        <div class="media user-about-block align-items-center mt-0 mb-3">
          <div class="position-relative d-inline-block">
            <img src="<?= staff_profile_photo($result['user_id']);?>" alt="" class="d-block img-radius img-fluid wid-80">
            <div class="certificated-badge">
              <?= $status_label;?>
            </div>
          </div>
          <div class="media-body ml-3">
            <h6 class="mb-1">
              <?= $result['first_name'].' '.$result['last_name'];?>
            </h6>
            <p class="mb-0 text-muted">@
              <?= $result['username'];?>
            </p>
          </div>
        </div>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"> <span class="f-w-500"><i class="feather icon-mail m-r-10"></i><?= lang('Main.xin_email');?></span> <a href="mailto:<?= $result['email'];?>" class="float-right text-body">
          <?= $result['email'];?>
          </a> </li>
        <li class="list-group-item"> <span class="f-w-500"><i class="feather icon-phone-call m-r-10"></i><?= lang('Main.xin_phone');?></span> <a href="#" class="float-right text-body">
          <?= $result['contact_number'];?>
          </a> </li>
      </ul>
      <div class="nav flex-column nav-pills list-group list-group-flush list-pills" id="user-set-tab" role="tablist" aria-orientation="vertical"> <a class="nav-link list-group-item list-group-item-action active" id="change_subscription-tab" data-toggle="pill" href="#change_subscription" role="tab" aria-controls="change_subscription" aria-selected="false"> <span class="f-w-500"><i class="feather icon-calendar m-r-10 h5 "></i><?= lang('Membership.xin_membership_change');?></span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action " id="user-edit-account-tab" data-toggle="pill" href="#user-edit-account" role="tab" aria-controls="user-edit-account" aria-selected="true"> <span class="f-w-500"><i class="feather icon-user m-r-10 h5 "></i><?= lang('Main.xin_personal_info');?></span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="user-companyinfo-tab" data-toggle="pill" href="#user-companyinfo" role="tab" aria-controls="user-companyinfo" aria-selected="false"> <span class="f-w-500"><i class="feather icon-mail m-r-10 h5 "></i>
        <?= lang('Main.xin_company_info');?>
        </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="user-profile-logo-tab" data-toggle="pill" href="#user-profile-logo" role="tab" aria-controls="user-profile-logo" aria-selected="false"> <span class="f-w-500"><i class="feather icon-mail m-r-10 h5 "></i><?= lang('Main.xin_e_details_profile_picture');?></span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="user-set-modules-tab" data-toggle="pill" href="#user-set-modules" role="tab" aria-controls="user-set-modules" aria-selected="false"> <span class="f-w-500"><i class="feather icon-target m-r-10 h5 "></i>
      <?= lang('Main.xin_setup_modules');?>
      </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> 
      <a class="nav-link list-group-item list-group-item-action" id="user-set-languages-tab" data-toggle="pill" href="#user-set-languages" role="tab" aria-controls="user-set-languages" aria-selected="false"> <span class="f-w-500"><i class="feather icon-flag m-r-10 h5 "></i>
      <?= lang('Main.xin_setup_languages');?>
      </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a></div>
    </div>
  </div>
  <div class="col-xl-8 col-lg-12">
    <div class="card tab-content">
      <div class="tab-pane fade" id="user-edit-account">
        <?php $attributes = array('name' => 'basic_info', 'id' => 'cibasic_info', 'autocomplete' => 'off');?>
        <?php $hidden = array('user_id' => 0, 'token' => $segment_id);?>
        <?= form_open('erp/companies/update_basic_info', $attributes, $hidden);?>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="company_name">
                  <?= lang('Company.xin_company_name');?>
                  <span class="text-danger">*</span> </label>
                <input class="form-control" placeholder="<?= lang('Company.xin_company_name');?>" name="company_name" type="text" value="<?= $result['company_name']?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="email">
                  <?= lang('Company.xin_company_type');?>
                  <span class="text-danger">*</span> </label>
                <select class="form-control" name="company_type" data-plugin="select_hrm" data-placeholder="<?= lang('Company.xin_company_type');?>">
                  <option value="">
                  <?= lang('Main.xin_select_one');?>
                  </option>
                  <?php foreach($company_types as $ctype) {?>
                  <option value="<?= $ctype['constants_id'];?>" <?php if($result['company_type_id']==$ctype['constants_id']){?> selected="selected" <?php } ?>>
                  <?= $ctype['category_name'];?>
                  </option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="registration_no">
                  <?= lang('Company.xin_company_registration');?>
                </label>
                <input class="form-control" placeholder="<?= lang('Company.xin_company_registration');?>" name="registration_no" type="text" value="<?= $result['registration_no']?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="first_name">
                  <?= lang('Main.contact_first_name_error');?>
                  <span class="text-danger">*</span> </label>
                <input class="form-control" placeholder="<?= lang('Main.contact_first_name_error');?>" name="first_name" type="text" value="<?= $result['first_name']?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="last_name">
                  <?= lang('Main.contact_last_name_error');?>
                  <span class="text-danger">*</span> </label>
                <input class="form-control" placeholder="<?= lang('Main.contact_last_name_error');?>" name="last_name" type="text" value="<?= $result['last_name']?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="address">
                  <?= lang('Main.xin_country');?>
                  <span class="text-danger">*</span> </label>
                <select class="form-control" name="country" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_country');?>">
                  <option value="">
                  <?= lang('Main.xin_select_one');?>
                  </option>
                  <?php foreach($all_countries as $country) {?>
                  <option value="<?= $country['country_id'];?>" <?php if($result['country']==$country['country_id']):?> selected="selected"<?php endif;?>>
                  <?= $country['country_name'];?>
                  </option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="trading_name">
                  <?= lang('Company.xin_company_trading');?>
                </label>
                <input class="form-control" placeholder="<?= lang('Company.xin_company_trading');?>" name="trading_name" type="text" value="<?= $result['trading_name']?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="xin_gtax">
                  <?= lang('Company.xin_gtax');?>
                </label>
                <input class="form-control" placeholder="<?= lang('Company.xin_gtax');?>" name="xin_gtax" type="text" value="<?= $result['government_tax']?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="membership_type">
                  <?= lang('Main.dashboard_xin_status');?>
                  <span class="text-danger">*</span> </label>
                <select class="form-select form-control" name="status" data-plugin="select_hrm" data-placeholder="<?= lang('Main.dashboard_xin_status');?>">
                  <option value="1" <?php if($result['is_active']=='1'):?> selected="selected"<?php endif;?>>
                  <?= lang('Main.xin_employees_active');?>
                  </option>
                  <option value="2" <?php if($result['is_active']=='2'):?> selected="selected"<?php endif;?>>
                  <?= lang('Main.xin_employees_inactive');?>
                  </option>
                </select>
              </div>
            </div>
          </div>
          <hr class="m-0 mb-3">
          <span class="preview-title-lg"><?= lang('Main.xin_employee_other_info');?></span>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="email">
                  <?= lang('Main.xin_email');?>
                  <span class="text-danger">*</span> </label>
                <input class="form-control" placeholder="<?= lang('Main.xin_email');?>" name="email" type="text" value="<?= $result['email']?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="username">
                  <?= lang('Main.dashboard_username');?>
                  <span class="text-danger">*</span> </label>
                <input class="form-control" placeholder="<?= lang('Main.dashboard_username');?>" name="username" type="text" value="<?= $result['username']?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="contact_number">
                  <?= lang('Main.xin_contact_number');?>
                  <span class="text-danger">*</span> </label>
                <input class="form-control" placeholder="<?= lang('Main.xin_contact_number');?>" name="contact_number" type="text" value="<?= $result['contact_number']?>">
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
      <div class="tab-pane fade active show" id="change_subscription">
        <?php $attributes = array('name' => 'update_plan', 'id' => 'ci_plan', 'autocomplete' => 'off');?>
        <?php $hidden = array('user_id' => 0, 'token' => $segment_id);?>
        <?= form_open_multipart('erp/companies/update_plan', $attributes, $hidden);?>
        <?php
		$subs_price = $subs_plan['price'];
		if($subs_plan['plan_duration']==1){
			$plan_duration = lang('Membership.xin_subscription_monthly');
		} else if($subs_plan['plan_duration']==2){
			$plan_duration = lang('Membership.xin_subscription_yearly');
		} else if($subs_plan['plan_duration']==3){
			$plan_duration = lang('Main.xin_plan_lifetime');
		} else if($subs_plan['plan_duration']==4){
			$plan_duration = lang('Main.xin_plan_weekly');
		} else if($subs_plan['plan_duration']==5){
			$plan_duration = lang('Main.xin_14days');
		} else {
			$plan_duration = lang('Main.xin_plan_lifetime');
		}
		?>
        <div class="card-body pb-2">
        <div class="table-responsive">
            <table class="table table-borderless mb-0">
                <tbody>
                    <tr>
                        <td>
                            <div class="d-inline-block align-middle text-center">
                                <img src="<?= base_url();?>/public/assets/images/pages/<?= $subs_plan['plan_icon']?>" alt="contact-img" title="contact-img" class="rounded" height="100">
                            </div>
                            <div class="d-inline-block align-middle m-l-20">
                                <a href="#!" class="text-body">
                                    <h5 class="mb-1"><?= $subs_plan['membership_type']?></h5>
                                </a>
                                <p class="text-muted mb-1"><?= $subs_plan['subscription_id']?></p>
                                <p class="text-muted mb-1"><?= lang('Membership.xin_plan_duration');?>: <?= $plan_duration;?></p>
                                <h4><?= number_to_currency($subs_price, $xin_system['default_currency'],null,2);?></h4>
                                <p class="text-muted mb-1"><?= $subs_plan['description']?></p>
                            </div>
                        </td>
                        <td class="text-right">
                            <div class="text-left d-inline-block">
                                <h6 class="my-2"><?= lang('Membership.xin_started_on');?>:  <?= $company_membership['update_at'];?></h6>
                                <p class="text-muted mb-1"><?= lang('Employees.xin_total_employees');?>: <?= $subs_plan['total_employees']?></p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h5 class="m-t-10"><?= lang('Membership.xin_membership_change');?></h5>
        <p><strong>Kiosk URL: </strong><a href="<?php echo base_url('kiosk/'.uencode($company_id));?>" target="_blank"><?php echo base_url('kiosk/'.uencode($company_id));?></a></p>
         <hr />
         <div class="alert alert-primary" role="alert"> <?= lang('Membership.xin_this_change_will_affect_on');?>
		<?= date('F d, Y');?>
        <?= lang('Membership.xin_on_acccount');?> </div>
        <div class="row text-center">
			<?php foreach($membership_plans as $plans) {?>
            <?php if($plans['membership_id']!=23423) {?>
            <?php
			if($plans['plan_duration']==1){
				$plan_duration = lang('Membership.xin_subscription_monthly');
			} else if($plans['plan_duration']==2){
				$plan_duration = lang('Membership.xin_subscription_yearly');
			} else if($plans['plan_duration']==3){
				$plan_duration = lang('Main.xin_plan_lifetime');
			} else if($plans['plan_duration']==4){
				$plan_duration = lang('Main.xin_plan_weekly');
			} else if($plans['plan_duration']==5){
				$plan_duration = lang('Main.xin_14days');
			} else {
				$plan_duration = lang('Main.xin_plan_lifetime');
			}
			?>
            <div class="col-xl-4 col-lg-4 col-sm-4 col-6 mb-3 pb-1">
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="radio" name="membership_type" class="form-check-input" id="<?= $plans['membership_id'];?>" value="<?= $plans['membership_id'];?>" <?php if($company_membership['membership_id']==$plans['membership_id']):?> checked="checked"<?php endif;?>>
                    <label class="form-check-label" for="<?= $plans['membership_id'];?>"><img src="<?= base_url();?>/public/assets/images/pages/<?= $plans['plan_icon'];?>" for="<?= $plans['membership_id'];?>" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= number_to_currency($plans['price'], $xin_system['default_currency'],null,2);?> <?= $plans['membership_type'];?></p>
                <p class="mb-2 text-muted"><?= $plan_duration;?></p>
            </div>
            <?php } ?>
            <?php } ?>
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">
            <?= lang('Main.xin_save');?>
            </button>
          </div>
        </div>
        <?= form_close(); ?>
      </div>
      <div class="tab-pane fade" id="user-profile-logo">
        <?php $attributes = array('name' => 'add_company', 'id' => 'ci_logo', 'autocomplete' => 'off');?>
        <?php $hidden = array('user_id' => 0, 'token' => $segment_id);?>
        <?= form_open_multipart('erp/companies/update_company_photo', $attributes, $hidden);?>
        <div class="card-body pb-2">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="logo">
                  <?= lang('Company.xin_company_logo');?>
                  <span class="text-danger">*</span> </label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="cifile">
                  <label class="custom-file-label"><?= lang('Main.xin_choose_file');?></label>
                  <small>
                  <?= lang('Main.xin_company_file_type');?>
                  </small> </div>
              </div>
            </div>
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">
            <?= lang('Main.xin_save');?>
            </button>
          </div>
        </div>
        <?= form_close(); ?>
      </div>
      <div class="tab-pane fade" id="user-companyinfo">
        <div class="card-body pb-2">
          <?php $attributes = array('name' => 'company_info', 'id' => 'company_info', 'autocomplete' => 'off');?>
          <?php $hidden = array('token' => $segment_id);?>
          <div class="card-header with-elements"> 
        <span class="card-header-title mr-2"><strong>
        <?= lang('Main.xin_list_all');?>
        </strong>
        <?= lang('Leave.xin_leave_type');?>
        </span> 
        <span class="card-header-title mr-2"><strong>
        <a onclick="return confirmation_close_year(event)" href="<?= site_url('erp/types/close_year/'.$result['user_id']) ?>" style="margin-top: -13px;" id="confrm_close_year" class="btn btn-primary">Close Year</a>
        </strong>
       
        </span> </div>
          <?= form_open('erp/companies/update_company_info', $attributes, $hidden);?>
          <div class="form-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="company_name">
                    <?= lang('Company.xin_company_name');?>
                    <span class="text-danger">*</span> </label>
                  <input class="form-control" placeholder="<?= lang('Company.xin_company_name');?>" name="company_name" type="text" value="<?= $result['company_name'];?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">
                    <?= lang('Company.xin_company_type');?>
                    <span class="text-danger">*</span> </label>
                  <select class="form-control" name="company_type" data-plugin="select_hrm" data-placeholder="<?= lang('Company.xin_company_type');?>">
                    <option value="">
                    <?= lang('Main.xin_select_one');?>
                    </option>
                    <?php foreach($company_types as $ctype) {?>
                    <option value="<?= $ctype['constants_id'];?>" <?php if($result['company_type_id']==$ctype['constants_id']){?> selected="selected" <?php } ?>>
                    <?= $ctype['category_name'];?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="trading_name">
                    <?= lang('Company.xin_company_trading');?>
                  </label>
                  <input class="form-control" placeholder="<?= lang('Company.xin_company_trading');?>" name="trading_name" type="text" value="<?= $result['trading_name'];?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="xin_gtax">
                    <?= lang('Company.xin_gtax');?>
                  </label>
                  <input class="form-control" placeholder="<?= lang('Company.xin_gtax');?>" name="xin_gtax" type="text" value="<?= $result['government_tax'];?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="registration_no">
                    <?= lang('Company.xin_company_registration');?>
                  </label>
                  <input class="form-control" placeholder="<?= lang('Company.xin_company_registration');?>" name="registration_no" type="text" value="<?= $result['registration_no'];?>">
                </div>
              </div>

              <h5>Leaves Quota Reset Setting</h5>
                        <div class="row">
                            <?php 
                            $fiscal_date =  $result['fiscal_date']; 
                            if(!empty($fiscal_date)) {
                            $fiscal_date = explode("-", $fiscal_date);
                            } else {
                            $fiscal_date[0] = "";
                            $fiscal_date[1] = "";
                            } 
                            ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">
                                        Specific Month
                                        <span class="text-danger">*</span> </label>
                                    <select class="form-control" name="month" data-plugin="select_hr"
                                        data-placeholder="Specific Month">
                                        <option value="">
                                            <?= lang('Main.xin_select_one');?>
                                        </option>

                                        <option <?php if($fiscal_date[0] == "01") {?> selected <?php } ?>  value="01">Jan</option>
                                        <option <?php if($fiscal_date[0] == "02") {?> selected <?php } ?> value="02">Feb</option>
                                        <option  <?php if($fiscal_date[0] == "03") {?> selected <?php } ?> value="03">Mar</option>
                                        <option  <?php if($fiscal_date[0] == "04") {?> selected <?php } ?> value="04">Apr</option>
                                        <option  <?php if($fiscal_date[0] == "05") {?> selected <?php } ?> value="05">May</option>
                                        <option  <?php if($fiscal_date[0] == "06") {?> selected <?php } ?> value="06">Jun</option>
                                        <option  <?php if($fiscal_date[0] == "07") {?> selected <?php } ?> value="07">Jul</option>
                                        <option  <?php if($fiscal_date[0] == "08") {?> selected <?php } ?> value="08">Aug</option>
                                        <option  <?php if($fiscal_date[0] == "09") {?> selected <?php } ?> value="09">Sep</option>
                                        <option  <?php if($fiscal_date[0] == "10") {?> selected <?php } ?> value="10">Oct</option>
                                        <option  <?php if($fiscal_date[0] == "11") {?> selected <?php } ?> value="11">Nov</option>
                                        <option  <?php if($fiscal_date[0] == "12") {?> selected <?php } ?> value="12">Dec</option>


                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">
                                    Specific Date
                                        <span class="text-danger">*</span> </label>
                                    <select class="form-control" name="date" data-plugin="select_hrmm"
                                        data-placeholder="Specific Date">
                                        <option value="">
                                            <?= lang('Main.xin_select_one');?>
                                        </option>

                                        <option <?php if($fiscal_date[1] == "01") {?> selected <?php } ?> value="01">01</option>
                                        <option <?php if($fiscal_date[1] == "02") {?> selected <?php } ?> value="02">02</option>
                                        <option <?php if($fiscal_date[1] == "03") {?> selected <?php } ?> value="03">03</option>
                                        <option <?php if($fiscal_date[1] == "04") {?> selected <?php } ?> value="04">04</option>
                                        <option <?php if($fiscal_date[1] == "05") {?> selected <?php } ?> value="05">05</option>
                                        <option <?php if($fiscal_date[1] == "06") {?> selected <?php } ?> value="06">06</option>
                                        <option <?php if($fiscal_date[1] == "07") {?> selected <?php } ?> value="07">07</option>
                                        <option <?php if($fiscal_date[1] == "08") {?> selected <?php } ?> value="08">08</option>
                                        <option <?php if($fiscal_date[1] == "09") {?> selected <?php } ?> value="09">09</option>
                                        <option <?php if($fiscal_date[1] == "10") {?> selected <?php } ?> value="10">10</option>
                                        <option <?php if($fiscal_date[1] == "11") {?> selected <?php } ?> value="11">11</option>
                                        <option <?php if($fiscal_date[1] == "12") {?> selected <?php } ?> value="12">12</option>
                                        <option <?php if($fiscal_date[1] == "13") {?> selected <?php } ?> value="13">13</option>
                                        <option <?php if($fiscal_date[1] == "14") {?> selected <?php } ?> value="14">14</option>
                                        <option <?php if($fiscal_date[1] == "15") {?> selected <?php } ?> value="15">15</option>
                                        <option <?php if($fiscal_date[1] == "16") {?> selected <?php } ?> value="16">16</option>
                                        <option <?php if($fiscal_date[1] == "17") {?> selected <?php } ?> value="17">17</option>
                                        <option <?php if($fiscal_date[1] == "18") {?> selected <?php } ?> value="18">18</option>
                                        <option <?php if($fiscal_date[1] == "19") {?> selected <?php } ?> value="19">19</option>
                                        <option <?php if($fiscal_date[1] == "20") {?> selected <?php } ?> value="20">20</option>
                                        <option <?php if($fiscal_date[1] == "21") {?> selected <?php } ?> value="21">21</option>
                                        <option <?php if($fiscal_date[1] == "22") {?> selected <?php } ?> value="22">22</option>
                                        <option <?php if($fiscal_date[1] == "23") {?> selected <?php } ?> value="23">23</option>
                                        <option <?php if($fiscal_date[1] == "24") {?> selected <?php } ?> value="24">24</option>
                                        <option <?php if($fiscal_date[1] == "25") {?> selected <?php } ?> value="25">25</option>
                                        <option <?php if($fiscal_date[1] == "26") {?> selected <?php } ?> value="26">26</option>
                                        <option <?php if($fiscal_date[1] == "27") {?> selected <?php } ?> value="27">27</option>
                                        <option <?php if($fiscal_date[1] == "28") {?> selected <?php } ?> value="28">28</option>
                                        <option <?php if($fiscal_date[1] == "29") {?> selected <?php } ?> value="29">29</option>
                                        <option <?php if($fiscal_date[1] == "30") {?> selected <?php } ?> value="30">30</option>
                                        <option <?php if($fiscal_date[1] == "31") {?> selected <?php } ?> value="31">31</option>

                                    </select>
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
      <div class="tab-pane fade" id="user-set-modules" role="tabpanel" aria-labelledby="user-set-modules-tab">
      
        <div class="card-header">
          <h5><i data-feather="target" class="icon-svg-primary wid-20"></i><span class="p-l-5">
            <?= lang('Main.xin_setup_modules');?>
            </span></h5>
        </div>
        <?php $attributes = array('name' => 'setup_modules_info', 'id' => 'setup_modules_info', 'autocomplete' => 'off');?>
        <?php $hidden = array('token' => $segment_id);?>
        <?= form_open('erp/companies/setup_modules_info', $attributes, $hidden);?>
        <div class="card-body">
          <div class="alert alert-primary" role="alert">
            <?= lang('Main.xin_setting_module_details_opt');?>
          </div>
          <div class="form-body">
			<?php
            if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==2):
            	$sub_modules = 'style=display:none;';
            else:
            	$sub_modules = 'style=display:block;';
            endif;endif;
            ?>
          <div class="bg-white">
          <div class="row text-center">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1">
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="radio" name="setup_module[re_module]" class="form-check-input main-module" id="hrm_finance" value="1" <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="hrm_finance"><img src="<?= base_url();?>/public/assets/images/modules/hrm_finance.svg" for="hrm_finance" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><strong>HRM + Finance</strong></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1">
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="radio" name="setup_module[re_module]" class="form-check-input main-module" id="projects_management" value="2" <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==2):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="projects_management"><img src="<?= base_url();?>/public/assets/images/modules/projects_management.svg" for="projects_management" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><strong>Finance + Project Management</strong></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1">
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="radio" name="setup_module[re_module]" class="form-check-input main-module" id="hrm_finance_project" value="3" <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==3):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="hrm_finance_project"><img src="<?= base_url();?>/public/assets/images/modules/hrm_finance_project.svg" for="hrm_finance_project" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><strong>HRM + Finance + Project Management</strong></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1">
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="radio" name="setup_module[re_module]" class="form-check-input main-module" id="hrm_finance_project_inventory" value="4" <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==4):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="hrm_finance_project_inventory"><img src="<?= base_url();?>/public/assets/images/modules/hrm_finance_project_inventory.svg" for="hrm_finance_project_inventory" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><strong>HRM + Finance + Project Management + Inventory</strong></p>
            </div>
          </div>
          <hr />
          <div class="alert alert-warning sub-module" role="alert">
            <?= lang('Main.xin_sub_modules_hrm');?>
          </div>
          <div class="row text-center">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[recruitment]" class="form-check-input" id="module_recruitment" value="1" <?php if(isset($setup_modules['recruitment'])): if($setup_modules['recruitment']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="module_recruitment"><img src="<?= base_url();?>/public/assets/images/modules/recruitment.svg" for="module_recruitment" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Recruitment.xin_recruitment_ats');?></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[payroll]" class="form-check-input" id="module_payroll" value="1" <?php if(isset($setup_modules['payroll'])): if($setup_modules['payroll']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="module_payroll"><img src="<?= base_url();?>/public/assets/images/modules/payroll.svg" for="module_payroll" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Dashboard.left_payroll');?></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module">
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[finance]" class="form-check-input" id="module_finance" value="1" <?php if(isset($setup_modules['finance'])): if($setup_modules['finance']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="module_finance"><img src="<?= base_url();?>/public/assets/images/modules/finance.svg" for="module_finance" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Dashboard.xin_hr_finance');?></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[travel]" class="form-check-input" id="module_travel" value="1" <?php if(isset($setup_modules['travel'])): if($setup_modules['travel']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="module_travel"><img src="<?= base_url();?>/public/assets/images/modules/travel.svg" for="module_travel" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Dashboard.left_travels');?></p>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[fmanager]" class="form-check-input" id="module_fmanager" value="1" <?php if(isset($setup_modules['fmanager'])): if($setup_modules['fmanager']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="module_fmanager"><img src="<?= base_url();?>/public/assets/images/modules/documents.svg" for="module_fmanager" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Dashboard.xin_upload_files');?></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[asset]" class="form-check-input" id="module_assets" value="1" <?php if(isset($setup_modules['asset'])): if($setup_modules['asset']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="module_assets"><img src="<?= base_url();?>/public/assets/images/modules/assets.svg" for="module_assets" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Dashboard.xin_assets');?></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[events]" class="form-check-input" id="module_events" value="1" <?php if(isset($setup_modules['events'])): if($setup_modules['events']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="module_events"><img src="<?= base_url();?>/public/assets/images/modules/events.svg" for="module_events" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Main.xin_events_meetings_title');?></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[performance]" class="form-check-input" id="module_performance" value="1" <?php if(isset($setup_modules['performance'])): if($setup_modules['performance']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="module_performance"><img src="<?= base_url();?>/public/assets/images/modules/performance.svg" for="module_performance" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Dashboard.left_talent_management');?></p>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[award]" class="form-check-input" id="module_award" value="1" <?php if(isset($setup_modules['award'])): if($setup_modules['award']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="module_award"><img src="<?= base_url();?>/public/assets/images/modules/awards.svg" for="module_award" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Dashboard.left_awards');?></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[holidays]" class="form-check-input" id="module_holidays" value="1" <?php if(isset($setup_modules['holidays'])): if($setup_modules['holidays']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="module_holidays"><img src="<?= base_url();?>/public/assets/images/modules/holidays.svg" for="module_holidays" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Dashboard.left_holidays');?></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[visitor_book]" class="form-check-input" id="module_visitor_book" value="1" <?php if(isset($setup_modules['visitor_book'])): if($setup_modules['visitor_book']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="module_visitor_book"><img src="<?= base_url();?>/public/assets/images/modules/visitors_book.svg" for="module_visitor_book" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Main.xin_visitor_book');?></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[training]" class="form-check-input" id="left_training" value="1" <?php if(isset($setup_modules['training'])): if($setup_modules['training']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="left_training"><img src="<?= base_url();?>/public/assets/images/modules/training.svg" for="left_training" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Dashboard.left_training');?></p>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[polls]" class="form-check-input" id="module_polls" value="1" <?php if(isset($setup_modules['polls'])): if($setup_modules['polls']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="module_polls"><img src="<?= base_url();?>/public/assets/images/modules/polls.svg" for="module_polls" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Main.xin_polls_votes');?></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[suggestions]" class="form-check-input" id="hr_suggestions" value="1" <?php if(isset($setup_modules['suggestions'])): if($setup_modules['polls']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="hr_suggestions"><img src="<?= base_url();?>/public/assets/images/modules/suggestions.svg" for="hr_suggestions" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Main.xin_hr_suggestions');?></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[warning]" class="form-check-input" id="hr_warning" value="1" <?php if(isset($setup_modules['warning'])): if($setup_modules['warning']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="hr_warning"><img src="<?= base_url();?>/public/assets/images/modules/warning.svg" for="hr_warning" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Dashboard.left_warnings');?></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[resignation]" class="form-check-input" id="hr_resignation" value="1" <?php if(isset($setup_modules['resignation'])): if($setup_modules['resignation']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="hr_resignation"><img src="<?= base_url();?>/public/assets/images/modules/resignation.svg" for="hr_resignation" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Dashboard.left_resignations');?></p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 mb-3 pb-1 sub-module" <?= $sub_modules;?>>
                <div class="form-check form-check-inline me-md-0 me-0">
                    <input type="checkbox" name="setup_module[termination]" class="form-check-input" id="hr_termination" value="1" <?php if(isset($setup_modules['termination'])): if($setup_modules['termination']==1):?> checked="checked" <?php endif; endif;?>>
                    <label class="form-check-label" for="hr_termination"><img src="<?= base_url();?>/public/assets/images/modules/termination.svg" for="hr_termination" class="img-fluid m-b-10 img-thumbnail bg-white mb-0" alt="" width="200"></label>
                </div>
                <p class="mb-0"><?= lang('Dashboard.left_terminations');?></p>
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
      <div class="tab-pane fade" id="user-set-languages" role="tabpanel" aria-labelledby="user-set-languages-tab">
      
        <div class="card-header">
          <h5><i data-feather="flag" class="icon-svg-primary wid-20"></i><span class="p-l-5">
            <?= lang('Main.xin_setup_languages');?>
            </span></h5>
        </div>
        <?php $attributes = array('name' => 'setup_languages_info', 'id' => 'setup_languages_info', 'autocomplete' => 'off');?>
        <?php $hidden = array('token' => $segment_id);?>
        <?= form_open('erp/companies/setup_languages_info', $attributes, $hidden);?>
        <div class="card-body">
          <div class="alert alert-success" role="alert">
            <?= lang('Main.xin_setup_languages_details_opt1');?>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="membership_type">
                  <?= lang('Main.xin_ci_default_language');?>
                  <span class="text-danger">*</span> </label>
                <select class="form-control" name="default_language" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_ci_default_language');?>">
                    <?php foreach($language as $lang):?>
                    <option value="<?= $lang['language_code'];?>" <?php if($xin_com_system['default_language']==$lang['language_code']){?> selected <?php }?>>
                    <?= $lang['language_name'];?>
                    </option>
                    <?php endforeach;?>
                  </select>
              </div>
            </div>
            <?php $setup_languages = unserialize($xin_com_system['setup_languages']);?>
            <div class="col-md-12">
              <div class="form-group">
                <label for="membership_type">
                  <?= lang('Main.xin_setup_languages');?>
                  <span class="text-danger">*</span> </label>
                <select class="form-control" multiple="multiple" required name="setup_languages[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_setup_languages');?>">
                    <?php foreach($language as $lang):?>
                    <option value="<?= $lang['language_code'];?>" <?php if(in_array($lang['language_code'],$setup_languages)):?> selected <?php endif;?>>
                    <?= $lang['language_name'];?>
                    </option>
                    <?php endforeach;?>
                  </select>
                  <small><?= lang('Main.xin_setup_languages_details_only');?></small>
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
<script>
  function confirmation_close_year(e){
    e.preventDefault();
    var urlToRedirect = e.currentTarget.getAttribute('href'); 
      console.log(urlToRedirect);
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if(result.isConfirmed===false){
          window.location.href = '';
        }
        if (result.isConfirmed) {
          Swal.fire({
          title: 'Are you sure?',
          text: "Do you want to done!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes'
          }).then((result) => {
          window.location.href = urlToRedirect;
          if(result.isConfirmed===false){
              window.location.href = '';
          }
          })
        }
      }) 
        
  }
</script>
