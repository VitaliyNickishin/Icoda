<section class="section section-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="l-box bg-color-light-blue">
                    <p><?php echo __('If you want to', 'icoda'); ?></p>
                    <p class="h3"><?php echo __('book a meeting', 'icoda'); ?></p>
                    <?php if (ICL_LANGUAGE_CODE != 'ru') : ?>
                    <p><?php echo __('at any of these conferences, please contact us!', 'icoda'); ?></p>
                    <?php endif; ?>
                    <div class="l-box-footer">
                        <a href="#" data-modal="#book_meeting" class="btn btn-blue open-modal"><?php echo __('Book a meeting', 'icoda'); ?></a>
                        <div class="theme-media-list">
                            <ul class="media-list">
                                <li><a class="icon-ico-media-1" target="_blank" href="https://www.linkedin.com/company/icoda-ico-marketing-solutions/"></a></li>
                                <li><a class="icon-ico-media-2" target="_blank" href="https://www.facebook.com/icodaagency/"></a></li>
                                <li><a class="icon-ico-media-3" target="_blank" href="mailto:post@icoda.io"></a></li>
                                <li><a class="icon-ico-media-4" target="_blank" href="https://t.me/icoda"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block col-lg-6">
                <div class="wr-img">
                    <div class="bg-events"></div>
                </div>
            </div>
        </div>
    </div>
</section>


<div id="book_meeting" class="modal-default modal-box">
    <a href="#" class="modal-close"><i class="icon-ico-close"></i></a>

    <div class="wr-form">
        <form class="form-default form-default-desctop" action="submit.php" method="post">
            <input type="hidden" name="lang-source" value="<?php echo ICL_LANGUAGE_CODE; ?>" />
            <div class="form-default-header">
                <p class="h4"><?php echo __('Contact Us', 'icoda'); ?></p>
                <div class="theme-media-list">
                    <ul class="media-list">
                        <li><a class="icon-ico-media-1" target="_blank" href="https://www.linkedin.com/company/icoda-ico-marketing-solutions/"></a></li>
                        <li><a class="icon-ico-media-2" target="_blank" href="https://www.facebook.com/icodaagency/"></a></li>
                        <li><a class="icon-ico-media-3" target="_blank" href="mailto:post@icoda.io"></a></li>
                        <li><a class="icon-ico-media-4" target="_blank" href="https://t.me/icoda"></a></li>
                    </ul>
                </div>
            </div>
            <div class="form-row">
                <div class="col-12 col-md-6">
                    <input type="text" name="name" class="form-control req" placeholder="<?php echo __('Your name', 'icoda'); ?>" required>
                </div>
                <div class="col-12 col-md-6">
                    <input type="text" name="telegram" class="form-control req" placeholder="<?php echo __('WhatsApp / Telegram', 'icoda'); ?>" required>
                </div>
                <div class="col-12">
                    <input type="email" name="email" class="form-control req" placeholder="<?php echo __('Email', 'icoda'); ?>" required>
                </div>
                <div class="col-12">
                    <textarea name="message" class="form-control" rows="5" placeholder="<?php _e('Text message', 'icoda'); ?>"></textarea>
                </div>
                <?php
                do_action( 'anr_captcha_form_field' );
                ?>
                <div class="col-12">
                    <div class="wr-btn text-right">
                        <button type="submit" class="btn btn-blue"><?php echo __('Apply Now', 'icoda'); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>