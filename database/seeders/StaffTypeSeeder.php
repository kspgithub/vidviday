<?php

namespace Database\Seeders;

use App\Models\StaffType;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class StaffTypeSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->truncate('staff_types');

        $staff_types = [
            [
                'title'=>['Керівник єкскурсійних груп'],
            ],
            [
                'title'=>['Офісний працівник'],
            ],
            [
                'title'=>['Спеціаліст з бронювання'],
            ],
            [
                'title'=>['Менеджер з персоналу'],
            ],
            [
                'title'=>['Менеджер з продажу подарункових сертифікатів'],

            ],
        ];

        foreach ($staff_types as $staff_type) {
            StaffType::factory()->createOne($staff_type);
        }
    }
}
