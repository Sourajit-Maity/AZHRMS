<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LeaveRequest;

use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function index()
    {
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');
        $user = Auth::user();
        if(Auth::user()->role=='1') {
            $leaves = DB::table('leaves')
            ->select('emp_id','leave_type','date_from','azhrms_employee.emp_nick_name','reason','leaves.id as id','azhrms_leave_type.name','date_to','days','leave_type_offer','is_approved',)
            
            ->join('azhrms_leave_type','leaves.leave_type','=','azhrms_leave_type.id')
            ->join('azhrms_employee','leaves.emp_id','=','azhrms_employee.id')
            ->paginate(10);
           // $leaves = Leave::paginate(5);
        }
        else{
            $leaves =  DB::table('leaves')
            ->select('emp_id','leave_type','date_from','azhrms_employee.emp_nick_name','reason','leaves.id as id','azhrms_leave_type.name','date_to','days','leave_type_offer','is_approved',)
            
            ->join('azhrms_leave_type','leaves.leave_type','=','azhrms_leave_type.id')
            ->join('azhrms_employee','leaves.emp_id','=','azhrms_employee.id')
             ->where('leaves.emp_id',$emp_id)->paginate(10);
            
        }
//        $user = Auth::user();
        return view('leave.index',compact('leaves','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leavetype= DB::table('azhrms_leave_type')->get();
        return view('leave.create',compact('leavetype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeaveRequest $request)
    {
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');
        Leave::create([
            'emp_id'   => $emp_id,
            'leave_type'    => $request->leave_type,
            'date_from'     => $request->date_from,
            'date_to'       => $request->date_to,
            'days'          => $request->days,
            'reason'        => $request->reason,
        ]);

       

        return redirect()->route('leave');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
//        dd($request->all());
           // $leave = $request -> get('search');
            $leaves =Leave::where('leave_type', 'LIKE',"%{$request->search}%")->paginate();
            return view('leave.index',compact('leaves'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */

    public function approve(Request $request,$id)
    {

      //  dd($request->all());
        $leave = Leave::find($id);
//        dd($leave);
       if($leave){
           $leave->is_approved = $request -> approve;
           $leave->save();
           return redirect()->back();
       }
    }

    public function paid(Request $request,$id)
    {
        $leave = Leave::find($id);
        if($leave){
            $leave->leave_type_offer = $request -> paid;
            $leave->save();
            return redirect()->back();
        }
    }
}
