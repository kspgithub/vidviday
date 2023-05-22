<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function get(Request $request)
{
    try {
        $request->validate([
            'page' => 'required|integer|min:1',
        ]);

        $page_id = $request->input('page');
        $page = Page::query()->findOrFail($page_id);

        return response()->json($page);
    } catch (ValidationException $e) {
        return response()->json(['error' => $e->errors()], 422);
    }
}
}
