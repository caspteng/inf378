@extends('layouts.app')
@section('content')
    <div class="ui grid">
        <div class="four wide column">
            <div class="ui cards">
                <div class="card">
                    <a class="dimmable image">
                        <div class="ui dimmer display-avatar">
                        </div>
                        <img alt="{{ $user->surname }}"
                             src="{{ $user->avatar }}">
                    </a>
                    <div class="content">
                        <div class="header">{{ $user->surname }}</div>
                        <div class="meta">
                            <a>{{ '@' . $user->username }}</a>
                        </div>
                        <div class="description">
                            {{ $user->biography }}
                        </div>
                    </div>
                    <div class="extra content">
                          <span class="right floated">
                            Joined in {{ $user->created_at->format('Y') }}
                          </span>
                        <span>
                            <i class="user icon"></i>
                            {{ $user->count_follower }} followers
                          </span>
                    </div>

                    @auth
                        @if ($is_profile_owner)
                            <a class="ui bottom attached button edit_profil">
                                <i class="user icon"></i>
                                Edit Profil
                            </a>
                        @else
                            <div class="ui {{ $is_follow ? '' : 'primary' }} follow button"
                                 data-following="{{ $is_follow ? 'false' : 'true' }}" data-id="{{ $user->id }}">
                                <i class="user {{ $is_follow ? 'plus' : 'minus' }} icon"></i>
                                {{ $is_follow ? 'Suivre' : 'Se désabonné' }}
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        <div class="nine wide column">
            @if ($is_profile_owner)
                <x-publish-tweet-form/>
            @endif
            <br/>
            @include('_timeline', ['tweets' => $user->timeline()])
        </div>
        <x-right-content/>
        <x-modal-tweet-remove/>
    </div>
    @include('_edit-profil')
    @include('_modal-avatar')
@stop
