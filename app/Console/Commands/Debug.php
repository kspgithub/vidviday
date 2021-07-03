<?php

namespace App\Console\Commands;

use App\Models\Job\CandidateVacancy;
use App\Services\MessengerService;
use Illuminate\Console\Command;

class Debug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $items = CandidateVacancy::all();
        foreach ($items as $offer) {
            MessengerService::sendOfferMessage($offer);
        }
    }
}
