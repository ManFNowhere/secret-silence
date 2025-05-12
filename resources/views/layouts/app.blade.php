<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Secret Silence')</title>
    {{--<title>{{ config('app.name', 'Laravel') }}</title>--}}

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @vite(['resources/js/app.js', 'resources/css/app.css'], 'build')


</head>

<body class="antialiased">
    <main class="min-h-screen relative overflow-hidden bg-black">
        <video autoplay muted loop playsinline preload="auto" class="absolute top-0 left-0 w-full h-full object-cover z-10 opacity-15">
            <source src="{{ asset('storage/videos/background.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        @include('layouts.navigation')
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4 z-50 relative">
            @yield('content')
        </div>
    </main>
</body>

</html>
