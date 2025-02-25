<?php if ( empty($_GET['case-header-v2'])) : ?>

<section class="section section-1">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-4">
                <div class="text">
                    <div class="wr-logo mb-2">
                        <img src="<?php block_field('img'); ?>" alt="<?php echo get_post_meta(block_field('img', false), '_wp_attachment_image_alt', true); ?>">
                    </div>
                    <?php if(block_value('title')): ?> <<?php block_field('title-tag'); ?> class="section-title"> <?php block_field('title'); ?> </<?php block_field('title-tag'); ?>> <?php endif; ?>
                    <div class="sub-text">
                        <?php block_field('description'); ?>
                    </div>
                    <?php if( ! empty( block_value('link') ) ) : ?>
                    <div class="wr-link">
                        <p><?php _e( 'Website', 'icoda' ); ?></p>
                        <a href="<?php block_field('link'); ?>" target="_blank" class="link">
                            <?= str_replace('htpps://', '', block_value('link')); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="d-none d-md-block col-md-7 col-lg-8">
                <div class="wr-img">
                    <div class="bg-case">
                        <?php if ( has_post_thumbnail()) : ?>
                            <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>

                            <img src="<?php echo $featured_img_url; ?>" alt="<?php echo get_the_title(get_the_ID()); ?>">

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php else: ?>

    <section class="section section-hero-new-cases mt-3">
        <div class="section-hero-new-cases__inner mx-lg-5 mx-sm-4 position-relative with-gradient with-gradient-pink">
            <div class="bg-hero bg-hero-desktop d-lg-block d-none" style="background-image: url(/wp-content/uploads/2025/02/bg-hero-cases-desktop.png);"></div>
            <div class="bg-hero bg-hero-mobile d-lg-none" style="background-image: url(/wp-content/uploads/2025/02/bg-hero-cases-mobile-no-gradient-1.png);"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-7 px-0 pr-lg-3 pr-xl-5">
                        <h1 class="h1 mb-4 title">
                            How to Create a <span class="text-primary">200K+</span> Views Viral 
                            Video <span class="text-primary">for a Crypto Project</span>
                            
                                <!-- <?php the_field('post_header_v2_title'); ?> -->
                            
                        </h1>
                        <p class="subtitle pr-lg-5 mr-lg-5">
                        Discover how ICODA’s 3D video expertise helped a client achieve viral success with 200,000+ views, elevating their brand in the competitive crypto market and attracting investors.
                            <!-- <?php the_field('post_header_v2_subtitle'); ?> -->
                        </p>
                        <div class="mt-4 pt-lg-3">
                            <p class="fw-semibold mb-1 cases-category-title">Category:</p>
                            <ul class="cases-category-list d-flex">
                                <li class="cases-category-item">
                                    Crypto
                                </li>
                                <li class="cases-category-item">
                                    Marketing
                                </li>
                                <li class="cases-category-item">
                                    Meme
                                </li>
                            </ul>
                        </div>

                    </div>

                    <div class="col-12 col-lg-4 offset-xl-1 px-0 mt-4 pt-4 mt-lg-0 pt-lg-0">
                        <div class="cases-box">
                            <div class="serv-box">
                                <span class="number"><?php _e('up to 5x', 'icoda'); ?></span>
                                <p><?php _e('Clients increase', 'icoda'); ?></p>
                            </div>
                            <div class="serv-box">
                                <span class="number"><?php _e('+300k', 'icoda'); ?></span>
                                <p><?php _e('Subscription', 'icoda'); ?></p>
                            </div>
                            <div class="serv-box">
                                <span class="number"><?php _e('+2', 'icoda'); ?></span>
                                <p><?php _e('New video hostings', 'icoda'); ?></p>
                            </div>
                            <div class="serv-box">
                                <span class="number"><?php _e('-20%', 'icoda'); ?></span>
                                <p><?php _e('Total cost', 'icoda'); ?></p>
                            </div>
                        </div>
                    
                        <div class="bg-wrap position-relative d-flex flex-column align-items-center mt-5 pt-4 mt-lg-0 pt-lg-0">
                            <!-- <?php if (!empty($background_image_1)) : ?>
                                <picture>
                                    <img class="bg-image-1" src="<?php echo $background_image_1['url']; ?>" alt="<?php echo $background_image_1['alt']; ?>" />
                                </picture>
                            <?php endif; ?> -->

                            <!-- <?php if (!empty($items)) : ?>
                                <?php foreach ($items as $item_data) : ?>
                                    <div class="serv-box">
                                        <span class="number"><?php echo $item_data['value']; ?></span>
                                        <p><?php echo $item_data['text']; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?> -->

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </section>

    <div class="box-company-about">
        <div class="box">
            <div class="box-header">
                <img class="logo" src="/wp-content/uploads/2025/02/cp-logo.svg" alt="Coin Pocker" />
            </div>
            <div class="box-body mt-3 pt-1">
                <p class="h6 title fw-semibold mb-1">
                    About Client
                </p>
                <a href="#" target="_blank">
                    Swisstronik
                </a> 
                is a modular blockchain ecosystem focusing on safety, privacy, and compliance. They needed a branded 3D video to clearly convey their core concept to both general audiences and potential investors.
            </div>
            <div class="box-footer mt-3 pt-1">
                <p class="h6 title fw-semibold mb-1">Services Performed</p>
                <ul>
                    <li>
                        <span class="mr-1">>Marketing Strategy</span
                        <img class="logo" src="assets/images/arrow-link-card-hover.svg" alt="Arrow" />
                    </li>
                </ul>
            </div>
        </div>
        

    </div>

<?php endif; ?>