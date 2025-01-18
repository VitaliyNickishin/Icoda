
setTimeout(function () {
    const leadership = $('#leadership');

    if (leadership.length && leadership.data('needLoad')) {
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                'action': 'load_front_page_part',
                'part': 'leadership',
                'post_id': leadership.data('postId'),
                'lang': icoda_main_params.current_language
            },
            success: function (result) {
                leadership.append(result.data);
                if (jQuery('.leadership-slider').length > 0) {

                    $(".leadership-slider").slick({
                        variableWidth: true,
                        responsive: [
                            {
                                breakpoint: 991,
                                settings: {
                                    appendArrows: jQuery(".wr-control-leadership"),
                                    slidesToShow: 3,
                                    slidesToScroll: 1,
                                },
                            },
                        ],
                    });
                }
            }
        });
    }
}, 550);

