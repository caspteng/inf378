<form class="ui edit modal" method="POST" action="{{ $user->path() }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="header">Éditer le profil
        <button class="ui right floated positive button" type="submit">
            <i class="save icon"></i>Enregistrer
        </button>
    </div>
    <div class="scrolling content">
        <div class="dimmable ui centered small circular image avatar-upload">
            <label for="avatar_picture" class="ui dimmer avatar-upload">
                <i class="camera inverted big retro icon"></i>
            </label>
            <img id="avatar-preview" src="{{ $user->avatar }}" alt="">
            <input name="avatar_picture" id="avatar_picture" type="file" style="display: none" accept="image/*"/>
        </div>
        <div class="ui form">
            <div class="field">
                <label>Nom</label>
                <input type="text" name="surname" placeholder="Nom" value="{{ $user->surname }}">
            </div>
            <div class="field">
                <label>Biographie</label>
                <textarea name="biography" rows="2">{{ $user->biography }}</textarea>
            </div>

        </div>

    </div>
</form>

<script>
    $('.button.edit_profil').click(function () {
            $('.ui.edit.modal')
                .modal('show')
            ;
        }
    );

    $('.ui.circular.image.avatar-upload').dimmer({
        on: 'hover'
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                $('#avatar-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#avatar_picture").change(function () {
        readURL(this);
    });
</script>
