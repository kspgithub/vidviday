<?php

namespace App\View\Components\Header;

use App\Models\Currency;
use Cache;
use Illuminate\View\Component;

class CurrencyDropdown extends Component
{
    public $currencies = [];

    public $current = null;

    public $currentCurrencyRate = 1.0;

    public $currentCurrencyISO = 'UAH';

    public $currentCurrencySymbol = '₴';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->currencies = Cache::rememberForever('currencies', function () {
            return Currency::all();
        });

        $this->currentCurrencyISO = session('currency', 'UAH');
        $this->current = $this->currencies->where('iso', $this->currentCurrencyISO)->first();
        $this->currentCurrencySymbol = $this->current->symbol ?? 'UAH';
        $this->currentCurrencyRate = $this->current->course ?? 1.0;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header.currency-dropdown');
    }
}
