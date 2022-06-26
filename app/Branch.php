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
        'lat'
    ];
    protected $appends = [
        'can_delete'
    ];

    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }
    public function employees() {
        return $this->hasMany("App\Employee", "branch_id");
    }

    public function getCanDeleteAttribute(){
        $valid = true;
        if ($this->employees()->count() > 0)
            $valid = false;
        
        return $valid;
    }
}
