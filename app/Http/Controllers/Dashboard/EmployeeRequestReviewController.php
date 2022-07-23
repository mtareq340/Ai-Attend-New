<?php

namespace App\Http\Controllers\Dashboard;

use App\Employee;
use App\Employee_Request_Review;
use App\EmployeeRequest;
use App\Http\Controllers\Controller;
use App\RequestType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeeRequestReviewController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $req)
    {
        //
        // if (!Gate::allows('show_employees_request_review')) {
        //     return abort(401);
        // }
        if (auth()->user()->hasRole('super_admin')) {
            if ($req->status) {
                $requestreviews = Employee_Request_Review::where('status', $req->status)->get();
            } else {
                $requestreviews = Employee_Request_Review::all();
            }
        } else {
            $requestreviews = Employee_Request_Review::whereHas('employee', function ($q) {
                $q->where('branch_id', auth()->user()->branch_id);
            });
            if ($req->status) {
                $requestreviews = $requestreviews->where('status', $req->status);
            }
            $requestreviews = $requestreviews->get();
        }
        return view('employeerequestreview.index', compact('requestreviews'));
    }
    //apply Employee request
    public function make_reponse(Request $request, $id)
    {
        // $request_types = RequestType::all();
        $request_review = Employee_Request_Review::find($id);
        // dd($user_id);
        return view('employeerequestreview.employeerequest.create', compact('request_review'));
    }

    //insert to Employee requests and delete from employee request reviews//

    // public function store_reponse(Request $request)
    // {
    //     try {
    //         $user_id = auth()->user()->id;
    //         $request_review = Employee_Request_Review::find($request->id);
    //         $validator = Validator::make(
    //             $request->all(),
    //             [
    //                 'type' => 'required',

    //             ],
    //             [
    //                 'type.required' => 'برجاء اختيار الرد',
    //             ]
    //         );
    //         if ($validator->fails()) {
    //             $err_msg = $validator->errors()->first();
    //             return back()->with('error', $err_msg)->withInput();
    //         }
    //         $emp_request = [
    //             'employee_id' => $request_review->employee_id,
    //             'user_id' => $user_id,
    //             'request_type_id' => $request->type,
    //             'request' => $request_review->request,
    //             'date' => $request_review->date
    //         ];
    //         $saving = EmployeeRequest::create($emp_request);

    //         //delete from Employee Request Review//
    //         $request_review->delete();

    //         return redirect()->route('employee_request_review')->with(['success' => 'تم تسجيل']);
    //     } catch (Exception $e) {
    //         return back()->with(['error' => 'حدث مشكله برجاء المحاوله مره اخري']);
    //     }
    // }

    public function accept_response(Request $request, $id)
    {
        try {
            $emp_request_review = Employee_Request_Review::find($id);
            $emp_request_review->status = 2;
            $emp_request_review->save();
            return redirect()->back()->with(['success' => 'تم التعديل بنجاح']);
        } catch (Exception $e) {
            return back()->with(['error' => 'حدثت مشكله برجاء المحاوله مره اخري']);
        }
    }

    public function reject_response(Request $request, $id)
    {
        try {
            $emp_request_review = Employee_Request_Review::find($id);
            $emp_request_review->status = 3;
            $emp_request_review->save();
            return redirect()->back()->with(['success' => 'تم التعديل بنجاح']);
        } catch (Exception $e) {
            return back()->with(['error' => 'حدثت مشكله برجاء المحاوله مره اخري']);
        }
    }
}
