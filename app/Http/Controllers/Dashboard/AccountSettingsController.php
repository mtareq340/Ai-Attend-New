<?php

namespace App\Http\Controllers\Dashboard;

use App\AttendenceSettings;
use App\CompanySettings;
use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountSettingsController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('settings.account-settings', compact('user'));
    }


    public function updateAll(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'address' => '',
                "email" => "required|email",
                "phone" => "required",
            ]
        );
        $id = Auth::id();
        $user = User::find($id);
        $user->update($data);
        // Auth::user()->updateAll($data);



        return back()->with('success', 'تم تحديث البيانات بنجاح');
    }
    public function changePassword(Request $req)
    {
        $validated = $req->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:3',
            'confirm_new_password' => 'required'
        ]);
        $id = Auth::id();
        $user = User::find($id);

        //    check if password is right
        if (!Hash::check($validated['old_password'], $user->password)) {
            return back()->with('error', 'كلمة السر القديمة خاطئة');
        }

        if ($validated['new_password'] != $validated['confirm_new_password']) {
            return back()->with('error', 'كلمة السر غير متطابقة');
        }
        // change password
        $user->password = Hash::make($validated['new_password']);
        $user->save();
        return back()->with('success', 'تم تحديث كلمة السر بنجاح');
    }


    public function update(Request $request, $id)
    {
    }


    public function updateCompanySettings(Request $req)
    {
        try {
            $data = $req->all();
            $settings = CompanySettings::first();
            $settings->update($data);

            return back()->with('success', 'تم نحديث البيانات بنجاح');
        } catch (Exception $e) {
            return back()->with('error', 'حدث خطأ ما قم بالمحاولة لاحقا');
        }
    }
}
