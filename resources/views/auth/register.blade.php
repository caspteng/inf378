@extends('layouts.auth')
@section('content')

    <h1>{{ $errors }}</h1>
    <div class="ui attached message">
        <div class="header">
            Welcome to our site!
        </div>
        <p>Fill out the form below to sign-up for a new account</p>
    </div>
    <form method="POST" action="{{ route('register') }}" class="ui form attached fluid segment">
        @csrf
            <div class="field">
                <label for="surname">Nom</label>
                <input id="surname" type="text" name="surname" placeholder="Prénom Nom" required>
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
    <div class="ui bottom attached warning message">
        <i class="icon help"></i>
        Already signed up? <a href="#">Login here</a> instead.
    </div>

@stop
