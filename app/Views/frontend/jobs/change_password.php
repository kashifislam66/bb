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
            <h2>Change Password</h2>
            <!-- Breadcrumbs -->
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li>Change Password</li>
                </ul>
            </nav>
        </div>
    </div>
</div>


<div class="row">
	<!-- Change Password -->
    <div class="col-lg-6 col-md-12">
        <div class="dashboard-list-box margin-top-0">
            <h4 class="gray">Change Password</h4>
            <?php $attributes = array('name' => 'change_password', 'id' => 'change_password', 'autocomplete' => 'off');?>
			<?php $hidden = array('token' => uencode($usession['cand_user_id']));?>
            <?= form_open('jobs/update_password', $attributes, $hidden);?>
            <div class="dashboard-list-box-static">

                <!-- Change Password -->
                <div class="my-profile">
                    <label class="margin-top-0"><?= lang('Main.xin_current_password');?></label>
                    <input type="password" value="*******************">

                    <label>New Password</label>
                    <input type="password" name="new_password">

                    <label>Confirm New Password</label>
                    <input type="password" name="confirm_password">

                    <button type="submit" class="button margin-top-15">Change Password</button>
                </div>

            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>