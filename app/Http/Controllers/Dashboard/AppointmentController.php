<?php

namespace App\Http\Controllers\Dashboard;

use App\Appointment;
use App\Attendance_Plan_Types;
use App\Branch;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Location;
use App\Device;
use App\Job;
use App\Plan_Attendance_Types;
use App\Week_Day;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
            return abort(400);
        }
        if (auth()->user()->hasRole('super_admin')) {
            $appointments = Appointment::latest()->get();
        } else {
            $appointments = Appointment::where('branch_id', '=', auth()->user()->branch_id)->get();
        }
        return view('appointments.index', compact('appointments'));
    }

    public function create(Request $req)
    {
        if (!Gate::allows('add_appointment')) {
            return abort(400);
        }
        $jobs = Job::all();
        if (auth()->user()->hasRole('super_admin')) {
            $employees = Employee::all();
            $branches = Branch::all();
            $attendance_plan_types = Attendance_Plan_Types::all();
        } else {
            $employees = Employee::where('branch_id', auth()->user()->branch_id)->get();
            $branches = Branch::find(auth()->user()->branch_id);
            $attendance_plan_types = Attendance_Plan_Types::all();
        }
        $days = Week_Day::all();
        return view('appointments.create', compact('branches', 'employees', 'jobs', 'days', 'attendance_plan_types'));
    }
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $validator = Validator::make(
                $data,
                [
                    'name' => 'required',
                    'date' => 'required',
                    'attendance_plan_type_id' => 'required',
                    'period_count' => 'required|in:1,2',
                    'start_from_period_1' => 'required',
                    'end_to_period_1' => 'required',
                    'delay_period_1' => 'required',

                    'overtime' => 'required',
                    'location_id' => 'required',
                    'branch_id' => 'required',

                    'attendance_days' => 'required',
                    'devices' => 'required',
                    'emps' => 'required',
                ],
                [
                    'name.required' => 'برجاء ادخال اسم الحضور',
                    'date.required' => "برجاء ادخال تاريخ بداية تطبيق الدوام",
                    'start_from_period_1.required' => 'برجاء اختيار وقت بداية الفترة الأولى',
                    'end_to_period_1.required' => 'برجاء اختيار وقت نهاية الفترة الأولى',
                    'delay_period_1.required' => 'برجاء اختيار الفترة المرنة للفترة الأولى',
                    'attendance_plan_type_id.required' => 'برجاء اختيار نوع خطه الدوام',

                    'overtime.required' => 'برجاء اختيار الوقت الاضافي',
                    'location_id.required' => 'برجاء اختيار الموقع',
                    'branch_id.required' => 'برجاء اختيار الفرع',
                    'attendance_days.required' => 'يجب اختيار على الاقل يوم عمل واحد',
                    'devices.required' => 'يجب اختيار على الاقل جهاز واحد',
                    'emps.required' => 'يجب اختيار على الاقل موظف واحد',

                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return response()->json(['msg' => $err_msg], 400);
            }

            // handle validation for selecting old Date

            if (Carbon::parse($request->date)->isPast()) {
                return response()->json(['msg' => 'هذا التاريخ غير مسموح'], 400);
            }


            $start_1 = Carbon::parse($request->start_from_period_1);
            $end_1 = Carbon::parse($request->end_to_period_1);



            // handle validation for selecting 2 periods
            if ($request->period_count == '2') {

                $start_2 = Carbon::parse($request->start_from_period_2);
                $end_2 = Carbon::parse($request->end_to_period_2);

                if (!$request->start_from_period_2) {
                    return response()->json(['msg' => 'برجاء اختيار وقت بداية الفترة الثانية'], 400);
                }
                if (!$request->end_to_period_2) {
                    return response()->json(['msg' => 'برجاء اختيار وقت نهاية الفترة الثانية'], 400);
                }
                if (!$request->delay_period_2) {
                    return response()->json(['msg' => 'برجاء اختيار الفترة المرنة للفترة الثانية'], 400);
                }


                if ($end_1->gt($start_2)) {
                    return response()->json(['msg' => 'يجب ان يكون وقت بدأ الفترة الثانية بعد وقت انتهاء الفترة الأولى'], 400);
                }

                if ($end_1->gt($start_2)) {
                    return response()->json(['msg' => 'يجب ان يكون وقت بداية الفترة الثانية بعد وقت نهاية الفترة الأولى'], 400);
                }
                if ($start_2->gt($end_2)) {
                    return response()->json(['msg' => 'يجب ان يكون وقت نهاية الفترة الثانية بعد وقت بداية الفترة الثانية'], 400);
                }
            }

            // handle validation for selecting time

            if ($start_1->gt($end_1)) {
                return response()->json(['msg' => 'يجب ان يكون وقت انتهاء الفترة الأولى بعد وقت بدأ الفترة الأولى'], 400);
            }


            $appointment = new Appointment($request->except(['period_count', 'attendance_days', 'devices', 'emps', 'date']));

            $appointment->fill([
                'attendance_days' => implode(',', $request->attendance_days),
                'branch_id' => $request->branch_id,
                'date' => Carbon::parse($request->date),
                'attendance_plan_type_id' => $request->attendance_plan_type_id
            ]);
            $appointment->save();

            // fill appointments devices
            $appointment->devices()->attach($request->devices);

            // foreach ($request->emps as $emp) {
            //     $emp = json_decode($emp);
            //     $assign_appointment = DB::table('assign_appointments')
            //         ->insert([
            //             'employee_id' => $emp->id, 'work_appointment_id' => $appointment->id,
            //             'job_id' => $emp->job_id, 'branch_id' => $request->branch_id, 'location_id' => $request->location_id
            //         ]);
            // }

            $emps = [];
            foreach ($request->emps as $emp) {
                $emp = json_decode($emp);
                array_push(
                    $emps,
                    [
                        'employee_id' => $emp->id,
                        'work_appointment_id' => $appointment->id,
                        'job_id' => $emp->job_id,
                        'branch_id' => $request->branch_id,
                        'location_id' => $request->location_id,
                        'over_time' => $appointment->overtime
                    ]
                );
            }
            $appointment->employees()->attach($emps);



            // fill appointments em ployees  
            return response()->json(['msg' => 'تم اضافة موعد الدوام بنجاح'], 200);
        } catch (Exception $e) {
            return response()->json(['msg' => 'حدث خطأ ما قم بالمحاولة مرة اخرى او اتصل بالشركة'], 500);
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
            return abort(400);
        }
        $jobs = Job::all();
        if (auth()->user()->hasRole('super_admin')) {
            $employees = Employee::all();
            $branches = Branch::all();
            $attendance_plan_types = Attendance_Plan_Types::all();
        } else {
            $employees = Employee::where('branch_id', auth()->user()->branch_id)->get();
            $branches = Branch::find(auth()->user()->branch_id);
            $attendance_plan_types = Attendance_Plan_Types::all();
        }
        $days = Week_Day::all();
        $appointment = Appointment::find($id);
        $attendance_plan_types = Attendance_Plan_Types::all();
        return view('appointments.edit', compact('employees', 'jobs', 'appointment', 'days', 'branches', 'attendance_plan_types'));
    }

    public function update(Request $request, $id)
    {
        try {

            $appointment = Appointment::find($id);

            $data = $request->all();
            $validator = Validator::make(
                $data,
                [
                    'name' => 'required',
                    // 'date' => 'required',
                    'attendance_plan_type_id' => 'required',
                    'period_count' => 'required|in:1,2',
                    'start_from_period_1' => 'required',
                    'end_to_period_1' => 'required',
                    'delay_period_1' => 'required',

                    'overtime' => 'required',
                    'location_id' => 'required',
                    'branch_id' => 'required',

                    'attendance_days' => 'required',
                    'devices' => 'required',
                    'emps' => 'required',
                ],
                [
                    'name.required' => 'برجاء ادخال اسم الحضور',
                    // 'date.required' => "برجاء ادخال تاريخ بداية تطبيق الدوام",
                    'attendance_plan_type_id.required' => 'برجاء اختيار نوع خطه الدوام',
                    'start_from_period_1.required' => 'برجاء اختيار وقت بداية الفترة الأولى',
                    'end_to_period_1.required' => 'برجاء اختيار وقت نهاية الفترة الأولى',
                    'delay_period_1.required' => 'برجاء اختيار الفترة المرنة للفترة الأولى',

                    'overtime.required' => 'برجاء اختيار الوقت الاضافي',
                    'location_id.required' => 'برجاء اختيار الموقع',
                    'branch_id.required' => 'برجاء اختيار الفرع',
                    'attendance_days.required' => 'يجب اختيار على الاقل يوم عمل واحد',
                    'devices.required' => 'يجب اختيار على الاقل جهاز واحد',
                    'emps.required' => 'يجب اختيار على الاقل موظف واحد',

                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return response()->json(['msg' => $err_msg], 400);
            }

            // handle validation for selecting old Date

            // if (Carbon::parse($request->date)->isPast()) {
            //     return response()->json(['msg' => 'هذا التاريخ غير مسموح'], 400);
            // }


            $start_1 = Carbon::parse($request->start_from_period_1);
            $end_1 = Carbon::parse($request->end_to_period_1);



            // handle validation for selecting 2 periods
            if ($request->period_count == '2') {

                $start_2 = Carbon::parse($request->start_from_period_2);
                $end_2 = Carbon::parse($request->end_to_period_2);

                if (!$request->start_from_period_2) {
                    return response()->json(['msg' => 'برجاء اختيار وقت بداية الفترة الثانية'], 400);
                }
                if (!$request->end_to_period_2) {
                    return response()->json(['msg' => 'برجاء اختيار وقت نهاية الفترة الثانية'], 400);
                }
                if (!$request->delay_period_2) {
                    return response()->json(['msg' => 'برجاء اختيار الفترة المرنة للفترة الثانية'], 400);
                }


                if ($end_1->gt($start_2)) {
                    return response()->json(['msg' => 'يجب ان يكون وقت بدأ الفترة الثانية بعد وقت انتهاء الفترة الأولى'], 400);
                }

                if ($end_1->gt($start_2)) {
                    return response()->json(['msg' => 'يجب ان يكون وقت بداية الفترة الثانية بعد وقت نهاية الفترة الأولى'], 400);
                }
                if ($start_2->gt($end_2)) {
                    return response()->json(['msg' => 'يجب ان يكون وقت نهاية الفترة الثانية بعد وقت بداية الفترة الثانية'], 400);
                }
            }

            // handle validation for selecting time

            if ($start_1->gt($end_1)) {
                return response()->json(['msg' => 'يجب ان يكون وقت انتهاء الفترة الأولى بعد وقت بدأ الفترة الأولى'], 400);
            }
            $appointment_data = $request->except(['devices', 'emps']);
            $appointment_data['attendance_days'] = implode(',', $request->attendance_days);
            $appointment_data['date'] = Carbon::parse($request->date);
            $appointment->update(
                $appointment_data
            );


            // fill appointments devices
            $appointment->devices()->sync($request->devices);

            $emps = [];
            foreach ($request->emps as $emp) {
                $emp = json_decode($emp);
                array_push(
                    $emps,
                    [
                        'employee_id' => $emp->id, 'work_appointment_id' => $appointment->id,
                        'job_id' => $emp->job_id, 'branch_id' => $request->branch_id, 'location_id' => $request->location_id
                    ]
                );
            }
            $appointment->employees()->sync($emps);
            return response()->json(['msg' => 'تم تحديث الدوام بنجاح'], 200);
        } catch (Exception $e) {
            return redirect()->route('appointment.edit')->with(['error' => 'حذث خطا برجاء المحاوله مره اخري']);
        }
    }

    public function getlocationfrombranch(Request $req)
    {
        $text = '';
        $branch_id = $req->branch_id;
        // $job_id  = $req->job_id;
        $locations =  location::where('branch_id', '=', $branch_id)->get();
        foreach ($locations as $location) {
            $text  .= "<option value = '$location->id'>" . $location->name . "</option>";
        }
        return $text;
    }

    // public function get_location_devices(Request $req)
    // {
    //     $text = '';
    //     $branch_id = $req->branch_id;
    //     // $job_id  = $req->job_id;
    //     $devices =  Device::where('branch_id', '=', $branch_id)->get();
    //     foreach ($devices as $d) {
    //         $text  .= "<option value = '$d->id'>" . $d->name . "</option>";
    //     }
    //     return $text;
    // }
}
