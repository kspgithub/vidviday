<?php

namespace App\Exports;

use App\Models\AccommodationType;
use App\Models\Order;
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

class OrdersExport extends DefaultValueBinder implements
    FromCollection,
    WithHeadings,
    WithColumnFormatting,
    WithStyles,
    ShouldAutoSize,
    WithCustomValueBinder,
    WithEvents
{
    protected $items;

    protected $roomTypes;

    public function __construct($orders)
    {
        $this->roomTypes = AccommodationType::all();
        $this->items = $orders->map(function (Order $order) {
            return [
                'id' => (string)$order->id,
                'status' => $order->status_text,
                'total_places' => (string)$order->total_places,
                'participants' => $this->getParticipantsText($order),
                'contacts' => $this->getContactsText($order),
                'accommodation' => $this->getAccommodationText($order),
                'sum_total' => (string)$order->total_price,
                'payment_fop' => (string)$order->payment_fop,
                'payment_tov' => (string)$order->payment_tov,
                'payment_office' => (string)$order->payment_office,
                'payment_get' => (string)$order->payment_get,
                'admin_comment' => $order->admin_comment,
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
            'Осіб',
            'ПІБ',
            'Контакти',
            'Нічліг',
            'Сума загалом',
            'Оплата ФОП',
            'Оплата ТОВ',
            'Оплата в офісі',
            'До збирати',
            'Примітки',
        ];
    }

    protected function getParticipantsText(Order $order)
    {
        $rows = [];
        $participants = (object)$order->participants ?? [];
        if (!empty($participants->items)) {
            foreach ($participants->items as $item) {
                $rows[] = "{$item['last_name']} {$item['first_name']} {$item['middle_name']} {$item['birthday']}";
            }
        }

        return implode("\n", $rows);
    }

    protected function getContactsText(Order $order)
    {
        $rows = [];
        $rows[] = "{$order->last_name} {$order->first_name}";
        $rows[] = "Тел: {$order->phone}";
        if (!empty($order->email)) {
            $rows[] = "Email: {$order->email}";
        }
        if (!empty($order->agency_data) && !empty($order->agency_data['title'])) {
            $rows[] = '----------------';
            $agencyData = (object)$order->agency_data;
            $rows[] = !empty($agencyData->affiliate) ? "$agencyData->title ($agencyData->affiliate)" : $agencyData->title;
            $rows[] = $agencyData->manager_name;
            $rows[] = $agencyData->manager_phone;
            $rows[] = "Тел: {$agencyData->manager_phone}";
            if (!empty($agencyData->manager_email)) {
                $rows[] = "Email: {$agencyData->manager_email}";
            }
        }

        return implode("\n", $rows);
    }

    public function getAccommodationText(Order $order)
    {
        $rows = [];
        if (!empty($order->accommodation)) {
            foreach ($order->accommodation as $key => $value) {
                if ($key !== 'other' && $key !== 'other_text' && (int)$value > 0) {
                    $accom = $this->roomTypes->where('slug_key', '=', $key)->first();
                    $rows[] = !empty($accom) ? "$accom->title: $value" : "$key: $value";
                }
                if ($key === 'other_text' && !empty($value)) {
                    $rows[] = "Інше: $value";
                }
            }
        }

        return implode("\n", $rows);
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
            'G' => NumberFormat::FORMAT_NUMBER_00,
            'H' => NumberFormat::FORMAT_NUMBER_00,
            'I' => NumberFormat::FORMAT_NUMBER_00,
            'J' => NumberFormat::FORMAT_NUMBER_00,
            'K' => NumberFormat::FORMAT_NUMBER_00,
            'L' => DataType::TYPE_STRING,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
            'D' => ['alignment' => ['wrap' => true]],
            'E' => ['alignment' => ['wrap' => true]],

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
     *
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $worksheet = $event->getSheet()->getDelegate();
                $worksheet->getStyle('D1:D' . $worksheet->getHighestRow())->getAlignment()->setWrapText(true);
                $worksheet->getStyle('E1:E' . $worksheet->getHighestRow())->getAlignment()->setWrapText(true);
            },
        ];
    }
}
