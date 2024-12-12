<section class="section section-hero-new section-hero-new-has-gradient">
    <div class="section-hero-new__inner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-8 pr-lg-0">
                    <h1 class="h1 mb-3 mb-lg-4">
                        <span class="title-gradient"><?php the_field('home_gradient_title'); ?></span>
                        <span class="d-md-block undertitle"><?php the_field('home_gradient_subtitle'); ?></span>
                    </h1>
                    <p class="subtitle pr-lg-5">
                        <?php the_field('home_gradient_text'); ?>
                    </p>
                    <div class="section-hero-new__info mt-3 pt-3 mt-lg-5 pt-lg-0">
                        <?php get_template_part('template-parts/_partials/info-about-us'); ?>
                    </div>
                    
                    <div class="mt-lg-4 mt-3 pt-3 pt-lg-0">
                        <?php get_template_part('template-parts/_partials/btn-hero'); ?>
                    </div>       
                    
                </div>
                
                <div class="col-12 col-lg-4 hide-on-mobile">
                    <?php get_template_part('template-parts/_partials/services-box'); ?>
                </div>
                

                <div class="col-12 pr-0">
                    <div class="mt-5 pt-lg-4">
                        <?php get_template_part('template-parts/_partials/slider-hero'); ?>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="has-gradient">
            <picture>
                <source
                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/gradient-hero-mob.png"
                    media="(max-width: 575px)"
                />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gradient-hero-desk.png" alt="gradient" />
            </picture>
        </div>
    </div>
    
</section>