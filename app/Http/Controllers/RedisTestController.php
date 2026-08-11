<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Models\User;

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
}
