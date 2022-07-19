<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    //
    use Notifiable;
    protected $table = 'work_appointments';
    protected $fillable = [
        'name', 'attendance_plan_type_id', 'location_id', 'start_from_period_1', 'end_to_period_1', 'start_from_period_2', 'end_to_period_2', 'delay_period_1', 'delay_period_2', 'branch_id', 'overtime', 'date', 'created_at', 'updated_at', 'attendance_days'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
  
    public function getDevicesIdsAttribute()
    {
        return $this->devices()->pluck('device_id');
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'assign_appointments', 'work_appointment_id', 'employee_id');
    }
    public function getEmployeesIds()
    {
        return $this->employees()->pluck('employee_id');
    }
    public function attendance_plan_type()
    {
        return $this->belongsTo(Attendance_Plan_Types::class, 'attendance_plan_type_id');
    }
}
