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

    <!-- ====== Settings Section Start -->
    <div class="grid grid-cols-5 gap-8 ">
        <div class="col-span-5 xl:col-span-3">
            <div class=" rounded-2xl border dark:text-white border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-stroke px-7 py-4 dark:border-strokedark">
                    <h3 class="font-medium text-black dark:text-white">
                        Personal Information
                    </h3>
                </div>
                <div class="p-7">
                    <form action="#">
                        <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                            <div class="w-full sm:w-1/2">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white"
                                    for="fullName">Full Name</label>
                                <div class="relative">
                                    <span class="absolute left-4.5 top-3">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g opacity="0.8">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M3.72039 12.887C4.50179 12.1056 5.5616 11.6666 6.66667 11.6666H13.3333C14.4384 11.6666 15.4982 12.1056 16.2796 12.887C17.061 13.6684 17.5 14.7282 17.5 15.8333V17.5C17.5 17.9602 17.1269 18.3333 16.6667 18.3333C16.2064 18.3333 15.8333 17.9602 15.8333 17.5V15.8333C15.8333 15.1703 15.5699 14.5344 15.1011 14.0655C14.6323 13.5967 13.9964 13.3333 13.3333 13.3333H6.66667C6.00363 13.3333 5.36774 13.5967 4.8989 14.0655C4.43006 14.5344 4.16667 15.1703 4.16667 15.8333V17.5C4.16667 17.9602 3.79357 18.3333 3.33333 18.3333C2.8731 18.3333 2.5 17.9602 2.5 17.5V15.8333C2.5 14.7282 2.93899 13.6684 3.72039 12.887Z"
                                                    fill="" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M9.99967 3.33329C8.61896 3.33329 7.49967 4.45258 7.49967 5.83329C7.49967 7.214 8.61896 8.33329 9.99967 8.33329C11.3804 8.33329 12.4997 7.214 12.4997 5.83329C12.4997 4.45258 11.3804 3.33329 9.99967 3.33329ZM5.83301 5.83329C5.83301 3.53211 7.69849 1.66663 9.99967 1.66663C12.3009 1.66663 14.1663 3.53211 14.1663 5.83329C14.1663 8.13448 12.3009 9.99996 9.99967 9.99996C7.69849 9.99996 5.83301 8.13448 5.83301 5.83329Z"
                                                    fill="" />
                                            </g>
                                        </svg>
                                    </span>
                                    <input value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 indent-8 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" disabled
                                        type="text" name="fullName" id="fullName" placeholder=""
                                        disabled />
                                </div>
                            </div>

                            <div class="mb-5.5 w-full sm:w-1/2">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white"
                                    for="emailAddress">Email Address</label>
                                <div class="relative">
                                    <span class="absolute left-4.5 top-3">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g opacity="0.8">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M3.33301 4.16667C2.87658 4.16667 2.49967 4.54357 2.49967 5V15C2.49967 15.4564 2.87658 15.8333 3.33301 15.8333H16.6663C17.1228 15.8333 17.4997 15.4564 17.4997 15V5C17.4997 4.54357 17.1228 4.16667 16.6663 4.16667H3.33301ZM0.833008 5C0.833008 3.6231 1.9561 2.5 3.33301 2.5H16.6663C18.0432 2.5 19.1663 3.6231 19.1663 5V15C19.1663 16.3769 18.0432 17.5 16.6663 17.5H3.33301C1.9561 17.5 0.833008 16.3769 0.833008 15V5Z"
                                                    fill="" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M0.983719 4.52215C1.24765 4.1451 1.76726 4.05341 2.1443 4.31734L9.99975 9.81615L17.8552 4.31734C18.2322 4.05341 18.7518 4.1451 19.0158 4.52215C19.2797 4.89919 19.188 5.4188 18.811 5.68272L10.4776 11.5161C10.1907 11.7169 9.80879 11.7169 9.52186 11.5161L1.18853 5.68272C0.811486 5.4188 0.719791 4.89919 0.983719 4.52215Z"
                                                    fill="" />
                                            </g>
                                        </svg>
                                    </span>
                                    <input value="{{ Auth::user()->email }}"
                                        class="dark:bg-dark-900 shadow-theme-xs indent-8 focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                        type="email" name="emailAddress" id="emailAddress" placeholder=""
                                        disabled />
                                </div>
                            </div>
                        </div>



                        <div class="flex justify-end gap-4.5">
                            <a href="{{route('profiles.forgot_password')}}"
                                class="w-full px-4 text-center py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600"
                                type="submit">
                                Change Your Password
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-span-5 xl:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-stroke px-7 py-4 dark:border-strokedark">
                    <h3 class="text-lg font-medium text-black dark:text-white">Your Photo</h3>
                </div>
                <div class="p-7">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="h-24 w-24 overflow-hidden rounded-full">
                            <img src="{{ Auth::user()->profile_picture ? asset('storage/media/' . Auth::user()->profile_picture) : asset('/images/front/placeholder.jpg') }}"
                                alt="User" class="w-22 h-22 rounded-full" id="avatarPreview" />


                        </div>
                    </div>
                </div>

                <form action="{{ route('profiles.profilePic_update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="avatarInput" class="block relative mb-5.5 m-4 cursor-pointer rounded border border-dashed hover:border-[#3C50E0] bg-gray px-4 py-4 dark:bg-meta-4 sm:py-7.5">
                        <input type="file"
                            name="avatar"
                            id="avatarInput"
                            accept="image/*"
                            class="absolute inset-0 z-50 h-full w-full opacity-0 cursor-pointer" />
                        <div class="flex flex-col items-center space-y-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full border border-stroke bg-white">
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
                            <p class="text-sm font-medium text-primary dark:text-white">Upload New Avatar or drag and drop</p>
                            <p class="text-sm font-medium text-gray-500">Accepted: SVG, PNG, JPG</p>
                        </div>
                    </label>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="w-full rounded-lg bg-brand-500 px-4 py-3 text-sm font-medium text-white shadow-theme-xs transition hover:bg-brand-600">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- ====== Settings Section End -->
</div>

@section('scripts')

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