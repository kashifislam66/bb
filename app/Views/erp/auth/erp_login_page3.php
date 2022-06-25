<?php
use App\Models\SystemModel;
$SystemModel = new SystemModel();
$xin_system = $SystemModel->where('setting_id', 1)->first();
$favicon = base_url().'/public/uploads/logo/favicon/'.$xin_system['favicon'];
$session = \Config\Services::session();
$request = \Config\Services::request();
$username = $session->get('sup_username');
?>
<?= doctype();?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>
<?= $title; ?>
</title>
<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="erp" />

<!-- Favicon icon -->
<link rel="icon" type="image/x-icon" href="<?= $favicon;?>">

<!-- font css -->
<link rel="stylesheet" href="<?= base_url('public/assets/fonts/font-awsome-pro/css/pro.min.css');?>">
<link rel="stylesheet" href="<?= base_url('public/assets/fonts/feather.css');?>">
<link rel="stylesheet" href="<?= base_url('public/assets/fonts/fontawesome.css');?>">

<!-- vendor css -->
<link rel="stylesheet" href="<?= base_url('public/assets/css/style.css');?>">
<link rel="stylesheet" href="<?= base_url('public/assets/css/customizer.css');?>">
<link rel="stylesheet" href="<?= base_url('public/assets/plugins/toastr/toastr.css');?>">
</head>
<body>
<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content">
		<div class="card">
			<div class="row align-items-center text-center">
				<div class="col-md-12">
					<div class="card-body">
						<img src="<?= base_url();?>/public/uploads/logo/other/<?= $xin_system['other_logo'];?>" height="40" width="138" alt="" class="img-fluid mb-4">
                          <p class="text-muted">
                            <?= lang('Login.xin_welcome_back_please_login');?>
                          </p>
                        <?php $attributes = array('class' => 'form-timehrm', 'name' => 'erp-form', 'id' => 'erp-form', 'autocomplete' => 'off');?>
						<?php $hidden = array('user_id' => 0);?>
                        <?= form_open('erp/auth/login', $attributes, $hidden);?>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i data-feather="user"></i></span>
							</div>
							<input type="text" class="form-control" name="iusername" id="iusername" placeholder="<?= lang('Login.xin_login_username');?>">
						</div>
						<div class="input-group mb-4">
							<div class="input-group-prepend">
								<span class="input-group-text"><i data-feather="lock"></i></span>
							</div>
							<input type="password" class="form-control" name="password" id="password" placeholder="<?= lang('Login.xin_login_enter_password');?>">
						</div>
						<button class="btn btn-block btn-primary mb-4" type="submit"><i class="fas fa-user-lock d-blockd"></i> <?= lang('Login.xin_login');?></button>
                        <?= form_close(); ?>
						<p class="mb-2 text-muted"><a href="<?= site_url('erp/forgot-password');?>" class="f-w-400"><?= lang('Login.xin_forgot_password_link');?></a></p>
                        <p class="mb-0 text-muted"><?= lang('Main.xin_dont_hv_an_account');?> <a href="<?= site_url('register');?>" class="f-w-400"><?= lang('Main.xin_signup');?></a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Required Js --> 
<script src="<?= base_url('public/assets/js/vendor-all.min.js');?>"></script> 
<script src="<?= base_url('public/assets/js/plugins/bootstrap.min.js');?>"></script> 
<script src="<?= base_url('public/assets/js/plugins/feather.min.js');?>"></script> 
<script src="<?= base_url('public/assets/js/pcoded.min.js');?>"></script> 
<script src="<?= base_url();?>/public/assets/plugins/toastr/toastr.js"></script> 
<script src="<?= base_url();?>/public/assets/plugins/sweetalert2/sweetalert2@10.js"></script>
<link rel="stylesheet" href="<?= base_url();?>/public/assets/plugins/ladda/ladda.css">
<script src="<?= base_url();?>/public/assets/plugins/spin/spin.js"></script> 
<script src="<?= base_url();?>/public/assets/plugins/ladda/ladda.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
	Ladda.bind('button[type=submit]');
	toastr.options.closeButton = <?= $xin_system['notification_close_btn'];?>;
	toastr.options.progressBar = <?= $xin_system['notification_bar'];?>;
	toastr.options.timeOut = 3000;
	toastr.options.preventDuplicates = true;
	toastr.options.positionClass = "<?= $xin_system['notification_position'];?>";
});
</script> 
<script type="text/javascript">
var desk_url = '<?php echo site_url('erp/desk'); ?>';
var processing_request = '<?= lang('Login.xin_processing_request');?>';</script></script> 
<script type="text/javascript" src="<?= base_url();?>/public/module_scripts/ci_erp_login.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$(".login-as").click(function(){
		var uname = jQuery(this).data('demo_user');
		var password = jQuery(this).data('demo_password');
		jQuery('#iusername').val(uname);
		jQuery('#ipassword').val(password);
	});
});	
</script>
</body></html>