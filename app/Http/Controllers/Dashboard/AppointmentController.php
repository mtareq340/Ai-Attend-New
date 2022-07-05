<?php

namespace App\Http\Controllers\Dashboard;

use App\Appointment;
use App\Branch;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Location;
use App\Device;
use App\Job;
use App\Week_Day;
use Carbon\Carbon;
use DB;
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
            $appointments = Appointment::where('branch_id', '=', auth()->user()->branch_id)->get();
        }
        return view('appointments.index', compact('appointments'));
    }

    public function create(Request $req)
    {
        if (!Gate::allows('add_appointment')) {
            return abort(401);
        }
        $locations = Location::all();
        $jobs = Job::all();
        $devices = Device::all();
        if(auth()->user()->hasRole('super_admin')){
            $employees = Employee::all();
        }else{
            $employees = Employee::where('branch_id' , auth()->user()->branch_id)->get();
        }
        $days = Week_Day::all();
        return view('appointments.create', compact('locations','employees' , 'jobs' , 'days'));
    }
    public function store(Request $request)
    {
        // try {
            $data = $request->all(); 

            $validator = Validator::make(
                $data,
                [
                    'name' => 'required',
                    'date' => 'required',
                    'period_count' => 'required|in:1,2',
                    'start_from_period_1' => 'required',
                    'end_to_period_1' => 'required',
                    'delay_period_1' => 'required',

                    'overtime' => 'required',
                    'location_id' => 'required',

                    'attendence_days' => 'required',
                    'devices' => 'required',
                    'emps' => 'required',
                ],
                [
                    'name.required' => 'برجاء ادخال اسم الحضور',
                    'date.required' => "برجاء ادخال تاريخ بداية تطبيق الدوام",
                    'start_from_period_1.required' => 'برجاء اختيار وقت بداية الفترة الأولى',
                    'end_to_period_1.required' => 'برجاء اختيار وقت نهاية الفترة الأولى',
                    'delay_period_1.required' => 'برجاء اختيار الفترة المرنة للفترة الأولى',

                    'overtime.required' => 'برجاء اختيار الوقت الاضافي',
                    'location_id.required' => 'برجاء اختيار الموقع',

                    'attendence_days.required' => 'يجب اختيار على الاقل يوم عمل واحد',
                    'devices.required' => 'يجب اختيار على الاقل جهاز واحد',
                    'emps.required' => 'يجب اختيار على الاقل موظف واحد',

                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return back()->with('error', $err_msg)->withInput();
            }

            // handle validation for selecting old Date

            if(Carbon::parse($request->date)->isPast()){
            return back()->with('error', 'هذا التاريخ غير مسموح')->withInput();
        }
    

        $start_1 = Carbon::parse($request->start_from_period_1); 
        $end_1 = Carbon::parse($request->end_to_period_1); 
    

        // handle validation for selecting 2 periods
            if( $request->period_count == '2' ){

                $start_2 = Carbon::parse($request->start_from_period_2); 
                $end_2 = Carbon::parse($request->end_to_period_2); 

               if(!$request->start_from_period_2){
                    return back()->with('error', 'برجاء اختيار وقت بداية الفترة الثانية')->withInput();
                }
                if(!$request->end_to_period_2){
                    return back()->with('error', 'برجاء اختيار وقت نهاية الفترة الثانية')->withInput();
                }
                if(!$request->delay_period_2){
                    return back()->with('error', 'برجاء اختيار الفترة المرنة للفترة الثانية')->withInput();
                }
            

                if($end_1->gt($start_2)){
                    return back()->with('error', 'يجب ان يكون وقت بدأ الفترة الثانية بعد وقت انتهاء الفترة الأولى')->withInput();
                }
    
                if($end_1->gt($start_2)){
                    return back()->with('error', 'يجب ان يكون وقت بداية الفترة الثانية بعد وقت نهاية الفترة الأولى')->withInput();
    
                }
                if($start_2->gt($end_2)){
                    return back()->with('error', 'يجب ان يكون وقت نهاية الفترة الثانية بعد وقت بداية الفترة الثانية')->withInput();
                }
            
            }

     
            // handle validation for selecting time


          
            if($start_1->gt($end_1)){
                return back()->with('error', 'يجب ان يكون وقت انتهاء الفترة الأولى بعد وقت بدأ الفترة الأولى')->withInput();
            }
          
            
            $appointment = new Appointment($request->except(['period_count' , 'attendence_days' , 'devices' , 'emps' , 'date']));
            $appointment->fill([
                'attendence_days' => implode(',', $request->attendence_days),
                'branch_id' => auth()->user()->branch_id,
                'date' => Carbon::parse($request->date)
            ]);
            $appointment->save();

            // fill appointments devices
            $appointment->devices()->attach($request->devices);
            $employees = [];
            foreach ($request->emps as $emp) {
                $emp = json_decode($emp);
                $assign_appointment = DB::table('assign_appointments')
                ->insert(['employee_id' => $emp->id, 'work_appointment_id' => $appointment->id,
                'job_id' => $emp->job_id,'branch_id' => auth()->user()->branch_id,'location_id'=>$request->location_id]);
            }
            // fill appointments em ployees  
            return redirect()->route('appointment.index')->with(['success' => 'تم الحفظ بنجاح']);

        // } catch (Exception $e) {
            // return $e;
            // return redirect()->route('appointment.create')->with(['error' => 'حدث خطا برجاء المحاوله مره اخري']);
        // }
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
