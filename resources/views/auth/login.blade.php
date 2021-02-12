@extends('layouts.auth')
@section('content')
    <form method="POST" action="{{ route('login') }}" class="ui form">
        @csrf
        <div class="ui placeholder segment">
            <div class="ui two column very relaxed grid">
                <div class="column">
                    <div class="ui form">
                        <div class="field">
                            <label for="login">Nom d'utilisateur ou email</label>
                            <div class="ui left icon input">
                                <input id="login" name="login" type="text" placeholder="Nom d'utilisateur ou email">
                                <i class="user icon"></i>
                            </div>
                        </div>
                        <div class="field">
                            <label for="password">Mot de passe</label>
                            <div class="ui left icon input">
                                <input id="password" name="password" type="password" placeholder="Mot de passe">
                                <i class="lock icon"></i>
                            </div>
                        </div>
                        <button class="ui blue submit button" type="submit">Login</button>
                        <div class="ui error message"></div>
                        @if ($errors->has('login'))
                        <div class="ui negative message">
                            <ul class="list">
                                <li>{{ $errors->first()  }}</li>
                            </ul>
                        </div>
                        @endif
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
<script>
    $('.form')
        .form({
            on: 'blur',
            fields: {
                login: {
                    identifier: 'login',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Merci d\'indiquer votre nom d\'utilisateur ou email'
                        }
                    ]
                },
                password: {
                    identifier: 'password',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Le champ mot de passe est requis'
                        }
                    ]
                },
            }
        })
    ;
</script>
@stop
