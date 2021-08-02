<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Discount\DiscountBasicRequest;
use App\Models\Currency;
use App\Models\Discount;
use App\Models\Tour;
use App\Services\DiscountService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    protected $service;

    public function __construct(DiscountService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.discount.index');
    }

    /**
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
     * @param DiscountBasicRequest $request
     * @return mixed
     */
    public function store(DiscountBasicRequest $request)
    {

        $discount = $this->service->store($request->validated());

        return redirect()->route('admin.discount.index', ['discount'=> $discount])->withFlashSuccess(__('Discount created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * @param Discount $discount
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
     * @param DiscountBasicRequest $request
     * @param Discount $discount
     * @return mixed
     * @throws GeneralException
     */
    public function update(DiscountBasicRequest $request, Discount $discount)
    {
        $this->service->update($discount, $request->validated());

        return redirect()->route('admin.discount.index', $discount)->withFlashSuccess(__('Discount updated.'));
    }

    /**
     * @param Discount $discount
     * @return mixed
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->route('admin.discount.index')->withFlashSuccess(__('Discount deleted.'));
    }

    /**
     * @return Builder
     */
    protected function query(){

        return  Discount::query();
    }

    /**
     * @param string $model
     * @return string
     */
    protected function modelHaveDiscount(string $model = "Tour"):string{

        $model = ucfirst($model);

        foreach ($this->modelsHaveDiscount() as $modelsHaveDiscountName){

            if ($modelsHaveDiscountName["text"] === $model)

                return "\\App\\Models\\$model";
        }
        return "\\App\\Models\\Tour";
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    protected function modelsHaveDiscount(){

        return collect([
            ['value' => "App\\Models\\Tour", 'text'=> "Tour"],
        ]);
    }
}
