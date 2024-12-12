<?php
/*
Template Name: Blog
Template Post Type: page
*/

get_header();
?>
    <script>
        window.intercomSettings = {
            app_id: "gdz549ih"
        };
    </script>

    <div class="container section-content">
        <div class="row">
            <div class="col-12 mb-2 mb-md-3">
                <?php the_breadcrumbs(); ?>
            </div>

            <div class="col-12">

                <h2><?php echo __('Blog', 'icoda'); ?></h2>

            </div>

            <div class="col-12  my-3 my-md-5">
                <div class="row">

                    <?php while ( have_posts() ) :
                        the_post(); ?>

                        <div class="col-12 col-md-6">
                            <a href="<?php the_permalink(); ?>" class="service-card cases-card hot">

                                <?php if ( has_post_thumbnail()) : ?>
                                    <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'cases-list'); ?>

                                    <img src="<?php echo $featured_img_url; ?>" alt="<?php echo get_the_title(get_the_ID()); ?>">

                                <?php endif; ?>

                                <div class="cases-card-content">
                                    <span class="h6"><?php the_title(); ?></span>
                                    <span class="sub-text">
                                        <span class="p"><?php the_excerpt(); ?></span>
                                    </span>
                                    <span class="service-card-footer">
                                        <span class="link-arrow"><?php echo __('Learn more', 'icoda'); ?></span>
                                    </span>
                                </div>

                            </a>
                        </div>

                    <?php endwhile; ?>

                </div>
            </div>

        </div>
    </div>

<?php
get_footer(); ?>