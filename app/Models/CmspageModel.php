<?php
namespace App\Models;

use CodeIgniter\Model;
	
class CmspageModel extends Model {
 
    protected $table = 'ci_cms_pages';

    protected $primaryKey = 'page_id';
    
	// get all fields of table
    protected $allowedFields = ['page_id','page_name','page_type','page_description','is_active'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>