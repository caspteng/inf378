<!-- Sidebar Menu -->
<div class="ui grey vertical inverted left sidebar visible icon menu" style="width: 8%">
    <a class="active blue item" href="#" style="padding-top: 2em; padding-bottom: 2em;">
        <i class="twitter huge icon"></i>
    </a>
    <a class="item" href="{{ route('home') }}">
        <i class="home big icon"></i>
        Home
    </a>
    <a class="item" href="{{ route('explore') }}">
        <i class="hashtag big icon"></i>
        Explorer
    </a>
    @auth
        <a class="item" href="{{ route('profile', auth()->user()) }}">
            <i class="user big icon"></i>
            Profil
        </a>
        <a class="item" href="#">
            <i class="envelope big icon"></i>
            Messages
        </a>
        <a class="item" href="{{ route('settings') }}">
            <i class="cog big icon"></i>
            Paramètres
        </a>
        <form id="tw-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a class="item" href="#" onclick="document.getElementById('tw-logout').submit();">
            <i class="power off big icon"></i>
            Déconnexion
        </a>
    @endauth
</div>
