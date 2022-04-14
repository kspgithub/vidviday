<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class RolesTable.
 */
class RolesTable extends DataTableComponent
{

    /**
     * @var string
     */
    public $sortField = 'name';

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped',
    ];

    /**
     * @return Builder|Relation
     */
    public function query(): Builder|Relation
    {
        return Role::with('permissions:id,name,description')
            ->withCount('users');
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Type'), 'type')
                ->sortable()
                ->format(function ($value, $column, $row) {
                    if ($row->type === User::TYPE_ADMIN) {
                        return __('Administrator');
                    }

                    if ($row->type === User::TYPE_USER) {
                        return __('User');
                    }

                    if ($row->type === User::TYPE_COMPANY) {
                        return __('Company');
                    }

                    return 'N/A';
                }),
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Permissions'), 'permissions_label')
                ->searchable(function ($builder, $term) {
                    return $builder->orWhereHas('permissions', function ($query) use ($term) {
                        return $query->where('name', 'like', '%'.$term.'%');
                    });
                }),
            Column::make(__('Number of Users'), 'users_count')
                ->sortable(),
            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.role.includes.actions', ['model' => $row]);
                }),
        ];
    }
}
