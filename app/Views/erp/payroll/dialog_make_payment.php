<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\ContractModel;
use App\Models\StaffdetailsModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\I18n\TimeDifference;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();		
$ContractModel = new ContractModel();	
$SystemModel = new SystemModel();
$StaffdetailsModel = new StaffdetailsModel();

$xin_system = erp_company_settings();
/* Payroll view
*/
$get_animate = '';
if($request->getGet('data') === 'payroll' && $request->getGet('field_id')){
	$user_id = udecode($field_id);
	$payment_date = $request->getGet('payment_date');
	$hpayment_date = udecode($request->getGet('payment_date'));
	$advance_salary = $request->getGet('advance_salary');
	$loan = $request->getGet('loan');
	$user_info = $UsersModel->where('user_id', $user_id)->first();
	$user_detail = $StaffdetailsModel->where('user_id', $user_info['user_id'])->first();
	if($user_detail['salay_type'] == 1){
		$wages_type = lang('Membership.xin_per_month');
		$salary_title = lang('Employees.xin_basic_salary');
		$ibasic_salary = $user_detail['basic_salary'];
		$shwbasic_salary = $user_detail['basic_salary'];
		
	} else {
		$wages_type = lang('Main.xin_per_hour');
		$salary_title = lang('Employees.xin_hourly_rate');
		$shwbasic_salary = $user_detail['hourly_rate'];
		$hour_worked = total_hours_worked_payslip($user_id,$hpayment_date);
		$ibasic_salary = $user_detail['hourly_rate'] * $hour_worked;
	}
	//$ibasic_salary = $user_detail['basic_salary'];

	// Salary Options //
	// 1:: Allowances
	$count_allowances = $ContractModel->where('user_id',$user_id)->where('salay_type','allowances')->countAllResults();
	$salary_allowances = $ContractModel->where('user_id',$user_id)->where('salay_type','allowances')->findAll();
	$allowance_amount = 0;
	if($count_allowances > 0) {
		foreach($salary_allowances as $sl_allowances) {
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
	$count_commissions = $ContractModel->where('user_id',$user_id)->where('salay_type','commissions')->countAllResults();
	$salary_commissions = $ContractModel->where('user_id',$user_id)->where('salay_type','commissions')->findAll();
	$commissions_amount = 0;
	if($count_commissions > 0) {
		foreach($salary_commissions as $sl_salary_commissions) {
			
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
	$count_other_payments = $ContractModel->where('user_id',$user_id)->where('salay_type','other_payments')->countAllResults();
	$other_payments = $ContractModel->where('user_id',$user_id)->where('salay_type','other_payments')->findAll();
	$other_payments_amount = 0;
	if($count_other_payments > 0) {
		foreach($other_payments as $sl_other_payments) {
			
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
	$count_statutory_deductions = $ContractModel->where('user_id',$user_id)->where('salay_type','statutory')->countAllResults();
	$statutory_deductions = $ContractModel->where('user_id',$user_id)->where('salay_type','statutory')->findAll();
	$statutory_deductions_amount = 0;
	if($count_statutory_deductions > 0) {
		foreach($statutory_deductions as $sl_salary_statutory_deductions) {
			
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
	/*echo 'EIS emp: '.$eis_val; echo '<br>';
	echo 'EIS empr: '.$er_eis_val; echo '<br>';
	echo 'SOC emp: '.$socso_val; echo '<br>';
	echo 'SOC empr: '.$er_socso_val; echo '<br>';
	echo 'HRDF: '.$ihrdf; echo '<br>';
	echo 'EPF emp: '.$epf_val; echo '<br>';
	echo 'EPF empr: '.$er_epf_val; echo '<br>';
	echo 'PCB TAX: '.$pcb_tax_val; echo '<br>';*/
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
	if($advance_salary > 0){
		$advance_salary = $advance_salary;
	} else {
		$advance_salary = 0;
	}
	if($loan > 0){
		$loan = $loan;
	} else {
		$loan = 0;
	}
	$inet_salary = $ibasic_salary + $allowance_amount + $commissions_amount + $other_payments_amount + $advance_salary + $loan - $statutory_deductions_amount - $pcb_tax_val_all;
			
?>

<div class="modal-header">
  <h5 class="modal-title">
    <?= lang('Payroll.xin_payroll_make_payment');?>
    <br>
    <small class="text-muted">
    <?= lang('Employees.xin_employee_type_wages').': '.$wages_type;?>
    </small>
  </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="<?= lang('Main.xin_close');?>"> <span aria-hidden="true">×</span> </button>
</div>
<?php $attributes = array('name' => 'pay_monthly', 'id' => 'pay_monthly', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('token' => $field_id,'token2' => $payment_date);?>
<?php echo form_open('erp/payroll/add_pay_monthly', $attributes, $hidden);?>
<div class="modal-body" style="overflow:auto;">
  <h6 class="m-b-15 text-success">
    <?= $salary_title;?>
  </h6>
  <div class="row">
  <div class="col-md-12">
      <div class="form-group">
        <div class="input-group mb-3"> <span class="input-group-prepend">
        <label class="input-group-text"><i class="fas fa-money-check"></i></label>
        </span>
        <input type="text" class="form-control" placeholder="<?= lang('Employees.xin_basic_salary');?>" readonly="readonly" value="<?php echo $shwbasic_salary;?>">
      </div>
      </div>
    </div>
   </div> 
  <input type="hidden" readonly="readonly" name="eis_value" class="form-control" value="<?php echo $eis_val;?>">
  <input type="hidden" readonly="readonly" name="employer_eis_value" value="<?php echo $er_eis_val;?>" />
  <input type="hidden" readonly="readonly" name="socso_value" class="form-control" value="<?php echo $socso_val;?>">
  <input type="hidden" readonly="readonly" name="employer_socso_value" value="<?php echo $er_socso_val;?>" />
  <input type="hidden" readonly="readonly" name="epf_value" class="form-control" value="<?php echo $epf_val;?>">
  <input type="hidden" readonly="readonly" name="employer_epf_value" value="<?php echo $er_epf_val;?>" />
  <input type="hidden" readonly="readonly" name="pcb_tax_value" class="form-control" value="<?php echo $pcb_tax_val;?>">
  <input type="hidden" readonly="readonly" name="ihrdf_value" class="form-control" value="<?php echo $ihrdf_val;?>">
  <ul class="list-group list-group-flush">
    <?php if($user_detail['salay_type'] == 2){ ?>
    <?php $hour_worked = total_hours_worked_payslip($user_id,$hpayment_date); ?>
  	<li class="list-group-item py-0" style="border:0">
      <div class="table-responsive">
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td><p class="m-0 d-inline-block align-middle">
                  <?= lang('Main.xin_hours_worked');?>
                </p></td>
              <td class="text-right"><?= $hour_worked;?> hrs</td>
            </tr>
            <tr>
              <td><p class="m-0 d-inline-block align-middle">
                  <?= lang('Main.xin_total_hours_worked');?>
                </p></td>
              <td class="text-right"><?= number_to_currency($ibasic_salary, $xin_system['default_currency'],null,2);?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </li>
    <?php } ?>
   <?php if($allowance_amount > 0){?>
    <li class="list-group-item py-0" style="border:0">
      <div class="table-responsive">
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td><p class="m-0 d-inline-block align-middle">
                  <?= lang('Employees.xin_allowances');?>
                </p></td>
              <td class="text-right"><?= number_to_currency($allowance_amount, $xin_system['default_currency'],null,2);?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </li>
    <?php } ?>
    <?php if($commissions_amount > 0){?>
    <li class="list-group-item py-0" style="border:0">
      <div class="table-responsive">
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td><p class="m-0 d-inline-block align-middle">
                  <?= lang('Employees.xin_commissions');?>
                </p></td>
              <td class="text-right"><?= number_to_currency($commissions_amount, $xin_system['default_currency'],null,2);?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </li>
    <?php } ?>
    <?php if($other_payments_amount > 0){?>
    <li class="list-group-item py-0" style="border:0">
      <div class="table-responsive">
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td><p class="m-0 d-inline-block align-middle">
                  <?= lang('Employees.xin_reimbursements');?>
                </p></td>
              <td class="text-right"><?= number_to_currency($other_payments_amount, $xin_system['default_currency'],null,2);?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </li>
    <?php } ?>
    <?php if($statutory_deductions_amount > 0){?>
    <li class="list-group-item py-0" style="border:0">
      <div class="table-responsive">
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td><p class="m-0 d-inline-block align-middle">
                  <?= lang('Employees.xin_satatutory_deductions');?>
                </p></td>
              <td class="text-right"><?= number_to_currency($statutory_deductions_amount, $xin_system['default_currency'],null,2);?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </li>
    <?php } ?>
    <?php if($advance_salary > 0){?>
    <li class="list-group-item py-0" style="border:0">
      <div class="table-responsive">
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td><p class="m-0 d-inline-block align-middle">
                  <?= lang('Main.xin_advance_salary');?>
                </p></td>
              <td class="text-right"><?= number_to_currency($advance_salary, $xin_system['default_currency'],null,2);?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </li>
    <?php } ?>
    <?php if($loan > 0){?>
    <li class="list-group-item py-0" style="border:0">
      <div class="table-responsive">
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td><p class="m-0 d-inline-block align-middle">
                  <?= lang('Main.xin_loan');?>
                </p></td>
              <td class="text-right"><?= number_to_currency($loan, $xin_system['default_currency'],null,2);?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </li>
    <?php } ?>
    <?php if($xin_system['is_enable_ml_payroll']==1){ ?>
    <li class="list-group-item py-0" style="border:0">
      <div class="table-responsive">
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td><p class="m-0 d-inline-block align-middle">
                  <?= lang('Main.xin_pcb_tax_eis_title');?>
                </p></td>
              <td class="text-right"><?= number_to_currency($eis_val, $xin_system['default_currency'],null,2);?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </li>
    <li class="list-group-item py-0" style="border:0">
      <div class="table-responsive">
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td><p class="m-0 d-inline-block align-middle">
                  <?= lang('Main.xin_pcb_tax_socso_title');?>
                </p></td>
              <td class="text-right"><?= number_to_currency($socso_val, $xin_system['default_currency'],null,2);?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </li>
    <li class="list-group-item py-0" style="border:0">
      <div class="table-responsive">
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td><p class="m-0 d-inline-block align-middle">
                  <?= lang('Main.xin_pcb_tax_epf_title');?>
                </p></td>
              <td class="text-right"><?= number_to_currency($epf_val, $xin_system['default_currency'],null,2);?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </li>
    <li class="list-group-item py-0" style="border:0">
      <div class="table-responsive">
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td><p class="m-0 d-inline-block align-middle">
                  <?= lang('Main.xin_pcb_tax_4th_title');?>
                </p></td>
              <td class="text-right"><?= number_to_currency($pcb_tax_val, $xin_system['default_currency'],null,2);?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </li>
    <li class="list-group-item py-0" style="border:0">
      <div class="table-responsive">
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td><p class="m-0 d-inline-block align-middle">
                  <?= lang('Main.xin_ml_hrdf');?>
                </p></td>
              <td class="text-right"><?= number_to_currency($ihrdf, $xin_system['default_currency'],null,2);?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </li>
    <?php } ?>
    <input type="hidden" name="inet_salary" value="<?= $inet_salary;?>" />
    <li class="list-group-item py-0" style="border:0">
      <div class="table-responsive">
        <table class="table table-borderless mb-0">
          <tbody>
            <tr>
              <td><p class="m-0 d-inline-block align-middle"><strong class="text-success"><?php echo lang('Employees.xin_payroll_net_salary');?></strong></p></td>
              <td class="text-right"><strong class="text-success">
                <?= number_to_currency($inet_salary, $xin_system['default_currency'],null,2);?>
                </strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    </li>
  </ul>
  
  <div class="row">
  <div class="col-md-12 reject_opt">
      <div class="form-group">
        <label for="description"><?= lang('Payroll.xin_payslip_comments');?></label>
        <textarea class="form-control textarea" placeholder="<?= lang('Payroll.xin_payslip_comments');?>" name="payslip_comments" cols="30" rows="3"></textarea>
      </div>
    </div>
   </div>
</div>
<div class="modal-footer">
<?php if($inet_salary > 0) { ?>
	<button type="submit" class="btn btn-success"> <?php echo lang('Payroll.xin_payroll_make_payment');?> </button>
<?php } else {?>
<div class="alert alert-danger" role="alert">
	   <?php echo lang('Success.ci_payslip_updated_0salary_error_msg');?>
	</div>
<?php } ?>
</div>
<?= form_close(); ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });
	Ladda.bind('button[type=submit]');
	// On page load: datatable					
	$("#pay_monthly").submit(function(e){
	
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		//$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=11&data=monthly&type=add_monthly_payment&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
					Ladda.stopAll();
				} else {
					$('.payroll-modal-data').modal('toggle');
					var xin_table = $('#xin_table').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("erp/payroll/payslip_list") ?>?staff_id=0&payment_date=<?= udecode($payment_date);?>",
							type : 'GET'
						},
						"language": {
							"lengthMenu": dt_lengthMenu,
							"zeroRecords": dt_zeroRecords,
							"info": dt_info,
							"infoEmpty": dt_infoEmpty,
							"infoFiltered": dt_infoFiltered,
							"search": dt_search,
							"paginate": {
								"first": dt_first,
								"previous": dt_previous,
								"next": dt_next,
								"last": dt_last
							},
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					xin_table.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});	
</script>
<?php } ?>
<style type="text/css">
.list-group-item {
    padding: 0 !important;
}
</style>
