<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Customer;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewTourAdded;

class TourismController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all tours
        $tours = Tour::all();
        //fetch categories and cities if needed
        $categories = Category::all();
        $cities = City::all();
        return view('admin.tourism.index', compact('tours', 'categories', 'cities'));
    }

    public function create_tour()
    {
        // Fetch categories and cities if needed
        $categories = Category::all();
        $cities = City::all();
        return view('admin.tourism.create', compact('categories', 'cities'));
    }




    public function store_tour(Request $request)
    {
        // Handle uploaded images
        $images = [];
        if ($request->hasFile('activity_multiple_images')) {
            foreach ($request->file('activity_multiple_images') as $image) {
                $images[] = $image->store('tour_images', 'public');
            }
        }

        // Handle logo upload if feature_offers is checked
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        // Decode variations
        $variationsData = json_decode($request->serialized_data, true);
        $priceVariations = $variationsData['priceVariations'] ?? [];
        $timeVariations = $variationsData['timeVariations'] ?? [];

        // Prepare JSON fields
        $featureOffersData = null;
        if ($request->has('feature_offers')) {
            // Fix: Use correct input names
            $logoPath = null;
            if ($request->hasFile('logo_feature')) {
                $logoPath = $request->file('logo_feature')->store('logos', 'public');
            }

            $featureOffersData = [
                'enabled' => true,
                'discount' => $request->input('discount_feature'),
                'logo' => $logoPath,
            ];
        }

        $promotionToursData = null;
        if ($request->has('promotion_tours')) {
            $promotionToursData = [
                'enabled' => true,
                'discount' => $request->input('discount_promotion'),
            ];
        }


        // Create the tour
        $tour = Tour::create([
            'activity_title' => $request->activity_title,
            'activity_slug' => $request->activity_slug,
            'seo_title' => $request->seo_title,
            'seo_keywords' => $request->seo_keywords,
            'seo_description' => $request->seo_description,
            'body' => $request->body,
            'activity_categories' => json_encode($request->activity_categories),
            'activity_cities' => json_encode($request->activity_cities),
            'top_rated' => $request->has('top_rated') ? 1 : 0,
            'rating_bar' => $request->rating_bar ?? 0,
            'yt_url' => $request->yt_url,
            'activity_location' => $request->activity_location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'activity_multiple_images' => json_encode($images),
            'price_variations' => json_encode($priceVariations),
            'time_variations' => json_encode($timeVariations),
            'feature_offers' => $featureOffersData ? json_encode($featureOffersData) : null,
            'promotion_tours' => $promotionToursData ? json_encode($promotionToursData) : null,
        ]);

        // Notify customers
        $customers = Customer::all();
        foreach ($customers as $customer) {
            $customer->notify(new NewTourAdded($tour));
        }

        return redirect()->route('tourism.index')->with('success', 'Tour created successfully.');
    }





    public function edit_tour($id)
    {
        $tour = Tour::findOrFail($id);
        $categories = Category::all();
        $cities = City::all();
        $priceVariations = json_decode($tour->price_variations, true) ?? [];
        $timeVariations = json_decode($tour->time_variations, true) ?? [];
        $images = json_decode($tour->activity_multiple_images, true) ?? [];


        return view('admin.tourism.edit', compact('tour', 'categories', 'cities', 'priceVariations', 'timeVariations', 'images'));
    }



    public function update_tour(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);

        $images = json_decode($tour->activity_multiple_images, true) ?? [];

        if ($request->hasFile('activity_multiple_images')) {
            foreach ($request->file('activity_multiple_images') as $image) {
                // Optional: Validate file here (type, size)
                $images[] = $image->store('tour_images', 'public');
            }
        }

        $variationsData = json_decode($request->serialized_data, true);
        $priceVariations = $variationsData['priceVariations'] ?? [];
        $timeVariations = $variationsData['timeVariations'] ?? [];

        $tour->update([
            'activity_title' => $request->activity_title,
            'activity_slug' => $request->activity_slug,
            'seo_title' => $request->seo_title,
            'seo_keywords' => $request->seo_keywords,
            'seo_description' => $request->seo_description,
            'body' => $request->body,
            'activity_categories' => json_encode($request->activity_categories),
            'activity_cities' => json_encode($request->activity_cities),
            'feature_offers' => $request->has('feature_offers') ? 1 : 0,
            'promotion_tours' => $request->has('promotion_tours') ? 1 : 0,
            'top_rated' => $request->has('top_rated') ? 1 : 0,
            'rating_bar' => $request->rating_bar ?? 0,
            'yt_url' => $request->yt_url,
            'activity_location' => $request->activity_location,
            'activity_multiple_images' => json_encode($images),
            'price_variations' => json_encode($priceVariations),
            'time_variations' => json_encode($timeVariations),
        ]);

        return redirect()->route('tourism.index')->with('success', 'Tour updated successfully.');
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
    public function destroy(string $id)
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();

        return redirect()->route('tourism.index')->with('success', 'Tour deleted successfully.');
    }

    public function show_tour($id)
    {


        $tour = Tour::findOrFail($id);
        $categories = Category::all();
        $cities = City::all();

        return view('admin.tourism.show', compact('tour', 'categories', 'cities'));
    }
}
