<?php

namespace Database\Factories;

use App\Models\StaffType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StaffTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StaffType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->realText(50);

        return [
            //
           'title' => $title,
           'slug' => Str::slug($title),
        ];
    }
}
