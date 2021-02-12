@extends('layouts.auth')
@section('content')


<h1 class="ui header center aligned">Tweets de {{$user->username}} </h1>
    @foreach($userTweets as $userTweet)


        <table class="ui celled padded table">
            <thead>
            <tr>
                <th>Message</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>

                    {{ $userTweet->message }}

                    <div class="right aligned"> {{ TweetUser::getUsername($userTweet->user_id) }} </div>


                </td>
            </tr>
            </tbody>

        </table>

    @endforeach
@stop
