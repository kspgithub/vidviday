<?php

namespace App\Exports;

use App\Models\TourVoting;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VotingsExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithColumnFormatting, WithStyles, ShouldAutoSize, WithCustomValueBinder, WithEvents
{
    protected $items;

    public function __construct($votings)
    {
        $this->items = $votings->map(function (TourVoting $voting) {
            return [
                'id' => (string) $voting->id,
                'status' => $voting->status_text,
                'name' => $voting->name,
                'email' => $voting->email,
                'phone' => $voting->phone,
                'ip' => $voting->ip,
                'date' => $voting->created_at,
            ];
        });
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->items;
    }

    public function headings(): array
    {
        return [
            '#',
            'Статус',
            'ім\'я',
            'Email',
            'Телефон',
            'IP',
            'Час',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => DataType::TYPE_STRING,
            'C' => NumberFormat::FORMAT_NUMBER,
            'D' => DataType::TYPE_STRING,
            'E' => DataType::TYPE_STRING,
            'F' => DataType::TYPE_STRING,
            'G' => DataType::TYPE_STRING,
            'H' => NumberFormat::FORMAT_NUMBER_00,
            'I' => NumberFormat::FORMAT_NUMBER_00,
            'J' => NumberFormat::FORMAT_NUMBER_00,
            'K' => NumberFormat::FORMAT_NUMBER_00,
            'L' => NumberFormat::FORMAT_NUMBER_00,
            'M' => DataType::TYPE_STRING,
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

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_NUMERIC);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    /**
     * Write code on Method
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $worksheet = $event->getSheet()->getDelegate();
                $worksheet->getStyle('D1:D'.$worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('E1:E'.$worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('F1:F'.$worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('G1:G'.$worksheet->getHighestRow())->getAlignment()->setWrapText(true);
            },
        ];
    }
}
