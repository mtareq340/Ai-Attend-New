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
        'name', 'location_id', 'start_from_period1', 'end_to_period1', 'start_from_period2', 'end_to_period2', 'delay_period1', 'delay_period2', 'branch_id', 'overtime_period_1', 'over_time_period_2', 'date', 'created_at', 'updated_at'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function devices()
    {
        return $this->belongsToMany(Device::class, 'appointment_device', 'device_id');
    }
    public function employees()
    {
        return $this->belongsToMany(Device::class, 'appointment_device', 'device_id');
    }
}
