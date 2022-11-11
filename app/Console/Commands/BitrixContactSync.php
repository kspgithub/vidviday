<?php

namespace App\Console\Commands;

use App\Lib\Bitrix24\CRM\Contact\ContactService;
use App\Models\BitrixContact;
use Illuminate\Console\Command;

class BitrixContactSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bitrix:contact-sync';

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
        $fields = ['ID', 'NAME', 'LAST_NAME', 'EMAIL', 'PHONE'];
        $order = ['ID' => 'ASC'];

        $contactID = 0;
        $finish = false;

        while (! $finish) {
            $filter = ['>ID' => $contactID];
            $response = ContactService::list($fields, $filter, $order, -1);
            if (! $response->error && ! empty($response->result) > 0) {
                foreach ($response->result as $contactData) {
                    $contactID = $contactData['ID'];
                    BitrixContact::createOrUpdate($contactID, $contactData);
                }
            } else {
                $finish = true;
            }
        }

        return 0;
    }
}
