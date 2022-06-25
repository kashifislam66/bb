<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\LeaveModel;
use App\Models\ConstantsModel;
use App\Models\StaffdetailsModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$LeaveModel = new LeaveModel();
$ConstantsModel = new ConstantsModel();
$StaffdetailsModel = new StaffdetailsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

///
$segment_id = $request->uri->getSegment(3);
$ifield_id = udecode($segment_id);
$result = $LeaveModel->where('leave_id', $ifield_id)->first();
$user_info = $UsersModel->where('user_id', $result['employee_id'])->first();
$ltype = $ConstantsModel->where('constants_id', $result['leave_type_id'])->where('type','leave_type')->first();

$iuser_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($iuser_info['user_type'] == 'staff'){
	$leave_types = $ConstantsModel->where('company_id',$iuser_info['company_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
} else {
	$leave_types = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
}
$employee_detail = $StaffdetailsModel->where('user_id', $result['employee_id'])->first();
?>

<div class="row">
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header">
        <h5>
          <?= lang('Leave.xin_leave_details');?>
        </h5>
      </div>
      <?php if(in_array('leave7',staff_role_resource()) || $iuser_info['user_type'] == 'company') { ?>
      <?php $attributes = array('name' => 'update_status', 'id' => 'update_status', 'autocomplete' => 'off');?>
      <?php $hidden = array('user_id' => 1, 'token_status' => $segment_id);?>
      <?php echo form_open('erp/leave/update_leave_status', $attributes, $hidden);?>
      <?php } ?>
      <div class="card-body task-details">
        <table class="table-responsive table">
          <tbody>
            <tr>
              <td><i class="fas fa-user-check m-r-5"></i>
                <?= lang('Dashboard.dashboard_employee');?>
                :</td>
              <td class="text-right"><span class="float-right"><?php echo $user_info['first_name'].''.$user_info['last_name'];?></span></td>
            </tr>
            <tr>
              <td><i class="fas fa-tasks m-r-5"></i>
                <?= lang('Leave.xin_leave_type');?>
                :</td>
              <td class="text-right"><?php echo $ltype['category_name'];?></td>
            </tr>
            <tr>
              <td><i class="far fa-calendar-alt m-r-5"></i>
                <?= lang('Leave.xin_applied_on');?>
                :</td>
              <td class="text-right"><?= set_date_format($result['created_at']);?></td>
            </tr>
            <?php if($result['from_date'] != ''):?>
            <tr>
              <td><i class="far fa-calendar-alt m-r-5"></i>
                <?= lang('Projects.xin_start_date');?>
                :</td>
              <td class="text-right">
                  <?= set_date_format($result['from_date']);?>
              </td>
            </tr>
            <tr>
              <td><i class="far fa-calendar-alt m-r-5"></i>
                <?= lang('Projects.xin_end_date');?>
                :</td>
              <td class="text-right"><?= set_date_format($result['to_date']);?></td>
            </tr>
            <?php endif;?>
            <?php if($result['from_date'] == '' && $result['particular_date'] != ''):?>
            <tr>
              <td><i class="far fa-calendar-alt m-r-5"></i>
                <?= lang('Main.xin_particular_date');?>
                :</td>
              <td class="text-right">
                  <?= set_date_format($result['particular_date']);?>
              </td>
            </tr>
            <?php endif;?>
            <tr>
              <td><i class="fas fa-cloud-download-alt m-r-5"></i>
                <?= lang('Main.xin_attachment');?>
                :</td>
              <td class="text-right"><?php if($result['leave_attachment']!='' && $result['leave_attachment']!='NULL'):?>
                <a href="<?= site_url()?>download?type=leave&filename=<?php echo uencode($result['leave_attachment']);?>">
                <?= lang('Main.xin_download');?>
                </a>
                <?php else:?>
                <?php endif;?></td>
            </tr>
            <tr>
              <td><i class="fas fa-user-clock m-r-5"></i>
                <?= lang('Main.xin_leave_hours');?>
                :</td>
              <td class="text-right"><?php 
				echo $result['leave_hours'];?></td>
            </tr>
          </tbody>
        </table>
        <div>
          <div class="row mt-2 mb-2">
            <div class="col-md-12"> <span class=" txt-primary"> <i class="fas fa-chart-line"></i> <strong>
              <?= lang('Main.dashboard_xin_status');?>
              </strong> </span> </div>
          </div>
          <div class="row justify-content-md-center mb-2">
            <div class="col-md-12">
              <div class="form-group leave-status">
                <select class="form-control" data-plugin="select_hrm" name="status" autocomplete="off">
                  <option value="1" <?php if($result['status']=='1'):?> selected <?php endif; ?>>
                  <?= lang('Main.xin_pending');?>
                  </option>
                  <option value="2" <?php if($result['status']=='2'):?> selected <?php endif; ?>>
                  <?= lang('Main.xin_approved');?>
                  </option>
                  <option value="3" <?php if($result['status']=='3'):?> selected <?php endif; ?>>
                  <?= lang('Main.xin_rejected');?>
                  </option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="remarks">
                  <?= lang('Recruitment.xin_remarks');?>
                </label>
                <textarea class="form-control textarea" placeholder="<?= lang('Recruitment.xin_remarks');?>" name="remarks" id="remarks"><?php echo $result['remarks'];?></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php if(in_array('leave7',staff_role_resource()) || $iuser_info['user_type'] == 'company') { ?>
      <div class="card-footer text-right">
        <button type="submit" class="btn btn-success">
        <?= lang('Main.xin_update_status');?>
        </button>
      </div>
      <?= form_close(); ?>
      <?php } ?>
    </div>
  </div>
  <div class="col-lg-8">
    <?php /*?><div class="card">
      <div class="card-header">
        <h5><i class="feather icon-lock mr-1"></i>
          <?= lang('Leave.xin_leave_reason');?>
        </h5>
      </div>
      <div class="card-body hd-detail hdd-admin border-bottom">
        <div class="row"> <?php echo $result['reason'];?> </div>
      </div>
    </div><?php */?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header with-elements"> <span class="card-header-title mr-2"><strong>
            <?= lang('Leave.xin_leave_statistics');?>
            </strong></span> </div>
          <div class="card-body">
          <?php
           if($employee_detail['leave_options'] == '') {
			  $ileave_option = 0;
		  } else {
			  $ileave_option = unserialize($employee_detail['leave_options']);
		  }
		  if($employee_detail['assigned_hours'] == '') {
			  $iassigned_hours = 0;
		  } else {
			  $iassigned_hours = unserialize($employee_detail['assigned_hours']);
		  }
		  ?>
          <?php $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');?>
          <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="350">#</th>
                            <th width="100">#</th>
                            <?php foreach($months as $_key=>$_val) { ?>
                            <th><?= $_val;?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php foreach($leave_types as $ltype){ ?>
                        <?php
						$ifieldleave_option = unserialize($ltype['field_one']);
						 if(isset($iassigned_hours[$ltype['constants_id']])) {
							   $iiiassigned_hours = $iassigned_hours[$ltype['constants_id']];
						  } else {
							  $iiiassigned_hours = 0;
						  }
						  if(isset($ifieldleave_option['enable_leave_accrual']) && $ifieldleave_option['enable_leave_accrual'] == 1){
						 ?>
                        <tr>
                        	<td width="350"><strong class="text-muted"><?= $ltype['category_name'];?></strong></td>
                            <td width="100"><?= $iiiassigned_hours;?><br /><small><?= lang('Main.xin_assigned_hrs');?></small></td>
                        	<?php foreach($months as $key=>$val) { ?>
                            <?php
							$count_l = count_employee_leave_hours($user_info['user_id'],$ltype['constants_id'],$key);
							$rem_leave = $ileave_option[$ltype['constants_id']][$key]-$count_l;
							if($rem_leave == 0){
								$text = 'text-danger';
							} else {
								$text = 'text-success';
							}
							?>
                            <td><?= lang('Main.xin_owed');?>: <?= $ileave_option[$ltype['constants_id']][$key];?> hrs<br /><small class="<?= $text;?>"><?= lang('Main.xin_remaining');?>: <?= $ileave_option[$ltype['constants_id']][$key]-$count_l;?> hrs</small></td>
                            <?php }?>
                        </tr>
                        <?php } else {?>
                        <tr>
                        	<td width="350"><strong class="text-muted"><?= $ltype['category_name'];?></strong></td>
                            <td width="100"><?= $iiiassigned_hours;?><br /><small><?= lang('Main.xin_assigned_hrs');?></small></td>
                            <td colspan="12"></td>
                         </tr>
                        <?php }?>
                        <?php }?>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
