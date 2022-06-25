<?php
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\ChatModel;
use App\Models\LanguageModel;
use App\Models\CompanysettingsModel;

$ChatModel = new ChatModel();
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
<header class="pc-header <?= $bg_option;?>">
    <div class="header-wrapper">
        <div class="m-header d-flex align-items-center">
				<a class="pc-head-link me-0" href="#" id="vertical-nav-toggle">
					<i class="material-icons-two-tone">vertical_split</i>
				</a>
			</div>
        <div class="mr-auto pc-mob-drp">
            <ul class="list-unstyled">
            	<?php if($user['user_type']== 'company'){ ?>
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="material-icons-two-tone" data-toggle="tooltip" data-placement="top" title="<?= lang('Membership.xin_my_subscription');?>">account_circle</i>
                    </a>
                    <div class="dropdown-menu pc-h-dropdown">
                        <a href="<?= site_url('erp/my-subscription');?>" class="dropdown-item">
                            <i class="material-icons-two-tone">card_membership</i>
                            <span><?= lang('Membership.xin_my_subscription');?></span>
                        </a>
                        <a href="<?= site_url('erp/my-payment-history');?>" class="dropdown-item">
                            <i class="material-icons-two-tone">payments</i>
                            <span><?= lang('Membership.xin_billing_invoices');?></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= site_url('erp/my-profile');?>" class="dropdown-item">
                            <i class="material-icons-two-tone">admin_panel_settings</i>
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
                    <a class="pc-head-link arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Dashboard.xin_my_account');?>" href="<?= site_url('erp/my-profile');?>">
                        <i class="material-icons-two-tone">account_circle</i>
                    </a>
                </li> 
                <?php } ?>
                <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==4):?>
                <li class="dropdown pc-h-item">
						<a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
							<i class="material-icons-two-tone" data-toggle="tooltip" data-placement="top" title="<?= lang('Inventory.xin_inventory_control');?>">add_shopping_cart</i>
						</a>
						<div class="dropdown-menu pc-h-dropdown">
							<a href="<?= site_url('erp/warehouse-list');?>" class="dropdown-item">
								<i class="material-icons-two-tone">account_balance</i>
								<span><?= lang('Inventory.xin_warehouses');?></span>
							</a>
							<div class="pc-level-menu">
								<a href="#!" class="dropdown-item">
                                    <i class="material-icons-two-tone">storefront</i>
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
								<i class="material-icons-two-tone">group</i>
								<span><?= lang('Inventory.xin_suppliers');?></span>
							</a>
                            <div class="pc-level-menu">
								<a href="#!" class="dropdown-item">
									<i class="material-icons-two-tone">shopping_cart</i>
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
									<i class="material-icons-two-tone">credit_card</i>
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
									<i class="material-icons-two-tone">request_quote</i>
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
                  <?php if($user['user_type']== 'staff' || $user['user_type'] == 'company'){ ?>
                <li class="pc-h-item">
                    <a class="pc-head-link arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_forms_builder');?>" href="<?= site_url('erp/forms-builder');?>">
                        <i class="material-icons-two-tone">ballot</i>
                    </a>
                </li> 
                <?php } ?>
                <?php if($user['user_type']== 'staff') {?>
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="material-icons-two-tone" title="<?= lang('Dashboard.xin_apps');?>">touch_app</i>
                    </a>
                    <div class="dropdown-menu pc-h-dropdown">
                        <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
						<?php if(isset($setup_modules['travel'])): if($setup_modules['travel']==1):?>
                        <?php if(in_array('travel1',staff_role_resource())) {?>
                        <a href="<?= site_url('erp/business-travel');?>" class="dropdown-item">
                            <i class="material-icons-two-tone">emoji_transportation</i>
                            <span><?= lang('Dashboard.left_travels');?></span>
                        </a>
                        <?php } ?>
                        <?php endif; endif;?>
                        <?php endif; endif;?>
                        <?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
                        <?php if(isset($setup_modules['events'])): if($setup_modules['events']==1):?>
                        <?php if(in_array('hr_event1',staff_role_resource()) || $user['user_type']== 'company') {?>
                        <a href="<?= site_url('erp/events-list');?>" class="dropdown-item">
                            <i class="material-icons-two-tone">event</i>
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
                        <?php /*?><?php if(isset($setup_modules['re_module'])): if($setup_modules['re_module']==1 || $setup_modules['re_module']==3 || $setup_modules['re_module']==4):?>
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
                        <?php endif; endif;?><?php */?>
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
                    </div>
                </li>
                <?php } ?>
                <?php if($user['user_type']== 'staff') {?>
                <li class="pc-h-item">
                    <a class="pc-head-link arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_polls');?>" href="<?= site_url('erp/polls-list');?>">
                        <i class="material-icons-two-tone">poll</i>
                    </a>
                </li>
                <li class="pc-h-item">
                    <a class="pc-head-link arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_hr_suggestions');?>" href="<?= site_url('erp/suggestions');?>">
                        <i class="material-icons-two-tone">playlist_add</i>
                    </a>
                </li>
                <?php } ?>
				<?php } if($user['user_type']== 'customer') {?>
                <li class="pc-h-item">
                    <a class="pc-head-link arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Dashboard.xin_acc_calendar');?>" href="<?= site_url('erp/my-invoices-calendar');?>">
                        <i class="material-icons-two-tone">event_note</i>
                    </a>
                </li>    
                <?php } if($user['user_type']== 'super_user') {?>
                <li class="pc-h-item">
                    <a class="pc-head-link arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Dashboard.xin_my_account');?>" href="<?= site_url('erp/my-profile');?>">
                        <i class="material-icons-two-tone">admin_panel_settings</i>
                    </a>
                </li>    
                <li class="pc-h-item">
                    <a class="pc-head-link arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_frontend_landing');?>" href="<?= site_url('');?>" target="_blank">
                        <i class="material-icons-two-tone">view_quilt</i>
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
                        <i class="material-icons-two-tone">language</i>
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
				if($user['user_type'] == 'staff'){		
					$multi_level_notifications = top_level_notifications_info();	
				?>
                <li class="dropdown pc-h-item pc-cart-menu">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="material-icons-two-tone">notifications_active</i>
                        <span class="badge bg-success pc-h-badge"><?= $multi_level_notifications['inotify_total'];?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pc-h-dropdown drp-cart" style="min-width: 30rem;">
                        <div class="cart-head">
                            <h5 class="mb-0">Notifications</h5>
                            <?php if($multi_level_notifications['inotify_total'] > 0):?>
                            <p class="mb-0"><a href="#!" data-user-id="<?= $usession['sup_user_id'];?>" class="mark-as-read float-end me-2 link-primary">Mark all as Read</a></p>
                            <?php endif;?>
                        </div>
                        <div <?php if($multi_level_notifications['inotify_total'] > 5):?> style="overflow:auto; height:380px;"<?php endif;?>>
                        <?php
							// complaints submission alert
                        	if($multi_level_notifications['itop_complaint_alert_cnt'] > 0){
								echo $multi_level_notifications['itop_complaint_alert_data'];
							}
							// complaints approval alert
                        	if($multi_level_notifications['complaint_approval_count'] > 0){
								echo $multi_level_notifications['complaint_approval_data'];
							}
							// complaints reject alert
                        	if($multi_level_notifications['complaint_reject_count'] > 0){
								echo $multi_level_notifications['complaint_reject_data'];
							}
							
							// leave submission alert
							if($multi_level_notifications['itop_leave_alert_cnt'] > 0){
								echo $multi_level_notifications['itop_leave_alert_data'];
							}
							// leave approval alert
							if($multi_level_notifications['leave_approval_count'] > 0){
								echo $multi_level_notifications['leave_approval_data'];
							}
							// leave reject alert
                        	if($multi_level_notifications['leave_reject_count'] > 0){
								echo $multi_level_notifications['leave_reject_data'];
							}
							
							// leave adjustment submission alert
							if($multi_level_notifications['itop_leave_adjust_alert_cnt'] > 0){
								echo $multi_level_notifications['itop_leave_adjust_alert_data'];
							}
							// leave adjustment approval alert
							if($multi_level_notifications['itop_leave_adjust_approval_alert_cnt'] > 0){
								echo $multi_level_notifications['itop_leave_adjust_approval_alert_data'];
							}
							// leave adjustment reject alert
                        	if($multi_level_notifications['leave_adjust_reject_count'] > 0){
								echo $multi_level_notifications['leave_adjust_reject_count'];
							}
							
							// travel submission alert
							if($multi_level_notifications['itop_travel_alert_cnt'] > 0){
								echo $multi_level_notifications['itop_travel_alert_data'];
							}
							// travel approval alert
							if($multi_level_notifications['travel_approval_count'] > 0){
								echo $multi_level_notifications['travel_approval_data'];
							}
							// travel reject alert
                        	if($multi_level_notifications['travel_reject_count'] > 0){
								echo $multi_level_notifications['travel_reject_data'];
							}
							
							// overtime submission alert
							if($multi_level_notifications['itop_overtime_alert_cnt'] > 0){
								echo $multi_level_notifications['itop_overtime_alert_data'];
							}
							// overtime approval alert
							if($multi_level_notifications['overtime_approval_count'] > 0){
								echo $multi_level_notifications['overtime_approval_data'];
							}
							// overtime reject alert
                        	if($multi_level_notifications['overtime_reject_count'] > 0){
								echo $multi_level_notifications['overtime_reject_data'];
							}
							
							// incident submission alert
							if($multi_level_notifications['itop_incident_alert_cnt'] > 0){
								echo $multi_level_notifications['itop_incident_alert_data'];
							}
							// incident approval alert
							if($multi_level_notifications['incident_approval_count'] > 0){
								echo $multi_level_notifications['incident_approval_data'];
							}
							// incident reject alert
                        	if($multi_level_notifications['incident_reject_count'] > 0){
								echo $multi_level_notifications['incident_reject_data'];
							}
							
							// transfer submission alert
							if($multi_level_notifications['itop_transfer_alert_cnt'] > 0){
								echo $multi_level_notifications['itop_transfer_alert_data'];
							}
							// transfer approval alert
							if($multi_level_notifications['transfer_approval_count'] > 0){
								echo $multi_level_notifications['transfer_approval_data'];
							}
							// transfer reject alert
                        	if($multi_level_notifications['transfer_reject_count'] > 0){
								echo $multi_level_notifications['transfer_reject_data'];
							}
							
							// resignation submission alert
							if($multi_level_notifications['itop_resignation_alert_cnt'] > 0){
								echo $multi_level_notifications['itop_resignation_alert_data'];
							}
							// resignation approval alert
							if($multi_level_notifications['resignation_approval_count'] > 0){
								echo $multi_level_notifications['resignation_approval_data'];
							}
							// resignation reject alert
                        	if($multi_level_notifications['resignation_reject_count'] > 0){
								echo $multi_level_notifications['resignation_reject_data'];
							}
							
							// attendance submission alert
							if($multi_level_notifications['attendance_submission_count'] > 0){
								echo $multi_level_notifications['attendance_submission_data'];
							}
							// attendance approval alert
							if($multi_level_notifications['attendance_approval_count'] > 0){
								echo $multi_level_notifications['attendance_approval_data'];
							}
							// attendance reject alert
                        	if($multi_level_notifications['attendance_reject_count'] > 0){
								echo $multi_level_notifications['attendance_reject_data'];
							}
						?>
                        </div>
                    </div>
                </li>
                <?php
				}
				if($user['user_type'] == 'company' || $user['user_type'] == 'staff'){ ?>
                <?php
					if($user['user_type'] == 'company'){
						$hcompany_id = $usession['sup_user_id'];
					} else {
						$hcompany_id = $user['company_id'];
					}
				?>
                <?php $hchat_msgs_count = $ChatModel->where('company_id', $hcompany_id)->where('to_id', $usession['sup_user_id'])->where('is_read',0)->countAllResults(); ?>
                <li class="pc-h-item">
                    <a class="pc-head-link arrow-none mr-0" data-toggle="tooltip" data-placement="top" title="<?= lang('Main.xin_chat_messenger');?>" href="<?= site_url('erp/messenger');?>">
                        <i class="material-icons-two-tone">chat</i>
                        <span class="badge bg-success pc-h-badge"><span class="header-chat-inotify"><?= $hchat_msgs_count;?></span></span>
                    </a>
                </li>
                <?php 
				}
				if($user['user_type'] == 'company'){
					$com_lang = $CompanysettingsModel->where('company_id', $usession['sup_user_id'])->first();
					$setup_languages = unserialize($com_lang['setup_languages']);
					$lang_count = count($setup_languages);
				} else {
					$cuser = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
					$com_lang = $CompanysettingsModel->where('company_id', $cuser['company_id'])->first();
					$setup_languages = unserialize($com_lang['setup_languages']);
					$lang_count = count($setup_languages);
				}
				?>
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="material-icons-two-tone">language</i>
                        <span class="badge bg-success pc-h-badge"><?= $lang_count;?></span>
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
                        <i class="material-icons-two-tone">library_add_check</i>
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
                            <i class="material-icons-two-tone">account_circle</i>
                            <span><?= lang('Dashboard.xin_my_account');?></span>
                        </a>
                        <a href="<?= site_url('erp/system-logout')?>" class="dropdown-item">
                            <i class="material-icons-two-tone">chrome_reader_mode</i>
                            <span><?= lang('Main.xin_logout');?></span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>