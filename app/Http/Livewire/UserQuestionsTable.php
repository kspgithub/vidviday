<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\DeleteRecordTrait;
use App\Models\UserQuestion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class UserQuestionsTable extends DataTableComponent
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


    public function mount()
    {
        $this->name = current_user()->name;
        $this->email = current_user()->email;
    }

    public function query(): Builder|Relation
    {
        $type = $this->getFilter('type');

        return UserQuestion::query()
            ->when(!is_null($type) && $type !== '', function ($query) use ($type) {
                return $query->where('type', $type);
            })
            ->orderBy('created_at', 'desc');
    }


    public function columns(): array
    {
        $types = $this->getTypes();

        return [
            Column::make(__('ID'), 'id'),

            Column::make(__('Type'), 'type')
                ->format(function ($value, $column, $row) use ($types) {
                    return $types[$value] ?? $value;
                }),

            Column::make(__('Question Type'), 'question_type')
                ->format(function ($value, $column, $row) use ($types) {
                    return $row->questionType->title ?? $value;
                }),

            Column::make(__('User'), 'name')
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return $row->name . '<br>' . $row->email . '<br>' . $row->phone;
                })
                ->asHtml(),

            Column::make(__('Time'), 'call_date')
                ->format(function ($value, $column, $row) {
                    return Carbon::parse($row->call_date)->format('d.m.Y') . ' ' . $row->call_time;
                })
                ->asHtml(),

            Column::make(__('Comment'), 'comment')
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
                    return view('admin.testimonial.includes.questions-status', ['model' => $row]);
                }),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.testimonial.includes.user-questions-actions', ['model' => $row]);
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

    public function createItem($parent_id)
    {
        $this->parent_id = $parent_id;
        $this->edit = true;
    }

    public function saveItem()
    {

        $model = UserQuestion::query()->find($this->parent_id);
        if ($model) {
            $this->validate();
            $item = new UserQuestion();
            $item->name = $this->name;
            $item->email = $this->email;
            $item->text = $this->text;
            $item->save();
        }


        $this->parent_id = 0;
        $this->text = '';
        $this->edit = false;
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
                ->select($this->getTypes()),
        ];
    }

    public function getTypes()
    {
        return [
            UserQuestion::TYPE_CALL => __('Call'),
            UserQuestion::TYPE_EMAIL => __('Email'),
            UserQuestion::TYPE_QUESTION => __('Question'),
            UserQuestion::TYPE_VACANCY => __('Vacancy'),
        ];
    }
}
