jQuery(document).ready(function () {

    /* Define API endpoints once globally */
    $.fn.api.settings.api = {
        'follow user': '/follow/{id}',
        'unfollow user': '/unfollow/{id}',
        'like tweet': '/like/{id}',
        'retweet': '/retweet/{id}',
        'undo retweet': '/retweet/{id}/undo',
    };

    $.fn.api.settings.successTest = function (response) {
        if (response && response.success) {
            return response.success;
        }
        return false;
    };

    const TweetAcademy = $('body');

    TweetAcademy.on('click', '.follow.button', function () {
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
    TweetAcademy.on('click', 'a.like', function () {
        if ($(this).attr('data-liking') === 'false') {
            $(this).api({
                action: 'like tweet',
                on: 'now',
                onSuccess: function (response, element, xhr) {
                    $(this).attr('data-liking', 'true');
                    $(this).addClass("active");

                },
                onFailure: function (response, element, xhr) {
                    $(this).toast({
                        class: 'error',
                        message: response.error
                    })
                },
            })
        } else if ($(this).attr('data-liking') === 'true') {
            $(this).api({
                action: 'like tweet',
                on: 'now',
                onSuccess: function (response, element, xhr) {
                    $(this).attr('data-liking', 'false');
                    $(this).removeClass("active");
                },
                onFailure: function (response, element, xhr) {
                    $(this).toast({
                        class: 'error',
                        message: response
                    })
                },
            })
        }
    })

    TweetAcademy.on('click', '.tw-delete', function () {
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
                linkifyTweet();
            }
        });
    });


    TweetAcademy.on('mouseenter', '.user-popup', function () {
        $(this).popup('show')
    });
    TweetAcademy.on('mouseleave', '.user-popup', function () {
        $(this).popup('hidden')
    });

});


$(window).on('load', function () {
    linkifyTweet()
});


function linkifyTweet() {
    $('p').linkify({
        target: "_blank"
    })
}
