<?php

namespace App\Http\Controllers\Dashboard;

use App\Appointment;
use App\Assign_Appointment;
use App\Employee;
use App\Employee_Attendance;
use App\Employee_Departure;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MakeDepartureController extends Controller
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
        $employees =  Employee_Attendance::query();
        $date_now = date('Y-m-d');
        // return $date_now;
        $attendance_employees = DB::table('employee_attendance')->where([
            ['date', $date_now],
            ['state', true]
        ])->pluck('employee_id')->toArray();
        $collection1 = collect($attendance_employees);

        $departure_employees = DB::table('employees_departure')->pluck('employee_id')->toArray();
        $collection2 = collect($departure_employees);

        $result = $collection1->diff($collection2);
        if ($request->appointment_id) {
            $employees = Employee_Attendance::where('appointment_id', $request->appointment_id)->whereIn('employee_id', $result->all())->get();
            // dd($employees);
        } else {
            $employees = [];
        }
        return view('make_departure.index', compact('employees', 'work_appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store_employees_departures(Request $request)
    {
        $employees_id = $request->employees_departure;
        $appointment_id = $request->appointment_id;
        $over_time = $request->overtime;
        $update_employees = Assign_Appointment::whereIn('employee_id', $employees_id)->where('work_appointment_id', $appointment_id)->get();
        $period = '1';
        // check if period is 1 or 2 from overtime //
        if ($request->overtime) {
            $period = '2';
        }
        foreach ($update_employees as $update) {
            $update->update(['over_time' => $over_time]);
            Employee_Departure::create([
                'employee_id' => $update->employee_id,
                'branch_id' => $update->branch->id,
                'date' => date('Y-m-d'),
                'period' => $period,
                'appointment_id' => $appointment_id,
                'user_name' => auth()->user()->name,
                'overtime_minutes_diff' => $over_time
            ]);
        }
    }
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
