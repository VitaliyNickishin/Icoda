
setTimeout(function () {
    const forWhom = $('#for-whom');

    if (forWhom.length && forWhom.data('needLoad')) {
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                'action': 'load_front_page_part',
                'part': 'for-whom',
                'post_id': forWhom.data('postId'),
                'lang': icoda_main_params.current_language
            },
            success: function (result) {
                forWhom.append(result.data);
                if (jQuery(".label-slider").length > 0) {
                    $(".label-slider").slick({
                        variableWidth: true,
                        responsive: [
                            {
                                breakpoint: 991,
                                settings: {
                                    slidesToShow: 6,
                                    slidesToScroll: 2,
                                },
                            },
                        ],
                    });
                }
            }
        });
    }
}, 500);

