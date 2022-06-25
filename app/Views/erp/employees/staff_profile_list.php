<?php
use CodeIgniter\I18n\Time;
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
$com_xin_system = erp_company_settings();
$session = \Config\Services::session();
$usession = $session->get('sup_username');

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$departments = $DepartmentModel->where('company_id',$user_info['company_id'])->orderBy('department_id', 'ASC')->findAll();
	$designations = $DesignationModel->where('company_id',$user_info['company_id'])->orderBy('designation_id', 'ASC')->findAll();
	$get_staff = $UsersModel->where('company_id',$user_info['company_id'])->where('user_type','staff')->orderBy('user_id', 'ASC')->findAll();
} else {
	$departments = $DepartmentModel->where('company_id',$usession['sup_user_id'])->orderBy('department_id', 'ASC')->findAll();
	$designations = $DesignationModel->where('company_id',$usession['sup_user_id'])->orderBy('designation_id', 'ASC')->findAll();
	$get_staff = $UsersModel->where('company_id',$usession['sup_user_id'])->where('user_type','staff')->orderBy('user_id', 'ASC')->findAll();
}

$roles = $RolesModel->orderBy('role_id', 'ASC')->findAll();
$xin_system = $SystemModel->where('setting_id', 1)->first();

$employee_id = generate_random_employeeid();
$get_animate='';
?>

<div class="row"> 
  <!-- [ Payslip ] start -->
  <div class="col-md-12"> 
    <!-- [ Payslip ] start -->
    <div class="container">
      <div>
        <div class="card" id="printTable">
          <div class="card-header">
            <h5><img class="img-fluid" width="171" height="30" src="<?= base_url();?>/public/uploads/logo/other/<?= $xin_system['other_logo'];?>" alt=""></h5>
          </div>
          <div class="card-body">
          <h5 class="text-primary m-l-10 text-center m-b-20"><?php echo lang('Main.xin_staff_profile_list');?></h5>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-xs m-b-0 f-14 b-solid requid-table">
                    <thead>
                      <tr class="">
                        <th width="" class="text-success"><?php echo lang('Dashboard.left_department');?></th>
                        <th class="text-success"><?= lang('Main.xin_salary');?></th>
                        <th class="text-success"><?= lang('Dashboard.dashboard_employee');?></th>
                        <th class="text-success"><?= lang('Main.xin_position');?></th>
                        <th class="text-success"><?= lang('Main.dashboard_xin_status');?></th>
                        <th class="text-success"><?= lang('Main.xin_doh');?></th>
                        <th class="text-success"><?= lang('Main.xin_yos');?></th>
                      </tr>
                    </thead>
                    <tbody class="text-muted">
                      <?php foreach($get_staff as $_staff):?>
                      <?php
                      	$staff_view = $StaffdetailsModel->where('user_id',$_staff['user_id'])->first();
					  	$departments = $DepartmentModel->where('department_id',$staff_view['department_id'])->first();
						$designations = $DesignationModel->where('designation_id',$staff_view['designation_id'])->first();
						$yos = Time::parse($staff_view['date_of_joining']);
						// job type
						if($staff_view['job_type']==1){
							$job_type = lang('Main.xin_permanent');
						} else {
							$job_type = lang('Main.xin_part_time');
						}
						?>
                      <tr>
                        <td width=""><?= $departments['department_name'];?></td>
                        <td width=""><?= number_to_currency($staff_view['basic_salary'], $com_xin_system['default_currency'],null,2);?></td>
                        <td width=""><?= $_staff['first_name'].' '.$_staff['last_name'];?></td>
                        <td width=""><?= $designations['designation_name'];?></td>
                        <td width=""><?= $job_type;?></td>
                        <td width=""><?= set_date_format($staff_view['date_of_joining']);?></td>
                        <td class=""><?= $yos->humanize();?></td>
                      </tr>
                      <?php endforeach?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row text-center d-print-none">
          <div class="col-sm-12 invoice-btn-group text-center">
            <button type="button" class="btn btn-print-invoice waves-effect waves-light btn-primary m-b-10">
            <?= lang('Main.xin_print');?>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Payslip ] end --> 
  </div>
</div>
