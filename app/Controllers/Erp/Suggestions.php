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
use App\Models\SuggestionsModel;
use App\Models\SuggestioncommentsModel;

class Suggestions extends BaseController {

	public function index()
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
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_hr_suggestions').' | '.$xin_system['application_name'];
		$data['path_url'] = 'suggestions';
		$data['breadcrumbs'] = lang('Main.xin_hr_suggestions');

		$data['subview'] = view('erp/suggestions/suggestions', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function suggestion_view()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		
		$usession = $session->get('sup_username');
		$SuggestionsModel = new SuggestionsModel();
		$ifield_id = udecode($request->uri->getSegment(3));
		$isegment_val = $SuggestionsModel->where('suggestion_id', $ifield_id)->first();
		if(!$isegment_val){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if(!$session->has('sup_username')){ 
			$session->setFlashdata('err_not_logged_in',lang('Dashboard.err_not_logged_in'));
			return redirect()->to(site_url('erp/login'));
		}
		if($user_info['user_type'] != 'company' && $user_info['user_type']!='staff'){
			$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
			return redirect()->to(site_url('erp/desk'));
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_hr_view_suggestion').' | '.$xin_system['application_name'];
		$data['path_url'] = 'suggestion_view';
		$data['breadcrumbs'] = lang('Main.xin_hr_view_suggestion');

		$data['subview'] = view('erp/suggestions/suggestion_view', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	 // record list
	public function suggestions_list() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$SuggestionsModel = new SuggestionsModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$get_data = $SuggestionsModel->where('company_id',$user_info['company_id'])->where('added_by',$user_info['user_id'])->orderBy('suggestion_id', 'ASC')->findAll();
		} else {
			$get_data = $SuggestionsModel->where('company_id',$usession['sup_user_id'])->orderBy('suggestion_id', 'ASC')->findAll();
		}
		$data = array();
		
          foreach($get_data as $r) {
			  
			if(in_array('policy3',staff_role_resource()) || $user_info['user_type'] == 'company') { //edit
				$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. uencode($r['suggestion_id']) . '"><i class="feather icon-edit"></i></button></span>';
			} else {
				$edit = '';
			}
			if(in_array('policy4',staff_role_resource()) || $user_info['user_type'] == 'company') { //delete
				$delete = '<span data-toggle="tooltip" data-placement="top" data-state="danger" title="'.lang('Main.xin_delete').'"><button type="button" class="btn icon-btn btn-sm btn-light-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. uencode($r['suggestion_id']) . '"><i class="feather icon-trash-2"></i></button></span>';
			} else {
				$delete = '';
			}
			if($r['attachment'] == ''){
				$download_link = '';
			} else {
				$download_link = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_download_signed_file').'"><a href="'.site_url().'download?type=suggestions&filename='.uencode($r['attachment']).'"><button type="button" class="btn icon-btn btn-sm btn-light-dark waves-effect waves-light"><i class="feather icon-download"></i></button></a></span>';
			}
			$view = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_view_details').'"><a href="'.site_url().'erp/suggestion-view/'.uencode($r['suggestion_id']).'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light"><span class="fa fa-arrow-circle-right"></span></button></a></span>';
			$created_at = set_date_format($r['created_at']);
			$added_by = $UsersModel->where('user_id', $r['added_by'])->first();			
			$title = $r['title'];
			$combhr = $view.$download_link.$edit.$delete;
			if(in_array('policy3',staff_role_resource()) || in_array('policy4',staff_role_resource()) || $user_info['user_type'] == 'company') {
					
				$ititle = '
				'.$title.'
				<div class="overlay-edit">
					'.$combhr.'
				</div>';		 			  				
			} else {
				$ititle = $title;
			}
			$data[] = array(
				$ititle,
				$created_at,
				$added_by['first_name'].' '.$added_by['last_name']
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
	public function add_suggestion() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'title' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "title" => $validation->getError('title'),
					// "description" => $validation->getError('description'),
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				if($_FILES['attachment']['size'] == 0) {
					$file_name = '';
				} else {
					// upload file
					$attachment = $this->request->getFile('attachment');
					$file_name = $attachment->getName();
					$file_name = $attachment->getRandomName();
					$attachment->move('public/uploads/suggestions/',$file_name);
				}
								
				$title = $this->request->getPost('title',FILTER_SANITIZE_STRING);
				$description = $this->request->getPost('description',FILTER_SANITIZE_STRING);
				
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
				} else {
					$company_id = $usession['sup_user_id'];
				}
				$data = [
					'company_id'  => $company_id,
					'title'  => $title,
					'description'  => $description,
					'attachment'  => $file_name,
					'added_by'  => $usession['sup_user_id'],
					'created_at' => date('d-m-Y h:i:s')
				];
				$SuggestionsModel = new SuggestionsModel();
				$result = $SuggestionsModel->insert($data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_hr_suggestion_added');
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
	public function add_comment() {
			
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
						'required' => lang('Main.xin_comment_field_required')
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
				$data = [
					'company_id' => $company_id,
					'suggestion_id' => $id,
					'employee_id'  => $usession['sup_user_id'],
					'suggestion_comment'  => $description,
					'created_at' => date('d-m-Y h:i:s')
				];
				$SuggestioncommentsModel = new SuggestioncommentsModel();
				$result = $SuggestioncommentsModel->insert($data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_comment_added_success');
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
	public function update_suggestion() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();	
		if ($this->request->getPost('type') === 'edit_record') {
			
			// set rules
			$rules = [
				'title' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "title" => $validation->getError('title'),
					// "description" => $validation->getError('description')
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
				$title = $this->request->getPost('title',FILTER_SANITIZE_STRING);
				$description = $this->request->getPost('description',FILTER_SANITIZE_STRING);
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				if ($validated) {
					// upload file
					$attachment = $this->request->getFile('attachment');
					$file_name = $attachment->getName();
					$file_name = $attachment->getRandomName();
					$attachment->move('public/uploads/suggestions/',$file_name);
					$data = [
						'title' => $title,
						'description'  => $description,
						'attachment'  => $file_name,
					];
				} else {
						$data = [
						'title' => $title,
						'description'  => $description,
					];	
				}
				$SuggestionsModel = new SuggestionsModel();
				$result = $SuggestionsModel->update($id, $data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_hr_suggestion_updated');
				} else {
					$Return['error'] = lang('Main.xin_error_msg');
				}
				$this->output($Return);
				exit;
			}
		}			
	}
	// read record
	public function read_suggestion()
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
			return view('erp/suggestions/dialog_suggestion', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// delete record
	public function delete_suggestion() {
		
		if($this->request->getPost('type')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$id = udecode($this->request->getPost('_token',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$SuggestionsModel = new SuggestionsModel();
			$result = $SuggestionsModel->where('suggestion_id', $id)->delete($id);
			if ($result == TRUE) {
				$Return['result'] = lang('Main.xin_hr_suggestion_deleted');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
	// delete record
	public function delete_suggestion_comment() {
		
		if($this->request->getVar('field_id')) {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$id = $this->request->getVar('field_id',FILTER_SANITIZE_STRING);
			$Return['csrf_hash'] = csrf_hash();
			$SuggestioncommentsModel = new SuggestioncommentsModel();
			$result = $SuggestioncommentsModel->where('comment_id', $id)->delete($id);
			if ($result == TRUE) {
				$Return['result'] = lang('Main.xin_comment_deleted_success');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
}
