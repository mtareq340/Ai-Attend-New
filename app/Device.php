<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Device extends Model
{
    use Notifiable;
    protected $fillable = [
        'name', 'code', 'notes', 'created_at', 'updated_at' , 'location_id'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class , 'location_id');
    }
    public function appointment()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_device', 'appointment_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($device) {
            $relationMethods = ['locations'];

            foreach ($relationMethods as $relationMethod) {
                if ($device->$relationMethod()->count() > 0) {
                    return false;
                }
            }
        });
    }
}
