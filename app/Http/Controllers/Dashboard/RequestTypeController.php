<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\RequestType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequestTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $types = RequestType::all();
        return view('EmployeeRequestReview.RequestType.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('EmployeeRequestReview.RequestType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required'
                ],
                [
                    'name.required' => 'the name field is required'
                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return back()->with('error', $err_msg)->withInput();
            }
            $data = $request->all();
            $saveing = RequestType::create($data);
            return redirect()->route('employee_request_type.create')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $e) {
            // return redirect()->route('employee_request_type.create')->with(['error' => 'حدث خطا برجاء المحاوله']);
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = RequestType::findOrFail($id);
        return view('EmployeeRequestReview.RequestType.edit', compact('types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required'
                ],
                [
                    'name.required' => 'the name field is required'
                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return back()->with('error', $err_msg)->withInput();
            }

            $data = $request->all();
            $request_type = RequestType::find($id);
            $request_type->update($data);
            return redirect()->route('employee_request_type.index')->with(['success' => 'تم التحديث بنجاح']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'حدث خطا برجاء المحاوله']);
            // return $e;
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
        try {
            $data = RequestType::findOrFail($id);
            //delete in db
            $data->delete();
            return back()->with(['success' => 'تم حذف النوع بنجاح']);
        } catch (\Exception $ex) {
            return back()->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }
}
