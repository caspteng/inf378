@extends('layouts.profile')
@section('content')
    <div class="row">
        <div class="column">
            <div class="ui cards">
                <div class="card">
                    <div class="image">
                        <img src="
                              {{ $user->avatar_picture ??
                              '//eu.ui-avatars.com/api/?size=290&&color=ffffff&background=555b6e&name=' . $user->surname . '&format=svg'
                              }} " alt="{{ $user->surname }}">
                    </div>
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
                            {{ TweetUser::getFollowCount($user->id) }} followers
                          </span>
                    </div>

                    @if (Auth::check())
                        @if ($is_profile_owner)
                            <a class="ui bottom attached button">
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
                    @endif
                </div>
            </div>
        </div>
@stop
