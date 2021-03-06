<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Branch;
use App\Job;
use App\Attendmethods;

class Employee extends Model
{

    protected $fillable = [
        'name', 'email', 'address', 'phone', 'password', 'age', 'branch_id', 'gender', 'job_id', 'job_number', 'otp', 'created_at', 'updated_at', 'avatar'
    ];
    //
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    public function attend_methods()
    {
        return $this->belongsToMany(Attendmethods::class, 'employee_attend_methods', 'employee_id', 'attend_method_id');
    }
    public function extra_time()
    {
        return $this->hasMany(ExtraTime::class, 'employee_id');
    }

    public function assign_appointments()
    {
        return $this->hasMany(Assign_Appointment::class);
    }
    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'assign_appointments', 'employee_id', 'work_appointment_id');
    }
    public function appointmentsIds()
    {
        return $this->assign_appointments()->pluck('work_appointment_id')->toArray();
    }
    public function requests()
    {
        return $this->hasMany(employee_requests::class);
    }

    public function attendeces()
    {
        return $this->hasMany(Employee_Attendance::class , 'appointment_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($employee) {
            $relationMethods = ['assign_appointments', 'attend_methods' ];
            foreach ($relationMethods as $relationMethod) {
                if ($employee->$relationMethod()->count() > 0) {
                    return false;
                }
            }
        });
    }
}
