<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\PayrollModel;
use App\Models\ContractModel;
use App\Models\ConstantsModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\StaffdetailsModel;
use App\Models\PayallowancesModel;
use App\Models\PaycommissionsModel;
use App\Models\PayotherpaymentsModel;
use App\Models\PaystatutorydeductionsModel;

$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$SystemModel = new SystemModel();
$PayrollModel = new PayrollModel();
$ContractModel = new ContractModel();
$ConstantsModel = new ConstantsModel();
$DepartmentModel = new DepartmentModel();
$DesignationModel = new DesignationModel();
$StaffdetailsModel = new StaffdetailsModel();
$PayallowancesModel = new PayallowancesModel();
$PaycommissionsModel = new PaycommissionsModel();
$PayotherpaymentsModel = new PayotherpaymentsModel();
$PaystatutorydeductionsModel = new PaystatutorydeductionsModel();
$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$segment_id = $request->uri->getSegment(3);
$payslip_id = udecode($segment_id);

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$payslip_data = $PayrollModel->where('company_id', $user_info['company_id'])->where('payslip_id', $payslip_id)->first();
	$user_data = $UsersModel->where('company_id', $user_info['company_id'])->where('user_id', $payslip_data['staff_id'])->first();
	// userdata
	$employee_detail = $StaffdetailsModel->where('user_id', $user_data['user_id'])->first();
	$idesignations = $DesignationModel->where('company_id', $user_info['company_id'])->where('designation_id',$employee_detail['designation_id'])->first();
} else {
	$payslip_data = $PayrollModel->where('company_id', $usession['sup_user_id'])->where('payslip_id', $payslip_id)->first();
	$user_data = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_id', $payslip_data['staff_id'])->first();
	// userdata
	$employee_detail = $StaffdetailsModel->where('user_id', $user_data['user_id'])->first();
	$idesignations = $DesignationModel->where('company_id', $usession['sup_user_id'])->where('designation_id',$employee_detail['designation_id'])->first();
}
// salary options
$pay_allowance = $PayallowancesModel->where('payslip_id', $payslip_id)->where('staff_id', $payslip_data['staff_id'])->findAll();
$pay_commission = $PaycommissionsModel->where('payslip_id', $payslip_id)->where('staff_id', $payslip_data['staff_id'])->findAll();
$pay_otherpayment = $PayotherpaymentsModel->where('payslip_id', $payslip_id)->where('staff_id', $payslip_data['staff_id'])->findAll();
$pay_statutory = $PaystatutorydeductionsModel->where('payslip_id', $payslip_id)->where('staff_id', $payslip_data['staff_id'])->findAll();
// salary options || rows count
$count_pay_allowance = $PayallowancesModel->where('payslip_id', $payslip_id)->where('staff_id', $payslip_data['staff_id'])->countAllResults();
$count_pay_commission = $PaycommissionsModel->where('payslip_id', $payslip_id)->where('staff_id', $payslip_data['staff_id'])->countAllResults();
$count_pay_otherpayment = $PayotherpaymentsModel->where('payslip_id', $payslip_id)->where('staff_id', $payslip_data['staff_id'])->countAllResults();
$count_pay_statutory = $PaystatutorydeductionsModel->where('payslip_id', $payslip_id)->where('staff_id', $payslip_data['staff_id'])->countAllResults();
$xin_system = erp_company_settings();
$ci_erp_settings = $SystemModel->where('setting_id', 1)->first();
// company information
$company_info = $UsersModel->where('user_id', $xin_system['company_id'])->first();
?>

<div class="row"> 
  <!-- [ Payslip ] start -->
  <div class="col-md-12"> 
    <!-- [ Payslip ] start -->
    <div class="container">
      <div>
        <div class="card" id="printTable">
          <div class="card-header">
            <h5><img class="img-fluid" width="171" height="30" src="<?= base_url();?>/public/uploads/users/<?= $company_info['profile_photo'];?>" alt=""></h5>
          </div>
          <div class="card-body">
          <h5 class="text-primary m-l-10 text-center m-b-20"><?php echo lang('Payroll.xin_employee_pay_summary');?></h5>
          <div class="table-responsive">
                <table class="table table-xs">
                    <tbody>
                        <tr>
                            <td><strong><?php echo lang('Dashboard.dashboard_employee');?></strong></td>
                            <td><?= $user_data['first_name'].' '.$user_data['last_name'];?></td>
                            <td><strong><?php echo lang('Dashboard.left_designation');?></strong></td>
                            <td><span class="label label-warning">
                        <?= $idesignations['designation_name'];?>
                        </span></td>
                        </tr>
                        <tr>
                            <td><strong><?php echo lang('Payroll.xin_pay_period');?></strong></td>
                            <td><?= $payslip_data['salary_month'];?></td>
                            <td><strong><?php echo lang('Payroll.xin_pay_date');?></strong></td>
                            <td><?= $payslip_data['created_at'];?></td>
                        </tr>
                        <?php if($payslip_data['wages_type'] == 1){ ?>
                        <tr>
                            <td><strong class="text-primary"><?php echo lang('Employees.xin_basic_salary');?></strong></td>
                            <td colspan="3"><strong class="text-primary"><?= number_to_currency($payslip_data['basic_salary'], $xin_system['default_currency'],null,2);?></strong></td>
                        </tr>
                        <?php } else {?>
                        <tr>
                            <td><strong class="text-primary"><?php echo lang('Main.xin_total_hours_worked');?></strong></td>
                            <td colspan="3"><strong class="text-primary"><?= number_to_currency($payslip_data['basic_salary'], $xin_system['default_currency'],null,2);?></strong></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php if($payslip_data['total_allowances'] > 0 || $payslip_data['total_commissions'] > 0 || $payslip_data['total_other_payments'] > 0 || $payslip_data['total_statutory_deductions'] > 0) {?>
            <div class="row">
             <?php if($payslip_data['total_allowances'] > 0 || $payslip_data['total_commissions'] > 0 || $payslip_data['total_other_payments'] > 0) {?>
             <?php $variable_pay = $payslip_data['total_allowances']+$payslip_data['total_commissions']+$payslip_data['total_other_payments'];?>
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-xs m-b-0 f-14 b-solid requid-table">
                    <thead>
                      <tr class="">
                        <th width="800" class="text-success"><?php echo lang('Variable Pay');?></th>
                        <th class="text-success text-right"><?= number_to_currency($variable_pay, $xin_system['default_currency'],null,2);?></th>
                      </tr>
                      <tr class="">
                        <td width="800"><strong><?php echo lang('Description');?></strong></td>
                        <td class="text-right"><strong><?php echo lang('Amount');?></strong></td>
                      </tr>
                    </thead>
                    <tbody class="text-muted">
                      <?php $allowance_amount =0; if($count_pay_allowance > 0) { ?>
                      <?php foreach($pay_allowance as $_allowance):?>
                      <?php
							if($_allowance['is_fixed']==1){
								$is_fixed = lang('Employees.xin_title_tax_fixed');
							} else {
								$is_fixed = lang('Employees.xin_title_tax_percent');
							}
							if($_allowance['is_taxable']==0){
								$contract_tax_option = lang('Employees.xin_salary_allowance_non_taxable');
							} else if($_allowance['is_taxable']==2){
								$contract_tax_option = lang('Employees.xin_fully_taxable');
							} else {
								$contract_tax_option = lang('Employees.xin_partially_taxable');
							}
							$allowance_amount += $_allowance['pay_amount'];
						?>
                      <tr>
                        <td width="800">
                          <?= $_allowance['pay_title'];?>
                          </td>
                        <td class="text-right"><?= number_to_currency($_allowance['pay_amount'], $xin_system['default_currency'],null,2);?></td>
                      </tr>
                      <?php endforeach?>
                      <?php } ?>
                      <?php $commission_amount =0; if($count_pay_commission > 0) { ?>
                      <?php foreach($pay_commission as $_commission):?>
                      <?php
							if($_commission['is_fixed']==1){
								$is_cfixed = lang('Employees.xin_title_tax_fixed');
							} else {
								$is_cfixed = lang('Employees.xin_title_tax_percent');
							}
							if($_commission['is_taxable']==0){
								$ccontract_tax_option = lang('Employees.xin_salary_allowance_non_taxable');
							} else if($_commission['is_taxable']==2){
								$ccontract_tax_option = lang('Employees.xin_fully_taxable');
							} else {
								$ccontract_tax_option = lang('Employees.xin_partially_taxable');
							}
							$commission_amount += $_commission['pay_amount'];
						?>
                      <tr>
                        <td width="800">
                          <?= $_commission['pay_title'];?>
                          </td>
                        <td class="text-right"><?= number_to_currency($_commission['pay_amount'], $xin_system['default_currency'],null,2);?></td>
                      </tr>
                      <?php endforeach?>
                      <?php } ?>
                      <?php $otherpayment_amount =0; if($count_pay_otherpayment > 0) { ?>
                      <?php foreach($pay_otherpayment as $_otherpayment):?>
                      <?php
							if($_otherpayment['is_fixed']==1){
								$is_ofixed = lang('Employees.xin_title_tax_fixed');
							} else {
								$is_ofixed = lang('Employees.xin_title_tax_percent');
							}
							if($_otherpayment['is_taxable']==0){
								$ocontract_tax_option = lang('Employees.xin_salary_allowance_non_taxable');
							} else if($_otherpayment['is_taxable']==2){
								$ocontract_tax_option = lang('Employees.xin_fully_taxable');
							} else {
								$ocontract_tax_option = lang('Employees.xin_partially_taxable');
							}
							$otherpayment_amount += $_otherpayment['pay_amount'];
						?>
                      <tr>
                        <td width="800">
                          <?= $_otherpayment['pay_title'];?>
                          </td>
                        <td class="text-right"><?= number_to_currency($_otherpayment['pay_amount'], $xin_system['default_currency'],null,2);?></td>
                      </tr>
                      <?php endforeach?>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <?php } ?>
              <?php if($payslip_data['total_statutory_deductions'] > 0) { ?>
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-xs m-b-0 f-14 b-solid requid-table">
                    <thead>
                     <tr class="">
                        <th width="800" class="text-danger"><?php echo lang('Variable Deduction');?></th>
                        <th class="text-danger text-right"><?= number_to_currency($payslip_data['total_statutory_deductions'], $xin_system['default_currency'],null,2);?></th>
                      </tr>
                      <tr class="">
                        <td width="800"><strong><?php echo lang('Description');?></strong></td>
                        <td class="text-right"><strong><?php echo lang('Amount');?></strong></td>
                      </tr>
                    </thead>
                    <tbody class="text-muted">
                      <?php $statutory_amount =0; if($count_pay_statutory > 0) { ?>
                      <?php foreach($pay_statutory as $_statutory):?>
                      <?php
							if($_statutory['is_fixed']==1){
								$is_sfixed = lang('Employees.xin_title_tax_fixed');
							} else {
								$is_sfixed = lang('Employees.xin_title_tax_percent');
							}
							$statutory_amount += $_statutory['pay_amount'];
						?>
                      <tr>
                        <td width="800">
                          <?= $_statutory['pay_title'];?>
                          </td>
                        <td class="text-right">
                          <?= number_to_currency($_statutory['pay_amount'], $xin_system['default_currency'],null,2);?>
                          </td>
                      </tr>
                      <?php endforeach?>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <?php } ?>
            </div>
            <?php } ?>
            <?php if($xin_system['is_enable_ml_payroll']==1){ ?>
            <?php $st_deduction = $payslip_data['eis_value'] + $payslip_data['epf_value'] + $payslip_data['socso_value'] + $payslip_data['pcb_tax_value'];?>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-xs m-b-0 f-14 b-solid requid-table">
                    <thead>
                     <tr class="">
                        <th class="text-danger" colspan="3"><?php echo lang('Statutory Deduction');?></th>
                        <th class="text-danger text-right"><?= number_to_currency($st_deduction, $xin_system['default_currency'],null,2);?></th>
                      </tr>
                      <tr class="text-muted">
                        <td width="150" class="text-right">&nbsp;</td>
                        <td class="text-right"><strong><?php echo lang('Employer');?></strong></td>
                        <td class="text-right"><strong><?php echo lang('Employee');?></strong></td>
                        <td class="text-right"><strong><?php echo lang('Sub-Total');?></strong></td>
                      </tr>
                    </thead>
                    <tbody class="text-muted">
                      <tr class="">
                        <td width="150" class="text-right"><?php echo lang('EPF');?>:</td>
                        <td class="text-right"><?= number_to_currency($payslip_data['employer_epf_value'], $xin_system['default_currency'],null,2);?></td>
                        <td class="text-right"><?= number_to_currency($payslip_data['epf_value'], $xin_system['default_currency'],null,2);?></td>
                        <td class="text-right">
						<?php $epf_total = $payslip_data['employer_epf_value']+$payslip_data['epf_value'];?>
                        <?= number_to_currency($epf_total, $xin_system['default_currency'],null,2);?></td>
                      </tr>
                      <tr class="">
                        <td width="150" class="text-right"><?php echo lang('SOCSO');?>:</td>
                        <td class="text-right"><?= number_to_currency($payslip_data['employer_socso_value'], $xin_system['default_currency'],null,2);?></td>
                        <td class="text-right"><?= number_to_currency($payslip_data['socso_value'], $xin_system['default_currency'],null,2);?></td>
                        <td class="text-right">
						<?php $socso_total = $payslip_data['employer_socso_value']+$payslip_data['socso_value'];?>
                        <?= number_to_currency($socso_total, $xin_system['default_currency'],null,2);?></td>
                      </tr>
                      <tr class="">
                        <td width="150" class="text-right"><?php echo lang('EIS');?>:</td>
                        <td class="text-right"><?= number_to_currency($payslip_data['employer_eis_value'], $xin_system['default_currency'],null,2);?></td>
                        <td class="text-right"><?= number_to_currency($payslip_data['eis_value'], $xin_system['default_currency'],null,2);?></td>
                        <td class="text-right">
						<?php $eis_total = $payslip_data['employer_eis_value']+$payslip_data['eis_value'];?>
                        <?= number_to_currency($eis_total, $xin_system['default_currency'],null,2);?></td>
                      </tr>
                      <tr class="">
                        <td width="150" class="text-right"><?php echo lang('HRDF');?>:</td>
                        <td class="text-right"><?= number_to_currency($payslip_data['ihrdf_value'], $xin_system['default_currency'],null,2);?></td>
                        <td class="text-right">&nbsp;</td>
                        <td class="text-right"><?= number_to_currency($payslip_data['ihrdf_value'], $xin_system['default_currency'],null,2);?></td>
                      </tr>
                      <tr class="">
                        <td width="150" class="text-right"><?php echo lang('PCB Tax');?>:</td>
                        <td class="text-right">&nbsp;</td>
                        <td class="text-right"><?= number_to_currency($payslip_data['pcb_tax_value'], $xin_system['default_currency'],null,2);?></td>
                        <td class="text-right"><?= number_to_currency($payslip_data['pcb_tax_value'], $xin_system['default_currency'],null,2);?></td>
                      </tr>
                      <tr class="">
                        <td width="150" class="text-right"><strong><?php echo lang('Total');?></strong>:</td>
                        <td class="text-right">
						<?php $total_empr = $payslip_data['employer_epf_value']+$payslip_data['employer_socso_value']+$payslip_data['employer_eis_value']+$payslip_data['ihrdf_value'];?>
                        <?= number_to_currency($total_empr, $xin_system['default_currency'],null,2);?></td>
                        <td class="text-right"><?php $total_employee = $payslip_data['epf_value']+$payslip_data['socso_value']+$payslip_data['eis_value']+$payslip_data['pcb_tax_value'];?>
                        <?= number_to_currency($total_employee, $xin_system['default_currency'],null,2);?></td>
                        <td class="text-right">
						<?php $total_sub = $total_empr+$total_employee;?>
                        <?= number_to_currency($total_sub, $xin_system['default_currency'],null,2);?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              </div>
              <?php } ?>
            <?php $total_earning = $payslip_data['basic_salary'] + $payslip_data['total_allowances'] + $payslip_data['total_commissions'] + $payslip_data['total_other_payments'];?>
            <?php $total_deduction = $payslip_data['total_statutory_deductions'];?>
            <div class="row">
              <div class="col-md-12">
                <table class="table table-responsive invoice-table invoice-total">
                  <tbody>
                    <tr>
                      <th><?= lang('Payroll.xin_total_earning');?>
                        :</th>
                      <td><?= number_to_currency($total_earning, $xin_system['default_currency'],null,2);?></td>
                    </tr>
                    <tr>
                      <th><?= lang('Payroll.xin_total_deductions');?>
                        :</th>
                      <td><?= number_to_currency($total_deduction, $xin_system['default_currency'],null,2);?></td>
                    </tr>
                    <tr class="text-info">
                      <td><hr>
                        <h5 class="text-primary m-r-10"><?php echo lang('Payroll.xin_net_pay');?> :</h5></td>
                      <td><hr>
                        <h5 class="text-primary">
                          <?= number_to_currency($payslip_data['net_salary'], $xin_system['default_currency'],null,2);?>
                        </h5></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <h6>
                  <?= lang('Payroll.xin_payslip_comments');?>
                  :</h6>
                <p>
                  <?= $payslip_data['pay_comments'];?>
                </p>
              </div>
            </div>
            <p class="m-l-10 text-center m-b-20"><?php echo lang('This is computer generated, no signature is required.');?></p>
          </div>
        </div>
        <div class="row text-center d-print-none">
          <div class="col-sm-12 invoice-btn-group text-center">
            <button type="button" class="btn btn-print-invoice waves-effect waves-light btn-primary m-b-10">
            <?= lang('Main.xin_print');?>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Payslip ] end --> 
  </div>
</div>