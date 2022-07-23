<?php

namespace App\Http\Controllers\Dashboard\Report;

use App\Appointment;
use App\Assign_Appointment;
use App\Employee;
use App\Employee_Attendance;
use App\Employee_Departure;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartureReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $work_appointments = Appointment::all();
        $employees = Employee::latest()->get();

        $query =  Employee_Departure::query();

        $date_now = date('Y-m-d');

        if ($request->date > 0 ) {
            $query->where('date', $request->date);
        }

        if (!$request->date) {
            $query->where('date', $date_now);
        }
        if ($request->employee_id > 0) {
            $query->where('employee_id', $request->employee_id);
        }

        $employeeDepartures = $query->latest()->get();

        return view('reports.departure_roport', compact('employees', 'work_appointments', 'employeeDepartures'));
    }

}
