<?php

namespace App\Http\Livewire;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class UsersTable.
 */
class ToursTable extends DataTableComponent
{
    public array $bulkActions = [
    ];

    /**
     * @var string
     */
    public string $defaultSortColumn = 'created_at';

    /**
     * @var string
     */
    public string $defaultSortDirection = 'desc';

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
        $query = Tour::query()->withCount(['media' => function ($q) {
            return $q->where('collection_name', 'pictures');
        }, 'questions', 'testimonials']);

        if (current_user()->isTourManager()) {
            $query->whereHas('manager', fn ($sq) => $sq->where('user_id', current_user()->id));
        }

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
                ->searchable(function (Builder $query, $searchTerm) {
                    return $query->orJsonLike('title', "%$searchTerm%");
                })
                ->sortable(),

            Column::make(__('Мови'), 'locales')
                ->format(function ($value, $column, $row) {
                    return implode(', ', $row->locales);
                }),

            Column::make(__('Manager'))
                ->format(function ($value, $column, $row) {
                    return !empty($row->tourManager) ? $row->tourManager->name : '-';
                }),

            Column::make(__('Published'), 'published')
                ->format(function ($value, $column, $row) {
                    return view('admin.partials.published', ['model' => $row, 'updateUrl' => route('admin.tour.update-status', $row)]);
                })
                ->sortable(),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.tour.includes.actions', ['tour' => $row]);
                }),
        ];
    }
}
