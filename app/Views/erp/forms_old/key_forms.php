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
$submited_all_form = $FormscompletedfieldsModel->where('company_id', $company_id)->groupBy("form_id")->countAllResults();
$submited_pending_form = $FormscompletedfieldsModel->where('company_id', $company_id)->where('status', 0)->groupBy("form_id")->countAllResults();
$submited_approved_form = $FormscompletedfieldsModel->where('company_id', $company_id)->where('status', 1)->groupBy("form_id")->countAllResults();

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
  <div class="card">
        <div class="card-body py-3">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <strong><?= lang('Main.xin_list_all');?> <?= lang('Main.xin_forms');?></strong>
                </div>
                <div class="col-md-5 text-md-end">
                    <span class="m-r-15"><?= lang('Projects.xin_view_mode');?>:</span>
                    <div class="nav nav-tabs btn-group btn-group-sm d-inline-flex" id="myTab" role="tablist">
                        <a class="btn btn-light-primary active" id="grid-tab" data-toggle="tab" href="#grid" role="tab" aria-controls="grid" aria-selected="true"><i class="fas fa-th-large"></i></a>
                        <a class="btn btn-light-primary m-r-5" id="list-tab" data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="false"><i class="fas fa-list-ul"></i></a> <a  href="<?= site_url('erp/create-form');?>" class="btn waves-effect waves-light btn-primary btn-sm m-0"> <i data-feather="plus"></i>
        <?= lang('Main.xin_creat_form_builder');?>
        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active show" id="grid" role="tabpanel" aria-labelledby="grid-tab">
            <div class="row">
                <?php 
				$form_categories = array(1=>'Employee Forms',2=>'Performance Forms',3=>'Job Candidate Forms',4=>'Approval process set up',5=>'Training evaluation Forms',6=>'Employee exit Forms',7=>'External Forms');
				$i=1;
				foreach($forms as $r) {
				$created_at = set_date_format($r['created_at']);
				//assigned user
				$assigned_to = explode(',',$r['assigned_to']);
				$formfieldscount = $FormsfieldModel->where('company_id',$company_id)->where("form_id",$r['forms_id'])->countAllResults();
				if($r['status']==0){
					$status = '<span class="badge bg-light-success">'.lang('Main.xin_employees_active').'</span>';
				} else {
					$status = '<span class="badge bg-light-danger">'.lang('Main.xin_employees_inactive').'</span>';
				}
				// supervisor
				$supervisor = $UsersModel->where('user_id', $r['supervisor_id'])->first();
				if($supervisor){
					$supervisor_name = $supervisor['first_name'].' '.$supervisor['last_name'];
					$supervisor_img = '<img class="img-fluid img-radius wid-20 me-2" src="'.staff_profile_photo($supervisor['user_id']).'" alt="1">';
				} else {
					$supervisor_name = '--';
					$supervisor_img = '';
				}
			   ?>
			   <div class="col-md-6 col-sm-12">
					<div class="card">
						<div class="card-header py-3 d-flex align-items-center justify-content-between">
							<h5>#<?= $i;?>. <?= $r['form_name'];?></h5>
							<div class="dropdown">
								<a class="dropdown-toggle arrow-none text-secondary" href="#" data-toggle="dropdown" aria-expanded="false">
									<i class="material-icons-two-tone f-18 text-primary">more_vert</i>
								</a>
								<div class="dropdown-menu dropdown-menu-end" style="">
									<a href="<?= site_url('erp/edit-form/').uencode($r['forms_id']);?>" class="dropdown-item">
										<i class="material-icons-two-tone">edit</i>
										<span><?= lang('Main.xin_edit');?></span>
									</a>
									<a href="<?= site_url('erp/view-form/').uencode($r['forms_id']);?>" class="dropdown-item">
										<i class="material-icons-two-tone">preview</i>
										<span><?= lang('Main.xin_view');?></span>
									</a>
									<a href="#!" class="dropdown-item" data-toggle="modal" data-target=".edit-modal-data" data-field_type="form_progress" data-field_id="<?= uencode($r['forms_id']);?>">
										<i class="material-icons-two-tone">insert_chart_outlined</i>
										<span><?= lang('Main.xin_form_statistics');?></span>
									</a>
									<?php if($r['status']==0){ ?>
									<a href="javascript:void(0);" class="dropdown-item form-status" data-status_val="1" data-record_id="<?= uencode($r['forms_id']);?>">
										<i class="material-icons-two-tone">visibility_off</i>
										<span><?= lang('Main.xin_employees_inactive');?></span>
									</a>
									<?php } else {?>
									<a href="javascript:void(0);" class="dropdown-item form-status" data-status_val="0" data-record_id="<?= uencode($r['forms_id']);?>">
										<i class="material-icons-two-tone">visibility</i>
										<span><?= lang('Main.xin_employees_active');?></span>
									</a>
									<?php } ?>
									<?php /*?><a href="<?= site_url('erp/submit-form/').uencode($r['forms_id']);?>" class="dropdown-item">
										<i class="material-icons-two-tone">fact_check</i>
										<span><?= lang('Main.xin_form_submit');?></span>
									</a><?php */?>
									<a href="#!" class="dropdown-item delete" data-toggle="modal" data-target=".delete-modal" data-record-id="<?= uencode($r['forms_id']);?>">
										<i class="material-icons-two-tone">delete_forever</i>
										<span><?= lang('Main.xin_delete');?></span>
									</a>
								</div>
							</div>
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
										<td class="pl-0 pb-0"><i class="material-icons-two-tone text-primary f-16">account_circle</i> <?= lang('Main.xin_form_assign_to');?>:</td>
										<td class="pb-0"><?= $supervisor_img.''.$supervisor_name;?></td>
									</tr>
									<tr>
										<td class="pl-0 pb-0"><i class="material-icons-two-tone text-primary f-16">playlist_add_check</i> <?= lang('Main.dashboard_xin_status');?>:</td>
										<td class="pb-0"><?= $status;?></td>
									</tr>
								</tbody>
							</table>                    
						</div>
					</div>
				</div>
			  <?php $i++;} ?>
            </div>
        </div>
        <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    	<?php 
						$form_categories = array(1=>'Employee Forms',2=>'Performance Forms',3=>'Job Candidate Forms',4=>'Approval process set up',5=>'Training evaluation Forms',6=>'Employee exit Forms',7=>'External Forms');
						$i=1;
						foreach($forms as $r) {
						$created_at = set_date_format($r['created_at']);
						//assigned user
						$assigned_to = explode(',',$r['assigned_to']);
						$formfieldscount = $FormsfieldModel->where('company_id',$company_id)->where("form_id",$r['forms_id'])->countAllResults();
						if($r['status']==0){
							$status = '<span class="badge bg-light-success">'.lang('Main.xin_employees_active').'</span>';
						} else {
							$status = '<span class="badge bg-light-danger">'.lang('Main.xin_employees_inactive').'</span>';
						}
						// supervisor
						$supervisor = $UsersModel->where('user_id', $r['supervisor_id'])->first();
						if($supervisor){
							$supervisor_name = $supervisor['first_name'].' '.$supervisor['last_name'];
							$supervisor_img = '<img class="img-fluid img-radius wid-20 me-2" src="'.staff_profile_photo($supervisor['user_id']).'" alt="1">';
						} else {
							$supervisor_name = '--';
							$supervisor_img = '';
						}
					   ?>
                        <div class="card-body py-1 border-bottom">
                            <div class="row justify-content-sm-between m-t-15">
                                <div class="col-sm-4 mb-2 mb-sm-0">
                                    <div class="text-mute">
                                        <strong>#<?= $i;?>. <?= $r['form_name'];?></strong>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <?php foreach($form_categories as $category_key=>$cat_value) {?>
                                <?php if($category_key==$r['category_id']):?> <?= $cat_value ?><?php endif;?>
                                <?php } ?>
                                </div>
                                <div class="col-sm-1">
                                    <?= $status;?>
                                </div>
                                <div class="col-sm-4">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <?= $supervisor_img;?><?= $supervisor_name;?>
                                        </div>
                                        <div>
                                            <p class="d-inline-block mb-0"><i class="material-icons-two-tone f-18 text-primary" title="<?= lang('Main.xin_form_fields_total');?>">fact_check</i> <?= $formfieldscount;?></p>
                                            <p class="d-inline-block mb-0 ms-2">
                                            <div class="dropdown d-inline-block">
                                            <a class="dropdown-toggle arrow-none text-secondary" href="#" data-toggle="dropdown" aria-expanded="false">
                                                <i class="material-icons-two-tone f-18 text-primary">more_vert</i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end" style="">
                                                <a href="<?= site_url('erp/edit-form/').uencode($r['forms_id']);?>" class="dropdown-item">
                                                    <i class="material-icons-two-tone">edit</i>
                                                    <span><?= lang('Main.xin_edit');?></span>
                                                </a>
                                                <a href="<?= site_url('erp/view-form/').uencode($r['forms_id']);?>" class="dropdown-item">
                                                    <i class="material-icons-two-tone">preview</i>
                                                    <span><?= lang('Main.xin_view');?></span>
                                                </a>
                                                <a href="#!" class="dropdown-item" data-toggle="modal" data-target=".edit-modal-data" data-field_type="form_progress" data-field_id="<?= uencode($r['forms_id']);?>">
                                                    <i class="material-icons-two-tone">insert_chart_outlined</i>
                                                    <span><?= lang('Main.xin_form_statistics');?></span>
                                                </a>
                                                <?php if($r['status']==0){ ?>
                                                <a href="javascript:void(0);" class="dropdown-item form-status" data-status_val="1" data-record_id="<?= uencode($r['forms_id']);?>">
                                                    <i class="material-icons-two-tone">visibility_off</i>
                                                    <span><?= lang('Main.xin_employees_inactive');?></span>
                                                </a>
                                                <?php } else {?>
                                                <a href="javascript:void(0);" class="dropdown-item form-status" data-status_val="0" data-record_id="<?= uencode($r['forms_id']);?>">
                                                    <i class="material-icons-two-tone">visibility</i>
                                                    <span><?= lang('Main.xin_employees_active');?></span>
                                                </a>
                                                <?php } ?>
                                                <?php /*?><a href="<?= site_url('erp/submit-form/').uencode($r['forms_id']);?>" class="dropdown-item">
                                                    <i class="material-icons-two-tone">fact_check</i>
                                                    <span><?= lang('Main.xin_form_submit');?></span>
                                                </a><?php */?>
                                                <a href="#!" class="dropdown-item delete" data-toggle="modal" data-target=".delete-modal" data-record-id="<?= uencode($r['forms_id']);?>">
                                                    <i class="material-icons-two-tone">delete_forever</i>
                                                    <span><?= lang('Main.xin_delete');?></span>
                                                </a>
                                            </div>
                                        </div></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <?php $i++;} ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

