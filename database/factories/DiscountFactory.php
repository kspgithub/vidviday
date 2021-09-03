<?php

namespace Database\Factories;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DiscountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Discount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = $this->faker->randomElement([0, 1]);
        $start_date = $this->faker->randomElement([null, Carbon::now()->addDays($this->faker->randomElement([-10, 10]))]);

        return [
            //
            'type' => $type,
            'price' => $type === 1 ? $this->faker->randomElement([5, 10, 15, 20, 30]) : $this->faker->randomElement([100, 200, 300]),
            'title' => implode(' ', $this->faker->words(2)),
            'start_date' => $start_date,
            'end_date' => is_null($start_date) ? null : $start_date->addDays(30),
            'currency' => 'UAH',
        ];
    }
}
