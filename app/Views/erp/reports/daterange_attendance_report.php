<?php
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\MainModel;
use App\Models\ShiftModel;
use App\Models\TimesheetModel;
use App\Models\ConstantsModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\StaffdetailsModel;
use App\Models\OvertimerequestModel;

$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$MainModel = new MainModel();
$ShiftModel = new ShiftModel();
$ConstantsModel = new ConstantsModel();
$TimesheetModel = new TimesheetModel();
$DepartmentModel = new DepartmentModel();
$DesignationModel = new DesignationModel();
$StaffdetailsModel = new StaffdetailsModel();
$OvertimerequestModel = new OvertimerequestModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$staff_info = udecode($_REQUEST['U']);
$start_date = $_REQUEST['S'];
$end_date = $_REQUEST['E'];
$seg_user_id = $staff_info;

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
//$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$timesheet_data = $TimesheetModel->where('company_id', $user_info['company_id'])->where('employee_id', $seg_user_id)->first();
	$user_data = $UsersModel->where('company_id', $user_info['company_id'])->where('user_id', $seg_user_id)->first();
	// userdata
	$employee_detail = $StaffdetailsModel->where('user_id', $seg_user_id)->first();
	$idesignations = $DesignationModel->where('company_id', $user_info['company_id'])->where('designation_id',$employee_detail['designation_id'])->first();
} else {
	$timesheet_data = $TimesheetModel->where('company_id', $usession['sup_user_id'])->where('employee_id', $seg_user_id)->first();
	$user_data = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_id', $seg_user_id)->first();
	// userdata
	$employee_detail = $StaffdetailsModel->where('user_id', $seg_user_id)->first();
	$idesignations = $DesignationModel->where('company_id', $usession['sup_user_id'])->where('designation_id',$employee_detail['designation_id'])->first();
}
if($idesignations){
	$designation_name = $idesignations['designation_name'];
} else {
	$designation_name = '';
}
$xin_system = erp_company_settings();
$daterange_attendance_report = daterange_attendance_report($start_date,$end_date,$staff_info);
$ci_erp_settings = $SystemModel->where('setting_id', 1)->first();

?>

<div class="row justify-content-md-center"> 
  <!-- [ Attendance view ] start -->
  <div class="col-md-8"> 
    <!-- [ Attendance view ] start -->
    <div class="container">
      <div>
        <div class="card" id="printTable">
          <div class="card-header">
            <h5><img class="img-fluid" width="171" height="30" src="<?= base_url();?>/public/uploads/logo/other/<?= $ci_erp_settings['other_logo'];?>" alt=""></h5>
          </div>
          <div class="card-body pb-0">
          <h6 class="text-primary">Attendance Report :</h6>
            <div class="row invoive-info d-pdrint-inline-flex ">
              
                <div class="col-md-6">
                    <div class="media user-about-block align-items-center mt-0">
                      <div class="position-relative d-inline-block"> <img class="img-radius img-fluid wid-80" src="<?= staff_profile_photo($seg_user_id);?>" alt="<?= $user_data['first_name'].' '.$user_data['last_name'];?>"> </div>
                      <div class="media-body ml-3">
                        <h6 class="mb-1">
                          <?= $user_data['first_name'].' '.$user_data['last_name'];?>
                        </h6>
                        <p class="mb-0 text-muted">
                          <?= $designation_name;?>
                        </p>
                        <p class="mb-0 text-muted">
                          <?= $user_data['email'];?>
                        </p>
                      </div>
                    </div>
              </div>
              </div>
              <div class="row invoive-info d-pdrint-inline-flex ">
              <div class="col-md-8">
                    
                    <table class="table table-responsive invoice-table invoice-order table-borderless">
                        <tbody>
                            <tr class="text-primary">
                                <th><?= lang('Main.xin_from');?> :</th>
                                <td><?= set_date_format($start_date);?></td>
                            </tr>
                            <tr class="text-primary">
                                <th><?= lang('Main.xin_to');?> :</th>
                                <td><?= set_date_format($end_date);?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="table-responsive">
                  <table class="table invoice-detail-table">
                    <thead>
                      <tr>
                        <th style="width:150px;"><?= lang('Main.xin_e_details_date');?></th>
                        <th style="width:100px;"><?= lang('Attendance.dashboard_clock_in');?></th>
                        <th style="width:100px;"><?= lang('Attendance.dashboard_clock_out');?></th>
                        <th style="width:100px;"><?= lang('Attendance.dashboard_total_work');?></th>
                        <th style="width:100px;"><?= lang('Main.xin_work_from_home');?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($daterange_attendance_report as $drange_report):?>
                      <?php
					  	$clock_in = strtotime($drange_report->clock_in);
						$clock_out = strtotime($drange_report->clock_out);
            if(!empty($clock_out)) {
              $iclock_out = date("h:i a", $clock_out);
              } else {
                  $iclock_out = "00:00";	
              }
						$iclock_in = date("h:i a", $clock_in);
						if($drange_report->work_from_home == 1){
							$work_from_home = lang('Main.xin_yes');
						} else {
							$work_from_home = lang('Main.xin_no');
						}
					  ?>
                      <tr>
                        <td width="150"><?= $drange_report->attendance_date;?></td>
                        <td width="200"><?= $iclock_in;?></td>
                        <td><?= $iclock_out;?></td>
                        <td><?= $drange_report->total_work;?></td>
                        <td><?= $work_from_home;?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row text-center d-print-none">
          <div class="col-sm-12 invoice-btn-group text-center">
            <button type="button" class="btn btn-print-invoice waves-effect waves-light btn-success m-b-10">
            <?= lang('Main.xin_print');?>
            </button>
           </div>
        </div>
      </div>
    </div>
    <!-- [ Attendance view ] end --> 
  </div>
</div>
