<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\Currency;
use App\Models\PriceItem;
use App\Models\Tour;
use Illuminate\Validation\Rule;
use Livewire\Component;

/**
 * @property PriceItem $model
 */
class TourCalc extends Component
{
    use EditRecordTrait;

    /**
     * @var Tour
     */
    public $tour;

    public $locales = [];

    public $currencies = [];

    public $title_uk = '';
    public $title_ru = '';
    public $title_en = '';
    public $title_pl = '';

    public $limited = 0;
    public $published = 0;
    public $places = 0;
    public $price = 0;
    public $currency = 'UAH';


    protected $rules = [
        'title_uk' => ['required'],
        'title_ru' => ['nullable'],
        'title_en' => ['nullable'],
        'title_pl' => ['nullable'],
        'limited' => ['nullable'],
        'places' => ['integer', 'nullable'],
        'published' => ['integer', 'nullable'],
        'price' => ['integer'],
        'currency' => ['string'],
    ];

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->currencies = Currency::toSelectBox();
        $this->locales = $this->getLocales();
    }


    public function render()
    {
        return view('admin.tour.includes.tour-calc', ['items' => $this->query()->get()]);
    }

    public function editRecordClass(): string
    {
        return PriceItem::class;
    }

    public function query()
    {
        return $this->tour->priceItems();
    }

    public function togglePublished($id)
    {
        $item = $this->query()->find($id);
        $item->published = !$item->published;
        $item->save();
    }

    public function afterModelInit()
    {
        $this->getTranslations('title');
        $this->published = $this->model->published ?? 0;
        $this->limited = $this->model->limited ?? 0;
        $this->places = $this->model->places ?? '';
        $this->price = $this->model->price ?? '';
        $this->currency = $this->model->currency ?? 'UAH';
    }

    public function beforeSaveItem()
    {
        $this->model->tour_id = $this->tour->id;
        $this->setTranslations('title');
        $this->model->published = $this->published ?? 0;
        $this->model->limited = $this->limited ?? 0;
        $this->model->places = empty($this->places) ? 0 : (int)$this->places;
        $this->model->price = $this->price;
        $this->model->currency = $this->currency;
    }
}
