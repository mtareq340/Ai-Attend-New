<?php

namespace App\Http\Controllers\Dashboard;

use App\Appointment;
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
        $work_appointments = Appointment::all();

        if (auth()->user()->hasRole('super_admin')) {
            $employees = Employee_Attendance::all();
            // dd($employees);
        } else {
            $employees = Employee_Attendance::where('branch_id', auth()->user()->branch_id)->get();
        }
        return view('employee_attendance.index', compact('employees', 'work_appointments'));
    }

    public function make_employees_attendance_success(Request $request)
    {
        $employee_attendances = $request->employees_attendance;
        foreach ($employee_attendances as $emp_attendnce) {
            // return $emp_attendnce;
            $data = Employee_Attendance::find($emp_attendnce);
            $data->update(['state' => 1]);
        }
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
        if (auth()->user()->hasRole('super_admin')) {
            $branch = Branch::all();
            $employees = Employee::all();
            $attendance = Attendmethods::all();
            $appointments = Appointment::all();
        } else {
            $branch = Branch::find(auth()->user()->branch_id);
            $employees = Employee::where('branch_id', auth()->user()->branch_id);
            $appointments = Appointment::where('branch_id', auth()->user()->branch_id);
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
            return redirect()->route('employee_attendance.create')->with(['error' => 'حدثت مشكله برجاء الماوله مره اخري']);
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
