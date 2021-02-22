@extends('layouts.auth')
@section('content')


    <h1 class="ui header">Liste des tweet</h1>

    @foreach ($allTweets as $allTweet)


        <table class="ui celled padded table">
            <thead>
            <tr>
                <th>Message</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>

                    {{ $allTweet->message }}

                    <div class="right aligned"> {{ '@' . $allTweet->user['username'] }} </div>

                </td>
            </tr>

            </tbody>

        </table>
        @if (Auth::check())

        <div class="ui labeled button" tabindex="0">
            <a href="{{ route('like', $allTweet->id) }}" class="ui red button">
                <i class="heart icon"></i> Like
            </a>
            <a class="ui basic red left pointing label">
                {{ TweetUser::getLikeCount($allTweet->id) }}
            </a>
        </div>
        @endif
    @endforeach
@stop
