jQuery(document).ready(function ($) {

    $('#faq-search-field').keydown(function (eventObject) {
        var searchTerm = $(this).val();
        if (searchTerm.length >= 1) {
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: {
                    'action': 'faq_ajax_search',
                    'term': searchTerm
                },
                success: function (result) {
                    $('.codyshop-ajax-search').fadeIn().html(result);
                }
            });
        }
    });


    $('#post-date-filter button').click(function (eventObject) {
        eventObject.preventDefault();
        var searchTerm = $('#faq-search-field').val();
        if (searchTerm.length >= 1) {
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: {
                    'action': 'faq_ajax_search',
                    'term': searchTerm
                },
                success: function (result) {
                    $('.codyshop-ajax-search').fadeIn().html(result);
                }
            });
        }
    });

    $('body').on('click', '.headline', function() {
        const $box = $(this).closest('[data-item]');
        $box.siblings().find('[data-content]').stop().slideUp();
        $box.find('[data-content]').stop().slideToggle();
    });

});