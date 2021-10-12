<?php

namespace App\Http\Controllers\Admin\Food;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Food;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $items = Food::query()->withCount(['media'])->get();

        return view('admin.food.index', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $food = new Food();
        $food->currency = 'UAH';
        $currencies = Currency::toSelectBox('iso', 'iso');
        return view('admin.food.create', [
            'model' => $food,
            'currencies' => $currencies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $food = new Food();
        $food->fill($request->all());
        $food->save();
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as  $imageFile) {
                $food->storeMedia($imageFile);
            }
        }
        return redirect()->route('admin.food.index')->withFlashSuccess(__('Record Created'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Food $food
     * @return View
     */
    public function edit(Food $food)
    {
        //
        $currencies = Currency::toSelectBox('iso', 'iso');
        return view('admin.food.edit', [
            'model' => $food,
            'currencies' => $currencies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Food $food
     * @return Response
     */
    public function update(Request $request, Food $food)
    {
        //
        $food->fill($request->all());
        $food->save();
        return redirect()->route('admin.food.index')->withFlashSuccess(__('Record updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Food $food
     * @return Response
     */
    public function destroy(Food $food)
    {
        //
        $food->delete();
        return redirect()->route('admin.food.index')->withFlashSuccess(__('Record deleted'));
    }
}
