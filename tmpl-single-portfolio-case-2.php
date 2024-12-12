<?php

/*
Template Name: Case 2
Template Post Type: portfolio-case
*/

get_header();
$front_page_id = get_option('page_on_front');

?>
<main class="single-portfolio-case">
    <div class="breadcrumbs-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-0 pb-2 mb-lg-5 pb-lg-0">
                    <?php the_breadcrumbs(); ?>
                </div>
            </div>
        </div>
    </div>


    <section class="section-hero pt-0 pb-5 pt-lg-3 pb-lg-5">
        <div class="visual-grid d-none d-lg-block">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="visual-grid-inner">
                            <div class="grid-item"></div>
                            <div class="grid-item"></div>
                            <div class="grid-item"></div>
                            <div class="grid-item"></div>
                            <div class="grid-item"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container d-flex flex-lg-column flex-column-reverse">
            <div class="row pb-md-4">
                <div class="col-12 col-lg-4">
                    <div class="content">
                        <h1 class="h4 mb-3 m-lg-0"><?php the_title(); ?> Hi, case-2</h1>
                    </div>
                </div>
                <div class="col-12 offset-lg-2 col-lg-6">
                    <div class="description">
                        <?php echo get_field('portfolio_main_description', get_the_ID()); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3 mb-lg-0 mt-0 pt-0 mt-lg-5 pt-lg-5">
                <div class="col-12">
                    <div class="img-featured">
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="single-hero">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    the_content();
    ?>

    <?php get_template_part('template-parts/sections/contact-us', '', ['need_post_id' => $front_page_id]); ?>

</main>

<?php

get_footer(); ?>