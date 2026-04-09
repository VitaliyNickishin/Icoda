<?php
$bas_title = get_field('bas_title');
$bas_description = get_field('bas_description');
$bas_url = get_field('bas_url');
$term = get_field('bas_taxonomy');

$args_q = array(
    'posts_per_page' => 10,
    'orderby' => 'date',
    'order' => 'DESC',
);

if(!empty($term)) {
    $args_q['tax_query'] = array(
        array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => array($term->term_id),
        )
    );
}

if(is_singular( 'post' )) {
    $args_q['post__not_in'] = array(get_the_ID());
}

$related_wp_query = new WP_Query($args_q);
if ($related_wp_query->have_posts()) :
?>
    <div class="related-articles section-blog-articles">
        <div class="container">
            <div class="row">
                <div class="col-12 mu-md-4">
                    <div class="d-flex justify-content-between">
					<?php if (!empty($bas_title)) { ?>
                        <h2 class="h3 title mb-0">
                            <?php echo $bas_title; ?>
                        </h2>
					<?php } ?>
						<?php if ($bas_url) { ?>
						<?php 
						$link_title=$bas_url['title'];
						$link_url=$bas_url['url'];
						$link_target = $bas_url['target'] ? $bas_url['target'] : '_self';
						?>
                        <a class="link-arrow d-flex align-items-center" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                            <span class="d-none d-lg-block">
                                <?php echo esc_html( $link_title ); ?>
                            </span>
                            <span class="d-lg-none">
                                <?php _e('All', 'icoda'); ?>
                            </span>
                        </a>
						<?php } ?>
                    </div>        
                    <div class="descriptions mt-3 mb-4 position-relative d-flex">
                        <div class="text">
                            <?php echo $bas_description; ?>
                        </div>
                        <div class="slider-control slider-control-blog-articles d-none d-lg-block"></div>     
                    </div>
                    <div class="articles-list slider-blog-articles custom-slider">
                        <?php
                        while ($related_wp_query->have_posts()) {
                            $related_wp_query->the_post();
                            $related_post = get_post(get_the_ID());
                            $fname = get_the_author_meta('first_name');
                            $acf_fname_user_id = 'acf-fname--user_' . $related_post->post_author;
                            do_action('wpml_register_single_string', 'Authors', $acf_fname_user_id, $fname);
                            $fname = apply_filters('wpml_translate_single_string', $fname, 'Authors', $acf_fname_user_id);

                            $lname = get_the_author_meta('last_name');
                            $acf_lname_user_id = 'acf-lname--user_' . $related_post->post_author;
                            do_action('wpml_register_single_string', 'Authors', $acf_lname_user_id, $lname);
                            $lname = apply_filters('wpml_translate_single_string', $lname, 'Authors', $acf_lname_user_id);

                            $tags = get_the_terms($related_post, 'post_tag');

                            $excerpt = mb_strimwidth(get_the_excerpt($related_post->ID), 0, 110, "...");
                        ?>
                            <div class="author-article">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>
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

                            
                                <div class="cases-card-content d-flex justify-content-between flex-column" style="min-height:unset">
                                    <div class="blog-card-body">
                                        <?php if (!empty($tags)): ?>
                                            <div class="tags">
                                                <ul class="d-flex">
                                                    <?php foreach ($tags as $tag_term): ?>
                                                        <li class="">
                                                            <a href="<?php echo get_term_link($tag_term, 'post_tag'); ?>">
                                                                <?php echo $tag_term->name; ?>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                        <div class="article-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></div>
                                        <div class="article-except"><?php echo $excerpt; ?></div>
                                    </div>
                                    <div class="article-date">
                                        <p><?php echo $fname . ' ' . $lname; ?> <span class="dote"></span> <?php echo get_the_date('d F, Y', get_the_ID()); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>