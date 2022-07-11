<?php

namespace App\Http\Controllers\Dashboard;

use App\Branch;
use App\Branch_Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BrancheController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if (!Gate::allows('show_branches')) {
            return abort(401);
        }
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            return view('branches.index_table', ['branches' => Branch::all()]);
        } else {
            $branches =  Branch::where('id', $user->branch_id)->orWhere('parent_id', $user->branch_id)->get();
            return view('branches.index_table', ['branches' => $branches]);
        }
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => '',
            'address' => '',
            'notes' => '',
            // 'long' => 'required|numeric',
            // 'lat' => 'required|numeric',
        ]);


        $branch = new Branch($data);
        $branch->save();
        $data['branch_id'] = $branch->id;

        //add brnach_id in branch settings//
        Branch_Setting::create([
            'branch_id' => $data['branch_id'],
            'over_time_count' => '0'
        ]);
        ///////////////////////////////////
        // $AttendenceSettings = AttendenceSettings::create($data);
        // return $request->parent_id;
        if ($request->parent_id) {
            // $parent = Branch::find($request->parent_id);
            $branch->parent_id = $request->parent_id;
            $branch->save();
        }

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('edit_branch')) {
            return abort(401);
        }
        //
        $branch = Branch::find($id);
        return view('branches.edit', ['branch' => $branch]);
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
        try {
            $request->validate([
                'name' => 'required',
                'phone' => 'required|numeric',
                'address' => ''
            ]);
            $branch = Branch::findOrFail($id);
            //update in db
            $branch->update($request->all());
            return redirect()->route('branches.index', ['type' => 'table'])->with(['success' => 'تم تحديث الفرع بنجاح']);
        } catch (\Exception $ex) {
            return back()->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
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
        try {
            $branch = Branch::findOrFail($id);
            $deleted = $branch->delete();
            if (!$deleted) {
                return back()->with(['error' => 'هذا الفرع لا يمكن مسحه']);
            }
            $branch->branch_settings->delete();
            return back()->with(['success' => 'تم حذف الفرع بنجاح']);
        } catch (\Exception $ex) {
            return back()->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }
}
