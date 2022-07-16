<?php

namespace App\Http\Controllers\api;

use App\Appointment;
use App\Employee;
use App\Employee_Attendance;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    //
    public function set_employee_attendence(Request $request)
    {
        $rules = array(
            'emp_id' => 'required',
            'appointment_id' => 'required',
            'period' => 'required|in:1,2',
            'attend_method_id' => 'required',
            'state' => 'required|in:1,0'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status' => 0, 'message' => 'errors', 'errors' => $validator->getMessageBag()->toArray()]);
        }
        $emp = Employee::find($request->emp_id);
        if (!$emp) {
            return response()->json(['status' => 0, 'message' => 'errors', 'errors' => [
                'employee' => 'the employee is not found'
            ]], 404);
        }
        // employee is found
        $emp_appointments_ids = $emp->appointmentsIds();
        if (!in_array($request->appointment_id, $emp_appointments_ids)) {
            return response()->json(['status' => 0, 'message' => 'errors', 'errors' => [
                'employee' => 'the employee is not associated in this appointment'
            ]], 404);
        }
        // the employee is associated with the appointment
        $appointment = Appointment::find($request->appointment_id);
        $emp_attendence = new Employee_Attendance();

        $emp_attendence->employee_id = $request->emp_id;
        $emp_attendence->branch_id = $appointment->branch_id;
        $emp_attendence->appointment_id = $request->appointment_id;
        $emp_attendence->attendance_method_id = $request->attend_method_id;
        // $emp_attendence->state = $request->state;

        $now = Carbon::now();
        $period = $request->period;
        $start = Carbon::parse($appointment['start_from_period_' . $period]);
        $end = Carbon::parse($appointment['end_to_period_' . $period]);
        return Carbon::parse($appointment['delay_period_' . $period])->format('h:m:s');
        // if(
        //     $now->gt($start)
        //     &&
        //     $now->lt( $end-> )

        // )


        $emp_attendence->save();
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
