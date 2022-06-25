<?php
namespace App\Models;

use CodeIgniter\Model;
	
class TimesheetModel extends Model {
 
    protected $table = 'ci_timesheet';

    protected $primaryKey = 'time_attendance_id';
    
	// get all fields of table
    protected $allowedFields = ['time_attendance_id','company_id','employee_id','shift_id','attendance_date','clock_in','clock_in_ip_address','clock_out','clock_out_ip_address','clock_in_out','clock_in_latitude','clock_in_longitude','clock_out_latitude','clock_out_longitude','time_late','early_leaving','overtime','total_work','total_rest','work_from_home','lunch_breakin','lunch_breakout','attendance_status','status'];
	
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = false;
	
}
?>