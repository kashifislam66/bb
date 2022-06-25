<?php
namespace App\Models;

use CodeIgniter\Model;
	
class ResignationsModel extends Model {
 
    protected $table = 'ci_resignations';

    protected $primaryKey = 'resignation_id';
    
	// get all fields of table
    protected $allowedFields = ['resignation_id','company_id','employee_id','notice_date','resignation_date','document_file','is_signed','signed_file','signed_date','reason','added_by','status','notify_send_to','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>