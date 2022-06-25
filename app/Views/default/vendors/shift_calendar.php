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
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      now: '<?= $events_date;?>',
      editable: true,
      aspectRatio: 1.8,
      scrollTime: '00:00',
      headerToolbar: {
        left: 'today',
        center: 'title',
        right: 'resourceTimelineMonth'
      },
      initialView: 'resourceTimelineMonth',
      
      navLinks: true,
      resourceAreaWidth: '22%',
      resourceAreaHeaderContent: '<?= lang('Dashboard.dashboard_employees');?>',
      resources: [
        <?php foreach($staff_info as $_staff): ?>
		<?php $shift_info = $StaffdetailsModel->where('company_id', $company_id)->where('user_id', $_staff['user_id'])->first(); ?>
		<?php $shift_detail = $ShiftModel->where('company_id',$company_id)->where('office_shift_id',$shift_info['office_shift_id'])->first(); ?>
		<?php
			if($shift_info['office_shift_id']==1):
				$eventColor = 'blue';
			elseif($shift_info['office_shift_id']==2):
				$eventColor = 'orange';
			elseif($shift_info['office_shift_id']==3):
				$eventColor = 'pink';
			elseif($shift_info['office_shift_id']==4):
				$eventColor = 'green';
			else:
				$eventColor = 'purple';
			endif;
		?>
		{ id: '<?= $_staff['user_id'];?>', title: '<?= $_staff['first_name'].' '.$_staff['last_name'];?>',eventColor: '<?= $eventColor;?>' },
        <?php endforeach;?>
      ],
      events: [
	  <?php foreach($staff_info as $_staff): ?>
	  <?php for($i = 1; $i <= $daysInMonth; $i++): ?>
	  	<?php
			if($i < 10):
				$day_val = '0'.$i;
			else:
				$day_val = $i;
			endif;
		?>
		<?php $shift_info = $StaffdetailsModel->where('company_id', $company_id)->where('user_id', $_staff['user_id'])->first(); ?>
		<?php $shift_detail = $ShiftModel->where('company_id',$company_id)->where('office_shift_id',$shift_info['office_shift_id'])->first(); ?>
	  	<?php
			$attendance_date = $year.'-'.$month.'-'.$day_val;
			$get_day = strtotime($attendance_date);
			$day = date('l', $get_day);
			if($shift_detail){
				
				if($day == 'Monday') {
					if($shift_detail['monday_in_time']==''){
						$attendance_date = '';
					} else {
						$attendance_date = $year.'-'.$month.'-'.$day_val;
					}
				} else if($day == 'Tuesday') {
					if($shift_detail['tuesday_in_time']==''){
						$attendance_date = '';
					} else {
						$attendance_date = $year.'-'.$month.'-'.$day_val;
					}
				} else if($day == 'Wednesday') {
					if($shift_detail['wednesday_in_time']==''){
						$attendance_date = '';
					} else {
						$attendance_date = $year.'-'.$month.'-'.$day_val;
					}
				} else if($day == 'Thursday') {
					if($shift_detail['thursday_in_time']==''){
						$attendance_date = '';
					} else {
						$attendance_date = $year.'-'.$month.'-'.$day_val;
					}
				} else if($day == 'Friday') {
					if($shift_detail['friday_in_time']==''){
						$attendance_date = '';
					} else {
						$attendance_date = $year.'-'.$month.'-'.$day_val;
					}
				} else if($day == 'Saturday') {
					if($shift_detail['saturday_in_time']==''){
						$attendance_date = '';
					} else {
						$attendance_date = $year.'-'.$month.'-'.$day_val;
					}
				} else if($day == 'Sunday') {
					if($shift_detail['sunday_in_time']==''){
						$attendance_date = '';
					} else {
						$attendance_date = $year.'-'.$month.'-'.$day_val;
					}
				} else {
					$attendance_date = '';
				}
			} else {
				$attendance_date = '';
			}
		?>
        { id: '<?= $day_val;?>', resourceId: '<?= $_staff['user_id'];?>', start: '<?= $attendance_date;?>', end: '<?= $attendance_date;?>', title: '', },
        <?php endfor;?>
		<?php endforeach;?>
      ]
    });

    calendar.render();
  });

</script>
<style>
  #calendar {
    max-width: 1100px;
  }
  .fc-timeline-event-harness {
	  width:20px !important;
  }
  .fc-scroller {
	      overflow: scroll !important;
  }

</style>