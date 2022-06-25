<?php
namespace App\Models;

use CodeIgniter\Model;

class StaffaccountsModel extends Model {
 
    protected $table = 'ci_employee_accounts';

    protected $primaryKey = 'account_id';
    
	// get all fields of table
    protected $allowedFields = ['account_id','company_id','account_name','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>