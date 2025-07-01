@extends('layouts.dashboard')

@section('content')

@section('styles')
<style>
  .hasImage:hover section {
    background-color: rgba(5, 5, 5, 0.4);
  }

  .hasImage:hover button:hover {
    background: rgba(5, 5, 5, 0.45);
  }

  #overlay p,
  i {
    opacity: 0;
  }

  #overlay.draggedover {
    background-color: rgba(255, 255, 255, 0.7);
  }

  #overlay.draggedover p,
  #overlay.draggedover i {
    opacity: 1;
  }

  .group:hover .group-hover\:text-blue-800 {
    color: #2b6cb0;
  }

  .hs-leaflet.leaflet-touch .leaflet-control-layers,
  .hs-leaflet.leaflet-touch .leaflet-bar {
    border-width: 0px;
  }

  .hs-leaflet.leaflet-touch .leaflet-bar a {
    line-height: 1.5;
    background-color: rgba(255, 255, 255, .8);
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
  }

  .hs-leaflet.leaflet-touch .leaflet-bar a:first-child,
  .hs-leaflet.leaflet-touch .leaflet-bar a:last-child {
    border-radius: 8px;
  }

  .hs-leaflet .leaflet-control-zoom-in,
  .hs-leaflet .leaflet-control-zoom-out {
    font-weight: 400;
    font-size: 18px;
    color: #1f2937;
    text-indent: 0px;
  }

  .hs-leaflet .leaflet-bar {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .hs-leaflet .leaflet-bar a {
    border-width: 0;
  }

  .hs-leaflet .leaflet-bar a:hover,
  .hs-leaflet .leaflet-bar a:focus {
    background-color: #e5e7eb;
  }

  .hs-leaflet .leaflet-popup-content-wrapper,
  .hs-leaflet .leaflet-popup-tip {
    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
  }

  .hs-leaflet .leaflet-popup-tip {
    border-radius: 4px;
  }

  .hs-leaflet.leaflet-container a.leaflet-popup-close-button {
    top: -10px;
    right: -10px;
    border-radius: 9999px;
    background-color: #f3f4f6;
    color: #1f2937;
    font-size: 14px;
    line-height: 1.6;
  }

  .hs-leaflet.leaflet-container a.leaflet-popup-close-button:hover {
    background-color: #f3f4f6;
  }

  .hs-leaflet-unstyled-popover .leaflet-popup-content-wrapper {
    display: flex;
  }

  .hs-leaflet-unstyled-popover .leaflet-popup-content {
    padding: 0;
    margin: 0;
    background: none;
    line-height: normal;
    border-radius: 0;
    font-size: inherit;
    min-height: auto;
  }
</style>

@endsection

{{-- Page Title --}}

{{-- CReate  Tourism Main Section --}}
<main>

  <!-- Breadcrum Start -->

  <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6 dark:border-gray-800  dark:text-white/90">
    <div class=" flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
      <h2 class="text-[26px] font-bold ">
        Add Tourism
      </h2>
      <nav>
        <ol class="flex items-center gap-2">
          <li>
            <a class="font-medium" href="{{route('tourism.index') }}">Dashboard /</a>
          </li>
          <li class="font-medium text-success capitalize">Add Tourism</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- Breadcrum End -->


  <form id="tourForm" class="tour-form mx-auto max-w-screen-2xl p-6  " method="POST" action="{{ route('tourism.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
      <div class="space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

          <div class="space-y-6  border-gray-100 p-5 sm:p-6 dark:border-gray-800">
            <!-- Elements -->

            <div class="flex flex-row gap-4">
              <div class="w-1/2">
                <label for="bookingTitle" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Activity Title</label>
                <input id="bookingTitle" type="text" placeholder="Enter Activity Title" name="activity_title"
                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" required />
              </div>
              <div class="w-1/2">
                <label for="slug" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Slug</label>
                <input id="slug" type="text" placeholder="Auto-generated or manual slug" name="activity_slug"
                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" readonly />
              </div>
            </div>

            <!-- seo  -->
            <h3
              class="text-base font-medium text-gray-800 dark:text-white/90">
              Seo
            </h3>
            <div class="flex flex-row gap-4">
              <div class="w-1/2">
                <label
                  class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                  Title
                </label>
                <input
                  type="text" placeholder="Enter Title" name="seo_title"
                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
              </div>
              <div class="w-1/2">
                <label
                  class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                  keywords
                </label>
                <input
                  placeholder="Keywords" name="seo_keywords"
                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
              </div>
            </div>

            <div>
              <label
                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                Description
              </label>
              <textarea
                placeholder="Enter a description..."
                type="text"
                rows="6" name="seo_description"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
            </div>



            <fieldset class="space-y-8" x-data="variationForm()" x-init="serialize()" @input.debounce.300ms="serialize()">
              <!-- Price Details Section -->
              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <legend class="text-base font-medium text-gray-800 dark:text-white/90">
                    Price Details Variation
                  </legend>
                  <button
                    type="button"
                    @click="addPriceVariation()"
                    class="px-4 py-2 text-sm font-medium text-white bg-brand-500 rounded-lg hover:bg-brand-600 transition">
                    + Add Variation
                  </button>
                </div>

                <template x-for="(variation, index) in priceVariations" :key="variation.id">
                  <div class="flex flex-row gap-4 items-end">
                    <div class="w-full">
                      <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Title</label>
                      <input type="text" x-model="variation.title" placeholder="Enter Title"
                        class="h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90" />
                    </div>
                    <div class="w-full">
                      <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Regular Price</label>
                      <input type="number" min="0" x-model="variation.regular" placeholder="Enter Regular Price"
                        class="h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90" />
                    </div>
                    <div class="w-full">
                      <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Sale Price</label>
                      <input type="number" min="0" x-model="variation.sale" placeholder="Enter Sale Price"
                        class="h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90" />
                    </div>
                    <div>
                      <template x-if="priceVariations.length > 1">
                        <button type="button" @click="removePriceVariation(index)"
                          class="px-3 py-2 text-xs font-medium text-white bg-red-500 rounded-lg hover:bg-red-600 transition">Remove</button>
                      </template>
                    </div>
                  </div>
                </template>
              </div>

              <!-- Time Variation Section -->
              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <legend class="text-base font-medium text-gray-800 dark:text-white/90">
                    Time Variation
                  </legend>
                  <button
                    type="button"
                    @click="addTimeVariation()"
                    class="px-4 py-2 text-sm font-medium text-white bg-brand-500 rounded-lg hover:bg-brand-600 transition">
                    + Add Time
                  </button>
                </div>

                <template x-for="(time, index) in timeVariations" :key="time.id">
                  <div class="flex flex-row gap-4 items-end">
                    <div class="w-full">
                      <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Start Time</label>
                      <input type="time" x-model="time.start"
                        class="h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90" />
                    </div>
                    <div class="w-full">
                      <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">End Time</label>
                      <input type="time" x-model="time.end"
                        class="h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-900 dark:text-white/90" />
                    </div>
                    <div>
                      <template x-if="timeVariations.length > 1">
                        <button type="button" @click="removeTimeVariation(index)"
                          class="px-3 py-2 text-xs font-medium text-white bg-red-500 rounded-lg hover:bg-red-600 transition">Remove</button>
                      </template>
                    </div>
                  </div>
                </template>
              </div>

              <input type="hidden" name="serialized_data" :value="serialized">

              <!-- Submit Button -->
              <div>
                <!-- <button
                  type="button"
                  @click="submitForm"
                  class="mt-4 px-6 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700">
                  Submit
                </button> -->
              </div>
            </fieldset>





            <!-- short description  -->
            <!-- CKEditor Initialization -->
            <textarea name="body" id="body" class="form-control"></textarea>









            <div class="flex flex-row gap-4 mt-6">

              <div class="w-1/2 ">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Select Categories</label>
                <!-- Select -->

                <div class="mb-4">
                  <!-- Select -->
                  <select name="activity_categories[]" id="multiple-with-conditional-counter-remote-data-select-category" multiple="" data-hs-select='{
                     
                      "hasSearch": true,
                      "searchPlaceholder": "Search...",
                      "searchClasses": "block w-full sm:text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-1 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-1.5 sm:py-2 px-3",
                      "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
                      "placeholder": "Categories",
                      "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                      "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-hidden dark:focus:ring-1 dark:focus:ring-neutral-600",
                      "toggleSeparators": {
                        "betweenItemsAndCounter": "&"
                      },
                      "toggleCountText": "selected",
                      "toggleCountTextMinItems": 3,
                      "toggleCountTextMode": "nItemsAndCount",
                      "dropdownClasses": "mt-2 z-50 w-full max-h-72 pb-1 px-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                      "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                      "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                      "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                    }' class="hidden">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>




                  <!-- End Select -->
                </div>


              </div>

              <div class="w-1/2 ">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Select Cities</label>
                <!-- Select -->
                <select name="activity_cities[]" id="multiple-with-conditional-counter-remote-data-select-cities" multiple="" data-hs-select='{
                     "hasSearch": true,
                     "searchPlaceholder": "Search...",
                     "searchClasses": "block w-full sm:text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-1 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-1.5 sm:py-2 px-3",
                     "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
                     "placeholder": "Cities",
                     "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                     "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-hidden dark:focus:ring-1 dark:focus:ring-neutral-600",
                     "toggleSeparators": {
                       "betweenItemsAndCounter": "&"
                     },
                     "toggleCountText": "selected",
                     "toggleCountTextMinItems": 3,
                     "toggleCountTextMode": "nItemsAndCount",
                     "dropdownClasses": "mt-2 z-50 w-full max-h-72 pb-1 px-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                     "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                     "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                     "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                   }' class="hidden">
                  @foreach ($cities as $city)
                  <option value="{{ $city->id }}">{{ $city->name }}</option>
                  @endforeach
                </select>

              </div>



            </div>


            <!-- checkboxes -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
              <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                <!-- Elements -->
                <div class="flex flex-wrap items-start gap-8">

                  <!-- Feature Offers -->
                  <div x-data="{ featureOffers: false }" class="space-y-4">
                    <label for="checkboxLabelOne" class="flex cursor-pointer items-center text-sm font-medium text-gray-700 select-none dark:text-gray-400">
                      <div class="relative">
                        <input type="checkbox" id="checkboxLabelOne" name="feature_offers" class="sr-only" @change="featureOffers = !featureOffers" />
                        <div :class="featureOffers ? 'border-brand-500 bg-brand-500' : 'bg-transparent border-gray-300 dark:border-gray-700'"
                          class="hover:border-brand-500 dark:hover:border-brand-500 mr-3 flex h-5 w-5 items-center justify-center rounded-md border-[1.25px]">
                          <span :class="featureOffers ? '' : 'opacity-0'">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                              <path d="M11.6666 3.5L5.24992 9.91667L2.33325 7" stroke="white" stroke-width="1.94437" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                          </span>
                        </div>
                      </div>
                      Feature Offers
                    </label>

                    <!-- Feature Offers Fields -->
                    <div x-show="featureOffers" x-transition>
                      <!-- Discount -->
                      <div>
                        <label for="discount1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Discount</label>
                        <input type="number" id="discount1" name="discount_feature" class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                      </div>

                      <!-- Logo -->
                      <div class="mt-4">
                        <label for="logo1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Logo</label>
                        <input type="file" id="logo1" name="logo_feature" accept="image/*"
                          class="mt-1 block w-full text-sm dark:text-white dark:bg-gray-800 dark:border-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100" />
                      </div>
                    </div>
                  </div>

                  <!-- Promotion Tours -->
                  <div x-data="{ promotionTours: false }" class="space-y-4">
                    <label for="checkboxLabelTwo" class="flex cursor-pointer items-center text-sm font-medium text-gray-700 select-none dark:text-gray-400">
                      <div class="relative">
                        <input type="checkbox" id="checkboxLabelTwo" name="promotion_tours" class="sr-only" @change="promotionTours = !promotionTours" />
                        <div :class="promotionTours ? 'border-brand-500 bg-brand-500' : 'bg-transparent border-gray-300 dark:border-gray-700'"
                          class="hover:border-brand-500 dark:hover:border-brand-500 mr-3 flex h-5 w-5 items-center justify-center rounded-md border-[1.25px]">
                          <span :class="promotionTours ? '' : 'opacity-0'">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                              <path d="M11.6666 3.5L5.24992 9.91667L2.33325 7" stroke="white" stroke-width="1.94437" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                          </span>
                        </div>
                      </div>
                      Promotion Tours
                    </label>

                    <!-- Promotion Tours Discount Only -->
                    <div x-show="promotionTours" x-transition>
                      <label for="discount2" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Discount</label>
                      <input type="number" id="discount2" name="discount_promotion" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    </div>
                  </div>

                  <!-- Top Rated -->
                  <div x-data="{ topRated: false }" class="space-y-4">
                    <label for="checkboxLabelThree" class="flex cursor-pointer items-center text-sm font-medium text-gray-700 select-none dark:text-gray-400">
                      <div class="relative">
                        <input type="checkbox" id="checkboxLabelThree" name="top_rated" class="sr-only" @change="topRated = !topRated" />
                        <div :class="topRated ? 'border-brand-500 bg-brand-500' : 'bg-transparent border-gray-300 dark:border-gray-700'"
                          class="hover:border-brand-500 dark:hover:border-brand-500 mr-3 flex h-5 w-5 items-center justify-center rounded-md border-[1.25px]">
                          <span :class="topRated ? '' : 'opacity-0'">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                              <path d="M11.6666 3.5L5.24992 9.91667L2.33325 7" stroke="white" stroke-width="1.94437" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                          </span>
                        </div>
                      </div>
                      Top Rated
                    </label>
                  </div>

                </div>
              </div>
            </div>



          </div>
        </div>

        <div class="w-full flex items-center justify-between">
          <button type="submit" class="w-full px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
            Submit
          </button>
        </div>


      </div>


      <!-- right side fields   -->
      <div class="space-y-6">

        <!-- multiple images selector -->
        <div class="rounded-2xl space-y-6 border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
          <div class="px-5 py-4 sm:px-6 sm:py-5">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
              Select Images
            </h3>
          </div>
          <!-- component -->
          <div class="sm:px-8 md:px-16 sm:py-8">
            <main class="">
              <!-- file upload modal -->
              <article aria-label="File Upload Modal"
                class="relative h-full flex flex-col text-gray-800 dark:text-white/90 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]"
                ondrop="dropHandler(event);" ondragover="dragOverHandler(event);" ondragleave="dragLeaveHandler(event);"
                ondragenter="dragEnterHandler(event);">
                <!-- overlay -->
                <div id="overlay" class="w-full h-full absolute top-0 left-0 pointer-events-none z-50 flex flex-col items-center justify-center rounded-md">
                  <i>
                    <svg class="fill-current w-12 h-12 mb-3 text-blue-700" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path d="M19.479 10.092c-.212-3.951-3.473-7.092-7.479-7.092-4.005 0-7.267 3.141-7.479 7.092-2.57.463-4.521 2.706-4.521 5.408 0 3.037 2.463 5.5 5.5 5.5h13c3.037 0 5.5-2.463 5.5-5.5 0-2.702-1.951-4.945-4.521-5.408zm-7.479-1.092l4 4h-3v4h-2v-4h-3l4-4z" />
                    </svg>
                  </i>
                  <p class="text-lg text-blue-700 dark:text-white/90">Drop files to upload</p>
                </div>

                <!-- scroll area -->
                <section class="h-full overflow-auto p-8 w-full flex flex-col">
                  <header class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
                    <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center dark:text-white/90">
                      <span>Drag and drop your</span>&nbsp;<span>files anywhere or</span>
                    </p>
                    <input id="hidden-input" type="file" name="activity_multiple_images[]" multiple class="hidden" />
                    <button id="button" type="button" class="mt-2 rounded-sm px-3 py-1 bg-gray-200 dark:text-black hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                      Upload a file
                    </button>
                  </header>

                  <h1 class="pt-8 pb-3 font-semibold sm:text-lg text-gray-800 dark:text-white/90">
                    To Upload
                  </h1>

                  <ul id="gallery" class="flex flex-1 flex-wrap -m-1">
                    <li id="empty" class="h-full w-full text-center flex flex-col items-center justify-center">
                      <img class="mx-auto w-32" src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png" alt="no data" />
                      <span class="text-small text-gray-500">No files selected</span>
                    </li>
                  </ul>
                </section>

                <!-- sticky footer -->
                <footer class="flex justify-end px-8 pb-8 pt-4">
                  <button id="submit" type="button" class="rounded-sm px-3 py-1 bg-blue-700 hover:bg-blue-500 text-white focus:shadow-outline focus:outline-none">
                    Upload now
                  </button>
                  <button type="button" id="cancel" class="ml-3 rounded-sm px-3 py-1 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                    Cancel
                  </button>
                </footer>
              </article>
            </main>
          </div>

          <!-- using two similar templates for simplicity in js code -->
          <template id="file-template">
            <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
              <article tabindex="0" class="group w-full h-full rounded-md focus:outline-none focus:shadow-outline elative bg-gray-100 cursor-pointer relative shadow-sm">
                <img alt="upload preview" class="img-preview hidden w-full h-full sticky object-cover rounded-md bg-fixed" />

                <section class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                  <h1 class="flex-1 group-hover:text-blue-800"></h1>
                  <div class="flex">
                    <span class="p-1 text-blue-800">
                      <i>
                        <svg class="fill-current w-4 h-4 ml-auto pt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z" />
                        </svg>
                      </i>
                    </span>
                    <p class="p-1 size text-xs text-gray-700"></p>
                    <button class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md text-gray-800">
                      <svg class="pointer-events-none fill-current w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path class="pointer-events-none" d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                      </svg>
                    </button>
                  </div>
                </section>
              </article>
            </li>
          </template>

          <template id="image-template">
            <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
              <article tabindex="0" class="group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
                <img alt="upload preview" class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />

                <section class="flex flex-col rounded-md break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                  <h1 class="flex text-[1px] justify-center items-center"></h1>
                  <div class="flex justify-center items-center">
                    <span class="p-1">
                      <i>
                        <svg class="fill-current w-4 h-4 ml-auto pt-" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
                        </svg>
                      </i>
                    </span>

                    <p class="p-1 size justify-center items-center text-[1px]"></p>
                    <button class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md">
                      <svg class="pointer-events-none fill-current w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                        <path class="pointer-events-none" d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                      </svg>
                    </button>
                  </div>
                </section>
              </article>
            </li>
          </template>

        </div>



        <!-- ratings bar  -->
        <div
          class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] ">
          <div class="px-5 py-4 sm:px-6 sm:py-5">
            <h3
              class="text-base font-medium text-gray-800 dark:text-white/90">
              Ratings
            </h3>


            <div x-data="{ rating: 0, hoverRating: 0 }" class="flex space-x-1 text-yellow-400 my-3">
              <template x-for="star in 5" :key="star">
                <button type="button" name="rating_bar"
                  @click="rating = (rating === star ? 0 : star)"
                  @mouseover="hoverRating = star"
                  @mouseleave="hoverRating = rating">
                  <svg
                    class="w-6 h-6 stroke-current"
                    fill="currentColor"
                    :class="(hoverRating >= star || rating >= star) ? 'text-yellow-400' : 'text-gray-300'"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                  </svg>
                </button>
              </template>

              <!-- Hidden input to store selected rating -->
              <input type="hidden" name="rating_bar" :value="rating">
            </div>
          </div>

          <!-- url  -->

          <div class="px-5 py-4 sm:px-6 sm:py-5">
            <label
              class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              URL
            </label>
            <div class="relative">
              <span
                class="absolute top-1/2 left-0 inline-flex h-11 -translate-y-1/2 items-center justify-center border-r border-gray-200 py-3 pr-3 pl-3.5 text-gray-500 dark:border-gray-800 dark:text-gray-400">
                http://
              </span>
              <input
                type="url" name="yt_url"
                placeholder="www.youtube.com"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pl-[90px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
            </div>
          </div>


          <!-- Location Input Section -->
          <div class="px-5 py-4 sm:px-6 sm:py-5">
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Location
            </label>
            <input type="text" id="locationInput" placeholder="Enter city or country" name="activity_location"
              class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 mb-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />

            <!-- Map -->
            <div id="hs-basic-leaflet" style="height: 400px;"></div>
          </div>
          <input type="hidden" name="latitude" id="latitudeInput">
          <input type="hidden" name="longitude" id="longitudeInput">




        </div>





      </div>
    </div>
    </div>
  </form>



</main>



@section('scripts')




<script>
  function variationForm() {
    let priceIdCounter = 0; // Counter for price variation IDs
    let timeIdCounter = 0; // Counter for time variation IDs

    return {
      priceVariations: [{
        id: priceIdCounter++, // Start with 0, increment for next
        title: '',
        regular: '',
        sale: ''
      }],
      timeVariations: [{
        id: timeIdCounter++, // Start with 0, increment for next
        start: '',
        end: ''
      }],
      serialized: '',

      serialize() {
        this.serialized = JSON.stringify({
          priceVariations: this.priceVariations,
          timeVariations: this.timeVariations,
        });
      },

      submitForm() {
        // Check if all fields are empty
        const allPriceEmpty = this.priceVariations.every(pv => !pv.title && !pv.regular && !pv.sale);
        const allTimeEmpty = this.timeVariations.every(tv => !tv.start && !tv.end);

        if (allPriceEmpty && allTimeEmpty) {
          alert("Empty Fields");
          return;
        }

        this.serialize();
        console.log("Serialized Data:", this.serialized);
        alert("Submitted");
      },

      addPriceVariation() {
        this.priceVariations.push({
          id: priceIdCounter++, // Use next sequential ID
          title: '',
          regular: '',
          sale: ''
        });
      },

      addTimeVariation() {
        this.timeVariations.push({
          id: timeIdCounter++, // Use next sequential ID
          start: '',
          end: ''
        });
      },

      removePriceVariation(index) {
        this.priceVariations.splice(index, 1);
      },

      removeTimeVariation(index) {
        this.timeVariations.splice(index, 1);
      }
    };
  }
  // <!-- auto generated slug  -->
  document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.querySelector('#bookingTitle');
    const slugInput = document.querySelector('#slug');

    titleInput.addEventListener('input', function() {
      const slug = titleInput.value
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-') // replace non-alphanumeric with dashes
        .replace(/^-+|-+$/g, ''); // remove leading/trailing dashes
      slugInput.value = slug;
    });
  });


  const dropzoneArea = document.querySelectorAll("#demo-upload");

  if (dropzoneArea.length) {
    let myDropzone = new Dropzone("#demo-upload", {
      url: "/file/post"
    });
  }



  //map location search 


  let map;
  let marker;
  let debounceTimer;

  window.addEventListener('load', () => {
    // Initialize map
    map = L.map('hs-basic-leaflet', {
      center: [20, 0],
      zoom: 2
    });

    // Add tile layer
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Handle input + geocoding with debounce
    document.getElementById('locationInput').addEventListener('input', function() {
      const location = this.value;

      clearTimeout(debounceTimer);
      debounceTimer = setTimeout(() => {
        if (!location) return;

        const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(location)}`;

        fetch(url)
          .then(response => response.json())
          .then(data => {
            if (data.length > 0) {
              const lat = parseFloat(data[0].lat);
              const lon = parseFloat(data[0].lon);

              // Update map
              map.setView([lat, lon], 13);

              // Add or update marker
              if (marker) map.removeLayer(marker);
              marker = L.marker([lat, lon]).addTo(map)
                .bindPopup(location)
                .openPopup();

              // Update hidden input fields
              document.getElementById('latitudeInput').value = lat;
              document.getElementById('longitudeInput').value = lon;
            }
          })
          .catch(error => {
            console.error("Geocoding error:", error);
          });
      }, 800); // delay in ms to prevent too many requests
    });
  });




  const fileTempl = document.getElementById("file-template"),
    imageTempl = document.getElementById("image-template"),
    empty = document.getElementById("empty");

  // use to store pre selected files
  let FILES = {};

  // check if file is of type image and prepend the initialied
  // template to the target element
  function addFile(target, file) {
    const isImage = file.type.match("image.*"),
      objectURL = URL.createObjectURL(file);

    const clone = isImage ?
      imageTempl.content.cloneNode(true) :
      fileTempl.content.cloneNode(true);

    clone.querySelector("h1").textContent = file.name;
    clone.querySelector("li").id = objectURL;
    clone.querySelector(".delete").dataset.target = objectURL;
    clone.querySelector(".size").textContent =
      file.size > 1024 ?
      file.size > 1048576 ?
      Math.round(file.size / 1048576) + "mb" :
      Math.round(file.size / 1024) + "kb" :
      file.size + "b";

    isImage &&
      Object.assign(clone.querySelector("img"), {
        src: objectURL,
        alt: file.name
      });

    empty.classList.add("hidden");
    target.prepend(clone);

    FILES[objectURL] = file;
  }

  const gallery = document.getElementById("gallery"),
    overlay = document.getElementById("overlay");

  // click the hidden input of type file if the visible button is clicked
  // and capture the selected files
  const hidden = document.getElementById("hidden-input");
  document.getElementById("button").onclick = () => hidden.click();
  hidden.onchange = (e) => {
    for (const file of e.target.files) {
      addFile(gallery, file);
    }
  };

  // use to check if a file is being dragged
  const hasFiles = ({
      dataTransfer: {
        types = []
      }
    }) =>
    types.indexOf("Files") > -1;

  // use to drag dragenter and dragleave events.
  // this is to know if the outermost parent is dragged over
  // without issues due to drag events on its children
  let counter = 0;

  // reset counter and append file to gallery when file is dropped
  function dropHandler(ev) {
    ev.preventDefault();
    for (const file of ev.dataTransfer.files) {
      addFile(gallery, file);
      overlay.classList.remove("draggedover");
      counter = 0;
    }
  }

  // only react to actual files being dragged
  function dragEnterHandler(e) {
    e.preventDefault();
    if (!hasFiles(e)) {
      return;
    }
    ++counter && overlay.classList.add("draggedover");
  }

  function dragLeaveHandler(e) {
    1 > --counter && overlay.classList.remove("draggedover");
  }

  function dragOverHandler(e) {
    if (hasFiles(e)) {
      e.preventDefault();
    }
  }

  // event delegation to caputre delete events
  // fron the waste buckets in the file preview cards
  gallery.onclick = ({
    target
  }) => {
    if (target.classList.contains("delete")) {
      const ou = target.dataset.target;
      document.getElementById(ou).remove(ou);
      gallery.children.length === 1 && empty.classList.remove("hidden");
      delete FILES[ou];
    }
  };

  // print all selected files
  document.getElementById("submit").onclick = () => {
    alert(`Submitted Files:\n${JSON.stringify(FILES)}`);
    console.log(FILES);
  };

  // clear entire selection
  document.getElementById("cancel").onclick = () => {
    while (gallery.children.length > 0) {
      gallery.lastChild.remove();
    }
    FILES = {};
    empty.classList.remove("hidden");
    gallery.append(empty);
  };
</script>

<!-- //ckeditor for description -->
<script>
  class MyUploadAdapter {
    constructor(loader) {
      this.loader = loader;
      this.url = "{{ route('ckeditor.upload') }}";
    }

    upload() {
      return this.loader.file.then(file =>
        new Promise((resolve, reject) => {
          this._initRequest();
          this._initListeners(resolve, reject, file);
          this._sendRequest(file);
        })
      );
    }

    abort() {
      if (this.xhr) {
        this.xhr.abort();
      }
    }

    _initRequest() {
      const xhr = this.xhr = new XMLHttpRequest();
      xhr.open('POST', this.url, true);
      xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
      xhr.responseType = 'json';
    }

    _initListeners(resolve, reject, file) {
      const xhr = this.xhr;
      const loader = this.loader;
      const errorText = `Couldn't upload file: ${file.name}.`;

      xhr.addEventListener('error', () => reject(errorText));
      xhr.addEventListener('abort', () => reject());
      xhr.addEventListener('load', () => {
        const response = xhr.response;

        if (!response || response.error) {
          return reject(response?.error?.message || errorText);
        }

        resolve({
          default: response.url
        });
      });

      if (xhr.upload) {
        xhr.upload.addEventListener('progress', evt => {
          if (evt.lengthComputable) {
            loader.uploadTotal = evt.total;
            loader.uploaded = evt.loaded;
          }
        });
      }
    }

    _sendRequest(file) {
      const data = new FormData();
      data.append('upload', file);
      this.xhr.send(data);
    }
  }

  function SimpleUploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
      return new MyUploadAdapter(loader);
    };
  }

  ClassicEditor
    .create(document.querySelector('#body'), {
      extraPlugins: [SimpleUploadAdapterPlugin],
      toolbar: [
        'heading', '|',
        'bold', 'italic', 'underline', 'strikethrough', '|',
        'alignment', 'fontSize', 'fontColor', 'fontBackgroundColor', '|',
        'link', 'imageUpload', 'blockQuote', 'insertTable', '|',
        'undo', 'redo'
      ],
      image: {
        toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side']
      },
      alignment: {
        options: ['left', 'center', 'right', 'justify']
      }
    })
    .then(editor => {
      window.editor = editor;
    })
    .catch(error => {
      console.error(error);
    });
</script>


@endsection




@endsection