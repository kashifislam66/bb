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

use App\Models\MainModel;
use App\Models\ChatModel; 
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;


class Chat extends BaseController {

	public function chat_index() {		
		
		$session = \Config\Services::session();
		$SystemModel = new SystemModel();
		$UsersModel = new UsersModel();
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_chat_messenger').' | '.$xin_system['application_name'];
		$data['path_url'] = 'chat_index';
		$data['breadcrumbs'] = lang('Main.xin_chat_messenger');
		$data['subview'] = view('erp/chat/chat_messenger', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	public function user_inbox() {		
		
		$session = \Config\Services::session();
		$SystemModel = new SystemModel();
		$UsersModel = new UsersModel();
		$usession = $session->get('sup_username');
		$xin_system = $SystemModel->where('setting_id', 1)->first();
		$data['title'] = lang('Main.xin_chat_messenger').' | '.$xin_system['application_name'];
		$data['path_url'] = 'chat_box';
		$data['breadcrumbs'] = lang('Main.xin_chat_messenger');
		$data['subview'] = view('erp/chat/user_inbox', $data);
		return view('erp/layout/layout_main', $data); //page load
	}
	
	public function send_chat() {
			
		$validation =  \Config\Services::validation();
		$session = \Config\Services::session();
		$usession = $session->get('sup_username');
		$request = \Config\Services::request();	
		//if ($this->request->getPost('type') === 'add_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = csrf_hash();
			// set rules
			
			$message_content = $this->request->getPost('message_content',FILTER_SANITIZE_STRING);
			$from_id = udecode($this->request->getPost('from_id',FILTER_SANITIZE_STRING));
			$to_id = udecode($this->request->getPost('to_id',FILTER_SANITIZE_STRING));
			$message_from = udecode($this->request->getPost('message_from',FILTER_SANITIZE_STRING));
			$qt_message = htmlspecialchars(addslashes($message_content), ENT_QUOTES);
			if($message_content==='') {
				$Return['error'] = lang('Main.xin_chat_message_field_error');
			}
			if($Return['error']!=''){
				$this->output($Return);
			}
			
			$UsersModel = new UsersModel();
			$ChatModel = new ChatModel();
			$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
			if($user_info['user_type'] == 'staff'){
				$company_id = $user_info['company_id'];
			} else {
				$company_id = $usession['sup_user_id'];
			}
			$data = array(
				'company_id' => $company_id,
				'from_id' => $from_id,
				'to_id' => $to_id,
				'message_frm' => $message_from,
				'message_content' => $qt_message,
				'is_read' => 0,
				'recd' => 0,
				'message_type' => 'single_chat',
				'message_date' => date('Y-m-d H:i:s'),
			);
			$result = $ChatModel->insert($data);	
			$Return['csrf_hash'] = csrf_hash();	
			if ($result == TRUE) {
				$Return['result'] = '';
			} else {
				$Return['error'] = lang('Main.xin_error_msg');
			}
			$this->output($Return);
			exit;
		//}
	} 
	// get chat box:ajax
	public function refresh_chatbox() {
		
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		$fid = udecode($request->uri->getSegment(4));
		$tid = udecode($request->uri->getSegment(5));
		$UsersModel = new UsersModel();
		$ChatModel = new ChatModel();
		$MainModel = new MainModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// staff chat msgs
		$chat_msgs = $ChatModel->where('company_id', $company_id)->findAll();
		foreach($chat_msgs as $_msgs) {
			if(($tid==$_msgs['to_id'] && $_msgs['from_id']==$fid) || ($fid==$_msgs['to_id'] && $_msgs['from_id']==$tid)) {
				if($usession['sup_user_id']!=$_msgs['from_id']){
					//get user info
					$get_main_user = $UsersModel->where('user_id', $_msgs['from_id'])->first();
					// update status
					$data = array(
						'is_read' => 1,
					);
					$MainModel->update_chat_status($data,$_msgs['from_id'],$usession['sup_user_id']);
					echo '<div class="message info">
						<img alt="1" class="img-circle medium-image" src="'.staff_profile_photo($get_main_user['user_id']).'">
						<div class="message-body">
							<div class="message-info">
								<h4> '.$get_main_user['first_name'].' '.$get_main_user['last_name'].' </h4>
								<h5> <i class="fa fa-clock-o"></i> '.date("M j, g:i A",strtotime($_msgs['message_date'])).' </h5>
							</div>
							<hr>
							<div class="message-text">
								'.$_msgs['message_content'].'
							</div>
						</div>
						<br>
					</div>';
				} else {
					//get user info
					$get_main_user = $UsersModel->where('user_id', $_msgs['from_id'])->first();
					echo '<div class="message my-message">
						<img alt="" class="img-circle medium-image" src="'.staff_profile_photo($get_main_user['user_id']).'">
						<div class="message-body">
							<div class="message-body-inner">
								<div class="message-info">
									<h4> '.lang('Main.xin_chat_messenger_me').' </h4>
									<h5> <i class="fa fa-clock-o"></i> '.date("M j, g:i A",strtotime($_msgs['message_date'])).' </h5>
								</div>
								<hr>
								<div class="message-text">
									'.$_msgs['message_content'].'
								</div>
							</div>
						</div>
						<br>
					</div>';
				}
			}
		}
	}
	// get chat users:ajax
	public function refresh_chat_users() {
		
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		$UsersModel = new UsersModel();
		$ChatModel = new ChatModel();
		$tid = udecode($request->uri->getSegment(4));
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
			$chat_main_user = $UsersModel->where('user_id', $user_info['company_id'])->first();
		} else {
			$company_id = $usession['sup_user_id'];
			$chat_main_user = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		}
		// staff chat users
		$chat_users = $UsersModel->where('company_id', $company_id)->where('user_type', 'staff')->findAll();
		if($chat_main_user['user_id']!=$usession['sup_user_id']):
        echo '<a href="'.site_url('erp/inbox/').uencode($chat_main_user['user_id']).'">';
        $mchat_msgs_count = $ChatModel->where('company_id', $company_id)->where('from_id', $chat_main_user['user_id'])->where('to_id', $usession['sup_user_id'])->where('is_read',0)->countAllResults();
		$exchat_msgs_count = $ChatModel->where('company_id', $company_id)->where('from_id', $chat_main_user['user_id'])->where('to_id', $usession['sup_user_id'])->orderBy('message_id','DESC')->countAllResults();
		if($exchat_msgs_count > 0){
			$exchat_msgs = $ChatModel->where('company_id', $company_id)->where('from_id', $chat_main_user['user_id'])->where('to_id', $usession['sup_user_id'])->orderBy('message_id','DESC')->first();
			$msg_time = chat_time_ago($exchat_msgs['message_date']);
			$message_content = $exchat_msgs['message_content'];
		} else {
			$msg_time = '';
			$message_content = lang('Main.xin_no_message');
		}
		if($mchat_msgs_count > 0){
			$mrchat_msgs_count = '<div class="message-count"> '.$mchat_msgs_count.'</div>';
		} else {
			$mrchat_msgs_count = '';
		}
        echo '<li class="company-head">
            '.$mrchat_msgs_count.'
            <img alt="" class="img-circle medium-image" src="'.staff_profile_photo($chat_main_user['user_id']).'">

            <div class="vcentered info-combo">
                <h3 class="no-margin-bottom name"><strong>'.lang('Main.xin_company_head').'</strong></h3>
                <h5> '.$chat_main_user['first_name'].' '.$chat_main_user['last_name'].' <br> '.$message_content.'</h5>
            </div>
            <div class="contacts-add">
                <span class="message-time"> '.$msg_time.'</span>
            </div>
        </li></a>';
        endif;
		foreach($chat_users as $_iuser){
			if($_iuser['user_id']!=$usession['sup_user_id']){
				$chat_msgs_count = $ChatModel->where('company_id', $company_id)->where('from_id', $_iuser['user_id'])->where('to_id', $usession['sup_user_id'])->where('is_read',0)->countAllResults();
				$exchat_msgs_count = $ChatModel->where('company_id', $company_id)->where('from_id', $_iuser['user_id'])->where('to_id', $usession['sup_user_id'])->orderBy('message_id','DESC')->countAllResults();
				if($exchat_msgs_count > 0){
					$exchat_msgs = $ChatModel->where('company_id', $company_id)->where('from_id', $_iuser['user_id'])->where('to_id', $usession['sup_user_id'])->orderBy('message_id','DESC')->first();
					$msg_time = chat_time_ago($exchat_msgs['message_date']);
					$message_content = $exchat_msgs['message_content'];
				} else {
					$msg_time = '';
					$message_content = lang('Main.xin_no_message');
				}
				if($chat_msgs_count > 0){
					$rchat_msgs_count = '<div class="message-count"> '.$chat_msgs_count.'</div>';
				} else {
					$rchat_msgs_count = '';
				}
				if($tid==$_iuser['user_id']):
					$active = 'active';
				else:
					$active = '';
				endif;
				echo '<a href="'.site_url('erp/inbox/').uencode($_iuser['user_id']).'">
				<li class="'.$active.'">
					'.$rchat_msgs_count.'
					<img alt="" class="img-circle medium-image" src="'.staff_profile_photo($_iuser['user_id']).'">
	
					<div class="vcentered info-combo">
						<h3 class="no-margin-bottom name"> '.$_iuser['first_name'].' '.$_iuser['last_name'].' </h3>
						<h5> '.$message_content.'</h5>
					</div>
					<div class="contacts-add">
						<span class="message-time"> '.$msg_time.'</span>
					</div>
				</li></a>';
			}
		}
	}
	// get chat count:ajax
	public function refresh_chat_count() {
		
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		$UsersModel = new UsersModel();
		$ChatModel = new ChatModel();
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
		} else {
			$company_id = $usession['sup_user_id'];
		}
		// staff chat users
		$hchat_msgs_count = $ChatModel->where('company_id', $company_id)->where('to_id', $usession['sup_user_id'])->where('is_read',0)->countAllResults();
		echo $hchat_msgs_count;
	}
	// get chat count notify:ajax
	public function refresh_chat_count_notify() {
		
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$usession = $session->get('sup_username');
		if(!$session->has('sup_username')){ 
			return redirect()->to(site_url('erp/login'));
		}
		$UsersModel = new UsersModel();
		$ChatModel = new ChatModel();
		$tid = $usession['sup_user_id'];
		$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		if($user_info['user_type'] == 'staff'){
			$company_id = $user_info['company_id'];
			$chat_main_user = $UsersModel->where('user_id', $user_info['company_id'])->first();
		} else {
			$company_id = $usession['sup_user_id'];
			$chat_main_user = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
		}
		// staff chat users
		$fhchat_msgs_count = $ChatModel->where('company_id', $company_id)->where('to_id', $usession['sup_user_id'])->where('is_read',0)->orderBy('message_id','DESC')->countAllResults();
		if($fhchat_msgs_count > 0){
			$fhchat_msgs_chat = $ChatModel->where('company_id', $company_id)->where('to_id', $usession['sup_user_id'])->where('is_read',0)->orderBy('message_id','DESC')->first();
			$imessage_date = $fhchat_msgs_chat['message_date'];
			//get user info
			$get_user = $UsersModel->where('user_id', $fhchat_msgs_chat['from_id'])->first();
			$full_name = $get_user['first_name'].' '.$get_user['last_name'];
			//message
			$message_content = $fhchat_msgs_chat['message_content'];
			// current date
			$current = strtotime(date("Y-m-d H:i:s"));
			$seconds = 9;
			$message_date = date("Y-m-d H:i:s", (strtotime(date($imessage_date)) + $seconds));
			$fmessage_date = strtotime($message_date);
			$fnotify_data = array('fcount' =>$fhchat_msgs_count,'current' =>$current,'fmessage_date' =>$fmessage_date,'full_name' =>$full_name,'message'=>$message_content,'to_user'=>uencode($fhchat_msgs_chat['from_id']));
		} else {
			$fnotify_data = array('fcount' =>0,'current' =>'no','fmessage_date' =>'no','full_name' =>'no','message' =>'no','to_user' =>'no');
		}
		$this->output($fnotify_data);
		exit;
	}
}
