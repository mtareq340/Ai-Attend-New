<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();

// Dashboard Routes
Route::group(['prefix' => 'dashboard'], function () {
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
    Route::post('import', 'Dashboard\EmployeeController@import')->name('import_emp_post');
    Route::resource('employees', 'Dashboard\EmployeeController');
    // assign appointment route
    Route::resource('assign_appointment', 'Dashboard\Assign_AppointmentController');
    // appointment //
    Route::resource('appointment', 'Dashboard\AppointmentController');



    // roles routes
    Route::resource('roles', 'Dashboard\RoleController');
});

Route::group(['prefix' => '/'], function () {
    Route::get('{first}/{second}/{third}', 'RoutingController@thirdLevel')->name('third');
    Route::get('{first}/{second}', 'RoutingController@secondLevel')->name('second');
    Route::get('{any}', 'RoutingController@root')->name('any');
});

// landing
Route::get('', 'RoutingController@index')->name('index');
