<?php

namespace App\Http\Livewire;


use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class UsersTable.
 */
class NewsTable extends DataTableComponent
{

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
     * @return Builder|Relation
     */
    public function query(): Builder|Relation
    {
        $query = News::query();

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
                    return $query->where(function ($sq) use ($searchTerm) {
                        return $sq->where('title->uk', 'LIKE', "%$searchTerm%")
                            ->orWhere('title->ru', 'LIKE', "%$searchTerm%")
                            ->orWhere('title->en', 'LIKE', "%$searchTerm%")
                            ->orWhere('title->pl', 'LIKE', "%$searchTerm%");
                    });
                })
                ->sortable(),

            Column::make(__('Created At'), 'created_at')
                ->format(function ($value, $column, $row) {
                    return $row->created_at->format('d.m.Y H:i');
                })
                ->sortable(),

            Column::make(__('Published'), 'published')
                ->format(function ($value, $column, $row) {
                    return view('admin.partials.published', ['model' => $row, 'updateUrl' => route('admin.news.update-status', $row)]);
                })
                ->sortable(),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.news.includes.actions', ['news' => $row]);
                }),
        ];
    }
}
