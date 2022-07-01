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

    public function index()
    {
        //
        // if (!Gate::allows('show_employees_request_review')) {
        //     return abort(401);
        // }
        if (auth()->user()->hasRole('super_admin')) {
            $requestreviews = Employee_Request_Review::all();
        } else {
            $requestreviews = DB::table('employees')->select('employee_request_review.id as reqid', 'employees.name as empname', 'request', 'employee_request_review.date as date')
                ->join('branches', 'branches.id', '=', 'employees.branch_id')
                ->join('employee_request_review', 'employee_request_review.employee_id', '=', 'employees.id')
                ->where('branches.id', auth()->user()->branch_id)->get();
            // dd($requestreviews);
        }
        return view('EmployeeRequestReview.index', compact('requestreviews'));
    }
    //apply Employee request
    public function make_reponse(Request $request, $id)
    {
        $request_types = RequestType::all();
        $request_review = Employee_Request_Review::find($id);
        // dd($user_id);
        return view('EmployeeRequestReview.EmployeeRequest.create', compact('request_types', 'request_review'));
    }




    //insert to Employee requests and delete from employee request reviews//

    public function store_reponse(Request $request)
    {
        try {
            $user_id = auth()->user()->id;
            $request_review = Employee_Request_Review::find($request->id);
            $validator = Validator::make(
                $request->all(),
                [
                    'type' => 'required',

                ],
                [
                    'type.required' => 'برجاء اختيار الرد',
                ]
            );
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return back()->with('error', $err_msg)->withInput();
            }
            $emp_request = [
                'employee_id' => $request_review->employee_id,
                'user_id' => $user_id,
                'request_type_id' => $request->type,
                'request' => $request_review->request,
                'date' => $request_review->date
            ];
            $saving = EmployeeRequest::create($emp_request);

            //delete from Employee Request Review//
            $request_review->delete();

            return redirect()->route('employee_request_review')->with(['success' => 'تم تسجيل']);
        } catch (Exception $e) {
            return back()->with(['error' => 'حدث مشكله برجاء المحاوله مره اخري']);
        }
    }
}
