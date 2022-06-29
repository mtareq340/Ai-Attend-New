<?php

namespace App\Http\Controllers\Dashboard;

use App\Appointment;
use App\Branch;
use App\Http\Controllers\Controller;
use App\Location;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AppointmentController extends Controller
{
    //
    public function index()
    {
        if (!Gate::allows('show_appointments')) {
            return abort(401);
        }
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        if (!Gate::allows('add_appointment')) {
            return abort(401);
        }
        $branches = Branch::all();
        $locations = Location::all();
        return view('appointments.create', compact('branches', 'locations'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'location_id' => 'required',
                'branch_id' => 'required',
                'start_from' => 'required',
                'end_to' => 'required',
                'delay' => 'required',
                'overtime' => 'required',
                'date' => 'required',
            ]);

            //split time first
            $delay = $request->delay;
            $delay_arr = explode(':', $delay);
            $delayhour = $delay_arr[0];
            $delaymin = $delay_arr[1];
            $overtime = $request->overtime;
            $overtime_arr = explode(":", $overtime);
            $overtimehour = $overtime_arr[0];
            $overtimemin = $overtime_arr[1];

            //save in appointment //
            $location = $request->location_id;
            $branch = $request->branch_id;
            $start_date = $request->start_from;
            $end_date = $request->end_to;
            $delay_min = $delaymin;
            $delay_hour = $delayhour;
            $overtime_hour = $overtimehour;
            $overtime_min = $overtimemin;
            $date = $request->date;
            // dd($location);
            $appoint = Appointment::create([
                'location_id' => $location,
                'start_from' => $start_date,
                'end_to' => $end_date,
                'branch_id' => $branch,
                'delay_min' => $delay_min,
                'delay_hour' => $delay_hour,
                'overtime_hour' => $overtime_hour,
                'overtime_min' => $overtime_min,
                'date' => $date
            ]);
            return redirect()->route('appointment.create')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function destroy($id)
    {
        try {
            $appointment = Appointment::find($id);
            $appointment->delete();
            return redirect()->route('appointment.edit')->with(['success' => 'تم حذف الحضور بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('appointment.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }

    public function edit($id)
    {
        if (!Gate::allows('edit_appointment')) {
            return abort(401);
        }
        $appointment = Appointment::find($id);
        $branches = Branch::all();
        $locations = Location::all();
        return view('appointments.edit', compact('appointment', 'branches', 'locations'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'location_id' => 'required',
                'branch_id' => 'required',
                'start_from' => 'required',
                'end_to' => 'required',
                'delay' => 'required',
                'overtime' => 'required',
                'date' => 'required',
            ]);
            // return ($request->all());
            $delay = $request->delay;
            $delay_arr = explode(':', $delay);
            $delayhour = $delay_arr[0];
            $delaymin = $delay_arr[1];
            $overtime = $request->overtime;
            $overtime_arr = explode(":", $overtime);
            $overtimehour = $overtime_arr[0];
            $overtimemin = $overtime_arr[1];

            $location = $request->location_id;
            $branch = $request->branch_id;
            $start_date = $request->start_from;
            $end_date = $request->end_to;
            $delay_min = $delaymin;
            $delay_hour = $delayhour;
            $overtime_hour = $overtimehour;
            $overtime_min = $overtimemin;
            $date = $request->date;
            $appoint = Appointment::find($id);
            $appoint->update([
                'location_id' => $location,
                'start_from' => $start_date,
                'end_to' => $end_date,
                'branch_id' => $branch,
                'delay_min' => $delay_min,
                'delay_hour' => $delay_hour,
                'overtime_hour' => $overtime_hour,
                'overtime_min' => $overtime_min,
                'date' => $date
            ]);
            return redirect()->route('appointment.index')->with(['success' => 'تم التحديث بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('appointment.edit')->with(['error' => 'حذث خطا برجاء المحاوله مره اخري']);
        }
    }
}
