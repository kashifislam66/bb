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

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}
$staff_info = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->findAll();

$segment_id = $request->uri->getSegment(3);
$form_id = udecode($segment_id);
$iform = $FormsModel->where('company_id',$company_id)->where("forms_id",$form_id)->first();
//get form fields
$formfields = $FormsfieldModel->where('company_id',$company_id)->where("form_id",$form_id)->orderBy("sort_order","ASC")->findAll();
// list departments
$list_departments = $DepartmentModel->where('company_id',$company_id)->orderBy('department_id', 'ASC')->findAll();
// list designations
$list_designations = $DesignationModel->where('company_id',$company_id)->orderBy('designation_id', 'ASC')->findAll();
// list employees
$list_employees = $UsersModel->where('company_id', $company_id)->where('user_type','staff')->orderBy('user_id','ASC')->findAll();
// list projects
$list_projects = $ProjectsModel->where('company_id', $company_id)->orderBy('project_id', 'ASC')->findAll();
// list jobs
$list_jobs = $JobsModel->where('company_id', $company_id)->orderBy('job_id', 'ASC')->findAll();
// form types
$form_categories = array(1=>'Employee Forms',2=>'Performance Forms',3=>'Job Candidate Forms',4=>'Approval process set up',5=>'Training evaluation Forms',6=>'Employee exit Forms',7=>'External Forms');

?>

<!-- Builder Wrap -->

<div class="row m-b-1">
  <div class="col-md-8">
    <div class="card mb-2">
      <div class="card-header">
        <h5>
          <?= lang('Main.xin_form_view');?>
        </h5>
        <div class="card-header-right"> <a href="<?= site_url('erp/forms-builder');?>" class="btn waves-effect waves-light btn-primary btn-sm m-0"> <i class="material-icons-two-tone f-18 text-white">ballot</i>
      <?= lang('Main.xin_forms_builder');?>
      </a> </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="form_name">
                <?= lang('Main.xin_form_name');?>
                </label><br />
                <?= $iform['form_name'];?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="form_name">
                <?= lang('Main.xin_form_categories');?>
                </label><br />
                <?php foreach($form_categories as $category_key=>$cat_value) {?>
				<?php if($category_key==$iform['category_id']):?> <?= $cat_value ?><?php endif;?>
                <?php } ?>
            </div>
          </div>
        </div>
        <h5><?= lang('Main.xin_form_questions_fields');?></h5>
        <hr />
        <?php foreach($formfields as $form_field){ ?>
        <?php
			if($form_field['is_mandatory']==1){
				$mandatory = '<span class="text-danger">*</span>';
			} else {
				$mandatory = '';
			}
        ?>
        <?php // 1: textbox: input single field
        if($form_field['field_type']==1){ ?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="form_name">
                <?= $form_field['field_label'];?>
                <?= $mandatory;?> </label>
                <input type="text" class="form-control" name="text_field" placeholder="<?= $form_field['field_label'];?>">
            </div>
          </div>
        </div> 
        <?php } ?>
        <?php // 2: List box : selection
        if($form_field['field_type']==2){ ?>
        <?php $select_options = explode(',',$form_field['field_key']);?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="form_name">
                <?= $form_field['field_label'];?>
                <?= $mandatory;?> </label>
                <select class="form-control" data-plugin="select_hrm" name="listbox" data-placeholder="<?= $form_field['field_label'];?>">
				<?php foreach($select_options as $soptions) {?>
                <option value="<?= $soptions?>">
                <?= $soptions ?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div> 
        <?php } ?>
        <?php // 2: Check Box : multi select checkboxes
        if($form_field['field_type']==3){ ?>
        <?php $checkbox_options = explode(',',$form_field['field_key']);?>
        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
              <label for="form_name">
                <?= $form_field['field_label'];?>
                <?= $mandatory;?> </label><br />
                <?php $ci=0;foreach($checkbox_options as $coptions) {?>
          		<div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="checkbox_group" value="<?= $coptions?>" id="checkbox_<?= $ci?>">
                    <label class="form-check-label" for="checkbox_<?= $ci?>">
                        <?= $coptions?>
                    </label>
                </div>
             <?php $ci++;} ?>
          </div>
        </div> 
        </div>
        <?php } ?>
        <?php // 4: date:textbox: date single field
        if($form_field['field_type']==4){ ?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="form_name">
                <?= $form_field['field_label'];?>
                <?= $mandatory;?> </label>
                <input type="text" class="form-control date" placeholder="<?= $form_field['field_label'];?>">
            </div>
          </div>
        </div> 
        <?php } ?>
        <?php // 5: text area: long description
        if($form_field['field_type']==5){ ?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="form_name">
                <?= $form_field['field_label'];?>
                <?= $mandatory;?> </label>
                <textarea class="form-control" name="textarea_field" placeholder="<?= $form_field['field_label'];?>" cols="30" rows="3"></textarea>
            </div>
          </div>
        </div> 
        <?php } ?>
		<?php // 6: time:textbox: date single field
        if($form_field['field_type']==6){ ?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="form_name">
                <?= $form_field['field_label'];?>
                <?= $mandatory;?> </label>
                <input type="text" class="form-control timepicker" name="timefield" placeholder="<?= $form_field['field_label'];?>">
            </div>
          </div>
        </div> 
        <?php } ?>
        <?php // 7: Radio Box : multi select radio options
        if($form_field['field_type']==7){ ?>
        <?php $radio_options = explode(',',$form_field['field_key']);?>
        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
              <label for="form_name">
                <?= $form_field['field_label'];?>
                <?= $mandatory;?> </label><br />
                <?php $ri=0;foreach($radio_options as $roptions) {?>
          		<div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="radio_group" value="<?= $roptions?>" id="checkradio_<?= $ri;?>">
                    <label class="form-check-label" for="checkradio_<?= $ri;?>">
                        <?= $roptions?>
                    </label>
                </div>
             <?php $ri++;} ?>
          </div>
        </div> 
        </div>
        <?php } ?>
        <?php // 8: List box : list of departments
        if($form_field['field_type']==8){ ?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="form_name">
                <?= $form_field['field_label'];?>
                <?= $mandatory;?> </label>
                <select class="form-control" name="department_id" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.left_department');?>">
                <option value="">
                <?= lang('Dashboard.left_department');?>
                </option>
                <?php foreach($list_departments as $idepartment):?>
                <option value="<?= $idepartment['department_id'];?>">
                <?= $idepartment['department_name'];?>
                </option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
        </div> 
        <?php } ?>
        <?php // 9: List box : list of employees
        if($form_field['field_type']==9){ ?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="form_name">
                <?= $form_field['field_label'];?>
                <?= $mandatory;?> </label>
                <select class="form-control" name="staff_id" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_choose_an_employee');?>">
                <option value="">
                <?= lang('Main.xin_choose_an_employee');?>
                </option>
                <?php foreach($list_employees as $istaff) {?>
                <option value="<?= $istaff['user_id']?>">
                <?= $istaff['first_name'].' '.$istaff['last_name'] ?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div> 
        <?php } ?>
        <?php // 10: List box : list of projects
        if($form_field['field_type']==10){ ?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="form_name">
                <?= $form_field['field_label'];?>
                <?= $mandatory;?> </label>
                <select class="form-control" name="project_id" data-plugin="select_hrm" data-placeholder="<?= lang('Projects.xin_project');?>">
                <option value="">
                <?= lang('Projects.xin_project');?>
                </option>
                <?php foreach($list_projects as $iprojects) {?>
                <option value="<?= $iprojects['project_id']?>">
                <?= $iprojects['title'] ?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div> 
        <?php } ?>
        <?php // 11: List box : list of designataions
        if($form_field['field_type']==11){ ?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="form_name">
                <?= $form_field['field_label'];?>
                <?= $mandatory;?> </label>
                <select class="form-control" name="designation_id" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.left_designation');?>">
                <option value="">
                <?= lang('Dashboard.left_designation');?>
                </option>
                <?php foreach($list_designations as $idesignation):?>
                <option value="<?= $idesignation['designation_id'];?>">
                <?= $idesignation['designation_name'];?>
                </option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
        </div> 
        <?php } ?>
        <?php // 11: List box : list of jobs post
        if($form_field['field_type']==12){ ?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="form_name">
                <?= $form_field['field_label'];?>
                <?= $mandatory;?> </label>
                <select class="form-control" name="job_id" data-plugin="select_hrm" data-placeholder="<?= lang('Recruitment.xin_jobs_list');?>">
                <option value="">
                <?= lang('Recruitment.xin_jobs_list');?>
                </option>
                <?php foreach($list_jobs as $ijob):?>
                <option value="<?= $ijob['job_id'];?>">
                <?= $ijob['job_title'];?>
                </option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
        </div> 
        <?php } ?>        
       <?php } ?>  
       <?php if($iform['is_allow_attachment']==1){ ?>
       <?php
       		if($iform['is_attachment_mandatory']==1){
				$is_mandatory = 'required';
				$imandatory = '<span class="text-danger">*</span>';
			} else {
				$is_mandatory = '';
				$imandatory = '';
			}
		?>
       <div class="row">
          <div class="col-md-12">
           <div class="form-group">
           		<label for="form_name">
                <?= lang('Main.xin_attachment');?>
                <?= $imandatory;?> </label>
                <input type="file" <?= $is_mandatory;?> class="form-control">
            </div>
         </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<style type="text/css">
.build-wrap .form-actions {display:none !important;}
</style>
