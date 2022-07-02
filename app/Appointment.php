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
        'location_id', 'start_from', 'end_to', 'delaytime', 'branch_id', 'overtime', 'date', 'created_at', 'updated_at'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
