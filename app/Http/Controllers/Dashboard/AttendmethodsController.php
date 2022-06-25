<?php

namespace App\Http\Controllers\Dashboard;

use App\Attendmethods;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendmethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* 
            return view in path view/attend_methods/index.blade.php        
        */
        $attend_methods  = Attendmethods::all();
        return view('attend_methods.index', compact('attend_methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
            return view in path view/jobs/create.blade.php
        */
        return view('attend_methods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Save The Request Into DataBase 
        $data = $request->all();
        $attend_methods = Attendmethods::create($data);
        return redirect()->route('attend_methods.index')->with(['success' => 'تم الحفظ بنجاح']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendmethods  $attendmethods
     * @return \Illuminate\Http\Response
     */
    public function show(Attendmethods $attendmethods)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendmethods  $attendmethods
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attend_methods = Attendmethods::FindOrFail($id);
        return view('attend_methods.update', compact('attend_methods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendmethods  $attendmethods
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $attend_methods= Attendmethods::findOrFail($id);

            //update in db
            $attend_methods->update($request->all());
            return redirect()->route('attend_methods.index')->with(['success' => 'تم تحديث المستخدم بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('attend_methods.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendmethods  $attendmethods
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $attend_methods = Attendmethods::find($id);

            $attend_methods->delete();
            return redirect()->route('attend_methods.index')->with(['success' => 'تم حذف الحضور بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('attend_methods.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }
}
