<?php
use CodeIgniter\I18n\Time;
use App\Models\SystemModel;
use App\Models\JobsModel;
use App\Models\UsersModel;
use App\Models\ShiftModel;
use App\Models\LanguageModel;
use App\Models\ConstantsModel;
use App\Models\TimesheetModel;
use App\Models\StaffapprovalsModel;


$SystemModel = new SystemModel();
$JobsModel = new JobsModel();
$UsersModel = new UsersModel();
$ShiftModel = new ShiftModel();
$LanguageModel = new LanguageModel();
$ConstantsModel = new ConstantsModel();
$TimesheetModel = new TimesheetModel();
$StaffapprovalsModel = new StaffapprovalsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$router = service('router');
$request = \Config\Services::request();
$locale = service('request')->getLocale();

$segment_id = $request->uri->getSegment(3);
$ifield_id = udecode($segment_id);

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}

$result = $TimesheetModel->where('company_id', $company_id)->where('time_attendance_id', $ifield_id)->first();
$office_shifts = $ShiftModel->where('company_id',$company_id)->orderBy('office_shift_id', 'ASC')->findAll();
// get approvals data
$approval_cnt = $StaffapprovalsModel->where('company_id', $company_id)->where('staff_id', $usession['sup_user_id'])->where('module_key_id', $ifield_id)->where('module_option', 'attendance_settings')->countAllResults();
$approvals_data = $StaffapprovalsModel->where('company_id', $company_id)->where('module_key_id', $ifield_id)->where('module_option', 'attendance_settings')->findAll();
$level_option = staff_reporting_manager_info($usession['sup_user_id'],'attendance_settings');
//check approval levels
$skip_specific = skip_specific_approval_info('attendance_settings');
$iskip_specific = $skip_specific['skip_specific_approval'];
if($iskip_specific == 1){
	$total_levels = $level_option['total_levels'];
} else {
	$old_level = staff_reporting_manager_old_level($result['employee_id'],'attendance_settings');
	$total_levels = $old_level['total_levels'];
}
?>

<div class="row">
  <div class="col-xl-4 col-lg-12 task-detail-right">
    <div class="card">
      <div class="card-header">
        <h5><?= lang('Main.xin_update_attendance_status');?></h5>
        <small class="text-primary text-center"><?= $total_levels;?> Level Approval</small>
      </div>
      <?php if($result['status'] != 'Not Approved'){ ?>
      	  <?php if($approval_cnt < 1) {?>
			  <?php if($level_option['level1']==$usession['sup_user_id'] || $level_option['level2']==$usession['sup_user_id'] || $level_option['level3']==$usession['sup_user_id'] || $level_option['level4']==$usession['sup_user_id'] || $level_option['level5']==$usession['sup_user_id'] || $user_info['user_type'] == 'company') { ?>
              <?php $attributes = array('name' => 'update_attendance_status', 'id' => 'update_attendance_status', 'autocomplete' => 'off');?>
              <?php $hidden = array('token' => $segment_id);?>
              <?php echo form_open('erp/notifications/update_attendance_status_record', $attributes, $hidden);?>
              <?php } ?>
              <div class="card-body">
                <div class="row mt-2 mb-2">
                  <div class="col-md-12"> <span class=" txt-primary"> <i class="fas fa-chart-line"></i> <strong>
                    <?= lang('Main.dashboard_xin_status');?> <span class="text-danger">*</span>
                    </strong> </span> </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <select name="status" class="form-control" data-plugin="select_hrm" data-placeholder="<?= lang('Main.dashboard_xin_status');?>">
                        <option value="">
                        <?= lang('Main.dashboard_xin_status');?>
                        </option>
                        <option value="Approved">Approved</option>
                        <option value="Not Approved">Not Approved</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
               <?php if($level_option['level1']==$usession['sup_user_id'] || $level_option['level2']==$usession['sup_user_id'] || $level_option['level3']==$usession['sup_user_id'] || $level_option['level4']==$usession['sup_user_id'] || $level_option['level5']==$usession['sup_user_id'] || $user_info['user_type'] == 'company') { ?>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">
                <?= lang('Main.xin_update_status');?>
                </button>
              </div>
              <?= form_close(); ?>
              <?php } ?>
          <?php } else {?>
          <div class="card-body">
            <div class="alert alert-primary" role="alert">
                Already changed the status
            </div>
        </div>
        <?php } ?>
      <?php } else {?>
      	<div class="card-body">
      	<div class="alert alert-danger" role="alert">
            Request has been rejected.
        </div>
        </div>
      <?php } ?>
    </div>
    <div class="card latest-update-card">
        <div class="card-header">
            <h5>Approval Status</h5>
            <small class="text-primary text-center"><?= $total_levels;?> Level Approval</small>
        </div>
        <div class="card-body">
            <div class="latest-update-box">
            	<?php foreach($approvals_data as $app_data):?>
                <?php
					$iuser = $UsersModel->where('user_id', $app_data['staff_id'])->where('user_type','staff')->first();
					if($iuser){
						$ol = $iuser['first_name'].' '.$iuser['last_name'].'</li>';
					} else {
						$ol = '';
					}
					if($app_data['status']==1):
						$formstatus = '<span class="badge bg-light-success">'.lang('Main.xin_accepted').'</span>';
						$status_icon = '<i class="feather icon-check bg-light-success update-icon"></i>';
					elseif($app_data['status']==2):
						$formstatus = '<span class="badge bg-light-danger">'.lang('Main.xin_rejected').'.</span>';
						$status_icon = '<i class="feather icon-x bg-light-danger update-icon"></i>';	
					else:
						$formstatus = '<span class="badge bg-light-warning">'.lang('Main.xin_pending').'</span>';
						$status_icon = '<i class="feather icon-plus bg-light-warning update-icon"></i>';
					endif;
				?>
                <div class="row p-t-20 p-b-30">
                    <div class="col-auto text-end update-meta">
                        <p class="text-muted m-b-0 d-inline-flex"><?= $formstatus;?></p>
                        <?= $status_icon;?>
                    </div>
                    <div class="col">
                        <a href="#!">
                            <h6><?= $ol?></h6>
                        </a>
                        <p class="text-muted m-b-0"><?= set_date_format($app_data['updated_at']);?></p>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
  </div>
  <div class="col-xl-8 col-lg-12">
    <div class="card">
      <div class="card-header">
        <h5 class=""><i class="fas fa-clock m-r-5"></i>
          <?= lang('Main.xin_attendance_details');?>
        </h5>
      </div>
      <?php $staff_info = $UsersModel->where('company_id', $company_id)->where('user_type','staff')->findAll();?>
      <div class="card-body">
        <div class="table-responsive">
              <table class="table m-b-0 f-14 b-solid requid-table">
                <tbody class="text-muted">
                  
                  <tr>
                    <td><?= lang('Employees.xin_employee_office_shift');?></td>
                    <td class="">
                    <?php foreach($office_shifts as $office_shift) {?>
                        <?php if($office_shift['office_shift_id']==$result['shift_id']){?>
                        <?= $office_shift['shift_name']?> <?php }?>
                    <?php } ?>
                    </td>
                  </tr>
                  <?php
					$clock_in_time = strtotime($result['clock_in']);
					$fclckIn = date("h:i A", $clock_in_time);
					?>
                  <tr>
                    <td><?= lang('Employees.xin_shift_in_time');?></td>
                    <td class="">
                      <?php echo $fclckIn;?></td>
                  </tr>
                  <?php
					$clock_out_time = strtotime($result['clock_out']);
					$fclckOut = date("h:i A", $clock_out_time);
					?>
                  <tr>
                    <td><?= lang('Employees.xin_shift_out_time');?></td>
                    <td><?php echo $fclckOut;?></td>
                  </tr>
                  <tr>
                    <td><?= lang('Main.xin_e_details_date');?></td>
                    <td><?= set_date_format($result['attendance_date']);?></td>
                  </tr>
                  <tr>
                    <td><?= lang('Main.dashboard_xin_status');?></td>
                    <td><?php
						if($result['status'] == 'Pending'){
							$is_approved = lang('Pending');
						} else if($result['status'] == 'Approved'){
							$is_approved = lang('Approved');
						} else {
							$is_approved = lang('Not Approved');
						}
						echo $is_approved;
					?></td>
                  </tr>
                  
                </tbody>
              </table>
            </div>
      </div>
    </div>
  </div>
</div>
