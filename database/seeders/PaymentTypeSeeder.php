<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
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

        $this->truncateMultiple([
            'payment_types',
        ]);

        $types = [
            [
                'title' => [
                    'uk' => 'За банківськими реквізитами (для звичайних фізичних осіб)',
                ],
                'published' => 1,
                'slug' => 'bank-details-individual',
            ],
            [
                'title' => [
                    'uk' => 'За банківськими реквізитами (для ФОП та юридичних осіб, які є платниками єдиного податку)',
                ],
                'published' => 1,
                'slug' => 'bank-details-single-tax',
            ],
            [
                'title' => [
                    'uk' => 'За банківськими реквізитами (для ФОП та юридичних осіб, які не є платниками єдиного податку)',
                ],
                'published' => 1,
                'slug' => 'bank-details-not-single-tax',
            ],
            [
                'title' => [
                    'uk' => 'Оплата в офісі',
                ],
                'published' => 1,
                'slug' => 'office',
            ],
            [
                'title' => [
                    'uk' => 'Онлайн-оплата (LiqPay)',
                ],
                'published' => 1,
                'slug' => 'online',
            ]
        ];

        foreach ($types as $type) {
            PaymentType::create($type);
        }


        $this->enableForeignKeys();
    }
}
