<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        //
        'name' => Str::random(10),
        'job_number' => rand(10000, 99999),
        'email' => Str::random(10) . '@gmail.com',
        'phone' => random_int(10000000000, 99999999999),
        'branch_id' => 2,
        'job_id' => 1,
    ];
});
