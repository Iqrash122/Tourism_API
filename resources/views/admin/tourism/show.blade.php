@extends('layouts.dashboard')

@section('content')


<div class="mx-auto max-w-(--breakpoint-2xl) my-20 p-4 md:p-6 ">
    <!-- Top - Image Carousel -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

        <div class="space-y-6  rounded-2xl border dark:text-white border-gray-200 bg-white  dark:border-gray-800 dark:bg-white/[0.03]">

            <div class="w-full relative h-[500px]" x-data="imageSlider()" x-init="init()">
                @php
                $images = json_decode($tour->activity_multiple_images, true) ?: [];
                @endphp

                @if(count($images) > 0)
                <div class="relative h-full overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-in-out h-full"
                        :style="`transform: translateX(-${currentIndex * 100}%)`">
                        @foreach ($images as $img)
                        <div class="w-full h-full flex-shrink-0">
                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $tour->activity_title }}" class="w-full h-full object-cover">
                        </div>
                        @endforeach
                    </div>

                    <!-- Navigation buttons -->
                    @if(count($images) > 1)
                    <button @click="prev()"
                        class="absolute top-1/2 left-4 -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-75 transition"
                        aria-label="Previous image">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button @click="next()"
                        class="absolute top-1/2 right-4 -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-75 transition"
                        aria-label="Next image">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Dots -->
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                        <template x-for="(image, index) in images.length" :key="index">
                            <button @click="goTo(index)"
                                :class="{'bg-white': currentIndex === index, 'bg-gray-500 bg-opacity-50': currentIndex !== index}"
                                class="w-3 h-3 rounded-full transition"
                                aria-label="Go to image"></button>
                        </template>
                    </div>
                    @endif
                </div>
                @else
                <div class="h-full flex items-center justify-center bg-gray-200">
                    <p class="text-gray-500 italic">No images available</p>
                </div>
                @endif
            </div>


            <!-- Bottom - Tour details -->
            <div class="p-6 md:p-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $tour->activity_title }}</h1>
                        <div class="flex items-center">
                            <div class="flex mr-2">
                                @php
                                $fullStars = floor($tour->rating_bar);
                                $hasHalfStar = $tour->rating_bar % 1 >= 0.5;
                                $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                                @endphp

                                @for ($i = 0; $i < $fullStars; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400 fill-amber-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    @endfor

                                    @if ($hasHalfStar)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400 fill-amber-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    @endif

                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        @endfor
                            </div>
                            <span class="text-gray-600">{{ number_format($tour->rating_bar, 2) }}</span>
                        </div>
                    </div>

                    <div class="mt-4 md:mt-0">
                        @php
                        $priceVariations = json_decode($tour->price_variations, true) ?? [];
                        $firstVariation = $priceVariations[0] ?? null;
                        @endphp

                        @if($firstVariation)
                        @if(isset($firstVariation['sale']) && $firstVariation['sale'] < $firstVariation['regular'])
                            <span class="text-3xl font-bold text-gray-900 dark:text-white">
                            AED {{ number_format($firstVariation['sale'], 2) }}
                            </span>
                            <span class="ml-2 text-lg text-gray-500 line-through">
                                AED {{ number_format($firstVariation['regular'], 2) }}
                            </span>
                            @else
                            <span class="text-3xl font-bold text-gray-900 dark:text-white">
                                ${{ number_format($firstVariation['regular'], 2) }}
                            </span>
                            @endif

                            @else
                            <span class="text-gray-500">Price not available</span>
                            @endif
                    </div>
                </div>

                <div class="mb-8">
                    <p class="text-gray-700 dark:text-white">{{ $tour->body }}</p>
                </div>

                <div class="grid grid-cols  text-center gap-4 mb-8">
                    <!-- Time Variations Section -->
                    <div class="space-y-4 sm:col-span-2 lg:col-span-2">
                        @if(!empty(json_decode($tour->time_variations, true)))
                        @foreach(json_decode($tour->time_variations, true) as $index => $variation)
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white dark:bg-white/[0.03] rounded-lg p-4 shadow-sm">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    @if($index === 0) Start Time @else Time Slot {{ $index + 1 }} Start @endif
                                </p>
                                <p class="font-semibold dark:text-white">
                                    {{ $variation['start'] ?? 'Not specified' }}
                                </p>
                            </div>

                            <div class="bg-white dark:bg-white/[0.03] rounded-lg p-4 shadow-sm">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    @if($index === 0) End Time @else Time Slot {{ $index + 1 }} End @endif
                                </p>
                                <p class="font-semibold dark:text-white">
                                    {{ $variation['end'] ?? 'Not specified' }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="bg-white dark:bg-white/[0.03] rounded-lg p-4 shadow-sm">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Time Information</p>
                            <p class="font-semibold dark:text-white">No time slots available</p>
                        </div>
                        @endif
                    </div>

                    <!-- Created Date Section -->
                    <!-- <div class="bg-white dark:bg-white/[0.03] rounded-lg p-4 shadow-sm">
                         <p class="text-sm text-gray-600 dark:text-gray-400">Created Date</p>
                         <p class="font-semibold dark:text-white">
                             {{ $tour->created_at->format('M d, Y h:i A') }}
                         </p>
                     </div> -->
                </div>
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-4">Package Details</h3>
                    <div class="grid grid-cols-1  justify-center items-center my-4 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @php
                        $priceVariations = json_decode($tour->price_variations, true) ?? [];
                        @endphp

                        @if(is_array($priceVariations) && count($priceVariations))
                        @foreach($priceVariations as $variation)
                        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-5 border border-rose-100 dark:border-gray-900 transition hover:scale-105 duration-200">
                            <div class="flex items-center space-x-3 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                    {{ $variation['title'] ?? 'Package' }}
                                </h3>
                            </div>

                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-medium text-gray-900 dark:text-white">Regular Price:</span> Rs {{ $variation['regular'] ?? 'N/A' }}</p>
                                <p><span class="font-medium text-gray-900 dark:text-white">Sale Price:</span> Rs {{ $variation['sale'] ?? 'N/A' }}</p>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <p class="text-gray-600 dark:text-gray-300">No packages available.</p>
                        @endif
                    </div>



                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-y-3 gap-6">
                        @php
                        // For JSON stored arrays (recommended approach)
                        $cityIds = json_decode($tour->activity_cities, true) ?? [];
                        $cityNames = collect($cityIds)->map(fn($id) => $cities->find($id)?->name)->filter()->implode(', ');

                        $categoryIds = json_decode($tour->activity_categories, true) ?? [];
                        $categoryNames = collect($categoryIds)->map(fn($id) => $categories->find($id)?->name)->filter()->implode(', ');
                        @endphp

                        @if($cityNames)
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h1 class="text-[20px] font-bold">Cities</h1>
                            <span>: {{ $cityNames }}</span>
                        </div>
                        @endif

                        @if($categoryNames)
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h1 class="text-[20px] font-bold">Categories</h1>
                            <span>: {{ $categoryNames }}</span>
                        </div>
                        @endif
                    </div>
                </div>



                <!-- //right side  -->



            </div>
        </div>

        <div class="space-y-4   rounded-2xl border dark:text-white border-gray-200 bg-white  dark:border-gray-800 dark:bg-white/[0.03]">

            <div class="">
                {{-- Location display --}}


                {{-- Hidden input for location string --}}
                <input type="hidden" id="locationInput" value="{{ $tour->activity_location }}">

                {{-- Map container --}}
                <div id="hs-basic-leaflet" class="w-full h-72 rounded-lg shadow-md z-0"></div>
            </div>



            @php
            $url = $tour->yt_url;
            $videoId = null;

            if (str_contains($url, 'youtube.com/watch?v=')) {
            $videoId = Str::after($url, 'v=');
            $videoId = Str::before($videoId, '&'); // Remove extra query params
            } elseif (str_contains($url, 'youtu.be/')) {
            $videoId = Str::after($url, 'youtu.be/');
            }
            @endphp

            @if($videoId)
            <div class="w-full space-y-4 ">
                <iframe
                    class="w-full h-64 md:h-96"
                    src="https://www.youtube.com/embed/{{ $videoId }}"
                    frameborder="0"
                    allowfullscreen>
                </iframe>
            </div>
            @else
            <div class="flex items-center rounded-lg shadow-md z-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="rounded-lg shadow-md z-0">{{ $tour->yt_url ? "Invalid YouTube URL: " . $tour->yt_url : 'No YouTube video available' }}</span>
            </div>
            @endif
        </div>
    </div>
</div>




<!-- Alpine.js Script -->
<script>
    function imageSlider() {
        return {
            currentIndex: 0,
            images: @json($images),
            init() {
                // Auto slide every 5 seconds
                setInterval(() => {
                    if (this.images.length > 1) {
                        this.next();
                    }
                }, 5000);
            },
            prev() {
                this.currentIndex = (this.currentIndex === 0) ? this.images.length - 1 : this.currentIndex - 1;
            },
            next() {
                this.currentIndex = (this.currentIndex === this.images.length - 1) ? 0 : this.currentIndex + 1;
            },
            goTo(index) {
                this.currentIndex = index;
            }
        }
    }
</script>

<script>
    let map;
    let marker;

    window.addEventListener('load', () => {
        const location = document.getElementById('locationInput').value;
        if (!location) return;

        map = L.map('hs-basic-leaflet').setView([20, 0], 2); // Default view

        // Add tile layer
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Geocode the location
        const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(location)}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    const lat = parseFloat(data[0].lat);
                    const lon = parseFloat(data[0].lon);

                    // Set view and add marker
                    map.setView([lat, lon], 13);
                    marker = L.marker([lat, lon]).addTo(map)
                        .bindPopup(location)
                        .openPopup();
                }
            })
            .catch(error => {
                console.error("Geocoding error:", error);
            });
    });
</script>



@endsection