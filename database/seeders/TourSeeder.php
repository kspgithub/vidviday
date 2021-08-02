<?php

namespace Database\Seeders;

use App\Models\Badge;
use App\Models\Direction;
use App\Models\Place;
use App\Models\Tour;
use App\Models\TourGroup;
use App\Models\TourSchedule;
use App\Models\TourSubject;
use App\Models\TourType;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TourSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->disableForeignKeys();
        $this->truncateMultiple([
            'tours_directions',
            'tour_badges',
            'tours_tour_groups',
            'tours_subjects',
            'tours_tour_types',
            'tours_places',
            'tour_schedules',
            'tours',
        ]);

        $directions = Direction::all();
        $badges = Badge::all();
        $groups = TourGroup::all();
        $subjects = TourSubject::all();
        $types = TourType::all();
        $places = Place::all();

        $start_date = Carbon::now()->subDays(5);
        $dates = collect();
        for ($i = 1; $i < 100; $i += 7) {
            $dates->add((clone $start_date)->addDays($i));
        }



        Tour::factory()->count(100)
            ->create()->each(function (Tour $item) use ($directions, $badges, $groups, $subjects, $types, $places, $dates) {
                $item->directions()->attach($directions->random(2)->pluck('id')->toArray());
                $item->badges()->attach($badges->random(2)->pluck('id')->toArray());
                $item->groups()->attach($groups->random(2)->pluck('id')->toArray());
                $item->subjects()->attach($subjects->random(2)->pluck('id')->toArray());
                $item->types()->attach($types->random(2)->pluck('id')->toArray());
                $item->places()->attach($places->random(4)->pluck('id')->toArray());

                $itemDates = $dates->random(5);
                foreach ($itemDates as $date) {
                    $item->scheduleItems()->save(TourSchedule::factory()->createOne([
                        'start_date' => $date,
                        'end_date' => (clone $date)->addDays($item->duration),
                        'tour_id' => $item->id,
                    ]));
                }

            });

        $this->enableForeignKeys();
    }
}
