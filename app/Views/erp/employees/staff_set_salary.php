<?php
use CodeIgniter\I18n\Time;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\ShiftModel;
use App\Models\SystemModel;
use App\Models\CountryModel;
use App\Models\LanguageModel;
use App\Models\ConstantsModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\StaffdetailsModel;
use App\Models\StaffaccountsModel;
use App\Models\CompanysettingsModel;
use CodeIgniter\HTTP\RequestInterface;
//$encrypter = \Config\Services::encrypter();
$ShiftModel = new ShiftModel();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$CountryModel = new CountryModel();
$LanguageModel = new LanguageModel();
$ConstantsModel = new ConstantsModel();
$DepartmentModel = new DepartmentModel();
$DesignationModel = new DesignationModel();
$StaffdetailsModel = new StaffdetailsModel();
$StaffaccountsModel = new StaffaccountsModel();
$CompanysettingsModel = new CompanysettingsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
///
$segment_id = $request->uri->getSegment(3);
$user_id = udecode($segment_id);
$result = $UsersModel->where('user_id', $user_id)->first();
$employee_detail = $StaffdetailsModel->where('user_id', $result['user_id'])->first();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$departments = $DepartmentModel->where('company_id',$user_info['company_id'])->orderBy('department_id', 'ASC')->findAll();
	$designations = $DesignationModel->where('company_id',$user_info['company_id'])->where('department_id',$employee_detail['department_id'])->orderBy('designation_id', 'ASC')->findAll();
	$office_shifts = $ShiftModel->where('company_id',$user_info['company_id'])->orderBy('office_shift_id', 'ASC')->findAll();
	$leave_types = $ConstantsModel->where('company_id',$user_info['company_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
	$roles = $RolesModel->where('company_id',$user_info['company_id'])->orderBy('role_id', 'ASC')->findAll();
	$staff_accounts = $StaffaccountsModel->where('company_id',$user_info['company_id'])->orderBy('account_id', 'ASC')->findAll();
	$com_lang = $CompanysettingsModel->where('company_id', $user_info['company_id'])->first();
	$setup_languages = unserialize($com_lang['setup_languages']);
	$staff_info = $UsersModel->where('company_id', $user_info['company_id'])->where('user_type','staff')->findAll();
	$company_id = $user_info['company_id'];
} else {
	$departments = $DepartmentModel->where('company_id',$usession['sup_user_id'])->orderBy('department_id', 'ASC')->findAll();
	$designations = $DesignationModel->where('company_id',$usession['sup_user_id'])->orderBy('designation_id', 'ASC')->findAll();
	$office_shifts = $ShiftModel->where('company_id',$usession['sup_user_id'])->orderBy('office_shift_id', 'ASC')->findAll();
	$leave_types = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
	$roles = $RolesModel->where('company_id',$usession['sup_user_id'])->orderBy('role_id', 'ASC')->findAll();
	$staff_accounts = $StaffaccountsModel->where('company_id',$usession['sup_user_id'])->orderBy('account_id', 'ASC')->findAll();
	$com_lang = $CompanysettingsModel->where('company_id', $usession['sup_user_id'])->first();
	$setup_languages = unserialize($com_lang['setup_languages']);
	$staff_info = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->findAll();
	$company_id = $usession['sup_user_id'];
}

$all_countries = $CountryModel->orderBy('country_id', 'ASC')->findAll();
$religion = $ConstantsModel->where('type','religion')->orderBy('constants_id', 'ASC')->findAll();

$selected_shift = $ShiftModel->where('office_shift_id', $employee_detail['office_shift_id'])->first();
$xin_system = erp_company_settings();
// department head
//$idepartment = $DepartmentModel->where('department_id',$employee_detail['department_id'])->first();
$rep_user = $UsersModel->where('user_id', $employee_detail['reporting_manager'])->first();
if($rep_user) {
	$rep_username = $rep_user['first_name'].' '.$rep_user['last_name'];
	//level2
	$rep_username2 = $StaffdetailsModel->where('user_id', $rep_user['user_id'])->first();
	$rep_user2 = $UsersModel->where('user_id', $rep_username2['reporting_manager'])->first();
	if($rep_user2){
		$rep_username22 = $rep_user2['first_name'].' '.$rep_user2['last_name'];
		//level3
		$rep_username3 = $StaffdetailsModel->where('user_id', $rep_user2['user_id'])->first();
		$rep_user3 = $UsersModel->where('user_id', $rep_username3['reporting_manager'])->first();
		if($rep_user3){
			$rep_username33 = $rep_user3['first_name'].' '.$rep_user3['last_name'];
		} else {
			$rep_username33 = lang('Main.xin_no_reporting_manager');
		}
	} else {
		$rep_username22 = lang('Main.xin_no_reporting_manager');
		$rep_username33 = lang('Main.xin_no_reporting_manager');
	}
	
} else {
	$rep_username = lang('Main.xin_no_reporting_manager');
	$rep_username22 = lang('Main.xin_no_reporting_manager');
	$rep_username33 = lang('Main.xin_no_reporting_manager');
}
// user designation
$idesignations = $DesignationModel->where('designation_id',$employee_detail['designation_id'])->first();
if($idesignations) {
	$designation_name = $idesignations['designation_name'];
} else {
	$designation_name = '--';
}
$get_animate = '';
$approval_levels_ids = unserialize($employee_detail['approval_levels']);
$all_staff_info = $UsersModel->where('company_id', $company_id)->where('user_type', 'staff')->where('user_id !=', $user_id)->orderBy('user_id','ASC')->findAll();
?>
<?php if($result['is_active']=='0'): $_status = '<span class="badge badge-light-danger">'.lang('Main.xin_employees_inactive').'</span>'; endif; ?>
<?php if($result['is_active']=='1'): $_status = '<span class="badge badge-light-success">'.lang('Main.xin_employees_active').'</span>'; endif; ?>

<div class="row"> 
  <!-- [] start -->
  <div class="col-lg-4">
    <div class="card user-card user-card-1">
      <div class="card-body pb-0">
        <div class="float-right">
          <?= $_status?>
        </div>
        <div class="media user-about-block align-items-center mt-0 mb-3">
          <div class="position-relative d-inline-block"> <img class="img-radius img-fluid wid-80" src="<?= staff_profile_photo($user_id);?>" alt="<?= $result['first_name'].' '.$result['last_name']; ?>">
            <div class="certificated-badge"> <i class="fas fa-certificate text-primary bg-icon"></i> <i class="fas fa-check front-icon text-white"></i> </div>
          </div>
          <div class="media-body ml-3">
            <h6 class="mb-1">
              <?= $result['first_name'].' '.$result['last_name']; ?>
            </h6>
            <p class="mb-0 text-muted">
              <?= $designation_name;?>
            </p>
          </div>
        </div>
      </div>
      <ul class="list-group list-group-flush mb-3">
        <li class="list-group-item"> <span class="f-w-500"><i class="feather icon-user m-r-10"></i>
          <?= lang('Employees.xin_manager');?>
          <i class="fas fa-question-circle" data-toggle="tooltip" title="<?= lang('Main.xin_reporting_manager');?>"></i></span> <a href="#" class="float-right text-body">
          <?= $rep_username; ?>
          </a> </li>
        <li class="list-group-item border-bottom-0"> <span class="f-w-500"><i class="feather icon-mail m-r-10"></i>
          <?= lang('Main.xin_email');?>
          </span> <span class="float-right">
          <?= $result['email'];?>
          </span> </li>
      </ul>
      <div class="nav flex-column nav-pills list-group list-group-flush list-pills" id="user-set-tab" role="tablist" aria-orientation="vertical">
        <?php if(in_array('staff4',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
        <a class="nav-link list-group-item list-group-item-action active" id="user-set-salary-tab" data-toggle="pill" href="#user-set-salary" role="tab" aria-controls="user-set-salary" aria-selected="false"> <span class="f-w-500"><i class="feather icon-credit-card m-r-10 h5 "></i>
        <?= lang('Main.xin_set_salary_and_contract');?>
        </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a>
        <?php } ?>
        <?php if($xin_system['is_enable_ml_payroll']==1){ ?>
        <a class="nav-link list-group-item list-group-item-action" id="user-set-malaysia-salary-tab" data-toggle="pill" href="#user-set-malaysia-salary" role="tab" aria-controls="user-set-malaysia-salary" aria-selected="false"> <span class="f-w-500"><i class="feather icon-edit m-r-10 h5 "></i>
        <?= lang('Main.xin_salary_calculator_malaysia');?>
        </span> <span class="float-right"><i class="feather icon-chevron-right"></i></span> </a>
        <?php } ?>
      </div>
    </div>
  </div>
  <input type="hidden" id="user_id" value="<?= udecode($segment_id);?>" />
  <div class="col-lg-8">
    <div class="tab-content" id="user-set-tabContent">
      <?php if(in_array('staff4',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
      <div class="tab-pane fade active show" id="user-set-salary" role="tabpanel" aria-labelledby="user-set-salary-tab">
        <div class="alert alert-info alert-dismissible" role="alert">
          <h5 class="alert-heading"><i class="feather icon-alert-circle mr-2"></i>
            <?= lang('Main.xin_set_employee_salary_contract');?>
          </h5>
          <p class="mb-0">
            <?= lang('Employees.xin_define_salary_options');?>
          </p>
        </div>
        <div class="card">
          <div class="card-header">
            <h5><i data-feather="credit-card" class="icon-svg-primary wid-20"></i><span class="p-l-5">
              <?= lang('Main.xin_set_salary');?>
              </span></h5>
          </div>
          <div class="card-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item"> <a class="nav-link active" id="pills-contract-tab" data-toggle="pill" href="#pills-contract" role="tab" aria-controls="pills-contract" aria-selected="true">
                <?= lang('Employees.xin_contract');?>
                </a> </li>
              <li class="nav-item"> <a class="nav-link" id="pills-allowances-tab" data-toggle="pill" href="#pills-allowances" role="tab" aria-controls="pills-allowances" aria-selected="false">
                <?= lang('Employees.xin_allowances');?>
                </a> </li>
              <li class="nav-item"> <a class="nav-link" id="pills-commissions-tab" data-toggle="pill" href="#pills-commissions" role="tab" aria-controls="pills-commissions" aria-selected="false">
                <?= lang('Employees.xin_commissions');?>
                </a> </li>
              <li class="nav-item"> <a class="nav-link" id="pills-statutory-tab" data-toggle="pill" href="#pills-statutory" role="tab" aria-controls="pills-statutory" aria-selected="false">
                <?= lang('Employees.xin_satatutory_deductions');?>
                </a> </li>
              <li class="nav-item"> <a class="nav-link" id="pills-reimbursements-tab" data-toggle="pill" href="#pills-reimbursements" role="tab" aria-controls="pills-reimbursements" aria-selected="false">
                <?= lang('Employees.xin_reimbursements');?>
                </a> </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade active show" id="pills-contract" role="tabpanel" aria-labelledby="pills-contract-tab">
                <?php $attributes = array('name' => 'update_contract', 'id' => 'update_contract', 'autocomplete' => 'off');?>
                <?php $hidden = array('token' => $segment_id);?>
                <?= form_open('erp/employees/update_contract_info', $attributes, $hidden);?>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label>
                          <?= lang('Employees.xin_contract_date');?>
                          <span class="text-danger">*</span></label>
                        <div class="input-group">
                          <input type="text" class="form-control date" name="contract_date" placeholder="<?= lang('Employees.xin_contract_date');?>" value="<?= $employee_detail['date_of_joining'];?>">
                          <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <label for="membership_type">
                          <?= lang('Main.xin_ci_default_language');?>
                          <span class="text-danger">*</span> </label>
                        <select class="form-control" name="default_language" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_ci_default_language');?>">
                            <?php foreach($setup_languages as $lang):?>
                            <?php $lang_code = $LanguageModel->where('language_code', $lang)->first(); ?>
                            <option value="<?= $lang_code['language_code'];?>" <?php if($employee_detail['default_language']==$lang_code['language_code']){?> selected <?php }?>>
                            <?= $lang_code['language_name'];?>
                            </option>
                            <?php endforeach;?>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="department">
                          <?= lang('Dashboard.left_department');?> <span class="text-danger">*</span>
                        </label>
                        
                        <select class="form-control" name="department_id" id="department_id" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.left_department');?>">
                          <option value="">
                          <?= lang('Dashboard.left_department');?>
                          </option>
                          <?php foreach($departments as $idepartment):?>
                          <option value="<?= $idepartment['department_id'];?>" <?php if($employee_detail['department_id']==$idepartment['department_id']):?> selected="selected"<?php endif;?>>
                          <?= $idepartment['department_name'];?>
                          </option>
                          <?php endforeach;?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6" id="designation_ajax">
                      <div class="form-group">
                        <label for="designation">
                          <?= lang('Dashboard.left_designation');?>
                        </label>
                        <span class="text-danger">*</span>
                        <select class="form-control" name="designation_id" data-plugin="select_hrm" data-placeholder="<?= lang('Dashboard.left_designation');?>">
                          <?php foreach($designations as $idesignation):?>
                          <option value="<?= $idesignation['designation_id'];?>" <?php if($employee_detail['designation_id']==$idesignation['designation_id']):?> selected="selected"<?php endif;?>>
                          <?= $idesignation['designation_name'];?>
                          </option>
                          <?php endforeach;?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>
                          <?= lang('Employees.xin_basic_salary');?>
                          <span class="text-danger">*</span></label>
                        <div class="input-group">
                          <div class="input-group-prepend"><span class="input-group-text">
                            <?= $xin_system['default_currency'];?>
                            </span></div>
                          <input type="text" class="form-control" name="basic_salary" placeholder="<?= lang('Employees.xin_gross_salary');?>" value="<?= $employee_detail['basic_salary'];?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>
                          <?= lang('Employees.xin_hourly_rate');?>
                          </label>
                        <div class="input-group">
                          <div class="input-group-prepend"><span class="input-group-text">
                            <?= $xin_system['default_currency'];?>
                            </span></div>
                          <input type="text" class="form-control" name="hourly_rate" placeholder="<?= lang('Employees.xin_hourly_rate');?>" value="<?= $employee_detail['hourly_rate'];?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="salay_type">
                          <?= lang('Employees.xin_employee_type_wages');?>
                          <i class="text-danger">*</i></label>
                        <select name="salay_type" id="salay_type" class="form-control" data-plugin="select_hrm">
                          <option value="1" <?php if($employee_detail['salay_type']==1):?> selected="selected"<?php endif;?>>
                          <?= lang('Membership.xin_per_month');?>
                          </option>
                          <option value="2" <?php if($employee_detail['salay_type']==2):?> selected="selected"<?php endif;?>>
                          <?= lang('Membership.xin_per_hour');?>
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="office_shift_id" class="control-label">
                          <?= lang('Employees.xin_employee_office_shift');?>
                        </label>
                        <span class="text-danger">*</span>
                        <select class="form-control" name="office_shift_id" data-plugin="select_hrm" data-placeholder="<?= lang('Employees.xin_employee_office_shift');?>">
                          <option value="">
                          <?= lang('Employees.xin_employee_office_shift');?>
                          </option>
                          <?php foreach($office_shifts as $ioffice_shift):?>
                          <option value="<?= $ioffice_shift['office_shift_id'];?>" <?php if($employee_detail['office_shift_id']==$ioffice_shift['office_shift_id']):?> selected="selected"<?php endif;?>>
                          <?= $ioffice_shift['shift_name'];?>
                          </option>
                          <?php endforeach;?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="salay_type">
                          <?= lang('Employees.xin_contract_end');?>
                          <i class="text-danger">*</i></label>
                        <select name="is_contract_end" id="is_contract_end" class="form-control" data-plugin="select_hrm">
                          <option value="1" <?php if($employee_detail['contract_end']==1):?> selected="selected"<?php endif;?>>
                          <?= lang('Main.xin_yes');?>
                          </option>
                         <option value="0" <?php if($employee_detail['contract_end']==0):?> selected="selected"<?php endif;?>>
                          <?= lang('Main.xin_no');?>
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>
                          <?= lang('Main.xin_contract_end_date');?>
                        </label>
                        <div class="input-group">
                          <input type="text" class="form-control date" name="contract_end" placeholder="<?= lang('Main.xin_contract_end_date');?>" value="<?= $employee_detail['date_of_leaving'];?>">
                          <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="salay_type">
                          <?= lang('Main.xin_job_type');?>
                          <i class="text-danger">*</i></label>
                        <select name="job_type" class="form-control" data-plugin="select_hrm">
                          <option value="1" <?php if($employee_detail['job_type']==1):?> selected="selected"<?php endif;?>>
                          <?= lang('Main.xin_permanent');?>
                          </option>
                         <option value="0" <?php if($employee_detail['job_type']==0):?> selected="selected"<?php endif;?>>
                          <?= lang('Main.xin_part_time');?>
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                  <div class="form-group">
                    <label for="first_name">
                      <?= lang('Main.xin_reporting_manager');?>
                    </label>
                    <select class="form-control" name="reporting_manager" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_choose_an_employee');?>">
                      
                        <option value="0">
						<?= lang('Main.xin_no_reporting_manager');?>
                        </option>
                      <?php foreach($staff_info as $staff) {?>
						  <?php if($staff['user_id']!=$user_id){?>
                          <option value="<?= $staff['user_id']?>" <?php if($employee_detail['reporting_manager']==$staff['user_id']):?> selected="selected"<?php endif;?>>
                          <?= $staff['first_name'].' '.$staff['last_name'] ?>
                          </option>
                          <?php } ?>
                      <?php } ?>
                      <option value="-1">
						<?= lang('Main.xin_not_part_of_org');?>
                        </option>
                    </select>
                  </div>
                </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>
                          <?= lang('Employees.xin_role_description');?>
                          <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="role_description"><?= $employee_detail['role_description'];?>
</textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-primary">
                  <?= lang('Employees.xin_update_contract');?>
                  </button>
                </div>
                <?= form_close(); ?>
              </div>
              <div class="tab-pane fade" id="pills-allowances" role="tabpanel" aria-labelledby="pills-allowances-tab">
                <div class="card-body user-profile-list">
                  <h5 class="mt-1 mb-3 pb-3 border-bottom">
                    <?= lang('Main.xin_list_all');?>
                    <?= lang('Employees.xin_allowances');?>
                  </h5>
                  <div class="box-datatable table-responsive">
                    <table class="table table-striped table-bordered dataTable" id="xin_table_all_allowances" style="width:100%;">
                      <thead>
                        <tr>
                          <th><?= lang('Dashboard.xin_title');?></th>
                          <th><?= lang('Invoices.xin_amount');?></th>
                          <th><?= lang('Employees.xin_allowance_option');?></th>
                          <th><?= lang('Employees.xin_amount_option');?></th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
                <?php $attributes = array('name' => 'user_allowance', 'id' => 'user_allowance', 'autocomplete' => 'off');?>
                <?php $hidden = array('token' => $segment_id);?>
                <?= form_open('erp/employees/add_allowance', $attributes, $hidden);?>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="is_allowance_taxable">
                          <?= lang('Employees.xin_allowance_option');?>
                          <span class="text-danger">*</span></label>
                        <select name="contract_tax_option" class="form-control" data-plugin="select_hrm">
                          <option value="1">
                          <?= lang('Employees.xin_salary_allowance_non_taxable');?>
                          </option>
                          <option value="2">
                          <?= lang('Employees.xin_fully_taxable');?>
                          </option>
                          <option value="3">
                          <?= lang('Employees.xin_partially_taxable');?>
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="amount_option">
                          <?= lang('Employees.xin_amount_option');?>
                          <span class="text-danger">*</span></label>
                        <select name="is_fixed" class="form-control" data-plugin="select_hrm">
                          <option value="1">
                          <?= lang('Employees.xin_title_tax_fixed');?>
                          </option>
                          <option value="2">
                          <?= lang('Employees.xin_title_tax_percent');?>
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="account_title">
                          <?= lang('Dashboard.xin_title');?>
                          <span class="text-danger">*</span></label>
                        <input class="form-control" placeholder="<?= lang('Dashboard.xin_title');?>" name="option_title" type="text">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="account_number">
                          <?= lang('Invoices.xin_amount');?>
                          <span class="text-danger">*</span></label>
                        <div class="input-group">
                          <div class="input-group-prepend"><span class="input-group-text">
                            <?= $xin_system['default_currency'];?>
                            </span></div>
                          <input class="form-control" placeholder="<?= lang('Invoices.xin_amount');?>" name="contract_amount" type="text">
                        </div>
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
              <div class="tab-pane fade" id="pills-commissions" role="tabpanel" aria-labelledby="pills-commissions-tab">
                <div class="card-body user-profile-list">
                  <h5 class="mt-1 mb-3 pb-3 border-bottom">
                    <?= lang('Main.xin_list_all');?>
                    <?= lang('Employees.xin_commissions');?>
                  </h5>
                  <div class="box-datatable table-responsive">
                    <table class="table table-striped table-bordered dataTable" id="xin_table_all_commissions" style="width:100%;">
                      <thead>
                        <tr>
                          <th><?= lang('Dashboard.xin_title');?></th>
                          <th><?= lang('Invoices.xin_amount');?></th>
                          <th><?= lang('Employees.xin_salary_commission_options');?></th>
                          <th><?= lang('Employees.xin_amount_option');?></th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
                <?php $attributes = array('name' => 'user_commissions', 'id' => 'user_commissions', 'autocomplete' => 'off');?>
                <?php $hidden = array('token' => $segment_id);?>
                <?= form_open('erp/employees/add_commissions', $attributes, $hidden);?>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="is_allowance_taxable">
                          <?= lang('Employees.xin_salary_commission_options');?>
                          <span class="text-danger">*</span></label>
                        <select name="contract_tax_option" class="form-control" data-plugin="select_hrm">
                          <option value="1">
                          <?= lang('Employees.xin_salary_allowance_non_taxable');?>
                          </option>
                          <option value="2">
                          <?= lang('Employees.xin_fully_taxable');?>
                          </option>
                          <option value="3">
                          <?= lang('Employees.xin_partially_taxable');?>
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="amount_option">
                          <?= lang('Employees.xin_amount_option');?>
                          <span class="text-danger">*</span></label>
                        <select name="is_fixed" class="form-control" data-plugin="select_hrm">
                          <option value="1">
                          <?= lang('Employees.xin_title_tax_fixed');?>
                          </option>
                          <option value="2">
                          <?= lang('Employees.xin_title_tax_percent');?>
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="account_title">
                          <?= lang('Dashboard.xin_title');?>
                          <span class="text-danger">*</span></label>
                        <input class="form-control" placeholder="<?= lang('Dashboard.xin_title');?>" name="option_title" type="text">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="account_number">
                          <?= lang('Invoices.xin_amount');?>
                          <span class="text-danger">*</span></label>
                        <div class="input-group">
                          <div class="input-group-prepend"><span class="input-group-text">
                            <?= $xin_system['default_currency'];?>
                            </span></div>
                          <input class="form-control" placeholder="<?= lang('Invoices.xin_amount');?>" name="contract_amount" type="text">
                        </div>
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
              <div class="tab-pane fade" id="pills-statutory" role="tabpanel" aria-labelledby="pills-statutory-tab">
                <div class="card-body user-profile-list">
                  <h5 class="mt-1 mb-3 pb-3 border-bottom">
                    <?= lang('Main.xin_list_all');?>
                    <?= lang('Employees.xin_satatutory_deductions');?>
                  </h5>
                  <div class="box-datatable table-responsive">
                    <table class="table table-striped table-bordered dataTable" id="xin_table_all_statutory_deductions" style="width:100%;">
                      <thead>
                        <tr>
                          <th><?= lang('Dashboard.xin_title');?></th>
                          <th><?= lang('Invoices.xin_amount');?></th>
                          <th><?= lang('Employees.xin_salary_sd_options');?></th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
                <?php $attributes = array('name' => 'user_statutory', 'id' => 'user_statutory', 'autocomplete' => 'off');?>
                <?php $hidden = array('token' => $segment_id);?>
                <?= form_open('erp/employees/add_statutory', $attributes, $hidden);?>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="amount_option">
                          <?= lang('Employees.xin_salary_sd_options');?>
                          <span class="text-danger">*</span></label>
                        <select name="is_fixed" class="form-control" data-plugin="select_hrm">
                          <option value="1">
                          <?= lang('Employees.xin_title_tax_fixed');?>
                          </option>
                          <option value="2">
                          <?= lang('Employees.xin_title_tax_percent');?>
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="account_title">
                          <?= lang('Dashboard.xin_title');?>
                          <span class="text-danger">*</span></label>
                        <input class="form-control" placeholder="<?= lang('Dashboard.xin_title');?>" name="option_title" type="text">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="account_number">
                          <?= lang('Invoices.xin_amount');?>
                          <span class="text-danger">*</span></label>
                        <div class="input-group">
                          <div class="input-group-prepend"><span class="input-group-text">
                            <?= $xin_system['default_currency'];?>
                            </span></div>
                          <input class="form-control" placeholder="<?= lang('Invoices.xin_amount');?>" name="contract_amount" type="text">
                        </div>
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
              <div class="tab-pane fade" id="pills-reimbursements" role="tabpanel" aria-labelledby="pills-reimbursements-tab">
                <div class="card-body user-profile-list">
                  <h5 class="mt-1 mb-3 pb-3 border-bottom">
                    <?= lang('Main.xin_list_all');?>
                    <?= lang('Employees.xin_reimbursements');?>
                  </h5>
                  <div class="box-datatable table-responsive">
                    <table class="table table-striped table-bordered dataTable" id="xin_table_all_other_payments" style="width:100%;">
                      <thead>
                        <tr>
                          <th><?= lang('Dashboard.xin_title');?></th>
                          <th><?= lang('Invoices.xin_amount');?></th>
                          <th><?= lang('Employees.xin_reimbursements_option');?></th>
                          <th><?= lang('Employees.xin_amount_option');?></th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
                <?php $attributes = array('name' => 'user_otherpayment', 'id' => 'user_otherpayment', 'autocomplete' => 'off');?>
                <?php $hidden = array('token' => $segment_id);?>
                <?= form_open('erp/employees/add_otherpayment', $attributes, $hidden);?>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="is_allowance_taxable">
                          <?= lang('Employees.xin_reimbursements_option');?>
                          <span class="text-danger">*</span></label>
                        <select name="contract_tax_option" class="form-control" data-plugin="select_hrm">
                          <option value="1">
                          <?= lang('Employees.xin_salary_allowance_non_taxable');?>
                          </option>
                          <option value="2">
                          <?= lang('Employees.xin_fully_taxable');?>
                          </option>
                          <option value="3">
                          <?= lang('Employees.xin_partially_taxable');?>
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="amount_option">
                          <?= lang('Employees.xin_amount_option');?>
                          <span class="text-danger">*</span></label>
                        <select name="is_fixed" class="form-control" data-plugin="select_hrm">
                          <option value="1">
                          <?= lang('Employees.xin_title_tax_fixed');?>
                          </option>
                          <option value="2">
                          <?= lang('Employees.xin_title_tax_percent');?>
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="account_title">
                          <?= lang('Dashboard.xin_title');?>
                          <span class="text-danger">*</span></label>
                        <input class="form-control" placeholder="<?= lang('Dashboard.xin_title');?>" name="option_title" type="text">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="account_number">
                          <?= lang('Invoices.xin_amount');?>
                          <span class="text-danger">*</span></label>
                        <div class="input-group">
                          <div class="input-group-prepend"><span class="input-group-text">
                            <?= $xin_system['default_currency'];?>
                            </span></div>
                          <input class="form-control" placeholder="<?= lang('Invoices.xin_amount');?>" name="contract_amount" type="text">
                        </div>
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
      <?php } ?>
      <?php if($xin_system['is_enable_ml_payroll']==1){ ?>
      <div class="tab-pane fade" id="user-set-malaysia-salary" role="tabpanel" aria-labelledby="user-set-malaysia-salary-tab">
        <div class="card">
          <div class="card-header">
            <h5> <i data-feather="edit" class="icon-svg-primary wid-20"></i><span class="p-l-5">
              <?= lang('Main.xin_salary_calculator_malaysia');?>
              </span> <small class="text-muted d-block m-l-25 m-t-5">
              <?= lang('Main.xin_pcb_epf_socso_eis_calculator');?>
              </small> </h5>
          </div>
          <?php $attributes = array('name' => 'edit_malaysia_salary', 'id' => 'edit_malaysia_salary', 'autocomplete' => 'off');?>
          <?php $hidden = array('token' => $segment_id);?>
          <?= form_open('erp/employees/update_malaysia_salary', $attributes, $hidden);?>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>
                    <?= lang('Main.xin_ml_tax_category');?>
                    <span class="text-danger">*</span></label>
                  <select class="form-control" name="ml_tax_category" size="1" data-plugin="select_hrm">
                    <option value="0" <?php if($employee_detail['ml_tax_category'] == '0'):?> selected="selected"<?php endif;?>>Single</option>
                    <option value="1" <?php if($employee_detail['ml_tax_category'] == '1'):?> selected="selected"<?php endif;?>>Spouse not working, No child</option>
                    <option value="2" <?php if($employee_detail['ml_tax_category'] == '2'):?> selected="selected"<?php endif;?>>Spouse not working, 1 child</option>
                    <option value="3" <?php if($employee_detail['ml_tax_category'] == '3'):?> selected="selected"<?php endif;?>>Spouse not working, 2 children</option>
                    <option value="4" <?php if($employee_detail['ml_tax_category'] == '4'):?> selected="selected"<?php endif;?>>Spouse not working, 3 children</option>
                    <option value="5" <?php if($employee_detail['ml_tax_category'] == '5'):?> selected="selected"<?php endif;?>>Spouse not working, 4 children</option>
                    <option value="6" <?php if($employee_detail['ml_tax_category'] == '6'):?> selected="selected"<?php endif;?>>Spouse not working, 5 children</option>
                    <option value="7" <?php if($employee_detail['ml_tax_category'] == '7'):?> selected="selected"<?php endif;?>>Spouse not working, 6 children</option>
                    <option value="8" <?php if($employee_detail['ml_tax_category'] == '8'):?> selected="selected"<?php endif;?>>Spouse not working, 7 children</option>
                    <option value="9" <?php if($employee_detail['ml_tax_category'] == '9'):?> selected="selected"<?php endif;?>>Spouse not working, 8 children</option>
                    <option value="10" <?php if($employee_detail['ml_tax_category'] == '10'):?> selected="selected"<?php endif;?>>Spouse not working, 9 children</option>
                    <option value="11" <?php if($employee_detail['ml_tax_category'] == '11'):?> selected="selected"<?php endif;?>>Spouse not working, 10 children</option>
                    <option value="12" <?php if($employee_detail['ml_tax_category'] == '12'):?> selected="selected"<?php endif;?>>Spouse working, No child</option>
                    <option value="13" <?php if($employee_detail['ml_tax_category'] == '13'):?> selected="selected"<?php endif;?>>Spouse working, 1 child</option>
                    <option value="14" <?php if($employee_detail['ml_tax_category'] == '14'):?> selected="selected"<?php endif;?>>Spouse working, 2 children</option>
                    <option value="15" <?php if($employee_detail['ml_tax_category'] == '15'):?> selected="selected"<?php endif;?>>Spouse working, 3 children</option>
                    <option value="16" <?php if($employee_detail['ml_tax_category'] == '16'):?> selected="selected"<?php endif;?>>Spouse working, 4 children</option>
                    <option value="17" <?php if($employee_detail['ml_tax_category'] == '17'):?> selected="selected"<?php endif;?>>Spouse working, 5 children</option>
                    <option value="18" <?php if($employee_detail['ml_tax_category'] == '18'):?> selected="selected"<?php endif;?>>Spouse working, 6 children</option>
                    <option value="19" <?php if($employee_detail['ml_tax_category'] == '19'):?> selected="selected"<?php endif;?>>Spouse working, 7 children</option>
                    <option value="20" <?php if($employee_detail['ml_tax_category'] == '20'):?> selected="selected"<?php endif;?>>Spouse working, 8 children</option>
                    <option value="21" <?php if($employee_detail['ml_tax_category'] == '21'):?> selected="selected"<?php endif;?>>Spouse working, 9 children</option>
                    <option value="22" <?php if($employee_detail['ml_tax_category'] == '22'):?> selected="selected"<?php endif;?>>Spouse working, 10 children</option>
                    </select>
                </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="tax_citizenship"><?= lang('Main.xin_ml_tax_citizenship');?></label>
                    <select class="form-control" name="ml_tax_citizenship" id="ml_tax_citizenship" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_ml_tax_citizenship');?>">
                      <option value="1" <?php if($employee_detail['ml_tax_citizenship'] == 1):?> selected="selected"<?php endif;?>><?= lang('Main.xin_pcb_tax_malaysian');?></option>                                  
                      <option value="2"<?php if($employee_detail['ml_tax_citizenship'] == 2):?> selected="selected"<?php endif;?>><?= lang('Main.xin_pcb_tax_non_m_with_permanent_residence');?></option>
                      <option value="3"<?php if($employee_detail['ml_tax_citizenship'] == 3):?> selected="selected"<?php endif;?>><?= lang('Main.xin_pcb_tax_non_m_without_permanent_residence');?></option>
                    </select>
                  </div>
                </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>
                    <?= lang('Main.xin_ml_empployee_epf_rate');?>
                    <span class="text-danger">*</span></label>
                  <select class="form-control" name="ml_empployee_epf_rate" size="1" data-plugin="select_hrm">
                    <option value="0" <?php if($employee_detail['ml_empployee_epf_rate'] == '0'):?> selected="selected"<?php endif;?>><?= lang('Main.xin_ml_no_epf_contribution');?></option>
                    <option value="4" <?php if($employee_detail['ml_tax_category'] == '4'):?> selected="selected"<?php endif;?>>4%</option>
                    <option value="5.5" <?php if($employee_detail['ml_empployee_epf_rate'] == '5.5'):?> selected="selected"<?php endif;?>>5.5%</option>
                    <option value="7" <?php if($employee_detail['ml_empployee_epf_rate'] == '7'):?> selected="selected"<?php endif;?>>7%</option>
                    <option value="8" <?php if($employee_detail['ml_empployee_epf_rate'] == '8'):?> selected="selected"<?php endif;?>>8%</option>
                    <option value="9" <?php if($employee_detail['ml_empployee_epf_rate'] == '9'):?> selected="selected"<?php endif;?>>9%</option>
                    <option value="10" <?php if($employee_detail['ml_empployee_epf_rate'] == '10'):?> selected="selected"<?php endif;?>>10%</option>
                    <option value="11" <?php if($employee_detail['ml_empployee_epf_rate'] == '11'):?> selected="selected"<?php endif;?>>11%</option>
                    <option value="12" <?php if($employee_detail['ml_empployee_epf_rate'] == '12'):?> selected="selected"<?php endif;?>>12%</option>
                    <option value="13" <?php if($employee_detail['ml_empployee_epf_rate'] == '13'):?> selected="selected"<?php endif;?>>13%</option>
                    <option value="14" <?php if($employee_detail['ml_empployee_epf_rate'] == '14'):?> selected="selected"<?php endif;?>>14%</option>
                    <option value="15" <?php if($employee_detail['ml_empployee_epf_rate'] == '15'):?> selected="selected"<?php endif;?>>15%</option>
                    <option value="16" <?php if($employee_detail['ml_empployee_epf_rate'] == '16'):?> selected="selected"<?php endif;?>>16%</option>
                    <option value="17" <?php if($employee_detail['ml_empployee_epf_rate'] == '17'):?> selected="selected"<?php endif;?>>17%</option>
                    <option value="18" <?php if($employee_detail['ml_empployee_epf_rate'] == '18'):?> selected="selected"<?php endif;?>>18%</option>
                    <option value="19" <?php if($employee_detail['ml_empployee_epf_rate'] == '19'):?> selected="selected"<?php endif;?>>19%</option>
                    <option value="20" <?php if($employee_detail['ml_empployee_epf_rate'] == '20'):?> selected="selected"<?php endif;?>>20%</option>
                    <option value="21" <?php if($employee_detail['ml_empployee_epf_rate'] == '21'):?> selected="selected"<?php endif;?>>21%</option>
                    <option value="22" <?php if($employee_detail['ml_empployee_epf_rate'] == '22'):?> selected="selected"<?php endif;?>>22%</option>
                    <option value="23" <?php if($employee_detail['ml_empployee_epf_rate'] == '23'):?> selected="selected"<?php endif;?>>23%</option>
                    <option value="24" <?php if($employee_detail['ml_empployee_epf_rate'] == '24'):?> selected="selected"<?php endif;?>>24%</option>
                    <option value="25" <?php if($employee_detail['ml_empployee_epf_rate'] == '25'):?> selected="selected"<?php endif;?>>25%</option>
                    <option value="26" <?php if($employee_detail['ml_empployee_epf_rate'] == '26'):?> selected="selected"<?php endif;?>>26%</option>
                    <option value="27" <?php if($employee_detail['ml_empployee_epf_rate'] == '27'):?> selected="selected"<?php endif;?>>27%</option>
                    <option value="28" <?php if($employee_detail['ml_empployee_epf_rate'] == '28'):?> selected="selected"<?php endif;?>>28%</option>
                    <option value="29" <?php if($employee_detail['ml_empployee_epf_rate'] == '29'):?> selected="selected"<?php endif;?>>29%</option>
                    <option value="30" <?php if($employee_detail['ml_empployee_epf_rate'] == '30'):?> selected="selected"<?php endif;?>>30%</option>
                    </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>
                    <?= lang('Main.xin_ml_empployer_epf_rate');?>
                    <span class="text-danger">*</span></label>
                  <select class="form-control" name="ml_empployer_epf_rate" size="1" data-plugin="select_hrm">
                    <option value="0" <?php if($employee_detail['ml_empployee_epf_rate'] == '0'):?> selected="selected"<?php endif;?>><?= lang('Main.xin_ml_no_epf_contribution');?></option>
                    <option value="4" <?php if($employee_detail['ml_empployer_epf_rate'] == '4'):?> selected="selected"<?php endif;?>>4%</option>
                    <option value="6" <?php if($employee_detail['ml_empployer_epf_rate'] == '6'):?> selected="selected"<?php endif;?>>6%</option>
                    <option value="6.5" <?php if($employee_detail['ml_empployer_epf_rate'] == '6.5'):?> selected="selected"<?php endif;?>>6.5%</option>
                    <option value="12" <?php if($employee_detail['ml_empployer_epf_rate'] == '12'):?> selected="selected"<?php endif;?>>12%</option>
                    <option value="13" <?php if($employee_detail['ml_empployer_epf_rate'] == '13'):?> selected="selected"<?php endif;?>>13%</option>
                    <option value="14" <?php if($employee_detail['ml_empployer_epf_rate'] == '14'):?> selected="selected"<?php endif;?>>14%</option>
                    <option value="15" <?php if($employee_detail['ml_empployer_epf_rate'] == '15'):?> selected="selected"<?php endif;?>>15%</option>
                    <option value="16" <?php if($employee_detail['ml_empployer_epf_rate'] == '16'):?> selected="selected"<?php endif;?>>16%</option>
                    <option value="17" <?php if($employee_detail['ml_empployer_epf_rate'] == '17'):?> selected="selected"<?php endif;?>>17%</option>
                    <option value="18" <?php if($employee_detail['ml_empployer_epf_rate'] == '18'):?> selected="selected"<?php endif;?>>18%</option>
                    <option value="19" <?php if($employee_detail['ml_empployer_epf_rate'] == '19'):?> selected="selected"<?php endif;?>>19%</option>
                    <option value="20" <?php if($employee_detail['ml_empployer_epf_rate'] == '20'):?> selected="selected"<?php endif;?>>20%</option>
                    <option value="21" <?php if($employee_detail['ml_empployer_epf_rate'] == '21'):?> selected="selected"<?php endif;?>>21%</option>
                    <option value="22" <?php if($employee_detail['ml_empployer_epf_rate'] == '22'):?> selected="selected"<?php endif;?>>22%</option>
                    <option value="23" <?php if($employee_detail['ml_empployer_epf_rate'] == '23'):?> selected="selected"<?php endif;?>>23%</option>
                    <option value="24" <?php if($employee_detail['ml_empployer_epf_rate'] == '24'):?> selected="selected"<?php endif;?>>24%</option>
                    <option value="25" <?php if($employee_detail['ml_empployer_epf_rate'] == '25'):?> selected="selected"<?php endif;?>>25%</option>
                    <option value="26" <?php if($employee_detail['ml_empployer_epf_rate'] == '26'):?> selected="selected"<?php endif;?>>26%</option>
                    <option value="27" <?php if($employee_detail['ml_empployer_epf_rate'] == '27'):?> selected="selected"<?php endif;?>>27%</option>
                    <option value="28" <?php if($employee_detail['ml_empployer_epf_rate'] == '28'):?> selected="selected"<?php endif;?>>28%</option>
                    <option value="29" <?php if($employee_detail['ml_empployer_epf_rate'] == '29'):?> selected="selected"<?php endif;?>>29%</option>
                    <option value="30" <?php if($employee_detail['ml_empployer_epf_rate'] == '30'):?> selected="selected"<?php endif;?>>30%</option>
                    </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>
                    <?= lang('Main.xin_eis_contribution');?>
                    <span class="text-danger">*</span></label>
                  <select class="form-control" name="ml_eis_contribution" size="1" data-plugin="select_hrm">
                    <option value="1" <?php if($employee_detail['ml_eis_contribution'] == '1'):?> selected="selected"<?php endif;?>><?= lang('Main.xin_yes');?></option>
                    <option value="0" <?php if($employee_detail['ml_eis_contribution'] == '0'):?> selected="selected"<?php endif;?>><?= lang('Main.xin_no');?></option>
                    </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>
                    <?= lang('Main.xin_ml_socso_category');?>
                    <span class="text-danger">*</span></label>
                  <select class="form-control" name="ml_socso_category" size="1" data-plugin="select_hrm">
                    <option value="1" <?php if($employee_detail['ml_socso_category'] == '1'):?> selected="selected"<?php endif;?>><?= lang('Main.xin_ml_employee_injury_invalidity');?></option>
                    <option value="2" <?php if($employee_detail['ml_socso_category'] == '2'):?> selected="selected"<?php endif;?>><?= lang('Main.xin_ml_employee_injury_only');?></option>
                    <option value="0" <?php if($employee_detail['ml_socso_category'] == '0'):?> selected="selected"<?php endif;?>><?= lang('Main.xin_ml_no_contribution');?></option>
                    </select>
                </div>
              </div>
              
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="account_title">
                      <?= lang('Main.xin_ml_hrdf');?>
                      <span class="text-danger">*</span></label>
                    <select class="form-control" name="ml_hrdf" size="1" data-plugin="select_hrm">
                    <option value="0" <?php if($employee_detail['ml_hrdf'] == '0'):?> selected="selected"<?php endif;?>><?= lang('Main.xin_ml_no_hrdf_contribution');?></option>
                    <option value="1" <?php if($employee_detail['ml_hrdf'] == '1'):?> selected="selected"<?php endif;?>>1%</option>
                    <option value="2" <?php if($employee_detail['ml_hrdf'] == '2'):?> selected="selected"<?php endif;?>>2%</option>
                    <option value="3" <?php if($employee_detail['ml_hrdf'] == '3'):?> selected="selected"<?php endif;?>>3%</option>
                    <option value="4" <?php if($employee_detail['ml_hrdf'] == '4'):?> selected="selected"<?php endif;?>>4%</option>
                    <option value="5" <?php if($employee_detail['ml_hrdf'] == '5'):?> selected="selected"<?php endif;?>>5%</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="zakat_fund">
                      <?= lang('Main.xin_muslim_zakat_fund');?>
                      <span class="text-danger">*</span></label>
                    <input class="form-control" placeholder="<?= lang('Main.xin_muslim_zakat_fund');?>" name="zakat_fund" type="text" value="<?= $employee_detail['zakat_fund'];?>">
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
      <?php } ?>     
    </div>
  </div>
  <!-- [] end --> 
</div>
