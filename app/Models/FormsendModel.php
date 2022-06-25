<?php
namespace App\Models;

use CodeIgniter\Model;
	
class FormsendModel extends Model {
 
    protected $table = 'ci_form_send';

    protected $primaryKey = 'form_send_id';
    
	// get all fields of table
    protected $allowedFields = ['form_send_id','company_id','form_id','assigned_to','form_deadline','status','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>