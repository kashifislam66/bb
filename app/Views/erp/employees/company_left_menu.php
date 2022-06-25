<?php
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\SuperroleModel;
use App\Models\MembershipModel;
use App\Models\CompanysettingsModel;
use App\Models\CompanymembershipModel;

$UsersModel = new UsersModel();
$SystemModel = new SystemModel();
$SuperroleModel = new SuperroleModel();
$MembershipModel = new MembershipModel();
$CompanysettingsModel = new CompanysettingsModel();
$CompanymembershipModel = new CompanymembershipModel();
$session = \Config\Services::session();
$router = service('router');
$usession = $session->get('sup_username');
$xin_system = $SystemModel->where('setting_id', 1)->first();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
$xin_com_system = $CompanysettingsModel->where('company_id', $usession['sup_user_id'])->first();
?>
<?php $arr_mod = select_module_class($router->controllerName(),$router->methodName()); ?>
<?php 
if($user_info['user_type'] == 'staff'){
	$cmembership = $CompanymembershipModel->where('company_id', $user_info['company_id'])->first();
} else {
	$cmembership = $CompanymembershipModel->where('company_id', $usession['sup_user_id'])->first();
}

$mem_info = $MembershipModel->where('membership_id', $cmembership['membership_id'])->first();
$setup_modules = unserialize($xin_com_system['setup_modules']);
if($xin_system['template_option']==1){
?>
<style type="text/css">
.minimenu .pc-sidebar .m-header {
    padding: 15px 26px !important;
}
.minimenu .pc-sidebar .pc-link {
    padding: 10px 15px !important;
}
.mmenu {
	margin-left: 5px !important;
    font-size: 12px !important;
}
.mmenu-staff {
	margin-left: 2px !important;
    font-size: 12px !important;
}
.mmenu-org {
	margin-left: -3px !important;
    font-size: 12px !important;
}
.mmenu-short {
	margin-left:15px !important;
	font-size: 12px !important;
}
.mmenu-short-leave {
	margin-left:18px !important;
	font-size: 12px !important;
}
.mmenu-help{
	margin-left:9px !important;
	font-size: 12px !important;
}
.mmenu-training{
	margin-left:12px !important;
	font-size: 12px !important;
}
.mmenu-performance {
	margin-left:0px !important;
	font-size: 12px !important;
}
.mmenu-projects {
	margin-left:10px !important;
	font-size: 12px !important;
}
.minimenu .pc-sidebar {
    width: 100px !important;
}
.pc-sidebar .pc-micon {
    margin-right: 15px;
    margin-left: 25px;
}
.minimenu .pc-sidebar .pc-item:hover > .pc-submenu {
	width:200px !important;
}
.minimenu .pc-sidebar .pc-item .pc-item:hover > .pc-link {
	width:200px !important;
}
.pc-sidebar.light-sidebar .pc-link {
    color: #1c232f;
    font-size: 14px !important;
}
.pc-submenu svg {
	width: 15px;
	height: 15px;
}
.minimenu .pc-sidebar .pc-item:hover > .pc-link {
    width: calc(230px + 70px) !important;
}
</style>
<?php } ?>
<ul class="pc-navbar">
  <li class="pc-item pc-caption">
    <label>
      <?= lang('Dashboard.dashboard_your_company');?>
    </label>
  </li>
  <!-- Dashboard|Home -->
  <li class="pc-item"><a href="<?= site_url('erp/desk');?>" class="pc-link "><span class="pc-micon"><i data-feather="home"></i></span><span class="mmenu"><?= lang('Dashboard.dashboard_title');?></span></a></li>
  <!-- Employees -->
 
  
  <li class="pc-item"> <a href="#" class="pc-link sidenav-toggle"> <span class="pc-micon"><i data-feather="users"></i></span><span class="mmenu-staff"><?= lang('Dashboard.dashboard_employees');?></span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a><ul class="pc-submenu">
        <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/staff-list');?>" >
        <?= lang('Dashboard.dashboard_employees');?>
        </a> </li>
        <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/staff-grid');?>" >
        <?= lang('Main.xin_directory');?>
        </a> </li>
        <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/set-roles');?>" >
        <?= lang('Dashboard.left_set_roles');?>
        </a> </li>        
        <?php if(isset($setup_modules['asset'])): if($setup_modules['asset']==1):?>
        <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/assets-list');?>" >
        <?= lang('Dashboard.xin_assets');?>
        </a> </li>
        <?php endif; endif;?>
        <?php if(isset($setup_modules['award'])): if($setup_modules['award']==1):?>
        <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/awards-list');?>" >
        <?= lang('Dashboard.left_awards');?>
        </a> </li>
        <?php endif; endif;?>
        <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/disciplinary-cases');?>" >
        <?= lang('Dashboard.left_warnings');?>
        </a> </li>
        <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/complaints-list');?>" >
        <?= lang('Dashboard.left_complaints');?>
        </a> </li>
      	<li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/resignation-list');?>" >
        <?= lang('Dashboard.left_resignations');?>
        </a> </li>
        <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/transfers-list');?>" >
        <?= lang('Dashboard.left_transfers');?>
        </a> </li>
        <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/termination-list');?>" >
        <?= lang('Dashboard.left_terminations');?>
        </a> </li> 
        <?php if(isset($setup_modules['training'])): if($setup_modules['training']==1):?>  
        <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/training-sessions');?>" >
        <?= lang('Dashboard.left_training');?>
        </a> </li>
        <?php endif; endif;?>
        <?php if(isset($setup_modules['travel'])): if($setup_modules['travel']==1):?> 
        <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/business-travel');?>" >
        <?= lang('Dashboard.left_travels');?>
        </a> </li>
        <?php endif; endif;?>
              
    </ul>
  </li>
  <!-- Attendance -->
  <li class="pc-item pc-hasmenu <?php if(!empty($arr_mod['attendance_open']))echo $arr_mod['attendance_open'];?>"> <a href="#" class="pc-link sidenav-toggle"><span class="pc-micon"><i data-feather="clock"></i></span><span class="mmenu-performance"><?= lang('Dashboard.left_attendance');?></span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
    <ul class="pc-submenu">
      <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/attendance-list');?>" >
        <?= lang('Dashboard.left_attendance');?>
        </a> </li>
      <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/manual-attendance');?>" >
        <?= lang('Dashboard.left_update_attendance');?>
        </a> </li>
      <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/office-shifts');?>" >
        <?= lang('Dashboard.left_office_shifts');?>
        </a> </li>
      <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/monthly-attendance');?>" >
        <?= lang('Dashboard.xin_month_timesheet_title');?>
        </a> </li>
      <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/overtime-request');?>" >
        <?= lang('Dashboard.xin_overtime_request');?>
        </a> </li>
        <?php if(isset($setup_modules['holidays'])): if($setup_modules['holidays']==1):?>
       <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/holidays-list');?>" >
        <?= lang('Dashboard.left_holidays');?>
        </a> </li>
       <?php endif; endif;?>
       <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/shift-calendar');?>" >
        <?= lang('Main.xin_shift_calendar');?>
        </a> </li>
    </ul>
  </li>  
  <!-- CoreHR -->
  <li class="pc-item <?php if(!empty($arr_mod['corehr_open']))echo $arr_mod['corehr_open'];?>"> <a href="#" class="pc-link sidenav-toggle"> <span class="pc-micon"><i data-feather="crosshair"></i></span><span class="mmenu-org"><?= lang('Dashboard.dashboard_core_hr');?></span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a><ul class="pc-submenu">
      <li class="pc-item">
            <a class="pc-link" href="<?= site_url('erp/polls-list');?>">
                <?= lang('Main.xin_polls');?>
            </a>
        </li>
        <li class="pc-item">
        <a href="<?= site_url('erp/policies-list');?>" class="pc-link">
            <?= lang('Dashboard.header_policies');?>
        </a>
        </li>
        <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/departments-list');?>" >
        <?= lang('Dashboard.left_department');?>
        </a> </li>
      <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/designation-list');?>" >
        <?= lang('Dashboard.left_designation');?>
        </a> </li>
        <li class="pc-item">
            <a class="pc-link" href="<?= site_url('erp/news-list');?>">
                <?= lang('Dashboard.left_announcement_make');?>
            </a>
        </li>   
        <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/suggestions');?>" >
        <?= lang('Main.xin_hr_suggestions');?>
        </a> </li>
        <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/chart');?>" >
        <?= lang('Dashboard.xin_org_chart_title');?>
        </a> </li>     
    </ul>
  </li>
   <?php if(isset($setup_modules['projects'])): if($setup_modules['projects']==1):?>
  <!-- Projects -->
  <li class="<?php if(!empty($arr_mod['talent_open']))echo $arr_mod['talent_open'];?> pc-item"> <a href="#" class="pc-link sidenav-toggle"> <span class="pc-micon"><i data-feather="aperture"></i></span><span class="mmenu-projects"><?= lang('Dashboard.left_projects');?></span><span class="pc-arrow"><i data-feather="chevron-right"></i></span> </a>
    <ul class="pc-submenu">
      <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/projects-grid');?>" >
        <?= lang('Dashboard.left_projects');?>
        </a> </li>
      <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/tasks-grid');?>" >
        <?= lang('Main.xin_project_tasks');?>
        </a> </li>
       <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/general-tasks-list');?>" >
        <?= lang('Main.xin_general_tasks');?>
        </a> </li>
      <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/clients-list');?>">
        <?= lang('Dashboard.xin_project_clients');?>
        </a> </li>
      <li class="pc-item"> <a href="<?= site_url('erp/leads-list');?>" class="pc-link ">
	  	<?= lang('Dashboard.xin_leads');?>
    	</a></li> 
      <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/invoices-list');?>">
        <?= lang('Dashboard.xin_invoices_title');?>
        </a> </li>
      <li class="pc-item"><a class="pc-link" href="<?= site_url('erp/estimates-list');?>" >
        <?= lang('Dashboard.xin_estimates');?>
        </a> </li>
    </ul>
  </li>
  <?php endif; endif;?>
  <?php if(isset($setup_modules['performance'])): if($setup_modules['performance']==1):?>
  <!-- Performance -->
  <li class="<?php if(!empty($arr_mod['talent_open']))echo $arr_mod['talent_open'];?> pc-item"> <a href="#" class="pc-link sidenav-toggle"> <span class="pc-micon"><i data-feather="aperture"></i></span><span class="mmenu-performance"><?= lang('Dashboard.left_talent_management');?></span><span class="pc-arrow"><i data-feather="chevron-right"></i></span> </a>
    <ul class="pc-submenu">
      <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/performance-indicator-list');?>" >
        <?= lang('Dashboard.left_performance_indicator');?>
        </a> </li>
      <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/performance-appraisal-list');?>">
        <?= lang('Dashboard.left_performance_appraisal');?>
        </a> </li>
      <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/competencies');?>">
        <?= lang('Performance.xin_competencies');?>
        </a> </li>
      <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/track-goals');?>" >
        <?= lang('Dashboard.xin_hr_goal_tracking');?>
        </a> </li>
      <li class="pc-item"><a class="pc-link" href="<?= site_url('erp/goal-type');?>" >
        <?= lang('Dashboard.xin_hr_goal_tracking_type');?>
        </a> </li>
     <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/goals-calendar');?>" >
        <?= lang('Performance.xin_goals_calendar');?>
        </a> </li>
    </ul>
  </li>
  <?php endif; endif;?>
  
  
  
  <?php if(isset($setup_modules['finance'])): if($setup_modules['finance']==1):?>
  <li class="pc-item"> <a href="<?= site_url('erp/accounts-list');?>" class="pc-link"> <span class="pc-micon"><i data-feather="file-plus"></i></span><span class="mmenu-training"><?= lang('Dashboard.xin_hr_finance');?></span> </a> </li>
  <?php endif; endif;?>
  <?php if(isset($setup_modules['payroll'])): if($setup_modules['payroll']==1):?>
  <!-- Payroll -->
  <li class="pc-item"> <a href="<?= site_url('erp/payroll-list');?>" class="pc-link"> <span class="pc-micon"><i data-feather="credit-card"></i></span><span class="mmenu-short"><?= lang('Dashboard.left_payroll');?></span></a></li>
  <?php endif; endif;?>  
  <!-- Leave -->
  <li class="pc-item"> <a href="<?= site_url('erp/leave-list');?>" class="pc-link"> <span class="pc-micon"><i data-feather="plus-square"></i></span><span class="mmenu-short-leave"><?= lang('Main.xin_leave_title');?></span> </a> </li>
  <?php if(isset($setup_modules['recruitment'])): if($setup_modules['recruitment']==1):?>
  <!-- Recruitment -->
  <li class="pc-item"> <a href="<?= site_url('erp/jobs-list');?>" class="pc-link"> <span class="pc-micon"><i data-feather="gitlab"></i></span><span class="mmenu-performance"><?= lang('Recruitment.xin_recruitment_ats');?></span></a></li>
    <?php endif; endif;?>
  <!-- upload_files -->
  <li class="pc-item"> <a href="<?= site_url('erp/signature-files');?>" class="pc-link"> <span class="pc-micon"><i data-feather="file-plus"></i></span><span class="mmenu"><?= lang('Dashboard.xin_upload_files');?></span> </a> </li>
  <!-- Tickets -->
  <?php if(!isset($setup_modules['finance'])):?>
  <li class="pc-item"> <a href="<?= site_url('erp/support-tickets');?>" class="pc-link"> <span class="pc-micon"><i data-feather="help-circle"></i></span><span class="mmenu-help"><?= lang('Dashboard.dashboard_helpdesk');?></span> </a> </li>
  <?php endif;?>
</ul>
