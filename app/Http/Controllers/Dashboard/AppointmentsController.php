<?php

namespace App\Http\Controllers\Dashboard;

use App\Appointment;
use App\Branch;
use App\Http\Controllers\Controller;
use App\Location;
use Exception;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    //
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
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
                'delay_min' => 'required',
                'delay_hour' => 'required',
                'overtime_min' => 'required',
                'overtime_hour' => 'required',
                'date' => 'required',
            ]);
            // return ($request->all());
            $data = $request->all();
            $appoint = Appointment::create($data);
            return redirect()->route('appointment.create')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('appointment.create')->with(['error' => 'حذث خطا برجاء المحاوله مره اخري']);
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
                'delay_min' => 'required',
                'delay_hour' => 'required',
                'overtime_min' => 'required',
                'overtime_hour' => 'required',
                'date' => 'required',
            ]);
            // return ($request->all());
            $data = $request->all();
            $appoint = Appointment::find($id);
            $appoint->update($data);
            return redirect()->route('appointment.index')->with(['success' => 'تم التحديث بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('appointment.edit')->with(['error' => 'حذث خطا برجاء المحاوله مره اخري']);
        }
    }
}
