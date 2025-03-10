<?php

/*
Template Name: New Case
Template Post Type: post
*/

global $post;

get_header();

?>
<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>


<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <nav class="wr-breadcrumb" aria-label="breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php the_breadcrumbs(); ?>
                    </div>
                </div>
            </div>
        </nav>

        <section class="section section-cases-hero-new mt-3">
            <div class="section-cases-hero-new__inner position-relative with-gradient with-gradient-pink">
                <div class="bg-hero bg-hero-desktop d-lg-block d-none" style="background-image: url(/wp-content/uploads/2025/02/bg-hero-cases-desktop.png);"></div>
                <div class="bg-hero bg-hero-mobile d-lg-none" style="background-image: url(/wp-content/uploads/2025/02/bg-hero-cases-mobile-no-gradient-1.png);"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-7 pr-lg-3 pr-xl-5">
                            <h1 class="h1 mb-4 title">
                                <?php the_field('post_case_hero_title'); ?>
                            </h1>
                            <p class="subtitle pr-lg-5 mr-lg-5">
                                <?php the_field('post_case_hero_subtitle'); ?>
                            </p>
                            <div class="mt-4 pt-lg-3">
                                <p class="fw-semibold mb-1 cases-category-title"><?php the_field('post_case_hero_category_title'); ?></p>
                                <ul class="cases-category-list d-flex">
                                    <?php
                                    if (have_rows('post_case_hero_category_items')):
                                        while (have_rows('post_case_hero_category_items')) : the_row();
                                    ?>
                                            <li class="cases-category-item">
                                                <a href="<?php echo get_sub_field('link'); ?>">
                                                    <?php echo get_sub_field('title'); ?>
                                                </a>
                                            </li>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>

                        </div>

                        <div class="col-12 col-lg-5 col-xl-4 offset-xl-1 mt-4 pt-4 mt-lg-0 pt-lg-0">
                            <div class="cases-box">
                                <?php
                                if (have_rows('post_case_hero_info_items')):
                                    while (have_rows('post_case_hero_info_items')) : the_row();
                                ?>
                                        <div class="serv-box">
                                            <span class="number"><?php echo get_sub_field('title'); ?></span>
                                            <p><?php echo get_sub_field('text'); ?></p>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </section>

        <?php
        $post_object_id = get_queried_object_id();
        $sidebar_data = [
            'image' => get_field('case_sidebar_image', $post_object_id),
            'title' => get_field('case_sidebar_title', $post_object_id),
            'text' => get_field('case_sidebar_text', $post_object_id),
            'info_title' => get_field('case_sidebar_info_title', $post_object_id),
            'info_items' => get_field('case_sidebar_info_items', $post_object_id),
            'promo_title' => get_field('case_sidebar_promo_title', $post_object_id),
            'promo_text' => get_field('case_sidebar_promo_text', $post_object_id),
        ];
        $t_uri = get_template_directory_uri();
        ?>

        <div class="section-cases-content pt-5 pt-lg-4 mt-lg-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-4 order-lg-1">
                        <div class="section-cases-sidebar">

                            <div class="box-company-about">
                                <div class="box">
                                    <div class="box-header">
                                        <img class="logo" src="<?php echo $sidebar_data['image']['url']; ?>" alt="<?php echo $sidebar_data['image']['alt']; ?>" />
                                    </div>
                                    <div class="box-body mt-3 pt-1">
                                        <p class="h6 title fw-semibold mb-1">
                                            <?php echo $sidebar_data['title']; ?>
                                        </p>
                                        <?php echo $sidebar_data['text']; ?>
                                    </div>
                                    <div class="box-footer mt-3 pt-1">
                                        <p class="h6 title fw-semibold mb-1"><?php echo $sidebar_data['info_title']; ?></p>
                                        <ul class="list-services-perfomed">
                                            <?php foreach ($sidebar_data['info_items'] as $item_data) : ?>
                                                <li>
                                                    <a href="<?php echo $item_data['link']; ?>">
                                                        <span class="mr-1"><?php echo $item_data['title']; ?></span>
                                                        <img src="<?php echo $t_uri; ?>/assets/images/arrow-more.svg" alt="Arrow" />
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 pt-1 pt-lg-3">
                                <div class="box-feedback text-lg-left text-center">
                                    <h2 class="mb-2 pb-1 section-title text-white"><?php echo $sidebar_data['promo_title']; ?></p>
                                    </h2>
                                    <p class="text-white"><?php echo $sidebar_data['promo_text']; ?></p>
                                    <div class="btn-wrap mt-3 pt-1">
                                        <a href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/oy--5/talk-to-our-expert'});return false;" class="btn btn-outline-white"><?php echo __('Book Intro Call', 'icoda'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 mt-5 mt-lg-0">
                        <?php
                        the_content();
                        ?>
                    </div>

                </div>
            </div>
        </div>

    <?php endwhile; ?>

    <?php get_template_part('blocks/block-testimonials-v3', '', [
        'case_data' => [
            'button_text' => __('All Cases', 'icoda'),
            'button_link' => '/cases',
        ]
    ]); ?>

    <?php if (has_category('cases') || has_category('cases-zh-hans')) : ?>
        <style>
            .article-page .section.section-form {
                padding-bottom: 80px;
                padding-top: 50px;
            }

            .section-form .l-box .text-vert {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-direction: column;
                flex-direction: column;
                margin-top: auto;
                margin-bottom: auto;
            }

            .section-form .l-box .h4 {
                max-width: 233px;
                padding-bottom: 25px;
            }

            .section-form .wr-form {
                padding-left: 50px;
            }

            .section-form .row-vert {
                -ms-flex-align: center;
                align-items: center;
            }

            @media (max-width: 767.98px) {

                .section-form .l-box,
                .section-form .wr-form {
                    padding-left: 0;
                }

                .section-form .l-box {
                    min-height: auto;
                    padding-bottom: 40px;
                }
            }
        </style>
        <?php echo do_shortcode('[contact-form-new]'); ?>

    <?php endif; ?>

<?php endif; ?>


<?php
get_footer();
