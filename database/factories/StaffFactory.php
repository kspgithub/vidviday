<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'position' => $this->faker->text(50),
            'text' => $this->faker->text(1000),
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
