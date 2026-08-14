<?php

namespace App\Http\Controllers\REDIS;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redis;

class CacheTestController extends Controller
{
    //
    public function index()
    {
        if (Cache::has('user'))
        {
            dd('Cache hit!');
        }
        else
        {
            $user = Cache::remember('user', 10, function () {
                return User::all();
            });

            dd(Cache::has('user'));
        }

        return $user;
    }

    public function forget()
    {
        Cache::forget('owner');

        return response()->json([
            "message" => "Cache forgotten successfully!"
        ],200);


    }

    public function put()
    {
        $user = User::find(3);

        Cache::put('owner',$user,25);

        return response()->json([
            "message" => "Cache forgotten successfully!",
            "user" => $user->name
        ]);
    }

    public function get()
    {
        $data = Cache::get('owner');

        if ($data)
        {
            return "Hello";
        }
        else
        {
            return "Come Later";
        }
    }

    public function remember()
    {
        $remember = Cache::remember('owner', 5, function () {
            return User::find(3);
        });

        return response()->json(["data" => $remember]);
    }

    public function increment()
    {
        Cache::increment('views');

        return response()->json([
            "views" => Cache::get('views'),
            "message" => "Cache increased successfully!"
        ]);
    }

    public function decrement()
    {
        Cache::decrement('views');

        return response()->json([
            "views" => Cache::get('views'),
            "message" => "Cache decreased successfully!"
        ]);

    }

    public function flush()
    {
        Cache::flush();
        return "Cache flushed successfully!";
    }

    public function incrementBy()
    {
        Cache::increment('views',5);

        return response()->json([
            "views" => Cache::get('views'),
            "message" => "Cache increased by 5 successfully!"
        ]);
    }
    public function decrementBy()
    {
        Cache::decrement('views',5);

        return response()->json([
            "views" => Cache::get('views'),
            "message" => "Cache decreased by 5 successfully!"
        ]);
    }

    public function add()
    {

        Cache::add('food','Burger',120);

        return response()->json([
            "message" => "Cache added successfully!",
            'food' => Cache::get('food'),
        ]);
    }

    public function tags()
    {
        Cache::tags(['users'])->put('all-users','User::all()',120);
        Cache::tags(['users'])->put('first-user','User::first()',120);
        Cache::put('last-user','User::last()',120);

        return response()->json([
            "message" => "Cache tags added successfully!",
            'tag 1' => Cache::tags(['users'])->get('all-users'),
            'tag 2' => Cache::tags(['users'])->get('first-user'),
            'untags' => Cache::get('last-user')
        ]);

    }

    public function tagsFlush()
    {
        Cache::tags(['users'])->flush();

        return response()->json([
            "message" => "Cache tags added successfully!",
            'tag 1' => Cache::tags(['users'])->get('all-users'),
            'tag 2' => Cache::tags(['users'])->get('first-user'),
            'untags' => Cache::get('last-user')
        ]);
    }
}
