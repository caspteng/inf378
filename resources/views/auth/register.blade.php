@extends('layouts.auth')
@section('content')

    <h1>{{ $errors }}</h1>
    <form method="POST" action="{{ route('register') }}" class="ui form">
        @csrf

        <div class="field">
            <label for="username">Nom</label>
            <input id="username" type="text" name="username" placeholder="Prénom Nom" required>
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="joe@schmoe.com" required>
        </div>
        <div class="field">
            <label for="birthday">Date de naissance</label>
            <input id="birthday" type="date" name="birthday" required>
        </div>
        <div class="two fields">
        <div class="field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Your Zboub Password" required>
        </div>
        <div class="field">
            <label for="password_confirmation">Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>
        </div>
        <button class="ui button" type="submit">Submit</button>
    </form>

@stop
