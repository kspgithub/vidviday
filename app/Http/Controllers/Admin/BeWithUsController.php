<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BeWithUs;
use Illuminate\Http\Request;

class BeWithUsController extends Controller
{
    public function index()
    {
        $bewithus = BeWithUs::orderBy('position')->get();

        return view('admin.bewithus.edit', compact('bewithus'));
    }

    /* public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'url' => 'required|url',
            'published' => 'boolean',
            'position' => 'integer',
        ]);

        BeWithUs::create($validatedData);

        return response()->json(['message' => 'BeWithUs record created successfully']);
    } */

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'url' => 'required|array',
            'published' => 'array',
            'position' => 'array',
        ]);
    
        foreach ($validatedData['url'] as $itemId => $urls) {
            $item = BeWithUs::findOrFail($itemId);
    
            $item->setTranslations('url', $urls);

            $item->save(); // Сохранение записи
        }
    
        return redirect()->route('admin.bewithus.edit')->with('success', 'BeWithUs records updated successfully');
    }

    /* public function destroy(BeWithUs $bewithus)
    {
        $bewithus->delete();

        return response()->json(['message' => 'BeWithUs record deleted successfully']);
    } */
}

