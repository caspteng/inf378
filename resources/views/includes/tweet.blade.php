<div class="ui large feed raised segment">
    @if ($tweet->is_retweet)
        <div class="ui top left attached label">
            <i class="retweet icon"></i> {{ $is_profile_owner ?? $tweet->user->id == $user->id ? 'Vous avez retweeté' : $tweet->user->surname . ' a retweeté'}}
        </div>
    @endif
    <div class="event">
        <div class="label">
            <div class="image">
                <img
                    alt="{{ $tweet->is_retweet ? $tweet->retweet->user->surname : $tweet->user->surname }}"
                    src="{{ $tweet->is_retweet ? $tweet->retweet->user->avatar : $tweet->user->avatar }}">
            </div>
        </div>
        <div class="content">
            <div class="summary">
                <a class="user-popup"
                   data-html="{{ $tweet->is_retweet ? $tweet->retweet->user->profil_widget : $tweet->user->profil_widget }}"
                   href="{{ $tweet->is_retweet ? route('profile', $tweet->retweet->user) : route('profile', $tweet->user)}}">
                    {{ $tweet->is_retweet ? $tweet->retweet->user->surname : $tweet->user->surname}}</a>
                {{ $tweet->is_retweet ? '@' . $tweet->retweet->user->username : '@' . $tweet->user->username}}
                <div class="date">
                    {{ $tweet->is_retweet ? $tweet->retweet->created_at->format('d/m/Y') :
                       $tweet->created_at->format('d/m/Y') }}
                </div>
            </div>
            <div class="extra text">
                <p>{{ $tweet->is_retweet ? $tweet->retweet->message : $tweet->message }}</p>
                @if ($tweet->hasImage() || $tweet->retweet && $tweet->retweet->hasImage())
                    <img class="ui rounded centered massive image"
                         src="{{ $tweet->is_retweet ? $tweet->retweet->image : $tweet->image }}" alt="">
                @endif
            </div>
            <div class="meta">
                <a href="{{ route('like', $tweet->is_retweet ? $tweet->retweet_id : $tweet->id) }}"
                   class="like @auth {{ auth()->user()->isLiking($tweet->is_retweet ? $tweet->retweet : $tweet) ? 'active' : ''}} @endauth">
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
                    <a @auth href="{{ $tweet::alreadyRetweeted(auth()->user()->id, $tweet->id) ?
                                    route('retweet_undo', $tweet->id) : route('retweet', $tweet->id) }} @endauth"
                       class="retweet @auth {{ $tweet::alreadyRetweeted(auth()->user()->id, $tweet->id) ? 'active' : ''}} @endauth">
                        <i class="retweet icon"></i> {{ TweetUser::getRetweetCount($tweet->is_retweet ? $tweet->retweet->id : $tweet->id) }}
                    </a>
                @endif
                @auth
                    @if ($tweet->user_id == auth()->user()->id && $tweet->is_retweet == false)
                        <a href="#" class="tw-delete" data-id="{{ $tweet->id }}">
                            <i class="remove icon"></i>
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
