<form method="POST" action="{{ route('create_tweet') }}" class="ui form" enctype="multipart/form-data">
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
        <div class="ui small basic icon buttons">
            <label for="tweet_picture" class="ui button"><i class="file image icon"></i></label>
        </div>
        <input name="img_path" id="tweet_picture" type="file" style="display: none" accept="image/*"/>
    </div>
</form>

