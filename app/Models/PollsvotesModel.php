<?php
namespace App\Models;

use CodeIgniter\Model;
	
class PollsvotesModel extends Model {
 
    protected $table = 'ci_polls_votes';

    protected $primaryKey = 'polls_vote_id';
    
	// get all fields of table
    protected $allowedFields = ['polls_vote_id','company_id','poll_id','poll_answer','poll_question_id','user_id','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>