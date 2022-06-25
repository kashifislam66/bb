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
 
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\MainModel;
use App\Models\FormsModel;
use App\Models\FormsendModel;
use App\Models\FormsfieldModel;
use App\Models\FormscompletedfieldsModel;
use App\Models\StaffdetailsModel;

class Forms extends BaseController {

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
		/*if($user_info['user_type'] != 'company'){
			if(!in_array('forms_builder',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}*/
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_forms_builder').' | '.$xin_system['application_name'];
		$data['path_url'] = 'forms_builder';
		$data['breadcrumbs'] = lang('Main.xin_forms_builder');
		
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
			$data['subview'] = view('erp/forms/key_users_forms', $data);
			return view('erp/layout/layout_main', $data); //page load
		} else {
			$company_id = $usession['sup_user_id'];
			$data['subview'] = view('erp/forms/key_forms', $data);
			return view('erp/layout/layout_main', $data); //page load
		}
		
	}
	public function send_form()
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
		/*if($user_info['user_type'] != 'company'){
			if(!in_array('system_calendar',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}*/
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_send_employee_form').' | '.$xin_system['application_name'];
		$data['path_url'] = 'forms_builder_send';
		$data['breadcrumbs'] = lang('Main.xin_send_employee_form');

		$data['subview'] = view('erp/forms/key_send_form', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function edit_form()
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
		/*if($user_info['user_type'] != 'company'){
			if(!in_array('system_calendar',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}*/
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_form_edit').' | '.$xin_system['application_name'];
		$data['path_url'] = 'forms_builder';
		$data['breadcrumbs'] = lang('Main.xin_form_edit');

		$data['subview'] = view('erp/forms/edit_form', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function submit_form()
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
		/*if($user_info['user_type'] != 'company'){
			if(!in_array('forms_builder',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}*/
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_form_submit').' | '.$xin_system['application_name'];
		$data['path_url'] = 'forms_builder';
		$data['breadcrumbs'] = lang('Main.xin_form_submit');

		$data['subview'] = view('erp/forms/complete_form', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function get_user_submited_form()
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
		/*if($user_info['user_type'] != 'company'){
			if(!in_array('system_calendar',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}*/
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_form_view').' | '.$xin_system['application_name'];
		$data['path_url'] = 'forms_builder';
		$data['breadcrumbs'] = lang('Main.xin_form_view');

		$data['subview'] = view('erp/forms/get_user_submited_form', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function view_form()
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
		/*if($user_info['user_type'] != 'company'){
			if(!in_array('system_calendar',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}*/
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_form_view').' | '.$xin_system['application_name'];
		$data['path_url'] = 'forms_builder';
		$data['breadcrumbs'] = lang('Main.xin_form_view');

		$data['subview'] = view('erp/forms/view_form', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	// |||add record|||
	public function add_new_form() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'form_name' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "form_name" => $validation->getError('form_name'),
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$form_name = $this->request->getPost('form_name',FILTER_SANITIZE_STRING);
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
				} else {
					$company_id = $usession['sup_user_id'];
				}
				$data = [
					'company_id'  => $company_id,
					'category_id'  => 0,
					'form_name' => $form_name,
					'is_allow_attachment' => 0,
					'is_attachment_mandatory' => 0,
					'is_allow_fill' => 0,
					'status'  => 1,
					
					'notify_upon_submission' => 0,
					'notify_upon_approval' => 0,
					'notify_upon_rejection' => 0,
					'approval_method' => 0,
					'approval_levels' => 0,
					'approval_level01' => 0,
					'approval_level02' => 0,
					'approval_level03' => 0,
					'approval_level04' => 0,
					'approval_level05' => 0,
					'skip_specific_approval' => 1,
					'assign_departments' => 0,
					'assigned_to' => 0,
					'created_at' => date('d-m-Y')
				];
				$FormsModel = new FormsModel();
				$result = $FormsModel->insert($data);
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_form_added_success_msg');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
				$Return['csrf_hash'] = csrf_hash();	
				$this->output($Return);
				exit;
			}
		}
	}
	// |||add record|||
	public function add_send_form() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$form_id = $this->request->getPost('form_id',FILTER_SANITIZE_STRING);
			$employee_id = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
			$employee_ids = implode(',',$employee_id);
			$form_deadline = $this->request->getPost('form_deadline',FILTER_SANITIZE_STRING);
				
			$UsersModel = new UsersModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$data = [
				'company_id'  => $company_id,
				'form_id' => $form_id,
				'assigned_to'  => $employee_ids,
				'form_deadline' => $form_deadline,
				'status' => 0,
				'created_at' => date('d-m-Y')
			];
			$FormsendModel = new FormsendModel();
			$result = $FormsendModel->insert($data);
			$Return['csrf_hash'] = csrf_hash();	
			if ($result == TRUE) {
				$Return['result'] = lang('Main.xin_send_form_submited_success_msg');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$Return['csrf_hash'] = csrf_hash();	
			$this->output($Return);
			exit;
		}
	}
	// |||edit record|||
	public function update_form() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'form_name' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'form_category' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'approval_levels' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "form_name" => $validation->getError('form_name'),
					"form_category" => $validation->getError('form_category'),
					"approval_levels" => $validation->getError('approval_levels'),
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$form_name = $this->request->getPost('form_name',FILTER_SANITIZE_STRING);
				$category_id = $this->request->getPost('form_category',FILTER_SANITIZE_STRING);
				$is_allow_attachment = $this->request->getPost('allow_attachment',FILTER_SANITIZE_STRING);	
				$is_attachment_mandatory = $this->request->getPost('attachment_mandatory',FILTER_SANITIZE_STRING);
				$allow_self_fill = $this->request->getPost('allow_self_fill',FILTER_SANITIZE_STRING);
				$status = $this->request->getPost('status',FILTER_SANITIZE_STRING);
				$notify_upon_submission = $this->request->getPost('notify_upon_submission',FILTER_SANITIZE_STRING);
				$notify_upon_submission_ids = implode(',',$notify_upon_submission);
				$notify_upon_approval = $this->request->getPost('notify_upon_approval',FILTER_SANITIZE_STRING);
				$notify_upon_approval_ids = implode(',',$notify_upon_approval);
				$notify_upon_rejection = $this->request->getPost('notify_upon_rejection',FILTER_SANITIZE_STRING);
				$notify_upon_rejection_ids = implode(',',$notify_upon_rejection);
				$assign_department = $this->request->getPost('assign_department',FILTER_SANITIZE_STRING);
				$assign_department_ids = implode(',',$assign_department);
				$method_multi_level = $this->request->getPost('method_multi_level',FILTER_SANITIZE_STRING);
				$approval_levels = $this->request->getPost('approval_levels',FILTER_SANITIZE_STRING);
				$approval_levelone = $this->request->getPost('approval_level01',FILTER_SANITIZE_STRING);
				$approval_leveltwo = $this->request->getPost('approval_level02',FILTER_SANITIZE_STRING);
				$approval_levelthree = $this->request->getPost('approval_level03',FILTER_SANITIZE_STRING);
				$approval_levelfour = $this->request->getPost('approval_level04',FILTER_SANITIZE_STRING);
				$approval_levelfive = $this->request->getPost('approval_level05',FILTER_SANITIZE_STRING);
				
				//check levels
				if($approval_levels==1 && $approval_levelone === '' && empty($approval_levelone)){
					$Return['error'] = 'Select Approval Level 01';
				} else if($approval_levels==2 && $approval_leveltwo === '' && empty($approval_leveltwo)){
					$Return['error'] = 'Select Approval Level 02';
				} else if($approval_levels==3 && $approval_levelthree === '' && empty($approval_levelthree)){
					$Return['error'] = 'Select Approval Level 03';
				} else if($approval_levels==4 && $approval_levelfour === '' && empty($approval_levelfour)){
					$Return['error'] = 'Select Approval Level 04';
				} else if($approval_levels==5 && $approval_levelfive === '' && empty($approval_levelfive)){
					$Return['error'] = 'Select Approval Level 05';
				}
				if($Return['error']!=''){
					$this->output($Return);
				}
				if($approval_levels==1 && isset($approval_levelone) && !empty($approval_levelone)){
					$approval_levelone = $approval_levelone;
					$approval_leveltwo = 0;
					$approval_levelthree = 0;
					$approval_levelfour = 0;
					$approval_levelfive = 0;
				} else if($approval_levels==2 && isset($approval_leveltwo) && !empty($approval_leveltwo)){
					$approval_levelone = $approval_levelone;
					$approval_leveltwo = $approval_leveltwo;
					$approval_levelthree = 0;
					$approval_levelfour = 0;
					$approval_levelfive = 0;
				} else if($approval_levels==3 && isset($approval_levelthree) && !empty($approval_levelthree)){
					$approval_levelone = $approval_levelone;
					$approval_leveltwo = $approval_leveltwo;
					$approval_levelthree = $approval_levelthree;
					$approval_levelfour = 0;
					$approval_levelfive = 0;
				} else if($approval_levels==4 && isset($approval_levelfour) && !empty($approval_levelfour)){
					$approval_levelone = $approval_levelone;
					$approval_leveltwo = $approval_leveltwo;
					$approval_levelthree = $approval_levelthree;
					$approval_levelfour = $approval_levelfour;
					$approval_levelfive = 0;
				} else if($approval_levels==5 && isset($approval_levelfive) && !empty($approval_levelfive)){
					$approval_levelone = $approval_levelone;
					$approval_leveltwo = $approval_leveltwo;
					$approval_levelthree = $approval_levelthree;
					$approval_levelfour = $approval_levelfour;
					$approval_levelfive = $approval_levelfive;
				} else {
					$approval_levelone = 0;
					$approval_leveltwo = 0;
					$approval_levelthree = 0;
					$approval_levelfour = 0;
					$approval_levelfive = 0;
				}
				
				$skip_specific_approval = $this->request->getPost('skip_specific_approval',FILTER_SANITIZE_STRING);
				
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				
				//$jsonfields = json_decode($org_json,true);	
				$share_with_employees = $this->request->getPost('assigned_to',FILTER_SANITIZE_STRING);	
				$share_info = implode(',',$share_with_employees);	
				//$ishare_info = array($share_with_employees);
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
					$assigned_user_info = $UsersModel->where('user_type','staff')->where('company_id', $company_id)->findAll();
				} else {
					$company_id = $usession['sup_user_id'];
					$assigned_user_info = $UsersModel->where('user_type','staff')->where('company_id', $company_id)->findAll();
				}
				$f=0;
				if(!empty($this->request->getPost('item',FILTER_SANITIZE_STRING))) {
					foreach($this->request->getPost('item',FILTER_SANITIZE_STRING) as $eitem_id=>$key_val){
						
						$efield_type = $this->request->getPost('efield_type',FILTER_SANITIZE_STRING);
						$refield_type = $efield_type[$key_val];
						// efield_name
						$efield_name = $this->request->getPost('efield_name',FILTER_SANITIZE_STRING);
						$rfield_name = $efield_name[$key_val];
						
						if($refield_type==='') {
							$Return['error'] = lang('Main.xin_field_type_field_required');
						} else if($rfield_name==='') {
							$Return['error'] = lang('Main.xin_field_name_field_required');
						}
						// efield_type
						$iefield_type = $this->request->getPost('efield_type',FILTER_SANITIZE_STRING);
						$iiefield_type = $iefield_type[$key_val]; 
						// efield_name
						$iefield_name = $this->request->getPost('efield_name',FILTER_SANITIZE_STRING);
						$iiefield_name = $iefield_name[$key_val]; 
						// efield_options
						$iefield_options = $this->request->getPost('efield_options',FILTER_SANITIZE_STRING);
						$iiefield_options = $iefield_options[$key_val]; 
						// efield_mandatory
						$iefield_mandatory = $this->request->getPost('efield_mandatory',FILTER_SANITIZE_STRING);
						$iiefield_mandatory = $iefield_mandatory[$key_val];
						// efield_order
						$iefield_order = $this->request->getPost('efield_order',FILTER_SANITIZE_STRING);
						$iiefield_order = $iefield_order[$key_val];
						
						$data = array(
							'field_key'  => $iiefield_options,
							'field_label'  => $iiefield_name,
							'field_type'  => $iiefield_type,
							'sort_order'  => $iiefield_order,
							'is_mandatory'  => $iiefield_mandatory,
						);
						$FormsfieldModel = new FormsfieldModel();
						$FormsfieldModel->update($eitem_id,$data);
						
						$f++;
					}
				}
				if($Return['error']!=''){
					$this->output($Return);
				}
				if($this->request->getPost('field_type')) {
					$ik=0;
					foreach($this->request->getPost('field_type',FILTER_SANITIZE_STRING) as $items){
						$item_name = $this->request->getPost('field_type',FILTER_SANITIZE_STRING);
						$iname = $item_name[$ik];
						// field_name
						$field_name = $this->request->getPost('field_name',FILTER_SANITIZE_STRING);
						$field_name_opt = $field_name[$ik];
												
						if($iname==='') {
							$Return['error'] = lang('Main.xin_field_type_field_required');
						} else if($field_name_opt==='') {
							$Return['error'] = lang('Main.xin_field_name_field_required');
						}
						$ik++;
					}
				}
				if($Return['error']!=''){
					$this->output($Return);
				}
				
				$data3 = [
					'category_id'  => $category_id,
					'form_name' => $form_name,
					'is_allow_attachment' => $is_allow_attachment,
					'is_attachment_mandatory' => $is_attachment_mandatory,
					'is_allow_fill' => $allow_self_fill,
					'status'  => $status,
					
					'notify_upon_submission'  => $notify_upon_submission_ids,
					'notify_upon_approval'  => $notify_upon_approval_ids,
					'notify_upon_rejection' => $notify_upon_rejection_ids,
					'approval_method'  => $method_multi_level,
					'approval_levels'  => $approval_levels,
					'approval_level01'  => $approval_levelone,
					'approval_level02'  => $approval_leveltwo,
					'approval_level03'  => $approval_levelthree,
					'approval_level04'  => $approval_levelfour,
					'approval_level05'  => $approval_levelfive,
					'skip_specific_approval'  => $skip_specific_approval,
					'assign_departments' => $assign_department_ids,
					'assigned_to' => $share_info,
				];
				$FormsModel = new FormsModel();
				$result = $FormsModel->update($id,$data3);
					
				$form_id = $id;
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					
					if($this->request->getPost('field_type')) {
						$key=0;
						$FormsfieldModel = new FormsfieldModel();
						foreach($this->request->getPost('field_type',FILTER_SANITIZE_STRING) as $items){
							
							// item name
							$field_type = $this->request->getPost('field_type',FILTER_SANITIZE_STRING);
							$ifield_type = $field_type[$key]; 
							// field_name
							$field_name = $this->request->getPost('field_name',FILTER_SANITIZE_STRING);
							$ifield_name = $field_name[$key];
							// field_options
							$field_options = $this->request->getPost('field_options',FILTER_SANITIZE_STRING);
							$ifield_options = $field_options[$key];
							// field_mandatory
							$field_mandatory = $this->request->getPost('field_mandatory',FILTER_SANITIZE_STRING);
							$ifield_mandatory = $field_mandatory[$key]; 
							// field_order
							$field_order = $this->request->getPost('field_order',FILTER_SANITIZE_STRING);
							$ifield_order = $field_order[$key]; 
							
							$data2 = array(
								'company_id'  => $company_id,
								'form_id'  => $form_id,
								'field_key'  => $ifield_options,
								'field_label'  => $ifield_name,
								'field_type'  => $ifield_type,
								'sort_order'  => $ifield_order,
								'is_mandatory'  => $ifield_mandatory,
								'status'  => 0,
								'created_at'  => date('d-m-Y')
							);
							$FormsfieldModel->insert($data2);
							$key++;
					 	}
					}
					$Return['result'] = lang('Main.xin_form_updated_success_msg');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
				$this->output($Return);
				exit;
			}
		}
	}
	// |||add user data > form|||
	public function save_user_input() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		//if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$form_name = $this->request->getPost('form_name',FILTER_SANITIZE_STRING);	
			$_formidtoken = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
			$ifield = $this->request->getPost('field',FILTER_SANITIZE_STRING);	
			$post_data = $_POST['field'];
			$UsersModel = new UsersModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$FormsModel = new FormsModel();
			$FormscompletedfieldsModel = new FormscompletedfieldsModel();
			$_formcinfo = $FormsModel->where('company_id',$company_id)->where("forms_id",$_formidtoken)->first();
			$upd_status = 0;/*if($_formcinfo['is_allow_supervisor']==1){
				$upd_status = 0;
			} else {
				$upd_status = 1;
			}*/
			foreach ($_POST['field'] as $key=>$value) {
				if($key==3){
					foreach ($_POST['field'][$key] as $key_val => $value_opt) {
						$fields_option = implode(',',$value_opt);
						$data2 = array(
							'company_id'  => $company_id,
							'form_id'  => $_formidtoken,
							'staff_id'  => $usession['sup_user_id'],
							'field_key'  => $key_val,
							'field_value'  => $fields_option,
							'status'  => $upd_status,
							'created_at'  => date('d-m-Y')
						);
						$result = $FormscompletedfieldsModel->insert($data2);
					}
				} else {
					foreach ($_POST['field'][$key] as $key_val => $value_opt) {
						
						$data2 = array(
							'company_id'  => $company_id,
							'form_id'  => $_formidtoken,
							'staff_id'  => $usession['sup_user_id'],
							'field_key'  => $key_val,
							'field_value'  => $value_opt,
							'status'  => $upd_status,
							'created_at'  => date('d-m-Y')
						);
						$result = $FormscompletedfieldsModel->insert($data2);
					}
				}
			}
			//  set attachment
			if($_formcinfo['is_allow_attachment']==1){
				$allow_attachment = $this->request->getFile('allow_attachment');
				$file_name = $allow_attachment->getName();
				$file_name = $allow_attachment->getRandomName();
				$allow_attachment->move('public/uploads/form_attachment/',$file_name);
				$data3 = array(
					'company_id'  => $company_id,
					'form_id'  => $_formidtoken,
					'staff_id'  => $usession['sup_user_id'],
					'field_key'  => 13,
					'field_value'  => $file_name,
					'status'  => $upd_status,
					'created_at'  => date('d-m-Y')
				);
				$FormscompletedfieldsModel->insert($data3);
			}
			$Return['csrf_hash'] = csrf_hash();	
			if ($result == TRUE) {
				$session->setFlashdata('form_success_msg',lang('Main.xin_form_submited_success_msg'));
				return redirect()->to(site_url('erp/forms-builder'));
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
			exit;
	}
	// read record
	public function change_form_status()
	{
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = csrf_hash();
		$record_id = udecode($request->getGet('record_id'));
		$status_val = $request->getGet('status_val');
		$data = [
			'status' => $status_val,
		];
		$FormsModel = new FormsModel();
		$result = $FormsModel->update($record_id,$data);
		echo lang('Main.xin_form_status_updated_msg');
		
	}
	// |||update record|||
	public function update_submited_form_status() {
			
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
				
				$data = [
					'status'  => $status,
				];
				$MainModel = new MainModel();
				$result = $MainModel->update_submited_form_record($data,$id);
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_submited_form_status_updated');
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
	// record list
	public function send_form_list() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$FormsModel = new FormsModel();
		$FormsendModel = new FormsendModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$get_data = assigned_staff_send_forms($usession['sup_user_id']);
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
			$get_data = $FormsendModel->where('company_id',$usession['sup_user_id'])->orderBy('form_send_id', 'ASC')->findAll();
		}
		$data = array();
		
          foreach($get_data as $r) {
			  
			/*if(in_array('hr_event3',staff_role_resource()) || $user_info['user_type'] == 'company') { //edit
				$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. uencode($r['event_id']) . '"><i class="feather icon-edit"></i></button></span>';
			} else {
				$edit = '';
			}*/
			//if(in_array('hr_event4',staff_role_resource()) || $user_info['user_type'] == 'company') { //delete
				$delete = '<span data-toggle="tooltip" data-placement="top" data-state="danger" title="'.lang('Main.xin_delete').'"><button type="button" class="btn icon-btn btn-sm btn-light-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. uencode($r['form_send_id']) . '"><i class="feather icon-trash-2"></i></button></span>';
			/*} else {
				$delete = '';
			}*/
			$_form = $FormsModel->where('company_id',$company_id)->where("forms_id",$r['form_id'])->first();
			if($_form){
				$form_name = $_form['form_name'];
			} else {
				$form_name = '--';
			}
			if($r['status']==0){
				$status = '<span class="badge bg-light-warning">'.lang('Main.xin_pending').'</span>';
			} else {
				$status = '<span class="badge bg-light-success">'.lang('Main.xin_form_submited_title').'</span>';
			}
			//assigned user
			if($r['assigned_to'] != 0){
				$assigned_to = explode(',',$r['assigned_to']);
				$multi_users = multi_user_profile_photo($assigned_to);			
			} else {
				$multi_users = '--';
			}
			//$form_deadline = set_date_format($r['form_deadline']);
			$form_deadline = set_date_format($r['form_deadline']).'<br>'.$status;
			 
			$combhr = $delete;	
			$iform_name = '
				'.$form_name.'
				<div class="overlay-edit">
					'.$combhr.'
				</div>';
			$data[] = array(
				$iform_name,
				$multi_users,
				$form_deadline
			);
			
		}
          $output = array(
               //"draw" => $draw,
			   "data" => $data
            );
          echo json_encode($output);
          exit();
     }
	// read record
	public function read_form_progress()
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
			return view('erp/forms/dialog_user_form', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// read record
	public function read_form()
	{
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		$data = [
				'field_id' => 1,
			];
		if($session->has('sup_username')){
			return view('erp/forms/dialog_form', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// delete field record
	public function delete_form_field_item() {
		
		if($this->request->getVar('record_id')) {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$record_id = udecode($this->request->getVar('record_id',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$FormsfieldModel = new FormsfieldModel();
			$result = $FormsfieldModel->where('form_field_id', $record_id)->delete($record_id);
			if ($result == TRUE) {
				$Return['result'] = lang('Success.ci_invoice_deleted_msg');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
	// delete field record
	public function delete_send_form_record() {
		
		if($this->request->getPost('type')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$record_id = udecode($this->request->getVar('_token',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$FormsendModel = new FormsendModel();
			$result = $FormsendModel->where('form_send_id', $record_id)->delete($record_id);
			if ($result == TRUE) {
				$Return['result'] = lang('Main.xin_send_form_deleted_success_msg');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
	// delete record
	public function delete_form() {
		
		if($this->request->getPost('type')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$id = udecode($this->request->getPost('_token',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$FormsModel = new FormsModel();
			$result = $FormsModel->where('forms_id', $id)->delete($id);
			if ($result == TRUE) {
				$MainModel = new MainModel();
				$MainModel->delete_form_options($id);
				$MainModel->delete_send_form_options($id);
				$MainModel->delete_form_completed_options($id);
				$Return['result'] = lang('Main.xin_form_deleted_success_msg');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
}
