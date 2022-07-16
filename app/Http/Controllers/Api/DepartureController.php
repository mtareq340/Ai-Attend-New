<?php

namespace App\Http\Controllers\api;

use App\Appointment;
use App\Employee;
use App\Employee_Departure;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartureController extends Controller
{
    //
    public function set_employee_departure(Request $request)
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
        $appointment = Appointment::find($request->appointment_id);
        $emp_departure = new Employee_Departure();

        $emp_departure->employee_id = $request->emp_id;
        $emp_departure->branch_id = $appointment->branch_id;
        $emp_departure->appointment_id = $request->appointment_id;
        $emp_departure->attendance_method_id = $request->attend_method_id;

        $now = Carbon::now();
        $period = $request->period;
        // $start = Carbon::parse($appointment['start_from_period_' . $period]);
        $end = Carbon::parse($appointment['end_to_period_' . $period]);
        //check if time is greater than or equal to end time of attendance plan
        if ($now->gte($end)) {
            $emp_departure->save();
            return response()->json([
                'state' => '1',
                'message' => 'Successful Departure'
            ]);
        } else {
            return response()->json([
                'state' => '0',
                'message' => 'Departure time has not comming yet'
            ]);
        }
    }
}
