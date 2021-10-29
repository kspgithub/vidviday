<?php

namespace App\Console\Commands;

use App\Lib\Bitrix24\CRM\Deal\DealSchedule;
use App\Lib\Bitrix24\CRM\Deal\DealService;
use Illuminate\Console\Command;

class BitrixScheduleSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bitrix:schedule-sync';

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

        $lastID = 0;
        $finish = false;
        $select = ['*', 'UF_*'];
        $order = ['ID' => 'ASC'];

        while (!$finish) {
            $filter =  ['>ID' => $lastID];

            $response = DealService::getByCategory(DealSchedule::CATEGORY_ID, $select, $filter, $order, -1);

            if (!$response->error && count($response->result) > 0) {

                foreach ($response->result as $scheduleData) {
                    $lastID = $scheduleData['ID'];
                    DealSchedule::createOrUpdate($lastID, $scheduleData);
                }

            } else {
                $finish = true;
            }
        }
        return 0;
    }
}
