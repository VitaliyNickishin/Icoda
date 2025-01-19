<?php
/* Template Name: Main page 2.0 */
get_header();
?>
<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>

<main>
    
    <?php if ( !empty($_GET['section_hero_new'])) : ?>
        <?php get_template_part('template-parts/front-page/section-hero-new'); ?>
    <?php elseif ( true || ICL_LANGUAGE_CODE === 'en' || !empty($_GET['section_hero_new_has_gradient'])) : ?>
        <?php get_template_part('template-parts/front-page/section-hero-new-has-gradient'); ?>
    <?php else : ?>
        <?php if ( get_field('section_1_show') ) : ?>
            <?php get_template_part('template-parts/front-page/section-hero'); ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (false && ICL_LANGUAGE_CODE !== 'en' && get_field('section_featured_show')) : ?>
        <section class="section featured-in test">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="section-title"><?php the_field('section_featured_title'); ?></h2>
                    </div>
                </div>
                <div class="featured-in-slider custom-slider">
                    <?php $feature_logos = get_field('section_featured_list_logos'); ?>
                    <?php if(!empty($feature_logos)) : ?>
                        <?php foreach ($feature_logos as $feature_logo) : ?>
                            <a href="<?php echo !empty($feature_logo['link']) ? $feature_logo['link'] : '#'; ?>" class="featured-logo" target="_blank">
                                <img class="" src="<?php echo $feature_logo['image']; ?>" alt="hn-logo">
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php get_template_part('template-parts/front-page/section-solutions'); ?>
    <?php get_template_part('template-parts/front-page/section-services-slider'); ?>
    <?php get_template_part('template-parts/front-page/section-agency'); ?>
    <?php get_template_part('template-parts/front-page/section-recent-cases'); ?>
    <?php get_template_part('template-parts/front-page/section-reliable-resources'); ?>

    <?php //get_template_part('template-parts/front-page/section-recent-cases-old'); 
    ?>

    <div class="section decoration-section">
        <canvas id="waves" class="canvas-waves"></canvas>
    </div>

    <?php /*if ( get_field('recent_cases_show') && empty($_GET['show_new_cases'])) : ?>
        <section id="cases" class="section cases" data-need-load="1" data-post-id="<?php echo get_the_ID(); ?>">
        </section>
    <?php endif;*/ ?>
    <?php /*if (get_field('section_3_show')) : ?>
        <section id="for-whom" class="section section-3" data-need-load="1" data-post-id="<?php echo get_the_ID(); ?>">
        </section>
    <?php endif;*/ ?>

    <?php if (false && get_field('section_4_show')) : ?>
        <section class="section section-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="section-title"><?php the_field('section_3_title_block-en'); ?></h3>
                    </div>
                </div>

                <?php if (get_field('section_3-en')) : ?>

                    <?php if (true || !empty($_GET['new_resources'])) : ?>
                        <?php $partners_list = get_field('section_3-en'); ?>
                        <?php get_template_part('template-parts/sections/reliable-resources', '', ['partners_list' => $partners_list]); ?>
                    <?php else : ?>
                        <?php if (get_field('section_3-en')) : ?>
                            <div class="col-12 col-md-12 p-0">
                                <div class="list-logo-desktop">
                                    <div class="list-logo">
                                        <?php while (has_sub_field('section_3-en')) : ?>
                                            <div class="list-logo-item">
                                                <div class="wr-img">
                                                    <img data-src="<?php the_sub_field('section_3_image-en'); ?>" src="<?php the_sub_field('section_3_image-en'); ?>" alt="img-logo">
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                        <div class="list-logo-item">
                                            <div class="wr-img">
                                                <div class="text">
                                                    <p class="h2">+300</p>
                                                    <p class="sub-text"><?php echo __('resources more', 'icoda'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- slider -->
                                <div class="list-logo-mobile">
                                    <div class="list-logo list-logo-slider custom-slider">

                                        <?php while (has_sub_field('section_3-en')) : ?>
                                            <div class="list-logo-item">
                                                <div class="wr-img">
                                                    <img data-src="<?php the_sub_field('section_3_image-en'); ?>" src="<?php the_sub_field('section_3_image-en'); ?>" alt="img-logo">
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                        <div class="list-logo-item">
                                            <div class="wr-img">
                                                <div class="text">
                                                    <p class="h2">+300</p>
                                                    <p class="sub-text"><?php echo __('resources more', 'icoda'); ?></p>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php endif; ?>



            </div>
        </section>
    <?php endif; ?>

    <?php if (get_field('section_6_show') == true) : ?>
        <section id="testimonials" class="section section-testimonials" data-need-load="1" data-post-id="<?php echo get_the_ID(); ?>">
        </section>
    <?php endif; ?>

    <div class="section decoration-section decoration-section-under-testimonials">
        <canvas id="waves-second" class="canvas-waves"></canvas>
    </div>

    <?php if (get_field('section_5_show') == true) : ?>
        <section id="home-brands" class="section section-5 home-brands" data-need-load="1" data-post-id="<?php echo get_the_ID(); ?>">
        </section>
    <?php endif; ?>

    <?php if (get_field('section_7_show') == true) : ?>
        <section id="leadership" class="section section-7" data-need-load="1" data-post-id="<?php echo get_the_ID(); ?>">
        </section>
    <?php endif; ?>

    <?php get_template_part('template-parts/sections/meet-up'); ?>

    <?php if (get_field('section_contact_us_show') == true) : ?>
        <?php get_template_part('template-parts/sections/contact-us'); ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>