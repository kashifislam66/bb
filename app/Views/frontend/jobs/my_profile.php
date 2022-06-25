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
            <h2>My Profile</h2>
            <!-- Breadcrumbs -->
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li>My Profile</li>
                </ul>
            </nav>
        </div>
    </div>
</div>


<div class="row">
			
    <div class="col-lg-8 col-md-12">

        <div class="dashboard-list-box margin-top-0">
            <h4><?= lang('Main.xin_personal_info');?></h4>
            <?php $attributes = array('name' => 'edit_user', 'id' => 'edit_user', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
			<?php $hidden = array('_method' => 'EDIT', 'token' => uencode($usession['cand_user_id']));?>
            <?= form_open('jobs/update_profile', $attributes, $hidden);?>
            <div class="dashboard-list-box-content">
			<div class="">
            <div class="submit-page">

                <!-- first_name -->
                <div class="form">
                    <h5><?= lang('Main.xin_employee_first_name');?></h5>
                    <input class="form-control" placeholder="<?= lang('Main.xin_employee_first_name');?>" name="first_name" type="text" value="<?= $result['first_name'];?>">
                </div>

                <!-- last_name -->
                <div class="form">
                    <h5><?= lang('Main.xin_employee_last_name');?></h5>
                    <input class="form-control" placeholder="<?= lang('Main.xin_employee_last_name');?>" name="last_name" type="text" value="<?= $result['last_name'];?>">
                </div>
                <!-- email -->
                <div class="form">
                    <h5><?= lang('Main.xin_email');?></h5>
                    <input class="form-control" placeholder="<?= lang('Main.xin_email');?>" name="email" type="text" value="<?= $result['email'];?>">
                </div>
                <!-- username -->
                <div class="form">
                    <h5><?= lang('Main.dashboard_username');?></h5>
                    <input class="form-control" placeholder="<?= lang('Main.dashboard_username');?>" name="username" type="text" value="<?= $result['username'];?>">
                </div>
                <!-- contact_number -->
                <div class="form">
                    <h5><?= lang('Main.xin_contact_number');?></h5>
                    <input class="form-control" placeholder="<?= lang('Main.xin_contact_number');?>" name="contact_number" type="text" value="<?= $result['contact_number'];?>">
                </div>
                <!-- gender -->
                <div class="form">
                    <h5><?= lang('Main.xin_employee_gender');?></h5>
                    <select name="gender" data-placeholder="Gender" class="chosen-select-no-single">
                        <option value="1" <?php if('1'==$result['gender']):?> selected="selected"<?php endif;?>>Male</option>
                        <option value="2" <?php if('2'==$result['gender']):?> selected="selected"<?php endif;?>>Female</option>
                    </select>
                </div>
                <!-- country -->
                <div class="form">
                    <h5><?= lang('Main.xin_country');?></h5>
                    <select name="country" data-placeholder="Country" class="chosen-select-no-single">
                        <?php foreach($all_countries as $country) {?>
                          <option value="<?= $country['country_id'];?>" <?php if($country['country_id']==$result['country']):?> selected="selected"<?php endif;?>>
                          <?= $country['country_name'];?>
                          </option>
                          <?php } ?>
                    </select>
                </div>
                <!-- city -->
                <div class="form">
                    <h5><?= lang('Main.xin_city');?></h5>
                    <input class="form-control" placeholder="<?= lang('Main.xin_city');?>" name="city" type="text" value="<?= $result['city'];?>">
                </div>
                <!-- state -->
                <div class="form">
                    <h5><?= lang('Main.xin_state');?></h5>
                    <input class="form-control" placeholder="<?= lang('Main.xin_state');?>" name="state" type="text" value="<?= $result['state'];?>">
                </div>
                <!-- zipcode -->
                <div class="form">
                    <h5><?= lang('Main.xin_zipcode');?></h5>
                    <input class="form-control" placeholder="<?= lang('Main.xin_zipcode');?>" name="zipcode" type="text" value="<?= $result['zipcode'];?>">
                </div>
                <!-- address -->
                <div class="form">
                    <h5><?= lang('Main.xin_address');?></h5>
                    <input class="form-control" placeholder="<?= lang('Main.xin_address');?>" name="address_1" type="text" value="<?= $result['address_1'];?>">
                </div>
                <!-- address -->
                <div class="form">
                    <h5>&nbsp;</h5>
                    <input class="form-control" placeholder="<?= lang('Main.xin_address_2');?>" name="address_2" type="text" value="<?= $result['address_2'];?>">
                </div>
                <p class="form-row">
					<button type="submit" class="button border fw margin-top-10" name="save_changes">Save Changes</button>
				</p>
            </div>
            </div>
            	
            </div>
            <?= form_close(); ?>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="dashboard-list-box margin-top-0">
            <h4 class="gray">Profile Details</h4>
            <?php $attributes = array('name' => 'edit_user_photo', 'id' => 'edit_user_photo', 'autocomplete' => 'off');?>
			<?php $hidden = array('token' => uencode($usession['cand_user_id']));?>
            <?= form_open('jobs/update_profile_photo', $attributes, $hidden);?>
            <div class="dashboard-list-box-static">
                <!-- Avatar -->
                <div class="edit-profile-photo">
                    <img src="<?= staff_profile_photo($result['user_id']);?>" alt="" style="width:100px;">
                </div>
                <!-- Details -->
                <div class="">

                    <div class="form">
                        <h5>Photo</h5>
                        <label class="upload-btn">
                            <input type="file" name="file" />
                            <i class="fa fa-upload"></i> Browse
                        </label>
                        <span class="fake-input">No file selected</span>
                    </div>
                </div>
                <button type="submit" class="button border fw margin-top-15">Update Picture</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>