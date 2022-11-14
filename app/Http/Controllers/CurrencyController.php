<?php

namespace App\Http\Controllers;

class CurrencyController extends Controller
{
    //

    public function change(string $currency)
    {
        $currency = strtoupper($currency);
        if (! in_array($currency, ['UAH', 'USD', 'EUR', 'GBP', 'PLN'])) {
            $currency = 'UAH';
        }

        session()->put('currency', $currency);

        return redirect()->back();
    }
}
