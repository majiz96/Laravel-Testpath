<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamsResource;
use App\Models\Teams;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    //
    public function index()
    {
       return TeamsResource::collection(Teams::all());
    }

    public function show(Teams $teams)
    {
        return new TeamsResource($teams);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|unique:teams',
            'points'=>'required|integer',
            'trophies'=>'sometimes|nullable|integer'
        ]);

       $teams = Teams::create($data);

        return new TeamsResource($teams);
    }

    public function update(Request $request,Teams $teams)
    {
        $data = $request->validate([
            'name'=>'sometimes|nullable|string|unique:teams',
            'points'=>'sometimes|nullable|integer',
            'trophies'=>'sometimes|integer'
        ]);

        $teams->update($data);
        return new TeamsResource($teams);
    }

    public function destroy(Teams $teams)
    {
        $teams->delete();
        return response()->json("You wiped (($teams->name)) team out of whole history!", 200);
    }


}
