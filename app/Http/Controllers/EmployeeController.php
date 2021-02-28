<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\WorkWeek;
use App\Models\Skills;
use App\Models\CompanyGenInfo;
use App\Models\EmployeeLanguage;
use App\Models\Employee;
use App\Models\LeaveEntitlement;
use App\Models\EmployeeSkillGrade;
use App\Models\EmployeeSkills;
use App\Models\EmployeeEducation;
use App\Models\EmployeeType;
use App\Models\User; 
use App\Models\Assets;
use App\Models\EmployeeAssets;
use App\Models\Workshift;
use App\Models\EmployeePromotion;
use App\Models\EmployeeSalary;
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
use App\Models\Role;
use App\Models\File;

class EmployeeController extends Controller
{
    public function addemployee()
    {
        $company= DB::table('azhrms_company_gen_info')->pluck("c_name","id");
        $nationality= DB::table('azhrms_nationalities')->get();
        $companylocation= DB::table('azhrms_company_location')->get();
        $locationdepartment= DB::table('azhrms_company_location_department')->get();
        $religion= DB::table('azhrms_religion')->get();
        return view('employee.addemployee',compact('company','nationality','companylocation','locationdepartment','religion'));
    }
    public function getlocation($id) 
    {
        $companylocation = DB::table("azhrms_company_location")->where("operational_company_id",$id)->pluck("l_name","id");
        return json_encode($companylocation);
    }
    
    public function getunit($id) 
    {
        $unit= DB::table("azhrms_company_location_department")->where("operational_company_location_id",$id)->pluck("d_name","id");
        return json_encode($unit);
    }

    public function getrole($id) 
    {
        $jobrole = DB::table("azhrms_user_role_categories")->where("role_id",$id)->pluck("respname","id");
        return json_encode($jobrole);
    }

    public function submitemployee(Request $request)
   {
       
    $this->validate($request, [
 
        'emp_firstname'  => 'required|string|max:120',
        'emp_lastname'  => 'required|string|max:120',
        'emp_pan_num'  => 'required',
        'joined_date'  => 'required',
        'emp_mobile' => 'required|max:10',
        'emp_img' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip|size:5000',
   
    ]);

           $company = CompanyGenInfo::where('id',$request->operational_company_id)->first();
           $newemp = Employee::where('operational_company_id',$request->operational_company_id)->get();
           $nubrow=count($newemp)+1;
           if($nubrow <10){
               $emp_code = $company->res_company_name.'-'.date('Y').'-'."00".$nubrow;
           }
           elseif($nubrow >=10 && $nubrow<=99){
            $emp_code = $company->res_company_name.'-'.date('Y').'-'."0".$nubrow;
           }
           elseif($nubrow <=100){
            $emp_code = $company->res_company_name.'-'.date('Y').'-'.$nubrow;
           }
           


            //$arraytostring =  implode(',',$request->input('skills'));
                
                $bankdetails = new EmployeeBankDetails();
                $education = new EmployeeEducation();
                $skills= new EmployeeSkills();
                $user= new User();
                $salary= new EmployeeSalary();
                $assets = new EmployeeAssets();
                $promotion = new EmployeePromotion();

                $employee = new Employee();
                $employee->emp_firstname= $request->get('emp_firstname');
                $employee->emp_middle_name= $request->get('emp_middle_name');
                $employee->emp_lastname= $request->get('emp_lastname');
                $employee->emp_nick_name= $request->get('emp_nick_name');
                $employee->emp_code= $emp_code;
                
                $employee->emp_birthday= $request->get('emp_birthday');
                $employee->operational_company_id= $request->get('operational_company_id');
                $employee->operational_company_location_id= $request->get('operational_company_location_id');
                $employee->operational_company_loc_dept_id= $request->get('operational_company_loc_dept_id');
                $employee->emp_gender= $request->get('emp_gender');
                $employee->emp_marital_status= $request->get('emp_marital_status');
                $employee->emp_religion_id= $request->get('emp_religion_id');
                $employee->emp_pan_num= $request->get('emp_pan_num');
                $employee->emp_smoker= $request->get('emp_smoker');
                $employee->emp_aadhar_num= $request->get('emp_aadhar_num');
                $employee->emp_other_id= $request->get('emp_other_id');
                $employee->emp_bloodgroup= $request->get('emp_bloodgroup');
                $employee->emp_street1= $request->get('emp_street1');
                $employee->emp_street2= $request->get('emp_street2');
                $employee->city_code= $request->get('city_code');
                $employee->state_code= $request->get('state_code');
                $employee->district_code= $request->get('district_code');
                $employee->emp_pincode= $request->get('emp_pincode');
                $employee->emp_hm_telephone= $request->get('emp_hm_telephone');
                $employee->emp_mobile= $request->get('emp_mobile');
                $employee->emp_work_telephone= $request->get('emp_work_telephone');
                $employee->emp_work_email= $request->get('emp_work_email');
                $employee->emp_oth_email= $request->get('emp_oth_email');
                $employee->sal_grd_code= $request->get('sal_grd_code');
                $employee->joined_date= $request->get('joined_date');
                $employee->emp_nationality_id= $request->get('emp_nationality_id');
                $employee->emp_status= $request->get('emp_status');
                $employee->reporting_to= $request->get('reporting_to');
                $employee->shift= $request->get('shift');
                $employee->designation= $request->get('designation');
                $employee->job_role= $request->get('job_role');
                $employee->org_age= $request->get('org_age');
                $employee->emp_food_habit= $request->get('emp_food_habit');
                $employee->emp_language= $request->get('emp_language');
                //$employee['skills'] = $arraytostring;

                
                $fileName = time().'.'.$request->file->extension();  
        
                $request->file->move(public_path('images'), $fileName);
                $employee->emp_img= $fileName;
        
                $employee->save();

                $user= new User();
                $user->emp_id = $employee->id;
                $user->name= $request->get('emp_nick_name');
                $user->email= $request->get('emp_work_email');
                $user->role= 1;
                $user->password = bcrypt('password');
                $user->save();

                $education = new EmployeeEducation();
                $education->emp_id = $employee->id;
                
                $education->emp_education_id= $request->get('emp_education_id');
                 $education->degree= $request->get('degree');
                 $education->ins_name= $request->get('ins_name');
                 $education->grade= $request->get('grade');
                 $education->notes= $request->get('notes');
                 $education->year= $request->get('year');

                $education->save();

                $skills = new EmployeeSkills();
                $skills->emp_id = $employee->id;
                $skills->emp_skill_id= $request->get('emp_skill_id');
                $skills->skill_grade= $request->get('skill_grade');
                $skills->save();

                $bankdetails = new EmployeeBankDetails();
                $bankdetails->acnt_holder_name= $request->get('acnt_holder_name');
                $bankdetails->bank_name= $request->get('bank_name');
                $bankdetails->branch_name= $request->get('branch_name');
                $bankdetails->account_number= $request->get('account_number');
                $bankdetails->neft_code= $request->get('neft_code');
                $bankdetails->ifsc_code= $request->get('ifsc_code');
                $bankdetails->emp_id = $employee->id;

                $bankdetails->save();

                $salary= new EmployeeSalary();

                $salary->committed_amount= $request->get('committed_amount');
                $salary->ctc_per_month= $request->get('ctc_per_month');
                $salary->esi_number= $request->get('esi_number');
                $salary->pf_uan_no= $request->get('pf_uan_no');
                $salary->pf_no= $request->get('pf_no');
                $salary->ctc_per_annum= $request->get('ctc_per_annum');
                $salary->payroll_org= $request->get('payroll_org');
                $salary->pf_effective_date= $request->get('pf_effective_date');
                $salary->emp_id = $employee->id;

                $salary->save();

                $assets = new EmployeeAssets();

                $assets->property_name	= $request->get('property_name');
                $assets->property_details= $request->get('property_details');
                $assets->giving_date= $request->get('giving_date');
                $assets->return_date= $request->get('return_date');
                $assets->return_property_conditions= $request->get('return_property_conditions');
                $assets->emp_id = $employee->id;

                $assets->save();

                $promotion = new EmployeePromotion();

                $promotion->promotion_date	= $request->get('promotion_date');
                $promotion->effective_from= $request->get('effective_from');
                $promotion->last_designation= $request->get('last_designation');
                $promotion->last_salary= $request->get('last_salary');
                //$promotion->letters= 1;
                $letters = time().'.'.$request->letters->extension();  
        
                $request->letters->move(public_path('assets/letters'), $letters);
                $promotion->letters= $letters;
                $promotion->emp_id = $employee->id;

                $promotion->save();

               

            Log::debug("all".print_r($request->all(),true));
            return Redirect::to('view-employee')->with('success','You have successfully file uplaod.')
            ->with('file',$fileName,$letters); 
        
       
    }



   public function viewemployee(Request $request)
   {

    
       $employee = DB::table('azhrms_employee')->select('emp_lastname','emp_firstname','emp_middle_name',
       'emp_nick_name','operational_company_id','emp_food_habit','emp_code',
       'operational_company_location_id', 'operational_company_loc_dept_id','emp_gender','emp_marital_status','emp_religion_id',
        'emp_street1','emp_street2','azhrms_company_gen_info.c_name',
        'emp_work_email',
       'emp_img','azhrms_employee.id as id')
       ->join('azhrms_company_gen_info','azhrms_employee.operational_company_id','=','azhrms_company_gen_info.id')
       
       ->get(); 
       //select('azhrms_company_gen_info.c_name','azhrms_skill.name as skill_name','azhrms_education.name as edu_name','azhrms_company_location.l_name','azhrms_company_location_department.d_name','azhrms_religion.name as r_name','azhrms_nationalities.name as n_name','emp_number','azhrms_employee.id as id','emp_lastname',
      // 'emp_firstname','emp_middle_name','emp_nick_name','emp_smoker','ethnic_race_code','emp_aadhar_num',
     //  'emp_birthday','emp_gender','emp_marital_status','emp_pan_num','emp_other_id',
      // 'emp_bloodgroup','emp_street1','emp_street2','city_code','state_code','district_code','emp_pincode','emp_hm_telephone',
       //'emp_mobile','emp_work_telephone','emp_work_email','emp_oth_email','sal_grd_code','joined_date',
       //'committed_amount','ctc_per_month','esi_number','pf_uan_no','pf_no','ctc_per_annum','payroll_org','pf_effective_date',
       //'promotion_date','effective_from','last_designation','last_salary','acnt_holder_name','bank_name',
      // 'branch_name','account_number','neft_code','ifsc_code','property_name','property_details','giving_date','return_date',
      // 'return_property_conditions','emp_img','shift','designation','job_role','emp_status',
      // )
      // ->join('azhrms_company_gen_info','azhrms_employee.operational_company_id','=','azhrms_company_gen_info.id')
     //  ->join('azhrms_company_location','azhrms_employee.operational_company_location_id','=','azhrms_company_location.id')
     //  ->join('azhrms_company_location_department','azhrms_employee.operational_company_loc_dept_id','=','azhrms_company_location_department.id')
     //  ->join('azhrms_religion','azhrms_employee.emp_religion_id','=','azhrms_religion.id')
      // ->join('azhrms_nationalities','azhrms_employee.emp_nationality_id','=','azhrms_nationalities.id')
     //  ->join('azhrms_education','azhrms_employee.emp_education_id','=','azhrms_education.id')
      // ->join('azhrms_skill','azhrms_employee.emp_skill_id','=','azhrms_skill.id')
      // ->join('azhrms_employee_skill_details','azhrms_employee.id','=','azhrms_employee_skill_details.emp_id')
      // ->join('azhrms_employee_assets','azhrms_employee.id','=','azhrms_employee_assets.emp_id')
      // ->join('azhrms_employee_bank_details','azhrms_employee.id','=','azhrms_employee_bank_details.emp_id')
     //  ->join('azhrms_employee_edu_details','azhrms_employee.id','=','azhrms_employee_edu_details.emp_id')
      // ->join('azhrms_employee_promotion','azhrms_employee.id','=','azhrms_employee_promotion.emp_id')
       //->join('azhrms_employee_salary','azhrms_employee.id','=','azhrms_employee_salary.emp_id')
       //->join('users','azhrms_employee.id','=','users.emp_id')
      // ->get();
       
      
     
      return view('employee.viewemployee',compact('employee',));
   } 

   public function editemployee($id)
   {

    //$employee = Employee::findOrFail($id);

    $employee= DB::table('azhrms_employee')->select('emp_status','emp_education_id','emp_skill_id','emp_nationality_id', 'employee_id','emp_lastname','emp_firstname','emp_middle_name',
        'emp_nick_name', 'emp_smoker','ethnic_race_code','emp_code','emp_birthday','operational_company_id',
        'operational_company_location_id', 'operational_company_loc_dept_id','emp_gender','emp_marital_status','emp_religion_id',
        'emp_pan_num', 'emp_aadhar_num','emp_other_id','emp_bloodgroup','emp_street1','emp_street2',
        'district_code', 'emp_pincode','emp_hm_telephone','emp_mobile','emp_work_telephone','emp_work_email','city_code','state_code',
        'sal_grd_code','org_age','joined_date','emp_oth_email','emp_img','reporting_to','shift','designation','job_role','created_at','updated_at','deleted_at',

        'azhrms_employee.id as id','azhrms_employee_assets.property_name','azhrms_employee_assets.property_details','azhrms_employee_assets.giving_date','azhrms_employee_assets.return_date','return_property_conditions',
        'acnt_holder_name','bank_name','branch_name','account_number','neft_code','ifsc_code',
        'promotion_date','effective_from','last_designation','last_salary','letters',
        'committed_amount','ctc_per_month','esi_number','pf_uan_no','pf_no','ctc_per_annum','payroll_org','pf_effective_date',
        'emp_id','emp_education_id_masters','ins_name_masters','degree_masters','grade_masters','notes_masters','year_masters',
        'emp_education_id_graduate','ins_name_graduate','degree_graduate','grade_graduate','notes_graduate','Year_graduate',
        'emp_education_id_12th','ins_name_12th','degree_12th','grade_12th','notes_12th','year_12th',
        'emp_education_id_10th','ins_name_10th','degree_10th','grade_10th','notes_10th','year_10th','azhrms_employee_skill_details.emp_skill_id as skill','azhrms_employee_skill_details.skill_grade')->
        join('azhrms_employee_assets', 'azhrms_employee.id', '=', 'azhrms_employee_assets.emp_id')->
        join('azhrms_employee_bank_details', 'azhrms_employee.id', '=', 'azhrms_employee_bank_details.emp_id')->
        join('azhrms_employee_edu_details', 'azhrms_employee.id', '=', 'azhrms_employee_edu_details.emp_id')->

        join('azhrms_employee_salary', 'azhrms_employee.id', '=', 'azhrms_employee_salary.emp_id')->
        join('users', 'azhrms_employee.id', '=', 'users.emp_id')->
        join('azhrms_employee_skill_details', 'azhrms_employee.id', '=', 'azhrms_employee_skill_details.emp_id')->

        join('azhrms_employee_promotion', 'azhrms_employee.id', '=', 'azhrms_employee_promotion.emp_id')
            ->where('azhrms_employee.id',$id)
            ->first();

            Log::debug("all".print_r($employee,true));

    $nationality= DB::table('azhrms_nationalities')->get();
    $company= DB::table('azhrms_company_gen_info')->pluck("c_name","id");
    $companylocation= DB::table('azhrms_company_location')->get();;
    $locationdepartment= DB::table('azhrms_company_location_department')->get();
    $religion= DB::table('azhrms_religion')->get();
    $bankdetails= DB::table('azhrms_employee_bank_details')->where('id',$id)->get();

     return view('employee.editemployee',compact('company','bankdetails','nationality','employee','companylocation','locationdepartment','religion'));
   }

   public function getldlocation($ld_id) 
   {
       $editcompanylocation = DB::table("azhrms_company_location")->where("operational_company_id",$ld_id)->pluck("l_name","id");
       return json_encode($editcompanylocation);
   }
   
   public function getldunit($ld_id) 
   {
       $editunit= DB::table("azhrms_company_location_department")->where("operational_company_location_id",$ld_id)->pluck("d_name","id");
       return json_encode($editunit);
   }


   public function updateemployee($id, Request $request)
   {
       
    $employee= Employee::findOrFail($id);
    $employee->emp_firstname= $request->get('emp_firstname');
    $employee->emp_middle_name= $request->get('emp_middle_name');
    $employee->emp_lastname= $request->get('emp_lastname');
    $employee->emp_nick_name= $request->get('emp_nick_name');
    
    
    $employee->emp_birthday= $request->get('emp_birthday');
    $employee->operational_company_id= $request->get('operational_company_id');
    $employee->operational_company_location_id= $request->get('operational_company_location_id');
    $employee->operational_company_loc_dept_id= $request->get('operational_company_loc_dept_id');
    $employee->emp_gender= $request->get('emp_gender');
    $employee->emp_marital_status= $request->get('emp_marital_status');
    $employee->emp_religion_id= $request->get('emp_religion_id');
    $employee->emp_pan_num= $request->get('emp_pan_num');
    
    $employee->emp_aadhar_num= $request->get('emp_aadhar_num');
    $employee->emp_other_id= $request->get('emp_other_id');
    $employee->emp_bloodgroup= $request->get('emp_bloodgroup');
    $employee->emp_street1= $request->get('emp_street1');
    $employee->emp_street2= $request->get('emp_street2');
    $employee->city_code= $request->get('city_code');
    $employee->state_code= $request->get('state_code');
    $employee->district_code= $request->get('district_code');
    $employee->emp_pincode= $request->get('emp_pincode');
    $employee->emp_hm_telephone= $request->get('emp_hm_telephone');
    $employee->emp_mobile= $request->get('emp_mobile');
    $employee->emp_work_telephone= $request->get('emp_work_telephone');
    $employee->emp_work_email= $request->get('emp_work_email');
    $employee->emp_oth_email= $request->get('emp_oth_email');
    $employee->emp_status_type= $request->get('emp_status_type');
    $employee->joined_date= $request->get('joined_date');
    $employee->emp_nationality_id= $request->get('emp_nationality_id');
    $employee->emp_status= $request->get('emp_status');
    $employee->reporting_to= $request->get('reporting_to');
    $employee->shift= $request->get('shift');
    $employee->designation= $request->get('designation');
    $employee->job_role= $request->get('job_role');
    $employee->org_age= $request->get('org_age');
    //$employee['skills'] = $arraytostring;

    
    $fileName = time().'.'.$request->file->extension();  

    $request->file->move(public_path('images'), $fileName);
    $employee->emp_img= $fileName;

    $employee->update();



    $bankdetail_id = EmployeeBankDetails::where('emp_id',$id)->value('id');
    $bankdetails =EmployeeBankDetails::findOrFail($bankdetail_id);
    $bankdetails->acnt_holder_name= $request->get('acnt_holder_name');
    $bankdetails->bank_name= $request->get('bank_name');
    $bankdetails->branch_name= $request->get('branch_name');
    $bankdetails->account_number= $request->get('account_number');
    $bankdetails->neft_code= $request->get('neft_code');
    $bankdetails->ifsc_code= $request->get('ifsc_code');
    $bankdetails->emp_id = $id;

    $bankdetails->update();

                $user_id=  User::where('emp_id',$id)->value('id');
                $user =User::findOrFail($user_id);
                $user->emp_id = $id;
                $user->name= $request->get('emp_nick_name');
                $user->email= $request->get('emp_work_email');
                $user->role= 1;
                $user->password = bcrypt('password');
                $user->update();

                $education_id =  EmployeeEducation::where('emp_id',$id)->value('id');
                $education =EmployeeEducation::findOrFail($education_id);

                $education->emp_id = $id;
                 
                 $education->emp_education_id= $request->get('emp_education_id');
                 $education->degree= $request->get('degree');
                 $education->ins_name= $request->get('ins_name');
                 $education->grade= $request->get('grade');
                 $education->notes= $request->get('notes');
                 $education->year= $request->get('year');

                $education->update();

                $skills_id =  EmployeeSkills::where('emp_id',$id)->value('id');
                $skills = EmployeeSkills::findOrFail($skills_id);
                $skills->emp_id = $id;
                $skills->emp_skill_id= $request->get('emp_skill_id');
                $skills->skill_grade= $request->get('skill_grade');
                $skills->update();


                $salary_id= EmployeeSalary::where('emp_id',$id)->value('id');
                $salary = EmployeeSalary::findOrFail($salary_id);

                $salary->committed_amount= $request->get('committed_amount');
                $salary->ctc_per_month= $request->get('ctc_per_month');
                $salary->esi_number= $request->get('esi_number');
                $salary->pf_uan_no= $request->get('pf_uan_no');
                $salary->pf_no= $request->get('pf_no');
                $salary->ctc_per_annum= $request->get('ctc_per_annum');
                $salary->payroll_org= $request->get('payroll_org');
                $salary->pf_effective_date= $request->get('pf_effective_date');
                $salary->emp_id = $id;

                $salary->update();

                $assets_id = EmployeeAssets::where('emp_id',$id)->value('id');
                $assets = EmployeeAssets::findOrFail($assets_id);

                $assets->property_name	= $request->get('property_name');
                $assets->property_details= $request->get('property_details');
                $assets->giving_date= $request->get('giving_date');
                $assets->return_date= $request->get('return_date');
                $assets->return_property_conditions= $request->get('return_property_conditions');
                $assets->emp_id = $id;

                $assets->update();

                $promotion_id =  EmployeePromotion::where('emp_id',$id)->value('id');
                $promotion = EmployeePromotion::findOrFail($promotion_id);

                $promotion->promotion_date	= $request->get('promotion_date');
                $promotion->effective_from= $request->get('effective_from');
                $promotion->last_designation= $request->get('last_designation');
                $promotion->last_salary= $request->get('last_salary');
                //$promotion->letters= 1;
                $letters = time().'.'.$request->letters->extension();  
        
                $request->letters->move(public_path('assets/letters'), $letters);
                $promotion->letters= $letters;
                $promotion->emp_id = $id;

                $promotion->update();

                Log::debug("all".print_r($request->all(),true));
                return Redirect::to('view-employee')->with('success','You have successfully file uplaod.')
                ->with('file',$fileName,$letters); 
   }

   public function deleteemployee(Request $request,$id)
    {

        Employee::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Conform_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }


    public function addemployeetab()
    {
        $roles= DB::table('azhrms_user_role')->pluck("name","id");
        $company= DB::table('azhrms_company_gen_info')->pluck("c_name","id");
        $nationality= DB::table('azhrms_nationalities')->get();
        $companylocation= DB::table('azhrms_company_location')->get();
        $locationdepartment= DB::table('azhrms_company_location_department')->get();
        $religion= DB::table('azhrms_religion')->get();
        $education= DB::table('azhrms_education')->get();
        $skills= DB::table('azhrms_skill')->get();
        $type= DB::table('azhrms_employee_type')->get();
        $shift= DB::table('azhrms_work_shift')->get();
        $reporting= DB::table('users')->where('role',4)->get();
        $language= DB::table('azhrms_employee_language')->get();
        $state= DB::table('azhrms_company_state')->get();
        $district= DB::table('azhrms_company_district')->get();
        $country= DB::table('azhrms_company_country')->get();
        return view('employee.addemployeetab',compact('roles','state','country','district','language','reporting','shift','type','education','skills','company','nationality','companylocation','locationdepartment','religion'));
    }


    public function editemployeetab($id)
    {
        //$employee = Employee::findOrFail($id);

        $employee= DB::table('azhrms_employee')->select('emp_status','emp_nationality_id','emp_lastname','emp_firstname','emp_middle_name',
        'emp_nick_name','emp_birthday','operational_company_id','emp_food_habit','emp_language',
        'operational_company_location_id', 'operational_company_loc_dept_id','emp_gender','emp_marital_status','emp_religion_id',
        'emp_pan_num', 'emp_aadhar_num','emp_other_id','emp_bloodgroup','emp_street1','emp_street2','related_person',
        'district_code', 'emp_pincode','emp_hm_telephone','emp_mobile','emp_work_telephone','emp_work_email','city_code','state_code',
        'emp_status_type','emp_code','org_age', 'joined_date','emp_oth_email','emp_img','reporting_to','shift','designation','job_role',

        'azhrms_employee.id as id','azhrms_employee_assets.property_name','azhrms_employee_assets.property_details',
        'azhrms_employee_assets.giving_date','azhrms_employee_assets.return_date','return_property_conditions',
        'acnt_holder_name','bank_name','branch_name','account_number','neft_code','ifsc_code',
        'promotion_date','effective_from','last_designation','last_salary','letters',
        'committed_amount','ctc_per_month','esi_number','pf_uan_no','pf_no','ctc_per_annum','payroll_org','pf_effective_date',
        'azhrms_employee_edu_details.emp_education_id','azhrms_employee_edu_details.ins_name','azhrms_employee_edu_details.degree',
        'azhrms_employee_edu_details.grade','azhrms_employee_edu_details.notes','azhrms_employee_edu_details.year',    
      'azhrms_employee_skill_details.emp_skill_id','azhrms_employee_skill_details.skill_grade')->
        join('azhrms_employee_assets', 'azhrms_employee.id', '=', 'azhrms_employee_assets.emp_id')->
        join('azhrms_employee_bank_details', 'azhrms_employee.id', '=', 'azhrms_employee_bank_details.emp_id')->
        join('azhrms_employee_edu_details', 'azhrms_employee.id', '=', 'azhrms_employee_edu_details.emp_id')->

        join('azhrms_employee_salary', 'azhrms_employee.id', '=', 'azhrms_employee_salary.emp_id')->
        join('users', 'azhrms_employee.id', '=', 'users.emp_id')->
        join('azhrms_employee_skill_details', 'azhrms_employee.id', '=', 'azhrms_employee_skill_details.emp_id')->

        join('azhrms_employee_promotion', 'azhrms_employee.id', '=', 'azhrms_employee_promotion.emp_id')
            ->where('azhrms_employee.id',$id)
            ->first();

            //Log::debug("all".print_r($employee,true));
        $state= DB::table("azhrms_company_state")->pluck("state_name","id");
        $empstate= DB::table('azhrms_employee')->select('azhrms_company_state.state_name as state_nme','azhrms_employee.state_code as state_code_id')->
        join('azhrms_company_state', 'azhrms_employee.state_code', '=', 'azhrms_company_state.id')
        ->where('azhrms_employee.id',$id)->get();

        $district= DB::table('azhrms_company_district')->get();
        $empdistrict= DB::table('azhrms_employee')->select('azhrms_company_district.district_name as district_nme','azhrms_employee.district_code as district_code_id')->
        join('azhrms_company_district', 'azhrms_employee.district_code', '=', 'azhrms_company_district.id')
        ->where('azhrms_employee.id',$id)->get();

        $country= DB::table('azhrms_company_country')->get();

        $nationality= DB::table('azhrms_nationalities')->get();
        $empnationality= DB::table('azhrms_employee')->select('azhrms_nationalities.name as nation_name','azhrms_employee.emp_nationality_id as emp_nationality')->
        join('azhrms_nationalities', 'azhrms_employee.emp_nationality_id', '=', 'azhrms_nationalities.id')
        ->where('azhrms_employee.id',$id)->get();

        $company= DB::table('azhrms_company_gen_info')->pluck("c_name","id");
        $empcompany= DB::table('azhrms_employee')->select('azhrms_company_gen_info.c_name as company_name','azhrms_employee.operational_company_id as operational_company')->
        join('azhrms_company_gen_info', 'azhrms_employee.operational_company_id', '=', 'azhrms_company_gen_info.id')
        ->where('azhrms_employee.id',$id)->get();


        $companylocation= DB::table('azhrms_company_location')->pluck("l_name","id");
        $empcompanylocation= DB::table('azhrms_employee')->select('azhrms_company_location.l_name as location_name','azhrms_employee.operational_company_location_id as operational_company_loc')->
        join('azhrms_company_location', 'azhrms_employee.operational_company_location_id', '=', 'azhrms_company_location.id')
        ->where('azhrms_employee.id',$id)->get();



        $locationdepartment= DB::table('azhrms_company_location_department')->pluck("d_name","id");
        $emplocationdepartment= DB::table('azhrms_employee')->select('azhrms_company_location_department.d_name as dept_name','azhrms_employee.operational_company_loc_dept_id as operational_company_loc_dept')->
        join('azhrms_company_location_department', 'azhrms_employee.operational_company_loc_dept_id', '=', 'azhrms_company_location_department.id')
        ->where('azhrms_employee.id',$id)->get();


        $religion= DB::table('azhrms_religion')->get();
        $empreligion= DB::table('azhrms_employee')->select('azhrms_religion.name as reli_name','azhrms_employee.emp_religion_id as emp_religion')->
        join('azhrms_religion', 'azhrms_employee.emp_religion_id', '=', 'azhrms_religion.id')
        ->where('azhrms_employee.id',$id)->get();

        $education= DB::table('azhrms_education')->get();
        $educationemployee= DB::table('azhrms_employee_edu_details')-> select('azhrms_education.name','azhrms_employee_edu_details.notes','azhrms_employee_edu_details.id as id',
        'azhrms_employee_edu_details.grade','azhrms_employee_edu_details.degree','azhrms_employee_edu_details.ins_name','azhrms_employee_edu_details.emp_education_id',
        'azhrms_employee_edu_details.year','azhrms_employee_edu_details.emp_id',)->
        join('azhrms_education', 'azhrms_employee_edu_details.emp_education_id', '=', 'azhrms_education.id')->where('emp_id',$id)->get();

        $skills= DB::table('azhrms_skill')->get();
        $skillemployee= DB::table('azhrms_employee_skill_details')-> select('azhrms_skill.name','azhrms_skill.description',
        'azhrms_employee_skill_details.id as id',
        'azhrms_employee_skill_details.emp_skill_id',
        'azhrms_employee_skill_details.skill_grade','azhrms_employee_skill_details.emp_id',)->
        join('azhrms_skill', 'azhrms_employee_skill_details.emp_skill_id', '=', 'azhrms_skill.id')->where('emp_id',$id)->get();

        $salary= DB::table('azhrms_employee_salary')->where('emp_id',$id)->get();

        $promotion= DB::table('azhrms_employee_promotion')->where('emp_id',$id)->get();
        $promotionemployee= DB::table('azhrms_employee_promotion')->where('emp_id',$id)->get();

        //$languageemployee= DB::table('employee_language')->where('emp_id',$id)->get();

        $languageemployee= DB::table('employee_language')-> select('azhrms_employee_language.lng_name',
        'employee_language.id as id',
        'employee_language.language_id',
        'employee_language.proficiency','employee_language.emp_id',)->
        join('azhrms_employee_language', 'employee_language.language_id', '=', 'azhrms_employee_language.id')->where('emp_id',$id)->get();

        $assets= DB::table('azhrms_employee_assets')->select('azhrms_company_assets.assets_name','azhrms_company_assets.assets_details','azhrms_employee_assets.id as id',
        'azhrms_employee_assets.return_property_conditions','azhrms_employee_assets.return_date','azhrms_employee_assets.giving_date','azhrms_employee_assets.property_details',
        'azhrms_employee_assets.property_name','azhrms_employee_assets.emp_id',)->
        join('azhrms_company_assets', 'azhrms_employee_assets.property_name', '=', 'azhrms_company_assets.id')->where('emp_id',$id)->get();

        

        $type= DB::table('azhrms_employee_type')->get();
        $emptype= DB::table('azhrms_employee')->select('azhrms_employee_type.emp_type_name as emp_type_name_name','azhrms_employee.emp_status as emp_status_id')->
        join('azhrms_employee_type', 'azhrms_employee.emp_status', '=', 'azhrms_employee_type.id')
        ->where('azhrms_employee.id',$id)->get();

        $shift= DB::table('azhrms_work_shift')->get();
        $empshift= DB::table('azhrms_employee')->select('azhrms_work_shift.name as work_name','azhrms_employee.shift as shift_id')->
        join('azhrms_work_shift', 'azhrms_employee.shift', '=', 'azhrms_work_shift.id')
        ->where('azhrms_employee.id',$id)->get();

        $reporting= DB::table('users')->get();
        $empreporting= DB::table('azhrms_employee')->select('users.name as user_name','azhrms_employee.reporting_to as reporting')->
        join('users', 'azhrms_employee.id', '=', 'users.emp_id')
        ->where('azhrms_employee.id',$id)->get();
        
 
        $language= DB::table('azhrms_employee_language')->get();
        $arrlanguages= DB::table('azhrms_employee')->where ('azhrms_employee.id',$id)->value("emp_language");
        
        $lng = explode(',', $arrlanguages);
       
        $search = $id;
        $data = DB::table("azhrms_employee")
            ->select("azhrms_employee.*")
            ->whereRaw("find_in_set('".$search."',azhrms_employee.emp_language)")
            ->get();
        
        $emplanguage= DB::table('azhrms_employee')->select('azhrms_employee_language.lng_name as lang_name','azhrms_employee.emp_language as emp_lng_id')->
        join('azhrms_employee_language', 'azhrms_employee.emp_language', '=', 'azhrms_employee_language.id')
        ->where ('azhrms_employee.id',$id)->get();
       

        $roles= DB::table('azhrms_user_role')->pluck("name","id");
        $emprole= DB::table('azhrms_employee')->select('azhrms_user_role.name as role_name','azhrms_employee.designation as designation_id')->
        join('azhrms_user_role', 'azhrms_employee.designation', '=', 'azhrms_user_role.id')
        ->where('azhrms_employee.id',$id)->get();

        $emprolecategory= DB::table('azhrms_employee')->select('azhrms_user_role_categories.respname as respname_name','azhrms_employee.job_role as job_role_id')->
        join('azhrms_user_role_categories', 'azhrms_employee.job_role', '=', 'azhrms_user_role_categories.id')
        ->where('azhrms_employee.id',$id)->get();
        $rolecategory= DB::table('azhrms_user_role_categories')->pluck("respname","id");

        $bankdetails= DB::table('azhrms_employee_bank_details')->where('emp_id',$id)->get();

        //Log::debug("langs   ".print_r($lnginarray,true));

        return view('employee.editemployeetab',compact('company','promotionemployee','empshift','emptype','empreligion',
        'emprole','emprolecategory','empnationality','empstate','empdistrict','emplanguage','arrlanguages',
        'emplocationdepartment','empcompanylocation','empcompany','empreporting','languageemployee','lng',
        'language','country','district','state','skillemployee','rolecategory','roles','type','reporting','shift','assets','promotion','salary','educationemployee','bankdetails','education','skills','nationality','employee','companylocation','locationdepartment','religion'));
   }
 

   public function detailsemployee($id,Request $request)
   {

    
    $employee = Employee::where('id',$id)->get();
       
      
     
      return view('employee.detailsemployee',compact('employee',));
   } 




   public function home3()
   {
    $roles= DB::table('azhrms_user_role')->pluck("name","id");
    return view('home3',compact('roles',));
}

public function fileUploadPost(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
    ]);

    $fileName = time().'.'.$request->file->extension();  
 
    $request->file->move(public_path('images'), $fileName);

    /* Store $fileName name in DATABASE from HERE */
    File::create(['img' => $fileName]);

    return back()
        ->with('success','You have successfully file uplaod.')
        ->with('file',$fileName); 
}



                public function updateemployeeinfo($id, Request $request)
                {

                    $this->validate($request, [
 
                        'emp_firstname'  => 'required|string|max:120',
                        'emp_lastname'  => 'required|string|max:120',
                        'emp_pan_num'  => 'required|string|max:20', 
                        'city_code'  => 'required',
                        'state_code'  => 'required',
                        'district_code'  => 'required',
                        'emp_pincode'  => 'required|max:6',
                       
                        'emp_work_telephone'  => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|between:10,14',
                        'emp_street1'  => 'required',
                       
                       
                   
                    ]);

                    DB::beginTransaction();

                    try {
                    
                $employee= Employee::findOrFail($id);
                $employee->emp_firstname= $request->get('emp_firstname');
                $employee->emp_middle_name= $request->get('emp_middle_name');
                $employee->emp_lastname= $request->get('emp_lastname');
                $employee->emp_nick_name= $request->get('emp_nick_name');
               
                $employee->emp_pan_num= $request->get('emp_pan_num');
                $employee->emp_street1= $request->get('emp_street1');
                $employee->emp_street2= $request->get('emp_street2');
                $employee->city_code= $request->get('city_code');
                $employee->state_code= $request->get('state_code');
                $employee->district_code= $request->get('district_code');
                $employee->emp_pincode= $request->get('emp_pincode');
              
                $employee->emp_work_telephone= $request->get('emp_work_telephone');
                $employee->emp_work_email= $request->get('emp_work_email');
               
             

                $employee->update();


                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }
 

             Log::debug("all".print_r($request->all(),true));
             return Redirect::back();
             
         }

public function updateemployeeaddress($id, Request $request)
{
    
    $employee= Employee::findOrFail($id);
  

    $employee->update();

    return Redirect::back();
             
}

public function updateemployeesalary($id, Request $request)
{
    DB::beginTransaction();

    try {
                $salary_id= EmployeeSalary::where('emp_id',$id)->value('id');
                $salary = EmployeeSalary::findOrFail($salary_id);

                $salary->committed_amount= $request->get('committed_amount');
                $salary->ctc_per_month= $request->get('ctc_per_month');
                $salary->esi_number= $request->get('esi_number');
                $salary->pf_uan_no= $request->get('pf_uan_no');
                $salary->pf_no= $request->get('pf_no');
                $salary->ctc_per_annum= $request->get('ctc_per_annum');
                $salary->payroll_org= $request->get('payroll_org');
                $salary->pf_effective_date= $request->get('pf_effective_date');
                $salary->emp_id = $id;

                $salary->update();
                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }
 

    return Redirect::back();
             
}

public function updateemployeebank($id, Request $request)
{
    
    DB::beginTransaction();

    try {
    $bankdetail_id = EmployeeBankDetails::where('emp_id',$id)->value('id');
    $bankdetails =EmployeeBankDetails::findOrFail($bankdetail_id);
    $bankdetails->acnt_holder_name= $request->get('acnt_holder_name');
    $bankdetails->bank_name= $request->get('bank_name');
    $bankdetails->branch_name= $request->get('branch_name');
    $bankdetails->account_number= $request->get('account_number');
    $bankdetails->neft_code= $request->get('neft_code');
    $bankdetails->ifsc_code= $request->get('ifsc_code');
    $bankdetails->emp_id = $id;

    $bankdetails->update();
    DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }

    return Redirect::back();
             
}
   public function updateemployeepromotion($id, Request $request)
        {
            DB::beginTransaction();

    try {
            $promotion_id =  EmployeePromotion::where('emp_id',$id)->value('id');
            $promotion = EmployeePromotion::findOrFail($promotion_id);

            $promotion->promotion_date	= $request->get('promotion_date');
            $promotion->effective_from= $request->get('effective_from');
            $promotion->last_designation= $request->get('last_designation');
            $promotion->last_salary= $request->get('last_salary');
            //$promotion->letters= 1;
            $letters = time().'.'.$request->letters->extension();  

            $request->letters->move(public_path('assets/letters'), $letters);
            $promotion->letters= $letters;
            $promotion->emp_id = $id;

            $promotion->update();
            DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }

            Log::debug("all".print_r($request->all(),true));
            return Redirect::back()->with('success','You have successfully file uplaod.')
            ->with('file',$letters);
        }


       
        
        public function updateemployeepersonal($id, Request $request)
        {

            $this->validate($request, [
 
                'emp_nationality_id'  => 'required',
                'emp_birthday'  => 'required',
                'emp_marital_status'  => 'required', 
                'emp_religion_id'  => 'required',
                'emp_oth_email'  => 'required|email',
                'emp_nationality_id'  => 'required',
                'emp_bloodgroup'  => 'required|max:6',
                'emp_hm_telephone'  => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|between:10,14',
                'emp_gender'  => 'required',
                'emp_mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|between:9,10',
               
           
            ]);
            DB::beginTransaction();

    try {
            $employee= Employee::findOrFail($id);
            $arraytostring =  implode(',',$request->input('emp_language'));
            
            
            $employee->emp_birthday= $request->get('emp_birthday');
            $employee->emp_gender= $request->get('emp_gender');
            $employee->emp_marital_status= $request->get('emp_marital_status');
            $employee->emp_religion_id= $request->get('emp_religion_id');
            $employee->emp_oth_email= $request->get('emp_oth_email');
            $employee->emp_hm_telephone= $request->get('emp_hm_telephone');
            $employee->emp_mobile= $request->get('emp_mobile');
            $employee->emp_aadhar_num= $request->get('emp_aadhar_num');
            $employee->emp_other_id= $request->get('emp_other_id');
            $employee->emp_bloodgroup= $request->get('emp_bloodgroup');
            $employee->emp_nationality_id= $request->get('emp_nationality_id');
            $employee->related_person= $request->get('related_person');
            $employee->emp_food_habit= $request->get('emp_food_habit');
            $employee['emp_language'] = $arraytostring;
        
            $employee->update();
            DB::commit();
              
        } 
        catch (\Exception $e) {
            DB::rollback();
            
        }
        
            return Redirect::back();
                     
        }  
        
        public function updateemployeeteaminfo($id, Request $request)
        {
            DB::beginTransaction();

    try {
            $employee= Employee::findOrFail($id);

            $current = Carbon::now();
            $age = $request->get('joined_date');
            $org_age = $current->diffInDays($age);

            //$company = CompanyGenInfo::where('id',$request->operational_company_id)->first();
           // $newemp = Employee::where('operational_company_id',$request->operational_company_id)->get();
           // $nubrow=count($newemp)+1;
          //  if($nubrow <10){
           //     $emp_code = $company->res_company_name.'-'.date('Y').'-'."00".$nubrow;
          //  }
          //  elseif($nubrow >=10 && $nubrow<=99){
          //   $emp_code = $company->res_company_name.'-'.date('Y').'-'."0".$nubrow;
          //  }
           // elseif($nubrow <=100){
           //  $emp_code = $company->res_company_name.'-'.date('Y').'-'.$nubrow;
           // } 
            
            $employee->operational_company_id= $request->get('operational_company_id');
            $employee->operational_company_location_id= $request->get('operational_company_location_id');
            $employee->operational_company_loc_dept_id= $request->get('operational_company_loc_dept_id');
            $employee->emp_status_type= $request->get('emp_status_type');
            $employee->joined_date= $request->get('joined_date');
            $employee->emp_status= $request->get('emp_status');
            $employee->reporting_to= $request->get('reporting_to');
            $employee->shift= $request->get('shift');
            $employee->designation= $request->get('designation');
            $employee->job_role= $request->get('job_role');
            $employee->org_age= $org_age;
            $employee->emp_code= $request->get('emp_code');
        
            $employee->update();
            DB::commit();
              
        } 
        catch (\Exception $e) {
            DB::rollback();
            
        }
            Log::debug("all".print_r($request->all(),true));
            return Redirect::back();
                     
        } 



        public function addemployeeassets($id)
        {
     
            $empassets = Assets::get();
            $assets = Employee::findOrFail($id);
     
          return view('employee.addemployeeassets',compact('assets','empassets'));
        }
     
     
        public function submitemployeeassets($id, Request $request)
        {
            
            DB::beginTransaction();

            try {
     
            $assets = new EmployeeAssets();

                $assets->property_name	= $request->get('property_name');
                $assets->property_details= $request->get('property_details');
                $assets->giving_date= $request->get('giving_date');
                $assets->return_date= $request->get('return_date');
                $assets->return_property_conditions= $request->get('return_property_conditions');
                $assets->emp_id = $id;

                $assets->save();
                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }
           
            return Redirect::to('view-employee')->with('success','Successfully Updated!');
        }


        public function editemployeeassets($id)
        {
            
    
                $empassets = Assets::get();
    
               // Log::debug("all".print_r($employee,true));
               $oldskill= DB::table('azhrms_employee_assets')->
            select('azhrms_company_assets.assets_details as assets_detail','azhrms_company_assets.assets_name as assets_nme',
            'azhrms_employee_assets.property_name as property_id','azhrms_employee_assets.property_details as details_id',)->  
            join('azhrms_company_assets', 'azhrms_employee_assets.property_name', '=', 'azhrms_company_assets.id')
            ->where('azhrms_employee_assets.id',$id)->get(); 
    
         
            $asset= EmployeeAssets::findOrFail($id);
           
            return view('employee.editemployeeassets',compact('asset','oldskill','empassets'));
       }

        public function updateemployeeassets($id, Request $request)
        {
              
            DB::beginTransaction();

    try {// $emp_id = Employee::where('emp_id',$id)->value('id');
                $assets = EmployeeAssets::findOrFail($id);

                $assets->property_name	= $request->get('property_name');
                $assets->property_details= $request->get('property_details');
                $assets->giving_date= $request->get('giving_date');
                $assets->return_date= $request->get('return_date');
                $assets->return_property_conditions= $request->get('return_property_conditions');
                $assets->emp_id = $request->get('emp_id');

                $assets->update();
                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }

            Log::debug("all".print_r($request->all(),true));
            return Redirect::back()->with('success','Successfully Updated!');
            
        }

        public function addemployeeskills($id)
        {
     
            $employeeskill = Employee::findOrFail($id);
            $skills= DB::table('azhrms_skill')->get();
     
          return view('employee.addemployeeskills',compact('skills','employeeskill'));
        }
     
     
        public function submitemployeeskills($id, Request $request)
        {
            DB::beginTransaction();

            try {
            
         
            $skills = new EmployeeSkills();
            $skills->emp_id = $id;
            $skills->emp_skill_id= $request->get('emp_skill_id');
            $skills->skill_grade= $request->get('skill_grade');
            $skills->save();
            DB::commit();
              
        } 
        catch (\Exception $e) {
            DB::rollback();
            
        }
           
        return Redirect::to('view-employee')->with('success','Successfully Updated!');
        }

        public function editemployeeskills($id)
        {
            $oldskill= DB::table('azhrms_employee_skill_details')->
            select('azhrms_skill.name as skill_name','azhrms_employee_skill_details.emp_skill_id as skill_id')->  
            join('azhrms_skill', 'azhrms_employee_skill_details.emp_skill_id', '=', 'azhrms_skill.id')
            ->where('azhrms_employee_skill_details.id',$id)->get(); 
            
            $empskills= DB::table('azhrms_skill')->get();
    
               // Log::debug("all".print_r($employee,true));
    
         
            $skills= EmployeeSkills::findOrFail($id);
           
            return view('employee.editemployeeskills',compact('skills','oldskill','empskills'));
       }

        public function updateemployeeskills($id, Request $request)
        {
            DB::beginTransaction();

            try {
                $skills = EmployeeSkills::findOrFail($id);
               
                $skills->emp_skill_id= $request->get('emp_skill_id');
                $skills->skill_grade= $request->get('skill_grade');
               
                $skills->emp_id = $request->get('emp_id');

                $skills->update();
                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }

           // Log::debug("all".print_r($request->all(),true));
           return Redirect::back()->with('success','Successfully Updated!');
            
        }


        public function editemployeeeducation($id)
        {
            
            $azheducation= DB::table('azhrms_education')->get();
    
            $oldeducation = DB::table('azhrms_employee_edu_details')->
            select('azhrms_education.name as edu_name','azhrms_employee_edu_details.emp_education_id as edu_id')->  
            join('azhrms_education', 'azhrms_employee_edu_details.emp_education_id', '=', 'azhrms_education.id')
            ->where('azhrms_employee_edu_details.id',$id)->get();
    
         
            $eduemployee= EmployeeEducation::findOrFail($id);
           
            return view('employee.editemployeeeducation',compact('eduemployee','oldeducation','azheducation'));
       }

        public function updateemployeeeducation($id, Request $request)
        {
            DB::beginTransaction();

            try {
            
            $education =EmployeeEducation::findOrFail($id);

            $education->emp_id = $request->get('emp_id');
 
             $education->emp_education_id= $request->get('emp_education_id');
             $education->ins_name= $request->get('ins_name');
             $education->degree= $request->get('degree');
             $education->grade= $request->get('grade');
             $education->notes= $request->get('notes');
             $education->year= $request->get('year');

            $education->update();
            DB::commit();
              
        } 
        catch (\Exception $e) {
            DB::rollback();
            
        }

           // Log::debug("all".print_r($request->all(),true));
           return Redirect::back()->with('success','Successfully Updated!');
            
        }


        public function addemployeeeducation($id)
        {
            $azheducation= DB::table('azhrms_education')->get();
            $educationemp = Employee::findOrFail($id);
     
          return view('employee.addemployeeeducation',compact('educationemp','azheducation'));
        }
     
     
        public function submitemployeeeducation($id, Request $request)
        {
            
            DB::beginTransaction();

            try {
     
            $education = new EmployeeEducation();

            $education->emp_education_id= $request->get('emp_education_id');
            $education->ins_name= $request->get('ins_name');
            $education->degree= $request->get('degree');
            $education->grade= $request->get('grade');
            $education->notes= $request->get('notes');
            $education->year= $request->get('year');
                $education->emp_id = $id;

                $education->save();
                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }
            Log::debug("all".print_r($id,true));
           
            return Redirect::to('view-employee')->with('success','Successfully Updated!');
        }
        public function addemployeblooddoc($id)
        {
     
            $employeeblood = Employee::findOrFail($id);
     
          return view('employee.addemployeeblooddoc',compact('employeeblood'));
        }
     
     
        public function submitemployeeblooddoc($id, Request $request)
        {
            
         
     
            $employee = Employee::findOrFail($id);

            
            $fileName = time().'.'.$request->blood_doc->extension();  

            $request->blood_doc->move(public_path('assets/blooddoc'), $fileName);
            $employee->blood_doc= $fileName;
        
            $employee->save();
        
            Log::debug("all".print_r($request->all(),true));
            return Redirect::to('view-employee')->with('success','You have successfully file uplaod.')
            ->with('file',$fileName); 
           
            return Redirect::to('view-employee')->with('success','Successfully Updated!');
        }

        public function addemployeimage($id)
        {
     
            $employeeimg = Employee::findOrFail($id);
     
          return view('employee.addemployeeimage',compact('employeeimg'));
        }
     
     
        public function submitemployeeimage($id, Request $request)
        {
            
         
     
            $employee = Employee::findOrFail($id);

            
            $fileName = time().'.'.$request->emp_img->extension();  

            $request->emp_img->move(public_path('assets/images'), $fileName);
            $employee->emp_img= $fileName;
        
            $employee->save();
        
            Log::debug("all".print_r($request->all(),true));
            return Redirect::to('view-employee')->with('success','You have successfully file uplaod.')
            ->with('file',$fileName); 
           
            return Redirect::to('view-employee')->with('success','Successfully Updated!');
        }

        public function updateemployeeimage($id, Request $request)
        {

            

            $employee= Employee::findOrFail($id);
            $fileName = time().'.'.$request->emp_img->extension();  

            $request->emp_img->move(public_path('assets/images'), $fileName);
            $employee->emp_img= $fileName;
        
            $employee->update();
        
            Log::debug("all".print_r($request->all(),true));
            return Redirect::to('view-employee')->with('success','You have successfully file uplaod.')
            ->with('file',$fileName); 
                     
        }      
        

        public function addemployepancard($id)
        {
     
            $employeepan = Employee::findOrFail($id);
     
          return view('employee.addemployeepandoc',compact('employeepan'));
        }
     
     
        public function submitemployeepancard($id, Request $request)
        {
            
         
     
            $employee = Employee::findOrFail($id);

            
            $fileName = time().'.'.$request->pan_doc->extension();  

            $request->pan_doc->move(public_path('assets/pandoc'), $fileName);
            $employee->pan_doc= $fileName;
        
            $employee->save();
        
            Log::debug("all".print_r($request->all(),true));
            return Redirect::to('view-employee')->with('success','You have successfully file uplaod.')
            ->with('file',$fileName); 
           
            return Redirect::to('view-employee')->with('success','Successfully Updated!');
        }

        public function addemployeepromotion($id)
        {
     
            
            $promotion = Employee::findOrFail($id);
     
          return view('employee.addemployeepromotion',compact('promotion'));
        }
     
     
        public function submitemployeepromotion($id, Request $request)
        {
            
            DB::beginTransaction();

            try {
     
            $promotion = new EmployeePromotion();

           

            $promotion->promotion_date	= $request->get('promotion_date');
           $promotion->effective_from= $request->get('effective_from');
           $promotion->last_designation= $request->get('last_designation');
           $promotion->last_salary= $request->get('last_salary');
        
           $letters = time().'.'.$request->letters->extension();  

           $request->letters->move(public_path('assets/letters'), $letters);
           $promotion->letters= $letters;
                $promotion->emp_id = $id;

                $promotion->save();
                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }
           
            Log::debug("all".print_r($request->all(),true));
            return Redirect::to('view-employee')->with('success','You have successfully file uplaod.')
            ->with('file',$letters);
        }


        public function editemployeepromotion($id)
        {

            $promotion= EmployeePromotion::findOrFail($id);
           
            return view('employee.editemployeepromotion',compact('promotion'));
        }


       public function updateemployepromotion($id, Request $request)
       {
             
           DB::beginTransaction();

         try {
               $promotion = EmployeePromotion::findOrFail($id);

            $promotion->promotion_date	= $request->get('promotion_date');
            $promotion->effective_from= $request->get('effective_from');
            $promotion->last_designation= $request->get('last_designation');
            $promotion->last_salary= $request->get('last_salary');
            $promotion->emp_id = $request->get('emp_id');
           
            $letters = time().'.'.$request->letters->extension();  

            $request->letters->move(public_path('assets/letters'), $letters);
            $promotion->letters= $letters;
            

            $promotion->update();
            DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }

            Log::debug("all".print_r($request->all(),true));
            return Redirect::back()->with('success','You have successfully file uplaod.')
            ->with('file',$letters);
       }


       public function addemployeelanguage($id)
        {
     
            
            $emplanguage = Employee::findOrFail($id);
            $language= DB::table('azhrms_employee_language')->get();
     
          return view('employee.addemployeelanguage',compact('language','emplanguage'));
        }
     
     
        public function submitemployeelanguage($id, Request $request)
        {
            
            DB::beginTransaction();

            try {
     
            $language = new EmployeeLanguage();

            $language->emp_id = $id;
            $language->language_id= $request->get('language_id');
            $language->proficiency= $request->get('proficiency');

                $language->save();
                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }
           
            Log::debug("all".print_r($request->all(),true));
            return Redirect::back();
           
        }


        public function editemployeelanguage($id)
        {

            $language= EmployeeLanguage::findOrFail($id);

            $oldlanguage= DB::table('employee_language')->
            select('azhrms_employee_language.lng_name as lang_name','employee_language.language_id as lang_id')->  
            join('azhrms_employee_language', 'employee_language.language_id', '=', 'azhrms_employee_language.id')
            ->where('employee_language.id',$id)->get(); 
            
            $emplanguage= DB::table('azhrms_employee_language')->get();
    
               // Log::debug("all".print_r($employee,true));
    
         
           
           
            return view('employee.editemployeelanguage',compact('language','emplanguage','oldlanguage'));
        }


       public function updateemployeelanguage($id, Request $request)
       {
             
           DB::beginTransaction();

         try {
               $language = EmployeeLanguage::findOrFail($id);

               $language->language_id= $request->get('language_id');
               $language->proficiency= $request->get('proficiency');
               $language->emp_id = $request->get('emp_id');
    
               $language->update();
            DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }

            Log::debug("all".print_r($request->all(),true));
            return Redirect::back();
            
       }



    }