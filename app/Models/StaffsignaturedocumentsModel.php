<?php
namespace App\Models;

use CodeIgniter\Model;
	
class StaffsignaturedocumentsModel extends Model {
 
    protected $table = 'ci_staff_signature_documents';

    protected $primaryKey = 'document_id';
    
	// get all fields of table
    protected $allowedFields = ['document_id','company_id','staff_id','signature_file_id','signature_task','is_signed','signed_file','signed_date','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>