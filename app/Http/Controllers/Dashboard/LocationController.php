<?php

namespace App\Http\Controllers\Dashboard;

use App\Branch;
use App\Device;
use App\Http\Controllers\Controller;
use App\Location;
use Exception;
use Illuminate\Http\Request;

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
        if (auth()->user()->hasRole('super_admin')) {
            $locations = Location::all();
        } else {
            $locations = Location::where('branch_id', auth()->user()->branch_id)->get();
        }
        // dd($locations);
        return view('locations\index', compact('locations'));
    }

    public function create()
    {
        if (!Gate::allows('add_location')) {
            return abort(401);
        }
        if (auth()->user()->hasRole('super_admin')) {
            $devices = Device::all();
            $branchs = Branch::all();
        } else {
            $devices = Device::all();
            $branchs = Branch::findOrfail(auth()->user()->branch_id);
            // dd($branchs);
        }
        return view('locations.create', compact('devices', 'branchs'));
    }

    public function store(Request $req)
    {
        try {
            $validator = Validator::make(
                $req->all(),
                [
                    'name' => 'required',
                    'branch_id' => 'required',
                    'location_address' => 'required',
                    'boundary_radius' => 'required|numeric',
                    'location_latitude' => 'required|numeric',
                    'location_longituide' => 'required|numeric',
                ],
                [
                    'name.required' => 'برجاء ادخال الاسم',
                    'branch_id.required' => 'برجاء اختيار الفرع',
                    'location_address.required' => 'برجاء ادخال العنوان',
                    'boundary_radius.required' => 'برجاء تحديد اقصي مسافه للحضور',
                    'location_latitude.required' => 'برجاء ادخال الاحدثيات العرض',
                    'location_longituide.required' => 'برجاء ادخال الاحدثيات الطول',
                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return response()->json(['msg' => $err_msg], 400);
            }

            $data = $req->except('devices');
            $location = new Location();
            $location->fill($data);
            $location->save();

            $devices = [];
            // save the devices
            foreach ($req->devices as $device) {
                array_push($devices , [
                    "code" => $device['code'] ?? '',
                    "ssid" => $device['ssid'] ?? '' ,
                    "bssid" => $device['bssid'] ?? '' ,
                    "type" => $device['type'],
                    "location_id" => $location->id,
                ]);
            }
            Device::insert($devices);
            return response()->json(['msg' => 'تم اضافة الموقع بنجاح'], 200);

        } catch (Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 400);
        }
    }
    public function destroy($id)
    {
        try {
            $location = Location::find($id);
            $delete = $location->delete();
            if (!$delete) {
                return redirect()->route('locations.index')->with(['error' => 'لا يمكن حذف الموقع لانه مستخدم']);
            } else {
                $location->devices()->delete();
                return redirect()->route('locations.index')->with(['success' => 'تم حذف الموقع بنجاح']);
            }
        } catch (Exception $e) {
            return redirect()->route('locations.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }

    public function edit($id)
    {
        if (!Gate::allows('edit_location')) {
            return abort(401);
        }
        $selected_branch = '';
        $location = Location::with(['devices' => function ($query) {
            $query->select('code', 'type' , 'ssid' , 'bssid' , 'location_id' );
        }])->find($id);
        if (auth()->user()->hasRole('super_admin')) {
            $selected_branch = Branch::find($location->branch_id);
            $branchs = Branch::all();
        } else {
            $branchs = Branch::findOrfail(auth()->user()->branch_id);
            // dd($branchs);
        }
        return view('locations.update', compact('location',  'branchs', 'selected_branch'));
    }
    public function update(Request $req, $id)
    {
        try {

            $validator = Validator::make(
                $req->all(),
                [
                    'name' => 'required',
                    'location_address' => 'required',
                    'branch_id' => 'required',
                    'boundary_radius' => 'required|numeric',
                    'location_latitude' => 'required|numeric',
                    'location_longituide' => 'required|numeric',
                ],
                [
                    'name.required' => 'برجاء ادخال الاسم',
                    'branch_id.required' => 'برجاء اختيار الفرع',
                    'location_address.required' => 'برجاء ادخال العنوان',
                    'boundary_radius.required' => 'برجاء تحديد اقصي مسافه للحضور',
                    'location_latitude.required' => 'برجاء ادخال الاحدثيات العرض',
                    'location_longituide.required' => 'برجاء ادخال الاحدثيات الطول',

                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return response()->json(['msg' => $err_msg], 400);

            }

            $data = $req->all();
            $location = Location::findOrFail($id);
            $location->update($data);

            $devices = $req->devices;
            // save the devices
            
            // return $devices;
            $location->devices()->delete();
            Device::insert($devices);
            return "success";
        } catch (Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 400);
        
        }
    }
    // will be called with ajax
    public function getLocationDevices(Request $req)
    {
        $id = $req->location_id;
        if (!$id) return 'no id provided';

        return Location::find($id)->devices;
    }
}
