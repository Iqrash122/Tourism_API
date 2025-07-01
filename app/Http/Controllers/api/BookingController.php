<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;

'App\Http\Controllers\api\JsonResponse';

use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function booking_index()
    {
        $booking = Booking::all();
        if (!$booking) {
            return response()->json([
                'message' => 'Booking not Found'
            ], 404);
        }
        return response()->json([
            'message' => 'Booking retrieved successfully',
            'data' => $booking
        ], 202);
    }



    public function post_booking(Request $request)
    {
        try {
            $validated = $request->validate([
                'booking_customer' => 'required|integer|exists:customers,id',
                'booking_person' => 'required|integer|min:1',
                'booking_status' => 'required|string',
                'booking_date' => 'required|date',
                'booking_time' => 'required|string',
                'booking_price' => 'required|numeric',
                'booking_tour' => 'required|integer|exists:tours,id',
                'booking_order_id' => 'nullable|string|max:255',

            ]);



            $booking = Booking::create($validated);

            return response()->json([
                'message' => 'Booking created successfully.',
                'data' => $booking
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed to create booking.',
                'error' => 'A database error occurred: ' . $e->getMessage()
            ], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function update_book_tour(Request $request, $id): JsonResponse
    {

        // Find the booking or return error
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json([
                'status' => 'error',
                'message' => 'Booking not found',
            ], 404);
        }

        // Convert to MySQL-compatible time format
        $convertedTime = date("H:i:s", strtotime($request->booking_time));

        // Update the booking with validated data
        $booking->update([
            'booking_customer' => $request->booking_customer,
            'booking_person' => $request->booking_person,
            'booking_status' => $request->booking_status,
            'booking_date' => $request->booking_date,
            'booking_time' => $convertedTime,
            'booking_price' => $request->booking_price,
            'booking_tour' => $request->booking_tour,
        ]);

        // Return JSON response with updated booking
        return response()->json([
            'status' => 'success',
            'message' => 'Booking updated successfully',
            'data' => $booking,
        ], 200);
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
