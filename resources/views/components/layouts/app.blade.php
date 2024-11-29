<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite('resources/css/app.css')
        @livewireStyles

        <title>{{ $title ?? 'To do' }}</title>
    </head>
    <body class="text-black bg-white dark:bg-gray-800 dark:text-white">
        @csrf
        {{ $slot }}

        @livewireScripts
    </body>
</html>
