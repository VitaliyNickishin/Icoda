<?php $top_post = icoda_get_top_post_for_blog_pages(); ?>
<?php if (!empty($top_post)) : ?>

    <div class="row">
        <?php
        $author_id = $top_post->post_author;
        $title = get_the_title($top_post->ID);
        $excerpt = get_the_excerpt($top_post->ID);

        // $excerpt = mb_strimwidth($excerpt, 0, 100, "...");
        ?>
        <div class="col-12 mb-lg-5 mb-3">
            <a href="<?php echo get_the_permalink($top_post->ID); ?>" class="article-card article-card-full d-flex">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <?php if (has_post_thumbnail($top_post)) : ?>
                            <?php $featured_img_url = icoda_get_featured_image_url($top_post->ID); ?>
                            <?php
                            $alt_text = '';
                            if (get_post_meta(get_post_thumbnail_id($top_post->ID), '_wp_attachment_image_alt', true)) {
                                $alt_text = get_post_meta(get_post_thumbnail_id($top_post->ID), '_wp_attachment_image_alt', true);
                            } else {
                                $alt_text = get_the_title($top_post->ID);
                            }
                            ?>
                            <div class="article-card__img">
                                <img src="<?php echo $featured_img_url; ?>" alt="<?php echo $alt_text; ?>">
                            </div>

                        <?php endif; ?>
                    </div>
                    <div class="col-12 col-lg-6 d-flex flex-column justify-content-between">
                        <div class="article-card-content">
                            <div class="article-card-meta d-sm-flex justify-content-sm-between align-items-sm-center mt-3 mt-lg-0 mb-2 pb-0 mb-lg-4 pb-lg-1">
                                <div class="author-meta">
                                    <span class="author-name">
                                        <?php
                                        echo !in_array($author_id, [8, 9, 10, 6, 24, 21, 22, 28, 27, 29, 31]) ? 'ICODA' : apply_filters(
                                            'wpml_translate_single_string',
                                            get_the_author_meta('display_name', $author_id),
                                            'Authors',
                                            'display_name_' . $author_id,
                                            ICL_LANGUAGE_CODE
                                        );
                                        ?>
                                    </span>
                                    ·
                                    <span class="date-publish"><?php echo get_the_date('F j, Y', $top_post->ID); ?></span>
                                </div>

                                <?php get_template_part('template-parts/article-card-meta-info', [], ['top_post_id' => $top_post->ID]); ?>
                            </div>

                            <p class="title h6 mb-1 mb-lg-2">
                                <?php echo $title; ?>
                            </p>
                            <div class="excerpt">
                                <?php echo $excerpt; ?>
                            </div>
                        </div>
                        <div class="mt-3 pt-1 btn-wrap">
                            <button type="button" class="btn btn-blue">
                                <?php _e('Read', 'icoda'); ?>
                            </button>
                        </div>

                    </div>
                </div>
            </a>
        </div>
    </div>
<?php endif; ?>