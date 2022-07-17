<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Employee_Request_Review;
use App\EmployeeRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;


class EmployeeRequestController extends Controller
{
    public function getData(Request $request)
    {
        $rules = array(
            'id' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status' => 0, 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()], 400);
        }
        // $employee =  Employee::where('id', $request->id)->get();
        $data =  Employee_Request_Review::where('employee_id', $request->id)->get();
        return Response()->json(['status' => 1, 'message' => 'success', 'data' => $data]);
    }

    function store(Request $request)
    {
        try {
            $rules = array(
                'id' => 'required',
                'title' => 'required',
                'details' => 'required',
                'attachment' => 'mimes:jpeg,jpg,png,gif'
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return Response()->json(['status' => 0, 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()], 400);
            }
            $request_data = $request->all();

            $employee = Employee::find($request->id);

            if ($employee) {
                $emp_request = new Employee_Request_Review();
                $emp_request['employee_id'] = $employee->id;
                $emp_request['request'] = $request_data['title'];
                $emp_request['details'] = $request_data['details'];
                $emp_request['date'] = date('y-m-d');

                $attachment = $request->file("attachment");
                if ($attachment) {

                    $image       = $request->file('attachment');
                    $filename    = time() . $image->getClientOriginalName();

                    $destinationPath = public_path('/uploads/requests');
                    $img = Image::make($image->path());
                    $img->resize(500, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $filename);



                    $emp_request['attachment'] = '/uploads/requests/' . $filename;
                }


                $employeeRequest = $emp_request->save();
                return Response()->json(['status' => 1, 'message' => 'Data added successfuly', 'data' => $employeeRequest]);
            } else {
                return Response()->json(['status' => 0, 'message' => 'no employee found'], 404);
            }
        } catch (Exception $e) {
            return Response()->json(['status' => 0, 'message' => $e->getMessage()], 500);
        }
    }
}
