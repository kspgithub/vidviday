<?php

namespace App\Console\Commands;

use App\Mail\CustomEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MailTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test {--to=} {--message=Hello} {--subject=Hello}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Тестирование сообщений';

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
        $to = $this->option('to');
        $message = $this->option('message');
        $subject = $this->option('subject');

        if (! empty($to)) {
            Mail::to($to)->queue(new CustomEmail($message, $subject));
        }

        return 0;
    }
}
