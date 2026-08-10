<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Models\User;

class RedisTestController extends Controller
{
    //
    public function index()
    {
        $user = Cache::remember('user:1', 120, function () { return User::find(1); });

        return $user;
    }
}
