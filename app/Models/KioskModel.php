<?php
namespace App\Models;

use CodeIgniter\Model;

class KioskModel extends Model {
 
    protected $table = 'ci_kiosk';

    protected $primaryKey = 'id';
    
	// get all fields of user roles table
    protected $allowedFields = ['id','user_id','date','sign_in_time','sign_out_time','created_at','updated_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>