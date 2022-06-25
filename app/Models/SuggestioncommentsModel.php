<?php
namespace App\Models;

use CodeIgniter\Model;
	
class SuggestioncommentsModel extends Model {
 
    protected $table = 'ci_suggestion_comments';

    protected $primaryKey = 'comment_id';
    
	// get all fields of table
    protected $allowedFields = ['comment_id','company_id','suggestion_id','employee_id','suggestion_comment','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>