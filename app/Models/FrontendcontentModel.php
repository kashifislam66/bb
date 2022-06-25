<?php
namespace App\Models;

use CodeIgniter\Model;
	
class FrontendcontentModel extends Model {
 
    protected $table = 'ci_frontend_content';

    protected $primaryKey = 'frontend_id';
    
	// get all fields of table
    protected $allowedFields = ['frontend_id','about_short','youtube_url','fb_profile','twitter_profile','linkedin_profile','updated_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>