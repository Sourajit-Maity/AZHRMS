<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{



    public function addRole()
    {
        return view('role.addrole');
    }


    public function registerRole(Request $request)
   {
       
    $this->validate($request, [
 
        'name'  => 'required|string|max:120',
        'display_name'  => 'required',
        
    ]);

       Role::create([
           
           'name' => $request->get('name'),
           'display_name' => $request->get('display_name'), 
         
       ]);

     

       return Redirect::to('view-role')->with('success','Subrole Created Successfully!');
   }


   public function viewrole(Request $request)
   {

    
       $role = DB::table('azhrms_user_role')->get();
       
      
     
      return view('role.viewrole',compact('role',));
   } 


   public function editRole($id)
   {
       $roledit = Role::findOrFail($id);

       return view('role.editrole', compact('roledit') );
   }


   public function updateRole($id, Request $request)
   {
       
       $this->validate($request, [
 
        'name'  => 'required|string|max:120',
        'display_name'  => 'required',
        
    ]);

       $role= Role::findOrFail($id);
       $role->update($request->all());
      
       return Redirect::to('view-role')->with('success','Successfully Updated!');
   }

   public function deleterole(Request $request,$id)
    {

        Role::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Conform_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }
}
