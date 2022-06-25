<?php
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\RolesModel;
use App\Models\ShiftModel;
use App\Models\UsersModel;

$RolesModel = new RolesModel();
$ShiftModel = new ShiftModel();
$UsersModel = new UsersModel();
$DepartmentModel = new DepartmentModel();
$DesignationModel = new DesignationModel();
$session = \Config\Services::session();
$usession = $session->get('sup_username');

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();

if($user_info['user_type'] == 'staff'){
	$departments = $DepartmentModel->where('company_id',$user_info['company_id'])->orderBy('department_id', 'ASC')->findAll();
	$designations = $DesignationModel->where('company_id',$user_info['company_id'])->orderBy('designation_id', 'ASC')->findAll();
	$office_shifts = $ShiftModel->where('company_id',$user_info['company_id'])->orderBy('office_shift_id', 'ASC')->findAll();
	$roles = $RolesModel->where('company_id',$user_info['company_id'])->orderBy('role_id', 'ASC')->findAll();
} else {
	$departments = $DepartmentModel->where('company_id',$usession['sup_user_id'])->orderBy('department_id', 'ASC')->findAll();
	$designations = $DesignationModel->where('company_id',$usession['sup_user_id'])->orderBy('designation_id', 'ASC')->findAll();
	$office_shifts = $ShiftModel->where('company_id',$usession['sup_user_id'])->orderBy('office_shift_id', 'ASC')->findAll();
	$roles = $RolesModel->where('company_id',$usession['sup_user_id'])->orderBy('role_id', 'ASC')->findAll();
}

/* Employee Import view
*/
?>
<?php /*?><?php $session = $this->session->userdata('username');?>
<?php $get_animate = $this->Xin_model->get_content_animate();?>
<?php $user_info = $this->Xin_model->read_user_info($session['user_id']);?>
<?php $role_resources_ids = $this->Xin_model->user_role_resource(); ?><?php */?>

<div id="smartwizard-2" class="smartwizard-example sw-main sw-theme-default">
  <ul class="nav nav-tabs step-anchor">
    <?php //if(in_array('92',$role_resources_ids)) { ?>
    <li class="nav-item active"> <a href="<?= site_url('erp/staff-import');?>" class="mb-3 nav-link"> <span class="sw-done-icon fas fa-user-edit"></span> <span class="sw-icon fas fa-user-edit"></span> <?php echo lang('Main.xin_import_employees');?>
      <div class="text-muted small"><?php echo lang('Main.xin_import_employees');?></div>
      </a> </li>
    <?php //} ?>
    <?php //if(in_array('443',$role_resources_ids)) { ?>
    <li class="nav-item done"> <a href="<?= site_url('erp/attendance-import');?>" class="mb-3 nav-link"> <span class="sw-done-icon fas fa-clock"></span> <span class="sw-icon fas fa-clock"></span> <?php echo lang('Main.left_import_attendance');?>
      <div class="text-muted small"><?php echo lang('Main.left_import_attendance');?></div>
      </a> </li>
    <?php //} ?>
  </ul>
  <hr class="border-light m-0 mb-3">
  <div class="sw-container tab-content">
    <?php //if(in_array('92',$role_resources_ids)) { ?>
    <div id="smartwizard-2-step-1" class="card animated fadeIn tab-pane step-content" style="display: block;">
      <div class="card-header with-elements"> <span class="card-header-title mr-2"><strong><?php echo lang('Main.xin_import_employees');?></strong> <?php echo lang('Main.xin_employee_import_csv_file');?></span></div>
      <div class="card-body">
      	<div class="alert alert-primary" role="alert">
			<?php echo lang('Main.xin_employee_import_description_line1');?>
        </div>
        <div class="alert alert-warning" role="alert">
			<?php echo lang('Main.xin_employee_import_description_line2');?>
        </div>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong><?= lang('Main.xin_hints');?>:</strong> <?= lang('Main.xin_hints_import_employees_detail1');?><br /> <?= lang('Main.xin_hints_import_employees_detail2');?>
        </div>
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0"><a href="#!" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed"><?= lang('Main.xin_hints');?></a></h5>
                </div>
                <div id="collapseOne" class="card-body collapse" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
                    <div class="row">
          				<div class="col-md-8">
                        	<strong><?= lang('Employees.xin_employee_office_shift');?></strong>
                        </div>
                     </div>
                     <div class="row">
                     	<div class="col-md-6">
                        	<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?= lang('Employees.xin_employee_office_shift');?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($office_shifts as $ioffice_shift):?>
                                        <tr>
                                            <td><?= $ioffice_shift['office_shift_id'];?></td>
                                            <td><?= $ioffice_shift['shift_name'];?></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                     </div>
                     <div class="row">
          				<div class="col-md-8">
                        	<strong><?= lang('Main.xin_employee_role');?></strong>
                        </div>
                     </div>
                     <div class="row">
                     	<div class="col-md-6">
                        	<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?= lang('Main.xin_employee_role');?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($roles as $role):?>
                                        <tr>
                                            <td><?= $role['role_id'];?></td>
                                            <td><?= $role['role_name'];?></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                     </div>
                     <div class="row">
          				<div class="col-md-8">
                        	<strong><?= lang('Dashboard.left_department');?></strong>
                        </div>
                     </div>
                     <div class="row">
                     	<div class="col-md-6">
                        	<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?= lang('Dashboard.left_department');?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($departments as $idepartment):?>
                                        <tr>
                                            <td><?= $idepartment['department_id'];?></td>
                                            <td><?= $idepartment['department_name'];?></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                     </div>
                     <div class="row">
          				<div class="col-md-8">
                        	<strong><?= lang('Dashboard.left_designation');?></strong>
                        </div>
                     </div>
                     <div class="row">
                     	<div class="col-md-6">
                        	<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?= lang('Dashboard.left_designation');?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($designations as $idesignation):?>
                                        <tr>
                                            <td><?= $idesignation['designation_id'];?></td>
                                            <td><?= $idesignation['designation_name'];?></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                     </div>
                </div>
            </div>
		</div>
        <h6><a href="<?php echo base_url();?>/public/import/sample-csv-employees.csv" class="btn btn-primary"> <i class="fa fa-download"></i> <?php echo lang('Main.xin_employee_import_download_sample');?> </a></h6>
        <?php $attributes = array('name' => 'import_users', 'id' => 'import_users', 'autocomplete' => 'off');?>
        <?php $hidden = array('user_id' => 0);?>
        <?php echo form_open_multipart('erp/application/upload_employees', $attributes, $hidden);?>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <fieldset class="form-group">
                <label for="file"><?php echo lang('Main.xin_employee_upload_file');?><i class="hrsale-asterisk">*</i></label>
                <input type="file" class="form-control-file" id="file" name="file">
                <small><?php echo lang('Main.xin_employee_imp_allowed_size');?></small>
              </fieldset>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary">
        <?= lang('Main.xin_import_employees');?>
        </button>
      </div>
      <?php echo form_close(); ?> </div>
    <?php //} ?>
  </div>
</div>
