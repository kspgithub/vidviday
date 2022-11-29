<?php

namespace App\Exports;

use App\Models\Staff;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\TourSchedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class TestimonialExport implements FromCollection, WithHeadings, WithColumnFormatting, WithStyles, ShouldAutoSize
{
    protected $items;

    public function __construct($testimonials)
    {
        $this->items = $testimonials->map(function (Testimonial $testimonial) {
            $type = ($testimonial->model_type === Tour::class) ? __('Tour') :
                ($testimonial->model_type === Staff::class ? __('Staff') : '');

            return [
                'model_type' => $type,
                'model_id' => (string)$testimonial->model_id,
                'date' => $testimonial->created_at?->format('d.m.Y'),
                'time' => $testimonial->created_at?->format(' H:i'),
                'rating' => (string)$testimonial->rating,
                'author' => $testimonial->name,
                'text' => $testimonial->text,
            ];
        });
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->items;
    }

    public function headings(): array
    {
        return [
            'Тип',
            'ID',
            'Дата додавання відгуку',
            'Час додавання відгуку',
            'Рейтинг відгуку',
            'Ім\'я автора відгуку',
            'Текст відгуку',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
            'D' => ['alignment' => ['wrap' => true]],
            'E' => ['alignment' => ['wrap' => true]],
            'F' => ['alignment' => ['wrap' => true]],
            'G' => ['alignment' => ['wrap' => true]],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => DataType::TYPE_STRING,
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => DataType::TYPE_STRING,
            'D' => DataType::TYPE_STRING,
            'E' => NumberFormat::FORMAT_NUMBER,
            'F' => DataType::TYPE_STRING,
            'G' => DataType::TYPE_STRING,
        ];
    }

    /**
     * Write code on Method
     *
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $worksheet = $event->getSheet()->getDelegate();
                $worksheet->getStyle('A1:A' . $worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('B1:B' . $worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('C1:C' . $worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('D1:D' . $worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('E1:E' . $worksheet->getHighestRow())->getAlignment()->setWrapText(true);
            },
        ];
    }
}
