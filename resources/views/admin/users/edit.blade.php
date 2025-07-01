@extends('layouts.dashboard')

@section('content')

@section('styles')
@endsection

{{-- Page Title --}}

{{-- Edit  user  Main Section --}}
<main>

    <!-- Breadcrum Start -->

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 dark:border-gray-800  dark:text-white/90">
        <div class=" flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-[26px] font-bold ">
                Edit User
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li>
                        <a class="font-medium" href="{{ route('users.index') }}">Dashboard /</a>
                    </li>
                    <li class="font-medium text-success capitalize"> Add User</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrum End -->

    <form class="tour-form mx-auto  p-6 my-8" action="{{ route('users.update', $user->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols gap-6 ">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="p-6.5">
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                First Name<span class="text-meta-1">*</span>
                            </label>
                            <input type="text" name="first_name" id="hs-validation-name-error"
                                placeholder="Enter Your First name" value="{{ $user->first_name }}"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required />

                        </div>

                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Last Name<span class="text-meta-1">*</span>
                            </label>
                            <input name="last_name" type="text" placeholder="Enter Your Last Name"
                                value="{{ $user->last_name }}"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required />
                        </div>
                    </div>

                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Email <span class="text-meta-1">*</span>
                            </label>
                            <input type="email" id="email" name="email" placeholder="Enter Your Email Address"
                                value="{{ $user->email }}"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required />
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                        </div>




                    </div>





                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Role <span class="text-meta-1">*</span>
                        </label>
                        <div x-data="{ isOptionSelected: true }" class="relative z-20 bg-transparent dark:bg-form-input">
                            <select name="role"
                                class="relative z-20 appearance-none order-stroke dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                :class="isOptionSelected && 'text-black dark:text-white'"
                                @change="isOptionSelected = true" required>

                                <option value="" disabled
                                    {{ !$user->hasRole('admin') && !$user->hasRole('customer') ? 'selected' : '' }}>
                                    Select user role
                                </option>
                                <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                                <option value="customer" {{ $user->hasRole('customer') ? 'selected' : '' }}>Customer
                                </option>
                            </select>

                            <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2">
                                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <g opacity="0.8">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                            fill=""></path>
                                    </g>
                                </svg>
                            </span>
                        </div>

                    </div>


                    <button type="submit"
                        class="w-full px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                        Submit
                    </button>
                </div>

            </div>


        </div>
    </form>



</main>



@section('scripts')
    <!-- JavaScript for Image Preview -->
    <script>
        document.getElementById('avatarInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection




@endsection
