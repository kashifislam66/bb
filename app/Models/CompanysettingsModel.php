<?php
namespace App\Models;

use CodeIgniter\Model;
	
class CompanysettingsModel extends Model {
 
    protected $table = 'ci_erp_company_settings';

    protected $primaryKey = 'setting_id';
    
	// get all fields of company settings table
    protected $allowedFields = ['setting_id','company_id','default_currency','default_currency_symbol','notification_position','notification_close_btn','notification_bar','date_format_xi','default_language','system_timezone','enable_ip_address','ip_address','paypal_email','paypal_sandbox','paypal_active','stripe_secret_key','stripe_publishable_key','stripe_active','invoice_terms_condition','setup_modules','setup_languages','is_enable_ml_payroll','bank_account','vat_number','hrm_staff_dashboard','is_lunch_break','hide_org_name','hide_org_photo','updated_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>