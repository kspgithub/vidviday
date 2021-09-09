<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Database\Eloquent\Builder;

trait DeleteRecordTrait
{
    public $deleteId = 0;

    abstract public function query(): Builder;


    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        $model = $this->query()->find($this->deleteId);
        $model->delete();
    }
}
