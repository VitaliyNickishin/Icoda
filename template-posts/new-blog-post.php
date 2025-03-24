<?php

/*
Template Name: New Blog Post
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

        <?php
        the_content();
        ?>


        <?php
        $args = array(
            'posts_per_page' => 10,
            'orderby' => 'RAND',
            'post__not_in' => array(get_the_ID()),
        );
        $related_wp_query = new WP_Query($args);
        if ($related_wp_query->have_posts()) :
        ?>
            <div class="related-articles">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mu-md-4">
                            <h2 class="h3 title">
                                <?php echo __('Related articles', 'icoda'); ?>
                            </h2>
                            <div class="articles-list slider-related-articles custom-slider">
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
                                                <div class="article-except"><?php the_excerpt(); ?></div>
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
                            <div class="slider-control slider-control-related-articles"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>


    <?php endwhile; ?>




<?php endif; ?>


<?php
get_footer();
