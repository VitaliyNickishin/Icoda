<section class="section section-form" id="contact-with-us">
    <div class="container">
        <div class="row row-vert">
            <div class="col-md-12 col-lg-6">
                <div class="l-box">
                    <div class="bg-line-left"></div>
                    <div class="text-vert">
                        <p class="h4"><?php _e( 'Feel free to contact us', 'icoda' ); ?></p>
                        <div class="sub-text">
                            <p><?php _e( 'We are the team of experts that will support your business at all stages', 'icoda' ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="wr-form">
                    <form class="form-default form-default-desctop form-with-captcha" action="submit.php" method="post">
                        <input type="hidden" name="lang-source" value="<?php echo ICL_LANGUAGE_CODE; ?>" />
                        <div class="form-row">
                            <div class="col-12 col-md-6">
                                <input type="text" name="name" class="form-control req" placeholder="<?php _e( 'Your name', 'icoda' ); ?>" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" name="telegram" class="form-control req" placeholder="<?php _e( 'WhatsApp / Telegram', 'icoda' ); ?>" required>
                            </div>
                            <div class="col-12">
                                <input type="email" name="email" class="form-control req" placeholder="<?php _e( 'Email', 'icoda' ); ?>" required>
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control" placeholder="<?php _e( 'Text message', 'icoda' ); ?>"></textarea>
                            </div>
                            <div class="col-12">
                            <div id="icoda-recaptcha" class="g-recaptcha"></div>
                            </div>
                            <div class="col-12">
                                <div class="wr-btn">
                                    <button type="submit" class="btn btn-blue"><?php _e( 'Apply now', 'icoda' ); ?></button>
                                    <?php /* ?>
                                    <div class="theme-media-list">
                                        <ul class="media-list">
                                            <li><a class="icon-ico-media-1" target="_blank" href="https://www.linkedin.com/company/icoda-ico-marketing-solutions/"></a></li>
                                            <li><a class="icon-ico-media-2" target="_blank" href="https://www.facebook.com/icodaagency/"></a></li>
                                            <li><a class="icon-ico-media-3" target="_blank" href="mailto:post@icoda.io"></a></li>
                                            <li><a class="icon-ico-media-4" target="_blank" href="https://t.me/icoda"></a></li>
                                        </ul>
                                    </div>
                                    <?php */ ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>