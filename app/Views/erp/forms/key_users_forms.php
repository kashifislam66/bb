<?php 
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\FormsModel;
use App\Models\FormsfieldModel;
use App\Models\ConstantsModel;
use App\Models\FormscompletedfieldsModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');

$UsersModel = new UsersModel();
$RolesModel = new RolesModel();	
$FormsModel = new FormsModel();	
$ConstantsModel = new ConstantsModel();
$FormsfieldModel = new FormsfieldModel();
$FormscompletedfieldsModel = new FormscompletedfieldsModel();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}
$submited_all_form = $FormscompletedfieldsModel->where('company_id', $company_id)->where('staff_id', $usession['sup_user_id'])->groupBy("form_id")->countAllResults();
$submited_pending_form = $FormscompletedfieldsModel->where('company_id', $company_id)->where('staff_id', $usession['sup_user_id'])->where('status', 0)->groupBy("form_id")->countAllResults();
$submited_approved_form = $FormscompletedfieldsModel->where('company_id', $company_id)->where('staff_id', $usession['sup_user_id'])->where('status', 1)->groupBy("form_id")->countAllResults();

$forms = $FormsModel->where('company_id', $company_id)->findAll();
/* Form Builder view
*/
if($submited_all_form > 0) {
	$get_pending_status = $submited_pending_form / $submited_all_form * 100;
	if(is_float($get_pending_status)){
		$pending_percent = number_format($get_pending_status, 1);
	} else {
		$pending_percent = $get_pending_status;
	}
	$get_approved_status = $submited_approved_form / $submited_all_form * 100;
	if(is_float($get_approved_status)){
		$approved_percent = number_format($get_approved_status, 1);
	} else {
		$approved_percent = $get_approved_status;
	}
} else {
	$pending_percent = 0;
	$approved_percent = 0;
}
?>
<?php if($session->get('form_success_msg')){?>
<div class="alert alert-success alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <?= $session->get('form_success_msg');?>
</div>
<?php } ?>
<div class="row"> 
  <!-- [ form list ] start -->
  <div class="col-xl-3 col-lg-4">
    <div class="card">
        <div class="card-body border-bottom">
            <strong><?= lang('Main.xin_forms_builder');?></strong>
        </div>
        <div class="card-body py-3 border-bottom">
            <a data-bs-toggle="collapse" href="#" data-bs-target="#taskfilstatus" class="link-dark" aria-expanded="true" aria-controls="taskfilstatus">
                <div class="h6 mb-0"><i class="material-icons-two-tone f-20 text-primary">emoji_flags</i> <?= lang('Main.xin_form_submission_status');?></div>
            </a>
            <div class="border-top pt-3 mt-3 collapse show" id="taskfilstatus" style="">
                <div class="h6 mb-2"><?= lang('Main.xin_pending_approval');?> (<?= $submited_pending_form;?>)</div>
                <div class="progress rounded mb-3" style="height: 5px;">
                    <div class="progress-bar bg-warning rounded" role="progressbar" style="width: <?= $pending_percent;?>%" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="h6 mb-2"><?= lang('Main.xin_approved');?> (<?= $submited_approved_form;?>)</div>
                <div class="progress rounded mb-3" style="height: 5px;">
                    <div class="progress-bar bg-success rounded" role="progressbar" style="width: <?= $approved_percent;?>%" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="col-xl-9 col-lg-8 filter-bar">
    <nav class="navbar m-b-30 p-10">
      <ul class="nav">
        <li class="nav-item dropdown"> <a class="nav-link text-secondary" href="javascript:void(0);" id="bydate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><strong>
          <?= lang('Main.xin_list_all');?>
          <?= lang('Main.xin_forms');?>
          </strong></a> </li>
      </ul>
    </nav>
    <div class="row filter-bar">
	  <?php 
	  	$form_categories = array(1=>'Employee Forms',2=>'Performance Forms',3=>'Job Candidate Forms',4=>'Approval process set up',5=>'Training evaluation Forms',6=>'Employee exit Forms',7=>'External Forms');
		$i=1;
		foreach($forms as $r) {
        $created_at = set_date_format($r['created_at']);
        //assigned user
        $assigned_to = explode(',',$r['assigned_to']);
		if(in_array('all',$assigned_to) || in_array($usession['sup_user_id'],$assigned_to)){
        $formfieldscount = $FormsfieldModel->where('company_id',$company_id)->where("form_id",$r['forms_id'])->countAllResults();
        if($r['status']==0){
            $status = '<span class="badge bg-light-success">'.lang('Main.xin_employees_active').'</span>';
        } else {
            $status = '<span class="badge bg-light-danger">'.lang('Main.xin_employees_inactive').'</span>';
        }
		// check form completed fields
		// form completed fields
		$count_completed_form = $FormscompletedfieldsModel->where('company_id',$company_id)->where("form_id",$r['forms_id'])->where("staff_id",$usession['sup_user_id'])->countAllResults();
		if($count_completed_form > 0){
		$completed_form = $FormscompletedfieldsModel->where('company_id',$company_id)->where("form_id",$r['forms_id'])->where("staff_id",$usession['sup_user_id'])->first();
		$formupdated_at = set_date_format($completed_form['created_at']);
		if($completed_form['status']==1):
			$formstatus = '<span class="badge bg-light-success">'.lang('Main.xin_accepted').'</span>';
			$status_icon = '<i class="feather icon-user-check bg-success update-icon"></i>';
		else:
			$formstatus = '<span class="badge bg-light-warning">'.lang('Main.xin_pending').'</span>';
			$status_icon = '<i class="feather icon-user-x bg-warning update-icon"></i>';
		endif;
		$formsubmited = '<a target="_blank" href="'.site_url('erp/user-submited-form').'/'.uencode($completed_form['completed_field_id']).'">'.lang('Main.xin_form_submited_view').'</a>';
		$formsubmitedtitle = lang('Main.xin_form_submited_title');
		} else {
			$formupdated_at = '';
			$formsubmited = '';
			$formstatus = '<span class="badge bg-light-warning">'.lang('Main.xin_pending').'</span>';
			$status_icon = '<i class="feather icon-user-x bg-warning update-icon"></i>';
			$formsubmitedtitle = lang('Main.xin_form_notsubmited_title');
		}
       ?>
       <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h5>#<?= $i;?>. <?= $r['form_name'];?></h5>
                    <?php if($count_completed_form < 1){?> 
                    <div class="dropdown">
                        <a class="dropdown-toggle arrow-none text-secondary" href="#" data-toggle="dropdown" aria-expanded="false">
                            <i class="material-icons-two-tone f-18 text-primary">more_vert</i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" style="">
                            <a href="<?= site_url('erp/submit-form/').uencode($r['forms_id']);?>" class="dropdown-item">
                                <i class="material-icons-two-tone">fact_check</i>
                                <span><?= lang('Main.xin_form_submit');?></span>
                            </a>
                            
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="card-body py-2 border-bottom d-flex align-items-center justify-content-between">
                    <p class="d-inline-block mb-0"><i class="material-icons-two-tone f-18 text-danger">calendar_today</i> <?= $r['created_at'];?></p>
                    <div>
                        <p class="d-inline-block mb-0 ms-2" title="<?= lang('Main.xin_form_fields_total');?>"><i class="material-icons-two-tone f-18 text-primary">fact_check</i> <?= $formfieldscount;?></p>
                    </div>
                </div>
                <div class="card-body">         
                    <table class="table table-xs w-auto table-borderless">
                        <tbody>
                            <tr>
                                <td class="pl-0 pb-0"><i class="material-icons-two-tone text-primary f-16">leaderboard</i> <?= lang('Main.xin_form_categories');?>:</td>
                                <td class="pb-0">
                                <?php foreach($form_categories as $category_key=>$cat_value) {?>
                                <?php if($category_key==$r['category_id']):?> <?= $cat_value ?><?php endif;?>
                                <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="pb-0 text-center"><?= $formsubmited;?></td>
                            </tr>
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>
      <?php $i++;} } ?>
    </div>
  </div>
</div>

