<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\StaffdetailsModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$DepartmentModel = new DepartmentModel();
$DesignationModel = new DesignationModel();
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
$user_chart = $UsersModel->where('user_id', $company_id)->first();
$main_department = $DepartmentModel->where('company_id', $company_id)->where('department_head!=', 0)->findAll();
$get_animate = '';

$head_of_company = $StaffdetailsModel->where('company_id', $company_id)->where('reporting_manager', 0)->findAll();
?>

<div class="row">
  <div class="col-sm-12 col-md-12 key-chart-col">
    <div class="card text-left" style="height:800px;">
      <div class="card-body" style="height:800px;">
        <h5 class="card-title">
          <?= lang('Dashboard.xin_org_chart_title');?>
        </h5>
        <label><input id="togglePan" type="checkbox" checked>Enable Pan</label>
<label><input id="toggleZoom" type="checkbox" checked>Enable Zoom</label>
        <div id="chart-container"></div>
      </div>
    </div>
  </div>
</div>
