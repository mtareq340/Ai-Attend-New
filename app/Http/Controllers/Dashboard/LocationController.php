<?php

namespace App\Http\Controllers\Dashboard;

use App\Branch;
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
        if (auth()->user()->hasRole('super_admin')) {
            $devices = Device::where('active', 1)->get();
            $branchs = Branch::all();
        } else {
            $devices = Device::where('active', 1)->get();
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
                    'devices' => 'required',
                    'location_address' => 'required',
                    'distance' => 'required|numeric',
                    'location_latitude' => 'required|numeric',
                    'location_longituide' => 'required|numeric',
                ],
                [
                    'name.required' => 'برجاء ادخال الاسم',
                    'branch_id.required' => 'برجاء اختيار الفرع',
                    'devices.required' => 'برجاء تحديد الجهاز/الأجهزة',
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
            $location = new Location();
            $location->fill($data);
            $location->save();
            $location->devices()->attach($req->devices);

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
        $selected_branch = '';
        $location = Location::find($id);
        if (auth()->user()->hasRole('super_admin')) {
            $devices = Device::where('active', 1)->get();
            $selected_branch = Branch::find($location->branch_id);
            $branchs = Branch::all();
            $devicename = Device::find($location->device_id);
        } else {
            $devices = Device::where('active', 1)->get();
            $branchs = Branch::findOrfail(auth()->user()->branch_id);
            $devicename = Device::find($location->device_id);
            // dd($branchs);
        }
        return view('locations.update', compact('location', 'devices', 'devicename', 'branchs', 'selected_branch'));
    }
    public function update(Request $req, $id)
    {
        try {

            $validator = Validator::make(
                $req->all(),
                [
                    'name' => 'required',
                    'devices' => 'required',
                    'location_address' => 'required',
                    'branch_id' => 'required',
                    'distance' => 'required|numeric',
                    'location_latitude' => 'required|numeric',
                    'location_longituide' => 'required|numeric',
                ],
                [
                    'name.required' => 'برجاء ادخال الاسم',
                    'devices.required' => 'برجاء تحديد الجهاز/الأجهزة',
                    'branch_id.required' => 'برجاء اختيار الفرع',
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


            $data = $req->except('devices');
            $location = Location::findOrFail($id);
            $location->update($data);
            $location->devices()->sync($req->devices);
            return redirect()->route('locations.index')->with(['success' => 'تم تحديث الموقع بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('locations.edit')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
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
