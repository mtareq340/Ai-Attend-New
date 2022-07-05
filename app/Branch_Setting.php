<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch_Setting extends Model
{
    protected $table = 'branch_setting';
    protected $fillable = [
        'id', 'branch_id', 'over_time_count', 'vication_days'
    ];
}
