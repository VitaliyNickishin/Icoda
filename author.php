<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package icoda
 */
global $post;
get_header();
$current_author_id = get_queried_object_id();
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>
<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>

<div class="section-content">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-2 mb-md-3">
                <?php the_breadcrumbs(); ?>
            </div>
        </div>
    </div>

    <div class="profile-box">
        <div class="container">
            <div class="profile-box_wrapper col-12">
                <div class="profile-avatar col-3">
                    <div class="row">
                        <?php echo get_avatar($curauth->ID, '255'); ?>
                    </div>
                </div>
                <div class="author-meta col-9">
                    <?php
                    $fname = get_the_author_meta('first_name');
                    $lname = get_the_author_meta('last_name');
                    ?>
                    <h1 class="author-name"><?php echo $fname . ' ' . $lname; ?></h1>
                    <div class="position">
                        <p><?php the_author_meta('position'); ?></p>
                    </div>

                    <div class="additional-meta-items">
                        <?php
                        if (have_rows('conferences', 'user_' . $curauth->ID)) :
                            $i = 0;
                        ?>
                            <div class="additional-field item-conferences">
                                <div class="item-name"><?php _e('Conferences', 'Authors'); ?></div>
                                <div class="item-value">
                                    <?php
                                    echo '<ul class="nav align-middle">';
                                    while (have_rows('conferences', 'user_' . $curauth->ID)) : the_row();

                                        $conference_name = get_sub_field('name', 'user_' . $curauth->ID);
                                        $acf_user_id = 'acf-conference-name-' . $i . '-user_' . $curauth->ID;
                                        do_action('wpml_register_single_string', 'Authors', $acf_user_id, $conference_name);
                                        $conference_name = apply_filters('wpml_translate_single_string', $conference_name, 'Authors', $acf_user_id);

                                        echo '<li class="nav-item">';
                                        echo $conference_name;
                                        echo '</a></li>';
                                        ++$i;
                                    endwhile;
                                    echo '</ul>';
                                    ?>
                                </div>
                            </div>
                        <?php
                        endif;
                        ?>
                        <?php if (have_rows('social', 'user_' . $curauth->ID)) : ?>
                            <div class="additional-field item-social-media">
                                <div class="item-name"><?php _e('Social', 'Authors'); ?></div>
                                <div class="item-value">
                                    <?php
                                    echo '<ul class="nav align-middle">';
                                    while (have_rows('social', 'user_' . $curauth->ID)) : the_row();
                                        $socialchannel = get_sub_field('icon', 'user_' . $curauth->ID);                                        
                                        $socialurl = get_sub_field('social_url', 'user_' . $curauth->ID);
                                        if( empty( $socialchannel ) ) {
                                            if(strpos($socialurl, 'linkedin') !== false) {
                                               $socialchannel = 'fab fa-linkedin'; 
                                            }
                                            if(strpos($socialurl, 'facebook') !== false) {
                                                $socialchannel = 'fab fa-facebook'; 
                                            }
                                            if(strpos($socialurl, 'twitter') !== false) {
                                                $socialchannel = 'fab fa-twitter'; 
                                            }
                                            if(strpos($socialurl, 'telegram') !== false) {
                                                $socialchannel = 'fab fa-telegram'; 
                                            }
                                        }
                                        echo '<li class="nav-item">';
                                        echo '<a class="nav-link ' . $socialchannel . '" rel="nofollow noopener noreferrer" href="' . $socialurl . '" target="_blank">';
                                        echo '</a></li>';
                                    endwhile;
                                    echo '</ul>';
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (get_the_author_meta('description')) : ?>
                            <?php
                            $description_value = get_field('description', 'user_' . $curauth->ID);
                            $acf_user_id = 'acf-description-user_' . $curauth->ID;
                            do_action('wpml_register_single_string', 'Authors', $acf_user_id, $description_value);
                            $description_value = apply_filters('wpml_translate_single_string', $description_value, 'Authors', $acf_user_id);
                            ?>
                            <div class="additional-field item-description">
                                <div class="item-name"><?php _e('Description', 'Authors'); ?></div>
                                <div class="item-value"><?php echo $description_value; ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="author-articles">

        <?php if (have_rows('external_articles', 'user_' . $curauth->ID)) : ?>
            <div class="container">
                <div class="row">
                    <div class="col-12 mu-md-4 mt-5">
                        <h2 class="articles-title"><?php printf(__('External Articles by %s', 'Authors'), $fname . ' ' . $lname); ?></h2>
                        <?php
                        echo '<ul class="earticles-list">';
                        $i = 0;
                        while (have_rows('external_articles', 'user_' . $curauth->ID)) : the_row();

                            $external_articles_title = get_sub_field('title', 'user_' . $curauth->ID);
                            $acf_user_id = 'acf-external_articles_title-' . $i . '-user_' . $curauth->ID;
                            do_action('wpml_register_single_string', 'Authors', $acf_user_id, $external_articles_title);
                            $external_articles_title = apply_filters('wpml_translate_single_string', $external_articles_title, 'Authors', $acf_user_id);

                            $link = get_sub_field('link', 'user_' . $curauth->ID);
                            echo '<li class="article-item">';
                            echo '<a rel="nofollow noopener noreferrer" href="' . $link . '" target="_blank">';
                            echo $external_articles_title;
                            echo '</a></li>';

                            ++$i;
                        endwhile;
                        echo '</ul>';
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>


        <?php
        if (ICL_LANGUAGE_CODE != 'en') {
            $order_by_author_posts = ['ID' => 'ASC'];
        } else {
            $order_by_author_posts = ['date' => 'DESC'];
        }
        $order_by_author_posts = ['date' => 'DESC'];
        $args = array(
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'author'     => $current_author_id,
            'orderby' => $order_by_author_posts,
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => array('38'),
                )
            ),
        );
        $wp_query = new WP_Query($args);
        ?>
        <?php
        $fname = get_the_author_meta('first_name');
        $lname = get_the_author_meta('last_name');
        ?>
        <?php if ($wp_query->have_posts()) : ?>
            <div class="container">
                <div class="row">
                    <div class="col-12 mu-md-4 my-5">

                        <h2 class="articles-title"><?php printf(__('Articles by %s', 'Authors'), $fname . ' ' . $lname); ?></h2>
                        <div class="articles-list">

                            <?php while ($wp_query->have_posts()) {
                                $wp_query->the_post(); 
                                ?>
                                <div class="author-article col-4">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'blog'); ?>
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
                                    <div class="cases-card-content d-flex justify-content-between flex-column">
                                        <div class="blog-card-body">
                                            <div class="article-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></div>
                                            <div class="article-except"><?php the_excerpt(); ?></div>
                                        </div>
                                        <div class="article-date">
                                            <p><?php echo get_the_date('d F, Y', get_the_ID()); ?></p>
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
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
