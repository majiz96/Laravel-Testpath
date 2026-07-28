<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Jobs\SendWelcomeJob;
use Illuminate\Http\Request;

class QueueTest extends Controller
{
    public function index(Request $request)
    {
        return view('queue-test');


    }
    public function send(Request $request)
    {
        $request->validate(['name'=>'required|string|max:255']);

        event(new UserRegistered($request->name));

        return back()->with(['success','You have sent successfully']);
    }
}
