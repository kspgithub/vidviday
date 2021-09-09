<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait EditRecordTrait
{
    public $edit = false;

    public $selectedId = 0;

    public $deleteId = 0;

    /**
     * The repository model.
     *
     * @var Model
     */
    public $model;

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {

        $model = $this->query()->find($this->deleteId);
        if (method_exists($model, 'clearMediaCollection')) {
            $model->clearMediaCollection();
        }
        $model->delete();
        $this->selectedId = 0;
        $this->model = null;
    }

    public function addItem()
    {
        $this->selectedId = 0;
        $class_name = $this->editRecordClass();
        $this->model = new $class_name;
        $this->afterModelInit();
        $this->edit = true;
    }


    public function cancelEdit()
    {
        $this->selectedId = 0;
        $this->edit = false;
    }

    public function editItem($id)
    {
        $this->model = $this->query()->find($id);
        $this->afterModelInit();
        $this->selectedId = $id;
        $this->edit = true;
    }

    public function saveItem()
    {
        $this->validate();
        $this->beforeSaveItem();
        $this->model->save();
        $this->afterSaveItem();
        $this->edit = false;
        $this->selectedId = 0;
    }


    public function beforeSaveItem()
    {
    }

    public function afterSaveItem()
    {
    }

    public function afterModelInit()
    {
    }

    abstract public function editRecordClass(): string;

    /**
     * @return mixed
     */
    abstract public function query();


    public function getLocales()
    {
        return array_keys(config('site-settings.locale.languages'));
    }

    public function getTranslations($key)
    {
        $locales = $this->getLocales();
        $translations = $this->model->getTranslations($key);
        foreach ($locales as $locale) {
            $this->{$key . '_' . $locale} = $translations[$locale] ?? '';
        }
    }

    public function setTranslations($key)
    {
        $translations = [];
        $locales = $this->getLocales();
        foreach ($locales as $locale) {
            $translations[$locale] = $this->{$key . '_' . $locale} ?? '';
        }
        $this->model->setTranslations($key, $translations);
    }
}
