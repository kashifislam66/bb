<?php
namespace App\Models;

use CodeIgniter\Model;
	
class IncidentsModel extends Model {
 
    protected $table = 'ci_incidents';

    protected $primaryKey = 'incident_id';
    
	// get all fields of table
    protected $allowedFields = ['incident_id','company_id','employee_id','incident_type_id','title','incident_date','incident_time','description','incident_file','notify_send_to','status','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>