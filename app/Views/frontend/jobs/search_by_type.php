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
$request = \Config\Services::request();

$segment_id = $request->uri->getSegment(2);
$type_id = udecode($segment_id);

$get_jobs = $JobsModel->where('job_type',$type_id)->where('status',1)->orderBy('job_id', 'DESC')->paginate(15);
$total_jobs = $JobsModel->where('job_type',$type_id)->where('status', 1)->countAllResults();
$pager = $JobsModel->pager;
?>
<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="ten columns">
			<span>We found <?= $total_jobs?> jobs matching:</span>
			<h2>Find a job that suits your passion</h2>
		</div>
	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	<!-- Recent Jobs -->
	<div class="eleven columns">
	<div class="padding-right">

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
					<img src="<?= staff_profile_photo($cinfo['user_id']);?>" alt="">
				</div>
				<div class="listing-title">
					<h4><?= $r['job_title']?> <span class="listing-type"><?= $job_type;?></span></h4>
					<ul class="listing-icons">
						<li><i class="ln ln-icon-Building"></i> <?= $cinfo['company_name'];?></li>
						<li><i class="ln ln-icon-Professor"></i> <?= $experience;?></li>
                        <li><div class="listing-date"><?= time_ago($r['created_at']);?></div></li>
					</ul>
				</div>
			</a>
			<?php } ?>
		</div>
		<div class="clearfix"></div>

		<div class="pagination-container">
			<?= $pager->links() ?>
		</div>

	</div>
	</div>


	<!-- Widgets -->
	<div class="five columns">

		<!-- Job Type -->
        <div class="widget">
			<h4>Job Type</h4>

			<ul class="footer-links search-categories">
                <li><a href="<?= site_url('search-jobs');?>">Any Type</a></li>
                <li><a href="<?= site_url('search-job/').uencode(1);?>">Full-Time </a></li>
                <li><a href="<?= site_url('search-job/').uencode(2);?>">Part-Time </a></li>
                <li><a href="<?= site_url('search-job/').uencode(3);?>">Internship </a></li>
                <li><a href="<?= site_url('search-job/').uencode(4);?>">Freelance </a></li>
			</ul>
		</div>

	</div>
	<!-- Widgets / End -->


</div>