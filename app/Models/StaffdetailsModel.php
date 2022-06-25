<?php
namespace App\Models;

use CodeIgniter\Model;

class StaffdetailsModel extends Model {
 
    protected $table = 'ci_erp_users_details';

    protected $primaryKey = 'staff_details_id';
    
	// get all fields of employees details table
    protected $allowedFields = ['staff_details_id','company_id','user_id','employee_id','reporting_manager','department_id','designation_id','office_shift_id','basic_salary','hourly_rate','salay_type','role_description','date_of_joining','contract_end','date_of_leaving','date_of_birth','marital_status','religion_id','blood_group','citizenship_id','bio','experience','fb_profile','twitter_profile','gplus_profile','linkedin_profile','account_title','account_number','bank_name','iban','swift_code','bank_branch','contact_full_name','contact_phone_no','contact_email','contact_address','ml_tax_category','ml_empployee_epf_rate','ml_empployer_epf_rate','ml_eis_contribution','ml_socso_category','ml_pcb_socso','ml_hrdf','ml_tax_citizenship','zakat_fund','job_type','assigned_hours','leave_options','approval_level01','approval_level02','approval_level03','not_part_of_orgchart','not_part_of_system_reports','is_accrual_pause','pause_start_date','pause_start_end','default_language','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>