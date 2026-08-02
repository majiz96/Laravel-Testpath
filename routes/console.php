<?php


use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

use App\Console\Commands\TestScheduler;
use App\Console\Commands\GenerateReport;


use App\Jobs\TestSchedulerJob;
use App\Jobs\TestSchedulerSecondJob;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


//Schedule::call(function () {
//    logger('remind me another thing');
//})->everyMinute();
//
//Schedule::job(new TestSchedulerJob())->everyMinute();

//Schedule::job(new TestSchedulerSecondJob())->everyMinute();

//Schedule::command(new GenerateReport())->everyMinute()->withoutOverlapping();

//Schedule::command(new TrainGenerateCommand())->everyMinute()->withoutOverlapping(); => WRONG WITH ARGUMENT

//Schedule::command('train:generate 25')->everyMinute()->withoutOverlapping();

//Schedule::command('try-again:command 60 days')->everyMinute()->withoutOverlapping();

Schedule::command('try-again:command 60 days')
    ->everyFiveMinutes()
    ->withoutOverlapping()
    ->emailOutputTo('someoneForTesting@mail.com');

