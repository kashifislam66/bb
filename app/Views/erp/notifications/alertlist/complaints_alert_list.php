<?php
use CodeIgniter\I18n\Time;
use App\Models\SystemModel;
use App\Models\JobsModel;
use App\Models\UsersModel;
use App\Models\LanguageModel;
use App\Models\ConstantsModel;
use App\Models\ComplaintsModel;
use App\Models\StaffapprovalsModel;


$SystemModel = new SystemModel();
$JobsModel = new JobsModel();
$UsersModel = new UsersModel();
$LanguageModel = new LanguageModel();
$ConstantsModel = new ConstantsModel();
$ComplaintsModel = new ComplaintsModel();
$StaffapprovalsModel = new StaffapprovalsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$router = service('router');
$request = \Config\Services::request();
$locale = service('request')->getLocale();

$segment_id = $request->uri->getSegment(3);
$alert_count = udecode($segment_id);
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}
// new levels
$level_option = staff_reporting_manager_info($usession['sup_user_id'],'complaint_settings');
$skip_specific = skip_specific_approval_info('complaint_settings');
$iskip_specific = $skip_specific['skip_specific_approval'];

?>

<div class="row">
  <div class="col-xl-12 col-md-12">
    <div class="card marketing-card table-card">
      <div class="card-header">
        <h5>
          <?= lang('Main.xin_complaint_alert_list');?> 
        </h5>
      </div>
      <div class="pro-scroll">
        <div class="card-body p-b-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th><?= lang('Employees.xin_complaint_title');?></th>
                  <th><i class="fa fa-user small"></i>
                    <?= lang('Employees.xin_complaint_against');?></th>
                  <th><i class="fa fa-calendar small"></i>
                    <?= lang('Employees.xin_complaint_date');?></th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $com_alert = staff_approval_notification_complaints_info('complaint_settings');
				// New Approvals
				if($iskip_specific == 1){
					if($level_option['total_levels'] > 1){
						if($level_option['level1']==$usession['sup_user_id']){
						 foreach($com_alert['complaint_alert_data'] as $_complaint_arr):
						 foreach($_complaint_arr as $_complaint):
						
								$complaint_date = set_date_format($_complaint['complaint_date']);
								$complaint_against = explode(',',$_complaint['complaint_against']);
								$multi_users = multi_user_profile_photo($complaint_against);
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_complaint['complaint_id'])
								 ->where('module_option', 'complaint_settings')
								 ->countAllResults();
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<br><span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								?>
							<tr>
							  <td><?= $_complaint['title'];?></td>
							  <td><?= $multi_users;?></td>
							  <td><?= $complaint_date;?></td>
							  <td><a href="<?= site_url().'erp/view-complaint-info/'.uencode($_complaint['complaint_id']);?>">View Complaint</a><?= $make_approve.$change_status;?></td>
							</tr>
							<?php endforeach;
							endforeach;
						} else if($level_option['level2']==$usession['sup_user_id']){
							 foreach($com_alert['complaint_alert_data'] as $_complaint_arr):
							 foreach($_complaint_arr as $_complaint):
						
								$complaint_date = set_date_format($_complaint['complaint_date']);
								$complaint_against = explode(',',$_complaint['complaint_against']);
								$multi_users = multi_user_profile_photo($complaint_against);
								// check levels															
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_complaint['complaint_id'])
								 ->where('module_option', 'complaint_settings')
								 ->countAllResults();
								// if($check_levels > 0){
								 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
									->where('staff_id!=',$usession['sup_user_id'])
									->where('staff_id',$level_option['level1'])
									 ->where('module_key_id', $_complaint['complaint_id'])
									->where('module_option','complaint_settings')->where('status',1)->countAllResults();
								// status
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								// pending approval
								if($approval_data_cnt > 0){
									$link = '<a href="'.site_url().'erp/view-complaint-info/'.uencode($_complaint['complaint_id']).'">View Complaint</a>'.$make_approve;
								} else {
									$link = '<span class="badge bg-light-warning">1st level approval is pending</span>';
								}
								?>
							<tr>
							  <td><?= $_complaint['title'];?></td>
							  <td><?= $multi_users;?></td>
							  <td><?= $complaint_date;?></td>
							  <td><?= $link;?><br /><?= $change_status;?></td>
							</tr>
							<?php endforeach;
							endforeach;
						} else if($level_option['level3']==$usession['sup_user_id']){
							 foreach($com_alert['complaint_alert_data'] as $_complaint_arr):
							 foreach($_complaint_arr as $_complaint):
						
								$complaint_date = set_date_format($_complaint['complaint_date']);
								$complaint_against = explode(',',$_complaint['complaint_against']);
								$multi_users = multi_user_profile_photo($complaint_against);
								// check levels															
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_complaint['complaint_id'])
								 ->where('module_option', 'complaint_settings')
								 ->countAllResults();
								// if($check_levels > 0){
								 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
									->where('staff_id!=',$usession['sup_user_id'])
									->where('staff_id',$level_option['level2'])
									 ->where('module_key_id', $_complaint['complaint_id'])
									->where('module_option','complaint_settings')->where('status',1)->countAllResults();
								// status
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								// pending approval
								if($approval_data_cnt > 0){
									$link = '<a href="'.site_url().'erp/view-complaint-info/'.uencode($_complaint['complaint_id']).'">View Complaint</a>'.$make_approve;
								} else {
									$link = '<span class="badge bg-light-warning">2nd level approval is pending</span>';
								}
								?>
							<tr>
							  <td><?= $_complaint['title'];?></td>
							  <td><?= $multi_users;?></td>
							  <td><?= $complaint_date;?></td>
							  <td><?= $link;?><br /><?= $change_status;?></td>
							</tr>
							<?php endforeach;
							endforeach;
						} else if($level_option['level4']==$usession['sup_user_id']){
							 foreach($com_alert['complaint_alert_data'] as $_complaint_arr):
							 foreach($_complaint_arr as $_complaint):
						
								$complaint_date = set_date_format($_complaint['complaint_date']);
								$complaint_against = explode(',',$_complaint['complaint_against']);
								$multi_users = multi_user_profile_photo($complaint_against);
								// check levels															
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_complaint['complaint_id'])
								 ->where('module_option', 'complaint_settings')
								 ->countAllResults();
								// if($check_levels > 0){
								 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
									->where('staff_id!=',$usession['sup_user_id'])
									->where('staff_id',$level_option['level3'])
									 ->where('module_key_id', $_complaint['complaint_id'])
									->where('module_option','complaint_settings')->where('status',1)->countAllResults();
								// status
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								// pending approval
								if($approval_data_cnt > 0){
									$link = '<a href="'.site_url().'erp/view-complaint-info/'.uencode($_complaint['complaint_id']).'">View Complaint</a>'.$make_approve;
								} else {
									$link = '<span class="badge bg-light-warning">3rd level approval is pending</span>';
								}
								?>
							<tr>
							  <td><?= $_complaint['title'];?></td>
							  <td><?= $multi_users;?></td>
							  <td><?= $complaint_date;?></td>
							  <td><?= $link;?><br /><?= $change_status;?></td>
							</tr>
							<?php endforeach;
							endforeach;
						} else if($level_option['level5']==$usession['sup_user_id']){
							 foreach($com_alert['complaint_alert_data'] as $_complaint_arr):
							 foreach($_complaint_arr as $_complaint):
						
								$complaint_date = set_date_format($_complaint['complaint_date']);
								$complaint_against = explode(',',$_complaint['complaint_against']);
								$multi_users = multi_user_profile_photo($complaint_against);
								// check levels															
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_complaint['complaint_id'])
								 ->where('module_option', 'complaint_settings')
								 ->countAllResults();
								// if($check_levels > 0){
								 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
									->where('staff_id!=',$usession['sup_user_id'])
									->where('staff_id',$level_option['level4'])
									 ->where('module_key_id', $_complaint['complaint_id'])
									->where('module_option','complaint_settings')->where('status',1)->countAllResults();
								// status
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								// pending approval
								if($approval_data_cnt > 0){
									$link = '<a href="'.site_url().'erp/view-complaint-info/'.uencode($_complaint['complaint_id']).'">View Complaint</a>'.$make_approve;
								} else {
									$link = '<span class="badge bg-light-warning">4th level approval is pending</span>';
								}
								?>
							<tr>
							  <td><?= $_complaint['title'];?></td>
							  <td><?= $multi_users;?></td>
							  <td><?= $complaint_date;?></td>
							  <td><?= $link;?><br /><?= $change_status;?></td>
							</tr>
							<?php endforeach;
							endforeach;
						}
					} else {
						foreach($com_alert['complaint_alert_data'] as $_complaint_arr):
						 foreach($_complaint_arr as $_complaint):
					
							$complaint_date = set_date_format($_complaint['complaint_date']);
							$complaint_against = explode(',',$_complaint['complaint_against']);
							$multi_users = multi_user_profile_photo($complaint_against);
							$check_levels
							 = $StaffapprovalsModel
							 ->where('company_id', $company_id)
							 ->where('staff_id', $usession['sup_user_id'])
							 ->where('module_key_id', $_complaint['complaint_id'])
							 ->where('module_option', 'complaint_settings')
							 ->countAllResults();
							if($check_levels < 1) {
								$change_status = '';
								$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
							} else {
								$change_status = '<br><span class="badge bg-light-success">Already changed the status</span>';
								$make_approve = '';
							}
							?>
						<tr>
						  <td><?= $_complaint['title'];?></td>
						  <td><?= $multi_users;?></td>
						  <td><?= $complaint_date;?></td>
						  <td><a href="<?= site_url().'erp/view-complaint-info/'.uencode($_complaint['complaint_id']);?>">View Complaint</a><?= $make_approve.$change_status;?></td>
						</tr>
						<?php endforeach;
						endforeach;
					}
				} else {
					foreach($com_alert['complaint_alert_data'] as $_complaint_arr):
						 foreach($_complaint_arr as $_complaint):
						 	$complaint_against = explode(',',$_complaint['complaint_against']);
							$old_level = staff_reporting_manager_old_level($complaint_against,'complaint_settings');
							if($old_level['level1'] == $usession['sup_user_id']){
								$complaint_date = set_date_format($_complaint['complaint_date']);
								$complaint_against = explode(',',$_complaint['complaint_against']);
								$multi_users = multi_user_profile_photo($complaint_against);
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_complaint['complaint_id'])
								 ->where('module_option', 'complaint_settings')
								 ->countAllResults();
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<br><span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								?>
							<tr>
							  <td><?= $_complaint['title'];?></td>
							  <td><?= $multi_users;?></td>
							  <td><?= $complaint_date;?></td>
							  <td><a href="<?= site_url().'erp/view-complaint-info/'.uencode($_complaint['complaint_id']);?>">View Complaint</a><?= $make_approve.$change_status;?></td>
							</tr>
						<?php 
						} else if($old_level['level2'] == $usession['sup_user_id']){
								$complaint_date = set_date_format($_complaint['complaint_date']);
								$complaint_against = explode(',',$_complaint['complaint_against']);
								$multi_users = multi_user_profile_photo($complaint_against);
								// check levels															
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_complaint['complaint_id'])
								 ->where('module_option', 'complaint_settings')
								 ->countAllResults();
								// if($check_levels > 0){
								 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
									->where('staff_id!=',$usession['sup_user_id'])
									->where('staff_id',$level_option['level1'])
									 ->where('module_key_id', $_complaint['complaint_id'])
									->where('module_option','complaint_settings')->where('status',1)->countAllResults();
								// status
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								// pending approval
								if($approval_data_cnt > 0){
									$link = '<a href="'.site_url().'erp/view-complaint-info/'.uencode($_complaint['complaint_id']).'">View Complaint</a>'.$make_approve;
								} else {
									$link = '<span class="badge bg-light-warning">1st level approval is pending</span>';
								}
								?>
							<tr>
							  <td><?= $_complaint['title'];?></td>
							  <td><?= $multi_users;?></td>
							  <td><?= $complaint_date;?></td>
							  <td><?= $link;?><br /><?= $change_status;?></td>
							</tr>
						<?php 
						} else if($old_level['level3'] == $usession['sup_user_id']){
								$complaint_date = set_date_format($_complaint['complaint_date']);
								$complaint_against = explode(',',$_complaint['complaint_against']);
								$multi_users = multi_user_profile_photo($complaint_against);
								// check levels															
								$check_levels
								 = $StaffapprovalsModel
								 ->where('company_id', $company_id)
								 ->where('staff_id', $usession['sup_user_id'])
								 ->where('module_key_id', $_complaint['complaint_id'])
								 ->where('module_option', 'complaint_settings')
								 ->countAllResults();
								// if($check_levels > 0){
								 $approval_data_cnt = $StaffapprovalsModel->where('company_id',$company_id)
									->where('staff_id!=',$usession['sup_user_id'])
									->where('staff_id',$level_option['level2'])
									 ->where('module_key_id', $_complaint['complaint_id'])
									->where('module_option','complaint_settings')->where('status',1)->countAllResults();
								// status
								if($check_levels < 1) {
									$change_status = '';
									$make_approve = '<br><span class="badge bg-light-primary">My pending approval</span>';
								} else {
									$change_status = '<span class="badge bg-light-success">Already changed the status</span>';
									$make_approve = '';
								}
								// pending approval
								if($approval_data_cnt > 0){
									$link = '<a href="'.site_url().'erp/view-complaint-info/'.uencode($_complaint['complaint_id']).'">View Complaint</a>'.$make_approve;
								} else {
									$link = '<span class="badge bg-light-warning">2nd level approval is pending</span>';
								}
								?>
							<tr>
							  <td><?= $_complaint['title'];?></td>
							  <td><?= $multi_users;?></td>
							  <td><?= $complaint_date;?></td>
							  <td><?= $link;?><br /><?= $change_status;?></td>
							</tr>
						<?php 
						}
					endforeach;
				endforeach;
			}
			?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
