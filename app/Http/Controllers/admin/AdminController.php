<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function admin_index()
    {
        $customer = Customer::all();
        $booking = Booking::all();
        $users = User::all();

        return view('admin.admin', compact('customer', 'booking', 'users'));
    }

    public function profile_index()
    {

        return view('admin.profiles.index');
    }


    public function profilePic_update(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            // Store the file in 'public/media' folder and get the filename
            $avatarPath = $avatar->store('media', 'public');
            $filename = basename($avatarPath);

            // Save only the filename to the database
            $user->profile_picture = $filename;
        }

        $user->save();

        return redirect()->route('profiles.index')->with('success', 'Profile picture updated!');
    }



    public function edit_Profile()
    {
        return view('admin.profiles.edit');
    }

    public function forgot_password()
    {
        return view('admin.profiles.forgot_password');
    }

    // Handle sending the password reset link
    public function send_reset_link_email(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    // Display the reset password form
    public function show_reset_form($token, Request $request)
    {
        return view('admin.profiles.reset_password', ['token' => $token, 'email' => $request->email]);
    }

    // Handle the password reset
    public function reset_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('admin.admin')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
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
        //
    }
}
