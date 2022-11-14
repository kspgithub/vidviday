<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Direction;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PlaceFactory extends Factory
{
    /**
     * @var Collection|City[]
     */
    protected $cities;

    /**
     * @var Collection|Direction[]
     */
    protected $directions;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Place::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $city = $this->randomCity();

        $direction = $this->randomDirection();

        return [
            //
            'country_id' => $city->country_id,
            'region_id' => $city->region_id,
            'city_id' => $city->id,
            'direction_id' => $direction->id,
            'title' => $this->faker->text(20),
            'text' => $this->faker->text(1000),
            'lat' => $this->faker->latitude(48.000000, 50.000000),
            'lng' => $this->faker->longitude(22.800000, 26.000000),
            'published' => 1,
        ];
    }

    public function configure()
    {
        parent::configure();

        $this->cities = City::query()->whereIn('region_id', [2, 8, 13, 21])->inRandomOrder()->take(20)->get();
        $this->directions = Direction::all();

        return $this;
    }

    /**
     * @return City|null|Model
     */
    protected function randomCity()
    {
        return City::query()->whereIn('region_id', [2, 8, 13, 21])->inRandomOrder()->first();
    }

    /**
     * @return Direction|null|Model
     */
    protected function randomDirection()
    {
        return Direction::query()->inRandomOrder()->first();
    }
}
