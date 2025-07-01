@extends('layouts.dashboard')

@section('content')
<div class="max-w-(--breakpoint-2xl) p-4 md:p-6 dark:border-gray-800  dark:text-white/90">
    <!-- Breadcrumb Start-->

    <div class="">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Queries
            </h2>
            <nav>
                <a href="{{ route('support.create') }}"
                    class="inline-flex items-center justify-center gap-2.5 bg-[#3C50E0] px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 rounded-sm">
                    <span>
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                    </span>
                    Add New Query
                </a>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Table Start -->

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]"
        id="dataTable">
        <div class="flex flex-col">
            <div class="grid grid-cols-7 rounded-sm bg-gray-2 dark:bg-meta-4 sm:grid-cols-7">
                <div class="p-2.5 xl:p-5 ">
                    <h5 class="text-sm font-medium uppercase xsm:text-base">ID</h5>
                </div>
                <div class="p-2.5 xl:p-5">
                    <h5 class="text-sm font-medium uppercase xsm:text-base"> Customer Name</h5>
                </div>
                <div class=" p-2.5  sm:block xl:p-5">
                    <h5 class="text-sm font-medium uppercase xsm:text-base">Type</h5>
                </div>
                <div class="p-2.5  xl:p-5">
                    <h5 class="text-sm font-medium uppercase xsm:text-base">Query</h5>
                </div>
                <div class="p-2.5  xl:p-5">
                    <h5 class="text-sm font-medium uppercase xsm:text-base">Status</h5>
                </div>
                <div class="p-2.5  xl:p-5">
                    <h5 class="text-sm font-medium uppercase xsm:text-base">Reply</h5>
                </div>
                <div class="p-2.5 xl:p-5">
                    <h5 class="text-sm font-medium uppercase xsm:text-base">Action</h5>
                </div>

            </div>
            @if ($queries->isEmpty())
            <div class="p-5 text-center">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-300">
                    No Queries available...
                </p>
            </div>
            @else
            @foreach ($queries as $query)
            <div class="grid grid-cols-7  dark:border-strokedark sm:grid-cols-7">

                <div class="flex  p-2.5 xl:p-5 w-100px">
                    <p class="font-medium text-black dark:text-white">{{ $query->id }}</p>
                </div>

                <div class="flex p-2.5 xl:p-5">
                    <p class="font-medium">
                        {{ $query->customer_name  }}
                    </p>
                </div>

                <div class="flex  p-2.5 xl:p-5">
                    <p class="font-medium text-black dark:text-white">{{ $query->type }}</p>
                </div>
                <div class="flex p-2.5 xl:p-5">
                    <p class="font-medium text-black dark:text-white">{{ \Illuminate\Support\Str::words($query->query, 4, '...') }}</p>
                </div>

                <div class="flex items-start p-2.5 xl:p-5">
                    <p class="font-medium text-black dark:text-white">
                        @if ($query->status == 'open')
                    <p
                        class="whitespace-nowrap rounded-full bg-warning bg-opacity-10 px-3 py-1 text-[12px] font-medium text-black dark:text-white">
                        In Progress
                    </p>
                    @elseif($query->status == 'closed')
                    <p
                        class="whitespace-nowrap rounded-full bg-success bg-opacity-10 px-3 py-1 text-[12px] font-medium text-black dark:text-white">
                        Closed
                    </p>
                    @endif

                    </p>
                </div>
                <div class="flex p-2.5 xl:p-5">
                    <p class="font-medium text-black dark:text-white">{{ \Illuminate\Support\Str::words($query->response, 4, '...') }}</p>
                </div>

                <div class=" items-start justify-start gap-2  p-2.5 sm:flex xl:p-5">
                    <button class="hover:text-danger" data-modal-target="popup-modal{{ $query->id }}"
                        data-modal-toggle="popup-modal{{ $query->id }}">
                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.7535 2.47502H11.5879V1.9969C11.5879 1.15315 10.9129 0.478149 10.0691 0.478149H7.90352C7.05977 0.478149 6.38477 1.15315 6.38477 1.9969V2.47502H4.21914C3.40352 2.47502 2.72852 3.15002 2.72852 3.96565V4.8094C2.72852 5.42815 3.09414 5.9344 3.62852 6.1594L4.07852 15.4688C4.13477 16.6219 5.09102 17.5219 6.24414 17.5219H11.7004C12.8535 17.5219 13.8098 16.6219 13.866 15.4688L14.3441 6.13127C14.8785 5.90627 15.2441 5.3719 15.2441 4.78127V3.93752C15.2441 3.15002 14.5691 2.47502 13.7535 2.47502ZM7.67852 1.9969C7.67852 1.85627 7.79102 1.74377 7.93164 1.74377H10.0973C10.2379 1.74377 10.3504 1.85627 10.3504 1.9969V2.47502H7.70664V1.9969H7.67852ZM4.02227 3.96565C4.02227 3.85315 4.10664 3.74065 4.24727 3.74065H13.7535C13.866 3.74065 13.9785 3.82502 13.9785 3.96565V4.8094C13.9785 4.9219 13.8941 5.0344 13.7535 5.0344H4.24727C4.13477 5.0344 4.02227 4.95002 4.02227 4.8094V3.96565ZM11.7285 16.2563H6.27227C5.79414 16.2563 5.40039 15.8906 5.37227 15.3844L4.95039 6.2719H13.0785L12.6566 15.3844C12.6004 15.8625 12.2066 16.2563 11.7285 16.2563Z"
                                fill="" />
                            <path
                                d="M9.00039 9.11255C8.66289 9.11255 8.35352 9.3938 8.35352 9.75942V13.3313C8.35352 13.6688 8.63477 13.9782 9.00039 13.9782C9.33789 13.9782 9.64727 13.6969 9.64727 13.3313V9.75942C9.64727 9.3938 9.33789 9.11255 9.00039 9.11255Z"
                                fill="" />
                            <path
                                d="M11.2502 9.67504C10.8846 9.64692 10.6033 9.90004 10.5752 10.2657L10.4064 12.7407C10.3783 13.0782 10.6314 13.3875 10.9971 13.4157C11.0252 13.4157 11.0252 13.4157 11.0533 13.4157C11.3908 13.4157 11.6721 13.1625 11.6721 12.825L11.8408 10.35C11.8408 9.98442 11.5877 9.70317 11.2502 9.67504Z"
                                fill="" />
                            <path
                                d="M6.72245 9.67504C6.38495 9.70317 6.1037 10.0125 6.13182 10.35L6.3287 12.825C6.35683 13.1625 6.63808 13.4157 6.94745 13.4157C6.97558 13.4157 6.97558 13.4157 7.0037 13.4157C7.3412 13.3875 7.62245 13.0782 7.59433 12.7407L7.39745 10.2657C7.39745 9.90004 7.08808 9.64692 6.72245 9.67504Z"
                                fill="" />
                        </svg>
                    </button>

                    <a href="{{ route('support.edit', $query->id) }}" class="hover:text-warning">
                        <svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 20h9" />
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                        </svg>
                    </a>
                    <p class="font-medium text-meta-5"></p>
                </div>
            </div>

            <!-- Modal Start-->
            <div id="popup-modal{{ $query->id }}" tabindex="-1"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all ">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div
                        class="relative bg-black rounded-lg shadow-sm dark:bg-gray-700 transition-colors duration-200 animate-fade-in-down animate-infinite animate-duration-1000 animate-ease-in-out">
                        <button type="button"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="popup-modal{{ $query->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure
                                you want to delete this query ?</h3>
                            <form action="{{ route('support.destroy', $query->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-white/[0.03] hover:[#F45C20] focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-[#F45C20] font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Yes, I'm Sure
                                </button>
                            </form>

                            <button data-modal-hide="popup-modal{{ $query->id }}" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                                Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal End-->
            @endforeach
            @endif
        </div>
    </div>


</div>


@endsection