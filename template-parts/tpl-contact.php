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
                    <div class="form-default-header">
                        <h1 class="h4"><?php echo __('Contact Us', 'icoda'); ?></h1>
                        <div class="theme-media-list">
                            <?php get_template_part('template-parts/_partials/media-list'); ?>
                        </div>
                    </div>
                    <?php get_template_part('template-parts/_partials/contact-form'); ?>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/sections/meet-up', '', ['need_post_id' => $front_page_id]); ?>

<?php
get_footer(); ?>