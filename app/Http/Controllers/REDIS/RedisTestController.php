<?php

namespace App\Http\Controllers\REDIS;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redis;

class RedisTestController extends Controller
{
    //
    public function index()
    {
        DB::enableQueryLog();

        $user = Cache::remember('user', 120, function () {
            return User::find(3);
        });

        $store = Cache::getStore();

        return [
            'user' => $user,
            'ttl' => $store->getRedis()->ttl(
                $store->getPrefix() . 'user'
            ),
            'queries' => DB::getQueryLog(),
        ];
    }

    public function publish()
    {
        return Redis::connection()->publish(
            'notifications',
            json_encode([
                'type' => 'new_notification',
                'user_id' => 3,
                'message' => 'You have a new notification',
            ])
        );
    }

    public function rateLimiter(Request $request)
    {
        $key = 'redis_rate_test'.$request->ip();

        if(RateLimiter::tooManyAttempts($key, 5))
        {
            return response()->json(['message' => 'Too many attempts.'], 429);
        }

        RateLimiter::increment($key,60);

        return response()->json([
            'message' => 'The request accepted',
            'attempts' => RateLimiter::attempts($key),
        ], 429);
    }


}
