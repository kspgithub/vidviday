<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\TourSchedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TourSchedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start_date = Carbon::now()->addDays(30);
        return [
            //
            'tour_id' => Tour::factory(),
            'start_date' => $start_date,
            'end_date' =>  function (array $attributes) use ($start_date) {
                return $attributes['start_date']->addDays(Tour::find($attributes['tour_id'])->duration);
            },
            'places' => $this->faker->randomElement([5, 10, 15]),
            'price' => function (array $attributes) use ($start_date) {
                return Tour::find($attributes['tour_id'])->price;
            },
            'commission' => $this->faker->randomElement([0, 20, 30]),
            'currency' => 'UAH',
            'published' => 1
        ];
    }
}
