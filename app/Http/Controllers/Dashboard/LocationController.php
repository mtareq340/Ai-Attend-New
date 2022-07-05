<?php

namespace App\Http\Controllers\Dashboard;

use App\Device;
use App\Http\Controllers\Controller;
use App\Location;
use Exception;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (!Gate::allows('show_locations')) {
            return abort(401);
        }
        $locations = Location::all();
        // dd($locations);
        return view('locations\index', compact('locations'));
    }

    public function create()
    {
        if (!Gate::allows('add_location')) {
            return abort(401);
        }
        $devices = Device::where('active', 1)->get();
        return view('locations.create', compact('devices'));
    }

    public function store(Request $req)
    {
        try {
            $validator = Validator::make(
                $req->all(),
                [
                    'name' => 'required',
                    'device_id' => 'required',
                    'location_address' => 'required',
                    'distance' => 'required|numeric',
                    'location_latitude' => 'required|numeric',
                    'location_longituide' => 'required|numeric',
                ],
                [
                    'name.required' => 'برجاء ادخال الاسم',
                    'device_id.required' => 'برجاء تحديد الجهاز',
                    'location_address.required' => 'برجاء ادخال العنوان',
                    'distance.required' => 'برجاء تحديد اقصي مسافه للحضور',
                    'location_latitude.required' => 'برجاء ادخال الاحدثيات العرض',
                    'location_longituide.required' => 'برجاء ادخال الاحدثيات الطول',

                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return back()->with('error', $err_msg)->withInput();
            }

            $data = $req->all();
            // dd($data);
            Location::create($data);
            return redirect()->route('locations.index')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('locations.create')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }
    public function destroy($id)
    {
        try {
            $location = Location::find($id);
            $location->delete();
            return redirect()->route('locations.index')->with(['success' => 'تم خذدغ الموقع بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('locations.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }

    public function edit($id)
    {
        if (!Gate::allows('edit_location')) {
            return abort(401);
        }
        $devices = Device::all();
        $location = Location::find($id);
        $devicename = Device::find($location->device_id);

        return view('locations.update', compact('location', 'devices', 'devicename'));
    }
    public function update(Request $req, $id)
    {
        try {
            $validator = Validator::make(
                $req->all(),
                [
                    'name' => 'required',
                    'device_id' => 'required',
                    'location_address' => 'required',
                    'distance' => 'required|numeric',
                    'location_latitude' => 'required|numeric',
                    'location_longituide' => 'required|numeric',
                ],
                [
                    'name.required' => 'برجاء ادخال الاسم',
                    'device_id.required' => 'برجاء تحديد الجهاز',
                    'location_address.required' => 'برجاء ادخال العنوان',
                    'distance.required' => 'برجاء تحديد اقصي مسافه للحضور',
                    'location_latitude.required' => 'برجاء ادخال الاحدثيات العرض',
                    'location_longituide.required' => 'برجاء ادخال الاحدثيات الطول',

                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return back()->with('error', $err_msg)->withInput();
            }


            $data = $req->all();
            $location = Location::findOrFail($id);
            $location->update($data);
            return redirect()->route('locations.index')->with(['success' => 'تم تحديث الموقع بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('locations.edit')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }
}
