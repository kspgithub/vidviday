<?php

namespace App\Http\Livewire;

use App\Models\Place;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class UsersTable.
 */
class PlacesTable extends DataTableComponent
{

    /**
     * @var string
     */
    public $sortField = 'id';

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped table-responsive',
    ];

    public function mount(): void
    {
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Place::query()->withCount('media');

        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('ID'), 'id')
                ->searchable()
                ->sortable(),

            Column::make(__('Title'), 'title')
                ->searchable()
                ->sortable(),

            Column::make(__('Published'), 'published')
                ->format(function ($value, $column, $row) {
                    return view('admin.partials.published', ['model' => $row, 'updateUrl'=>route('admin.place.update', $row)]);
                })
                ->sortable(),

            Column::make(__('Gallery'))
                ->format(function ($value, $column, $row) {
                    return view('admin.partials.media-link', [
                        'url' => route('admin.place.media.index', $row),
                        'count'=>$row->media_count,
                    ]);
                }),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.place.includes.actions', ['place' => $row]);
                }),
        ];
    }
}
