<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance_Plan_Types extends Model
{
    //
    protected $table = 'attendance_plan_types';
    protected $fillable = [
        'id', 'name'
    ];
}
