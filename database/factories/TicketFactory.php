<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'region_id' => $this->faker->randomElement([1, 2, 8, 13]),
            'title' => 'Квиток '.$this->faker->realText(50),
            'text' => $this->faker->realText(),
            'price' => $this->faker->numberBetween(1, 10) * 10,
            'currency' => 'UAH',
            'published' => 1,
        ];
    }
}
