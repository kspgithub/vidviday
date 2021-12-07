<?php

namespace Database\Factories;

use App\Models\TourAccommodation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourAccommodationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TourAccommodation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->text(50),
            'text' => $this->faker->text(500),
            'published' => 1
        ];
    }
}
