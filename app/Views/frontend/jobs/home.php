<?php 
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\JobsModel;
use App\Models\SystemModel;

$session = \Config\Services::session();
$usession = $session->get('cand_username');

$JobsModel = new JobsModel();
$UsersModel = new UsersModel();
$RolesModel = new RolesModel();
$SystemModel = new SystemModel();

$xin_system = $SystemModel->where('setting_id', 1)->first();
$get_jobs = $JobsModel->where('status',1)->orderBy('job_id', 'DESC')->paginate(10);
$pager = $JobsModel->pager;
?>
<!-- Slider
================================================== -->
<div class="fullwidthbanner-container">
	<div class="fullwidthbanner">
		<ul>

			<!-- Slide 1 -->
			<li data-fstransition="fade" data-transition="fade" data-slotamount="10" data-masterspeed="300">
				<img src="<?= base_url();?>/public/frontend/jobs/images/banner-02.jpg" alt="">

				<div class="caption title sfb" data-x="center" data-y="195" data-speed="400" data-start="800"  data-easing="easeOutExpo">
					<h2>Hire great hourly employees</h2>
				</div>

				<div class="caption text align-center sfb" data-x="center" data-y="270" data-speed="400" data-start="1200" data-easing="easeOutExpo">
					<p><?= $xin_system['company_name'];?> is most trusted job board, connecting the world's <br> brightest minds with resume database loaded with talents.</p>
				</div>

				<div class="caption sfb" data-x="center" data-y="400" data-speed="400" data-start="1600" data-easing="easeOutExpo">
					<a href="<?php echo site_url('search-jobs');?>" class="slider-button">Work</a>
				</div>
			</li>

		</ul>
	</div>
</div>
<div class="section-background top-0">
	<div class="container">

		<div class="one-third column">
			<div class="icon-box rounded alt">
				<i class="ln ln-icon-Folder-Add"></i>
				<h4>Add Resume</h4>
				<p>Pellentesque habitant morbi tristique senectus netus ante et malesuada fames ac turpis egestas maximus neque.</p>
			</div>
		</div>

		<div class="one-third column">
			<div class="icon-box rounded alt">
				<i class="ln ln-icon-Search-onCloud"></i>
				<h4>Search For Jobs</h4>
				<p>Pellentesque habitant morbi tristique senectus netus ante et malesuada fames ac turpis egestas maximus neque.</p>
			</div>
		</div>

		<div class="one-third column">
			<div class="icon-box rounded alt">
				<i class="ln ln-icon-Business-ManWoman"></i>
				<h4>Find Crew</h4>
				<p>Pellentesque habitant morbi tristique senectus netus ante et malesuada fames ac turpis egestas maximus neque.</p>
			</div>
		</div>

	</div>
</div>
<!-- Content
================================================== -->

<div class="container">
	
	<!-- Recent Jobs -->
	<div class="sixteen columns">
	<div class="padding-right">
		<h3 class="margin-bottom-25">Recent Jobs</h3>
		<div class="listings-container">
			<?php foreach($get_jobs as $r) { ?>
            <?php
			$cinfo = $UsersModel->where('user_id', $r['company_id'])->where('user_type', 'company')->first();
			if($r['job_type']==1){
				$job_type = lang('Recruitment.xin_full_time');
				$css_jtype = 'full-time';
			} else if($r['job_type']==2){
				$job_type = lang('Recruitment.xin_part_time');
				$css_jtype = 'part-time';
			} else if($r['job_type']==3){
				$job_type = lang('Recruitment.xin_internship');
				$css_jtype = 'internship';
			} else {
				$job_type = lang('Recruitment.xin_freelance');
				$css_jtype = 'freelance';
			}
			if($cinfo){
				$cpic = staff_profile_photo($cinfo['user_id']);
				$cname = $cinfo['company_name'];
			} else {
				$cpic = '';
				$cname = '--';
			}
			?>
            <?php if($r['minimum_experience'] == 0): $experience = lang('Recruitment.xin_job_fresh'); endif;?>
			<?php if($r['minimum_experience'] == 1): $experience = lang('Employees.xin_1year'); endif;?>
            <?php if($r['minimum_experience'] == 2): $experience = lang('Employees.xin_2years'); endif;?>
            <?php if($r['minimum_experience'] == 3): $experience = lang('Employees.xin_3years'); endif;?>
            <?php if($r['minimum_experience'] == 4): $experience = lang('Employees.xin_4years'); endif;?>
            <?php if($r['minimum_experience'] == 5): $experience = lang('Employees.xin_5years'); endif;?>
            <?php if($r['minimum_experience'] == 6): $experience = lang('Employees.xin_6years'); endif;?>
            <?php if($r['minimum_experience'] == 7): $experience = lang('Employees.xin_7years'); endif;?>
            <?php if($r['minimum_experience'] == 8): $experience = lang('Employees.xin_8years'); endif;?>
            <?php if($r['minimum_experience'] == 9): $experience = lang('Employees.xin_9years'); endif;?>
            <?php if($r['minimum_experience'] == 10): $experience = lang('Employees.xin_10years'); endif;?>
            <?php if($r['minimum_experience'] == 11): $experience = lang('Employees.xin_10plus_years'); endif;?>

			<!-- Listing -->
			<a href="<?= site_url().'job-info/'.uencode($r['job_id']);?>" class="listing <?= $css_jtype;?>">
				<div class="listing-logo">
					<img src="<?= $cpic;?>" alt="">
				</div>
				<div class="listing-title">
					<h4><?= $r['job_title']?> <span class="listing-type"><?= $job_type;?></span></h4>
					<ul class="listing-icons">
						<li><i class="ln ln-icon-Building"></i> <?= $cname;?></li>
						<li><i class="ln ln-icon-Professor"></i> <?= $experience;?></li>
                        <li><div class="listing-date"><?= time_ago($r['created_at']);?></div></li>
					</ul>
				</div>
			</a>
			<?php } ?>
		</div>

		<a href="<?php echo site_url('search-jobs');?>" class="button centered"><i class="fa fa-plus-circle"></i> Show More Jobs</a>
		<div class="margin-bottom-55"></div>
	</div>
	</div>

</div>

<div class="infobox margin-reset">
	<div class="container">
		<div class="sixteen columns">
        Start Building Your Own Job Board Now <?php if(!$session->has('cand_username')){?><a href="<?php echo site_url('signup');?>">Get Started</a><?php } ?></div>
	</div>
</div>