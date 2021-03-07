<div class="ui blue segment">
    <div class="ui horizontal left aligned divider header"><h3>Suivi</h3></div>
    @foreach (auth()->user()->following()->latest()->limit(10)->get() as $following)
        <p><img class="ui avatar image" src="{{ $following->avatar }}"><a href="{{ route('profile', $following->username) }}">{{ $following->surname }}</a></p>
    @endforeach
</div>
