<?php

namespace App\Http\Controllers\Dashboard;

use App\CompanySettings;
use App\Http\Controllers\Controller;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountSettingsController extends Controller
{

    public function index()
    {

        $settings = CompanySettings::first();
        $user = Auth::user();

        return view('settings.index', compact('settings' , 'user'));
    }

    public function uploadCover(Request $request)
    {

        if($request->cover){

            
            $img = $request->cover;
            $folderPath = "assets/images/"; //path location
            $imageName = 'cover.jpg';
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            file_put_contents($folderPath.$imageName, $image_base64);

            $settings= CompanySettings::first();
            $settings->background = $imageName;
            $settings->save();
            return response()->json(['msg' => 'تم تعديل صورة الخلفية']);

        }
    }
    
    public function uploadLogo(Request $request){
        $request->validate([
            'logo' => 'mimes:jpeg,jpg,png|required|max:2048'
        ], [
            'logo.max:2048' => "يجب ان لا يكون حجم اللوجو اكبر من 2 ميجا"
        ]);

        $imageName = 'logo.jpg';
        request()->logo->move(public_path('assets/images'), $imageName);
        $settings= CompanySettings::first();
        $settings->logo = $imageName;
        $settings->save();

        return back()->with('success' , 'تم تعديل اللوجو بنجاح');


    }

    public function updateAll(Request $request){
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

    

    return back()->with('success' , 'تم تحديث البيانات بنجاح');

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
        return back()->with('success' , 'تم تحديث كلمة السر بنجاح');
    
    }


    public function update(Request $request, $id)
    {
    }
}
