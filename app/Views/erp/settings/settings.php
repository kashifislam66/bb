<?php
/*
* System Settings - Settings View
*/
?>
<?php
use App\Models\SystemModel;
use App\Models\CountryModel;
use App\Models\LanguageModel;
use App\Models\ConstantsModel;
use App\Models\CurrenciesModel;
use App\Models\EmailconfigModel;

$SystemModel = new SystemModel();
$CountryModel = new CountryModel();
$LanguageModel = new LanguageModel();
$ConstantsModel = new ConstantsModel();
$CurrenciesModel = new CurrenciesModel();
$EmailconfigModel = new EmailconfigModel();

$currency = $ConstantsModel->where('type','currency_type')->orderBy('constants_id', 'ASC')->findAll();
$language = $LanguageModel->where('is_active', 1)->orderBy('language_id', 'ASC')->findAll();
$xin_system = $SystemModel->where('setting_id', 1)->first();
$email_config = $EmailconfigModel->where('email_config_id', 1)->first();
/////
$all_countries = $CountryModel->orderBy('country_id', 'ASC')->findAll();
$company_types = $ConstantsModel->where('type','company_type')->orderBy('constants_id', 'ASC')->findAll();
$subscription_tax = $ConstantsModel->where('type','subscription_tax')->orderBy('constants_id', 'ASC')->findAll();
$currency_list = $CurrenciesModel->orderBy('currency_id', 'ASC')->findAll();
?>

<div id="smartwizard-2" class="border-bottom smartwizard-example sw-main sw-theme-default mt-2">
  <ul class="nav nav-tabs step-anchor">
    <?php if(in_array('6',super_user_role_resource())) { ?>
    <li class="nav-item active"> <a href="<?= site_url('erp/system-settings');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-settings"></span>
      <?= lang('Main.left_settings');?>
      <div class="text-muted small">
        <?= lang('Main.xin_set_up');?>
        <?= lang('Main.left_settings');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('7',super_user_role_resource())) { ?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/system-constants');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-activity"></span>
      <?= lang('Main.left_constants');?>
      <div class="text-muted small">
        <?= lang('Main.xin_set_up');?>
        <?= lang('Main.left_constants');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('9',super_user_role_resource())) { ?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/email-templates');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-mail"></span>
      <?= lang('Main.left_email_templates');?>
      <div class="text-muted small">
        <?= lang('Main.xin_set_up');?>
        <?= lang('Main.left_email_templates');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('9',super_user_role_resource())) { ?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/all-languages');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-flag"></span>
      <?= lang('Main.xin_multi_language');?>
      <div class="text-muted small">
        <?= lang('Main.xin_set_up');?>
        <?= lang('Main.xin_multi_language');?>
      </div>
      </a> </li>
    <?php } ?>
  </ul>
</div>
<hr class="border-light m-0 mb-3">
<?php if(in_array('6',super_user_role_resource())) { ?>
<div class="row">
<!-- start -->
<div class="col-xl-3 col-12">
  <div class="card user-card user-card-1">
    <div class="card-body pb-0">
      <div class="media user-about-block align-items-center mt-0 mb-3">
        <div class="position-relative d-inline-block">
          <div class="certificated-badge"> <a href="javascript:void(0)" class="mb-3 nav-link"><span class="sw-icon fas fa-cog"></span></a> </div>
        </div>
        <div class="media-body ml-3">
          <h6 class="mb-1">
            <?= lang('Main.left_settings');?>
          </h6>
          <p class="mb-0 text-muted">
            <?= lang('Main.header_configuration');?>
          </p>
        </div>
      </div>
    </div>
    <div class="nav flex-column nav-pills list-group list-group-flush list-pills" id="user-set-tab" role="tablist" aria-orientation="vertical"> <a class="nav-link list-group-item list-group-item-action active" id="account-settings-tab" data-toggle="pill" href="#account-settings" role="tab" aria-controls="account-settings" aria-selected="true"> <span class="f-w-500"><i class="feather icon-disc m-r-10 h5 "></i>
      <?= lang('Main.xin_system');?>
      </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="account-system-logos-tab" data-toggle="pill" href="#account-system-logos" role="tab" aria-controls="account-system-logos" aria-selected="false"> <span class="f-w-500"><i class="feather icon-image m-r-10 h5 "></i>
      <?= lang('Main.xin_system_logos');?>
      </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="account-payment-tab" data-toggle="pill" href="#account-payment" role="tab" aria-controls="account-payment" aria-selected="false"> <span class="f-w-500"><i class="feather icon-credit-card m-r-10 h5 "></i>
      <?= lang('Main.xin_acc_payment_gateway');?>
      </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="account-notification-tab" data-toggle="pill" href="#account-notification" role="tab" aria-controls="account-notification" aria-selected="false"> <span class="f-w-500"><i class="feather icon-crosshair m-r-10 h5 "></i>
      <?= lang('Main.xin_notification_position');?>
      </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="user-set-email-tab" data-toggle="pill" href="#user-set-email" role="tab" aria-controls="user-set-email" aria-selected="false"> <span class="f-w-500"><i class="feather icon-mail m-r-10 h5 "></i>
      <?= lang('Main.xin_email_notifications');?>
      </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="user-subscription-tax-tab" data-toggle="pill" href="#user-subscription-tax" role="tab" aria-controls="user-subscription-tax" aria-selected="false"> <span class="f-w-500"><i class="feather icon-align-justify m-r-10 h5 "></i>
      <?= lang('Users.xin_subscription_tax');?>
      </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="user-set-theme-tab" data-toggle="pill" href="#user-set-theme" role="tab" aria-controls="user-set-theme" aria-selected="false"> <span class="f-w-500"><i class="feather icon-layout m-r-10 h5 "></i>
      <?= lang('Main.xin_theme_settings');?>
      </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a></div>
  </div>
</div>
<div class="col-xl-9 col-12">
  <div class="tab-content" id="user-set-tabContent">
    <div class="tab-pane fade show active" id="account-settings" role="tabpanel" aria-labelledby="account-settings-tab">
      <div class="card">
        <div class="card-header">
          <h5><i data-feather="disc" class="icon-svg-primary wid-20"></i><span class="p-l-5">
            <?= lang('Main.xin_system');?>
            </span></h5>
        </div>
        <div class="card-body">
          <?php $attributes = array('name' => 'system_info', 'id' => 'system_info', 'autocomplete' => 'off');?>
          <?php $hidden = array('u_basic_info' => 'UPDATE');?>
          <?= form_open('erp/settings/system_info', $attributes, $hidden);?>
          <div class="bg-white">
            <div class="row form-sm-row">
              <div class="col-md-4 col-6">
                <div class="form-group">
                  <label class="">
                    <?= lang('Main.xin_application_name');?>
                    <span class="text-danger">*</span> </label>
                  <input class="form-control" placeholder="<?= lang('Main.xin_application_name');?>" name="application_name" type="text" value="<?= $xin_system['application_name'];?>" id="application_name">
                </div>
              </div>
              <div class="col-md-4 col-6">
                <div class="form-group">
                  <label class="">
                    <?= lang('Company.xin_company_name');?>
                    <span class="text-danger">*</span> </label>
                  <input class="form-control" placeholder="<?= lang('Company.xin_company_name');?>" name="company_name" type="text" value="<?= $xin_system['company_name'];?>">
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label class="">
                    <?= lang('Company.xin_company_type');?>
                    <span class="text-danger">*</span> </label>
                  <select class="form-control" name="company_type" data-plugin="select_hrm" data-placeholder="<?= lang('Company.xin_company_type');?>">
                    <option value="">
                    <?= lang('Main.xin_select_one');?>
                    </option>
                    <?php foreach($company_types as $ctype) {?>
                    <option value="<?= $ctype['constants_id'];?>" <?php if($ctype['constants_id']==$xin_system['company_type_id']):?> selected="selected"<?php endif;?>>
                    <?= $ctype['category_name'];?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4 col-6">
                <div class="form-group">
                  <label for="trading_name">
                    <?= lang('Company.xin_company_trading');?>
                  </label>
                  <input class="form-control" placeholder="<?= lang('Company.xin_company_trading');?>" name="trading_name" type="text" value="<?= $xin_system['trading_name'];?>">
                </div>
              </div>
              <div class="col-md-4 col-6">
                <div class="form-group">
                  <label for="registration_no">
                    <?= lang('Company.xin_company_registration');?>
                  </label>
                  <input class="form-control" placeholder="<?= lang('Company.xin_company_registration');?>" name="registration_no" type="text" value="<?= $xin_system['registration_no'];?>">
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label for="xin_gtax">
                    <?= lang('Company.xin_gtax');?>
                  </label>
                  <input class="form-control" placeholder="<?= lang('Company.xin_gtax');?>" name="xin_gtax" type="text" value="<?= $xin_system['government_tax'];?>">
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="email">
                    <?= lang('Main.xin_email');?>
                    <span class="text-danger">*</span> </label>
                  <input class="form-control" placeholder="<?= lang('Main.xin_email');?>" name="email" type="email" value="<?= $xin_system['email'];?>">
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="contact_number">
                    <?= lang('Main.xin_contact_number');?>
                    <span class="text-danger">*</span></label>
                  <input class="form-control" placeholder="<?= lang('Main.xin_contact_number');?>" name="contact_number" type="text" value="<?= $xin_system['contact_number'];?>">
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label for="country">
                    <?= lang('Main.xin_country');?>
                    <span class="text-danger">*</span> </label>
                  <select class="form-control" name="country" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_country');?>">
                    <option value="">
                    <?= lang('Main.xin_select_one');?>
                    </option>
                    <?php foreach($all_countries as $country) {?>
                    <option value="<?= $country['country_id'];?>" <?php if($country['country_id']==$xin_system['country']):?> selected="selected"<?php endif;?>>
                    <?= $country['country_name'];?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-8 col-sm-6 col-12">
                <div class="form-group">
                  <label class="">
                    <?= lang('Main.xin_setting_timezone');?>
                    <span class="text-danger">*</span> </label>
                  <select class="form-control" name="system_timezone" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_setting_timezone');?>">
                    <option value="">
                    <?= lang('Main.xin_select_one');?>
                    </option>
                    <?php foreach(generate_timezone_list() as $tval=>$labels):?>
                    <option value="<?= $tval;?>" <?php if($xin_system['system_timezone']==$tval){?> selected <?php }?>>
                    <?= $labels;?>
                    </option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="address_1">
                    <?= lang('Main.xin_address');?>
                    <span class="text-danger">*</span></label>
                  <input class="form-control" placeholder="<?= lang('Main.xin_address');?>" name="address_1" type="text" value="<?= $xin_system['address_1'];?>">
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="address_2" class="d-sm-block d-none"> &nbsp;</label>
                  <input class="form-control" placeholder="<?= lang('Main.xin_address_2');?>" name="address_2" type="text" value="<?= $xin_system['address_2'];?>">
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label for="city">
                    <?= lang('Main.xin_city');?>
                    <span class="text-danger">*</span></label>
                  <input class="form-control" placeholder="<?= lang('Main.xin_city');?>" name="city" type="text" value="<?= $xin_system['city'];?>">
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label for="state">
                    <?= lang('Main.xin_state');?>
                    <span class="text-danger">*</span></label>
                  <input class="form-control" placeholder="<?= lang('Main.xin_state');?>" name="state" type="text" value="<?= $xin_system['state'];?>">
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label for="zipcode">
                    <?= lang('Main.xin_zipcode');?>
                    <span class="text-danger">*</span></label>
                  <input class="form-control" placeholder="<?= lang('Main.xin_zipcode');?>" name="zipcode" type="text" value="<?= $xin_system['zipcode'];?>">
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label class="">
                    <?= lang('Main.xin_date_format');?>
                    <span class="text-danger">*</span> </label>
                  <select class="form-control" name="date_format" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_date_format');?>">
                    <option value="">
                    <?= lang('Main.xin_select_one');?>
                    </option>
                    <option value="Y-m-d" <?php if($xin_system['date_format_xi']=='Y-m-d'){?> selected <?php }?>>Format: <?= date('Y-m-d');?></option>
                    <option value="Y-d-m" <?php if($xin_system['date_format_xi']=='Y-d-m'){?> selected <?php }?>>Format: <?= date('Y-d-m');?></option>
                    <option value="d-m-Y" <?php if($xin_system['date_format_xi']=='d-m-Y'){?> selected <?php }?>>Format: <?= date('d-m-Y');?></option>
                    <option value="m-d-Y" <?php if($xin_system['date_format_xi']=='m-d-Y'){?> selected <?php }?>>Format: <?= date('m-d-Y');?></option>
                    <option value="Y/m/d" <?php if($xin_system['date_format_xi']=='Y/m/d'){?> selected <?php }?>>Format: <?= date('Y/m/d');?></option>
                    <option value="Y/d/m" <?php if($xin_system['date_format_xi']=='Y/d/m'){?> selected <?php }?>>Format: <?= date('Y/d/m');?></option>
                    <option value="d/m/Y" <?php if($xin_system['date_format_xi']=='d/m/Y'){?> selected <?php }?>>Format: <?= date('d/m/Y');?></option>
                    <option value="m/d/Y" <?php if($xin_system['date_format_xi']=='m/d/Y'){?> selected <?php }?>>Format: <?= date('m/d/Y');?></option>
                    <option value="Y.m.d" <?php if($xin_system['date_format_xi']=='Y.m.d'){?> selected <?php }?>>Format: <?= date('Y.m.d');?></option>
                    <option value="Y.d.m" <?php if($xin_system['date_format_xi']=='Y.d.m'){?> selected <?php }?>>Format: <?= date('Y.d.m');?></option>
                    <option value="d.m.Y" <?php if($xin_system['date_format_xi']=='d.m.Y'){?> selected <?php }?>>Format: <?= date('d.m.Y');?></option>
                    <option value="m.d.Y" <?php if($xin_system['date_format_xi']=='m.d.Y'){?> selected <?php }?>>Format: <?= date('m.d.Y');?></option>
                    <option value="F j, Y" <?php if($xin_system['date_format_xi']=='F j, Y'){?> selected <?php }?>>Format: <?= date('F j, Y');?></option>
                  </select>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label class="">
                    <?= lang('Main.xin_ci_default_language');?>
                    <span class="text-danger">*</span> </label>
                  <select class="form-control" name="default_language" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_ci_default_language');?>">
                    <?php foreach($language as $lang):?>
                    <option value="<?= $lang['language_code'];?>" <?php if($xin_system['default_language']==$lang['language_code']){?> selected <?php }?>>
                    <?= $lang['language_name'];?>
                    </option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label class="">
                    <?= lang('Main.xin_default_currency');?>
                    <span class="text-danger">*</span> </label>
                 <select class="form-control" name="default_currency" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_default_currency');?>">
   				<?php foreach($currency_list as $_currency):?>
   					<option value="<?= $_currency['currency_code'];?>" <?php if($xin_system['default_currency']==$_currency['currency_code']):?> selected="selected"<?php endif;?>>
					<?= $_currency['currency_name'].' - '.$_currency['currency_code'];?></option>
                	<?php endforeach;?>
                </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label class="">
                    <?= lang('Main.xin_invoice_terms_condition');?>
                    <span class="text-danger">*</span> </label>
                  <textarea class="form-control" name="invoice_terms_condition" rows="3"><?= $xin_system['invoice_terms_condition'];?></textarea>
                </div>
              </div>
            </div>
            
            <h6 class="mb-lg-4 mb-2"><?= lang('Main.xin_installed_ssl');?></h6>
            <div class="custom-control custom-switch d-flex">
                <input type="checkbox" class="custom-control-input mt-1 me-1" id="is_ssl_available" name="is_ssl_available" <?php if($xin_system['is_ssl_available']==1):?> checked="checked" <?php endif;?> value="1">
                <label class="custom-control-label" for="is_ssl_available"><?= lang('Main.xin_installed_ssl_details_text');?></label>
            </div>
            <hr>
            <h5 class="mt-md-5 mt-4"><?= lang('Main.xin_auth_background');?></h5>
            <div class="alert alert-primary" role="alert">
            <?= lang('Main.xin_for_login_page1');?></div>
            <hr />
            <div class="row text-center">
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6">
                    <div class="form-check form-check-inline me-md-3 me-0">
                        <input type="radio" name="auth_background" class="form-check-input" id="2815767" value="2815767" <?php if($xin_system['auth_background']=='2815767'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="2815767"><a href="<?= base_url();?>/public/assets/images/auth/2815767.jpg" data-lightbox="roadtrip"><img src="<?= base_url();?>/public/assets/images/auth/2815767.jpg" for="2815767" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6">
                    <div class="form-check form-check-inline me-md-3 me-0">
                        <input type="radio" name="auth_background" class="form-check-input" id="4859202" value="4859202" <?php if($xin_system['auth_background']=='4859202'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="4859202"><a href="<?= base_url();?>/public/assets/images/auth/4859202.jpg" data-lightbox="roadtrip"><img src="<?= base_url();?>/public/assets/images/auth/4859202.jpg" for="4859202" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6">
                    <div class="form-check form-check-inline me-md-3 me-0">
                        <input type="radio" name="auth_background" class="form-check-input" id="4881040" value="4881040" <?php if($xin_system['auth_background']=='4881040'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="4881040"><a href="<?= base_url();?>/public/assets/images/auth/4881040.jpg" data-lightbox="roadtrip"><img src="<?= base_url();?>/public/assets/images/auth/4881040.jpg" for="4881040" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6">
                    <div class="form-check form-check-inline me-md-3 me-0">
                        <input type="radio" name="auth_background" class="form-check-input" id="4899203" value="4899203" <?php if($xin_system['auth_background']=='4899203'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="4899203"><a href="<?= base_url();?>/public/assets/images/auth/4899203.jpg" data-lightbox="roadtrip"><img src="<?= base_url();?>/public/assets/images/auth/4899203.jpg" for="4899203" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6">
                    <div class="form-check form-check-inline me-md-3 me-0">
                        <input type="radio" name="auth_background" class="form-check-input" id="4859203" value="4859203" <?php if($xin_system['auth_background']=='4859203'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="4859203"><a href="<?= base_url();?>/public/assets/images/auth/4859203.jpg" data-lightbox="roadtrip"><img src="<?= base_url();?>/public/assets/images/auth/4859203.jpg" for="4859203" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6">
                    <div class="form-check form-check-inline me-md-3 me-0">
                        <input type="radio" name="auth_background" class="form-check-input" id="4904579" value="4904579" <?php if($xin_system['auth_background']=='4904579'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="4904579"><a href="<?= base_url();?>/public/assets/images/auth/4904579.jpg" data-lightbox="roadtrip"><img src="<?= base_url();?>/public/assets/images/auth/4904579.jpg" for="4904579" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6">
                    <div class="form-check form-check-inline me-md-3 me-0">
                        <input type="radio" name="auth_background" class="form-check-input" id="4910284" value="4910284" <?php if($xin_system['auth_background']=='4910284'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="4910284"><a href="<?= base_url();?>/public/assets/images/auth/4910284.jpg" data-lightbox="roadtrip"><img src="<?= base_url();?>/public/assets/images/auth/4910284.jpg" for="4910284" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6">
                    <div class="form-check form-check-inline me-md-3 me-0">
                        <input type="radio" name="auth_background" class="form-check-input" id="4888301" value="4888301" <?php if($xin_system['auth_background']=='4888301'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="4888301"><a href="<?= base_url();?>/public/assets/images/auth/4888301.jpg" data-lightbox="roadtrip"><img src="<?= base_url();?>/public/assets/images/auth/4888301.jpg" for="4888301" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6">
                    <div class="form-check form-check-inline me-md-3 me-0">
                        <input type="radio" name="auth_background" class="form-check-input" id="4910910" value="4910910" <?php if($xin_system['auth_background']=='4910910'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="4910910"><a href="<?= base_url();?>/public/assets/images/auth/4910910.jpg" data-lightbox="roadtrip"><img src="<?= base_url();?>/public/assets/images/auth/4910910.jpg" for="4910910" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6">
                    <div class="form-check form-check-inline me-md-3 me-0">
                        <input type="radio" name="auth_background" class="form-check-input" id="4914544" value="4914544" <?php if($xin_system['auth_background']=='4914544'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="4914544"><a href="<?= base_url();?>/public/assets/images/auth/4914544.jpg" data-lightbox="roadtrip"><img src="<?= base_url();?>/public/assets/images/auth/4914544.jpg" for="4914544" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6">
                    <div class="form-check form-check-inline me-md-3 me-0">
                        <input type="radio" name="auth_background" class="form-check-input" id="4915973" value="4915973" <?php if($xin_system['auth_background']=='4915973'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="4915973"><a href="<?= base_url();?>/public/assets/images/auth/4915973.jpg" data-lightbox="roadtrip"><img src="<?= base_url();?>/public/assets/images/auth/4915973.jpg" for="4915973" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6">
                    <div class="form-check form-check-inline me-md-3 me-0">
                        <input type="radio" name="auth_background" class="form-check-input" id="4931302" value="4931302" <?php if($xin_system['auth_background']=='4931302'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="4931302"><a href="<?= base_url();?>/public/assets/images/auth/4931302.jpg" data-lightbox="roadtrip"><img src="<?= base_url();?>/public/assets/images/auth/4931302.jpg" for="4931302" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a></label>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-sm-4 col-6">
                    <div class="form-check form-check-inline me-md-3 me-0">
                        <input type="radio" name="auth_background" class="form-check-input" id="2456057" value="2456057" <?php if($xin_system['auth_background']=='2456057'):?> checked="checked" <?php endif;?>>
                        <label class="form-check-label" for="2456057"><a href="<?= base_url();?>/public/assets/images/auth/2456057.jpg" data-lightbox="roadtrip"><img src="<?= base_url();?>/public/assets/images/auth/2456057.jpg" for="2456057" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a></label>
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
    <div class="tab-pane fade" id="account-system-logos" role="tabpanel" aria-labelledby="account-system-logos-tab">
      <div class="card">
        <div class="card-header">
          <h5><i data-feather="image" class="icon-svg-primary wid-20"></i><span class="p-l-5">
            <?= lang('Main.xin_system_logos');?>
            </span></h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-xl-12">
              <div class="nav-tabs-top mb-4">
                <ul class="nav nav-tabs system-logos-col">
                  <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#xin_system_logos">
                    <?= lang('Main.xin_system_logos');?>
                    </a> </li>
                  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#xin_theme_frontend_logo_title">
                    <?= lang('Main.xin_theme_frontend_logo_title');?>
                    </a> </li>
                  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#xin_payslip_invoice_logo_title">
                    <?= lang('Main.xin_payslip_invoice_logo_title');?>
                    </a> </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade active show" id="xin_system_logos">
                    <div class="card-body px-0">
                      <div class="row  mb-4">
                        <div class="col-md-6">
                          <?php $attributes = array('name' => 'logo_info', 'id' => 'logo_info', 'autocomplete' => 'off');?>
                          <?php $hidden = array('company_logo' => 'UPDATE');?>
                          <?= form_open_multipart('erp/settings/add_logo', $attributes, $hidden);?>
                          <label for="logo">
                            <?= lang('Main.xin_system_logos');?>
                            <span class="text-danger">*</span> </label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="logo_file">
                            <label class="custom-file-label"><?= lang('Main.xin_choose_file');?></label>
                            <div class="mt-3">
                              <?php if($xin_system['logo']!='' && $xin_system['logo']!='no file') {?>
                              <img src="<?= base_url().'/public/uploads/logo/'.$xin_system['logo'];?>" width="70px" style="margin-left:30px;" id="u_file_1">
                              <?php } else {?>
                              <img src="<?= base_url().'/public/uploads/logo/no_logo.png';?>" width="70px" style="margin-left:30px;" id="u_file_1">
                              <?php } ?>
                            </div>
                            <div class="mt-3"> <small>-
                              <?= lang('Main.xin_logo_files_only');?>
                              </small><br />
                              <small>-
                              <?= lang('Main.xin_best_main_logo_size');?>
                              </small><br />
                              <small>-
                              <?= lang('Main.xin_logo_whit_background_light_text');?>
                              </small></div>
                          </div>
                          <div class="card-footer text-right px-md-3 px-0">
                            <button type="submit" class="btn btn-primary">
                            <?= lang('Main.xin_save');?>
                            </button>
                          </div>
                          <?= form_close(); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                          <?php $attributes = array('name' => 'logo_favicon', 'id' => 'logo_favicon', 'autocomplete' => 'off');?>
                          <?php $hidden = array('company_logo' => 'UPDATE');?>
                          <?= form_open_multipart('erp/settings/add_favicon', $attributes, $hidden);?>
                          <label for="logo">
                            <?= lang('Main.xin_favicon');?>
                            <span class="text-danger">*</span> </label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="favicon">
                            <label class="custom-file-label"><?= lang('Main.xin_choose_file');?></label>
                            <div class="mt-3">
                              <?php if($xin_system['favicon']!='' && $xin_system['favicon']!='no file') {?>
                              <img src="<?= base_url().'/public/uploads/logo/favicon/'.$xin_system['favicon'];?>" width="16px" style="margin-left:30px;" id="favicon1">
                              <?php } else {?>
                              <img src="<?= base_url().'/public/uploads/logo/no_logo.png';?>" width="16px" style="margin-left:30px;" id="favicon1">
                              <?php } ?>
                            </div>
                            <div class="mt-3"> <small>-
                              <?= lang('Main.xin_logo_files_only_favicon');?>
                              </small><br />
                              <small>-
                              <?= lang('Main.xin_best_logo_size_favicon');?>
                              </small></div>
                          </div>
                          <div class="card-footer text-right px-md-3 px-0">
                            <button type="submit" class="btn btn-primary">
                            <?= lang('Main.xin_save');?>
                            </button>
                          </div>
                          <?= form_close(); ?>
                        </div>
                      </div>
                      <div class="alert alert-primary" role="alert">
							<strong><?= lang('Main.xin_note');?></strong> <?= lang('Main.xin_favicon_will_use_for_bk_frntend');?>
						</div>
                    </div>
                    
                  </div>
                  <div class="tab-pane fade" id="xin_theme_frontend_logo_title">
                    
                      <?php $attributes = array('name' => 'ifrontend_logo', 'id' => 'frontend_logo', 'autocomplete' => 'off');?>
                      <?php $hidden = array('company_logo' => 'UPDATE');?>
                      <?= form_open_multipart('erp/settings/add_frontend_logo', $attributes, $hidden);?>
                      <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 mb-4">
                          <label for="logo">
                            <?= lang('Main.xin_logo');?>
                            <span class="text-danger">*</span> </label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="frontend_logo">
                            <label class="custom-file-label"><?= lang('Main.xin_choose_file');?></label>
                            <div class="mt-3">
                              <?php if($xin_system['frontend_logo']!='' && $xin_system['frontend_logo']!='no file') {?>
                              <img src="<?= base_url().'/public/uploads/logo/frontend/'.$xin_system['frontend_logo'];?>" width="70px" style="margin-left:30px;" id="u_file3">
                              <?php } else {?>
                              <img src="<?= base_url().'/public/uploads/logo/no_logo.png';?>" width="70px" style="margin-left:30px;" id="u_file3">
                              <?php } ?>
                            </div>
                            <div class="mt-3"> <small>-
                              <?= lang('Main.xin_logo_files_only');?>
                              </small></div>
                            <div> <small>-
                              <?= lang('Main.xin_best_signlogo_size');?>
                              </small></div>
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
                  <div class="tab-pane fade" id="xin_payslip_invoice_logo_title">
                    
                      <?php $attributes = array('name' => 'iother_logo', 'id' => 'other_logo', 'autocomplete' => 'off');?>
                      <?php $hidden = array('company_logo' => 'UPDATE');?>
                      <?= form_open_multipart('erp/settings/add_other_logo', $attributes, $hidden);?>
                      <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 mb-4">
                          <label for="logo">
                            <?= lang('Main.xin_logo');?>
                            <span class="text-danger">*</span> </label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="other_logo">
                            <label class="custom-file-label"><?= lang('Main.xin_choose_file');?></label>
                            <div class="mt-3">
                              <?php if($xin_system['other_logo']!='' && $xin_system['other_logo']!='no file') {?>
                              <img src="<?= base_url().'/public/uploads/logo/other/'.$xin_system['other_logo'];?>" width="70px" style="margin-left:30px;" id="u_file3">
                              <?php } else {?>
                              <img src="<?= base_url().'/public/uploads/logo/no_logo.png';?>" width="70px" style="margin-left:30px;" id="u_file3">
                              <?php } ?>
                            </div>
                            <div class="mt-3"> <small>-
                              <?= lang('Main.xin_logo_dark_background_text');?>
                              </small></div>
                            <div> <small>-
                              <?= lang('Main.xin_logo_files_only');?>
                              </small></div>
                            <div> <small>-
                              <?= lang('Main.xin_best_signlogo_size');?>
                              </small></div>
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
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="account-payment" role="tabpanel" aria-labelledby="account-payment-tab">
      <div class="card">
        <div class="card-header">
          <h5> <i data-feather="credit-card" class="icon-svg-primary wid-20"></i><span class="p-l-5">
            <?= lang('Main.xin_acc_payment_gateway');?>
            </span> <small class="text-muted d-block m-l-25 m-t-5"><?= lang('Main.xin_change_payment_gateway_settings');?></small> </h5>
        </div>
          <?php $attributes = array('name' => 'payment_gateway', 'id' => 'payment_gateway', 'autocomplete' => 'off');?>
          <?php $hidden = array('u_company_info' => 'UPDATE');?>
          <?= form_open('erp/settings/update_payment_gateway', $attributes, $hidden);?>
          <div class="card-body">
          <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-paypal_info-tab" data-toggle="pill" href="#pills-paypal_info" role="tab" aria-controls="pills-paypal_info" aria-selected="true"><?= lang('Main.xin_paypal_title');?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-stripe_info-tab" data-toggle="pill" href="#pills-stripe_info" role="tab" aria-controls="pills-stripe_info" aria-selected="false"><?= lang('Main.xin_stripe_title');?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-razorpay_info-tab" data-toggle="pill" href="#pills-razorpay_info" role="tab" aria-controls="pills-razorpay_info" aria-selected="false"><?= lang('Main.xin_razorpay_title');?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-paystack_info-tab" data-toggle="pill" href="#pills-paystack_info" role="tab" aria-controls="pills-paystack_info" aria-selected="false"><?= lang('Main.xin_paystack_title');?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-flutterwave-tab" data-toggle="pill" href="#pills-flutterwave" role="tab" aria-controls="pills-flutterwave" aria-selected="false"><?= lang('Main.xin_flutterwave_title');?></a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-paypal_info" role="tabpanel" aria-labelledby="pills-paypal_info-tab">
                <div class="form-sm-row row">
                <div class="col-md-6">
                	<div class="form-group">
                    <label class="">
                      <?= lang('Main.xin_acc_paypal_email');?>
                     </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_acc_paypal_email');?>" name="paypal_email" type="text" value="<?= $xin_system['paypal_email'];?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                   <div class="form-group">
                    <label class="">
                      <?= lang('Main.xin_acc_paypal_sandbox_active');?>
                     </label>
                    <select class="form-control" name="paypal_sandbox" data-plugin="select_hrm" data-placeholder="<?= lang('Main.paypal_sandbox_active');?>">
                      <option value="">
                      <?= lang('Main.xin_select_one');?>
                      </option>
                      <option value="yes" <?php if($xin_system['paypal_sandbox'] =='yes'):?> selected="selected"<?php endif;?>>
                      <?= lang('Main.xin_yes');?>
                      </option>
                      <option value="no" <?php if($xin_system['paypal_sandbox'] =='no'):?> selected="selected"<?php endif;?>>
                      <?= lang('Main.xin_no');?>
                      </option>
                    </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                    <label class="">
                      <?= lang('Main.xin_employees_active');?>
                    </label>
                    <select class="form-control" name="paypal_active" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_employees_active');?>">
                      <option value="">
                      <?= lang('Main.xin_select_one');?>
                      </option>
                      <option value="yes" <?php if($xin_system['paypal_active'] =='yes'):?> selected="selected"<?php endif;?>>
                      <?= lang('Main.xin_yes');?>
                      </option>
                      <option value="no" <?php if($xin_system['paypal_active'] =='no'):?> selected="selected"<?php endif;?>>
                      <?= lang('Main.xin_no');?>
                      </option>
                    </select>
                  </div>
                  </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-stripe_info" role="tabpanel" aria-labelledby="pills-stripe_info-tab">
                <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="">
                      <?= lang('Main.xin_acc_stripe_secret_key');?>
                    </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_acc_stripe_secret_key');?>" name="stripe_secret_key" type="text" value="<?= $xin_system['stripe_secret_key'];?>">
                  </div>
                  <div class="form-group">
                    <label class="">
                      <?= lang('Main.xin_acc_stripe_publlished_key');?>
                    </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_acc_stripe_publlished_key');?>" name="stripe_publishable_key" type="text" value="<?= $xin_system['stripe_publishable_key'];?>">
                  </div>
                  <div class="form-group">
                    <label class="">
                      <?= lang('Main.xin_employees_active');?>
                     </label>
                    <select class="form-control" name="stripe_active" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_employees_active');?>">
                      <option value="">
                      <?= lang('Main.xin_select_one');?>
                      </option>
                      <option value="yes" <?php if($xin_system['stripe_active'] =='yes'):?> selected="selected"<?php endif;?>>
                      <?= lang('Main.xin_yes');?>
                      </option>
                      <option value="no" <?php if($xin_system['stripe_active'] =='no'):?> selected="selected"<?php endif;?>>
                      <?= lang('Main.xin_no');?>
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-razorpay_info" role="tabpanel" aria-labelledby="pills-razorpay_info-tab">
            	<div class="alert alert-primary" role="alert">
                    <?= lang('Main.xin_razorpay_only_for_india');?>
                </div>
                <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="">
                      <?= lang('Main.xin_razorpay_keyid');?>
                     </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_razorpay_keyid');?>" name="razorpay_keyid" type="text" value="<?= $xin_system['razorpay_keyid'];?>">
                  </div>
                  <div class="form-group">
                    <label class="">
                      <?= lang('Main.xin_razorpay_key_secret');?>
                    </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_razorpay_key_secret');?>" name="razorpay_key_secret" type="text" value="<?= $xin_system['razorpay_key_secret'];?>">
                  </div>
                  <div class="form-group">
                    <label class="">
                      <?= lang('Main.xin_employees_active');?>
                    </label>
                    <select class="form-control" name="razorpay_active" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_employees_active');?>">
                      <option value="">
                      <?= lang('Main.xin_select_one');?>
                      </option>
                      <option value="yes" <?php if($xin_system['razorpay_active'] =='yes'):?> selected="selected"<?php endif;?>>
                      <?= lang('Main.xin_yes');?>
                      </option>
                      <option value="no" <?php if($xin_system['razorpay_active'] =='no'):?> selected="selected"<?php endif;?>>
                      <?= lang('Main.xin_no');?>
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-paystack_info" role="tabpanel" aria-labelledby="pills-paystack_info-tab">
              <div class="alert alert-primary" role="alert">
                    <?= lang('Main.xin_paystack_only_for_nigeria_info');?>
                </div>
                <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="">
                      <?= lang('Main.xxin_paystack_key_secret');?>
                    </label>
                    <input class="form-control" placeholder="<?= lang('Main.xxin_paystack_key_secret');?>" name="paystack_key_secret" type="text" value="<?= $xin_system['paystack_key_secret'];?>">
                  </div>
                  <div class="form-group">
                    <label class="">
                      <?= lang('Main.xxin_paystack_public_secret');?>
                    </label>
                    <input class="form-control" placeholder="<?= lang('Main.xxin_paystack_public_secret');?>" name="paystack_public_secret" type="text" value="<?= $xin_system['paystack_public_secret'];?>">
                  </div>
                  <div class="form-group">
                    <label class="">
                      <?= lang('Main.xin_employees_active');?>
                     </label>
                    <select class="form-control" name="paystack_active" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_employees_active');?>">
                      <option value="">
                      <?= lang('Main.xin_select_one');?>
                      </option>
                      <option value="yes" <?php if($xin_system['paystack_active'] =='yes'):?> selected="selected"<?php endif;?>>
                      <?= lang('Main.xin_yes');?>
                      </option>
                      <option value="no" <?php if($xin_system['paystack_active'] =='no'):?> selected="selected"<?php endif;?>>
                      <?= lang('Main.xin_no');?>
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-flutterwave" role="tabpanel" aria-labelledby="pills-flutterwave-tab">
            <div class="alert alert-primary" role="alert">
                    <?= lang('Main.xin_flutterwave_only_for_country_info');?>
                </div>	
                <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="">
                      <?= lang('Main.xin_acc_flutterwave_secret_key');?>
                    </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_acc_flutterwave_secret_key');?>" name="flutterwave_secret_key" type="text" value="<?= $xin_system['flutterwave_secret_key'];?>">
                  </div>
                  <div class="form-group">
                    <label class="">
                      <?= lang('Main.xin_acc_flutterwave_public_key');?>
                    </label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_acc_flutterwave_public_key');?>" name="flutterwave_public_key" type="text" value="<?= $xin_system['flutterwave_public_key'];?>">
                  </div>
                  <div class="form-group">
                    <label class="">
                      <?= lang('Main.xin_employees_active');?>
                     </label>
                    <select class="form-control" name="flutterwave_active" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_employees_active');?>">
                      <option value="">
                      <?= lang('Main.xin_select_one');?>
                      </option>
                      <option value="yes" <?php if($xin_system['flutterwave_active'] =='yes'):?> selected="selected"<?php endif;?>>
                      <?= lang('Main.xin_yes');?>
                      </option>
                      <option value="no" <?php if($xin_system['flutterwave_active'] =='no'):?> selected="selected"<?php endif;?>>
                      <?= lang('Main.xin_no');?>
                      </option>
                    </select>
                  </div>
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
    <div class="tab-pane fade" id="account-notification" role="tabpanel" aria-labelledby="account-notification-tab">
      <div class="card">
        <div class="card-header">
          <h5><i data-feather="crosshair" class="icon-svg-primary wid-20"></i><span class="p-l-5">
            <?= lang('Main.xin_notification_position');?>
            </span></h5>
        </div>
        
          <?php $attributes = array('name' => 'notification_position_info', 'id' => 'notification_position_info', 'autocomplete' => 'off');?>
          <?php $hidden = array('theme_info' => 'UPDATE');?>
          <?= form_open('erp/settings/notification_position_info', $attributes, $hidden);?>
          <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="">
                  <?= lang('Main.dashboard_position');?>
                  <span class="text-danger">*</span> </label>
                <select class="form-control" name="notification_position" data-plugin="select_hrm" data-placeholder="<?= lang('Main.dashboard_position');?>">
                  <option value="">
                  <?= lang('Main.xin_select_one');?>
                  </option>
                  <option value="toast-top-right" <?php if($xin_system['notification_position']=='toast-top-right'){?> selected <?php }?>>
                  <?= lang('Main.xin_top_right');?>
                  </option>
                  <option value="toast-bottom-right" <?php if($xin_system['notification_position']=='toast-bottom-right'){?> selected <?php }?>>
                  <?= lang('Main.xin_bottom_right');?>
                  </option>
                  <option value="toast-bottom-left" <?php if($xin_system['notification_position']=='toast-bottom-left'){?> selected <?php }?>>
                  <?= lang('Main.xin_bottom_left');?>
                  </option>
                  <option value="toast-top-left" <?php if($xin_system['notification_position']=='toast-top-left'){?> selected <?php }?>>
                  <?= lang('Main.xin_top_left');?>
                  </option>
                  <option value="toast-top-center" <?php if($xin_system['notification_position']=='toast-top-center'){?> selected <?php }?>>
                  <?= lang('Main.xin_top_center');?>
                  </option>
                </select>
                <br />
                <small class="text-muted"><i class="ft-arrow-up"></i>
                <?= lang('Main.xin_set_position_for_notifications');?>
                </small> </div>
            </div>
           </div>
           <hr class="pb-3">
            <h6 class="mb-lg-4 mb-2"><?= lang('Main.xin_close_button');?></h6>
            <div class="custom-control custom-switch d-flex">
                <input type="checkbox" class="custom-control-input mt-1 me-1" id="notification_close" name="notification_close" <?php if($xin_system['notification_close_btn']=='true'):?> checked="checked" <?php endif;?> value="true">
                <label class="custom-control-label" for="notification_close"><?= lang('Main.xin_enable_notification_close_btn');?></label>
            </div>
            <hr class="pb-3">
            <h6 class="mb-lg-4 mb-2"><?= lang('Main.xin_progress_bar');?></h6>
            <div class="custom-control custom-switch d-flex">
                <input type="checkbox" class="custom-control-input mt-1 me-1" id="notification_bar" name="notification_bar" <?php if($xin_system['notification_bar']=='true'):?> checked="checked" <?php endif;?> value="true">
                <label class="custom-control-label" for="notification_bar"><?= lang('Main.xin_enable_notification_bar');?></label>
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
    <div class="tab-pane fade" id="user-set-email" role="tabpanel" aria-labelledby="user-set-email-tab">
      <div class="card">
        <div class="card-header">
          <h5><i data-feather="mail" class="icon-svg-primary wid-20"></i><span class="p-l-5">
            <?= lang('Main.xin_email_notifications');?>
            </span></h5>
        </div>
          <?php $attributes = array('name' => 'email_info', 'id' => 'email_info', 'autocomplete' => 'off');?>
          <?php $hidden = array('u_basic_info' => 'UPDATE');?>
          <?= form_open('erp/settings/email_info', $attributes, $hidden);?>
          <div class="card-body">
          <div class="bg-white">
          <div class="row">
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label class="">
                    <?= lang('Main.xin_mail_type_config');?>
                    <span class="text-danger">*</span> </label>
                  <select class="form-control email_type" name="email_type" id="email_type" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_mail_type_config');?>">
                    <option value="codeigniter" <?php if($xin_system['email_type'] == 'codeigniter'):?> selected="selected"<?php endif;?>>CodeIgniter v4 Mail()</option>
                    <option value="phpmail" <?php if($xin_system['email_type'] == 'phpmail'):?> selected="selected"<?php endif;?>>PHP Mail()</option>
                    <option value="smtp" <?php if($xin_system['email_type'] == 'smtp'):?> selected="selected"<?php endif;?>><?= lang('Main.xin_mail_smtp_configuration');?></option>
                  </select>
                </div>
              </div>
            </div>
            <?php if($xin_system['email_type'] == 'smtp'): $sm_opt = '';  else: $sm_opt = 'style="display:none;"'; endif;?>
            <div id="smtp_options" <?php echo $sm_opt;?>>
            <div class="alert alert-primary" role="alert">
            	<?= lang('Main.xin_mail_smtp_detail');?>
            </div>
            <div class="row" >
            	<div class="col-md-4">
                    <div class="form-group">
                    <label for="smtp_host"><?php echo lang('Main.xin_mail_smtp_host');?></label>
                    <input class="form-control" placeholder="<?php echo lang('Main.xin_mail_smtp_host');?>" name="smtp_host" type="text" value="<?= $email_config['smtp_host'];?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="smtp_username"><?php echo lang('Main.xin_mail_smtp_username');?></label>
                    <input class="form-control" placeholder="<?php echo lang('Main.xin_mail_smtp_username');?>" name="smtp_username" type="text" value="<?= $email_config['smtp_username'];?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="smtp_password"><?php echo lang('Main.xin_mail_smtp_password');?></label>
                    <input class="form-control" placeholder="<?php echo lang('Main.xin_mail_smtp_password');?>" name="smtp_password" type="password" value="<?= $email_config['smtp_password'];?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="smtp_port"><?php echo lang('Main.xin_mail_smtp_port');?></label>
                    <input class="form-control" placeholder="<?php echo lang('Main.xin_mail_smtp_port');?>" name="smtp_port" type="text" value="<?= $email_config['smtp_port'];?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="smtp_secure"><?php echo lang('Main.xin_mail_smtp_secure');?></label>
                    <select class="form-control" name="smtp_secure" data-plugin="select_hrm" data-placeholder="<?php echo lang('Main.xin_mail_smtp_secure');?>">
                    <option value="tls"<?php if($email_config['smtp_secure'] == 'tls'):?> selected="selected"<?php endif;?>>TLS</option>
                    <option value="ssl"<?php if($email_config['smtp_secure'] == 'ssl'):?> selected="selected"<?php endif;?>>SSL</option>
                  </select>
                    </div>
                </div>
            </div>
            </div>
              <hr class="pb-3">
                <h6 class="mb-lg-4 mb-2"><?= lang('Main.xin_email_notification_enable');?></h6>
                <div class="custom-control custom-switch d-flex">
                    <input type="checkbox" class="custom-control-input mt-1 me-1" id="email_notification" name="email_notification" <?php if($xin_system['enable_email_notification']==1):?> checked="checked" <?php endif;?> value="1">
                    <label class="custom-control-label" for="email_notification"><?= lang('Main.xin_enable_email_notification');?></label>
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
    <div class="tab-pane fade" id="user-subscription-tax" role="tabpanel" aria-labelledby="user-subscription-tax-tab">
      <div class="card">
        <div class="card-header">
          <h5><i data-feather="align-justify" class="icon-svg-primary wid-20"></i><span class="p-l-5">
            <?= lang('Users.xin_subscription_tax');?>
            </span></h5>
        </div>
          <?php $attributes = array('name' => 'subscription_tax', 'id' => 'subscription_tax', 'autocomplete' => 'off');?>
          <?php $hidden = array('u_basic_info' => 'UPDATE');?>
          <?= form_open('erp/settings/update_subscription_tax', $attributes, $hidden);?>
          <div class="card-body">
          <div class="bg-white">
          <div class="row">
              <div class="col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label class="">
                    <?= lang('Dashboard.xin_invoice_tax_type');?>
                    <span class="text-danger">*</span> </label>
                  <select class="form-control" name="tax_type" id="tax_type" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.xin_invoice_tax_type');?>">
                    <?php foreach($subscription_tax as $_tax) { ?>
						<?php
                       if($_tax['field_two']=='percentage') {
                            $_tax_type = $_tax['field_one'].'%';
                        } else {
                            $_tax_type = number_to_currency($_tax['field_one'], $xin_system['default_currency'],null,2);
                        }
                        ?>
                    <option value="<?= $_tax['constants_id'];?>" <?php if($xin_system['tax_type'] == $_tax['constants_id']):?> selected="selected"<?php endif;?>>
					<?= $_tax['category_name'];?> (<?= $_tax_type;?>)</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
              <hr class="pb-3">
                <h6 class="mb-lg-4 mb-2"><?= lang('Users.xin_enable_tax');?></h6>
                <div class="custom-control custom-switch d-flex">
                    <input type="checkbox" class="custom-control-input mt-1 me-1" id="enable_tax" name="enable_tax" <?php if($xin_system['enable_tax']==1):?> checked="checked" <?php endif;?> value="1">
                    <label class="custom-control-label" for="enable_tax"><?= lang('Users.xin_enable_tax_details');?></label>
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
    <div class="tab-pane fade" id="user-set-theme" role="tabpanel" aria-labelledby="user-set-theme-tab">
      <div class="card">
        <div class="card-header">
          <h5><i data-feather="layout" class="icon-svg-primary wid-20"></i><span class="p-l-5">
            <?= lang('Main.xin_theme_settings');?>
            </span></h5>
        </div>
        <?php $attributes = array('name' => 'layout_info', 'id' => 'layout_info', 'autocomplete' => 'off');?>
        <?php $hidden = array('token' => 'Layout');?>
        <?= form_open('erp/settings/layout_info', $attributes, $hidden);?>
        <div class="card-body">
          <div class="bg-white">
            <div class="row">
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label class="">
                    <?= lang('Main.xin_header_background');?>
                    <span class="text-danger">*</span> </label>
                  <select class="form-control header-color" name="header_background" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_header_background');?>">
                    <option data-value="bg-default" value="bg-default" <?php if($xin_system['header_background'] == 'bg-default'):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_white');?>
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label class="">
                    <?= lang('Main.xin_login_page_version');?>
                    <span class="text-danger">*</span> </label>
                  <select class="form-control" name="login_page" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_login_page_version');?>">
                    <option value="1" <?php if($xin_system['login_page'] == '1'):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_login_page1');?>
                    </option>
                    <option value="2" <?php if($xin_system['login_page'] == '2'):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_login_page2');?>
                    </option>
                    <option value="3" <?php if($xin_system['login_page'] == '3'):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_login_page3');?>
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="form-group">
                  <label class="">
                    <?= lang('Main.xin_system_template');?>
                    <span class="text-danger">*</span> </label>
                  <select class="form-control" name="template_option" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_system_template');?>">
                    <option value="1" <?php if($xin_system['template_option'] == '1'):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_system_template1');?>
                    </option>
                    <option value="0" <?php if($xin_system['template_option'] == '0'):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_system_template2');?>
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <div class="custom-control custom-switch d-flex">
                    <input type="checkbox" class="custom-control-input mt-1 me-1" name="light_sidebar" id="cust-sidebar" <?php if($xin_system['light_sidebar']==1):?> checked="checked" <?php endif;?> value="1">
                    <label class="custom-control-label f-w-600 pl-1" for="cust-sidebar"><?= lang('Main.xin_light_sidebar');?></label>
                </div>
                </div>
              </div>
              
              <div class="col-md-12">
                <div class="form-group">
                  <label class="">
                    <?= lang('Main.xin_login_page_text');?>
                    <span class="text-danger">*</span> </label>
                  	<textarea class="form-control" name="login_page_text" rows="4"><?= $xin_system['login_page_text'];?></textarea>
                    <small><?= lang('Main.xin_login_page_text_desc');?></small>
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
  </div>
</div>
<?php } ?>
