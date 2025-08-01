<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" as="style"> --}}

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
   <body class="font-sans antialiased">
    <div class="flex min-h-screen overflow-x-hidden">
        {{-- Sidebar --}}
        @include('dashboard.sidebar')

        {{-- Main Content --}}
        <div class="bg-slate-50 flex-1 overflow-x-hidden">
            {{-- Top Header (optional) --}}
            @include('dashboard.header')

            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
