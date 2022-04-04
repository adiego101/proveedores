<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $fecha_actual=Carbon::now();
            
            $result = DB::table('proveedores')
                            ->where('fecha_inscripcion','<=',$fecha_actual->subYear())
                            ->update([  'dado_de_baja'=>1,
                                        'fecha_baja'=>$fecha_actual->format("Y/m/d"),
                                        'motivo_baja'=>'Se venció el período de vigencia (un año desde la fecha de inscripción)',
                                        'updated_at'=>$fecha_actual]);
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
