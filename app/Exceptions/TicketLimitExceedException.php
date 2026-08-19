<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TicketLimitExceedException extends Exception
{
    //
    public function report()
    {
        Log::channel('exceptions')->error('Ticket Limit Exceed Exception',[
            'message' => $this->getMessage()
        ]);
    }

    public function shouldReport(): bool
    {
        return false;
    }

    public function render(Request $request)
    {
        if($request->is('api/*'))
        {
            return response()->json([
                "message" => $this->getMessage(),
            ],422);
        }

       return response($this->getMessage(), 422);
    }

}
