<?php
use CodeIgniter\I18n\Time;
use App\Models\SystemModel;
use App\Models\JobsModel;
use App\Models\UsersModel;
use App\Models\LanguageModel;
use App\Models\ConstantsModel;
use App\Models\DepartmentModel;
use App\Models\AnnouncementModel;
use App\Models\AnnouncementcommentsModel;

$SystemModel = new SystemModel();
$JobsModel = new JobsModel();
$UsersModel = new UsersModel();
$LanguageModel = new LanguageModel();
$ConstantsModel = new ConstantsModel();
$DepartmentModel = new DepartmentModel();
$AnnouncementModel = new AnnouncementModel();
$AnnouncementcommentsModel = new AnnouncementcommentsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$router = service('router');
$request = \Config\Services::request();
$locale = service('request')->getLocale();

$segment_id = $request->uri->getSegment(3);
$ifield_id = udecode($segment_id);

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$result = $AnnouncementModel->where('company_id',$user_info['company_id'])->where('announcement_id', $ifield_id)->first();
} else {
	$result = $AnnouncementModel->where('company_id',$usession['sup_user_id'])->where('announcement_id', $ifield_id)->first();
}
// suggestion comments
$comments = $AnnouncementcommentsModel->where('announcement_id', $ifield_id)->orderBy('comment_id', 'ASC')->findAll();
?>

<div class="row">
  <div class="col-xl-4 col-lg-12 task-detail-right">
    <div class="card">
      <div class="card-header">
        <h5><?= lang('Dashboard.left_announcement');?></h5>
      </div>
      <div class="card-body task-details">
        <table class="table">
          <tbody>
            <tr>
              <td><i class="far fa-calendar-alt m-r-5"></i> <?php echo lang('Projects.xin_start_date');?>:</td>
              <td class="text-right"><?= set_date_format($result['start_date']);?></td>
            </tr>
            <tr>
              <td><i class="far fa-calendar-alt m-r-5"></i> <?php echo lang('Projects.xin_end_date');?>:</td>
              <td class="text-right"><?= set_date_format($result['end_date']);?></td>
            </tr>
            <tr>
              <td><i class="far fa-calendar-alt m-r-5"></i> <?php echo lang('Main.xin_created_at');?>:</td>
              <td class="text-right"><?= set_date_format($result['created_at']);?></td>
            </tr>
            <?php $department_ids = explode(',',$result['department_id']); ?>
            <tr>
              <td><i class="fas fa-user-shield m-r-5"></i>
                <?= lang('Dashboard.left_department');?>
                :</td>
              <td>
			  <?php
			  if(in_array('all',$department_ids)) {
				  echo lang('Main.xin_all_departments');
			  } else {
				  foreach($department_ids as $department_id) {
					  if($department_id!=0){
						$department = $DepartmentModel->where('department_id', $department_id)->first();
						echo $department['department_name'].'<br>';
					  }
				  }
			  }
			  ?>
              </td>
            </tr>
            <?php $audience_ids = explode(',',$result['audience_id']); ?>
            <tr>
              <td><i class="fas fa-users m-r-5"></i>
                <?= lang('Main.xin_audience');?>
                :</td>
              <td>
			  <?php
			  if(in_array('all',$audience_ids)) {
				  echo lang('Main.xin_all_audience');
			  } else {
				  foreach($audience_ids as $employee_id) {
					  if($employee_id!=0){
						$iuser_info = $UsersModel->where('user_id', $employee_id)->first();
						if($iuser_info){
							echo $iuser_info['first_name'].' '.$iuser_info['last_name'].'<br>';
						}
					  }
				  }
			  }
			  ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-xl-8 col-lg-12">
    <div class="card">
      <div class="card-header">
        <h5 class=""><i class="fas fa-ticket-alt m-r-5"></i>
          <?= $result['title'];?>
        </h5>
        
      </div>
      <div class="card-body">
        <div class="m-b-20">
          <h6>
            <?= lang('Main.xin_summary');?>
          </h6>
          <hr>
          <p>
            <?= $result['summary'];?>
          </p>
        </div>
        <div class="m-b-20">
          <h6>
            <?= lang('Main.xin_description');?>
          </h6>
        </div>
        <hr>
        <div class="m-b-20">
          
          <p>
            <?= html_entity_decode($result['description']);?>
          </p>
          <hr>
          <h6>
            <?= lang('Main.xin_comments');?>
          </h6>
          <div class="card-body task-comment">
              <ul class="media-list p-0">
                <?php $tn=0; foreach($comments as $_note){ ?>
                <?php $time = Time::parse($_note['created_at']); ?>
                <?php $note_user = $UsersModel->where('user_id', $_note['employee_id'])->first();?>
                <li class="media" id="option_id_<?= $_note['comment_id'];?>">
                  <div class="media-left mr-3"> <a href="#!"> <img class="img-fluid media-object img-radius comment-img" src="<?= staff_profile_photo($_note['employee_id']);?>" alt=""> </a> </div>
                  <div class="media-body">
                    <h6 class="media-heading txt-primary">
                      <?= $note_user['first_name'].' '.$note_user['last_name'];?>
                      <span class="f-12 text-muted ml-1">
                      <?= time_ago($_note['created_at']);?>
                      </span></h6>
                    <p>
                      <?= $_note['announcement_comment'];?>
                    </p>
                    <div class="m-t-10"> <span><a href="#!" data-field="<?= $_note['comment_id'];?>" data-title="training" class="delete_data m-r-10 text-secondary"><i class="fas fa-trash-alt text-danger mr-2"></i>
                      <?= lang('Main.xin_delete');?>
                      </a></span><span></span> </div>
                  </div>
                </li>
                <hr class="option_id_<?= $_note['comment_id'];?>">
                <?php } ?>
              </ul>
              <?php $attributes = array('name' => 'add_comment', 'id' => 'add_comment', 'autocomplete' => 'off');?>
              <?php $hidden = array('token' => $segment_id);?>
              <?= form_open('erp/announcements/add_comment', $attributes, $hidden);?>
              <div class="input-group mb-3">
                <input type="text" name="description" class="form-control" placeholder="<?= lang('Main.xin_add_your_comments');?>">
                <div class="input-group-append">
                  <button class="btn waves-effect waves-light btn-primary btn-icon" type="submit"><i class="fa fa-plus"></i></button>
                </div>
              </div>
              <?= form_close(); ?>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
