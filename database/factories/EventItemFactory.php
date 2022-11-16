<?php

namespace Database\Factories;

use App\Models\EventItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class EventItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->realText(50);
        $indefinite = $this->faker->randomElement([0, 1]);
        return [
            //
            'title' => $title,
            'slug' => Str::slug($title),
            'text' => $this->faker->realText(1500),
            'indefinite' =>$indefinite,
            'start_date' => $indefinite ? Carbon::now()->addDays(30) : null,
            'end_date' => $indefinite ? Carbon::now()->addDays(37) : null,
            'published' => 1,
        ];
    }
}
