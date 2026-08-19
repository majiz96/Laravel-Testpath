<?php

use Illuminate\Support\Facades\Route;

use App\Exceptions\TicketLimitExceedException;

use App\Http\Controllers\QueueTest;
use App\Http\Controllers\PostController;
use App\Http\Controllers\REDIS\RedisTestController;
use App\Http\Controllers\REDIS\CacheTestController;

use App\Livewire\Dashboard\Home;
use App\Livewire\Dashboard\Products;
use App\Livewire\Tickets;
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
Route::get('tickets', Tickets::class)->name('tickets');
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
Route::get('redis-cache-training-add',[CacheTestController::class,'add'])->name('cache-training-add');
Route::get('redis-cache-training-tags',[CacheTestController::class,'tags'])->name('cache-training-tags');
Route::get('redis-cache-training-tagsFlush',[CacheTestController::class,'tagsFlush'])->name('cache-training-tagsFlush');
Route::get('redis-cache-training-acquireLock',[CacheTestController::class,'acquireLock'])->name('cache-training-acquireLock');
Route::get('redis-cache-training-releaseLock',[CacheTestController::class,'releaseLock'])->name('cache-training-releaseLock');
Route::get('redis-cache-training-lock',[CacheTestController::class,'lock'])->name('cache-training-lock');

Route::get('redis-dispatch-job',[CacheTestController::class,'dispatchJob'])->name('dispatch-job');

Route::get('redis-rete-limiter',[CacheTestController::class,'reteLimit'])->name('rate-limiter');

Route::get('/test-exception', function () {
    throw new TicketLimitExceedException(
        'VIP limit reached'
    );
});

Route::get('/test-error', function () {
    abort(404);
});
