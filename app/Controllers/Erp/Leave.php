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
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\I18n\Time;
 
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\MainModel;
use App\Models\ShiftModel;
use App\Models\LeaveModel;
use App\Models\ConstantsModel;
use App\Models\LeaveadjustModel;
use App\Models\StaffdetailsModel;
use App\Models\SmstemplatesModel;
use App\Models\StaffapprovalsModel;
use App\Models\EmailtemplatesModel;

class Leave extends BaseController {

	public function index()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
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
			if(!in_array('leave2',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$data['title'] = lang('Dashboard.xin_manage_leaves').' | '.$xin_system['application_name'];
		$data['path_url'] = 'leave';
		$data['breadcrumbs'] = lang('Dashboard.xin_manage_leaves');

		$data['subview'] = view('erp/leave/staff_leave_list', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function leave_adjustment()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
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
			if(!in_array('leave_adjustment',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$data['title'] = lang('Main.xin_leave_adjustment').' | '.$xin_system['application_name'];
		$data['path_url'] = 'leave_adjustment';
		$data['breadcrumbs'] = lang('Main.xin_leave_adjustment');

		$data['subview'] = view('erp/leave/leave_adjustment', $data);
		return view('erp/layout/layout_main', $data); //page load
	}

	public function leave_summary_report()
	{		
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$db = \Config\Database::connect();

		$Return = array('result'=>'', 'error'=>'');
		$data['formData'] = $this->request->getPost();
		//debug($formData);

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
			if(!in_array('system_reports',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.xin_system_reports').' | '.$xin_system['application_name'];
		$data['path_url'] = 'employees';
		$data['breadcrumbs'] = lang('Dashboard.xin_system_reports');

		$data['subview'] = view('erp/leave_reports/leave_summary_reports', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	
	public function leave_status()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
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
			if(!in_array('leave2',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$data['title'] = lang('Employees.xin_employee_details').' | '.$xin_system['application_name'];
		$data['path_url'] = 'leave';
		$data['breadcrumbs'] = lang('Employees.xin_employee_details');

		$data['subview'] = view('erp/leave/leave_status', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function leave_calendar()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
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
			if(!in_array('leave_calendar',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$data['title'] = lang('Dashboard.xin_acc_calendar').' | '.$xin_system['application_name'];
		$data['path_url'] = 'meetings';
		$data['breadcrumbs'] = lang('Dashboard.xin_acc_calendar');

		$data['subview'] = view('erp/leave/calendar_leave', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function view_leave()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$LeaveModel = new LeaveModel();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$ifield_id = udecode($request->uri->getSegment(3));
		$leave_val = $LeaveModel->where('leave_id', $ifield_id)->first();
		if(!$leave_val){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type']=='staff'){
			//get request
			$status = $this->request->getGET('status');
			if($status == 0){
				update_notifications_read_status_pending('leave_settings',$ifield_id);
			} else {
				update_notifications_read_status_approved('leave_settings',$ifield_id);
			}
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Leave.xin_leave_details').' | '.$xin_system['application_name'];
		$data['path_url'] = 'leave_details';
		$data['breadcrumbs'] = lang('Leave.xin_leave_details');

		$data['subview'] = view('erp/leave/leave_details', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function view_leave_adjustment()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$LeaveadjustModel = new LeaveadjustModel();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$ifield_id = udecode($request->uri->getSegment(3));
		$leave_val = $LeaveadjustModel->where('adjustment_id', $ifield_id)->first();
		if(!$leave_val){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type']=='staff'){
			//get request
			$status = $this->request->getGET('status');
			if($status == 0){
				update_notifications_read_status_pending('leave_adjustment_settings',$ifield_id);
			} else {
				update_notifications_read_status_approved('leave_adjustment_settings',$ifield_id);
			}
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_leave_adjustment').' | '.$xin_system['application_name'];
		$data['path_url'] = 'leave_adjustment_details';
		$data['breadcrumbs'] = lang('Main.xin_leave_adjustment');

		$data['subview'] = view('erp/leave/leave_adjustment_details', $data);
		return view('erp/layout/layout_main', $data); //page load
	}	 
	// record list
	public function leave_list() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$ConstantsModel = new ConstantsModel();
		$LeaveModel = new LeaveModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$get_data = [];
		if($user_info['user_type'] == 'staff'){
					$db = \Config\Database::connect();
					$sql = "SELECT  user_id,
					company_id,
					reporting_manager 
					FROM    (SELECT * FROM `ci_erp_users_details`
					ORDER BY user_id) reporting_manager,
					(SELECT @pv := '".$usession['sup_user_id']."') initialisation
					WHERE   FIND_IN_SET(reporting_manager, @pv)
					AND     LENGTH(@pv := CONCAT(@pv, ',', user_id))";
					$query =  $db->query($sql);
					$result = $query->getResult();
					if(!empty($result)) {
						$get_data[] = $LeaveModel->where('employee_id',$usession['sup_user_id'])->orderBy('leave_id', 'ASC')->findAll();
						foreach($result as $results) {
							// print_r($results->user_id);
								
								$get_data[] = $LeaveModel->where('employee_id',$results->user_id)->findAll();
								// print_r($LeaveModel->getLastQuery()->getQuery());
							}
					} else {
						$get_data[] = $LeaveModel->where('employee_id',$usession['sup_user_id'])->orderBy('leave_id', 'ASC')->findAll();
					}
		} else {
			$get_data[] = $LeaveModel->where('company_id',$usession['sup_user_id'])->orderBy('leave_id', 'ASC')->findAll();
		}
		
		$data = array();
	
			foreach($get_data as $get_dataa) {
				// print_r($dataa); 
          foreach($get_dataa as $r) {
			  
			if(in_array('leave4',staff_role_resource()) || $user_info['user_type'] == 'company') { //edit
				$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-field_id="'. uencode($r['leave_id']) . '"><i class="feather icon-edit"></i></button></span>';
			} else {
				$edit = '';
			}
			if(in_array('leave6',staff_role_resource()) || $user_info['user_type'] == 'company') { //delete
				$delete = '<span data-toggle="tooltip" data-placement="top" data-state="danger" title="'.lang('Main.xin_delete').'"><button type="button" class="btn icon-btn btn-sm btn-light-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. uencode($r['leave_id']) . '"><i class="feather icon-trash-2"></i></button></span>';
			} else {
				$delete = '';
			}
			$view = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_view_details').'"><a href="'.site_url().'erp/view-leave-info/'.uencode($r['leave_id']).'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light"><span class="fa fa-arrow-circle-right"></span></button></a></span>';
			// leave type
			$ltype = $ConstantsModel->where('constants_id', $r['leave_type_id'])->where('type','leave_type')->first();
			if($ltype){
				$itype_name = $ltype['category_name'];
			} else {
				$itype_name = '';
			}
			// applied on
			$applied_on = set_date_format($r['created_at']);
			// get employee info
			$staff = $UsersModel->where('user_id', $r['employee_id'])->first();
			if($staff){
				$name = $staff['first_name'].' '.$staff['last_name'];
				$uname = '<div class="d-inline-block align-middle">
					<img src="'.base_url().'/public/uploads/users/thumb/'.$staff['profile_photo'].'" alt="'.$name.'" class="img-radius align-top m-r-15" style="width:40px;">
					<div class="d-inline-block">
						<h6 class="m-b-0">'.$name.'</h6>
						<p class="m-b-0">'.$staff['email'].'</p>
					</div>
				</div>';
				$combhr = $edit.$view.$delete;
			} else {
				$uname = lang('Users.xin_user_data_removed');
				$combhr = $edit.$delete;
			}
			// get leave date difference
			//$no_of_days = erp_date_difference($r['from_date'],$r['to_date']);
			
			if($r['leave_hours'] == 0.5 || $r['leave_hours'] == 1){
				$rem_leave_title = 'hr';
			} else {
				$rem_leave_title = 'hrs';
			}
		
			$idays = $r['leave_hours'].' '.$rem_leave_title;
			$count_hours = count_employee_leave_hours($r['employee_id'],$r['leave_type_id'],$r['leave_month']);
			
			$duration = set_date_format($r['from_date']).' '.lang('Employees.dashboard_to').' '.set_date_format($r['to_date']);
			$total_days = $idays;
			// leave status
			if($r['status']==1): $status = '<span class="badge badge-light-warning">'.lang('Main.xin_pending').'</span>';
			elseif($r['status']==2): $status = '<span class="badge badge-light-success">'.lang('Main.xin_approved').'</span>';
			elseif($r['status']==3): $status = '<span class="badge badge-light-danger">'.lang('Main.xin_rejected').'</span>';
			else: $status = '<span class="badge badge-light-warning">'.lang('Main.xin_pending').'</span>'; endif;
			$combhr = $edit.$view.$delete;
			$icname = '
				'.$uname.'
				<div class="overlay-edit">
					'.$combhr.'
				</div>';
			$data[] = array(
				$icname,
				$itype_name,
				$total_days,
				$duration,
				$applied_on,
				$status
			);
			
		}
		
		}
		
          $output = array(
               //"draw" => $draw,
			   "data" => $data
            );
          echo json_encode($output);
          exit();
     }
	 // record list
	public function leave_adjustment_list() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$ConstantsModel = new ConstantsModel();
		$LeaveadjustModel = new LeaveadjustModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$get_data = $LeaveadjustModel->where('employee_id',$usession['sup_user_id'])->orderBy('adjustment_id', 'ASC')->findAll();
		} else {
			$get_data = $LeaveadjustModel->where('company_id',$usession['sup_user_id'])->orderBy('adjustment_id', 'ASC')->findAll();
		}
		$data = array();
		
          foreach($get_data as $r) {
			  
			if(in_array('leave_adjustment2',staff_role_resource()) || $user_info['user_type'] == 'company') { //edit
				$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-field_id="'. uencode($r['adjustment_id']) . '"><i class="feather icon-edit"></i></button></span>';
			} else {
				$edit = '';
			}
			if(in_array('leave_adjustment3',staff_role_resource()) || $user_info['user_type'] == 'company') { //delete
				$delete = '<span data-toggle="tooltip" data-placement="top" data-state="danger" title="'.lang('Main.xin_delete').'"><button type="button" class="btn icon-btn btn-sm btn-light-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. uencode($r['adjustment_id']) . '"><i class="feather icon-trash-2"></i></button></span>';
			} else {
				$delete = '';
			}
			if(in_array('leave_adjustment4',staff_role_resource()) || $user_info['user_type'] == 'company') { //delete
				$view = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_view_details').'"><a href="'.site_url().'erp/view-leave-adjustment/'.uencode($r['adjustment_id']).'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light"><span class="fa fa-arrow-circle-right"></span></button></a></span>';
			} else {
				$view ='';
			}

			// leave type
			$ltype = $ConstantsModel->where('constants_id', $r['leave_type_id'])->where('type','leave_type')->first();
			if($ltype){
				$itype_name = $ltype['category_name'];
			} else {
				$itype_name = '';
			}
			// applied on
			$applied_on = set_date_format($r['created_at']);
			// get employee info
			$staff = $UsersModel->where('user_id', $r['employee_id'])->first();
			if($staff){
				$name = $staff['first_name'].' '.$staff['last_name'];
				$uname = $name;
				$combhr = $edit.$view.$delete;
			} else {
				$uname = lang('Users.xin_user_data_removed');
				$combhr = $edit.$view.$delete;
			}
			
			// leave status
			if($r['status']==0): $status = '<span class="badge badge-light-warning">'.lang('Main.xin_pending').'</span>';
			elseif($r['status']==1): $status = '<span class="badge badge-light-success">'.lang('Main.xin_approved').'</span>';
			elseif($r['status']==2): $status = '<span class="badge badge-light-danger">'.lang('Main.xin_rejected').'</span>';
			else: $status = '<span class="badge badge-light-warning">'.lang('Main.xin_pending').'</span>'; endif;
			$iapplied_on = $applied_on.'<br>'.$status;
			$combhr = $edit.$view.$delete;
			$icname = '
				'.$uname.'
				<div class="overlay-edit">
					'.$combhr.'
				</div>';
			$data[] = array(
				$icname,
				$itype_name,
				$r['adjust_hours'],
				$iapplied_on,
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
	public function add_leave_adjustment() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'leave_type' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'hours_to_adjust' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'adjustment_reason' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "leave_type" => $validation->getError('leave_type'),
					"hours_to_adjust" => $validation->getError('hours_to_adjust'),
					"adjustment_reason" => $validation->getError('adjustment_reason')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$leave_type = $this->request->getPost('leave_type',FILTER_SANITIZE_STRING);
				$hours_to_adjust = $this->request->getPost('hours_to_adjust',FILTER_SANITIZE_STRING);
				$adjustment_reason = $this->request->getPost('adjustment_reason',FILTER_SANITIZE_STRING);
				$staff_id = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);	
						
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $staff_id)->first();
				// print_r($user_info); die();
				if($user_info['user_type'] == 'staff'){
					$staff_id = $user_info['user_id'];
					$company_id = $user_info['company_id'];
				} else {
					$staff_id = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
					$company_id = $usession['sup_user_id'];
				}
				
				$data = [
					'company_id'  => $company_id,
					'employee_id'  => $staff_id,
					'leave_type_id'  => $leave_type,
					'adjust_hours'  => $hours_to_adjust,
					'reason_adjustment'  => $adjustment_reason,
					'status'  => 0,
					'created_at' => date('d-m-Y h:i:s')
				];
				// print_r($data); die();
				$LeaveadjustModel = new LeaveadjustModel();
				$result = $LeaveadjustModel->insert($data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_leave_adjustment_added_msg');
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
	// |||edit record|||
	public function update_leave_adjustment() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'leave_type' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'hours_to_adjust' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'adjustment_reason' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "leave_type" => $validation->getError('leave_type'),
					"hours_to_adjust" => $validation->getError('hours_to_adjust'),
					"adjustment_reason" => $validation->getError('adjustment_reason')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$leave_type = $this->request->getPost('leave_type',FILTER_SANITIZE_STRING);
				$hours_to_adjust = $this->request->getPost('hours_to_adjust',FILTER_SANITIZE_STRING);
				$adjustment_reason = $this->request->getPost('adjustment_reason',FILTER_SANITIZE_STRING);
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
						
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
				} else {
					$company_id = $usession['sup_user_id'];
				}
				
				$data = [
					'leave_type_id'  => $leave_type,
					'adjust_hours'  => $hours_to_adjust,
					'reason_adjustment'  => $adjustment_reason,
				];
				$LeaveadjustModel = new LeaveadjustModel();
				$result = $LeaveadjustModel->update($id,$data);
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_leave_adjustment_updated_msg');
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
	public function add_leave() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$ShiftModel = new ShiftModel();
		$LeaveModel = new LeaveModel();
		$ConstantsModel = new ConstantsModel();
		$StaffdetailsModel = new StaffdetailsModel();
		$usession = $session->get('sup_username');
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();	
		if ($this->request->getPost('type') === 'add_record') {
			
			// set rules
			$rules = [
				'leave_type' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				/*'reason' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],*/
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "leave_type" => $validation->getError('leave_type'),
					//"reason" => $validation->getError('reason')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
			   $validated = $this->validate([
					'attachment' => [
						'rules'  => 'uploaded[attachment]|ext_in[attachment,jpg,jpeg,png,pdf,doc,docx]|max_size[attachment,10240]',
						'errors' => [
							'uploaded' => lang('Main.xin_error_field_text'),
							'mime_in' => lang('Main.xin_invalid_file_format')
						]
					],
				]);
				// die("fdsfds");
				$db = \Config\Database::connect();
				$leave_type = $this->request->getPost('leave_type',FILTER_SANITIZE_STRING);
				$start_date = $this->request->getPost('start_date',FILTER_SANITIZE_STRING);
				$end_date = $this->request->getPost('end_date',FILTER_SANITIZE_STRING);
				$luser_id = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
				$particular_date = $this->request->getPost('particular_date',FILTER_SANITIZE_STRING);
				$leave_hours   = '';
					// particular date code
					$clock_in = $this->request->getPost('clock_in_m',FILTER_SANITIZE_STRING);
					$clock_out = $this->request->getPost('clock_out_m',FILTER_SANITIZE_STRING);
                    
					if($clock_in !="" && $clock_out !="") {
						if(preg_match("/((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))/", $clock_in) == false || preg_match("/((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))/", $clock_out) == false) 	{
							$Return['error'] = "Invalid Time";
							if($Return['error']!=''){
							$this->output($Return);
							}
						}
					}					
					if($clock_in !="" && $clock_out !="") {
					$employee_detail = $StaffdetailsModel->where('user_id', $luser_id)->first();
					$office_shift = $ShiftModel->where('office_shift_id', $employee_detail['office_shift_id'])->first();
					$day = strtolower(date ('l'));
					$day_lunch_break = $day .'_lunch_break';
					$day_lunch_break_out = $day .'_lunch_break_out';

					$clock_in = date("H:i", strtotime($clock_in));
					$clock_out = date("H:i", strtotime($clock_out));
					$clock_in2 = $particular_date.' '.$clock_in.':00';
					$clock_out2 = $particular_date.' '.$clock_out.':00';
					
					$total_work_cin = date_create($clock_in2);
					
					$total_work_cout = date_create($clock_out2);
					$leave = date_diff($total_work_cin, $total_work_cout);
					$hours_in   = $leave->format('%h');
					$minutes_in = $leave->format('%i');
					$secounds_in = $leave->format('%s');
						if($office_shift) {
							$day_lunch_break =	$office_shift[$day_lunch_break];
							$day_lunch_break_out =	$office_shift[$day_lunch_break_out];
							if($day_lunch_break != "" && $day_lunch_break_out !="") {
								$lunch_start = date_create($particular_date.' '.$day_lunch_break. ':00');
								$lunch_end = date_create($particular_date.' '.$day_lunch_break_out. ':00');
								if(date_format($total_work_cin,'H') <  date_format($lunch_start,'H') && date_format($total_work_cout,'H') > date_format($lunch_end,'H')) {
									$lunch_diffrence = date_diff($lunch_start, $lunch_end);
									$hours_break   = $lunch_diffrence->format('%h');
									$minutes_break = $lunch_diffrence->format('%i');
									$secounds_break = $lunch_diffrence->format('%s');

									$in_time_minuts = $hours_in .":".$minutes_in .":".$secounds_in;
									$break_time_minuts = $hours_break .":".$minutes_break .":".$secounds_break;
									$break_time_minuts_year = date_create(date($particular_date.' '.$break_time_minuts));
									$in_time_minuts_year = date_create(date($particular_date.' '.$in_time_minuts));
									$difreence_break_in = date_diff($in_time_minuts_year, $break_time_minuts_year);
									// print_r($difreence_break_in->format('%h:%i:%s'));echo "difreence_break_in<br>";
									$leave_hours = $difreence_break_in->format('%h');		
								} else {
									
									$leave_hours   = $leave->format('%h');
								}
							}
						}else {
									
							$leave_hours   = $leave->format('%h');
						}
					
					}
				$UsersModel = new UsersModel();
				
				$user_info = $UsersModel->where('user_id', $luser_id)->first();
				if($start_date !='' && $end_date!='') {
			
				$sql = "SELECT time_attendance_id
				FROM `ci_timesheet`
				WHERE  employee_id = ".$user_info['user_id']." AND company_id = ".$user_info['company_id']." AND attendance_date BETWEEN CAST('".$start_date."' AS DATE) AND CAST('".$end_date."' AS DATE)";
				$query =  $db->query($sql);
				$result = $query->getNumRows();
				if($result > 0) {
					$Return['error'] = lang('You Already Apply attendance on this Date');
							if($Return['error']!=''){
								$Return['csrf_hash'] = csrf_hash();
								$this->output($Return);
							}
				}
			} else {
				
				$sql = "SELECT time_attendance_id
				FROM `ci_timesheet`
				WHERE employee_id = ".$user_info['user_id']." AND company_id = ".$user_info['company_id']." 
				AND (DATE_FORMAT(clock_in, '%Y-%m-%d %H:%i') BETWEEN DATE_FORMAT('".$clock_in2."', '%Y-%m-%d %H:%i') 
				AND DATE_FORMAT('".$clock_in2."', '%Y-%m-%d %H:%i')
				OR DATE_FORMAT(clock_out, '%Y-%m-%d %H:%i') BETWEEN DATE_FORMAT('".$clock_out2."', '%Y-%m-%d %H:%i') 
				AND DATE_FORMAT('".$clock_out2."', '%Y-%m-%d %H:%i'))";
				$query =  $db->query($sql);
				$result = $query->getNumRows();
				// print_r($db->getLastQuery()->getQuery()); die();
				if($result > 0) {
					$Return['error'] = lang('You Already Apply attendance on this Date');
							if($Return['error']!=''){
								$Return['csrf_hash'] = csrf_hash();
								$this->output($Return);
							}
				}

			}
				// print_r($result); die();
				
				//$leave_half_day = $this->request->getPost('leave_half_day',FILTER_SANITIZE_STRING);
				$remarks = $this->request->getPost('remarks',FILTER_SANITIZE_STRING);
				$reason = $remarks;
				
				
				
				$cleave_user_info = $UsersModel->where('user_id', $luser_id)->first();
				if($cleave_user_info['user_type'] == 'staff'){
					$icompany_id = $cleave_user_info['company_id'];
				} else {
					$icompany_id = $usession['sup_user_id'];
				}
				// check days
				// get db
				if($start_date !='' && $end_date!='') {
					$cistart_date = strtotime($start_date);
					$ciend_date = strtotime($end_date);
					if($cistart_date > $ciend_date){
						$Return['error'] = lang('Main.xin_start_date_less_than_end_date');
					}
					$db      = \Config\Database::connect();	
					$form_dates = date_range($start_date,$end_date);
					// print_r($form_dates); die();
					foreach( $form_dates as  $fdate ) {
						// leave application
						$builder = $db->table('ci_leave_applications');
						$builder->where('"'. $fdate. '" BETWEEN from_date AND to_date');
						$builder->where('employee_id', $luser_id);
						$builder->where('leave_type_id', $leave_type);
						$builder->where('status!=', 3);
						$query = $builder->get();
						$FieldCount = $query->getNumRows();
						if($FieldCount > 0) {
							$Return['error'] = lang('Main.xin_already_applied_same_date').' '.$fdate;
							if($Return['error']!=''){
								$Return['csrf_hash'] = csrf_hash();
								$this->output($Return);
							}
						}
					}	
				}
				//check
				if(($start_date=='' || $end_date=='') && $leave_hours==''){
					$Return['error'] = lang('Main.xin_you_have_to_select_leave_hours');
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
				if($leave_hours == 11){
					$dec_leave_hours = $this->request->getPost('dec_leave_hours',FILTER_SANITIZE_STRING);
					if($dec_leave_hours == ''){
						$Return['error'] = lang('Main.xin_enter_leave_hours');
					}
					$leave_hours = $dec_leave_hours;
				} else {
					$leave_hours = $leave_hours;
				}
				//$aaano_of_days = erp_date_difference($start_date,$end_date);
				//$Return['error'] = $aaano_of_days;
				if($Return['error']!=''){
					$this->output($Return);
				}
				
				$leave_user_info = $UsersModel->where('user_id', $luser_id)->first();
				if($leave_user_info['user_type'] == 'staff'){
					$leave_types = $ConstantsModel->where('constants_id',$leave_type)->where('type','leave_type')->first();
				} else {
					$leave_types = $ConstantsModel->where('constants_id',$leave_type)->where('type','leave_type')->first();
				}
				$employee_detail = $StaffdetailsModel->where('user_id', $luser_id)->first();				
				$ileave_option = unserialize($employee_detail['leave_options']);
				$icparticular_date = strtotime($particular_date);
				$date_day = date('l', $icparticular_date);
				///particular date check as weekday
				$employee_detail = $StaffdetailsModel->where('user_id', $luser_id)->first();
				$office_shift = $ShiftModel->where('office_shift_id', $employee_detail['office_shift_id'])->first();
				/*if($date_day == 'Saturday' || $date_day == 'Sunday') {
					$Return['error'] = lang('Main.xin_cant_apply_leave_offdays');
				}*/
				if($start_date == '' && $end_date == '') {
					if($office_shift) {
						if($date_day == 'Monday') {
							if($office_shift['monday_in_time']==''){
								$Return['error'] = lang('Main.xin_cant_apply_leave_offdays');
							}
						} else if($date_day == 'Tuesday') {
							if($office_shift['tuesday_in_time']==''){
								$Return['error'] = lang('Main.xin_cant_apply_leave_offdays');
							}
						} else if($date_day == 'Wednesday') {
							if($office_shift['wednesday_in_time']==''){
								$Return['error'] = lang('Main.xin_cant_apply_leave_offdays');
							}
						} else if($date_day == 'Thursday') {
							if($office_shift['thursday_in_time']==''){
								$Return['error'] = lang('Main.xin_cant_apply_leave_offdays');
							}
						} else if($date_day == 'Friday') {
							if($office_shift['friday_in_time']==''){
								$Return['error'] = lang('Main.xin_cant_apply_leave_offdays');
							}
						} else if($date_day == 'Saturday') {
							if($office_shift['saturday_in_time']==''){
								$Return['error'] = lang('Main.xin_cant_apply_leave_offdays');
							}
						} else if($date_day == 'Sunday') {
							if($office_shift['sunday_in_time']==''){
								$Return['error'] = lang('Main.xin_cant_apply_leave_offdays');
							}
						}
					}
					if($Return['error']!=''){
						$Return['csrf_hash'] = csrf_hash();
						$this->output($Return);
					}
				}
				// check same day leave
				if($start_date == '') {
					$count_same_day = count_sameday_leave($luser_id,$particular_date);
					if($count_same_day > 0){
						$Return['error'] = lang('Main.xin_already_applied_for_this_date').' '.$particular_date;
					}
				} else {
					$count_same_day = count_sameday_leave($luser_id,$start_date);
					if($count_same_day > 0){
						$Return['error'] = lang('Main.xin_already_applied_for_this_date').' '.$start_date;
					}
				}
				if($Return['error']!=''){
					$Return['csrf_hash'] = csrf_hash();
					$this->output($Return);
				}
				if($start_date == '') {
					// holidays
					$ibuilder = $db->table('ci_holidays');
					$ibuilder->where('"'. $particular_date. '" BETWEEN start_date AND end_date');
					$ibuilder->where('company_id', $icompany_id);
					$ibuilder->where('is_publish', 1);
					$queryh = $ibuilder->get();
					$HolidayCount = $queryh->getNumRows();
					if($HolidayCount > 0) {
						$Return['error'] = lang('Main.xin_already_holiday_date').' '.$fdate;
						if($Return['error']!=''){
							$Return['csrf_hash'] = csrf_hash();
							$this->output($Return);
						}
					}
					$current_date = $particular_date;
					$istart_date = strtotime($current_date);
					$get_month = date('n', $istart_date);
					$leave_year = date('Y', $istart_date);					
					// check leave accruals
					$iistart_date = $current_date;
					$iiend_date = $current_date;
				//	$itinc = final_staff_leave_accruals($luser_id,$leave_type,$leave_year);
					//$Return['error'] = $staff_leave_accruals.'__ here..';
					//$tinc = count_employee_leave($luser_id,$leave_type,$get_month);
					//$count_hours = count_employee_leave_hours($luser_id,$leave_type,$get_month);
					$tinc = count_approved_leave_hours($luser_id,$leave_type,$get_month,$leave_year);
					// count hours total
					//$tinc = $itinc;// + $count_hours;
					$fday_hours = $tinc + $leave_hours;
					$cfleave_hours = $leave_hours;
				} else {
					 
					$istart_date = strtotime($start_date);
					$no_of_days = erp_leave_date_difference($luser_id,$start_date,$end_date);
					$get_month = date('n', $istart_date);
					$leave_year = date('Y', $istart_date);
					$iistart_date = $start_date;
					$iiend_date = $end_date;
					//$itinc = count_employee_leave_hours($luser_id,$leave_type,$get_month,$leave_year);
					//$itinc = final_staff_leave_accruals($luser_id,$leave_type,$leave_year);
					//$tinc = count_employee_leave($luser_id,$leave_type,$get_month);
					$tinc = count_approved_leave_hours($luser_id,$leave_type,$get_month,$leave_year);
					// count hours total
					//$tinc = $itinc ;//+ $count_hours;
					$ifday_hours = $no_of_days;
					$fday_hours = $ifday_hours + $tinc;
					$cfleave_hours = $ifday_hours;
				}
				$itinc = final_staff_leave_accruals($luser_id,$leave_type,$leave_year);
				// ifdisablel leave accrual
				$ifield_one = unserialize($leave_types['field_one']);
				$iassigned_hours = unserialize($employee_detail['assigned_hours']);
				if(isset($ifield_one['enable_leave_accrual']) && $ifield_one['enable_leave_accrual'] == 0){
					// quota assignment year
					$ejoining_date = Time::parse($employee_detail['date_of_joining']);
					$curr_date    = Time::parse(date('Y-m-d'));
					$diff_year_quota = $ejoining_date->difference($curr_date);
					$fyear_quota = $diff_year_quota->getYears();
					
					if(isset($iassigned_hours[$leave_type])) {
						$qdays_per_year = $iassigned_hours[$leave_type];
					} else {
						$qdays_per_year = 0;
					}
					$days_per_year = $qdays_per_year;
					$dis_rem_leave = $days_per_year - $tinc;
					if($dis_rem_leave < 0 || $dis_rem_leave == 0){
						$Return['error'] = lang('Main.xin_hr_cant_appply_leave_quota_completed');
					} else if($fday_hours > $days_per_year){
						if($dis_rem_leave == 1){
							$rem_leave_title = lang('Main.xin_leave_hour');
						} else {
							$rem_leave_title = lang('Main.xin_leave_hours');
						}
						$Return['error'] = lang('Main.xin_hr_cant_appply_morethan').$dis_rem_leave.' '.$rem_leave_title;
					}
					if($Return['error']!=''){
						$Return['csrf_hash'] = csrf_hash();
						$this->output($Return);
					}
				} else {
					$fyear_quota = 0;
					$accrual_disable_hr = 0;
					$days_per_year = $ileave_option[$leave_type][$get_month];
				}
				/*if($fday_hours > $accrual_disable_hr){
					$Return['error'] = $ifield_one['quota_assign'][$fyear_quota].'__'.$days_per_year.'_Y'.$fyear_quota;
				} else {
					$Return['error'] = $ifield_one['quota_assign'][$fyear_quota].'__'.$days_per_year.'_Y'.$fyear_quota;
				}
				
				if($Return['error']!=''){
					$Return['csrf_hash'] = csrf_hash();
					$this->output($Return);
				}*/
				
				
				if($Return['error']!=''){
					$Return['csrf_hash'] = csrf_hash();
					$this->output($Return);
				}
				
				//leave carry over
				$carry_over = check_leave_carry_over_limit($luser_id,$leave_type,$leave_year);
				//$Return['error'] = $carry_over.'_';
				// leave negative
				$negative_quota = check_negative_leaves($leave_type);
				$newneg_leave = $itinc + $negative_quota + $carry_over;
				//$Return['error'] = $cfleave_hours.'_'.$itinc.'_'.$negative_quota.'=='.$newneg_leave;
				if($Return['error']!=''){
					$Return['csrf_hash'] = csrf_hash();
					$this->output($Return);
				}
				if($fday_hours > $days_per_year){
					if($newneg_leave == $cfleave_hours) {
					} else if($cfleave_hours > $newneg_leave) {
						if($newneg_leave == 1){
							$rem_leave_title = lang('Main.xin_leave_hour');
						} else {
							$rem_leave_title = lang('Main.xin_leave_hours');
						}
						if($newneg_leave < 0 || $newneg_leave == 0){
							$Return['error'] = lang('Main.xin_hr_cant_appply_leave_quota_completed');
						} else {
							$Return['error'] = lang('Main.xin_hr_cant_appply_morethan').$newneg_leave.' '.$rem_leave_title;
						}
					} else {
						$rem_leave = $newneg_leave - $cfleave_hours;
						if($rem_leave < 0 || $rem_leave == 0){
							if($negative_quota == 0) {
								$Return['error'] = lang('Main.xin_hr_cant_appply_leave_quota_completed');
							}
						}
					}
					//$Return['error'] = $rem_leave.'--'.$itinc.' '.$tinc;
				} else {
					$rem_leave = $days_per_year - $tinc;
					if($rem_leave < 0 || $rem_leave == 0){
						$Return['error'] = lang('Main.xin_hr_cant_appply_leave_quota_completed');
					} else if($fday_hours > $days_per_year){
						if($rem_leave == 1){
							$rem_leave_title = lang('Main.xin_leave_hour');
						} else {
							$rem_leave_title = lang('Main.xin_leave_hours');
						}
						$Return['error'] = lang('Main.xin_hr_cant_appply_morethan').$rem_leave.' '.$rem_leave_title;
					}
				}
				
				
				
				if($Return['error']!=''){
					$Return['csrf_hash'] = csrf_hash();
					$this->output($Return);
				}
	
				$leave_half_day_opt = 0;
				// check users
				
				$SystemModel = new SystemModel();
				$xin_system = $SystemModel->where('setting_id', 1)->first();
				$user_info = $UsersModel->where('user_id', $luser_id)->first();
				if($user_info['user_type'] == 'staff'){
					$staff_id = $user_info['user_id'];
					$company_id = $user_info['company_id'];
					$company_info = $UsersModel->where('company_id', $company_id)->first();
				} else {
					$staff_id = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
					$company_id = $usession['sup_user_id'];
					$company_info = $UsersModel->where('user_id', $luser_id)->first();
				}
				
				$require_info = $ConstantsModel->where('constants_id', $leave_type)->where('type','leave_type')->first();
				if($require_info['field_two'] == 0){
					$status = 2;
				} else {
					$status = 1;
				}
				if ($validated) {
					$attachment = $this->request->getFile('attachment');
					$file_name = $attachment->getName();
					$file_name = $attachment->getRandomName();
					$attachment->move('public/uploads/leave/',$file_name);
					$data = [
						'company_id' => $company_id,
						'employee_id'  => $staff_id,
						'leave_type_id'  => $leave_type,
						'particular_date'  => $particular_date,
						'from_date'  => $iistart_date,
						'leave_hours'  => $cfleave_hours,
						'to_date'  => $iiend_date,
						'leave_month'  => $get_month,
						'leave_year'  => $leave_year,
						'reason'  => $reason,
						'remarks'  => $remarks,
						'status'  => $status,
						'is_half_day'  => $leave_half_day_opt,
						'leave_attachment'  => $file_name,
						'created_at'  => date('d-m-Y h:i:s'),
					];
				} else {
						$data = [
						'company_id' => $company_id,
						'employee_id'  => $staff_id,
						'leave_type_id'  => $leave_type,
						'leave_hours'  => $cfleave_hours,
						'particular_date'  => $particular_date,
						'from_date'  => $iistart_date,
						'to_date'  => $iiend_date,
						'leave_month'  => $get_month,
						'leave_year'  => $leave_year,
						'reason'  => $reason,
						'remarks'  => $remarks,
						'status'  => $status,
						'is_half_day'  => $leave_half_day_opt,
						'leave_attachment'  => '',
						'created_at'  => date('d-m-Y h:i:s'),
					];	
				}
				$LeaveModel = new LeaveModel();
				$EmailtemplatesModel = new EmailtemplatesModel();
				// print_r($data); die();
				$result = $LeaveModel->insert($data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					if($xin_system['enable_email_notification'] == 1){
						// Send mail start
						$itemplate = $EmailtemplatesModel->where('template_id', 13)->first();
						$istaff_info = $UsersModel->where('user_id', $staff_id)->first();
						$full_name = $istaff_info['first_name'].' '.$istaff_info['last_name'];
						// leave type
						$ltype = $ConstantsModel->where('constants_id', $leave_type)->where('type','leave_type')->first();
						$category_name = $ltype['category_name'];	
						$isubject = $itemplate['subject'];
						$ibody = html_entity_decode($itemplate['message']);
						$fbody = str_replace(array("{site_name}","{employee_name}","{leave_type}"),array($company_info['company_name'],$full_name,$category_name),$ibody);
						timehrm_mail_data($istaff_info['email'],$company_info['company_name'],$company_info['email'],$isubject,$fbody);
						
						// Send mail end
					}
					$Return['result'] = lang('Success.ci_leave_created__msg');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
			}
			$this->output($Return);
			exit;
		}			
	}

	public function leave_type_chart() {
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$ConstantsModel = new ConstantsModel();
		$LeaveModel = new LeaveModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$get_data = $ConstantsModel->where('company_id',$user_info['company_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
		} else {
			$get_data = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
		}
		$data = array();
		$Return = array('iseries'=>'', 'ilabels'=>'');
		$title_info = array();
		$series_info = array();
		foreach($get_data as $r){
			$leave_info = $LeaveModel->where('leave_type_id',$r['constants_id'])->first();
			$leave_count = $LeaveModel->where('leave_type_id',$r['constants_id'])->countAllResults();
			if($leave_count > 0){
				$title_info[] = $r['category_name'];
				$series_info[] = $leave_count;
			}
			
		}				  
		$Return['iseries'] = $series_info;
		$Return['ilabels'] = $title_info;
		$this->output($Return);
		exit;
	}
	public function leave_status_chart() {
		
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$ConstantsModel = new ConstantsModel();
		$LeaveModel = new LeaveModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$leave_pending = $LeaveModel->where('employee_id',$usession['sup_user_id'])->where('status', 1)->countAllResults();
			$total_accepted = $LeaveModel->where('employee_id',$usession['sup_user_id'])->where('status', 2)->countAllResults();
			$total_rejected = $LeaveModel->where('employee_id',$usession['sup_user_id'])->where('status', 3)->countAllResults();
		} else {
			$leave_pending = $LeaveModel->where('company_id',$usession['sup_user_id'])->where('status', 1)->countAllResults();
			$total_accepted = $LeaveModel->where('company_id',$usession['sup_user_id'])->where('status', 2)->countAllResults();
			$total_rejected = $LeaveModel->where('company_id',$usession['sup_user_id'])->where('status', 3)->countAllResults();
		}
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('accepted'=>'', 'accepted_count'=>'','pending'=>'', 'pending_count'=>'','rejected'=>'', 'rejected_count'=>'');
		
		//accepted
		$Return['accepted'] = lang('Main.xin_approved');
		$Return['accepted_count'] = $total_accepted;
		// pending
		$Return['pending'] = lang('Main.xin_pending');
		$Return['pending_count'] = $leave_pending;
		// rejected
		$Return['rejected'] = lang('Main.xin_rejected');
		$Return['rejected_count'] = $total_rejected;
		$this->output($Return);
		exit;
	}
	// |||update record|||
	public function update_leave() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'remarks' => [
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
                    "remarks" => $validation->getError('remarks'),
					"reason" => $validation->getError('reason')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$remarks = $this->request->getPost('remarks',FILTER_SANITIZE_STRING);	
				$reason = $this->request->getPost('reason',FILTER_SANITIZE_STRING);	
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));	
				$data = [
					'remarks' => $remarks,
					'reason'  => $reason
				];
				$LeaveModel = new LeaveModel();
				$result = $LeaveModel->update($id,$data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_leave_updated_msg');
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
	public function update_leave_status() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'status' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
					"status" => $validation->getError('status')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$remarks = $this->request->getPost('remarks',FILTER_SANITIZE_STRING);	
				$status = $this->request->getPost('status',FILTER_SANITIZE_STRING);	
				$id = udecode($this->request->getPost('token_status',FILTER_SANITIZE_STRING));	
				
				$UsersModel = new UsersModel();
				$LeaveModel = new LeaveModel();
				$ConstantsModel = new ConstantsModel();
				$SmstemplatesModel = new SmstemplatesModel();
				$EmailtemplatesModel = new EmailtemplatesModel();
				/*$result = $LeaveModel->update($id,$data);	*/
				$SystemModel = new SystemModel();
				$StaffapprovalsModel = new StaffapprovalsModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
				} else {
					$company_id = $usession['sup_user_id'];
				}
				// get approvals
				$skip_specific = skip_specific_approval_info('leave_settings');
				$iskip_specific = $skip_specific['skip_specific_approval'];
				if($iskip_specific == 1){
					$level_option = staff_reporting_manager_info($usession['sup_user_id'],'leave_settings');
					$total_levels = $level_option['total_levels'];
				} else {
					$result = $LeaveModel->where('leave_id', $id)->first();
					$old_level = staff_reporting_manager_old_level($result['employee_id'],'leave_settings');
					$total_levels = $old_level['total_levels'];
				}
				// check approvals
				$approval_cnt = $StaffapprovalsModel->where('company_id', $company_id)->where('module_key_id', $id)->where('module_option', 'leave_settings')->countAllResults();
				$iapproval_cnt = $approval_cnt+1;
				
				if($user_info['user_type'] == 'company'){
					$data = [
							'remarks' => $remarks,
							'status'  => $status
						];
						$LeaveModel = new LeaveModel();
						$result = $LeaveModel->update($id,$data);
				} else {
					if($iapproval_cnt == $total_levels){	
						$data2 = [
							'company_id'  => $company_id,
							'staff_id'  => $usession['sup_user_id'],
							'module_key_id'  => $id,
							'module_option'  => 'leave_settings',
							'status'  => $status,
							'approval_level'  => 1,
							'updated_at' => date('d-m-Y h:i:s')
						];
						$StaffapprovalsModel->insert($data2);
						$data = [
							'remarks' => $remarks,
							'status'  => $status
						];
						$LeaveModel = new LeaveModel();
						$result = $LeaveModel->update($id,$data);
					} else {
						if($iapproval_cnt < $total_levels){
							if($status == 3) {
								$data = [
									'remarks' => $remarks,
									'status'  => $status
								];
								$LeaveModel = new LeaveModel();
								$result = $LeaveModel->update($id,$data);
								$data2 = [
									'company_id'  => $company_id,
									'staff_id'  => $usession['sup_user_id'],
									'module_key_id'  => $id,
									'module_option'  => 'leave_settings',
									'status'  => $status,
									'approval_level'  => 2,
									'updated_at' => date('d-m-Y h:i:s')
								];
								$result = $StaffapprovalsModel->insert($data2);
							} else {
								$data2 = [
									'company_id'  => $company_id,
									'staff_id'  => $usession['sup_user_id'],
									'module_key_id'  => $id,
									'module_option'  => 'leave_settings',
									'status'  => $status,
									'approval_level'  => 0,
									'updated_at' => date('d-m-Y h:i:s')
								];
								$result = $StaffapprovalsModel->insert($data2);
							}
							
						} else {
							$Return['result'] = 'Approval level finished.';
							$this->output($Return);
						}
					}
				}
				$xin_system = $SystemModel->where('setting_id', 1)->first();
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_leave_status_updated_msg');
					if($xin_system['enable_email_notification'] == 1){
						$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
						if($user_info['user_type'] == 'staff'){
							$company_info = $UsersModel->where('company_id', $user_info['company_id'])->first();
						} else {
							$company_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
						}
						$leave_result = $LeaveModel->where('leave_id', $id)->first();
						if($status  == 2){ //approve
							// Send mail start
							if($xin_system['enable_email_notification'] == 1){
								$itemplate = $EmailtemplatesModel->where('template_id', 14)->first();
								$istaff_info = $UsersModel->where('user_id', $leave_result['employee_id'])->first();
								// leave type
								$ltype = $ConstantsModel->where('constants_id', $leave_result['leave_type_id'])->where('type','leave_type')->first();
								$category_name = $ltype['category_name'];	
								$isubject = $itemplate['subject'];
								$ibody = html_entity_decode($itemplate['message']);
								$fbody = str_replace(array("{site_name}","{leave_type}","{start_date}","{end_date}","{remarks}"),array($company_info['company_name'],$category_name,$leave_result['from_date'],$leave_result['to_date'],$remarks),$ibody);
								timehrm_mail_data($company_info['email'],$company_info['company_name'],$istaff_info['email'],$isubject,$fbody);
							}
							if($xin_system['enable_sms_notification'] == 1){
								$itemplate = $SmstemplatesModel->where('template_id', 4)->first();
								$istaff_info = $UsersModel->where('user_id', $leave_result['employee_id'])->first();
								// leave type
								$ltype = $ConstantsModel->where('constants_id', $leave_result['leave_type_id'])->where('type','leave_type')->first();
								$category_name = $ltype['category_name'];	
								$ibody = html_entity_decode($itemplate['message']);
								$fbody = str_replace(array("{firstname}","{leave_name}"),array($istaff_info['first_name'],$category_name),$ibody);
								timehrm_sms_data($istaff_info['contact_number'],$fbody);
							}
						} elseif($status == 3){
							// Send mail start
							if($xin_system['enable_email_notification'] == 1){
								$itemplate = $EmailtemplatesModel->where('template_id', 15)->first();
								$istaff_info = $UsersModel->where('user_id', $leave_result['employee_id'])->first();
								// leave type
								$ltype = $ConstantsModel->where('constants_id', $leave_result['leave_type_id'])->where('type','leave_type')->first();
								$category_name = $ltype['category_name'];	
								$isubject = $itemplate['subject'];
								$ibody = html_entity_decode($itemplate['message']);
								$fbody = str_replace(array("{site_name}","{leave_type}","{start_date}","{end_date}","{remarks}"),array($company_info['company_name'],$category_name,$leave_result['from_date'],$leave_result['to_date'],$remarks),$ibody);
								timehrm_mail_data($company_info['email'],$company_info['company_name'],$istaff_info['email'],$isubject,$fbody);
							}
							if($xin_system['enable_sms_notification'] == 1){
								$itemplate = $SmstemplatesModel->where('template_id', 5)->first();
								$istaff_info = $UsersModel->where('user_id', $leave_result['employee_id'])->first();
								// leave type
								$ltype = $ConstantsModel->where('constants_id', $leave_result['leave_type_id'])->where('type','leave_type')->first();
								$category_name = $ltype['category_name'];	
								$ibody = html_entity_decode($itemplate['message']);
								$fbody = str_replace(array("{firstname}","{leave_name}"),array($istaff_info['first_name'],$category_name),$ibody);
								timehrm_sms_data($istaff_info['contact_number'],$fbody);
							}
						} else {
						}
					}
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
	public function update_leave_adjustment_status() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'status' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "status" => $validation->getError('status'),
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$status = $this->request->getPost('status',FILTER_SANITIZE_STRING);
				$id = udecode($this->request->getPost('token_status',FILTER_SANITIZE_STRING));
				
				$UsersModel = new UsersModel();
				$LeaveadjustModel = new LeaveadjustModel();
				$StaffapprovalsModel = new StaffapprovalsModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
				} else {
					$company_id = $usession['sup_user_id'];
				}
				// get approvals
				$skip_specific = skip_specific_approval_info('leave_adjustment_settings');
				$iskip_specific = $skip_specific['skip_specific_approval'];
				if($iskip_specific == 1){
					$level_option = staff_reporting_manager_info($usession['sup_user_id'],'leave_adjustment_settings');
					$total_levels = $level_option['total_levels'];
				} else {
					$result = $LeaveadjustModel->where('adjustment_id', $id)->first();
					$old_level = staff_reporting_manager_old_level($result['employee_id'],'leave_adjustment_settings');
					$total_levels = $old_level['total_levels'];
				}
				// check approvals
				$approval_cnt = $StaffapprovalsModel->where('company_id', $company_id)->where('module_key_id', $id)->where('module_option', 'leave_adjustment_settings')->countAllResults();
				$iapproval_cnt = $approval_cnt+1;
				
				if($user_info['user_type'] == 'company'){
					$data = [
					'status'  => $status,
					];
					$LeaveadjustModel = new LeaveadjustModel();
					$result = $LeaveadjustModel->update($id,$data);
				} else {
					if($iapproval_cnt == $total_levels){	
					
						$data2 = [
							'company_id'  => $company_id,
							'staff_id'  => $usession['sup_user_id'],
							'module_key_id'  => $id,
							'module_option'  => 'leave_adjustment_settings',
							'status'  => $status,
							'approval_level'  => 1,
							'updated_at' => date('d-m-Y h:i:s')
						];
						$StaffapprovalsModel->insert($data2);
						$data = [
							'status'  => $status,
						];
						$LeaveadjustModel = new LeaveadjustModel();
						$result = $LeaveadjustModel->update($id,$data);
					} else {
						if($iapproval_cnt < $total_levels){
							if($status == 2) {
								$data = [
									'status'  => $status,
								];
								$LeaveadjustModel = new LeaveadjustModel();
								$LeaveadjustModel->update($id,$data);
								$data2 = [
									'company_id'  => $company_id,
									'staff_id'  => $usession['sup_user_id'],
									'module_key_id'  => $id,
									'module_option'  => 'leave_adjustment_settings',
									'status'  => $status,
									'approval_level'  => 2,
									'updated_at' => date('d-m-Y h:i:s')
								];
								$result = $StaffapprovalsModel->insert($data2);
							} else {
								$data2 = [
									'company_id'  => $company_id,
									'staff_id'  => $usession['sup_user_id'],
									'module_key_id'  => $id,
									'module_option'  => 'leave_adjustment_settings',
									'status'  => $status,
									'approval_level'  => 0,
									'updated_at' => date('d-m-Y h:i:s')
								];
								$result = $StaffapprovalsModel->insert($data2);
							}
							
						} else {
							$Return['result'] = 'Approval level finished.';
							$this->output($Return);
						}
					}
				}
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_leave_adjustment_status_updated');
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
	// read record
	public function read_leave()
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
			return view('erp/leave/dialog_leave', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// read record
	public function read_leave_adjustment()
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
			return view('erp/leave/dialog_leave_adjustment', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// read record
	public function is_leave_type_summary()
	{
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		$ltype = $request->uri->getSegment(4);
		$staffid = $request->uri->getSegment(5);
		$data = [
				'ltype' => $ltype,
				'staffid' => $staffid,
			];
		if($session->has('sup_username')){
			return view('erp/leave/get_leave_type_summary', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// delete record
	public function delete_leave() {
		
		if($this->request->getPost('type')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$id = udecode($this->request->getPost('_token',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$LeaveModel = new LeaveModel();
			$result = $LeaveModel->where('leave_id', $id)->delete($id);
			if ($result == TRUE) {
				$Return['result'] = lang('Success.ci_leave_deleted_msg');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
	// delete record
	public function delete_leave_adjustment() {
		
		if($this->request->getPost('type')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$id = udecode($this->request->getPost('_token',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$LeaveadjustModel = new LeaveadjustModel();
			$result = $LeaveadjustModel->where('adjustment_id', $id)->delete($id);
			if ($result == TRUE) {
				$Return['result'] = lang('Success.ci_leave_adjustment_deleted_msg');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
}
