<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\FormsModel;
use App\Models\JobsModel;
use App\Models\ProjectsModel;
use App\Models\FormsfieldModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\FormscompletedfieldsModel;

$FormsModel = new FormsModel();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$JobsModel = new JobsModel();
$ProjectsModel = new ProjectsModel();
$FormsfieldModel = new FormsfieldModel();
$DepartmentModel = new DepartmentModel();
$DesignationModel = new DesignationModel();
$FormscompletedfieldsModel = new FormscompletedfieldsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$segment_id = $request->uri->getSegment(3);
$ifield_id = udecode($segment_id);

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}
// completed fields
$completedformfield = $FormscompletedfieldsModel->where("completed_field_id",$ifield_id)->first();
// form table
//$formfield_cnt = $FormsModel->where('company_id',$company_id)->where("forms_id",$completedformfield['form_id'])->countAllResults();
$formfield = $FormsModel->where('company_id',$company_id)->where("forms_id",$completedformfield['form_id'])->first();
// read_json_for_completed_form
$json_for_completed_form = read_json_for_completed_form($completedformfield['form_id']);

?>


<!-- View Completed Builder Form -->
<div class="row">
  <div class="col-xxl-8 col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5><?= lang('Main.xin_form_submited_view');?></h5>
                <div class="card-header-right"> <a href="<?= site_url('erp/forms-builder');?>" class="btn waves-effect waves-light btn-primary btn-sm m-0"> <i class="material-icons-two-tone f-18 text-white">ballot</i>
      <?= lang('Main.xin_forms_builder');?>
      </a> </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                    <div class="h6 m-0"><?= lang('Main.xin_form_name');?>:</div>
                    <div><?= $formfield['form_name'];?></div>
                </li>
                <?php foreach($json_for_completed_form as $json_form_data) { //echo '<pre>'; print_r($json_form_data);?>
					<?php
                    if($json_form_data->status==1):
                        $istatus = '<span class="badge bg-light-success">'.lang('Main.xin_accepted').'</span>';
                    elseif($json_form_data->status==2):
                        $istatus = '<span class="badge bg-light-danger">'.lang('Main.xin_rejected').'</span>';
                    else:
                        $istatus = '<span class="badge bg-light-warning">'.lang('Main.xin_pending').'</span>';
                    endif;
                    // form fields info
                    $form_field_cnt = $FormsfieldModel->where("form_field_id",$json_form_data->field_key)->countAllResults();
					if($form_field_cnt > 0) {
					$form_field_opt = $FormsfieldModel->where("form_field_id",$json_form_data->field_key)->first();
					if($form_field_opt['field_type'] != 3 && $form_field_opt['field_type'] != 8 && $form_field_opt['field_type'] != 9 && $form_field_opt['field_type'] != 10 && $form_field_opt['field_type'] != 11 && $form_field_opt['field_type'] != 12){
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="h6 m-0"><?= $json_form_data->field_label;?>:</div>
                        <div><?= $json_form_data->field_value;?></div>
                    </li>
                    <?php
					}
					 // 3: Checkbox options: multiple
                    if($form_field_opt['field_type'] == 3){
                    // multiple
                    $fields_option = explode(',',$json_form_data->field_value);
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="h6 m-0"><?= $json_form_data->field_label;?>:</div>
                        <div>
						<?php
                        foreach($fields_option as $field_multi):
                        	echo $field_multi.'<br>';
						endforeach;?>
                        </div>
                    </li>
                    <?php } 
                    // 8: departments
                    if($form_field_opt['field_type'] == 8){
                    // user department
                    $department = $DepartmentModel->where('department_id',$json_form_data->field_value)->first();
                    if($department){
                        $department_name = $department['department_name'];
                    } else {
                     	$department_name = '--';
                    }
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="h6 m-0"><?= $json_form_data->field_label;?>:</div>
                        <div><?= $department_name?></div>
                    </li>
                    <?php } ?>
                    <?php
                    // 9: employees
                    if($form_field_opt['field_type'] == 9){
                    // employee
                    $submit_user = $UsersModel->where('user_id',$json_form_data->field_value)->first();
                    if($submit_user){
                        $submited_user = $submit_user['first_name'].' '.$submit_user['last_name'];
                    } else {
                     	$submited_user = '--';
                    }
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="h6 m-0"><?= $json_form_data->field_label;?>:</div>
                        <div><?= $submited_user?></div>
                    </li>
                    <?php } ?>
                    <?php
                    // 10: projects
                    if($form_field_opt['field_type'] == 10){
                    // user project
                    $submit_project = $ProjectsModel->where('project_id',$json_form_data->field_value)->first();
                    if($submit_project){
                        $submited_project = $submit_project['title'];
                    } else {
                     	$submited_project = '--';
                    }
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="h6 m-0"><?= $json_form_data->field_label;?>:</div>
                        <div><?= $submited_project?></div>
                    </li>
                    <?php } ?>
                    <?php
                    // 11: designations
                    if($form_field_opt['field_type'] == 11){
                    // user designation
                    $submit_designation = $DesignationModel->where('designation_id',$json_form_data->field_value)->first();
                    if($submit_designation){
                        $submited_designation = $submit_designation['designation_name'];
                    } else {
                     	$submited_designation = '--';
                    }
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="h6 m-0"><?= $json_form_data->field_label;?>:</div>
                        <div><?= $submited_designation?></div>
                    </li>
                    <?php } ?>
                    <?php
                    // 12: jobs title
                    if($form_field_opt['field_type'] == 12){
                    // user designation
                    $submit_job= $JobsModel->where('job_id',$json_form_data->field_value)->first();
                    if($submit_designation){
                        $submited_job = $submit_job['job_title'];
                    } else {
                     	$submited_job = '--';
                    }
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="h6 m-0"><?= $json_form_data->field_label;?>:</div>
                        <div><?= $submited_job?></div>
                    </li>
                    <?php } ?>
                    <?php
                    // 12: jobs title
                    if($formfield['is_allow_attachment'] == 1){?>
                    <?php $attachment_value = $FormscompletedfieldsModel->where("form_id",$json_form_data->form_id)->where("staff_id",$json_form_data->staff_id)->where("field_key",13)->first();?>
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="h6 m-0"><?= lang('Main.xin_attachment');?>:</div>
                        <div><a href="<?= site_url()?>download?type=form_attachment&filename=<?= uencode($attachment_value['field_value']);?>">
						  <?= lang('Main.xin_download');?>
                          </a></div>
                    </li>
                    <?php } ?>
                <?php } ?>
                <?php /*?><li class="list-group-item d-flex justify-content-between">
                    <div class="h6 m-0">Status:</div>
                    <div><?= $istatus;?></div>
                </li><?php */?>
                <?php } ?>
            </ul>
            <?php if($user_info['user_type'] == 'company') { ?>
            <?php $attributes = array('name' => 'update_submited_status', 'id' => 'update_submited_status', 'autocomplete' => 'off');?>
			  <?php $hidden = array('user_id' => 1, 'token_status' => uencode($completedformfield['form_id']));?>
              <?php echo form_open('erp/forms/update_submited_form_status', $attributes, $hidden);?>
              <div class="card-body">
              	<div class="row mt-2 mb-2">
                    <div class="col-md-12"> <span class=" txt-primary"> <i class="fas fa-chart-line"></i> <strong>
                      <?= lang('Main.dashboard_xin_status');?>
                      </strong> </span> </div>
                  </div>
                  <div class="row justify-content-md-center mb-2">
                    <div class="col-md-12">
                      <div class="form-group leave-status">
                        <select class="form-control" data-plugin="select_hrm" name="status" autocomplete="off">
                          <option value="0" <?php if($completedformfield['status']=='0'):?> selected <?php endif; ?>>
                          <?= lang('Main.xin_pending');?>
                          </option>
                          <option value="1" <?php if($completedformfield['status']=='1'):?> selected <?php endif; ?>>
                          <?= lang('Main.xin_approved');?>
                          </option>
                          <option value="2" <?php if($completedformfield['status']=='2'):?> selected <?php endif; ?>>
                          <?= lang('Main.xin_rejected');?>
                          </option>
                        </select>
                      </div>
                    </div>
                 </div>
              </div>
              
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">
                <?= lang('Main.xin_update_status');?>
                </button>
              </div>
              <?= form_close(); ?>
              <?php } ?>
        </div>
    </div>
</div>
<style type="text/css">
.build-wrap .form-actions {display:none !important;}
</style>
