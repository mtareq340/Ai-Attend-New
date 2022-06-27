<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountSettingsController extends Controller
{

    public function index()
    {

        // get settings as key-value pair from the database
        $raw_settings = Setting::all();
        $settings = [];
        foreach ($raw_settings as $setting) {
            $settings[$setting->name] = $setting->value;
        }

        return view('settings.index', compact('settings'));
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

            $imageSetting = Setting::where('name' , 'image')->first();
            $imageSetting->value = $imageName;
            $imageSetting->save();
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
        $logoSetting = Setting::where('name' , 'logo')->first();
        $logoSetting->value = $imageName;
        $logoSetting->save();

        return back()->with('success' , 'تم تعديل اللوجو بنجاح');


    }

    public function updateAll(Request $request){
    $data = $request->validate(
        [
            'name' => 'required',
            "email" => "required|email",
            "phone" => "required",
        ]
    );

    Setting::where('name' , 'name')->update(['value' => $data['name']]);
    Setting::where('name' , 'email')->update(['value' => $data['email']]);
    Setting::where('name' , 'phone')->update(['value' => $data['phone']]);

    return back()->with('success' , 'تم تحديث البيانات بنجاح');

    }
    public function update(Request $request, $id)
    {
    }
}
