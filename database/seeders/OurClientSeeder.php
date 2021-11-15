<?php

namespace Database\Seeders;

use App\Models\OurClient;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class OurClientSeeder extends Seeder
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
        $this->truncate('our_clients');

        $items = [
            [ 'title'=>['uk'=>'Кліент 1'] , 'image'=>'/img/logo_1.png', 'published'=>1],
            [ 'title'=>['uk'=>'Кліент 2'] , 'image'=>'/img/logo_2.png', 'published'=>1],
            [ 'title'=>['uk'=>'Кліент 3'] , 'image'=>'/img/logo_3.png', 'published'=>1],
            [ 'title'=>['uk'=>'Кліент 4'] , 'image'=>'/img/logo_4.png', 'published'=>1],
            [ 'title'=>['uk'=>'Кліент 5'] , 'image'=>'/img/logo_5.png', 'published'=>1],
            [ 'title'=>['uk'=>'Кліент 6'] , 'image'=>'/img/logo_6.png', 'published'=>1],
        ];

        foreach ($items as $item) {
            OurClient::create($item);
        }
    }
}
