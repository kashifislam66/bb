<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\PollsModel;
use App\Models\ConstantsModel;
use App\Models\PollsvotesModel;
use App\Models\PollsQuestions;

$db      = \Config\Database::connect();
$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();		
$PollsModel = new PollsModel();	
$SystemModel = new SystemModel();
$ConstantsModel = new ConstantsModel();
$PollsvotesModel = new PollsvotesModel();
$PollsQuestions = new PollsQuestions();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
$xin_system = erp_company_settings();

$segment_id = $request->uri->getSegment(3);
$poll_id = udecode($segment_id);
$result = $PollsModel->where('poll_id', $poll_id)->first();	

if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}
$poll_question = $PollsQuestions->where('company_id',$company_id)->where('poll_ref_id',$poll_id)->findAll();
// print_r($company_id); die();

$poll_votes = $PollsvotesModel->where('company_id',$company_id)->where('poll_id',$poll_id)->groupBy(array('user_id'))->findAll();
// print_r($PollsvotesModel->getLastQuery()->getQuery()); die();
$al_poll_votes = $PollsvotesModel->where('company_id',$company_id)->where('poll_id',$poll_id)->where('user_id',$usession['sup_user_id'])->countAllResults();
?>


<div class="row">
<?php if($user_info['user_type'] == 'company') :
    $class = 'col-lg-4';
    else :
    $class = 'col-lg-12';
    endif;
    ?>
    <div class ="<?= $class; ?>">
        <div class="card hdd-right-inner">

            <?php
                  $added_by = $UsersModel->where('user_id', $result['added_by'])->first();
              if($added_by){
                $iadded_by = $added_by['first_name'].' '.$added_by['last_name'];
              } else {
                $iadded_by = '--';
              }
              ?>
            <?php $attributes = array('name' => 'update_vote', 'id' => 'update_vote', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
            <?php $hidden = array('_method' => 'EDIT', 'token' => $segment_id);?>
            <?php echo form_open('erp/polls/update_vote', $attributes, $hidden);?>
            <div class="card-body widget-last-task">

                <div class="new-task form-group">
                    <?php foreach($poll_question as $questions) :  ?>
                    <div class="card-header" style='padding: 13px 0px;
			margin-bottom: 14px;
			border-bottom: 2px solid #dadce0;'>
                        <h5>
                            <?= $questions['poll_question'] ?>
                        </h5>
                    </div>
                    <div class="to-do-list mb-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" name="poll_answer[<?= $questions['id'] ?>]"
                                class="custom-control-input input-light-primary" id="poll_answer1" value="1"
                                checked="checked">
                            <label class="custom-control-label" for="poll_answer1">
                                <?= $questions['poll_answer1'] ?>
                            </label>
                        </div>
                    </div>
                    <div class="to-do-list mb-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" name="poll_answer[<?= $questions['id'] ?>]"
                                class="custom-control-input input-light-primary" id="poll_answer2" value="2">
                            <label class="custom-control-label" for="poll_answer2">
                                <?= $questions['poll_answer2'] ?>
                            </label>
                        </div>
                    </div>
                    <?php if($questions['poll_answer3']!=''){ ?>
                    <div class="to-do-list mb-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" name="poll_answer[<?= $questions['id'] ?>]"
                                class="custom-control-input input-light-primary" id="poll_answer3" value="3">
                            <label class="custom-control-label" for="poll_answer3">
                                <?= $questions['poll_answer3'] ?>
                            </label>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($questions['poll_answer4']!=''){ ?>
                    <div class="to-do-list mb-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" name="poll_answer[<?= $questions['id'] ?>]"
                                class="custom-control-input input-light-primary" id="poll_answer4" value="4">
                            <label class="custom-control-label" for="poll_answer4">
                                <?= $questions['poll_answer4'] ?>
                            </label>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($questions['poll_answer5']!=''){ ?>
                    <div class="to-do-list mb-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" name="poll_answer[<?= $questions['id'] ?>]"
                                class="custom-control-input input-light-primary" id="poll_answer5" value="5">
                            <label class="custom-control-label" for="poll_answer5">
                                <?= $questions['poll_answer5'] ?>
                            </label>
                        </div>
                    </div>
                    <?php } ?>
                    <?php endforeach; ?>
                </div>

            </div>


            <div class="card-footer text-right">
                <?php if($al_poll_votes > 0) { ?>
                <button type="button" class="btn disabled btn-secondary">
                    <?= lang('Main.xin_already_voted');?>
                </button>
                <?php } else {?>
                <button type="submit" class="btn btn-primary">
                    <?= lang('Main.xin_vote');?>
                </button>
                <?php } ?>

            </div>
            <?= form_close(); ?>
        </div>

        <div class="card hdd-right-inner">
            <div class="card-header">
                <h5>
                    <?= lang('Main.xin_poll_view') ?>
                </h5>
            </div>
           
            <div class="card-body">
                <table class="table" style="table-layout: fixed; overflow: hidden;">
                    <tbody>
                        <tr>
                            <td><i class="far fa-calendar-alt m-r-5"></i>
                                <?php echo lang('Main.xin_poll_start_date');?>:</td>
                            <td class="text-right"><?= set_date_format($result['poll_start_date']);?></td>
                        </tr>
                        <tr>
                            <td><i class="far fa-calendar-alt m-r-5"></i> <?php echo lang('Main.xin_poll_end_date');?>:
                            </td>
                            <td class="text-right"><?= set_date_format($result['poll_end_date']);?></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user m-r-5"></i> <?php echo lang('Main.xin_added_by');?>:</td>
                            <td class="text-right"><?= $iadded_by;?></td>
                        </tr>
                        <tr>
                            <td><i class="far fa-calendar-alt m-r-5"></i> <?php echo lang('Main.xin_created_at');?>:
                            </td>
                            <td class="text-right"><?= set_date_format($result['created_at']);?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if($user_info['user_type'] == 'company') : ?>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="feather icon-check-circle mr-1"></i>
                    <?= $result['poll_question'] ?>
                </h5>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-overview" role="tabpanel"
                    aria-labelledby="pills-overview-tab">
                    <div class="card-body">

                        <?php 
                        $i = 0;
                        $responses = count($poll_votes);
                         foreach($poll_votes as $pvote){ 
                             $i++;
                             if($i == 1) { ?>
                        <div style="margin-bottom: 25px;">
                            <h1> <?= $result['poll_title']; ?></h1>
                            <h7><?= $responses; ?> responses</h7>
                        </div>
                        <?php  }

                        $user_name = $UsersModel->where('user_id', $pvote['user_id'])->first(); ?>
                        <div class="username" style="margin-bottom: 10px;"><?= $user_name['username']; ?></div>

                        <?php } ?>
                        <input type="hidden" class="poll_id" value="<?= $poll_id ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control" name="users" id="users">
                                    <option value="">Select User</option>

                                    <?php  foreach($poll_votes as $pvote){ 
                                    $user_name = $UsersModel->where('user_id', $pvote['user_id'])->first(); ?>
                                    <option value="<?= $pvote['user_id'] ?>"><?= $user_name['username']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <select class="form-control" name="question" id="question">
                                    <option value="">Select Question</option>

                                    <?php  foreach($poll_question as $question){ ?>
                                    <option value="<?= $question['id'] ?>"><?= $question['poll_question']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent" style="padding: 0px 37px;">
                <div class="result" >
                </div>
            </div>
            </div>
            
       
    </div>
    <?php endif ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    jQuery(document).on('change', '#question', function() {
        var obj = $(this);
        var poll_id = $(".poll_id").val();
        var id = $(this).val();

        if (poll_id != "") {
            $.ajax({
                url: main_url + "polls/get_question",
                type: "GET",
                data: obj.serialize() + 'jd=1&is_ajax=1&poll_id=' + poll_id +
                    '&data=get_question&type=get_question&question=' + id,
                success: function(JSON) {
                    $(".result").html(JSON.result);
                }
            });
        }
    });

    jQuery(document).on('change', '#users', function() {
        var obj = $(this);
        var poll_id = $(".poll_id").val();
        var id = $(this).val();

        if (poll_id != "") {
            $.ajax({
                url: main_url + "polls/get_user_poll",
                type: "GET",
                data: obj.serialize() + 'jd=1&is_ajax=1&poll_id=' + poll_id +
                    '&data=get_user_poll&type=get_user_poll&user=' + id,
                success: function(JSON) {
                    $(".result").html(JSON.result);

                }
            });
        }
    });
});
</script>

<style type="text/css">
.hide-calendar .ui-datepicker-calendar {
    display: none !important;
}

.hide-calendar .ui-priority-secondary {
    display: none !important;
}

.ui-datepicker-div {
    top: 500px !important;
}
.main_div {
    border-bottom: 2px solid #dadce0;
    margin-bottom: 18px;
}

.hide_1 {
  display: none;
}
    
.response_1:hover + .hide_1 {
  display: block;
  color: red;
}

.hide_2 {
  display: none;
}
    
.response_2:hover + .hide_2 {
  display: block;
  color: red;
}

.hide_3 {
  display: none;
}
    
.response_3:hover + .hide_3 {
  display: block;
  color: red;
}

.hide_4 {
  display: none;
}
    
.response_4:hover + .hide_4 {
  display: block;
  color: red;
}

.hide_5 {
  display: none;
}
    
.response_5:hover + .hide_5 {
  display: block;
  color: red;
}
</style>