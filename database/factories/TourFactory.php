<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

class TourFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tour::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $duration = $this->faker->randomElement([1, 3, 5, 7, 10]);
        return [
            //
            'title'=>['uk'=> $this->faker->text(30)],
            'duration' => $duration,
            'nights' => $this->faker->randomElement([$duration - 1, $duration]),
            'short_text'=>$this->faker->text(250),
            'text'=>$this->faker->text(1000),
            'published'=>1,
            'price'=> $this->faker->randomElement([1000, 2000, 3000, 5000, 10000]),
            'currency'=> 'UAH',
            'rating' => $this->faker->randomElement([0, 3, 4, 5]),
        ];
    }



}
