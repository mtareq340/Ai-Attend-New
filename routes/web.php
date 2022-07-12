<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;



Auth::routes();




// Dashboard Routes
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {

  // home
  Route::get('/', 'Dashboard\HomeController@index');

  Route::resource('users', 'Dashboard\UserController');
  /*
        the List Of route name
        1- jobs.index    => return The View Path => Jobs/index.blade.php
        2- jobs.create   => return The View Path => Jobs/create.blade.php
        3- jobs.edit     => return The view Path => Jobs/Update.blade.php
        4- jobs.store    => Save   The Request Into DataBase
        6- jobs.update   => Update The Request Into DataBase
        5- jobs.destroy  => Delete The Data From Table Jobs
    */
  // branches
  Route::resource('plans', 'Dashboard\PlanController');
  Route::resource('jobs',               'Dashboard\JobController');
  Route::resource('attend_methods', 'Dashboard\AttendmethodController');
  Route::resource('devices',             'Dashboard\DeviceController');

  Route::get('locations/devices', 'Dashboard\LocationController@getLocationDevices')->name('getLocationDevices');
  Route::resource('locations', 'Dashboard\LocationController');
  // employees attend methods
  Route::resource('employees_attend_methods', 'Dashboard\EmployeeAttendMethodController');
  // branches
  Route::resource('branches', 'Dashboard\BrancheController');
  // employees (this order should remain the same)
  Route::get('employees/add-from-excel', 'Dashboard\EmployeeController@excelPage')->name('employees.excelPage');
  Route::patch('employees/activate', 'Dashboard\EmployeeController@toggleActiveAndLocked')->name('toggleActiveEmp');
  Route::post('employees/import', 'Dashboard\EmployeeController@import')->name('import_employees');
  Route::get('/employees/downloadexcel', 'Dashboard\EmployeeController@downloadExcelEmployees')->name('downloadExcelEmps');
  Route::get('/job_employees/get', 'Dashboard\EmployeeController@getEmployeesByJob')->name('getEmployeesByJob');
  Route::post('import', 'Dashboard\EmployeeController@import')->name('import_emp_post');
  Route::resource('employees', 'Dashboard\EmployeeController');
  // assign appointment route
  Route::resource('assign_appointment', 'Dashboard\Assign_AppointmentController');
  Route::get('getemployees', 'Dashboard\Assign_AppointmentController@getemployees')->name('getEmpsByBranch');
  Route::get('getappointment', 'Dashboard\Assign_AppointmentController@getappointment')->name('getappointment');
  // appointment //
  Route::resource('appointment', 'Dashboard\AppointmentController');

  // employees request
  Route::patch('employee_requests/activate', 'EmployeeRequestsController@toggleActivationAccept')->name('toggleActiveReqEmp');
  Route::get('employee_requests/info', 'EmployeeRequestsController@show_request_emp_info')->name("employee_requests.index.request");
  Route::get('employee_requests/info/{id}/data', 'EmployeeRequestsController@show_request_emp_info_data')->name('employee_requests.index.request.data');
  Route::resource('employee_requests', 'Dashboard\EmployeeRequestsController');
  //Employees request //
  Route::get('employee_request_review', 'Dashboard\EmployeeRequestReviewController@index')->name('employee_request_review');
  Route::get('employee_request/{id}', 'Dashboard\EmployeeRequestReviewController@make_reponse')->name('employee_request');
  Route::post('store_employee_request', 'Dashboard\EmployeeRequestReviewController@store_reponse')->name('store_employee_request');
  //Request Type
  Route::resource('employee_request_type', 'Dashboard\RequestTypeController');

  //employeee Attendace //
  Route::resource('employee_attendance', 'Dashboard\EmployeeAttendanceController');

  Route::get('get_location_from_branch', 'Dashboard\AppointmentController@getlocationfrombranch')->name('get_location_from_branch');
  // start settings

  Route::patch('settings/cover', 'Dashboard\CompanySettingsController@uploadCover')->name('changeCover');
  Route::delete('settings/logo/reset', 'Dashboard\CompanySettingsController@resetLogo')->name('resetLogo');
  Route::patch('settings/logo', 'Dashboard\CompanySettingsController@uploadLogo')->name('changeLogo');
  Route::resource("company-settings", 'Dashboard\CompanySettingsController');

  Route::patch('attendence_settings/toggle', 'Dashboard\AttendenceSettingsController@toggleAttendenceSettings')->name('toggleAttendenceSettings');
  Route::resource("attendence-settings", 'Dashboard\AttendenceSettingsController');


  Route::put('/account-settings/updateAll', 'Dashboard\AccountSettingsController@updateAll')->name('updateAccountSettings');
  Route::patch('/account-settings/changepass', 'Dashboard\AccountSettingsController@changePassword')->name('change_auth_user_password');
  Route::resource("account-settings", 'Dashboard\AccountSettingsController');
  // end settings

  //active devices
  Route::patch('active_device', 'Dashboard\DeviceController@changeStatus')->name('active_device');

  //active attendace method //
  Route::patch('active_attendance_method', 'Dashboard\AttendmethodController@toggleactivate')->name('active_attendance_method');
  //

  //extra time
  // Route::resource('extra_time', 'Dashboard\ExtraTimeController');

  //brnach_settings
  Route::resource('branch_setting', 'Dashboard\BranchSettingController');

  // roles routes
  Route::resource('roles', 'Dashboard\RoleController');

  Route::post('/addvication', 'Dashboard\CompanySettingsController@addvication')->name('addvication');

  //update attendance method employee
  Route::get('edit_employee_attend_method/{id}', 'Dashboard\EmployeeController@edit_employee_attend_method')->name('edit_employee_attend_method');
  Route::patch('store_employee_attend_method/{id}', 'Dashboard\EmployeeController@store_employee_attend_method')->name('store_employee_attend_method');
});







Route::group(['prefix' => '/'], function () {
  Route::get('{first}/{second}/{third}', 'RoutingController@thirdLevel')->name('third');
  Route::get('{first}/{second}', 'RoutingController@secondLevel')->name('second');
  Route::get('{any}', 'RoutingController@root')->name('any');
});

// landing
Route::get('', 'RoutingController@index')->name('index');
