<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\CountryModel;
use App\Models\ConstantsModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$CountryModel = new CountryModel();
$ConstantsModel = new ConstantsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'company'){
	$trainer = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','trainer')->findAll();
	$training_types = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','training_type')->orderBy('constants_id', 'ASC')->findAll();
} else {
	$trainer = $UsersModel->where('company_id', $user_info['company_id'])->where('user_type','trainer')->findAll();
	$training_types = $ConstantsModel->where('company_id',$user_info['company_id'])->where('type','training_type')->orderBy('constants_id', 'ASC')->findAll();
}
?>
<?php //if(in_array('trainer2',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>

<div id="add_form" class="collapse add-form" data-parent="#accordion" style="">
    <div class="card mb-2">
        <div id="accordion">
            <div class="card-header">
                <h5>
                    <?= lang('Main.xin_create_poll');?>
                </h5>
                <div class="card-header-right"> <a data-toggle="collapse" href="#add_form" aria-expanded="false"
                        class="collapsed btn btn-sm waves-effect waves-light btn-primary m-0"> <i
                            data-feather="minus"></i>
                        <?= lang('Main.xin_hide');?>
                    </a> </div>
            </div>
            <?php $attributes = array('name' => 'add_poll', 'id' => 'xin-form', 'autocomplete' => 'off');?>
            <?php $hidden = array('_user' => 1);?>
            <?php echo form_open('erp/polls/add_poll', $attributes, $hidden);?>
            <div class="card-body">
            <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_number">
                                    <?= lang('Main.poll_title');?>
                                    <span class="text-danger">*</span> </label>
                                <input class="form-control" placeholder="<?= lang('Main.poll_title');?>"
                                    name="poll_title" type="text" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="contact_number">
                                    <?= lang('Main.xin_poll_start_date');?>
                                    <span class="text-danger">*</span> </label>
                                <input class="form-control date" placeholder="<?= lang('Main.xin_poll_start_date');?>"
                                    name="poll_start_date" type="text" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="contact_number">
                                    <?= lang('Main.xin_poll_end_date');?>
                                    <span class="text-danger">*</span> </label>
                                <input class="form-control date" placeholder="<?= lang('Main.xin_poll_end_date');?>"
                                    name="poll_end_date" type="text" value="">
                            </div>
                        </div>
                    </div>
                <div class="after-add-more">
                <div class="row">
                <div class="col-md-12">
                            <div class="form-group">
                                <label for="contact_number">
                                    <?= lang('Main.xin_poll_question');?>
                                    <span class="text-danger">*</span> </label>
                                <input class="form-control" placeholder="<?= lang('Main.xin_poll_question');?>"
                                    name="poll_question[]" type="text" value="">
                            </div>
                        </div>
                        </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_number">
                                    <?= lang('Main.xin_poll_answer1');?>
                                    <span class="text-danger">*</span> </label>
                                <input class="form-control" placeholder="<?= lang('Main.xin_poll_answer1');?>"
                                    name="poll_answer1[]" type="text" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_number">
                                    <?= lang('Main.xin_poll_answer2');?>
                                    <span class="text-danger">*</span> </label>
                                <input class="form-control" placeholder="<?= lang('Main.xin_poll_answer2');?>"
                                    name="poll_answer2[]" type="text" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_number">
                                    <?= lang('Main.xin_poll_answer3');?>
                                </label>
                                <input class="form-control" placeholder="<?= lang('Main.xin_poll_answer3');?>"
                                    name="poll_answer3[]" type="text" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_number">
                                    <?= lang('Main.xin_poll_answer4');?>
                                </label>
                                <input class="form-control" placeholder="<?= lang('Main.xin_poll_answer4');?>"
                                    name="poll_answer4[]" type="text" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_number">
                                    <?= lang('Main.xin_poll_answer5');?>
                                </label>
                                <input class="form-control" placeholder="<?= lang('Main.xin_poll_answer5');?>"
                                    name="poll_answer5[]" type="text" value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">
                                    <?= lang('Main.xin_notes');?>
                                </label>
                                <textarea class="form-control" placeholder="<?= lang('Main.xin_notes');?>" name="notes[]"
                                    cols="30" rows="3" id="notes"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group change">
                            <label for="">&nbsp;</label><br />
                            <a class="btn btn-success add-more">+ Add More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="reset" class="btn btn-light" href="#add_form" data-toggle="collapse"
                    aria-expanded="false">
                    <?= lang('Main.xin_reset');?>
                </button>
                &nbsp;
                <button type="submit" class="btn btn-primary">
                    <?= lang('Main.xin_save');?>
                </button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<?php //} ?>
<div class="card user-profile-list">
    <div class="card-header">
        <h5>
            <?= lang('Main.xin_list_all');?>
            <?= lang('Main.xin_polls');?>
        </h5>
        <?php if($user_info['user_type'] == 'company') { ?>
        <div class="card-header-right"> <a data-toggle="collapse" href="#add_form" aria-expanded="false"
                class="collapsed btn waves-effect waves-light btn-primary btn-sm m-0"> <i data-feather="plus"></i>
                <?= lang('Main.xin_create_poll');?>
            </a> </div>
        <?php } ?>
    </div>
    <div class="card-body">
        <div class="box-datatable table-responsive">
            <table class="datatables-demo table table-striped table-bordered" id="xin_table">
                <thead>
                    <tr>
                        <th width="450"><?= lang('Main.xin_poll_question');?></th>
                        <th> <?= lang('Main.xin_poll_start_date');?></th>
                        <th> <?= lang('Main.xin_poll_end_date');?></th>
                        <th><?= lang('Main.dashboard_xin_status');?></th>
                        <th><?= lang('Main.xin_created_at');?></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>