@extends('layouts.auth')
@section('content')


    <form method="POST" action="{{ route('tweetForm') }}" class="ui form">
        @csrf
        <div class="ui form">

            <div class="ui grid center aligned">
                <div class="eight wide column ">
                    <label class="two column row ">Veuillez entrer votre tweet</label>

                    <textarea rows="5" placeholder="Entrez votre tweet d'un maximum de 140 caractères"
                        name="message"></textarea>
                    </div>
                </div>
            </div>
                    <div class="ui grid center aligned">
            <div class="eight wide column ">
                <button class="ui button two column row " type="submit">Envoyer</button>
                @if ($errors->has('message'))
                <div class="ui negative message">
                    <ul class="list">
                        <li>{{ $errors->first()  }}</li>
                    </ul>
                </div>
                @endif
                </div>
                </div>
                </div>

                </div>

                </div>
            </div>
        </div>
   
    </form>
@stop