<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Myinfo;
use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\WorkWeek;
use App\Models\Skills;
use App\Models\Employee;
use App\Models\LeaveEntitlement;
use App\Models\EmployeeSkillGrade;
use App\Models\EmployeeSkills;
use App\Models\EmployeeEducation; 
use App\Models\User;
use App\Models\EmployeeBankDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Datatables;
use Response,Config;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;

class MyinfoController extends Controller
{
    public function addinfotab()

    {  
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');

        Log::debug("allcurrent".print_r($currentuserid,true));
        Log::debug("allemp".print_r($emp_id,true));

        $myprofile= DB::table('azhrms_employee')->select('emp_status','emp_nationality_id','emp_lastname','emp_firstname','emp_middle_name',
        'emp_nick_name','emp_birthday','operational_company_id','emp_food_habit','emp_code','related_person','emp_language',
        'operational_company_location_id', 'operational_company_loc_dept_id','emp_gender','emp_marital_status','emp_religion_id',
        'emp_pan_num', 'emp_aadhar_num','emp_other_id','emp_bloodgroup','emp_street1','emp_street2',
        'district_code', 'emp_pincode','emp_hm_telephone','emp_mobile','emp_work_telephone','emp_work_email','city_code','state_code',
        'org_age','joined_date','emp_oth_email','emp_img','reporting_to','shift','designation','job_role',

        'azhrms_employee.id as id','azhrms_employee_assets.property_name','azhrms_employee_assets.property_details','azhrms_employee_assets.giving_date','azhrms_employee_assets.return_date','return_property_conditions',
        'acnt_holder_name','bank_name','branch_name','account_number','neft_code','ifsc_code',
        'promotion_date','effective_from','last_designation','last_salary','letters','emp_status_type',
        'committed_amount','ctc_per_month','esi_number','pf_uan_no','pf_no','ctc_per_annum','payroll_org','pf_effective_date',
        'azhrms_employee_edu_details.emp_education_id','ins_name','degree','grade','notes','year',
       'azhrms_employee_skill_details.emp_skill_id as skill','azhrms_employee_skill_details.skill_grade')->
        join('azhrms_employee_assets', 'azhrms_employee.id', '=', 'azhrms_employee_assets.emp_id')->
        join('azhrms_employee_bank_details', 'azhrms_employee.id', '=', 'azhrms_employee_bank_details.emp_id')->
        join('azhrms_employee_edu_details', 'azhrms_employee.id', '=', 'azhrms_employee_edu_details.emp_id')->

        join('azhrms_employee_salary', 'azhrms_employee.id', '=', 'azhrms_employee_salary.emp_id')->
        join('users', 'azhrms_employee.id', '=', 'users.emp_id')->
        join('azhrms_employee_skill_details', 'azhrms_employee.id', '=', 'azhrms_employee_skill_details.emp_id')->

        join('azhrms_employee_promotion', 'azhrms_employee.id', '=', 'azhrms_employee_promotion.emp_id')
            ->where('azhrms_employee.id',$emp_id)
            ->first();

            Log::debug("all".print_r($myprofile,true));
        $assets= DB::table('azhrms_employee_assets')-> join('azhrms_company_assets', 'azhrms_employee_assets.property_name', '=', 'azhrms_company_assets.id')->where('emp_id',$emp_id)->get();
        $promotionemployee= DB::table('azhrms_employee_promotion')->where('emp_id',$emp_id)->get();
        $skillemployee= DB::table('azhrms_employee_skill_details')-> join('azhrms_skill', 'azhrms_employee_skill_details.emp_skill_id', '=', 'azhrms_skill.id')->where('emp_id',$emp_id)->get();
        $educationemployee= DB::table('azhrms_employee_edu_details')-> join('azhrms_education', 'azhrms_employee_edu_details.emp_education_id', '=', 'azhrms_education.id')->where('emp_id',$emp_id)->get();

        $company= DB::table('azhrms_employee')->select('azhrms_company_gen_info.c_name as company_name','azhrms_employee.operational_company_id as operational_company')->
        join('azhrms_company_gen_info', 'azhrms_employee.operational_company_id', '=', 'azhrms_company_gen_info.id')
        ->where('azhrms_employee.id',$emp_id)->get();

        $nationality= DB::table('azhrms_employee')->select('azhrms_nationalities.name as nation_name','azhrms_employee.emp_nationality_id as emp_nationality')->
        join('azhrms_nationalities', 'azhrms_employee.emp_nationality_id', '=', 'azhrms_nationalities.id')
        ->where('azhrms_employee.id',$emp_id)->get();
        
        $companylocation= DB::table('azhrms_employee')->select('azhrms_company_location.l_name as location_name','azhrms_employee.operational_company_location_id as operational_company_loc')->
        join('azhrms_company_location', 'azhrms_employee.operational_company_location_id', '=', 'azhrms_company_location.id')
        ->where('azhrms_employee.id',$emp_id)->get();

        $locationdepartment= DB::table('azhrms_employee')->select('azhrms_company_location_department.d_name as dept_name','azhrms_employee.operational_company_loc_dept_id as operational_company_loc_dept')->
        join('azhrms_company_location_department', 'azhrms_employee.operational_company_loc_dept_id', '=', 'azhrms_company_location_department.id')
        ->where('azhrms_employee.id',$emp_id)->get();

        $religion= DB::table('azhrms_employee')->select('azhrms_religion.name as reli_name','azhrms_employee.emp_religion_id as emp_religion')->
        join('azhrms_religion', 'azhrms_employee.emp_religion_id', '=', 'azhrms_religion.id')
        ->where('azhrms_employee.id',$emp_id)->get();

        $education= DB::table('azhrms_education')->get();
        $skills= DB::table('azhrms_skill')->get();

        $roles= DB::table('azhrms_employee')->select('azhrms_user_role.name as role_name','azhrms_employee.designation as designation_id')->
        join('azhrms_user_role', 'azhrms_employee.designation', '=', 'azhrms_user_role.id')
        ->where('azhrms_employee.id',$emp_id)->get();

        $rolecategory= DB::table('azhrms_employee')->select('azhrms_user_role_categories.respname as respname_name','azhrms_employee.job_role as job_role_id')->
        join('azhrms_user_role_categories', 'azhrms_employee.job_role', '=', 'azhrms_user_role_categories.id')
        ->where('azhrms_employee.id',$emp_id)->get();

        $type= DB::table('azhrms_employee')->select('azhrms_employee_type.emp_type_name as emp_type_name_name','azhrms_employee.emp_status as emp_status_id')->
        join('azhrms_employee_type', 'azhrms_employee.emp_status', '=', 'azhrms_employee_type.id')
        ->where('azhrms_employee.id',$emp_id)->get();

        $shift= DB::table('azhrms_employee')->select('azhrms_work_shift.name as work_name','azhrms_employee.shift as shift_id')->
        join('azhrms_work_shift', 'azhrms_employee.shift', '=', 'azhrms_work_shift.id')
        ->where('azhrms_employee.id',$emp_id)->get();

 

        $languageemployee= DB::table('employee_language')-> select('azhrms_employee_language.lng_name',
        'employee_language.id as id',
        'employee_language.language_id',
        'employee_language.proficiency','employee_language.emp_id',)->
        join('azhrms_employee_language', 'employee_language.language_id', '=', 'azhrms_employee_language.id')
        ->where('emp_id',$emp_id)->get();

        $language= DB::table('azhrms_employee_language')->get();
        $arrlanguages= DB::table('azhrms_employee')->where ('azhrms_employee.id',$emp_id)->value("emp_language");
        
        $lng = explode(',', $arrlanguages);


        $reporting= DB::table('azhrms_employee')->select('users.name as user_name','azhrms_employee.reporting_to as reporting')->
        join('users', 'azhrms_employee.id', '=', 'users.emp_id')
        ->where('azhrms_employee.id',$emp_id)->get();
        
        $allleave= DB::table('leaves')-> join('azhrms_leave_type', 'leaves.leave_type', '=', 'azhrms_leave_type.id')
        ->join('azhrms_leave_entitlement','leaves.leave_type','=','azhrms_leave_entitlement.leave_type_id')
        ->where('emp_id',$emp_id)->get();
        return view('myinfo.addinfotab',compact('roles','language','arrlanguages','lng',
        'promotionemployee','allleave','assets','skillemployee',    'educationemployee',
        'type','shift','reporting','myprofile','roles','rolecategory','education','skills',
        'company','nationality','companylocation','languageemployee','locationdepartment','religion'));
        
    }
}
