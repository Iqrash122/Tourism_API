<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class PasswordResetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }



    public function forgotPassword(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'token' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            // If only email is provided, send reset link
            if (!$request->has('token') && !$request->has('password')) {
                // Remove throttle for this email
                $emailKey = 'reset-password|' . $request->email;
                RateLimiter::clear($emailKey);

                // Override the reset URL generator callback
                Password::createUrlUsing(function ($user, string $token) use ($request) {
                    // You can change this to match your mobile app reset password route
                    $frontendUrl = config('app.frontend_url', 'https://your-app.com');
                    return "{$frontendUrl}/reset-password?token={$token}&email=" . urlencode($user->email);
                });

                $status = Password::sendResetLink($request->only('email'));

                return response()->json([
                    'status' => 'success',
                    'message' => __($status),
                ], 200);
            }

            // If token and password are provided, reset the password
            if ($request->has('token') && $request->has('password')) {
                $status = Password::reset(
                    $request->only('email', 'password', 'password_confirmation', 'token'),
                    function ($user, $password) {
                        $user->forceFill([
                            'password' => Hash::make($password),
                            'remember_token' => Str::random(60),
                        ])->save();

                        event(new PasswordReset($user));
                    }
                );

                return $status === Password::PASSWORD_RESET
                    ? response()->json([
                        'status' => 'success',
                        'message' => __($status)
                    ], 200)
                    : response()->json([
                        'status' => 'error',
                        'message' => __($status)
                    ], 400);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Invalid request parameters.'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }





    public function updatePassword(Request $request)
    {
        try {
            // Get the authenticated user (customer) via Sanctum
            $user = Auth::guard('sanctum')->user();

            // Check if user is authenticated
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized',
                    'timestamp' => now()->toDateTimeString(),
                ], Response::HTTP_UNAUTHORIZED);
            }

            // Verify if the user has a related customer record
            $customer = Customer::where('user_id', $user->id)->first();
            if (!$customer) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No customer record found for this user',
                    'timestamp' => now()->toDateTimeString(),
                ], Response::HTTP_NOT_FOUND);
            }

            // Validate request data
            $validated = $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|same:new_password',
            ]);

            // Verify current password
            if (!Hash::check($validated['current_password'], $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Current password is incorrect',
                    'timestamp' => now()->toDateTimeString(),
                ], Response::HTTP_BAD_REQUEST);
            }

            // Update the user's password
            $user->password = Hash::make($validated['new_password']);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password changed successfully',
                'data' => null,
                'timestamp' => now()->toDateTimeString(),
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update password',
                'error' => $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
