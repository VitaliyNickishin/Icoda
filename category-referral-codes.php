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
            <div class="mb-4 mb-lg-5 pt-2 pt-lg-5">
                <?php echo get_search_form(); ?>
            </div>
             <h1 class="h2 mb-1 mt-4 font-weight-bold title-opacity">
                <?php single_cat_title(); ?>
            </h1>
            <div class="undertitle">
                <?php echo category_description(); ?>
            </div>
        </div>

    </div>

    <div class="row mt-lg-5 pt-lg-1 blog-post_list">
        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>
                <?php
                $referral_code = get_field('category_extra_field_with_referral_code', get_the_ID());
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
                                    <?php if ( !empty($referral_code)) : ?>
                                        <div class="btn btn-copy-promo d-flex align-items-center px-0">
                                            <svg fill="currentColor" width="32px" height="32px" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;}</style></defs><title>copy</title><path d="M28,10V28H10V10H28m0-2H10a2,2,0,0,0-2,2V28a2,2,0,0,0,2,2H28a2,2,0,0,0,2-2V10a2,2,0,0,0-2-2Z" transform="translate(0)"/><path d="M4,18H2V4A2,2,0,0,1,4,2H18V4H4Z" transform="translate(0)"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"/></svg>
                                            
                                            <span data-referral-value class="d-none"><?php echo $referral_code; ?></span>
                                            <span data-btn-copy class="px-2 py-1 position-relative d-flex align-items-center" data-code-copied="<?php _e('Copied promo code', 'icoda'); ?>">
                                                <?php _e('Copy promo code', 'icoda'); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                    
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
					$post_id = get_post($module_id);
					if ($post_id) 
					{
						echo apply_filters('the_content', $post_id->post_content);
					}
				}
		    }
			?>
</div>

<?php
get_footer();
