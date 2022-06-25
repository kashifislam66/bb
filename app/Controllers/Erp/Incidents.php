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
use App\Models\IncidentsModel;
use App\Models\SystemModel;
use App\Models\ConstantsModel;
use App\Models\SmstemplatesModel;
use App\Models\StaffapprovalsModel;
use App\Models\EmailtemplatesModel;

class Incidents extends BaseController {

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
			if(!in_array('incident1',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_incidents').' | '.$xin_system['application_name'];
		$data['path_url'] = 'incidents';
		$data['breadcrumbs'] = lang('Main..xin_incidents');

		$data['subview'] = view('erp/incidents/key_incidents', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function incident_details()
	{		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		
		$usession = $session->get('sup_username');
		$IncidentsModel = new IncidentsModel();
		$request = \Config\Services::request();
		$ifield_id = udecode($request->uri->getSegment(3));
		$isegment_val = $IncidentsModel->where('incident_id', $ifield_id)->first();
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
		/*if($user_info['user_type'] != 'company'){
			if(!in_array('incident1',staff_role_resource())) {
				$session->setFlashdata('unauthorized_module',lang('Dashboard.xin_error_unauthorized_module'));
				return redirect()->to(site_url('erp/desk'));
			}
		}*/
		$NotificationsModel = new \App\Models\NotificationsModel();
		$NotificationstatusModel = new \App\Models\NotificationstatusModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type']=='staff'){
			//get request
			$status = $this->request->getGET('status');
			if($status == 0){
				update_notifications_read_status_pending('incident_settings',$ifield_id);
			} else {
				update_notifications_read_status_approved('incident_settings',$ifield_id);
			}
		}
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_incident_details').' | '.$xin_system['application_name'];
		$data['path_url'] = 'incidents';
		$data['breadcrumbs'] = lang('Main.xin_incident_details');

		$data['subview'] = view('erp/incidents/key_incident_details', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	// |||add record|||
	public function add_incident() {
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
				'incident_type_id' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'title' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'incident_date' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'incident_time' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'incident_description' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "incident_type_id" => $validation->getError('incident_type_id'),
					"title" => $validation->getError('title'),
					"incident_date" => $validation->getError('incident_date'),
					"incident_time" => $validation->getError('incident_time'),
					"incident_description" => $validation->getError('incident_description'),
					//"award_picture" => $validation->getError('award_picture')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				 $validated = $this->validate([
					'incident_file' => [
						'rules'  => 'uploaded[incident_file]|ext_in[incident_file,jpg,jpeg,png,pdf,doc,docx]|max_size[incident_file,10240]',
						'errors' => [
							'uploaded' => lang('Main.xin_error_field_text'),
							'mime_in' => lang('Main.xin_invalid_file_format')
						]
					],
				]);	
				
				$incident_time = $this->request->getPost('incident_time',FILTER_SANITIZE_STRING);
				if(preg_match("/((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))/", $incident_time) == false ) {
					$Return['error'] = "Invalid Time";
					if($Return['error']!=''){
					$this->output($Return);
					}
				}
				$incident_type_id = $this->request->getPost('incident_type_id',FILTER_SANITIZE_STRING);
				$title = $this->request->getPost('title',FILTER_SANITIZE_STRING);
				$incident_date = $this->request->getPost('incident_date',FILTER_SANITIZE_STRING);
				$incident_time = date("H:i", strtotime($incident_time));
				$incident_description = $this->request->getPost('incident_description',FILTER_SANITIZE_STRING);
				$notify_send_to = implode(',',$this->request->getPost('notify_send_to',FILTER_SANITIZE_STRING));
				$notify_send_to_ids = $notify_send_to;
				
				$UsersModel = new UsersModel();
				$SystemModel = new SystemModel();
				$ConstantsModel = new ConstantsModel();
				$SmstemplatesModel = new SmstemplatesModel();
				$EmailtemplatesModel = new EmailtemplatesModel();
				$xin_system = $SystemModel->where('setting_id', 1)->first();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$staff_id = $usession['sup_user_id'];
					$company_id = $user_info['company_id'];
					$company_info = $UsersModel->where('company_id', $company_id)->first();
				} else {
					$staff_id = $this->request->getPost('employee_id',FILTER_SANITIZE_STRING);
					$company_id = $usession['sup_user_id'];
					$company_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				}
				if ($validated) {
					$attachment = $this->request->getFile('incident_file');
					$file_name = $attachment->getName();
					$file_name = $attachment->getRandomName();
					$attachment->move('public/uploads/incidents/',$file_name);
					$data = [
						'company_id' => $company_id,
						'employee_id'  => $staff_id,
						'incident_type_id'  => $incident_type_id,
						'title'  => $title,
						'incident_date'  => $incident_date,
						'incident_time'  => $incident_time,
						'description'  => $incident_description,
						'incident_file'  => $file_name,
						'notify_send_to'  => $notify_send_to_ids,
						'status'  => 0,
						'created_at'  => date('d-m-Y h:i:s'),
					];
				} else {
					$data = [
						'company_id' => $company_id,
						'employee_id'  => $staff_id,
						'incident_type_id'  => $incident_type_id,
						'title'  => $title,
						'incident_date'  => $incident_date,
						'incident_time'  => $incident_time,
						'description'  => $incident_description,
						'incident_file'  => '',
						'notify_send_to'  => $notify_send_to_ids,
						'status'  => 0,
						'created_at'  => date('d-m-Y h:i:s'),
					];
				}
				
				$IncidentsModel = new IncidentsModel();
				$result = $IncidentsModel->insert($data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.xin_incident_added_success');
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
	public function update_incident() {
			
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
				'incident_type_id' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'title' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'incident_date' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'incident_time' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'incident_description' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "incident_type_id" => $validation->getError('incident_type_id'),
					"title" => $validation->getError('title'),
					"incident_date" => $validation->getError('incident_date'),
					"incident_time" => $validation->getError('incident_time'),
					"incident_description" => $validation->getError('incident_description'),
					//"award_picture" => $validation->getError('award_picture')
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				// upload file
				 $validated = $this->validate([
					'incident_file' => [
						'rules'  => 'uploaded[incident_file]|ext_in[incident_file,jpg,jpeg,png,pdf,doc,docx]|max_size[incident_file,10240]',
						'errors' => [
							'uploaded' => lang('Main.xin_error_field_text'),
							'mime_in' => lang('Main.xin_invalid_file_format')
						]
					]
				]);
				if ($validated) {
					$attachment = $this->request->getFile('incident_file');
					$file_name = $attachment->getName();
					$file_name = $attachment->getRandomName();
					$attachment->move('public/uploads/incidents/',$file_name);
				}

				$incident_time = $this->request->getPost('incident_time',FILTER_SANITIZE_STRING);
				if(preg_match("/((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))/", $incident_time) == false ) {
					$Return['error'] = "Invalid Time";
					if($Return['error']!=''){
					$this->output($Return);
					}
				}
				
				$incident_type_id = $this->request->getPost('incident_type_id',FILTER_SANITIZE_STRING);
				$title = $this->request->getPost('title',FILTER_SANITIZE_STRING);
				$incident_date = $this->request->getPost('incident_date',FILTER_SANITIZE_STRING);
				$incident_time = date("H:i", strtotime($incident_time));
				$incident_description = $this->request->getPost('incident_description',FILTER_SANITIZE_STRING);
				
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				
				if ($validated) {
					$data = [
						'incident_type_id'  => $incident_type_id,
						'title'  => $title,
						'incident_date'  => $incident_date,
						'incident_time'  => $incident_time,
						'description'  => $incident_description,
						'incident_file'  => $file_name
					];
				} else {
					$data = [
						'incident_type_id'  => $incident_type_id,
						'title'  => $title,
						'incident_date'  => $incident_date,
						'incident_time'  => $incident_time,
						'description'  => $incident_description
					];
				}
				$IncidentsModel = new IncidentsModel();
				$result = $IncidentsModel->update($id,$data);	
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Success.xin_incident_updated_success');
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
	public function incidents_list() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		$IncidentsModel = new IncidentsModel();
		$ConstantsModel = new ConstantsModel();
		$xin_system = erp_company_settings();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$get_data = $IncidentsModel->where('employee_id',$user_info['user_id'])->orderBy('incident_id', 'ASC')->findAll();
		} else {
			$get_data = $IncidentsModel->where('company_id',$usession['sup_user_id'])->orderBy('incident_id', 'ASC')->findAll();
		}
		$data = array();
		
          foreach($get_data as $r) {						
		  			
				if(in_array('incident4',staff_role_resource()) || $user_info['user_type'] == 'company') { //delete
					$delete = '<span data-toggle="tooltip" data-placement="top" data-state="danger" title="'.lang('Main.xin_delete').'"><button type="button" class="btn icon-btn btn-sm btn-light-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. uencode($r['incident_id']) . '"><i class="feather icon-trash-2"></i></button></span>';
				} else {
					$delete = '';
				}
				if(in_array('incident3',staff_role_resource()) || $user_info['user_type'] == 'company') { //edit
					$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. uencode($r['incident_id']) . '"><i class="feather icon-edit"></i></button></span>';
				} else {
					$edit = '';
				}
				/*} else {
					$delete = '';
				}
				$view = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_view_details').'"><a href="'.site_url().'erp/award-view/'.uencode($r['incident_id']).'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light"><span class="fa fa-arrow-circle-right"></span></button></a></span>';*/
			$incident_date = set_date_format($r['incident_date']);
			// user info
			$iuser_info = $UsersModel->where('user_id', $r['employee_id'])->first();
			if($iuser_info){
				$user_detail = $iuser_info['first_name'].' '.$iuser_info['last_name'];
			} else {
				$user_detail = '--';
			}
			// award type
			$category_info = $ConstantsModel->where('constants_id', $r['incident_type_id'])->where('type','incident_type')->first();
			$combhr = $edit.$delete;
			// category_name
			if($category_info){
				$cname = $category_info['category_name'];
			} else {
				$cname = '--';
			}
			//
			if($r['status'] == 0){
				$app_status = '<span class="badge badge-light-warning">'.lang('Main.xin_pending').'</span>';
			} else if($r['status'] == 1){
				$app_status = '<span class="badge badge-light-success">'.lang('Main.xin_accepted').'</span>';
			} else if($r['status'] == 2){
				$app_status = '<span class="badge badge-light-danger">'.lang('Main.xin_rejected').'</span>';
			}
			$incident_time = $r['incident_time'].'<br>'.$app_status;
			if(in_array('incident3',staff_role_resource()) || in_array('incident4',staff_role_resource()) || $user_info['user_type'] == 'company') {
			$icname = '
				'.$cname.'
				<div class="overlay-edit">
					'.$combhr.'
				</div>';
			} else {
				$icname = $cname;
			}
			$data[] = array(
				$icname,
				$user_detail,
				$r['title'],
				$incident_date,
				$incident_time,
			);
			
		}
          $output = array(
               //"draw" => $draw,
			   "data" => $data
            );
          echo json_encode($output);
          exit();
     }
	// |||update record|||
	public function update_status_record() {
			
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
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
				} else {
					$company_id = $usession['sup_user_id'];
				}
				$IncidentsModel = new IncidentsModel();
				$StaffapprovalsModel = new StaffapprovalsModel();
				// get approvals
				$skip_specific = skip_specific_approval_info('incident_settings');
				$iskip_specific = $skip_specific['skip_specific_approval'];
				if($iskip_specific == 1){
					$level_option = staff_reporting_manager_info($usession['sup_user_id'],'incident_settings');
					$total_levels = $level_option['total_levels'];
				} else {
					$result = $IncidentsModel->where('incident_id', $id)->first();
					$old_level = staff_reporting_manager_old_level($result['employee_id'],'incident_settings');
					$total_levels = $old_level['total_levels'];
				}
				
				// check approvals
				$approval_cnt = $StaffapprovalsModel->where('company_id', $company_id)->where('module_key_id', $id)->where('module_option', 'incident_settings')->countAllResults();
				$iapproval_cnt = $approval_cnt+1;
				/*$Return['error'] = $iapproval_cnt.'.....'.$total_levels;
				if($Return['error']!=''){
					$this->output($Return);
				}*/
				if($user_info['user_type'] == 'company'){
					$data = [
						'status'  => $status,
					];
					$IncidentsModel = new IncidentsModel();
					$result = $IncidentsModel->update($id,$data);
				} else {
					if($iapproval_cnt == $total_levels){	
						$data2 = [
							'company_id'  => $company_id,
							'staff_id'  => $usession['sup_user_id'],
							'module_key_id'  => $id,
							'module_option'  => 'incident_settings',
							'status'  => $status,
							'approval_level'  => 1,
							'updated_at' => date('d-m-Y h:i:s')
						];
						$StaffapprovalsModel->insert($data2);
						$data = [
							'status'  => $status,
						];
						$IncidentsModel = new IncidentsModel();
						$result = $IncidentsModel->update($id,$data);
					} else {
						if($iapproval_cnt < $total_levels){
							if($status == 2) {
								$data = [
									'status'  => $status,
								];
								$IncidentsModel = new IncidentsModel();
								$IncidentsModel->update($id,$data);
									$data2 = [
									'company_id'  => $company_id,
									'staff_id'  => $usession['sup_user_id'],
									'module_key_id'  => $id,
									'module_option'  => 'incident_settings',
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
									'module_option'  => 'incident_settings',
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
					$Return['result'] = lang('Main.xin_updated_status');
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
	public function read_incident()
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
			return view('erp/incidents/dialog_incident', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// delete record
	public function delete_incident() {
		
		if($this->request->getPost('type')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$id = udecode($this->request->getPost('_token',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$IncidentsModel = new IncidentsModel();
			$result = $IncidentsModel->where('incident_id', $id)->delete($id);
			if ($result == TRUE) {
				$Return['result'] = lang('Success.xin_incident_deleted_success');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}
}
