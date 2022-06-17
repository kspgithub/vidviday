<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\Currency;
use App\Models\Discount;
use App\Models\Tour;
use App\Models\TourDiscount;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class TourDiscounts extends Component
{
    use EditRecordTrait;

    protected $listeners = [
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
    public $discountTypes;

    /**
     * @var Collection
     */
    public $durations;

    /**
     * @var Collection
     */
    public $categories;

    /**
     * @var Collection
     */
    public $discounts;

    public $currencies = [];


    public array $form = [
        'type_id' => null,
        'discount_id' => 0,
//        'title_admin' => '',
        'title' => ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''],
        'type' => null,
        'price' => 0,
        'currency' => null,
        'category' => null,
        'duration' => null,
        'age_limit' => null,
        'age_start' => null,
        'age_end' => null,
        'start_date' => null,
        'end_date' => null,
    ];

    /**
     * @var Discount
     */
    public $discount;

    public $type;

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->types = collect([
            ['value' => TourDiscount::TYPE_TEMPLATE, 'text' => __('Вибрати з шаблону')],
            ['value' => TourDiscount::TYPE_CUSTOM, 'text' => __('Свій тип')],
        ]);
        $this->discountTypes = array_map(fn($key, $value) => ['value' => $key, 'text' => $value], array_keys(Discount::$types), Discount::$types);
        $this->durations = array_map(fn($key, $value) => ['value' => $key, 'text' => $value], array_keys(Discount::$durations), Discount::$durations);
        $this->categories = array_map(fn($key, $value) => ['value' => $key, 'text' => $value], array_keys(Discount::$categories), Discount::$categories);
        $this->currencies = Currency::toSelectBox('iso', 'iso');
        $this->discounts    = Discount::query()->orderBy('title')->toSelectBox();
        $this->discount = null;
    }

    public function editRecordClass(): string
    {
        return TourDiscount::class;
    }

    public function query(): Builder|Relation
    {
        return $this->tour->tourDiscounts()->with(['discount']);
    }

    protected function rules()
    {
        $rules = [
            'form.type_id' => 'required',
            'form.discount_id' => Rule::when(fn() => $this->form['type_id'] == TourDiscount::TYPE_TEMPLATE, ['required', 'int', 'min:1']),
        ];

        $locales = $this->tour->locales;

        foreach ($locales as $locale) {
            $rules['form.title.' . $locale] = Rule::when(fn() => $this->form['type_id'] == TourDiscount::TYPE_CUSTOM, ['required', 'string']);
        }

        return $rules;
    }

    public function render()
    {
        return view('admin.tour.discount.livewire', [
//            'items' => $this->query()->orderBy('position')->get(),
            'items' => $this->tour->groupTourDiscounts,
        ]);
    }

    public function updatedFormTypeId($type_id)
    {
        if($type_id == TourDiscount::TYPE_CUSTOM) {
            $this->form['discount_id'] = 0;
        }

        if(!$this->type) {
            $this->type = $type_id;

            $this->form['discount_id'] = 0;

            $this->dispatchBrowserEvent('DOMContentLoaded', []);
        } else {
            $this->form['type_id'] = 0;
            $this->dispatchBrowserEvent('updateType', ['type_id' => $type_id]);
        }
    }

    public function updatedFormDiscountId($discount_id)
    {
        if ($discount_id) {
            $this->discount = Discount::query()->find($this->form['discount_id']);
        }
    }

    public function updatedSelectedId($id)
    {
//        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            DB::table('tours_discounts')
                ->where([['tour_id', $this->tour->id], ['id', $item['value']]])
                ->update(['position' => $item['order']]);
        }
    }

    public function beforeSaveItem()
    {
        $this->model->tour_id = $this->tour->id;
        $this->model->type_id = $this->form['type_id'];
        $this->model->discount_id = $this->form['discount_id'] === 0 ? null : $this->form['discount_id'];
        $this->model->title = $this->form['title'];
//        $this->model->title_admin = $this->form['title_admin'];
        $this->model->type = $this->form['type'];
        $this->model->price = $this->form['price'];
        $this->model->currency = $this->form['currency'];
        $this->model->category = $this->form['category'];
        $this->model->duration = $this->form['duration'];
        $this->model->age_limit = $this->form['age_limit'];
        $this->model->age_start = $this->form['age_start'];
        $this->model->age_end = $this->form['age_end'];
        $this->model->start_date = $this->form['start_date'];
        $this->model->end_date = $this->form['end_date'];
    }

    public function afterSaveItem()
    {
        $this->form['type_id'] = 0;
        $this->form['discount_id'] = 0;
        $this->form['title'] = ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''];
//        $this->form['title_admin'] = '';
        $this->form['type'] = null;
        $this->form['price'] = null;
        $this->form['currency'] = null;
        $this->form['category'] = null;
        $this->form['duration'] = null;
        $this->form['age_limit'] = null;
        $this->form['age_start'] = null;
        $this->form['age_end'] = null;
        $this->form['start_date'] = null;
        $this->form['end_date'] = null;

        $this->dispatchBrowserEvent('DOMContentLoaded', []);
    }

    public function afterModelInit()
    {
        $this->form['type_id'] = $this->model->type_id === 0 ? ($this->model->discount_id > 0 ? TourDiscount::TYPE_TEMPLATE : TourDiscount::TYPE_CUSTOM) : $this->model->type_id;
        $this->type = $this->model->type_id;
        $this->form['discount_id'] = $this->model->discount_id === null ? 0 : $this->model->discount_id;
        $this->discount = Discount::query()->find($this->form['discount_id']);
//        $this->form['title_admin'] = $this->model->title_admin;
        $this->form['title'] = $this->model->getTranslations('title');
        $this->form['type'] = $this->model->type;
        $this->form['price'] = $this->model->price;
        $this->form['currency'] = $this->model->currency;
        $this->form['category'] = $this->model->category;
        $this->form['duration'] = $this->model->duration;
        $this->form['age_limit'] = $this->model->age_limit;
        $this->form['age_start'] = $this->model->age_start;
        $this->form['age_end'] = $this->model->age_end;
        $this->form['start_date'] = $this->model->start_date;
        $this->form['end_date'] = $this->model->end_date;

        $this->dispatchBrowserEvent('DOMContentLoaded', []);

    }

    public function syncType($type_id)
    {
        $this->type = 0;
        $this->form['type_id'] = $type_id;
        $this->updatedFormTypeId($type_id);
    }
}
