<?php

namespace App\Http\Livewire;

use App\Models\LanguageLine;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class LanguageLineTable extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make(__('Group'), 'group')
                ->sortable(),

            Column::make(__('Key'), 'key')
                ->sortable(),

            Column::make(__('Translations'), 'text')
                ->format(function ($value, $column, $row) {
                    return view('admin.translation.includes.translations', ['language_line' => $row, 'locales'=>config('site-settings.locale.languages')]);
                }),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.translation.includes.actions', ['language_line' => $row]);
                }),
        ];
    }

    public function query()
    {
        return LanguageLine::query()->when($this->getFilter('search'), function ($query) {
            $term = $this->getFilter('search');
            $encoded_term = str_replace('\\', '', str_replace('"', '', json_encode($term)));

            return $query->whereRaw(" REPLACE(`text`, '\\\', '') LIKE '%$encoded_term%' OR `text` LIKE '%$term%' OR `group` LIKE '%$term%' OR `key` LIKE '%$term%'");
        });
    }

//    public function filters(): array
//    {
//        return [
//            'locale' => Filter::make(__('Locale'))
//                ->select([
//                    '' => __('Any'),
//                    'ru' => __('Рус'),
//                    'kk' => __('Каз'),
//                ]),
//        ];
//    }
}
