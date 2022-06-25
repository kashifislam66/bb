<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\ConstantsModel;


$SystemModel = new SystemModel();
$UserRolesModel = new RolesModel();
$UsersModel = new UsersModel();
$ConstantsModel = new ConstantsModel();

$xin_system = $SystemModel->where('setting_id', 1)->first();
$role_user = $UserRolesModel->where('role_id', 1)->first();

$session = \Config\Services::session();
$router = service('router');

$username = $session->get('sup_username');
$user_id = $username['sup_user_id'];
$user_info = $UsersModel->where('user_id', $user_id)->first();
$company_types = $ConstantsModel->where('type','company_type')->orderBy('constants_id', 'ASC')->findAll();
if($xin_system['light_sidebar']==1){
	$light_sidebar = 'light-sidebar';
} else {
	$light_sidebar = 'nolight-sidebar';
}
if($xin_system['template_option']==1){
	$minimenu = 'minimenu';
} else {
	$minimenu = '';
}
if($user_info['user_type'] == 'super_user'){
	$bg_option = $xin_system['header_background'];
} else if($user_info['user_type'] == 'company'){
	$bg_option = $xin_system['header_background'];
} else if($user_info['user_type'] == 'customer'){
	$bg_option = $xin_system['header_background'];
} else if($user_info['user_type'] == 'staff'){
	$bg_option = $xin_system['header_background'];
} else {
	$bg_option = 'bg-success';
}
?>
<?= view('default/htmlheader');?>
<body class="creative-layout <?= $minimenu;?>">
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
<!-- [ Pre-loader ] End --> 
<!-- [ Mobile header ] start -->
<div class="pc-mob-header pc-header">
  <div class="pcm-logo">
			<img src="<?= base_url();?>/public/uploads/logo/<?= $xin_system['logo'];?>" alt="" class="logo logo-lg">
		</div>
  <div class="pcm-toolbar">
        <a href="#!" class="pc-head-link" id="mobile-collapse">
            <div class="hamburger hamburger--arrowturn">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </div>
        </a>
        <a href="#!" class="pc-head-link" id="headerdrp-collapse">
            <i data-feather="align-right"></i>
        </a>
        <a href="#!" class="pc-head-link" id="header-collapse">
            <i data-feather="more-vertical"></i>
        </a>
    </div>
</div>
<!-- [ Mobile header ] End --> 
<!-- [ navigation menu ] start -->
<nav class="pc-sidebar <?= $light_sidebar;?>">
  <div class="navbar-wrapper">
   <div class="m-header <?= $bg_option;?>">
        <a href="<?= site_url('erp/desk');?>" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="<?= base_url();?>/public/uploads/logo/<?= $xin_system['logo'];?>" alt="" class="logo logo-lg">
             <img src="<?= base_url();?>/public/uploads/logo/360hris_icon.svg" alt="" class="logo logo-sm"> 
        </a>
    </div>
    <div class="navbar-content">
      <?= view('default/left_menu')?>
    </div>
  </div>
</nav>
<!-- [ navigation menu ] end --> 
<!-- [ Header ] start -->
<?= view('default/header')?>
<!-- [ Header ] end --> 

<!-- [ Main Content ] start -->
<div class="pc-container">
  <div class="pcoded-content"> 
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-4 col-sm-8 col pe-0 mb-1"> 
            <ul class="breadcrumb">
              <?php //if($router->controllerName() == '\App\Controllers\Erp\Dashboard') { ?>
              <li class="breadcrumb-item">
                <div class="align-middle d-flex">
                    <img src="<?= staff_profile_photo($user_id);?>" alt="" class="img-radius wid-40 align-top m-r-15 me-lg-3 me-1">
                    <div class="d-inline-block">
                      <a href="<?= site_url('erp/my-profile');?>">
                      <h6><?= $user_info['first_name'].' '.$user_info['last_name'];?>
                        <p class="text-muted m-b-0">@<?= $user_info['username'];?></p></h6>
                      </a>
                    </div>
                </div>
                </li>
                <?php /*?><?php } else {?>
                <li class="breadcrumb-item"><a href="<?= site_url('erp/desk')?>">
					<?= lang('Dashboard.dashboard_title');?>
                    </a></li>
                  <li class="breadcrumb-item">
                    <?= $breadcrumbs;?>
                  </li>
                <?php } ?><?php */?>
            </ul>
          </div>
          <?php if($user_info['user_type'] != 'customer' && $user_info['user_type'] != 'super_user' && $user_info['user_type'] != 'staff'){?>
          <?php $profile_completeness = dashboard_profile_completeness();?>
          <div class="col-md-4 col-sm mb-md-0 mb-2 ms-auto text-md-rdight">
            <div class="row align-items-center">
              <div class="col-lg-auto col-12 mb-1 mb-sm-0 dropdown"> <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <h6 class="m-b-0 dropdown-toggle">
                  <?= lang('Dashboard.dashboard_profile_complete');?>
                </h6>
                </a>
                <div class="dropdown-menu dropdown-menu-center"> <a href="<?= site_url('erp/departments-list')?>" class="dropdown-item"><i class="material-icons-two-tone">view_list</i><span>
                  <?= lang('Dashboard.left_department');?>
                  <i data-feather="check-circle" <?php if($profile_completeness['departments']==1):?>class="text-success"<?php endif;?>></i></span> </a> <a href="<?= site_url('erp/designation-list')?>" class="dropdown-item"><i class="material-icons-two-tone">view_list</i><span>
                  <?= lang('Dashboard.left_designation');?>
                  <i data-feather="check-circle" <?php if($profile_completeness['designations']==1):?>class="text-success"<?php endif;?>></i></span> </a> <a href="<?= site_url('erp/set-roles')?>" class="dropdown-item"><i class="material-icons-two-tone">recent_actors</i><span>
                  <?= lang('Dashboard.left_set_roles');?>
                  <i data-feather="check-circle" <?php if($profile_completeness['roles']==1):?>class="text-success"<?php endif;?>></i></span> </a> <a href="<?= site_url('erp/office-shifts')?>" class="dropdown-item"><i class="material-icons-two-tone">timer</i><span>
                  <?= lang('Employees.xin_employee_office_shifts');?>
                  <i data-feather="check-circle" <?php if($profile_completeness['office_shifts']==1):?>class="text-success"<?php endif;?>></i></span> </a> <a href="<?= site_url('erp/competencies')?>" class="dropdown-item"><i class="material-icons-two-tone">view_day</i><span>
                  <?= lang('Performance.xin_competencies');?>
                  <i data-feather="check-circle" <?php if($profile_completeness['competencies'] == 1):?>class="text-success"<?php endif;?>></i></span> </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" target="_blank" href="<?= site_url('contact')?>"><i class="material-icons-two-tone">help</i>
                  <?= lang('Membership.xin_need_more_help');?>
                  </a> </div>
              </div>
              <div class="col">
                <div class="progress" style="height:8px">
                  <div class="progress-bar bg-success" style="width:<?= $profile_completeness['percent'];?>%"></div>
                </div>
              </div>
              <div class="col-auto">
                <h6 class="m-b-0">
                  <?= $profile_completeness['percent'];?>
                  %</h6>
              </div>
            </div>
          </div>
          <?php $colval = '4';?>
          <?php } else {?>
          <?php $colval = '8';?>
          <?php }?>
          <div class="col-md-<?= $colval;?> col-auto ms-auto text-md-end page-header-action-col"> <div class="pc-head-content">
                <ul class="list-inline m-0">
                	<?php if($user_info['user_type'] == 'company' || $user_info['user_type'] == 'staff' || $user_info['user_type'] == 'super_user'){?>
                	<!-- tickets -->
                	<li class="list-inline-item"><a href="<?= site_url('erp/tickets-list')?>" data-toggle="tooltip" data-placement="top" title="<?= lang('Users.xin_company_support_tickets');?>"><i class="material-icons-two-tone">help</i></a></li>
                    <?php } ?>
                    <!-- system settings > super admin -->
					<?php if($user_info['user_type'] == 'super_user'){?>
                    <li class="list-inline-item"><a href="<?= site_url('erp/system-settings')?>" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_configuration_wizard');?>"><i class="material-icons-two-tone">settings</i></a></li>
                    <?php } ?>
                    <?php if($user_info['user_type'] == 'company' || $user_info['user_type'] == 'staff'){?>
                    <?php
					$cl_xin_system = erp_company_settings();
					$ssetup_modules = unserialize($cl_xin_system['setup_modules']);
					?>
                    <!-- system import -->
                    <?php if(isset($ssetup_modules['re_module'])): if($ssetup_modules['re_module']==1 || $ssetup_modules['re_module']==3 || $ssetup_modules['re_module']==4):?>
                    <?php if(in_array('system_import',staff_role_resource()) || $user_info['user_type'] == 'company'):?>
                    <li class="list-inline-item"><a href="<?= site_url('erp/staff-import')?>" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_hr_import');?>"><i class="material-icons-two-tone">cloud_upload</i></a></li>
                    <?php endif;?>
                    <?php endif; endif;?>
                    <!-- system reports -->
                    <?php if(in_array('system_reports',staff_role_resource()) || $user_info['user_type'] == 'company'):?>
                    <li class="list-inline-item"><a href="<?= site_url('erp/system-reports')?>" data-toggle="tooltip" data-placement="top" title="<?= lang('Dashboard.xin_system_reports');?>"><i class="material-icons-two-tone">insert_chart</i></a></li>
                    <?php endif;?>
                    <!-- system calendar -->
                    <?php if(in_array('system_calendar',staff_role_resource()) || $user_info['user_type'] == 'company'):?>
                    <li class="list-inline-item"><a href="<?= site_url('erp/system-calendar')?>" data-toggle="tooltip" data-placement="top" title="<?= lang('Dashboard.xin_system_calendar');?>"><i class="material-icons-two-tone">calendar_today</i></a></li>
                    <?php endif;?>
                    <?php } ?>
                    <li class="list-inline-item"><a href="<?= site_url('erp/system-logout')?>" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_logout');?>"><i class="material-icons-two-tone">settings_power</i></a></li>
                </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end --> 
    <!-- [ Main Content ] start -->
    <?= $subview;?>
    <!-- [ Main Content ] end --> 
  </div>
</div>
<!-- [ Main Content ] end -->
</div>
<?= view('default/footer')?>
<?= view('default/htmlfooter')?>
</body>
</html>