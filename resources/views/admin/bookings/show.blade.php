@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-800 dark:to-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <!-- Booking Card -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden dark:bg-gray-800 transition-all duration-300 hover:shadow-2xl">
            <!-- Card Header with Decorative Elements -->
            <div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 dark:from-blue-800 dark:to-indigo-900 px-8 py-6">
                <div class="absolute top-0 right-0 -mt-4 -mr-4">
                    <div class="w-16 h-16 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-white/10 rounded-xl backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white">{{ $booking->title ?? 'Your Booking' }}</h1>
                        <p class="text-blue-100 dark:text-blue-200">Booking ID: #{{ $booking->id ?? '0000' }}</p>
                    </div>
                </div>
            </div>

            <!-- Booking Content -->
            <div class="p-8">
                <!-- Tour Section -->
                <div class="mb-10">
                    <div class="flex items-center mb-6">
                        <div class="h-12 w-1 bg-indigo-500 rounded-full mr-4"></div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Tour Details</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tour Card -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-800 rounded-2xl p-6 shadow-sm border border-blue-100 dark:border-gray-700">
                            <div class="flex items-center mb-4">
                                <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Tour Information</h3>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Tour Name</span>
                                    <span class="font-medium text-gray-800 dark:text-white">{{ $booking->tour->activity_title ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Package</span>
                                    @if($booking->tour)
                                    @php
                                    $variations = json_decode($booking->tour->price_variations, true);
                                    $bookingPrice = trim((string) $booking->booking_price);
                                    $displayTitle = 'N/A';

                                    if (is_array($variations)) {
                                    foreach ($variations as $variation) {
                                    if (isset($variation['sale']) && trim($variation['sale']) == $bookingPrice) {
                                    $displayTitle = $variation['title'] ?? 'N/A';
                                    break;
                                    }
                                    }
                                    }
                                    @endphp

                                    <span class="font-medium text-gray-800 dark:text-white">
                                        {{ $displayTitle }}
                                    </span>
                                    @endif
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Price</span>
                                    <span class="font-medium text-indigo-600 dark:text-indigo-400">{{ $booking->booking_price ? 'AED '.$booking->booking_price : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Date & Time Card -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-800 rounded-2xl p-6 shadow-sm border border-blue-100 dark:border-gray-700">
                            <div class="flex items-center mb-4">
                                <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Schedule</h3>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Booking Date</span>
                                    <span class="font-medium text-gray-800 dark:text-white">
                                        {{ $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') : 'N/A' }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Time</span>
                                    <span class="font-medium text-gray-800 dark:text-white">
                                        {{ $booking->booking_time ? \Carbon\Carbon::parse($booking->booking_time)->format('g:i A') : 'N/A' }}
                                    </span>
                                </div>

                                @php
                                use Carbon\Carbon;

                                $start = 'N/A';
                                $end = 'N/A';
                                $duration = 'N/A';
                                $bookingTime = $booking->booking_time ?? null;

                                if ($booking->tour && $bookingTime) {
                                $bookingTimeCarbon = Carbon::parse($bookingTime);
                                $timeVariations = json_decode($booking->tour->time_variations ?? '[]', true);

                                if (is_array($timeVariations)) {
                                foreach ($timeVariations as $variation) {
                                $variationStart = $variation['start'] ?? null;
                                $variationBooking = $variation['booking_time'] ?? null;
                                $variationEnd = $variation['end'] ?? null;

                                $matchFound = false;

                                if ($variationStart) {
                                $variationStartCarbon = Carbon::parse($variationStart);
                                if ($bookingTimeCarbon->format('H:i') === $variationStartCarbon->format('H:i')) {
                                $matchFound = true;
                                }
                                }

                                if (!$matchFound && $variationBooking) {
                                $variationBookingCarbon = Carbon::parse($variationBooking);
                                if ($bookingTimeCarbon->format('H:i') === $variationBookingCarbon->format('H:i')) {
                                $matchFound = true;
                                }
                                }

                                if ($matchFound) {
                                try {
                                $startCarbon = $variationStart ? Carbon::parse($variationStart) : null;
                                $endCarbon = $variationEnd ? Carbon::parse($variationEnd) : null;

                                if ($startCarbon && $endCarbon) {
                                if ($endCarbon->lessThanOrEqualTo($startCarbon)) {
                                $endCarbon->addDay(); // Handle overnight duration
                                }

                                $diffInMinutes = $endCarbon->diffInMinutes($startCarbon);
                                $hours = intdiv($diffInMinutes, 60);
                                $minutes = $diffInMinutes % 60;

                                $durationParts = [];
                                if ($hours > 0) {
                                $durationParts[] = $hours . ' hour' . ($hours > 1 ? 's' : '');
                                }
                                if ($minutes > 0) {
                                $durationParts[] = $minutes . ' minute' . ($minutes > 1 ? 's' : '');
                                }

                                $duration = $durationParts ? implode(' ', $durationParts) : '0 minutes';

                                $start = $startCarbon->format('g:i A');
                                $end = $endCarbon->format('g:i A');
                                }
                                } catch (\Exception $e) {
                                $start = 'N/A';
                                $end = 'N/A';
                                $duration = 'N/A';
                                }

                                break; // Exit loop after finding the first match
                                }
                                }
                                }
                                }
                                @endphp

                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Duration</span>
                                    <span class="text-gray-700 dark:text-gray-200">
                                        {{ $start !== 'N/A' && $end !== 'N/A' ? "$start – $end ($duration)" : 'N/A' }}
                                    </span>
                                </div>





                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="mb-10">
                    <div class="flex items-center mb-6">
                        <div class="h-12 w-1 bg-indigo-500 rounded-full mr-4"></div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Additional Information</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Participants Card -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-800 rounded-2xl p-6 shadow-sm border border-blue-100 dark:border-gray-700">
                            <div class="flex items-center mb-4">
                                <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Participants</h3>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-gray-600 dark:text-gray-300 block">Number of Persons</span>
                                    <span class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $booking->booking_person ?? '0' }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-gray-600 dark:text-gray-300 block">Total Price</span>
                                    <span class="text-2xl font-bold text-gray-800 dark:text-white">
                                        AED {{ $booking->booking_price  ?? '0' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Status Card -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-800 rounded-2xl p-6 shadow-sm border border-blue-100 dark:border-gray-700">
                            <div class="flex items-center mb-4">
                                <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Booking Status</h3>
                            </div>
                            <div class="flex flex-col items-center justify-center h-full">
                                <span class="px-6 py-2 rounded-full text-lg font-semibold 
                                    {{ $booking->status === 'Public' ? 
                                       'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                                       'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' }}">
                                    {{ $booking->booking_status ?? 'Pending' }}
                                </span>
                                <p class="mt-3 text-center text-gray-600 dark:text-gray-300 mb-4">
                                    @if($booking->booking_status === 'public')
                                    Your booking is confirmed and active
                                    @else
                                    Your booking is being processed
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{route('book_tour.index')}}" class="flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Bookings
                    </a>

                </div>
            </div>
        </div>

        <!-- Help Section -->

    </div>
</div>


@endsection