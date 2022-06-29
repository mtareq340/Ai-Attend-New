<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Role;
use App\Branch;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Gate::allows('show_users')) {
            return abort(401);
        }
        $users = User::where('branch_id', auth()->user()->branch_id)->get();
        return view('users/index', compact('users'));
    }

    public function create()
    {
        if (!Gate::allows('add_user')) {
            return abort(401);
        }
        $roles = Role::all();
        $branches = Branch::all();
        return view('users.add', compact('roles', 'branches'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                "email" => "required|email|unique:users",
                "address" => "required",
                "phone" => "required",
                "password" => "required",
                "role_id" => "required",
                "branch_id" => "required",
            ],
            [
                'name.required' => "يجب ادخال اسم المستخدم",
                "email.required" => 'يجب ادخال الايميل',
                "email.email" => 'الايميل يجب ان يكون ايميل',
                "address.required" => 'العنوان مطلوب',
                "phone.required" => 'الهاتف مطلوب',
                "password.required" => 'كلمة المرور مطلوبة',
                "role_id.required" => 'الوظيفة مطلوبة',
                "branch_id.required" => 'الفرع مطلوب',
            ]
        );

        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return back()->with('error', $err_msg)->withInput();
        }

        $data = $request->except(['password']);
        $data['password'] = bcrypt($request->password);
        $role = Role::where('id', $request->role_id)->first();
        $data['user_type'] = $role->name;

        $user = User::create($data);
        // attach user role
        $user->attachRole($request->role_id);
        return redirect()->route('users.index')->with(['success' => 'تم الحفظ بنجاح']);

        return view('users.add');
    }

    public function edit(Request $resuest, $id)
    {
        if (!Gate::allows('edit_user')) {
            return abort(401);
        }
        $user = User::FindOrFail($id);
        // return $user->roles;
        $branches = Branch::all();

        $roles = Role::all();

        return view('users.edit', compact('user', 'roles', 'branches'));
    }

    public function update(Request $request, $id)
    {
        // try{

        $user = User::findOrFail($id);
        //update in db
        $user->update($request->all());

        // sync roles
        $user->syncRoles([$request->role_id]);

        return redirect()->route('users.index')->with(['success' => 'تم تحديث المستخدم بنجاح']);

        // }catch(\Exception $ex){
        //     return redirect()->route('users.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        // }

    }

    public function destroy($id)
    {

        try {
            $user = User::find($id);

            if (Auth::id() == $user->id) {
                return back()->with('error', "لا يمكن ان تمسح حسابك");
            }
            $user->syncRoles([]); //delete relations in user_role table

            //delete in db

            // $user->delete();
            DB::table('users')->delete($user->id);

            return redirect()->route('users.index')->with(['success' => 'تم حذف الموظف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('users.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }
}
