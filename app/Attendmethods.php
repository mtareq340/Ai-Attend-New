<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Attendmethods extends Model
{
    use Notifiable;
    protected $table = "attend_methods";
    protected $fillable = [
        'name', 'active', 'notes', 'created_at', 'updated_at'
    ];
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_attend_methods', 'employee_id');
    }
}
