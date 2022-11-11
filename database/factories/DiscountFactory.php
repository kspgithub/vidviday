<?php

namespace Database\Factories;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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
        $type = $this->faker->randomElement(array_keys(Discount::$types));
        $price = $type === 1 ? $this->faker->randomElement([5, 10, 15, 20, 30]) : $this->faker->randomElement([100, 200, 300]);
        $start_date = $this->faker->randomElement([null, Carbon::now()->addDays($this->faker->randomElement([-10, 10]))]);
        $category = $this->faker->randomElement(array_keys(Discount::$categories));
        $duration = $this->faker->randomElement(array_keys(Discount::$durations));
        $title = 'Знижка '.$price.Discount::$types[$type].', '.Discount::$categories[$category].', '.Discount::$durations[$duration];

        return [
            //
            'type' => $type,
            'price' => $price,
            'title' => $title,
            'start_date' => $start_date,
            'end_date' => is_null($start_date) ? null : $start_date->addDays(30),
            'currency' => 'UAH',
            'category' => $category,
            'duration' => $duration,
            'slug' => Str::slug($title),
        ];
    }
}
