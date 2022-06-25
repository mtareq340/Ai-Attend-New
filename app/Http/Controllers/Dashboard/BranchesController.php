<?php

namespace App\Http\Controllers\Dashboard;

use App\Branch;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class BranchesController extends Controller
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
        try {
            if($request->type == 'table'){
                return view('branches.index_table', ['branches' => Branch::all()]);
            }
            $branches = Branch::withDepth()->with('ancestors')->get()->toTree();
            return view('branches.index', compact('branches'));

        } catch (Exception $exp) {
            Branch::fixTree();
        }
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
        if($request->parent_id ){
            // $parent = Branch::find($request->parent_id);
            $branch->parent_id = $request->parent_id;
            $branch->save();
        }
   
        return back()->with('success' , 'تم الحفظ بنجاح' );
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
        $branch = Branch::find($id);
        return view('branches.edit' , ['branch' => $branch]);
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
        try{    
            $branch = Branch::findOrFail($id);
            //update in db
            $branch->update($request->all());
            return redirect()->route('branches.index',['type' => 'table'])->with(['success' => 'تم تحديث الفرع بنجاح']);
        }catch(\Exception $ex){
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
        try{
            $branch = Branch::findOrFail($id);
            //delete in db
            $branch ->delete();
            // Branch::fixTree();
            return back()->with(['success' => 'تم حذف الفرع بنجاح']);

        }catch(\Exception $ex){
            return back()->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }
}
