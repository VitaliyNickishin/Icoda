<?php
$need_post_id = !empty($args['need_post_id']) ? $args['need_post_id'] : get_the_ID();
?>
<?php if (get_field('section_contact_us_show', $need_post_id) == true) : ?>
    <section class="form-contact">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4 col-top">
                    <div class="text">
                        <h4 class="section-title"><?php echo get_field('section_contact_us_title', $need_post_id); ?></h4>
                        <p class="sub-text"><?php echo get_field('section_contact_us_sub_text', $need_post_id); ?></p>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <form class="form-default-desctop" action="submit.php" method="post">
                        <input type="hidden" name="lang-source" value="<?php echo ICL_LANGUAGE_CODE; ?>" />
                        <div class="first-row d-flex justify-content-between">
                            <div class="input-wrap form-group">
                                <label for="name" class="form-label"><?php _e('Enter your name', 'icoda'); ?></label>
                                <input id="name" type="text" name="name" placeholder="<?php _e('Enter your name', 'icoda'); ?>">

                            </div>
                            <div class="input-wrap form-group">
                                <label for="telegram" class="form-label"><?php _e('Enter your Phone', 'icoda'); ?></label>
                                <input id="telegram" type="text" name="telegram" placeholder="<?php _e('Enter your Phone', 'icoda'); ?>">

                            </div>
                            <div class="input-wrap form-group">
                                <label for="email" class="form-label"><?php _e('Enter your E-mail', 'icoda'); ?></label>
                                <input id="email" name="email" type="email" placeholder="<?php _e('Enter your E-mail', 'icoda'); ?>">

                            </div>
                        </div>
                        <div class="second-row">
                            <div class="form-group desktop-text">
                                <label for="message" class="form-label"><?php _e('Describe your situation. How can we help you?', 'icoda'); ?></label>
                                <input id="message" class="desktop-text" name="message" type="text" placeholder="<?php _e('Describe your situation. How can we help you?', 'icoda'); ?>">
                            </div>
                            <div class="form-group mobile-text">
                                <label for="message_mob" class="form-label"><?php _e('How can we help you?', 'icoda'); ?></label>
                                <input id="message_mob" class="mobile-text" name="message_mob" type="text" placeholder="<?php _e('How can we help you?', 'icoda'); ?>">
                            </div>
                        </div>
                        <?php
                        do_action('anr_captcha_form_field');
                        ?>
                        <button type="submit" class="btn btn-default"><?php _e('Apply Now', 'icoda'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>