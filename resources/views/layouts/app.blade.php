<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="token" name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($page_title) ? "$page_title -" : "" }} {{ config('app.name') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/semantic/semantic.min.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/semantic/semantic.min.js') }}"></script>
    <script src="{{ asset('js/api.js') }}"></script>

</head>
<body>
<x-navbar-menu/>
    <div class="ui container" id="content">
    @yield('content')
    </div>
    <x-flash-message/>
</body>
</html>
