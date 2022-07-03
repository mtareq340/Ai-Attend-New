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
            $emps = Employee::where('locked', '=', '0')->where('active', '1')->get();
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
        //
        $employees = Employee::whereDoesntHave('attend_methods')->get();
        $jobs = Job::all();
        $branchs = Branch::all();
        $attendmethod = Attendmethods::all();
        return view('employees_attend_methods.create', compact('employees', 'jobs', 'attendmethod', 'branchs'));
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
                'att_id' => 'required',
                'employee_id' => 'required',
            ]);
            $employees = $request->employee_id;
            $attend = $request->att_id;
            $list = [];
            foreach ($employees as $emp) {
                array_push($list, [
                    'employee_id' => $emp,
                    'attend_method_id' => $attend,
                ]);
            }
            EmpAttendMethods::insert($list);
            return redirect()->route('employees_attend_methods.create')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('employees_attend_methods.create')->with(['error' => 'حدث خطا برجاء المحاوله']);
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
