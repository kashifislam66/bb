<?php
namespace App\Models;

use CodeIgniter\Model;
	
class NotificationsModel extends Model {
 
    protected $table = 'ci_erp_notifications';

    protected $primaryKey = 'notification_id';
    
	// get all fields of table
    protected $allowedFields = ['notification_id','company_id','module_options','notify_upon_submission','notify_upon_approval','approval_method','approval_level','approval_level01','approval_level02','approval_level03','approval_level04','approval_level05','skip_specific_approval','added_at','updated_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>