jQuery(document).ready(function ($) {

    jQuery('[data-get-book]').on('click', function () {
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                'action': 'getXMoneySignatures',
                'email': 'test@test.com',
            },
            success: function (result) {
                console.log(result);
                $('[name="jsonRequest"]').val(result.data.base64JsonRequest)
                $('[name="checksum"]').val(result.data.base64Checksum)
                document.myform1.submit();
            }
        });
    });
});
