<?php

namespace Database\Seeders;

use App\Models\TransportDuration;
use Illuminate\Database\Seeder;

class TransportDurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['value' => 1, 'title' => ['en' => 'Duration 1', 'ru' => 'Продолжительность 1', 'uk' => 'Тривалість 1', 'pl' => 'Duration 1'], 'published' => true],
            ['value' => 2, 'title' => ['en' => 'Duration 2', 'ru' => 'Продолжительность 2', 'uk' => 'Тривалість 2', 'pl' => 'Duration 2'], 'published' => true],
            ['value' => 3, 'title' => ['en' => 'Duration 3', 'ru' => 'Продолжительность 3', 'uk' => 'Тривалість 3', 'pl' => 'Duration 3'], 'published' => true],
        ];

        foreach ($data as $item) {
            TransportDuration::query()->updateOrCreate(['value' => $item['value']], $item);
        }
    }
}
