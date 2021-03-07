@extends('layouts.app')
@section('content')

    <div class="ui grid">
        <div class="two wide column">

        </div>

        <div class="eleven wide column">
            <div class="ui attached message">
                <div class="ui header"> Paramètre de compte</div>
            </div>
            <form class="ui form attached clearing segment" method="POST" action="{{ route('settings') }}">
                @csrf
                @method('PATCH')
                <div class="required field @error('email') error @enderror">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email"
                           placeholder="Email"
                           value="{{ $user->email }}">
                </div>
                <div class="required field @error('username') error @enderror">
                    <label for="username">Nom d'utilisateur</label>
                    <div class="ui labeled input" data-children-count="1">
                        <div class="ui label">
                            @
                        </div>
                        <input id="username" name="username" type="text"
                               placeholder="Nom d'utilisateur"
                               value="{{ $user->username }}">
                    </div>
                </div>
                <div class="required field @error('current_password') error @enderror">
                    <label for="current_password">Mot de passe actuel</label>
                    <input id="current_password" name="current_password" type="password"
                           placeholder="Mot de passe actuel">
                </div>
                <div class="ui tertiary inverted segment">
                    <div class="ui header">Changer son mot de passe ?</div>
                    <div class="two fields">
                        <div class="field">
                            <label for="password">Nouveau mot de passe</label>
                            <input id="password" type="password" name="password" placeholder="Nouveau mot de passe">
                        </div>
                        <div class="field">
                            <label for="password_confirmation">Confirmer le mot de passe</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                   placeholder="Confirmer le mot de passe">
                        </div>
                    </div>
                </div>
                <div class="ui error message"></div>
                <button class="ui button primary right floated" type="submit">Confirmer</button>
            </form>
        </div>
    </div>

    <script>
        $('.ui.form')
            .form({
                on: 'blur',
                fields: {
                    username: {
                        identifier: 'username',
                        rules: [
                            {
                                type: 'minLength[5]',
                                prompt: 'Ton nom d\'utilisateur doit contenir au minimum {ruleValue} caractères.',
                            }
                        ],
                    },
                    current_password: {
                        identifier: 'current_password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Tu dois taper ton mot de passe pour modifier ton compte.',
                            }
                        ],
                    },
                    email: {
                        identifier: 'email',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Une adresse email est requise.',
                            },
                        ]
                    },
                    match: {
                        identifier: 'password_confirmation',
                        rules: [
                            {
                                type: 'match[password]',
                                prompt: 'Les mots de passe ne correspondent pas..'
                            }
                        ]
                    },
                }
            })
        ;

    </script>
@stop|
