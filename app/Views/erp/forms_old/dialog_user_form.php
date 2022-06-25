<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\FormsModel;
use App\Models\FormsfieldModel;
use App\Models\FormscompletedfieldsModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$UsersModel = new UsersModel();			
$FormsModel = new FormsModel();
$FormsfieldModel = new FormsfieldModel();
$FormscompletedfieldsModel = new FormscompletedfieldsModel();
$get_animate = '';
if($request->getGet('type') === 'form_progress' && $request->getGet('field_id')){
$ifield_id = udecode($field_id);
$request_form = $FormsModel->where('forms_id', $ifield_id)->first();
$result = $FormsModel->where('forms_id', $ifield_id)->findAll();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
$assigned_to = $request_form['assigned_to'];
$exp_assigned_to = explode(',',$assigned_to);
if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}
if(in_array('all',$exp_assigned_to)){
	$assigned_user_info = $UsersModel->where('user_type','staff')->where('company_id', $company_id)->findAll();
} else {
	$assigned_user_info = $exp_assigned_to;
}
?>
<div class="modal-header">
  <h5 class="modal-title">
    <?= $request_form['form_name'];?>
    <br>
    <small class="text-muted">
    <?= lang('Main.xin_form_statistics');?>
    </small>
   </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<div class="modal-body">
<div style="height:385px;position:relative;overflow:auto;">
<div class="box-datatable table-responsive">
  <table class="table table-striped table-bordered dataTable" id="xin_table_modal_progress" style="width:100%;">
    <thead>
      <tr>
        <th><?= lang('Dashboard.dashboard_employee');?></th>
        <th><?= lang('Main.xin_form_submit');?></th>
        <th width="100"><?= lang('Main.xin_created_at');?></th>
        <th width="100"><?= lang('Main.xin_signed_updated_at');?></th>
      </tr>
    </thead>
    <tbody>
    <?php
        if(!in_array('all',$exp_assigned_to)){ 
            foreach($assigned_user_info as $istaff){
                if($istaff!=0){
                $nuser_info = $UsersModel->where('user_id', $istaff)->first();
                $created_at = set_date_format($request_form['created_at']);
                // form completed fields
                $count_completed_form = $FormscompletedfieldsModel->where('company_id',$company_id)->where("form_id",$request_form['forms_id'])->where("staff_id",$istaff)->countAllResults();
                if($count_completed_form > 0){
                $completed_form = $FormscompletedfieldsModel->where('company_id',$company_id)->where("form_id",$request_form['forms_id'])->where("staff_id",$istaff)->first();
				$updated_at = set_date_format($completed_form['created_at']);
				if($completed_form['status']==1):
					$status = '<span class="badge bg-light-success">'.lang('Main.xin_accepted').'</span>';
				else:
					$status = '<span class="badge bg-light-warning">'.lang('Main.xin_pending').'</span>';
				endif;
				$submited = '<a target="_blank" href="'.site_url('erp/user-submited-form').'/'.uencode($completed_form['completed_field_id']).'">'.lang('Main.xin_form_submited_view').'</a><br>'.$status;
                } else {
					$updated_at = '--';
					$submited = '--';
				}
            ?>
            <tr>
                <td><div class="d-inline-block align-middle">
                    <img src="<?= base_url().'/public/uploads/users/thumb/'.$nuser_info['profile_photo'];?>" alt="" class="img-radius align-top m-r-15" style="width:40px;">
                    <div class="d-inline-block">
                        <h6 class="m-b-0"><?= $nuser_info['first_name'].' '.$nuser_info['last_name'];?></h6>
                        <p class="m-b-0"><? //= $signedinfo;?></p>
                    </div>
                </div></td>
                <td><?= $submited;?></td>
                <td width="100"><i class="feather icon-calendar"></i> <?= $created_at;?></td>
                <td width="100"><?= $updated_at;?></td>
              </tr>
    <?php } } } else {
		$all_user_info = $UsersModel->where('user_type','staff')->where('company_id', $company_id)->findAll();
		foreach($all_user_info as $nuser_info){
			$created_at = set_date_format($request_form['created_at']);
			// form completed fields
			$count_completed_form = $FormscompletedfieldsModel->where("form_id",$request_form['forms_id'])->where("staff_id",$nuser_info['user_id'])->countAllResults();
			if($count_completed_form > 0){
			$completed_form = $FormscompletedfieldsModel->where("form_id",$request_form['forms_id'])->where("staff_id",$nuser_info['user_id'])->first();
			$updated_at = set_date_format($completed_form['created_at']);
			if($completed_form['status']==1):
				$status = '<span class="badge bg-light-success">'.lang('Main.xin_accepted').'</span>';
			else:
				$status = '<span class="badge bg-light-warning">'.lang('Main.xin_pending').'</span>';
			endif;
			$submited = '<a target="_blank" href="'.site_url('erp/user-submited-form').'/'.uencode($completed_form['completed_field_id']).'">'.lang('Main.xin_form_submited_view').'</a><br>'.$status;
			} else {
				$updated_at = '--';
				$submited = '--';
			}
		?>
        <tr>
            <td><div class="d-inline-block align-middle">
                <img src="<?= base_url().'/public/uploads/users/thumb/'.$nuser_info['profile_photo'];?>" alt="" class="img-radius align-top m-r-15" style="width:40px;">
                <div class="d-inline-block">
                    <h6 class="m-b-0"><?= $nuser_info['first_name'].' '.$nuser_info['last_name'];?></h6>
                    <p class="m-b-0"><? //= $signedinfo;?></p>
                </div>
            </div></td>
            <td><?= $submited;?></td>
            <td width="100"><i class="feather icon-calendar"></i> <?= $created_at;?></td>
            <td width="100"><?= $updated_at;?></td>
          </tr>
    <?php }} ?>
    </tbody>
  </table>
    </div>
    </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-light" data-dismiss="modal">
  <?= lang('Main.xin_close');?>
  </button>
</div>
<script type="text/javascript">
$(document).ready( function () {
    $('#xin_table_modal_progress').DataTable();
});
</script>
<?php }
?>
