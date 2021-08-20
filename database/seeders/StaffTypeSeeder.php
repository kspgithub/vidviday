<?php

namespace Database\Seeders;

use App\Models\StaffType;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class StaffTypeSeeder extends Seeder
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
        $this->disableForeignKeys();
        $this->truncate('staff_types');

        $staff_types = [
            [
                'title' => ['uk' => 'Менеджер туру', 'ru' => 'Менеджер тура',
                    'en' => 'Tour manager', 'pl' => 'Kierownik wycieczki'],
                'slug' => 'tour-manager',
            ],
            [
                'title' => ['uk' => 'Керівник єкскурсійних груп', 'ru' => 'Руководитель экскурсионных групп',
                    'en' => 'Excursion groups leader', 'pl' => 'Kierownik grup wycieczkowych'],
                'slug' => 'excursion-leader',
            ],
            [
                'title' => ['uk' => 'Офісний працівник', 'ru' => 'Офисный работник',
                    'en' => 'Office worker', 'pl' => 'Pracownik biurowy'],
                'slug' => 'official',
            ],
            [
                'title' => ['uk' => 'Спеціаліст з бронювання', 'ru' => 'Специалист по бронированию',
                    'en' => 'Booking specialist', 'pl' => 'Specjalista rezerwacji'],
                'slug' => 'booking-manager',
            ],
            [
                'title' => ['uk' => 'Менеджер з персоналу', 'ru' => 'Менеджер по персоналу',
                    'en' => 'HR Manager', 'pl' => 'Menedżer HR'],
                'slug' => 'hr-manager',
            ],
            [
                'title' => [
                    'uk' => 'Менеджер з продажу подарункових сертифікатів',
                    'ru' => 'Менеджер по продажам подарочных сертификатов',
                    'en' => 'Gift Certificate Sales Manager',
                    'pl' => 'Menedżer sprzedaży bonów upominkowych'
                ],
                'slug' => 'certificate-manager',
            ],
        ];

        foreach ($staff_types as $staff_type) {
            StaffType::create($staff_type);
        }

        $this->enableForeignKeys();
    }
}
