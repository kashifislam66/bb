<?php
namespace App\Models;

use CodeIgniter\Model;
	
class FormsModel extends Model {
 
    protected $table = 'ci_forms';

    protected $primaryKey = 'forms_id';
    
	// get all fields of table
    protected $allowedFields = ['forms_id','company_id','category_id','form_name','is_allow_attachment','is_attachment_mandatory','is_allow_fill','status','notify_upon_submission','notify_upon_approval','notify_upon_rejection','approval_method','approval_levels','approval_level01','approval_level02','approval_level03','approval_level04','approval_level05','skip_specific_approval','assign_departments','assigned_to','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>