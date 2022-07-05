<?php

namespace App\Http\Controllers\Dashboard;

use App\Branch;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\CompanySettings;
use App\Plan;
use Carbon\Carbon;
use App\EmployeeRequest;
use App\Employee_Request_Review;
use DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $users_count = User::count();
        $employess_count = Employee::count();
        $branches_count = Branch::count();
        $jobs_count = Job::count();

        $companySettings = CompanySettings::first();
        $empRequestsRevs = Employee_Request_Review::latest()->take(10)->get();
        $plan = Plan::where('id', $companySettings->plan_id)->first();

        $startDate = Carbon::parse($companySettings->registeration_date);
        $endDate = $startDate->addDays($plan->number_days);

        $datework = Carbon::createFromDate($endDate);
        $now = Carbon::now();
        $diffDays = $datework->diffInDays($now);

        $percentDays =  ($diffDays / $plan->number_days) * 100;
        $percentDays = number_format($percentDays, 2);

        $loginHistories = DB::table('login_histories')->where('user_id', auth()->user()->id)->latest()->take(20)->get();

        return view('dashboard' , compact('users_count' , 'employess_count' , 'branches_count'
        ,'jobs_count', 'percentDays', 'plan', 'empRequestsRevs', 'loginHistories'
    ));
    }
}
