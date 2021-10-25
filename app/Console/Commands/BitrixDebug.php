<?php

namespace App\Console\Commands;

use App\Lib\Bitrix24\CRM\Contact\ContactService;
use App\Lib\Bitrix24\CRM\Deal\DealOrder;
use App\Lib\Bitrix24\Lists\TourLists;
use App\Models\Order;
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
        $order = Order::find(7);
        DealOrder::createOrder($order);


        return 0;
    }
}
