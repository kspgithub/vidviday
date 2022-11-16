<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UniqueSlugRule implements Rule
{
    protected $tables = ['tours', 'places', 'tour_groups', 'pages'];

    protected $table;

    protected $exceptId;

    protected $attr;


    public function __construct($table, $attr = 'slug', $exceptId = 0)
    {
        //
        $this->table = $table;
        $this->exceptId = $exceptId;
        $this->attr = $attr;
    }

    public function passes($attribute, $value): bool
    {

        if (!empty($value)) {
            foreach ($this->tables as $table) {
                $query = DB::table($table)->where(function ($q) use ($attribute, $value) {
                    foreach (siteLocales() as $idx => $locale) {
                        if ($idx === 0) {
                            $q->where("{$this->attr}->{$locale}", $value);
                        } else {
                            $q->orWhere("{$this->attr}->{$locale}", $value);
                        }
                    }
                });
                if ($this->exceptId > 0 && $table === $this->table) {
                    $query->where('id', '<>', $this->exceptId);
                }
                if (Schema::hasColumn($table, 'deleted_at')) {
                    $query->whereNull('deleted_at');
                }
                if ($query->count() > 0) {
                    return false;
                }
            }
        }
        return true;
    }

    public function message(): string
    {
        return "Запис з таким значенням :attribute вже існує";
    }
}
