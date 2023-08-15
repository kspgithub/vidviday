<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use App\Models\Testimonial;

class TestimonialsImport implements ToCollection, WithHeadingRow, WithCustomCsvSettings
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if(!empty($row['tour_id'])){
                Testimonial::create([
                    'model_type' => 'App\Models\Tour',
                    'model_id' => $row['tour_id'],
                    'rating' => $row['rating'],
                    'name' => $row['name'],
                    'text' => $row['text'],
                    'created_at' => $row['date'] .' '. $row['time'],
                    'imported' => '1',
                ]);
            }
        }
    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ";"
        ];
    }
}
