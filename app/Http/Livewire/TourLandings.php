<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\LandingPlace;
use App\Models\Tour;
use App\Models\TourLanding;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class TourLandings extends Component
{
    use EditRecordTrait;

    /**
     * @var Tour
     */
    public $tour;

    /**
     * @var Collection
     */
    public $types;

    /**
     * @var Collection
     */
    public $landings;

    public array $form = [
        'type_id' => null,
        'landing_id' => 0,
        'title' => ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''],
        'description' => ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''],
    ];

    /**
     * @var LandingPlace
     */
    public $landing;

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->types = collect([
            ['value' => TourLanding::TYPE_TEMPLATE, 'text' => __('Вибрати з шаблону')],
            ['value' => TourLanding::TYPE_CUSTOM, 'text' => __('Свій тип')],
        ]);
        $this->landings = collect();
        $this->landing = null;
    }

    public function editRecordClass(): string
    {
        return TourLanding::class;
    }

    public function query(): Builder|Relation
    {
        return $this->tour->tourLandings()->with(['landing']);
    }

    protected function rules()
    {
        $rules = [
            'form.type_id' => 'required',
            'form.landing_id' => Rule::when(fn() => $this->form['type_id'] == TourLanding::TYPE_TEMPLATE, ['required', 'int', 'min:1']),
        ];

        $locales = $this->tour->locales;

        foreach ($locales as $locale) {
            $rules['form.title.' . $locale] = Rule::when(fn() => $this->form['type_id'] == TourLanding::TYPE_CUSTOM, ['required', 'string']);
        }

        return $rules;
    }

    public function render()
    {
        if ($this->form['landing_id']) {
            $landing = LandingPlace::query()->find($this->form['landing_id']);
            $this->landings = collect([$landing->asSelectBox()]);
        }

        return view('admin.tour.landing.livewire', [
            'items' => $this->query()->orderBy('position')->get()
        ]);
    }

    public function updatedFormTypeId($type_id)
    {
        $this->dispatchBrowserEvent('initLocation', ['type_id' => $type_id]);
    }

    public function updatedFormLandingId($landing_id)
    {
        if ($landing_id) {
            $this->landing = LandingPlace::query()->find($this->form['landing_id']);
        }
    }

    public function updatedSelectedId($id)
    {
//        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            DB::table('tours_landings')
                ->where([['tour_id', $this->tour->id], ['id', $item['value']]])
                ->update(['position' => $item['order']]);
        }
    }

    public function beforeSaveItem()
    {
        $this->model->tour_id = $this->tour->id;
        $this->model->type_id = $this->form['type_id'];
        $this->model->landing_id = $this->form['landing_id'] === 0 ? null : $this->form['landing_id'];
        $this->model->title = $this->form['title'];
        $this->model->description = $this->form['description'];
    }

    public function afterSaveItem()
    {
        $this->form['type_id'] = 0;
        $this->form['landing_id'] = 0;
        $this->form['title'] = ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''];
        $this->form['description'] = ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''];

        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function afterModelInit()
    {
        $this->form['type_id'] = $this->model->type_id === 0 ? ($this->model->landing_id > 0 ? TourLanding::TYPE_TEMPLATE : TourLanding::TYPE_CUSTOM) : $this->model->type_id;
        $this->form['landing_id'] = $this->model->landing_id === null ? 0 : $this->model->landing_id;
        $this->landing = LandingPlace::query()->find($this->form['landing_id']);
        $this->form['title'] = $this->model->getTranslations('title');
        $this->form['description'] = $this->model->getTranslations('description');

        $this->dispatchBrowserEvent('initLocation', []);

    }
}
