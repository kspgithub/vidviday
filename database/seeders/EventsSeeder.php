<?php

namespace Database\Seeders;

use App\Models\Direction;
use App\Models\EventGroup;
use App\Models\EventItem;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
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
            'events_directions',
            'events_groups',
            'event_items',
            'event_groups',
        ]);

        $directions = Direction::inRandomOrder()->take(2)->get('id')->pluck('id');

        $eventGroups = [
            [
                'title'=>['uk'=>'Бринза'],
            ],
            [
                'title'=>['uk'=>'Новий рік в карпатах'],
            ]
        ];


        $groups = collect();



        foreach ($eventGroups as $eventGroup) {
            $group = EventGroup::create($eventGroup);
            $groups->push($group->id);
        }

        $events = EventItem::factory()->count(10)->create();

        foreach ($events as $event) {
            $event->groups()->attach($groups->random(1));
            $event->directions()->attach($directions->random(1));
        }

    }
}
