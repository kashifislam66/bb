<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\PolicyModel;

$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$SystemModel = new SystemModel();
$PolicyModel = new PolicyModel();
$session = \Config\Services::session();
$usession = $session->get('sup_username');

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$get_data = $PolicyModel->where('company_id',$user_info['company_id'])->orderBy('policy_id', 'ASC')->findAll();
} else {
	$get_data = $PolicyModel->where('company_id',$usession['sup_user_id'])->orderBy('policy_id', 'ASC')->findAll();
}
$data = array();
?>
<?php if(in_array('policy2',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
<div class="align-items-center d-flex d-md-block font-weight-bold justify-content-between  flex-grow-1 container-p-y mt-lg-4 mt-3">
  <h3 class="mb-md-2 mb-0 py-1 text-center">
    <?= lang('Dashboard.xin_view_policies');?>
    
  </h3>
  <div class="ms-auto text-left">
    <a class="text-dark" href="<?php echo site_url('erp/policies-list');?>">
    <button type="button" class="btn btn-primary rounded-pill"><span class="ion ion-md-add"></span>&nbsp;
    <?= lang('Main.xin_add_new');?>
    <?= lang('Dashboard.header_policy');?>
    </button>
    </a> 
    </div>
  <hr class="container-m-nx border-light my-0 d-none">
</div>
<?php } ?>
<div class="row mt-2">
  <div class="col-md-12">
    <div class="pc-wizard-subtitle-vertical card" id="detailswizard2">
      <div class="row">
        <div class="col-md-4">
          <ul class="nav flex-column card-body border-right nav-tabs view-policies-tabs">
            <?php $i=1;foreach($get_data as $r): ?>
            <li class="nav-item"><a href="#policy_<?= $r['policy_id'];?>" class="nav-link <?php if($i==1):?>active<?php else:?><?php endif;?>" data-toggle="tab"><i class="feather icon-check-square"></i><span>
              <h6>
                <?= $r['title'];?>
              </h6>
              </span></a></li>
            <?php $i++;endforeach;?>
          </ul>
        </div>
        <div class="col-md-8">
          <div class="card-body pb-0">
            <div class="tab-content">
              <?php $j=1;foreach($get_data as $r) { ?>
              <div class="tab-pane show <?php if($j==1):?>active<?php else:?><?php endif;?>" id="policy_<?php echo $r['policy_id'];?>">
                <h5 class="mt-3"><?php echo $r['title'];?></h5>
                <div><?php echo html_entity_decode($r['description']);?></div>
                <p class="mt-5"><?= '<a href="'.site_url().'download?type=policy&filename='.uencode($r['attachment']).'"><i class="fas fa-download"></i> '.lang('Main.xin_download_file').'</a>';?></p>
              </div>
              <?php $j++;} ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
