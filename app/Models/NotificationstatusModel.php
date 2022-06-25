<?php
namespace App\Models;

use CodeIgniter\Model;
	
class NotificationstatusModel extends Model {
 
    protected $table = 'ci_erp_notifications_status';

    protected $primaryKey = 'notification_status_id';
    
	// get all fields of table
    protected $allowedFields = ['notification_status_id','module_option','module_status','module_key_id','staff_id','is_read'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>