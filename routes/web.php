<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Dashboard Routes
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {

  // home
  Route::get('/', 'Dashboard\HomeController@index');

  Route::resource('users', 'Dashboard\UserController');

  Route::resource('plans', 'Dashboard\PlanController');
  Route::resource('jobs',               'Dashboard\JobController');
  Route::resource('attend_methods', 'Dashboard\AttendmethodController');
  // Route::resource('devices',             'Dashboard\DeviceController');

  // Route::get('locations/devices', 'Dashboard\LocationController@getLocationDevices')->name('getLocationDevices');
  Route::resource('locations', 'Dashboard\LocationController');
  // employees attend methods
  Route::resource('employees_attend_methods', 'Dashboard\EmployeeAttendMethodController');
  // branches
  Route::get('branches/locations', 'Dashboard\BrancheController@getBranchLocations')->name('getBranchLocations');
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
  // Route::patch('active_device', 'Dashboard\DeviceController@changeStatus')->name('active_device');

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

  // toggle attendance methods
  Route::patch('/attendance_methods/toggle' , 'Dashboard\EmployeeController@toggleAttendMethod')->name('toggleAttendMethod');
  Route::get('/employee/attendance_methods' , 'Dashboard\EmployeeController@getEmpAttendMethods')->name('getEmpAttendMethod');


  //update attendance method employee
  // legacy
  Route::get('edit_employee_attend_method/{id}', 'Dashboard\EmployeeController@edit_employee_attend_method')->name('edit_employee_attend_method');
  Route::patch('store_employee_attend_method/{id}', 'Dashboard\EmployeeController@store_employee_attend_method')->name('store_employee_attend_method');

  //make response
  Route::post('accept_response/{id}', 'Dashboard\EmployeeRequestReviewController@accept_response')->name('accept_response');
  Route::post('reject_response/{id}', 'Dashboard\EmployeeRequestReviewController@reject_response')->name('reject_response');

  Route::post('make_employees_attendance_success', 'Dashboard\EmployeeAttendanceController@make_employees_attendance_success')->name('make_employees_attendance_success');

  //employees Departure
  Route::resource('employees_departures', 'Dashboard\EmployeesDepartureController');
  Route::post('make_employees_departure_success', 'Dashboard\EmployeesDepartureController@make_employees_departure_success')->name('make_employees_departure_success');
  //update over time to Employees
  Route::post('update_over_time', 'Dashboard\Assign_AppointmentController@update_over_time')->name('update_over_time');

  //get employees from attendance plan in attendce & departure
  Route::get('get_employees_from_attendanceplan', 'Dashboard\EmployeeAttendanceController@getEmployeesFromAttendanceplan')->name('get_employees_from_attendanceplan');

  //make Departure
  Route::resource('make_departure', 'Dashboard\MakeDepartureController');
  Route::post('store_employees_departures', 'Dashboard\MakeDepartureController@store_employees_departures')->name('store_employees_departures');

  //reports route
  Route::get('reports/attendance-report', 'Dashboard\Report\AttendanceReportController@index')->name('reports.attend-report');

});




Route::group(['prefix' => '/'], function () {
  Route::get('{first}/{second}/{third}', 'RoutingController@thirdLevel')->name('third');
  Route::get('{first}/{second}', 'RoutingController@secondLevel')->name('second');
  Route::get('{any}', 'RoutingController@root')->name('any');
});

// landing
Route::get('', 'RoutingController@index')->name('index');
