<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_Request_Review extends Model
{
    //
    protected $table = 'employee_request_review';
    protected $fillable = [
        'employee_id', 'request', 'date', 'created_at', 'updated_at',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}