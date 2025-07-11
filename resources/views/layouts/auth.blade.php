<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign In | Tourism Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
  </head>
  <body
    x-data="{ page: 'comingSoon', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
  :class="{'dark bg-gray-900': darkMode === true}">

  {{-- per loader --}}
  <x-admin.preloader />

  {{-- Page Wrapper --}}
  <div class="relative p-6 bg-white z-1 dark:bg-gray-900 sm:p-0">
    <div class="flex flex-col justify-center w-full h-screen dark:bg-gray-900 sm:p-0 lg:flex-row">
      @yield('content')
    </div>
  </div>

  @yield('scripts')
</body>

</html>