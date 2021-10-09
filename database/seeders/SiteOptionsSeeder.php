<?php

namespace Database\Seeders;

use App\Models\SiteOption;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class SiteOptionsSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->truncate('site_options');

        $site_options = [
            ['key' => 'moderate_testimonials', 'value' => false, 'title' => 'Модерация відгуків', 'primary' => true, 'type' => 'boolean'],
            ['key' => 'moderate_questions', 'value' => false, 'title' => 'Модерация питань', 'primary' => true, 'type' => 'boolean'],
        ];

        foreach ($site_options as $option) {
            SiteOption::createOption($option['key'], $option['value'], $option['title'], $option['primary'] ?? false, $option['type'] ?? null);

        }
        SiteOption::clearCache();
    }
}
