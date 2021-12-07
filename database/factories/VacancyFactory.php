<?php

namespace Database\Factories;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

class VacancyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vacancy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'staff_id' => $this->faker->randomElement([1, 2]),
            'title' => $this->faker->realText(50),
            'text' =>  $this->faker->realText(1500),
            'published' => 1,
            'similar' => [1, 2, 3, 4, 5, 6]
        ];
    }
}
