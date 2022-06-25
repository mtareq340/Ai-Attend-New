<?php

namespace App\Http\Controllers\Api;

use App\Branch;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Imports\EmployeeImport;
use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class EmployeesController extends Controller
{

    function employeeLogin (Request $request){

        $rules = array(
            'email' => 'required',
            'password' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status' => 'failure', 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()]);
        }
        $email = $request->email;
        $password = $request->password;

        if (Employee::attempt(array('email' => $email, 'password' => $password))) {
                $userDetails = array(
                    // 'user_id' => Auth::id(),
                    // 'name' => Auth::User()->name,
                    // 'email' => Auth::User()->email,
                    // 'mobile_number' => Auth::User()->phone,
                );
            return Response()->json(['status' => 1, 'message' => 'Successful..!', 'data' => $userDetails]);
        }else{
            return Response()->json(['status' => 0, 'message' => 'Invalid username or password']);
        }
    }

    public function getData(Request $request){
        $data =  Employee::latest()->get();

        return Response()->json(['status' => 1, 'message' => 'success', 'data' => $data]);

    }

    function isEmployeePhoneExist (Request $request){

        $rules = array(
            'phone' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status' => 0, 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()]);
        }
        $phone = $request->phone;

        $employee = Employee::where('phone', $phone)->first();

        if ($employee) {
            return Response()->json(['status' => 1, 'message' => 'Successful..! Your Phone is Exist']);
        }else{
            return Response()->json(['status' => 0, 'message' => 'Invalid phone']);
        }
    }

    function isOtpTrue (Request $request){

        $rules = array(
            'otp' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status' => 0, 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()]);
        }
        $otp = $request->otp;

        $employee = Employee::where('otp', $otp)->first();

        if ($employee) {
            return Response()->json(['status' => 1, 'message' => 'Successful..! Your OTP is Exist']);
        }else{
            return Response()->json(['status' => 0, 'message' => 'Invalid OTP']);
        }
    }
    function resetPassword (Request $request){

        $rules = array(
            'id' => 'required',
            'password' => 'required',
            're_password' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status' => 0, 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()]);
        }
        if($request->password == $request->re_password){
            $employee = Employee::FindOrFail($request->id);
            $employee->update([
                'password' => $request->password
            ]);
            return Response()->json(['status' => 1, 'message' => 'Successful..! Your password is changed']);
        }else{
            return Response()->json(['status' => 0, 'message' => 'password not equal Re-Password']);
        }

    }
    function changePassword (Request $request){

        $rules = array(
            'id' => 'required',
            'old_password' => 'required',
            'new_password' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status' => 0, 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()]);
        }
        try{
            $employee = Employee::FindOrFail($request->id);
            $employee->update([
                'password' => $request->new_password
            ]);
            return Response()->json(['status' => 1, 'message' => 'Successful..! Your password is changed']);
        }catch(exception $e){
            return Response()->json(['status' => 0, 'message' => $e->getMessage()]);
        }
           
    }

    function employeeUpdate (Request $request){

        $rules = array(
            'id' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status' => 0, 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()]);
        }
        $request_data = $request->all();
        $employee = Employee::FindOrFail($request->id);

        if($employee){
            $employee->update($request_data);
            return Response()->json(['status' => 1, 'message' => 'Data updated successfuly', 'data'=> $employee]);
        }else{
            return Response()->json(['status' => 0, 'message' => 'there is no data']);
        }

    }
}
