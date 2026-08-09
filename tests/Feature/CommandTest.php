<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use App\Jobs\TrainGenerateJob;

class CommandTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_train_generate_command_can_dispatch_job(): void
    {
        Queue::fake();

        $this->artisan('train:generate',['minutes' => 5])
            ->expectsOutput("The Reports generation have trained successfully in 5 minutes.")
            ->assertExitCode(0);

        Queue::assertPushed(TrainGenerateJob::class);
    }
}
