<?php
use App\Models\RolesModel;
use App\Models\ShiftModel;
use App\Models\UsersModel;
use App\Models\NotificationsModel;

$RolesModel = new RolesModel();
$ShiftModel = new ShiftModel();
$UsersModel = new UsersModel();
$NotificationsModel = new NotificationsModel();
$session = \Config\Services::session();
$usession = $session->get('sup_username');

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}
$staff_info = $UsersModel->where('company_id', $company_id)->where('user_type', 'staff')->orderBy('user_id','ASC')->findAll();
//echo $approval_levels_ids['level1'];
/* Employee Approvals view
*/
?>

<div class="row"> 
  <!-- start -->
  <div class="col-lg-3">
    <div class="card user-card user-card-1">
      <div class="card-body pb-0">
        <div class="media user-about-block align-items-center mt-0 mb-3">
          <div class="position-relative d-inline-block">
            <div class="certificated-badge"> <a href="javascript:void(0)" class="mb-3 nav-link"><span class="sw-icon fas fa-cog"></span></a> </div>
          </div>
          <div class="media-body ml-3">
            <h6 class="mb-1">
              <?= lang('Main.xin_notifications');?>
            </h6>
            <p class="mb-0 text-muted">
              <?= lang('Main.left_settings');?>
            </p>
          </div>
        </div>
      </div>
      <div class="nav flex-column nav-pills list-group list-group-flush list-pills" id="user-set-tab" role="tablist" aria-orientation="vertical"> <a class="nav-link list-group-item list-group-item-action active" id="account-leave-tab" data-toggle="pill" href="#account-leave" role="tab" aria-controls="account-leave" aria-selected="false"> <span class="f-w-500">
        <?= lang('Main.xin_leave_title');?>
        </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="account-leave_adjustment-tab" data-toggle="pill" href="#account-leave_adjustment" role="tab" aria-controls="account-leave_adjustment" aria-selected="false"> <span class="f-w-500">
        <?= lang('Main.xin_leave_adjustment');?>
        </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="account-travel-tab" data-toggle="pill" href="#account-travel" role="tab" aria-controls="account-travel" aria-selected="false"> <span class="f-w-500">
        <?= lang('Dashboard.left_travels');?>
        </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="account-overtime_request-tab" data-toggle="pill" href="#account-overtime_request" role="tab" aria-controls="account-overtime_request" aria-selected="false"> <span class="f-w-500">
        <?= lang('Dashboard.xin_overtime_request');?>
        </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="account-incidents-tab" data-toggle="pill" href="#account-incidents" role="tab" aria-controls="account-incidents" aria-selected="false"> <span class="f-w-500">
        <?= lang('Main.xin_incidents');?>
        </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="account-transfers-tab" data-toggle="pill" href="#account-transfers" role="tab" aria-controls="account-transfers" aria-selected="false"> <span class="f-w-500">
        <?= lang('Dashboard.left_transfers');?>
        </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="account-resignations-tab" data-toggle="pill" href="#account-resignations" role="tab" aria-controls="account-resignations" aria-selected="false"> <span class="f-w-500">
        <?= lang('Dashboard.left_resignations');?>
        </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="account-complaints-tab" data-toggle="pill" href="#account-complaints" role="tab" aria-controls="account-complaints" aria-selected="false"> <span class="f-w-500">
        <?= lang('Dashboard.left_complaints');?>
        </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a> <a class="nav-link list-group-item list-group-item-action" id="account-attendance-tab" data-toggle="pill" href="#account-attendance" role="tab" aria-controls="account-attendance" aria-selected="false"> <span class="f-w-500">
        <?= lang('Dashboard.left_attendance');?>
        </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a></div>
    </div>
  </div>
  <div class="col-lg-9">
    <div class="tab-content" id="user-set-tabContent">
      <div class="tab-pane fade show active" id="account-leave" role="tabpanel" aria-labelledby="account-leave-tab">
        <div class="bg-light card mb-2">
          <div class="card-body">
            <ul class="nav nav-pills mb-0">
              <li class="nav-item m-r-5"> <a href="#pills-notifications1" data-toggle="tab" aria-expanded="false" class="active">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Notifications </button>
                </a> </li>
              <li class="nav-item m-r-5"> <a href="#pills-approvals1" data-toggle="tab" aria-expanded="false" class="">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Approvals </button>
                </a> </li>
            </ul>
          </div>
        </div>
        <div class="card">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-notifications1" role="tabpanel" aria-labelledby="pills-notifications1-tab">
              <div class="card-header">
                <h5><i class="feather icon-bell mr-1"></i> Notifications </h5>
              </div>
              <?php $attributes = array('name' => 'update_leave_settings', 'id' => 'leave-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_notification_settings', $attributes, $hidden);?>
              <input type="hidden" name="notify_upon_submission[]" value="0" />
              <input type="hidden" name="notify_upon_approval[]" value="0" />
              <input type="hidden" name="module_option" value="leave_settings" />
              <div class="card-body">
                <?php $leave_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'leave_settings')->countAllResults(); ?>
                <?php if($leave_settings_cnt > 0) {?>
                <?php $leave_settings = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'leave_settings')->first(); ?>
                <?php $inotify_upon_submission = explode(',',$leave_settings['notify_upon_submission']);?>
                <?php $inotify_upon_approval = explode(',',$leave_settings['notify_upon_approval']);?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_submission');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_submission[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_submission');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_submission');?>
                        </option>
                        <option value="self" <?php if($leave_settings_cnt>0):if(in_array('self',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($leave_settings_cnt>0):if(in_array('manager',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($leave_settings_cnt>0):if(in_array($staff['user_id'],$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_approval');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_approval[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_approval');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_approval');?>
                        </option>
                        <option value="self" <?php if($leave_settings_cnt>0):if(in_array('self',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($leave_settings_cnt>0):if(in_array('manager',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($leave_settings_cnt>0): if(in_array($staff['user_id'],$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
            <div class="tab-pane fade" id="pills-approvals1" role="tabpanel" aria-labelledby="pills-approvals1-tab">
              <div class="card-header">
                <h5><i class="feather icon-users mr-1"></i> Approvals</h5>
              </div>
              <?php $attributes = array('name' => 'update_erp_approval_settings', 'id' => 'leave-approval-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_approval_settings', $attributes, $hidden);?>
              <input type="hidden" name="approval_level[]" value="0" />
              <input type="hidden" name="module_option" value="leave_settings" />
              <div class="card-body">
                <?php $leave_approval_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'leave_settings')->countAllResults(); ?>
                <?php if($leave_approval_cnt > 0) {?>
                <?php $leave_approval = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'leave_settings')->first(); ?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_method');?>
                      </label>
                      <select class="form-control" name="method_multi_level" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_method');?>">
                        <option value="1" <?php if($leave_approval_cnt > 0) { if($leave_approval['approval_method']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_method_multi_level');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_levels');?>
                      </label>
                      <select class="form-control leave_approval_levels" name="approval_levels" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_levels');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_levels');?>
                        </option>
                        <option value="0" <?php if($leave_approval_cnt > 0) { if($leave_approval['approval_level']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_auto');?>
                        </option>
                        <option value="1" <?php if($leave_approval_cnt > 0) { if($leave_approval['approval_level']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <option value="2" <?php if($leave_approval_cnt > 0) { if($leave_approval['approval_level']==2):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <option value="3" <?php if($leave_approval_cnt > 0) { if($leave_approval['approval_level']==3):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <option value="4" <?php if($leave_approval_cnt > 0) { if($leave_approval['approval_level']==4):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <option value="5" <?php if($leave_approval_cnt > 0) { if($leave_approval['approval_level']==5):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <?php if($leave_approval_cnt > 0) {
					if($leave_approval['approval_level']==0):
						$leave_approval01 = 'style="display:none;"';
						$leave_approval02 = 'style="display:none;"';
						$leave_approval03 = 'style="display:none;"';
						$leave_approval04 = 'style="display:none;"';
						$leave_approval05 = 'style="display:none;"';
					elseif($leave_approval['approval_level']==1):
						$leave_approval01 = 'style="display:block;"';
						$leave_approval02 = 'style="display:none;"';
						$leave_approval03 = 'style="display:none;"';
						$leave_approval04 = 'style="display:none;"';
						$leave_approval05 = 'style="display:none;"';
					elseif($leave_approval['approval_level']==2):
						$leave_approval01 = 'style="display:block;"';
						$leave_approval02 = 'style="display:block;"';
						$leave_approval03 = 'style="display:none;"';
						$leave_approval04 = 'style="display:none;"';
						$leave_approval05 = 'style="display:none;"';
					elseif($leave_approval['approval_level']==3):
						$leave_approval01 = 'style="display:block;"';
						$leave_approval02 = 'style="display:block;"';
						$leave_approval03 = 'style="display:block;"';
						$leave_approval04 = 'style="display:none;"';
						$leave_approval05 = 'style="display:none;"';
					elseif($leave_approval['approval_level']==4):
						$leave_approval01 = 'style="display:block;"';
						$leave_approval02 = 'style="display:block;"';
						$leave_approval03 = 'style="display:block;"';
						$leave_approval04 = 'style="display:block;"';
						$leave_approval05 = 'style="display:none;"';
					elseif($leave_approval['approval_level']==5):
						$leave_approval01 = 'style="display:block;"';
						$leave_approval02 = 'style="display:block;"';
						$leave_approval03 = 'style="display:block;"';
						$leave_approval04 = 'style="display:block;"';
						$leave_approval05 = 'style="display:block;"';
					else:
						$leave_approval01 = 'style="display:none;"';
						$leave_approval02 = 'style="display:none;"';
						$leave_approval03 = 'style="display:none;"';
						$leave_approval04 = 'style="display:none;"';
						$leave_approval05 = 'style="display:none;"';
					endif;
				} else {
					$leave_approval01 = 'style="display:none;"';
					$leave_approval02 = 'style="display:none;"';
					$leave_approval03 = 'style="display:none;"';
					$leave_approval04 = 'style="display:none;"';
					$leave_approval05 = 'style="display:none;"';
				}
			?>
                <?php
				
			?>
                <div class="row leave-approval-level-default leave-approval-level-one" <?= $leave_approval01;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level01');?>
                      </label>
                      <select class="form-control" name="approval_level01" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level01');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($leave_approval_cnt > 0) { if($leave_approval['approval_level01']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row leave-approval-level-default leave-approval-level-two" <?= $leave_approval02;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level02');?>
                      </label>
                      <select class="form-control" name="approval_level02" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level02');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($leave_approval_cnt > 0) { if($leave_approval['approval_level02']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row leave-approval-level-default leave-approval-level-three" <?= $leave_approval03;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level03');?>
                      </label>
                      <select class="form-control" name="approval_level03" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level03');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($leave_approval_cnt > 0) { if($leave_approval['approval_level03']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row leave-approval-level-default leave-approval-level-four" <?= $leave_approval04;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level04');?>
                      </label>
                      <select class="form-control" name="approval_level04" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level04');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($leave_approval_cnt > 0) { if($leave_approval['approval_level04']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row leave-approval-level-default leave-approval-level-five" <?= $leave_approval05;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level05');?>
                      </label>
                      <select class="form-control" name="approval_level05" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level05');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($leave_approval_cnt > 0) { if($leave_approval['approval_level05']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="xin_skip_specific_approval" class="control-label">
                        <?= lang('Main.xin_skip_specific_approval');?>
                      </label>
                      <select class="form-control" name="skip_specific_approval" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_skip_specific_approval');?>">
                        <option value="0" <?php if($leave_approval_cnt > 0) { if($leave_approval['skip_specific_approval']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_no');?>
                        </option>
                        <option value="1" <?php if($leave_approval_cnt > 0) { if($leave_approval['skip_specific_approval']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_yes');?>
                        </option>
                        
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="account-leave_adjustment" role="tabpanel" aria-labelledby="account-leave_adjustment-tab">
        <div class="bg-light card mb-2">
          <div class="card-body">
            <ul class="nav nav-pills mb-0">
              <li class="nav-item m-r-5"> <a href="#pills-notifications2" data-toggle="tab" aria-expanded="false" class="active">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Notifications </button>
                </a> </li>
              <li class="nav-item m-r-5"> <a href="#pills-approvals2" data-toggle="tab" aria-expanded="false" class="">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Approvals </button>
                </a> </li>
            </ul>
          </div>
        </div>
        <div class="card">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-notifications2" role="tabpanel" aria-labelledby="pills-notifications2-tab">
              <div class="card-header">
                <h5><i class="feather icon-bell mr-1"></i> Notifications </h5>
              </div>
              <?php $attributes = array('name' => 'update_leave_adjustment_settings', 'id' => 'leave-adjustment-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_notification_settings', $attributes, $hidden);?>
              <input type="hidden" name="notify_upon_submission[]" value="0" />
              <input type="hidden" name="notify_upon_approval[]" value="0" />
              <input type="hidden" name="module_option" value="leave_adjustment_settings" />
              <div class="card-body">
                <?php $leave_adjustment_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'leave_adjustment_settings')->countAllResults(); ?>
                <?php if($leave_adjustment_settings_cnt > 0) {?>
                <?php $leave_adjustment_settings = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'leave_adjustment_settings')->first(); ?>
                <?php $inotify_upon_submission = explode(',',$leave_adjustment_settings['notify_upon_submission']);?>
                <?php $inotify_upon_approval = explode(',',$leave_adjustment_settings['notify_upon_approval']);?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_submission');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_submission[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_submission');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_submission');?>
                        </option>
                        <option value="self" <?php if($leave_settings_cnt>0):if(in_array('self',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($leave_settings_cnt>0):if(in_array('manager',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($leave_adjustment_settings_cnt>0):if(in_array($staff['user_id'],$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_approval');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_approval[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_approval');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_approval');?>
                        </option>
                        <option value="self" <?php if($leave_settings_cnt>0):if(in_array('self',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($leave_settings_cnt>0):if(in_array('manager',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($leave_adjustment_settings_cnt>0): if(in_array($staff['user_id'],$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
            <div class="tab-pane fade" id="pills-approvals2" role="tabpanel" aria-labelledby="pills-approvals2-tab">
              <div class="card-header">
                <h5><i class="feather icon-users mr-1"></i> Approvals</h5>
              </div>
              <?php $attributes = array('name' => 'update_erp_approval_settings', 'id' => 'leave-adjustment-approval-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_approval_settings', $attributes, $hidden);?>
              <input type="hidden" name="approval_level[]" value="0" />
              <input type="hidden" name="module_option" value="leave_adjustment_settings" />
              <div class="card-body">
                <?php $leave_adjustment_setting_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'leave_adjustment_settings')->countAllResults(); ?>
                <?php if($leave_adjustment_setting_cnt > 0) {?>
                <?php $leave_adjustment_approve = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'leave_adjustment_settings')->first(); ?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_method');?>
                      </label>
                      <select class="form-control" name="method_multi_level" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_method');?>">
                        <option value="1" <?php if($leave_adjustment_setting_cnt > 0) { if($leave_adjustment_approve['approval_method']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_method_multi_level');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_levels');?>
                      </label>
                      <select class="form-control leave_adjust_approval_levels" name="approval_levels" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_levels');?>">
                        <option value="0" <?php if($leave_adjustment_setting_cnt > 0) { if($leave_adjustment_approve['approval_level']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_auto');?>
                        </option>
                        <option value="1" <?php if($leave_adjustment_setting_cnt > 0) { if($leave_adjustment_approve['approval_level']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <option value="2" <?php if($leave_adjustment_setting_cnt > 0) { if($leave_adjustment_approve['approval_level']==2):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <option value="3" <?php if($leave_adjustment_setting_cnt > 0) { if($leave_adjustment_approve['approval_level']==3):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <option value="4" <?php if($leave_adjustment_setting_cnt > 0) { if($leave_adjustment_approve['approval_level']==4):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <option value="5" <?php if($leave_adjustment_setting_cnt > 0) { if($leave_adjustment_approve['approval_level']==5):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <?php if($leave_adjustment_setting_cnt > 0) {
					if($leave_adjustment_approve['approval_level']==0):
						$leave_adjustment_approve01 = 'style="display:none;"';
						$leave_adjustment_approve02 = 'style="display:none;"';
						$leave_adjustment_approve03 = 'style="display:none;"';
						$leave_adjustment_approve04 = 'style="display:none;"';
						$leave_adjustment_approve05 = 'style="display:none;"';
					elseif($leave_adjustment_approve['approval_level']==1):
						$leave_adjustment_approve01 = 'style="display:block;"';
						$leave_adjustment_approve02 = 'style="display:none;"';
						$leave_adjustment_approve03 = 'style="display:none;"';
						$leave_adjustment_approve04 = 'style="display:none;"';
						$leave_adjustment_approve05 = 'style="display:none;"';
					elseif($leave_adjustment_approve['approval_level']==2):
						$leave_adjustment_approve01 = 'style="display:block;"';
						$leave_adjustment_approve02 = 'style="display:block;"';
						$leave_adjustment_approve03 = 'style="display:none;"';
						$leave_adjustment_approve04 = 'style="display:none;"';
						$leave_adjustment_approve05 = 'style="display:none;"';
					elseif($leave_adjustment_approve['approval_level']==3):
						$leave_adjustment_approve01 = 'style="display:block;"';
						$leave_adjustment_approve02 = 'style="display:block;"';
						$leave_adjustment_approve03 = 'style="display:block;"';
						$leave_adjustment_approve04 = 'style="display:none;"';
						$leave_adjustment_approve05 = 'style="display:none;"';
					elseif($leave_adjustment_approve['approval_level']==4):
						$leave_adjustment_approve01 = 'style="display:block;"';
						$leave_adjustment_approve02 = 'style="display:block;"';
						$leave_adjustment_approve03 = 'style="display:block;"';
						$leave_adjustment_approve04 = 'style="display:block;"';
						$leave_adjustment_approve05 = 'style="display:none;"';
					elseif($leave_adjustment_approve['approval_level']==5):
						$leave_adjustment_approve01 = 'style="display:block;"';
						$leave_adjustment_approve02 = 'style="display:block;"';
						$leave_adjustment_approve03 = 'style="display:block;"';
						$leave_adjustment_approve04 = 'style="display:block;"';
						$leave_adjustment_approve05 = 'style="display:block;"';
					else:
						$leave_adjustment_approve01 = 'style="display:none;"';
						$leave_adjustment_approve02 = 'style="display:none;"';
						$leave_adjustment_approve03 = 'style="display:none;"';
						$leave_adjustment_approve04 = 'style="display:none;"';
						$leave_adjustment_approve05 = 'style="display:none;"';
					endif;
				} else {
					$leave_adjustment_approve01 = 'style="display:none;"';
					$leave_adjustment_approve02 = 'style="display:none;"';
					$leave_adjustment_approve03 = 'style="display:none;"';
					$leave_adjustment_approve04 = 'style="display:none;"';
					$leave_adjustment_approve05 = 'style="display:none;"';
				}
			?>
                <?php
				
			?>
                <div class="row leave-adjust-approval-level-default leave-adjust-approval-level-one" <?= $leave_adjustment_approve01;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level01');?>
                      </label>
                      <select class="form-control" name="approval_level01" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level01');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($leave_adjustment_setting_cnt > 0) { if($leave_adjustment_approve['approval_level01']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row leave-adjust-approval-level-default leave-adjust-approval-level-two" <?= $leave_adjustment_approve02;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level02');?>
                      </label>
                      <select class="form-control" name="approval_level02" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level02');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($leave_adjustment_setting_cnt > 0) { if($leave_adjustment_approve['approval_level02']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row leave-adjust-approval-level-default leave-adjust-approval-level-three" <?= $leave_adjustment_approve03;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level03');?>
                      </label>
                      <select class="form-control" name="approval_level03" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level03');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($leave_adjustment_setting_cnt > 0) { if($leave_adjustment_approve['approval_level03']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row leave-adjust-approval-level-default leave-adjust-approval-level-four" <?= $leave_adjustment_approve04;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level04');?>
                      </label>
                      <select class="form-control" name="approval_level04" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level04');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($leave_adjustment_setting_cnt > 0) { if($leave_adjustment_approve['approval_level04']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row leave-adjust-approval-level-default leave-adjust-approval-level-five" <?= $leave_adjustment_approve05;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level05');?>
                      </label>
                      <select class="form-control" name="approval_level05" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level05');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($leave_adjustment_setting_cnt > 0) { if($leave_adjustment_approve['approval_level05']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="xin_skip_specific_approval" class="control-label">
                        <?= lang('Main.xin_skip_specific_approval');?>
                      </label>
                      <select class="form-control" name="skip_specific_approval" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_skip_specific_approval');?>">
                        <option value="0" <?php if($leave_adjustment_setting_cnt > 0) { if($leave_adjustment_approve['skip_specific_approval']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_no');?>
                        </option>
                        <option value="1" <?php if($leave_adjustment_setting_cnt > 0) { if($leave_adjustment_approve['skip_specific_approval']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_yes');?>
                        </option>
                        
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="account-travel" role="tabpanel" aria-labelledby="account-travel-tab">
        <div class="bg-light card mb-2">
          <div class="card-body">
            <ul class="nav nav-pills mb-0">
              <li class="nav-item m-r-5"> <a href="#pills-notifications3" data-toggle="tab" aria-expanded="false" class="active">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Notifications </button>
                </a> </li>
              <li class="nav-item m-r-5"> <a href="#pills-approvals3" data-toggle="tab" aria-expanded="false" class="">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Approvals </button>
                </a> </li>
            </ul>
          </div>
        </div>
        <div class="card">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-notifications3" role="tabpanel" aria-labelledby="pills-notifications3-tab">
              <div class="card-header">
                <h5><i class="feather icon-bell mr-1"></i> Notifications </h5>
              </div>
              <?php $attributes = array('name' => 'update_travel_settings', 'id' => 'travel-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_notification_settings', $attributes, $hidden);?>
              <input type="hidden" name="notify_upon_submission[]" value="0" />
              <input type="hidden" name="notify_upon_approval[]" value="0" />
              <input type="hidden" name="module_option" value="travel_settings" />
              <div class="card-body">
                <?php $travel_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'travel_settings')->countAllResults(); ?>
                <?php if($travel_settings_cnt > 0) {?>
                <?php $travel_settings = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'travel_settings')->first(); ?>
                <?php $inotify_upon_submission = explode(',',$travel_settings['notify_upon_submission']);?>
                <?php $inotify_upon_approval = explode(',',$travel_settings['notify_upon_approval']);?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_submission');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_submission[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_submission');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_submission');?>
                        </option>
                        <option value="self" <?php if($travel_settings_cnt>0):if(in_array('self',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($travel_settings_cnt>0):if(in_array('manager',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($travel_settings_cnt>0):if(in_array($staff['user_id'],$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_approval');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_approval[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_approval');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_approval');?>
                        </option>
                        <option value="self" <?php if($travel_settings_cnt>0):if(in_array('self',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($travel_settings_cnt>0):if(in_array('manager',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($travel_settings_cnt>0): if(in_array($staff['user_id'],$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
            <div class="tab-pane fade" id="pills-approvals3" role="tabpanel" aria-labelledby="pills-approvals3-tab">
              <div class="card-header">
                <h5><i class="feather icon-users mr-1"></i> Approvals</h5>
              </div>
              <?php $attributes = array('name' => 'update_erp_approval_settings', 'id' => 'travel-approval-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_approval_settings', $attributes, $hidden);?>
              <input type="hidden" name="approval_level[]" value="0" />
              <input type="hidden" name="module_option" value="travel_settings" />
              <div class="card-body">
                <?php $travel_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'travel_settings')->countAllResults(); ?>
                <?php if($travel_settings_cnt > 0) {?>
                <?php $travel_approve = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'travel_settings')->first(); ?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_method');?>
                      </label>
                      <select class="form-control" name="method_multi_level" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_method');?>">
                        <option value="1" <?php if($travel_settings_cnt > 0) { if($travel_approve['approval_method']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_method_multi_level');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_levels');?>
                      </label>
                      <select class="form-control travel_approval_levels" name="approval_levels" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_levels');?>">
                        <option value="0" <?php if($travel_settings_cnt > 0) { if($travel_approve['approval_level']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_auto');?>
                        </option>
                        <option value="1" <?php if($travel_settings_cnt > 0) { if($travel_approve['approval_level']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <option value="2" <?php if($travel_settings_cnt > 0) { if($travel_approve['approval_level']==2):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <option value="3" <?php if($travel_settings_cnt > 0) { if($travel_approve['approval_level']==3):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <option value="4" <?php if($travel_settings_cnt > 0) { if($travel_approve['approval_level']==4):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <option value="5" <?php if($travel_settings_cnt > 0) { if($travel_approve['approval_level']==5):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <?php if($travel_settings_cnt > 0) {
					if($travel_approve['approval_level']==0):
						$travel_approve01 = 'style="display:none;"';
						$travel_approve02 = 'style="display:none;"';
						$travel_approve03 = 'style="display:none;"';
						$travel_approve04 = 'style="display:none;"';
						$travel_approve05 = 'style="display:none;"';
					elseif($travel_approve['approval_level']==1):
						$travel_approve01 = 'style="display:block;"';
						$travel_approve02 = 'style="display:none;"';
						$travel_approve03 = 'style="display:none;"';
						$travel_approve04 = 'style="display:none;"';
						$travel_approve05 = 'style="display:none;"';
					elseif($travel_approve['approval_level']==2):
						$travel_approve01 = 'style="display:block;"';
						$travel_approve02 = 'style="display:block;"';
						$travel_approve03 = 'style="display:none;"';
						$travel_approve04 = 'style="display:none;"';
						$travel_approve05 = 'style="display:none;"';
					elseif($travel_approve['approval_level']==3):
						$travel_approve01 = 'style="display:block;"';
						$travel_approve02 = 'style="display:block;"';
						$travel_approve03 = 'style="display:block;"';
						$travel_approve04 = 'style="display:none;"';
						$travel_approve05 = 'style="display:none;"';
					elseif($travel_approve['approval_level']==4):
						$travel_approve01 = 'style="display:block;"';
						$travel_approve02 = 'style="display:block;"';
						$travel_approve03 = 'style="display:block;"';
						$travel_approve04 = 'style="display:block;"';
						$travel_approve05 = 'style="display:none;"';
					elseif($travel_approve['approval_level']==5):
						$travel_approve01 = 'style="display:block;"';
						$travel_approve02 = 'style="display:block;"';
						$travel_approve03 = 'style="display:block;"';
						$travel_approve04 = 'style="display:block;"';
						$travel_approve05 = 'style="display:block;"';
					else:
						$travel_approve01 = 'style="display:none;"';
						$travel_approve02 = 'style="display:none;"';
						$travel_approve03 = 'style="display:none;"';
						$travel_approve04 = 'style="display:none;"';
						$travel_approve05 = 'style="display:none;"';
					endif;
				} else {
					$travel_approve01 = 'style="display:none;"';
					$travel_approve02 = 'style="display:none;"';
					$travel_approve03 = 'style="display:none;"';
					$travel_approve04 = 'style="display:none;"';
					$travel_approve05 = 'style="display:none;"';
				}
			?>
                <?php
				
			?>
                <div class="row travel-approval-level-default travel-approval-level-one" <?= $travel_approve01;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level01');?>
                      </label>
                      <select class="form-control" name="approval_level01" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level01');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($travel_settings_cnt > 0) { if($travel_approve['approval_level01']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row travel-approval-level-default travel-approval-level-two" <?= $travel_approve02;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level02');?>
                      </label>
                      <select class="form-control" name="approval_level02" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level02');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($travel_settings_cnt > 0) { if($travel_approve['approval_level02']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row travel-approval-level-default travel-approval-level-three" <?= $travel_approve03;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level03');?>
                      </label>
                      <select class="form-control" name="approval_level03" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level03');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($travel_settings_cnt > 0) { if($travel_approve['approval_level03']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row travel-approval-level-default travel-approval-level-four" <?= $travel_approve04;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level04');?>
                      </label>
                      <select class="form-control" name="approval_level04" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level04');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($travel_settings_cnt > 0) { if($travel_approve['approval_level04']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row travel-approval-level-default travel-approval-level-five" <?= $travel_approve05;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level05');?>
                      </label>
                      <select class="form-control" name="approval_level05" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level05');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($travel_settings_cnt > 0) { if($travel_approve['approval_level05']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                	<div class="col-md-4">
                    <div class="form-group">
                      <label for="xin_skip_specific_approval" class="control-label">
                        <?= lang('Main.xin_skip_specific_approval');?>
                      </label>
                      <select class="form-control" name="skip_specific_approval" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_skip_specific_approval');?>">
                        <option value="0" <?php if($travel_settings_cnt > 0) { if($travel_approve['skip_specific_approval']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_no');?>
                        </option>
                        <option value="1" <?php if($travel_settings_cnt > 0) { if($travel_approve['skip_specific_approval']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_yes');?>
                        </option>
                        
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="account-overtime_request" role="tabpanel" aria-labelledby="account-overtime_request-tab">
        <div class="bg-light card mb-2">
          <div class="card-body">
            <ul class="nav nav-pills mb-0">
              <li class="nav-item m-r-5"> <a href="#pills-notifications4" data-toggle="tab" aria-expanded="false" class="active">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Notifications </button>
                </a> </li>
              <li class="nav-item m-r-5"> <a href="#pills-approvals4" data-toggle="tab" aria-expanded="false" class="">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Approvals </button>
                </a> </li>
            </ul>
          </div>
        </div>
        <div class="card">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-notifications4" role="tabpanel" aria-labelledby="pills-notifications4-tab">
              <div class="card-header">
                <h5><i class="feather icon-bell mr-1"></i> Notifications </h5>
              </div>
              <?php $attributes = array('name' => 'update_overtime_request_settings', 'id' => 'overtime-request-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_notification_settings', $attributes, $hidden);?>
              <input type="hidden" name="notify_upon_submission[]" value="0" />
              <input type="hidden" name="notify_upon_approval[]" value="0" />
              <input type="hidden" name="module_option" value="overtime_request_settings" />
              <div class="card-body">
                <?php $overtime_request_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'overtime_request_settings')->countAllResults(); ?>
                <?php if($overtime_request_settings_cnt > 0) {?>
                <?php $overtime_request_settings = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'overtime_request_settings')->first(); ?>
                <?php $inotify_upon_submission = explode(',',$overtime_request_settings['notify_upon_submission']);?>
                <?php $inotify_upon_approval = explode(',',$overtime_request_settings['notify_upon_approval']);?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_submission');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_submission[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_submission');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_submission');?>
                        </option>
                        <option value="self" <?php if($overtime_request_settings_cnt>0):if(in_array('self',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($overtime_request_settings_cnt>0):if(in_array('manager',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($overtime_request_settings_cnt>0):if(in_array($staff['user_id'],$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_approval');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_approval[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_approval');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_approval');?>
                        </option>
                        <option value="self" <?php if($overtime_request_settings_cnt>0):if(in_array('self',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($overtime_request_settings_cnt>0):if(in_array('manager',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($overtime_request_settings_cnt>0): if(in_array($staff['user_id'],$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
            <div class="tab-pane fade" id="pills-approvals4" role="tabpanel" aria-labelledby="pills-approvals4-tab">
              <div class="card-header">
                <h5><i class="feather icon-users mr-1"></i> Approvals</h5>
              </div>
              <?php $attributes = array('name' => 'update_erp_approval_settings', 'id' => 'overtime-request-approval-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_approval_settings', $attributes, $hidden);?>
              <input type="hidden" name="approval_level[]" value="0" />
              <input type="hidden" name="module_option" value="overtime_request_settings" />
              <div class="card-body">
                <?php $overtime_request_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'overtime_request_settings')->countAllResults(); ?>
                <?php if($overtime_request_settings_cnt > 0) {?>
                <?php $overtime_request_approve = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'overtime_request_settings')->first(); ?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_method');?>
                      </label>
                      <select class="form-control" name="method_multi_level" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_method');?>">
                        <option value="1" <?php if($overtime_request_settings_cnt > 0) { if($overtime_request_approve['approval_method']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_method_multi_level');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_levels');?>
                      </label>
                      <select class="form-control overtime_approval_levels" name="approval_levels" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_levels');?>">
                        <option value="0" <?php if($overtime_request_settings_cnt > 0) { if($overtime_request_approve['approval_level']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_auto');?>
                        </option>
                        <option value="1" <?php if($overtime_request_settings_cnt > 0) { if($overtime_request_approve['approval_level']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <option value="2" <?php if($overtime_request_settings_cnt > 0) { if($overtime_request_approve['approval_level']==2):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <option value="3" <?php if($overtime_request_settings_cnt > 0) { if($overtime_request_approve['approval_level']==3):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <option value="4" <?php if($overtime_request_settings_cnt > 0) { if($overtime_request_approve['approval_level']==4):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <option value="5" <?php if($overtime_request_settings_cnt > 0) { if($overtime_request_approve['approval_level']==5):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <?php if($overtime_request_settings_cnt > 0) {
					if($overtime_request_approve['approval_level']==0):
						$overtime_request_approve01 = 'style="display:none;"';
						$overtime_request_approve02 = 'style="display:none;"';
						$overtime_request_approve03 = 'style="display:none;"';
						$overtime_request_approve04 = 'style="display:none;"';
						$overtime_request_approve05 = 'style="display:none;"';
					elseif($overtime_request_approve['approval_level']==1):
						$overtime_request_approve01 = 'style="display:block;"';
						$overtime_request_approve02 = 'style="display:none;"';
						$overtime_request_approve03 = 'style="display:none;"';
						$overtime_request_approve04 = 'style="display:none;"';
						$overtime_request_approve05 = 'style="display:none;"';
					elseif($overtime_request_approve['approval_level']==2):
						$overtime_request_approve01 = 'style="display:block;"';
						$overtime_request_approve02 = 'style="display:block;"';
						$overtime_request_approve03 = 'style="display:none;"';
						$overtime_request_approve04 = 'style="display:none;"';
						$overtime_request_approve05 = 'style="display:none;"';
					elseif($overtime_request_approve['approval_level']==3):
						$overtime_request_approve01 = 'style="display:block;"';
						$overtime_request_approve02 = 'style="display:block;"';
						$overtime_request_approve03 = 'style="display:block;"';
						$overtime_request_approve04 = 'style="display:none;"';
						$overtime_request_approve05 = 'style="display:none;"';
					elseif($overtime_request_approve['approval_level']==4):
						$overtime_request_approve01 = 'style="display:block;"';
						$overtime_request_approve02 = 'style="display:block;"';
						$overtime_request_approve03 = 'style="display:block;"';
						$overtime_request_approve04 = 'style="display:block;"';
						$overtime_request_approve05 = 'style="display:none;"';
					elseif($overtime_request_approve['approval_level']==5):
						$overtime_request_approve01 = 'style="display:block;"';
						$overtime_request_approve02 = 'style="display:block;"';
						$overtime_request_approve03 = 'style="display:block;"';
						$overtime_request_approve04 = 'style="display:block;"';
						$overtime_request_approve05 = 'style="display:block;"';
					else:
						$overtime_request_approve01 = 'style="display:none;"';
						$overtime_request_approve02 = 'style="display:none;"';
						$overtime_request_approve03 = 'style="display:none;"';
						$overtime_request_approve04 = 'style="display:none;"';
						$overtime_request_approve05 = 'style="display:none;"';
					endif;
				} else {
					$overtime_request_approve01 = 'style="display:none;"';
					$overtime_request_approve02 = 'style="display:none;"';
					$overtime_request_approve03 = 'style="display:none;"';
					$overtime_request_approve04 = 'style="display:none;"';
					$overtime_request_approve05 = 'style="display:none;"';
				}
			?>
                <?php
				
			?>
                <div class="row overtime-approval-level-default overtime-approval-level-one" <?= $overtime_request_approve01;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level01');?>
                      </label>
                      <select class="form-control" name="approval_level01" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level01');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($overtime_request_settings_cnt > 0) { if($overtime_request_approve['approval_level01']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row overtime-approval-level-default overtime-approval-level-two" <?= $overtime_request_approve02;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level02');?>
                      </label>
                      <select class="form-control" name="approval_level02" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level02');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($overtime_request_settings_cnt > 0) { if($overtime_request_approve['approval_level02']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row overtime-approval-level-default overtime-approval-level-three" <?= $overtime_request_approve03;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level03');?>
                      </label>
                      <select class="form-control" name="approval_level03" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level03');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($overtime_request_settings_cnt > 0) { if($overtime_request_approve['approval_level03']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row overtime-approval-level-default overtime-approval-level-four" <?= $overtime_request_approve04;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level04');?>
                      </label>
                      <select class="form-control" name="approval_level04" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level04');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($overtime_request_settings_cnt > 0) { if($overtime_request_approve['approval_level04']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row overtime-approval-level-default overtime-approval-level-five" <?= $overtime_request_approve05;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level05');?>
                      </label>
                      <select class="form-control" name="approval_level05" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level05');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($overtime_request_settings_cnt > 0) { if($overtime_request_approve['approval_level05']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="xin_skip_specific_approval" class="control-label">
                        <?= lang('Main.xin_skip_specific_approval');?>
                      </label>
                      <select class="form-control" name="skip_specific_approval" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_skip_specific_approval');?>">
                        <option value="0" <?php if($overtime_request_settings_cnt > 0) { if($overtime_request_approve['skip_specific_approval']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_no');?>
                        </option>
                        <option value="1" <?php if($overtime_request_settings_cnt > 0) { if($overtime_request_approve['skip_specific_approval']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_yes');?>
                        </option>
                        
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="account-incidents" role="tabpanel" aria-labelledby="account-incidents-tab">
        <div class="bg-light card mb-2">
          <div class="card-body">
            <ul class="nav nav-pills mb-0">
              <li class="nav-item m-r-5"> <a href="#pills-notifications5" data-toggle="tab" aria-expanded="false" class="active">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Notifications </button>
                </a> </li>
              <li class="nav-item m-r-5"> <a href="#pills-approvals5" data-toggle="tab" aria-expanded="false" class="">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Approvals </button>
                </a> </li>
            </ul>
          </div>
        </div>
        <div class="card">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-notifications5" role="tabpanel" aria-labelledby="pills-notifications5-tab">
              <div class="card-header">
                <h5><i class="feather icon-bell mr-1"></i> Notifications </h5>
              </div>
              <?php $attributes = array('name' => 'update_incident_settings', 'id' => 'incident-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_notification_settings', $attributes, $hidden);?>
              <input type="hidden" name="notify_upon_submission[]" value="0" />
              <input type="hidden" name="notify_upon_approval[]" value="0" />
              <input type="hidden" name="module_option" value="incident_settings" />
              <div class="card-body">
                <?php $incident_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'incident_settings')->countAllResults(); ?>
                <?php if($incident_settings_cnt > 0) {?>
                <?php $incident_settings = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'incident_settings')->first(); ?>
                <?php $inotify_upon_submission = explode(',',$incident_settings['notify_upon_submission']);?>
                <?php $inotify_upon_approval = explode(',',$incident_settings['notify_upon_approval']);?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_submission');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_submission[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_submission');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_submission');?>
                        </option>
                        <option value="self" <?php if($incident_settings_cnt>0):if(in_array('self',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($incident_settings_cnt>0):if(in_array('manager',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($incident_settings_cnt>0):if(in_array($staff['user_id'],$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_approval');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_approval[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_approval');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_approval');?>
                        </option>
                        <option value="self" <?php if($incident_settings_cnt>0):if(in_array('self',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($incident_settings_cnt>0):if(in_array('manager',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($incident_settings_cnt>0): if(in_array($staff['user_id'],$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
            <div class="tab-pane fade" id="pills-approvals5" role="tabpanel" aria-labelledby="pills-approvals5-tab">
              <div class="card-header">
                <h5><i class="feather icon-users mr-1"></i> Approvals</h5>
              </div>
              <?php $attributes = array('name' => 'update_erp_approval_settings', 'id' => 'incident-approval-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_approval_settings', $attributes, $hidden);?>
              <input type="hidden" name="approval_level[]" value="0" />
              <input type="hidden" name="module_option" value="incident_settings" />
              <div class="card-body">
                <?php $incident_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'incident_settings')->countAllResults(); ?>
                <?php if($incident_settings_cnt > 0) {?>
                <?php $incident_approve = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'incident_settings')->first(); ?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_method');?>
                      </label>
                      <select class="form-control" name="method_multi_level" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_method');?>">
                        <option value="1" <?php if($incident_settings_cnt > 0) { if($incident_approve['approval_method']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_method_multi_level');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_levels');?>
                      </label>
                      <select class="form-control incident_approval_levels" name="approval_levels" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_levels');?>">
                        <option value="0" <?php if($incident_settings_cnt > 0) { if($incident_approve['approval_level']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_auto');?>
                        </option>
                        <option value="1" <?php if($incident_settings_cnt > 0) { if($incident_approve['approval_level']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <option value="2" <?php if($incident_settings_cnt > 0) { if($incident_approve['approval_level']==2):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <option value="3" <?php if($incident_settings_cnt > 0) { if($incident_approve['approval_level']==3):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <option value="4" <?php if($incident_settings_cnt > 0) { if($incident_approve['approval_level']==4):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <option value="5" <?php if($incident_settings_cnt > 0) { if($incident_approve['approval_level']==5):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <?php if($incident_settings_cnt > 0) {
					if($incident_approve['approval_level']==0):
						$incident_approve01 = 'style="display:none;"';
						$incident_approve02 = 'style="display:none;"';
						$incident_approve03 = 'style="display:none;"';
						$incident_approve04 = 'style="display:none;"';
						$incident_approve05 = 'style="display:none;"';
					elseif($incident_approve['approval_level']==1):
						$incident_approve01 = 'style="display:block;"';
						$incident_approve02 = 'style="display:none;"';
						$incident_approve03 = 'style="display:none;"';
						$incident_approve04 = 'style="display:none;"';
						$incident_approve05 = 'style="display:none;"';
					elseif($incident_approve['approval_level']==2):
						$incident_approve01 = 'style="display:block;"';
						$incident_approve02 = 'style="display:block;"';
						$incident_approve03 = 'style="display:none;"';
						$incident_approve04 = 'style="display:none;"';
						$incident_approve05 = 'style="display:none;"';
					elseif($incident_approve['approval_level']==3):
						$incident_approve01 = 'style="display:block;"';
						$incident_approve02 = 'style="display:block;"';
						$incident_approve03 = 'style="display:block;"';
						$incident_approve04 = 'style="display:none;"';
						$incident_approve05 = 'style="display:none;"';
					elseif($incident_approve['approval_level']==4):
						$incident_approve01 = 'style="display:block;"';
						$incident_approve02 = 'style="display:block;"';
						$incident_approve03 = 'style="display:block;"';
						$incident_approve04 = 'style="display:block;"';
						$incident_approve05 = 'style="display:none;"';
					elseif($incident_approve['approval_level']==5):
						$incident_approve01 = 'style="display:block;"';
						$incident_approve02 = 'style="display:block;"';
						$incident_approve03 = 'style="display:block;"';
						$incident_approve04 = 'style="display:block;"';
						$incident_approve05 = 'style="display:block;"';
					else:
						$incident_approve01 = 'style="display:none;"';
						$incident_approve02 = 'style="display:none;"';
						$incident_approve03 = 'style="display:none;"';
						$incident_approve04 = 'style="display:none;"';
						$incident_approve05 = 'style="display:none;"';
					endif;
				} else {
					$incident_approve01 = 'style="display:none;"';
					$incident_approve02 = 'style="display:none;"';
					$incident_approve03 = 'style="display:none;"';
					$incident_approve04 = 'style="display:none;"';
					$incident_approve05 = 'style="display:none;"';
				}
			?>
                <?php
				
			?>
                <div class="row incident-approval-level-default incident-approval-level-one" <?= $incident_approve01;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level01');?>
                      </label>
                      <select class="form-control" name="approval_level01" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level01');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($incident_settings_cnt > 0) { if($incident_approve['approval_level01']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row incident-approval-level-default incident-approval-level-two" <?= $incident_approve02;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level02');?>
                      </label>
                      <select class="form-control" name="approval_level02" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level02');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($incident_settings_cnt > 0) { if($incident_approve['approval_level02']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row incident-approval-level-default incident-approval-level-three" <?= $incident_approve03;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level03');?>
                      </label>
                      <select class="form-control" name="approval_level03" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level03');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($incident_settings_cnt > 0) { if($incident_approve['approval_level03']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row incident-approval-level-default incident-approval-level-four" <?= $incident_approve04;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level04');?>
                      </label>
                      <select class="form-control" name="approval_level04" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level04');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($incident_settings_cnt > 0) { if($incident_approve['approval_level04']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row incident-approval-level-default incident-approval-level-five" <?= $incident_approve05;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level05');?>
                      </label>
                      <select class="form-control" name="approval_level05" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level05');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($incident_settings_cnt > 0) { if($incident_approve['approval_level05']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="xin_skip_specific_approval" class="control-label">
                        <?= lang('Main.xin_skip_specific_approval');?>
                      </label>
                      <select class="form-control" name="skip_specific_approval" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_skip_specific_approval');?>">
                        <option value="0" <?php if($incident_settings_cnt > 0) { if($incident_approve['skip_specific_approval']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_no');?>
                        </option>
                        <option value="1" <?php if($incident_settings_cnt > 0) { if($incident_approve['skip_specific_approval']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_yes');?>
                        </option>
                        
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="account-transfers" role="tabpanel" aria-labelledby="account-transfers-tab">
        <div class="bg-light card mb-2">
          <div class="card-body">
            <ul class="nav nav-pills mb-0">
              <li class="nav-item m-r-5"> <a href="#pills-notifications6" data-toggle="tab" aria-expanded="false" class="active">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Notifications </button>
                </a> </li>
              <li class="nav-item m-r-5"> <a href="#pills-approvals6" data-toggle="tab" aria-expanded="false" class="">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Approvals </button>
                </a> </li>
            </ul>
          </div>
        </div>
        <div class="card">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-notifications6" role="tabpanel" aria-labelledby="pills-notifications6-tab">
              <div class="card-header">
                <h5><i class="feather icon-bell mr-1"></i> Notifications </h5>
              </div>
              <?php $attributes = array('name' => 'update_transfer_settings', 'id' => 'transfer-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_notification_settings', $attributes, $hidden);?>
              <input type="hidden" name="notify_upon_submission[]" value="0" />
              <input type="hidden" name="notify_upon_approval[]" value="0" />
              <input type="hidden" name="module_option" value="transfer_settings" />
              <div class="card-body">
                <?php $transfer_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'transfer_settings')->countAllResults(); ?>
                <?php if($transfer_settings_cnt > 0) {?>
                <?php $transfer_settings = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'transfer_settings')->first(); ?>
                <?php $inotify_upon_submission = explode(',',$transfer_settings['notify_upon_submission']);?>
                <?php $inotify_upon_approval = explode(',',$transfer_settings['notify_upon_approval']);?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_submission');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_submission[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_submission');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_submission');?>
                        </option>
                        <option value="self" <?php if($transfer_settings_cnt>0):if(in_array('self',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($transfer_settings_cnt>0):if(in_array('manager',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($transfer_settings_cnt>0):if(in_array($staff['user_id'],$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_approval');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_approval[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_approval');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_approval');?>
                        </option>
                        <option value="self" <?php if($transfer_settings_cnt>0):if(in_array('self',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($transfer_settings_cnt>0):if(in_array('manager',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($transfer_settings_cnt>0): if(in_array($staff['user_id'],$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
            <div class="tab-pane fade" id="pills-approvals6" role="tabpanel" aria-labelledby="pills-approvals6-tab">
              <div class="card-header">
                <h5><i class="feather icon-users mr-1"></i> Approvals</h5>
              </div>
              <?php $attributes = array('name' => 'update_erp_approval_settings', 'id' => 'transfer-approval-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_approval_settings', $attributes, $hidden);?>
              <input type="hidden" name="approval_level[]" value="0" />
              <input type="hidden" name="module_option" value="transfer_settings" />
              <div class="card-body">
                <?php $transfer_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'transfer_settings')->countAllResults(); ?>
                <?php if($transfer_settings_cnt > 0) {?>
                <?php $transfer_approve = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'transfer_settings')->first(); ?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_method');?>
                      </label>
                      <select class="form-control" name="method_multi_level" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_method');?>">
                        <option value="1" <?php if($transfer_settings_cnt > 0) { if($transfer_approve['approval_method']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_method_multi_level');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_levels');?>
                      </label>
                      <select class="form-control transfer_approval_levels" name="approval_levels" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_levels');?>">
                        <option value="0" <?php if($transfer_settings_cnt > 0) { if($transfer_approve['approval_level']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_auto');?>
                        </option>
                        <option value="1" <?php if($transfer_settings_cnt > 0) { if($transfer_approve['approval_level']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <option value="2" <?php if($transfer_settings_cnt > 0) { if($transfer_approve['approval_level']==2):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <option value="3" <?php if($transfer_settings_cnt > 0) { if($transfer_approve['approval_level']==3):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <option value="4" <?php if($transfer_settings_cnt > 0) { if($transfer_approve['approval_level']==4):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <option value="5" <?php if($transfer_settings_cnt > 0) { if($transfer_approve['approval_level']==5):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <?php if($transfer_settings_cnt > 0) {
					if($transfer_approve['approval_level']==0):
						$transfer_approve01 = 'style="display:none;"';
						$transfer_approve02 = 'style="display:none;"';
						$transfer_approve03 = 'style="display:none;"';
						$transfer_approve04 = 'style="display:none;"';
						$transfer_approve05 = 'style="display:none;"';
					elseif($transfer_approve['approval_level']==1):
						$transfer_approve01 = 'style="display:block;"';
						$transfer_approve02 = 'style="display:none;"';
						$transfer_approve03 = 'style="display:none;"';
						$transfer_approve04 = 'style="display:none;"';
						$transfer_approve05 = 'style="display:none;"';
					elseif($transfer_approve['approval_level']==2):
						$transfer_approve01 = 'style="display:block;"';
						$transfer_approve02 = 'style="display:block;"';
						$transfer_approve03 = 'style="display:none;"';
						$transfer_approve04 = 'style="display:none;"';
						$transfer_approve05 = 'style="display:none;"';
					elseif($transfer_approve['approval_level']==3):
						$transfer_approve01 = 'style="display:block;"';
						$transfer_approve02 = 'style="display:block;"';
						$transfer_approve03 = 'style="display:block;"';
						$transfer_approve04 = 'style="display:none;"';
						$transfer_approve05 = 'style="display:none;"';
					elseif($transfer_approve['approval_level']==4):
						$transfer_approve01 = 'style="display:block;"';
						$transfer_approve02 = 'style="display:block;"';
						$transfer_approve03 = 'style="display:block;"';
						$transfer_approve04 = 'style="display:block;"';
						$transfer_approve05 = 'style="display:none;"';
					elseif($transfer_approve['approval_level']==5):
						$transfer_approve01 = 'style="display:block;"';
						$transfer_approve02 = 'style="display:block;"';
						$transfer_approve03 = 'style="display:block;"';
						$transfer_approve04 = 'style="display:block;"';
						$transfer_approve05 = 'style="display:block;"';
					else:
						$transfer_approve01 = 'style="display:none;"';
						$transfer_approve02 = 'style="display:none;"';
						$transfer_approve03 = 'style="display:none;"';
						$transfer_approve04 = 'style="display:none;"';
						$transfer_approve05 = 'style="display:none;"';
					endif;
				} else {
					$transfer_approve01 = 'style="display:none;"';
					$transfer_approve02 = 'style="display:none;"';
					$transfer_approve03 = 'style="display:none;"';
					$transfer_approve04 = 'style="display:none;"';
					$transfer_approve05 = 'style="display:none;"';
				}
			?>
                <?php
				
			?>
                <div class="row transfer-approval-level-default transfer-approval-level-one" <?= $transfer_approve01;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level01');?>
                      </label>
                      <select class="form-control" name="approval_level01" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level01');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($transfer_settings_cnt > 0) { if($transfer_approve['approval_level01']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row transfer-approval-level-default transfer-approval-level-two" <?= $transfer_approve02;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level02');?>
                      </label>
                      <select class="form-control" name="approval_level02" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level02');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($transfer_settings_cnt > 0) { if($transfer_approve['approval_level02']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row transfer-approval-level-default transfer-approval-level-three" <?= $transfer_approve03;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level03');?>
                      </label>
                      <select class="form-control" name="approval_level03" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level03');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($transfer_settings_cnt > 0) { if($transfer_approve['approval_level03']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row transfer-approval-level-default transfer-approval-level-four" <?= $transfer_approve04;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level04');?>
                      </label>
                      <select class="form-control" name="approval_level04" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level04');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($transfer_settings_cnt > 0) { if($transfer_approve['approval_level04']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row transfer-approval-level-default transfer-approval-level-five" <?= $transfer_approve05;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level05');?>
                      </label>
                      <select class="form-control" name="approval_level05" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level05');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($transfer_settings_cnt > 0) { if($transfer_approve['approval_level05']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="xin_skip_specific_approval" class="control-label">
                        <?= lang('Main.xin_skip_specific_approval');?>
                      </label>
                      <select class="form-control" name="skip_specific_approval" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_skip_specific_approval');?>">
                        <option value="0" <?php if($transfer_settings_cnt > 0) { if($transfer_approve['skip_specific_approval']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_no');?>
                        </option>
                        <option value="1" <?php if($transfer_settings_cnt > 0) { if($transfer_approve['skip_specific_approval']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_yes');?>
                        </option>
                        
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="account-resignations" role="tabpanel" aria-labelledby="account-resignations-tab">
        <div class="bg-light card mb-2">
          <div class="card-body">
            <ul class="nav nav-pills mb-0">
              <li class="nav-item m-r-5"> <a href="#pills-notifications7" data-toggle="tab" aria-expanded="false" class="active">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Notifications </button>
                </a> </li>
              <li class="nav-item m-r-5"> <a href="#pills-approvals7" data-toggle="tab" aria-expanded="false" class="">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Approvals </button>
                </a> </li>
            </ul>
          </div>
        </div>
        <div class="card">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-notifications7" role="tabpanel" aria-labelledby="pills-notifications7-tab">
              <div class="card-header">
                <h5><i class="feather icon-bell mr-1"></i> Notifications </h5>
              </div>
              <?php $attributes = array('name' => 'update_resignation_settings', 'id' => 'resignation-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_notification_settings', $attributes, $hidden);?>
              <input type="hidden" name="notify_upon_submission[]" value="0" />
              <input type="hidden" name="notify_upon_approval[]" value="0" />
              <input type="hidden" name="module_option" value="resignation_settings" />
              <div class="card-body">
                <?php $resignation_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'resignation_settings')->countAllResults(); ?>
                <?php if($resignation_settings_cnt > 0) {?>
                <?php $resignation_settings = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'resignation_settings')->first(); ?>
                <?php $inotify_upon_submission = explode(',',$resignation_settings['notify_upon_submission']);?>
                <?php $inotify_upon_approval = explode(',',$resignation_settings['notify_upon_approval']);?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_submission');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_submission[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_submission');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_submission');?>
                        </option>
                        <option value="self" <?php if($resignation_settings_cnt>0):if(in_array('self',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($resignation_settings_cnt>0):if(in_array('manager',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($resignation_settings_cnt>0):if(in_array($staff['user_id'],$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_approval');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_approval[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_approval');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_approval');?>
                        </option>
                        <option value="self" <?php if($resignation_settings_cnt>0):if(in_array('self',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($resignation_settings_cnt>0):if(in_array('manager',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($resignation_settings_cnt>0): if(in_array($staff['user_id'],$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
            <div class="tab-pane fade" id="pills-approvals7" role="tabpanel" aria-labelledby="pills-approvals7-tab">
              <div class="card-header">
                <h5><i class="feather icon-users mr-1"></i> Approvals</h5>
              </div>
              <?php $attributes = array('name' => 'update_erp_approval_settings', 'id' => 'resignation-approval-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_approval_settings', $attributes, $hidden);?>
              <input type="hidden" name="approval_level[]" value="0" />
              <input type="hidden" name="module_option" value="resignation_settings" />
              <div class="card-body">
                <?php $resignation_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'resignation_settings')->countAllResults(); ?>
                <?php if($resignation_settings_cnt > 0) {?>
                <?php $resignation_approve = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'resignation_settings')->first(); ?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_method');?>
                      </label>
                      <select class="form-control" name="method_multi_level" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_method');?>">
                        <option value="1" <?php if($resignation_settings_cnt > 0) { if($resignation_approve['approval_method']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_method_multi_level');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_levels');?>
                      </label>
                      <select class="form-control resignation_approval_levels" name="approval_levels" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_levels');?>">
                        <option value="0" <?php if($resignation_settings_cnt > 0) { if($resignation_approve['approval_level']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_auto');?>
                        </option>
                        <option value="1" <?php if($resignation_settings_cnt > 0) { if($resignation_approve['approval_level']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <option value="2" <?php if($resignation_settings_cnt > 0) { if($resignation_approve['approval_level']==2):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <option value="3" <?php if($resignation_settings_cnt > 0) { if($resignation_approve['approval_level']==3):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <option value="4" <?php if($resignation_settings_cnt > 0) { if($resignation_approve['approval_level']==4):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <option value="5" <?php if($resignation_settings_cnt > 0) { if($resignation_approve['approval_level']==5):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <?php if($resignation_settings_cnt > 0) {
					if($resignation_approve['approval_level']==0):
						$resignation_approve01 = 'style="display:none;"';
						$resignation_approve02 = 'style="display:none;"';
						$resignation_approve03 = 'style="display:none;"';
						$resignation_approve04 = 'style="display:none;"';
						$resignation_approve05 = 'style="display:none;"';
					elseif($resignation_approve['approval_level']==1):
						$resignation_approve01 = 'style="display:block;"';
						$resignation_approve02 = 'style="display:none;"';
						$resignation_approve03 = 'style="display:none;"';
						$resignation_approve04 = 'style="display:none;"';
						$resignation_approve05 = 'style="display:none;"';
					elseif($resignation_approve['approval_level']==2):
						$resignation_approve01 = 'style="display:block;"';
						$resignation_approve02 = 'style="display:block;"';
						$resignation_approve03 = 'style="display:none;"';
						$resignation_approve04 = 'style="display:none;"';
						$resignation_approve05 = 'style="display:none;"';
					elseif($resignation_approve['approval_level']==3):
						$resignation_approve01 = 'style="display:block;"';
						$resignation_approve02 = 'style="display:block;"';
						$resignation_approve03 = 'style="display:block;"';
						$resignation_approve04 = 'style="display:none;"';
						$resignation_approve05 = 'style="display:none;"';
					elseif($resignation_approve['approval_level']==4):
						$resignation_approve01 = 'style="display:block;"';
						$resignation_approve02 = 'style="display:block;"';
						$resignation_approve03 = 'style="display:block;"';
						$resignation_approve04 = 'style="display:block;"';
						$resignation_approve05 = 'style="display:none;"';
					elseif($resignation_approve['approval_level']==5):
						$resignation_approve01 = 'style="display:block;"';
						$resignation_approve02 = 'style="display:block;"';
						$resignation_approve03 = 'style="display:block;"';
						$resignation_approve04 = 'style="display:block;"';
						$resignation_approve05 = 'style="display:block;"';
					else:
						$resignation_approve01 = 'style="display:none;"';
						$resignation_approve02 = 'style="display:none;"';
						$resignation_approve03 = 'style="display:none;"';
						$resignation_approve04 = 'style="display:none;"';
						$resignation_approve05 = 'style="display:none;"';
					endif;
				} else {
					$resignation_approve01 = 'style="display:none;"';
					$resignation_approve02 = 'style="display:none;"';
					$resignation_approve03 = 'style="display:none;"';
					$resignation_approve04 = 'style="display:none;"';
					$resignation_approve05 = 'style="display:none;"';
				}
			?>
                <?php
				
			?>
                <div class="row resignation-approval-level-default resignation-approval-level-one" <?= $resignation_approve01;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level01');?>
                      </label>
                      <select class="form-control" name="approval_level01" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level01');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($resignation_settings_cnt > 0) { if($resignation_approve['approval_level01']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row resignation-approval-level-default resignation-approval-level-two" <?= $resignation_approve02;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level02');?>
                      </label>
                      <select class="form-control" name="approval_level02" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level02');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($resignation_settings_cnt > 0) { if($resignation_approve['approval_level02']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row resignation-approval-level-default resignation-approval-level-three" <?= $resignation_approve03;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level03');?>
                      </label>
                      <select class="form-control" name="approval_level03" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level03');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($resignation_settings_cnt > 0) { if($resignation_approve['approval_level03']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row resignation-approval-level-default resignation-approval-level-four" <?= $resignation_approve04;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level04');?>
                      </label>
                      <select class="form-control" name="approval_level04" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level04');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($resignation_settings_cnt > 0) { if($resignation_approve['approval_level04']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row resignation-approval-level-default resignation-approval-level-five" <?= $resignation_approve05;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level05');?>
                      </label>
                      <select class="form-control" name="approval_level05" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level05');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($resignation_settings_cnt > 0) { if($resignation_approve['approval_level05']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="xin_skip_specific_approval" class="control-label">
                        <?= lang('Main.xin_skip_specific_approval');?>
                      </label>
                      <select class="form-control" name="skip_specific_approval" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_skip_specific_approval');?>">
                        <option value="0" <?php if($resignation_settings_cnt > 0) { if($resignation_approve['skip_specific_approval']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_no');?>
                        </option>
                        <option value="1" <?php if($resignation_settings_cnt > 0) { if($resignation_approve['skip_specific_approval']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_yes');?>
                        </option>
                        
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="account-complaints" role="tabpanel" aria-labelledby="account-complaints-tab">
        <div class="bg-light card mb-2">
          <div class="card-body">
            <ul class="nav nav-pills mb-0">
              <li class="nav-item m-r-5"> <a href="#pills-notifications8" data-toggle="tab" aria-expanded="false" class="active">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Notifications </button>
                </a> </li>
              <li class="nav-item m-r-5"> <a href="#pills-approvals8" data-toggle="tab" aria-expanded="false" class="">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Approvals </button>
                </a> </li>
            </ul>
          </div>
        </div>
        <div class="card">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-notifications8" role="tabpanel" aria-labelledby="pills-notifications8-tab">
              <div class="card-header">
                <h5><i class="feather icon-bell mr-1"></i> Notifications </h5>
              </div>
              <?php $attributes = array('name' => 'update_complaint_settings', 'id' => 'complaints-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_notification_settings', $attributes, $hidden);?>
              <input type="hidden" name="notify_upon_submission[]" value="0" />
              <input type="hidden" name="notify_upon_approval[]" value="0" />
              <input type="hidden" name="module_option" value="complaint_settings" />
              <div class="card-body">
                <?php $complaint_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'complaint_settings')->countAllResults(); ?>
                <?php if($complaint_settings_cnt > 0) {?>
                <?php $complaint_settings = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'complaint_settings')->first(); ?>
                <?php $inotify_upon_submission = explode(',',$complaint_settings['notify_upon_submission']);?>
                <?php $inotify_upon_approval = explode(',',$complaint_settings['notify_upon_approval']);?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_submission');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_submission[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_submission');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_submission');?>
                        </option>
                        <option value="self" <?php if($complaint_settings_cnt>0):if(in_array('self',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($complaint_settings_cnt>0):if(in_array('manager',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($complaint_settings_cnt>0):if(in_array($staff['user_id'],$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_approval');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_approval[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_approval');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_approval');?>
                        </option>
                        <option value="self" <?php if($complaint_settings_cnt>0):if(in_array('self',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($complaint_settings_cnt>0):if(in_array('manager',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($complaint_settings_cnt>0): if(in_array($staff['user_id'],$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
            <div class="tab-pane fade" id="pills-approvals8" role="tabpanel" aria-labelledby="pills-approvals8-tab">
              <div class="card-header">
                <h5><i class="feather icon-users mr-1"></i> Approvals</h5>
              </div>
              <?php $attributes = array('name' => 'update_erp_approval_settings', 'id' => 'complaint-approval-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_approval_settings', $attributes, $hidden);?>
              <input type="hidden" name="approval_level[]" value="0" />
              <input type="hidden" name="module_option" value="complaint_settings" />
              <div class="card-body">
                <?php $complaint_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'complaint_settings')->countAllResults(); ?>
                <?php if($complaint_settings_cnt > 0) {?>
                <?php $complaint_approve = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'complaint_settings')->first(); ?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_method');?>
                      </label>
                      <select class="form-control" name="method_multi_level" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_method');?>">
                        <option value="1" <?php if($complaint_settings_cnt > 0) { if($complaint_approve['approval_method']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_method_multi_level');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_levels');?>
                      </label>
                      <select class="form-control complaint_approval_levels" name="approval_levels" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_levels');?>">
                        <option value="0" <?php if($complaint_settings_cnt > 0) { if($complaint_approve['approval_level']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_auto');?>
                        </option>
                        <option value="1" <?php if($complaint_settings_cnt > 0) { if($complaint_approve['approval_level']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <option value="2" <?php if($complaint_settings_cnt > 0) { if($complaint_approve['approval_level']==2):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <option value="3" <?php if($complaint_settings_cnt > 0) { if($complaint_approve['approval_level']==3):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <option value="4" <?php if($complaint_settings_cnt > 0) { if($complaint_approve['approval_level']==4):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <option value="5" <?php if($complaint_settings_cnt > 0) { if($complaint_approve['approval_level']==5):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <?php if($complaint_settings_cnt > 0) {
					if($complaint_approve['approval_level']==0):
						$complaint_approve01 = 'style="display:none;"';
						$complaint_approve02 = 'style="display:none;"';
						$complaint_approve03 = 'style="display:none;"';
						$complaint_approve04 = 'style="display:none;"';
						$complaint_approve05 = 'style="display:none;"';
					elseif($complaint_approve['approval_level']==1):
						$complaint_approve01 = 'style="display:block;"';
						$complaint_approve02 = 'style="display:none;"';
						$complaint_approve03 = 'style="display:none;"';
						$complaint_approve04 = 'style="display:none;"';
						$complaint_approve05 = 'style="display:none;"';
					elseif($complaint_approve['approval_level']==2):
						$complaint_approve01 = 'style="display:block;"';
						$complaint_approve02 = 'style="display:block;"';
						$complaint_approve03 = 'style="display:none;"';
						$complaint_approve04 = 'style="display:none;"';
						$complaint_approve05 = 'style="display:none;"';
					elseif($complaint_approve['approval_level']==3):
						$complaint_approve01 = 'style="display:block;"';
						$complaint_approve02 = 'style="display:block;"';
						$complaint_approve03 = 'style="display:block;"';
						$complaint_approve04 = 'style="display:none;"';
						$complaint_approve05 = 'style="display:none;"';
					elseif($complaint_approve['approval_level']==4):
						$complaint_approve01 = 'style="display:block;"';
						$complaint_approve02 = 'style="display:block;"';
						$complaint_approve03 = 'style="display:block;"';
						$complaint_approve04 = 'style="display:block;"';
						$complaint_approve05 = 'style="display:none;"';
					elseif($complaint_approve['approval_level']==5):
						$complaint_approve01 = 'style="display:block;"';
						$complaint_approve02 = 'style="display:block;"';
						$complaint_approve03 = 'style="display:block;"';
						$complaint_approve04 = 'style="display:block;"';
						$complaint_approve05 = 'style="display:block;"';
					else:
						$complaint_approve01 = 'style="display:none;"';
						$complaint_approve02 = 'style="display:none;"';
						$complaint_approve03 = 'style="display:none;"';
						$complaint_approve04 = 'style="display:none;"';
						$complaint_approve05 = 'style="display:none;"';
					endif;
				} else {
					$complaint_approve01 = 'style="display:none;"';
					$complaint_approve02 = 'style="display:none;"';
					$complaint_approve03 = 'style="display:none;"';
					$complaint_approve04 = 'style="display:none;"';
					$complaint_approve05 = 'style="display:none;"';
				}
			?>
                <?php
				
			?>
                <div class="row complaint-approval-level-default complaint-approval-level-one" <?= $complaint_approve01;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level01');?>
                      </label>
                      <select class="form-control" name="approval_level01" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level01');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($complaint_settings_cnt > 0) { if($complaint_approve['approval_level01']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row complaint-approval-level-default complaint-approval-level-two" <?= $complaint_approve02;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level02');?>
                      </label>
                      <select class="form-control" name="approval_level02" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level02');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($complaint_settings_cnt > 0) { if($complaint_approve['approval_level02']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row complaint-approval-level-default complaint-approval-level-three" <?= $complaint_approve03;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level03');?>
                      </label>
                      <select class="form-control" name="approval_level03" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level03');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($complaint_settings_cnt > 0) { if($complaint_approve['approval_level03']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row complaint-approval-level-default complaint-approval-level-four" <?= $complaint_approve04;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level04');?>
                      </label>
                      <select class="form-control" name="approval_level04" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level04');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($complaint_settings_cnt > 0) { if($complaint_approve['approval_level04']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row complaint-approval-level-default complaint-approval-level-five" <?= $complaint_approve05;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level05');?>
                      </label>
                      <select class="form-control" name="approval_level05" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level05');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($complaint_settings_cnt > 0) { if($complaint_approve['approval_level05']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="xin_skip_specific_approval" class="control-label">
                        <?= lang('Main.xin_skip_specific_approval');?>
                      </label>
                      <select class="form-control" name="skip_specific_approval" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_skip_specific_approval');?>">
                        <option value="0" <?php if($complaint_settings_cnt > 0) { if($complaint_approve['skip_specific_approval']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_no');?>
                        </option>
                        <option value="1" <?php if($complaint_settings_cnt > 0) { if($complaint_approve['skip_specific_approval']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_yes');?>
                        </option>
                        
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="account-attendance" role="tabpanel" aria-labelledby="account-attendance-tab">
        <div class="bg-light card mb-2">
          <div class="card-body">
            <ul class="nav nav-pills mb-0">
              <li class="nav-item m-r-5"> <a href="#pills-notifications9" data-toggle="tab" aria-expanded="false" class="active">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Notifications </button>
                </a> </li>
              <li class="nav-item m-r-5"> <a href="#pills-approvals9" data-toggle="tab" aria-expanded="false" class="">
                <button type="button" class="btn btn-sm btn-shadow btn-secondary text-uppercase"> Approvals </button>
                </a> </li>
            </ul>
          </div>
        </div>
        <div class="card">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-notifications9" role="tabpanel" aria-labelledby="pills-notifications9-tab">
              <div class="card-header">
                <h5><i class="feather icon-bell mr-1"></i> Notifications </h5>
              </div>
              <?php $attributes = array('name' => 'update_attendance_settings', 'id' => 'attendance-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_notification_settings', $attributes, $hidden);?>
              <input type="hidden" name="notify_upon_submission[]" value="0" />
              <input type="hidden" name="notify_upon_approval[]" value="0" />
              <input type="hidden" name="module_option" value="attendance_settings" />
              <div class="card-body">
                <?php $attendance_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'attendance_settings')->countAllResults(); ?>
                <?php if($attendance_settings_cnt > 0) {?>
                <?php $attendance_settings = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'attendance_settings')->first(); ?>
                <?php $inotify_upon_submission = explode(',',$attendance_settings['notify_upon_submission']);?>
                <?php $inotify_upon_approval = explode(',',$attendance_settings['notify_upon_approval']);?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_submission');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_submission[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_submission');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_submission');?>
                        </option>
                        <option value="self" <?php if($attendance_settings_cnt>0):if(in_array('self',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($attendance_settings_cnt>0):if(in_array('manager',$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($attendance_settings_cnt>0):if(in_array($staff['user_id'],$inotify_upon_submission)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_notify_upon_approval');?>
                      </label>
                      <select multiple="multiple" class="form-control" name="notify_upon_approval[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_approval');?>">
                        <option value="">
                        <?= lang('Main.xin_notify_upon_approval');?>
                        </option>
                        <option value="self" <?php if($attendance_settings_cnt>0):if(in_array('self',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_him_herself');?>
                        </option>
                        <option value="manager" <?php if($attendance_settings_cnt>0):if(in_array('self',$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= lang('Main.xin_reporting_manager');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($attendance_settings_cnt>0): if(in_array($staff['user_id'],$inotify_upon_approval)):?> selected="selected"<?php endif;endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
            <div class="tab-pane fade" id="pills-approvals9" role="tabpanel" aria-labelledby="pills-approvals9-tab">
              <div class="card-header">
                <h5><i class="feather icon-users mr-1"></i> Approvals</h5>
              </div>
              <?php $attributes = array('name' => 'update_erp_approval_settings', 'id' => 'attendance-approval-settings', 'autocomplete' => 'off');?>
              <?php $hidden = array('user_id' => 0);?>
              <?= form_open_multipart('erp/notifications/update_erp_approval_settings', $attributes, $hidden);?>
              <input type="hidden" name="approval_level[]" value="0" />
              <input type="hidden" name="module_option" value="attendance_settings" />
              <div class="card-body">
                <?php $attendance_settings_cnt = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'attendance_settings')->countAllResults(); ?>
                <?php if($attendance_settings_cnt > 0) {?>
                <?php $attendance_approve = $NotificationsModel->where('company_id', $company_id)->where('module_options', 'attendance_settings')->first(); ?>
                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_method');?>
                      </label>
                      <select class="form-control" name="method_multi_level" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_method');?>">
                        <option value="1" <?php if($attendance_settings_cnt > 0) { if($attendance_approve['approval_method']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_method_multi_level');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_levels');?>
                      </label>
                      <select class="form-control complaint_approval_levels" name="approval_levels" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_levels');?>">
                        <option value="0" <?php if($attendance_settings_cnt > 0) { if($attendance_approve['approval_level']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_auto');?>
                        </option>
                        <option value="1" <?php if($attendance_settings_cnt > 0) { if($attendance_approve['approval_level']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <option value="2" <?php if($attendance_settings_cnt > 0) { if($attendance_approve['approval_level']==2):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <option value="3" <?php if($attendance_settings_cnt > 0) { if($attendance_approve['approval_level']==3):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <option value="4" <?php if($attendance_settings_cnt > 0) { if($attendance_approve['approval_level']==4):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <option value="5" <?php if($attendance_settings_cnt > 0) { if($attendance_approve['approval_level']==5):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <?php if($attendance_settings_cnt > 0) {
					if($attendance_approve['approval_level']==0):
						$attendance_approve01 = 'style="display:none;"';
						$attendance_approve02 = 'style="display:none;"';
						$attendance_approve03 = 'style="display:none;"';
						$attendance_approve04 = 'style="display:none;"';
						$attendance_approve05 = 'style="display:none;"';
					elseif($attendance_approve['approval_level']==1):
						$attendance_approve01 = 'style="display:block;"';
						$attendance_approve02 = 'style="display:none;"';
						$attendance_approve03 = 'style="display:none;"';
						$attendance_approve04 = 'style="display:none;"';
						$attendance_approve05 = 'style="display:none;"';
					elseif($attendance_approve['approval_level']==2):
						$attendance_approve01 = 'style="display:block;"';
						$attendance_approve02 = 'style="display:block;"';
						$attendance_approve03 = 'style="display:none;"';
						$attendance_approve04 = 'style="display:none;"';
						$attendance_approve05 = 'style="display:none;"';
					elseif($attendance_approve['approval_level']==3):
						$attendance_approve01 = 'style="display:block;"';
						$attendance_approve02 = 'style="display:block;"';
						$attendance_approve03 = 'style="display:block;"';
						$attendance_approve04 = 'style="display:none;"';
						$attendance_approve05 = 'style="display:none;"';
					elseif($attendance_approve['approval_level']==4):
						$attendance_approve01 = 'style="display:block;"';
						$attendance_approve02 = 'style="display:block;"';
						$attendance_approve03 = 'style="display:block;"';
						$attendance_approve04 = 'style="display:block;"';
						$attendance_approve05 = 'style="display:none;"';
					elseif($attendance_approve['approval_level']==5):
						$attendance_approve01 = 'style="display:block;"';
						$attendance_approve02 = 'style="display:block;"';
						$attendance_approve03 = 'style="display:block;"';
						$attendance_approve04 = 'style="display:block;"';
						$attendance_approve05 = 'style="display:block;"';
					else:
						$attendance_approve01 = 'style="display:none;"';
						$attendance_approve02 = 'style="display:none;"';
						$attendance_approve03 = 'style="display:none;"';
						$attendance_approve04 = 'style="display:none;"';
						$attendance_approve05 = 'style="display:none;"';
					endif;
				} else {
					$attendance_approve01 = 'style="display:none;"';
					$attendance_approve02 = 'style="display:none;"';
					$attendance_approve03 = 'style="display:none;"';
					$attendance_approve04 = 'style="display:none;"';
					$attendance_approve05 = 'style="display:none;"';
				}
			?>
                <?php
				
			?>
                <div class="row complaint-approval-level-default complaint-approval-level-one" <?= $attendance_approve01;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level01');?>
                      </label>
                      <select class="form-control" name="approval_level01" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level01');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level01');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($attendance_settings_cnt > 0) { if($attendance_approve['approval_level01']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row complaint-approval-level-default complaint-approval-level-two" <?= $attendance_approve02;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level02');?>
                      </label>
                      <select class="form-control" name="approval_level02" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level02');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level02');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($attendance_settings_cnt > 0) { if($attendance_approve['approval_level02']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row complaint-approval-level-default complaint-approval-level-three" <?= $attendance_approve03;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level03');?>
                      </label>
                      <select class="form-control" name="approval_level03" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level03');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level03');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($attendance_settings_cnt > 0) { if($attendance_approve['approval_level03']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row complaint-approval-level-default complaint-approval-level-four" <?= $attendance_approve04;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level04');?>
                      </label>
                      <select class="form-control" name="approval_level04" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level04');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level04');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($attendance_settings_cnt > 0) { if($attendance_approve['approval_level04']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row complaint-approval-level-default complaint-approval-level-five" <?= $attendance_approve05;?>>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_approval_level05');?>
                      </label>
                      <select class="form-control" name="approval_level05" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level05');?>">
                        <option value="">
                        <?= lang('Main.xin_approval_level05');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($attendance_settings_cnt > 0) { if($attendance_approve['approval_level05']==$staff['user_id']):?> selected="selected" <?php endif; } ?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="xin_skip_specific_approval" class="control-label">
                        <?= lang('Main.xin_skip_specific_approval');?>
                      </label>
                      <select class="form-control" name="skip_specific_approval" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_skip_specific_approval');?>">
                        <option value="0" <?php if($attendance_settings_cnt > 0) { if($attendance_approve['skip_specific_approval']==0):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_no');?>
                        </option>
                        <option value="1" <?php if($attendance_settings_cnt > 0) { if($attendance_approve['skip_specific_approval']==1):?> selected="selected" <?php endif; } ?>>
                        <?= lang('Main.xin_yes');?>
                        </option>
                        
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                <?= lang('Main.xin_save');?>
                </button>
              </div>
              <?= form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
