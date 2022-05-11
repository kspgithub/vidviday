<?php

namespace App\Console\Commands;

use App\Models\TourSchedule;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class UpdatePlacesYesterday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'places_yesterday:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates yesterday booked places';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $schedules = TourSchedule::query()
            ->where(function (Builder $q) {
                return $q->orWhereNull('places_yd_updated_at')
                    ->orWhereDate('places_yd_updated_at', Carbon::yesterday());
            });

        $schedulesUpdated = 0;

        $schedules->chunkById(50, function ($chunk) use (&$schedulesUpdated) {
            foreach ($chunk as $schedule) {
                $totalPlaces = $schedule->placesBooked;

                $schedulesUpdated += $schedule->update(['places_yesterday' => $totalPlaces, 'places_yd_updated_at' => now()]);
            }
        });

        $this->info($schedulesUpdated . ' schedules updated.');

        Log::info($schedulesUpdated . ' schedules updated.');

        return 0;
    }
}
