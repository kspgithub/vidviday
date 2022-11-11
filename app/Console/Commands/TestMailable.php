<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\Email\EmailTemplateController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TestMailable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailable:test {--to=} {--class=}';

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
        $mailableClass = $this->option('class');

        if ($mailableClass === 'all') {
            $emailTemplateController = new EmailTemplateController();

            $mailables = $emailTemplateController->getTemplates();

            foreach ($mailables as $mailable) {
                $this->send($mailable);
            }
        } else {
            if (! Str::startsWith($mailableClass, ['App\Mail', 'App\\Mail'])) {
                $mailableClass = 'App\Mail\\'.$mailableClass;
            }

            $this->send($mailableClass);
        }

        return 0;
    }

    public function send($mailableClass)
    {
        $to = $this->option('to') ?: config('mail.from.address');

        if (class_exists($mailableClass)) {
            $mailable = new $mailableClass();

            try {
                $this->info('Sending '.$mailableClass.'...');
                Mail::to($to)->send($mailable);
                $this->info($mailableClass.' sent.');
            } catch (\Exception $e) {
                $this->error($mailableClass.' failed: '.$e->getMessage());
            }
        } else {
            $this->error($mailableClass.' class doesnt exists.');
            throw new \Exception('Mailable doesnt exists');
        }

        sleep(3);
    }
}
