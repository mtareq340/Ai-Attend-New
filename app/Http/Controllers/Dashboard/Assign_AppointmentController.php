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

class Assign_AppointmentController extends Controller
{
    //
    public function index()
    {
        $appoints = Assign_Appointment::all();
        // dd($appoints);
        return view('assign_appointments.index', compact('appoints'));
    }

    public function create()
    {
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
            $req->validate([
                'location_id' => 'required',
                'job_id' => 'required',
                'branch_id' => 'required',
                'work_appointment_id' => 'required',
                'employee_id' => 'required',
            ]);
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
            return redirect()->route('assign_appointment.create')->with(['error' => 'تم جدث خطا']);
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
        $employees = Employee::all();
        $locations = Location::all();
        $branchs = Branch::all();
        $appointments = Appointment::all();
        $jobs = Job::all();
        $assign = Assign_Appointment::find($id);
        return view('assign_appointments.edit', compact('employees', 'locations', 'branchs', 'appointments', 'jobs', 'assign'));
    }

    public function update(Request $req, $id)
    {
        try {
            $req->validate([
                'location_id' => 'required',
                'job_id' => 'required',
                'branch_id' => 'required',
                'work_appointment_id' => 'required',
                'employee_id' => 'required',
            ]);
            $assigns = Assign_Appointment::find($id);
            $assigns->update($req->all());
            return redirect()->route('assign_appointment.index')->with(['success' => 'تم تحديث الموقع بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('assign_appointment.edit')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }
}
