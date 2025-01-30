    <?php
    $background_image_1 = get_field('background_image_1');
    $background_image_2 = get_field('background_image_2');
    $items = get_field('items');
    $ratings = get_field('ratings');
    $has_gradient = get_field('has_gradient');
    $mobile_gradient = get_field('mobile_gradient');
    $desktop_gradient = get_field('desktop_gradient');
    ?>

    <section class="section section-hero-new section-hero-new-service">
        <div class="section-hero-new__inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-7 pr-lg-0">
                        <h1 class="h1 mb-3 mb-lg-4 title">
                            <span class="title-gradient">
                                <?php the_field('post_header_v2_title'); ?>
                            </span>

                        </h1>
                        <p class="subtitle">
                            <?php the_field('post_header_v2_subtitle'); ?>
                        </p>
                        <div class="mt-lg-4 mt-3 pt-3 pt-lg-0">
                            <?php get_template_part('template-parts/_partials/btn-hero'); ?>
                        </div>

                    </div>

                    <div class="col-12 col-lg-5">
                        <div class="bg-wrap position-relative d-flex flex-column align-items-center mt-5 pt-4 mt-lg-0 pt-lg-0">
                            <?php if (!empty($background_image_1)) : ?>
                                <picture>
                                    <img class="bg-image-1" src="<?php echo $background_image_1['url']; ?>" alt="<?php echo $background_image_1['alt']; ?>" />
                                </picture>
                            <?php endif; ?>

                            <?php if (!empty($items)) : ?>
                                <?php foreach ($items as $item_data) : ?>
                                    <div class="serv-box">
                                        <span class="number"><?php echo $item_data['value']; ?></span>
                                        <p><?php echo $item_data['text']; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php if (!empty($background_image_2)) : ?>
                                <picture>
                                    <img class="bg-image-2" src="<?php echo $background_image_2['url']; ?>" alt="<?php echo $background_image_2['alt']; ?>" />
                                </picture>
                            <?php endif; ?>

                        </div>
                    </div>

                    <?php if (!empty($ratings)) : ?>

                        <div class="col-12 pr-0">
                            <div class="mt-5 pt-4">
                                <div class="hero-slider-services custom-slider">
                                    <?php foreach ($ratings as $rat_data) : ?>

                                        <div
                                            class="media-logo">
                                            <picture>
                                                <img src="<?php echo $rat_data['image']['url']; ?>" alt="<?php echo $rat_data['image']['alt']; ?>" />
                                            </picture>
                                            <span class="media-title">
                                                <?php echo $rat_data['title']; ?>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <?php if (!empty($has_gradient)) : ?>
                <div class="has-gradient">
                    <picture>
                        <source
                            srcset="<?php echo $mobile_gradient['url']; ?>"
                            media="(max-width: 575px)" />
                        <img src="<?php echo $desktop_gradient['url']; ?>" alt="<?php echo $desktop_gradient['alt']; ?>" />
                    </picture>
                </div>
            <?php endif; ?>

        </div>

    </section>