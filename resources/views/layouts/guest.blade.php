<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
            <div class="w-full px-6 py-4 mt-6 overflow-hidden text-white shadow-md sm:max-w-md bg-teal-950 sm:rounded-lg">
                <div class="flex flex-col items-center justify-center">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
                    </a>

                    <span class="mt-4 text-2xl font-semibold">Sign in</span>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
