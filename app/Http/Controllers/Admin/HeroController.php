<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{

public function displayHero()
{
    $hero = Hero::first();

    return response()->json([
        'hero' => $hero,
        'image_path' => $hero?->image,
        'image_url' => $hero ? asset($hero->image) : null,
    ]);
}

    public function store(Request $request)
{
    $hero = Hero::first();

    $data = $request->all();

if ($request->hasFile('cv_link')) {

    $file = $request->file('cv_link');

    $filename = time() . '_' . $file->getClientOriginalName();

    $file->move(public_path('cv'), $filename);

    $data['cv_link'] = 'cv/' . $filename;
}

if ($request->hasFile('image')) {

    $file = $request->file('image');

    $filename = time() . '_' . $file->getClientOriginalName();

    $file->move(public_path('heroes'), $filename);

    $data['image'] = 'heroes/' . $filename;
}

    if ($hero) {
        $hero->update($data);
        return response()->json($hero);
    }

    $hero = Hero::create($data);

    return response()->json($hero);
}

public function update(Request $request, $id)
{
    $hero = Hero::findOrFail($id);

    $data = $request->all();

    // CV upload to public/cv
    if ($request->hasFile('cv_link')) {

        $file = $request->file('cv_link');

        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('cv'), $filename);

        $data['cv_link'] = 'cv/' . $filename;
    }

    // Image upload to public/heroes
    if ($request->hasFile('image')) {

        $file = $request->file('image');

        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('heroes'), $filename);

        $data['image'] = 'heroes/' . $filename;
    }

    $hero->update($data);

    return response()->json($hero);
}
}