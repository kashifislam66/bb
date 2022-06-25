<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\FrontendcontentModel;

$SystemModel = new SystemModel();
$UserRolesModel = new RolesModel();
$FrontendcontentModel = new FrontendcontentModel();

$session = \Config\Services::session();
$session = $session->get('sup_username');
$router = service('router');

$xin_system = $SystemModel->where('setting_id', 1)->first();
$cms_page = $FrontendcontentModel->where('frontend_id', 1)->first();
?>
<?php if($router->methodName() =='pricing'){?>
<footer class="footer__area grey-bg-3 pt-200 p-relative">
<?php } else { ?>
<footer class="footer__area grey-bg-3 pt-60 p-relative fix">
<?php } ?>
 <div class="footer__shape">
	<img class="footer-circle-1 footer-2-circle-1" src="assets/img/icon/footer/home-1/circle-1.png" alt="">
	<img class="footer-circle-2 footer-2-circle-2" src="assets/img/icon/footer/home-1/circle-2.png" alt="">
 </div>
 <div class="footer__top pb-45">
	<div class="container">
	   <div class="row">
		  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay=".3s">
			 <div class="footer__widget mb-50">
				<div class="footer__widget-title mb-25">
				   <div class="footer__logo">
					  <a href="#">
						 <img src="<?= base_url();?>/public/uploads/logo/other/<?= $xin_system['other_logo'];?>" alt="logo">
					  </a>
				   </div>
				</div>
				<div class="footer__widget-content">
				   <p><?= $cms_page['about_short'];?></p>
				</div>
			 </div>
		  </div>
		  <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".5s">
			 <div class="footer__widget mb-50 footer__pl-70">
				<div class="footer__widget-title mb-25">
				   <h3>Company</h3>
				</div>
				<div class="footer__widget-content">
				   <div class="footer__link footer__link-2">
					  <ul>
						<li><a href="<?= site_url('page-info/').uencode(2);?>">Terms</a></li>
						<li><a href="<?= site_url('page-info/').uencode(1);?>">Privacy Policy</a></li>
						<li><a href="<?= site_url('page-info/').uencode(5);?>">About Us</a></li>
						<li><a href="<?= site_url('page-info/').uencode(6);?>">Communications</a></li>
						
					  </ul>
				   </div>
				</div>
			 </div>
		  </div>
		  <div class="col-xxl-3 col-xl-2 col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".7s">
			 <div class="footer__widget mb-50 footer__pl-90">
				<div class="footer__widget-title mb-25">
				   <h3>&nbsp;</h3>
				</div>
				<div class="footer__widget-content">
				   <div class="footer__link footer__link-2">
					  <ul>
						 <li><a href="<?= site_url('page-info/').uencode(7);?>">How It Works</a></li>
						 <li><a href="<?= site_url('page-info/').uencode(8);?>">Disclaimers</a></li>
					  </ul>
				   </div>
				</div>
			 </div>
		  </div>
		  <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="1.2s">
			 <div class="footer__widget mb-50 float-md-end fix">
				<div class="footer__widget-title mb-25">
				 
					  </ul>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
 </div>
 <div class="footer__bottom">
	<div class="container">
	   <div class="footer__copyright">
		  <div class="row">
			 <div class="col-xxl-12 wow fadeInUp" data-wow-delay=".7s">
				<div class="footer__copyright-wrapper footer__copyright-wrapper-2 text-center">
				   <p>Copyright © <?= date('2012');?> All Rights Reserved</p>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
 </div>
</footer>
      
