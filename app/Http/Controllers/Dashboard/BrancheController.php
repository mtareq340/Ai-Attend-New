<?php

namespace App\Http\Controllers\Dashboard;

use App\Branch;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BrancheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (!Gate::allows('show_branches')) {
            return abort(401);
        }
        return view('branches.index_table', ['branches' => Branch::all()]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //this was added by using ajax call in the index view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'notes' => '',
            // 'long' => 'required|numeric',
            // 'lat' => 'required|numeric',
        ]);

        $branch = new Branch($data);
        $branch->save();
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
            if ($branch->can_delete) {
                //delete in db
                $branch->delete();
                return back()->with(['success' => 'تم حذف الفرع بنجاح']);
            } else {
                return back()->with(['error' => 'هذا الفرع يوجد عليه موظفين لا يمكن مسحه']);
            }
        } catch (\Exception $ex) {
            return back()->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }
}
