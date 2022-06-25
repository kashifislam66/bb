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
use App\Models\DepartmentModel;
use App\Models\ResignationsModel;
use App\Models\StaffdetailsModel;
use App\Models\SignaturedocumentsModel;
use App\Models\StaffsignaturedocumentsModel;

class Files extends BaseController {

	public function new_files()
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
			if(!in_array('file1',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_e_signature_files').' | '.$xin_system['application_name'];
		$data['path_url'] = 'documents_signature';
		$data['breadcrumbs'] = lang('Main.xin_e_signature_files');

		$data['subview'] = view('erp/system_documents/files/signature_files', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function onboarding_tasks()
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
			if(!in_array('file1',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Employees.xin_general_documents').' | '.$xin_system['application_name'];
		$data['path_url'] = 'documents_signature';
		$data['breadcrumbs'] = lang('Employees.xin_general_documents');

		$data['subview'] = view('erp/system_documents/tasks/onboarding_tasks', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function offboarding_tasks()
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
			if(!in_array('file1',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Employees.xin_general_documents').' | '.$xin_system['application_name'];
		$data['path_url'] = 'documents_signature';
		$data['breadcrumbs'] = lang('Employees.xin_general_documents');

		$data['subview'] = view('erp/system_documents/tasks/offboarding_tasks', $data);
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
		if($user_info['user_type'] != 'company'){
			if(!in_array('file1',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Employees.xin_general_documents').' | '.$xin_system['application_name'];
		$data['path_url'] = 'documents';
		$data['breadcrumbs'] = lang('Employees.xin_general_documents');

		$data['subview'] = view('erp/system_documents/files/view_file', $data);
		return view('erp/layout/pre_layout_pdf', $data); //page load
	}
	
	// record list
	public function signature_documents_list() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		//$id = $request->uri->getSegment(5);
		$SignaturedocumentsModel = new SignaturedocumentsModel();
		$DepartmentModel = new DepartmentModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
			$get_data = $SignaturedocumentsModel->where('company_id',$company_id)->orderBy('document_id', 'ASC')->findAll();
		} else {
			$company_id = $usession['sup_user_id'];
			$get_data = $SignaturedocumentsModel->where('company_id',$company_id)->orderBy('document_id', 'ASC')->findAll();
		}

		$data = array();
		
          foreach($get_data as $r) {
			  
			if(in_array('file3',staff_role_resource()) || $user_info['user_type'] == 'company') {
				$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-field_type="document" data-field_id="'. uencode($r['document_id']) . '"><i class="feather icon-edit"></i></button></span>';
			} else {
				$edit = '';
			}
			if(in_array('file4',staff_role_resource()) || $user_info['user_type'] == 'company') {
				$delete = '<span data-toggle="tooltip" data-placement="top" data-state="danger" title="'.lang('Main.xin_delete').'"><button type="button" class="btn icon-btn btn-sm btn-light-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-field_type="document" data-record-id="'. uencode($r['document_id']) . '"><i class="feather icon-trash-2"></i></button></span>';
			} else {
				$delete = '';
			}
			$view = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_view_this_file').'"><a target="_blank" href="'.site_url().'erp/sign-file/'.uencode($r['document_id']).'"><button type="button" class="btn icon-btn btn-sm btn-light-warning waves-effect waves-light"><span class="fa fa-arrow-circle-right"></span></button></a></span>';
			
			$file_progress = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_view_file_progress').'"><button type="button" class="btn icon-btn btn-sm btn-light-dark waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_type="file_progress" data-field_id="'. uencode($r['document_id']) . '"><i class="feather icon-link-2"></i></button></span>';
			
			$combhr = $file_progress.$view.$edit.$delete;
			$download_link = '<a href="'.site_url().'download?type=system_documents&filename='.uencode($r['document_file']).'">'.lang('Main.xin_download').'</a>';
			$created_at = '<i class="feather icon-calendar"></i> '.set_date_format($r['created_at']);
			$size = format_size_units($r['document_size']);
			if($r['share_with_employees']==1){
				$shared = '<small><i class="text-muted  fas fa-user-check"></i> Shared</small>';
			} else {
				$shared = '';
			}
			if($r['signature_task']==1){
				$signature_task = lang('Main.xin_onboarding_file');
			} else {
				$signature_task = lang('Main.xin_offboarding_file');
			}
			$file_opt = '<span>'.$size.'</span>';
			
			$file_name = '<h6 class="m-b-0">'.$r['document_name'].' '.$shared.'</h6>'.$file_opt;
			if(in_array('file3',staff_role_resource()) || in_array('file4',staff_role_resource()) || $user_info['user_type'] == 'company') {
					$status = '
					'.$created_at.'
					<div class="overlay-edit">
						'.$combhr.'
					</div>';		  				
			} else {
				$status = '';
			}
			$data[] = array(
				$file_name,
				$signature_task,
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
	public function user_onboarding_documents() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		$id = $usession['sup_user_id'];
		$SignaturedocumentsModel = new SignaturedocumentsModel();
		$StaffsignaturedocumentsModel = new StaffsignaturedocumentsModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$get_data = $StaffsignaturedocumentsModel->where('signature_task',1)->where('staff_id',$id)->orderBy('document_id', 'ASC')->findAll();
		$data = array();
		//->where('staff_id',$id)->orwhere('staff_id',0)
          foreach($get_data as $r) {
		
				$org_file = $SignaturedocumentsModel->where('document_id', $r['signature_file_id'])->first();
				$created_at = '<i class="feather icon-calendar"></i> '.set_date_format($r['created_at']);
				if($r['is_signed']==1){
					$signedinfo = lang('Main.xin_signed');
					$signed_download_link = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_download_signed_file').'"><a href="'.site_url().'download?type=pdf_files/files/signed/&filename='.uencode($r['signed_file']).'"><button type="button" class="btn icon-btn btn-sm btn-light-dark waves-effect waves-light"><i class="feather icon-download"></i></button></a></span>';
					$signed_date = set_date_format($r['signed_date']);
					$isignedinfo = $signedinfo.'<br> <i class="feather icon-calendar"></i> '.$signed_date;
				} else {
					$signedinfo = lang('Main.xin_notsigned');
					$signed_download_link = '';
					$isignedinfo = $signedinfo;
				}
				
				$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_upload_signed_file').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-field_type="onboarding" data-field_id="'. uencode($r['document_id']) . '"><i class="feather icon-upload"></i></button></span>';
				
				$view = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_sign_this_file').'"><a target="_blank" href="'.site_url().'erp/sign-file/'.uencode($r['signature_file_id']).'"><button type="button" class="btn icon-btn btn-sm btn-light-warning waves-effect waves-light"><span class="fa fa-arrow-circle-right"></span></button></a></span>';
				
				$download_link = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_download_original_file').'"><a href="'.site_url().'download?type=pdf_files/files&filename='.uencode($org_file['document_file']).'"><button type="button" class="btn icon-btn btn-sm btn-light-success waves-effect waves-light"><i class="feather icon-download"></i></button></a></span>';
								
				$combhr = $edit.$view.$download_link.$signed_download_link;
				$action = '
				'.$created_at.'
				<div class="overlay-edit">
					'.$combhr.'
				</div>';

				$data[] = array(
					$org_file['document_name'],
					$isignedinfo,
					$action
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
	public function user_offboarding_documents() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		$id = $usession['sup_user_id'];
		$SignaturedocumentsModel = new SignaturedocumentsModel();
		$StaffsignaturedocumentsModel = new StaffsignaturedocumentsModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$get_data = $StaffsignaturedocumentsModel->where('signature_task',0)->where('staff_id',$id)->orderBy('document_id', 'ASC')->findAll();
		$data = array();
		
          foreach($get_data as $r) {
			
				$org_file = $SignaturedocumentsModel->where('document_id', $r['signature_file_id'])->first();
				$created_at = '<i class="feather icon-calendar"></i> '.set_date_format($r['created_at']);
				if($r['is_signed']==1){
					$signedinfo = lang('Main.xin_signed');
					$signed_download_link = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_download_signed_file').'"><a href="'.site_url().'download?type=pdf_files/files/signed/&filename='.uencode($r['signed_file']).'"><button type="button" class="btn icon-btn btn-sm btn-light-dark waves-effect waves-light"><i class="feather icon-download"></i></button></a></span>';
					$signed_date = set_date_format($r['signed_date']);
					$isignedinfo = $signedinfo.'<br> <i class="feather icon-calendar"></i> '.$signed_date;
				} else {
					$signedinfo = lang('Main.xin_notsigned');
					$signed_download_link = '';
					$isignedinfo = $signedinfo;
				}
				
				$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_upload_signed_file').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-field_type="offboarding" data-field_id="'. uencode($r['document_id']) . '"><i class="feather icon-upload"></i></button></span>';
				
				$view = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_sign_this_file').'"><a target="_blank" href="'.site_url().'erp/sign-file/'.uencode($r['signature_file_id']).'"><button type="button" class="btn icon-btn btn-sm btn-light-warning waves-effect waves-light"><span class="fa fa-arrow-circle-right"></span></button></a></span>';
				
				$download_link = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_download_original_file').'"><a href="'.site_url().'download?type=pdf_files/files&filename='.uencode($org_file['document_file']).'"><button type="button" class="btn icon-btn btn-sm btn-light-success waves-effect waves-light"><i class="feather icon-download"></i></button></a></span>';
								
				$combhr = $edit.$view.$download_link.$signed_download_link;
				
				$action = '
				'.$created_at.'
				<div class="overlay-edit">
					'.$combhr.'
				</div>';

				$data[] = array(
					$org_file['document_name'],
					$isignedinfo,
					$action
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
	public function user_resigntion_documents() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		$id = $usession['sup_user_id'];
		$ResignationsModel = new ResignationsModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		$get_data = $ResignationsModel->where('employee_id',$id)->orderBy('resignation_id', 'ASC')->findAll();
		$data = array();

          foreach($get_data as $r) {
		
				$notice_date = '<i class="feather icon-calendar"></i> '.set_date_format($r['notice_date']);
				$created_at = '<i class="feather icon-calendar"></i> '.set_date_format($r['created_at']);
				if($r['is_signed']==1){
					$signedinfo = lang('Main.xin_signed');
					$signed_download_link = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_download_signed_file').'"><a href="'.site_url().'download?type=pdf_files/resignation/signed/&filename='.uencode($r['signed_file']).'"><button type="button" class="btn icon-btn btn-sm btn-light-dark waves-effect waves-light"><i class="feather icon-download"></i></button></a></span>';
					$signed_date = set_date_format($r['signed_date']);
					$isignedinfo = $signedinfo.'<br> <i class="feather icon-calendar"></i> '.$signed_date;
				} else {
					$signedinfo = lang('Main.xin_notsigned');
					$signed_download_link = '';
					$isignedinfo = $signedinfo;
				}
				
				$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_upload_signed_file').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-field_type="resignation" data-field_id="'. uencode($r['resignation_id']) . '"><i class="feather icon-upload"></i></button></span>';
				
				$view = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_sign_this_file').'"><a target="_blank" href="'.site_url().'erp/resignation-file/'.uencode($r['resignation_id']).'"><button type="button" class="btn icon-btn btn-sm btn-light-warning waves-effect waves-light"><span class="fa fa-arrow-circle-right"></span></button></a></span>';
				
				$download_link = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_download_original_file').'"><a href="'.site_url().'download?type=pdf_files/resignation&filename='.uencode($r['document_file']).'"><button type="button" class="btn icon-btn btn-sm btn-light-success waves-effect waves-light"><i class="feather icon-download"></i></button></a></span>';
								
				$combhr = $edit.$view.$download_link.$signed_download_link;
				$action = '
				'.$created_at.'
				<div class="overlay-edit">
					'.$combhr.'
				</div>';

				$data[] = array(
					$notice_date,
					$isignedinfo,
					$action
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
	public function add_onboarding_document() {
			
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
				'file' => [
					'rules'  => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,10000]',
					'errors' => [
						'uploaded' => lang('Main.xin_error_field_text'),
						'mime_in' => lang('Main.xin_only_pdf_type_file'),
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
					"file" => $validation->getError('file')
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
				
				$document_file->move('public/uploads/pdf_files/files/signed/',$newName);							
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				$data = [
					'is_signed' => 1,
					'signed_file' => $newName,
					'signed_date'  => date('d-m-Y h:i:s')
				];
				$MainModel = new MainModel();
				$StaffsignaturedocumentsModel = new StaffsignaturedocumentsModel();
				$result = $StaffsignaturedocumentsModel->update($id,$data);				
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_uploaded_signed_file');
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
	public function add_offboarding_document() {
			
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
				'file' => [
					'rules'  => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,10000]',
					'errors' => [
						'uploaded' => lang('Main.xin_error_field_text'),
						'mime_in' => lang('Main.xin_only_pdf_type_file'),
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
					"file" => $validation->getError('file')
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
				
				$document_file->move('public/uploads/pdf_files/files/signed/',$newName);							
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				$data = [
					'is_signed' => 1,
					'signed_file' => $newName,
					'signed_date'  => date('d-m-Y h:i:s')
				];
				$MainModel = new MainModel();
				$StaffsignaturedocumentsModel = new StaffsignaturedocumentsModel();
				$result = $StaffsignaturedocumentsModel->update($id,$data);				
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_uploaded_signed_file');
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
	public function add_resignation_document() {
			
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
				'file' => [
					'rules'  => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,10000]',
					'errors' => [
						'uploaded' => lang('Main.xin_error_field_text'),
						'mime_in' => lang('Main.xin_only_pdf_type_file'),
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
					"file" => $validation->getError('file')
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
				
				$document_file->move('public/uploads/pdf_files/resignation/signed/',$newName);							
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				$data = [
					'is_signed' => 1,
					'signed_file' => $newName,
					'signed_date'  => date('d-m-Y h:i:s')
				];
				$MainModel = new MainModel();
				$ResignationsModel = new ResignationsModel();
				$result = $ResignationsModel->update($id,$data);				
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_uploaded_signed_file');
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
	public function add_document() {
			
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
				'document_name' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'signature_task' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'share_with_employees' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'file' => [
					'rules'  => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,10000]',
					'errors' => [
						'uploaded' => lang('Main.xin_error_field_text'),
						'mime_in' => lang('Main.xin_only_pdf_type_file'),
					]
				]
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
					"document_name" => $validation->getError('document_name'),
					"signature_task" => $validation->getError('signature_task'),
					"share_with_employees" => $validation->getError('share_with_employees'),
					"file" => $validation->getError('file')
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
				
				$document_file->move('public/uploads/pdf_files/files/',$newName);				
				$document_name = $this->request->getPost('document_name',FILTER_SANITIZE_STRING);
				$signature_task = $this->request->getPost('signature_task',FILTER_SANITIZE_STRING);
				$share_with_employees = $this->request->getPost('share_with_employees',FILTER_SANITIZE_STRING);		
				$share_info = implode(',',$share_with_employees);	
				$ishare_info = array($share_info);
				
				/*if($Return['error']!=''){
					$this->output($Return);
				}*/
								
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
					'company_id' => $company_id,
					'folder_id' => $company_id,
					'share_with_employees'  => $share_info,
					'document_name'  => $document_name,
					'document_size'  => $size,
					'document_file'  => $newName,
					'signature_task'  => $signature_task,
					'created_at' => date('d-m-Y h:i:s')
				];
				$SignaturedocumentsModel = new SignaturedocumentsModel();
				$StaffsignaturedocumentsModel = new StaffsignaturedocumentsModel();
				$result = $SignaturedocumentsModel->insert($data);	
				$signature_file_id = $SignaturedocumentsModel->insertID();
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_signature_file_added_msg');
					if(in_array('all',$ishare_info)) {
						
						foreach($assigned_user_info as $istaff){
							$data2 = [
								'company_id' => $company_id,
								'staff_id' => $istaff['user_id'],
								'signature_file_id' => $signature_file_id,
								'signature_task'  => $signature_task,
								'is_signed'  => 0,
								'signed_file'  => '',
								'signed_date'  => '',
								'created_at' => date('d-m-Y h:i:s')
							];
							$StaffsignaturedocumentsModel->insert($data2);
						}
					} else {
						$data2 = [
							'company_id' => $company_id,
							'staff_id' => $share_info,
							'signature_file_id' => $signature_file_id,
							'signature_task'  => $signature_task,
							'is_signed'  => 0,
							'signed_file'  => '',
							'signed_date'  => '',
							'created_at' => date('d-m-Y h:i:s')
						];
						$StaffsignaturedocumentsModel->insert($data2);
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
	// |||add record|||
	public function update_document() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'document_name' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
					"document_name" => $validation->getError('document_name'),
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {				
				$document_name = $this->request->getPost('document_name',FILTER_SANITIZE_STRING);
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				$data = [
					'document_name'  => $document_name,
				];
				$SignaturedocumentsModel = new SignaturedocumentsModel();
				$result = $SignaturedocumentsModel->update($id,$data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_signature_file_updated_msg');
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
	public function read_document()
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
			return view('erp/system_documents/files/dialog_signature_files', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// read record
	public function read_user_signature_document()
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
			return view('erp/system_documents/files/dialog_user_signature_files', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// delete record
	public function delete_document() {
		
		$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			if($this->request->getPost('_method')=='DELETE') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			
			$id = udecode($this->request->getPost('_token',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$SignaturedocumentsModel = new SignaturedocumentsModel();
			$result = $SignaturedocumentsModel->where('document_id', $id)->delete($id);
			if ($result == TRUE) {
				$Return['result'] = lang('Main.xin_signature_file_deleted_msg');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
			exit;
		}
	}
}
