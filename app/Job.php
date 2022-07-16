<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Job extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'name', 'notes', 'created_at', 'updated_at'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function assigned_appointments()
    {
        return $this->hasMany(Assign_Appointment::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($job) {
            $relationMethods = ['employees', 'assigned_appointments'];

            foreach ($relationMethods as $relationMethod) {
                if ($job->$relationMethod()->count() > 0) {
                    return false;
                }
            }
        });
    }
}
