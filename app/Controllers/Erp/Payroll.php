<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the TimeHRM License
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.timehrm.com/license.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to timehrm.official@gmail.com so we can send you a copy immediately.
 *
 * @author   TimeHRM
 * @author-email  timehrm.official@gmail.com
 * @copyright  Copyright © timehrm.com All Rights Reserved
 */
namespace App\Controllers\Erp;
use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Files\UploadedFile;
 
use App\Models\MainModel;
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\PayrollModel;
use App\Models\ContractModel;
use App\Models\StaffdetailsModel;
use App\Models\AdvancesalaryModel;
use App\Models\PayallowancesModel;
use App\Models\SmstemplatesModel;
use App\Models\PaycommissionsModel;
use App\Models\EmailtemplatesModel;
use App\Models\PayotherpaymentsModel;
use App\Models\PaystatutorydeductionsModel;

class Payroll extends BaseController {

	public function index()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			$session->setFlashdata('err_not_logged_in',lang('Dashboard.err_not_logged_in'));
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		if($user_info['user_type'] != 'company'){
			if(!in_array('pay1',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.left_payroll').' | '.$xin_system['application_name'];
		$data['path_url'] = 'payroll';
		$data['breadcrumbs'] = lang('Dashboard.left_payroll');

		$data['subview'] = view('erp/payroll/erp_payroll', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function advance_salary()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			$session->setFlashdata('err_not_logged_in',lang('Dashboard.err_not_logged_in'));
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		if($user_info['user_type'] != 'company'){
			if(!in_array('advance_salary1',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_advance_salary').' | '.$xin_system['application_name'];
		$data['path_url'] = 'advance_salary';
		$data['breadcrumbs'] = lang('Main.xin_advance_salary');

		$data['subview'] = view('erp/payroll/key_advance_salary', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function request_loan()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			$session->setFlashdata('err_not_logged_in',lang('Dashboard.err_not_logged_in'));
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		if($user_info['user_type'] != 'company'){
			if(!in_array('loan1',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_request_loan').' | '.$xin_system['application_name'];
		$data['path_url'] = 'loan';
		$data['breadcrumbs'] = lang('Main.xin_request_loan');

		$data['subview'] = view('erp/payroll/key_loan', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function payroll_history()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			$session->setFlashdata('err_not_logged_in',lang('Dashboard.err_not_logged_in'));
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		if($user_info['user_type'] != 'company'){
			if(!in_array('pay_history',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.xin_payslip_history').' | '.$xin_system['application_name'];
		$data['path_url'] = 'payslip_history';
		$data['breadcrumbs'] = lang('Dashboard.xin_payslip_history');

		$data['subview'] = view('erp/payroll/payslip_history', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function staff_payroll_sheet()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			$session->setFlashdata('err_not_logged_in',lang('Dashboard.err_not_logged_in'));
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_salary_sheet').' | '.$xin_system['application_name'];
		$data['path_url'] = 'empty';
		$data['breadcrumbs'] = lang('Main.xin_salary_sheet');

		$data['subview'] = view('erp/payroll/payroll_export_sheet', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
	public function payroll_view()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		
		$PayrollModel = new PayrollModel();
		$request = \Config\Services::request();
		$ifield_id = udecode($request->uri->getSegment(3));
		$isegment_val = $PayrollModel->where('payslip_id', $ifield_id)->first();
		if(!$isegment_val){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			return redirect()->to(site_url('erp/desk'));
		}
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Payroll.xin_view_payslip').' | '.$xin_system['application_name'];
		$data['path_url'] = 'payroll';
		$data['breadcrumbs'] = lang('Payroll.xin_view_payslip');

		$data['subview'] = view('erp/payroll/erp_payroll_view', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
	
	// list
	public function payslip_list() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$request = \Config\Services::request();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$UsersModel = new UsersModel();
		$config         = new \Config\Encryption();
		$config->key    = 'aBigsecret_ofAtleast32Characters';
		$config->driver = 'OpenSSL';
		
		$encrypter = \Config\Services::encrypter($config);
		$RolesModel = new RolesModel();
		$SystemModel = new SystemModel();
		$ContractModel = new ContractModel();
		$MainModel = new MainModel();
		$PayrollModel = new PayrollModel();
		$StaffdetailsModel = new StaffdetailsModel();
		$AdvancesalaryModel = new AdvancesalaryModel();
		$payment_date = $this->request->getVar('payment_date',FILTER_SANITIZE_STRING);
		$employee_id = $this->request->getVar('staff_id',FILTER_SANITIZE_STRING);
		if($payment_date){
			$payment_date = $payment_date;
		} else {
			$payment_date = date('Y-m');
		}
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			if($employee_id == 0){
				$staff = $UsersModel->where('company_id',$user_info['company_id'])->where('user_type','staff')->orderBy('user_id', 'ASC')->findAll();
			} else {
				$staff = $UsersModel->where('company_id',$user_info['company_id'])->where('user_id',$employee_id)->findAll();
			}
			$company_id = $user_info['company_id'];
		} else {
			if($employee_id == 0){
				$staff = $UsersModel->where('company_id',$usession['sup_user_id'])->where('user_type','staff')->orderBy('user_id', 'ASC')->findAll();
			} else {
				$staff = $UsersModel->where('company_id',$usession['sup_user_id'])->where('user_id',$employee_id)->findAll();
			}
			$company_id = $usession['sup_user_id'];
		}
		$xin_system = erp_company_settings();
		
		$data = array();
		
          foreach($staff as $r) {						
		  			
				$payroll_count = $PayrollModel->where('company_id',$company_id)->where('staff_id',$r['user_id'])->where('salary_month',$payment_date)->countAllResults();
				// Advance Salary //
				$advance_salary = $AdvancesalaryModel->where('employee_id',$r['user_id'])->where('status',1)->where('salary_type','advance')->countAllResults();
				if($advance_salary > 0) {
					$fadvance_salary = $AdvancesalaryModel->where('employee_id',$r['user_id'])->where('status',1)->where('salary_type','advance')->first();
					if($fadvance_salary['advance_amount']!= $fadvance_salary['total_paid']){
						$monthly_installment = $fadvance_salary['monthly_installment'];
						$advance_amount = $fadvance_salary['advance_amount'];
						$total_paid = $fadvance_salary['total_paid'];
						//check ifpaid
						$em_advance_amount = $fadvance_salary['advance_amount'];
						$em_total_paid = $fadvance_salary['total_paid'];
						if($fadvance_salary['one_time_deduct']==1) {
							$i_net_advance = $em_advance_amount - $total_paid;
							$deduct_salary = $i_net_advance;
							$is_advance_deducted = 0;
						} else {
							$re_amount = $em_advance_amount - $em_total_paid;
							if($monthly_installment > $re_amount){
								$deduct_salary = $re_amount;
							} else {
								$deduct_salary = $monthly_installment;
							}
						}
					}
				} else {
					$deduct_salary = 0.00;
					$is_advance_deducted = 0;
				}	
				// Loan Request //
				$lo_advance_salary = $AdvancesalaryModel->where('employee_id',$r['user_id'])->where('status',1)->where('salary_type','loan')->countAllResults();
				if($lo_advance_salary > 0) {
					$flo_advance_salary = $AdvancesalaryModel->where('employee_id',$r['user_id'])->where('status',1)->where('salary_type','loan')->first();
					if($flo_advance_salary['advance_amount']!= $flo_advance_salary['total_paid']){
						$lo_monthly_installment = $flo_advance_salary['monthly_installment'];
						$lo_advance_amount = $flo_advance_salary['advance_amount'];
						$lo_total_paid = $flo_advance_salary['total_paid'];
						//check ifpaid
						$lo_em_advance_amount = $flo_advance_salary['advance_amount'];
						$lo_em_total_paid = $flo_advance_salary['total_paid'];
						if($flo_advance_salary['one_time_deduct']==1) {
							$lo_i_net_advance = $lo_em_advance_amount - $lo_total_paid;
							$lo_deduct_salary = $lo_i_net_advance;
							$lo_is_advance_deducted = 0;
						} else {
							$lo_re_amount = $lo_em_advance_amount - $lo_em_total_paid;
							if($lo_monthly_installment > $lo_re_amount){
								$lo_deduct_salary = $lo_re_amount;
							} else {
								$lo_deduct_salary = $lo_monthly_installment;
							}
						}
					}
				} else {
					$lo_deduct_salary = 0.00;
					$lo_is_advance_deducted = 0;
				}				
				if($payroll_count > 0){		
					$payroll_link = $PayrollModel->where('company_id',$company_id)->where('staff_id',$r['user_id'])->where('salary_month',$payment_date)->first();			
					$pay_salary = '';
					if(in_array('pay3',staff_role_resource()) || $user_info['user_type'] == 'company') {
						$delete = '<span data-toggle="tooltip" data-placement="top" data-state="danger" title="'.lang('Main.xin_delete').'"><button type="button" class="btn icon-btn btn-sm btn-light-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. uencode($payroll_link['payslip_id']) . '"><i class="feather icon-trash-2"></i></button></span>';
					} else {
						$delete = '';
					}
					$view = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Payroll.xin_view_payslip').'"><a target="_blank" href="'.site_url('erp/payroll-view').'/'.uencode($payroll_link['payslip_id']).'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light"><i class="feather icon-arrow-right"></i></button></a></span>';
					$set_salary_opt = '';
					$combhr = $set_salary_opt.$pay_salary.$view.$delete;
					$status = '<span class="badge badge-light-success">'.lang('Invoices.xin_paid').'</span>';
				} else {
					if(in_array('pay2',staff_role_resource()) || $user_info['user_type'] == 'company') {
						$pay_salary = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Payroll.xin_payroll_make_payment').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".payroll-modal-data" data-field_id="'. uencode($r['user_id']) . '" data-payment_date="'.uencode($payment_date).'" data-advance_salary="'.$deduct_salary.'" data-loan="'.$lo_deduct_salary.'"><i class="feather icon-credit-card"></i></button></span>';
					} else {
						$pay_salary = '';
					}
					
					$view = '';
					$delete = '';
					$set_salary_opt = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_set_salary').'"><a target="_blank" href="'.site_url('erp/set-salary').'/'.uencode($r['user_id']).'"><button type="button" class="btn icon-btn btn-sm btn-light-warning waves-effect waves-light"><i class="feather icon-settings"></i></button></a></span>';
					$combhr = $set_salary_opt.$pay_salary.$view.$delete;
					$status = '<span class="badge badge-light-danger">'.lang('Invoices.xin_unpaid').'</span>';
				}		
				$user_detail = $StaffdetailsModel->where('user_id', $r['user_id'])->first();
				if($user_detail['salay_type'] == 1){
					$wages_type = lang('Membership.xin_per_month');
					$ibasic_salary = $user_detail['basic_salary'];
					$shwbasic_salary = $user_detail['basic_salary'];
				} else {
					$wages_type = lang('Main.xin_per_hour');
					$shwbasic_salary = $user_detail['hourly_rate'];
					$hour_worked = total_hours_worked_payslip($r['user_id'],$payment_date);
					$ibasic_salary = $user_detail['hourly_rate'] * $hour_worked;
				}
				
				$name = $r['first_name'].' '.$r['last_name'];
				$uname = '<div class="d-inline-block align-middle">
					<img src="'.staff_profile_photo($r['user_id']).'" alt="user image" class="img-radius align-top m-r-15" style="width:40px;">
					<div class="d-inline-block">
						<h6 class="m-b-0">'.$name.'</h6>
						<p class="m-b-0">'.$r['email'].'</p>
					</div>
				</div>';
				// Salary Options //
				// 1:: Allowances
				$count_allowances = $ContractModel->where('user_id',$r['user_id'])->where('salay_type','allowances')->countAllResults();
				$salary_allowances = $ContractModel->where('user_id',$r['user_id'])->where('salay_type','allowances')->findAll();
				$allowance_amount = 0;
				if($count_allowances > 0) {
					foreach($salary_allowances as $sl_allowances) {
						//$allowance_amount += $sl_allowances['contract_amount'];
						if($sl_allowances['is_fixed'] == 1) {
							$allowance_amount += $sl_allowances['contract_amount'];
						} else {
							$allowance_amount += ($ibasic_salary / 100) * $sl_allowances['contract_amount'];
						}
					}
				} else {
					$allowance_amount = 0;
				}
				// 2:: Commissions
				$count_commissions = $ContractModel->where('user_id',$r['user_id'])->where('salay_type','commissions')->countAllResults();
				$salary_commissions = $ContractModel->where('user_id',$r['user_id'])->where('salay_type','commissions')->findAll();
				$commissions_amount = 0;
				if($count_commissions > 0) {
					foreach($salary_commissions as $sl_salary_commissions) {
						//$commissions_amount += $sl_salary_commissions['contract_amount'];
						if($sl_salary_commissions['is_fixed'] == 1) {
							$commissions_amount += $sl_salary_commissions['contract_amount'];
						} else {
							$commissions_amount += ($ibasic_salary / 100) * $sl_salary_commissions['contract_amount'];
						}
					}
				} else {
					$commissions_amount = 0;
				}
				// 3:: Other Payments
				$count_other_payments = $ContractModel->where('user_id',$r['user_id'])->where('salay_type','other_payments')->countAllResults();
				$other_payments = $ContractModel->where('user_id',$r['user_id'])->where('salay_type','other_payments')->findAll();
				$other_payments_amount = 0;
				if($count_other_payments > 0) {
					foreach($other_payments as $sl_other_payments) {
						//$other_payments_amount += $sl_other_payments['contract_amount'];
						if($sl_other_payments['is_fixed'] == 1) {
							$other_payments_amount += $sl_other_payments['contract_amount'];
						} else {
							$other_payments_amount += ($ibasic_salary / 100) * $sl_other_payments['contract_amount'];
						}
					}
				} else {
					$other_payments_amount = 0;
				}
				// 4:: Statutory
				$count_statutory_deductions = $ContractModel->where('user_id',$r['user_id'])->where('salay_type','statutory')->countAllResults();
				$statutory_deductions = $ContractModel->where('user_id',$r['user_id'])->where('salay_type','statutory')->findAll();
				$statutory_deductions_amount = 0;
				if($count_statutory_deductions > 0) {
					foreach($statutory_deductions as $sl_salary_statutory_deductions) {
						//$statutory_deductions_amount += $sl_salary_statutory_deductions['contract_amount'];
						if($sl_salary_statutory_deductions['is_fixed'] == 1) {
							$statutory_deductions_amount += $sl_salary_statutory_deductions['contract_amount'];
						} else {
							$statutory_deductions_amount += ($ibasic_salary / 100) * $sl_salary_statutory_deductions['contract_amount'];
						}
					}
				} else {
					$statutory_deductions_amount = 0;
				}
				
				// is_enable_ml_payroll start
				if($xin_system['is_enable_ml_payroll']==1){
					
					$user_detail = $StaffdetailsModel->where('user_id', $r['user_id'])->first();
					$basic_salary = $ibasic_salary;
					// 1: EIS Calculation
					if($user_detail['ml_eis_contribution']==1){
						$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
						$eiscsvFile = fopen(base_url('public/payroll_csv/eis_calculation.csv'), 'r');
						//skip first line
						fgetcsv($eiscsvFile);
						$eis_val = 0;
						$er_eis_val = 0;
						//parse data from csv file line by line
						while(($eis_line = fgetcsv($eiscsvFile)) !== FALSE){
								$eisnum = explode('-',$eis_line[1]);
							if ( in_array($ibasic_salary, range($eisnum[0],$eisnum[1])) ) {
								$eis_val = $eis_line[3];
								$er_eis_val = $eis_line[2];
							}
						}
					} else {
						$eis_val = 0;
						$er_eis_val = 0;
					}
					
					// 2: SOCSO Calculation
					if($user_detail['ml_socso_category']==1){
						$socsocsvFile = fopen(base_url('public/payroll_csv/socso_injury_invalidity.csv'), 'r');
						//skip first line
						fgetcsv($socsocsvFile);
						$socso_val = 0;
						$er_socso_val = 0;
						//parse data from csv file line by line
						while(($socso_line = fgetcsv($socsocsvFile)) !== FALSE){
								$socsonum = explode('-',$socso_line[1]);
							if ( in_array($ibasic_salary, range($socsonum[0],$socsonum[1])) ) {
								$socso_val = $socso_line[3];
								$er_socso_val = $socso_line[2];
							}
						}
					} else if($user_detail['ml_socso_category']==2){
						$socsocsvFile = fopen(base_url('public/payroll_csv/socso_injury_only.csv'), 'r');
						//skip first line
						fgetcsv($socsocsvFile);
						$socso_val = 0;
						$er_socso_val = 0;
						//parse data from csv file line by line
						while(($socso_line = fgetcsv($socsocsvFile)) !== FALSE){
								$socsonum = explode('-',$socso_line[1]);
							if ( in_array($ibasic_salary, range($socsonum[0],$socsonum[1])) ) {
								$socso_val = $socso_line[3];
								$er_socso_val = $socso_line[2];
							}
						}
					} else {
						$socso_val = 0;
						$er_socso_val = 0;
					}
					
					// 3: HRDF Calculation
					if($user_detail['ml_hrdf']!=0){
						$ihrdf = $ibasic_salary + $allowance_amount;
						$ihrdf = $ihrdf / 100 * $user_detail['ml_hrdf'];
					} else {
						$ihrdf = 0;
					}
					
					// 4: EPF Calculation
					$current = Time::parse(date('Y-m-d'));
					$test    = Time::parse($user_detail['date_of_birth']);
					$diff = $test->difference($current);
					$dob_emp = $diff->getYears(); //get years
					
					// 5: Zakat Fund
					$zakat_fund = $user_detail['zakat_fund'];
					$basic_salary = $ibasic_salary;
					$epf_val = 0;
					$er_epf_val = 0;
					if($user_detail['ml_empployee_epf_rate']=='7' || $user_detail['ml_empployee_epf_rate']=='11' || $user_detail['ml_empployer_epf_rate'] == '13'){
						// less 60 and malaysian
						if($dob_emp < 60 && $user_detail['ml_tax_citizenship']==1) {
							if($basic_salary > 20000){
								$epf_ipval = $basic_salary / 100 * 11;
								$epf_val = $epf_ipval;
								///
								$er_epf_ipval = $basic_salary / 100 * 12;
								$er_epf_val = $er_epf_ipval;
							} else {
								$epfcsvFile = fopen(base_url('public/payroll_csv/epf_part_a_less_than_60_years_old.csv'), 'r');
								//skip first line
								fgetcsv($epfcsvFile);
								//parse data from csv file line by line
								while(($epf_line = fgetcsv($epfcsvFile)) !== FALSE){
										$dt_epf0 = $epf_line[0];
										$dt_epf2 = $epf_line[2];
									if($basic_salary >= $dt_epf0 && $basic_salary <= $dt_epf2) {
										$epf_val = $epf_line[4];
										$er_epf_val = $epf_line[3];
									}
								}
							}
						} else if($dob_emp > 59 && $user_detail['ml_tax_citizenship']==1) {
							if($basic_salary > 20000){
								$epf_ipval = $basic_salary / 100 * 0;
								$epf_val = $epf_ipval;
								///
								$er_epf_ipval = $basic_salary / 100 * 4;
								$er_epf_val = $er_epf_ipval;
							} else {
								$epfcsvFile = fopen(base_url('public/payroll_csv/epf_part_e_60_years_and_above.csv'), 'r');
								//skip first line
								fgetcsv($epfcsvFile);
								//parse data from csv file line by line
								while(($epf_line = fgetcsv($epfcsvFile)) !== FALSE){
										$dt_epf0 = $epf_line[0];
										$dt_epf2 = $epf_line[2];
									if($basic_salary >= $dt_epf0 && $basic_salary <= $dt_epf2) {
										$epf_val = $epf_line[4];
										$er_epf_val = $epf_line[3];
									}
								}
							}
						} else if($dob_emp < 60 && $user_detail['ml_tax_citizenship']==2) {
							if($basic_salary > 20000){
								$epf_ipval = $basic_salary / 100 * 11;
								$epf_val = $epf_ipval;
								///
								$er_epf_ipval = $basic_salary / 100 * 12;
								$er_epf_val = $er_epf_ipval;
							} else {
								$epfcsvFile = fopen(base_url('public/payroll_csv/epf_part_a_less_than_60_years_old.csv'), 'r');
								//skip first line
								fgetcsv($epfcsvFile);
								$epf_val = 0;
								//parse data from csv file line by line
								while(($epf_line = fgetcsv($epfcsvFile)) !== FALSE){
										$dt_epf0 = $epf_line[0];
										$dt_epf2 = $epf_line[2];
									if($basic_salary >= $dt_epf0 && $basic_salary <= $dt_epf2) {
										$epf_val = $epf_line[4];
										$er_epf_val = $epf_line[3];
									}
								}
							}
						} else if($dob_emp > 59 && $user_detail['ml_tax_citizenship']==2) {
							if($basic_salary > 20000){
								$epf_ipval = $basic_salary / 100 * 5.5;
								$epf_val = $epf_ipval;
								///
								$er_epf_ipval = $basic_salary / 100 * 6;
								$er_epf_val = $er_epf_ipval;
							} else {
								$epfcsvFile = fopen(base_url('public/payroll_csv/epf_part_c_60_years_and_above.csv'), 'r');
								//skip first line
								fgetcsv($epfcsvFile);
								$epf_val = 0;
								//parse data from csv file line by line
								while(($epf_line = fgetcsv($epfcsvFile)) !== FALSE){
										$dt_epf0 = $epf_line[0];
										$dt_epf2 = $epf_line[2];
									if($basic_salary >= $dt_epf0 && $basic_salary <= $dt_epf2) {
										$epf_val = $epf_line[4];
										$er_epf_val = $epf_line[3];
									}
								}
							}
						} else if($dob_emp < 60 && $user_detail['ml_tax_citizenship']==3) {
							if($basic_salary > 20000){
								$epf_ipval = $basic_salary / 100 * 11;
								$epf_val = $epf_ipval;
								///
								$er_epf_val = 5;
							} else {
								$epfcsvFile = fopen(base_url('public/payroll_csv/epf_part_b_less_than_60_years_old.csv'), 'r');
								//skip first line
								fgetcsv($epfcsvFile);
								$epf_val = 0;
								//parse data from csv file line by line
								while(($epf_line = fgetcsv($epfcsvFile)) !== FALSE){
										$dt_epf0 = $epf_line[0];
										$dt_epf2 = $epf_line[2];
									if($basic_salary >= $dt_epf0 && $basic_salary <= $dt_epf2) {
										$epf_val = $epf_line[4];
										$er_epf_val = $epf_line[3];
									}
								}
							}
						} else if($dob_emp > 59 && $user_detail['ml_tax_citizenship']==3) {
							if($basic_salary > 20000){
								$epf_ipval = $basic_salary / 100 * 5.5;
								$epf_val = $epf_ipval;
								$er_epf_val = 5;
							} else {
								$epfcsvFile = fopen(base_url('public/payroll_csv/epf_part_d_60_years_and_above.csv'), 'r');
								//skip first line
								fgetcsv($epfcsvFile);
								$epf_val = 0;
								//parse data from csv file line by line
								while(($epf_line = fgetcsv($epfcsvFile)) !== FALSE){
										$dt_epf0 = $epf_line[0];
										$dt_epf2 = $epf_line[2];
									if($basic_salary >= $dt_epf0 && $basic_salary <= $dt_epf2) {
										$epf_val = $epf_line[4];
										$er_epf_val = $epf_line[3];
									}
								}
							}
						}
					} else {
						/// employee
						$iepf_val = $user_detail['ml_empployee_epf_rate'];
						$epf_val = $basic_salary / 100 * $iepf_val;
						/// employer
						$ier_epf_val = $user_detail['ml_empployer_epf_rate'];
						$er_epf_val = $basic_salary / 100 * $ier_epf_val;
					}
					
					// 5: PCB TAX Calulcation
					$pcb_tax_no_of_kids = $user_detail['ml_tax_category'];
					//$max_value_num = 86085;//live
					$max_value_num = 6335;
						$pcbtaxcsvFile = fopen(base_url('public/payroll_csv/tax_calculation_0_10_children.csv'), 'r');
						//skip first line
						fgetcsv($pcbtaxcsvFile);
						$pcb_tax_val = 0;
						$basic_salary = $ibasic_salary;
						//parse data from csv file line by line
						while(($pcbtax_line = fgetcsv($pcbtaxcsvFile)) !== FALSE){
							//foreach($line[0] as $enum){
								//$pcbtaxnum = explode('-',$pcbtax_line[1]);
							if ( in_array($basic_salary, range($pcbtax_line[0],$pcbtax_line[2])) ) {
								
								if($pcb_tax_no_of_kids == 0){ 
									$pcb_tax_val = $pcbtax_line[3];
								} else if($pcb_tax_no_of_kids == 1){
									$pcb_tax_val = $pcbtax_line[4];
								} else if($pcb_tax_no_of_kids == 2){
									$pcb_tax_val = $pcbtax_line[5];
								} else if($pcb_tax_no_of_kids == 3){
									$pcb_tax_val = $pcbtax_line[6];
								} else if($pcb_tax_no_of_kids == 4){
									$pcb_tax_val = $pcbtax_line[7];
								} else if($pcb_tax_no_of_kids == 5){
									$pcb_tax_val = $pcbtax_line[8];
								} else if($pcb_tax_no_of_kids == 6){
									$pcb_tax_val = $pcbtax_line[9];
								} else if($pcb_tax_no_of_kids == 7){
									$pcb_tax_val = $pcbtax_line[10];
								} else if($pcb_tax_no_of_kids == 8){
									$pcb_tax_val = $pcbtax_line[11];
								} else if($pcb_tax_no_of_kids == 9){
									$pcb_tax_val = $pcbtax_line[12];
								} else if($pcb_tax_no_of_kids == 10){
									$pcb_tax_val = $pcbtax_line[13];
								} else if($pcb_tax_no_of_kids == 11){
									$pcb_tax_val = $pcbtax_line[14];
								} else if($pcb_tax_no_of_kids == 12){
									$pcb_tax_val = $pcbtax_line[15];
								} else if($pcb_tax_no_of_kids == 13){
									$pcb_tax_val = $pcbtax_line[16];
								} else if($pcb_tax_no_of_kids == 14){
									$pcb_tax_val = $pcbtax_line[17];
								} else if($pcb_tax_no_of_kids == 15){
									$pcb_tax_val = $pcbtax_line[18];
								} else if($pcb_tax_no_of_kids == 16){
									$pcb_tax_val = $pcbtax_line[19];
								} else if($pcb_tax_no_of_kids == 17){
									$pcb_tax_val = $pcbtax_line[20];
								} else if($pcb_tax_no_of_kids == 18){
									$pcb_tax_val = $pcbtax_line[21];
								} else if($pcb_tax_no_of_kids == 19){
									$pcb_tax_val = $pcbtax_line[22];
								} else if($pcb_tax_no_of_kids == 20){
									$pcb_tax_val = $pcbtax_line[23];
								} else if($pcb_tax_no_of_kids == 21){
									$pcb_tax_val = $pcbtax_line[24];
								} else if($pcb_tax_no_of_kids == 22){
									$pcb_tax_val = $pcbtax_line[25];
								} else {
									$pcb_tax_val = 0;
								}
							}
							if($basic_salary > $max_value_num) {
								while(($getData = fgetcsv($pcbtaxcsvFile)) !== FALSE){
									if($basic_salary > $getData[2]) {
										if($pcb_tax_no_of_kids == 0){ 
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[3];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 1){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[4];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 2){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[5];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 3){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[6];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 4){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[7];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 5){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[8];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 6){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[9];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 7){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[10];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 8){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[11];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 9){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[12];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 10){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[13];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 11){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[14];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 12){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[15];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 13){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[16];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 14){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[17];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 15){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[18];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 16){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[19];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 17){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[20];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 18){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[21];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 19){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[22];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 20){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[23];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 21){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[24];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else if($pcb_tax_no_of_kids == 22){
											if($basic_salary > $max_value_num) {
												$p_ptax = $getData[25];
												$np_ptax = $basic_salary - $max_value_num;
												$np_netax = $np_ptax / 100 * 28;
												$np_netax = (float)$np_netax;
												$p_ptax = (float)$p_ptax;
												$pcb_tax_val = $np_netax + $p_ptax;
											} else {
												$pcb_tax_val = $pcb_tax_val;
											}
										} else {
											$pcb_tax_val = 0;
										}
									} else {
										$pcb_tax_val = $pcb_tax_val;
									}
								}
							}
						}
				} else {
					$eis_val = 0;
					$er_eis_val = 0;
					$socso_val = 0;
					$er_socso_val = 0;
					$ihrdf = 0;
					$epf_val = 0;
					$er_epf_val = 0;
					$pcb_tax_val = 0;
					$zakat_fund =0;
				}
				// is_enable_ml_payroll end
				// ml payroll calculation
				$ipcb_tax_val = $pcb_tax_val + $zakat_fund;
				$eis_val = (float)$eis_val;
				$socso_val = (float)$socso_val;
				$epf_val = (float)$epf_val;
				$pcb_tax_val = (float)$pcb_tax_val;
				$ihrdf_val = (float)$ihrdf;
				$pcb_tax_val_all = $eis_val + $socso_val + $epf_val + $ipcb_tax_val;
				// net salary
				$inet_salary = $ibasic_salary + $allowance_amount + $commissions_amount + $other_payments_amount - $statutory_deductions_amount + $deduct_salary + $lo_deduct_salary - $pcb_tax_val_all;
				$net_salary = '<h6 class="text-success">'.number_to_currency($inet_salary, $xin_system['default_currency'],null,2).'</h6>';
				$basic_salary = '<h6 class="text-primary">'.number_to_currency($ibasic_salary, $xin_system['default_currency'],null,2).'</h6>';
				$shwbasic_salary = '<h6 class="text-primary">'.number_to_currency($shwbasic_salary, $xin_system['default_currency'],null,2).'</h6>';
				
				$links = '
					'.$uname.'
					<div class="overlay-edit">
						'.$combhr.'
					</div>
				';					 			  				
				$data[] = array(
					$links,
					$user_detail['employee_id'],
					$wages_type,
					$shwbasic_salary,
					$net_salary,
					$status
				);
			}
          $output = array(
               //"draw" => $draw,
			   "data" => $data
            );
          echo json_encode($output);
          exit();
     }
	// record list
	public function advance_salary_list() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$AdvancesalaryModel = new AdvancesalaryModel();
		//$ConstantsModel = new ConstantsModel();
		$xin_system = erp_company_settings();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$get_data = $AdvancesalaryModel->where('employee_id',$user_info['user_id'])->where('salary_type','advance')->orderBy('advance_salary_id', 'ASC')->findAll();
		} else {
			$get_data = $AdvancesalaryModel->where('company_id',$usession['sup_user_id'])->where('salary_type','advance')->orderBy('advance_salary_id', 'ASC')->findAll();
		}
		$data = array();
		
          foreach($get_data as $r) {						
		  			
				if(in_array('advance_salary4',staff_role_resource()) || $user_info['user_type'] == 'company') { //delete
					$delete = '<span data-toggle="tooltip" data-placement="top" data-state="danger" title="'.lang('Main.xin_delete').'"><button type="button" class="btn icon-btn btn-sm btn-light-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. uencode($r['advance_salary_id']) . '"><i class="feather icon-trash-2"></i></button></span>';
				} else {
					$delete = '';
				}
				if(in_array('advance_salary3',staff_role_resource()) || $user_info['user_type'] == 'company') {
					$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-field_id="'. uencode($r['advance_salary_id']) . '"><i class="feather icon-edit"></i></button></span>';
				} else {
					$edit = '';
				}
			// awards month year
			$d = explode('-',$r['month_year']);
			$get_month = date('F', mktime(0, 0, 0, $d[1], 10));
			$month_year = $get_month.', '.$d[0];
			// user info
			$iuser_info = $UsersModel->where('user_id', $r['employee_id'])->first();
			$combhr = $edit.$delete;
			if($r['one_time_deduct']==1): $onetime = lang('Main.xin_yes'); else: $onetime = lang('Main.xin_no'); endif;	
			if($r['status'] == 0){
				$app_status = '<span class="badge badge-light-warning">'.lang('Main.xin_pending').'</span>';
			} else if($r['status'] == 1){
				$app_status = '<span class="badge badge-light-success">'.lang('Main.xin_accepted').'</span>';
			} else if($r['status'] == 2){
				$app_status = '<span class="badge badge-light-danger">'.lang('Main.xin_rejected').'</span>';
			}
			$created_at = set_date_format($r['created_at']);
			// advance_amount
			$advance_amount = number_to_currency($r['advance_amount'], $xin_system['default_currency'],null,2);
			$monthly_installment = number_to_currency($r['monthly_installment'], $xin_system['default_currency'],null,2);
			$total_paid = number_to_currency($r['total_paid'], $xin_system['default_currency'],null,2);
			$itotal_paid = $advance_amount.'<br>'.lang('Invoices.xin_paid').': '.$total_paid;
			$iapp_status = $created_at.'<br>'.$app_status;
			//'xin_paid' => 'Paid',
			if($iuser_info){
				$employee_name = $iuser_info['first_name'].' '.$iuser_info['last_name'];
				$uname = '<div class="d-inline-block align-middle">
					<img src="'.base_url().'/public/uploads/users/thumb/'.$iuser_info['profile_photo'].'" alt="" class="img-radius align-top m-r-15" style="width:40px;">
					<div class="d-inline-block">
						<h6 class="m-b-0">'.$employee_name.'</h6>
						<p class="m-b-0">'.$iuser_info['email'].'</p>
					</div>
				</div>';
				$combhr = $edit.$delete;
			} else {
				$uname = '--';
				$combhr = $delete;
			}
			if(in_array('advance_salary3',staff_role_resource()) || in_array('advance_salary4',staff_role_resource()) || $user_info['user_type'] == 'company') {
				$icname = '
				'.$uname.'
				<div class="overlay-edit">
					'.$combhr.'
				</div>';	 			  				
			} else {
				$icname = $uname;
			}
			
			$data[] = array(
				$icname,
				$itotal_paid,
				$month_year,
				$onetime,
				$monthly_installment,
				$iapp_status,
			);
			
		}
          $output = array(
               //"draw" => $draw,
			   "data" => $data
            );
          echo json_encode($output);
          exit();
     }
	// record list
	public function loan_list() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$AdvancesalaryModel = new AdvancesalaryModel();
		//$ConstantsModel = new ConstantsModel();
		$xin_system = erp_company_settings();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$get_data = $AdvancesalaryModel->where('employee_id',$user_info['user_id'])->where('salary_type','loan')->orderBy('advance_salary_id', 'ASC')->findAll();
		} else {
			$get_data = $AdvancesalaryModel->where('company_id',$usession['sup_user_id'])->where('salary_type','loan')->orderBy('advance_salary_id', 'ASC')->findAll();
		}
		$data = array();
		
          foreach($get_data as $r) {						
		  			
				if(in_array('advance_salary4',staff_role_resource()) || $user_info['user_type'] == 'company') { //delete
					$delete = '<span data-toggle="tooltip" data-placement="top" data-state="danger" title="'.lang('Main.xin_delete').'"><button type="button" class="btn icon-btn btn-sm btn-light-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. uencode($r['advance_salary_id']) . '"><i class="feather icon-trash-2"></i></button></span>';
				} else {
					$delete = '';
				}
				if(in_array('advance_salary3',staff_role_resource()) || $user_info['user_type'] == 'company') {
					$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-field_id="'. uencode($r['advance_salary_id']) . '"><i class="feather icon-edit"></i></button></span>';
				} else {
					$edit = '';
				}
			// awards month year
			$d = explode('-',$r['month_year']);
			$get_month = date('F', mktime(0, 0, 0, $d[1], 10));
			$month_year = $get_month.', '.$d[0];
			// user info
			$iuser_info = $UsersModel->where('user_id', $r['employee_id'])->first();
			$combhr = $edit.$delete;
			if($r['one_time_deduct']==1): $onetime = lang('Main.xin_yes'); else: $onetime = lang('Main.xin_no'); endif;	
			if($r['status'] == 0){
				$app_status = '<span class="badge badge-light-warning">'.lang('Main.xin_pending').'</span>';
			} else if($r['status'] == 1){
				$app_status = '<span class="badge badge-light-success">'.lang('Main.xin_accepted').'</span>';
			} else if($r['status'] == 2){
				$app_status = '<span class="badge badge-light-danger">'.lang('Main.xin_rejected').'</span>';
			}
			$created_at = set_date_format($r['created_at']);
			// advance_amount
			$advance_amount = number_to_currency($r['advance_amount'], $xin_system['default_currency'],null,2);
			$monthly_installment = number_to_currency($r['monthly_installment'], $xin_system['default_currency'],null,2);
			$total_paid = number_to_currency($r['total_paid'], $xin_system['default_currency'],null,2);
			$itotal_paid = $advance_amount.'<br>'.lang('Invoices.xin_paid').': '.$total_paid;
			$iapp_status = $created_at.'<br>'.$app_status;
			//'xin_paid' => 'Paid',
			if($iuser_info){
				$employee_name = $iuser_info['first_name'].' '.$iuser_info['last_name'];
				$uname = '<div class="d-inline-block align-middle">
					<img src="'.base_url().'/public/uploads/users/thumb/'.$iuser_info['profile_photo'].'" alt="user image" class="img-radius align-top m-r-15" style="width:40px;">
					<div class="d-inline-block">
						<h6 class="m-b-0">'.$employee_name.'</h6>
						<p class="m-b-0">'.$iuser_info['email'].'</p>
					</div>
				</div>';
				$combhr = $edit.$delete;
			} else {
				$uname = '--';
				$combhr = $delete;
			}
			if(in_array('advance_salary3',staff_role_resource()) || in_array('advance_salary4',staff_role_resource()) || $user_info['user_type'] == 'company') {
				$icname = '
				'.$uname.'
				<div class="overlay-edit">
					'.$combhr.'
				</div>';	 			  				
			} else {
				$icname = $uname;
			}
			
			$data[] = array(
				$icname,
				$itotal_paid,
				$month_year,
				$onetime,
				$monthly_installment,
				$iapp_status,
			);
			
		}
          $output = array(
               //"draw" => $draw,
			   "data" => $data
            );
          echo json_encode($output);
          exit();
     }
	 // list
	public function payslip_history_list() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$request = \Config\Services::request();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$UsersModel = new UsersModel();
		$config         = new \Config\Encryption();
		$config->key    = 'aBigsecret_ofAtleast32Characters';
		$config->driver = 'OpenSSL';
		
		$encrypter = \Config\Services::encrypter($config);
		$RolesModel = new RolesModel();
		$SystemModel = new SystemModel();
		$ContractModel = new ContractModel();
		$MainModel = new MainModel();
		$PayrollModel = new PayrollModel();
		$StaffdetailsModel = new StaffdetailsModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$payslip = $PayrollModel->where('company_id',$user_info['company_id'])->where('staff_id',$usession['sup_user_id'])->orderBy('payslip_id', 'ASC')->findAll();
			$company_id = $user_info['company_id'];
		} else {
			$payslip = $PayrollModel->where('company_id',$usession['sup_user_id'])->orderBy('payslip_id', 'ASC')->findAll();
			$company_id = $usession['sup_user_id'];
		}
		$xin_system = erp_company_settings();
		$data = array();
		
          foreach($payslip as $r) {						
		  			
					
				$user_detail = $UsersModel->where('user_id', $r['staff_id'])->first();
				$wages_type = lang('Membership.xin_per_month');
				
				$name = $user_detail['first_name'].' '.$user_detail['last_name'];
				$uname = '<div class="d-inline-block align-middle">
					<img src="'.base_url().'/public/uploads/users/thumb/'.$user_detail['profile_photo'].'" alt="user image" class="img-radius align-top m-r-15" style="width:40px;">
					<div class="d-inline-block">
						<h6 class="m-b-0">'.$name.'</h6>
						<p class="m-b-0">'.$user_detail['email'].'</p>
					</div>
				</div>';
				// Salary Options //
				$view = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Payroll.xin_view_payslip').'"><a target="_blank" href="'.site_url('erp/payroll-view').'/'.uencode($r['payslip_id']).'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light"><i class="feather icon-arrow-right"></i></button></a></span>';
				
				// net salary
				$inet_salary = $r['net_salary'];
				$smonth = strtotime($r['salary_month']);
				$smonth = date('F, Y',$smonth);
				$salary_month = set_date_format($r['salary_month']);
				$net_salary = '<h6 class="text-success">'.number_to_currency($inet_salary, $xin_system['default_currency'],null,2).'</h6>';
				$combhr = $view;
				$links = '
					'.$uname.'
					<div class="overlay-edit">
						'.$combhr.'
					</div>
				';					 			  				
				$data[] = array(
					$links,
					$net_salary,
					$smonth,
					$net_salary
				);
			}
          $output = array(
               //"draw" => $draw,
			   "data" => $data
            );
          echo json_encode($output);
          exit();
     }
	// |||add record|||
	public function add_advance_salary() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'month_year' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'advance_amount' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'one_time_deduct' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'reason' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "month_year" => $validation->getError('month_year'),
					"advance_amount" => $validation->getError('advance_amount'),
					"one_time_deduct" => $validation->getError('one_time_deduct'),
					"reason" => $validation->getError('reason')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$month_year = $this->request->getPost('month_year',FILTER_SANITIZE_STRING);
				$advance_amount = $this->request->getPost('advance_amount',FILTER_SANITIZE_STRING);
				$one_time_deduct = $this->request->getPost('one_time_deduct',FILTER_SANITIZE_STRING);
				$reason = $this->request->getPost('reason',FILTER_SANITIZE_STRING);
				// get one time value
				if($one_time_deduct==1){
					$emi_amount = $advance_amount;
				} else {
					$iemi_amount = $this->request->getPost('emi_amount',FILTER_SANITIZE_STRING);
					if($iemi_amount == ''){
						$emi_amount = 0;
					} else {
						$emi_amount = $this->request->getPost('emi_amount',FILTER_SANITIZE_STRING);
					}
				}
							
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$staff_id = $usession['sup_user_id'];
					$company_id = $user_info['company_id'];
				} else {
					$assigned_ids = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
					$staff_id = $assigned_ids;
					$company_id = $usession['sup_user_id'];
				}
				$data = [
					'company_id'  => $company_id,
					'employee_id' => $staff_id,
					'month_year'  => $month_year,
					'advance_amount'  => $advance_amount,
					'one_time_deduct'  => $one_time_deduct,
					'monthly_installment'  => $emi_amount,
					'salary_type'  => 'advance',
					'total_paid'  => 0,
					'reason'  => $reason,
					'status'  => 0,
					'is_deducted_from_salary'  => 0,
					'created_at' => date('d-m-Y h:i:s')
				];
				$AdvancesalaryModel = new AdvancesalaryModel();
				$result = $AdvancesalaryModel->insert($data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_advance_salary_created__msg');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
				$this->output($Return);
				exit;
			}
		} else {
			$Return['error'] = lang('Main.xin_error_msg');
			$this->output($Return);
			exit;
		}
	} 
	// |||update record|||
	public function edit_advance_salary() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'month_year' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'advance_amount' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'one_time_deduct' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'reason' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "month_year" => $validation->getError('month_year'),
					"advance_amount" => $validation->getError('advance_amount'),
					"one_time_deduct" => $validation->getError('one_time_deduct'),
					"reason" => $validation->getError('reason')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$month_year = $this->request->getPost('month_year',FILTER_SANITIZE_STRING);
				$advance_amount = $this->request->getPost('advance_amount',FILTER_SANITIZE_STRING);
				$one_time_deduct = $this->request->getPost('one_time_deduct',FILTER_SANITIZE_STRING);
				$reason = $this->request->getPost('reason',FILTER_SANITIZE_STRING);
				$status = $this->request->getPost('status',FILTER_SANITIZE_STRING);
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				// get one time value
				if($one_time_deduct==1){
					$emi_amount = $advance_amount;
				} else {
					$iemi_amount = $this->request->getPost('emi_amount',FILTER_SANITIZE_STRING);
					if($iemi_amount == ''){
						$emi_amount = 0;
					} else {
						$emi_amount = $this->request->getPost('emi_amount',FILTER_SANITIZE_STRING);
					}
				}
							
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$staff_id = $usession['sup_user_id'];
					$company_id = $user_info['company_id'];
				} else {
					$assigned_ids = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
					$staff_id = $assigned_ids;
					$company_id = $usession['sup_user_id'];
				}
				$data = [
					'company_id'  => $company_id,
					'employee_id' => $staff_id,
					'month_year'  => $month_year,
					'advance_amount'  => $advance_amount,
					'one_time_deduct'  => $one_time_deduct,
					'monthly_installment'  => $emi_amount,
					'salary_type'  => 'advance',
					'total_paid'  => 0,
					'reason'  => $reason,
					'status'  => $status,
					'is_deducted_from_salary'  => 0,
					'created_at' => date('d-m-Y h:i:s')
				];
				$AdvancesalaryModel = new AdvancesalaryModel();
				$result = $AdvancesalaryModel->update($id,$data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_advance_salary_updated_msg');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
				$this->output($Return);
				exit;
			}
		} else {
			$Return['error'] = lang('Main.xin_error_msg');
			$this->output($Return);
			exit;
		}
	} 
	// |||add record|||
	public function add_loan() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'month_year' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'advance_amount' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'one_time_deduct' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'reason' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "month_year" => $validation->getError('month_year'),
					"advance_amount" => $validation->getError('advance_amount'),
					"one_time_deduct" => $validation->getError('one_time_deduct'),
					"reason" => $validation->getError('reason')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$month_year = $this->request->getPost('month_year',FILTER_SANITIZE_STRING);
				$advance_amount = $this->request->getPost('advance_amount',FILTER_SANITIZE_STRING);
				$one_time_deduct = $this->request->getPost('one_time_deduct',FILTER_SANITIZE_STRING);
				$reason = $this->request->getPost('reason',FILTER_SANITIZE_STRING);
				// get one time value
				if($one_time_deduct==1){
					$emi_amount = $advance_amount;
				} else {
					$iemi_amount = $this->request->getPost('emi_amount',FILTER_SANITIZE_STRING);
					if($iemi_amount == ''){
						$emi_amount = 0;
					} else {
						$emi_amount = $this->request->getPost('emi_amount',FILTER_SANITIZE_STRING);
					}
				}
							
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$staff_id = $usession['sup_user_id'];
					$company_id = $user_info['company_id'];
				} else {
					$assigned_ids = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
					$staff_id = $assigned_ids;
					$company_id = $usession['sup_user_id'];
				}
				$data = [
					'company_id'  => $company_id,
					'employee_id' => $staff_id,
					'month_year'  => $month_year,
					'advance_amount'  => $advance_amount,
					'one_time_deduct'  => $one_time_deduct,
					'monthly_installment'  => $emi_amount,
					'salary_type'  => 'loan',
					'total_paid'  => 0,
					'reason'  => $reason,
					'status'  => 0,
					'is_deducted_from_salary'  => 0,
					'created_at' => date('d-m-Y h:i:s')
				];
				$AdvancesalaryModel = new AdvancesalaryModel();
				$result = $AdvancesalaryModel->insert($data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_loan_created__msg');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
				$this->output($Return);
				exit;
			}
		} else {
			$Return['error'] = lang('Main.xin_error_msg');
			$this->output($Return);
			exit;
		}
	} 
	// |||update record|||
	public function edit_loan() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'month_year' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'advance_amount' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'one_time_deduct' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'reason' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "month_year" => $validation->getError('month_year'),
					"advance_amount" => $validation->getError('advance_amount'),
					"one_time_deduct" => $validation->getError('one_time_deduct'),
					"reason" => $validation->getError('reason')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$month_year = $this->request->getPost('month_year',FILTER_SANITIZE_STRING);
				$advance_amount = $this->request->getPost('advance_amount',FILTER_SANITIZE_STRING);
				$one_time_deduct = $this->request->getPost('one_time_deduct',FILTER_SANITIZE_STRING);
				$reason = $this->request->getPost('reason',FILTER_SANITIZE_STRING);
				$status = $this->request->getPost('status',FILTER_SANITIZE_STRING);
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				// get one time value
				if($one_time_deduct==1){
					$emi_amount = $advance_amount;
				} else {
					$iemi_amount = $this->request->getPost('emi_amount',FILTER_SANITIZE_STRING);
					if($iemi_amount == ''){
						$emi_amount = 0;
					} else {
						$emi_amount = $this->request->getPost('emi_amount',FILTER_SANITIZE_STRING);
					}
				}
							
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$staff_id = $usession['sup_user_id'];
					$company_id = $user_info['company_id'];
				} else {
					$assigned_ids = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
					$staff_id = $assigned_ids;
					$company_id = $usession['sup_user_id'];
				}
				$data = [
					'company_id'  => $company_id,
					'employee_id' => $staff_id,
					'month_year'  => $month_year,
					'advance_amount'  => $advance_amount,
					'one_time_deduct'  => $one_time_deduct,
					'monthly_installment'  => $emi_amount,
					'salary_type'  => 'loan',
					'total_paid'  => 0,
					'reason'  => $reason,
					'status'  => $status,
					'is_deducted_from_salary'  => 0,
					'created_at' => date('d-m-Y h:i:s')
				];
				$AdvancesalaryModel = new AdvancesalaryModel();
				$result = $AdvancesalaryModel->update($id,$data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_loan_updated_msg');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
				$this->output($Return);
				exit;
			}
		} else {
			$Return['error'] = lang('Main.xin_error_msg');
			$this->output($Return);
			exit;
		}
	} 
	// add payslip
	public function add_pay_monthly() {
		
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}	
		if ($this->request->getPost('type') === 'add_monthly_payment') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			if($this->request->getPost('payslip_comments') === ''){
				$Return['error'] = lang('Success.xin_payslip_comments_field_error');
			}
					
			if($Return['error']!=''){
				$this->output($Return);
			}
			$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
			$salary_month = udecode($this->request->getPost('token2',FILTER_SANITIZE_STRING));
			$MainModel = new MainModel();
			$ContractModel = new ContractModel();
			$AdvancesalaryModel = new AdvancesalaryModel();
			// Advance Salary //->where('salary_type','loan')
			$advance_salary = $AdvancesalaryModel->where('employee_id',$id)->where('status',1)->where('salary_type','advance')->countAllResults();
			if($advance_salary > 0) {
				$ldadvance_salary = $AdvancesalaryModel->where('employee_id',$id)->where('status',1)->where('salary_type','advance')->first();
				if($ldadvance_salary['advance_amount']!= $ldadvance_salary['total_paid']){
					$monthly_installment = $ldadvance_salary['monthly_installment'];
					$advance_amount = $ldadvance_salary['advance_amount'];
					$total_paid = $ldadvance_salary['total_paid'];
					//check ifpaid
					$em_advance_amount = $ldadvance_salary['advance_amount'];
					$em_total_paid = $ldadvance_salary['total_paid'];
					if($ldadvance_salary['one_time_deduct']==1) {
						$i_net_advance = $em_advance_amount - $total_paid;
						$deduct_salary = $i_net_advance;
						$is_advance_deducted = 1;
						$add_amount = $total_paid + $i_net_advance;
						//pay_date //emp_id
						$adv_data = array('total_paid' => $add_amount);
						$MainModel->update_advance_salary_record($adv_data,$id,'advance');
					} else {
						$re_amount = $em_advance_amount - $em_total_paid;
						if($monthly_installment > $re_amount){
							$deduct_salary = $total_paid + $re_amount;
						} else {
							$deduct_salary = $total_paid + $monthly_installment;
						}
						$is_advance_deducted = 1;
						$add_amount = $deduct_salary;
						//pay_date //emp_id
						$adv_data = array('total_paid' => $add_amount);
						$MainModel->update_advance_salary_record($adv_data,$id,'advance');
					}
				}
			} else {
				$deduct_salary = 0;
				$is_advance_deducted = 0;
			}
			// Loan Request //
			$lo_advance_salary_count = $AdvancesalaryModel->where('employee_id',$id)->where('status',1)->where('salary_type','loan')->countAllResults();
			if($lo_advance_salary_count > 0) {
				$lo_advance_salary = $AdvancesalaryModel->where('employee_id',$id)->where('status',1)->where('salary_type','loan')->first();
				if($lo_advance_salary['advance_amount']!= $lo_advance_salary['total_paid']){
					$lo_monthly_installment = $lo_advance_salary['monthly_installment'];
					$lo_advance_amount = $lo_advance_salary['advance_amount'];
					$lo_total_paid = $lo_advance_salary['total_paid'];
					//check ifpaid
					$lo_em_advance_amount = $lo_advance_salary['advance_amount'];
					$lo_em_total_paid = $lo_advance_salary['total_paid'];
					if($lo_advance_salary['one_time_deduct']==1) {
						$lo_i_net_advance = $lo_em_advance_amount - $lo_total_paid;
						$lo_deduct_salary = $lo_i_net_advance;
						$lo_is_advance_deducted = 1;
						$lo_add_amount = $lo_total_paid + $lo_i_net_advance;
						//pay_date //emp_id
						$lo_adv_data = array('total_paid' => $lo_add_amount);
						$MainModel->update_advance_salary_record($lo_adv_data,$id,'loan');
					} else {
						$lo_re_amount = $lo_em_advance_amount - $lo_em_total_paid;
						if($lo_monthly_installment > $lo_re_amount){
							$lo_deduct_salary = $total_paid + $lo_re_amount;
						} else {
							$lo_deduct_salary = $lo_total_paid + $lo_monthly_installment;
						}
						$lo_is_advance_deducted = 1;
						$lo_add_amount = $lo_deduct_salary;
						//pay_date //emp_id
						$lo_adv_data = array('total_paid' => $lo_add_amount);
						$MainModel->update_advance_salary_record($lo_adv_data,$id,'loan');
					}
				}
			} else {
				$lo_deduct_salary = 0;
				$lo_is_advance_deducted = 0;
			}
			// Salary Options //
			// 1:: Allowances
			$count_allowances = $ContractModel->where('user_id',$id)->where('salay_type','allowances')->countAllResults();
			$salary_allowances = $ContractModel->where('user_id',$id)->where('salay_type','allowances')->findAll();
			$allowance_amount = 0;
			if($count_allowances > 0) {
				foreach($salary_allowances as $sl_allowances) {
					$allowance_amount += $sl_allowances['contract_amount'];
				}
			} else {
				$allowance_amount = 0;
			}
			// 2:: Commissions
			$count_commissions = $ContractModel->where('user_id',$id)->where('salay_type','commissions')->countAllResults();
			$salary_commissions = $ContractModel->where('user_id',$id)->where('salay_type','commissions')->findAll();
			$commissions_amount = 0;
			if($count_commissions > 0) {
				foreach($salary_commissions as $sl_salary_commissions) {
					$commissions_amount += $sl_salary_commissions['contract_amount'];
				}
			} else {
				$commissions_amount = 0;
			}
			// 3:: Other Payments
			$count_other_payments = $ContractModel->where('user_id',$id)->where('salay_type','other_payments')->countAllResults();
			$other_payments = $ContractModel->where('user_id',$id)->where('salay_type','other_payments')->findAll();
			$other_payments_amount = 0;
			if($count_other_payments > 0) {
				foreach($other_payments as $sl_other_payments) {
					$other_payments_amount += $sl_other_payments['contract_amount'];
				}
			} else {
				$other_payments_amount = 0;
			}
			// 4:: Statutory
			$count_statutory_deductions = $ContractModel->where('user_id',$id)->where('salay_type','statutory')->countAllResults();
			$statutory_deductions = $ContractModel->where('user_id',$id)->where('salay_type','statutory')->findAll();
			$statutory_deductions_amount = 0;
			if($count_statutory_deductions > 0) {
				foreach($statutory_deductions as $sl_salary_statutory_deductions) {
					$statutory_deductions_amount += $sl_salary_statutory_deductions['contract_amount'];
				}
			} else {
				$statutory_deductions_amount = 0;
			}								
			
			$generate_key = uencode(generate_random_employeeid());
			$UsersModel = new UsersModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
				$company_info = $UsersModel->where('company_id', $company_id)->first();
			} else {
				$company_id = $usession['sup_user_id'];
				$company_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			}
			$StaffdetailsModel = new StaffdetailsModel();
			$SmstemplatesModel = new SmstemplatesModel();
			$EmailtemplatesModel = new EmailtemplatesModel();
			$user_detail = $StaffdetailsModel->where('user_id', $id)->first();
			if($user_detail['salay_type'] == 1){
				$wages_type = lang('Membership.xin_per_month');
				$salary_title = lang('Employees.xin_basic_salary');
				$ibasic_salary = $user_detail['basic_salary'];
				$shwbasic_salary = $user_detail['basic_salary'];
				
			} else {
				$wages_type = lang('Main.xin_per_hour');
				$salary_title = lang('Employees.xin_hourly_rate');
				$shwbasic_salary = $user_detail['hourly_rate'];
				$hour_worked = total_hours_worked_payslip($id,$salary_month);
				$ibasic_salary = $user_detail['hourly_rate'] * $hour_worked;
			}
				
			// net salary
			$inet_salary = $ibasic_salary + $allowance_amount + $commissions_amount + $other_payments_amount - $statutory_deductions_amount;
			// add info
			$eis_value = $this->request->getPost('eis_value',FILTER_SANITIZE_STRING);
			$employer_eis_value = $this->request->getPost('employer_eis_value',FILTER_SANITIZE_STRING);
			$socso_value = $this->request->getPost('socso_value',FILTER_SANITIZE_STRING);
			$employer_socso_value = $this->request->getPost('employer_socso_value',FILTER_SANITIZE_STRING);
			$epf_value = $this->request->getPost('epf_value',FILTER_SANITIZE_STRING);
			$employer_epf_value = $this->request->getPost('employer_epf_value',FILTER_SANITIZE_STRING);
			$pcb_tax_value = $this->request->getPost('pcb_tax_value',FILTER_SANITIZE_STRING);
			$ihrdf_value = $this->request->getPost('ihrdf_value',FILTER_SANITIZE_STRING);
			$einet_salary = $this->request->getPost('inet_salary',FILTER_SANITIZE_STRING);
			$payslip_comments = $this->request->getPost('payslip_comments',FILTER_SANITIZE_STRING);
			$data = [
				'payslip_key'  => $generate_key,
				'company_id'  => $company_id,
				'staff_id' => $id,
				'salary_month'  => $salary_month,
				'wages_type' => $user_detail['salay_type'],
				'payslip_type' => 'full_monthly',
				'year_to_date' => date('d-m-Y'),
				'basic_salary' => $ibasic_salary,
				'daily_wages' => 0,
				'hours_worked' => 0,
				'total_allowances' => $allowance_amount,
				'total_commissions' => $commissions_amount,
				'total_statutory_deductions' => $statutory_deductions_amount,
				'total_other_payments' => $other_payments_amount,
				'net_salary' => $einet_salary,
				'payment_method' => 1,
				'pay_comments' => $payslip_comments,
				'is_payment' => 1,
				'is_advance_salary_deduct' => $is_advance_deducted,
				'advance_salary_amount' => $deduct_salary,
				'is_loan_deduct' => $lo_is_advance_deducted,
				'loan_amount' => $lo_deduct_salary,
				'eis_value' => $eis_value,
				'employer_eis_value' => $employer_eis_value,
				'epf_value' => $epf_value,
				'employer_epf_value' => $employer_epf_value,
				'socso_value' => $socso_value,
				'employer_socso_value' => $employer_socso_value,
				'pcb_tax_value' => $pcb_tax_value,
				'ihrdf_value' => $ihrdf_value,
				'status' => 0,
				'created_at' => date('Y-m-d')
			];
			$PayrollModel = new PayrollModel();
			$result = $PayrollModel->insert($data);
			$payroll_id = $PayrollModel->insertID();
			$Return['csrf_hash'] = csrf_hash();	
			if ($result == TRUE) {
				if($count_allowances > 0) {
					foreach($salary_allowances as $sl_allowances) {
						$allowance_amount = $sl_allowances['contract_amount'];
						$allowance_data = array(
						'payslip_id' => $payroll_id,
						'staff_id' => $id,
						'salary_month' => date('Y-m'),
						'pay_title' => $sl_allowances['option_title'],
						'pay_amount' => $allowance_amount,
						'is_taxable' => $sl_allowances['contract_tax_option'],
						'is_fixed' => $sl_allowances['is_fixed'],
						'created_at' => date('d-m-Y h:i:s')
						);
						$PayallowancesModel = new PayallowancesModel();
						$PayallowancesModel->insert($allowance_data);
					}
				}
				if($count_commissions > 0) {
					foreach($salary_commissions as $sl_salary_commissions) {
						$commissions_amount = $sl_salary_commissions['contract_amount'];
						$commissions_data = array(
						'payslip_id' => $payroll_id,
						'staff_id' => $id,
						'salary_month' => date('Y-m'),
						'pay_title' => $sl_salary_commissions['option_title'],
						'pay_amount' => $commissions_amount,
						'is_taxable' => $sl_salary_commissions['contract_tax_option'],
						'is_fixed' => $sl_salary_commissions['is_fixed'],
						'created_at' => date('d-m-Y h:i:s')
						);
						$PaycommissionsModel = new PaycommissionsModel();
						$PaycommissionsModel->insert($commissions_data);
					}
				}
				if($count_other_payments > 0) {
					foreach($other_payments as $sl_other_payments) {
						$other_payments_amount = $sl_other_payments['contract_amount'];
						$otherpayments_data = array(
						'payslip_id' => $payroll_id,
						'staff_id' => $id,
						'salary_month' => date('Y-m'),
						'pay_title' => $sl_other_payments['option_title'],
						'pay_amount' => $other_payments_amount,
						'is_taxable' => $sl_other_payments['contract_tax_option'],
						'is_fixed' => $sl_other_payments['is_fixed'],
						'created_at' => date('d-m-Y h:i:s')
						);
						$PayotherpaymentsModel = new PayotherpaymentsModel();
						$PayotherpaymentsModel->insert($otherpayments_data);
					}
				}
				if($count_statutory_deductions > 0) {
					foreach($statutory_deductions as $sl_salary_statutory_deductions) {
						$statutory_deductions_amount = $sl_salary_statutory_deductions['contract_amount'];
						$statutorydeductions_data = array(
						'payslip_id' => $payroll_id,
						'staff_id' => $id,
						'salary_month' => date('Y-m'),
						'pay_title' => $sl_salary_statutory_deductions['option_title'],
						'pay_amount' => $statutory_deductions_amount,
						'is_fixed' => $sl_salary_statutory_deductions['is_fixed'],
						'created_at' => date('d-m-Y h:i:s')
						);
						$PaystatutorydeductionsModel = new PaystatutorydeductionsModel();
						$PaystatutorydeductionsModel->insert($statutorydeductions_data);
					}
				}
				$SystemModel = new SystemModel();
				$xin_system = $SystemModel->where('setting_id', 1)->first();
				if($xin_system['enable_email_notification'] == 1){
					// Send mail start
					$istaff_info = $UsersModel->where('user_id', $id)->first();
					$itemplate = $EmailtemplatesModel->where('template_id', 17)->first();
					$isubject = str_replace("{month_year}",$salary_month,$itemplate['subject']);
					$ibody = html_entity_decode($itemplate['message']);
					$fbody = str_replace(array("{site_name}","{month_year}"),array($company_info['company_name'],$salary_month),$ibody);
					timehrm_mail_data($company_info['email'],$company_info['company_name'],$istaff_info['email'],$isubject,$fbody);
					// Send mail end
				}
				if($xin_system['enable_sms_notification'] == 1){
					$itemplate = $SmstemplatesModel->where('template_id', 6)->first();
					$istaff_info = $UsersModel->where('user_id', $id)->first();
					$ibody = html_entity_decode($itemplate['message']);
					$fbody = str_replace(array("{firstname}","{salary_amount}"),array($istaff_info['first_name'],$inet_salary),$ibody);
					timehrm_sms_data($istaff_info['contact_number'],$fbody);
				}
				$Return['result'] = lang('Success.ci_payslip_generated_added_msg');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
			exit;
		} else {
			$Return['error'] = lang('Main.xin_error_msg');
			$this->output($Return);
			exit;
		}
	}
	public function payroll_chart() {
		
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$ConstantsModel = new ConstantsModel();
		//$InvoicesModel = new InvoicesModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		
		/* Define return | here result is used to return user data and error for error message *///
		$Return = array('payslip_month'=>'', 'paid_inv_label'=>'','payroll_amount'=>'');
		$payslip_month = array();
		$paid_payroll = array();
		$someArray = array();
		$j=0;
		for ($i = 0; $i <= 11; $i++) 
		{
		   $months = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));		   
		   $paid_amount = erp_payroll($months);
		   $paid_payroll[] = $paid_amount;
		   $payslip_month[] = date("M Y",strtotime($months));		   
		}
		$strtotime = $payslip_month;
		$Return['payslip_month'] = $strtotime;
		$Return['paid_inv_label'] = lang('Dashboard.left_payroll');
		$Return['payroll_amount'] = $paid_payroll;
		$this->output($Return);
		exit;
	}
	public function staff_payroll_chart() {
		
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$ConstantsModel = new ConstantsModel();
		//$InvoicesModel = new InvoicesModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
			$staff_id = $usession['sup_user_id'];
		} else {
			$company_id = $usession['sup_user_id'];
			$staff_id = $usession['sup_user_id'];
		}
		
		/* Define return | here result is used to return user data and error for error message *///
		$Return = array('payslip_month'=>'', 'paid_inv_label'=>'','payroll_amount'=>'');
		$payslip_month = array();
		$paid_payroll = array();
		$someArray = array();
		$j=0;
		for ($i = 0; $i <= 11; $i++) 
		{
		   $months = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));		   
		   $paid_amount = staff_payroll($months,$staff_id);
		   $paid_payroll[] = $paid_amount;
		   $payslip_month[] = date("M Y",strtotime($months));		   
		}
		$strtotime = $payslip_month;
		$Return['payslip_month'] = $strtotime;
		$Return['paid_inv_label'] = lang('Dashboard.left_payroll');
		$Return['payroll_amount'] = $paid_payroll;
		$this->output($Return);
		exit;
	}
	// read record
	public function read_advance_salary()
	{
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		$id = $request->getGet('field_id');
		$data = [
				'field_id' => $id,
			];
		if($session->has('sup_username')){
			return view('erp/payroll/dialog_advance_salary', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// read record
	public function read_loan()
	{
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		$id = $request->getGet('field_id');
		$data = [
				'field_id' => $id,
			];
		if($session->has('sup_username')){
			return view('erp/payroll/dialog_loan', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	 // read record
	public function read_payroll()
	{
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		$id = $request->getGet('field_id');
		$data = [
				'field_id' => $id,
			];
		if($session->has('sup_username')){
			return view('erp/payroll/dialog_make_payment', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// delete record
	public function delete_advance_salary() {
		
		if($this->request->getPost('type')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$id = udecode($this->request->getPost('_token',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$AdvancesalaryModel = new AdvancesalaryModel();
			$result = $AdvancesalaryModel->where('advance_salary_id', $id)->delete($id);
			if ($result == TRUE) {
				$Return['result'] = lang('Success.ci_advance_salary_deleted_msg');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
	// delete record
	public function delete_loan() {
		
		if($this->request->getPost('type')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$id = udecode($this->request->getPost('_token',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$AdvancesalaryModel = new AdvancesalaryModel();
			$result = $AdvancesalaryModel->where('advance_salary_id', $id)->delete($id);
			if ($result == TRUE) {
				$Return['result'] = lang('Success.ci_loan_deleted_msg');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
	// delete record
	public function delete_payslip() {
		
		if($this->request->getPost('type')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$id = udecode($this->request->getPost('_token',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$PayrollModel = new PayrollModel();
			$UsersModel = new UsersModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$result = $PayrollModel->where('payslip_id', $id)->where('company_id', $company_id)->delete($id);
			if ($result == TRUE) {
				$Return['result'] = lang('Payroll.xin_payroll_deleted');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
}
