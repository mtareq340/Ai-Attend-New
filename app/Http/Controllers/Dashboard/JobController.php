<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* 
            return view in path view/jobs/index.blade.php        
        */
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
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
        return view('jobs.create');
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
        $job = Job::create($data);

        return redirect()->route('jobs.index')->with(['success' => 'تم الحفظ بنجاح']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = job::FindOrFail($id);
        return view('jobs.update', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $job = Job::findOrFail($id);

            //update in db
            $job->update($request->all());
            return redirect()->route('jobs.index')->with(['success' => 'تم تحديث المستخدم بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('jobs.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
            Delete The Job Where id = id request
            And redirect -> with msg [  ]
        */
        try {
            $job = Job::find($id);

            $job->delete();
            return redirect()->route('jobs.index')->with(['success' => 'تم حذف الوظيفة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('jobs.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }
}
