<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
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
        $this->truncate('achievements');

        $items = [
            [ 'title'=>['uk'=>'<p>&nbsp;<b>6,4%</b> ринку внутрішнього туризму</p>'] , 'image'=>'/icon/pie-chart.svg', 'published'=>1],
            [ 'title'=>['uk'=>'<p>Більше <b>197 000</b> туристів</p>'] , 'image'=>'/icon/signpost.svg', 'published'=>1],
            [ 'title'=>['uk'=>'<p><b>282</b> Авторських турів та екскурсій</p>'] , 'image'=>'/icon/tourist.svg', 'published'=>1],
            [ 'title'=>['uk'=>'<p>Партнерство з <b>560</b> турагентами</p>'] , 'image'=>'/icon/network.svg', 'published'=>1],
            [ 'title'=>['uk'=>'<p>&nbsp;<b>6,4%</b> ринку внутрішнього туризму</p>'] , 'image'=>'/icon/pie-chart.svg', 'published'=>1],
            [ 'title'=>['uk'=>'<p>Більше <b>197 000</b> туристів</p>'] , 'image'=>'/icon/signpost.svg', 'published'=>1],
            [ 'title'=>['uk'=>'<p><b>282</b> Авторських турів та екскурсій</p>'] , 'image'=>'/icon/tourist.svg', 'published'=>1],
            [ 'title'=>['uk'=>'<p>Партнерство з <b>560</b> турагентами</p>'] , 'image'=>'/icon/network.svg', 'published'=>1],
        ];

        foreach ($items as $item) {
            Achievement::create($item);
        }
    }
}
