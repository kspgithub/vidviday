<?php

namespace Database\Seeders;

use App\Lib\Bitrix24\CRM\Dynamic\BitrixTour;
use App\Models\Badge;
use App\Models\Direction;
use App\Models\Food;
use App\Models\Media;
use App\Models\Place;
use App\Models\Staff;
use App\Models\Testimonial;
use App\Models\Ticket;
use App\Models\Tour;
use App\Models\TourGroup;
use App\Models\TourPlan;
use App\Models\TourSchedule;
use App\Models\TourSubject;
use App\Models\TourType;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TourBitrixSeeder extends Seeder
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
            'tour_plans',
            'tours_staff',
            'tour_schedules',
            'tour_questions',
            'tours',
        ]);

        Media::where('model_type', Tour::class)->delete();
        Testimonial::where('model_type', Tour::class)->orWhere('related_type', Tour::class)->delete();

        $directions = Direction::select('id')->get();
        $badges = Badge::select('id')->get();
        $groups = TourGroup::select('id')->get();
        $subjects = TourSubject::select('id')->get();
        $types = TourType::select('id')->get();
        $places = Place::select('id')->get();
        $foods = Food::select('id')->get();
        $tickets = Ticket::select('id')->get();
        $managers = Staff::query()->whereHas('types', function (Builder $q) {
            return $q->where('slug', 'tour-manager');
        })->get();
        $leaders = Staff::query()->whereHas('types', function (Builder $q) {
            return $q->where('slug', 'excursion-leader');
        })->get();

        $dates = collect();
        for ($i = 1; $i < 300; $i += 1) {
            $dates->add($i);
        }

        $faker = FakerFactory::create('uk_UA');

        $items = BitrixTour::getAll();

        foreach ($items as $item_data) {
            /**
             * @var Tour $tour
             */
            $item = Tour::factory()->createOne([
                'title' => ['uk' => $item_data->title],
                'bitrix_id' => $item_data->bitrix_id,
                'duration' => $item_data->duration,
                'nights' => $item_data->duration,
                'price' => $item_data->price,
                'commission' => $item_data->commission,
                'text' => $faker->realText(1500),
                'short_text' => $faker->realText(500),
            ]);

            $item->directions()->attach($directions->random(2)->pluck('id')->toArray());
            $item->badges()->attach($badges->random(random_int(1, 2))->pluck('id')->toArray());
            $item->groups()->attach($groups->random(2)->pluck('id')->toArray());
            $item->subjects()->attach($subjects->random(2)->pluck('id')->toArray());
            $item->types()->attach($types->random(2)->pluck('id')->toArray());
            $item->places()->attach($places->random(4)->pluck('id')->toArray());
            $item->staff()->attach($managers->random(1)->pluck('id')->toArray());
            $item->staff()->attach($leaders->random(2)->pluck('id')->toArray());

            $plan_text = '<ul>';
            for ($day = 1; $day <= $item->duration; $day++) {
                $text = $faker->realText();
                $plan_text .= "<li><strong>$day день</strong><div>$text</div></li>";
            }
            $plan_text = '</ul>';
            $planItem = new TourPlan();
            $planItem->tour_id = $item->id;
            $planItem->text = $plan_text;
            $planItem->save();

            $itemDates = $dates->random(3);
            foreach ($itemDates as $date) {
                $start_date = Carbon::now()->subDays(30)->addDays($date);

                $item->scheduleItems()->save(TourSchedule::factory()->createOne([
                    'start_date' => $start_date,
                    'end_date' => (clone $start_date)->addDays($item->duration),
                    'tour_id' => $item->id,
                ]));
            }
        }
    }
}
