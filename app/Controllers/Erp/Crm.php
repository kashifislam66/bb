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
use App\Models\UsersModel;
use App\Models\RolesModel;
use App\Models\CompanyModel;
use App\Models\CountryModel;
use App\Models\ConstantsModel;
use App\Models\SuperroleModel;
use App\Models\CompanyticketsModel;
use App\Models\CompanyticketreplyModel;

class Crm extends BaseController {

	// create new ticket
	public function create_ticket()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		/*if($user_info['user_type'] != 'company' && $user_info['user_type']!='super_user'){
			return redirect()->to(site_url('erp/desk'));
		}*/
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.dashboard_employees').' | '.$xin_system['application_name'];
		$data['path_url'] = 'company_ticket_create';
		$data['breadcrumbs'] = lang('Dashboard.dashboard_employees');

		$data['subview'] = view('erp/crm/contact_support', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	// tickets
	public function tickets()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		/*if($user_info['user_type'] != 'company' && $user_info['user_type']!='super_user'){
			return redirect()->to(site_url('erp/desk'));
		}*/
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.dashboard_employees').' | '.$xin_system['application_name'];
		$data['path_url'] = 'company_tickets';
		$data['breadcrumbs'] = lang('Dashboard.dashboard_employees');

		$data['subview'] = view('erp/crm/key_tickets', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	//ticket details
	public function ticket_details()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$CompanyticketsModel = new CompanyticketsModel();
		$ifield_id = udecode($request->uri->getSegment(3));
		$isegment_val = $CompanyticketsModel->where('ticket_id', $ifield_id)->first();
		if(!$isegment_val){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		/*if($user_info['user_type'] != 'company' && $user_info['user_type']!='super_user'){
			return redirect()->to(site_url('erp/desk'));
		}*/
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Dashboard.left_ticket_details').' | '.$xin_system['application_name'];
		$data['path_url'] = 'company_ticket_details';
		$data['breadcrumbs'] = lang('Dashboard.left_ticket_details');

		$data['subview'] = view('erp/crm/key_ticket_details', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	// |||add record|||
	public function add_ticket() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}	
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'category' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'priority' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'subject' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'description' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "category" => $validation->getError('category'),
					"priority" => $validation->getError('priority'),
					"subject" => $validation->getError('subject'),
					"description" => $validation->getError('description')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				// upload file			
				$category = $this->request->getPost('category',FILTER_SANITIZE_STRING);
				$priority = $this->request->getPost('priority',FILTER_SANITIZE_STRING);
				$subject = $this->request->getPost('subject',FILTER_SANITIZE_STRING);
				$description = $this->request->getPost('description',FILTER_SANITIZE_STRING);
				$UsersModel = new UsersModel();
			//	$EmailtemplatesModel = new EmailtemplatesModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				$company_id = $usession['sup_user_id'];
				$ticket_code = generate_random_code();
				$data = [
					'company_id'  => $company_id,
					'subject'  => $subject,
					'ticket_code'  => $ticket_code,
					'category_id'  => $category,
					'ticket_priority'  => $priority,
					'description'  => $description,
					'ticket_status' => '1',
					'ticket_remarks' => '',
					'created_by' => $usession['sup_user_id'],
					'created_at' => date('d-m-Y h:i:s')
				];
				$CompanyticketsModel = new CompanyticketsModel();
				$result = $CompanyticketsModel->insert($data);	
				$ticket_id = $CompanyticketsModel->insertID();
				$data3 = [
					'company_id' => $company_id,
					'ticket_id' => $ticket_id,
					'sent_by'  => $usession['sup_user_id'],
					'assign_to'  => $company_id,
					'reply_text'  => $description,
					'created_at' => date('d-m-Y h:i:s')
				];
				$CompanyticketreplyModel = new CompanyticketreplyModel();
				
				$CompanyticketreplyModel->insert($data3);
				$Return['csrf_hash'] = csrf_hash();	
				$SystemModel = new SystemModel();
				$xin_system = $SystemModel->where('setting_id', 1)->first();
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_ticket_created__msg');
					if($xin_system['enable_email_notification'] == 1){
						// Send mail start
						/*$itemplate = $EmailtemplatesModel->where('template_id', 12)->first();
						$istaff_info = $UsersModel->where('user_id', $employee_id)->first();
	
						$isubject = str_replace("{ticket_code}",$ticket_code,$itemplate['subject']);
						$ibody = html_entity_decode($itemplate['message']);
						$fbody = str_replace(array("{site_name}","{ticket_code}"),array($company_info['company_name'],$ticket_code),$ibody);
						timehrm_mail_data($company_info['email'],$company_info['company_name'],$istaff_info['email'],$isubject,$fbody);*/
						// Send mail end
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
	public function update_ticket_status() {
			
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
				],
				'remarks' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "remarks" => $validation->getError('remarks'),
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
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));	
				$data = [
					'ticket_remarks' => $remarks,
					'ticket_status'  => $status
				];
				$CompanyticketsModel = new CompanyticketsModel();
				$result = $CompanyticketsModel->update($id,$data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_ticket_status_updated_msg');
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
	public function add_ticket_reply() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'description' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Success.xin_ticket_reply_field_error')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "description" => $validation->getError('description')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
				} else {
					$company_id = $usession['sup_user_id'];
				}
				$description = $this->request->getPost('description',FILTER_SANITIZE_STRING);
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				$token2 = udecode($this->request->getPost('token2',FILTER_SANITIZE_STRING));	
				$data = [
					'company_id' => $company_id,
					'ticket_id' => $id,
					'sent_by'  => $usession['sup_user_id'],
					'assign_to'  => $token2,
					'reply_text'  => $description,
					'created_at' => date('d-m-Y h:i:s')
				];
				$CompanyticketreplyModel = new CompanyticketreplyModel();
				$result = $CompanyticketreplyModel->insert($data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_ticket_reply_updated_msg');
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
	public function update_ticket() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'subject' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'ticket_priority' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "subject" => $validation->getError('subject'),
					"ticket_priority" => $validation->getError('ticket_priority')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$subject = $this->request->getPost('subject',FILTER_SANITIZE_STRING);	
				$ticket_priority = $this->request->getPost('ticket_priority',FILTER_SANITIZE_STRING);
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));	
				$data = [
					'subject' => $subject,
					'ticket_priority'  => $ticket_priority
				];
				$CompanyticketsModel = new CompanyticketsModel();
				$result = $CompanyticketsModel->update($id,$data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.ci_ticket_updated_msg');
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
	public function read_ticket()
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
			return view('erp/crm/dialog_ticket', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// delete record
	public function delete_ticket_reply() {
		
		if($this->request->getVar('field_id')) {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$id = $this->request->getVar('field_id',FILTER_SANITIZE_STRING);
			$Return['csrf_hash'] = csrf_hash();
			$CompanyticketreplyModel = new CompanyticketreplyModel();
			$result = $CompanyticketreplyModel->where('ticket_reply_id', $id)->delete($id);
			if ($result == TRUE) {
				$Return['result'] = lang('Success.ci_ticket_reply_deleted_msg');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
	// delete record
	public function delete_ticket() {
		
		if($this->request->getPost('type')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$id = udecode($this->request->getPost('_token',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$CompanyticketsModel = new CompanyticketsModel();
			$result = $CompanyticketsModel->where('ticket_id', $id)->delete($id);
			if ($result == TRUE) {
				$Return['result'] = lang('Success.ci_ticket_deleted_msg');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
}
