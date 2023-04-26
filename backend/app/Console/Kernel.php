<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;
use Illuminate\Support\Carbon;

class Kernel extends ConsoleKernel
{
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
            $users = User::whereHas('completedChallenges', function ($query) {
                $query->where('chellenge_user.created_at', '<=', Carbon::now()->subDays(8));
            })->with('completedChallenges')->get();
            
            foreach ($users as $user) {
                foreach($user->completedChallenges as $challenge) {
                    $user->completedChallenges()->toggle($challenge->id);
                }
            }
        })->weeklyOn(1, '8:00');
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
