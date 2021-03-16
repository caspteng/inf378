<form method="POST" action="{{ route('create_tweet') }}" class="ui form" enctype="multipart/form-data">
    @csrf
    <div class="ui form clearing segment">
        <div class="ui field aligned ">
                <textarea id="tweet-textarea" rows="2" placeholder="Quoi de neuf ?"
                          name="message">{{ old('message') }}</textarea>
        </div>
        <button class="ui right floated twitter button" id="send-tweet" type="submit">Tweeter</button>
        <div class="ui small basic icon buttons">
            <label for="tweet_picture" class="ui button picture-btn"><i class="file image icon"></i></label>
        </div>
        <input name="img_path" id="tweet_picture" type="file" style="display: none" accept="image/*"/>
        <img id="img-preview" class="hidden ui image" src="{{ asset('assets/images/wireframe/image.png') }}">
        @if ($errors->has('message'))
            <div class="ui pointing red basic label">
                {{ $errors->first()  }}
            </div>
        @endif
    </div>
</form>

<script>
    function pictureReadURL(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                $('#img-preview').attr('src', e.target.result).addClass('mini right spaced rounded');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#tweet_picture").change(function () {
        pictureReadURL(this);
    });

    $(document).ready(function () {
        //const $text = $('text[type="text"]');
        const $textarea = $('#tweet-textarea');
        const $submit = $('#send-tweet');

        // Set the onkeyup events
        $submit.prop('disabled', true);
        //$text.on('keyup', checkStatus);
        $textarea.on('keyup', checkStatus);

        // Set the event handler
        function checkStatus() {
            const status = ($.trim($textarea.val()) === '');
            $submit.prop('disabled', status);
        }
    });
</script>

