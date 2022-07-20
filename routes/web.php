<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Dashboard Routes
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth' , 'namespace' => 'Dashboard'], function () {

  // home
  Route::get('/', 'HomeController@index');
  Route::resource('users', 'UserController');
  Route::resource('plans', 'PlanController');
  Route::resource('jobs',               'JobController');
  Route::resource('attend_methods', 'AttendmethodController');
  // Route::resource('devices',             'DeviceController');
  // Route::get('locations/devices', 'LocationController@getLocationDevices')->name('getLocationDevices');
  Route::resource('locations', 'LocationController');
  // employees attend methods
  Route::resource('employees_attend_methods', 'EmployeeAttendMethodController');
  // branches
  Route::get('branches/locations', 'BrancheController@getBranchLocations')->name('getBranchLocations');
  Route::resource('branches', 'BrancheController');
  // employees (this order should remain the same)
  Route::get('employees/add-from-excel', 'EmployeeController@excelPage')->name('employees.excelPage');
  Route::patch('employees/activate', 'EmployeeController@toggleActiveAndLocked')->name('toggleActiveEmp');
  Route::post('employees/import', 'EmployeeController@import')->name('import_employees');
  Route::get('/employees/downloadexcel', 'EmployeeController@downloadExcelEmployees')->name('downloadExcelEmps');
  Route::get('/job_employees/get', 'EmployeeController@getEmployeesByJob')->name('getEmployeesByJob');
  Route::post('import', 'EmployeeController@import')->name('import_emp_post');
  Route::resource('employees', 'EmployeeController');
  // assign appointment route
  Route::resource('assign_appointment', 'Assign_AppointmentController');
  Route::get('getemployees', 'Assign_AppointmentController@getemployees')->name('getEmpsByBranch');
  Route::get('getappointment', 'Assign_AppointmentController@getappointment')->name('getappointment');
  // appointment //
  Route::resource('appointment', 'AppointmentController');

  // employees request
  Route::patch('employee_requests/activate', 'EmployeeRequestsController@toggleActivationAccept')->name('toggleActiveReqEmp');
  Route::get('employee_requests/info', 'EmployeeRequestsController@show_request_emp_info')->name("employee_requests.index.request");
  Route::get('employee_requests/info/{id}/data', 'EmployeeRequestsController@show_request_emp_info_data')->name('employee_requests.index.request.data');
  Route::resource('employee_requests', 'EmployeeRequestsController');
  //Employees request //
  Route::get('employee_request_review', 'EmployeeRequestReviewController@index')->name('employee_request_review');
  Route::get('employee_request/{id}', 'EmployeeRequestReviewController@make_reponse')->name('employee_request');
  Route::post('store_employee_request', 'EmployeeRequestReviewController@store_reponse')->name('store_employee_request');
  //Request Type
  Route::resource('employee_request_type', 'RequestTypeController');

  //employeee Attendace //
  Route::resource('employee_attendance', 'EmployeeAttendanceController');

  Route::get('get_location_from_branch', 'AppointmentController@getlocationfrombranch')->name('get_location_from_branch');
  // start settings

  Route::patch('settings/cover', 'CompanySettingsController@uploadCover')->name('changeCover');
  Route::delete('settings/logo/reset', 'CompanySettingsController@resetLogo')->name('resetLogo');
  Route::patch('settings/logo', 'CompanySettingsController@uploadLogo')->name('changeLogo');
  Route::resource("company-settings", 'CompanySettingsController');

  Route::patch('attendence_settings/toggle', 'AttendenceSettingsController@toggleAttendenceSettings')->name('toggleAttendenceSettings');
  Route::resource("attendence-settings", 'AttendenceSettingsController');


  Route::put('/account-settings/updateAll', 'AccountSettingsController@updateAll')->name('updateAccountSettings');
  Route::patch('/account-settings/changepass', 'AccountSettingsController@changePassword')->name('change_auth_user_password');
  Route::resource("account-settings", 'AccountSettingsController');
  // end settings

  //active devices
  // Route::patch('active_device', 'DeviceController@changeStatus')->name('active_device');

  //active attendace method //
  Route::patch('active_attendance_method', 'AttendmethodController@toggleactivate')->name('active_attendance_method');
  //
  //extra time
  // Route::resource('extra_time', 'ExtraTimeController');
  //brnach_settings
  Route::resource('branch_setting', 'BranchSettingController');
  // roles routes
  Route::resource('roles', 'RoleController');
  Route::post('/addvication', 'CompanySettingsController@addvication')->name('addvication');
  // toggle attendance methods
  Route::patch('/attendance_methods/toggle' , 'EmployeeController@toggleAttendMethod')->name('toggleAttendMethod');
  Route::get('/employee/attendance_methods' , 'EmployeeController@getEmpAttendMethods')->name('getEmpAttendMethod');


  //update attendance method employee
  // legacy
  Route::get('edit_employee_attend_method/{id}', 'EmployeeController@edit_employee_attend_method')->name('edit_employee_attend_method');
  Route::patch('store_employee_attend_method/{id}', 'EmployeeController@store_employee_attend_method')->name('store_employee_attend_method');

  //make response
  Route::post('accept_response/{id}', 'EmployeeRequestReviewController@accept_response')->name('accept_response');
  Route::post('reject_response/{id}', 'EmployeeRequestReviewController@reject_response')->name('reject_response');

  Route::post('make_employees_attendance_success', 'EmployeeAttendanceController@make_employees_attendance_success')->name('make_employees_attendance_success');

  //employees Departure 
  Route::resource('employees_departures', 'EmployeesDepartureController');
  Route::post('make_employees_departure_success', 'EmployeesDepartureController@make_employees_departure_success')->name('make_employees_departure_success');
  //update over time to Employees
  Route::post('update_over_time', 'Assign_AppointmentController@update_over_time')->name('update_over_time');

  //get employees from attendance plan in attendce & departure
  Route::get('get_employees_from_attendanceplan', 'EmployeeAttendanceController@getEmployeesFromAttendanceplan')->name('get_employees_from_attendanceplan');

  //make Departure 
  Route::resource('make_departure', 'MakeDepartureController');

  Route::post('store_employees_departures', 'MakeDepartureController@store_employees_departures')->name('store_employees_departures');
});

Route::group(['prefix' => '/'], function () {
  Route::get('{first}/{second}/{third}', 'RoutingController@thirdLevel')->name('third');
  Route::get('{first}/{second}', 'RoutingController@secondLevel')->name('second');
  Route::get('{any}', 'RoutingController@root')->name('any');
});

// landing
Route::get('', 'RoutingController@index')->name('index');
