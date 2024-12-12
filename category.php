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

        <div class="col-12">
            <h1><?php single_cat_title(); ?></h1>
            <?php echo category_description(); ?>
        </div>

        <div class="blog-post_list col-12 my-3 my-md-5">
            <div class="row">

                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-12 col-md-6 col-lg-4">
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
                                    <span class="h6"><?php the_title(); ?></span>
                                    <div class="sub-text">
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>

                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>

            </div>
        </div>
        <?php if ($wp_query->max_num_pages > 1) : ?>
            <div class="col-12 col-md-12 col-lg-12 load-more">
                <div class="text-center wr-btn">
                    <a href="#" class="btn btn-default btn-show-el"><?php echo __('Load more', 'icoda'); ?></a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
