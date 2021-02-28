<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'azhrms_employee';
    protected $fillable = [
        'emp_status','emp_education_id','emp_skill_id','emp_nationality_id', 'employee_id','emp_lastname','emp_firstname','emp_middle_name',
        'emp_nick_name','emp_birthday','operational_company_id','emp_food_habit','emp_code','pan_doc','blood_doc','emp_language','related_person',
        'operational_company_location_id', 'operational_company_loc_dept_id','emp_gender','emp_marital_status','emp_religion_id',
        'emp_pan_num', 'emp_aadhar_num','emp_other_id','emp_bloodgroup','emp_street1','emp_street2','org_age','blood_doc',
        'district_code', 'emp_pincode','emp_hm_telephone','emp_mobile','emp_work_telephone','emp_work_email','city_code','state_code',
        'emp_status_type', 'joined_date','emp_oth_email','emp_img','reporting_to','shift','designation','job_role','created_at','updated_at','deleted_at',

    ];


 
}
