<?php
global $post;

get_header();

?>

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

        <section class="section section-1 title-descr_block 22">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 col-xl-8">
                        <h2><?php the_title(); ?></h2>
                        <div class="sub-text ">
                            <?php
                            $faq_content = '';
                            ob_start();
                            the_content();
                            $faq_content = ob_get_clean();
                            $faq_content = str_replace('<ul>', '<ul class="marker-list">', $faq_content);
                            echo $faq_content;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php endwhile; ?>

    <?php get_template_part('template-parts/sections/contact-us', '', ['need_post_id' => get_option('page_on_front')]); ?>

<?php endif;
get_footer();
