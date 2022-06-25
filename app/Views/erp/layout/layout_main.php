<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\ConstantsModel;

$SystemModel = new SystemModel();
$UserRolesModel = new RolesModel();
$UsersModel = new UsersModel();
$ConstantsModel = new ConstantsModel();

$xin_system = $SystemModel->where('setting_id', 1)->first();
$role_user = $UserRolesModel->where('role_id', 1)->first();

$session = \Config\Services::session();
$router = service('router');

$username = $session->get('sup_username');
$user_id = $username['sup_user_id'];
$user_info = $UsersModel->where('user_id', $user_id)->first();

if($xin_system['template_option']==0){
	echo view('erp/layout/layout_main_company');
} else if($xin_system['template_option']==1){
	echo view('erp/layout/layout_main_company_2');
} else {
	echo view('erp/layout/layout_main_company');
}
if($xin_system['template_option']==1){
?>
<style type="text/css">
.pc-header-new {
	background: transparent !important;
	right: 120px !important;
	position:absolute !important;
}
.pc-container .page-header + .pcoded-content {
    padding-top: calc(-20px + 40px) !important;
}
.minimenu .pc-header {
    left: 200px !important;
}
.minimenu .pc-container {
    margin-left: 330px !important;
	
	right:120px !important;
}
.minimenu .page-header {
    left: 200px !important;
}
.page-header {
    background: 0 !important;
    box-shadow: 0 0px 0px 0 rgb(69 90 100 / 8%) !important;
	right: 120px !important;
	position: static !important;
}
.card {
	border-radius: 16px !important;
}
.feed-card .card-body .border-feed {
	border-top-left-radius: 16px !important;
    border-bottom-left-radius: 16px !important;
}

@media(max-width: 767px) {

.pc-header-new {

    right: 0px !important; 

}
.pc-container .page-header + .pcoded-content {
    padding-top: 5px !important;
}

}


</style>
<?php } ?>