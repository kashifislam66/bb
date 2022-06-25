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

use App\Models\OffModel; 
use App\Models\MainModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\ConstantsModel;
use App\Models\TerminationModel;

class Termination extends BaseController {

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
		$data['title'] = lang('Dashboard.left_terminations').' | '.$xin_system['application_name'];
		$data['path_url'] = 'termination';
		$data['breadcrumbs'] = lang('Dashboard.left_terminations');

		$data['subview'] = view('erp/termination/key_termination', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	
	public function view_file()
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
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_termination_file').' | '.$xin_system['application_name'];
		$data['path_url'] = 'documents';
		$data['breadcrumbs'] = lang('Main.xin_termination_file');

		$data['subview'] = view('erp/system_documents/files/view_file', $data);
		return view('erp/layout/pre_layout_pdf', $data); //page load
	}
	// |||add record|||
	public function add_termination() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'notice_date' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'termination_date' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'file' => [
					'rules'  => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,10240]',
					'errors' => [
						'uploaded' => lang('Main.xin_error_field_text'),
						'mime_in' => lang('Main.xin_only_pdf_type_file'),
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
                    "notice_date" => $validation->getError('notice_date'),
					"termination_date" => $validation->getError('termination_date'),
					"file" => $validation->getError('file'),
					"reason" => $validation->getError('reason')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				
				// upload file
				$document_file = $this->request->getFile('file');
				$file_name = $document_file->getName();
				$size     = $document_file->getSize(); 
				$newName = $document_file->getRandomName();
				
				$document_file->move('public/uploads/pdf_files/termination/',$newName);
				
				$notice_date = $this->request->getPost('notice_date',FILTER_SANITIZE_STRING);
				$termination_date = $this->request->getPost('termination_date',FILTER_SANITIZE_STRING);
				$reason = $this->request->getPost('reason',FILTER_SANITIZE_STRING);			
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$staff_id = $usession['sup_user_id'];
					$company_id = $user_info['company_id'];
				} else {
					$staff_id = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
					$company_id = $usession['sup_user_id'];
				}
				$data = [
					'company_id'  => $company_id,
					'employee_id' => $staff_id,
					'notice_date'  => $notice_date,
					'termination_date'  => $termination_date,
					'reason'  => $reason,
					'document_file'  => $newName,
					'added_by'  => $usession['sup_user_id'],
					'status'  => 0,
					'is_signed'  => 0,
					'signed_file'  => '',
					'signed_date'  => '',
					'created_at' => date('d-m-Y h:i:s')
				];
				$TerminationModel = new TerminationModel();
				$result = $TerminationModel->insert($data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_termination_added');
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
	public function update_termination() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type',FILTER_SANITIZE_STRING) === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'notice_date' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'termination_date' => [
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
                    "notice_date" => $validation->getError('notice_date'),
					"termination_date" => $validation->getError('termination_date'),
					"reason" => $validation->getError('reason')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$notice_date = $this->request->getPost('notice_date',FILTER_SANITIZE_STRING);
				$termination_date = $this->request->getPost('termination_date',FILTER_SANITIZE_STRING);
				$reason = $request->getPost('reason',FILTER_SANITIZE_STRING);		
				$status = $this->request->getPost('status',FILTER_SANITIZE_STRING);		
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				$data = [
					'notice_date'  => $notice_date,
					'termination_date'  => $termination_date,
					'reason'  => $reason,
					'status'  => $status,
				];
				$TerminationModel = new TerminationModel();
				$result = $TerminationModel->update($id,$data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_termination_updated');
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
	public function termination_list() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$TerminationModel = new TerminationModel();
		$ConstantsModel = new ConstantsModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$get_data = $TerminationModel->where('company_id',$user_info['company_id'])->orderBy('termination_id', 'ASC')->findAll();
		} else {
			$get_data = $TerminationModel->where('company_id',$usession['sup_user_id'])->orderBy('termination_id', 'ASC')->findAll();
		}
		$data = array();
		
          foreach($get_data as $r) {
			  
			$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-field_id="'. uencode($r['termination_id']) . '"><i class="feather icon-edit"></i></button></span>';
			$delete = '<span data-toggle="tooltip" data-placement="top" data-state="danger" title="'.lang('Main.xin_delete').'"><button type="button" class="btn icon-btn btn-sm btn-light-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. uencode($r['termination_id']) . '"><i class="feather icon-trash-2"></i></button></span>';
			
			$view = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_view_this_file').'"><a target="_blank" href="'.site_url().'erp/termination-file/'.uencode($r['termination_id']).'"><button type="button" class="btn icon-btn btn-sm btn-light-warning waves-effect waves-light"><span class="fa fa-arrow-circle-right"></span></button></a></span>';
			
			$file_progress = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_view_file_progress').'"><button type="button" class="btn icon-btn btn-sm btn-light-dark waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_type="file_progress" data-field_id="'. uencode($r['termination_id']) . '"><i class="feather icon-link-2"></i></button></span>';
			
			$notice_date = set_date_format($r['notice_date']);
			$termination_date = set_date_format($r['termination_date']);
			//
			if($r['status'] == 0){
				$app_status = '<span class="badge badge-light-warning">'.lang('Main.xin_pending').'</span>';
			} else if($r['status'] == 1){
				$app_status = '<span class="badge badge-light-success">'.lang('Main.xin_accepted').'</span>';
			} else if($r['status'] == 2){
				$app_status = '<span class="badge badge-light-danger">'.lang('Main.xin_rejected').'</span>';
			}
			// employee
			$iuser = $UsersModel->where('user_id', $r['employee_id'])->first();
			if($iuser){
				$employee_name = $iuser['first_name'].' '.$iuser['last_name'];
				$ruserinfo = $employee_name.'<br><small class="text-muted"><i>'.$iuser['email'].'<i></i></i></small>';
				$uname = '<div class="d-inline-block align-middle">
					<img src="'.base_url().'/public/uploads/users/thumb/'.$iuser['profile_photo'].'" alt="user image" class="img-radius align-top m-r-15" style="width:40px;">
					<div class="d-inline-block">
						<h6 class="m-b-0">'.$employee_name.'</h6>
						<p class="m-b-0">'.$iuser['email'].'</p>
					</div>
				</div>';
				$combhr = $file_progress.$view.$edit.$delete;
			} else {
				$combhr = $file_progress.$view.$delete;
				$uname = '--';
			}
			if($user_info['user_type'] == 'company') {
				$iemployee_name = '
				'.$uname.'
				<div class="overlay-edit">
					'.$combhr.'
				</div>';	 			  				
			} else {
				$iemployee_name = $uname;
			}
			$data[] = array(
				$iemployee_name,
				$notice_date,
				$termination_date,
				$app_status
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
	public function read_termination()
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
			return view('erp/termination/dialog_termination', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// delete record
	public function delete_termination() {
		
		if($this->request->getPost('type')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$id = udecode($this->request->getPost('_token',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$TerminationModel = new TerminationModel();
			$result = $TerminationModel->where('termination_id', $id)->delete($id);
			if ($result == TRUE) {
				$Return['result'] = lang('Main.xin_termination_deleted');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
}
