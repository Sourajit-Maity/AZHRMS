<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Myinfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Datatables;
use Response,Config;

class MyinfoController extends Controller
{
    public function addinfotab()

    {
        $roles= DB::table('azhrms_user_role')->get();
        return view('myinfo.addinfotab',compact('roles'));
    }
}
