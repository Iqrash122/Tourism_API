<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;

class ToursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function tours_index()
    {
        $tours = Tour::all();

        if ($tours->isEmpty()) {
            return response()->json([
                'message' => 'Tours Not Found'
            ], 404);
        }

        $tours = $tours->map(function ($tour) {
            $tour->price_variations = json_decode($tour->price_variations, true) ?: [];
            $tour->time_variations = json_decode($tour->time_variations, true) ?: [];
            $tour->activity_multiple_images = json_decode($tour->activity_multiple_images, true) ?: [];

            $category_ids = json_decode($tour->activity_categories, true) ?: [];
            $city_ids = json_decode($tour->activity_cities, true) ?: [];

            $tour->categories = Category::whereIn('id', $category_ids)->get(['id', 'name']);
            $tour->cities = City::whereIn('id', $city_ids)->get(['id', 'name']);

            // Decode feature offers and promotion tours as arrays, or empty array if null
            $tour->feature_offers = json_decode($tour->feature_offers, true) ?: [];
            $tour->promotion_tours = json_decode($tour->promotion_tours, true) ?: [];

            return $tour;
        });

        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => $tours
        ], 200);
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show_tours(string $id)
    {
        $tours = Tour::find($id);
        if (!$tours) {
            return response()->json([
                'message' => 'Tours not Found'
            ], 404);
        }
        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => $tours
        ], 200);
    }

    /**
     * Get tours grouped by categories
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * Get tours grouped by activity categories
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function toursByCategory($id)
    {
        try {
            if (!is_numeric($id)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid category ID format'
                ], 400);
            }

            $category = Category::find($id);

            if (!$category) {
                $availableIds = Category::pluck('id')->toArray();

                return response()->json([
                    'status' => 'error',
                    'message' => 'Category not found',
                    'available_category_ids' => $availableIds
                ], 404);
            }

            $tours = Tour::whereJsonContains('activity_categories', $id)->get();

            if ($tours->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No tours found for this category'
                ], 404);
            }

            $tours = $tours->map(function ($tour) {
                $tour->price_variations = json_decode($tour->price_variations, true);
                $tour->time_variations = json_decode($tour->time_variations, true);
                $tour->activity_multiple_images = json_decode($tour->activity_multiple_images, true);

                $category_ids = json_decode($tour->activity_categories, true);
                $city_ids = json_decode($tour->activity_cities, true);

                $tour->categories = Category::whereIn('id', $category_ids)->get();
                $tour->cities = City::whereIn('id', $city_ids)->get();

                return $tour;
            });

            return response()->json([
                'status' => 'success',
                'data' => [
                    'category_id' => $category->id,
                    'category_name' => $category->name,
                    'category_slug' => $category->slug,
                    'tours' => $tours
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch tours',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function toursByCity($id)
    {
        try {
            if (!is_numeric($id)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid city ID format'
                ], 400);
            }

            $city = City::find($id);

            if (!$city) {
                $availableIds = City::pluck('id')->toArray();

                return response()->json([
                    'status' => 'error',
                    'message' => 'City not found',
                    'available_city_ids' => $availableIds
                ], 404);
            }

            $tours = Tour::whereJsonContains('activity_cities', $id)->get();

            if ($tours->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No tours found for this city'
                ], 404);
            }

            $tours = $tours->map(function ($tour) {
                $tour->price_variations = json_decode($tour->price_variations, true);
                $tour->time_variations = json_decode($tour->time_variations, true);
                $tour->activity_multiple_images = json_decode($tour->activity_multiple_images, true);

                $category_ids = json_decode($tour->activity_categories, true);
                $city_ids = json_decode($tour->activity_cities, true);

                $tour->categories = Category::whereIn('id', $category_ids)->get();
                $tour->cities = City::whereIn('id', $city_ids)->get();

                return $tour;
            });

            return response()->json([
                'status' => 'success',
                'data' => [
                    'city_id' => $city->id,
                    'city_name' => $city->name,
                    'city_slug' => $city->slug,
                    'tours' => $tours
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch tours',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function topRatedTours()
    {
        try {
            $tours = Tour::where('top_rated', 1)->get();

            if ($tours->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No top-rated tours found'
                ], 404);
            }

            $tours = $tours->map(function ($tour) {
                $tour->price_variations = json_decode($tour->price_variations, true);
                $tour->time_variations = json_decode($tour->time_variations, true);
                $tour->activity_multiple_images = json_decode($tour->activity_multiple_images, true);

                $category_ids = json_decode($tour->activity_categories, true);
                $city_ids = json_decode($tour->activity_cities, true);

                $tour->categories = Category::whereIn('id', $category_ids)->get();
                $tour->cities = City::whereIn('id', $city_ids)->get();

                return $tour;
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => [
                    'tours' => $tours
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch top-rated tours',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function promotion_tours()
    {
        try {
            $tours = Tour::where('promotion_tours', 1)->get();

            if ($tours->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No promotional tours found'
                ], 404);
            }

            $tours = $tours->map(function ($tour) {
                $tour->price_variations = json_decode($tour->price_variations, true);
                $tour->time_variations = json_decode($tour->time_variations, true);
                $tour->activity_multiple_images = json_decode($tour->activity_multiple_images, true);

                $category_ids = json_decode($tour->activity_categories, true);
                $city_ids = json_decode($tour->activity_cities, true);

                $tour->categories = Category::whereIn('id', $category_ids)->get();
                $tour->cities = City::whereIn('id', $city_ids)->get();

                return $tour;
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => [
                    'tours' => $tours
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch promotional tours',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function feature_offers()
    {
        try {
            $tours = Tour::where('feature_offers', 1)->get();

            if ($tours->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No featured offer tours found'
                ], 404);
            }

            $tours = $tours->map(function ($tour) {
                $tour->price_variations = json_decode($tour->price_variations, true);
                $tour->time_variations = json_decode($tour->time_variations, true);
                $tour->activity_multiple_images = json_decode($tour->activity_multiple_images, true);

                $category_ids = json_decode($tour->activity_categories, true);
                $city_ids = json_decode($tour->activity_cities, true);

                $tour->categories = Category::whereIn('id', $category_ids)->get();
                $tour->cities = City::whereIn('id', $city_ids)->get();

                return $tour;
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => [
                    'tours' => $tours
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch featured offer tours',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function topRatedToursByCat($id)
    {
        try {
            if (!is_numeric($id)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid category ID format'
                ], 400);
            }

            $category = Category::find($id);

            if (!$category) {
                $availableIds = Category::pluck('id')->toArray();

                return response()->json([
                    'status' => 'error',
                    'message' => 'Category not found',
                    'available_category_ids' => $availableIds
                ], 404);
            }

            $tours = Tour::where('top_rated', 1)
                ->whereJsonContains('activity_categories', $id)
                ->get();

            if ($tours->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No top-rated tours found for this category'
                ], 404);
            }

            $tours = $tours->map(function ($tour) {
                $tour->price_variations = json_decode($tour->price_variations, true);
                $tour->time_variations = json_decode($tour->time_variations, true);
                $tour->activity_multiple_images = json_decode($tour->activity_multiple_images, true);

                $category_ids = json_decode($tour->activity_categories, true);
                $city_ids = json_decode($tour->activity_cities, true);

                $tour->categories = Category::whereIn('id', $category_ids)->get();
                $tour->cities = City::whereIn('id', $city_ids)->get();

                return $tour;
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => [
                    'category_id' => $category->id,
                    'category_name' => $category->name,
                    'category_slug' => $category->slug,
                    'tours' => $tours
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch top-rated tours',
                'error' => $e->getMessage()
            ], 500);
        }
    }






    public function searchTours($searchTerm)
    {
        try {
            // Validate the search term
            if (empty($searchTerm)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Search term is required'
                ], 400);
            }

            // Search for tours where activity_title matches the search term (case-insensitive)
            $tours = Tour::where('activity_title', 'LIKE', '%' . $searchTerm . '%')
                ->get();

            // Check if any tours were found
            if ($tours->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No tours found for the search term: ' . $searchTerm
                ], 404);
            }

            $tours = $tours->map(function ($tour) {
                $tour->price_variations = json_decode($tour->price_variations, true);
                $tour->time_variations = json_decode($tour->time_variations, true);
                $tour->activity_multiple_images = json_decode($tour->activity_multiple_images, true);

                $category_ids = json_decode($tour->activity_categories, true);
                $city_ids = json_decode($tour->activity_cities, true);

                $tour->categories = Category::whereIn('id', $category_ids)->get();
                $tour->cities = City::whereIn('id', $city_ids)->get();

                return $tour;
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => [
                    'search_term' => $searchTerm,
                    'tours' => $tours
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to search tours',
                'error' => $e->getMessage()
            ], 500);
        }
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
    public function destroy(string $id)
    {
        //
    }
}
