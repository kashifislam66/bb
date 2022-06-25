<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\FormsModel;
use App\Models\DepartmentModel;
use App\Models\FormsfieldModel;
use App\Models\StaffdetailsModel;

$FormsModel = new FormsModel();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$DepartmentModel = new DepartmentModel();
$FormsfieldModel = new FormsfieldModel();
$StaffdetailsModel = new StaffdetailsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}
$staff_info = $UsersModel->where('company_id', $company_id)->where('user_type','staff')->findAll();
$departments = $DepartmentModel->where('company_id',$company_id)->orderBy('department_id', 'ASC')->findAll();

$segment_id = $request->uri->getSegment(3);
$form_id = udecode($segment_id);
$_form = $FormsModel->where('company_id',$company_id)->where("forms_id",$form_id)->first();
$assigned_to = explode(',',$_form['assigned_to']);
// form fields
$form_items = $FormsfieldModel->where('company_id', $company_id)->where('form_id', $form_id)->findAll();
$form_categories = array(1=>'Employee Forms',2=>'Performance Forms',3=>'Job Candidate Forms',4=>'Approval process set up',5=>'Training evaluation Forms',6=>'Employee exit Forms',7=>'External Forms');
$form_types = array(1=>'Text Box',2=>'List Box',3=>'Check Box',4=>'Date',5=>'Text Area (Large Text Field)',6=>'Time',7=>'Radio Box',8=>'Data | List of Departments',9=>'Data | List of Employees',10=>'Data | List of Projects',11=>'Data | List of Designations', 12=>'Data | List of Job Posts');
?>

<!-- Builder Wrap -->

<div class="row m-b-1 animated fadeInRight">
  <div class="col-md-12">
    <div class="card mb-2">
      <div class="card-header">
        <h5>
          <?= lang('Main.xin_form_edit');?>
        </h5>
        <div class="card-header-right"> <a href="<?= site_url('erp/forms-builder');?>" class="btn waves-effect waves-light btn-primary btn-sm m-0"> <i class="material-icons-two-tone f-18 text-white">ballot</i>
      <?= lang('Main.xin_forms_builder');?>
      </a> </div>
      </div>
      <?php $attributes = array('name' => 'update_form', 'id' => 'xin-form', 'autocomplete' => 'off');?>
      <?php $hidden = array('token' => $segment_id);?>
      <?= form_open('erp/forms/update_form', $attributes, $hidden);?>
      <div class="card-body">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item m-r-5"> <a href="#pills-overview" data-toggle="tab" aria-expanded="false" class="">
            <button type="button" class="btn  btn-primary btn-sm text-uppercase">
            <?= lang('Main.xin_form_settings');?>
            </button>
            </a> </li>
          <li class="nav-item m-r-5"> <a href="#pills-edit" data-toggle="tab" aria-expanded="false" class="">
            <button type="button" class="btn  btn-primary btn-sm text-uppercase">
            <?= lang('Main.xin_form_questions_fields');?>
            </button>
            </a> </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade active show" id="pills-overview" role="tabpanel" aria-labelledby="pills-overview-tab">
            <div class="row">
              <div class="col-md-7">
                <div class="form-group">
                  <label for="form_name">
                    <?= lang('Main.xin_form_name');?>
                    <span class="text-danger">*</span> </label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"> <i class="fab fa-wpforms"></i></span></div>
                    <input type="text" class="form-control" placeholder="<?= lang('Main.xin_form_name');?>" value="<?= $_form['form_name'];?>" name="form_name" id="form_name">
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="form_category">
                    <?= lang('Main.xin_form_categories');?>
                    <span class="text-danger">*</span> </label>
                  <select class="form-control" name="form_category" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_form_categories');?>">
                    <option value="">
                    <?= lang('Main.xin_form_categories');?>
                    </option>
                    <?php foreach($form_categories as $category_key=>$cat_value) {?>
                    <option value="<?= $category_key?>" <?php if($category_key==$_form['category_id']):?> selected="selected"<?php endif;?>>
                    <?= $cat_value ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="is_allow_attachment">
                    <?= lang('Main.xin_allow_attachment');?>
                  </label>
                  <select class="form-control form-control-x" name="allow_attachment" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_allow_attachment');?>">
                    <option value="0" <?php if(0==$_form['is_allow_attachment']):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_no');?>
                    </option>
                    <option value="1" <?php if(1==$_form['is_allow_attachment']):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_yes');?>
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="is_attachment_mandatory">
                    <?= lang('Main.xin_allow_attachment_mandatory');?>
                  </label>
                  <select class="form-control form-control-x" name="attachment_mandatory" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_allow_attachment_mandatory');?>">
                    <option value="0" <?php if(0==$_form['is_attachment_mandatory']):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_no');?>
                    </option>
                    <option value="1" <?php if(1==$_form['is_attachment_mandatory']):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_yes');?>
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="self_fill">
                    <?= lang('Main.xin_allow_self_fill');?>
                  </label>
                  <select class="form-control form-control-x" name="allow_self_fill" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_allow_self_fill');?>">
                    <option value="0" <?php if(0==$_form['is_allow_fill']):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_no');?>
                    </option>
                    <option value="1" <?php if(1==$_form['is_allow_fill']):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_yes');?>
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="status">
                    <?= lang('Main.dashboard_xin_status');?>
                  </label>
                  <select class="form-control form-control-x" name="status" data-plugin="select_hrm" data-placeholder="<?= lang('Main.dashboard_xin_status');?>">
                    <option value="1" <?php if(1==$_form['status']):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_employees_active');?>
                    </option>
                    <option value="0" <?php if(0==$_form['status']):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_employees_inactive');?>
                    </option>
                  </select>
                </div>
              </div>
            </div>
            <h5 class="mt-3">Notifications</h5>
            <div class="row">
              <div class="col-md-6">
              	<input type="hidden" value="0" name="notify_upon_submission[]" />
                <?php $inotify_upon_submission = explode(',',$_form['notify_upon_submission']);?>
                <div class="form-group">
                  <label for="first_name">
                    <?= lang('Main.xin_notify_upon_submission');?>
                  </label>
                  <select multiple="multiple" class="form-control" name="notify_upon_submission[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_submission');?>">
                    <option value="">
                    <?= lang('Main.xin_notify_upon_submission');?>
                    </option>
                    <option value="self" <?php if(in_array('self',$inotify_upon_submission)):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_him_herself');?>
                    </option>
                    <option value="manager" <?php if(in_array('manager',$inotify_upon_submission)):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_reporting_manager');?>
                    </option>
                    <?php foreach($staff_info as $staff) {?>
                    <option value="<?= $staff['user_id']?>" <?php if(in_array($staff['user_id'],$inotify_upon_submission)):?> selected="selected"<?php endif;?>>
                    <?= $staff['first_name'].' '.$staff['last_name'] ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
              	<input type="hidden" value="0" name="notify_upon_approval[]" />
                <?php $inotify_upon_approval = explode(',',$_form['notify_upon_approval']);?>
                <div class="form-group">
                  <label for="first_name">
                    <?= lang('Main.xin_notify_upon_approval_form');?>
                  </label>
                  <select multiple="multiple" class="form-control" name="notify_upon_approval[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_approval_form');?>">
                    <option value="">
                    <?= lang('Main.xin_notify_upon_approval_form');?>
                    </option>
                    <option value="self" <?php if(in_array('self',$inotify_upon_approval)):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_him_herself');?>
                    </option>
                    <option value="manager" <?php if(in_array('manager',$inotify_upon_approval)):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_reporting_manager');?>
                    </option>
                    <?php foreach($staff_info as $staff) {?>
                    <option value="<?= $staff['user_id']?>" <?php if(in_array($staff['user_id'],$inotify_upon_approval)):?> selected="selected"<?php endif;?>>
                    <?= $staff['first_name'].' '.$staff['last_name'] ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
              	<input type="hidden" value="0" name="notify_upon_rejection[]" />
                <?php $inotify_upon_rejection = explode(',',$_form['notify_upon_rejection']);?>
                <div class="form-group">
                  <label for="first_name">
                    <?= lang('Main.xin_notify_upon_rejection_form');?>
                  </label>
                  <select multiple="multiple" class="form-control" name="notify_upon_rejection[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_notify_upon_rejection_form');?>">
                    <option value="">
                    <?= lang('Main.xin_notify_upon_rejection_form');?>
                    </option>
                    <option value="self" <?php if(in_array('self',$inotify_upon_rejection)):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_him_herself');?>
                    </option>
                    <option value="manager" <?php if(in_array('manager',$inotify_upon_rejection)):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_reporting_manager');?>
                    </option>
                    <?php foreach($staff_info as $staff) {?>
                    <option value="<?= $staff['user_id']?>" <?php if(in_array($staff['user_id'],$inotify_upon_rejection)):?> selected="selected"<?php endif;?>>
                    <?= $staff['first_name'].' '.$staff['last_name'] ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <h5 class="mt-3">Approvals</h5>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="first_name">
                    <?= lang('Main.xin_approval_method');?>
                  </label>
                  <select class="form-control" name="method_multi_level" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_method');?>">
                    <option value="1" <?php if($_form['approval_method']==1):?> selected="selected" <?php endif; ?>>
                    <?= lang('Main.xin_approval_method_multi_level');?>
                    </option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="first_name">
                    <?= lang('Main.xin_approval_levels');?>
                  </label>
                  <select class="form-control approval_level_options" name="approval_levels" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_levels');?>">
                    <option value="">
                    <?= lang('Main.xin_approval_levels');?>
                    </option>
                    <option value="1" <?php if($_form['approval_levels']==1):?> selected="selected" <?php endif; ?>>
                    <?= lang('Main.xin_approval_level01');?>
                    </option>
                    <option value="2" <?php if($_form['approval_levels']==2):?> selected="selected" <?php endif; ?>>
                    <?= lang('Main.xin_approval_level02');?>
                    </option>
                    <option value="3" <?php if($_form['approval_levels']==3):?> selected="selected" <?php endif; ?>>
                    <?= lang('Main.xin_approval_level03');?>
                    </option>
                    <option value="4" <?php if($_form['approval_levels']==4):?> selected="selected" <?php endif; ?>>
                    <?= lang('Main.xin_approval_level04');?>
                    </option>
                    <option value="5" <?php if($_form['approval_levels']==5):?> selected="selected" <?php endif; ?>>
                    <?= lang('Main.xin_approval_level05');?>
                    </option>
                  </select>
                </div>
              </div>
            </div>
            <?php
				if($_form['approval_levels']==0):
					$leave_approval01 = 'style="display:none;"';
					$leave_approval02 = 'style="display:none;"';
					$leave_approval03 = 'style="display:none;"';
					$leave_approval04 = 'style="display:none;"';
					$leave_approval05 = 'style="display:none;"';
				elseif($_form['approval_levels']==1):
					$leave_approval01 = 'style="display:block;"';
					$leave_approval02 = 'style="display:none;"';
					$leave_approval03 = 'style="display:none;"';
					$leave_approval04 = 'style="display:none;"';
					$leave_approval05 = 'style="display:none;"';
				elseif($_form['approval_levels']==2):
					$leave_approval01 = 'style="display:block;"';
					$leave_approval02 = 'style="display:block;"';
					$leave_approval03 = 'style="display:none;"';
					$leave_approval04 = 'style="display:none;"';
					$leave_approval05 = 'style="display:none;"';
				elseif($_form['approval_levels']==3):
					$leave_approval01 = 'style="display:block;"';
					$leave_approval02 = 'style="display:block;"';
					$leave_approval03 = 'style="display:block;"';
					$leave_approval04 = 'style="display:none;"';
					$leave_approval05 = 'style="display:none;"';
				elseif($_form['approval_levels']==4):
					$leave_approval01 = 'style="display:block;"';
					$leave_approval02 = 'style="display:block;"';
					$leave_approval03 = 'style="display:block;"';
					$leave_approval04 = 'style="display:block;"';
					$leave_approval05 = 'style="display:none;"';
				elseif($_form['approval_levels']==5):
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
			?>
            <div class="row form-approval-level-default form-approval-level-one" <?= $leave_approval01;?>>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="first_name">
                    <?= lang('Main.xin_approval_level01');?>
                  </label>
                  <select class="form-control" name="approval_level01" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level01');?>">
                    <option value="">
                    <?= lang('Main.xin_approval_level01');?>
                    </option>
                    <?php foreach($staff_info as $staff) {?>
                    <option value="<?= $staff['user_id']?>" <?php if($_form['approval_level01']==$staff['user_id']):?> selected="selected" <?php endif;?>>
                    <?= $staff['first_name'].' '.$staff['last_name'] ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row form-approval-level-default form-approval-level-two" <?= $leave_approval02;?>>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="first_name">
                    <?= lang('Main.xin_approval_level02');?>
                  </label>
                  <select class="form-control" name="approval_level02" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level02');?>">
                    <option value="">
                    <?= lang('Main.xin_approval_level02');?>
                    </option>
                    <?php foreach($staff_info as $staff) {?>
                    <option value="<?= $staff['user_id']?>" <?php if($_form['approval_level02']==$staff['user_id']):?> selected="selected" <?php endif;?>>
                    <?= $staff['first_name'].' '.$staff['last_name'] ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row form-approval-level-default form-approval-level-three" <?= $leave_approval03;?>>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="first_name">
                    <?= lang('Main.xin_approval_level03');?>
                  </label>
                  <select class="form-control" name="approval_level03" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level03');?>">
                    <option value="">
                    <?= lang('Main.xin_approval_level03');?>
                    </option>
                    <?php foreach($staff_info as $staff) {?>
                    <option value="<?= $staff['user_id']?>" <?php if($_form['approval_level03']==$staff['user_id']):?> selected="selected" <?php endif;?>>
                    <?= $staff['first_name'].' '.$staff['last_name'] ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row form-approval-level-default form-approval-level-four" <?= $leave_approval04;?>>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="first_name">
                    <?= lang('Main.xin_approval_level04');?>
                  </label>
                  <select class="form-control" name="approval_level04" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level04');?>">
                    <option value="">
                    <?= lang('Main.xin_approval_level04');?>
                    </option>
                    <?php foreach($staff_info as $staff) {?>
                    <option value="<?= $staff['user_id']?>" <?php if($_form['approval_level04']==$staff['user_id']):?> selected="selected" <?php endif;?>>
                    <?= $staff['first_name'].' '.$staff['last_name'] ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row form-approval-level-default form-approval-level-five" <?= $leave_approval05;?>>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="first_name">
                    <?= lang('Main.xin_approval_level05');?>
                  </label>
                  <select class="form-control" name="approval_level05" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_approval_level05');?>">
                    <option value="">
                    <?= lang('Main.xin_approval_level05');?>
                    </option>
                    <?php foreach($staff_info as $staff) {?>
                    <option value="<?= $staff['user_id']?>" <?php if($_form['approval_level05']==$staff['user_id']):?> selected="selected" <?php endif;?>>
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
                    <option value="1" <?php if(1==$_form['skip_specific_approval']):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_yes');?>
                    </option>
                    <option value="0" <?php if(0==$_form['skip_specific_approval']):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_no');?>
                    </option>                    
                  </select>
                </div>
              </div>
            </div>
            <h5 class="mt-3">Form Access</h5>
            <div class="row">
              <div class="col-md-6">
              	<input type="hidden" value="0" name="assign_department[]" />
                <?php $iassign_department = explode(',',$_form['assign_departments']);?>
                <div class="form-group">
                  <label for="first_name">
                    <?= lang('Dashboard.left_department');?> 
                  </label>
                  <select class="form-control" multiple="multiple" name="assign_department[]" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.left_department');?>">
                    <option value="">
                    <?= lang('Dashboard.left_department');?>
                    </option>
                    <?php foreach($departments as $idepartment):?>
                  <option value="<?= $idepartment['department_id'];?>"  <?php if(in_array($idepartment['department_id'],$iassign_department)):?> selected="selected"<?php endif;?>>
                  <?= $idepartment['department_name'];?>
                  </option>
                  <?php endforeach;?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
              	<input type="hidden" value="0" name="assigned_to[]" />
                <div class="form-group">
                  <label for="first_name">
                    <?= lang('Main.xin_select_employees');?>
                  </label>
                  <select class="form-control" multiple="multiple" name="assigned_to[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_choose_an_employee');?>">
                    <option value="all" <?php if(in_array('all',$assigned_to)):?> selected="selected"<?php endif;?>>
                    <?= lang('Main.xin_form_show_for_all_employees');?>
                    </option>
                    <?php foreach($staff_info as $staff) {?>
                    <option value="<?= $staff['user_id']?>" <?php if(in_array($staff['user_id'],$assigned_to)):?> selected="selected"<?php endif;?>>
                    <?= $staff['first_name'].' '.$staff['last_name'] ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-edit" role="tabpanel" aria-labelledby="pills-edit-tab">
            <h5 class="mt-2">
              <?= lang('Main.xin_form_questions_fields');?>
            </h5>
            <hr />
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                	<?php $iv = 1; foreach($form_items as $item){?>
                  <div class="ci-item-values">
                    <div data-repeater-list="items">
                      <div data-repeater-item="">
                        <div class="row item-row">
                          <div class="form-group mb-1 col-sm-12 col-md-3">
                            <input type="hidden" name="item[<?php echo $item['form_field_id'];?>]" value="<?php echo $item['form_field_id'];?>" />
                            <label for="field_type">
                              <?= lang('Main.xin_field_type');?>
                            </label>
                            <br>
                            <select class="form-control form-control-sm" name="efield_type[<?= $item['form_field_id'];?>]" data-placeholder="<?= lang('Main.xin_field_type');?>">
                            <?php foreach($form_types as $type_key=>$type_value) {?>
                            <option value="<?= $type_key?>" <?php if($type_key==$item['field_type']):?> selected="selected"<?php endif;?>>
                            <?= $type_value ?>
                            </option>
                            <?php } ?>
                          </select>
                          </div>
                          <div class="form-group mb-1 col-sm-12 col-md-2">
                            <label for="qty_hrs" class="cursor-pointer">
                              <?= lang('Main.xin_field_name');?>
                            </label>
                            <br>
                            <input type="text" class="form-control form-control-sm" name="efield_name[<?= $item['form_field_id'];?>]" value="<?= $item['field_label'];?>">
                          </div>
                          <div class="form-group mb-1 col-sm-12 col-md-4">
                            <label for="qty_hrs" class="cursor-pointer">
                              <?= lang('Main.xin_field_options_list');?>
                            </label>
                            <br>
                            <input type="text" class="form-control form-control-sm" name="efield_options[<?= $item['form_field_id'];?>]" id="" value="<?= $item['field_key'];?>">
                          </div>
                          <div class="form-group mb-1 col-sm-12 col-md-1">
                            <label for="profession">
                              <?= lang('Main.xin_field_mandatory');?>
                            </label>
                            <select class="form-control form-control-sm" name="efield_mandatory[<?= $item['form_field_id'];?>]">
                            <option value="0" <?php if(0==$item['field_type']):?> selected="selected"<?php endif;?>><?= lang('Main.xin_no');?></option>
                            <option value="1" <?php if(1==$item['field_type']):?> selected="selected"<?php endif;?>><?= lang('Main.xin_yes');?></option>
                          </select>
                          </div>
                          <div class="form-group mb-1 col-sm-12 col-md-1">
                            <label for="qty_hrs" class="cursor-pointer">
                              <?= lang('Main.xin_field_order');?>
                            </label>
                            <br>
                            <input type="text" class="form-control form-control-sm" name="efield_order[<?= $item['form_field_id'];?>]" value="<?= $item['sort_order'];?>" size="2">
                          </div>
                          <div class="form-group col-sm-12 col-md-1 text-xs-center">
                            <label for="profession">&nbsp;</label>
                            <br>
                            <?php if($iv == 1):?>
                                <button type="button" disabled="disabled" class="btn icon-btn btn-sm btn-outline-secondary waves-effect waves-light" data-repeater-delete=""> <span class="fa fa-trash"></span></button>
                            <?php else:?>
                            <button type="button" class="btn icon-btn btn-sm btn-outline-danger waves-effect waves-light remove-invoice-item-ol" data-repeater-delete="" data-record-id="<?= uencode($item['form_field_id']);?>"> <span class="fa fa-trash"></span></button>
                            <?php endif;?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php $iv++;} ?>
                  
                  <div id="item-list"></div>
                  <div class="form-group overflow-hidden1">
                    <div class="col-xs-12">
                      <button type="button" data-repeater-create="" class="btn btn-sm btn-primary" id="add-invoice-item">
                      <?= lang('Main.xin_add_type');?>
                      </button>
                    </div>
                  </div>
                  <div class="form-group col-xs-12 mb-2 file-repeaters"> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer text-right btn-wrap">
        <button type="submit" class="btn btn-primary">
        <?= lang('Main.xin_form_update');?>
        </button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
<style type="text/css">
.form-group label {
    font-size: 13px;
}
</style>
