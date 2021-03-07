@extends('layouts.app')
@section('content')

    <div class="ui grid">
        <div class="two wide column">

        </div>

        <div class="eleven wide column">
            <h2 class="ui header blue">Quoi de neuf en ce moment ?</h2>
            <br/>
            @include('includes.timeline', ['tweets' => $latest_tweets])
        </div>
    </div>
    <x-modal-tweet-remove/>
@stop
