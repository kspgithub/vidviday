<?php

namespace App\Http\Controllers\Admin\SiteMenu;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiteMenu\MenuItemBasicRequest;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MenuItemController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $menuItems  = MenuItem::query()->get();

        return view('admin.site-menu.menu-item.index', [
            "menuItems" => $menuItems,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $menuItem = new MenuItem();

        $menus  = Menu::toSelectBox('title', 'id');

        $parentMenuItems  = MenuItem::toSelectBox('title', 'id');


        return view("admin.site-menu.menu-item.create", [
            "menuItem" => $menuItem,
            "menus" => $menus,
            "parentMenuItems" => $parentMenuItems,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MenuItemBasicRequest $request
     *
     * @return mixed
     */
    public function store(MenuItemBasicRequest $request)
    {
        $menuItem = new MenuItem();

        $menuItem->fill($request->all());
        $menuItem->save();

        return redirect()->route('admin.menu-item.index')
                         ->withFlashSuccess(__('Record created.'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param MenuItem $menuItem
     *
     * @return Application|Factory|View
     */
    public function edit(MenuItem $menuItem)
    {
        $menus  = Menu::toSelectBox('title', 'id');

        $parentMenuItems  = MenuItem::toSelectBox('title', 'id');

        return view('admin.site-menu.menu-item.edit', [
            'menuItem'=> $menuItem,
            "menus" => $menus,
            "parentMenuItems" => $parentMenuItems,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MenuItemBasicRequest $request
     *
     * @param MenuItem $menuItem
     *
     * @return mixed
     *
     * @throws GeneralException
     */
    public function update(MenuItemBasicRequest $request, MenuItem $menuItem)
    {
        $menuItem->fill($request->all());
        $menuItem->save();

        return redirect()->route('admin.menu-item.index', $menuItem)->withFlashSuccess(__('Record updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuItem  $menuItem
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return redirect()->route('admin.menu-item.index')->withFlashSuccess(__('Record deleted.'));
    }
}
