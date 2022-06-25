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
<?php } ?>
<ul class="pc-navbar">
  <!-- Dashboard|Home -->
  <li class="pc-item">
        <a href="<?= site_url('erp/desk');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">dashboard</i></span><span
                class="pc-mtext"><?= lang('Dashboard.dashboard_title');?></span></a>
    </li>
  <!-- subscription -->
  <li class="pc-item">
        <a href="<?= site_url('erp/my-subscription');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">card_membership</i></span><span
                class="pc-mtext"><?= lang('Membership.xin_subscription');?></span></a>
    </li>
  <!-- Freelancers -->
  <li class="pc-item pc-hasmenu">
        <a href="#!" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">group_add</i></span><span
                class="pc-mtext"><?= lang('Main.xin_freelancers');?></span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
        <ul class="pc-submenu">
            <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/staff-list');?>" >
			<?= lang('Main.xin_freelancers');?>
            </a> </li>
            <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/staff-grid');?>" >
            <?= lang('Main.xin_directory');?>
            </a> </li>
            <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/set-roles');?>" >
            <?= lang('Dashboard.left_set_roles');?>
            </a> </li>        
           <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/departments-list');?>" >
            <?= lang('Dashboard.left_department');?>
            </a> </li>
            <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/designation-list');?>" >
            <?= lang('Dashboard.left_designation');?>
            </a> </li>
          <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/chart');?>" >
            <?= lang('Dashboard.xin_org_chart_title');?>
            </a> </li>
        </ul>
    </li>
  <!-- Projects -->
  <li class="pc-item">
        <a href="<?= site_url('erp/projects-grid');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">layers</i></span><span
                class="pc-mtext"><?= lang('Dashboard.left_projects');?></span></a>
    </li>
  <!-- Tasks -->
  <li class="pc-item">
        <a href="<?= site_url('erp/tasks-grid');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">library_add_check</i></span><span
                class="pc-mtext"><?= lang('Projects.xin_tasks');?></span></a>
    </li>
  <!-- Attendance -->
  <li class="pc-item pc-hasmenu">
        <a href="#!" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">access_time</i></span><span
                class="pc-mtext"><?= lang('Dashboard.left_attendance');?></span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
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
  <!-- Clients -->
  <li class="pc-item">
        <a href="<?= site_url('erp/clients-list');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">supervised_user_circle</i></span><span
                class="pc-mtext"><?= lang('Dashboard.xin_project_clients');?></span></a>
    </li>
  <!-- Invoices -->
  <li class="pc-item">
        <a href="<?= site_url('erp/invoices-list');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">event_available</i></span><span
                class="pc-mtext"><?= lang('Dashboard.xin_invoices_title');?></span></a>
    </li>
  <!-- Estimates -->
  <li class="pc-item">
        <a href="<?= site_url('erp/estimates-list');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">request_quote</i></span><span
                class="pc-mtext"><?= lang('Dashboard.xin_estimates');?></span></a>
    </li>
  <?php if(isset($setup_modules['finance'])): if($setup_modules['finance']==1):?>
  <li class="pc-item">
        <a href="<?= site_url('erp/accounts-list');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">account_balance_wallet</i></span><span
                class="pc-mtext"><?= lang('Dashboard.xin_hr_finance');?></span></a>
    </li>
  <?php endif; endif;?>
  <li class="pc-item">
        <a href="<?= site_url('erp/tickets-list');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">help</i></span><span
                class="pc-mtext"><?= lang('Dashboard.dashboard_helpdesk');?></span></a>
    </li>
  
</ul>
