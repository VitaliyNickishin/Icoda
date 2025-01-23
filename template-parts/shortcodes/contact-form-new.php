<section class="section section-form" id="contact-with-us">
    <div class="section-form-inner mx-lg-5 mx-sm-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <h3 class="section-title mb-3 mb-lg-4">
                        <?php echo _e('Feel free to contact us', 'icoda') ?>
                    </h3>
                    <p class="subtitle mb-3 mb-lg-4">
                        <?php echo _e('We are the team of experts that will support your business at all stages', 'icoda') ?>
                    </p>
                    
                </div>
                <div class="col-md-12 offset-lg-1 col-lg-7">
                    <div class="wr-form">
                        <form class="form-default form-default-desctop <?php /* ?>form-with-captcha<?php */ ?>" action="submit.php" method="post">
                            <input type="hidden" name="lang-source" value="<?php echo ICL_LANGUAGE_CODE; ?>" />
                            <div class="form-row">
                                <div class="col-12 col-md-6">
                                    <input type="text" name="name" class="form-control req" placeholder="<?php _e( 'Your name', 'icoda' ); ?>" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="telegram" class="form-control req" placeholder="<?php _e( 'WhatsApp / Telegram / Skype', 'icoda' ); ?>" required>
                                </div>
                                <div class="col-12">
                                    <input type="email" name="email" class="form-control req" placeholder="<?php _e( 'Email', 'icoda' ); ?>" required>
                                </div>
                                <div class="col-12">
                                    <textarea name="message" class="form-control" placeholder="<?php _e( 'Text message', 'icoda' ); ?>"></textarea>
                                </div>
                                <?php /* ?>
                                <div class="col-12">
                                    <div id="icoda-recaptcha" class="g-recaptcha"></div>
                                </div>
                                <?php */ ?>
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
    </div>
</section>