<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index()
    {
        return response()->json(Work::latest()->get());
    }

    // public function store(Request $request)
    // {
    //     $imagePath = null;

    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('works', 'public');
    //     }

    //     $work = Work::create([
    //         'title' => $request->title,
    //         'image' => $imagePath,
    //         'description' => $request->description,
    //         'technologies' => $request->technologies,
    //         'project_link' => $request->project_link,
    //     ]);

    //     return response()->json($work);
    // }

    public function store(Request $request)
{
    $imagePath = null;

    if ($request->hasFile('image')) {

        $image = $request->file('image');

        $imageName = time() . '_' . $image->getClientOriginalName();

        $image->move(public_path('works'), $imageName);

        $imagePath = 'works/' . $imageName;
    }

    $work = Work::create([
        'title' => $request->title,
        'image' => $imagePath,
        'description' => $request->description,
        'technologies' => $request->technologies,
        'project_link' => $request->project_link,
    ]);

    return response()->json($work);
}


    public function update(Request $request, $id)
{
    $work = Work::findOrFail($id);

    $imagePath = $work->image;

    if ($request->hasFile('image')) {

        $image = $request->file('image');

        $imageName = time() . '_' . $image->getClientOriginalName();

        $image->move(public_path('works'), $imageName);

        $imagePath = 'works/' . $imageName;
    }

    $work->update([
        'title' => $request->title,
        'image' => $imagePath,
        'description' => $request->description,
        'technologies' => $request->technologies,
        'project_link' => $request->project_link,
    ]);

    return response()->json($work);
}


    public function destroy($id)
{
    $work = Work::findOrFail($id);

    if ($work->image) {
        $imagePath = public_path($work->image);

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    $work->delete();

    return response()->json([
        'message' => 'Work deleted successfully'
    ]);
}
}