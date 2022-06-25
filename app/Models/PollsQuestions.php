<?php
namespace App\Models;

use CodeIgniter\Model;
	
class PollsQuestions extends Model {
 
    protected $table = 'ci_polls_questions';

    protected $primaryKey = 'id';
    
	// get all fields of table
    protected $allowedFields = ['id','poll_ref_id','company_id','poll_question','poll_answer1','poll_answer2','poll_answer3','poll_answer4','poll_answer5','notes'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>