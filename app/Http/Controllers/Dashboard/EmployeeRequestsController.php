<?php

namespace App\Http\Controllers\Dashboard;

use App\Employee;
use App\employee_requests;
use App\EmployeeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Return view in path EmployeeRequests/index
        if (isset($request->request_type_id)) {
            $employee_requests = EmployeeRequest::where('request_type_id', $request->request_type_id)->get();
        } else {
            $employee_requests = EmployeeRequest::all();
        }
        return view('EmployeeRequestReview.EmployeeRequest.index', compact(
            'employee_requests'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\employee_requests  $employee_requests
     * @return \Illuminate\Http\Response
     */
    public function show(employee_requests $employee_requests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\employee_requests  $employee_requests
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $request_emp = employee_requests::FindOrFail($id);
        $emp         = Employee::FindOrFail($id);
        return view('EmployeeRequests.Accept', compact('request_emp', 'emp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\employee_requests  $employee_requests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            $emp = employee_requests::findOrFail($id);

            //update in db
            $emp->accepted = $request->accept;
            $emp->Action = 1;

            $emp->save();
            // $emp->update($request->accept);
            return redirect()->route('employee_requests.index')->with(['success' => 'تم تحديث المستخدم بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('employee_requests.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\employee_requests  $employee_requests
     * @return \Illuminate\Http\Response
     */
    public function destroy(employee_requests $employee_requests)
    {
        //
    }


    public function toggleActivationAccept(Request $req)
    {
        $id = $req->id;
        $checked = $req->checked;
        $emp = employee_requests::find($id);
        if ($checked) {
            $emp[$req->type] = true;
        } else {
            $emp[$req->type] = false;
        }
        $emp->save();

        return response()->json(['msg' => "تم التعديل بنجاح"]);
    }

    public function show_request_emp_info()
    {
        $employees  = Employee::all();
        return view("EmployeeRequests.Employee.index", compact('employees'));
    }

    public function get_new_request()
    {
        // Return view in path EmployeeRequests/index
        $employee_requests = employee_requests::where('Action', '=', '0')->get();
        return view('EmployeeRequests.index', compact(
            'employee_requests'
        ));
    }

    public function get_accept_request()
    {
        $employee_requests = employee_requests::where('accepted', '=', '1')->get();
        return view('EmployeeRequests.Accept_Request', compact(
            'employee_requests'
        ));
        // return view('EmployeeRequests.Accept_Request');
    }

    public function get_reject_request()
    {
        $employee_requests = employee_requests::where('accepted', '=', '0')->get();
        return view('EmployeeRequests.Reject', compact(
            'employee_requests'
        ));
        // return view('EmployeeRequests.Reject');   
    }
    public function show_request_emp_info_data($id)
    {

        $employees     = Employee::where('id', '=', $id)->first();
        $employee_request_reject = employee_requests::where('employee_id', '=', $id)
            ->where('accepted', '=', 0)
            ->get();

        $employee_request_accepted = employee_requests::where('employee_id', '=', $id)
            ->where('accepted', '=', 1)
            ->get();

        $count_request = employee_requests::where('employee_id', '=', $id)->count();
        $count_reject  = employee_requests::where('employee_id', '=', $id)
            ->where('accepted', '=', 0)
            ->count();

        $count_accepted  = employee_requests::where('employee_id', '=', $id)
            ->where('accepted', '=', 1)
            ->count();
        return view("EmployeeRequests.Employee.info_employee_req", compact(
            'employees',
            'employee_request_reject',
            'employee_request_accepted',
            'count_request',
            'count_reject',
            'count_accepted'
        ));
    }
}
