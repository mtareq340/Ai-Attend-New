<?php

use App\Http\Controllers\Api\EmployeesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
salah
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API! tarek
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Auth::routes();

/* Api Routes
   important default prefix => 'api' */

Route::group(['as' => 'api.', 'namespace' => 'Api'], function () {

    // Employees Apis
    Route::post('employees/employee_login', 'EmployeesController@employeeLogin'); // parameters ($email, $password)

    Route::post('employees/is_employee_phone_exist', 'EmployeesController@isEmployeePhoneExist'); // parameters ($phone)

    Route::get('employees/is_otp_true', 'EmployeesController@isOtpTrue'); // parameters ($otp)
    Route::patch('employees/reset_password', 'EmployeesController@resetPassword'); // parameters ($id,$password,$newpassword)
    Route::patch('employees/change_password', 'EmployeesController@changePassword'); // parameters ($id,$oldpassword,$newpassword)

    Route::get('employees/getData', 'EmployeesController@getData');
    Route::get('employee_requests/getData', 'EmployeeRequestController@getData');

    Route::post('employee/update', 'EmployeesController@employeeUpdate');
    Route::post('employee_requests/store', 'EmployeeRequestController@store');

    Route::get('employees/attend_methods', [EmployeesController::class, 'get_employee_attendenceMethods']);

    // Company Apis
    Route::get('company/get_settings', 'CompanySettingsController@getData'); // parameters ()

    // Attenance Methodd Apis
    Route::get('attend_methods/getData', 'AttendMethodController@getEmployeeAttenance');

    // employee attenance and departure
    Route::post('employees/set_employees_attenance', 'AttendanceController@set_employee_attendence');
    Route::post('employees/set_employees_departure', 'DepartureController@set_employee_departure');
});
