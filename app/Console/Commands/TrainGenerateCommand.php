<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

use App\Jobs\TrainGenerateJob;

#[Signature('train:generate {minutes}')]
#[Description('Command description')]
class TrainGenerateCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $minutes = $this->argument('minutes');
        TrainGenerateJob::dispatch($minutes);
        $this->info("The Reports generation have trained successfully in {$minutes} minutes.");
    }
}
