<?php
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\MainModel;
use App\Models\PayrollModel;
use App\Models\StaffdetailsModel;
use App\Models\StaffaccountsModel;

$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$MainModel = new MainModel();
$PayrollModel = new PayrollModel();
$StaffdetailsModel = new StaffdetailsModel();
$StaffaccountsModel = new StaffaccountsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();



$segment_id = $_REQUEST['account_id'];
$account_id = udecode($segment_id);
$req_month_year = $_REQUEST['M'];
$start_date = $_REQUEST['S'];
$end_date = $_REQUEST['E'];

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$payslip_data = $PayrollModel->where('company_id', $user_info['company_id'])->where('salary_month', $req_month_year)->where('created_at BETWEEN "'. $start_date. '" and "'. $end_date.'"')->findAll();
	$staff_accounts = $StaffaccountsModel->where('company_id',$user_info['company_id'])->where('account_id',$account_id)->orderBy('account_id', 'ASC')->findAll();
	$count_result = $PayrollModel->where('company_id', $user_info['company_id'])->where('salary_month', $req_month_year)->countAllResults();
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
	$payslip_data = $PayrollModel->where('company_id', $usession['sup_user_id'])->where('salary_month', $req_month_year)->where('created_at BETWEEN "'. $start_date. '" and "'. $end_date.'"')->findAll();
	$staff_accounts = $StaffaccountsModel->where('company_id',$usession['sup_user_id'])->where('account_id',$account_id)->orderBy('account_id', 'ASC')->findAll();
	$count_result = $PayrollModel->where('company_id', $usession['sup_user_id'])->where('salary_month', $req_month_year)->countAllResults();
}
$xin_system = erp_company_settings();
?>
<?php
?>
<?php
$date_info = strtotime($req_month_year.'-01');
$imonth_year = explode('-',$req_month_year);
$day = date('d', $date_info);
$month = date($imonth_year[1], $date_info);
$year = date($imonth_year[0], $date_info);

/* Set the date */
$date = date("F, Y", strtotime($req_month_year.'-01'));//strtotime(date("Y-m-d"),$date_info);
// total days in month
$daysInMonth =  date('t');
//$date = strtotime(date("Y-m-d"));
$day = date('d', $date_info);
$month = date('m', $date_info);
$year = date('Y', $date_info);
$month_year = date('Y-m');
$ci_erp_settings = $SystemModel->where('setting_id', 1)->first();
?>

<div class="row justify-content-md-center"> 
  <!-- [ Attendance view ] start -->
  <div class="col-md-10"> 
    <!-- [ Attendance view ] start -->
    <div class="container">
      <div>
        <div class="card" id="printTable">
          <div class="card-header">
            <h5><img class="img-fluid" width="171" height="30" src="<?= base_url();?>/public/uploads/logo/other/<?= $ci_erp_settings['other_logo'];?>" alt=""></h5>
          </div>
          <div class="card-body pb-0">
          <?php if($count_result > 0){?>
          <?php
          	foreach($staff_accounts as $_staffaccount) {
          	$employee_detail = $StaffdetailsModel->where('company_id', $company_id)->where('bank_name', $_staffaccount['account_id'])->first();
			if($employee_detail){
				
			?>
            <div class="row d-pdrint-inline-flex">
              <div class="col-md-6">
                <h5 class="m-b-10 text-primary text-uppercase"><?php echo $date;?></h5>
                  <h6 class="text-uppercase text-success"> <strong>
                  <?= $_staffaccount['account_name'];?>
                  </strong> </h6>
              </div>
            </div>
            
            <div class="row m-b-30">
              <div class="col-sm-12 col-md-12">
                <div class="table-responsive">
                  <table class="table m-b-0 f-14 b-solid requid-table">
                    <thead>
                      <tr class="text-uppercase">
                        <th>Employee</th>
                        <th>Account#</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($payslip_data as $_payslip) { ?>
                      <?php $pay_user = $UsersModel->where('user_id', $_payslip['staff_id'])->first();?>
                      <?php $iemployee_detail = $StaffdetailsModel->where('company_id', $company_id)->where('user_id', $_payslip['staff_id'])->first();?>
                      <?php if($_staffaccount['account_id'] == $iemployee_detail['bank_name']) { ?>
                      <tr>
                        <td width="200"><?= $pay_user['first_name'].' '.$pay_user['last_name'];?></td>
                        <td width="200"><strong class="text-success"><?= $iemployee_detail['account_number'];?></strong></td>
                        <td width="200"><?= number_to_currency($_payslip['net_salary'], $xin_system['default_currency'],null,2);?></td>
                      </tr>
                    <?php } }?> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <?php } }  ?>
            <?php } else {?>
            <div class="alert alert-danger" role="alert">
                <?= lang('Main.xin_no_payslip_found');?>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php if($count_result > 0){?>
        <div class="row text-center d-print-none">
          <div class="col-sm-12 invoice-btn-group text-center">
            <button type="button" class="btn btn-print-invoice waves-effect waves-light btn-success m-b-10">
            <?= lang('Main.xin_print');?>
            </button>
           </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <!-- [ Attendance view ] end --> 
  </div>
</div>
