<?php
/* Template Name: Contact page */

get_header();
$front_page_id = get_option('page_on_front');
?>
<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>
<section class="wr-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php the_breadcrumbs(); ?>
            </div>
        </div>
    </div>
</section>
<section class="section section-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="l-box bg-color-light-blue">
                    <div class="bg-line-left"></div>
                    <p class="h4"><?php echo __('Send request to scale your business to the next level', 'icoda'); ?></p>
                    <div class="sub-text">
                        <p><?php echo __('We are a team of professionals who accompany your business at all stages', 'icoda'); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="wr-form">
                    <form class="form-default form-default-desctop" action="submit.php" method="post">
                        <input type="hidden" name="lang-source" value="<?php echo ICL_LANGUAGE_CODE; ?>" />
                        <div class="form-default-header">
                            <h1 class="h4"><?php echo __('Contact Us', 'icoda'); ?></h1>
                            <div class="theme-media-list">
                                <ul class="media-list">
                                    <li><a class="icon-ico-media-1" target="_blank" href="https://www.linkedin.com/company/icoda-ico-marketing-solutions/"></a></li>
                                    <li><a class="icon-ico-media-2" target="_blank" href="https://www.facebook.com/icodaagency/"></a></li>
                                    <li><a class="icon-ico-media-3" target="_blank" href="mailto:post@icoda.io"></a></li>
                                    <li><a class="icon-ico-media-4" target="_blank" href="https://t.me/icoda"></a></li>
                                    <li><a class="icon-twitter" target="_blank" href="https://twitter.com/icoda_io"></a></li>
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
                            do_action('anr_captcha_form_field');
                            ?>
                            <div class="col-12">
                                <div class="wr-btn text-center text-lg-right">
                                    <button type="submit" class="btn btn-blue"><?php echo __('Apply Now', 'icoda'); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/sections/meet-up', '', ['need_post_id' => $front_page_id]); ?>

<?php
get_footer(); ?>