<?php
use App\Models\UsersModel;
use App\Models\CountryModel;

$CountryModel = new CountryModel();
$UsersModel = new UsersModel();
$request = \Config\Services::request();

$session = \Config\Services::session();
$usession = $session->get('cand_username');
if(!$session->has('cand_username')){ 
	return redirect()->to(site_url('signin'));
}

$result = $UsersModel->where('user_id', $usession['cand_user_id'])->first();
/////
$all_countries = $CountryModel->orderBy('country_id', 'ASC')->findAll();

if($result['is_active'] == 1){
	$status = '<span class="badge badge-light-success"><em class="icon ni ni-check-circle"></em> '.lang('Main.xin_employees_active').'</span>';
	$status_label = '<i class="fas fa-certificate text-success bg-icon"></i><i class="fas fa-check front-icon text-white"></i>';
} else {
	$status = '<span class="badge badge-light-danger"><em class="icon ni ni-cross-circle"></em> '.lang('Main.xin_employees_inactive').'</span>';
	$status_label = '<i class="fas fa-certificate text-danger bg-icon"></i><i class="fas fa-times-circle front-icon text-white"></i>';
}
?>
<!-- Titlebar -->
<div id="titlebar">
    <div class="row">
        <div class="col-md-12">
            <h2>Delete Account</h2>
            <!-- Breadcrumbs -->
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li>Delete Account</li>
                </ul>
            </nav>
        </div>
    </div>
</div>


<div class="row">
			
    <div class="col-lg-6 col-md-12">
        <div class="dashboard-list-box margin-top-0">
            <h4 class="gray">Delete Account</h4>
            <?php $attributes = array('name' => 'delete_my_account', 'id' => 'delete_my_account', 'autocomplete' => 'off');?>
			<?php $hidden = array('token' => uencode($usession['cand_user_id']));?>
            <?= form_open('jobs/delete_my_account', $attributes, $hidden);?>
            <div class="dashboard-list-box-static">
                <!-- Details -->
                <div class="">
                    <div class="notification error closeable">
                        <p><span>Are you sure you want to delete your account?</span><br /> Account deleted will not be restored!!!</p>
                        <a class="close" href="#"></a>
                    </div>
                </div>
                <button type="submit" class="button border fw margin-top-15">Delete Account</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>