<?php
namespace App\Models;

use CodeIgniter\Model;

class ShiftModel extends Model {
 
    protected $table = 'ci_office_shifts';

    protected $primaryKey = 'office_shift_id';
    
	// get all fields of table
    protected $allowedFields = ['office_shift_id','company_id','shift_name','monday_in_time','monday_out_time','tuesday_in_time','tuesday_out_time','wednesday_in_time','wednesday_out_time','thursday_in_time','thursday_out_time','friday_in_time','friday_out_time','saturday_in_time','saturday_out_time','sunday_in_time','sunday_out_time','monday_lunch_break','tuesday_lunch_break','wednesday_lunch_break','thursday_lunch_break','friday_lunch_break','saturday_lunch_break','sunday_lunch_break','monday_lunch_break_out','tuesday_lunch_break_out','wednesday_lunch_break_out','thursday_lunch_break_out','friday_lunch_break_out','saturday_lunch_break_out','sunday_lunch_break_out','created_at'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>