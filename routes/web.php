<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();

// Dashboard Routes
Route::group([ 'prefix' => 'dashboard'], function () {
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
    Route::resource('jobs',               'Dashboard\JobController');
    Route::resource('attend_methods', 'Dashboard\AttendmethodsController');
    Route::resource('devices',             'Dashboard\DeviceController');
    Route::resource('locations', 'Dashboard\LocationController');
    // employees attend methods
    Route::resource('employees-attend-methods', 'Dashboard\EmployeesAttendMethodsController');
    // branches
    Route::resource('branches', 'Dashboard\BranchesController');
    // employees (this order should remain the same)
    Route::get('employees/add-from-excel', 'Dashboard\EmployeesController@excelPage')->name('employees.excelPage');
    Route::patch('employees/activate', 'Dashboard\EmployeesController@toggleActiveAndLocked')->name('toggleActiveEmp');
    Route::post('employees/import', 'Dashboard\EmployeesController@import')->name('import_employees');
    Route::get('/employees/downloadexcel', 'Dashboard\EmployeesController@downloadExcelEmployees')->name('downloadExcelEmps');
    Route::post('import', 'Dashboard\EmployeesController@import')->name('import_emp_post');
    Route::resource('employees', 'Dashboard\EmployeesController');
    // assign appointment route
    Route::resource('assign_appointment', 'Dashboard\Assign_AppointmentController');
    // appointment //
    Route::resource('appointment', 'Dashboard\AppointmentsController');



    // roles routes
    Route::resource('roles', 'Dashboard\RolesController');
});

Route::group(['prefix' => '/'], function () {
    Route::get('{first}/{second}/{third}', 'RoutingController@thirdLevel')->name('third');
    Route::get('{first}/{second}', 'RoutingController@secondLevel')->name('second');
    Route::get('{any}', 'RoutingController@root')->name('any');
});

// landing
Route::get('', 'RoutingController@index')->name('index');
