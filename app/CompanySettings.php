<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySettings extends Model
{
    protected $table = "company_settings";

    protected $fillable = [
        'name', 'email', 'vication_days', 'logo', 'background', 'phone', 'ssid', 'mac_address', 'notes'
    ];
}
