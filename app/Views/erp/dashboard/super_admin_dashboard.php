<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\CountryModel;
use App\Models\MembershipModel;
use App\Models\InvoicepaymentsModel;
use App\Models\CompanymembershipModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$CountryModel = new CountryModel();

$InvoicepaymentsModel = new InvoicepaymentsModel();
$CompanymembershipModel = new CompanymembershipModel();
$MembershipModel = new MembershipModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$xin_system = $SystemModel->where('setting_id', 1)->first();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
$total_companies = $UsersModel->where('user_type','company')->countAllResults();
$active_companies = $UsersModel->where('user_type','company')->where('is_active',1)->countAllResults();
$inactive_companies = $UsersModel->where('user_type','company')->where('is_active',2)->countAllResults();
$total_membership = $MembershipModel->orderBy('membership_id', 'ASC')->countAllResults();
$get_invoices = $InvoicepaymentsModel->orderBy('membership_invoice_id','DESC')->findAll(10);
///
$membership_col3 = $MembershipModel->orderBy('membership_id', 'ASC')->findAll(5);
$membership_count = $CompanymembershipModel->orderBy('membership_id', 'ASC')->countAllResults();
$companies = $UsersModel->where('user_type', 'company')->orderBy('user_id', 'DESC')->findAll(3);
?>

<div class="row">
  <div class="col-xl-3 col-md-6">
    <div class="card feed-card">
      <div class="card-body p-0">
        <div class="row mx-0">
          <div class="col-4 bg-primary border-feed"> <i class="feather icon-user-plus f-40"></i> </div>
          <div class="col-8">
            <div class="p-t-25 p-b-25">
              <h2 class="f-w-400 m-b-10">
                <?= $total_companies;?>
              </h2>
              <p class="text-muted m-0">
                <?= lang('Main.xin_total');?>
                <span class="text-primary f-w-400">
                <?= lang('Company.xin_small_text_companies');?>
                </span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6">
    <div class="card feed-card">
      <div class="card-body p-0">
        <div class="row mx-0">
          <div class="col-4 bg-success border-feed"> <i class="feather icon-user-check f-40"></i> </div>
          <div class="col-8">
            <div class="p-t-25 p-b-25">
              <h2 class="f-w-400 m-b-10">
                <?= $active_companies;?>
              </h2>
              <p class="text-muted m-0"><?= lang('Main.xin_employees_active');?> <span class="text-success f-w-400">
                <?= lang('Company.xin_small_text_companies');?>
                </span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6">
    <div class="card feed-card">
      <div class="card-body p-0">
        <div class="row mx-0">
          <div class="col-4 bg-danger border-feed"> <i class="feather icon-user-minus f-40"></i> </div>
          <div class="col-8">
            <div class="p-t-25 p-b-25">
              <h2 class="f-w-400 m-b-10">
                <?= $inactive_companies;?>
              </h2>
              <p class="text-muted m-0"><?= lang('Main.xin_employees_inactive');?> <span class="text-danger f-w-400">
                <?= lang('Company.xin_small_text_companies');?>
                </span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6">
    <div class="card feed-card">
      <div class="card-body p-0">
        <div class="row mx-0">
          <div class="col-4 bg-warning border-feed"> <i class="feather icon-users f-40"></i> </div>
          <div class="col-8">
            <div class="p-t-25 p-b-25">
              <h2 class="f-w-400 m-b-10">
                <?= $total_membership;?>
              </h2>
              <p class="text-muted m-0">
                <?= lang('Main.xin_total');?>
                <span class="text-warning f-w-400">
                <?= lang('Membership.xin_small_text_memberships');?>
                </span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-6 col-md-12">
    <div class="card">
    	<div class="card-header">
            <h5><?= lang('Membership.xin_membership_report');?></h5>
        </div>
        <div class="card-body">
            <div class="row mt-0">
            	<?php $col3_clr = array('text-success','text-danger','text-primary','text-warning','text-info','text-primary');?>
                <?php $i=0; foreach($membership_col3 as $mcol3):?>
                <div class="col-sm-6 m-b-2">
                	
                    <span class="d-block"><i class="fas fa-circle <?= $col3_clr[$i];?> f-10 m-r-10"></i><?= $mcol3['membership_type'];?></span>
                    
                </div>
                <?php $i++; endforeach;?>
            </div>
            <div class="progress mt-3" style="height:20px;">
            	<?php $col3_clrbg = array('badge-light-success','badge-light-danger','badge-light-primary','badge-light-warning','badge-light-info','badge-light-primary');?>
            	<?php
                	$j=0; foreach($membership_col3 as $mcol3):
					$comp_count = $CompanymembershipModel->where('membership_id',$mcol3['membership_id'])->countAllResults();
					if($comp_count == 1){
						$suser = lang('Users.xin_user');
					} else {
						$suser = lang('Users.xin_users');
					}
					$plan_user = $comp_count.' '.$suser;
				?>
                <div class="progress-bar <?= $col3_clrbg[$j];?> rounded" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"><?= $plan_user;?></div>
                <?php $j++; endforeach;?>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5><?= lang('Membership.xin_membership_by_country');?></h5>
        </div>
        <div class="card-body w-100">
            <?php $col3_country = array('bg-primary','bg-warning','bg-success','bg-warning','bg-info','bg-primary','bg-danger','bg-warning','bg-success');?>
            <?php
				$ccget_data = $CountryModel->orderBy('country_id', 'ASC')->findAll();
				$company_count = $UsersModel->where('user_type','company')->countAllResults();
				$k=0; foreach($ccget_data as $cplan){
					$comp_count = $UsersModel->where('country',$cplan['country_id'])->where('user_type','company')->countAllResults();
					if($comp_count > 0){
					$cal_data = $comp_count / $company_count * 100;
					$ical_data = round($cal_data, 1);
				?>
                <div class="card-progress p-t-10">
                    <div class="row ">
                        <div class="col-sm-4 text-sm-right">
                            <label class="text-muted "><?= $cplan['country_name'];?></label>
                        </div>
                        <div class="col-sm-6 col">
                            <div class="progress">
                                <div class="progress-bar <?= $col3_country[$k];?> " style="width:<?= $ical_data;?>%"></div>
                            </div>
                        </div>
                        <div class="col-sm-2 col-auto">
                            <label class="text-muted "><?= $ical_data;?>%</label>
                        </div>
                    </div>
                </div>
            	<?php $k++; } ?>
            <?php } ?>
        </div>
    </div>
    <div class="row mb-n4">
		<?php $l=0; foreach($companies as $r) {?>
        <?php
		if($l==0){
			$txt_info = 'Recent Companies';
			$txt_align = 'text-left';
		} else if($l==1){
			$txt_info = '&nbsp;';
			$txt_align = 'text-left d-md-block d-none';
		} else {
			$txt_info = 'View all';
			$txt_align = 'text-lg-right';
		}
		?>	
        <div class="col-xl-4 col-md-6">
            <h6 class="<?= $txt_align;?> mb-3"><?= $txt_info;?></h6>
            <div class="card user-card user-card-3 support-bar1">
                <div class="card-body ">
                    <div class="text-center">
                        <img class="img-radius img-fluid wid-100" src="<?= staff_profile_photo($r['user_id']);?>" alt="">
                        <h5 class="mb-0 mt-2 f-w-400">
						<a href="<?= site_url('erp/company-detail/').uencode($r['user_id']);?>"><?= $r['company_name'];?></a></h5>
                    </div>
                </div>
            </div>
        </div>        
		<?php $l++;} ?>
     </div>
  </div>
  <div class="col-xl-6 col-md-12 mt-lg-0 mt-4">
    <div class="card review-project">
        <div class="card-header">
            <h5>
			<?= lang('Membership.xin_subscription_invoice_report');?></h5>
        </div>
        <div class="sale-scroll" style="position:relative;">
        <div class="card-body">
            <h2><?= number_to_currency(total_membership_payments(), $xin_system['default_currency'],null,2);?></h2>
            <p class="text-muted m-b-10"><?= lang('Main.xin_total_revenue');?></p>
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <p class="text-success f-16 m-0 f-w-900"><?= number_to_currency(company_sales_amount_current_month(), $xin_system['default_currency'],null,2);?></p>
                    <span class="text-muted">This Month</span>
                </div>
                <div class="col-sm-4 col-xs-12 mt-sm-0 mt-3">
                    <p class="text-info f-16 m-0 f-w-900"><?= number_to_currency(company_sales_amount_last_month(), $xin_system['default_currency'],null,2);?></p>
                    <span class="text-muted">Last Month</span>
                </div>
                <div class="col-sm-4 col-xs-12 mt-sm-0 mt-3">
                    <p class="text-primary f-16 m-0 f-w-900"><?= number_to_currency(company_sales_amount_this_year(), $xin_system['default_currency'],null,2);?></p>
                    <span class="text-muted">This Year</span>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h5>
          <?= lang('Invoices.xin_last_invoices');?>
        </h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <div class="sale-scroll" style="height:250px;position:relative;">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th><?= lang('Membership.xin_subscription');?></th>
                  <th><?= lang('Main.xin_price');?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($get_invoices as $r){ ?>
                <?php $membership = $MembershipModel->where('membership_id', $r['membership_id'])->first(); ?>
                <?php
				if($r['payment_method'] == 'Stripe'){
					$invoice_url = '<a target="_blank" href="'.$r['receipt_url'].'"><span>'.$r['invoice_id'].'</span></a>';
				} else {
					$invoice_url = '<a target="_blank" href="'.site_url('erp/billing-detail').'/'.uencode($r['membership_invoice_id']).'"><span>'.$r['invoice_id'].'</span></a>';
				}
				?>
                <tr>
                  <td><h6 class="mb-1 text-success">
                      <?= $invoice_url;?>
                    </h6></td>
                  <td><?= $membership['membership_type'];?></td>
                  <td><h6 class="mb-1 text-success">
                      <?= number_to_currency($r['membership_price'], $xin_system['default_currency'],null,2);?>
                    </h6></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
