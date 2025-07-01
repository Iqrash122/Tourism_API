<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function customer_index()
    {
        $customers = User::role('customer')->with('customer')->get();


        return view('admin.customers.index', compact('customers'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create_customer()
    {
        return view('admin.customers.create');
    }



    public function store_customer(Request $request)
    {


        $imagePath = null;
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('avatars', 'public');
        }
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'profile_picture' => $imagePath,
        ]);


        $user->assignRole('customer');

        $customer = Customer::create([
            'user_id'         => $user->id,
            'number'          => $request->number ?? null,
            'bio'             => $request->bio ?? null,
            'dob'             => $request->dob ?? null,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Customer created successfully.',
                'customer' => [
                    'id' => $user->id,
                    'user' => [
                        'first_name' => $user->first_name,
                        'last_name'  => $user->last_name,
                    ],
                ]
            ]);
        }

        return redirect()->route('customer.index');
    }







    public function update_customer(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $userData = [
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
        ];

        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('avatars', 'public');
            $userData['profile_picture'] = $imagePath;
        }

        $user->update($userData);

        $customerData = [
            'number' => $request->number,
            'bio'    => $request->bio,
            'dob'    => $request->dob,
        ];

        $customer = $user->customer;
        $customer->update($customerData);

        return redirect()->route('customer.index')->with('success', 'Customer updated successfully!');
    }





    public function edit_customer($id)
    {

        $customer = User::with('customer')->findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }



    public function store_guest(Request $request)
    {

        $guest = Guest::create([
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'guest_phone' => $request->guest_phone,
        ]);

        return response()->json([
            'id' => $guest->id,
            'full_name' => $guest->guest_name, // Make sure this is the correct property
        ]);

        return response()->json(['message' => 'Guest saved successfully']);
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
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->back()->with('success', 'Customer deleted successfully!');
    }
}
