<?php

namespace App\Http\Controllers\Dashboard;

use App\Employee_Departure;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeesDepartureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (auth()->user()->hasRole('super_admin')) {
            $employees_departure = Employee_Departure::all();
        } else {
            $employees_departure = Employee_Departure::where('branch_id', auth()->user()->branch_id)->get();
        }
        return view('employees_departure.index', compact('employees_departure'));
    }

    public function make_employees_departure_success(Request $request)
    {
        $employees_departure = $request->employees_departure;
        Employee_Departure::whereIn('id', $employees_departure)->update(['state' => 1]);
        return redirect()->back()->with(['success' => 'تم التحديث']);
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
}
