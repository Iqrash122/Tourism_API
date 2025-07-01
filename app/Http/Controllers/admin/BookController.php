<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Guest;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function book_tour_index()
    {
        $customers = Customer::all();
        $bookings = Booking::with('customer', 'tour')->get();
        return view('admin.bookings.index', compact('bookings', 'customers'));
    }

    public function create_book_tour()
    {
        $customers = Customer::with('user')->get();
        $tours = Tour::all();
        $guest = Guest::all();

        $tours->transform(function ($tour) {
            // Decode price variations
            $priceVariations = json_decode($tour->price_variations, true) ?? [];

            // Create packages array from price variations
            $packages = [];
            foreach ($priceVariations as $index => $variation) {
                $packages[] = [
                    'id' => $index,
                    'package_title' => $variation['title'] ?? 'Package ' . ($index + 1),
                    'regular_price' => $variation['regular'] ?? 0,
                    'sale_price' => $variation['sale'] ?? 0,
                    'price' => $variation['sale'] ?? $variation['regular'] ?? 0 // Default to sale price, then regular
                ];
            }

            $tour->packages = $packages;

            // Handle time variations if needed
            $timeVariations = json_decode($tour->time_variations, true) ?? [];
            $times = [];
            foreach ($timeVariations as $index => $time) {
                $times[] = [
                    'id' => $index,
                    'activity_start_time' => $time['start'] ?? '',
                    'label' => ($time['start'] ? date('g:i A', strtotime($time['start'])) : '') .
                        ($time['end'] ? ' - ' . date('g:i A', strtotime($time['end'])) : '')
                ];
            }

            $tour->times = $times;

            return $tour;
        });

        return view('admin.bookings.create', compact('customers', 'tours', 'guest'));
    }


    public function store_book_tour(Request $request)
    {

        // Generate a unique 7-character booking_order_id from UUIDv4
        do {
            $bookingOrderId = substr(Uuid::uuid4()->toString(), 0, 7); // Take first 7 characters
        } while (Booking::where('booking_order_id', $bookingOrderId)->exists());

        $convertedTime = date("H:i:s", strtotime($request->booking_time));

        Booking::create([

            'booking_customer' => $request->booking_customer,
            'booking_person' => $request->booking_person,
            'booking_status' => $request->booking_status,
            'booking_date' => $request->booking_date,
            'booking_time' => $convertedTime,
            'booking_price' => $request->booking_price,
            'booking_tour' => $request->booking_tour,
        ]);

        return redirect()->route('book_tour.index')->with('success', 'Booking created successfully.');
    }





    public function edit_book_tour($id)
    {
        $booking = Booking::findOrFail($id);
        $tours = Tour::all();
        $customers = Customer::with('user')->get(); // Fix: Use 'user' relation and get()
        // Transform tours to include proper package data
        $tours->transform(function ($tour) {
            $priceVariations = json_decode($tour->price_variations, true) ?? [];
            $packages = [];

            foreach ($priceVariations as $index => $variation) {
                $packages[] = [
                    'id' => $index,
                    'package_title' => $variation['title'] ?? 'Package ' . ($index + 1),
                    'price' => $variation['sale'] ?? $variation['regular'] ?? 0
                ];
            }

            $tour->packages = $packages;

            // Handle time variations
            $timeVariations = json_decode($tour->time_variations, true) ?? [];
            $times = [];
            foreach ($timeVariations as $index => $time) {
                $times[] = [
                    'id' => $index,
                    'activity_start_time' => $time['start'] ?? '',
                    'label' => ($time['start'] ? date('g:i A', strtotime($time['start'])) : '') .
                        ($time['end'] ? ' - ' . date('g:i A', strtotime($time['end'])) : '')
                ];
            }

            $tour->times = $times;

            return $tour;
        });

        return view('admin.bookings.edit', compact('booking', 'customers', 'tours'));
    }

    public function update_book_tour(Request $request, $id)
    {
        // Validate incoming request data
        $validatedData = $request->validate([

            'booking_customer' => 'required|exists:customers,id',  // Ensure the customer exists in the database
            'booking_person' => 'required|integer|min:1',  // Validating number of persons
            'booking_status' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'booking_time' => 'required|date_format:H:i:s',
            'booking_price' => 'required|numeric|min:0',
            'booking_tour' => 'required|exists:tours,id',  // Ensure the tour exists in the database
        ]);

        // Convert to MySQL-compatible time format
        $convertedTime = date("H:i:s", strtotime($request->booking_time));
        // Update the booking with validated data
        Booking::where('id', $id)->update([

            'booking_customer' => $request->booking_customer,
            'booking_person' => $request->booking_person,
            'booking_status' => $request->booking_status,
            'booking_date' => $request->booking_date,
            'booking_time' => $convertedTime,
            'booking_price' => $request->booking_price,
            'booking_tour' => $request->booking_tour,
        ]);

        return redirect()->route('book_tour.index')->with('success', 'Booking updated successfully.');
    }



    public function destroy($id)
    {
        Booking::destroy($id);
        return redirect()->route('book_tour.index')->with('success', 'Booking deleted successfully.');
    }


    public function show_book_tour($id)
    {

        $booking = Booking::findOrFail($id);
        $tour = Tour::all();
        return view('admin.bookings..show', compact('booking', 'tour'));
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
