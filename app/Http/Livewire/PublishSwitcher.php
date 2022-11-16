<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class PublishSwitcher extends Component
{
    public $model;

    public $published = false;

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->published = (bool)$model->published;
    }


    public function update()
    {
        $this->model->published = $this->published;
        $this->model->save();

    }

    public function render()
    {
        return view('admin.partials.publish-switcher');
    }

}
