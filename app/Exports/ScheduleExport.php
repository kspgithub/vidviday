<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\TourSchedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ScheduleExport implements FromCollection, WithHeadings, WithColumnFormatting, WithStyles, ShouldAutoSize, WithTitle, WithEvents, WithCustomStartCell
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $from = site_option('export_from');
        $to = site_option('export_to');

        $query = TourSchedule::inFuture()->with(['tour'])
            ->whereHas('tour', fn($q) => $q->where('export', 1))
            ->orderBy('start_date');

        if($from) {
            $query->where('start_date', '>=', $from);
        }

        if($to) {
            $query->where('start_date', '<=', $to);
        }

        return $query->get()->map(function (TourSchedule $item) {
            return [
                'tour' => $item->tour->title,
                'start_date' => date_title($item->start_date),
                'end_date' => date_title($item->end_date),
                'duration' => $item->tour->format_duration,
                'price' => $item->price,
                'currency' => $item->currency,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Тур',
            'Дата виїзду',
            'Дата повернення',
            'Тривалість',
            'Ціна',
            'Валюта',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $styles = [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
            'D' => ['alignment' => ['wrap' => true]],
            'E' => ['alignment' => ['wrap' => true]],
            'F' => ['alignment' => ['wrap' => true]],
            'G' => ['alignment' => ['wrap' => true]],
        ];

        if (!is_tour_agent()) {
            $styles[3] = ['font' => ['bold' => true]];
        }

        return $styles;
    }

    public function columnFormats(): array
    {
        return [
            'A' => DataType::TYPE_STRING,
            'B' => DataType::TYPE_STRING,
            'C' => DataType::TYPE_STRING,
            'D' => DataType::TYPE_STRING,
            'E' => NumberFormat::FORMAT_NUMBER_00,
            'F' => DataType::TYPE_STRING,
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

                if(!is_tour_agent()) {
                    $worksheet->mergeCells('A1:F2');
                    $worksheet->setCellValue('A1', $this->title());

                }

                $rows = $this->collection()->count() + (is_tour_agent() ? 3 : 5);

                if(!is_tour_agent()) {
                    $worksheet->setCellValue('A' . $rows, 'Контакти');
                    $worksheet->setCellValue('B' . $rows, site_option('document_contacts'));
                    $worksheet->mergeCells("B$rows:F$rows");
                }

                $worksheet->getStyle('A1:A' . $worksheet->getHighestRow())->getAlignment()->setVertical('center')->setWrapText(true);
                $worksheet->getStyle('B1:B' . $worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('C1:C' . $worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('D1:D' . $worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('E1:E' . $worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('F1:F' . $worksheet->getHighestRow())->getAlignment()->setWrapText(true);
            },
        ];
    }

    public function title(): string
    {
        return site_option('document_title');
    }

    public function startCell(): string
    {
        return is_tour_agent() ? 'A1' : 'A3';
    }
}
