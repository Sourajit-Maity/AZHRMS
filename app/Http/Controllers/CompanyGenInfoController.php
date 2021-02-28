<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CompanyGenInfo;
use App\Models\CompanyLocation;
use App\Models\CompanyLocationDepartment;
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

class CompanyGenInfoController extends Controller
{
    public function addcompany()
    {
       
        $companylocation= DB::table('azhrms_company_location')->get();
     
        return view('company.addcompany',compact('companylocation'));
    }

    
    public function submitcompany(Request $request)
   {
       
    $this->validate($request, [
 
        'c_name'  => 'required|string|max:120',
        'tax_id'  => 'required',
       'res_company_name' => 'required|string|max:4',
        'registration_number'  => 'required',
       
       
        
    ]);
   

    CompanyGenInfo::create([
           
           'c_name' => $request->get('c_name'),
           'tax_id' => $request->get('tax_id'), 
           'registration_number' => $request->get('registration_number'),
            'res_company_name' => $request->get('res_company_name'),
                  
       ]);

     

       return Redirect::to('view-company')->with('success',' Created Successfully!');
   }



   public function viewcompany(Request $request)
   {

    
       $company = DB::table('azhrms_company_gen_info')->get();
       
       
       
       
      
     
      return view('company.viewcompany',compact('company',));
   } 


   
   
   


   public function editcompany($id)
   {
  

    $company = CompanyGenInfo::findOrFail($id);
   
    $companylocation= DB::table('azhrms_company_location')->get();
 

     return view('company.editcompany',compact('companylocation','company'));
   }


   public function updatecompany($id, Request $request)
   {
    $this->validate($request, [
 
        'c_name'  => 'required|string|max:120',
        'tax_id'  => 'required',
       'res_company_name' => 'required|string|max:4',
        'registration_number'  => 'required',
       
       
        
    ]);
    

       $company= CompanyGenInfo::findOrFail($id);
       $company->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletecompany(Request $request,$id)
    {

        CompanyGenInfo::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Conform_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }
}
