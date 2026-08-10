<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueueTest;
use App\Http\Controllers\PostController;

use App\Livewire\Dashboard\Home;
use App\Livewire\Test;

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\VerifyEmail;

use App\Jobs\SendWelcomeJob;
use Tests\Feature\PostTest;

use Illuminate\Support\Facades\Cache;

Route::get('/', function () {
    return view('welcome');
});

Route::get('queue-test', [QueueTest::class, 'index']);
Route::post('queue-test',[QueueTest::class, 'send']);
Route::get('home', Home::class)->name('home');
//Route::get('test', Test::class)->name('test');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});


Route::get('/test', function () {
    return 'Hello Test Laravel';
});
Route::get('/testOk', function () {
    return response('Hello Test Laravel',500);
});

Route::get('redis-test', function () {
    return
    [
        'put' => Cache::put('age',30),
        'get' => Cache::get('age'),
        'has' => Cache::has('age'),
//        'forget' => Cache::forget('age'),
//        'delete' => Cache::delete('age'),
    ];
});
