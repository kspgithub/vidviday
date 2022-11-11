<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        \Storage::makeDirectory('public/banners');
        $image = $this->faker->image('storage/app/public/banners', 948, 516, null, false);

        return [
            //
            'title' => $this->faker->realText(50),
            'text' => $this->faker->realText(100),
            'show_price' => 1,
            'url' => '#',
            'price' => 745,
            'currency' => 'UAH',
            'price_comment' => 'вартість з однієї особи',
            'label' => 'Хіт продажу',
            'color' => '#FFB947',
            'image' => 'public/banners/'.$image,
        ];
    }
}
