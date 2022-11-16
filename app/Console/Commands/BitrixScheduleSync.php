<?php

namespace App\Console\Commands;

use App\Lib\Bitrix24\CRM\Dynamic\BitrixTourSchedule;
use App\Lib\Bitrix24\CRM\Dynamic\BitrixTourScheduleService;
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
        $order = ['id' => 'ASC'];

        while (!$finish) {
            $filter = ['>id' => $lastID];

            $response = BitrixTourScheduleService::list($select, $filter, $order, -1);

            if (!$response->error && !empty($response->result['items']) > 0) {

                foreach ($response->result['items'] as $scheduleData) {
                    $lastID = $scheduleData['id'];
                    BitrixTourSchedule::createOrUpdate($lastID, BitrixTourSchedule::createFromData($scheduleData));
                }

            } else {
                $finish = true;
            }
        }
        return 0;
    }
}
