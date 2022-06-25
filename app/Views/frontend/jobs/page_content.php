<?php
use App\Models\MainModel;
use App\Models\UsersModel;
use App\Models\SystemModel;
use App\Models\CmspageModel;
use App\Models\ConstantsModel;
use App\Models\CountryModel;
use App\Models\MembershipModel;
use App\Models\CompanymembershipModel;

$MainModel = new MainModel();
$UsersModel = new UsersModel();
$SystemModel = new SystemModel();
$CmspageModel = new CmspageModel();
$ConstantsModel = new ConstantsModel();
$CountryModel = new CountryModel();
$MembershipModel = new MembershipModel();
$CompanymembershipModel = new CompanymembershipModel();

$company_types = $ConstantsModel->where('type','company_type')->orderBy('constants_id', 'ASC')->findAll();
$all_countries = $CountryModel->orderBy('country_id', 'ASC')->findAll();
$membership = $MembershipModel->orderBy('membership_id', 'ASC')->findAll();
$request = \Config\Services::request();
$segment_id = $request->uri->getSegment(2);
$page_id = udecode($segment_id);
$cms_page = $CmspageModel->where('page_id', $page_id)->first();
/* Company Details view
*/		
$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$xin_system = $SystemModel->where('setting_id', 1)->first();
?>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
	<div class="container">

		<div class="sixteen columns">
			<h2><?= $cms_page['page_name'];?></h2>
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="<?= site_url('jobs');?>">Home</a></li>
					<li><?= $cms_page['page_name'];?></li>
				</ul>
			</nav>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<!-- Container -->
<div class="container">
	<div class="margin-bottom-20">
	<?= html_entity_decode($cms_page['page_description']);?>
    </div>
</div>