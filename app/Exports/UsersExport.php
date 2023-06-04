<?php

namespace App\Exports;

use App\Models\User;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class UsersExport implements FromCollection, WithHeadings, WithStyles
{
    protected $items;

    public function __construct(){
        $this->items = User::get()->map(function (User $user) {
            return [
                'id' => (int)$user->id,
                'first_name' => (string)$user->first_name,
                'last_name' => (string)$user->last_name,
                'birthday' => (string)$user->birthday,
                'email' => (string)$user->email,
                'phone' => (string)$user->mobile_phone,
                'viber' => (string)$user->viber,
                'company' => (string)$user->company,
                'work_phone' => (string)$user->work_phone,
                'work_email' => (string)$user->work_email,
                'address' => (string)$user->address,
                'website' => (string)$user->website,
                'email_verified_at' => $user->email_verified_at ? 'Так' : 'Нi',
                'roles' => $this->getUsersRoles($user),
            ];
        });
    }

    public function getUsersRoles($user){
        $roles = [];
        foreach( $user->roles as $role){
            $roles[] = $role['name'];
        }

        return implode(', ', $roles);
    }
    

    public function headings(): array
    {
        return [
            '#',
            'Імя',
            'Прізвище',
            'Дата народження',
            'Електронна пошта',
            'Телефон',
            'Viber',
            'Компанія',
            'Стаціонарний телефон',
            'Робоча email',
            'Адреса',
            'Website',
            'Перевірено',
            'Ролі',
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
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => DataType::TYPE_STRING,
            'C' => DataType::TYPE_STRING,
            'D' => DataType::TYPE_STRING,
            'E' => DataType::TYPE_STRING,
            'F' => DataType::TYPE_STRING,
            'G' => DataType::TYPE_STRING,
            'H' => DataType::TYPE_STRING,
            'I' => DataType::TYPE_STRING,
            'J' => DataType::TYPE_STRING,
            'K' => DataType::TYPE_STRING,
            'L' => DataType::TYPE_STRING,
            'M' => DataType::TYPE_STRING,
            'N' => DataType::TYPE_STRING,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->items;
    }
}
