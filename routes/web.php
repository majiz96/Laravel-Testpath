<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QueueTest;
use App\Http\Controllers\PostController;
use App\Http\Controllers\REDIS\RedisTestController;
use App\Http\Controllers\REDIS\CacheTestController;

use App\Livewire\Dashboard\Home;
use App\Livewire\Dashboard\Products;
use App\Livewire\Test;

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\VerifyEmail;

use App\Jobs\SendWelcomeJob;
use Tests\Feature\PostTest;

Route::get('/', function () {
    return view('welcome');
});

Route::get('queue-test', [QueueTest::class, 'index']);
Route::post('queue-test',[QueueTest::class, 'send']);
Route::get('home', Home::class)->name('home');
Route::get('products-management', Products::class)->name('products-management');
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

Route::get('redis-test',[RedisTestController::class,'index'])->name('redis-test');
Route::get('redis-publish',[RedisTestController::class,'publish'])->name('redis-publish');
Route::get('redis-rate',[RedisTestController::class,'rateLimiter'])->name('rate');

Route::get('redis-cache-training',[CacheTestController::class,'index'])->name('cache-training');
Route::get('redis-cache-training-forget',[CacheTestController::class,'forget'])->name('cache-training-forget');
Route::get('redis-cache-training-put',[CacheTestController::class,'put'])->name('cache-training-put');
Route::get('redis-cache-training-get',[CacheTestController::class,'get'])->name('cache-training-get');
Route::get('redis-cache-training-remember',[CacheTestController::class,'remember'])->name('cache-training-remember');
Route::get('redis-cache-training-incr',[CacheTestController::class,'increment'])->name('cache-training-incr');
Route::get('redis-cache-training-decr',[CacheTestController::class,'decrement'])->name('cache-training-decr');
Route::get('redis-cache-training-incrby',[CacheTestController::class,'incrementBy'])->name('cache-training-incrby');
Route::get('redis-cache-training-decr',[CacheTestController::class,'decrementBy'])->name('cache-training-decr');
Route::get('redis-cache-training-forgetall',[CacheTestController::class,'flush'])->name('cache-training-forgetall');

