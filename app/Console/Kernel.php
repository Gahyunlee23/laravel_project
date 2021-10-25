<?php

namespace App\Console;

use App\Http\Controllers\Schedules\ScheduleController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Date;

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

        /* 실 사용자용 스케쥴러 */
        /*app(ScheduleController::class)->oneDaysBeforeLivingInHotel();//입주 1일 전*/
        $schedule->call(function () {
            app(ScheduleController::class)->threeDaysBeforeLiveInHotel();/* 입주 3일~1일전*/

            app(ScheduleController::class)->oneDaysAfterLivingInHotel();/*입주 1일 후*/
            app(ScheduleController::class)->DaysBeforeLivingInHotel();/* 퇴실 전*/
            app(ScheduleController::class)->oneDaysAfterLiveEndHotel();/* 퇴실 1일 후*/
            app(ScheduleController::class)->oneDayBeforeHotelTour();/*투어 하루 전 리마인드*/
        })->cron('*/5 13-23 * * *');

        $schedule->call(function () {
            app(ScheduleController::class)->twoHoursBeforeHotelTour();/*투어 2시간 전 리리마인드 */
        })->cron('*/5 7-23 * * *');/* 투어 2시간 전 - 투어시간 9~20 -2 시간 씩 크론탭*/

        $schedule->call(function () {
            app(ScheduleController::class)->oneHourAfterHotelTour();/*투어 1시간 후 입주 희망 체크*/
        })->cron('*/5 10-22 * * *');/* 투어 후 2시간 - 투어시간 9~20 +2 시간 씩 크론탭*/

        $schedule->call(function () {
            app(ScheduleController::class)->ADayBeforeLivingInHotel(); /* 퇴실 23~24시간 전 알림톡 전송 */
        })->cron('*/5 * * * *');/* 5분 마다 시간 씩 크론탭*/

        $schedule->call(function () {
            app(ScheduleController::class)->unsuccessfulPayment();/*결제 닫기 후 10분 후 */
        })->everyMinute();


        /* test 관리자 스케쥴러 테스트 */
//        $schedule->call(function () {
//            app(ScheduleController::class)->unsuccessfulPayment();/*결제 닫기 후 5분 후 */
//        })->everyMinute();
//        $schedule->call(function () {
//            app(ScheduleController::class)->oneHourAfterHotelTour();
//        })->everyMinute();
        //cron('*/5 13-23 * * *');/* 매일 13~18시 5분마다 실행 */
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
