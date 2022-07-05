<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week_Day extends Model
{
    //
    protected $table = 'week_days';
    protected $fillabel = [
        'id', 'days'
    ];
}
