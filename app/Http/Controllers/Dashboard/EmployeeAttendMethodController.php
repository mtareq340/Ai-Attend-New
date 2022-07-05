<?php

namespace App\Http\Controllers\Dashboard;

use App\Attendmethods;
use App\Branch;
use App\EmpAttendMethods;
use Illuminate\Http\Request;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Job;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class EmployeeAttendMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('show_employee_attend_methods')) {
            return abort(401);
        }
        if (auth()->user()->hasRole('super_admin')) {
            $emps = Employee::all();
        } else {
            $emps = Employee::where('branch_id', auth()->user()->branch_id)->where('active', '1')->where('locked', '=', '0')->get();
        }
        return view("employees_attend_methods.index", compact('emps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('add_employee_attend_method')) {
            return abort(401);
        }
        $attendmethods = Attendmethods::all();
        $jobs = Job::all();
        $employees = '';
        if (auth()->user()->hasRole('super_admin')) {
            $employees = Employee::whereDoesntHave('attend_methods')->get();
            // $employees = Employee::all();
        } else {
            $employees = Employee::whereDoesntHave('attend_methods')->where('branch_id', auth()->user()->branch_id)->get();
            // $employees = Employee::where('branch_id', auth()->user()->branch_id)->get();
        }
        return view('employees_attend_methods.create', compact('employees', 'attendmethods', 'jobs'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'attendance_id' => 'required',
                'emp_ids' => 'required',
            ]);
            $employees = $request->emp_ids;
            $attends = $request->attendance_id;
            // dd($employees, $attends);
            foreach ($attends as $attend) {
                $attend_method = Attendmethods::find($attend);
                $attend_method->employees()->sync($employees);
            }
            return redirect()->route('employees_attend_methods.index')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('employees_attend_methods.create')->with(['error' => 'حدث خطا برجاء المحاوله']);
            // return $e;
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
        if (!Gate::allows('edit_employee_attend_method')) {
            return abort(401);
        }
        $emp = Employee::find($id);
        $allattendmethod = Attendmethods::all();
        $attend_methods = $emp->attend_methods;
        return view('employees_attend_methods.edit', compact('emp', 'attend_methods', 'allattendmethod'));
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
        try {
            $request->validate([
                'attend_methods' => 'required',
            ]);
            $emp = Employee::find($id);
            $old = $emp->attend_methods;
            $new = $request->attend_methods;
            // dd($old);

            //first delete old attend method for employee //
            $oldlist = [];
            foreach ($old as $o) {
                array_push($oldlist, [
                    'employee_id' => $id,
                    'attend_method_id' => $o->id,
                ]);
            }
            // dd($oldlist);
            $attend = EmpAttendMethods::where('employee_id', $id);
            $attend->delete($oldlist);

            //add new attend methods//
            $newlist = [];
            foreach ($new as $n) {
                array_push($newlist, [
                    'employee_id' => $id,
                    'attend_method_id' => $n,
                ]);
            }
            EmpAttendMethods::insert($newlist);
            return redirect()->route('employees_attend_methods.index')->with(['success' => 'تم التحديث بنجاح']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'حدث خطا برجاء المحاوله']);
        }
    }

    public function destroy($id)
    {
    }
}
