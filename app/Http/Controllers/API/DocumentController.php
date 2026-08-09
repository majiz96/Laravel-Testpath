<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DocumentController extends Controller
{
    //
    public function update(Document $document, Request $request)
    {
        Gate::authorize('update', $document);

        $document->update($request->only(['title', 'body']));

        return response()->json(['message' => 'Document updated successfully.'], 200);
    }
}
