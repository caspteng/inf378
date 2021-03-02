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

            <x-flash-message/>
            @if ($is_profile_owner)
                <x-publish-tweet-form/>
            @endif

            @foreach($user->timeline() as $tweet)
                <div class="ui large feed raised segment">
                    @if ($tweet->is_retweet)
                        <div class="ui top left attached label">
                            <i class="retweet icon"></i> {{ $is_profile_owner ? 'Vous avez retweeté' : $tweet->user->surname . ' a retweeté'}}
                        </div>
                    @endif
                    <div class="event">
                        <div class="label">
                            <div class="image">
                                <img
                                    alt="{{ $tweet->is_retweet ? $tweet->retweet->user->surname :$tweet->user->surname }}"
                                    src="{{ $tweet->is_retweet ? $tweet->retweet->user->avatar_picture ??
                                    '//eu.ui-avatars.com/api/?size=290&&color=ffffff&background=555b6e&name='
                                            . $tweet->retweet->user->surname . '&format=svg' :
                                        $tweet->user->avatar_picture ??
                                    '//eu.ui-avatars.com/api/?size=290&&color=ffffff&background=555b6e&name='
                                            . $tweet->user->surname . '&format=svg'
                              }}">
                            </div>
                        </div>
                        <div class="content">
                            <div class="summary">
                                <a href="{{ $tweet->is_retweet ? url($tweet->retweet->user->username) : url($tweet->user->username)}}">
                                    {{ $tweet->is_retweet ? $tweet->retweet->user->surname : $tweet->user->surname}}</a>
                                {{ $tweet->is_retweet ? '@' . $tweet->retweet->user->username : '@' . $tweet->user->username}}
                                <div class="date">
                                    {{ $tweet->is_retweet ? $tweet->retweet->created_at->format('d/m/Y') :
                                       $tweet->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                            <div class="extra text">
                                {{ $tweet->is_retweet ? $tweet->retweet->message : $tweet->message }}
                            </div>
                            <div class="meta">
                                <a href="{{ route('like', $tweet->is_retweet ? $tweet->retweet_id : $tweet->id) }}"
                                   class="like @if (Auth::check()) {{ auth()->user()->isLiking($tweet->is_retweet ? $tweet->retweet : $tweet) ? 'active' : ''}} @endif">
                                    <i class="like icon"></i>
                                    {{ TweetUser::getLikeCount($tweet->is_retweet ? $tweet->retweet_id : $tweet->id) }}
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
                                @if (Auth::check())
                                    @if ($tweet->user_id == auth()->user()->id && $tweet->is_retweet == false)
                                        <a href="#" class="tw-delete" data-id="{{ $tweet->id }}">
                                            <i class="remove icon"></i>
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <x-modal-tweet-remove/>
        <script>
            $('.tw-delete').click(function () {
                let confirmBtnEle = $("#confirm-button");
                let tweetID = $(this).data('id');
                confirmBtnEle.attr('href', 'tweet/' + tweetID + '/destroy');
                $('.mini.modal').modal('show');
            });
        </script>
@stop
