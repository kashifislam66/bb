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
use App\Models\PollsModel;
use App\Models\PollsvotesModel;
use App\Models\PollsQuestions;

class Polls extends BaseController {

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
		$data['title'] = lang('Main.xin_polls').' | '.$xin_system['application_name'];
		$data['path_url'] = 'polls';
		$data['breadcrumbs'] = lang('Main.xin_polls');

		$data['subview'] = view('erp/polls/polls', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function poll_view()
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
		$data['title'] = lang('Main.xin_poll_view').' | '.$xin_system['application_name'];
		$data['path_url'] = 'polls';
		$data['breadcrumbs'] = lang('Main.xin_poll_view');

		$data['subview'] = view('erp/polls/poll_view', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	// record list
	public function polls_list() {

		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}		
		$RolesModel = new RolesModel();
		$UsersModel = new UsersModel();
		$SystemModel = new SystemModel();
		//$AssetsModel = new AssetsModel();
		$PollsModel = new PollsModel();
		$PollsQuestions = new PollsQuestions();

		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$get_data = $PollsModel->where('company_id',$user_info['company_id'])->orderBy('poll_id', 'ASC')->findAll();
		} else {
			$get_data = $PollsModel->where('company_id',$usession['sup_user_id'])->orderBy('poll_id', 'ASC')->findAll();
		}
		$data = array();
		
          foreach($get_data as $r) {
			  
			if($user_info['user_type'] == 'company') { //edit
				$edit = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_edit').'"><button type="button" class="btn icon-btn btn-sm btn-light-primary waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. uencode($r['poll_id']) . '"><i class="feather icon-edit"></i></button></span>';
			} else {
				$edit = '';
			}
			if($user_info['user_type'] == 'company') { //delete
				$delete = '<span data-toggle="tooltip" data-placement="top" data-state="danger" title="'.lang('Main.xin_delete').'"><button type="button" class="btn icon-btn btn-sm btn-light-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. uencode($r['poll_id']) . '"><i class="feather icon-trash-2"></i></button></span>';
			} else {
				$delete = '';
			}
			$view = '<span data-toggle="tooltip" data-placement="top" data-state="primary" title="'.lang('Main.xin_view_details').'"><a href="'.site_url().'erp/poll-view/'.uencode($r['poll_id']).'"><button type="button" class="btn icon-btn btn-sm btn-light-info waves-effect waves-light"><span class="fa fa-arrow-circle-right"></span></button></a></span>';
			// added by
			$added_by = $UsersModel->where('user_id', $r['added_by'])->first();
			// $question = $PollsQuestions->where('poll_ref_id',$r['poll_id'])->first();
			if($added_by){
				$iadded_by = $added_by['first_name'].' '.$added_by['last_name'];
			} else {
				$iadded_by = '--';
			}
			// status
			if($r['is_active']==1){
				$is_active = lang('Main.xin_employees_active');
			} else {
				$is_active = lang('Main.xin_employees_inactive');
			}
			$poll_start_date = set_date_format($r['poll_start_date']);
			$poll_end_date = set_date_format($r['poll_end_date']);
			$created_at = set_date_format($r['created_at']);
		//	$full_name = 'mmmm';//
			$combhr = $view.$edit.$delete;
			$poll_question = '
			'.$r['poll_title'].'
			<div class="overlay-edit">
				'.$combhr.'
			</div>';
			$data[] = array(
				$poll_question,
				$poll_start_date,
				$poll_end_date,
				$is_active,
				$created_at
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
	public function add_poll() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		// print_r($_POST); die();
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'poll_question.*' => [
					'rules'  => 'trim|required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				
				'poll_start_date' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'poll_end_date' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'poll_title' => [
					'rules'  => 'trim|required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'poll_answer1.*' => [
					'rules'  => 'trim|required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'poll_answer2.*' => [
					'rules'  => 'trim|required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
				
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
					"poll_question" => $validation->getError('poll_question.*'),
                    "poll_title" => $validation->getError('poll_title'),
					"poll_start_date" => $validation->getError('poll_start_date'),
					"poll_end_date" => $validation->getError('poll_end_date'),
					"poll_answer1" => $validation->getError('poll_answer1.*'),
					"poll_answer2" => $validation->getError('poll_answer2.*'),
					
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$poll_title = $this->request->getPost('poll_title',FILTER_SANITIZE_STRING);
				$poll_question = $this->request->getPost('poll_question',FILTER_SANITIZE_STRING);
				$poll_start_date = $this->request->getPost('poll_start_date',FILTER_SANITIZE_STRING);
				$poll_end_date = $this->request->getPost('poll_end_date',FILTER_SANITIZE_STRING);
				$poll_answer1 = $this->request->getPost('poll_answer1',FILTER_SANITIZE_STRING);
				$poll_answer2 = $this->request->getPost('poll_answer2',FILTER_SANITIZE_STRING);
				$poll_answer3 = $this->request->getPost('poll_answer3',FILTER_SANITIZE_STRING);
				$poll_answer4 = $this->request->getPost('poll_answer4',FILTER_SANITIZE_STRING);
				$poll_answer5 = $this->request->getPost('poll_answer5',FILTER_SANITIZE_STRING);
				$notes = $this->request->getPost('notes',FILTER_SANITIZE_STRING);
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
				} else {
					$company_id = $usession['sup_user_id'];
				}
			
				$data = [
					'company_id'  => $company_id,
					'poll_start_date'  => $poll_start_date,
					'poll_end_date'  => $poll_end_date,
					'is_active'  => 1,
					'poll_title' => $poll_title,
					'added_by'  => $usession['sup_user_id'],
					'created_at' => date('d-m-Y h:i:s')
				];
				$PollsModel = new PollsModel();
				$PollsQuestions = new PollsQuestions();
				$result = $PollsModel->insert($data);
				if($result != "") {
			
					foreach($poll_question as $key => $question) {
						$temp = [
							'poll_ref_id' => $result,
							'company_id'  => $company_id,
							'poll_question' => $question,
							'poll_answer1' => $poll_answer1[$key],
							'poll_answer2' => $poll_answer2[$key],
							'poll_answer3' => isset($poll_answer3[$key]) ? $poll_answer3[$key] : '',
							'poll_answer4' =>  isset($poll_answer4[$key]) ? $poll_answer4[$key] : '',
							'poll_answer5' =>  isset($poll_answer5[$key]) ? $poll_answer5[$key] : '',
							'notes' =>  isset($notes[$key]) ? $notes[$key] : '',
						];
						
						$result = $PollsQuestions->insert($temp);
					
					}
				}
				

				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_poll_created_success');
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
	public function update_poll() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'edit_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'poll_question.*' => [
					'rules'  => 'trim|required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				
				'poll_start_date' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'poll_end_date' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'poll_title' => [
					'rules'  => 'trim|required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'poll_answer1.*' => [
					'rules'  => 'trim|required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
				'poll_answer2.*' => [
					'rules'  => 'trim|required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				]
				
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
					"poll_question" => $validation->getError('poll_question.*'),
                    "poll_title" => $validation->getError('poll_title'),
					"poll_start_date" => $validation->getError('poll_start_date'),
					"poll_end_date" => $validation->getError('poll_end_date'),
					"poll_answer1" => $validation->getError('poll_answer1.*'),
					"poll_answer2" => $validation->getError('poll_answer2.*'),
					
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			}else {
				$poll_title = $this->request->getPost('poll_title',FILTER_SANITIZE_STRING);
				$poll_question = $this->request->getPost('poll_question',FILTER_SANITIZE_STRING);
				$poll_start_date = $this->request->getPost('poll_start_date',FILTER_SANITIZE_STRING);
				$poll_end_date = $this->request->getPost('poll_end_date',FILTER_SANITIZE_STRING);
				$poll_answer1 = $this->request->getPost('poll_answer1',FILTER_SANITIZE_STRING);
				$poll_answer2 = $this->request->getPost('poll_answer2',FILTER_SANITIZE_STRING);
				$poll_answer3 = $this->request->getPost('poll_answer3',FILTER_SANITIZE_STRING);
				$poll_answer4 = $this->request->getPost('poll_answer4',FILTER_SANITIZE_STRING);
				$poll_answer5 = $this->request->getPost('poll_answer5',FILTER_SANITIZE_STRING);
				$notes = $this->request->getPost('notes',FILTER_SANITIZE_STRING);
				$is_active = $this->request->getPost('is_active',FILTER_SANITIZE_STRING);
				
				$id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
				} else {
					$company_id = $usession['sup_user_id'];
				}
				$data = [
					'poll_title' => $poll_title,
					'poll_start_date'  => $poll_start_date,
					'poll_end_date'  => $poll_end_date,
					'is_active'  => $is_active,
				];
				$PollsModel = new PollsModel();
				// $result = $PollsModel->update($id,$data);	
			
				$PollsQuestions = new PollsQuestions();

				foreach($poll_question as $key => $question) {
					$result = $PollsQuestions->where('id', $key)->first();
					if($result !="") {
						$temp = [
							'poll_ref_id' => $id,
							'poll_question' => $question,
							'poll_answer1' => $poll_answer1[$key],
							'poll_answer2' => $poll_answer2[$key],
							'poll_answer3' => isset($poll_answer3[$key]) ? $poll_answer3[$key] : '',
							'poll_answer4' =>  isset($poll_answer4[$key]) ? $poll_answer4[$key] : '',
							'poll_answer5' =>  isset($poll_answer5[$key]) ? $poll_answer5[$key] : '',
							'notes' =>  isset($notes[$key]) ? $notes[$key] : '',
						];
						$result = $PollsQuestions->update($key,$temp);

					} else {
						$temp = [
							'poll_ref_id' => $id,
							'poll_question' => $question,
							'company_id'  => $company_id,
							'poll_answer1' => $poll_answer1[$key],
							'poll_answer2' => $poll_answer2[$key],
							'poll_answer3' => isset($poll_answer3[$key]) ? $poll_answer3[$key] : '',
							'poll_answer4' =>  isset($poll_answer4[$key]) ? $poll_answer4[$key] : '',
							'poll_answer5' =>  isset($poll_answer5[$key]) ? $poll_answer5[$key] : '',
							'notes' =>  isset($notes[$key]) ? $notes[$key] : '',
						];
							$result = $PollsQuestions->insert($temp);
					}
				}

				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_poll_updated_success');
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
	public function update_vote() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');	
		if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			$rules = [
				'poll_answer.*' => [
					'rules'  => 'required',
					'errors' => [
						'required' => lang('Main.xin_error_field_text')
					]
				],
			];
			if(!$this->validate($rules)){
				$ruleErrors = [
                    "poll_answer" => $validation->getError('poll_answer.*'),
                ];
				foreach($ruleErrors as $err){
					$Return['error'] = $err;
					if($Return['error']!=''){
						$this->output($Return);
					}
				}
			} else {
				$poll_answer = $this->request->getPost('poll_answer',FILTER_SANITIZE_STRING);				
				$poll_id = udecode($this->request->getPost('token',FILTER_SANITIZE_STRING));
				
				 
				$UsersModel = new UsersModel();
				$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
				if($user_info['user_type'] == 'staff'){
					$company_id = $user_info['company_id'];
				} else {
					$company_id = $usession['sup_user_id'];
				}
				foreach($poll_answer as $key => $value) {
					$data = [
						'company_id' => $company_id,
						'poll_id'  => $poll_id,
						'poll_answer'  => $value,
						'poll_question_id' => $key,
						'user_id'  => $usession['sup_user_id'],
						'created_at' => date('d-m-Y h:i:s')
					];

					$PollsvotesModel = new PollsvotesModel();
					$result = $PollsvotesModel->insert($data);
				}
				$Return['csrf_hash'] = csrf_hash();	
				if ($result == TRUE) {
					$Return['result'] = lang('Main.xin_vote_added');
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
	public function read_poll()
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
			return view('erp/polls/dialog_poll', $data);
		} else {
			return redirect()->to(site_url('erp/login'));
		}
	}
	// delete record
	public function delete_poll() {
		
		if($this->request->getPost('type')=='delete_record') {
			/* Define return | here result is used to return user data and error for error message */
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$session = \Config\Services::session();
			$request = \Config\Services::request();
			$usession = $session->get('sup_username');
			$id = udecode($this->request->getPost('_token',FILTER_SANITIZE_STRING));
			$Return['csrf_hash'] = csrf_hash();
			$PollsModel = new PollsModel();
			$result = $PollsModel->where('poll_id', $id)->delete($id);
			if ($result == TRUE) {
				$Return['result'] = lang('Main.xin_poll_deleted_success');
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
		}
	}

	public function get_user_poll() {
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$PollsvotesModel = new PollsvotesModel();
		$PollsQuestions = new PollsQuestions();
		$poll_id = $request->getGet('poll_id');
		$user = $request->getGet('user');
		$poll_question = $PollsQuestions->where('poll_ref_id',$poll_id)->findAll();
		
		// print_r($poll_votes); die();
		$html = '';
		foreach($poll_question as $questions) {
			$poll_votes = $PollsvotesModel->where('user_id',$user)->where('poll_id',$poll_id)->where('poll_question_id',$questions['id'])->first();
			$html .= "<div class='card-header' style='padding: 13px 0px;
			margin-bottom: 14px;
			border-bottom: 2px solid #dadce0;'><h5> ".$questions['poll_question']."</h5></div>
				<div class='to-do-list mb-3'>
					<div class='custom-control custom-radio'>
						<input type='radio' ". ($poll_votes['poll_answer'] == 1 ? "checked" :  '') ." name='poll_answer[".$questions['id']."]' class='custom-control-input input-light-primary' id='poll_answer1' value='1'>
						<label class='custom-control-label' for='poll_answer1'> ".$questions['poll_answer1']." </label>
					</div>
				</div>
				<div class='to-do-list mb-3'>
					<div class='custom-control custom-radio'>
						<input type='radio' ".($poll_votes['poll_answer'] == 2 ? "checked" :  '') ." name='poll_answer[". $questions['id']."]'
							class='custom-control-input input-light-primary' id='poll_answer2' value='2'>
						<label class='custom-control-label' for='poll_answer2'>
							" .$questions['poll_answer2'] ."
						</label>
					</div>
				</div>";
				 if($questions['poll_answer3']!=''){
			$html .=	"<div class='to-do-list mb-3'>
					<div class='custom-control custom-radio'>
						<input type='radio' ".($poll_votes['poll_answer'] == 3 ? "checked" :  '') ." name='poll_answer[". $questions['id'] ."]'
							class='custom-control-input input-light-primary' id='poll_answer3' value='3'>
						<label class='custom-control-label' for='poll_answer3'>
							". $questions['poll_answer3']. "
						</label>
					</div>
				</div>";
				 } 
				 if($questions['poll_answer4']!=''){ 
			$html .=	"<div class='to-do-list mb-3'>
					<div class='custom-control custom-radio'>
						<input type='radio' ".($poll_votes['poll_answer'] == 4 ? "checked" :  '') ." name='poll_answer[". $questions['id'] ."]'
							class='custom-control-input input-light-primary' id='poll_answer4' value='4'>
						<label class='custom-control-label' for='poll_answer4'>
							". $questions['poll_answer4'] ."
						</label>
					</div>
				</div>";
				 } 
			if($questions['poll_answer5']!=''){ 
			$html .=	"<div class='to-do-list mb-3'>
					<div class='custom-control custom-radio'>
						<input type='radio' ".($poll_votes['poll_answer'] == 5 ? "checked" :  '') ." name='poll_answer[". $questions['id'] ."]'
							class='custom-control-input input-light-primary' id='poll_answer5' value='5'>
						<label class='custom-control-label' for='poll_answer5'>
							". $questions['poll_answer5'] ."
						</label>
					</div>
				</div>";
				 } 
			
		}
		if (!empty($poll_question)) {
			$Return['result'] = $html;
		} else {
			$Return['error'] = lang('Main.xin_error_msg');
		}
		// $Return['csrf_hash'] = $this->security->get_csrf_hash();
			$Return['csrf_hash'] = csrf_hash();
			$this->output($Return);
			exit;
	}

	public function get_question() {
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$PollsvotesModel = new PollsvotesModel();
		$PollsQuestions = new PollsQuestions();
		$UsersModel = new UsersModel();
		$poll_id = $request->getGet('poll_id');
		$question = $request->getGet('question');
		$questions = $PollsQuestions->where('id',$question)->first();
		// print_r($poll_votes); die();
		$html = '';
		
			
			$html .= "<div class='card-header' style='padding: 13px 0px;
			margin-bottom: 14px;
			border-bottom: 2px solid #dadce0;'><h5> ".$questions['poll_question']."</h5></div>
				<div class='main_div'><div class='to-do-list mb-3'>
					<div class='custom-control custom-radio'>
						<input type='radio' checked   class='custom-control-input input-light-primary' id='poll_answer1' value='1'>
						<label class='custom-control-label' for='poll_answer1'> ".$questions['poll_answer1']." </label>
					</div>
				</div>";
				$poll_votes_result = $PollsvotesModel->where('poll_question_id',$question)->where('poll_id',$poll_id)->where('poll_answer',1)->findAll();

				$poll_votes = $PollsvotesModel->where('poll_question_id',$question)->where('poll_id',$poll_id)->where('poll_answer',1)->countAllResults();
				$iadded = '';
				if($poll_votes > 0) { 
		
					
					foreach($poll_votes_result as $votes_user) {
						$added_by = $UsersModel->where('user_id', $votes_user['user_id'])->first();
						if($added_by){ 
							$iadded_by = $added_by['first_name'].' '.$added_by['last_name'];
							
							$iadded .=	'<li>'. $iadded_by .'</li>';
						 } 
					}
				}
				
				$html .= "<div class='response_1'> ".$poll_votes ." responses</div><div class ='hide_1'><ul>".$iadded."</ul> </div></div>";
				$html .="<div class='main_div'><div class='to-do-list mb-3'>
					<div class='custom-control custom-radio'>
						<input type='radio' checked  
							class='custom-control-input input-light-primary' id='poll_answer2' value='2'>
						<label class='custom-control-label' for='poll_answer2'>
							" .$questions['poll_answer2'] ."
						</label>
					</div>
				</div>";
				$poll_votes_result = $PollsvotesModel->where('poll_question_id',$question)->where('poll_id',$poll_id)->where('poll_answer',2)->findAll();
				$poll_votes = $PollsvotesModel->where('poll_question_id',$question)->where('poll_id',$poll_id)->where('poll_answer',2)->countAllResults();
				$iadded2 = '';
				if($poll_votes > 0) { 
		
					
					foreach($poll_votes_result as $votes_user) {
						$added_by = $UsersModel->where('user_id', $votes_user['user_id'])->first();
						if($added_by){ 
							$iadded_by = $added_by['first_name'].' '.$added_by['last_name'];
							
							$iadded2 .=	'<li>'. $iadded_by .'</li>';
						 } 
					}
				}
				$html .= "<div class='response_2'> ".$poll_votes ." responses</div><div class ='hide_2'><ul>".$iadded2."</ul> </div></div>";
				 if($questions['poll_answer3']!=''){
			$html .=	"<div class='main_div'><div class='to-do-list mb-3'>
					<div class='custom-control custom-radio'>
						<input type='radio' checked  
							class='custom-control-input input-light-primary' id='poll_answer3' value='3'>
						<label class='custom-control-label' for='poll_answer3'>
							". $questions['poll_answer3']. "
						</label>
					</div>
				</div>";
				$poll_votes = $PollsvotesModel->where('poll_question_id',$question)->where('poll_id',$poll_id)->where('poll_answer',3)->countAllResults();
				$poll_votes_result = $PollsvotesModel->where('poll_question_id',$question)->where('poll_id',$poll_id)->where('poll_answer',3)->findAll();
				$iadded3 = '';
				if($poll_votes > 0) { 
		
					
					foreach($poll_votes_result as $votes_user) {
						$added_by = $UsersModel->where('user_id', $votes_user['user_id'])->first();
						if($added_by){ 
							$iadded_by = $added_by['first_name'].' '.$added_by['last_name'];
							
							$iadded3 .=	'<li>'. $iadded_by .'</li>';
						 } 
					}
				}
				$html .= "<div class='response_3'> ".$poll_votes ." responses</div><div class ='hide_3'><ul>".$iadded3."</ul> </div></div>";
				 } 
				 if($questions['poll_answer4']!=''){ 
			$html .=	"<div class='main_div'><div class='to-do-list mb-3'>
					<div class='custom-control custom-radio'>
						<input type='radio' checked  
							class='custom-control-input input-light-primary' id='poll_answer4' value='4'>
						<label class='custom-control-label' for='poll_answer4'>
							". $questions['poll_answer4'] ."
						</label>
					</div>
				</div>";
				$poll_votes = $PollsvotesModel->where('poll_question_id',$question)->where('poll_id',$poll_id)->where('poll_answer',4)->countAllResults();
				$poll_votes_result = $PollsvotesModel->where('poll_question_id',$question)->where('poll_id',$poll_id)->where('poll_answer',4)->findAll();
				$iadded4 = '';
				if($poll_votes > 0) { 
		
					
					foreach($poll_votes_result as $votes_user) {
						$added_by = $UsersModel->where('user_id', $votes_user['user_id'])->first();
						if($added_by){ 
							$iadded_by = $added_by['first_name'].' '.$added_by['last_name'];
							
							$iadded4 .=	'<li>'. $iadded_by .'</li>';
						 } 
					}
				}
				$html .= "<div class='response_4'> ".$poll_votes ." responses</div><div class ='hide_4'><ul>".$iadded4."</ul> </div></div>";
				 } 
			if($questions['poll_answer5']!=''){ 
			$html .=	"<div class='main_div'><div class='to-do-list mb-3'>
					<div class='custom-control custom-radio'>
						<input type='radio' checked  
							class='custom-control-input input-light-primary' id='poll_answer5' value='5'>
						<label class='custom-control-label' for='poll_answer5'>
							". $questions['poll_answer5'] ."
						</label>
					</div>
				</div>";
				$poll_votes = $PollsvotesModel->where('poll_question_id',$question)->where('poll_id',$poll_id)->where('poll_answer',5)->countAllResults();
				$poll_votes_result = $PollsvotesModel->where('poll_question_id',$question)->where('poll_id',$poll_id)->where('poll_answer',5)->findAll();
				$iadded5 = '';
				if($poll_votes > 0) { 
		
					
					foreach($poll_votes_result as $votes_user) {
						$added_by = $UsersModel->where('user_id', $votes_user['user_id'])->first();
						if($added_by){ 
							$iadded_by = $added_by['first_name'].' '.$added_by['last_name'];
							
							$iadded5 .=	'<li>'. $iadded_by .'</li>';
						 } 
					}
				}
				$html .= "<div class='response_5'> ".$poll_votes ." responses</div><div class ='hide_5'><ul>".$iadded5."</ul> </div></div>";
				 } 
			
		
		if (!empty($questions)) {
			$Return['result'] = $html;
		} else {
			$Return['error'] = lang('Main.xin_error_msg');
		}
		// $Return['csrf_hash'] = $this->security->get_csrf_hash();
			$Return['csrf_hash'] = csrf_hash();
			$this->output($Return);
			exit;
	}
}
