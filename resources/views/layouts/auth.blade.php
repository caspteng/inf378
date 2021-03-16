<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($page_title) ? "$page_title -" : "" }} {{ config('app.name') }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/semantic/semantic.min.css') }}">
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('assets/semantic/semantic.min.js') }}"></script>
</head>
<body>
<div class="ui container">

    @yield('content')

</div>
</body>
</html>


