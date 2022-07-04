<?php

namespace App\Http\Livewire;


use App\Models\Banner;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class BannersTable.
 */
class BannersTable extends DataTableComponent
{

    public bool $reordering = true;

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
     * @return Builder|Relation
     */
    public function query(): Builder|Relation
    {
        $query = Banner::query()->orderBy('position');

        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('ID'), 'id'),

            Column::make(__('Image'), 'image_url')
                ->format(function ($value, $column, $row) {
                    return '<img src="' . $value . '" alt="'. $value .'" style="height: 80px;">';
                })->asHtml(),

            Column::make(__('Title'), 'title'),

            Column::make(__('Created At'), 'url'),

            Column::make(__('Published'), 'published')
                ->format(function ($value, $column, $row) {
                    return view('admin.partials.published', ['model' => $row, 'updateUrl' => route('admin.charity.update-status', $row)]);
                }),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.charity.includes.actions', ['charity' => $row]);
                }),
        ];
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            Banner::query()->find((int)$item['value'])->update(['position' => (int)$item['order']]);
        }
    }
}
