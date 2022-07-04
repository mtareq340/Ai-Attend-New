<?php

namespace App\Http\Controllers\Dashboard;

use App\Branch;
use App\Branch_Setting;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class BranchSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            $request->validate([
                'over_time_count' => 'required|numeric'
            ]);
            //add Extra time to branch settings table//
            $branch_settings = Branch_Setting::find($id);
            $branch_settings->update([
                'branch_id' => auth()->user()->branch_id,
                'over_time_count' => $request->over_time_count
            ]);
            return redirect()->back()->with(['success' => 'تم تعديل عدد الساعات العمل الاضافيه بنجاح']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'حدث خطا برجاء المحاوله مره اخري']);
        }
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
}
