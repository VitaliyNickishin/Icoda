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
                            <?php get_template_part('template-parts/_partials/contact-form'); ?>
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
        <div class="form-default-header">
            <p class="h4"><?php echo __('Contact Us', 'icoda'); ?></p>
            <div class="theme-media-list">
                <?php get_template_part('template-parts/_partials/contact-form'); ?>
            </div>
        </div>
        <?php get_template_part('template-parts/_partials/contact-form'); ?>
    </div>
</div>