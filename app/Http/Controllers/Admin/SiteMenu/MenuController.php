<?php

namespace App\Http\Controllers\Admin\SiteMenu;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiteMenu\MenuBasicRequest;
use App\Models\Menu;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MenuController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $menus = Menu::query()->get();

        return view('admin.site-menu.menu.index', [
            "menus" => $menus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $menu = new Menu();

        return view("admin.site-menu.menu.create", [
            "menu" => $menu
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MenuBasicRequest $request
     *
     * @return mixed
     */
    public function store(MenuBasicRequest $request)
    {
        $menu = new Menu();

        $menu->fill($request->all());
        $menu->save();

        return redirect()->route('admin.menu.index')->withFlashSuccess(__('Record created.'));
    }



    /**
     *  Show the form for editing the specified resource.
     *
     * @param Menu $menu
     *
     * @return Application|Factory|View
     */
    public function edit(Menu $menu)
    {
        return view('admin.site-menu.menu.edit', [
            'menu'=> $menu
        ]);
    }

    /**
     *  Update the specified resource in storage.
     *
     * @param MenuBasicRequest $request
     *
     * @param Menu $menu
     *
     * @return mixed
     *
     * @throws GeneralException
     */
    public function update(MenuBasicRequest $request, Menu $menu)
    {
        $menu->fill($request->all());
        $menu->save();

        return redirect()->route('admin.menu.index', $menu)->withFlashSuccess(__('Record updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Menu $menu
     *
     * @return mixed
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menu.index')->withFlashSuccess(__('Record deleted.'));
    }
}
