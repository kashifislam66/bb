<?php
namespace App\Models;

use CodeIgniter\Model;
	
class PollsModel extends Model {
 
    protected $table = 'ci_polls';

    protected $primaryKey = 'poll_id';
    
	// get all fields of table
    protected $allowedFields = ['poll_id','company_id','poll_question','poll_start_date','poll_end_date','poll_answer1','poll_answer2','poll_answer3','poll_answer4','poll_answer5','notes','poll_title','is_active','added_by','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>