<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

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
            'text'=>$this->faker->realText(2500),
        ];
    }
}
