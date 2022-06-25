<?php
namespace App\Models;

use CodeIgniter\Model;
	
class AnnouncementcommentsModel extends Model {
 
    protected $table = 'ci_announcement_comments';

    protected $primaryKey = 'comment_id';
    
	// get all fields of table
    protected $allowedFields = ['comment_id','company_id','announcement_id','employee_id','announcement_comment','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>