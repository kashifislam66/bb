<?php
namespace App\Models;

use CodeIgniter\Model;
	
class StaffapprovalsModel extends Model {
 
    protected $table = 'ci_erp_notifications_approval';

    protected $primaryKey = 'staff_approval_id';
    
	// get all fields of table
    protected $allowedFields = ['staff_approval_id','company_id','staff_id','module_option','module_key_id','status','approval_level','updated_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>