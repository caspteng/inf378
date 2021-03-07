@extends('layouts.app')
@section('content')

    <div class="ui grid">
        <div class="two wide column">
        </div>

        <div class="eleven wide column">
            <h2 class="ui header blue">{{ $page_title }}</h2>
            <div class="scrolling-pagination">
                <div class="ui segments">
                    @forelse ($followings as $following)
                        <div class="ui clearing segment">
                            <img class="ui avatar image" src="{{ $following->avatar }}">
                            <a href="{{ route('profile', $following->username) }}">{{ $following->surname }}</a>
                            @if ($is_owner)
                                <div class="ui follow button right floated"
                                     data-following="true"
                                     data-id="{{ $following->id }}">Ne plus suivre
                                </div>
                            @elseif (Auth::check() && auth()->user()->id != $following->id)
                                <div class="ui follow button right floated"
                                     data-following="{{ auth()->user()->isFollowing($following) ? 'true' : 'false' }}"
                                     data-id="{{ $following->id }}">
                                    {{ auth()->user()->isFollowing($following) ? 'Ne plus suivre' : 'Suivre'}}
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="ui clearing segment">{{ $user->surname }} ne suit personne</div>
                    @endforelse
                    {{ $followings->links() }}
                </div>
            </div>
        </div>

        <div class="three wide column">
        </div>
@stop
