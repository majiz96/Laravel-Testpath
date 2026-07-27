<?php

namespace App\Http\Controllers;

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

        SendWelcomeJob::dispatch($request->name);

        return back()->with(['success','You have sent successfully']);
    }
}
