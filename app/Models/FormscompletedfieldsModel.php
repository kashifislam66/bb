<?php
namespace App\Models;

use CodeIgniter\Model;
	
class FormscompletedfieldsModel extends Model {
 
    protected $table = 'ci_form_completed_fields';

    protected $primaryKey = 'completed_field_id';
    
	// get all fields of table
    protected $allowedFields = ['completed_field_id','company_id','form_id','staff_id','field_key','field_value','status','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>