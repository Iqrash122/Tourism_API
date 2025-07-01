@extends('layouts.dashboard')

@section('content')

@section('styles')
@endsection

{{-- Page Title --}}

{{-- CReate  Customer Tour Main Section --}}
<main>

    <!-- Breadcrum Start -->

    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 dark:border-gray-800  dark:text-white/90">
        <div class=" flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-[26px] font-bold ">
                Add Customer
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li>
                        <a class="font-medium" href="{{ route('customer.index') }}">Dashboard /</a>
                    </li>
                    <li class="font-medium text-success capitalize"> Add Customer</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrum End -->

    <form id="createCustomer" class="tour-form mx-auto max-w-screen-2xl p-6 my-8" action="{{ route('customers.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="p-6.5">
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                First Name<span class="text-meta-1">*</span>
                            </label>
                            <input type="text" name="first_name" id="hs-validation-name-error"
                                placeholder="Enter Your First name"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required />

                        </div>

                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Last Name<span class="text-meta-1">*</span>
                            </label>
                            <input name="last_name" type="text" placeholder="Enter Your Last Name"
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
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required />
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                        </div>
                        <div class="w-full xl:w-1/2 relative">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Password <span class="text-meta-1">*</span>
                            </label>

                            <input type="password" name="password" placeholder="Enter Your Password"
                                id="currentpasswordInputs"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required />
                            <button type="button" id="newtogglePasswords"
                                class="absolute top-11 right-4 text-[#6E6E6E]">
                                <i class="bi bi-eye"></i>
                            </button>

                        </div>

                    </div>

                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row date-picker">
                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Mobile
                            </label>
                            <input name="number" type="number" placeholder="Enter Your Mobile Number"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        </div>


                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">Date of Birth</label>
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-[#6e6e6e] dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="#6e6e6e" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="dateofbirth-format" type="text" name="dob" value="{{ old('dob') }}"
                                    class="h-11 w-full indent-6 rounded-lg border border-gray-300 bg-white dark:bg-gray-900 dark:text-white text-sm px-4 py-2.5 focus:border-brand-300 focus:ring-brand-500/10 focus:ring-3 dark:border-gray-700"
                                    placeholder="YYYY-MM-DD">
                            </div>
                        </div>




                    </div>

                    <div class="mb-6 ">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Bio
                        </label>
                        <textarea name="bio" rows="5" placeholder="Bio" maxlength="255"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                    </div>


                    <button
                        class="w-full px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                        Submit
                    </button>
                </div>

            </div>

            <div class="right rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="col-span-5 xl:col-span-2">
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="border-b border-stroke px-7 py-4 dark:border-strokedark">
                            <h3 class="font-medium text-black dark:text-white">
                                Profile Photo
                            </h3>
                        </div>
                        <div class="p-7">
                            <div class="mb-15 flex items-center gap-3">
                                <div class="h-22 w-22 rounded-full">
                                    <img id="avatarPreview" src="{{ asset('/images/front/placeholder.jpg') }}"
                                        alt="PlaceHolder" class="w-22 h-22 rounded-full" />
                                </div>
                                <div>
                                    <span class="mb-1.5 font-medium text-black dark:text-white">Avatar</span>
                                    <span class="flex gap-2.5">
                                        <form action="" method="POST"
                                            onsubmit="return confirm('Are You Sure to delete the Avatar ?')">
                                            @csrf
                                        </form>
                                    </span>
                                </div>
                            </div>

                            <div id="FileUpload"
                                class="relative mb-5.5 block w-full cursor-pointer appearance-none rounded border border-dashed hover:border-[#3C50E0] bg-gray px-4 py-4 dark:bg-meta-4 sm:py-7.5">
                                <input type="file" accept="image/*" name="profile_picture" id="avatarInput"
                                    class="absolute inset-0 z-50 m-0 h-full w-full cursor-pointer p-0 opacity-0 outline-none" />
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <span
                                        class="flex h-10 w-10 items-center justify-center rounded-full border border-stroke bg-white dark:border-strokedark dark:bg-boxdark">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M1.99967 9.33337C2.36786 9.33337 2.66634 9.63185 2.66634 10V12.6667C2.66634 12.8435 2.73658 13.0131 2.8616 13.1381C2.98663 13.2631 3.1562 13.3334 3.33301 13.3334H12.6663C12.8431 13.3334 13.0127 13.2631 13.1377 13.1381C13.2628 13.0131 13.333 12.8435 13.333 12.6667V10C13.333 9.63185 13.6315 9.33337 13.9997 9.33337C14.3679 9.33337 14.6663 9.63185 14.6663 10V12.6667C14.6663 13.1971 14.4556 13.7058 14.0806 14.0809C13.7055 14.456 13.1968 14.6667 12.6663 14.6667H3.33301C2.80257 14.6667 2.29387 14.456 1.91879 14.0809C1.54372 13.7058 1.33301 13.1971 1.33301 12.6667V10C1.33301 9.63185 1.63148 9.33337 1.99967 9.33337Z"
                                                fill="#3C50E0" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M7.5286 1.52864C7.78894 1.26829 8.21106 1.26829 8.4714 1.52864L11.8047 4.86197C12.0651 5.12232 12.0651 5.54443 11.8047 5.80478C11.5444 6.06513 11.1223 6.06513 10.8619 5.80478L8 2.94285L5.13807 5.80478C4.87772 6.06513 4.45561 6.06513 4.19526 5.80478C3.93491 5.54443 3.93491 5.12232 4.19526 4.86197L7.5286 1.52864Z"
                                                fill="#3C50E0" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M7.99967 1.33337C8.36786 1.33337 8.66634 1.63185 8.66634 2.00004V10C8.66634 10.3682 8.36786 10.6667 7.99967 10.6667C7.63148 10.6667 7.33301 10.3682 7.33301 10V2.00004C7.33301 1.63185 7.63148 1.33337 7.99967 1.33337Z"
                                                fill="#3C50E0" />
                                        </svg>
                                    </span>
                                    <p class="text-sm font-medium">
                                        <span class="text-primary dark:text-white">Upload New Image</span>
                                    </p>


                                </div>
                            </div>

                        </div>
                    </div>
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

    window.addEventListener('DOMContentLoaded', function() {
        // Get the elements
        const cpasswordInput = document.getElementById('currentpasswordInputs');
        const ctogglePassword = document.getElementById('newtogglePasswords');

        // Add event listener for the click event
        ctogglePassword.addEventListener('click', () => {
            console.log('clicked'); // Check if this appears in the console

            // Toggle password visibility
            const type = cpasswordInput.type === 'password' ? 'text' : 'password';
            cpasswordInput.type = type;

            // Update the eye icon
            ctogglePassword.innerHTML = type === 'password' ?
                `<i class="bi bi-eye"></i>` :
                `<i class="bi bi-eye-slash"></i>`;
        });
    });



    // date picker 
    document.addEventListener("DOMContentLoaded", function() {
        const dateInput = document.getElementById("dob");
        const today = new Date();

        // Set max to yesterday
        today.setDate(today.getDate() - 1);

        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');

        const maxDate = `${yyyy}-${mm}-${dd}`;
        dateInput.max = maxDate;
    });
</script>

@endsection




@endsection