<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\StaffdetailsModel;
use App\Models\ShiftModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$StaffdetailsModel = new StaffdetailsModel();
$ShiftModel = new ShiftModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}
$staff_info = $UsersModel->where('company_id', $company_id)->where('user_type', 'staff')->orderBy('user_id','ASC')->findAll();
$office_shifts = $ShiftModel->where('company_id',$company_id)->orderBy('office_shift_id', 'ASC')->findAll();
?>
<?php
$events_date = date('Y-m-d');
$date = strtotime(date("Y-m-d"));
$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);
$month_year = date('Y-m');
// total days in month
$daysInMonth =  date('t');
?>
<div class="row">
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5><?= lang('Main.xin_shift_calendar'). ' - '.date('F Y');?></h5>
            <span class="d-block m-t-5">
            <?php foreach($office_shifts as $shift_info): ?>
            <?php
				if($shift_info['office_shift_id']==1):
					$eventColor = 'primary';
				elseif($shift_info['office_shift_id']==2):
					$eventColor = 'secondary';
				elseif($shift_info['office_shift_id']==3):
					$eventColor = 'success';
				elseif($shift_info['office_shift_id']==4):
					$eventColor = 'warning';
				elseif($shift_info['office_shift_id']==5):
					$eventColor = 'info';
				elseif($shift_info['office_shift_id']==6):
					$eventColor = 'light';
				elseif($shift_info['office_shift_id']==6):
					$eventColor = 'dark';
				else:
					$eventColor = 'danger';
				endif;
			?>
            <span class="badge badge-<?= $eventColor;?>"><?= $shift_info['shift_name'];?></span>
            <?php endforeach;?>
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-xs" id="xin_table0">
                    <thead>
                        <tr>
                            <th width="350"><?= lang('Dashboard.dashboard_employees');?></th>
                            <?php for($i = 1; $i <= $daysInMonth; $i++): ?>
                            <?php
								if($i < 10):
									$day_val = '0'.$i;
								else:
									$day_val = $i;
								endif;
							?>
                            <th><?= $day_val?></th>
                            <?php endfor;?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($staff_info as $_staff): ?>
						<?php $shift_info = $StaffdetailsModel->where('company_id', $company_id)->where('user_id', $_staff['user_id'])->first(); ?>
                        <?php $shift_detail = $ShiftModel->where('company_id',$company_id)->where('office_shift_id',$shift_info['office_shift_id'])->first(); ?>  
                        <?php if($shift_detail){?>                     
                        <tr>
                            <td width="350"><strong><?= $_staff['first_name'].' '.$_staff['last_name'];?></strong></td>
                            <?php for($i = 1; $i <= $daysInMonth; $i++): ?>
                            <?php
								if($i < 10):
									$day_val = '0'.$i;
								else:
									$day_val = $i;
								endif;
							?>
                            <?php
								if($shift_info['office_shift_id']==1):
									$eventColor = 'primary';
								elseif($shift_info['office_shift_id']==2):
									$eventColor = 'secondary';
								elseif($shift_info['office_shift_id']==3):
									$eventColor = 'success';
								elseif($shift_info['office_shift_id']==4):
									$eventColor = 'warning';
								elseif($shift_info['office_shift_id']==5):
									$eventColor = 'info';
								elseif($shift_info['office_shift_id']==6):
									$eventColor = 'light';
								elseif($shift_info['office_shift_id']==6):
									$eventColor = 'dark';
								else:
									$eventColor = 'danger';
								endif;
							?>
                            <?php
							$attendance_date = $year.'-'.$month.'-'.$day_val;
							$get_day = strtotime($attendance_date);
							$day = date('l', $get_day);
							if($shift_detail){
								
								if($day == 'Monday') {
									if($shift_detail['monday_in_time']==''){
										$attendance_date = '';
										$shift_time = lang('Main.xin_noshift');
										$shift_time_out = '';
										$shw_shift = lang('Main.xin_noshift');
									} else {
										$shift_time = $shift_detail['monday_in_time'];
										$shift_time_out = $shift_detail['monday_out_time'];
										$attendance_date = $year.'-'.$month.'-'.$day_val;
										$shw_shift = $shift_time.' - '.$shift_time_out;
									}
								} else if($day == 'Tuesday') {
									if($shift_detail['tuesday_in_time']==''){
										$attendance_date = '';
										$shift_time = lang('Main.xin_noshift');
										$shift_time_out = '';
										$shw_shift = lang('Main.xin_noshift');
									} else {
										$shift_time = $shift_detail['tuesday_in_time'];
										$shift_time_out = $shift_detail['tuesday_out_time'];
										$attendance_date = $year.'-'.$month.'-'.$day_val;
										$shw_shift = $shift_time.' - '.$shift_time_out;
									}
								} else if($day == 'Wednesday') {
									if($shift_detail['wednesday_in_time']==''){
										$attendance_date = lang('Main.xin_noshift');
										$shift_time = lang('Main.xin_noshift');
										$shift_time_out = '';
										$shw_shift = lang('Main.xin_noshift');
									} else {
										$shift_time = $shift_detail['wednesday_in_time'];
										$shift_time_out = $shift_detail['wednesday_out_time'];
										$attendance_date = $year.'-'.$month.'-'.$day_val;
										$shw_shift = $shift_time.' - '.$shift_time_out;
									}
								} else if($day == 'Thursday') {
									if($shift_detail['thursday_in_time']==''){
										$attendance_date = '';
										$shift_time = lang('Main.xin_noshift');
										$shift_time_out = '';
										$shw_shift = lang('Main.xin_noshift');
									} else {
										$shift_time = $shift_detail['thursday_in_time'];
										$attendance_date = $year.'-'.$month.'-'.$day_val;
										$shift_time_out = $shift_detail['thursday_out_time'];
										$shw_shift = $shift_time.' - '.$shift_time_out;
									}
								} else if($day == 'Friday') {
									if($shift_detail['friday_in_time']==''){
										$attendance_date = '';
										$shift_time = lang('Main.xin_noshift');
										$shift_time_out = '';
										$shw_shift = lang('Main.xin_noshift');
									} else {
										$shift_time = $shift_detail['friday_in_time'];
										$attendance_date = $year.'-'.$month.'-'.$day_val;
										$shift_time_out = $shift_detail['friday_out_time'];
										$shw_shift = $shift_time.' - '.$shift_time_out;
									}
								} else if($day == 'Saturday') {
									if($shift_detail['saturday_in_time']==''){
										$attendance_date = '';
										$shift_time = lang('Main.xin_noshift');
										$shift_time_out = '';
										$shw_shift = lang('Main.xin_noshift');
									} else {
										$shift_time = $shift_detail['saturday_in_time'];
										$shift_time_out = $shift_detail['saturday_out_time'];
										$attendance_date = $year.'-'.$month.'-'.$day_val;
										$shw_shift = $shift_time.' - '.$shift_time_out;
									}
								} else if($day == 'Sunday') {
									if($shift_detail['sunday_in_time']==''){
										$attendance_date = '';
										$shift_time = lang('Main.xin_noshift');
										$shift_time_out = '';
										$shw_shift = lang('Main.xin_noshift');
									} else {
										$shift_time = $shift_detail['sunday_in_time'];
										$shift_time_out = $shift_detail['sunday_out_time'];
										$attendance_date = $year.'-'.$month.'-'.$day_val;
										$shw_shift = $shift_time.' - '.$shift_time_out;
									}
								} else {
									$shift_time = lang('Main.xin_noshift');
									$shift_time_out = '';
									$attendance_date = '';
									$shw_shift = lang('Main.xin_noshift');
								}
							} else {
								$shift_time = lang('Main.xin_noshift');
								$shift_time_out = '';
								$attendance_date = '';
								$shw_shift = lang('Main.xin_noshift');
							}
						?>
                            <td><a data-modal_mode="1" data-time_val="<?= $day;?>" data-attendance_date="<?= $attendance_date;?>" data-field_id="<?= uencode($shift_detail['office_shift_id']);?>" href="#" data-toggle="modal" data-target=".view-modal-data" ><span class="badge badge-<?=$eventColor;?>"><?= $shw_shift;?></span></a></td>
                            <?php endfor;?>
                        </tr>
                        <?php } else {
							$attendance_date = $year.'-'.$month.'-'.$day_val;
							$get_day = strtotime($attendance_date);
							$day = date('l', $get_day);
							?>
                        <tr>
                        <td width="350"><strong><?= $_staff['first_name'].' '.$_staff['last_name'];?></strong></td>
                        <td>
                        <a data-modal_mode="0" data-time_val="0" data-attendance_date="0" data-field_id="<?= uencode($_staff['user_id']);?>" href="#" data-toggle="modal" data-target=".view-modal-data" >
                        <span class="badge badge-danger"><?= lang('Main.xin_noshift_assigned');?></span></a></td>
                        </tr>
                        <?php } ?>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>