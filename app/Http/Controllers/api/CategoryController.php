<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category_index()
    {
        $category = Category::all();

        if ($category->isEmpty()) {
            return response()->json([
                'message' => 'No category found'
            ], 404);
        }

        return response()->json([
            'message' => 'category   retrieved successfully',
            'data' => $category
        ], 200);
    }

    public function show_category($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Category not found.'
            ], 404);
        }

        return response()->json([
            'message' => 'Category retrieved successfully.',
            'data' => $category
        ], 200);
    }
}
