<?php

namespace App\Http\Controllers\Dashboard;

use App\Device;
use App\Http\Controllers\Controller;
use App\Location;
use Exception;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Driver\Driver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('show_devices')) {
            return abort(401);
        }
        /*
            return view in path view/devices/index.blade.php
        */
        $devices  = Device::all();
        return view('devices.index', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('add_device')) {
            return abort(401);
        }
        /*
            return view in path view/devices/create.blade.php
        */
        $locations = Location::all();
        return view('devices.create' ,compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'برجاء ادخال الاسم الجهاز',

            ]
        );
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return back()->with('error', $err_msg)->withInput();
        }
        // Save The Request Into DataBase
        $data = $request->all();
        // dd($data);
        $devices = Device::create($data);
        return redirect()->route('devices.index')->with(['success' => 'تم الحفظ بنجاح']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('edit_device')) {
            return abort(401);
        }
        $device = Device::FindOrFail($id);
        $locations = Location::all();

        return view('devices.update', compact('device' , 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required'
            ]);
            $devices = Device::findOrFail($id);

            //update in db
            $devices->update($request->all());
            return redirect()->route('devices.index')->with(['success' => 'تم تحديث الجهاز بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('devices.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $devices = Device::find($id);
            $delete = $devices->delete();
            //check if data is deleted or not
            if (!$delete) {
                return redirect()->route('devices.index')->with(['error' => 'لايمكن حذف هذا الجهاز لانه يتيع لموقع']);
            } else {
                return redirect()->route('devices.index')->with(['success' => 'تم الحذف بنجاح']);
            }
        } catch (Exception $ex) {
            return redirect()->route('devices.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }

    public function changeStatus(Request $req)
    {
        try {
            $id = $req->id;
            $checked = $req->checked;
            $device = Device::find($id);
            if ($checked) {
                $device[$req->type] = true;
            } else {
                $device[$req->type] = false;
            }
            $device->save();
            return response()->json(['msg' => "تم تحديث الجهاز بنجاح"]);
        } catch (Exception $e) {
        }
    }
}
