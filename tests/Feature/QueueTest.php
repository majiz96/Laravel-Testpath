<?php

namespace Tests\Feature;

use App\Jobs\SendWelcomeJob;
use Illuminate\Support\Facades\Queue;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QueueTest extends TestCase
{

    public function test_send_welcome_job_is_dispatching()
    {
        Queue::fake();

        $str = "Test";

        SendWelcomeJob::dispatch($str);
        Queue::assertPushed(SendWelcomeJob::class);
    }

}
