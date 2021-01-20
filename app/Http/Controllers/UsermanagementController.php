<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;
use App\Usermanagement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Datatables;
use Response,Config;

class UsermanagementController extends Controller
{
    public function addUser()

   {
    $roles= DB::table('azhrms_user_role')->get();
    
       return view('usermanagement.adduser',compact('roles'));
   }

   public function registerUser(Request $request)
   {
       $this->validate($request, [

           'name'  => 'required|string|max:120',
           'email'  => 'required|email|unique:users',
           'password' => 'required|min:6|confirmed'
       ]);

       User::create([
           'name' => $request->get('name'),
           'email' => $request->get('email'),
           'user_id' => $request->get('user_id'),
           'role' => $request->get('role'),
           'password' => bcrypt($request->get('password'))
       ]);


       return Redirect::to('view-user')->with('success','User Registered Successfully!');
   }

   public function viewUser(Request $request)
   {

    


       $users = DB::table('users')
       ->select('user_id','email','users.name as u_name','role','azhrms_user_role.name as r_name','azhrms_user_role.display_name','users.id as id')
       ->join('azhrms_user_role','users.role','=','azhrms_user_role.id')
       ->get();
       $roles= DB::table('azhrms_user_role')->get();
           
           
       return view('usermanagement.viewuser',compact('users','roles',));
   }



   public function usersList()
    {   
        $usersQuery = User::query();
 
        $user_id = (!empty($_GET["user_id"])) ? ($_GET["user_id"]) : ('');
        $name = (!empty($_GET["name"])) ? ($_GET["name"]) : ('');
 
        if($user_id & $name){
     
         $user_id = date('Y-m-d', strtotime($user_id));
         $name = date('Y-m-d', strtotime($name));
          
         $usersQuery->whereRaw("(users.user_id) = '" . $user_id . "' AND (users.name) = '" . $name . "'");
        }
        $users = $usersQuery->select('*');
        return datatables()->of($users)
            ->make(true);
    }


   public function deleteuser(Request $request,$id)
    {

        User::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Conform_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }

    public function edituser($id)

    {
        $roles= DB::table('azhrms_user_role')->get();
        $users= DB::table('users')->get();
        $users = User::findOrFail($id);
 
        return view('usermanagement.edituser', compact('users','roles') );
    }
 
 
    public function updateuser($id, Request $request)
    {
        $this->validate($request, [

            'name'  => 'required|string|max:120',
            'email'  => 'required|email',
            
           
        ]);
 
        $user= User::findOrFail($id);
        $user->update($request->all());
        return Redirect::to('view-user')->with('success','Successfully Updated!');
    }

}
