<?php

namespace Database\Seeders;

use App\Models\VisualOption;
use Illuminate\Database\Seeder;

class VisualOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $visual_options = [
            [
                'key' => 'gift_image',
                'value' => '',
                'title' => 'Gift Image',
                'primary' => true,
                'type' => VisualOption::TYPE_IMAGE,
            ],
        ];

        foreach ($visual_options as $option) {
            $setting = VisualOption::getValue($option['key']);

            if (is_null($setting)) {
                VisualOption::createOption(
                    $option['key'],
                    $option['value'],
                    $option['title'],
                    $option['primary'] ?? false,
                    $option['type'] ?? null
                );
            }
        }

        // Delete outdated
        VisualOption::query()
            ->whereNotIn('key', array_column($visual_options, 'key'))
            ->delete();

        VisualOption::clearCache();
    }
}