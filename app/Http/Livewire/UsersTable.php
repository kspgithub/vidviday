<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class UsersTable.
 */
class UsersTable extends DataTableComponent
{

    /**
     * @var string
     */
    public $sortField = 'id';

    /**
     * @var string
     */
    public $status;

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped table-responsive',
    ];

    /**
     * @param  string  $status
     */
    public function mount($status = 'active'): void
    {
        $this->status = $status;
    }

    /**
     * @return Builder|Relation
     */
    public function query(): Builder|Relation
    {
        $query = User::with('roles');

        if ($this->status === 'deleted') {
            return $query->onlyTrashed();
        }

        if ($this->status === 'deactivated') {
            return $query->onlyDeactivated();
        }

        return $query->onlyActive();
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

            Column::make(__('Type'), 'type')
                ->sortable()
                ->format(function ($value, $column, $row) {
                    return view('admin.user.includes.type', ['user' => $row]);
                }),

            Column::make(__('First Name'), 'first_name')
                ->searchable()
                ->sortable(),

            Column::make(__('Last Name'), 'last_name')
                ->searchable()
                ->sortable(),

            Column::make(__('E-mail'), 'email')
                ->searchable()
                ->sortable()
                ->format(function ($value) {
                    return '<a href="'.$value.'">'.$value.'</a>';
                })
                ->asHtml(),
            Column::make(__('Phone'), 'phone')
                ->searchable()
                ->sortable()
                ->format(function ($value) {
                    return '<a href="'.$value.'">'.$value.'</a>';
                })
                ->asHtml(),
            Column::make(__('Verified'), 'email_verified_at')
                ->sortable()
                ->format(function ($value, $column, $row) {
                    return view('admin.user.includes.verified', ['user' => $row]);
                }),

            Column::make(__('Roles'), 'roles_label')
                ->searchable(function ($builder, $term) {
                    return $builder->orWhereHas('roles', function ($query) use ($term) {
                        return $query->where('name', 'like', '%'.$term.'%');
                    });
                })
                ->format(function ($value) {
                    return $value;
                }),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.user.includes.actions', ['user' => $row]);
                }),
        ];
    }
}
