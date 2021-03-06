<?php

namespace App\Http\Controllers\Dashboard;

use App\Attendmethods;
use App\Branch;
use App\EmpAttendMethods;
use App\Employee;
use App\Plan;
use App\Http\Controllers\Controller;
use App\Imports\EmployeeImport;
use App\Job;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        if (!Gate::allows('show_employees')) {
            return abort(401);
        }
        $branches = Branch::all();
        $jobs = Job::all();
        $attend_methods = Attendmethods::all();
        //
        if (auth()->user()->hasRole('super_admin')) {
            $employees = Employee::with('attend_methods')->latest()->get();
        } else {
            $employees = Employee::with('attend_methods')->where('branch_id', auth()->user()->branch_id)->get();
        }
        return view('employees.index', compact('employees', 'branches', 'jobs' , 'attend_methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('add_employee')) {
            return abort(401);
        }
        //
        $branches = Branch::all();
        $jobs = Job::all();
        return view('employees.add', compact('branches', 'jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $plan_id = Setting::find(1)->value;
        // $plan = Plan::find($plan_id);
        // $employees_count = Employee::count();

        // if($plan->count_employees <= $employees_count)
        //     return back()->with(['error' => '?????? ???????? ?????? ???????????????? ???? ???????? ?????????????? ????????']);


        // $data = $request->except('_token');
        // $data['password'] = Hash::make($data['password']);
        // $emp = Employee::create($data);

        // return redirect()->route('employees.create')->with(['success' => '???? ?????????? ??????????']);
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'phone' => 'required',
                    'job_number' => 'required|unique:employees'

                ],
                [
                    'phone.required' => '?????????? ?????????? ?????? ????????????',
                    'job_number.rpequired' => '?????????? ?????????? ?????? ????????????',
                    'job_number.unique' => '?????? ?????????? ???? ???????????? ???? ??????'
                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return back()->with('error', $err_msg)->withInput();
            }
            $plan = Plan::first();

            $employees_count = Employee::count() + 1;
            if ($plan->count_employees < $employees_count)
                return back()->with(['error' => '?????? ???????? ?????? ???????????????? ???? ???????? ?????????????? ????????']);

            $data = $request->except('_token');
            // if($data['password']){
            //     $data['password'] = Hash::make($data['password']);
            // }
            $emp = Employee::create($data);
            return redirect()->route('employees.index')->with(['success' => '???? ?????????? ??????????']);
        } catch (Exception $e) {
            // return redirect()->back()->with(['error' => '???????? ?????? ?????????? ???????????????? ??????????']);
            return $e;
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        if (!Gate::allows('edit_employee')) {
            return abort(401);
        }
        $emp = Employee::find($id);
        $branches = Branch::all();
        $jobs = Job::all();
        return view('employees.edit', compact('emp', 'branches', 'jobs'));
    }


    public function update(Request $request, $id)
    {
        //
        try {
            $request->validate([
                'job_number' => 'required',
            ]);
            $emp = Employee::findOrFail($id);
            //update in db
            $emp->update($request->all());
            // $emp->update($request->all());
            return redirect()->route('employees.index')->with(['success' => '???? ?????????? ???????????? ??????????']);
        } catch (\Exception $ex) {
            return redirect()->route('employees.index')->with(['error' => '???????? ?????? ?????????? ???????????????? ??????????']);
        }
    }

    public function excelPage()
    {
        $branches = Branch::all();
        $jobs = Job::all();
        return view('employees.importexcel', compact('branches', 'jobs'));
    }


    public function import(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'required',
                'job_id' => 'required',
                'branch_id' => 'required',
            ],
            [
                'file.required' => "?????? ???????????? ?????? ?????????? ????????",
            ]

        );
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return back()->with('error', $err_msg)->withInput();
        }

        if ($request->file('file')->getClientOriginalExtension() != 'xlsx') {
            return back()->with('error', '(xlsx) ?????? ???? ???????? ??????????  ???? ?????? ??????????')->withInput();
        }
        $data =  Excel::toArray(new EmployeeImport, $request->file('file'));
        // ckeck if file is right
        $first_row = $data[0][0];
        if (
            $first_row[0] != 'job number' ||
            $first_row[1] != 'name' ||
            $first_row[2] != 'email' ||
            $first_row[3] != 'address' ||
            $first_row[4] != 'phone' ||
            $first_row[5] != 'password' ||
            $first_row[6] != 'gender (male - female)' ||
            $first_row[7] != 'age'
        ) {
            return back()->with('error', '???? ???????? ???? ???????????? ?? ?????????????? ?????? ???????????????? ?????????? ??????????????????')->withInput();
        }
        // if($data[0])

        $plan = Plan::first();
        $employees_count = Employee::count() + count($data[0]) - 1;
        if ($plan->count_employees < $employees_count)
            return back()->with(['error' => '?????? ???????? ?????? ???????????????? ???? ???????? ?????????????? ????????']);

        $emps = [];
        for ($i = 0; $i < count($data[0]); $i++) {
            $row = $data[0][$i];
            // skip first row
            if ($i == 0) continue;
            $emp = [
                'job_number' => $row[0],
                'name' => $row[1],
                'email' => $row[2],
                'address' => $row[3],
                'phone' => $row[4],
                'password' => $row[5] ? Hash::make($row[5]) : null,
                'gender' => $row[6],
                'age' => $row[7],
                'branch_id' => $request->branch_id,
                'job_id' => $request->job_id,
            ];
            array_push($emps, $emp);
        }
        try {
            Employee::insert($emps);
        } catch (\Exception $e) {
            return response()->json(['msg' => "?????? ?????? ????"], 400);
        }
        // return back();
        return redirect()->route('employees.index')->with('success', "???? ?????????? ???????????????? ??????????");
    }


    public function destroy($id)
    {
        try {
            $emp = Employee::findOrFail($id);
            $emp->attend_methods()->detach();
            $emp->requests()->delete();
            $deleted = $emp->delete();
            if (!$deleted) {
                return redirect()->route('employees.index')->with(['error' => '???????? ?????? ?????????? ???????????????? ??????????']);
            }
            return redirect()->route('employees.index')->with(['success' => '???? ?????? ???????????? ??????????']);
        } catch (\Exception $ex) {
            return redirect()->route('employees.index')->with(['error' => '???????? ?????? ?????????? ???????????????? ??????????']);
        }
    }

    public function toggleActiveAndLocked(Request $req)
    {
        $id = $req->id;
        $checked = $req->checked;
        $emp = Employee::find($id);
        if ($checked) {
            $emp[$req->type] = true;
        } else {
            $emp[$req->type] = false;
        }
        $emp->save();

        // if ($checked) {
        //     return response()->json([
        //         "msg" => "user " . $emp->name . " is active now",
        //     ]);
        // } else {
        //     return response()->json([
        //         "error" => "user " . $emp->name . " isn't active anymore",
        //     ]);
        // }

        return response()->json(['msg' => "???? ?????????????? ??????????"]);
    }

    public function downloadExcelEmployees()
    {
        $filepath = public_path('excel\Employees.xlsx');
        return Response()->download($filepath, 'employees.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ]);
    }

    public function getEmployeesByJob(Request $req)
    {
        $job_id = $req->job_id;
        if ($job_id) {
            if (auth()->user()->hasRole('super_admin')) {
                $employees = Employee::with('job')->where('job_id', $job_id)->get();
            } else {
                $employees = Employee::with('job')->where('branch_id', auth()->user()->branch_id)->where('job_id', $job_id)->get();
            }
        } else {
            if (auth()->user()->hasRole('super_admin')) {
                $employees = Employee::with('job')->get();
            } else {
                $employees = Employee::with('job')->where('branch_id', auth()->user()->branch_id)->get();
            }
        }
        return $employees;
    }

    public function edit_employee_attend_method($id)
    {
        if (!Gate::allows('edit_employee_attend_method')) {
            return abort(401);
        }
        $emp = Employee::find($id);
        $allattendmethod = Attendmethods::all();
        $attend_methods = $emp->attend_methods;
        return view('employees.edit_attendance_method', compact('emp', 'attend_methods', 'allattendmethod'));
    }

    public function store_employee_attend_method(Request $request, $id)
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
            return redirect()->route('employees.index')->with(['success' => '???? ?????????????? ??????????']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => '?????? ?????? ?????????? ????????????????']);
        }
    }

    function toggleAttendMethod(Request $req){
        $req->validate([
            'emp_id' => 'required',
            'method_id' => 'required',
        ]);

        $employee = Employee::find($req->emp_id);
        $employee->attend_methods()->toggle($req->method_id);
    }
    function getEmpAttendMethods(Request $req){
        $req->validate([
            'emp_id' => 'required',
        ]);

        return Employee::findOrFail($req->emp_id)->attend_methods;
    }
}
