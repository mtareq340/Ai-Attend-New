<?php

namespace App\Http\Controllers\Auth;

use App\CompanySettings;
use App\Http\Controllers\Controller;
use App\Plan;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Http;
use Jerry\JWT\JWT;

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

        // call api
        $base_url = 'http://127.0.0.1:5000';

        $payload = [
            'company_id' => env('COMPANY_ID')
        ];
        $jwt_token = JWT::basic_encode($payload , env('JWT_SECRET'));
       
        $response = Http::withHeaders([
            'access_token' =>  $jwt_token
        ])->get($base_url . '/api/getData');
        


        $alerts = $response['alerts'];
        $payment_detail = $response['payment_detail'];
        if (!$payment_detail) {
            Auth::logout();
            $request->session()->flash('msg', "sorry ,your subscription has expired .. contact sphinx company to renew your subscription");
            return redirect('/auth/login');
        }
        // check if company plan subscription is over
        $end_date = Carbon::parse($payment_detail['end_date']);
        if ($end_date->isPast()) {
            Auth::logout();
            $request->session()->flash('msg', "sorry ,your subscription has expired .. contact sphinx company to renew your subscription");
            return redirect('/auth/login');
        }


        $request->session()->flash('alerts', json_encode($alerts));
        $company_settings = CompanySettings::first();
        if (!$company_settings->registeration_num) {
            $company_settings->registeration_num = $payment_detail['company']['registration_num'];
            $company_settings->save();
        }

        $plan = Plan::first();
        $plan->start_date = $payment_detail['start_date'];
        $plan->end_date = $payment_detail['end_date'];
        $plan->number_days = $payment_detail['plan']['duration_days'];
        $plan->count_employees = $payment_detail['plan']['max_emp'];
        $plan->save();


        $agent = new Agent();
        // dd($agent->city());
        $details = [
            "device" => $agent->device(),
            "platform" => $agent->platform(),
            "browser" => $agent->browser(),
        ];
        $activity_log = [
            'user_id' => Auth::user()->id,
            'ip' => request()->getClientIp(),
            'datetime' =>  Carbon::now()->toDateTimeString(),
            'created_at' =>  Carbon::now()->toDateTimeString(),
            'updated_at' =>  Carbon::now()->toDateTimeString(),
            'details' => json_encode($details)
        ];



        DB::table('login_histories')->insert($activity_log);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('auth/login');
    }
}
