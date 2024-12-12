<section class="section section-hero">
    <div class="section-hero__inner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-5 position-static">
                    
                    <div class="title-animated section-hero__title-animated">
                        <h1 class="h1 section-hero__cd-headline cd-headline zoom mb-3 mb-lg-2 text-center text-lg-left">
                            <?php if ( wp_is_mobile() ) : ?>
                                <?php the_field('section_1_subtitle_block-en'); ?>
                            <?php else : ?>
                                <span class="cd-words-wrapper">
                                <b
                                    class="is-visible"
                                    ><?php echo get_field('section_1_name_form_block-en'); ?></b
                                >
                                <b
                                    class="is-hidden"
                                    ><?php the_field('section_1_subtitle_block-en'); ?></b
                                >
                                </span>
                            <?php endif; ?>
                        </h1>
                        <div class="section-hero__line-undertitle d-none d-lg-block">
                            <svg id="svg-line-wave" width="419" height="20" viewBox="0 0 419 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M417 5.63797C417 5.63797 405.784 18.4281 382.585 17.689C364.905 17.1257 329.514 7.05123 311.881 5.63797C271.564 2.40662 253.388 14.6133 212.785 13.3029C172.741 12.0105 147.114 -0.213309 106.571 2.35302C77.1632 4.21454 53.5406 15.8976 30.3415 15.1585C12.6611 14.5953 2.00002 5.638 2.00002 5.638" stroke="#3C61E2" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                            
                        </div>
                        <!-- desktop  -->
                        <div class="d-none d-lg-block mt-sm-4 pt-sm-1">
                            <?php get_template_part('template-parts/_partials/btn-hero'); ?>
                            
                        </div>
                    </div>
                    <div class="section-hero__info-counter d-none d-lg-block">
                        <?php get_template_part('template-parts/_partials/info-counter'); ?>
                    </div>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="wrap-img text-center">
                        <picture>
                            <source
                              srcset="<?php the_field('section_1_background_mobile'); ?>"
                              media="(max-width: 575px)"
                            />
                            <img src="<?php the_field('section_1_background_desctop'); ?>" alt="<?php echo get_field('section_1_name_form_block-en'); ?>" />
                          </picture>

                    </div>
                    <!-- mobile  -->
                    <div class="d-lg-none d-flex justify-content-center">
                        <?php get_template_part('template-parts/_partials/btn-hero'); ?>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    <div class="d-lg-none section-hero__info-counter container px-0 px-sm-3">
        <?php get_template_part('template-parts/_partials/info-counter'); ?>
    </div>
    
</section>