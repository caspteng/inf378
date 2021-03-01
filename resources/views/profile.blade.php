@extends('layouts.profile')
@section('content')
    <div class="ui grid">
        <div class="four wide column">
            <div class="ui cards">
                <div class="card">
                    <div class="image">
                        <img alt="{{ $user->surname }}"
                             src="{{ $user->avatar_picture ??
                              '//eu.ui-avatars.com/api/?size=290&&color=ffffff&background=555b6e&name='
                               . $user->surname . '&format=svg'
                              }}">
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
        <div class="twelve wide column">

            @if ($is_profile_owner)
                <x-publish-tweet-form></x-publish-tweet-form>
            @endif

            @foreach($user->timeline() as $tweet)
                <div class="ui large feed raised segment">
                    <div class="event">
                        <div class="label">
                            <div class="image">
                                <img alt="{{ $user->surname }}"
                                     src="{{ $user->avatar_picture ??
                              '//eu.ui-avatars.com/api/?size=290&&color=ffffff&background=555b6e&name='
                               . $user->surname . '&format=svg'
                              }}">
                            </div>
                        </div>
                        <div class="content">
                            <div class="summary">
                                <a>{{ $tweet->user['surname'] }}</a> {{ '@' . $tweet->user['username'] }}
                                <div class="date">
                                    {{ $tweet->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                            <div class="extra text">
                                @if ($tweet->is_retweet)
                                    <b> <i class="retweet icon"></i> {{ $is_profile_owner ? 'Vous avez retweeté' : $tweet->user->surname . ' a retweeté'}}</b>
                                @endif
                                {{ $tweet->message }}
                            </div>
                            <div class="meta">
                                <a href="{{ route('like', $tweet->id) }}"
                                   class="like @if (Auth::check()) {{ auth()->user()->isLiking($tweet) ? 'active' : ''}} @endif">
                                    <i class="like icon"></i> {{ TweetUser::getLikeCount($tweet->id) }} Likes
                                </a>
                                @if ($tweet->is_retweet && Auth::check())
                                    <a href="{{ $tweet::alreadyRetweeted(auth()->user()->id, $tweet->retweet_id) ?
                                    route('retweet_undo', $tweet->retweet_id) : route('retweet', $tweet->retweet_id)  }}"
                                       class="retweet {{ $tweet::alreadyRetweeted(auth()->user()->id, $tweet->retweet_id) ? 'active' : ''}}">
                                        <i class="retweet icon"></i> {{ TweetUser::getRetweetCount($tweet->retweet_id) }}
                                    </a>
                                @else
                                    <a @if (Auth::check()) href="{{ $tweet::alreadyRetweeted(auth()->user()->id, $tweet->id) ?
                                    route('retweet_undo', $tweet->id) : route('retweet', $tweet->id) }} @endif"
                                       class="retweet @if (Auth::check()) {{ $tweet::alreadyRetweeted(auth()->user()->id, $tweet->id) ? 'active' : ''}} @endif">
                                        <i class="retweet icon"></i> {{ TweetUser::getRetweetCount($tweet->id) }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@stop
