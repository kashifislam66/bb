<?php
use App\Models\SystemModel;
use App\Models\UsersModel;
use App\Models\MainModel;
use App\Models\ChatModel;
use App\Models\LanguageModel;

$SystemModel = new SystemModel();
$UsersModel = new UsersModel();
$ChatModel = new ChatModel();
$MainModel = new MainModel();
$LanguageModel = new LanguageModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$router = service('router');
$locale = service('request')->getLocale();
$xin_com_system = erp_company_settings();

$xin_system = $SystemModel->where('setting_id', 1)->first();
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
// staff chat msgs
$chat_msgs = $ChatModel->where('company_id', $company_id)->findAll();
//
$segment_id = $request->uri->getSegment(3);
$to_id = udecode($segment_id);

$fid = $usession['sup_user_id'];
$tid = $to_id;

?>

<div class="panel messages-panel">
    <div class="contacts-list">
        <div class="inbox-categories">
            <div data-toggle="tab" data-target="#inbox" class="active"> <?= lang('Main.xin_chat_messenger_users');?> </div>
        </div>
        <div class="tab-content">
            <div id="inbox" class="contacts-outter-wrapper tab-pane active">
                <div class="contacts-outter">
                    <ul class="list-unstyled contacts chat-users">
                        <?php if($chat_main_user['user_id']!=$usession['sup_user_id']):?>
                        <a href="<?= site_url('erp/inbox/').uencode($chat_main_user['user_id']);?>">
                        <?php $mchat_msgs_count = $ChatModel->where('company_id', $company_id)->where('from_id', $chat_main_user['user_id'])->where('to_id', $usession['sup_user_id'])->where('is_read',0)->countAllResults();
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
                        ?>
                        <li class="company-head">
                            <?= $mrchat_msgs_count;?>
                            <img alt="" class="img-circle medium-image" src="<?= staff_profile_photo($chat_main_user['user_id']);?>">

                            <div class="vcentered info-combo">
                                <h3 class="no-margin-bottom name"> <strong><?= lang('Main.xin_company_head');?></strong> </h3>
                                <h5> <?= $chat_main_user['first_name'].' '.$chat_main_user['last_name'];?><br /> <?= $message_content;?></h5>
                            </div>
                            <div class="contacts-add">
                                <span class="message-time"> <?= $msg_time;?></span>
                            </div>
                        </li></a>
                        <?php endif;?>
                        <?php foreach($chat_users as $_iuser):?>
                        <?php if($_iuser['user_id']!=$usession['sup_user_id']):?>
                        <?php $chat_msgs_count = $ChatModel->where('company_id', $company_id)->where('from_id', $_iuser['user_id'])->where('to_id', $usession['sup_user_id'])->where('is_read',0)->countAllResults();
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
                        ?>
                        <a href="<?= site_url('erp/inbox/').uencode($_iuser['user_id']);?>">
                        <li class="<?php if($tid==$_iuser['user_id']):?>active<?php endif;?>">
                            <?= $rchat_msgs_count;?>
                            <img alt="" class="img-circle medium-image" src="<?= staff_profile_photo($_iuser['user_id']);?>">

                            <div class="vcentered info-combo">
                                <h3 class="no-margin-bottom name"> <?= $_iuser['first_name'].' '.$_iuser['last_name'];?> </h3>
                                <h5> <?= $message_content;?></h5>
                            </div>
                            <div class="contacts-add">
                                <span class="message-time"> <?= $msg_time;?></span>
                            </div>
                        </li></a>
                        <?php endif;?>
                       <?php endforeach;?> 
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-content">
        <div class="tab-pane message-body active" id="inbox-message-1">
            <div class="message-chat">
                <div class="chat-body" style="height:550px;">
                    <div class="row justify-content-md-center">
                        <div class="col-md-8 text-center">
                            <img src="<?= base_url();?>/public/assets/images/hrm_chat.png" width="350" height="350" />
                            <p><?= lang('Main.xin_chat_messenger_app_started');?></p>
                            <p><?= lang('Main.xin_chat_messenger_app_started1');?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>