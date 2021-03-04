@extends('layouts.app')
@section('content')

    <div class="ui grid">
        <div class="four wide column">

        </div>

        <div class="nine wide column">
            <x-publish-tweet-form/>
            <br/>
            @include('_timeline', ['tweets' => $user->feed()])
        </div>
    </div>
    <x-right-content/>
    <x-modal-tweet-remove/>
@stop
