<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueSlugRule implements Rule
{
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
            $query = DB::table($this->table)->where(function ($q) use ($attribute, $value) {

                foreach (siteLocales() as $idx => $locale) {
                    if ($idx === 0) {
                        $q->where("{$this->attr}->{$locale}", $value);
                    } else {
                        $q->orWhere("{$this->attr}->{$locale}", $value);
                    }
                }
            });
            if ($this->exceptId > 0) {
                $query->where('id', '<>', $this->exceptId);
            }
            return $query->count() === 0;
        }
        return true;
    }

    public function message(): string
    {
        return "Запис з таким значенням :attribute вже існує";
    }
}
