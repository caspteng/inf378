@extends('layouts.app')
@section('content')

    <div class="ui attached message">
        <div class="header">
            <img class="ui avatar image" src="{{ $user->avatar }}">
            {{ $user->surname }}
        </div>
        <p>{{ TweetUser::getUsername($user->id) }}</p>
    </div>
    <form class="ui form  attached clearing segment" method="POST" action="{{ route('messages', $user->id) }}">
        @csrf
        <div class="" style="overflow-y: scroll; height: 500px">
            @foreach ($messages as $message)
                <div class="ui field" style="@if ($message->sender->id == auth()->user()->id)
                    text-align: right;@endif">
                    <p><b><span>{{ $message->sender->surname }} </span></b>
                        <span style="color: grey">le {{ $message->created_at->format('d/m/Y H:i') }} : </span>
                    </p>
                    <p>{{ $message->message }}</p>
                </div>
                <br>
            @endforeach
        </div>
        <div class="field">
            <label for="message"></label>
            <textarea rows="2" id="message" placeholder="Écrivez votre message..." name="message"></textarea>
        </div>
        <button class="ui primary button">Envoyer</button>
    </form>
@stop
