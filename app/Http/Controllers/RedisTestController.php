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
        Cache::forget('user');

        DB::enableQueryLog();

        $user = Cache::remember('test', 120, function () {
            return User::find(3);
        });

        $key = config('cache.prefix') . 'user';

        return [
            'user' => $user,
            'ttl' => Redis::ttl($key),
            'queries' => DB::getQueryLog(),
        ];

    }
}
