<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CurrencyUpdateRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update-rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновляем курс валют с центрального банка';

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
        $url = 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json';
        try {
            $currencies = Currency::all();
            $rates = collect(json_decode(file_get_contents($url), true));

            foreach ($currencies as  $currency) {
                $rate = $rates->where('cc', $currency->iso)->first();
                if (! empty($rate)) {
                    $currency->course = $rate['rate'];
                    $currency->save();
                }
            }

            Cache::forget('currencies');
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
        }

        return 0;
    }
}
