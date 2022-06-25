<?php

namespace App\Http\Controllers\Dashboard;

use App\Device;
use App\Http\Controllers\Controller;
use App\Location;
use Exception;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class LocationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $locations = Location::all();
        // dd($locations);
        return view('locations\index', compact('locations'));
    }

    public function create()
    {
        $devices = Device::all();
        return view('locations.create', compact('devices'));
    }

    public function store(Request $req)
    {
        try {
            $req->validate(
                [
                    'name' => 'required',
                    'device_id' => 'required',
                    'location_address' => 'required',
                    'distance' => 'required|numeric',
                    'location_latitude' => 'required|numeric',
                    'location_longituide' => 'required|numeric',
                ]
            );
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
        $devices = Device::all();
        $location = Location::find($id);
        $devicename = Device::find($location->device_id);

        return view('locations.update', compact('location', 'devices', 'devicename'));
    }
    public function update(Request $req, $id)
    {
        try {

            $req->validate(
                [
                    'name' => 'required',
                    'device_id' => 'required',
                    'location_address' => 'required',
                    'distance' => 'required|numeric',
                    'location_latitude' => 'required|numeric',
                    'location_longituide' => 'required|numeric',
                ]
            );
            $data = $req->all();
            $location = Location::findOrFail($id);
            $location->update($data);
            return redirect()->route('locations.index')->with(['success' => 'تم تحديث الموقع بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('locations.edit')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }
}
