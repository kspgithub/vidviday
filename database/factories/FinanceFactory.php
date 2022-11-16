<?php

namespace Database\Factories;

use App\Models\Finance;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Finance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $html = '<ul>';
        for ($i =0; $i < 5; $i++) {
            $text = $this->faker->realText(20);
            $html .= "<li>$text</li>";
        }
        $html .= '</ul>';

        return [
            //
            'type_id'=>$this->faker->randomElement([1,2]),
            'title' => $this->faker->realText(50),
            'text' => $html,
            'published' => 1
        ];
    }
}
