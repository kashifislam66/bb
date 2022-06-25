<?php
namespace App\Models;

use CodeIgniter\Model;

class BalanceHistoryModel extends Model {
 
    protected $table = 'ci_erp_balance_history';

    protected $primaryKey = 'id';
    
	// get all fields of user roles table
    protected $allowedFields = ['id','user_id','year','leave_type','balance','company_id'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>