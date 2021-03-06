@extends('layouts.app')
@section('content')

    <div class="ui grid">
        <div class="two wide column">

        </div>

        <div class="eleven wide column">
            <x-publish-tweet-form/>
            <br/>
            @include('includes.timeline', ['tweets' => $user->feed()])
        </div>
    </div>
    <x-modal-tweet-remove/>
@stop
