<?php

namespace App\Console\Commands;

use App\Lib\Bitrix24\Lists\TourLists;
use App\Models\Tour;
use App\Models\TourPlan;
use Illuminate\Console\Command;

class BitrixTourSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bitrix:tour-sync';

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
        $items = TourLists::getAll();
        foreach ($items as $item_data) {
            if (Tour::whereBitrixId($item_data->id)->count() === 0) {
                $data = [
                    'title' => $item_data->name,
                    'bitrix_id' => $item_data->id,
                    'bitrix_manager_id' => $item_data->manager_id,
                    'duration' => $item_data->duration,
                    'nights' => $item_data->duration,
                    'text' => '',
                    'short_text' => '',
                    'price' => $item_data->price ?? 0,
                    'currency' => $item_data->currency ?? 'UAH',
                    'commission' => $item_data->commission ?? 0,
                ];

                $tour = new Tour();
                $tour->fill($data);
                $tour->published = 0;
                $tour->save();
                if (!empty($item_data->plan)) {
                    $tourPlan = new TourPlan();
                    $tourPlan->setLocale('uk');
                    $tourPlan->tour_id = $tour->id;
                    $tourPlan->text = $item_data->plan;
                    $tourPlan->save();
                }
            }

        }

        return 0;
    }
}
