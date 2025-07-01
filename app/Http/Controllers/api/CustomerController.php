<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    // REGISTER

    public function customer_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'password'   => 'nullable|string|min:6',
            'number'     => 'nullable|string|max:20',
            'dob'        => 'nullable|date',
            'bio'        => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $plainPassword = $request->password;

        // Check if a user already exists with this email
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            if (!empty($existingUser->password)) {
                // Email is taken by a user with a password (active user)
                return response()->json([
                    'status' => false,
                    'error'  => 'Email is already taken'
                ], 422);
            }

            // If user exists with no password, update and reuse
            $existingUser->update([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'password'   => $plainPassword ? Hash::make($plainPassword) : null,
            ]);

            if (method_exists($existingUser, 'assignRole')) {
                $existingUser->assignRole('customer');
            }

            $customer = Customer::updateOrCreate(
                ['user_id' => $existingUser->id],
                [
                    'number' => $request->number,
                    'dob'    => $request->dob,
                    'bio'    => $request->bio,
                ]
            );

            $token = $existingUser->createToken('customer-token')->plainTextToken;

            return response()->json([
                'status'  => true,
                'message' => 'Existing user updated and registered as customer.',
                'data'    => [
                    'user'     => [
                        'id'         => $existingUser->id,
                        'first_name' => $existingUser->first_name,
                        'last_name'  => $existingUser->last_name,
                        'email'      => $existingUser->email,
                        'password'   => $plainPassword,
                        'hashed'     => $existingUser->password,
                    ],
                    'customer' => $customer,
                    'token'    => $token,
                ]
            ]);
        }

        // Create new user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => $plainPassword ? Hash::make($plainPassword) : null,
        ]);

        if (method_exists($user, 'assignRole')) {
            $user->assignRole('customer');
        }

        $customer = Customer::create([
            'user_id' => $user->id,
            'number'  => $request->number,
            'dob'     => $request->dob,
            'bio'     => $request->bio,
        ]);

        $token = $user->createToken('customer-token')->plainTextToken;

        return response()->json([
            'status'  => true,
            'message' => 'Customer registered successfully!',
            'data'    => [
                'user'     => [
                    'id'         => $user->id,
                    'first_name' => $user->first_name,
                    'last_name'  => $user->last_name,
                    'email'      => $user->email,
                    'password'   => $plainPassword,
                    'hashed'     => $user->password,
                ],
                'customer' => $customer,
                'token'    => $token,
            ]
        ]);
    }


    //login
    public function customer_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found. Please register first.'
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials.'
            ], 401);
        }

        if (method_exists($user, 'hasRole') && !$user->hasRole('customer')) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized role.'
            ], 403);
        }

        $user->tokens()->delete();
        $token = $user->createToken('customer-token', ['customer:access'])->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => $user->only(['id', 'first_name', 'last_name', 'email']),
                'token' => $token,
                'token_type' => 'bearer'
            ]
        ]);
    }

    public function some_high_action(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'High security action performed',
            'data' => []
        ]);
    }



    public function forgotPassword(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'email' => 'required|email|exists:users,email'
            ]);

            // Check if the user is a customer (has a record in the customers table)
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No user found with the provided email.'
                ], 404);
            }

            // Check if the user is a customer by verifying a matching record in customers table
            $customer = Customer::where('user_id', $user->id)->first();

            if (!$customer) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No customer account found with the provided email.'
                ], 404);
            }

            // Send password reset link
            $response = Password::sendResetLink(
                $request->only('email')
            );

            if ($response === Password::RESET_LINK_SENT) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Password reset link sent to your email.'
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Unable to send reset link.'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process forgot password request',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function customer_profile($id)
    {
        try {
            // Find user with their customer data
            $user = User::with('customer')->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => [
                    'user' => $user
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve customer profile: ' . $e->getMessage()
            ], 404);
        }
    }

    public function update_customer(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'nullable|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255|unique:users,email,' . $id,
                'number' => 'nullable|string|max:20',
                'bio' => 'nullable|string|max:500',
                'dob' => 'nullable|date',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Find user
            $user = User::findOrFail($id);

            // Track if any updates were actually made
            $isUpdated = false;

            // Prepare user data
            $userData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ];

            // Filter out nulls and unchanged values
            $filteredUserData = collect($userData)
                ->filter(fn($value, $key) => !is_null($value) && $user->$key !== $value)
                ->toArray();

            // Handle profile picture
            if ($request->hasFile('profile_picture')) {
                if ($user->profile_picture) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
                $imagePath = $request->file('profile_picture')->store('avatars', 'public');
                $filteredUserData['profile_picture'] = $imagePath;
            }

            // Update user only if something changed
            if (!empty($filteredUserData)) {
                $user->update($filteredUserData);
                $isUpdated = true;
            }

            // Handle customer data
            $customerData = [
                'number' => $request->number,
                'bio' => $request->bio,
                'dob' => $request->dob,
            ];

            $customer = $user->customer;
            $filteredCustomerData = collect($customerData)
                ->filter(fn($value, $key) => !is_null($value) && (!$customer || $customer->$key !== $value))
                ->toArray();

            if ($customer) {
                if (!empty($filteredCustomerData)) {
                    $customer->fill($filteredCustomerData);
                    $customer->save();
                    $isUpdated = true;
                }
            } else {
                if (!empty($filteredCustomerData)) {
                    $user->customer()->create($filteredCustomerData);
                    $isUpdated = true;
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => $isUpdated
                    ? 'Customer updated successfully'
                    : 'No fields were changed, returning current data',
                'data' => [
                    'user' => $user->fresh()->load('customer')
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update customer: ' . $e->getMessage()
            ], 500);
        }
    }





    public function changePassword(Request $request): JsonResponse
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'confirmed',
            ],
            'new_password_confirmation' => ['required', 'string'],
        ], [
            'new_password.regex' => 'The new password must contain at least one uppercase letter, one lowercase letter, and one number.',
            'new_password.confirmed' => 'The new password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // Get the authenticated user
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect',
            ], 401);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'message' => 'Password updated successfully',
        ], 200);
    }
}
