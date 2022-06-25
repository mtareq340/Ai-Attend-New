<?php

namespace App\Http\Controllers\Api;

use App\Branch;
use App\Employee;
use App\EmployeeRequest;
use App\Attendmethods;
use App\Http\Controllers\Controller;
use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeRequestController extends Controller
{
    public function getData(Request $request){
        $employee =  Employee::where('id', $request->id)->get();

        $data =  EmployeeRequest::where('employee_id', $request->id)->get();

        return Response()->json(['status' => 1, 'message' => 'success', 'data' => $data]);

    }

    function store (Request $request){

        $rules = array(
            'id' => 'required',
            'title' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status' => 0, 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()]);
        }
        $request_data = $request->all();
        $employee = Employee::FindOrFail($request->id);

        if($employee){
            $request_data['employee_id'] = $employee->id;
            $request_data['request'] = $request->title;
            $request_data['date'] = date('y-m-d');

            $employeeRequest = EmployeeRequest::create($request_data);
            return Response()->json(['status' => 1, 'message' => 'Data added successfuly', 'data'=> $employeeRequest]);
        }else{
            return Response()->json(['status' => 0, 'message' => 'there is no data']);
        }

    }

}
