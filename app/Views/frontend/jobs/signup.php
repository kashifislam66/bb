<?php 
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\JobsModel;
use App\Models\SystemModel;
use App\Models\CountryModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');

$JobsModel = new JobsModel();
$UsersModel = new UsersModel();
$RolesModel = new RolesModel();
$SystemModel = new SystemModel();
$CountryModel = new CountryModel();

$get_jobs = $JobsModel->where('status',1)->orderBy('job_id', 'DESC')->paginate(10);
$pager = $JobsModel->pager;
$all_countries = $CountryModel->orderBy('country_id', 'ASC')->findAll();
?>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
	<div class="container">

		<div class="sixteen columns">
			<h2>Sign Up</h2>
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="#">Home</a></li>
					<li>Sign Up</li>
				</ul>
			</nav>
		</div>

	</div>
</div>


<!-- Content
================================================== -->

<!-- Container -->
<div class="container">

	<div class="my-account">

		<div class="tabs-container">
			<!-- Login -->
			<div class="tab-content" id="tab1">
				<?php $attributes = array('name' => 'add_user', 'id' => 'register-account', 'class' =>'register', 'autocomplete' => 'off');?>
                <?php $hidden = array('user_id' => 0);?>
                <?= form_open_multipart('jobs/register_candidate', $attributes, $hidden);?>
                    <p class="form-row form-row-wide">
                        <label for="username2">First Name:
                            <i class="ln ln-icon-Male"></i>
                            <input type="text" class="input-text" name="first_name" value="" />
                        </label>
                    </p>
                        
                    <p class="form-row form-row-wide">
                        <label for="email2">Last Name:
                            <i class="ln ln-icon-Mail"></i>
                            <input type="text" class="input-text" name="last_name" value="" />
                        </label>
                    </p>
                    <p class="form-row form-row-wide">
                        <label for="password1">Email Address:
                            <i class="ln ln-icon-Lock-2"></i>
                            <input class="input-text" type="text" name="email"/>
                        </label>
                    </p>
                    <p class="form-row form-row-wide">
                        <label for="password1">Username:
                            <i class="ln ln-icon-Lock-2"></i>
                            <input class="input-text" type="text" name="username"/>
                        </label>
                    </p>
    
                    <p class="form-row form-row-wide">
                        <label for="password1">Password:
                            <i class="ln ln-icon-Lock-2"></i>
                            <input class="input-text" type="password" name="password"/>
                        </label>
                    </p>
                    <p class="form-row form-row-wide">
                        <label for="password1">Country:
                            <i class="ln ln-icon-Lock-2"></i>
                            <select name="country" data-placeholder="Country" class="chosen-select-no-single">
								<option value="">Country</option>
                                <?php foreach($all_countries as $country) {?>
								<option value="<?= $country['country_id'];?>"><?= $country['country_name'];?></option>
                                <?php } ?>
							</select>
                        </label>
                    </p>
                    <p class="form-row form-row-wide">
                        <label for="password1">Contact Number:
                            <i class="ln ln-icon-Lock-2"></i>
                            <input class="input-text" type="text" name="contact_number"/>
                        </label>
                    </p>
                    <p class="form-row form-row-wide">
                        <label for="password1">Gender:
                            <i class="ln ln-icon-Lock-2"></i>
                            <select name="gender" data-placeholder="Gender" class="chosen-select-no-single">
								<option value="1">Male</option>
								<option value="2">Female</option>
							</select>
                        </label>
                    </p>
                    <p class="form-row">
                    <h5>Profile Picture</h5>
                        <label class="upload-btn">
                            <input type="file" id="file" name="file" />
                            Browse
                        </label>
                        <span class="fake-input">No file selected</span>
                    </p>
                    <p class="form-row">
                        <button type="submit" class="button border fw margin-top-10" name="register"/>Register</button>
                    </p>

				<?= form_close(); ?>
			</div>
			
		</div>
	</div>
</div>