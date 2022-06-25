<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\DepartmentModel;
use App\Models\StaffdetailsModel;
use App\Models\CompanyticketsModel;
//$encrypter = \Config\Services::encrypter();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$CompanyticketsModel = new CompanyticketsModel();
$DepartmentModel = new DepartmentModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();

if($user_info['user_type'] == 'company' || $user_info['user_type'] == 'staff'){
   $get_tickets = $CompanyticketsModel->where('company_id',$usession['sup_user_id'])->orderBy('ticket_id', 'ASC')->paginate(9);
   $pager = $CompanyticketsModel->pager;
} else {
	$get_tickets = $CompanyticketsModel->orderBy('ticket_id', 'ASC')->paginate(9);
	$pager = $CompanyticketsModel->pager;
}
?>

<div class="row help-desk">
  <div class="col-xl-12 col-lg-12">
    <div class="card">
      <div class="card-body">
        <nav class="navbar justify-content-between p-0 align-items-center">
         <?php if($user_info['user_type'] == 'company'){ ?>
          <h5>
            <?= lang('Users.xin_my_tickets');?>
          </h5>
          <?php } else {?>
          <h5>
            <?= lang('Dashboard.left_tickets_list');?>
          </h5>
          <?php } ?>
          <div class="btn-group btn-group-toggle" data-toggle="buttons"> <a href="<?= site_url().'erp/create-new';?>" class="btn waves-effect waves-light btn-primary btn-sm m-0"> <i data-feather="plus"></i>
            <?= lang('Dashboard.left_create_ticket');?>
            </a> </div>
        </nav>
      </div>
    </div>
    <?php foreach($get_tickets as $r){ ?>
    <?php
		// created by
		$created_by = $UsersModel->where('user_id', $r['created_by'])->first();
		$icreated_by = $created_by['first_name'].' '.$created_by['last_name'];
		// assigned employee
		$iuser = $UsersModel->where('user_id', $r['company_id'])->first();
		$employee_name = $iuser['first_name'].' '.$iuser['last_name'];
		// created at
		$created_at = set_date_format($r['created_at']);
		// priority
		if($r['ticket_priority']==1):
			$priority = '<span class="text-warning">'.lang('Projects.xin_low').'</span>';
		elseif($r['ticket_priority']==2):
			$priority = '<span class="text-success">'.lang('Main.xin_medium').'</span>';
		elseif($r['ticket_priority']==3):
			$priority = '<span class="text-danger">'.lang('Projects.xin_high').'</span>';
		elseif($r['ticket_priority']==4):
			$priority = '<span class="text-danger">'.lang('Main.xin_critical').'</span>';
		endif;
		// status
		if($r['ticket_status']==1):
			$status = '<span class="text-warning">'.lang('Main.xin_open').'</span>';
		elseif($r['ticket_status']==2):
			$status = '<span class="text-success">'.lang('Main.xin_closed').'</span>';
		else:
			$status = '<span class="text-warning">'.lang('Main.xin_open').'</span>';
		endif;
		?>
    <div class="ticket-block">
      <div class="row">
        <div class="col-auto"> <img class="media-object wid-60 img-radius" src="<?= staff_profile_photo($r['created_by']);?>" alt=""> </div>
        <div class="col ps-md-3 ps-0">
          <div class="card hd-body">
            <div class="row align-items-center me-0">
              <div class="col border-right pe-0">
                <div class="card-body inner-center pe-0">
                  <div class="ticket-customer font-weight-bold">
                    <?= $icreated_by;?>
                  </div>
                  <div class="ticket-type-icon private mt-1 mb-1"><i class="feather icon-lock mr-1 f-14"></i>
                    <?= $r['subject'];?>
                  </div>
                  <ul class="list-inline mt-2 mb-0">
                    <li class="list-inline-item">#
                      <?= $r['ticket_code'];?>
                    </li>
                    <li class="list-inline-item"><img src="<?= staff_profile_photo($r['company_id']);?>" alt="" class="wid-20 rounded mr-1 img-fluid">
                      <?= lang('Users.xin_created_by');?>
                      <?= $employee_name;?>
                    </li>
                    <li class="list-inline-item"><i class="feather icon-calendar mr-1 f-14"></i>
                      <?= $created_at;?>
                    </li>
                    <li class="list-inline-item">
                      <?= $priority;?>
                    </li>
                    <li class="list-inline-item">
                      <?= $status;?>
                    </li>
                  </ul>
                  <div class="excerpt mt-md-4 mt-3">
                        <h6><img src="<?= staff_profile_photo($r['company_id']);?>" alt="" class="wid-20 avatar me-2 rounded"><?= lang('Main.xin_description');?></h6>
                        <p><?= substr($r['description'],0,200);?></p>
                    </div>
                  <div class="mt-2"> 
                  <?php if($r['ticket_status']==1){ ?>
                  <a href="#" class="mr-3 text-muted" data-toggle="modal" data-target=".view-modal-data" data-field_id="<?= uencode($r['ticket_id']);?>"><i class="feather icon-edit mr-1"></i>
                    <?= lang('Main.xin_edit');?>
                    </a> 
                    <?php } ?>
                    <a href="<?= site_url('erp/ticket-details').'/'.uencode($r['ticket_id']);?>" class="mr-3 text-muted"><i class="feather icon-eye mr-1"></i>
                    <?= lang('Dashboard.left_view_ticket');?>
                    </a> 
                    <a href="#" class="text-danger delete" data-toggle="modal" data-target=".delete-modal" data-record-id="<?= uencode($r['ticket_id']);?>"><i class="feather icon-trash-2 mr-1"></i>
                    <?= lang('Main.xin_delete');?>
                    </a>
                    </div>
                </div>
              </div>
              <div class="col-auto ps-3 ps-0 right-icon">
                <div class="card-body p-md-3 px-0">
                  <ul class="list-unstyled mb-0">
                    <li><a href="<?= site_url('erp/ticket-details').'/'.uencode($r['ticket_id']);?>" data-toggle="tooltip" data-placement="top" title="<?= lang('Dashboard.left_view_ticket');?>"><i class="feather icon-circle text-muted"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<hr>
<div class="p-2">
<?= $pager->links() ?>
</div>