<?php

namespace App\Http\Livewire;

use App\Models\Tour;
use App\Models\TourFood;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class TourFoodTable extends DataTableComponent
{
    /**
     * @var Tour
     */
    public $tour;



    public function mount(Tour $tour)
    {
        $this->tour = $tour;
    }

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped',
    ];

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return TourFood::query()->where('tour_id', $this->tour->id)->with(['time'])->withCount(['media']);
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [

            Column::make(__('Day'), 'day')
                ->sortable(),

            Column::make(__('Time'), 'time_id')
                ->format(function ($value, $column, $row) {
                    return $row->time->title;
                })
                ->sortable(),

            Column::make(__('Text'), 'text')
                ->format(function ($value, $column, $row) {
                    return Str::limit(strip_tags($row->text));
                }),
            Column::make(__('Pictures'))
                ->format(function ($value, $column, $row) {
                    return $row->media_count;
                }),
            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.tour-food.includes.actions', ['food' => $row, 'tour'=>$this->tour]);
                }),
        ];
    }
}
