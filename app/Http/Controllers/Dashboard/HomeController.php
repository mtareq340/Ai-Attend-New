<?php

namespace App\Http\Controllers\Dashboard;

use App\Branch;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $users_count = User::count();
        $employess_count = Employee::count();
        $branches_count = Branch::count();
        $jobs_count = Job::count();
        return view('dashboard' , compact('users_count' , 'employess_count' , 'branches_count'
        ,'jobs_count'
    ));
    }

}
