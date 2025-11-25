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
         <div class="col-12 mb-4 mb-lg-0">
             <h1 class="h2 mb-1 mt-4 font-weight-bold title-opacity">
                <?php single_cat_title(); ?>
            </h1>
            <div class="mb-4">
                <?php echo category_description(); ?>
            </div>
        </div>

    </div>

    <?php get_template_part('template-parts/blog', 'top-post'); ?>

    <div class="row">
         <div class="col-12 mb-4 mb-lg-0">
            <div class="mb-4 mb-lg-5 pt-2 pt-lg-5">
                <?php echo get_search_form(); ?>
            </div>
        </div>

    </div>

    <div class="row mt-lg-5 pt-lg-1 blog-post_list">
        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>
                <?php
                $author_id = get_the_author_meta('ID');
                $lg_class = 'col-lg-4';
                $title = get_the_title(get_the_ID());
                $excerpt = get_the_excerpt(get_the_ID());
                $title = mb_strimwidth($title, 0, 45, "...");
                $excerpt = mb_strimwidth($excerpt, 0, 100, "...");
                ?>
                <div class="col-12 col-md-6 mb-lg-5 mb-3 <?php echo $lg_class; ?>">
                    <article class="service-card cases-card hot">
                        <a class="d-block h-100 position-absolute w-100" href="<?php the_permalink(); ?>"></a>

                        <?php if (has_post_thumbnail()) : ?>
                            <?php $featured_img_url = icoda_get_featured_image_url(get_the_ID()); ?>
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

                            <div class="blog-card-body">
                                <span class="h6"><?php echo $title; ?></span>
                                <div class="sub-text">
                                    <p><?php echo $excerpt; ?></p>
                                </div>
                            </div>

                            <div class="blog-card-footer">
                                <div class="author-meta d-flex justify-content-between align-items-center">                                    
                                    <span class="date-publish"><?php echo get_the_date('F j, Y', get_the_ID()); ?></span>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>
            <?php endwhile; ?>


            <?php if ($wp_query->max_num_pages > 1) : ?>
                <div class="col-12 col-md-12 col-lg-12 load-more anchor-loader">
                    <div class="text-center wr-btn">
                        <a href="#" class="btn btn-default btn-show-el"><?php echo __('Load more', 'icoda'); ?></a>
                    </div>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <p class="mb-5"><?php _e('Nothing was found for these criteria.', 'icoda'); ?></p>
        <?php endif; ?>
		</div>
		<?php

			$module_ids = get_field('choose_the_id_module_for_category',get_queried_object());
			if ($module_ids) 
			{
				foreach ($module_ids as $module_id) 
				{
					$post = get_post($module_id);
					if ($post) 
					{
						setup_postdata($post);
						echo apply_filters('the_content', $post->post_content);
						wp_reset_postdata();
					}
				}
		    }
			?>
</div>

<?php
get_footer();
