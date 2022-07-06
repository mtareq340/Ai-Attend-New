<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct(){
    //     $this->middleware(['permission:show_roles'])->only('index');
    //     $this->middleware(['permission:create_role'])->only('create');
    //     $this->middleware(['permission:update_role'])->only('edit');
    //     $this->middleware(['permission:delete_role'])->only('destroy');

    // }
    public function index()
    {
        if (!Gate::allows('show_roles')) {
            return abort(401);
        }
        $roles = Role::latest()->get();
        $permissions = Permission::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('add_role')) {
            return abort(401);
        }
        // $permissions = $this->permessions_data();
        $permissions = Permission::latest()->get();
        return view('roles.add', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    "permissions" => "required",
                ],
                [
                    'name.required' => "يجب ادخال اسم الدور",
                    "permissions.required" => 'يجب اختيار على الاقل تصريح واحد'
                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return back()->with('error', $err_msg)->withInput();
            }


            $data = $request->only('name', 'notes');
            $role = Role::create($data);

            // assign permissions to the role
            $permissions = $request->permissions;
            foreach ($permissions as $p) {
                $role->attachPermission($p);
            }
            return redirect()->route('roles.index')->with('success', 'تم الحفظ بنجاح');
        } catch (\Exception $exp) {
            return back()->with('error', 'هناك خطأ برجاء المحاولة ثانيا');
        }
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
        if (!Gate::allows('edit_role')) {
            return abort(401);
        }
        //
        $role = Role::FindOrFail($id);
        $permissions = Permission::latest()->get();
        return view('roles.edit', compact('role', 'permissions'));
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
            $role = Role::findOrFail($id);
            $request->validate([
                'name' => 'required',
                "permissions" => "required",
            ]);
            //update in db
            $role->update($request->except('permissions'));
            $role->syncPermissions($request->permissions);

            return redirect()->route('roles.index')->with(['success' => 'تم تحديث المستخدم بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('roles.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
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
            $role = Role::findOrFail($id);
            if ($role->users->count() != 0) {
                return back()->with('error', 'لا يمكن مسح هذا الدور لان هناك موظفين عليه');
            }

            $role->permissions()->sync([]); // Delete relationship data
            $role->delete();

            return redirect()->route('roles.index')->with(['success' => 'تم حذف الدور بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('roles.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }

    public function permessions_data()
    {
        $permissions_data = [];

        $permissions = Permission::all();

        $current_name = null;
        $collection = [];

        $numItems = count($permissions);
        $i = 0;
        foreach ($permissions as $p) {
            if (!$current_name) {
                // first loob
                array_push($collection, $p);
            } elseif (substr($p->name, 0, 4) == $current_name) {
                array_push($collection, $p);
            } elseif (substr($p->name, 0, 4) != $current_name) {
                array_push($permissions_data, $collection);
                $collection = [];
                array_push($collection, $p);
            }
            if (++$i === $numItems) {
                array_push($permissions_data, $collection);
            }

            $current_name = substr($p->name, 0, 4);
        }
        return $permissions_data;
    }
}
