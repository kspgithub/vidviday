<?php

namespace Database\Factories;

use App\Models\LandingPlace;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LandingPlaceFactory extends Factory
{
    protected $model = LandingPlace::class;

    public function definition(): array
    {


        return [
            'title' => ['uk' => implode(' ', $this->faker->words)],
            'description' => $this->faker->realText(),
            'slug' => $this->faker->slug(),
            'published' => 1,
            'lat' => $this->faker->latitude(48.000000, 50.000000),
            'lng' => $this->faker->longitude(22.800000, 26.000000),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
