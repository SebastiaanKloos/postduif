<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />

        <meta name="application-name" content="{{ config('app.name') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ config('app.name') }}</title>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @filamentStyles
        @vite('resources/css/app.css')
    </head>

    <body class="antialiased bg-gray-50">
        <main class="max-w-2xl mx-auto py-10">
            <div class="bg-white rounded-lg overflow-hidden border">
                {{ $slot }}
            </div>
        </main>

        <x-footer />

        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>
