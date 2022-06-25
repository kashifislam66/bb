<?php
namespace App\Models;

use CodeIgniter\Model;
	
class SuggestionsModel extends Model {
 
    protected $table = 'ci_suggestions';

    protected $primaryKey = 'suggestion_id';
    
	// get all fields of table
    protected $allowedFields = ['suggestion_id','company_id','title','description','attachment','added_by','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>