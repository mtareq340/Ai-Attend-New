<?php

namespace App\Http\Controllers\Dashboard;

use App\AttendenceSettings;
use App\CompanySettings;
use App\Http\Controllers\Controller;
use App\Vication;
use App\Week_Day;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class CompanySettingsController extends Controller
{
    public function index()
    {
        if(auth()->user()->hasRole('super_admin')){
            $company_settings = CompanySettings::first();
            return view('settings.company-settings', compact('company_settings'));
        }else{
            return abort(401);
        }

    }

    public function update(Request $req, $id)
    {
        //
        try {
            $validator = Validator::make(
                $req->all(),
                [
                    'phone' => 'required',

                ],
                [
                    'phone.required' => 'برجاء ادخال رقم جوال الشركه',

                ]
            );
            $data = $req->all();
            $settings = CompanySettings::first();
            $settings->update($data);

            return back()->with('success', 'تم نحديث البيانات بنجاح');
        } catch (Exception $e) {
            return back()->with('error', 'حدث خطأ ما قم بالمحاولة لاحقا');
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
        //
    }

    public function uploadCover(Request $request)
    {

        if ($request->cover) {
            $img = $request->cover;
            $folderPath = "assets/images/"; //path location
            $imageName = 'cover.jpg';
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            file_put_contents($folderPath . $imageName, $image_base64);

            $settings = CompanySettings::first();
            $settings->background = $imageName;
            $settings->save();
            return response()->json(['msg' => 'تم تعديل صورة الخلفية']);
        }
    }

    public function uploadLogo(Request $request)
    {
        $img = $request->logo;
        $folderPath = "assets/images/"; //path location
        $imageName = 'logo.jpg';
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        file_put_contents($folderPath . $imageName, $image_base64);

        $settings = CompanySettings::first();
        $settings->logo = $imageName;
        $settings->save();

        return back()->with('success', 'تم تعديل اللوجو بنجاح');
    }

    public function addvication(Request $request)
    {
        try {
            $input['days'] = $request->input('days');
            $list_of_days = implode(',', $input['days']);
            // dd($list_of_days);
            $data = CompanySettings::first();
            // dd($data);
            $data->update([
                'vication_days' => $list_of_days
            ]);
            return back()->with('success', 'تم اضافه اجازه');
        } catch (Exception $e) {
            return $e;
        }
    }

    public function resetLogo(Request $req){
        $settings = CompanySettings::first();
        $settings['logo'] = null;
        $settings->save();
        return back()->with('success', 'تم اعادة ضبط اللوجو بنجاح');
    }

}
