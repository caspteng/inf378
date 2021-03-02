@props(['tweetid'])

<div class="ui mini modal">
    <i class="close icon"></i>
    <div class="header">
        Supprimer le tweet
    </div>
    <div class="content">
        <p>Êtes-vous sûr de vouloir supprimer ce tweet ?</p>
    </div>
    <div class="actions">
        <div class="ui negative button">
            Non
        </div>
        <a id="confirm-button" href="#" class="ui positive right labeled icon button">
            Oui
            <i class="checkmark icon"></i>
        </a>
    </div>
</div>
