<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\DeleteRecordTrait;
use App\Models\UserQuestion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class ResumeTable extends DataTableComponent
{
    use DeleteRecordTrait;

    public array $bulkActions = [
    ];

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped table-responsive',
    ];

    public $edit = false;

    public $name = '';

    public $email = '';

    public $text = '';


    protected $rules = [
        'name' => ['required'],
        'email' => ['required', 'email'],
        'text' => ['required'],
    ];


    public function mount()
    {
        $this->name = current_user()->name;
        $this->email = current_user()->email;
       /*  UserQuestion::fixTree(); */
    }

    public function query(): Builder|Relation
    {
        $status = $this->getFilter('status');
    
        return UserQuestion::query()
            ->where('type', 3) 
            ->when(!is_null($status) && $status !== '', function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc');
    }


    public function columns(): array
    {
        return [
            Column::make(__('ID'), 'id'),

            Column::make(__('User'), 'name')
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return $row->name . '<br>' . $row->email . '<br>' . $row->phone;
                })
                ->asHtml(),
            Column::make(__('Text'), 'comment')
                ->format(function ($value, $column, $row) {
                    return nl2br($row->comment);
                })
                ->asHtml(),

            Column::make(__('Created At'), 'created_at')
                ->format(function ($value, $column, $row) {
                    return $row->created_at ? $row->created_at?->format('d.m.Y H:s') : '-';
                }),

            Column::make(__('Status'))
                ->format(function ($value, $column, $row) {
                    return view('admin.testimonial.includes.resume-status', ['model' => $row]);
                }),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.testimonial.includes.resume-actions', ['model' => $row]);
                }),
        ];
    }

    public function publishItem($id)
    {
        $item = UserQuestion::query()->find($id);
        if ($item) {
            $item->status = UserQuestion::STATUS_RESOLVED;
            $item->save();
        }
    }

    public function blockItem($id)
    {
        $item = UserQuestion::query()->find($id);
        if ($item) {
            $item->status = UserQuestion::STATUS_ARCHIVED;
            $item->save();
        }
    }

    public function undoItem($id)
    {
        $item = UserQuestion::query()->find($id);
        if ($item) {
            $item->status = UserQuestion::STATUS_NEW;
            $item->save();
        }
    }

    public function createItem()
    {
        $this->edit = true;
    }

    public function cancelEdit()
    {
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
            'status' => Filter::make(__('Status'))
                ->select([
                    '' => __('Any'),
                    0 => __('resume.new'),
                    1 => __('resume.resolved'),
                    2 => __('resume.archived'),
                ]),
        ];
    }
}