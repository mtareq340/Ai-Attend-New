<?php

namespace App\Http\Controllers\api;

use App\Appointment;
use App\Employee;
use App\Employee_Attendance;
use App\Http\Controllers\Controller;
use App\RegisteredAttendanceMethod;
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
            'attendance_methods' => 'required',
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
        // check if today is a workday
        $today = Carbon::parse('07/14/2022')->dayOfWeek + 2;
        if($today > 7) $today = 1;

        // return in_array($today , explode(',',$appointment->attendance_days));
        if(! in_array((string)$today , explode(',',$appointment->attendance_days))){
            // today is not a work day
            return response()->json(['status' => 0 , 'message' => "today is not a work day"] , 403);
        }

        $emp_attendence = new Employee_Attendance();


        $emp_attendence->employee_id = $request->emp_id;
        $emp_attendence->branch_id = $appointment->branch_id;
        $emp_attendence->appointment_id = $request->appointment_id;
        

        $pass_attendance_methods = true; 
        foreach ($request->attendance_methods as $method) {
            if(! $method['state']) {
                $pass_attendance_methods = false;
            }
        }

        if(! $pass_attendance_methods){
            $emp_attendence->state = false;
            $emp_attendence['reason'] = "the employee failed the one or more of the verification methods" ;
        }else{
            // the employee passed the verification and localization methods
            // checking the time
            $now = Carbon::now();
            $period = $request->period;

            // add the delay time to the start time
            $start = Carbon::parse($appointment['start_from_period_' . $period]);
            // $end = Carbon::parse($appointment['end_to_period_' . $period]);
            $allow_delay_minutes = Carbon::parse($appointment['delay_period_' . $period])->secondsSinceMidnight() / 60;
            

            // check if the now between the start and end
            if($now->greaterThanOrEqualTo($start) && $now->lessThanOrEqualTo($start->addMinutes($allow_delay_minutes))){
                $emp_attendence['state'] = true;
            }else{
                // get the different in minutes
                // to know how many minutes the employee is late
                $diff_minutes = $now->diffInMinutes($start);
                $emp_attendence['state'] = false;
                $emp_attendence['reason'] = "the employee is late ". $diff_minutes . ' minutes';
                if($now->lt($start)){
                    // employee is early
                    return response()->json(['status' => 0 , 'message' => "the employee is early ". $diff_minutes . ' minutes'] , 401);
                }
            }
        }


        $emp_attendence->save();
        // store the attend methods ids with status
        $registered_attendance_methods = [];
        // save attendence methods status
        foreach ($request->attendance_methods as $method) {
           
            array_push($registered_attendance_methods , [
                'employee_id' => $request->emp_id,
                'attend_mthod_id' => (int) $method['method_id'],
                'plan_id' => $request->appointment_id,
                'location_id' => $appointment->location_id,
                'success' => $method['state'],
                'attendance_id' => $emp_attendence->id
            ]);
        }
        RegisteredAttendanceMethod::insert($registered_attendance_methods);
        $status = 1;
        $msg = '';
        $code = 204;
        if(! $emp_attendence['status']){
            $status = 0;
            $msg = $emp_attendence['reason'];
            $code = 401; 
        }
        return response()->json(['status' => $status , 'msg' => $msg] , $code);
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
