<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Branch;
use App\Job;
use App\Attendmethods;

class Employee extends Model
{

    protected $fillable = [
        'name', 'email', 'address', 'phone', 'password', 'age', 'branch_id', 'gender', 'job_id', 'job_number', 'otp', 'created_at', 'updated_at'
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
    public function requests()
    {
        return $this->hasMany(employee_requests::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($employee) {
            $relationMethods = ['assign_appointments', 'attend_methods'];
            foreach ($relationMethods as $relationMethod) {
                if ($employee->$relationMethod()->count() > 0) {
                    return false;
                }
            }
        });
    }
}
