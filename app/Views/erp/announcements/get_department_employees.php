<?php
use App\Models\SystemModel;
use App\Models\UsersModel;
use App\Models\DesignationModel;
use App\Models\StaffdetailsModel;

$UsersModel = new UsersModel();
$DesignationModel = new DesignationModel();
$StaffdetailsModel = new StaffdetailsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
//echo $field_id;
if(isset($field_id)){
/*$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	//$employee_detail = $StaffdetailsModel->where('user_id', $result['user_id'])->first();
	//$designations = $DesignationModel->where('company_id',$user_info['company_id'])->where('department_id',$department_id)->orderBy('designation_id', 'ASC')->findAll();
} else {
	//$designations = $DesignationModel->where('company_id',$usession['sup_user_id'])->where('department_id',$department_id)->orderBy('designation_id', 'ASC')->findAll();
}*/
$department_details = explode(',',$field_id);//$StaffdetailsModel->whereIn('department_id', 3)->findAll();
?>

<div class="form-group" id="staff_ajax">
  <label class="form-label">
    <?= lang('Main.xin_select_audience');?>
  </label>
  <span class="text-danger">*</span>
  <select class="form-control" multiple="multiple" name="audience_id[]" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_select_audience');?>">
    <option value="">
    <?= lang('Main.xin_select_audience');?>
    </option>
    <option value="all" selected="selected">
	  <?= lang('Main.xin_all');?>
      </option>
    <?php foreach($department_details as $idepartment) {
			if($idepartment!='all'){
		?>
		<?php $idepartment_info = $StaffdetailsModel->where('department_id', $idepartment)->findAll();?>
        <?php foreach($idepartment_info as $istaff): ?>
			<?php $user_info = $UsersModel->where('user_id', $istaff['user_id'])->first();?>
            <?php if($user_info) {?>
            <option value="<?= $user_info['user_id']?>">
           <?= $user_info['first_name'].' '.$user_info['last_name']?>
            </option>
            <?php } ?>
        <?php endforeach;?>
    <?php } }?>
  </select>
  <?php /*?><?php foreach($department_details as $idepartment) {?>
		<?php $idepartment_info = $StaffdetailsModel->where('department_id', $idepartment)->findAll();?>
        <?php foreach($idepartment_info['user_id'] as $istaff): ?>
			<?php $user_info = $UsersModel->where('user_id', $istaff['user_id'])->first();?>
            <option value="<?= $user_info['user_id']?>">
            <?= $user_info['first_name']?>
            </option>
        <?php endforeach;?>
    <?php } ?><?php */?>
</div>
<script type="text/javascript">
$(document).ready(function(){	
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });
});
</script>
<?php } ?>