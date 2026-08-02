<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

use App\Jobs\TryAgainJob;

#[Signature('try-again:command {time} {duration}')]
#[Description('Command description')]
class TryAgainCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $time = $this->argument('time');
        $duration = $this->argument('duration');

        TryAgainJob::dispatch($time, $duration);

        $this->info("We tried again in {$time} {$duration}");

    }
}
