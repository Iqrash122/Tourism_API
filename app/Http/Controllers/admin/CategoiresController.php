<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoiresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function category_index()
    {
        $categories = Category::all();
        return view('admin.tourism.categories.index', compact('categories'));
    }

    public function create_category()
    {
        return view('admin.tourism.categories.create');
    }


    public function store_category(Request $request)
    {
        $validated = $request->validate([
            'categoryName' => 'required|string|max:255',
            'categorySlug' => 'required|string|max:255|unique:categories,slug',
            'categoryIcon' => 'nullable|image',
            'categoryBanner' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        // Store uploaded files
        $iconPath = $request->hasFile('categoryIcon')
            ? $request->file('categoryIcon')->store('icons', 'public')
            : null;

        $bannerPath = $request->hasFile('categoryBanner')
            ? $request->file('categoryBanner')->store('banners', 'public')
            : null;



        // Save to database
        Category::create([
            'name' => $validated['categoryName'],
            'slug' => $validated['categorySlug'],
            'icon_path' => $iconPath,
            'banner_path' => $bannerPath,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Category added successfully!');
    }






    public function edit_category($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.tourism.categories.edit', compact('category'));
    }




    public function update_category(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->name = $request->categoryName;
        $category->slug = $request->categorySlug;
        $category->description = $request->description;

        if ($request->hasFile('categoryIcon')) {
            $iconPath = $request->file('categoryIcon')->store('icons', 'public');
            $category->icon_path = $iconPath;
        }

        if ($request->hasFile('categoryBanner')) {
            $bannerPath = $request->file('categoryBanner')->store('banners', 'public');
            $category->banner_path = $bannerPath;
        }

        $category->save();

        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Optional: Delete associated files if needed
        if ($category->icon_path) {
            Storage::disk('public')->delete($category->icon_path);
        }
        if ($category->banner_path) {
            Storage::disk('public')->delete($category->banner_path);
        }

        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
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
  
}
