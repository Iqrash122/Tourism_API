@extends('layouts.dashboard')

@section('content')
    {{-- user Main Section --}}
    <main>
        <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
            <!-- Breadcrum Start -->

            <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 dark:border-gray-800  dark:text-white/90">
                <div class=" flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-[26px] font-bold ">
                        All Users
                    </h2>
                    <nav>
                        <a href="{{ route('users.create') }}"
                            class="inline-flex items-center justify-center gap-2.5 bg-[#3C50E0] px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 rounded-sm">
                            <span>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                            </span>
                            Add New User
                        </a>
                    </nav>
                </div>
            </div>
            <!-- Breadcrum End -->
            <div class="grid grid-cols-12 gap-4 md:gap-6">
                <div class="col-span-12 flex flex-col">
                    {{-- Table Header --}}
                    <div
                        class="grid grid-cols-5 rounded-2xl border dark:text-white border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="p-2.5 xl:p-5">
                            <h5 class="text-sm font-medium uppercase xsm:text-base">ID</h5>
                        </div>
                        <div class="p-2.5 xl:p-5">
                            <h5 class="text-sm font-medium uppercase xsm:text-base">Name</h5>
                        </div>
                        <div class="hidden p-2.5 text-center sm:block xl:p-5">
                            <h5 class="text-sm font-medium uppercase xsm:text-base">Email</h5>
                        </div>
                        <div class="hidden p-2.5 text-center sm:block xl:p-5">
                            <h5 class="text-sm font-medium uppercase xsm:text-base">Role</h5>
                        </div>

                        <div class="p-2.5 text-center xl:p-5">
                            <h5 class="text-sm font-medium uppercase xsm:text-base">Action</h5>
                        </div>
                    </div>


                </div>
            </div>

            <!-- //table for all user role wise -->


            @foreach ($users as $user)
                <div class="grid grid-cols-5 dark:text-white">
                    <div class="p-2.5 xl:p-5">
                        <p class="text-sm">{{ $user->id }}</p>
                    </div>
                    <div class="p-2.5 xl:p-5">
                        <p class="text-sm">{{ $user->first_name }} {{ $user->last_name }}</p>
                    </div>
                    <div class="hidden p-2.5 text-center sm:block xl:p-5">
                        <p class="text-sm">{{ $user->email }}</p>
                    </div>
                    <div class="hidden p-2.5 text-center sm:block xl:p-5">
                        <p class="text-sm">{{ $user->getRoleNames()->first() }}</p>
                    </div>
                    <div class="p-2.5 text-center xl:p-5">
                      
                        <a href="{{ route('users.edit', $user->id) }}"
                            class="text-yellow-600 hover:underline text-sm ml-2">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Delete this users?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-sm ml-2">Delete</button>
                        </form>

                    </div> 
                </div>
            @endforeach



        </div>
    </main>
@endsection
