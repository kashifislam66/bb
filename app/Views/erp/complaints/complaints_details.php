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
$ifield_id = udecode($segment_id);

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}
// get approvals data
$approval_cnt = $StaffapprovalsModel->where('company_id', $company_id)->where('staff_id', $usession['sup_user_id'])->where('module_key_id', $ifield_id)->where('module_option', 'complaint_settings')->countAllResults();
$approvals_data = $StaffapprovalsModel->where('company_id', $company_id)->where('module_key_id', $ifield_id)->where('module_option', 'complaint_settings')->findAll();
$level_option = staff_reporting_manager_info($usession['sup_user_id'],'complaint_settings');

$result = $ComplaintsModel->where('company_id', $company_id)->where('complaint_id', $ifield_id)->first();
//check approval levels
$skip_specific = skip_specific_approval_info('incident_settings');
$iskip_specific = $skip_specific['skip_specific_approval'];
if($iskip_specific == 1){
	$total_levels = $level_option['total_levels'];
} else {
	$old_level = staff_reporting_manager_old_level($result['employee_id'],'incident_settings');
	$total_levels = $old_level['total_levels'];
}

?>

<div class="row">
  <div class="col-xl-4 col-lg-12 task-detail-right">
  	<?php if($level_option['level1']==$usession['sup_user_id'] || $level_option['level2']==$usession['sup_user_id'] || $level_option['level3']==$usession['sup_user_id'] || $level_option['level4']==$usession['sup_user_id'] || $level_option['level5']==$usession['sup_user_id'] || $user_info['user_type'] == 'company') { ?>
    <div class="card">
      <div class="card-header">
        <h5><?= lang('Main.xin_update_complaint_status');?></h5>
        <small class="text-primary text-center"><?= $total_levels;?> Level Approval</small>
      </div>
      <?php if($result['status'] != 2){ ?>
      	  <?php if($approval_cnt < 1) {?>
			  
              <?php $attributes = array('name' => 'update_status_record', 'id' => 'update_status', 'autocomplete' => 'off');?>
              <?php $hidden = array('token' => $segment_id);?>
              <?php echo form_open('erp/complaints/update_status_record', $attributes, $hidden);?>
              <div class="card-body">
                <div class="row mt-2 mb-2">
                  <div class="col-md-12"> <span class=" txt-primary"> <i class="fas fa-chart-line"></i> <strong>
                    Responde <span class="text-danger">*</span>
                    </strong> </span> </div>
                </div>
                <div class="row">
                <ul>
                <li>
                <input type="radio" name="status" id="myCheckbox1" value="1" />
                <label for="myCheckbox1"><img src="<?= base_url();?>/public/assets/images/approve.png" width="70" height="70" /></label>
                </li>
                <li>
                
                <input type="radio" name="status"  id="myCheckbox2" value="2" />
                <label for="myCheckbox2"><img src="<?= base_url();?>/public/assets/images/reject.png" width="70" height="70" /></label>
                </li>
                </ul>

                  <?php /*?><div class="col-md-12">
                    <div class="form-group">
                      <select name="status" class="form-control" data-plugin="select_hrm" data-placeholder="<?= lang('Main.dashboard_xin_status');?>">
                        <option value="">
                        <?= lang('Main.dashboard_xin_status');?>
                        </option>
                        <option value="1">
                        <?= lang('Main.xin_accepted');?>
                        </option>
                        <option value="2">
                        <?= lang('Main.xin_rejected');?>
                        </option>
                      </select>
                    </div>
                  </div><?php */?>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">
                <?= lang('Main.xin_update_status');?>
                </button>
              </div>
              <?= form_close(); ?>
              
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
    <?php } ?>
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
						$ol = $iuser['first_name'].' '.$iuser['last_name'];
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
          <?= lang('Main.xin_view_complaint');?>
        </h5>
      </div>
      <?php $staff_info = $UsersModel->where('company_id', $company_id)->where('user_type','staff')->findAll();?>
      <div class="card-body">
        <div class="table-responsive">
              <table class="table m-b-0 f-14 b-solid requid-table">
                <tbody class="text-muted">
                  <tr>
                    <td><?= lang('Employees.xin_complaint_title');?></td>
                    <td>
                      <?= $result['title'];?></td>
                  </tr>
                  <tr>
                    <td><?= lang('Employees.xin_complaint_date');?></td>
                    <td class="text-danger">
                      <?= set_date_format($result['complaint_date']);?></td>
                  </tr>
                  <?php
				   //complaint_against
					$complaint_against = explode(',',$result['complaint_against']);
					$complaint_users = multi_user_profile_photo($complaint_against);?>
                  <tr>
                    <td><?= lang('Employees.xin_complaint_against');?></td>
                    <td><?= $complaint_users;?></td>
                  </tr>
                  <tr>
                    <td><?= lang('Main.dashboard_xin_status');?></td>
                    <td><?php
						if($result['status'] == 0){
							$is_approved = lang('Main.xin_pending');
						} else if($result['status'] == 1){
							$is_approved = lang('Main.xin_accepted');
						} else {
							$is_approved = lang('Main.xin_rejected');
						}
						echo $is_approved;
					?></td>
                  </tr>
                  
                </tbody>
              </table>
            </div>
            <div class="m-b-30 m-t-15">
              <h6><?= lang('Main.xin_description');?></h6>
              <hr>
              <?= html_entity_decode($result['description']);?>
            </div>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
li {
  display: inline-block;
}

input[type="radio"][id^="myCheckbox"] {
  display: none;
}

label {
  border: 1px solid #fff;
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  cursor: pointer;
}

label:before {
  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid grey;
  position: absolute;
  top: -5px;
  left: -5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
}

label img {
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + label {
  border-color: #ddd;
}

:checked + label:before {
  content: "✓";
  background-color: grey;
  transform: scale(1);
}

:checked + label img {
  transform: scale(0.9);
  /* box-shadow: 0 0 5px #333; */
  z-index: -1;
}</style>