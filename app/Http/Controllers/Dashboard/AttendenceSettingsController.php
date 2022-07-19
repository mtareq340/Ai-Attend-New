<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AttendenceSettings;
use App\Branch_Setting;
use App\CompanySettings;
use App\Employee;
use App\Employee_Attendance;
use App\Employee_Departure;
use App\User;
use App\Week_Day;
use Illuminate\Support\Facades\DB;

class AttendenceSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('super_admin')) {
            $week_days = Week_Day::all();
            // $week_days = DB::table('week_days')->select('id')->first();
            $days = [];
            $list_of_days = [];
            $attendence_settings = AttendenceSettings::first();
            $selected_vaction = CompanySettings::first();
            //get defalut extra time from company settings 
            $extra_time = Branch_Setting::where('branch_id', auth()->user()->branch_id)->get();
            // dd($extra_time);
            if ($selected_vaction->vication_days != NULL) {
                $selected_days = explode(',', $selected_vaction->vication_days);
                foreach ($week_days as $d) {
                    array_push($list_of_days, [
                        'id' => $d->id,
                        'days' => $d->days,
                        'selected' => in_array($d->id, $selected_days)
                    ]);
                }
                // $arr_dif1 = array_diff($days, $week_days);
                // $arr_dif2 = array_diff($week_days, $days);
                // $merger_diff = array_merge($arr_dif1, $arr_dif2);
                // dd($list_of_days);
            }
            return view('settings.attendence-settings', compact('attendence_settings', 'list_of_days', 'extra_time'));
        } else {
            return abort(401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    public function toggleAttendenceSettings(Request $req)
    {
        $checked = $req->checked;
        $branch_id = auth()->user()->branch_id;
        $settings = AttendenceSettings::where('branch_id', '=', $branch_id)->first();
        if ($checked) {
            $settings[$req->type] = true;
        } else {
            $settings[$req->type] = false;
        }
        $settings->save();

        return response()->json(['msg' => "تم التعديل بنجاح"]);
    }
}
