<?php

namespace App\Http\Controllers\Dashboard;

use App\Appointment;
use App\Assign_Appointment;
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
    public function index(Request $request)
    {

        if (auth()->user()->hasRole('super_admin')) {
            $work_appointments = Appointment::all();
            $branches = Branch::all();
            $employees = Employee_Attendance::query();

            if ($request->appointment_id) {
                $employees = $employees->where('appointment_id', $request->appointment_id);
            }
            if (isset($request->branch_id)) {
                $employees = $employees->where('branch_id', $request->branch_id);
            }
            if (isset($request->state)) {
                $employees = $employees->where('state', $request->state);
            }
            $employees = $employees->get();
        } else {
            $work_appointments = Appointment::where('branch_id', auth()->user()->branch_id)->get();
            $branches =  Branch::find(auth()->user()->branch_id);
            $employees = Employee_Attendance::where('branch_id', auth()->user()->branch_id);
            if (isset($request->appointment_id)) {
                $employees = $employees->where('appointment_id', $request->appointment_id)->where('branch_id', auth()->user()->branch_id)->get();
            }
            if (isset($request->state)) {
                $employees = $employees->where('state', $request->state);
            }
        }
        return view('employee_attendance.index', compact('employees', 'work_appointments', 'branches'));
    }


    public function make_employees_attendance_success(Request $request)
    {
        $employee_attendances = $request->employees_attendance;
        Employee_Attendance::whereIn('id', $employee_attendances)->update(['state' => 1, 'user_name' => auth()->user()->name]);
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
            $employees = Employee::all();
            $attendance = Attendmethods::all();
            $appointments = Appointment::all();
        } else {
            $employees = Employee::where('branch_id', auth()->user()->branch_id);
            $appointments = Appointment::where('branch_id', auth()->user()->branch_id);
            $attendance = Attendmethods::all();
        }
        return view('employee_attendance.create', compact('employees', 'appointments', 'attendance'));
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

    //filter Employees form Attendance plan

    public function getEmployeesFromAttendanceplan(Request $request)
    {
        $data = Assign_Appointment::where('work_appointment_id', $request->appointment)->get();
        $text = '';

        foreach ($data as $d) {
            $text  .= "<option value = '$d->id'>" . $d->employees->name . "</option>";
        }
        return $text;
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
