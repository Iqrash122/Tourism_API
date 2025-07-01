@extends('layouts.dashboard')

@section('content')

{{-- Edit City Main Section --}}
<main>
    <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10   ">
            <!-- Breadcrumb Start -->
            <div class="mx-auto">
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between   dark:text-white/90">
                    <h2 class="text-[26px] font-bold ">
                        Edit City
                    </h2>
                    <nav>
                        <ol class="flex items-center gap-2">
                            <li>
                                <a class="font-medium" href="{{ route('cities.index') }}">Dashboard /</a>
                            </li>
                            <li class="font-medium text-success capitalize">Edit City</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Breadcrumb End -->

            <!-- Table Start -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <form action="{{ route('cities.update', $city->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="p-6.5">
                        <div class="flex flex-row gap-4 space-y-6">
                            <div class="w-1/2">
                                <label for="City" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Enter City</label>
                                <input id="bookingTitle" type="text" placeholder=" City" name="cityName"
                                    value="{{ $city->name }}"

                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                            </div>
                            <div class="w-1/2">
                                <label for="slug" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Slug</label>
                                <input id="slug" type="text" name="citySlug"
                                    value="{{ $city->slug }}"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" readonly />
                            </div>
                        </div>

                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                            <div class="w-full xl:w-1/2">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Upload Category Icon<span class="text-meta-1">*</span>
                                </label>
                                <input type="file" name="cityIcon"
                                    class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-normal outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:px-5 file:py-3 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary" />
                                @if($city->cityIcon)
                                    <img src="{{ asset('storage/' . $city->cityIcon) }}" class="mt-2 h-12" alt="Current Icon">
                                @endif
                            </div>
                            <div class="w-full xl:w-1/2">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Upload Category Banner<span class="text-meta-1">*</span>
                                </label>
                                <input type="file" name="cityBanner"
                                    class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-normal outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:px-5 file:py-3 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary" />
                                @if($city->cityBanner)
                                <img src="{{ asset('storage/' . $city->cityBanner) }}" class="mt-2 h-12" alt="Current Banner">
                                @endif
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Description
                            </label>
                            <textarea name="description" rows="5" placeholder="Enter Description"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ $city->description }}</textarea>
                        </div>

                        <button type="submit"
                            class="w-full px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                            Update City
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</main>

<script>
    <!-- auto generated slug  
    -->
    document.addEventListener('DOMContentLoaded',
    function
    ()
    {
    const
    titleInput
    =
    document.querySelector('#bookingTitle');
    const
    slugInput
    =
    document.querySelector('#slug');
    titleInput.addEventListener('input',
    function
    ()
    {
    const
    slug
    =
    titleInput.value
    .toLowerCase()
    .replace(/[^a-z0-9]+/g,
    '-')
    .replace(/^-+|-+$/g,
    '');
    slugInput.value
    =
    slug;
    });
    });
</script>

@endsection