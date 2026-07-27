<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueueTest;

use App\Jobs\SendWelcomeJob;

Route::get('/', function () {
    return view('welcome');
});

Route::get('queue-test', [QueueTest::class, 'index']);
Route::post('queue-test',[QueueTest::class, 'send']);
