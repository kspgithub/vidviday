<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BuildApp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(app()->environment('production')) {
            exec('source ~/.nvm/nvm.sh;cd ' . base_path() . ';~/.nvm/versions/node/v14.19.1/bin/npm run prod-app');
        }

        if(app()->environment('local')) {
            exec('cd ' . base_path() . ';~/.nodenv/shims/npm run prod-app');
        }
    }
}
