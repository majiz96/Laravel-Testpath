<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function store(Request $request)
    {
        $data = $request->validate(['title'=>'required|string|min:3']);
        return response()->json($data);
    }
}
