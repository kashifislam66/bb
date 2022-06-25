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
// get name
$get_user_name = $UsersModel->where('user_id', $to_id)->first();

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
            <div class="message-top">
            <div class="d-flex align-items-center chat-user">
                    <img src="<?= staff_profile_photo($tid);?>" alt="1" class="img-radius mb-2 wid-40">
                    <div class="ms-2">
                        <h6 class="mb-1"><?= $get_user_name['first_name'].' '.$get_user_name['last_name'];?></h6>
                    </div>
                </div>
                <!--<a class="btn btn-warning new-message"> <i class="fas fa-history"></i> Show History </a>-->
            </div>
            <div class="message-chat">
                <div class="chat-body">
                    <?php foreach($chat_msgs as $_msgs) { ?>
                    <?php
                        if(($tid==$_msgs['to_id'] && $_msgs['from_id']==$fid) || ($fid==$_msgs['to_id'] && $_msgs['from_id']==$tid)) {
                            if($usession['sup_user_id']!=$_msgs['from_id']){
                            //get user info
                            $get_main_user = $UsersModel->where('user_id', $_msgs['from_id'])->first();
                            // update status
                            $data = array(
                                'is_read' => 1,
                            );
                            $MainModel->update_chat_status($data,$_msgs['from_id'],$usession['sup_user_id']);
                    ?>
                    <div class="message info">
                        <img alt="1" class="img-circle medium-image" src="<?= staff_profile_photo($get_main_user['user_id']);?>">

                        <div class="message-body">
                            <div class="message-info">
                                <h4> <?= $get_main_user['first_name'].' '.$get_main_user['last_name'];?> </h4>
                                <h5> <i class="fa fa-clock-o"></i> <?= date("M j, g:i A",strtotime($_msgs['message_date']));?> </h5>
                            </div>
                            <hr>
                            <div class="message-text">
                                <?= $_msgs['message_content'];?>
                            </div>
                        </div>
                        <br>
                    </div>
                    <?php } else {?>
                    <?php
                    //get user info
                    $get_main_user = $UsersModel->where('user_id', $_msgs['from_id'])->first();
                    ?>
                    <div class="message my-message">
                        <img alt="" class="img-circle medium-image" src="<?= staff_profile_photo($get_main_user['user_id']);?>">

                        <div class="message-body">
                            <div class="message-body-inner">
                                <div class="message-info">
                                    <h4> <?= lang('Main.xin_chat_messenger_me');?> </h4>
                                    <h5> <i class="fa fa-clock-o"></i> <?= date("M j, g:i A",strtotime($_msgs['message_date']));?> </h5>
                                </div>
                                <hr>
                                <div class="message-text">
                                    <?= $_msgs['message_content'];?>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                  <?php } } }?>
                </div>

                <div class="chat-footer">
                <?php $attributes = array('name' => 'send_chat', 'id' => 'send_chat', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
                <?php $hidden = array('_method' => 'Send');?>
                <?php echo form_open('erp/chat/send_chat', $attributes, $hidden);?>
                <input type="hidden" name="to_id" id="to_id" value="<?= $segment_id;?>" />
                <input type="hidden" name="from_id" id="mfid" value="<?= uencode($fid);?>" />
                <input type="hidden" name="message_from" id="mfrid" value="<?= $segment_id;?>" />
                <input type="text" class="send-message-text" name="message_content" id="message_content" placeholder="<?= lang('Main.xin_chat_message_type');?>">
                <button type="submit" class="send-message-button btn-primary"> <i class="material-icons-two-tone text-white">send</i> </button>
                <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>