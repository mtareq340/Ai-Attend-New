<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Device extends Model
{
    use Notifiable;
    protected $fillable = [
        'name', 'notes', 'created_at', 'updated_at'
    ];

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'devices_to_locations');
    }
    public function appointment()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_device', 'appointment_id');
    }
}
