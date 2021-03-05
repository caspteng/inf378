<form class="ui edit modal" method="POST" action="{{ $user->path() }}">
    @csrf
    @method('PATCH')

    <div class="header">Éditer le profil
        <button class="ui right floated positive button" type="submit">
            <i class="save icon"></i>Enregistrer
        </button>
    </div>
    <div class="scrolling content">
        <div class="dimmable ui centered small circular image edit_picture">
            <a href="#" class="ui dimmer">
                <i class="camera inverted big retro icon"></i>
            </a>
            <img src="{{ $user->avatar }}" alt="">
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

    $('.ui.circular.image.edit_picture').dimmer({
        on: 'hover'
    });
</script>
