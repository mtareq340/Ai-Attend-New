<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AttendenceSettings;
use App\CompanySettings;
use App\User;
use App\Week_Day;

class AttendenceSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendence_settings = AttendenceSettings::first();
        $week_days = Week_Day::all();
        return view('settings.attendence-settings', compact('attendence_settings', 'week_days'));
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
