@extends('layouts.auth')
@section('content')
    <h1>{{ $errors }}</h1>
    <form method="POST" action="{{ route('login') }}" class="ui form">
        @csrf
        <div class="ui placeholder segment">
            <div class="ui two column very relaxed grid">
                <div class="column">
                    <div class="ui form">
                        <div class="field">
                            <label for="email">Email</label>
                            <div class="ui left icon input">
                                <input id="email" type="email" placeholder="votre@email.com">
                                <i class="user icon"></i>
                            </div>
                        </div>
                        <div class="field">
                            <label for="password">Mot de passe</label>
                            <div class="ui left icon input">
                                <input id="password" type="password" placeholder="Mot de passe">
                                <i class="lock icon"></i>
                            </div>
                        </div>
                        <button class="ui blue submit button" type="submit">Login</button>
                    </div>
                </div>
                <div class="middle aligned column">
                    <a href="{{ route('register') }}" class="ui big button">
                        <i class="signup icon"></i>
                        Sign Up
                    </a>
                </div>
            </div>
            <div class="ui vertical divider">
                Or
            </div>
        </div>
    </form>

@stop
