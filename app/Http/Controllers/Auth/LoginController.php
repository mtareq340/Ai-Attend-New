<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Request $request)
    {
        $this->middleware('guest')->except('logout');
    }

  

    protected function authenticated(Request $request)
    {


        $agent = new Agent();
        // dd($agent->city());
        $details = [
            "device" => $agent->device(),
            "platform" => $agent->platform(),
            "browser" => $agent->browser(),
        ];
        $activity_log = [
            'user_id' => Auth::user()->id ,
            'ip' => request()->getClientIp(),
            'datetime' =>  Carbon::now()->toDateTimeString(),
            'created_at' =>  Carbon::now()->toDateTimeString(),
            'updated_at' =>  Carbon::now()->toDateTimeString(),
            'details' => json_encode($details)
        ];

    
    
        DB::table('login_histories')->insert($activity_log);

    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('auth/login');
      }
}
