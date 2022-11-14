<?php

namespace App\Http\Controllers\Admin\SiteMenu;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiteMenu\MenuItemBasicRequest;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $menus = Menu::query()->with([
            'items' => function ($q) {
                return $q->where('parent_id', 0);
            }, 'items.children'
        ])->get();

        return view('admin.site-menu.index', [
            'menus' => $menus,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Request $request, Menu $menu)
    {
        $item = new MenuItem();
        $item->menu_id = $menu->id;
        $item->parent_id = $request->input('parent_id', 0);
        $item->side = MenuItem::SIDE_LEFT;

        $pages = Page::toSelectBox();
        $sides = arrayToSelectBox(MenuItem::sides());

        return view('admin.site-menu.menu-item.create', [
            'item' => $item,
            'menu' => $menu,
            'pages' => $pages,
            'sides' => $sides,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MenuItemBasicRequest  $request
     *
     * @return mixed
     */
    public function store(MenuItemBasicRequest $request, Menu $menu)
    {
        $item = new MenuItem();
        $item->menu_id = $menu->id;
        $item->parent_id = $request->input('parent_id', 0);
        $item->side = $request->input('side', MenuItem::SIDE_LEFT);

        $item->fill($request->validated());
        $item->save();

        return redirect()->route('admin.site-menu.index')
            ->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MenuItem  $item
     *
     * @return View
     */
    public function edit(MenuItem $item)
    {
        $pages = Page::toSelectBox();
        $sides = arrayToSelectBox(MenuItem::sides());

        return view('admin.site-menu.menu-item.edit', [
            'item' => $item,
            'pages' => $pages,
            'sides' => $sides,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MenuItemBasicRequest  $request
     * @param MenuItem  $item
     *
     * @throws GeneralException
     *
     * @return mixed
     */
    public function update(MenuItemBasicRequest $request, MenuItem $item)
    {
        $item->fill($request->validated());
        $item->save();

        return redirect()->route('admin.site-menu.index')->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MenuItem  $item
     *
     * @return Response|JsonResponse
     */
    public function destroy(Request $request, MenuItem $item)
    {
        $item->delete();
        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Deleted')]);
        }

        return redirect()->route('admin.site-menu.index')->withFlashSuccess(__('Record Deleted'));
    }

    public function sort(Request $request)
    {
        $sortData = $request->input('sortData', []);
        foreach ($sortData as $data) {
            MenuItem::whereKey($data['id'])->update(['position' => $data['position']]);
        }

        return response()->json(['result' => 'success', 'message' => __('Record Updated')]);
    }

    public function status(Request $request, MenuItem $item)
    {
        $item->published = ! $item->published;
        $item->save();

        return response()->json(['result' => 'success', 'message' => $item->published ? __('Record Published') : __('Record Unpublish')]);
    }
}
