<?php
namespace App\Models;

use CodeIgniter\Model;
	
class MembershipModel extends Model {
 
    protected $table = 'ci_membership';

    protected $primaryKey = 'membership_id';
    
	// get all fields of user membership table
    protected $allowedFields = ['membership_id','subscription_id','membership_type','price','plan_duration','total_employees','plan_icon','description','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>