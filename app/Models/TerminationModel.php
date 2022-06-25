<?php
namespace App\Models;

use CodeIgniter\Model;
	
class TerminationModel extends Model {
 
    protected $table = 'ci_terminations';

    protected $primaryKey = 'termination_id';
    
	// get all fields of table
    protected $allowedFields = ['termination_id','company_id','employee_id','notice_date','termination_date','document_file','is_signed','signed_file','signed_date','reason','added_by','status','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>