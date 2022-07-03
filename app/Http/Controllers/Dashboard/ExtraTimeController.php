<?php

namespace App\Http\Controllers\Dashboard;

use App\AttendenceSettings;
use App\Branch;
use App\Employee;
use App\ExtraTime;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ExtraTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('show_extra_time')) {
            abort(401);
        }
        $extras = ExtraTime::all();
        return view('extra_time.index', compact('extras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $branch_id = auth()->user()->branch_id;
        $branch = Branch::find($branch_id);
        $attendance_settings = AttendenceSettings::where('branch_id', $branch_id)->get();
        $employees = Employee::whereDoesntHave('extra_time')->where('branch_id', $branch_id)->get();
        return view('extra_time.create', compact('branch', 'attendance_settings', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'extra' => 'required|numeric',
                    'employee_id' => 'required',

                ],
                [
                    'extra.required' => 'برجاء ادخال عدد الساعات الاضافيه',
                    'employee_id.required' => 'برجاء اختيار الموظفين',
                ]
            );
            $extra_time = $request->extra;
            $branch_id = auth()->user()->branch_id;
            $attendance_settings = DB::table('attendance_settings')->select('id')->where('branch_id', '=', $branch_id)->first();
            // dd($attendance_settings);
            $employees = $request->employee_id;
            //save Employee data //
            $emplist = [];
            foreach ($employees as $emp) {
                array_push($emplist, [
                    'employee_id' => $emp,
                    'branch_id' => $branch_id,
                    'attendance_setting_id' => $attendance_settings->id,
                    'time_count' => $extra_time
                ]);
            }
            ExtraTime::insert($emplist);
            return redirect()->route('extra_time.create')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('extra_time.create')->with(['error' => 'حدث خطا']);
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
        try {
            $data = ExtraTime::findOrfail($id);
            $data->delete();
            return redirect()->route('extra_time.index')->with(['success' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('extra_time.index')->with(['error' => 'برجاء المحاوله مره اخري']);
            // return $e;
        }
    }
}
