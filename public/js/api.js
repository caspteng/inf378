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

    $('.tw-delete').click(function () {
        let confirmBtnEle = $("#confirm-button");
        let tweetID = $(this).data('id');
        confirmBtnEle.attr('href', 'tweet/' + tweetID + '/destroy');
        $('.mini.modal').modal('show');
    });


    $('ul.pagination').hide();
    $(function () {
        $('.scrolling-pagination').jscroll({
            loadingHtml: '<div class="ui large feed raised segment">\n' +
                '  <div class="ui active inverted dimmer">\n' +
                '    <div class="ui text loader">Chargement</div>\n' +
                '  </div>\n' +
                '  <img class="ui wireframe image" src="../assets/images/wireframe/short-paragraph.png">\n' +
                '</div>',
            autoTrigger: true,
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.scrolling-pagination',
            callback: function () {
                $('ul.pagination').remove();
            }
        });
    });

    const userPopup = $('.user-popup');
    $(userPopup).mouseenter(function () {
        $(this).popup('show')
    });
    $(userPopup).mouseleave(function () {
        $(this).popup('hidden')
    });

});


