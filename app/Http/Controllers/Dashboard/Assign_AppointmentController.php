<?php

namespace App\Http\Controllers\Dashboard;

use App\Appointment;
use App\Assign_Appointment;
use App\Branch;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Job;
use App\Location;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class Assign_AppointmentController extends Controller
{
 
    public function index()
    {
        if (!Gate::allows('show_assign_appointments')) {
            return abort(401);
        }
        $appoints = Assign_Appointment::all();
        // dd($appoints);
        return view('assign_appointments.index', compact('appoints'));
    }

    public function create()
    {
        if (!Gate::allows('add_assign_appointment')) {
            return abort(401);
        }
        $employees = Employee::all();
        $locations = Location::all();
        $branchs = Branch::all();
        $appointments = Appointment::all();
        $jobs = Job::all();
        $assigns = Assign_Appointment::all();

        return view('assign_appointments.create', compact('employees', 'locations', 'branchs', 'appointments', 'jobs', 'assigns'));
    }

    public function store(Request $req)
    {
        try {
            $validator = Validator::make(
                $req->all(),
                [
                    'location_id' => 'required',
                    'job_id' => 'required',
                    'branch_id' => 'required',
                    'work_appointment_id' => 'required',
                    'employee_id' => 'required',
                ],
                [
                    'location_id.required' => 'برجاء ادخال الموقع',
                    'job_id.required' => 'برجاء ادخال المسمي الوظيفي',
                    'branch_id.required' => 'برجاء ادخال الفرع',
                    'work_appointment_id.required' => 'برجاء ادخال خظه الحضور',
                    'employee_id.required' => 'برجاء ادخال اسم الموظف',
                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return back()->with('error', $err_msg)->withInput();
            }

            $employees = $req->employee_id;
            $location = $req->location_id;
            $job = $req->job_id;
            $branch = $req->branch_id;
            $appointment = $req->work_appointment_id;

            $emplist = [];
            foreach ($employees as $emp) {
                array_push($emplist, [
                    'employee_id' => $emp,
                    'work_appointment_id' => $appointment,
                    'job_id' => $job,
                    'branch_id' => $branch,
                    'location_id' => $location,
                ]);
            }
            // dd($emplist);
            Assign_Appointment::insert($emplist);
            return redirect()->route('assign_appointment.index')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('assign_appointment.create')->with(['error' => 'حدث خطا']);
        }
    }
    public function destroy($id)
    {
        try {
            $assign = Assign_Appointment::find($id);
            $assign->delete();
            return redirect()->route('assign_appointment.index')->with(['success' => 'تم خذدغ الموقع بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('assign_appointment.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }
    public function edit($id)
    {
        if (!Gate::allows('edit_assign_appointment')) {
            return abort(401);
        }
        $employees = Employee::all();

        $assign = Assign_Appointment::find($id);
        // get appointment from branch and location //
        $appointments = Appointment::where([['location_id', '=', $assign->location_id], ['branch_id', '=', $assign->branch_id]])->get();
        return view('assign_appointments.edit', compact('employees', 'appointments', 'assign'));
    }

    public function update(Request $req, $id)
    {
        try {
            $validator = Validator::make(
                $req->all(),
                [
                    'work_appointment_id' => 'required',

                ],
                [
                    'work_appointment_id.required' => 'برجاء ادخال خظه الحضور',

                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return back()->with('error', $err_msg)->withInput();
            }

            $assigns = Assign_Appointment::find($id);
            $data = [
                'employee_id' => $assigns->employee_id,
                'work_appointment_id' => $req->work_appointment_id,
                'job_id' => $assigns->job_id,
                'branch_id' => $assigns->branch_id,
                'location_id' => $assigns->location_id
            ];
            $assigns->update($data);
            return redirect()->route('assign_appointment.index')->with(['success' => 'تم تحديث خطه الحضور بنجاح']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
            // return $e;
        }
    }


    //function to get employees filtering from branch and job

    public function getemployees(Request $req)
    {
        $text = '';
        $branch_id = $req->branch_id;
        $job_id  = $req->job_id;
        $emps =  Employee::where([['job_id', '=', $job_id], ['branch_id', '=', $branch_id]])->get();
        foreach ($emps as $e) {
            $text  .= "<option value = '$e->id'>" . $e->name . "</option>";
        }
        return $text;
    }

    //function to get appointment filtering from location
    public function getappointment(Request $req)
    {
        try {
            $location_id = $req->location_id;
            $branch_id = $req->branch_id;
            $option = '';
            $appointment = Appointment::where([['location_id', '=', $location_id], ['branch_id', '=', $branch_id]])->get();
            foreach ($appointment as $a) {
                $option  .= "<option value = '$a->id'>" . $a->name . "</option>";
            }
            return $option;
        } catch (Exception $e) {
            return $e;
        }
    }

    // update overtime to employee
    public function update_over_time(Request $request)
    {
        try {
            $assign_appointment = Assign_Appointment::find($request->assign_appointment_id);
            $over_time =  $request->over_time;
            $assign_appointment->update(['over_time' => $over_time]);
            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'حدثت مشكله برجاء المحاوله مره اخري']);
        }
    }
}
