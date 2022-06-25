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
	$mheader = 'bg-light';
} else {
	$mheader = '';
	$light_sidebar = 'nolight-sidebar';
}
$ci_erp_settings = $SystemModel->where('setting_id', 1)->first();
?>
<?= view('default/htmlheader');?>
<body class=" minimenu">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ Mobile header ] start -->
	<div class="pc-mob-header pc-header <?= $light_sidebar;?>">
		<div class="pcm-logo">
        	<img src="<?= base_url();?>/public/uploads/logo/<?= $ci_erp_settings['logo'];?>" alt="" class="logo logo-lg">
        	<?php /*?><?php if($user_info['user_type'] == 'super_user'){ ?>
			<img src="<?= base_url();?>/public/uploads/logo/<?= $ci_erp_settings['logo'];?>" alt="" class="logo logo-lg">
            <?php } else {?>
				<?php
                    if($user_info['user_type'] == 'company'){
                        $c_logo = $UsersModel->where('user_id',$username['sup_user_id'])->first();
                    } else {
                        $c_logo = $UsersModel->where('user_id',$user_info['company_id'])->first();
                    }
                ?>
                <img src="<?= base_url();?>/public/uploads/users/thumb/<?= $c_logo['profile_photo'];?>" alt="" class="logo logo-lg">
            <?php }?><?php */?>
		</div>
		<div class="pcm-toolbar d-flex">
			<a href="#!" class="pc-head-link" id="mobile-collapse">
				<div class="hamburger hamburger--arrowturn">
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
				</div>
				<!-- <i data-feather="menu"></i> -->
			</a>
			<a href="#!" class="pc-head-link" id="headerdrp-collapse">
				<i data-feather="align-right"></i>
			</a>
			<a href="#!" class="pc-head-link" id="header-collapse">
				<i data-feather="more-vertical"></i>
			</a>
            <a class="d-inline-flex d-lg-none logout-btn pc-head-link" href="<?= site_url('erp/system-logout')?>"><i class="feather icon-power"></i></a>
		</div>
	</div>
	<!-- [ Mobile header ] End -->

	<!-- [ navigation menu ] start -->
	<nav class="pc-sidebar <?= $light_sidebar;?>">
		<div class="navbar-wrapper">
			<div class="m-header <?= $mheader;?>">
				<a href="<?= site_url('erp/desk');?>" class="b-brand">
					<!-- ========   logo hear   ============ -->
                    <img src="<?= base_url();?>/public/uploads/logo/<?= $ci_erp_settings['logo'];?>" alt="" class="logo logo-lg" width="45" height="30">
					<img src="<?= base_url();?>/public/uploads/logo/<?= $ci_erp_settings['logo'];?>" alt="" class="logo logo-sm" width="45" height="30">
                    
                    <?php /*?><?php if($user_info['user_type'] == 'super_user'){ ?>
					<img src="<?= base_url();?>/public/uploads/logo/<?= $ci_erp_settings['logo'];?>" alt="" class="logo logo-lg" width="45" height="30">
					<img src="<?= base_url();?>/public/uploads/logo/<?= $ci_erp_settings['logo'];?>" alt="" class="logo logo-sm" width="45" height="30">
                    <?php } else {?>
						<?php
                        	if($user_info['user_type'] == 'company'){
								$c_logo = $UsersModel->where('user_id',$username['sup_user_id'])->first();
							} else {
								$c_logo = $UsersModel->where('user_id',$user_info['company_id'])->first();
							}
						?>
                        <img src="<?= base_url();?>/public/uploads/users/thumb/<?= $c_logo['profile_photo'];?>" alt="" class="logo logo-lg" width="45" height="30">
                        <img src="<?= base_url();?>/public/uploads/users/thumb/<?= $c_logo['profile_photo'];?>" alt="" class="logo logo-sm" width="45" height="30">
                    <?php }?><?php */?>
				</a>
			</div>
			<div class="navbar-content">
				<?= view('default/left_menu')?>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<?= view('default/header2')?>	
	<!-- [ Header ] end -->

<!-- [ Main Content ] start -->
<div class="pc-container">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-6 col">
                	<?php if($router->controllerName() != '\App\Controllers\Erp\Dashboard') { ?>
                    <div class="page-header-title">
                        <h5><?= $breadcrumbs;?></h5>
                    </div>
                    <?php } ?>
                    <ul class="breadcrumb d-inline-flex">
                        <?php if($router->controllerName() == '\App\Controllers\Erp\Dashboard') { ?>
                          <li class="breadcrumb-item">
                            <div class="align-middle">
                                <img src="<?= staff_profile_photo($user_id);?>" alt="" class="staff-profile-photo img-radius wid-40 align-top m-r-15">
                                <div class="d-inline-block">
                                  <a href="<?= site_url('erp/my-profile');?>">
                                  <h6><?= $user_info['first_name'].' '.$user_info['last_name'];?>
                                    <p class="text-muted m-b-0">@<?= $user_info['username'];?></p></h6>
                                  </a>
                                </div>
                            </div>
                        </li>
						<?php } else {?>
                        <li class="breadcrumb-item"><a href="<?= site_url('erp/desk')?>">
                            <?= lang('Dashboard.dashboard_title');?>
                            </a></li>
                          <li class="breadcrumb-item">
                            <?= $breadcrumbs;?>
                          </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php if($user_info['user_type'] != 'customer' && $user_info['user_type'] != 'super_user' && $user_info['user_type'] != 'staff'){?>
				  <?php $profile_completeness = dashboard_profile_completeness();?>
                  <div class="col-md-6 col-lg-4 text-md-rdight mt-md-0 mt-2">
                    <div class="row form-row align-items-center">
                      <div class="col-auto dropdown"> <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <h6 class="m-b-0 dropdown-toggle">
                          <?= lang('Dashboard.dashboard_profile_complete');?>
                        </h6>
                        </a>
                        <div class="dropdown-menu dropdown-menu-center"> <a href="<?= site_url('erp/departments-list')?>" class="dropdown-item"> <i data-feather="align-justify"></i> <span>
                          <?= lang('Dashboard.left_department');?>
                          <i data-feather="check-circle" <?php if($profile_completeness['departments']==1):?>class="text-success"<?php endif;?>></i></span> </a> <a href="<?= site_url('erp/designation-list')?>" class="dropdown-item"> <i data-feather="list"></i> <span>
                          <?= lang('Dashboard.left_designation');?>
                          <i data-feather="check-circle" <?php if($profile_completeness['designations']==1):?>class="text-success"<?php endif;?>></i></span> </a> <a href="<?= site_url('erp/set-roles')?>" class="dropdown-item"> <i data-feather="unlock"></i> <span>
                          <?= lang('Dashboard.left_set_roles');?>
                          <i data-feather="check-circle" <?php if($profile_completeness['roles']==1):?>class="text-success"<?php endif;?>></i></span> </a> <a href="<?= site_url('erp/office-shifts')?>" class="dropdown-item"> <i data-feather="clock"></i> <span>
                          <?= lang('Employees.xin_employee_office_shifts');?>
                          <i data-feather="check-circle" <?php if($profile_completeness['office_shifts']==1):?>class="text-success"<?php endif;?>></i></span> </a> <a href="<?= site_url('erp/competencies')?>" class="dropdown-item"> <i data-feather="list"></i> <span>
                          <?= lang('Performance.xin_competencies');?>
                          <i data-feather="check-circle" <?php if($profile_completeness['competencies'] == 1):?>class="text-success"<?php endif;?>></i></span> </a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" target="_blank" href="<?= site_url('contact')?>"><i data-feather="help-circle"></i>
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
                  <?php $colval = '2';?>
                  <?php } else {?>
                  <?php $colval = '6';?>
                  <?php }?>
                  <div class="d-lg-block d-none col-md-<?= $colval;?> text-right logout-btn-col"> <a class="btn btn-smb btn-outline-primary rounded-pill logout-btn" href="<?= site_url('erp/system-logout')?>"><i class="feather icon-power"></i>
                    <?= lang('Main.xin_logout');?>
                    </a> </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <?= $subview;?>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
</div>
    <!-- Required Js -->
    <?= view('default/htmlfooter')?>
</body>

</html>