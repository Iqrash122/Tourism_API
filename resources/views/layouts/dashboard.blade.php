<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        Tourism Dashboard
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
    {{-- <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/preline@latest/dist/preline.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


</head>

<body x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark bg-gray-900': darkMode === true }">
    {{-- preloader --}}
    <x-admin.preloader />

    {{-- Page Wrapper --}}
    <div class="flex h-screen overflow-hidden">
        {{-- sidebar --}}
        <x-admin.sidebar />
        {{-- content area start --}}
        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            {{-- Overlay Component --}}
            <x-admin.overlay />
            {{-- Header Component --}}
            <x-admin.header /> 
            {{-- Main Component --}}
            @yield('content')


        </div>
    </div>

    @yield('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Include CKEditor 5 Classic build -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>


    <script>
        flatpickr("#bookingTime", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K", // 'K' adds AM/PM
            minTime: "9:00AM",
            maxTime: "6:00PM",
            time_24hr: false, // use 12-hour format
        });
    </script>

    <!-- Flatpickr CSS and JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        flatpickr("#datepicker-format", {
            dateFormat: "Y-m-d",
            minDate: "today",
            maxDate: new Date().fp_incr(14)
        });
    </script>



    <script>
        flatpickr("#dateofbirth-format", {
            dateFormat: "Y-m-d",
            maxDate: new Date().fp_incr(-1),
            minDate: new Date().fp_incr(-100 * 365),
            defaultDate: "{{ old('dob') || '' }}"
        });
    </script>

</body>

</html>