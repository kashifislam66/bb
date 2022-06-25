<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\LanguageModel;
use App\Models\CompanysettingsModel;

$UsersModel = new UsersModel();
$SystemModel = new SystemModel();
$UserRolesModel = new RolesModel();
$LanguageModel = new LanguageModel();
$CompanysettingsModel = new CompanysettingsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();
$router = service('router');
$user = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
$locale = service('request')->getLocale();
$language = $LanguageModel->where('is_active', 1)->orderBy('language_id', 'ASC')->findAll();
if($user['user_type'] == 'super_user'){
	$xin_system = $SystemModel->where('setting_id', 1)->first();
} else {
	$xin_system = erp_company_settings();
}
$ci_erp_settings = $SystemModel->where('setting_id', 1)->first();
?>
<?php
$session_lang = $session->lang;
if(!empty($session_lang)):
	$lang_code = $LanguageModel->where('language_code', $session_lang)->first();
	$flg_icn = '<img src="'.base_url().'/public/uploads/languages_flag/'.$lang_code['language_flag'].'">';
	$lg_code = $session_lang;
elseif($xin_system['default_language']!=''):
	$lg_code = $xin_system['default_language'];
	$lang_code = $LanguageModel->where('language_code', $xin_system['default_language'])->first();
	$flg_icn = '<img src="'.base_url().'/public/uploads/languages_flag/'.$lang_code['language_flag'].'">';
else:
	$flg_icn = '<img src="'.base_url().'/public/uploads/languages_flag/gb.gif">';	
endif;
if($user['user_type'] == 'super_user'){
	$bg_option = $ci_erp_settings['header_background'];
} else if($user['user_type'] == 'company'){
	$bg_option = $ci_erp_settings['header_background'];
} else if($user['user_type'] == 'customer'){
	$bg_option = $ci_erp_settings['header_background'];
} else if($user['user_type'] == 'staff'){
	$bg_option = $ci_erp_settings['header_background'];
} else {
	$bg_option = 'bg-success';
}
?>
<header class="pc-header pc-header-new">
    <div class="header-wrapper">
        <div class="mr-auto pc-mob-drp">
            <ul class="list-unstyled">
                <?php if($user['user_type']== 'company'){ ?>
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none mr-0 active" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i data-feather="user" data-toggle="tooltip" data-placement="top" title="<?= lang('Membership.xin_my_subscription');?>"></i>
                    </a>
                    <div class="dropdown-menu pc-h-dropdown">
                        <a href="<?= site_url('erp/my-subscription');?>" class="dropdown-item">
                            <i data-feather="file-text"></i>
                            <span><?= lang('Membership.xin_my_subscription');?></span>
                        </a>
                        <a href="<?= site_url('erp/my-payment-history');?>" class="dropdown-item">
                            <i data-feather="credit-card"></i>
                            <span><?= lang('Membership.xin_billing_invoices');?></span>
                        </a>
                        <a target="_blank" href="<?= site_url('contact');?>" class="dropdown-item">
                            <i data-feather="life-buoy"></i>
                            <span><?= lang('Dashboard.dashboard_contact_support');?></span>
                        </a>
                        <?php /*?><a href="<?= site_url('erp/tickets-list');?>" class="dropdown-item">
                            <i data-feather="help-circle"></i>
                            <span><?= lang('Users.xin_company_support_tickets');?></span>
                        </a> <?php */?>
                        <a href="<?= site_url('erp/my-profile');?>" class="dropdown-item">
                            <i data-feather="user-plus"></i>
                            <span><?= lang('Main.xin_account_settings');?></span>
                        </a>
                    </div>
                </li>
                <?php } ?>
                <?php if($user['user_type']!= 'customer' && $user['user_type']!= 'super_user'){ ?>
                <?php
					if($user['user_type'] == 'company'){
						$xin_com_system = $CompanysettingsModel->where('company_id', $usession['sup_user_id'])->first();
					} else {
						$m_user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
						$xin_com_system = $CompanysettingsModel->where('company_id', $m_user_info['company_id'])->first();
					}
					$setup_modules = unserialize($xin_com_system['setup_modules']);
				?>
                <?php if($user['user_type']== 'staff'){ ?>
                <li class="pc-h-item">
                    <a class="pc-head-link arrow-none mr-0 active" data-toggle="tooltip" data-placement="top" title="<?= lang('Dashboard.xin_my_account');?>" href="<?= site_url('erp/my-profile');?>">
                        <i data-feather="user"></i>
                    </a>
                </li> 
                <?php } ?>
                <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==4):?>
                <li class="dropdown pc-h-item">
						<a class="pc-head-link dropdown-toggle arrow-none mr-0 active" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
							<i data-feather="shopping-cart" data-toggle="tooltip" data-placement="top" title="<?= lang('Inventory.xin_inventory_control');?>"></i>
						</a>
						<div class="dropdown-menu pc-h-dropdown">
							<a href="<?= site_url('erp/warehouse-list');?>" class="dropdown-item">
								<i data-feather="grid"></i>
								<span><?= lang('Inventory.xin_warehouses');?></span>
							</a>
							<div class="pc-level-menu">
								<a href="#!" class="dropdown-item">
									<i data-feather="menu"></i>
									<span class="float-right"><i data-feather="chevron-right" class="mr-0"></i></span>
									<span><?= lang('Inventory.xin_products');?></span>
								</a>
								<div class="dropdown-menu pc-h-dropdown">
									<a class="dropdown-item" href="<?= site_url('erp/product-list');?>">
                                    	<i class="fas fa-circle"></i> 
                                        <span><?= lang('Inventory.xin_products');?></span>
                                     </a>
                                    <a class="dropdown-item" href="<?= site_url('erp/out-of-stock-products');?>">
                                    	<i class="fas fa-circle"></i> 
                                        <span><?= lang('Inventory.xin_out_of_stock');?></span>
                                    </a>
                                    <a class="dropdown-item" href="<?= site_url('erp/expired-products');?>">
                                    	<i class="fas fa-circle"></i> 
                                        <span><?= lang('Inventory.xin_expired_products');?></span>
                                    </a>
                                    <a class="dropdown-item" href="<?= site_url('erp/tax-type');?>">
                                    	<i class="fas fa-circle"></i> 
                                        <span><?= lang('Inventory.xin_product_tax');?></span>
                                    </a>
                                    <a class="dropdown-item" href="<?= site_url('erp/products-category');?>">
                                    	<i class="fas fa-circle"></i> 
                                        <span><?= lang('Inventory.xin_product_category');?></span>
                                    </a>
								</div>
							</div>
							<a href="<?= site_url('erp/suppliers-list');?>" class="dropdown-item">
								<i data-feather="users"></i>
								<span><?= lang('Inventory.xin_suppliers');?></span>
							</a>
                            <div class="pc-level-menu">
								<a href="#!" class="dropdown-item">
									<i data-feather="shopping-cart"></i>
									<span class="float-right"><i data-feather="chevron-right" class="mr-0"></i></span>
									<span><?= lang('Inventory.xin_purchases');?></span>
								</a>
								<div class="dropdown-menu pc-h-dropdown">
									<a class="dropdown-item" href="<?= site_url('erp/create-purchase');?>">
                                    	<i class="fas fa-circle"></i> 
                                        <span><?= lang('Inventory.xin_new_purchase');?></span>
                                     </a>
                                    <a class="dropdown-item" href="<?= site_url('erp/stock-purchases');?>">
                                    	<i class="fas fa-circle"></i> 
                                        <span><?= lang('Inventory.xin_purchase_list');?></span>
                                    </a>
								</div>
							</div>
							<div class="pc-level-menu">
								<a href="#!" class="dropdown-item">
									<i data-feather="credit-card"></i>
									<span class="float-right"><i data-feather="chevron-right" class="mr-0"></i></span>
									<span><?= lang('Inventory.xin_sales_order');?></span>
								</a>
								<div class="dropdown-menu pc-h-dropdown">
									<a class="dropdown-item" href="<?= site_url('erp/stock-orders');?>">
										<i class="fas fa-circle"></i> 
										<span><?= lang('Inventory.xin_sales_manage');?></span>
                                    </a>
                                    <a class="dropdown-item" href="<?= site_url('erp/create-order');?>">
										<i class="fas fa-circle"></i> 
										<span><?= lang('Inventory.xin_add_new_order');?></span>
                                    </a>
                                    <a class="dropdown-item" href="<?= site_url('erp/paid-orders');?>">
										<i class="fas fa-circle"></i> 
										<span><?= lang('Inventory.xin_paid_orders');?></span>
                                    </a>
                                    <a class="dropdown-item" href="<?= site_url('erp/unpaid-orders');?>">
										<i class="fas fa-circle"></i> 
										<span><?= lang('Inventory.xin_unpaid_orders');?></span>
                                    </a>
                                    <a class="dropdown-item" href="<?= site_url('erp/packed-orders');?>">
										<i class="fas fa-circle"></i> 
										<span><?= lang('Inventory.xin_packed_orders');?></span>
                                    </a>
                                    <a class="dropdown-item" href="<?= site_url('erp/delivered-orders');?>">
										<i class="fas fa-circle"></i> 
										<span><?= lang('Inventory.xin_delivered_orders');?></span>
                                   	</a>
                                    <a class="dropdown-item" href="<?= site_url('erp/cancelled-orders');?>">
										<i class="fas fa-circle"></i> 
										<span><?= lang('Inventory.xin_cancelled_orders');?></span>
                                    </a>
                                    
								</div>
							</div>
							<div class="pc-level-menu">
								<a href="#!" class="dropdown-item">
									<i data-feather="file-text"></i>
									<span class="float-right"><i data-feather="chevron-right" class="mr-0"></i></span>
									<span><?= lang('Inventory.xin_quote_orders');?></span>
								</a>
								<div class="dropdown-menu pc-h-dropdown">
									<a class="dropdown-item" href="<?= site_url('erp/order-quotes');?>">
										<i class="fas fa-circle"></i> 
										<span><?= lang('Inventory.xin_quote_orders');?></span>
                                   	</a>
                                    <a class="dropdown-item" href="<?= site_url('erp/create-quote');?>">
										<i class="fas fa-circle"></i> 
										<span><?= lang('Inventory.xin_add_quote_order');?></span>
                                    </a>
								</div>
							</div>
						</div>
					</li>
                  <?php endif; endif;?>
                <?php if($user['user_type']== 'staff') {?>
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none mr-0 active" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <?= lang('Dashboard.xin_apps');?>
                    </a>
                    <div class="dropdown-menu pc-h-dropdown">
                    	<?php /*?><a href="<?= site_url('erp/tickets-list');?>" class="dropdown-item">
                            <i data-feather="help-circle"></i>
                            <span><?= lang('Users.xin_company_support_tickets');?></span>
                        </a> <?php */?>
						<?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
                    	<?php if(isset($setup_modules['travel'])): if($setup_modules['travel']==1):?>
                        <?php if(in_array('travel1',staff_role_resource())) {?>
                        <a href="<?= site_url('erp/business-travel');?>" class="dropdown-item">
                            <i data-feather="globe"></i>
                            <span><?= lang('Dashboard.left_travels');?></span>
                        </a>
                        <?php } ?>
                        <?php endif; endif;?>
                        <?php endif; endif;?>
                        <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
                        <?php if(isset($setup_modules['events'])): if($setup_modules['events']==1):?>
                        <?php if(in_array('hr_event1',staff_role_resource()) || $user['user_type']== 'company') {?>
                        <a href="<?= site_url('erp/events-list');?>" class="dropdown-item">
                            <i data-feather="disc"></i>
                            <span><?= lang('Dashboard.xin_hr_events');?></span>
                        </a>
                        <?php } ?>
                        <?php endif; endif;?>
                        <?php endif; endif;?>
                        <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
                        <?php if(isset($setup_modules['holidays'])): if($setup_modules['holidays']==1):?>
						<?php if(in_array('holiday1',staff_role_resource())) {?>
                        <a href="<?= site_url('erp/holidays-list');?>" class="dropdown-item">
                            <i data-feather="sun"></i>
                            <span><?= lang('Dashboard.left_holidays');?></span>
                        </a>
                        <?php } ?>
                        <?php endif; endif;?>
                        <?php endif; endif;?>
                        <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
                        <?php if(isset($setup_modules['visitor_book'])): if($setup_modules['visitor_book']==1):?>
						<?php if(in_array('visitor1',staff_role_resource()) || $user['user_type']== 'company') {?>
                        <a href="<?= site_url('erp/visitors-list');?>" class="dropdown-item">
                            <i data-feather="user-plus"></i>
                            <span><?= lang('Main.xin_visitor_book');?></span>
                        </a>
                        <?php } ?>
                        <?php endif; endif;?>
                        <?php endif; endif;?>
                        <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
                        <?php if(isset($setup_modules['events'])): if($setup_modules['events']==1):?>
                        <?php if(in_array('conference1',staff_role_resource()) || $user['user_type']== 'company') {?>
                        <a href="<?= site_url('erp/meeting-list');?>" class="dropdown-item">
                            <i data-feather="calendar"></i>
                            <span><?= lang('Dashboard.xin_hr_meetings');?></span>
                        </a>
                        <?php } ?>
                        <?php endif; endif;?>
                        <?php endif; endif;?>
                        <?php //if(isset($setup_modules['fmanager'])): if($setup_modules['fmanager']==1):?>
						<?php if(in_array('disciplinary1',staff_role_resource())) {?>
                        <a href="<?= site_url('erp/disciplinary-cases');?>" class="dropdown-item">
                            <i data-feather="alert-circle"></i>
                            <span><?= lang('Dashboard.left_warnings');?></span>
                        </a>
                        <?php } ?>
                        <?php //endif; endif;?>
                        <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
                        <?php if(isset($setup_modules['asset'])): if($setup_modules['asset']==1):?>
						<?php if(in_array('asset1',staff_role_resource())) {?>
                        <a href="<?= site_url('erp/assets-list');?>" class="dropdown-item">
                            <i data-feather="command"></i>
                            <span><?= lang('Dashboard.xin_assets');?></span>
                        </a>
                        <?php } ?>
                        <?php endif; endif;?>
                        <?php endif; endif;?>
                        <?php if(in_array('incident1',staff_role_resource())) {?>
                        <a href="<?= site_url('erp/incidents-list');?>" class="dropdown-item">
                            <i data-feather="clipboard"></i>
                            <span><?= lang('Main.xin_incidents');?></span>
                        </a>
                        <?php } ?>
                        <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
                        <?php if(isset($setup_modules['award'])): if($setup_modules['award']==1):?>
						<?php if(in_array('award1',staff_role_resource())) {?>
                        <a href="<?= site_url('erp/awards-list');?>" class="dropdown-item">
                            <i data-feather="award"></i>
                            <span><?= lang('Dashboard.left_awards');?></span>
                        </a>
                        <?php } ?>
                        <?php endif; endif;?>
                        <?php endif; endif;?>
                        <?php if(in_array('transfers1',staff_role_resource())) {?>
                        <a href="<?= site_url('erp/transfers-list');?>" class="dropdown-item">
                            <i data-feather="minimize-2"></i>
                            <span><?= lang('Dashboard.left_transfers');?></span>
                        </a>
                        <?php } ?>
						<?php if(in_array('complaint1',staff_role_resource())) {?>
                        <a href="<?= site_url('erp/complaints-list');?>" class="dropdown-item">
                            <i data-feather="edit"></i>
                            <span><?= lang('Dashboard.left_complaints');?></span>
                        </a>
                        <?php } ?>
						<?php if(in_array('resignation1',staff_role_resource())) {?>
                        <a href="<?= site_url('erp/resignation-list');?>" class="dropdown-item">
                            <i data-feather="user-minus"></i>
                            <span><?= lang('Dashboard.left_resignations');?></span>
                        </a>
                       <?php } ?> 
                       <?php /*?><?php if(isset($setup_modules['finance'])):?>
                       <a href="<?= site_url('erp/support-tickets');?>" class="dropdown-item">
                            <i data-feather="help-circle"></i>
                            <span><?= lang('Dashboard.dashboard_helpdesk');?></span>
                        </a>
                        <?php endif;?><?php */?>
                        <?php if($user['user_type']== 'company'):?>
                       <a href="<?= site_url('erp/staff-import');?>" class="dropdown-item">
                            <i data-feather="upload"></i>
                            <span><?= lang('Main.xin_hr_import');?></span>
                        </a>
                        <?php endif;?>
                       <?php if(in_array('system_reports',staff_role_resource()) || $user['user_type']== 'company'):?>
                       <a href="<?= site_url('erp/system-reports');?>" class="dropdown-item">
                            <i data-feather="bar-chart"></i>
                            <span><?= lang('Dashboard.xin_system_reports');?></span>
                        </a>
                        <?php endif;?>
                        <?php if(in_array('system_calendar',staff_role_resource()) || $user['user_type']== 'company'):?>
                       <a href="<?= site_url('erp/system-calendar');?>" class="dropdown-item">
                            <i data-feather="calendar"></i>
                            <span><?= lang('Dashboard.xin_system_calendar');?></span>
                        </a>
                        <?php endif;?>
                    </div>
                </li>
                <?php } ?>
                <?php if($user['user_type']== 'company') {?>
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none mr-0 active" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <?= lang('Dashboard.xin_apps');?>
                    </a>
                    <div class="dropdown-menu pc-h-dropdown">
                    	
                        <a href="<?= site_url('erp/tickets-list');?>" class="dropdown-item">
                            <i data-feather="help-circle"></i>
                            <span><?= lang('Users.xin_company_support_tickets');?></span>
                        </a> 
						<?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
						<?php if(isset($setup_modules['events'])): if($setup_modules['events']==1):?>
                        <?php if(in_array('hr_event1',staff_role_resource()) || $user['user_type']== 'company') {?>
                        <a href="<?= site_url('erp/events-list');?>" class="dropdown-item">
                            <i data-feather="disc"></i>
                            <span><?= lang('Dashboard.xin_hr_events');?></span>
                        </a>
                        <?php } ?>
                        <?php endif; endif;?>
                        <?php endif; endif;?>
                        <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
                        <?php if(isset($setup_modules['visitor_book'])): if($setup_modules['visitor_book']==1):?>
						<?php if(in_array('visitor1',staff_role_resource()) || $user['user_type']== 'company') {?>
                        <a href="<?= site_url('erp/visitors-list');?>" class="dropdown-item">
                            <i data-feather="user-plus"></i>
                            <span><?= lang('Main.xin_visitor_book');?></span>
                        </a>
                        <?php } ?>
                        <?php endif; endif;?>
                        <?php endif; endif;?>
                        <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
                        <?php if(isset($setup_modules['events'])): if($setup_modules['events']==1):?>
                        <?php if(in_array('conference1',staff_role_resource()) || $user['user_type']== 'company') {?>
                        <a href="<?= site_url('erp/meeting-list');?>" class="dropdown-item">
                            <i data-feather="calendar"></i>
                            <span><?= lang('Dashboard.xin_hr_meetings');?></span>
                        </a>
                        <?php } ?>
                        <?php endif; endif;?>
                        <?php endif; endif;?>
                       <?php /*?><?php if(isset($setup_modules['finance'])):?>
                       <a href="<?= site_url('erp/support-tickets');?>" class="dropdown-item">
                            <i data-feather="help-circle"></i>
                            <span><?= lang('Dashboard.dashboard_helpdesk');?></span>
                        </a>
                        <?php endif;?><?php */?>
                        <?php if($user['user_type']== 'company'):?>
                       <a href="<?= site_url('erp/staff-import');?>" class="dropdown-item">
                            <i data-feather="upload"></i>
                            <span><?= lang('Main.xin_hr_import');?></span>
                        </a>
                        <?php endif;?>
                       <?php if(in_array('system_reports',staff_role_resource()) || $user['user_type']== 'company'):?>
                       <a href="<?= site_url('erp/system-reports');?>" class="dropdown-item">
                            <i data-feather="bar-chart"></i>
                            <span><?= lang('Dashboard.xin_system_reports');?></span>
                        </a>
                        <?php endif;?>
                        <?php if(in_array('system_calendar',staff_role_resource()) || $user['user_type']== 'company'):?>
                       <a href="<?= site_url('erp/system-calendar');?>" class="dropdown-item">
                            <i data-feather="calendar"></i>
                            <span><?= lang('Dashboard.xin_system_calendar');?></span>
                        </a>
                        <?php endif;?>
                    </div>
                </li>
                <?php } ?>
                <?php if($user['user_type']== 'staff') {?>
                <li class="pc-h-item">
                    <a class="pc-head-link arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_polls');?>" href="<?= site_url('erp/polls-list');?>">
                        <i data-feather="pie-chart"></i>
                    </a>
                </li>
                <?php } ?>
				<?php } if($user['user_type']== 'customer') {?>
                <li class="pc-h-item">
                    <a class="pc-head-link arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Dashboard.xin_acc_calendar');?>" href="<?= site_url('erp/my-invoices-calendar');?>">
                        <i data-feather="calendar"></i>
                    </a>
                </li>    
                <?php } if($user['user_type']== 'super_user') {?>
                <li class="pc-h-item">
                    <a class="pc-head-link arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Dashboard.xin_my_account');?>" href="<?= site_url('erp/my-profile');?>">
                        <i data-feather="user"></i>
                    </a>
                </li>    
                <li class="pc-h-item">
                    <a class="pc-head-link arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_frontend_landing');?>" href="<?= site_url('');?>" target="_blank">
                        <i data-feather="layout"></i>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="ms-auto">
            <ul class="list-unstyled">
                <?php if($user['user_type']== 'super_user') {?>
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fas fa-globe"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pc-h-dropdown">
                        <?php foreach($language as $lang):?>
                        <a href="<?= site_url('erp/set-language/');?><?= $lang['language_code'];?>" class="dropdown-item">
                            <img src="<?= base_url();?>/public/uploads/languages_flag/<?= $lang['language_flag'];?>" width="16" height="11" />
                            <span><?= $lang['language_name'];?></span>
                        </a>
                        <?php endforeach;?>
                    </div>
                </li>
                <?php } else {?>
                <?php
				if($user['user_type'] == 'company'){
					$com_lang = $CompanysettingsModel->where('company_id', $usession['sup_user_id'])->first();
					$setup_languages = unserialize($com_lang['setup_languages']);
				} else {
					$cuser = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
					$com_lang = $CompanysettingsModel->where('company_id', $cuser['company_id'])->first();
					$setup_languages = unserialize($com_lang['setup_languages']);
				}
				?>
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fas fa-globe"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pc-h-dropdown">
                        <?php foreach($setup_languages as $lang):?>
                        <?php $lang_code = $LanguageModel->where('language_code', $lang)->first(); ?>
                        <a href="<?= site_url('erp/set-language/');?><?= $lang;?>" class="dropdown-item">
                            <img src="<?= base_url();?>/public/uploads/languages_flag/<?= $lang_code['language_flag'];?>" width="16" height="11" />
                            <span><?= $lang_code['language_name'];?></span>
                        </a>
                        <?php endforeach;?>
                    </div>
                </li>
                <?php } ?>
                <?php if(in_array('todo_ist',staff_role_resource()) || $user['user_type']== 'company' || $user['user_type']== 'customer' || $user['user_type']== 'super_user') {?>
                <li class="pc-h-item">
                    <a class="pc-head-link mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_todo_ist');?>" href="<?= site_url('erp/todo-list');?>">
                        <i data-feather="check-circle"></i>
                        <span class="sr-only"></span>
                    </a>
                </li>
                <?php }?>
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="<?= staff_profile_photo($user['user_id']);?>" alt="" class="user-avtar">
                        <span>
                            <span class="user-name"><?= $user['first_name'].' '.$user['last_name'];?></span>
                            <span class="user-desc"><?= $user['username']?></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pc-h-dropdown">
                        <div class=" dropdown-header">
                            <h6 class="text-overflow m-0"><?= lang('Dashboard.xin_welcome');?></h6>
                        </div>
                        <a href="<?= site_url('erp/my-profile');?>" class="dropdown-item">
                            <i data-feather="user"></i>
                            <span><?= lang('Dashboard.xin_my_account');?></span>
                        </a>
                        <a href="<?= site_url('erp/system-logout')?>" class="dropdown-item">
                            <i data-feather="power"></i>
                            <span><?= lang('Main.xin_logout');?></span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</header>