<?php

namespace App\Http\Controllers\Dashboard;

use App\Appointment;
use App\Branch;
use App\Http\Controllers\Controller;
use App\Location;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    //
    public function index()
    {
        if (!Gate::allows('show_appointments')) {
            return abort(401);
        }
        if (auth()->user()->hasRole('super_admin')) {
            $appointments = Appointment::latest()->get();
        } else {
            $appointments = Appointment::where('branch_id', '=', auth()->user()->branch_id)->latest()->get();
        }
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        if (!Gate::allows('add_appointment')) {
            return abort(401);
        }
        // $branches = Branch::all();
        $branch = Branch::find(auth()->user()->branch_id);
        // dd($branch);
        $locations = Location::all();
        return view('appointments.create', compact('branch', 'locations'));
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'location_id' => 'required',
                    'start_from' => 'required',
                    'end_to' => 'required',
                    'delay' => 'required',
                    'overtime' => 'required',
                    'date' => 'required',
                ],
                [
                    'name.required' => 'برجاء ادخال اسم الحضور',
                    'location_id.required' => 'برجاء اختيار الموقع',
                    'start_from.required' => 'برجاء ادخال موعد بدء الدوام',
                    'end_to.required' => 'برجاءادخال موعد اتتهاء الدوام ',
                    'delay.required' => ' برجاء تحديد  عدد الساعات و الدقاءق للدوام',
                    'overtime.required' => 'برجاء تحديد عدد الساعات و الدقاءق للوفت العمل الاضافي',
                    'date.required' => ""
                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return back()->with('error', $err_msg)->withInput();
            }

            $delay = $request->delay;
            $overtime = $request->overtime;

            //save in appointment //
            $name = $request->name;
            $location = $request->location_id;
            $branch = auth()->user()->branch_id;
            $start_date = $request->start_from;
            $end_date = $request->end_to;
            $date = $request->date;
            $data = [
                'name' => $name,
                'location_id' => $location,
                'branch_id' => $branch,
                'start_from' => $start_date,
                'end_to' => $end_date,
                'delay' => $delay,
                'overtime' => $overtime,
                'date' => $date
            ];
            // dd($location);
            // return $request->all();
            // dd($request->delay, $request->overtime);
            $appoint = Appointment::create($data);
            return redirect()->route('appointment.index')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $e) {
            return $e;
            // return redirect()->route('appointment.create')->with(['error' => 'حدث خطا برجاء المحاوله مره اخري']);
        }
    }

    public function destroy($id)
    {
        try {
            $appointment = Appointment::find($id);
            $appointment->delete();
            return redirect()->route('appointment.edit')->with(['success' => 'تم حذف الحضور بنجاح']);
        } catch (\Exception $ex) {
            return $ex;
            // return redirect()->route('appointment.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }

    public function edit($id)
    {
        if (!Gate::allows('edit_appointment')) {
            return abort(401);
        }
        $appointment = Appointment::find($id);
        $branch = Branch::find(auth()->user()->branch_id);
        $locations = Location::all();
        return view('appointments.edit', compact('appointment', 'branch', 'locations'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'location_id' => 'required',
                    'start_from' => 'required',
                    'end_to' => 'required',
                    'delay' => 'required',
                    'overtime' => 'required',
                    'date' => 'required',
                ],
                [
                    'name.required' => 'برجاء ادخال اسم الحضور',
                    'location_id.required' => 'برجاء اختيار الموقع',
                    'start_from.required' => 'برجاء ادخال موعد بدء الدوام',
                    'end_to' => 'برجاءادخال موعد اتتهاء الدوام ',
                    'delay' => ' برجاء تحديد  عدد الساعات و الدقاءق للدوام',
                    'overtime' => 'برجاء تحديد عدد الساعات و الدقاءق للوفت العمل الاضافي',
                    'date' => ""
                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return back()->with('error', $err_msg)->withInput();
            }
            // return ($request->all());
            $delay = $request->delay;
            $overtime = $request->overtime;
            $name = $request->name;
            $location = $request->location_id;
            $branch = auth()->user()->branch_id;
            $start_date = $request->start_from;
            $end_date = $request->end_to;
            $date = $request->date;
            $appoint = Appointment::find($id);
            $appoint->update([
                'name' => $name,
                'location_id' => $location,
                'start_from' => $start_date,
                'end_to' => $end_date,
                'branch_id' => $branch,
                'delay' => $delay,
                'overtime' => $overtime,
                'date' => $date
            ]);
            return redirect()->route('appointment.index')->with(['success' => 'تم التحديث بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('appointment.edit')->with(['error' => 'حذث خطا برجاء المحاوله مره اخري']);
        }
    }
}
