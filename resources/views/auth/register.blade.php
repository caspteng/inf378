@extends('layouts.auth')
@section('content')

    <div class="ui attached message">
        <div class="header">
            {{__('web.welcome', ['appName' => config('app.name')])}}
        </div>
        <p>{{__('web.register_desc')}}</p>
    </div>
    <form method="POST" action="{{ route('register') }}" class="ui form attached fluid segment">
        @csrf
        <div class="field">
            <label for="surname">Nom</label>
            <input id="surname" type="text" name="surname" placeholder="Prénom Nom" value="{{ old('surname') }}">
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="franck@epitech.eu" value="{{ old('email') }}">
        </div>
        <div class="field">
            <label for="birthday">Date de naissance</label>
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input id="birthday" name="birthday" type="date" value="{{ old('birthday') }}">
                </div>
        </div>
        <div class="two fields">
            <div class="field">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" placeholder="Mot de passe">
            </div>
            <div class="field">
                <label for="password_confirmation">Retape ton mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation">
            </div>
        </div>
        <button class="ui button" type="submit">Submit</button>
        <div class="ui error message"></div>
        @if ($errors->has('email'))
            <div class="ui negative message">
                <ul class="list">
                    <li>{{ $errors->first('email') }}</li>
                </ul>
            </div>
        @endif
    </form>
    <div class="ui bottom attached warning message">
        <i class="icon help"></i>
        Already signed up? <a href="#">Login here</a> instead.
    </div>
    <script>
        $('.ui.form')
            .form({
                on: 'blur',
                fields: {
                    name: {
                        identifier: 'surname',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Un nom est requis',
                            },
                            {
                                type: 'minLength[3]',
                                prompt: 'Votre nom doit contenir au minimum {ruleValue} caractères',
                            }
                        ],
                    },
                    email: {
                        identifier: 'email',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Une adresse email est requis',
                            },
                        ]
                    },
                    birthdate: {
                        identifier: 'birthday',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Merci d\'indiquer votre date de naissance',
                            }
                        ]
                    },
                    password: {
                        identifier: 'password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Un mot de passe est requis pour créer un compte.',
                            },
                            {
                                type: 'minLength[8]',
                                prompt: 'Votre mot de passe doit contenir au minimum {ruleValue} caractères',
                            },
                            {
                                type: 'match[password]',
                                prompt: 'Les mots de passe ne correspondent pas.'
                            }
                        ]
                    },
                    match: {
                        identifier: 'password_confirmation',
                        rules: [
                            {
                                type: 'match[password]',
                                prompt: 'Les mots de passe ne correspondent pas.'
                            }
                        ]
                    },
                }
            })
        ;

    </script>
@stop
