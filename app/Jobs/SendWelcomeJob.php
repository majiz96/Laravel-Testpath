<?php

namespace App\Jobs;

use App\Mail\TestWelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendWelcomeJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;
    public int $backoff = 10;

//    public function backoff(): array
//    {
////        return [5,10,20,30];
//
//        $times=[];
//        $delay= 1;
//
//        for ($i=0; $i < $this->tries; $i++)
//        {
//            $times[] = min($delay, 60);
//
//            $delay *= 4;
//        }
//
//        return $times;
//    }
    /**
     * Create a new job instance.
     */
    public function __construct(public string $name)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //

        Mail::to("test@example.com")
            ->send(new TestWelcomeMail($this->name));
    }
}
