<?php
use App\Models\SystemModel;
use App\Models\UsersModel;
use App\Models\FrontendcontentModel;

$SystemModel = new SystemModel();
$UsersModel = new UsersModel();	
$FrontendcontentModel = new FrontendcontentModel();

$session = \Config\Services::session();
$usession = $session->get('cand_username');
$router = service('router');

$xin_system = $SystemModel->where('setting_id', 1)->first();
$cms_page = $FrontendcontentModel->where('frontend_id', 1)->first();
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

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
<link rel="stylesheet" href="<?= base_url();?>/public/frontend/jobs/css/colors.css">
<link rel="stylesheet" href="<?= base_url('public/assets/plugins/toastr/toastr.css');?>">


</head>

<body>
<div id="wrapper">


<!-- Header
================================================== -->
<header class="sticky-header">
<div class="container">
	<div class="sixteen columns">
	
		<!-- Logo -->
		<div id="logo">
			<h1><a href="<?= site_url();?>"><img src="<?= base_url();?>/public/uploads/logo/other/<?= $xin_system['other_logo'];?>" alt="" /></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">
			<ul id="responsive">

				<li><a href="<?php echo site_url('jobs');?>">Home</a><li>
				<li><a href="<?php echo site_url('search-jobs');?>">Search Jobs</a></li>
                <li><a href="<?php echo site_url('contact');?>">Contact Us</a></li>
                <?php if(!$session->has('cand_username')){?>
                <li><a href="<?php echo site_url('signup');?>"><i class="fa fa-user"></i> Sign Up</a></li>
				<li><a href="<?php echo site_url('signin');?>"><i class="fa fa-lock"></i> Log In</a></li>
                <?php } else {?>
                <li><a href="<?php echo site_url('update-profile');?>"><i class="fa fa-user"></i> My Account</a></li>
                <?php } ?>
			</ul>
			<ul class="responsive float-right">
            	<li><a href="<?= site_url('jobs-dashboard');?>"><i class="fa fa-cog"></i> Dashboard</a></li>
                <?php if($session->has('cand_username')){?>
				<li><a href="<?= site_url('jobs-signout');?>"><i class="fa fa-lock"></i> Log Out</a></li>
                <?php } ?>
			</ul>

		</nav>

		<!-- Navigation -->
		<div id="mobile-navigation">
			<a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
		</div>

	</div>
</div>
</header>
<div class="clearfix"></div>

<!-- Container Start -->
<?php echo $subview;?>
<!-- Container End -->
<!-- Footer
================================================== -->
<div class="margin-top-0"></div>

<div id="footer">
	<!-- Main -->
	<div class="container">

		<div class="seven columns">
			<h4>About</h4>
			<p><?= $cms_page['about_short'];?></p>
		</div>

		<div class="three columns">
			<h4>Company</h4>
			<ul class="footer-links">
				<li><a href="<?= site_url('page-view/').uencode(5);?>">About Us</a></li>
                <li><a href="<?= site_url('page-view/').uencode(6);?>">Communications</a></li>
				<li><a href="<?= site_url('page-view/').uencode(2);?>">Terms of Service</a></li>
				<li><a href="<?= site_url('page-view/').uencode(1);?>">Privacy Policy</a></li>
			</ul>
		</div>
		
		<div class="three columns">
			<h4>&nbsp;</h4>
			<ul class="footer-links">
				<li><a href="<?= site_url('page-view/').uencode(7);?>">How It Works</a></li>
				<li><a href="<?= site_url('page-view/').uencode(8);?>">Disclaimers</a></li>
			</ul>
		</div>		

		<div class="three columns">
			<h4>Follow Us</h4>
			<ul class="footer-links">
				<li><a href="<?= $cms_page['fb_profile'];?>" target="_blank">Facebook</a></li>
				<li><a href="<?= $cms_page['twitter_profile'];?>" target="_blank">Twitter</a></li>
				<li><a href="<?= $cms_page['linkedin_profile'];?>" target="_blank">Linkedin</a></li>
			</ul>
		</div>

	</div>

	<!-- Bottom -->
	<div class="container">
		<div class="footer-bottom">
			<div class="sixteen columns">
				<div class="copyrights">©  Copyright <?= date('Y');?>. All Rights Reserved.</div>
			</div>
		</div>
	</div>

</div>

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>

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
<script src="<?= base_url();?>/public/frontend/jobs/scripts/headroom.min.js"></script>

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
<style type="text/css">
.pagination {display: flex !important; margin:9px 0 15px 0 !important; }
.pagination li{ margin-left:5px !important; }
</style>
</body>
</html>