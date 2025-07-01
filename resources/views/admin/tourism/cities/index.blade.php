@extends('layouts.dashboard')

@section('content')

{{-- City Main Section --}}
<main>
     <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
          <!-- Breadcrum Start -->

          <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 dark:border-gray-800  dark:text-white/90">
               <div class=" flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-[26px] font-bold ">
                         All Cities
                    </h2>
                    <nav>
                         <a href="{{ route('cities.create') }}"
                              class="inline-flex items-center justify-center gap-2.5 bg-[#3C50E0] px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 rounded-sm">
                              <span>
                                   <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                   </svg>

                              </span>
                              Add New City
                         </a>
                    </nav>
               </div>
          </div>
          <!-- Breadcrum End -->
          <div class="grid grid-cols-12 gap-4 md:gap-6">
               <div class="col-span-12 flex flex-col">
                    {{-- Table Header --}}
                    <div class="grid grid-cols-7 rounded-2xl border dark:text-white border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                         <div class="p-2.5 xl:p-5">
                              <h5 class="text-sm font-medium uppercase xsm:text-base">ID</h5>
                         </div>
                         <div class="p-2.5 xl:p-5">
                              <h5 class="text-sm font-medium uppercase xsm:text-base">Name</h5>
                         </div>
                         <div class="hidden p-2.5 text-center sm:block xl:p-5">
                              <h5 class="text-sm font-medium uppercase xsm:text-base">Slug</h5>
                         </div>
                         <div class="hidden p-2.5 text-center sm:block xl:p-5">
                              <h5 class="text-sm font-medium uppercase xsm:text-base">Description</h5>
                         </div>
                         <div class="p-2.5 text-center xl:p-5">
                              <h5 class="text-sm font-medium uppercase xsm:text-base">Icon</h5>
                         </div>
                         <div class="p-2.5 text-center xl:p-5">
                              <h5 class="text-sm font-medium uppercase xsm:text-base">Banner</h5>
                         </div>
                         <div class="p-2.5 text-center xl:p-5">
                              <h5 class="text-sm font-medium uppercase xsm:text-base">Action</h5>
                         </div>
                    </div>


               </div>
          </div>

          @foreach($Cities as $city)
          <div class="grid grid-cols-7  dark:text-white border-gray-200 ">
               {{-- ID --}}
               <div class="p-2.5 xl:p-5">
                    <p class="text-sm">{{ $city->id }}</p>
               </div>

               {{-- Name --}}
               <div class="p-2.5 xl:p-5">
                    <p class="text-sm font-medium">{{ $city->name }}</p>
               </div>

               {{-- Slug --}}
               <div class="hidden p-2.5 text-center sm:block xl:p-5">
                    <p class="text-sm">{{ $city->slug }}</p>
               </div>

               {{-- Description --}}
               <div class="hidden p-2.5 text-center sm:block xl:p-5">
                    <p class="text-sm truncitye">{{ $city->description }}</p>
               </div>

               {{-- Icon --}}
               <div class="p-2.5 text-center xl:p-5">
                    @if($city->icon_path)
                    <img src="{{ asset('storage/'.$city->icon_path) }}"
                         alt="Icon"
                         class="h-10 w-10 object-cover mx-auto rounded" />
                    @else
                    <span class="text-xs text-gray-500">—</span>
                    @endif
               </div>

               {{-- Banner --}}
               <div class="p-2.5 text-center xl:p-5">
                    @if($city->banner_path)
                    <img src="{{ asset('storage/'.$city->banner_path) }}"
                         alt="Banner"
                         class="h-10 w-20 object-cover mx-auto rounded" />
                    @else
                    <span class="text-xs text-gray-500">—</span>
                    @endif
               </div>


               <div class="p-2.5 text-center xl:p-5 flex justify-center gap-2">

                    <a href="{{ route('cities.edit', $city->id) }}" class="w-12 h-7 inline-flex items-center justify-center text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
                         Edit</a>


                    <form action="{{ route('cities.destroy', $city->id) }}" method="POST"
                         onsubmit="return confirm('Delete this City?');">
                         @csrf
                         @method('DELETE')
                         <button type="submit"
                              class="px-2 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700">
                              Delete
                         </button>
                    </form>

               </div>
          </div>
          @endforeach

          @if($Cities->isEmpty())
          <p class="p-5 text-center text-gray-500">No City found.</p>
          @endif
     </div>
</main>

@endsection