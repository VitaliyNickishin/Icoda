<?php
/* Template Name: Main page 2.0 */
get_header();
?>
<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>

<?php
if (ICL_LANGUAGE_CODE == 'zh-hans') :
?>
    <style>
        .link-telegram-fix,
        .link-wechat-fix {
            position: fixed;
            right: 60px;
            bottom: 60px;
            width: 60px;
            height: 60px;
            background: #f1f4ff;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: center;
            justify-content: center;
            -ms-flex-align: center;
            align-items: center;
            overflow: hidden;
            border-radius: 50%;
            color: #3c61e2;
            z-index: 10;
            box-shadow: 0 0 0 rgba(60, 97, 226, .4);
            animation: pulse 2s infinite
        }

        .link-wechat-fix {
            border-radius: 5px;
            width: 80px;
            height: 80px;
        }


        @media (max-width: 767.98px) {

            .link-telegram-fix,
            .link-wechat-fix {
                display: none
            }

        }

        @media (min-width: 1200px) {

            .link-telegram-fix,
            .link-wechat-fix {
                right: 10%
            }
        }

        @media only screen and (max-width: 1470px) {

            .link-telegram-fix,
            .link-wechat-fix {
                right: 60px
            }
        }

        @media only screen and (max-width: 1600px) {

            .link-telegram-fix,
            .link-wechat-fix {
                right: 6%
            }
        }
    </style>
<?php endif; ?>

<main>
    <?php if (get_field('section_1_show')) : ?>
        <section class="section section-1 main-hero">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-5 col-mobile">
                        <div class="text">
                            <h1 class="section-title"><?php the_field('section_1_name_form_block-en'); ?></h1>
                            <div class="img-mobile mt-5">
                                <img src="<?php the_field('section_1_background_mobile'); ?>" alt="bg-home-mobile">
                            </div>
                            <div class="sub-text d-none d-lg-block">
                                <?php the_field('section_1_subtitle_block-en'); ?>
                            </div>
                            <div class="btn-wrap">
                                <a href="#" data-modal="#callback" class="btn btn-blue open-modal">
                                    <?php echo __('Get Your Proposal', 'icoda'); ?>
                                </a>
                                <a href="https://t.me/icoda" target="_blank" class="link-hover-underline"><?php echo __('or contact us on Telegram', 'icoda'); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div data-main-img class="wrap-img">
                            <div class="bg-gradient">
                                <div class="item item-first"></div>
                                <div class="item item-second"></div>
                                <div class="item item-third"></div>
                                <div class="item item-fourth"></div>
                            </div>
                            <div class="img-hero">
                                <img src="<?php the_field('section_1_background_desctop'); ?>" alt="bg-home">
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>


    <?php if (get_field('section_featured_show')) : ?>
        <section class="section featured-in">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="section-title"><?php the_field('section_featured_title'); ?></h2>
                    </div>
                </div>
                <div class="featured-in-slider custom-slider">
                    <?php $feature_logos = get_field('section_featured_list_logos'); ?>
                    <?php foreach ($feature_logos as $feature_logo) : ?>
                        <a href="<?php echo !empty($feature_logo['link']) ? $feature_logo['link'] : '#'; ?>" class="featured-logo" target="_blank">
                            <img class="" src="<?php echo $feature_logo['image']; ?>" alt="hn-logo">
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <div class="section decoration-section">
        <canvas id="waves" class="canvas-waves"></canvas>
    </div>

    <?php if (get_field('section_2_show')) : ?>
        <section class="section section-2">
            <div class="container">
                <div class="row">
                    <?php $services = get_field('section_2-en'); ?>

                    <?php
                        $icoda_gb_services = get_field('icoda_gb_services', 'option');
                        if( ! empty( $_GET['new_services'] ) && !empty( $icoda_gb_services ) ) {
                            $services = [];
                            foreach( $icoda_gb_services as $item_row_data ) {
                                if( ! empty( $item_row_data['custom_url'] ) ) {
                                    $link_val = $item_row_data['custom_url'];
                                } elseif( ! empty( $item_row_data['post_obj'] ) ) {
                                    $link_val = get_the_permalink( $item_row_data['post_obj'] );
                                } else {
                                    $link_val = '#';
                                }

                                if( ! empty( $item_row_data['custom_title'] ) ) {
                                    $title_val = $item_row_data['custom_title'];
                                } elseif( ! empty( $item_row_data['post_obj'] ) ) {
                                    $title_val = get_the_title( $item_row_data['post_obj'] );
                                } else {
                                    $title_val = __('Service', 'icoda');
                                }

                                if( ! empty( $item_row_data['description'] ) ) {
                                    $desc_val = $item_row_data['description'];
                                } else {
                                    $desc_val = '';
                                }

                                if( ! empty( $item_row_data['custom_label'] ) ) {
                                    $label_val = $item_row_data['custom_label'];
                                } elseif( ! empty( $item_row_data['is_hot'] ) ) {
                                    $label_val = __('hot', 'icoda');
                                } else {
                                    $label_val = '';
                                }
                                $services[] = [
                                    'section_2_link-en' => $link_val,
                                    'section_2_title-en' => $title_val,
                                    'section_2_desc-en' => $desc_val,
                                    'section_2_label-en' => $label_val
                                ];
                            }
                        }
                    ?>

                    <div class="col-12 col-md-6 col-lg-4 col-main d-flex flex-column justify-content-end">
                        <div class="text">
                            <h3 class="section-title"><?php the_field('section_2_title_block-en'); ?></h3>
                            <p class="sub-text"><?php the_field('section_2_subtitle_block-en'); ?></p>

                            <div class="d-lg-none d-xl-none mobile-block">
                                <?php $index = 0; ?>
                                <?php foreach ($services as $service_item) : ?>
                                    <?php $index++; ?>
                                    <?php if ($index >= 4) {
                                        continue;
                                    } ?>
                                    <a href="<?php echo $service_item['section_2_link-en']; ?>" class="service-card hot">
                                        <span class="h6"><?php echo $service_item['section_2_title-en']; ?></span>
                                        <span class="sub-text">
                                            <span class="p"><?php echo $service_item['section_2_desc-en']; ?></span>
                                        </span>
                                        <span class="service-card-footer">
                                            <span class="link-arrow"><?php echo __('Learn more', 'icoda'); ?></span>
                                            <?php if ($service_item['section_2_label-en']) : ?>
                                                <span class="label-hot"><?php echo $service_item['section_2_label-en']; ?></span>
                                            <?php endif ?>
                                        </span>
                                    </a>
                                <?php endforeach; ?>
                            </div>

                            <div class="wr-btn">
                                <a href="<?php echo home_url('/services/'); ?>" class="btn btn-blue btn-show-el"><?php echo __('Show all services', 'icoda'); ?></a>
                            </div>
                        </div>

                        <div class="desktop-block d-none d-lg-block d-xl-block">
                            <?php $index = 0; ?>
                            <?php foreach ($services as $service_item) : ?>
                                <?php $index++; ?>
                                <?php if ($index >= 4) {
                                    continue;
                                } ?>
                                <a href="<?php echo $service_item['section_2_link-en']; ?>" class="service-card hot">
                                    <span class="h6"><?php echo $service_item['section_2_title-en']; ?></span>
                                    <span class="sub-text">
                                        <span class="p"><?php echo $service_item['section_2_desc-en']; ?></span>
                                    </span>
                                    <span class="service-card-footer">
                                        <span class="link-arrow"><?php echo __('Learn more', 'icoda'); ?></span>
                                        <?php if ($service_item['section_2_label-en']) : ?>
                                            <span class="label-hot"><?php echo $service_item['section_2_label-en']; ?></span>
                                        <?php endif ?>
                                    </span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="d-none d-lg-flex col-lg-4 flex-column justify-content-end">
                        <?php $index = 0; ?>
                        <?php foreach ($services as $service_item) : ?>
                            <?php $index++; ?>
                            <?php if ($index < 4 || $index >= 8) {
                                continue;
                            } ?>
                            <a href="<?php echo $service_item['section_2_link-en']; ?>" class="service-card hot">
                                <span class="h6"><?php echo $service_item['section_2_title-en']; ?></span>
                                <span class="sub-text">
                                    <span class="p"><?php echo $service_item['section_2_desc-en']; ?></span>
                                </span>
                                <span class="service-card-footer">
                                    <span class="link-arrow"><?php echo __('Learn more', 'icoda'); ?></span>
                                    <?php if ($service_item['section_2_label-en']) : ?>
                                        <span class="label-hot"><?php echo $service_item['section_2_label-en']; ?></span>
                                    <?php endif ?>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <div class="d-none d-lg-flex col-lg-4 last-col flex-column justify-content-end">
                        <?php $index = 0; ?>
                        <?php foreach ($services as $service_item) : ?>
                            <?php $index++; ?>
                            <?php if ($index < 8 || $index >= 12) {
                                continue;
                            } ?>
                            <a href="<?php echo $service_item['section_2_link-en']; ?>" class="service-card hot">
                                <span class="h6"><?php echo $service_item['section_2_title-en']; ?></span>
                                <span class="sub-text">
                                    <span class="p"><?php echo $service_item['section_2_desc-en']; ?></span>
                                </span>
                                <span class="service-card-footer">
                                    <span class="link-arrow"><?php echo __('Learn more', 'icoda'); ?></span>
                                    <?php if ($service_item['section_2_label-en']) : ?>
                                        <span class="label-hot"><?php echo $service_item['section_2_label-en']; ?></span>
                                    <?php endif ?>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if (get_field('recent_cases_show') && empty( $_GET['show_new_cases'] )) : ?>
        <section class="section cases">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="section-title"><?php the_field('recent_cases_title'); ?></h3>
                    </div>
                </div>

                <?php $recent_cases = get_field('recent_cases_cases'); ?>
                <?php
                $last_recent_cases_query = new WP_Query(
                    [
                        'post_type' => 'post',
                        'category_name' => 'cases',
                        'orderby' => 'DATE',
                        'order' => 'DESC',
                        'posts_per_page' => 3
                    ]
                );
                ?>
                <div class="wr-slider">
                    <div class="cases-slider custom-slider">
                        <?php if ($last_recent_cases_query->have_posts()) : ?>
                            <?php while ($last_recent_cases_query->have_posts()) : ?>
                                <?php $last_recent_cases_query->the_post(); ?>
                                <div class="col-item">
                                    <div class="service-card-wrap">
                                        <a href="<?php echo get_the_permalink(); ?>" class="service-card">
                                            <div class="blog-img">
                                                <img src="<?php echo !empty(get_field('case_front_image', get_the_ID())) ? get_field('case_front_image', get_the_ID()) : get_the_post_thumbnail_url(); ?>" alt="">
                                            </div>
                                            <div class="cases-content">
                                                <p class="h5 text-center"><?php echo get_the_title(); ?></p>
                                                <?php if (!empty(get_field('case_post_logo', get_the_ID()))) : ?>
                                                    <div class="cases-logo">
                                                        <img class="" src="<?php echo get_field('case_post_logo', get_the_ID()); ?>" alt="logo">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php elseif (!empty($recent_cases)) : ?>
                            <?php foreach ($recent_cases as $recent_case_item) : ?>
                                <div class="col-item">
                                    <div class="service-card-wrap">
                                        <a href="<?php echo get_the_permalink($recent_case_item['case_post']); ?>" class="service-card">
                                            <div class="img">
                                                <img src="<?php echo $recent_case_item['top_image']; ?>" alt="abcc">
                                            </div>
                                            <p class="h5 text-center"><?php echo $recent_case_item['title']; ?></p>
                                            <div class="footer">
                                                <img class="" src="<?php echo $recent_case_item['bottom_logo']; ?>" alt="abcc-logo">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="slider-control wr-control-cases"></div>
                </div>

                <div class="row justify-content-center">
                    <div class="wr-btn mt-5">
                        <a href="<?php echo home_url('/cases/'); ?>" class="btn btn-blue btn-show-el"><?php echo __('Show all cases', 'icoda'); ?></a>
                    </div>
                </div>

            </div>
        </section>
    <?php endif; ?>

    <?php if (!empty($_GET['show_new_cases'])) : ?>

        <?php
            $portfolio_cases = new WP_Query([
                'post_type' => 'portfolio-case',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'fields' => 'ids'
            ]);
            ?>

        <section class="section cases-new">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="section-title"><?php the_field('recent_cases_title'); ?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="cases-new-descktop">
                            <ul class="case-list">

                                <?php foreach( $portfolio_cases->posts as $portfolio_case_id ) : ?>

                                    <?php
                                        $portfolio_case_name = get_field( 'portfolio_short_name', $portfolio_case_id );
                                        $portfolio_services = get_field( 'portfolio_services_list', $portfolio_case_id );
                                        if( !empty($portfolio_services) ) {
                                            $portfolio_services = explode("\n", $portfolio_services);
                                            $portfolio_services = array_map('trim', $portfolio_services);
                                            $portfolio_services = implode(", ", $portfolio_services) . '.';
                                        }
                                        $portfolio_year = get_field( 'portfolio_year', $portfolio_case_id );
                                        $portfolio_image_on_home = get_field( 'portfolio_image_on_home', $portfolio_case_id );
                                        if( empty( $portfolio_image_on_home ) ) {
                                            $portfolio_image_on_home = get_the_post_thumbnail_url( $portfolio_case_id );
                                        }
                                        if( empty( $portfolio_case_name ) ) {
                                            $portfolio_case_name = get_the_title( $portfolio_case_id );
                                        }

                                        ?>

                                    <li class="layer card-wrapper">
                                        <a href="<?php echo get_the_permalink( $portfolio_case_id ); ?>" target="_blank"><?php echo $portfolio_case_name; ?><sup><?php echo empty( $portfolio_year ) ? '2022' : $portfolio_year; ?></sup></a>
                                        <?php if( ! empty( $portfolio_services ) ) : ?>
                                        <p><?php echo strtolower( $portfolio_services ); ?></p>
                                        <?php endif; ?>
                                        <div class="case-img case-img-banxe card">
                                            <img src="<?php echo $portfolio_image_on_home; ?>" alt="<?php echo $portfolio_case_name; ?>" />
                                        </div>
                                    </li>

                                <?php endforeach; ?>

                            </ul>
                        </div>
                        <div class="cases-new-mobile">
                            <ul class="case-list case-new-slider custom-slider">


                            <?php foreach( $portfolio_cases->posts as $portfolio_case_id ) : ?>

                                <?php
                                    $portfolio_case_name = get_field( 'portfolio_short_name', $portfolio_case_id );
                                    $portfolio_services = get_field( 'portfolio_services_list', $portfolio_case_id );
                                    if( !empty($portfolio_services) ) {
                                        $portfolio_services = explode("\n", $portfolio_services);
                                        $portfolio_services = array_map('trim', $portfolio_services);
                                        $portfolio_services = implode(", ", $portfolio_services) . '.';
                                    }
                                    $portfolio_year = get_field( 'portfolio_year', $portfolio_case_id );
                                    $portfolio_image_on_home = get_field( 'portfolio_image_on_home', $portfolio_case_id );
                                    if( empty( $portfolio_image_on_home ) ) {
                                        $portfolio_image_on_home = get_the_post_thumbnail_url( $portfolio_case_id );
                                    }
                                    if( empty( $portfolio_case_name ) ) {
                                        $portfolio_case_name = get_the_title( $portfolio_case_id );
                                    }

                                    ?>

                                <li>
                                    <a href="<?php echo get_the_permalink( $portfolio_case_id ); ?>" target="_blank" class="case-img">
                                        <img src="<?php echo $portfolio_image_on_home; ?>" alt="<?php echo $portfolio_case_name; ?>" />
                                    </a>
                                    <a class="case-title" href="#" target="_blank"><?php echo $portfolio_case_name; ?><sup><?php echo empty( $portfolio_year ) ? '2022' : $portfolio_year; ?></sup></a>
                                    <?php if( ! empty( $portfolio_services ) ) : ?>
                                    <p><?php echo strtolower( $portfolio_services ); ?></p>
                                    <?php endif; ?>
                                </li>

                            <?php endforeach; ?>

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    <?php endif; ?>

    <?php if (get_field('section_3_show')) : ?>
        <section class="section section-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-5 pr-0">
                        <div class="text-box">
                            <div class="text">
                                <h3 class="section-title"><?php the_field('section_3_title_block-new-en'); ?></h3>
                                <p class="sub-text"><?php the_field('section_3_text_block-en'); ?></p>
                            </div>
                            <div class="label-list-desktop">
                                <div class="label-list">
                                    <?php foreach (get_field('section_3_repeater_block-en') as $item) : ?>
                                        <div class="label-list-item"><?= $item['t']; ?></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="label-list-mobile">
                                <div class="label-list label-slider custom-slider">
                                    <?php foreach (get_field('section_3_repeater_block-en') as $item) : ?>
                                        <div class="label-list-item"><?= $item['t']; ?></div>
                                    <?php endforeach; ?>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-12 col-lg-7 col-custom">
                        <div class="img-block">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/for-whom-do-we-work.jpg" alt="for-whom-do-we-work">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if (get_field('section_4_show')) : ?>
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
        <?php
        $general_testimonials = get_field('icoda_gb_testimonials', 'option');
        ?>
        <section id="testimonials" class="section section-testimonials">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php
                        $title = get_field('section_9_title-en');
                        if (empty($title)) {
                            $title = __('Testimonials', 'icoda');
                        }
                        ?>
                        <h3 class="section-title"><?php echo $title; ?></h3>
                    </div>
                    <div class="col-12">
                        <div class="wr-slider">
                            <div class="slider-default custom-slider">

                                <?php while (has_sub_field('testimonials_repeat')) : ?>
                                    <div class="wr-slider-default-item">
                                        <div class="slider-default-item">
                                            <div class="slider-default-item-header">
                                                <div class="profile-box">
                                                    <div class="profile-box-avatar">
                                                        <img class="skip-lazy" src="<?php the_sub_field('testimonials_image'); ?>" alt="avatar" />
                                                    </div>
                                                    <div class="profile-box-des">
                                                        <p class="h5"><?php the_sub_field('testimonials_firstname');
                                                                        the_sub_field('testimonials_lastname') ?></p>
                                                        <a href="<?php the_sub_field('testimonials_linkedin'); ?>" class="profile-link" target="_blank"><?php echo __('LinkedIn Profile', 'icoda'); ?></a>
                                                    </div>
                                                </div>
                                                <div class="slider-logo-box">
                                                    <img class="skip-lazy" src="<?php the_sub_field('logo'); ?>" alt="logo-project" />
                                                    <?php // data-lazy="<?php the_sub_field('logo'); ?>
                                                </div>
                                            </div>
                                            <div class="slider-default-item-body">
                                                <p><?php the_sub_field('testimonials_desc'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>

                                <?php if (!empty($general_testimonials)) : ?>
                                    <?php foreach ($general_testimonials as $general_testimonials_item) : ?>
                                        <?php
                                        if ($general_testimonials_item['hide_testimonial']) {
                                            continue;
                                        }
                                        ?>
                                        <div class="wr-slider-default-item">
                                            <div class="slider-default-item">
                                                <div class="slider-default-item-header">
                                                    <div class="profile-box">
                                                        <?php if (!empty($general_testimonials_item['avatar'])) : ?>
                                                            <?php $avatar_img_url = wp_get_attachment_image_url($general_testimonials_item['avatar']); ?>
                                                            <div class="profile-box-avatar">
                                                                <img class="skip-lazy" src="<?php echo $avatar_img_url; ?>" alt="<?php echo get_post_meta($general_testimonials_item['avatar'], '_wp_attachment_image_alt', true); ?>">
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="profile-box-des">
                                                            <p class="h5"><?= $general_testimonials_item['name']; ?></p>
                                                            <?php if (!empty($general_testimonials_item['linkedin'])) : ?>
                                                                <a href="<?php echo $general_testimonials_item['linkedin']; ?>" class="profile-link" target="_blank"><?php echo __('LinkedIn Profile', 'icoda'); ?></a>
                                                            <?php endif; ?>
                                                            <?php if (!empty($general_testimonials_item['youtube'])) : ?>
                                                                <?php
                                                                $youtube_link_text = !empty($general_testimonials_item['youtube_link_text']) ? $general_testimonials_item['youtube_link_text'] :  __('Youtube Chanel', 'icoda');
                                                                ?>
                                                                <a href="<?php echo $general_testimonials_item['youtube']; ?>" target="_blank" class="profile-link"><?php echo $youtube_link_text; ?></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <?php if (!empty($general_testimonials_item['logo'])) : ?>
                                                        <?php $logo_img_url = wp_get_attachment_image_url($general_testimonials_item['logo']); ?>
                                                        <div class="slider-logo-box">
                                                            <img class="skip-lazy" src="<?php echo $logo_img_url; ?>" alt="logo-project">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="slider-default-item-body">
                                                    <?php echo $general_testimonials_item['content']; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                            <div class="wr-control wr-control-testimonials"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <div class="section decoration-section decoration-section-under-testimonials">
        <canvas id="waves-second" class="canvas-waves"></canvas>
    </div>

    <?php if (get_field('section_5_show') == true) : ?>
        <?php
        $section_5_gb_data = get_field('section_5_gb_data');
        if ($section_5_gb_data) {
            $some_brands = get_field('icoda_gb_some_brands', 'option');
        }
        ?>
        <section class="section section-5 home-brands">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="text">
                            <h3 class="section-title"><?php the_field('section_8_title-en'); ?></h3>
                            <p class="sub-text"><?php the_field('section_8_subtitle-en'); ?></p>
                            <a data-toggle="collapse" href="#" class="link-arrow d-none d-lg-block" role="button" data-target=".multi-collapse-project-card" aria-expanded="false"><?php echo __('Show all brands', 'icoda'); ?></a>
                        </div>
                    </div>
                    <?php $count = 0; ?>

                    <?php if ($section_5_gb_data && !empty($some_brands['projects'])) : ?>
                        <?php foreach ($some_brands['projects'] as $project_item) : $count++; ?>
                            <div class="col-sm-6 col-lg-4 d-none d-lg-block col-card">
                                <?php if ($count > 8) : ?>
                                    <div class="collapse multi-collapse-project-card">
                                    <?php endif; ?>
                                    <div class="project-card">
                                        <div class="project-card-header">
                                            <div class="project-card-logo">
                                                <img data-src="<?php echo $project_item['logo']; ?>" src="<?php echo $project_item['logo']; ?>" alt="logo-project">
                                            </div>
                                            <div class="project-card-flag" data-bg="<?php echo $project_item['flag']; ?>" style="background: url() center no-repeat;"></div>
                                        </div>
                                        <div class="project-card-body">
                                            <p><span><?php echo $project_item['name']; ?></span> <?php echo $project_item['description']; ?></p>
                                        </div>
                                    </div>
                                    <?php if ($count > 8) : ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <?php while (has_sub_field('our_clients_repeat')) : $count++; ?>
                            <div class="col-sm-6 col-lg-4 d-none d-lg-block col-card">
                                <?php if ($count > 8) : ?>
                                    <div class="collapse multi-collapse-project-card">
                                    <?php endif; ?>
                                    <div class="project-card">
                                        <div class="project-card-header">
                                            <div class="project-card-logo">
                                                <img data-src="<?php the_sub_field('our_clients_logo'); ?>" src="<?php the_sub_field('our_clients_logo'); ?>" alt="logo-project">
                                            </div>
                                            <div class="project-card-flag" data-bg="<?php the_sub_field('country'); ?>" style="background: url() center no-repeat;"></div>
                                        </div>
                                        <div class="project-card-body">
                                            <p><?php the_sub_field('our_clients_desc'); ?></p>
                                        </div>
                                    </div>
                                    <?php if ($count > 8) : ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>

                <div class="mobile-project-card">
                    <div class="project-card-slider custom-slider">
                        <?php if ($section_5_gb_data && !empty($some_brands['projects'])) : ?>
                            <?php foreach ($some_brands['projects'] as $project_item) : $count++; ?>
                                <div class="project-card-slider-inner">
                                    <div class="col-sm-12 col-lg-4">
                                        <div class="project-card">
                                            <div class="project-card-header">
                                                <div class="project-card-logo">
                                                    <img data-src="<?php echo $project_item['logo']; ?>" src="<?php echo $project_item['logo']; ?>" alt="logo-project">
                                                </div>
                                                <div class="project-card-flag" data-bg="<?php echo $project_item['flag']; ?>" style="background: url() center no-repeat;"></div>
                                            </div>
                                            <div class="project-card-body">
                                                <p><span><?php echo $project_item['name']; ?></span> <?php echo $project_item['description']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <?php while (has_sub_field('our_clients_repeat')) : $count++; ?>
                                <div class="project-card-slider-inner">
                                    <div class="col-sm-12 col-lg-4">
                                        <div class="project-card">
                                            <div class="project-card-header">
                                                <div class="project-card-logo">
                                                    <img data-src="<?php the_sub_field('our_clients_logo'); ?>" src="<?php the_sub_field('our_clients_logo'); ?>" alt="logo-project">
                                                </div>
                                                <div class="project-card-flag" data-bg="<?php the_sub_field('country'); ?>" style="background: url() center no-repeat;"></div>
                                            </div>
                                            <div class="project-card-body">
                                                <p><?php the_sub_field('our_clients_desc'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <div class="wr-btn">
                        <a href="<?php echo home_url('/cases/'); ?>" class="btn btn-blue btn-show-el"><?php echo __('Show all cases', 'icoda'); ?></a>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>


    <?php if (get_field('section_7_show') == true) : ?>
        <section class="section section-7">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="section-title"><?php the_field('section_7_title_block-new-en'); ?></h3>
                    </div>
                </div>
                <?php // get_template_part( 'template-parts/leadership-slider'); ?>
                <div class="list-leadership-desktop">
                    <div class="row list-leadership">
                        <?php foreach (get_field('section_7-new_list-en') as $item) : $count++; ?>
                            <div class="col-lg-3">
                                <div class="list-leadership-item">

                                    <div class="leadership-item-avatar" data-bg="<?php echo $item['image']; ?>" style="background-image:url(<?php echo $item['image']; ?>);"></div>
                                    <div class="leadership-item-des">
                                        <div class="title-wrap d-flex justify-content-between w-100">
                                            <span class="h6"><?= $item['name']; ?></span>

                                            <span class="leadership-contact-icons m-0">
                                                <?php echo ($item['author_page'] ? '<a href="' . $item['author_page'] . '"><i class="fas fa-user"></i></a>' : ''); ?>
                                            </span>
                                        </div>
                                        <div class="position-twitter-block">
                                            <span class="leadership-des-position"><?= $item['position']; ?> </span>
                                        </div>

                                        <span class="leadership-des-text"><?= $item['desc']; ?></span>

                                        <div class="leadership-social">
                                            <div class="btn-twitter">
                                                <?php if (!empty($item['twitter'])) : ?>
                                                    <span class="leadership-des-twitter">
                                                        <a class="btn" href="<?= $item['twitter']; ?>" target="_blank">
                                                            <svg width="13" height="11" viewBox="0 0 13 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12.8067 2.17427C12.3544 2.37469 11.8685 2.5101 11.3577 2.57131C11.8847 2.25595 12.279 1.75961 12.467 1.1749C11.9719 1.46901 11.4299 1.67604 10.8648 1.78698C10.4847 1.3812 9.98135 1.11224 9.43279 1.02186C8.88422 0.931482 8.32116 1.02474 7.83103 1.28716C7.3409 1.54957 6.95111 1.96647 6.72219 2.47311C6.49327 2.97975 6.43803 3.5478 6.56503 4.08906C5.56169 4.03868 4.58016 3.7779 3.68413 3.32364C2.78811 2.86937 1.99761 2.23177 1.36394 1.45223C1.14728 1.82598 1.02269 2.25931 1.02269 2.72081C1.02245 3.13627 1.12476 3.54536 1.32054 3.91179C1.51633 4.27822 1.79953 4.59067 2.14503 4.8214C1.74434 4.80865 1.3525 4.70038 1.00211 4.5056V4.5381C1.00207 5.1208 1.20363 5.68556 1.57258 6.13656C1.94154 6.58756 2.45517 6.89702 3.02632 7.01244C2.65462 7.11303 2.26492 7.12785 1.88665 7.05577C2.0478 7.55714 2.36169 7.99558 2.78439 8.30969C3.20709 8.6238 3.71744 8.79787 4.24399 8.80752C3.35015 9.5092 2.24626 9.88982 1.1099 9.88814C0.908608 9.8882 0.707485 9.87644 0.507568 9.85294C1.66103 10.5946 3.00375 10.9882 4.37507 10.9866C9.01715 10.9866 11.5549 7.14189 11.5549 3.8074C11.5549 3.69906 11.5522 3.58964 11.5473 3.48131C12.0409 3.12434 12.467 2.6823 12.8056 2.1759L12.8067 2.17427Z" fill="currentColor" />
                                                            </svg>
                                                            Twitter
                                                        </a>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="btn-linkedin">
                                                <?php echo ($item['link'] ? '<a class="btn" href="' . $item['link'] . '" target="_blank"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3.178 14V4.55423H0.176939V14H3.178ZM1.67786 3.26379C2.72438 3.26379 3.37579 2.53846 3.37579 1.63205C3.35629 0.705194 2.72442 0 1.69772 0C0.671174 0 -0.00012207 0.705208 -0.00012207 1.63205C-0.00012207 2.53851 0.651127 3.26379 1.65826 3.26379H1.67776H1.67786ZM4.83907 14H7.84013V8.72502C7.84013 8.44271 7.85963 8.16069 7.93888 7.95888C8.15583 7.39484 8.64963 6.81065 9.47865 6.81065C10.5646 6.81065 10.999 7.67685 10.999 8.94665V13.9999H13.9999V8.58382C13.9999 5.68244 12.5194 4.33247 10.5448 4.33247C8.92589 4.33247 8.21506 5.27917 7.82017 5.92397H7.8402V4.55403H4.83914C4.87852 5.44037 4.83914 13.9998 4.83914 13.9998L4.83907 14Z" fill="currentColor"/>
                                                    </svg>LinkedIn</a>' : ''); ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- slider -->
                <div class="list-leadership-mobile">
                    <div class="list-leadership">
                        <div class="leadership-slider custom-slider">
                            <?php foreach (get_field('section_7-new_list-en') as $item) : $count++; ?>

                                <div class="list-leadership-item">

                                    <div class="leadership-item-avatar" data-bg="<?php echo $item['image']; ?>" style="background-image:url(<?php echo $item['image']; ?>);"></div>
                                    <div class="leadership-item-des">
                                        <div class="title-wrap d-flex justify-content-between w-100">
                                            <span class="h6"><?= $item['name']; ?></span>

                                            <span class="leadership-contact-icons m-0">
                                                <?php echo ($item['author_page'] ? '<a href="' . $item['author_page'] . '"><i class="fas fa-user"></i></a>' : ''); ?>
                                            </span>
                                        </div>
                                        <div class="position-twitter-block">
                                            <span class="leadership-des-position"><?= $item['position']; ?> </span>
                                        </div>

                                        <span class="leadership-des-text"><?= $item['desc']; ?></span>

                                        <div class="leadership-social">
                                            <div class="btn-twitter">
                                                <?php if (!empty($item['twitter'])) : ?>
                                                    <span class="leadership-des-twitter">
                                                        <a class="btn" href="<?= $item['twitter']; ?>" target="_blank">
                                                            <svg width="13" height="11" viewBox="0 0 13 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12.8067 2.17427C12.3544 2.37469 11.8685 2.5101 11.3577 2.57131C11.8847 2.25595 12.279 1.75961 12.467 1.1749C11.9719 1.46901 11.4299 1.67604 10.8648 1.78698C10.4847 1.3812 9.98135 1.11224 9.43279 1.02186C8.88422 0.931482 8.32116 1.02474 7.83103 1.28716C7.3409 1.54957 6.95111 1.96647 6.72219 2.47311C6.49327 2.97975 6.43803 3.5478 6.56503 4.08906C5.56169 4.03868 4.58016 3.7779 3.68413 3.32364C2.78811 2.86937 1.99761 2.23177 1.36394 1.45223C1.14728 1.82598 1.02269 2.25931 1.02269 2.72081C1.02245 3.13627 1.12476 3.54536 1.32054 3.91179C1.51633 4.27822 1.79953 4.59067 2.14503 4.8214C1.74434 4.80865 1.3525 4.70038 1.00211 4.5056V4.5381C1.00207 5.1208 1.20363 5.68556 1.57258 6.13656C1.94154 6.58756 2.45517 6.89702 3.02632 7.01244C2.65462 7.11303 2.26492 7.12785 1.88665 7.05577C2.0478 7.55714 2.36169 7.99558 2.78439 8.30969C3.20709 8.6238 3.71744 8.79787 4.24399 8.80752C3.35015 9.5092 2.24626 9.88982 1.1099 9.88814C0.908608 9.8882 0.707485 9.87644 0.507568 9.85294C1.66103 10.5946 3.00375 10.9882 4.37507 10.9866C9.01715 10.9866 11.5549 7.14189 11.5549 3.8074C11.5549 3.69906 11.5522 3.58964 11.5473 3.48131C12.0409 3.12434 12.467 2.6823 12.8056 2.1759L12.8067 2.17427Z" fill="currentColor" />
                                                            </svg>
                                                            Twitter
                                                        </a>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="btn-linkedin">
                                                <?php echo ($item['link'] ? '<a class="btn" href="' . $item['link'] . '" target="_blank"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3.178 14V4.55423H0.176939V14H3.178ZM1.67786 3.26379C2.72438 3.26379 3.37579 2.53846 3.37579 1.63205C3.35629 0.705194 2.72442 0 1.69772 0C0.671174 0 -0.00012207 0.705208 -0.00012207 1.63205C-0.00012207 2.53851 0.651127 3.26379 1.65826 3.26379H1.67776H1.67786ZM4.83907 14H7.84013V8.72502C7.84013 8.44271 7.85963 8.16069 7.93888 7.95888C8.15583 7.39484 8.64963 6.81065 9.47865 6.81065C10.5646 6.81065 10.999 7.67685 10.999 8.94665V13.9999H13.9999V8.58382C13.9999 5.68244 12.5194 4.33247 10.5448 4.33247C8.92589 4.33247 8.21506 5.27917 7.82017 5.92397H7.8402V4.55403H4.83914C4.87852 5.44037 4.83914 13.9998 4.83914 13.9998L4.83907 14Z" fill="currentColor"/>
                                                    </svg>LinkedIn</a>' : ''); ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            <?php endforeach; ?>
                        </div>
                        <div class="wr-control wr-control-leadership"></div>
                    </div>
                </div>


            </div>
        </section>
    <?php endif; ?>

    <?php get_template_part( 'template-parts/sections/meet-up'); ?>


    <?php if (get_field('section_contact_us_show') == true) : ?>
        <?php get_template_part('template-parts/sections/contact-us'); ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>