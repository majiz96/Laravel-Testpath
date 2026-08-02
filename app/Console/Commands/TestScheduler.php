<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('test:scheduler')]
#[Description('Command description')]
class TestScheduler extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        logger('test-scheduler executed');

        $this->info('test-scheduler made a log in laravel.log');
    }
}
