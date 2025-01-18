
setTimeout(function () {
    const homeBrands = $('#home-brands');

    if (homeBrands.length && homeBrands.data('needLoad')) {
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                'action': 'load_front_page_part',
                'part': 'home-brands',
                'post_id': homeBrands.data('postId'),
                'lang': icoda_main_params.current_language

            },
            success: function (result) {
                homeBrands.append(result.data);
                $(".project-card-slider").slick({
                    variableWidth: true,
                    responsive: [
                        {
                            breakpoint: 991,
                            settings: {
                                rows: 3,
                                slidesToShow: 3,
                                slidesToScroll: 1,
                            },
                        },
                    ],
                });
            }
        });
    }
}, 800);

