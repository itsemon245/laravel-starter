<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    @include('layouts.styles')


</head>

<body class="flex h-screen bg-gray-50 dark:bg-gray-900">

    <div id="vue-root">
        @yield('header')
        @yield('aside')
        @yield('main')

        @yield('footer')
    </div>
    @include('layouts.scripts')
</body>

</html>
