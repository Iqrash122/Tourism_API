@extends('layouts.dashboard')

@section('content')

<div class=" p-4 md:p-6 2xl:p-10 ">
    <div class="">
        <div class="mb-6 flex flex-col gap-3 mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 dark:border-gray-800  dark:text-white/90 sm:flex-row sm:items-center sm:justify-between ">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Profile
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li>
                        <a class="font-medium" href="{{ route('profiles.index') }}">Dashboard /</a>
                    </li>
                    <li class="font-medium text-success capitalize">My Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="max-w-md mx-auto  rounded-2xl border dark:text-white border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-6">
        <h1 class="text-2xl font-bold mb-4">Forgot Your Password</h1>
        <p class="mb-6">Enter your email address to receive a password reset link.</p>

        @if (session('status'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
            {{ session('status') }}
        </div>
        @endif

        @if ($errors->has('email'))
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
            {{ $errors->first('email') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4 ">
            @csrf
            <div class="form-group">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-500" value="{{ old('email') }}" required>
            </div>
            <button type="submit" class="w-full px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                Send Reset Link
            </button>
        </form>
    </div>
</div>
@endsection