<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($page_title) ? "$page_title -" : "" }} {{ config('app.name') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>

</head>
<body>
<x-navbar-menu/>
<div class="ui container" id="content">
    @yield('content')
</div>
<x-flash-message/>
</body>
</html>
