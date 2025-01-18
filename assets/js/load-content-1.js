const testimonials = jQuery('#testimonials');

function icodaLoadTestimonials() {
    $.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        data: {
            'action': 'load_front_page_part',
            'part': 'testimonials',
            'post_id': testimonials.data('postId'),
            'lang': icoda_main_params.current_language
        },
        success: function (result) {
            testimonials.append(result.data);
            jQuery(".slider-default").slick({
                lazyLoad: "ondemand",
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: true,
                dots: true,
                infinite: true,
                speed: 500,
                cssEase: "linear",
                appendArrows: jQuery(".wr-control-testimonials"),
                variableWidth: true,
                rtl: $('body').hasClass('rtl') ? true : false,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            adaptiveHeight: true,
                            slidesToShow: 2,
                        },
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            dots: false,
                        },
                    },
                ],
            });
        }
    });
}

jQuery(document.body).on('icoda-load-testimonials', icodaLoadTestimonials);

setTimeout(function () {
    if (testimonials.length && testimonials.data('needLoad')) {
        jQuery(document.body).trigger('icoda-load-testimonials');
    }
}, 700);
