<?php
namespace App\Models;

use CodeIgniter\Model;
	
class EmailconfigModel extends Model {
 
    protected $table = 'ci_email_configuration';

    protected $primaryKey = 'email_config_id';
    
	// get all fields of table
    protected $allowedFields = ['email_config_id','email_type','smtp_host','smtp_username','smtp_password','smtp_port','smtp_secure'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>