<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\Employee;
use App\Models\LeaveEntitlement;
use App\Models\EmployeeType;
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
use App\Models\Role;
use App\Models\File;

class AllleaveController extends Controller
{
    public function allleave()
    {
        return view('totalleave.index');
    }


    public function viewleaves(Request $request)
   {

    
      

       if(Auth::user()->role=='1') {
        $leaveentitlement = DB::table('leaves')
        ->select('emp_id','no_of_days','leave_type_id','leave_type','date_from','azhrms_employee.emp_nick_name','reason','leaves.id as id','azhrms_leave_type.name','date_to','days','leave_type_offer','is_approved',)
        ->join('azhrms_leave_type','leaves.leave_type','=','azhrms_leave_type.id')
        ->join('azhrms_leave_entitlement','leaves.leave_type','=','azhrms_leave_entitlement.leave_type_id')
        ->join('azhrms_employee','leaves.emp_id','=','azhrms_employee.id')
        ->paginate(10);
       
    }
       
      
     
      return view('totalleave.allleave',compact('leaveentitlement',));
   } 
}
