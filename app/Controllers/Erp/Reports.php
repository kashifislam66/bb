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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\MainModel;
use App\Models\LeaveModel;
use App\Models\ConstantsModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\StaffdetailsModel;

class Reports extends BaseController {

	public function leave_report_export()
	{
		$spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

		$sheet = $spreadsheet->getActiveSheet();
		
		$sheet->setCellValue('E1', 'VACATION ACCRUALS');
		$sheet->MergeCells('E1:K1');

		// manually set table data value
		$sheet->setCellValue('A2', lang('Dashboard.left_department')); 
		$sheet->setCellValue('B2', lang('Main.xin_salary'));
		$sheet->setCellValue('C2', lang('Dashboard.dashboard_employee'));
		$sheet->setCellValue('D2', lang('Main.xin_position')); 
		$sheet->setCellValue('E2', lang('Main.dashboard_xin_status'));
		$sheet->setCellValue('F2', lang('Main.xin_doh'));
		$sheet->setCellValue('G2', lang('Main.xin_yos'));
		$sheet->setCellValue('H2', lang('Main.xin_no_of_days_entitled'));
		$sheet->setCellValue('I2', lang('Main.xin_anniversary_date'));
		$sheet->setCellValue('J2', lang('Main.xin_accrual_date'));
		$sheet->setCellValue('K2', lang('Main.xin_no_of_days_accrued'));
		$sheet->setCellValue('L2', lang('Main.xin_carry_over_days'));
		$sheet->setCellValue('M2', lang('Main.xin_days_owed'));
		$sheet->setCellValue('N2', lang('Main.xin_days_taken'));
		$sheet->setCellValue('O2', lang('Main.xin_no_of_days_remaining'));
		
		$SystemModel = new SystemModel();
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$MainModel = new MainModel();
		$LeaveModel = new LeaveModel();
		$ConstantsModel = new ConstantsModel();
		$DepartmentModel = new DepartmentModel();
		$DesignationModel = new DesignationModel();
		$StaffdetailsModel = new StaffdetailsModel();

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$request = \Config\Services::request();
		
		$owed = $this->request->getPost('month',FILTER_SANITIZE_STRING);
		$leave_type_id = $this->request->getPost('leave_type',FILTER_SANITIZE_STRING);

		$com_xin_system = erp_company_settings();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$departments = $DepartmentModel->where('company_id',$user_info['company_id'])->orderBy('department_id', 'ASC')->findAll();
			$designations = $DesignationModel->where('company_id',$user_info['company_id'])->orderBy('designation_id', 'ASC')->findAll();
			$get_staff = $UsersModel->where('company_id',$user_info['company_id'])->where('user_type','staff')->orderBy('user_id', 'ASC')->findAll();
		} else {
			$departments = $DepartmentModel->where('company_id',$usession['sup_user_id'])->orderBy('department_id', 'ASC')->findAll();
			$designations = $DesignationModel->where('company_id',$usession['sup_user_id'])->orderBy('designation_id', 'ASC')->findAll();
			$get_staff = $UsersModel->where('company_id',$usession['sup_user_id'])->where('user_type','staff')->orderBy('user_id', 'ASC')->findAll();
		}
		
		$count = 3;

		foreach($get_staff as $_staff)
		{
			$staff_view = $StaffdetailsModel->where('user_id',$_staff['user_id'])->first();
			$departments = $DepartmentModel->where('department_id',$staff_view['department_id'])->first();
			$designations = $DesignationModel->where('designation_id',$staff_view['designation_id'])->first();
			$yos = Time::parse($staff_view['date_of_joining']);
			// job type
			if($staff_view['job_type']==1){
				$job_type = lang('Main.xin_permanent');
			} else {
				$job_type = lang('Main.xin_part_time');
			}
			$datetime1 = date_create($staff_view['date_of_joining']);
			$datetime2 = date_create(date('Y-m-d'));
			$interval = date_diff($datetime1, $datetime2);
			$accrued= $interval->format('%m');
			$days_entitled = 24;		
			$new_accrued = 24 / 12 * $accrued;	
			// owed
		//	$owed = 9;
			//$leave_type_id = 190;
			//leave
			$leave_info = $LeaveModel->where('leave_type_id',$leave_type_id)->where('leave_month',$owed)->first();
			if($staff_view['leave_options'] == '') {
				 $days_assigned = 0;
			} else {
				$ileave_option = unserialize($staff_view['leave_options']);
				$days_assigned = $ileave_option[$leave_type_id][$owed];
			}
			
			$count_l = count_employee_leave($_staff['user_id'],$leave_type_id,$owed);
			$rem_leave = $days_assigned-$count_l;
							
			$sheet->setCellValue('A' . $count, $departments['department_name']);

			$sheet->setCellValue('B' . $count, number_to_currency($staff_view['basic_salary'], $com_xin_system['default_currency'],null,2));

			$sheet->setCellValue('C' . $count, $_staff['first_name'].' '.$_staff['last_name']);

			$sheet->setCellValue('D' . $count, $designations['designation_name']);
			
			$sheet->setCellValue('E' . $count, $job_type);
			
			$sheet->setCellValue('F' . $count, set_date_format($staff_view['date_of_joining']));
			
			$sheet->setCellValue('G' . $count, $yos->humanize());
			
			$sheet->setCellValue('H' . $count, "$days_entitled");
			
			$sheet->setCellValue('I' . $count, $staff_view['date_of_joining']);
			
			$sheet->setCellValue('J' . $count, date('Y-m-d'));
			
			$sheet->setCellValue('K' . $count, "$new_accrued");
			
			$sheet->setCellValue('L' . $count, "0");
			
			$sheet->setCellValue('M' . $count, "$days_assigned");
			
			$sheet->setCellValue('N' . $count, "$count_l");
			
			$sheet->setCellValue('O' . $count, "$rem_leave");

			$count++;
		}
		$spreadsheet->getActiveSheet()->getStyle("A1:K1")->getFont()->setSize(18);
		$spreadsheet->getActiveSheet()->getStyle("A2:O2")->getFont()->setSize(13);
		foreach (range('A', 'O') as $letra) {            
            $spreadsheet->getActiveSheet()->getColumnDimension($letra)->setAutoSize(true);
		}
		$spreadsheet->getActiveSheet()->getStyle('A1:K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('37e484');
		$spreadsheet->getActiveSheet()->getStyle('A2:O2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('8baffa');
		$writer = new Xlsx($spreadsheet); // instantiate Xlsx
	 
		$filename = 'leave-report'; // set filename for excel file to be exported
	 
		header('Content-Type: application/vnd.ms-excel'); // generate excel file
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		
		$writer->save('php://output');	// download file
	}
	
	public function export_to_excel1111()
	{
		$spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

		$sheet = $spreadsheet->getActiveSheet();
		
		$sheet->setCellValue('A1', 'VACATION ACCRUALS');
		$sheet->MergeCells('A1:G1');

		// manually set table data value
		$sheet->setCellValue('A2', lang('Dashboard.left_department')); 
		$sheet->setCellValue('B2', lang('Main.xin_salary'));
		$sheet->setCellValue('C2', lang('Dashboard.dashboard_employee'));
		$sheet->setCellValue('D2', lang('Main.xin_position')); 
		$sheet->setCellValue('E2', lang('Main.dashboard_xin_status'));
		$sheet->setCellValue('F2', lang('Main.xin_doh'));
		$sheet->setCellValue('G2', lang('Main.xin_yos'));
		
		$SystemModel = new SystemModel();
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$MainModel = new MainModel();
		$LeaveModel = new LeaveModel();
		$ConstantsModel = new ConstantsModel();
		$DepartmentModel = new DepartmentModel();
		$DesignationModel = new DesignationModel();
		$StaffdetailsModel = new StaffdetailsModel();

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$request = \Config\Services::request();

		$com_xin_system = erp_company_settings();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$departments = $DepartmentModel->where('company_id',$user_info['company_id'])->orderBy('department_id', 'ASC')->findAll();
			$designations = $DesignationModel->where('company_id',$user_info['company_id'])->orderBy('designation_id', 'ASC')->findAll();
			$get_staff = $UsersModel->where('company_id',$user_info['company_id'])->where('user_type','staff')->orderBy('user_id', 'ASC')->findAll();
		} else {
			$departments = $DepartmentModel->where('company_id',$usession['sup_user_id'])->orderBy('department_id', 'ASC')->findAll();
			$designations = $DesignationModel->where('company_id',$usession['sup_user_id'])->orderBy('designation_id', 'ASC')->findAll();
			$get_staff = $UsersModel->where('company_id',$usession['sup_user_id'])->where('user_type','staff')->orderBy('user_id', 'ASC')->findAll();
		}
		
		$count = 3;

		foreach($get_staff as $_staff)
		{
			$staff_view = $StaffdetailsModel->where('user_id',$_staff['user_id'])->first();
			$departments = $DepartmentModel->where('department_id',$staff_view['department_id'])->first();
			$designations = $DesignationModel->where('designation_id',$staff_view['designation_id'])->first();
			$yos = Time::parse($staff_view['date_of_joining']);
			// job type
			if($staff_view['job_type']==1){
				$job_type = lang('Main.xin_permanent');
			} else {
				$job_type = lang('Main.xin_part_time');
			}
						
			$sheet->setCellValue('A' . $count, $departments['department_name']);

			$sheet->setCellValue('B' . $count, number_to_currency($staff_view['basic_salary'], $com_xin_system['default_currency'],null,2));

			$sheet->setCellValue('C' . $count, $_staff['first_name'].' '.$_staff['last_name']);

			$sheet->setCellValue('D' . $count, $designations['designation_name']);
			
			$sheet->setCellValue('E' . $count, $job_type);
			
			$sheet->setCellValue('F' . $count, set_date_format($staff_view['date_of_joining']));
			
			$sheet->setCellValue('G' . $count, $yos->humanize());

			$count++;
		}
		$spreadsheet->getActiveSheet()->getStyle('A2:G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('8baffa');
		$writer = new Xlsx($spreadsheet); // instantiate Xlsx
	 
		$filename = 'list-of-jaegers'; // set filename for excel file to be exported
	 
		header('Content-Type: application/vnd.ms-excel'); // generate excel file
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		
		$writer->save('php://output');	// download file
	}
	public function attendance_report()
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
		$data['title'] = lang('Dashboard.left_attendance').' | '.$xin_system['application_name'];
		$data['path_url'] = 'empty';
		$data['breadcrumbs'] = lang('Dashboard.left_attendance');

		$data['subview'] = view('erp/reports/attendance_report', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
	public function daterange_attendance_report()
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
		$data['title'] = lang('Dashboard.left_attendance').' | '.$xin_system['application_name'];
		$data['path_url'] = 'empty';
		$data['breadcrumbs'] = lang('Dashboard.left_attendance');

		$data['subview'] = view('erp/reports/daterange_attendance_report', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
	public function timesheet_report()
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
		$data['title'] = lang('Main.xin_timesheet_report').' | '.$xin_system['application_name'];
		$data['path_url'] = 'empty';
		$data['breadcrumbs'] = lang('Main.xin_timesheet_report');

		$data['subview'] = view('erp/reports/timesheet_report', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
	public function payroll_report()
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
		$data['title'] = lang('Employees.xin_employee_details').' | '.$xin_system['application_name'];
		$data['path_url'] = 'empty';
		$data['breadcrumbs'] = lang('Employees.xin_employee_details');

		$data['subview'] = view('erp/reports/payroll_report', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
	public function project_report()
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
		$data['title'] = lang('Employees.xin_employee_details').' | '.$xin_system['application_name'];
		$data['path_url'] = 'empty';
		$data['breadcrumbs'] = lang('Employees.xin_employee_details');

		$data['subview'] = view('erp/reports/project_report', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
	public function task_report()
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
		$data['title'] = lang('Employees.xin_employee_details').' | '.$xin_system['application_name'];
		$data['path_url'] = 'empty';
		$data['breadcrumbs'] = lang('Employees.xin_employee_details');

		$data['subview'] = view('erp/reports/task_report', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
	public function invoice_report()
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
		$data['title'] = lang('Employees.xin_employee_details').' | '.$xin_system['application_name'];
		$data['path_url'] = 'empty';
		$data['breadcrumbs'] = lang('Employees.xin_employee_details');

		$data['subview'] = view('erp/reports/invoice_report', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
	public function leave_report()
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
		$data['title'] = lang('Employees.xin_employee_details').' | '.$xin_system['application_name'];
		$data['path_url'] = 'empty';
		$data['breadcrumbs'] = lang('Employees.xin_employee_details');

		$data['subview'] = view('erp/reports/leave_report', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
	public function training_report()
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
		$data['title'] = lang('Employees.xin_employee_details').' | '.$xin_system['application_name'];
		$data['path_url'] = 'empty';
		$data['breadcrumbs'] = lang('Employees.xin_employee_details');

		$data['subview'] = view('erp/reports/training_report', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
	public function account_statement()
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
		$data['title'] = lang('Employees.xin_employee_details').' | '.$xin_system['application_name'];
		$data['path_url'] = 'empty';
		$data['breadcrumbs'] = lang('Employees.xin_employee_details');

		$data['subview'] = view('erp/reports/account_statement', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
	public function purchases_report()
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
		$data['title'] = lang('Inventory.xin_purchases_report').' | '.$xin_system['application_name'];
		$data['path_url'] = 'empty';
		$data['breadcrumbs'] = lang('Inventory.xin_purchases_report');

		$data['subview'] = view('erp/reports/purchases_report', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
	public function salesorder_report()
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
		$data['title'] = lang('Inventory.xin_sales_order_report').' | '.$xin_system['application_name'];
		$data['path_url'] = 'empty';
		$data['breadcrumbs'] = lang('Inventory.xin_sales_order_report');

		$data['subview'] = view('erp/reports/sales_report', $data);
		return view('erp/layout/pre_layout_main', $data); //page load
	}
}
