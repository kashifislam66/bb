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

$segment_id = $request->uri->getSegment(3);
$form_id = udecode($segment_id);
$formfield = $FormsModel->where('company_id',$company_id)->where("forms_id",$form_id)->first();
$assigned_to = explode(',',$formfield['assigned_to']);
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
                <button type="button" class="btn-shadow btn btn-outline-primary text-uppercase">
                <?= lang('Main.xin_form_settings');?></button>
                </a> </li>
            <li class="nav-item m-r-5"> <a href="#pills-edit" data-toggle="tab" aria-expanded="false" class="">
                <button type="button" class="btn-shadow btn btn-outline-primary text-uppercase">
                <?= lang('Main.xin_form_questions_fields');?></button>
                </a> </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-overview" role="tabpanel" aria-labelledby="pills-overview-tab">
            	<div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="form_name">
                        <?= lang('Main.xin_form_name');?>
                        <span class="text-danger">*</span> </label>
                      <div class="input-group"> <span class="input-group-text"><i class="fab fa-wpforms"></i></span>
                        <input type="text" class="form-control" placeholder="<?= lang('Main.xin_form_name');?>" name="form_name" value="<?= $formfield['form_name'];?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_form_categories');?> <span class="text-danger">*</span>
                      </label>
                      <select class="form-control" name="form_category" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_form_categories');?>">
                        <option value="">
                        <?= lang('Main.xin_form_categories');?>
                        </option>
                        <?php foreach($form_categories as $category_key=>$cat_value) {?>
                        <option value="<?= $category_key?>" <?php if($category_key==$formfield['category_id']):?> selected="selected"<?php endif;?>>
                        <?= $cat_value ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-5">
                  	<input type="hidden" value="0" name="assigned_to[]" />
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_form_show_for_all');?>
                        <span class="text-danger">*</span> </label>
                      <select class="form-control" required multiple="multiple" name="assigned_to[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_choose_an_employee');?>">
                        <option value="all" <?php if(in_array('all',$assigned_to)):?> selected="selected"<?php endif;?>>
                        <?= lang('Main.xin_form_show_for_all_employees');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if(in_array($staff['user_id'],$assigned_to)):?> selected="selected"<?php endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                      <small>
                      <?= lang('Main.xin_form_show_for_all_text');?>
                      </small> </div>
                  </div>
                </div>
                <div class="row"> 
              	<div class="col-md-5">
                  <div class="form-group">
                  <div class="form-check form-switch custom-switch-v1">
                        <input type="checkbox" class="form-check-input input-light-success" id="allow_attachment_1" name="is_allow_attachment" <?php if($formfield['is_allow_attachment']==1):?> checked="checked"<?php endif;?> value="1">
                        <label class="form-check-label" for="allow_attachment_1"><?= lang('Main.xin_allow_attachment');?></label>
                    </div>
                  </div>  
                </div> 
              </div>  
              <div class="row"> 
              	<div class="col-md-5">
                  <div class="form-group">
                  <div class="form-check form-switch custom-switch-v1">
                        <input type="checkbox" class="form-check-input input-light-success" id="allow_attachment_mandatory_1" name="is_attachment_mandatory" <?php if($formfield['is_attachment_mandatory']==1):?> checked="checked"<?php endif;?> value="1">
                        <label class="form-check-label" for="allow_attachment_mandatory_1"><?= lang('Main.xin_allow_attachment_mandatory');?></label>
                    </div>
                  </div>  
                </div> 
              </div>  
              <div class="row"> 
              	<div class="col-md-5">
                  <div class="form-group">
                  <div class="form-check form-switch custom-switch-v1">
                        <input type="checkbox" class="form-check-input input-light-success allow_supervisor_1" id="allow_supervisor_1" value="1" name="is_allow_supervisor" <?php if($formfield['is_allow_supervisor']==1):?> checked="checked"<?php endif;?>>
                        <label class="form-check-label" for="allow_supervisor_1"><?= lang('Main.xin_allow_supervisor');?></label>
                        <br /><small><?= lang('Main.xin_form_assign_to_info_auto');?></small>
                    </div>
                  </div>  
                </div> 
              </div>  
              <?php if($formfield['is_allow_supervisor']==1): $check_sup_option = 'style="display:block;"'; else: $check_sup_option = 'style="display:none;"'; endif;?>
              <div class="row show-supervisor" <?= $check_sup_option;?>> 
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="first_name">
                        <?= lang('Main.xin_form_assign_to');?>
                        <span class="text-danger">*</span> </label>
                      <select class="form-control" name="supervisor_id" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_choose_an_employee');?>">
                        <option value="">
                        <?= lang('Main.xin_choose_an_employee');?>
                        </option>
                        <?php foreach($staff_info as $staff) {?>
                        <option value="<?= $staff['user_id']?>" <?php if($formfield['supervisor_id']==$staff['user_id']):?> selected="selected"<?php endif;?>>
                        <?= $staff['first_name'].' '.$staff['last_name'] ?>
                        </option>
                        <?php } ?>
                      </select>
                      <small>
                      <?= lang('Main.xin_form_assign_to_info');?>
                      </small>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane fade" id="pills-edit" role="tabpanel" aria-labelledby="pills-edit-tab">
            <h5 class="mt-2"><?= lang('Main.xin_form_questions_fields');?></h5>
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
