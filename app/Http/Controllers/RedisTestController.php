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

        return [
            'user' => $user,
            'quaries' => DB::getQueryLog()
        ];
    }
}
