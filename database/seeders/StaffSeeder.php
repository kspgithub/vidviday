<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\StaffType;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
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
        $this->truncate('staff');

        $types = StaffType::all();

        Staff::factory()->count(20)->create()->each(function (Staff $item) use ($types) {
            $type = $types->random(1)->first();
            $item->types()->sync([$type->id]);
            switch ($type->id) {
                case 1:
                    $item->label = json_decode('{"uk":"Менеджер туру","ru":"Менеджер тура","en":"Tour manager","pl":"Kierownik wycieczki"}', true);
                    break;
                case 2:
                    $item->label = json_decode('{"uk":"Екскурсовод","ru":"Экскурсовод","en":"Guide","pl":"Przewodnik"}', true);
                    break;
                case 3:
                    $item->label = json_decode('{"uk":"Офісний працівник","ru":"Офисный работник","en":"Office worker","pl":"Pracownik biurowy"}', true);
                    break;
                case 4:
                    $item->label = json_decode('{"uk":"Замовлення турів","ru":"Заказ туров","en":"Book tours","pl":"Zarezerwuj wycieczki"}', true);
                    break;
                case 5:
                    $item->label = json_decode('{"uk":"HR Менеджер","ru":"HR Менеджер","en":"HR Manager","pl":"Menedżer HR"}', true);
                    break;
                case 6:
                    $item->label = json_decode('{"uk":"Замовлення сертифікатів","ru":"Заказ сертификатов","en":"Ordering certificates","pl":"Zamawianie certyfikatów"}', true);
                    break;
                case 7:
                    $item->label = json_decode('{"uk":"Корпоративи","ru":"Корпоративы","en":"Corporates","pl":"Zlecenia korporacyjne"}', true);
                    break;
                case 8:
                    $item->label = json_decode('{"uk":"Менеджер","ru":"Менеджер","en":"Manager","pl":"Menedżer"}', true);
                    break;
            }

            $item->position = $type->getTranslations('title');
            $item->save();
        });

        $this->enableForeignKeys();
    }
}
