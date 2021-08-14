<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Discount\DiscountBasicRequest;
use App\Models\Currency;
use App\Models\Discount;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.discount.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $discount = new Discount();

        $discount->currency = 'UAH';

        $currencies = Currency::toSelectBox('iso', 'iso');

        $modelsNames = $this->modelsHaveDiscount();

        $model = ($this->modelHaveDiscount("Tour"))::toSelectWithOthersOptionsBox('title', 'id', "price", "currency");


        return view('admin.discount.create', [
            'discount'=> $discount,
            'currencies'=> $currencies,
            "modelsNames" => $modelsNames,
            "model" => $model,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DiscountBasicRequest $request
     *
     * @return mixed
     */
    public function store(DiscountBasicRequest $request)
    {
        $discount = new Discount();

        $discount->fill($request->all());
        $discount->save();

        return redirect()->route('admin.discount.index', ['discount'=> $discount])
                         ->withFlashSuccess(__('Discount created.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Discount $discount
     *
     * @return Application|Factory|View
     */
    public function edit(Discount $discount)
    {

        $currencies = Currency::toSelectBox('iso', 'iso');

        $modelsNames = $this->modelsHaveDiscount();

        $model = ($this->modelHaveDiscount("Tour"))::toSelectWithOthersOptionsBox('title', 'id', "price", "currency");

        return view('admin.discount.edit', [
            'discount'=> $discount,
            "modelsNames" => $modelsNames,
            'currencies'=>$currencies,
            "model" => $model,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DiscountBasicRequest $request
     *
     * @param Discount $discount
     *
     * @return mixed
     *
     * @throws GeneralException
     */
    public function update(DiscountBasicRequest $request, Discount $discount)
    {
        $discount->fill($request->all());
        $discount->save();

        return redirect()->route('admin.discount.index', $discount)->withFlashSuccess(__('Record updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Discount $discount
     *
     * @return mixed
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->route('admin.discount.index')->withFlashSuccess(__('Record deleted.'));
    }



    /**
     * Return the model chosen otherwise by default Tour
     *
     * @param string $model
     *
     * @return string
     */
    protected function modelHaveDiscount(string $model = "Tour"):string
    {

        $model = ucfirst($model);

        foreach ($this->modelsHaveDiscount() as $modelsHaveDiscountName) {
            if ($modelsHaveDiscountName["text"] === $model) {
                return "\\App\\Models\\$model";
            }
        }
        return "\\App\\Models\\Tour";
    }

    /**
     * Return all the models that have a price field to which you apply the discount
     *
     * @return \Illuminate\Support\Collection
     */
    protected function modelsHaveDiscount()
    {

        return collect([
            ['value' => "App\\Models\\Tour", 'text'=> "Tour"],
        ]);
    }
}
