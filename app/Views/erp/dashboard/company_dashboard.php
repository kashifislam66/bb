<?php
use CodeIgniter\I18n\Time;

use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\LeaveModel;
use App\Models\WarningModel;
use App\Models\TicketsModel;
use App\Models\ProjectsModel;
use App\Models\ConstantsModel;
use App\Models\MembershipModel;
use App\Models\DesignationModel;
use App\Models\TransactionsModel;
use App\Models\StaffdetailsModel;
use App\Models\AnnouncementModel;
use App\Models\JobinterviewsModel;
use App\Models\ResignationsModel;
use App\Models\CompanymembershipModel;
//$encrypter = \Config\Services::encrypter();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$LeaveModel = new LeaveModel();
$SystemModel = new SystemModel();
$TicketsModel = new TicketsModel();
$WarningModel = new WarningModel();
$ProjectsModel = new ProjectsModel();
$ConstantsModel = new ConstantsModel();
$MembershipModel = new MembershipModel();
$DesignationModel = new DesignationModel();
$TransactionsModel = new TransactionsModel();
$StaffdetailsModel = new StaffdetailsModel();
$AnnouncementModel = new AnnouncementModel();
$JobinterviewsModel = new JobinterviewsModel();
$ResignationsModel = new ResignationsModel();
$CompanymembershipModel = new CompanymembershipModel();

$curr_date = date('Y-m-d');
$curr_date1 = date("m").'-'.date("d");
$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$xin_system = erp_company_settings();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
$company_id = user_company_info();
$total_staff = $UsersModel->where('company_id', $company_id)->where('user_type','staff')->countAllResults();
$total_projects = $ProjectsModel->where('company_id',$company_id)->countAllResults();
$total_tickets = $TicketsModel->where('company_id',$company_id)->countAllResults();
$open = $TicketsModel->where('company_id',$company_id)->where('ticket_status', 1)->countAllResults();
$closed = $TicketsModel->where('company_id',$company_id)->where('ticket_status', 2)->countAllResults();
$new_hires = $JobinterviewsModel->where('company_id',$company_id)->where('status',2)->countAllResults();

$disciplinaries = $WarningModel->where('company_id',$company_id)->countAllResults();
$resignations = $ResignationsModel->where('company_id',$company_id)->countAllResults();
$announcements = $AnnouncementModel->where('company_id',$company_id)->orderBy('announcement_id', 'DESC')->findAll(8);
$cnt_announcements = $AnnouncementModel->where('company_id',$company_id)->orderBy('announcement_id', 'DESC')->countAllResults();
//upcoming birthday
$date_of_leaving = $StaffdetailsModel->where('company_id', $company_id)->like('date_of_birth',$curr_date1)->findAll();
$count_birthday = $StaffdetailsModel->where('company_id', $company_id)->like('date_of_birth',$curr_date1)->countAllResults();
// contracts ending
$contract_end = $StaffdetailsModel->where('company_id',$company_id)->like('date_of_leaving',$curr_date)->findAll(10);
$cnt_contract_end = $StaffdetailsModel->where('company_id',$company_id)->like('date_of_leaving',$curr_date)->countAllResults();
// leave request
$leave_request = $LeaveModel->where('company_id',$company_id)->where('status',1)->findAll();
$cnt_leave_request = $LeaveModel->where('company_id',$company_id)->where('status',1)->countAllResults();

/*$current = Time::parse($curr_date);
$test    = Time::parse('2021-10-28');
$diff = $current->difference($test);

echo $diff->getDays();
echo $curr_date;
if($diff->getDays() <= 14){
	$asd = 'grt';
} else {
	$asd = 'asdasdasdas';
}
echo $asd;*/
	
// membership
$company_membership = $CompanymembershipModel->where('company_id', $usession['sup_user_id'])->first();
$subs_plan = $MembershipModel->where('membership_id', $company_membership['membership_id'])->first();
$current_time = Time::now('Asia/Karachi');
$company_membership_details = company_membership_details();
if($company_membership_details['diff_days'] < 4){
	$alert_bg = 'alert-danger';
} else {
	$alert_bg = 'alert-warning';
}	
?>

<div class="row">
  <div class="col-xl-6 col-md-12">
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="card proj-t-card">
          <div class="card-body">
            <div class="row align-items-center m-b-0">
              <div class="col-auto"> </div>
              <div class="col p-l-0">
                <h6 class="m-b-5">
                  <img src="<?= base_url();?>/public/assets/images/pages/<?= $subs_plan['plan_icon']?>" alt="contact-img" title="contact-img" class="rounded" height="50"> <?= $subs_plan['membership_type'];?> <span class="f-12 text-success ml-1"><?= lang('Membership.xin_current_plan');?></span> <br />
                </h6>
               <?php /*?> <h6 class="m-b-10 text-success">
                  <?= lang('Main.xin_id');?>: <?= $subs_plan['subscription_id'];?>
                </h6><?php */?>
                <div class="alert m-b-0 <?= $alert_bg;?>" role="alert">
					<?= $company_membership_details['plan_msg'];?>
                </div>
              </div>
            </div>
            <h6 class="pt-badge badge-light-success">
              <?= $subs_plan['total_employees']?>
              <?= lang('Dashboard.dashboard_employees');?>
            </h6>
          </div>
          <a href="<?= site_url('erp/subscription-list');?>" class="btn btn-primary btn-sm btn-round">
          <?= lang('Dashboard.dashboard_upgrade');?></a> </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="row">
          <div class="col-sm-6">
            <div class="card prod-p-card bg-primary background-pattern-white">
              <div class="card-body">
                <div class="row align-items-center m-b-0">
                  <div class="col">
                  	<a href="<?= site_url('erp/disciplinary-cases');?>" class="text-white">
                    <h6 class="m-b-5 text-white">
                      <?= lang('Main.xin_disciplinaries');?>
                    </h6>
                    <h3 class="m-b-0 text-white">
                      <?= $disciplinaries;?>
                    </h3>
                    </a>
                  </div>
                  <div class="col-auto"> <i class="fas fa-edit text-white"></i> </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card prod-p-card background-pattern">
              <div class="card-body">
                <div class="row align-items-center m-b-0">
                  <div class="col">
                    <a href="<?= site_url('erp/resignation-list');?>" class="text-white">
                    <h6 class="m-b-5">
                      <?= lang('Dashboard.left_resignations');?>
                    </h6>
                    <h3 class="m-b-0">
                      <?= $resignations;?>
                    </h3>
                    </a>
                  </div>
                  <div class="col-auto"> <i class="fas fa-file-contract text-primary"></i> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-6 col-md-6">
            <div class="card new-cust-card user-Messages-card">
              <div class="card-header">
                <h5>
                  <?= lang('Main.xin_birthday_buddies');?>
                </h5>
              </div>
              <div class="pro-scroll" style="height:215px;position:relative;">
                <div class="card-body p-b-0">
                    <?php
                    foreach($date_of_leaving as $_staff):
						$_staff_info = $UsersModel->where('user_id', $_staff['user_id'])->first();
						if($_staff_info){
							$idesignations = $DesignationModel->where('designation_id',$_staff['designation_id'])->first();
							if($idesignations) {
								$staff_position = $idesignations['designation_name'];
							} else {
								$staff_position = '---';
							}
						?>
						<div class="row m-b-10">
							<div class="col-auto p-r-0">
								<div class="u-img">
									<img src="<?= staff_profile_photo($_staff['user_id']);?>" alt="" class="img-radius profile-img">
									<span class="tot-msg text-success bg-success"><i class="text-white fas fa-birthday-cake m-r-2"></i></span>
								</div>
							</div>
							<div class="col">
								<a href="<?= site_url('erp/employee-details').'/'.uencode($_staff['user_id']);?>">
									<h6 class="m-b-5"><?= $_staff_info['first_name'].' '.$_staff_info['last_name']?></h6>
								</a>
								<h6 class="text-muted m-b-0 m-t-5"><i class="fas fa-address-card"></i> <?= $staff_position;?></h6>
							</div>
						</div>
						<?php } ?>                
                    <?php endforeach;?>
                    <?php if($count_birthday < 1) {?>
                        <div class="text-center">
                            <?= lang('Main.xin_no_birthday_buddies');?> <i class="text-mute fas fa-birthday-cake m-r-2"></i>
                        </div>
                        
                    <?php }?>
                </div>
            </div>
         </div>
         </div>
         <div class="col-xl-6 col-md-6">
            <div class="card feed-card new-cust-card user-Messages-card">
              <div class="card-header">
                <h5>
                  <?= lang('Main.xin_contracts_ending');?>
                </h5>
              </div>
              <div class="feed-scroll" style="height:215px;position:relative;">
                <div class="card-body p-b-0">
                    <?php
					$no_contract_end = 0;
                    foreach($contract_end as $_istaff):
						$_istaff_info = $UsersModel->where('user_id', $_istaff['user_id'])->first();
						if($_istaff_info){
							/*$current = Time::parse($curr_date);
							$contract_ending    = Time::parse($_istaff['date_of_leaving']);
							$diff = $current->difference($contract_ending);
							//echo $diff->getDays().'<br>';
							if($diff->getDays() <= 14 && $diff->getDays() >= 0 && $_istaff['date_of_leaving']!=''){
							$no_contract_end += $diff->getDays();
							if($_istaff['date_of_leaving']!=''){
								$flag += 1;
							} else {
								$flag += 0;
							}*/
							?>
                            <div class="row m-b-10">
                                <div class="col-auto p-r-0">
                                    <div class="u-img">
                                        <img src="<?= staff_profile_photo($_istaff_info['user_id']);?>" alt="" class="img-radius profile-img">
                                        <span class="tot-msg text-success bg-danger"><i class="text-white fas fa-file-contract m-r-2"></i></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <a href="<?= site_url('erp/employee-details').'/'.uencode($_istaff['user_id']);?>">
                                        <h6 class="m-b-5"><?= $_istaff_info['first_name'].' '.$_istaff_info['last_name'];?></h6>
                                    </a>
                                    <h6 class="text-muted m-b-0"><i class="fas fa-calendar-alt"></i> <?= set_date_format($_istaff['date_of_leaving']);?></h6>
                                </div>
                            </div>
                            <?php } else {?>
                            <?php } ?>
						<?php //} ?>                 
                    <?php endforeach;?>
                    <?php if($cnt_contract_end < 1) {?>
                        <div class="text-center">
                            <?= lang('Main.xin_no_upcoming_contracts_ending');?> <i class="text-danger fas fa-file-contract m-r-2"></i>
                        </div>
                    <?php }?>
                </div>
            </div>
         </div>
         </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h6>
              <?= lang('Dashboard.xin_staff_department_wise');?>
            </h6>
            <div class="row d-flex justify-content-center align-items-center">
              <div class="col">
                <div id="department-wise-chart"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12 col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-auto">
                    <h6>
                      <?= lang('Dashboard.xin_staff_attendance');?>
                    </h6>
                  </div>
                  <div class="col">
                    <div class="dropdown float-right">
                      <?= date('d F, Y');?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 pr-0">
                    <h6 class="my-3"><i class="feather icon-users f-20 mr-2 text-primary"></i>
                      <?= lang('Dashboard.xin_total_staff');?>
                    </h6>
                    <h6 class="my-3"><i class="feather icon-user f-20 mr-2 text-success"></i>
                      <?= lang('Attendance.attendance_present');?>
                      <span class="text-success ml-2 f-14"><i class="feather icon-arrow-up"></i></span></h6>
                    <h6 class="my-3"><i class="feather icon-user f-20 mr-2 text-danger"></i>
                      <?= lang('Attendance.attendance_absent');?>
                      <span class="text-danger ml-2 f-14"><i class="feather icon-arrow-down"></i></span></h6>
                  </div>
                  <div class="col-6">
                    <div id="staff-attendance-chart" class="chart-percent text-center"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="companyCalendar">
          <?= view('erp/erp_calendar/staff_anniversary_calendar');?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-md-12">
    <div class="row">
      <div class="col-sm-6">
        <div class="card prod-p-card background-pattern">
          <div class="card-body">
            <div class="row align-items-center m-b-0">
              <div class="col">
              	<a href="<?= site_url('erp/staff-grid');?>" class="text-white">
                <h6 class="m-b-5">
                  <?= lang('Dashboard.xin_total_employees');?>
                </h6>
                <h3 class="m-b-0">
                  <?= $total_staff;?>
                </h3>
                </a>
              </div>
              <div class="col-auto"> <i class="fas fa-user-circle text-primary"></i> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card prod-p-card bg-success background-pattern-white">
          <div class="card-body">
            <div class="row align-items-center m-b-0">
              <div class="col">
                <a href="<?= site_url('erp/promotion-list');?>" class="text-white">
                <h6 class="m-b-5 text-white">
                  <?= lang('Main.xin_new_hires');?>
                </h6>
                <h3 class="m-b-0 text-white">
                  <?= $new_hires;?>
                </h3>
                </a>
              </div>
              <div class="col-auto"> <i class="fas fa-user-plus text-white"></i> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h5>
          <?= lang('Dashboard.left_announcements');?>
        </h5>
      </div>
      <div class="row">
      	<div class="col-xl-12 col-md-12">
            <div class="activity-scroll" style="height:230px;position:relative;">
                <div class="card-body">
                    <div class="tab-pane fade show active m-l-15" id="utab" role="tabpanel">
                    	<?php if($cnt_announcements > 0){?>
                        <?php foreach($announcements as $_announcement) { ?>
                        <div class="widget-timeline m-b-25">
                            <div class="media">
                                <div class="mr-0 photo-table">
                                    <i class="fas fa-circle text-success f-10 m-r-10"></i>
                                </div>
                                <div class="media-body">
                                	<a href="<?= site_url().'erp/announcement-view/'.uencode($_announcement['announcement_id']);?>">
                                    <h6 class="d-inline-block m-0"><?= $_announcement['title'];?></h6>
                                    <span class="text-muted float-right f-13"><i class="fas fa-calendar-alt m-r-2"></i> <?= set_date_format($_announcement['start_date']);?></span>
                                    <p class="text-muted m-0"><?= $_announcement['summary'];?></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } else {?>
                        <div class="text-center m-b-25">
                            <?= lang('Main.xin_no_company_announcements_available');?> <i class="text-mute fas fa-bullhorn m-r-2"></i>
                        </div>
                        <?php } ?>
                    </div>
                    <?php if($cnt_announcements > 0){?>
                    <div class="text-center">
                        <a href="<?= site_url('erp/news-list');?>" class="b-b-primary text-primary"><?= lang('Main.xin_view_all');?></a>
                    </div>
                    <?php } else {?>
                    <div class="text-center">
                        <a href="<?= site_url('erp/news-list');?>" class="b-b-primary text-primary"><?= lang('Main.xin_add_new').' '.lang('Dashboard.left_announcement');?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
         </div>
      </div>
    </div>
    <div class="card">
        <div class="card-body widget-last-task">
            <p class="m-b-10"><?= lang('Main.xin_on_leave_today');?></p>
            <?php
            	$on_leave_status = on_leave_status();
				$today_leave = $on_leave_status['today_leave'];
				$tomorrow_leave = $on_leave_status['tomorrow_leave'];
			?>
            <ul class="list-unstyled m-b-5">
            	<?php foreach($today_leave as $today_leave_users): ?>
                <li class="d-inline-block"><img src="<?= staff_profile_photo($today_leave_users['euser_id']);?>" alt="<?= $today_leave_users['full_name'];?>" class="img-radius wid-30" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?= $today_leave_users['full_name'];?>"></li>
                <?php endforeach;?>
            </ul>
            <p class="m-b-10 "><?= lang('Main.xin_on_leave_tomorrow');?></p>
            <ul class="list-unstyled  m-b-5">
                <?php foreach($tomorrow_leave as $tomorrow_leave_users): ?>
                <li class="d-inline-block"><img src="<?= staff_profile_photo($tomorrow_leave_users['euser_id']);?>" alt="<?= $tomorrow_leave_users['full_name'];?>" class="img-radius wid-30" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?= $tomorrow_leave_users['full_name'];?>"></li>
                <?php endforeach;?>
            </ul>                        
        </div>
    </div>
    <div class="card">
      <div class="card-body">
        <h6>
          <?= lang('Dashboard.xin_staff_designation_wise');?>
        </h6>
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col">
            <div id="designation-wise-chart"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="card flat-card">
      <div class="px-3 pt-3 row">
        <div class="col-sm mb-3">
          <div class="row gx-3">
            <div class="col-auto"> <i class="fa-3x fa fa-ticket-alt text-primary mb-1 d-block"></i> </div>
            <div class="col">
            	<a href="<?= site_url('erp/support-tickets');?>" class="text-muted">
              <h5>
                <?= $total_tickets;?>
              </h5>
              <h6 class="mb-0">
              <?= lang('Dashboard.left_tickets');?>
              </h6></a> </div>
          </div>
        </div>
        <div class="col-sm mb-3">
          <div class="row gx-3">
            <div class="col-auto"> <i class="fa-3x fa fa-folder-open text-warning mb-1 d-block"></i> </div>
            
            <div class="col">
            	<a href="<?= site_url('erp/support-tickets');?>" class="text-muted">
              <h5>
                <?= $open;?>
              </h5>
              <h6 class="mb-0">
              <?= lang('Main.xin_open');?>
              </h6> </a></div>
          </div>
        </div>
        <div class="col-sm mb-3">
          <div class="row gx-3">
            <div class="col-auto"> <i class="fa-3x fa fa-folder text-success mb-1 d-block"></i> </div>
            <div class="col">
            	<a href="<?= site_url('erp/support-tickets');?>" class="text-muted">
              <h5>
                <?= $closed;?>
              </h5>
              <h6 class="mb-0">
              <?= lang('Main.xin_closed');?>
              </h6> </a></div>
          </div>
        </div>
      </div>
    </div>
    <div class="card testimonial-card table-card">
        <div class="card-header">
            <h5><?= lang('Leave.left_leave_request');?></h5>
        </div>
        <div class="test-scroll" style="height:230px;position:relative;">
            <div class="card-body p-b-0">
                <div class="review-block">
                	<?php if($cnt_leave_request > 0) {?>
                	<?php foreach($leave_request as $_leave){
					// leave type
					$ltype = $ConstantsModel->where('constants_id', $_leave['leave_type_id'])->where('type','leave_type')->first();
					if($ltype){
						$itype_name = $ltype['category_name'];
					} else {
						$itype_name = '';
					}
					// applied on
					$applied_on = set_date_format($_leave['created_at']);
					$_ilstaff_info = $UsersModel->where('user_id', $_leave['employee_id'])->first();
					if($_ilstaff_info){
					?>
                    <div class="row">
                        <div class="col-sm-auto p-r-0">
                            <img src="<?= staff_profile_photo($_leave['employee_id']);?>" alt="" class="img-radius profile-img cust-img m-b-15">
                        </div>
                        <div class="col">
                            <h6 class="m-b-10"><?= $_ilstaff_info['first_name'].' '.$_ilstaff_info['last_name'];?> <span class="text-muted float-right text-time"><?= lang('Leave.xin_applied_on');?>: <?= $applied_on;?></span></h6>
                            <h6 class="text-muted">
							<?= lang('Main.xin_leave_applied_title');?> <span class="text-primary"> <a href="<?= site_url().'erp/view-leave-info/'.uencode($_leave['leave_id']);?>" class="text-primary"><?= $itype_name;?></a> </span></h6>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    <?php } else {?>
                    	<div class="text-center m-t-25">
                            <?= lang('Main.xin_no_pending_leave_available');?> <i class="text-mute fas fa-calendar-alt m-r-2"></i>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

