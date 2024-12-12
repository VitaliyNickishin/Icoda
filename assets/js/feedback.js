(function ($) {
    'use strict';


    $(document).on('submit', '.feedback-form', function (event) {
        event.preventDefault();
        // validation process
        var $form = $(this)
        let $btn = $(this).find('button[type="submit"]');

        $btn.prop('disabled', true);
        var tmpFormButtonText = $btn.text();
        $btn.text(IcodaFeedback.sending);

        $.ajax({
            url: IcodaFeedback.rest_root,
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', IcodaFeedback.nonce);
            },
            success: function (response) {
                if (response) {
                    if (response.success) {
                        show_thanks_popup($form);
                        $form[0].reset();
                    } else {
                        show_error_message($form, response.message);
                    }
                } else {
                    show_error_message($form);
                }
            },
            error: function (error) {
                show_error_message($form);
            },
            complete: function () {
                $btn.text(tmpFormButtonText);
                $btn.prop('disabled', false);
                $btn.removeClass('disabled');
            }
        });
        return true;
    });

    function show_error_message($form, message = '') {
        if (!message) {
            message = IcodaFeedback.error;
        }
        $form.append(`<div class="error-row" style="color:red;">${message}</div>`);
        setTimeout(function () {
            $form.find('.error-row').remove();
        }, 3000);
    }

    function show_thanks_popup(form) {
        setTimeout(function () {
            $(".modal-box")
                .animate({ opacity: 0, top: "45%" }, 200)
                .css("display", "none");
            $("body").find(".success").css("opacity", "1").fadeIn(500);
        }, 200);
    }

})(jQuery);