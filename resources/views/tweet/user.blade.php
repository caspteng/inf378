@extends('layouts.auth')
@section('content')


    <h1 class="ui header">Tweet de </h1>
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

                    <div class="right aligned"> {{ $userTweet->user['username'] }} </div>


                </td>
            </tr>
            </tbody>

        </table>

    @endforeach
@stop
