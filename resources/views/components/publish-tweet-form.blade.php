<form method="POST" action="{{ route('create_tweet') }}" class="ui form">
    @csrf
    <div class="ui form clearing segment">
        <div class="ui field aligned ">
                <textarea rows="2" placeholder="Quoi de neuf ?"
                          name="message"></textarea>
        </div>
        @if ($errors->has('message'))
            <div class="ui pointing red basic label">
                    {{ $errors->first()  }}
            </div>
        @endif
            <button class="ui right floated twitter button" type="submit">Tweeter</button>
        </div>
</form>
