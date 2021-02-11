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

    @endforeach
@stop
