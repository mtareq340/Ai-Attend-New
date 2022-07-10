<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySettings extends Model
{
    protected $table = "company_settings";

    protected $fillable = [
        'name' ,'plan_id' ,'vication_days','registeration_date' , 'email' , 'logo' , 'background' , 'phone' , 'ssid' , 'mac_address' , 'notes'
    ];


}
