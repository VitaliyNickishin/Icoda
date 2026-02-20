<?php
    $variant = $args['variant'] ?? 'default';
?>
<form class="form-default form-default-desctop" method="post">
    <input type="hidden" name="lang-source" value="<?php echo ICL_LANGUAGE_CODE; ?>" />
    <?php get_template_part('template-parts/_partials/contact-form-fields'); ?>
    
    <div class="form-row">
        <div class="col-12 <?php if ($variant === 'home') : ?>col-md-6<?php endif; ?>">
            <div class="input-wrap form-group">
                <label for="name" class="form-label"><?php _e('Your name', 'icoda'); ?></label>
                <input type="text" name="name" class="form-control" placeholder="<?php echo __('Your name', 'icoda'); ?>" required>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="input-wrap form-group">
                <label for="telegram" class="form-label"><?php _e('Telegram', 'icoda'); ?></label>
                <input type="text" name="telegram" class="form-control" placeholder="<?php echo __('Telegram', 'icoda'); ?>">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="input-wrap form-group">
                <label for="name" class="form-label"><?php _e('Phone number', 'icoda'); ?></label>
                <input id="intlTel" type="tel" name="phone" class="form-control intlTel" required>
            </div>
        </div>
        <div class="col-12 <?php if ($variant === 'home') : ?>col-md-6<?php endif; ?>">
            <div class="input-wrap form-group">
                <label for="telegram" class="form-label"><?php _e('Email', 'icoda'); ?></label>
                <input name="email" class="form-control" placeholder="<?php echo __('Email', 'icoda'); ?>" required>
            </div>
            
        </div>
        <div class="col-12">
            <?php if ($variant === 'home') : ?>
                <div class="form-group">
                    <label for="message" class="form-label">
                        <span class="d-none d-md-block"><?php _e('Describe your situation. How can we help you?', 'icoda'); ?></span>
                        <span class="d-md-none"><?php _e('How can we help you?', 'icoda'); ?></span>
                    </label>
                    <input id="message" class="form-control" name="message" type="text" placeholder="<?php _e('How can we help you?', 'icoda'); ?>">
                </div>
            <?php else : ?>
                <div class="input-wrap form-group">
                    <label for="telegram" class="form-label"><?php _e('Text message', 'icoda'); ?></label>
                    <textarea name="message" class="form-control" rows="5" placeholder="<?php _e('Text message', 'icoda'); ?>"></textarea>
                </div>
            <?php endif; ?>
        </div>
        <?php
        do_action('anr_captcha_form_field');
        ?>
        <div class="col-12">
            <div class="wr-btn text-center text-lg-right">
                <button type="submit" class="btn btn-blue"><?php echo __('Apply Now', 'icoda'); ?></button>
            </div>
        </div>
    </div>
</form>