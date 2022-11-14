<?php

namespace Database\Seeders;

use App\Models\HtmlBlock;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class HtmlBlockSeeder extends Seeder
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
        $this->truncate('html_blocks');

        $blocks = [
            [
                'title' => [
                    'uk' => 'Правила замовлення турів',
                    'en' => 'Rules for booking tours',
                ],
                'text' => [
                    'uk' => 'Замовлення туру відбувається у три основні етапи: запит, бронювання (підтвердження), оплата. У випадку відсутності місць пропонується додатковий проміжний етап між запитом та бронюванням: резерв (включення до списку очікування). Запит на наявність вільних місць в турах можна подати через сайт.
На березі річки Манявки розташований один із найбільших духовних центрів Західної України – «Український Афон». Історико-архітектурний заповідник «Скит Манявський» був заснований як монастир-скит у мальовничому куточку Карпат вихідцем з Афону Йовом Княгинецьким (1606р.). У часи найбільшого розквіту скитові підпорядковувалося 556 монастирів Східної Європи. Зараз тут Манявський Хресто-Воздвиженський чоловічий монастир УПЦ КП. Віруючі можуть помолитися в багатьох храмах, а також відвідати «Блаженний камінь» – цілюще джерело, яке б’є з каменя-пісковика і вода якого має такі властивості, як води Люрду.',
                    'en' => 'Booking a tour takes place in three main stages: request, booking (confirmation), payment. In case of no seats, an additional intermediate stage between the request and the reservation is offered: reserve (inclusion in the waiting list). Requests for available seats in the tours can be submitted through the site.
On the banks of the Manyavka River is one of the largest spiritual centers of Western Ukraine - "Ukrainian Athos". The Manyavsky Hermitage Historical and Architectural Reserve was founded as a hermitage monastery in a picturesque corner of the Carpathians by Yov Knyagynetsky (1606), a native of Mount Athos. During the heyday of the hermitage, 556 monasteries of Eastern Europe were subordinated to the hermitage. Now here Manyavsky Cross-Exaltation Monastery of the UOC-KP. Believers can pray in many temples, as well as visit the Blessed Stone, a healing spring that springs from sandstone and whose water has properties such as the waters of Lourdes.',
                ],
                'slug' => 'booking-tour-rules',
            ],
        ];

        foreach ($blocks as $block) {
            HtmlBlock::create($block);
        }
    }
}
