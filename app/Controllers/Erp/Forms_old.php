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
			if(!in_array('system_calendar',staff_role_resource())) {
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
	public function create_form()
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
		$data['title'] = lang('Main.xin_creat_form_builder').' | '.$xin_system['application_name'];
		$data['path_url'] = 'forms_builder';
		$data['breadcrumbs'] = lang('Main.xin_creat_form_builder');

		$data['subview'] = view('erp/forms/create_form_builder', $data);
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
			if(!in_array('system_calendar',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}*/
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_creat_form_builder').' | '.$xin_system['application_name'];
		$data['path_url'] = 'forms_builder';
		$data['breadcrumbs'] = lang('Main.xin_creat_form_builder');

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
		$data['title'] = lang('Main.xin_creat_form_builder').' | '.$xin_system['application_name'];
		$data['path_url'] = 'forms_builder';
		$data['breadcrumbs'] = lang('Main.xin_creat_form_builder');

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
		//if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$form_name = $this->request->getPost('form_name',FILTER_SANITIZE_STRING);
			$category_id = $this->request->getPost('form_category',FILTER_SANITIZE_STRING);
			$supervisor_id = $this->request->getPost('supervisor_id',FILTER_SANITIZE_STRING);	
			$org_json = $_POST['json'];
			$jsonfields = json_decode($org_json,true);	
			$share_with_employees = $this->request->getPost('assigned_to',FILTER_SANITIZE_STRING);	
			$share_info = implode(',',$share_with_employees);	
			$ishare_info = array($share_with_employees);
			$UsersModel = new UsersModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
				$assigned_user_info = $UsersModel->where('user_type','staff')->where('company_id', $company_id)->findAll();
			} else {
				$company_id = $usession['sup_user_id'];
				$assigned_user_info = $UsersModel->where('user_type','staff')->where('company_id', $company_id)->findAll();
			}
			$data = [
				'company_id'  => $company_id,
				'category_id'  => $category_id,
				'supervisor_id'  => $supervisor_id,
				'form_name' => $form_name,
				'json_data' => $org_json,
				'assigned_to' => $share_info,
				'status'  => 0,
				'created_at' => date('d-m-Y')
			];
			$FormsModel = new FormsModel();
			$FormsfieldModel = new FormsfieldModel();
			$result = $FormsModel->insert($data);	
			$form_id = $FormsModel->insertID();
			$Return['csrf_hash'] = csrf_hash();	
			if ($result == TRUE) {
				foreach ($jsonfields as $i => $jsonfield) {
					$data2 = array(
						'company_id'  => $company_id,
						'form_id'  => $form_id,
						'field_key'  => $jsonfield['name'],
						'field_label'  => $jsonfield['label'],
						'field_type'  => $jsonfield['type'],
						'sort_order'  => $i,
						'json_data'  => json_encode($jsonfield),
						'status'  => 0,
						'created_at'  => date('d-m-Y')
					);
					$FormsfieldModel->insert($data2);
				}
				$session->setFlashdata('form_success_msg',lang('Main.xin_form_added_success_msg'));
				return redirect()->to(site_url('erp/forms-builder'));
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
			exit;
	}
	// |||edit record|||
	public function update_form() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		//if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$form_name = $this->request->getPost('form_name',FILTER_SANITIZE_STRING);
			$category_id = $this->request->getPost('form_category',FILTER_SANITIZE_STRING);	
			$supervisor_id = $this->request->getPost('supervisor_id',FILTER_SANITIZE_STRING);
			$org_json = $_POST['json'];
			$jsonfields = json_decode($org_json,true);	
			$share_with_employees = $this->request->getPost('assigned_to',FILTER_SANITIZE_STRING);	
			$share_info = implode(',',$share_with_employees);	
			$ishare_info = array($share_with_employees);
			$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
			$UsersModel = new UsersModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$data = [
				'category_id' => $category_id,
				'supervisor_id'  => $supervisor_id,
				'form_name' => $form_name,
				'json_data' => $org_json,
				'assigned_to' => $share_info,
			];
			$MainModel = new MainModel();
			$FormsModel = new FormsModel();
			$FormsfieldModel = new FormsfieldModel();
			$result = $FormsModel->update($id,$data);	
			$form_id = $id;
			$Return['csrf_hash'] = csrf_hash();	
			if ($result == TRUE) {
				//delete current one
				$MainModel->delete_form_options($id);
				foreach ($jsonfields as $i => $jsonfield) {
					$data2 = array(
						'company_id'  => $company_id,
						'form_id'  => $form_id,
						'field_key'  => $jsonfield['name'],
						'field_label'  => $jsonfield['label'],
						'field_type'  => $jsonfield['type'],
						'sort_order'  => $i,
						'json_data'  => json_encode($jsonfield),
						'status'  => 0,
						'created_at'  => date('d-m-Y')
					);
					$FormsfieldModel->insert($data2);
				}
				$session->setFlashdata('form_success_msg',lang('Main.xin_form_updated_success_msg'));
				return redirect()->to(site_url('erp/forms-builder'));
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
			exit;
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
			$jsonfields = json_decode($_POST['json'],true);	
			
			$UsersModel = new UsersModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$FormscompletedfieldsModel = new FormscompletedfieldsModel();
			foreach ($_POST as $key => $value) {
				if($key!='user_id' && $key!='json' && $key!='ciapp_check' && $key!='token'){
					$data2 = array(
						'company_id'  => $company_id,
						'form_id'  => $_formidtoken,
						'staff_id'  => $usession['sup_user_id'],
						'field_key'  => $key,
						'field_value'  => $value,
						'status'  => 0,
						'created_at'  => date('d-m-Y')
					);
					$result = $FormscompletedfieldsModel->insert($data2);
				}
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
				$MainModel->delete_form_completed_options($id);
				$Return['result'] = lang('Main.xin_form_deleted_success_msg');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
}
