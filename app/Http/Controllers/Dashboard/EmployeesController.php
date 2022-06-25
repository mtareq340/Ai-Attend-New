<?php

namespace App\Http\Controllers\Dashboard;

use App\Branch;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Imports\EmployeeImport;
use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
        $employees = Employee::all();
        return view('employees.index' , compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $branches = Branch::all();
        $jobs = Job::all();
        return view('employees.add' , compact('branches' , 'jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);
        $emp = Employee::create($data);

        return redirect()->route('employees.create')->with(['success' => 'تم الحفظ بنجاح']);
        
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
        //
        $emp = Employee::FindOrFail($id);
        $branches = Branch::all();
        $jobs = Job::all();
        return view('employees.edit' , compact('emp' , 'branches' , 'jobs'));
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
        try{    
            $emp = Employee::findOrFail($id);

        //update in db
            $emp->update($request->all());
            return redirect()->route('employees.index')->with(['success' => 'تم تحديث المستخدم بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('employees.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
    }

    public function excelPage(){
        $branches = Branch::all();
        $jobs = Job::all();
        return view('employees.importexcel' , compact('branches' , 'jobs'));
    }


    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'file' => 'required',
                'job_id' => 'required',
                'branch_id' => 'required',
            ],
            [
                'file.required' => "يجب اختيار ملف اكسيل اولا" ,
                
            ]

        );
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return back()->with('error' , $err_msg)->withInput();
        }

        if($request->file('file')->getClientOriginalExtension() != 'xlsx'){
            return back()->with('error' , '(xlsx) يجب ان يكون الملف  من نوع اكسيل')->withInput();
        }
        $data =  Excel::toArray(new EmployeeImport, $request->file('file'));
        // ckeck if file is right
        $first_row = $data[0][0];
        if($first_row[0] != 'name' ||
            $first_row[1] != 'email' ||
            $first_row[2] != 'address' ||
            $first_row[3] != 'phone' ||
            $first_row[4] != 'password' ||
            $first_row[5] != 'gender (male - female)' ||
            $first_row[6] != 'age'
        ){
            return back()->with('error' , 'من فضلك قم بتحميل و استخدام ملف الايكسيل الموفر أسفل الصفحة')->withInput();
        }
        // if($data[0])
        
        $emps = [];
        for ($i = 0; $i < count($data[0]); $i++) {
            $row = $data[0][$i];
            // skip first row
            if ($i == 0) continue;
            $emp = [
                'name' => $row[0],
                'email' => $row[1],
                'address' => $row[2],
                'phone' => $row[3],
                'password' => $row[4],
                'gender' => $row[5],
                'age' => $row[6],
                'branch_id' => $request->branch_id,
                'job_id' => $request->job_id,
            ];
            array_push($emps, $emp);
        }
        try {
            Employee::insert($emps);
        } catch (\Exception $e) {
            return response()->json(['msg' => "حدث خطا ما"] , 400);
        }
        // return back();
        return redirect()->route('employees.index')->with('success' , "تم اضافة الموظفين بنجاح");
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $emp = Employee::findOrFail($id);
            //delete in db
            $emp->delete();
            return redirect()->route('employees.index')->with(['success' => 'تم حذف الموظف بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('employees.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

    public function toggleActiveAndLocked(Request $req)
    {
        $id = $req->id;
        $checked = $req->checked;
        $emp = Employee::find($id);
        if ($checked) {
            $emp[$req->type] = true;
        } else {
            $emp[$req->type] = false;
        }
        $emp->save();

        // if ($checked) {
        //     return response()->json([
        //         "msg" => "user " . $emp->name . " is active now",
        //     ]);
        // } else {
        //     return response()->json([
        //         "error" => "user " . $emp->name . " isn't active anymore",
        //     ]);
        // }

        return response()->json(['msg' => "تم التعديل بنجاح"]);
    }

    public function downloadExcelEmployees(){
        $filepath = public_path('excel\Employees.xlsx');
        return Response()->download($filepath,'employees.xlsx',[
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ]);
    }
}
