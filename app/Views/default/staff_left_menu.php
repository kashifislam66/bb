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
$xin_com_system = erp_company_settings();
$setup_modules = unserialize($xin_com_system['setup_modules']);
?>
<?php $arr_mod = select_module_class($router->controllerName(),$router->methodName()); ?>
<ul class="pc-navbar">
  <!-- Dashboard|Home -->
  <li class="pc-item">
        <a href="<?= site_url('erp/desk');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">dashboard</i></span><span
                class="pc-mtext"><?= lang('Dashboard.dashboard_title');?></span></a>
    </li>
  <?php if(in_array('attendance',staff_role_resource())) {?>  
  <!-- Attendance -->
  <li class="pc-item">
        <a href="<?= site_url('erp/attendance-list');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">access_time</i></span><span
                class="pc-mtext"><?= lang('Dashboard.left_attendance');?></span></a>
    </li>
  <?php } ?>  
  <!-- Payroll -->
  <?php if(in_array('pay_history',staff_role_resource())) {?> 
  <li class="pc-item">
        <a href="<?= site_url('erp/payslip-history');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">payments</i></span><span
                class="pc-mtext"><?= lang('Dashboard.left_payroll');?></span></a>
    </li>
  <?php } ?>
  <?php if(in_array('leave2',staff_role_resource()) || in_array('leave_adjustment',staff_role_resource()) || in_array('expense1',staff_role_resource()) || in_array('loan1',staff_role_resource()) || in_array('travel1',staff_role_resource()) || in_array('advance_salary1',staff_role_resource()) || in_array('overtime_req1',staff_role_resource())) {?>
  <!-- Requests -->
  <li class="pc-item pc-hasmenu">
        <a href="#!" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">flip_to_back</i></span><span
                class="pc-mtext"><?= lang('Dashboard.dashboard_requests');?></span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
        <ul class="pc-submenu">
            <?php if(in_array('leave2',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/leave-list');?>?type=apply" >
                <?= lang('Leave.left_leave_request');?>
                </a> </li>
              <?php } ?>
              <?php if(in_array('leave_adjustment',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/leave-adjustment');?>" >
                <?= lang('Main.xin_leave_adjustment');?>
                </a> </li>
              <?php } ?>
              <?php if(isset($setup_modules['finance'])): if($setup_modules['finance']==1):?>
              <?php if(in_array('expense1',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/expense-list');?>" >
                <?= lang('Dashboard.dashboard_expense_claim');?>
                </a> </li>
              <?php } ?>
              <?php endif; endif;?>
              <?php if(in_array('loan1',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/loan-request');?>" >
                <?= lang('Main.xin_request_loan');?>
                </a> </li>
              <?php } ?>
              <?php if(in_array('travel1',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/business-travel');?>?type=apply" >
                <?= lang('Dashboard.dashboard_travel_request');?>
                </a> </li>
              <?php } ?>
              <?php if(in_array('advance_salary1',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/advance-salary');?>" >
                <?= lang('Main.xin_advance_salary');?>
                </a> </li>
              <?php } ?>
              <?php if(in_array('overtime_req1',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/overtime-request');?>?type=apply" >
                <?= lang('Dashboard.xin_overtime_request');?>
                </a> </li>
              <?php } ?>
        </ul>
    </li>
  <?php } ?>
    <?php if(in_array('staff2',staff_role_resource()) || in_array('shift1',staff_role_resource()) || in_array('staffexit1',staff_role_resource())) {?>
  <!-- Employees -->
  <li class="pc-item">
        <a href="<?= site_url('erp/staff-list');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">group_add</i></span><span
                class="pc-mtext"><?= lang('Dashboard.dashboard_employees');?></span></a>
    </li>
  <?php } ?>
  <?php if(isset($setup_modules['finance'])): if($setup_modules['finance']==1):?>
  <?php if(in_array('accounts1',staff_role_resource()) || in_array('deposit1',staff_role_resource()) || in_array('expense1',staff_role_resource()) || in_array('transaction1',staff_role_resource())) {?>
  <li class="pc-item">
        <a href="<?= site_url('erp/accounts-list');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">account_balance_wallet</i></span><span
                class="pc-mtext"><?= lang('Dashboard.xin_hr_finance');?></span></a>
    </li>
  <?php } ?>
  <?php endif; endif;?>
  <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==2 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
  <?php if(in_array('project1',staff_role_resource()) || in_array('task1',staff_role_resource()) || in_array('client1',staff_role_resource()) || in_array('invoice2',staff_role_resource()) || in_array('estimate2',staff_role_resource())) {?>
  <!-- Projects -->
  <li class="pc-item pc-hasmenu">
        <a href="#!" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">layers</i></span><span
                class="pc-mtext"><?= lang('Dashboard.left_projects');?></span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
        <ul class="pc-submenu">
            <?php if(in_array('project1',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/projects-grid');?>" >
                <?= lang('Dashboard.left_projects');?>
                </a> </li>
              <?php } ?>
              <?php if(in_array('task1',staff_role_resource())) {?>  
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/tasks-grid');?>" >
                <?= lang('Dashboard.left_tasks');?>
                </a> </li>
              <?php } ?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/general-tasks-list');?>" >
                <?= lang('Main.xin_general_tasks');?>
                </a> </li>
              <?php if(in_array('client1',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/clients-list');?>">
                <?= lang('Dashboard.xin_project_clients');?>
                </a> </li>
               <?php } ?>
              <?php if(in_array('invoice2',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/invoices-list');?>">
                <?= lang('Dashboard.xin_invoices_title');?>
                </a> </li>
              <?php } ?>
              <?php if(in_array('estimate2',staff_role_resource())) {?>
              <li class="pc-item"><a class="pc-link" href="<?= site_url('erp/estimates-list');?>" >
                <?= lang('Dashboard.xin_estimates');?>
                </a> </li>
              <?php } ?>
        </ul>
    </li>
  <?php } ?>
  <?php endif; endif;?>
  <?php if(in_array('news1',staff_role_resource()) || in_array('department1',staff_role_resource()) || in_array('designation1',staff_role_resource()) || in_array('policy1',staff_role_resource())) {?>
  <!-- CoreHR -->
  <li class="pc-item pc-hasmenu">
        <a href="#!" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">home_work</i></span><span
                class="pc-mtext"><?= lang('Dashboard.dashboard_core_hr');?></span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
        <ul class="pc-submenu">
            <?php if(in_array('department1',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/departments-list');?>" >
                <?= lang('Dashboard.left_department');?>
                </a> </li>
               <?php } ?>
              <?php if(in_array('designation1',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/designation-list');?>" >
                <?= lang('Dashboard.left_designation');?>
                </a> </li>
               <?php } ?>
              <?php if(in_array('policy1',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/policies-list');?>" >
                <?= lang('Dashboard.header_policies');?>
                </a> </li>
              <?php } ?>
              <?php if(in_array('news1',staff_role_resource())) {?>
              <li class="pc-item">
                    <a class="pc-link" href="<?= site_url('erp/news-list');?>">
                        <?= lang('Dashboard.left_announcement_make');?>
                    </a>
                </li>
             <?php } ?>
             <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
             <?php if(isset($setup_modules['events'])): if($setup_modules['events']==1):?>
             <?php if(in_array('conference1',staff_role_resource())) {?>
              <li class="pc-item">
                    <a class="pc-link" href="<?= site_url('erp/meeting-list');?>">
                        <?= lang('Dashboard.xin_hr_meetings');?>
                    </a>
                </li>
             <?php } ?>
             <?php endif; endif;?>
             <?php endif; endif;?>
             <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
             <?php if(isset($setup_modules['visitor_book'])): if($setup_modules['visitor_book']==1):?>
             <?php if(in_array('visitor1',staff_role_resource())) {?>
              <li class="pc-item">
                    <a class="pc-link" href="<?= site_url('erp/visitors-list');?>">
                        <?= lang('Main.xin_visitor_book');?>
                    </a>
                </li>
             <?php } ?>
             <?php endif; endif;?>
             <?php endif; endif;?>
        </ul>
    </li>
  <?php } ?>
  <?php if(in_array('indicator1',staff_role_resource()) || in_array('appraisal1',staff_role_resource()) || in_array('competency1',staff_role_resource()) || in_array('tracking1',staff_role_resource()) || in_array('track_type1',staff_role_resource()) || in_array('track_calendar',staff_role_resource())) {?>  
  <!-- Performance -->
  <li class="pc-item pc-hasmenu">
        <a href="#!" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">donut_small</i></span><span
                class="pc-mtext"><?= lang('Dashboard.left_talent_management');?></span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
        <ul class="pc-submenu">
            <?php if(in_array('indicator1',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/performance-indicator-list');?>" >
                <?= lang('Dashboard.left_performance_indicator');?>
                </a> </li>
              <?php } ?>
              <?php if(in_array('appraisal1',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/performance-appraisal-list');?>">
                <?= lang('Dashboard.left_performance_appraisal');?>
                </a> </li>
              <?php } ?>
              <?php if(in_array('competency1',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/competencies');?>">
                <?= lang('Performance.xin_competencies');?>
                </a> </li>
              <?php } ?>
              <?php if(in_array('tracking1',staff_role_resource())) {?>
              <li class="pc-item"> <a class="pc-link" href="<?= site_url('erp/track-goals');?>" >
                <?= lang('Dashboard.xin_hr_goal_tracking');?>
                </a> </li>
              <?php } ?>
              <?php if(in_array('track_type1',staff_role_resource())) {?>
              <li class="pc-item"><a class="pc-link" href="<?= site_url('erp/goal-type');?>" >
                <?= lang('Dashboard.xin_hr_goal_tracking_type');?>
                </a> </li>
              <?php } ?>
              <?php if(in_array('track_calendar',staff_role_resource())) {?>
              <li class="pc-item"><a class="pc-link" href="<?= site_url('erp/goals-calendar');?>" >
                <?= lang('Performance.xin_goals_calendar');?>
                </a> </li>
              <?php } ?>
        </ul>
    </li>
  <?php } ?>
  <!-- Tickets -->
  <?php if(in_array('helpdesk1',staff_role_resource())) {?> 
  <li class="pc-item">
        <a href="<?= site_url('erp/tickets-list');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">help</i></span><span
                class="pc-mtext"><?= lang('Dashboard.dashboard_helpdesk');?></span></a>
    </li>
  <?php } ?>
  <?php if(in_array('training1',staff_role_resource()) || in_array('trainer1',staff_role_resource()) || in_array('training_skill1',staff_role_resource()) || in_array('training_calendar',staff_role_resource())) {?> 
  <!-- Training Session -->
  <li class="pc-item">
        <a href="<?= site_url('erp/training-sessions');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">group_work</i></span><span
                class="pc-mtext"><?= lang('Dashboard.left_training');?></span></a>
    </li>
  <?php } ?>
  <?php if(in_array('ats2',staff_role_resource()) || in_array('candidate',staff_role_resource()) || in_array('interview',staff_role_resource()) || in_array('promotion',staff_role_resource())) {?>
  <!-- Recruitment -->
  <li class="pc-item">
        <a href="<?= site_url('erp/jobs-list');?>" class="pc-link "><span class="pc-micon"><i class="material-icons-two-tone">event_note</i></span><span
                class="pc-mtext"><?= lang('Recruitment.xin_recruitment_ats');?></span></a>
    </li>
  <?php } ?>  
</ul>