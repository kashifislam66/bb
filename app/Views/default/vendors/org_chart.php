<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\StaffdetailsModel;
//$encrypter = \Config\Services::encrypter();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$SystemModel = new SystemModel();
$DepartmentModel = new DepartmentModel();
$DesignationModel = new DesignationModel();
$StaffdetailsModel = new StaffdetailsModel();
$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$company_id = $user_info['company_id'];
} else {
	$company_id = $usession['sup_user_id'];
}
$xin_system = erp_company_settings();
$user_chart = $UsersModel->where('user_id', $company_id)->first();
$main_department = $DepartmentModel->where('company_id', $company_id)->where('department_head!=', 0)->findAll();
$get_animate = '';

$head_of_company = $StaffdetailsModel->where('company_id', $company_id)->where('reporting_manager', 0)->findAll();

?>
<link rel="stylesheet" href="<?= base_url();?>/public/assets/plugins/orgchart/css/jquery.orgchart.css">
<link rel="stylesheet" href="<?= base_url();?>/public/assets/plugins/orgchart/css/style.css">
  <script type="text/javascript" src="<?= base_url();?>/public/assets/plugins/orgchart/js/html2canvas.min.js"></script>
  <script type="text/javascript" src="<?= base_url();?>/public/assets/plugins/orgchart/js/jquery.orgchart.js"></script>
  <script type="text/javascript">
   $(function() {

    var datascource = //{
      //'profile': '<?= base_url();?>/public/uploads/users/thumb/<?= $user_chart['profile_photo'];?>',
	  //'name': '<?= $user_chart['first_name'].' '.$user_chart['last_name'];?>',
      //'title': '<?= $user_chart['company_name'];?>',
      //'children': [
	  <?php foreach($head_of_company as $hd_company){?>
	  <?php $ic_head = $UsersModel->where('company_id', $company_id)->where('user_id', $hd_company['user_id'])->first(); ?>
	  <?php if($ic_head){
		$hemployee_detail = $StaffdetailsModel->where('user_id', $ic_head['user_id'])->first();
		$hdepartment = $DepartmentModel->where('department_id',$hemployee_detail['department_id'])->first();
		if($hdepartment) {
			$hdepartment_name = $hdepartment['department_name'];
		} else {
			$hdepartment_name = '--';
		}
		?>
        {
			'profile': '<?= staff_profile_photo($ic_head['user_id']);?>',
			'name': '<?= $ic_head['first_name'].' '.$ic_head['last_name'];?>',
			'department': 'Company Head',
			'title': '<?= $hdepartment_name;?>',
			'children': [
				<?php $re_manager = $StaffdetailsModel->where('reporting_manager', $ic_head['user_id'])->where('not_part_of_orgchart', 0)->findAll();?>
				<?php foreach($re_manager as $rre_manager){?>
				<?php $ire_manager = $UsersModel->where('user_id', $rre_manager['user_id'])->first(); ?>
				<?php //$iuser_count = $UsersModel->where('user_id', $sdesign['user_id'])->countAllResults(); ?>
				<?php if($ire_manager){?>
				<?php
					$remployee_detail = $StaffdetailsModel->where('user_id', $ire_manager['user_id'])->first();
					$rdesignations = $DesignationModel->where('designation_id',$remployee_detail['designation_id'])->first(); ?>
				<?php
					if($rdesignations) {
						$rdesignation_name = $rdesignations['designation_name'];
					} else {
						$rdesignation_name = '--';
					}
					$idepartment = $DepartmentModel->where('department_id',$remployee_detail['department_id'])->first();
					if($idepartment) {
						$department_name = $idepartment['department_name'];
					} else {
						$department_name = '--';
					}
				?>
				{
					'profile': '<?= staff_profile_photo($ire_manager['user_id']);?>',
					'name': '<?= $ire_manager['first_name'].' '.$ire_manager['last_name'];?>',
					'title': '<?= $rdesignation_name;?>',
					'department': '<?= $department_name;?>',
					'children': [
						<?php $nstaff = $StaffdetailsModel->where('reporting_manager', $ire_manager['user_id'])->where('not_part_of_orgchart', 0)->findAll();?>
						<?php foreach($nstaff as $instaff){?>
						<?php $nistaff = $UsersModel->where('user_id', $instaff['user_id'])->first(); ?>
						<?php //$iuser_count = $UsersModel->where('user_id', $sdesign['user_id'])->countAllResults(); ?>
						<?php if($nistaff){?>
						<?php
						$nemployee_detail = $StaffdetailsModel->where('user_id', $nistaff['user_id'])->first();
						$ndesignations = $DesignationModel->where('designation_id',$nemployee_detail['designation_id'])->first(); ?>
						<?php
						if($ndesignations) {
							$ndesignation_name = $ndesignations['designation_name'];
						} else {
							$ndesignation_name = '--';
						}
						$ndepartment = $DepartmentModel->where('department_id',$nemployee_detail['department_id'])->first();
						if($ndepartment) {
							$ndepartment_name = $ndepartment['department_name'];
						} else {
							$ndepartment_name = '--';
						}
						?>
						{
							'profile': '<?= staff_profile_photo($nistaff['user_id']);?>',
							'name': '<?= $nistaff['first_name'].' '.$nistaff['last_name'];?>',
							'title': '<?= $ndesignation_name;?>',
							'department': '<?= $ndepartment_name;?>',
							'children': [
									<?php $lnstaff = $StaffdetailsModel->where('reporting_manager', $nistaff['user_id'])->where('not_part_of_orgchart', 0)->findAll();?>
									<?php foreach($lnstaff as $linstaff){?>
									<?php $lnistaff = $UsersModel->where('user_id', $linstaff['user_id'])->first(); ?>
									<?php //$iuser_count = $UsersModel->where('user_id', $sdesign['user_id'])->countAllResults(); ?>
									<?php if($lnistaff){?>
									<?php
									$nxemployee_detail = $StaffdetailsModel->where('user_id', $lnistaff['user_id'])->first();
									$nxdesignations = $DesignationModel->where('designation_id',$nxemployee_detail['designation_id'])->first(); ?>
									<?php
									if($nxdesignations) {
										$nxdesignation_name = $nxdesignations['designation_name'];
									} else {
										$nxdesignation_name = '--';
									}
									$nxdepartment = $DepartmentModel->where('department_id',$nxemployee_detail['department_id'])->first();
									if($nxdepartment) {
										$nxdepartment_name = $nxdepartment['department_name'];
									} else {
										$nxdepartment_name = '--';
									}
									?>
									{
										'profile': '<?= staff_profile_photo($lnistaff['user_id']);?>',
										'name': '<?= $lnistaff['first_name'].' '.$lnistaff['last_name'];?>',
										'title': '<?= $nxdesignation_name;?>',
										'department': '<?= $nxdepartment_name;?>',
										'children': [
											<?php $xlnstaff = $StaffdetailsModel->where('reporting_manager', $lnistaff['user_id'])->where('not_part_of_orgchart', 0)->findAll();?>
											<?php foreach($xlnstaff as $xlinstaff){?>
											<?php $xlnistaff = $UsersModel->where('user_id', $xlinstaff['user_id'])->first(); ?>
											<?php //$iuser_count = $UsersModel->where('user_id', $sdesign['user_id'])->countAllResults(); ?>
											<?php if($xlnistaff){?>
											<?php
											$nxxemployee_detail = $StaffdetailsModel->where('user_id', $xlnistaff['user_id'])->first();
											$nxxdesignations = $DesignationModel->where('designation_id',$nxxemployee_detail['designation_id'])->first(); ?>
											<?php
											if($nxxdesignations) {
												$nxxdesignation_name = $nxxdesignations['designation_name'];
											} else {
												$nxxdesignation_name = '--';
											}
											$nxxdepartment = $DepartmentModel->where('department_id',$nxxemployee_detail['department_id'])->first();
											if($nxxdepartment) {
												$nxxdepartment_name = $nxxdepartment['department_name'];
											} else {
												$nxxdepartment_name = '--';
											}
											?>
											{
												'profile': '<?= staff_profile_photo($xlnistaff['user_id']);?>',
												'name': '<?= $xlnistaff['first_name'].' '.$xlnistaff['last_name'];?>',
												'title': '<?= $nxxdesignation_name;?>',
												'department': '<?= $nxxdepartment_name;?>',
											},
											<?php } ?>
											<?php }?>
										  ],
									},
									<?php } ?>
									<?php }?>
								  ],
						},
						<?php } ?>
						<?php }?>
					  ],
				},
				<?php } ?>
				<?php }?>
			  ],
        };
		<?php } ?>
		<?php } ?>
     // ],
	  
    //};

    var nodeTemplate = function(data) {
      return `
        <div class="title">${data.name}</div>
		<div class="department">${data.department}</div>
        <div class="content">${data.title}</div>
      `;
    }
	$('#togglePan').on('click', function() {
      // of course, oc.setOptions({ 'pan': this.checked }); is also OK.
      oc.setOptions('pan', this.checked);
    });
    
    $('#toggleZoom').on('click', function() {
      // of course, oc.setOptions({ 'zoom': this.checked }); is also OK.
      oc.setOptions('zoom', this.checked);
    });
	var oc = $('#chart-container').orgchart({
      'data' : datascource,
	  'nodeTemplate': nodeTemplate,
	  'nodeID': 'profile',
	  'nodeTitle': 'name',
      'nodeContent': 'title',
	  'nodeOffice': 'office',
      'pan': true,
	  'visibleLevel': 5,
	  'exportButton': true,
	  'exportFilename': '<?= $user_chart['company_name'];?>_<?=lang('Dashboard.xin_org_chart_title');?>',
      'zoom': true,
	  'zoominLimit': 7,
	  'direction': 't2b',
	  'createNode': function($node, data) {
        var nodePrompt = $('<i>', {
          'class': '',
          click: function() {
            $(this).siblings('.second-menu').toggle();
          }
        });
        var secondMenu = '<div class="second-menu"><img class="avatar" src="' + data.profile + '"></div>';
        $node.append(nodePrompt).append(secondMenu);
      }
    });

    oc.$chartContainer.on('touchmove', function(event) {
      event.preventDefault();
    });

  });
  </script>
  <style type="text/css">
	.orgchart .node .content {
		box-sizing: border-box;
		width: 100%;
		height: 20px;
		font-size: 11px;
		line-height: 18px;
		border: 1px solid #7267EF;
		
		text-align: center;
		background-color: #fff;
		color: #333;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	.orgchart .node .department {
		box-sizing: border-box;
		width: 100%;
		height: 20px;
		font-size: 11px;
		line-height: 18px;
		border: 1px solid #7267EF;
		border-bottom: 0px;
		text-align: center;
		background-color: #fff;
		color: #333;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	.orgchart .node .title {
		text-align: center;
		font-size: 12px;
		font-weight: 700;
		height: 20px;
		line-height: 20px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		background-color: #7267EF;
		color: #fff;
		border-radius: 4px 4px 0 0;
	}
	.orgchart .lines .downLine {
	  background-color: #7267EF;
	  margin: 0 auto;
	  height: 20px;
	  width: 2px;
	  float: none;
	}
	.orgchart .lines .rightLine {
	  border-right: 1px solid #7267EF;
	  float: none;
	  border-radius: 0;
	}
	.orgchart .lines .topLine {
	  border-top: 2px solid #7267EF;
	}
	.orgchart .lines .leftLine {
	  border-left: 1px solid #7267EF;
	  float: none;
	  border-radius: 0;
	}
	.orgchart .node .title .symbol {
	  float: left;
	  margin-top: 4px;
	  margin-left: 5px;
	}
	.orgchart {
	  background-image: none !important;
	}
  </style>
  <?php if($xin_system['hide_org_name']==0):?>
  <style type="text/css">
  .orgchart .node .title {display:none !important; }
  </style>
  <?php endif;?>
  <?php if($xin_system['hide_org_photo']==0):?>
  <style type="text/css">
  .orgchart .node .second-menu {display:none !important; }
  </style>
  <?php endif;?>
