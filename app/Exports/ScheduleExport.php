<?php

namespace App\Exports;

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

class ScheduleExport implements FromCollection, WithHeadings, WithColumnFormatting, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TourSchedule::inFuture()->with(['tour'])->orderBy('start_date')->get()->map(function (TourSchedule $item) {
            return [
                'start_date' => $item->start_date->format('d.m.Y'),
                'end_date' => $item->end_date->format('d.m.Y'),
                'tour' => $item->tour->title,
                'price' => $item->price,
                'currency' => $item->currency,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Дата виїзду',
            'Дата повернення',
            'Тур',
            'Ціна',
            'Валюта',
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
            'B' => DataType::TYPE_STRING,
            'C' => DataType::TYPE_STRING,
            'D' => NumberFormat::FORMAT_NUMBER_00,
            'E' => DataType::TYPE_STRING,
        ];
    }

    /**
     * Write code on Method
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $worksheet = $event->getSheet()->getDelegate();
                $worksheet->getStyle('A1:A'.$worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('B1:B'.$worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('C1:C'.$worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('D1:D'.$worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('E1:E'.$worksheet->getHighestRow())->getAlignment()->setWrapText(true);
            },
        ];
    }
}
