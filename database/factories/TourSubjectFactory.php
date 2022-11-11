<?php

namespace Database\Factories;

use App\Models\TourSubject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TourSubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TourSubject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->realText(50);
        $slug = Str::slug($title);

        return [
            //
            'title' => $title,
            'slug' => $slug,
            'published' => 1,
        ];
    }
}
