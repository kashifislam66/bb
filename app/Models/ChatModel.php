<?php
namespace App\Models;

use CodeIgniter\Model;
	
class ChatModel extends Model {
 
    protected $table = 'ci_chat_messages';

    protected $primaryKey = 'message_id';
    
	// get all fields of table
    protected $allowedFields = ['message_id','company_id','from_id','to_id','message_frm','is_read','message_content','recd','message_type','message_date'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>