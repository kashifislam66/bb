<?php
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\ShiftModel;
use App\Models\ConstantsModel;
use App\Models\SystemModel;
use App\Models\CountryModel;
use App\Models\StaffdetailsModel;

$DepartmentModel = new DepartmentModel();
$DesignationModel = new DesignationModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$ConstantsModel = new ConstantsModel();
$ShiftModel = new ShiftModel();
$SystemModel = new SystemModel();
$CountryModel = new CountryModel();
$StaffdetailsModel = new StaffdetailsModel();
$session = \Config\Services::session();
$usession = $session->get('sup_username');

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$departments = $DepartmentModel->where('company_id',$user_info['company_id'])->orderBy('department_id', 'ASC')->findAll();
	$designations = $DesignationModel->where('company_id',$user_info['company_id'])->orderBy('designation_id', 'ASC')->findAll();
	$office_shifts = $ShiftModel->where('company_id',$user_info['company_id'])->orderBy('office_shift_id', 'ASC')->findAll();
	$leave_types = $ConstantsModel->where('company_id',$user_info['company_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
	$get_staff = $UsersModel->where('company_id',$user_info['company_id'])->where('user_type','staff')->paginate(18);
	$roles = $RolesModel->where('company_id',$user_info['company_id'])->orderBy('role_id', 'ASC')->findAll();
	$pager = $UsersModel->pager;
} else {
	$departments = $DepartmentModel->where('company_id',$usession['sup_user_id'])->orderBy('department_id', 'ASC')->findAll();
	$designations = $DesignationModel->where('company_id',$usession['sup_user_id'])->orderBy('designation_id', 'ASC')->findAll();
	$office_shifts = $ShiftModel->where('company_id',$usession['sup_user_id'])->orderBy('office_shift_id', 'ASC')->findAll();
	$roles = $RolesModel->where('company_id',$usession['sup_user_id'])->orderBy('role_id', 'ASC')->findAll();
	$leave_types = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
	$get_staff = $UsersModel->where('company_id',$usession['sup_user_id'])->where('user_type','staff')->paginate(18);
	$pager = $UsersModel->pager;
}
$xin_com_system = erp_company_settings();
$xin_system = $SystemModel->where('setting_id', 1)->first();

$employee_id = generate_random_employeeid();
$get_animate='';
?>
<div class="row justify-content-center"> 
  <!-- staff-section start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body text-center">
        <div class="row align-items-center ms-lg-0 m-b-20">
          <div class="col-sm-6 text-left">
            <h5>
              <?= lang('Employees.xin_employees_management');?>
            </h5>
          </div>
          <div class="col-sm-6 text-right"> <span class="me-md-3 me-1">
            <?= lang('Projects.xin_view_mode');?>
            :</span> <a href="<?= site_url().'erp/staff-list';?>" class="btn btn-sm waves-effect waves-light btn-primary btn-icon m-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Projects.xin_list_view');?>"> <i class="fas fa-list-ul"></i> </a> <a href="#" class="btn disabled btn-dark btn-sm waves-effect waves-light btn-icon m-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_directory');?>"> <i class="fas fa-th-large"></i> </a> <a target="_blank" href="<?= site_url().'erp/staff-profile-list';?>" class="btn btn-sm waves-effect waves-light btn-primary btn-icon m-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_staff_profile_list');?>"> <i class="fas fa-user-friends"></i> </a>
          </div>
        </div>
        <div class="row mb-n4">		
        	<?php foreach($get_staff as $r) { ?>
            <?php
			if($r['is_active'] == 1){
				$status_label = '<i class="fas fa-certificate text-success bg-icon"></i><i class="fas fa-check front-icon text-white"></i>';
			} else {
				$status_label = '<i class="fas fa-certificate text-danger bg-icon"></i><i class="fas fa-times-circle front-icon text-white"></i>';
			}
			$role = $RolesModel->where('role_id', $r['user_role_id'])->first();
			$employee_detail = $StaffdetailsModel->where('user_id', $r['user_id'])->first();
			$idesignations = $DesignationModel->where('designation_id',$employee_detail['designation_id'])->first();
			?>
            <div class="col-xl-2 col-md-4 col-sm-4 col-6 user-card user-card-3 social-hover support-bar1">            
                <div class="text-center">
                    <div class="position-relative d-inline-block">
                        <img class="img-radius img-fluid wid-150" src="<?= staff_profile_photo($r['user_id']);?>" alt="User image">
                        <div class="certificated-badge" data-toggle="tooltip" data-placement="right" title="" data-original-title="Certificated">
                            <?= $status_label;?>
                        </div>
                    </div>
                    <h5 class="mb-0 mt-3 f-w-400"><?= $r['first_name'].' '.$r['last_name'];?></h5>
                    <p class="mb-3 text-muted">
						<?= $idesignations['designation_name'];?>
                      </p>
                    <div class="card-body hover-data text-white">
                        <div class="">
                            <h4 class="text-white"><?= $r['first_name'].' '.$r['last_name'];?></h4>
                            <p class="mb-1"><?= $idesignations['designation_name'];?></p>
                            <?php if(in_array('staff4',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
                            <a href="<?= site_url('erp/employee-details').'/'.uencode($r['user_id']);?>" class="btn btn-sm waves-effect waves-light btn-primary"><i class="feather icon-arrow-right"></i></a>
                            <?php } ?>
                        </div>
					</div>
                </div>
            </div>
            <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<hr>
<div class="p-2">
  <?= $pager->links() ?>
</div>
