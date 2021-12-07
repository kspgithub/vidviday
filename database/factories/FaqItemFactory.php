<?php

namespace Database\Factories;

use App\Models\FaqItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FaqItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'section'=> $this->faker->randomElement(array_keys(FaqItem::$sections)),
            'question'=> $this->faker->realText(50),
            'answer'=> $this->faker->realText(500),
        ];
    }
}
