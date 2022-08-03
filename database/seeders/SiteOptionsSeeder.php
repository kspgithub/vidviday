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
//        $this->truncate('site_options');

        $site_options = [
            ['key' => 'moderate_testimonials', 'value' => true, 'title' => 'Модерация відгуків', 'primary' => true, 'type' => SiteOption::TYPE_BOOLEAN],
            ['key' => 'moderate_questions', 'value' => true, 'title' => 'Модерация питань', 'primary' => true, 'type' => SiteOption::TYPE_BOOLEAN],
            ['key' => 'from_email', 'value' => 'support@vidviday.ua', 'title' => 'Email підтримки', 'primary' => true, 'type' => SiteOption::TYPE_STRING],
            ['key' => 'notify_email', 'value' => 'support@vidviday.ua', 'title' => 'Email для сповіщення з форм', 'primary' => true, 'type' => SiteOption::TYPE_STRING],
            ['key' => 'order_email', 'value' => 'support@vidviday.ua', 'title' => 'Email менеджера по замовленням', 'primary' => true, 'type' => SiteOption::TYPE_STRING],
            ['key' => 'tour_agent_email', 'value' => 'support@vidviday.ua', 'title' => 'Email менеджера по турагентам', 'primary' => true, 'type' => SiteOption::TYPE_STRING],
            ['key' => 'certificate_email', 'value' => 'support@vidviday.ua', 'title' => 'Email менеджера по сертифікатам', 'primary' => true, 'type' => SiteOption::TYPE_STRING],
            ['key' => 'transport_email', 'value' => 'support@vidviday.ua', 'title' => 'Email менеджера по транспорту', 'primary' => true, 'type' => SiteOption::TYPE_STRING],
            ['key' => 'google_analytics', 'value' => '', 'title' => 'Google analytics', 'primary' => true, 'type' => SiteOption::TYPE_TEXT],
            ['key' => 'facebook_chat', 'value' => '', 'title' => 'Facebook chat', 'primary' => true, 'type' => SiteOption::TYPE_TEXT],
        ];

        foreach ($site_options as $option) {
            $setting = SiteOption::getValue($option['key']);

            if(!$setting) {
                SiteOption::createOption($option['key'], $option['value'], $option['title'], $option['primary'] ?? false, $option['type'] ?? null);
            }
        }

        SiteOption::clearCache();
    }
}
