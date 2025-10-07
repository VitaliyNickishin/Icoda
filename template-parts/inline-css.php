<style>
    .icoda-hidden {
        display: none !important;
    } 
</style>
<?php
if (is_front_page()) :
    if (ICL_LANGUAGE_CODE == 'zh-hans') :
?>
        <style>
            .link-telegram-fix,
            .link-wechat-fix {
                position: fixed;
                right: 60px;
                bottom: 60px;
                width: 60px;
                height: 60px;
                background: #f1f4ff;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-pack: center;
                justify-content: center;
                -ms-flex-align: center;
                align-items: center;
                overflow: hidden;
                border-radius: 50%;
                color: #3c61e2;
                z-index: 10;
                box-shadow: 0 0 0 rgba(60, 97, 226, .4);
                animation: pulse 2s infinite
            }

            .link-wechat-fix {
                border-radius: 5px;
                width: 80px;
                height: 80px;
            }


            @media (max-width: 767.98px) {

                .link-telegram-fix,
                .link-wechat-fix {
                    display: none
                }

            }

            @media (min-width: 1200px) {

                .link-telegram-fix,
                .link-wechat-fix {
                    right: 10%
                }
            }

            @media only screen and (max-width: 1470px) {

                .link-telegram-fix,
                .link-wechat-fix {
                    right: 60px
                }
            }

            @media only screen and (max-width: 1600px) {

                .link-telegram-fix,
                .link-wechat-fix {
                    right: 6%
                }
            }
        </style>
    <?php endif; ?>
<?php endif; ?>

<?php if (ICL_LANGUAGE_CODE == 'zh-hans') : ?>
    <style>
        .link-telegram-fix,
        .link-wechat-fix {
            position: fixed;
            right: 60px;
            bottom: 60px;
            width: 60px;
            height: 60px;
            background: #f1f4ff;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: center;
            justify-content: center;
            -ms-flex-align: center;
            align-items: center;
            overflow: hidden;
            border-radius: 50%;
            color: #3c61e2;
            z-index: 10;
            box-shadow: 0 0 0 rgba(60, 97, 226, .4);
            animation: pulse 2s infinite
        }

        .link-wechat-fix {
            border-radius: 5px;
            width: 80px;
            height: 80px;
        }

        @media (max-width: 767.98px) {

            .link-telegram-fix,
            .link-wechat-fix {
                display: none
            }

        }

        @media (min-width: 1200px) {

            .link-telegram-fix,
            .link-wechat-fix {
                right: 10%
            }
        }

        @media only screen and (max-width: 1470px) {

            .link-telegram-fix,
            .link-wechat-fix {
                right: 60px
            }
        }

        @media only screen and (max-width: 1600px) {

            .link-telegram-fix,
            .link-wechat-fix {
                right: 6%
            }
        }
    </style>
<?php endif; ?>

<?php if (ICL_LANGUAGE_CODE == 'ru') : ?>
    <style>
        body .btn {
            text-transform: none;
        }
    </style>
<?php endif; ?>

<?php if (ICL_LANGUAGE_CODE == 'es') : ?>
    <style>
        body .btn.btn-blue.open-modal,
        form.form-default .btn-blue {
            text-transform: none;
        }
    </style>
<?php endif; ?>

<?php if (is_page(11717) || is_page(11751)) : ?>
    <style>
        body.page-id-11717 .anim-box .bg-computer,
        body.page-id-11751 .anim-box .bg-computer {
            background: url(/wp-content/uploads/2021/04/1.png) 0 0 no-repeat;
        }

        body.page-id-11717 .anim-box .bg-phone,
        body.page-id-11751 .anim-box .bg-phone {
            background: url(/wp-content/uploads/2021/04/2.png) 0 0 no-repeat;
        }
    </style>
<?php endif; ?>


<style>
    .single-post .wp-caption-text {
        display: none;
    }

    img.alignleft {
        width: auto !important;
    }

    #congrats-confetti {
        position: absolute;
        display: block;
        top: 50%;
        left: 50%;
        z-index: -1;
        transform: translate(-50%, -50%);
        width: 100%;
        height: 100%;
    }
</style>

<style>
    .rtl .wpml-ls-legacy-dropdown a.wpml-ls-item-toggle {
        padding-right: unset;
        padding-left: unset;
    }

    .rtl .section-agency .section-title {
        text-align: right;
    }

    .rtl .meet-up .map {
        position: inherit;
    }

    .rtl .media-list li:first-child {
        margin-left: 16px;
    }
    .rtl .media-list li:last-child {
        margin-left: 0;
    }

    .rtl .media-list {
        justify-content: flex-end;
    }

    .rtl .media {
        align-items: flex-end;
    }

    .rtl .footer-modal-link li:first-child {
        margin-left: 30px;
    }

    .rtl .footer-modal-link li:last-child {
        margin-left: 0;
    }

    .rtl.page-template-template-home-2-0 .decoration-section .canvas-waves {
        position: inherit;
    }

    body.rtl .lang-select {
        margin-left: 10px;
    }

    @media screen and (max-width: 991px) {
        body.rtl .header.navbar .burger {
            margin-left: unset;
        }

        body.rtl .wr-btn .email-icon {
            margin-left: 10px;
        }
    }
</style>


<style>
    .location-info-usa {
        left: 170px;
        top: 90px;
    }
    .location-info-usa:before {
        left: 7px;
        bottom: 54px;
    }

    @media screen and (max-width: 1440px) { 
        .location-info-usa {
            left: 170px;
            top: 85px;
        }
        .location-info-usa:before {
            left: 5px;
            bottom: 42px;
        }
    }
   
    @media screen and (max-width: 1340px) { 
        .location-info-usa {
            left: 143px;
            top: 102px;
        }
    }
    @media screen and (max-width: 1100px) {
        .location-info-usa {
            left: 142px;
            top: 162px;
        }
    }
    

    @media screen and (max-width: 991px) {
        .location-info-usa {
            left: 93px;
            top: 35px;
        }
        .location-info-usa:before {
            left: 0px;
            bottom: 25px;
        }
    }

    @media screen and (max-width: 767px) {
        .location-info-usa {
            left: 80px;
            top: 105px;
        }
    }

    @media screen and (max-width: 540px) {
        .location-info-usa {
            left: 9px;
            top: 105px;
        }
    }
    
    @media screen and (max-width: 460px) {
        .location-info-usa {
            left: 5px;
            top: 100px;
        }
    }
    
</style>