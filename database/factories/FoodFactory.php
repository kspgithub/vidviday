<?php

namespace Database\Factories;

use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

class FoodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Food::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->realText(50),
            'text' => $this->faker->realText(),
            'price' => $this->faker->numberBetween(1, 10) * 10,
            'currency' => 'UAH',
            'published' => 1,
        ];
    }
}
