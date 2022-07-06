<?php

namespace App\Http\Controllers\Dashboard;

use App\Attendmethods;
use App\Branch;
use App\Employee;
use App\Employee_Attendance;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('super_admin')) {
            $employees = Employee_Attendance::all();
            // dd($employees);
        } else {
            $employees = Employee_Attendance::where('branch_id', auth()->user()->branch_id)->get();
        }
        return view('employee_attendance.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (auth()->user()->hasRole('super_admin')) {
            $branch = Branch::all();
            $employees = Employee::all();
            $attendance = Attendmethods::all();
        } else {
            $branch = Branch::find(auth()->user()->branch_id);
            $employees = Employee::find(auth()->user()->branch_id);
            $attendance = Attendmethods::all();
        }
        return view('employee_attendance.create', compact('branch', 'employees', 'attendance'));
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
        try {
            $request->validate([
                'employee_id' => 'required',
                'attendance_method_id' => 'required',
            ]);
            $branch = auth()->user()->branch_id;
            $attendance  = $request->attendance_method_id;
            $employees = $request->employee_id;
            $emplist = [];
            foreach ($employees as $emp) {
                array_push($emplist, [
                    'employee_id' => $emp,
                    'branch_id' => $branch,
                    'attendance_method_id' => $attendance,
                ]);
            }
            // dd($emplist);
            Employee_Attendance::insert($emplist);
            return redirect()->back()->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $e) {
            return $e;
        }
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
