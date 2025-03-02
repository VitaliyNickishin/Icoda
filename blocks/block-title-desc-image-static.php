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

    <section class="section section-cases-hero-new mt-3">
        <div class="section-cases-hero-new__inner position-relative with-gradient with-gradient-pink">
            <div class="bg-hero bg-hero-desktop d-lg-block d-none" style="background-image: url(/wp-content/uploads/2025/02/bg-hero-cases-desktop.png);"></div>
            <div class="bg-hero bg-hero-mobile d-lg-none" style="background-image: url(/wp-content/uploads/2025/02/bg-hero-cases-mobile-no-gradient-1.png);"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-7 pr-lg-3 pr-xl-5">
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
                                    <a href="#">
                                        Crypto
                                    </a>
                                </li>
                                <li class="cases-category-item">
                                    <a href="#">
                                        Marketing
                                    </a>   
                                </li>
                                <li class="cases-category-item">
                                    <a href="#">
                                        Meme
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <div class="col-12 col-lg-5 col-xl-4 offset-xl-1 mt-4 pt-4 mt-lg-0 pt-lg-0">
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
                    
                        <!-- <div class="bg-wrap position-relative d-flex flex-column align-items-center mt-5 pt-4 mt-lg-0 pt-lg-0"> -->
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

                        <!-- </div> -->
                    </div>

                </div>
            </div>

        </div>

    </section>

    <div class="section-cases-content pt-5 pt-lg-4 mt-lg-3">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4 order-lg-1">
                    <div class="section-cases-sidebar">
                        
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
                                    <ul class="list-services-perfomed">
                                        <li>
                                            <a href="#">
                                                <span class="mr-1">Marketing Strategy</span>
                                                <img src="<?php echo get_template_directory_uri();?>/assets/images/arrow-more.svg" alt="Arrow" />
                                            </a>
                                            
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="mr-1">ORM</span>
                                                <img src="<?php echo get_template_directory_uri();?>/assets/images/arrow-more.svg" alt="Arrow" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="mr-1">Video production</span>
                                                <img src="<?php echo get_template_directory_uri();?>/assets/images/arrow-more.svg" alt="Arrow" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="mr-1">SEO</span>
                                                <img src="<?php echo get_template_directory_uri();?>/assets/images/arrow-more.svg" alt="Arrow" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="mr-1">Influencer Marketing</span>
                                                <img src="<?php echo get_template_directory_uri();?>/assets/images/arrow-more.svg" alt="Arrow" />
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 pt-1 pt-lg-3">
                            <div class="box-feedback text-lg-left text-center">
                                <h2 class="mb-2 pb-1 section-title text-white">Upgrade Your Marketing</h2>
                                <p class="text-white">Chat with a team that understands well-developed full-service marketing.</p>
                                <div class="btn-wrap mt-3 pt-1">
                                    <a href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/oy--5/talk-to-our-expert'});return false;" class="btn btn-outline-white"><?php echo __('Book Intro Call', 'icoda'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 mt-5 mt-lg-0">
                    <section class="section-goals">
                        <h2 class="mb-4 section-title">Project Goals</h2>
                        <div class="goals-boxes">
                            <div class="serv-box">
                                <span class="number mb-2"><?php _e('1. Simplify Complex Concepts', 'icoda'); ?></span>
                                <p><?php _e('Break down intricate blockchain technology into easily digestible visuals.', 'icoda'); ?></p>
                            </div>
                            <div class="serv-box">
                                <span class="number mb-2"><?php _e('2. Highlight Key Benefits', 'icoda'); ?></span>
                                <p><?php _e('Showcase Swisstronik’s unique features, including its privacy and security focus.', 'icoda'); ?></p>
                            </div>
                            <div class="serv-box">
                                <span class="number mb-2"><?php _e('3. Investor Engagement', 'icoda'); ?></span>
                                <p><?php _e('Create a polished presentation video to capture the attention of investors, clients, and developers.', 'icoda'); ?></p>
                            </div>
                            <div class="serv-box">
                                <span class="number mb-2"><?php _e('4. Enhanced Client Value', 'icoda'); ?></span>
                                <p><?php _e('In addition to the main deliverables, we took the initiative to create bonus video clips for social media and website integration.', 'icoda'); ?></p>
                            </div>
                        </div>
                    </section>

                    <section class="section-result my-4 py-3">
                        <h2 class="mb-4 section-title">Results</h2>
                        <div class="resault-boxes">
                            <div class="serv-box">
                                <span class="number mb-2"><?php _e('+ 200k views to date', 'icoda'); ?></span>
                                <p><?php _e('Increased YouTube watches count over 200,000 views to date.', 'icoda'); ?></p>
                            </div>
                            <div class="serv-box">
                                <span class="number mb-2"><?php _e('4x', 'icoda'); ?></span>
                                <p><?php _e('Increased user engagement across Twitter and LinkedIn with a notable uptick in shares and comments.', 'icoda'); ?></p>
                            </div>
                            <div class="serv-box">
                                <span class="number mb-2"><?php _e('Website Boost', 'icoda'); ?></span>
                                <p><?php _e('Integrated sections on the website helped boost on-site engagement, according to feedback from Swisstronik\’s team.', 'icoda'); ?></p>
                            </div>
                        </div>
                    </section>
                </div>
                
            </div>
        </div>
    </div>

    

    

<?php endif; ?>