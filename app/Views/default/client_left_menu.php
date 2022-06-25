<?php
use App\Models\SystemModel;
use App\Models\SuperroleModel;
use App\Models\UsersModel;
use App\Models\MembershipModel;
use App\Models\CompanymembershipModel;

$SystemModel = new SystemModel();
$UsersModel = new UsersModel();
$SuperroleModel = new SuperroleModel();
$MembershipModel = new MembershipModel();
$CompanymembershipModel = new CompanymembershipModel();
$session = \Config\Services::session();
$router = service('router');
$usession = $session->get('sup_username');
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
$xin_system = $SystemModel->where('setting_id', 1)->first();
?>
<?php $arr_mod = select_module_class($router->controllerName(),$router->methodName()); ?>
<ul class="pc-navbar">
  <li class="pc-item pc-caption">
    <label>
      <?= lang('Main.xin_navigation');?>
    </label>
  </li>
  <!-- Dashboard|Home -->
  <li class="pc-item">
        <a href="<?= site_url('erp/desk');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">dashboard</i></span><span
                class="pc-mtext"><?= lang('Dashboard.dashboard_title');?></span></a>
    </li>
  <!-- Projects -->
  <li class="pc-item">
        <a href="<?= site_url('erp/my-projects-list');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">layers</i></span><span
                class="pc-mtext"><?= lang('Dashboard.left_projects');?></span></a>
    </li>
  <!-- Tasks -->
  <li class="pc-item">
        <a href="<?= site_url('erp/my-tasks-list');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">library_add_check</i></span><span
                class="pc-mtext"><?= lang('Projects.xin_tasks');?></span></a>
    </li>
  <!-- Invoices -->
  <li class="pc-item">
        <a href="<?= site_url('erp/my-invoices-list');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">event_available</i></span><span
                class="pc-mtext"><?= lang('Dashboard.xin_invoices_title');?></span></a>
    </li>
  <!-- Invoice Calendar -->
  <li class="pc-item">
        <a href="<?= site_url('erp/my-invoice-payments-list');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">payments</i></span><span
                class="pc-mtext"><?= lang('Main.xin_payments');?></span></a>
    </li>
  <li class="pc-item pc-caption">
    <label>
      <?= lang('Main.left_settings');?>
    </label>
    <span>
    <?= lang('Dashboard.xin_my_account');?>
    </span> </li>
  <!-- Account Settings -->
  <li class="pc-item">
        <a href="<?= site_url('erp/my-profile');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">account_circle</i></span><span
                class="pc-mtext"><?= lang('Dashboard.xin_my_account');?></span></a>
    </li>
  <!-- Logout -->
  <li class="pc-item">
        <a href="<?= site_url('erp/system-logout');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">settings_power</i></span><span
                class="pc-mtext"><?= lang('Main.xin_logout');?></span></a>
    </li>
  <?php //$arr_mod = select_module_class($router->controllerName(),$router->methodName()); ?>
</ul>
