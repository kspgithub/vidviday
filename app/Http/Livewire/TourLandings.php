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

    protected $listeners = [
        'locationChanged' => 'syncLocation',
        'updateType' => 'syncType',
    ];

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
        'lat' => 48.736383466532274,
        'lng' => 31.460746106250006,
    ];

    /**
     * @var LandingPlace
     */
    public $landing;

    public $type;

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
        if($type_id == TourLanding::TYPE_CUSTOM) {
            $this->form['landing_id'] = 0;
        }

        if(!$this->type) {
            $this->type = $type_id;

            $this->dispatchBrowserEvent('initLocation', ['type_id' => $type_id]);
        } else {
            $this->form['type_id'] = 0;
            $this->dispatchBrowserEvent('updateType', ['type_id' => $type_id]);
        }
    }

    public function updatedFormLandingId($landing_id)
    {
        if ($landing_id) {
            $this->landing = LandingPlace::query()->find($this->form['landing_id']);
        }
    }

    public function updatedFormLat($lat)
    {
        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function updatedFormLng($lng)
    {
        $this->dispatchBrowserEvent('initLocation', []);
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
        $this->model->lat = $this->form['lat'];
        $this->model->lng = $this->form['lng'];
    }

    public function afterSaveItem()
    {
        $this->form['type_id'] = 0;
        $this->form['landing_id'] = 0;
        $this->form['title'] = ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''];
        $this->form['description'] = ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''];
        $this->form['lat'] = 48.736383466532274;
        $this->form['lng'] = 31.460746106250006;

        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function afterModelInit()
    {
        $this->form['type_id'] = $this->model->type_id === 0 ? ($this->model->landing_id > 0 ? TourLanding::TYPE_TEMPLATE : TourLanding::TYPE_CUSTOM) : $this->model->type_id;
        $this->type = $this->model->type_id;
        $this->form['landing_id'] = $this->model->landing_id === null ? 0 : $this->model->landing_id;
        $this->landing = LandingPlace::query()->find($this->form['landing_id']);
        $this->form['title'] = $this->model->getTranslations('title');
        $this->form['description'] = $this->model->getTranslations('description');
        $this->form['lat'] = $this->model->lat;
        $this->form['lng'] = $this->model->lng;

        $this->dispatchBrowserEvent('initLocation', []);

    }

    public function syncLocation(array $location = [
        'country_id' => 0,
        'region_id' => 0,
        'district_id' => 0,
        'city_id' => 0,
        'lat' => 0,
        'lng' => 0,
    ])
    {
        foreach ($location as $key => $value) {
            if (array_key_exists($key, $this->form)) {
                $this->form[$key] = $value;
            }
        }
    }

    public function syncType($type_id)
    {
        $this->type = 0;
        $this->form['type_id'] = $type_id;
        $this->updatedFormTypeId($type_id);
    }
}
