<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendenceSettings extends Model
{
    protected $table = "attendance_settings";
    protected $fillable = [
        'branch_id', 'allow_deny', 'automatic_leave', 'over_time_count', 'validate_finger', 'created_at', 'updated_at'
    ];
    //
}
