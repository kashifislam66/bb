<?php
use App\Models\SystemModel;
use App\Models\UsersModel;

$SystemModel = new SystemModel();
$UsersModel = new UsersModel();	

$session = \Config\Services::session();
$usession = $session->get('cand_username');
$router = service('router');

$xin_system = $SystemModel->where('setting_id', 1)->first();
?>

<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title><?= $title;?></title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="<?= base_url();?>/public/frontend/jobs/css/style.css">
<link rel="stylesheet" href="<?= base_url();?>/public/frontend/jobs/dashboard-2.html">
<link rel="stylesheet" href="<?= base_url();?>/public/frontend/jobs/css/colors.css">
<link rel="stylesheet" href="<?= base_url('public/assets/plugins/toastr/toastr.css');?>">

</head>

<body>
<div id="wrapper">



<!-- Header
================================================== -->
<header class="dashboard-header">
<div class="container">
	<div class="sixteen columns">

		<!-- Logo -->
		<div id="logo">
			<h1><a href="<?php echo site_url('');?>"><img src="<?= base_url();?>/public/uploads/logo/other/<?= $xin_system['other_logo'];?>" alt="" /></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">
			<ul id="responsive">

				<li><a href="<?php echo site_url('jobs');?>">Jobs Listing</a><li>
				<li><a href="<?php echo site_url('search-jobs');?>">Search Jobs</a></li>
                <li><a href="<?php echo site_url('contact');?>">Contact Us</a></li>
			</ul>


			<ul class="responsive float-right">
				<li><a href="<?= site_url('jobs-dashboard');?>"><i class="fa fa-cog"></i> Dashboard</a></li>
				<li><a href="<?= site_url('jobs-signout');?>"><i class="fa fa-lock"></i> Log Out</a></li>
			</ul>

		</nav>

		<!-- Navigation -->
		<div id="mobile-navigation">
			<a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i></a>
		</div>

	</div>
</div>
</header>
<div class="clearfix"></div>


<!-- Titlebar
================================================== -->

<!-- Dashboard -->
<div id="dashboard">

	<!-- Navigation
	================================================== -->

	<!-- Responsive Navigation Trigger -->
	<a href="#" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> Dashboard Navigation</a>

	<div class="dashboard-nav">
		<div class="dashboard-nav-inner">

			<ul data-submenu-title="Start">
				<li><a href="<?= site_url('jobs-dashboard');?>">Applied Jobs</a></li>
                <li><a href="<?= site_url('interviews');?>">Call for Interview</a></li>
                <li><a href="<?= site_url('rejected-applications');?>">Rejected Applications</a></li>
			</ul>	

			<ul data-submenu-title="Account">
            	<li><a href="<?= site_url('update-profile');?>">My Profile</a></li>
            	<li><a href="<?= site_url('change-account-password');?>">Change Password</a></li>
				<li><a href="<?= site_url('jobs-signout');?>">Logout</a></li>
			</ul>
			
		</div>
	</div>
	<!-- Navigation / End -->


	<!-- Content
	================================================== -->
	<div class="dashboard-content">
    		<?php echo $subview;?>
			<!-- Copyrights -->
			<div class="col-md-12">
				<div class="copyrights">© <?= date('Y');?> WorkScout. All Rights Reserved.</div>
			</div>
		</div>

	</div>
	<!-- Content / End -->


</div>
<!-- Dashboard / End -->


</div>
<!-- Wrapper / End -->


<!-- Scripts
================================================== -->
<script src="<?= base_url();?>/public/frontend/jobs/scripts/jquery-3.4.1.min.js"></script>
<script src="<?= base_url();?>/public/frontend/jobs/scripts/jquery-migrate-3.1.0.min.js"></script>
<script src="<?= base_url();?>/public/frontend/jobs/scripts/custom.js"></script>
<script src="<?= base_url();?>/public/frontend/jobs/scripts/jquery.superfish.js"></script>
<script src="<?= base_url();?>/public/frontend/jobs/scripts/jquery.themepunch.tools.min.js"></script>
<script src="<?= base_url();?>/public/frontend/jobs/scripts/jquery.themepunch.revolution.min.js"></script>
<script src="<?= base_url();?>/public/frontend/jobs/scripts/jquery.themepunch.showbizpro.min.js"></script>
<script src="<?= base_url();?>/public/frontend/jobs/scripts/jquery.flexslider-min.js"></script>
<script src="<?= base_url();?>/public/frontend/jobs/scripts/chosen.jquery.min.js"></script>
<script src="<?= base_url();?>/public/frontend/jobs/scripts/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url();?>/public/frontend/jobs/scripts/waypoints.min.js"></script>
<script src="<?= base_url();?>/public/frontend/jobs/scripts/jquery.counterup.min.js"></script>
<script src="<?= base_url();?>/public/frontend/jobs/scripts/jquery.jpanelmenu.js"></script>
<script src="<?= base_url();?>/public/frontend/jobs/scripts/stacktable.js"></script>
<script src="<?= base_url();?>/public/frontend/jobs/scripts/slick.min.js"></script>
<script src="<?= base_url();?>/public/assets/plugins/toastr/toastr.js"></script>
<link rel="stylesheet" href="<?= base_url();?>/public/assets/plugins/ladda/ladda.css">
<script src="<?= base_url();?>/public/assets/plugins/spin/spin.js"></script>
<script src="<?= base_url();?>/public/assets/plugins/ladda/ladda.js"></script>

<script type="application/javascript">
	$(document).ready(function(){
		Ladda.bind('button[type=submit]');
        //Ladda.bind('button[type=submit]');
        toastr.options.closeButton = <?= $xin_system['notification_close_btn'];?>;
        toastr.options.progressBar = <?= $xin_system['notification_bar'];?>;
        toastr.options.timeOut = 3000;
        toastr.options.preventDuplicates = true;
        toastr.options.positionClass = "<?= $xin_system['notification_position'];?>";
    });
    </script>
<script type="text/javascript">
var desk_url = '<?php echo site_url('erp/desk'); ?>';
var processing_request = '<?= lang('Login.xin_processing_request');?>';</script>
<script type="text/javascript">var dt_lengthMenu = '<?= lang('Datatables.xin_dt_lengthMenu');?>';</script>
<script type="text/javascript">var dt_zeroRecords = '<?= lang('Datatables.xin_dt_zeroRecords');?>';</script>
<script type="text/javascript">var dt_info = '<?= lang('Datatables.xin_dt_info');?>';</script>
<script type="text/javascript">var dt_infoEmpty = '<?= lang('Datatables.xin_dt_infoEmpty');?>';</script>
<script type="text/javascript">var dt_infoFiltered = '<?= lang('Datatables.xin_dt_infoFiltered');?>';</script>
<script type="text/javascript">var dt_search = '<?= lang('Datatables.xin_dt_search');?>';</script>
<script type="text/javascript">var dt_first = '<?= lang('Datatables.dt_first');?>';</script>
<script type="text/javascript">var dt_previous = '<?= lang('Datatables.dt_previous');?>';</script>
<script type="text/javascript">var dt_next = '<?= lang('Datatables.dt_next');?>';</script>
<script type="text/javascript">var dt_last = '<?= lang('Datatables.dt_last');?>';</script>
<script type="text/javascript">var main_url = '<?= site_url(''); ?>';</script>
<script type="text/javascript">var processing_request = '<?= lang('Login.xin_processing_request');?>';</script>
<script type="text/javascript">var request_submitted = '<?= lang('Dashboard.xin_hr_request_submitted');?>';</script>
<script type="text/javascript" src="<?= base_url();?>/public/module_scripts/jobs/<?= $path_url;?>.js"></script>


</body>

</html>