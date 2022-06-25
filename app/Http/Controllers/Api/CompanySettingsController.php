<?php

namespace App\Http\Controllers\Api;

use App\Branch;
use App\Employee;
use App\Attendmethods;
use App\Http\Controllers\Controller;
use App\Imports\EmployeeImport;
use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class CompanySettingsController extends Controller
{
    public function getData(Request $request){
        $data =  DB::table('company_settings')->first();

        return Response()->json(['status' => 1, 'message' => 'success', 'data' => $data]);

    }

}
