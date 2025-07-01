<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\SupportQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupportController extends Controller
{
    // Get all support queries
    public function support_index()
    {
        $queries = SupportQuery::with(['customer.user'])->latest()->get();
        return response()->json([
            'success' => true,
            'data' => $queries
        ]);
    }

    // Get all customers (for creating support)
    public function create_support()
    {
        $customers = Customer::all();
        return response()->json([
            'success' => true,
            'data' => $customers
        ]);
    }

    // Store a new support query
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|string|email|max:255',
            'type' => 'required|string',
            'query' => 'required|string',
            'status' => 'required|string|in:Open,Closed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $query = SupportQuery::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Support query submitted successfully.',
            'data' => $query
        ], 201);
    }

    // Get a specific query for editing
    public function edit_support($id)
    {
        $query = SupportQuery::with('user')->find($id);

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Support query not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $query
        ]);
    }

    // Update a support query
    public function update_support(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'nullable|in:Open,Closed',
            'response' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $query = SupportQuery::find($id);

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Support query not found.'
            ], 404);
        }

        $query->update([
            'status' => $request->status,
            'response' => $request->reply,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Support query updated successfully.',
            'data' => $query
        ]);
    }

    // Delete a support query
    public function destroy_support($id)
    {
        $query = SupportQuery::find($id);

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Support query not found.'
            ], 404);
        }

        $query->delete();

        return response()->json([
            'success' => true,
            'message' => 'Support query deleted successfully.'
        ]);
    }
}
