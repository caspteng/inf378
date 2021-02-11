@extends('layouts.auth')
@section('content')
    <h1>{{ $errors }}</h1>
        <form method="POST" action="{{ route('login') }}" class="ui form">
         @csrf
        <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="Zboub mail">
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Your Zboub Password">
        </div>
        <button class="ui button" type="submit">Submit</button>
    </form>

@stop
