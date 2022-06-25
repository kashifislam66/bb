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
$JobcandidatesModel = new JobcandidatesModel();

$get_data = $JobcandidatesModel->where('staff_id',$usession['cand_user_id'])->where('application_status',3)->orderBy('candidate_id', 'DESC')->findAll();
?>
<!-- Titlebar -->
<div id="titlebar">
    <div class="row">
        <div class="col-md-12">
            <h2>Rejected Jobs</h2>
            <!-- Breadcrumbs -->
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li>Rejected Jobs</li>
                </ul>
            </nav>
        </div>
    </div>
</div>


<div class="row">
    
    <!-- Table-->
    <div class="col-lg-12 col-md-12">

        <div class="dashboard-list-box margin-top-30">
            <div class="dashboard-list-box-content">

                <!-- Table -->

                <table class="manage-table responsive-table">

                    <tr>
                        <th><i class="fa fa-file-text"></i> Title</th>
                        <th><i class="fa fa-check-square-o"></i> Status</th>
                        <th><i class="fa fa-calendar"></i> Date Applied</th>
                        <th><i class="fa fa-calendar"></i> Date Expires</th>
                        <th><i class="ln ln-icon-Letter-Open"></i> Cover Letter</th>
                    </tr>
                   <?php foreach($get_data as $r) { ?>       
                   <?php
				   	$job_title = $JobsModel->where('job_id', $r['job_id'])->first();
					// applicant status
					if($r['application_status'] == 0){
						$status = lang('Main.xin_pending');
					} else if($r['application_status'] == 1){
						$status = lang('Recruitment.xin_call_for_interview');
					} elseif($r['application_status'] == 3){
						$status = lang('Main.xin_rejected');
					}
					$date_applied = set_date_format($r['created_at']);
					$expires = set_date_format($job_title['date_of_closing']);
				   ?>  
                    <!-- Job Item -->
                    <tr>
                        <td class="title"><a href="<?= site_url().'job-info/'.uencode($r['job_id']);?>"><?= $job_title['job_title']?></a></td>
                        <td class="centered"><?= $status;?></td>
                        <td><?= $date_applied;?></td>
                        <td><?= $expires;?></td>
                        <td class="centered"><a href="#small-dialog" class="popup-with-zoom-anim button">View</a></td>
                    </tr>
                    <div id="small-dialog" class="zoom-anim-dialog mfp-hide apply-popup">
					<div class="small-dialog-headline">
						<h2><?= $job_title['job_title']?> Conver Letter </h2>
					</div>

					<div class="small-dialog-content"><?= $r['message'];?></div>
					
				</div>
                    <?php } ?>        

                </table>

            </div>
        </div>
        <a href="<?php echo site_url('search-jobs');?>" class="button margin-top-30">Search New Jobs</a>
        
    </div>