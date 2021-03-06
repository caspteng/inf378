@extends('layouts.app')
@section('content')

    <div class="ui grid">
        <div class="two wide column">

        </div>

        <div class="eleven wide column">

            <br/>
            @include('includes.timeline', ['tweets' => $latest_tweets])
        </div>
    </div>
    <x-modal-tweet-remove/>
@stop
