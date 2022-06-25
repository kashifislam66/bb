<?php
namespace App\Models;

use CodeIgniter\Model;
	
class FormsfieldModel extends Model {
 
    protected $table = 'ci_form_fields';

    protected $primaryKey = 'form_field_id';
    
	// get all fields of table
    protected $allowedFields = ['form_field_id','company_id','form_id','field_type','field_key','field_label','sort_order','is_mandatory','status','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>