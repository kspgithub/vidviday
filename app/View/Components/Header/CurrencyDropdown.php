<?php

namespace App\View\Components\Header;

use App\Models\Currency;
use Cache;
use Illuminate\View\Component;

class CurrencyDropdown extends Component
{

    public $currencies = [];

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
            return Currency::all()->pluck('symbol', 'iso')->toArray();
        });

        $this->currentCurrencyISO = session('currency', 'UAH');
        $this->currentCurrencySymbol = $this->currencies[$this->currentCurrencyISO];
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
