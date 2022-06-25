<?php 
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\JobsModel;
use App\Models\SystemModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');

$JobsModel = new JobsModel();
$UsersModel = new UsersModel();
$RolesModel = new RolesModel();
$SystemModel = new SystemModel();

$get_jobs = $JobsModel->where('status',1)->orderBy('job_id', 'DESC')->paginate(10);
$pager = $JobsModel->pager;
?>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
	<div class="container">

		<div class="sixteen columns">
			<h2>My Account</h2>
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="#">Home</a></li>
					<li>My Account</li>
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
			<div class="tab-content">
				<?php $attributes = array('class' => 'form-timehrm', 'name' => 'erp-form', 'id' => 'erp-form', 'autocomplete' => 'off');?>
				<?php $hidden = array('user_id' => 0);?>
                <?= form_open('jobs/user_login', $attributes, $hidden);?>

					<p class="form-row form-row-wide">
						<label for="username">Username:
							<i class="ln ln-icon-Male"></i>
							<input type="text" class="input-text" name="iusername" id="iusername" value="" />
						</label>
					</p>

					<p class="form-row form-row-wide">
						<label for="password">Password:
							<i class="ln ln-icon-Lock-2"></i>
							<input class="input-text" type="password" name="password" id="password"/>
						</label>
					</p>

					<p class="form-row">
						<input type="submit" class="button border fw margin-top-10" name="login" value="Login" />
					</p>
                    <div class="notification success success-msg" style="display:none;">
                        <p><span id="msg_one">Success!</span></p>
                    </div>
					<p class="lost_password">
						<a href="#" >Lost Your Password?</a>
					</p>
					
				</form>
			</div>
		</div>
	</div>
</div>