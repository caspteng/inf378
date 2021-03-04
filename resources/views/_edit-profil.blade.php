{{-- You can change this template using File > Settings > Editor > File and Code Templates > Code > Laravel Ideal View --}}
<div class="ui edit modal">
    <div class="header">Éditer le profil
        <button class="ui right floated positive button" type="submit">
            <i class="save icon"></i>Enregistrer
        </button>
    </div>

    <div class="scrolling content">
                <div class="blurring dimmable ui centered small circular image edit_picture">
            <a href="#" class="ui dimmer">
                <i class="camera inverted big retro icon"></i>
            </a>
        <img src="{{ $user->avatar }}" alt="">
        </div>
        <div class="ui form">
            <div class="field">
                <label>Nom</label>
                <input type="text" name="first-name" placeholder="Nom">
            </div>
            <div class="field">
                <label>Biographie</label>
                <textarea rows="2"></textarea>
            </div>

        </div>

    </div>
</div>
    <script>
        $('.button.edit_profil').click(function(){
                $('.ui.edit.modal')
                    .modal('show')
                ;
            }
        );

        $('.ui.circular.image.edit_picture').dimmer({
            on: 'hover'
        });
    </script>
