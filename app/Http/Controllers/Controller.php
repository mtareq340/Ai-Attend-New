<?php

namespace App\Http\Controllers;

use App\CompanySettings;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $company_setting;
    public function __construct()
    {
        $this->company_setting = CompanySettings::all();
        View::share('company_setting', $this->company_setting);
    }
}
