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
            ['key' => 'moderate_testimonials', 'value' => true, 'title' => 'Модерация відгуків', 'primary' => true, 'type' => 'boolean'],
            ['key' => 'moderate_questions', 'value' => true, 'title' => 'Модерация питань', 'primary' => true, 'type' => 'boolean'],
            ['key' => 'from_email', 'value' => 'support@vidviday.ua', 'title' => 'Email підтримки', 'primary' => true, 'type' => 'string'],
            ['key' => 'notify_email', 'value' => 'support@vidviday.ua', 'title' => 'Email для сповіщення з форм', 'primary' => true, 'type' => 'string'],
            ['key' => 'order_email', 'value' => 'support@vidviday.ua', 'title' => 'Email менеджера по замовленням', 'primary' => true, 'type' => 'string'],
            ['key' => 'tour_agent_email', 'value' => 'support@vidviday.ua', 'title' => 'Email менеджера по турагентам', 'primary' => true, 'type' => 'string'],
            ['key' => 'certificate_email', 'value' => 'support@vidviday.ua', 'title' => 'Email менеджера по сертифікатам', 'primary' => true, 'type' => 'string'],
            ['key' => 'transport_email', 'value' => 'support@vidviday.ua', 'title' => 'Email менеджера по транспорту', 'primary' => true, 'type' => 'string'],
        ];

        foreach ($site_options as $option) {
            SiteOption::createOption($option['key'], $option['value'], $option['title'], $option['primary'] ?? false, $option['type'] ?? null);
        }
        SiteOption::clearCache();
    }
}
