<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmployeeRequest extends Model
{
    use Notifiable;
    protected $table = "employee_requests";
    protected $fillable = [
        'employee_id','request', 'date','accepted','accept_date','attachment'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
