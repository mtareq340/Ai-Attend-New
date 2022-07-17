<?php

namespace App\Http\Controllers\Dashboard;

use App\AttendenceSettings;
use App\Branch;
use App\Branch_Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class BrancheController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        // $location = json_encode($data);
        if (!Gate::allows('show_branches')) {
            return abort(401);
        }
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            return view('branches.index_table', ['branches' => Branch::orderBy('id', 'DESC')->get()]);
        } else {
            $branches =  Branch::where('id', $user->branch_id)->orWhere('parent_id', $user->branch_id)->orderBy('id', 'DESC')->get();
            return view('branches.index_table', ['branches' => $branches]);
        }
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            return view('branches.create', ['branches' => Branch::orderBy('id', 'DESC')->get()]);
        } else {
            $branches =  Branch::where('id', $user->branch_id)->orWhere('parent_id', $user->branch_id)->orderBy('id', 'DESC')->get();
            return view('branches.create', ['branches' => $branches]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:branches',
                'phone' => '',
                'address' => ''
            ],

            [
                'name.required' => "لا يجب ترك اسم الفرع فارغ",
                'name.unique' => "هذا الفرع تمت اضافته سابقا"
            ]
        );

        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return back()->with('error', $err_msg)->withInput();
        }
        $data = $request->except('_token');

        $branch = new Branch($data);
        $branch->save();
        $data['branch_id'] = $branch->id;

        //add brnach_id in branch settings//
        Branch_Setting::create([
            'branch_id' => $data['branch_id'],
            'over_time_count' => '0'
        ]);
        ///////////////////////////////////
        $AttendenceSettings = AttendenceSettings::create($data);

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


    public function update(Request $request, $id)
    {
        try {
            $branch = Branch::findOrFail($id);

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|unique:branches,name,' . $id,
                    'phone' => '',
                    'address' => ''
                ],

                [
                    'name.required' => "لا يجب ترك اسم الفرع فارغ",
                    'name.unique' => "هذا الفرع تمت اضافته سابقا"
                ]
            );

            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return back()->with('error', $err_msg)->withInput();
            }

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

    public function getBranchLocations(Request $req)
    {
        $id = $req->branch_id;
        if (!$id) return 'no id provided';

        return Branch::find($id)->locations;
    }
}
