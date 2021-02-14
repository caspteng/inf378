jQuery(document).ready(function () {

    /* Define API endpoints once globally */
    $.fn.api.settings.api = {
        'follow user': '/follow/{id}',
        'unfollow user': '/unfollow/{id}',
    };

    $.fn.api.settings.successTest = function (response) {
        if (response && response.success) {
            return response.success;
        }
        return false;
    };

    $('.follow.button').click(function () {
        if ($(this).attr('data-following') === 'false') {
            $(this).api({
                action: 'follow user',
                on: 'now',
                onSuccess: function (response, element, xhr) {
                    $(this).attr('data-following', 'true');
                    $(this).text('Abonné');
                    $(this).removeClass("negative").addClass("primary");
                },
                onFailure: function (response, element, xhr) {
                    $(this).text('Erreur!');
                },
            })
        } else if ($(this).attr('data-following') === 'true') {
            $(this).api({
                action: 'unfollow user',
                on: 'now',
                onSuccess: function (response, element, xhr) {
                    $(this).attr('data-following', 'false');
                    $(this).text('Désabonné');
                    $(this).removeClass("primary").addClass("negative");
                },
                onFailure: function (response, element, xhr) {
                    $(this).text('Erreur!');
                },
            })
        }
    })


});


