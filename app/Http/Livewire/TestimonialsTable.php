<?php

namespace App\Http\Livewire;

use App\Exports\TestimonialExport;
use App\Http\Livewire\Traits\DeleteRecordTrait;
use App\Models\Place;
use App\Models\Staff;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\TourQuestion;
use Excel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class TestimonialsTable extends DataTableComponent
{
    use DeleteRecordTrait;

    public array $bulkActions = [
        'export' => '1'
    ];

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped table-responsive',
    ];


    public $parent_id = 0;

    public $edit = false;

    public $name = '';

    public $email = '';

    public $text = '';


    protected $rules = [
        'name' => ['required'],
        'email' => ['required', 'email'],
        'text' => ['required'],
    ];

    public function export()
    {
        $items = $this->selected ? $this->rows->whereIn('id', $this->selected) : $this->rows;

        return Excel::download(new TestimonialExport($items), 'testimonials.xlsx');
    }


    public function mount(Request $request)
    {
        $this->name = current_user()->name;
        $this->email = current_user()->email;
        Testimonial::fixTree();
    }

    public function query(): Builder|Relation
    {
        $status = $this->getFilter('status');
        $type = $this->getFilter('type');
        $imported = $this->getFilter('imported');

        return Testimonial::query()
            ->with(['model', 'user'])
            ->when(!empty($type) && $type === 'tour', function ($query) use ($status) {
                return $query->where('model_type', Tour::class);
            })
            ->when(!empty($type) && $type === 'staff', function ($query) use ($status) {
                return $query->where('model_type', Staff::class);
            })
            ->when(!empty($type) && $type === 'place', function ($query) use ($status) {
                return $query->where('model_type', Place::class);
            })
            ->when(!is_null($status) && $status !== '', function ($query) use ($status) {
                return $query->where('status', $status);
            })->orderBy('created_at', 'desc')
            ->when(!is_null($imported) && $imported !== '', function ($query) use ($imported) {
                return $query->where('imported', $imported);
            })->orderBy('created_at', 'desc');
    }


    public function columns(): array
    {
        return [
            Column::make(__('ID'), 'id'),

            Column::make(__('PID'), 'parent_id'),

            Column::make(__('Type'), 'model_type')
                ->format(function ($value, $column, $row) {
                    $html = "<div>" . Testimonial::TYPES[$row->model_type] ?? 'Інше' . "</div>";
                    if ($row->model_type === Tour::class || $row->model_type === Place::class) {
                        $html .= "<div>{$row->model->title}</div>";
                    }
                    if ($row->model_type === Staff::class) {
                        $html .= "<div>{$row->model->name}</div>";
                    }
                    return $html;
                })
                ->asHtml(),

            Column::make(__('User'), 'name')
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return $row->name . '<br>' . $row->email . '<br>' . $row->phone;
                })
                ->asHtml(),

            Column::make(__('Text'), 'text')
                ->format(function ($value, $column, $row) {
                    return str_limit(nl2br($row->text), 200);
                })
                ->asHtml(),

            Column::make(__('Rating'), 'rating'),


            Column::make(__('Created At'), 'created_at')
                ->format(function ($value, $column, $row) {
                    return $row->created_at ? $row->created_at?->format('d.m.Y H:s') : '-';
                }),

            Column::make(__('Status'))
                ->format(function ($value, $column, $row) {
                    return view('admin.testimonial.includes.testimonial-status', ['model' => $row]);
                }),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.tour.includes.testimonial-actions', ['model' => $row]);
                }),
        ];
    }

    public function publishItem($id)
    {
        $item = Testimonial::query()->find($id);
        if ($item) {
            $item->status = Testimonial::STATUS_PUBLISHED;
            $item->save();
        }

        Cache::forget('latest__testimonials_tour');
        Cache::forget('latest__testimonials_staff');
        Cache::forget('latest__testimonials_all');
    }

    public function blockItem($id)
    {
        $item = Testimonial::query()->find($id);
        if ($item) {
            $item->status = Testimonial::STATUS_BLOCKED;
            $item->save();
        }

        Cache::forget('latest__testimonials_tour');
        Cache::forget('latest__testimonials_staff');
        Cache::forget('latest__testimonials_all');
    }

    public function createItem($parent_id)
    {
        $this->parent_id = $parent_id;
        $this->edit = true;
    }


    public function saveItem()
    {
        $model = Testimonial::query()->where('id', $this->parent_id)->first();
        if ($model) {
            $this->validate();
            $item = new Testimonial();
            $item->model_type = $model->model_type;
            $item->model_id = $model->model_id; //TODO
            $item->name = $this->name;
            $item->email = $this->email;
            $item->text = $this->text;
            $item->parent_id = $this->parent_id;
            $item->avatar = current_user()->avatar;
            $item->save();
        }


        $this->parent_id = 0;
        $this->text = '';
        $this->edit = false;

        Cache::forget('latest__testimonials_tour');
        Cache::forget('latest__testimonials_staff');
        Cache::forget('latest__testimonials_all');
    }

    public function cancelEdit()
    {
        $this->parent_id = 0;
        $this->text = '';
        $this->edit = false;
    }

    /**
     * @return mixed
     */
    public function render()
    {
        if ($this->edit) {
            return view('admin.tour.includes.question-form');
        }

        return view('livewire-tables::' . config('livewire-tables.theme') . '.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
                'modalsView' => $this->modalsView(),
            ]);
    }

    public function filters(): array
    {
        return [
            'type' => Filter::make(__('Type'))
                ->select([
                    '' => __('Any'),
                    'tour' => __('Tour'),
                    'staff' => __('Staff'),
                    'place' => __('Place'),
                ]),
            'status' => Filter::make(__('Status'))
                ->select([
                    '' => __('Any'),
                    0 => __('New'),
                    1 => __('Published'),
                    2 => __('Blocked'),
                ]),
            'imported' => Filter::make('Imported')
                ->select([
                    '' => __('Any'),
                    0 => 'NO',
                    1 => 'YES',
                ]),
        ];
    }
}
