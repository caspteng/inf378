<div class="ui tiny basic modal avatar">
    <div class="ui big rounded centered image">
        <img src="{{ $user->avatar }}" width="500" height="500" alt="">
    </div>
</div>

<script>
    $('.display-avatar').dimmer({
        on: 'hover'
    })
        .click(function () {
            $('.ui.tiny.basic.modal.avatar').modal({
                blurring: true
            }).modal('show');
        })
</script>
