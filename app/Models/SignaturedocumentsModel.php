<?php
namespace App\Models;

use CodeIgniter\Model;
	
class SignaturedocumentsModel extends Model {
 
    protected $table = 'ci_signature_documents';

    protected $primaryKey = 'document_id';
    
	// get all fields of table
    protected $allowedFields = ['document_id','company_id','folder_id','share_with_employees','document_file','document_name','document_size','signature_task','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>