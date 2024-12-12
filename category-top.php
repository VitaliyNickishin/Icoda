<?php
get_header();
?>
<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>
<?php global $wp_query; ?>
<div class="container section-content">
    <div class="row">
        <div class="col-12 mb-2 mb-md-3">
            <?php the_breadcrumbs(); ?>
        </div>

        <div class="col-12 mb-3 mb-md-5">

            <h1><?php single_cat_title(); ?></h1>

            <?php echo category_description(); ?>

        </div>

        <?php get_sidebar('blog'); ?>

        <div class="col-md-9 blog-post_list">
            <div class="row">

                <?php if (have_posts()) : ?>
                    <?php $index = 1; ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php
                        $lg_class = 'col-lg-4';
                        $title = get_the_title(get_the_ID());
                        $excerpt = get_the_excerpt(get_the_ID());
                        if ($index == 1 || $index == 2 || $index == 6 || $index == 7) {
                            $lg_class = 'col-lg-6 has-big-card';
                            $title = mb_strimwidth($title, 0, 90, "...");
                        } else {
                            $title = mb_strimwidth($title, 0, 45, "...");
                        }
                        $excerpt = mb_strimwidth($excerpt, 0, 100, "...");
                        ?>
                        <div class="col-12 col-md-6 mb-lg-5 mb-3 <?php echo $lg_class; ?>">
                            <a href="<?php the_permalink(); ?>" class="service-card cases-card hot">

                                <?php if (has_post_thumbnail()) : ?>
                                    <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
                                    <?php
                                    $alt_text = '';
                                    if (get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) {
                                        $alt_text = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
                                    } else {
                                        $alt_text = get_the_title(get_the_ID());
                                    }
                                    ?>
                                    <div class="blog-img">
                                        <img src="<?php echo $featured_img_url; ?>" alt="<?php echo $alt_text; ?>">
                                    </div>

                                <?php endif; ?>

                                <div class="blog-card-content">
                                    <span class="h6"><?php echo $title; ?></span>
                                    <div class="sub-text">
                                        <p><?php echo $excerpt; ?></p>
                                    </div>
                                    <?php get_template_part('template-parts/article-card-meta-info'); ?>
                                </div>

                            </a>
                        </div>
                        <?php $index++; ?>
                    <?php endwhile; ?>


                    <?php if ($wp_query->max_num_pages > 1) : ?>
                        <div class="col-12 col-md-12 col-lg-12 load-more anchor-loader">
                            <div class="text-center wr-btn">
                                <a href="#" class="btn btn-default btn-show-el"><?php echo __('Load more', 'icoda'); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <p><?php _e('Nothing was found for these criteria.', 'icoda'); ?></p>
                <?php endif; ?>

            </div>
        </div>

    </div>
</div>

<?php
get_footer();
