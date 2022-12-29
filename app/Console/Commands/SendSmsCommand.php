<?php

namespace App\Console\Commands;

use Daaner\TurboSMS\Facades\TurboSMS;
use Illuminate\Console\Command;

class SendSmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:send
        {phone}
        {message}
        {--viber}';

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
        $phone = $this->argument('phone');
        $message = $this->argument('message');
        $type = $this->option('viber') ? 'viber' : 'sms';
        $response = TurboSMS::sendMessages($phone, $message, $type);

//        dump($response);
        /**
        [
            "success" => true
            "result" => array:1 [
                0 => array:4 [
                "phone" => "000000000000"
                "message_id" => "00000000-0000-0000-0000-000000000000"
                "response_code" => 0
                "response_status" => "OK"
                ]
            ]
            "info" => "Повідомлення успішно надіслано"
        ]
        */

        if (!($response['success'] ?? false)) {
            $this->error($response['info'] ?? 'Error');
        }

        $this->info($response['info']);

        return Command::SUCCESS;
    }
}
