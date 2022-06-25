<?php
namespace App\Models;

use CodeIgniter\Model;
	
class LeaveadjustModel extends Model {
 
    protected $table = 'ci_leave_adjustment';

    protected $primaryKey = 'adjustment_id';
    
	// get all fields of table
    protected $allowedFields = ['adjustment_id','company_id','employee_id','leave_type_id','adjust_hours','reason_adjustment','status','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>