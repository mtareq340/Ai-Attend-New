<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Branch extends Model
{
    //
    use NodeTrait;
    protected $fillable = [
        'name',
        'phone',
        'address',
        'notes',
        'long',
        'lat',
        'latitude',
        'longituide'
    ];


    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }
    public function employees()
    {
        return $this->hasMany("App\Employee");
    }
    public function assigned_appointments()
    {
        return $this->hasMany(Assign_Appointment::class);
    }
    public function attendance_settings()
    {
        return $this->hasOne(AttendenceSettings::class);
    }
    public function branch_settings()
    {
        return $this->hasOne(Branch_Setting::class);
    }
    public function locations()
    {
        return $this->hasMany(Location::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }





    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($branch) {
            $relationMethods = ['employees', 'users', 'appointment', 'assigned_appointments', 'locations'];
            foreach ($relationMethods as $relationMethod) {
                if ($branch->$relationMethod()->count() > 0) {
                    return false;
                }
            }
        });
    }
}
