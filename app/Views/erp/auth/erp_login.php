<?php
use App\Models\SystemModel;
$SystemModel = new SystemModel();
$xin_system = $SystemModel->where('setting_id', 1)->first();
$favicon = base_url().'/public/uploads/logo/favicon/'.$xin_system['favicon'];
$session = \Config\Services::session();
$request = \Config\Services::request();
$username = $session->get('sup_username');
?>
<?php
if($xin_system['login_page']==1){
	echo view('erp/auth/erp_login_page1'); //login page load
} else if($xin_system['login_page']==2){
	echo view('erp/auth/erp_login_page2'); //login page load
} else if($xin_system['login_page']==3){
	echo view('erp/auth/erp_login_page3'); //login page load
} else {
	echo view('erp/auth/erp_login_page1'); //login page load
}
?>