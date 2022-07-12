<?php

namespace App\Http\Controllers\api;

use App\Employee_Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    public function set_employee_attendence(Request $request)
    {
        $employee_attendance = Employee_Attendance::all();
        // return $employee_attendance;
        return response()->json(['status' => 1, 'message' => 'success', 'data' => $employee_attendance]);
    }

    public function set_employee_checkout(Request $request)
    {
        $employee_attendance_id = $request->id;
        $departure_time = $request->departure_time;
        $employee_attendance = Employee_Attendance::find($employee_attendance_id);
        $employee_attendance->update(
            ['departure_time' => $departure_time]
        );
        return response()->json(['status' => 1, 'message' => 'Employee has made Check out']);
    }
}
