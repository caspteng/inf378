{{-- You can change this template using File > Settings > Editor > File and Code Templates > Code > Laravel Ideal View --}}
@extends('layouts.auth')
@section('content')


    <h1>Liste des tweet</h1>
    @foreach($tweets as $tweet)


    <table class="ui celled padded table">
        <thead>
            <tr>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>

                    {{ $tweet->message }}

                 <div class="right aligned"> {{ $tweet->user['username'] }} </div>


                </td>
            </tr>
        </tbody>

    </table>

    @endforeach
@stop
@extends('layouts.auth')
@section('content')


    <h1>Liste des tweet</h1>
    @foreach($tweets as $tweet)


    <table class="ui celled padded table">
        <thead>
            <tr>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>

                    {{ $tweet->message }}

                 <div class="right aligned"> {{ $tweet->user['username'] }} </div>


                </td>
            </tr>
        </tbody>

    </table>

    @endforeach
@stop
