<?php

namespace App\Http\Controllers\Dashboard;

use App\Appointment;
use App\Branch;
use App\Employee_Attendance;
use App\Employee_Departure;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeesDepartureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $branches = '';
        $work_appointments = Appointment::all();
        if (auth()->user()->hasRole('super_admin')) {
            $work_appointments = Appointment::all();
            $branches = Branch::all();
            $employees_departure = Employee_Departure::query();
            if (isset($request->appointment_id)) {
                $employees_departure = Employee_Departure::where('appointment_id', $request->appointment_id);
            }
            if (isset($request->branch_id)) {
                $employees_departure = Employee_Departure::where('branch_id', $request->branch_id);
            }
            if (isset($request->state)) {
                $employees_departure = $employees_departure->where('state', $request->state);
            }
            $employees_departure = $employees_departure->get();
        } else {
            if (isset($request->appointment_id)) {
                $employees_departure = Employee_Departure::where('branch_id', auth()->user()->branch_id)->where('appointment_id', $request->appointment_id);
            } else {
                $employees_departure = Employee_Departure::where('branch_id', auth()->user()->branch_id);
            }
        }
        return view('employees_departure.index', compact('employees_departure', 'work_appointments', 'branches'));
    }

    public function make_employees_departure_success(Request $request)
    {
        $employees_departure = $request->employees_departure;
        Employee_Departure::whereIn('id', $employees_departure)->update(['state' => 1, 'user_name' => auth()->user()->name]);
        return redirect()->back()->with(['success' => 'تم التحديث']);
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
