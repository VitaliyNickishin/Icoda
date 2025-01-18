
setTimeout(function () {
    const cases = $('#cases');

    if (cases.length && cases.data('needLoad')) {
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                'action': 'load_front_page_part',
                'part': 'cases',
                'post_id': cases.data('postId'),
                'lang': icoda_main_params.current_language
            },
            success: function (result) {
                cases.append(result.data);
                jQuery(".cases-slider").slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    appendArrows: jQuery(".wr-control-cases"),
                    speed: 500,
                    responsive: [
                        {
                            breakpoint: 1100,
                            settings: {
                                adaptiveHeight: false,
                                slidesToShow: 2,
                                centerMode: true,
                                centerPadding: "40px",
                            },
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                adaptiveHeight: false,
                                slidesToShow: 1,
                                centerMode: true,
                                centerPadding: "40px",
                            },
                        },
                    ],
                });

            }
        });
    }
}, 600);

