<?php
namespace App\Controllers\Erp;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Files\UploadedFile;
 
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\MainModel;
use App\Models\JobsModel;
use App\Models\DesignationModel;
use App\Models\JobcandidatesModel;
use App\Models\JobinterviewsModel;
use App\Models\EmailtemplatesModel;

$session = \Config\Services::session();
$usession = $session->get('cand_username');
if(!$session->has('cand_username')){ 
	return redirect()->to(site_url('signin'));
}		
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$SystemModel = new SystemModel();
$JobsModel = new JobsModel();
$JobinterviewsModel = new JobinterviewsModel();

$get_data = $JobinterviewsModel->where('staff_id',$usession['cand_user_id'])->orderBy('job_interview_id', 'DESC')->findAll();
?>
<!-- Titlebar -->
<div id="titlebar">
    <div class="row">
        <div class="col-md-12">
            <h2>Call for Interview</h2>
            <!-- Breadcrumbs -->
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li>Call for Interview</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    
    
    <!-- Interview -->
    <div class="col-md-12">
        
        <!-- Interview -->
        <?php foreach($get_data as $r) {?>
        <?php
			$cinfo = $UsersModel->where('user_id', $r['company_id'])->where('user_type', 'company')->first();
			$job_title = $JobsModel->where('job_id', $r['job_id'])->first();
			if($job_title){
				$eijob_title = $job_title['job_title'];
			} else {
				$eijob_title = '--';
			}
			// applicant status
			if($r['status'] == 1){
				$status = lang('Projects.xin_not_started');
			} else if($r['status'] == 2){
				$status = lang('Recruitment.xin_passed_interview');
			} elseif($r['status'] == 3){
				$status = lang('Main.xin_rejected');
			}
			$created_at = set_date_format($r['created_at']);
			$interviewer = $UsersModel->where('user_id', $r['interviewer_id'])->first();
			if($interviewer){
				$iinterviewer = $interviewer['first_name'].' '.$interviewer['last_name'];
			} else {
				$iinterviewer = '--';
			}
		?>
        <div class="application">
            <div class="app-content">
                
                <!-- Name / Avatar -->
                <div class="info">
                    <img src="<?= staff_profile_photo($cinfo['user_id']);?>" alt="">
                    <span><a href="<?= site_url().'job-info/'.uencode($job_title['job_id']);?>" target="_blank"><?= $eijob_title?></a></span>
                    <ul>
                        <li><i class="fa fa-user"></i> <?= $cinfo['company_name'];?></li>
                    </ul>
                </div>
                
                <!-- Buttons -->
                <div class="buttons">
                    <a href="#three-1" class="button gray app-link"><i class="fa fa-plus-circle"></i> Show Details</a>
                </div>
                <div class="clearfix"></div>
    
            </div>
    
            <!--  Hidden Tabs -->
            <div class="app-tabs">
    
                <a href="#" class="close-tab button gray"><i class="fa fa-close"></i></a>
                
                <!-- Third Tab -->
                <div class="app-tab-content"  id="three-1">
                    <i>Place of Interview:</i>
                    <span><?= $r['interview_place'];?></span>
    
                    <i>Interview Time:</i>
                    <span><?= $r['interview_date'].' '.$r['interview_time'];?></span>
                    
                    <i>Interviewer:</i>
                    <span><?= $iinterviewer;?></span>
    
                    <i>Interview Remarks:</i>
                    <span><?= $r['interview_remarks'];?></span>
                    
                    <i>Interview Description:</i>
                    <span><?= $r['description'];?></span>
                </div>
    
            </div>
    
            <!-- Footer -->
            <div class="app-footer">    
                <ul>
                    <li><i class="fa fa-file-text-o"></i> <?= $status;?></li>
                    <li><i class="fa fa-calendar"></i> <?= $created_at;?></li>
                </ul>
                <div class="clearfix"></div>
    
            </div>
        </div>   
        <?php } ?> 
    </div>
</div>