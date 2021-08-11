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
                'title'=>['uk'=>'Керівник єкскурсійних груп', 'ru'=>'Руководитель экскурсионных групп', 'en'=>'Excursion groups leader', 'pl'=>'Kierownik grup wycieczkowych'],
            ],
            [
                'title'=>['uk'=>'Офісний працівник', 'ru'=>'Офисный работник', 'en'=>'Office worker', 'pl'=>'Pracownik biurowy'],
            ],
            [
                'title'=>['uk'=>'Спеціаліст з бронювання', 'ru'=>'Специалист по бронированию', 'en'=>'Booking specialist', 'pl'=>'Specjalista rezerwacji'],
            ],
            [
                'title'=>['uk'=>'Менеджер з персоналу', 'ru'=>'Менеджер по персоналу', 'en'=>'HR Manager', 'pl'=>'Menedżer HR'],
            ],
            [
                'title'=>['uk'=>'Менеджер з продажу подарункових сертифікатів', 'ru'=>'Менеджер по продажам подарочных сертификатов', 'en'=>'Gift Certificate Sales Manager', 'pl'=>'Menedżer sprzedaży bonów upominkowych'],

            ],
        ];

        foreach ($staff_types as $staff_type) {
            StaffType::factory()->createOne($staff_type);
        }
    }
}
