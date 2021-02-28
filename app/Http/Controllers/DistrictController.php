<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Employee;
use App\Models\User;
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

class DistrictController extends Controller
{
    public function adddistrict()
    {
      return view('district.adddistrict');
    }

    
    public function submitdistrict(Request $request)
   {
       
    $this->validate($request, [
 
        'district_name'  => 'required|string|max:120',
      
    ]);
   

    District::create([
           
           'district_name' => $request->get('district_name'),

         
                  
       ]);

     

       return Redirect::to('view-district')->with('success',' Created Successfully!');
   }



   public function viewdistrict(Request $request)
   {

    
       $type = DB::table('azhrms_company_district')->get();

      return view('district.viewdistrict',compact('type',));
   } 


   
   
   


   public function editdistrict($id)
   {

    $type = District::findOrFail($id);

     return view('district.editdistrict',compact('type'));
   }


   public function updatedistrict($id, Request $request)
   {
       
    

       $type= District::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletedistrict(Request $request,$id)
    {

        District::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Confirm_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }
}
