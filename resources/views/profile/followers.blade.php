@extends('layouts.app')
@section('content')

    <div class="ui grid">
        <div class="two wide column">
        </div>

        <div class="eleven wide column">
            <h2 class="ui header blue">{{ $page_title }}</h2>
            <div class="scrolling-pagination">
                <div class="ui segments">
                    @forelse($followers as $follower)
                        <div class="ui clearing segment">
                            <img class="ui avatar image" src="{{ $follower->avatar }}">
                            <a href="{{ route('profile', $follower->username) }}">{{ $follower->surname }}</a>
                            @if (Auth::check() && auth()->user()->id != $follower->id)
                                <div class="ui follow button right floated"
                                     data-following="{{ auth()->user()->isFollowing($follower) ? 'true' : 'false' }}"
                                     data-id="{{ $follower->id }}">
                                    {{ auth()->user()->isFollowing($follower) ? 'Ne plus suivre' : 'Suivre'}}
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="ui clearing segment">Personne ne suit {{ $user->surname }}</div>
                    @endforelse
                    {{ $followers->links() }}
                </div>
            </div>
        </div>

        <div class="three wide column">
        </div>
@stop
