<?php
use App\Models\UsersModel;
use App\Models\ShiftModel;
use App\Models\SystemModel;
use App\Models\StaffdetailsModel;

$ShiftModel = new ShiftModel();
$SystemModel = new SystemModel();
$UsersModel = new UsersModel();
$StaffdetailsModel = new StaffdetailsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');

$user_info = $StaffdetailsModel->where('user_id', $user_id)->first();
$office_shift = $ShiftModel->where('office_shift_id',$user_info['office_shift_id'])->first();
?>

<div class="form-group">
  <label class="form-label">
    <?= lang('Employees.xin_employee_office_shift');?>
  </label>
  <span class="text-danger">*</span>
  <select class="form-control" name="office_shift_id_m" data-plugin="select_hrm" data-placeholder="<?= lang('Employees.xin_employee_office_shift');?>">
    <option value="">
    <?= lang('Employees.xin_employee_office_shift');?>
    </option>
    <option value="<?= $office_shift['office_shift_id']?>">
    <?= $office_shift['shift_name']?>
    </option>
  </select>
</div>
<script type="text/javascript">
$(document).ready(function(){	
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });
});
</script>