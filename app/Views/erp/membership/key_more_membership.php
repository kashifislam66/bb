<?php
use App\Models\ConstantsModel;
use App\Models\CountryModel;
use App\Models\MembershipModel;
use App\Models\CompanymembershipModel;
use App\Models\MainModel;
use App\Models\UsersModel;
use App\Models\SystemModel;

$ConstantsModel = new ConstantsModel();
$CountryModel = new CountryModel();
$MembershipModel = new MembershipModel();
$MainModel = new MainModel();
$UsersModel = new UsersModel();
$SystemModel = new SystemModel();
$CompanymembershipModel = new CompanymembershipModel();

$company_types = $ConstantsModel->where('type','company_type')->orderBy('constants_id', 'ASC')->findAll();
$all_countries = $CountryModel->orderBy('country_id', 'ASC')->findAll();
$membership_plans = $MembershipModel->orderBy('membership_id', 'ASC')->findAll();
/* Company Details view
*/		
$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
//$segment_id = $request->uri->getSegment(3);
$field_id = $usession['sup_user_id'];//udecode($segment_id);
/////
$xin_system = erp_company_settings();
$xin_super_system = $SystemModel->where('setting_id', 1)->first();
$result = $UsersModel->where('user_id', $field_id)->first();
$company_membership = $CompanymembershipModel->where('company_id', $field_id)->first();
if($result['is_active'] == 1){
	$status = '<span class="text-success"><em class="fas fa-check-circle"></em> '.lang('Main.xin_employees_active').'</span>';
} else {
	$status = '<span class="text-danger"><em class="fas fa-check-circle"></em> '.lang('Main.xin_employees_inactive').'</span>';
}
?>
<?php $subs_plan = $MembershipModel->where('membership_id', $company_membership['membership_id'])->first(); ?>
<?php
$membership = $MembershipModel->orderBy('membership_id', 'ASC')->paginate(8);
$pager = $MembershipModel->pager;
?>
<?php if($session->get('paypal_payment_error_status')){?>

<div class="alert alert-danger alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <?= $session->get('paypal_payment_error_status');?>
</div>
<?php } ?>
<div class="row">
    <div class="col-sm-12">
        <div class="row justify-content-center text-center">
            <div class="col-xl-8 col-md-10">
                <h2 class="mt-2">
                    <?= lang('Membership.xin_membership_plans');?>
                </h2>
                <p class="my-4">
                <?= lang('Membership.xin_subscription_list_text1');?></p>                        
            </div>
        </div>
    </div>
</div>
<div class="row text-center">
<?php foreach($membership as $plans) {?>
	<?php
    if($plans['plan_duration']==1){
        $plan_duration = lang('Membership.xin_subscription_monthly');
    } else if($plans['plan_duration']==2){
        $plan_duration = lang('Membership.xin_subscription_yearly');
    } else if($plans['plan_duration']==4){
        $plan_duration = lang('Main.xin_plan_weekly');
    } else if($plans['plan_duration']==5){
        $plan_duration = lang('Main.xin_14days');
    } else {
        $plan_duration = lang('Main.xin_plan_lifetime');
    }
    ?>
    <div class="col-xl-3 col-lg-4 col-sm-4">
    	<div class="card">
            <div class="card-body text-center">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="<?= $plans['membership_id'];?>"><img src="<?= base_url();?>/public/assets/images/pages/<?= $plans['plan_icon'];?>" for="<?= $plans['membership_id'];?>" class="img-fluid m-b-10 img-thumbnail bg-white" alt="" width="200"></label>
                </div>
                <p class="mb-0 text-muted"><strong><?= number_to_currency($plans['price'], $xin_system['default_currency'],null,2);?> <?= $plans['membership_type'];?></strong></p>
                <p class="mb-0 text-muted"><?= $plan_duration;?></p>
                <hr>
                <a href="#!" class="btn btn-outline-success btn-sm delete" data-toggle="modal" data-target=".view-modal-data" data-field_id="<?= uencode($plans['membership_id']);?>">
                <?= lang('Main.xin_view_details');?></a>
                <?php if($company_membership['membership_id'] == $plans['membership_id']){ ?>
                <a  href="#!" class="btn btn-sm disabled btn-secondary"><?= lang('Membership.xin_current_plan');?></a>
                <?php } else if($plans['membership_id'] == 1) {?>
                <?php } else { ?>
                <a  href="<?= site_url('erp/upgrade-subscription/').uencode($plans['membership_id']);?>" class="btn btn-sm btn-outline-primary"><?= lang('Dashboard.dashboard_upgrade');?></a>
                <?php } ?>
            </div>
    	</div>
    </div>
<?php } ?>
</div>
