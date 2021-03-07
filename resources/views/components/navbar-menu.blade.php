<div class="ui center aligned grid">

    <div class="computer only row">
        <div class="ui top blue inverted fixed menu">
            <a class="active item" href="{{ url('/') }}"><i class="twitter big icon"></i>{{ config('app.name') }}
            </a>
            @auth
                <a class="item" href="{{ route('home') }}"><i class="home big icon"></i> Home</a>
            @endauth
            <a class="item" href="{{ route('explore') }}"><i class="hashtag big icon"></i> Explorer</a>
            @auth
                <a class="item" href="{{ route('profile', auth()->user()) }}"><i class="user big icon"></i> Profil</a>
                <a class="item" href="{{ route('settings') }}"><i class="cog big icon"></i> Paramètres</a>
            @endauth
            <div class="right menu">
                <div class="item">
                    <div class="ui icon input">
                        <input type="text" placeholder="Rechercher..."><i class="search link icon"></i>
                    </div>
                </div>
            </div>
            @auth
                <a class="item" href="#" onclick="document.getElementById('tw-logout').submit();"><i
                        class="power off big icon"></i> Déconnexion</a>
            @else
                <a class="item" href="{{ route('login') }}"><i
                        class="angle user circle big icon"></i> Se connecter</a>
            @endauth
        </div>
    </div>

    <div class="tablet mobile only row">
        <div class="column">
            <div class="ui top blue inverted fixed menu">
                <a id="mobile_item" class="item"><i class="bars big icon"></i></a>
                <a class="active item" href="{{ route('home') }}"><i
                        class="twitter big icon"></i>{{ config('app.name') }}</a>
                <div class="right menu">
                    <div class="item">
                        <div class="ui icon input">
                            <input type="text" placeholder="Rechercher..."><i class="search link icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="ui pushable sidebar vertical icon menu blue inverted">
    <a class="item" href="{{ route('home') }}"><i class="home big icon"></i> Home</a>
    <a class="item" href="{{ route('explore') }}"><i class="hashtag big icon"></i> Explorer</a>
    @auth
        <a class="item" href="{{ route('profile', auth()->user()) }}"><i class="user big icon"></i> Profil</a>
        <a class="item" href="{{ route('settings') }}"><i class="cog big icon"></i> Paramètres</a>
        <a class="item" href="#" onclick="document.getElementById('tw-logout').submit();"><i
                class="power off big icon"></i> Déconnexion</a>
    @endauth
</div>

<form id="tw-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    $('#mobile_item').click(function () {
        $('.ui.sidebar').sidebar('toggle', 'attach events');
    })
</script>
