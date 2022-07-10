<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_Attendance extends Model
{
    //
    protected $table = 'employee_attendance';
    protected $fillable = [
        'employee_id',
        'branch_id',
        'attendance_method_id',
        'created_at',
        'updated_at',
        'state'
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function attendanc_method()
    {
        return $this->belongsTo(Attendmethods::class, 'attendance_method_id');
    }
}