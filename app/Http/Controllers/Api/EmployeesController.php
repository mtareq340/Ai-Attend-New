<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{

    function employeeLogin(Request $request)
    {
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

        $employee = Employee::where('email', $email)->with(['appointments' , 'attend_methods'])->first();
        if (!$employee) {
            return Response()->json(['status' => 'failure', 'message' => 'errors', 'errors' => ['employee' => 'invalid email or password']]);
        }

        if(! $employee->password){
            // check with job number
            if($employee->job_number != $password){
                return Response()->json(['status' => 'failure', 'message' => 'errors', 'errors' => ['employee' => 'invalid email or password']]);
            }
        }else{
            // check with password
            if (!Hash::check($password, $employee->password)) {
                return Response()->json(['status' => 'failure', 'message' => 'errors', 'errors' => ['employee' => 'invalid email or password']]);
            }
        }
        
        // the employee passed the authentication

        return Response()->json(['status' => 1, 'message' => 'Successful..!', 'data' => $employee]);
    }

    public function getData(Request $request)
    {
        $data =  Employee::latest()->get();
        return Response()->json(['status' => 1, 'message' => 'success', 'data' => $data]);
    }

    function isEmployeePhoneExist(Request $request)
    {

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
        } else {
            return Response()->json(['status' => 0, 'message' => 'Invalid phone']);
        }
    }

    function isOtpTrue(Request $request)
    {

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
        } else {
            return Response()->json(['status' => 0, 'message' => 'Invalid OTP']);
        }
    }
    function resetPassword(Request $request)
    {

        $rules = array(
            'id' => 'required',
            'password' => 'required',
            're_password' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status' => 0, 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()]);
        }
        if ($request->password == $request->re_password) {
            $employee = Employee::FindOrFail($request->id);
            $employee->update([
                'password' => $request->password
            ]);
            return Response()->json(['status' => 1, 'message' => 'Successful..! Your password is changed']);
        } else {
            return Response()->json(['status' => 0, 'message' => 'password not equal Re-Password']);
        }
    }
    function changePassword(Request $request)
    {

        $rules = array(
            'id' => 'required',
            'old_password' => 'required',
            'new_password' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status' => 0, 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()]);
        }
        try {
            $employee = Employee::FindOrFail($request->id);
            $employee->update([
                'password' => Hash::make($request->new_password)
            ]);
            return Response()->json(['status' => 1, 'message' => 'Successful..! Your password is changed']);
        } catch (\Exception $e) {
            return Response()->json(['status' => 0, 'message' => $e->getMessage()]);
        }
    }

    function employeeUpdate(Request $request)
    {

        $rules = array(
            'id' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status' => 0, 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()]);
        }
        $request_data = $request->all();
        $employee = Employee::FindOrFail($request->id);

        if ($employee) {
            $employee->update($request_data);
            return Response()->json(['status' => 1, 'message' => 'Data updated successfuly', 'data' => $employee]);
        } else {
            return Response()->json(['status' => 0, 'message' => 'there is no data']);
        }
    }

    function get_employee_attendenceMethods(Request $req)
    {
        $rules = array(
            'id' => 'required',
        );
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status' => 0, 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()]);
        }
        $emp = Employee::find($req->id);
        if (!$emp) {
            return response()->json(['status' => 0, 'message' => 'errors', 'errors' => [
                'employee' => 'the employee is not found'
            ]], 404);
        }
        return $emp->attend_methods()->where('active', 1)->get();
    }
}
