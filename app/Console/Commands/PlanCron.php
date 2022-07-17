<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PlanCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plan:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $plans = DB::table('attendance_plan_details')->get();
        foreach ($plans as $plan) {
            $planEndDate = Carbon::parse($plan->end_date);
            if($planEndDate->isToday()){
                $workAppointment = DB::table('work_appointments')->where('id', $plan->work_appointment_id)->first();
                if($workAppointment->attendance_repeat == 1){
                    $endDate = date( "Y-m-d", strtotime( "$plan->end_date +7 day" ) );
                    DB::table('attendance_plan_details')->insert([
                        'work_appointment_id'   => $plan->work_appointment_id,
                        'start_date'   => $plan->end_date,
                        'end_date'   => $endDate,
                    ]);
                }
            }
        }
        return 1;
    }
}
