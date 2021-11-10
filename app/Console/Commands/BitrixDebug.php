<?php

namespace App\Console\Commands;

use App\Lib\Bitrix24\App\ActivityService;
use App\Lib\Bitrix24\CRM\Contact\ContactService;
use App\Lib\Bitrix24\CRM\Deal\DealOrder;
use App\Lib\Bitrix24\CRM\Deal\DealService;
use App\Lib\Bitrix24\CRM\Lead\LeadFeedback;
use App\Lib\Bitrix24\Lists\TourLists;
use App\Models\Order;
use App\Models\UserQuestion;
use Illuminate\Console\Command;

class BitrixDebug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bitrix:debug';

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
        //$order = Order::find(7);
        //DealOrder::createCrmDeal($order);

//        $bitrixId = 198;
//        $response = DealService::get($bitrixId);
//
//        if (!$response->error) {
//            $data = $response->result;
//            DealOrder::createOrUpdate($bitrixId, $data);
//        }

        // $question = UserQuestion::find(1);
        // LeadFeedback::createCrmLead($question);

        $response = ActivityService::list();
        
        return 0;
    }
}
