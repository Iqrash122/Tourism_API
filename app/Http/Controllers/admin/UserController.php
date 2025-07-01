<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Pest\ArchPresets\Custom;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function users_index()
    {
        // Fetch users from the database
        $customers = Customer::all();
        $users = User::all();
        return view('admin.users.index', compact('customers', 'users'));
    }

    public function create_user()
    {
        return view('admin.users.create');
    }

    public function store_user(Request $request)
    {
        // 1. Validate the input
        $validated = $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|string|min:6',
            'number'           => 'nullable|string|max:20',
            'dob'              => 'nullable|date',
            'bio'              => 'nullable|string|max:255',
            'profile_picture'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Handle file upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public'); // store in storage/app/public/profile_pictures
        } else {
            $path = null;
        }

        $user = User::create([
            'first_name'      => $validated['first_name'],
            'last_name'       => $validated['last_name'],
            'email'           => $validated['email'],
            'password'        => Hash::make($validated['password']),
        ]);

        $user->assignRole($request->role);

        Customer::create([
            'user_id'         => $user->id,
            'number'          => $validated['number'] ?? null,
            'dob'             => $validated['dob'] ?? null,
            'bio'             => $validated['bio'] ?? null,
            'profile_picture' => $path,
        ]);
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }




    public function edit_user($id)
    {
        // Find the user by ID
        $user = User::with('customer')->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update_user(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public');
        } else {
            $path = $user->profile_picture;
        }

        $user->update([
            'first_name'      => $request->first_name,
            'last_name'       => $request->last_name,
            'email'           => $request->email,
            'profile_picture' => $path,
        ]);

        if ($request->filled('role')) {
            $user->syncRoles($request->role);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
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
        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }

        // Delete the user
        $user->delete();

        // Redirect or return success
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
