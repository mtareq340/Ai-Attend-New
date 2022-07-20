<?php

use App\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Employee::create(
            [
                'name' => Str::random(10),
                'job_number' => rand(10000, 99999),
                'email' => Str::random(10) . '@gmail.com',
                'phone' => random_int(10000000000, 99999999999),
                'branch_id' => 2,
                'job_id' => 1,
            ]
        );
    }
}
