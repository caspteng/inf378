<div class="ui blue segment">
    <div class="ui horizontal left aligned divider header"><h3><a
                href="{{ route('following', auth()->user()->username) }}">Suivi</a></h3></div>
    @forelse (auth()->user()->following()->latest()->limit(10)->get() as $following)
        <p><img class="ui avatar image" src="{{ $following->avatar }}">
            <a href="{{ route('profile', $following->username) }}">
                {{ $following->surname }}
            </a></p>
    @empty
        <p>Aucun utilisateur suivi</p>
    @endforelse
</div>
