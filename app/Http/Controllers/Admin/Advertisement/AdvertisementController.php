<?php

namespace App\Http\Controllers\Admin\Advertisement;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        $advertisements = Advertisement::paginate(20);

        return view('admin.advertisement.index', ['advertisements' => $advertisements]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $advertisement = new Advertisement();

        return view('admin.advertisement.create', ['advertisement' => $advertisement]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response|JsonResponse
     */
    public function store(Request $request)
    {
        //
        $advertisement = new Advertisement();
        $advertisement->fill($request->all());
        if ($request->hasFile('image_upload')) {
            $advertisement->deleteImage();
            $advertisement->uploadImage($request->file('image_upload'));
        }

        return redirect()->route('admin.advertisement.edit', $advertisement)->withFlashSuccess(__('Record created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Advertisement  $advertisement
     * @return View
     */
    public function edit(Advertisement $advertisement)
    {
        //
        return view('admin.advertisement.edit', ['advertisement' => $advertisement]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Advertisement  $advertisement
     * @return Response|JsonResponse
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        //
        $advertisement->update($request->all());
        if ($request->hasFile('image_upload')) {
            $advertisement->deleteImage();
            $advertisement->uploadImage($request->file('image_upload'));
        }
        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Updated')]);
        }

        return redirect()->route('admin.advertisement.edit', $advertisement)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Advertisement  $advertisement
     * @return Response
     */
    public function destroy(Advertisement $advertisement)
    {
        //
        $advertisement->deleteImage();
        $advertisement->delete();

        return redirect()->route('admin.advertisement.index')->withFlashSuccess(__('Record Deleted'));
    }
}
