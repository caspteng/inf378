<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properties -->
    <title>{{ $page_title ?? config('app.name') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/semantic/semantic.min.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/semantic/semantic.min.js') }}"></script>
</head>


<body>

<div class="ui equal width center aligned middle aligned grid">
    <div class="row ">
        <div class="blue column tweet">

            <div class="item ">
                <span class="label"><i class="large search icon"></i> Retrouvez vos centres d'intérêt.</span>
            </div>
            <br>
            <div class="item">
                    <span class="label"><i class="large newspaper icon"></i> Discutez des tendances qui
                        <br>vous tiennent à cœur.</span>
            </div>
            <br>
            <div class="item">
                <span class="label"><i class="large heart icon"></i> Partagez, aimez, retweetez...</span>
            </div>

        </div>
        <div class="column">
            <div class="right-content middle aligned">
            <h1><i class="twitter blue icon"></i> Ça se passe maintenant.</h1>
            <span class="medium text">Rejoignez Tweet Académie.</span><br>
            <a href="{{ route('login') }}" class="ui primary button">Se connecter
                <i class="angle right icon"></i></a>
            <a href="{{ route('register') }}" class="ui button">S'inscrire
                <i class="angle right icon"></i></a>
            </div>
        </div>
    </div>

    <div class="row" style="background-color: #e9e9e9;">
        <div class="middle aligned column">
            © 2021 Web@cadémie - TweetAcadémie
        </div>

    </div>
</div>
</body>
</html>
