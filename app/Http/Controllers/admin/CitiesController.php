<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cities_index()
    {
        $Cities = City::all();
        return view('admin.tourism.cities.index', compact('Cities'));
    }

    public function create_cities()
    {
        return view('admin.tourism.cities.create');
    }

    public function store_cities(Request $request)
    {
        $validated = $request->validate([
            'cityName' => 'required|string|max:255',
            'citySlug' => 'required|string|max:255|unique:categories,slug',
            'cityIcon' => 'nullable|image',
            'cityBanner' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        // Store uploaded files
        $iconPath = $request->hasFile('cityIcon')
            ? $request->file('cityIcon')->store('icons', 'public')
            : null;

        $bannerPath = $request->hasFile('cityBanner')
            ? $request->file('cityBanner')->store('banners', 'public')
            : null;



        // Save to database
        City::create([
            'name' => $validated['cityName'],
            'slug' => $validated['citySlug'],
            'icon_path' => $iconPath,
            'banner_path' => $bannerPath,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Cities added successfully!');
    }




    public function edit_cities($id)
    {
        $city = City::findOrFail($id);
        return view('admin.tourism.cities.edit', compact('city'));
    }





    public function update_cities(Request $request, $id)
    {
        $city = City::findOrFail($id);

        $city->name = $request->cityName;
        $city->slug = $request->citySlug;
        $city->description = $request->description;

        if ($request->hasFile('cityIcon')) {
            $iconPath = $request->file('cityIcon')->store('icons', 'public');
            $city->icon_path = $iconPath;
        }

        if ($request->hasFile('cityBanner')) {
            $bannerPath = $request->file('cityBanner')->store('banners', 'public');
            $city->banner_path = $bannerPath;
        }

        $city->save();

        return redirect()->route('cities.index')->with('success', 'City updated successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $cities = City::findOrFail($id);

        // Optional: Delete associated files if needed
        if ($cities->icon_path) {
            Storage::disk('public')->delete($cities->icon_path);
        }
        if ($cities->banner_path) {
            Storage::disk('public')->delete($cities->banner_path);
        }

        $cities->delete();

        return redirect()->route('cities.index')->with('success', 'Category deleted successfully!');
    }
}
