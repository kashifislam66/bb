<?php
use App\Models\SystemModel;
use App\Models\JobsModel;
use App\Models\UsersModel;
use App\Models\LanguageModel;
use App\Models\CountryModel;
use App\Models\DesignationModel;
use App\Models\JobcandidatesModel;

$SystemModel = new SystemModel();
$JobsModel = new JobsModel();
$UsersModel = new UsersModel();
$LanguageModel = new LanguageModel();
$CountryModel = new CountryModel();
$DesignationModel = new DesignationModel();
$JobcandidatesModel = new JobcandidatesModel();

$session = \Config\Services::session();
$usession = $session->get('cand_username');
$router = service('router');
$request = \Config\Services::request();
$xin_system = $SystemModel->where('setting_id', 1)->first();
//$user = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
$locale = service('request')->getLocale();

$segment_id = $request->uri->getSegment(2);
$ifield_id = udecode($segment_id);
$job_data = $JobsModel->where('job_id',$ifield_id)->first();
$idesignations = $DesignationModel->where('designation_id',$job_data['designation_id'])->first();
if($idesignations){
	$designation_name = $idesignations['designation_name'];
} else {
	$designation_name = '--';
}
if($job_data['job_type']==1){
	$job_type = lang('Recruitment.xin_full_time');
	$css_jtype = 'full-time';
} else if($job_data['job_type']==2){
	$job_type = lang('Recruitment.xin_part_time');
	$css_jtype = 'part-time';
} else if($job_data['job_type']==3){
	$job_type = lang('Recruitment.xin_internship');
	$css_jtype = 'internship';
} else {
	$job_type = lang('Recruitment.xin_freelance');
	$css_jtype = 'freelance';
}
$cinfo = $UsersModel->where('user_id', $job_data['company_id'])->where('user_type', 'company')->first();
if($cinfo){
	$company_name = $cinfo['company_name'];
	$cpic = staff_profile_photo($cinfo['user_id']);
	$_country = $CountryModel->where('country_id', $cinfo['country'])->first();
	$country_name = $_country['country_name'];
} else {
	$company_name = '--';
	$country_name = '--';
	$cpic = '--';
}
// gender
if($job_data['gender']==0){
	$gender = lang('Main.xin_gender_male');
} else if($job_data['gender']==1){
	$gender = lang('Main.xin_gender_female');
} else {
	$gender = lang('Recruitment.xin_no_reference');
}
?>
<?php if($job_data['minimum_experience'] == 0): $experience = lang('Recruitment.xin_job_fresh'); endif;?>
<?php if($job_data['minimum_experience'] == 1): $experience = lang('Employees.xin_1year'); endif;?>
<?php if($job_data['minimum_experience'] == 2): $experience = lang('Employees.xin_2years'); endif;?>
<?php if($job_data['minimum_experience'] == 3): $experience = lang('Employees.xin_3years'); endif;?>
<?php if($job_data['minimum_experience'] == 4): $experience = lang('Employees.xin_4years'); endif;?>
<?php if($job_data['minimum_experience'] == 5): $experience = lang('Employees.xin_5years'); endif;?>
<?php if($job_data['minimum_experience'] == 6): $experience = lang('Employees.xin_6years'); endif;?>
<?php if($job_data['minimum_experience'] == 7): $experience = lang('Employees.xin_7years'); endif;?>
<?php if($job_data['minimum_experience'] == 8): $experience = lang('Employees.xin_8years'); endif;?>
<?php if($job_data['minimum_experience'] == 9): $experience = lang('Employees.xin_9years'); endif;?>
<?php if($job_data['minimum_experience'] == 10): $experience = lang('Employees.xin_10years'); endif;?>
<?php if($job_data['minimum_experience'] == 11): $experience = lang('Employees.xin_10plus_years'); endif;?>
<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="ten columns">
			<span><a href="browse-jobs.html"><?= $job_data['job_title'];?></a></span>
			<h2><?= $designation_name;?> <span class="<?= $css_jtype;?>"><?= $job_type;?></span></h2>
		</div>

		<div class="six columns">
			<a href="#" class="button">Post New Job</a>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	
	<!-- Recent Jobs -->
	<div class="eleven columns">
	<div class="padding-right">
		
		<!-- Company Info -->
		<div class="company-info">
			<img src="<?= $cpic;?>" alt="">
			<div class="content">
				<h4><?= $company_name;?></h4>
				<span><a href="#"><i class="fa fa-map-marker"></i> <?= $country_name;?></a></span>
			</div>
			<div class="clearfix"></div>
		</div>
        <h4 class="margin-bottom-10"><?= lang('Recruitment.xin_overview');?></h4>
		<p class="margin-reset">
			<?= html_entity_decode($job_data['short_description']);?>
		</p>		
		<br>

		<h4 class="margin-bottom-10"><?= lang('Recruitment.xin_job_description');?></h4>

		<p>
        <?= html_entity_decode($job_data['long_description']);?>
        </p>

	</div>
	</div>


	<!-- Widgets -->
	<div class="five columns">

		<!-- Sort by -->
		<div class="widget">
			<h4>Overview</h4>

			<div class="job-overview">
				
				<ul>
					<li>
						<i class="ln ln-icon-ID-3"></i>
						<div>
							<strong><?php echo lang('Recruitment.xin_job_type');?>:</strong>
							<span><?= $job_type;?></span>
						</div>
					</li>
					<li>
						<i class="ln ln-icon-Address-Book"></i>
						<div>
							<strong><?php echo lang('Dashboard.left_designation');?>:</strong>
							<span><?= $designation_name;?></span>
						</div>
					</li>
					<li>
						<i class="ln ln-icon-Professor"></i>
						<div>
							<strong><?php echo lang('Recruitment.xin_job_experience');?>:</strong>
							<span><?= $experience;?></span>
						</div>
					</li>
					<li>
						<i class="ln ln-icon-Blackboard"></i>
						<div>
							<strong><?= lang('Recruitment.xin_positions');?>:</strong>
							<span><?= $job_data['job_vacancy']?></span>
						</div>
					</li>
                    <li>
						<i class="ln ln-icon-Calendar"></i>
						<div>
							<strong><?= lang('Recruitment.xin_closing_date');?>:</strong>
							<span><?= $job_data['date_of_closing']?></span>
						</div>
					</li>
                    <li>
						<i class="ln ln-icon-User"></i>
						<div>
							<strong><?= lang('Main.xin_employee_gender');?>:</strong>
							<span><?= $gender;?></span>
						</div>
					</li>
				</ul>
				<?php if($usession){
                	$cinfo = $UsersModel->where('user_id', $usession['cand_user_id'])->where('user_type', 'candidate')->first();
                	$count_job = $JobcandidatesModel->where('staff_id',$usession['cand_user_id'])->where('job_id', $ifield_id)->countAllResults();
                	if($count_job > 0){?>
                		<a href="#!" class="button" disabled><?= lang('Recruitment.xin_already_applied');?></a>
                     <?php } else {?>
                     	<a href="#small-dialog" class="popup-with-zoom-anim button">Apply For This Job</a>
                     <?php } ?>
                        <div id="small-dialog" class="zoom-anim-dialog mfp-hide apply-popup">
                            <div class="small-dialog-headline">
                                <h2>Apply For This Job</h2>
                            </div>
        
                            <div class="small-dialog-content">
                                <?php $attributes = array('name' => 'apply_job', 'id' => 'apply_job', 'autocomplete' => 'off');?>
                              <?php $hidden = array('token' => $segment_id);?>
                              <?= form_open('jobs/apply_job', $attributes, $hidden);?>
                                    <input type="text" disabled="disabled" name="name" value="<?= $cinfo['first_name'].' '.$cinfo['first_name'];?>"/>
                                    <input type="text" disabled="disabled" name="email" value="<?= $cinfo['email'];?>"/>
                                    <textarea placeholder="<?= lang('Recruitment.xin_cover_letter');?>" name="cover_letter"></textarea>
        
                                    <!-- Upload CV -->
                                    <div class="upload-info"><strong><?= lang('Recruitment.xin_upload_cv');?></strong> <span>Max. file size: 5MB</span></div>
                                    <div class="clearfix"></div>
        
                                    <label class="upload-btn">
                                        <input type="file" name="file_cv" />
                                        <i class="fa fa-upload"></i> Browse
                                    </label>
                                    <span class="fake-input">No file selected</span>
        
                                    <div class="divider"></div>
        
                                    <button type="submit" class="send">Send Application</button>
                                <?= form_close(); ?>
                            </div>
                            
                        </div>
                <?php } else { ?>
                <a href="<?= site_url('signin');?>" class="button">Login To Apply For This Job</a>
                <?php }?>

			</div>

		</div>

	</div>
	<!-- Widgets / End -->
    <!-- Sharingbutton Facebook -->
<a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=<?= site_url('job-info/').$segment_id;?>" target="_blank" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.38 0 0 5.38 0 12s5.38 12 12 12 12-5.38 12-12S18.62 0 12 0zm3.6 11.5h-2.1v7h-3v-7h-2v-2h2V8.34c0-1.1.35-2.82 2.65-2.82h2.35v2.3h-1.4c-.25 0-.6.13-.6.66V9.5h2.34l-.24 2z"/></svg>
    </div>
  </div>
</a>

<!-- Sharingbutton Twitter -->
<a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text=<?= $job_data['job_title'];?>&amp;url=<?= site_url('job-info/').$segment_id;?>" target="_blank" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.38 0 0 5.38 0 12s5.38 12 12 12 12-5.38 12-12S18.62 0 12 0zm5.26 9.38v.34c0 3.48-2.64 7.5-7.48 7.5-1.48 0-2.87-.44-4.03-1.2 1.37.17 2.77-.2 3.9-1.08-1.16-.02-2.13-.78-2.46-1.83.38.1.8.07 1.17-.03-1.2-.24-2.1-1.3-2.1-2.58v-.05c.35.2.75.32 1.18.33-.7-.47-1.17-1.28-1.17-2.2 0-.47.13-.92.36-1.3C7.94 8.85 9.88 9.9 12.06 10c-.04-.2-.06-.4-.06-.6 0-1.46 1.18-2.63 2.63-2.63.76 0 1.44.3 1.92.82.6-.12 1.95-.27 1.95-.27-.35.53-.72 1.66-1.24 2.04z"/></svg>
    </div>
  </div>
</a>

<!-- Sharingbutton Tumblr -->
<a class="resp-sharing-button__link" href="https://www.tumblr.com/widgets/share/tool?posttype=link&amp;title=<?= $job_data['job_title'];?>&amp;caption=Super%20fast%20and%20easy%20Social%20Media%20Sharing%20Buttons.%20No%20JavaScript.%20No%20tracking.&amp;content=<?= $job_data['job_title'];?>&amp;canonicalUrl=<?= site_url('job-info/').$segment_id;?>&amp;shareSource=tumblr_share_button" target="_blank" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--tumblr resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
    <svg version="1.1" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
        <path d="M12,0C5.383,0,0,5.383,0,12s5.383,12,12,12s12-5.383,12-12S18.617,0,12,0z M15.492,17.616C11.401,19.544,9.5,17,9.5,14.031 V9.5h-2V8.142c0.549-0.178,1.236-0.435,1.627-0.768c0.393-0.334,0.707-0.733,0.943-1.2c0.238-0.467,0.401-0.954,0.49-1.675H12.5v3h2 v2h-2v3.719c0,2.468,1.484,2.692,2.992,1.701V17.616z"/>
     </svg>
    </div>
  </div>
</a>

<!-- Sharingbutton E-Mail -->
<a class="resp-sharing-button__link" href="mailto:?subject=<?= $job_data['job_title'];?>&amp;body=<?= site_url('job-info/').$segment_id;?>" target="_self" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--email resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.38 0 0 5.38 0 12s5.38 12 12 12 12-5.38 12-12S18.62 0 12 0zm8 16c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2h12c1.1 0 2 .9 2 2v8z"/><path d="M17.9 8.18c-.2-.2-.5-.24-.72-.07L12 12.38 6.82 8.1c-.22-.16-.53-.13-.7.08s-.15.53.06.7l3.62 2.97-3.57 2.23c-.23.14-.3.45-.15.7.1.14.25.22.42.22.1 0 .18-.02.27-.08l3.85-2.4 1.06.87c.1.04.2.1.32.1s.23-.06.32-.1l1.06-.9 3.86 2.4c.08.06.17.1.26.1.17 0 .33-.1.42-.25.15-.24.08-.55-.15-.7l-3.57-2.22 3.62-2.96c.2-.2.24-.5.07-.72z"/></svg>
    </div>
  </div>
</a>
<style type="text/css">
.resp-sharing-button__link,
.resp-sharing-button__icon {
  display: inline-block
}

.resp-sharing-button__link {
  text-decoration: none;
  color: #fff;
  margin: 0.5em
}

.resp-sharing-button {
  border-radius: 5px;
  transition: 25ms ease-out;
  padding: 0.5em 0.75em;
  font-family: Helvetica Neue,Helvetica,Arial,sans-serif
}

.resp-sharing-button__icon svg {
  width: 1em;
  height: 1em;
  margin-right: 0.4em;
  vertical-align: top
}

.resp-sharing-button--small svg {
  margin: 0;
  vertical-align: middle
}

/* Non solid icons get a stroke */
.resp-sharing-button__icon {
  stroke: #fff;
  fill: none
}

/* Solid icons get a fill */
.resp-sharing-button__icon--solid,
.resp-sharing-button__icon--solidcircle {
  fill: #fff;
  stroke: none
}

.resp-sharing-button--twitter {
  background-color: #55acee
}

.resp-sharing-button--twitter:hover {
  background-color: #2795e9
}

.resp-sharing-button--pinterest {
  background-color: #bd081c
}

.resp-sharing-button--pinterest:hover {
  background-color: #8c0615
}

.resp-sharing-button--facebook {
  background-color: #3b5998
}

.resp-sharing-button--facebook:hover {
  background-color: #2d4373
}

.resp-sharing-button--tumblr {
  background-color: #35465C
}

.resp-sharing-button--tumblr:hover {
  background-color: #222d3c
}

.resp-sharing-button--reddit {
  background-color: #5f99cf
}

.resp-sharing-button--reddit:hover {
  background-color: #3a80c1
}

.resp-sharing-button--google {
  background-color: #dd4b39
}

.resp-sharing-button--google:hover {
  background-color: #c23321
}

.resp-sharing-button--linkedin {
  background-color: #0077b5
}

.resp-sharing-button--linkedin:hover {
  background-color: #046293
}

.resp-sharing-button--email {
  background-color: #777
}

.resp-sharing-button--email:hover {
  background-color: #5e5e5e
}

.resp-sharing-button--xing {
  background-color: #1a7576
}

.resp-sharing-button--xing:hover {
  background-color: #114c4c
}

.resp-sharing-button--whatsapp {
  background-color: #25D366
}

.resp-sharing-button--whatsapp:hover {
  background-color: #1da851
}

.resp-sharing-button--hackernews {
background-color: #FF6600
}
.resp-sharing-button--hackernews:hover, .resp-sharing-button--hackernews:focus {   background-color: #FB6200 }

.resp-sharing-button--vk {
  background-color: #507299
}

.resp-sharing-button--vk:hover {
  background-color: #43648c
}

.resp-sharing-button--facebook {
  background-color: #3b5998;
  border-color: #3b5998;
}

.resp-sharing-button--facebook:hover,
.resp-sharing-button--facebook:active {
  background-color: #2d4373;
  border-color: #2d4373;
}

.resp-sharing-button--twitter {
  background-color: #55acee;
  border-color: #55acee;
}

.resp-sharing-button--twitter:hover,
.resp-sharing-button--twitter:active {
  background-color: #2795e9;
  border-color: #2795e9;
}

.resp-sharing-button--tumblr {
  background-color: #35465C;
  border-color: #35465C;
}

.resp-sharing-button--tumblr:hover,
.resp-sharing-button--tumblr:active {
  background-color: #222d3c;
  border-color: #222d3c;
}

.resp-sharing-button--email {
  background-color: #777777;
  border-color: #777777;
}

.resp-sharing-button--email:hover,
.resp-sharing-button--email:active {
  background-color: #5e5e5e;
  border-color: #5e5e5e;
}

.resp-sharing-button--pinterest {
  background-color: #bd081c;
  border-color: #bd081c;
}

.resp-sharing-button--pinterest:hover,
.resp-sharing-button--pinterest:active {
  background-color: #8c0615;
  border-color: #8c0615;
}

</style>


</div>