function getFileForm() {
    jQuery('.get-file-btn').on('click', function () {
        const $btn = jQuery('.get-file-btn');
        $btn.css('pointer-events', 'none');
        $btn.css('opacity', '0.8');
        jQuery.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "POST",
            data: {
                action: "get_file_from_block",
                email: jQuery('#get-file-form').find('input[name="email"]').val()
            },
            success: function (result) {
                jQuery("body").find(".success-get-file").css("opacity", "1").fadeIn(500);
                $btn.css('pointer-events', 'unset');
                $btn.css('opacity', '1');
            },
        });
    });
}

getFileForm();
