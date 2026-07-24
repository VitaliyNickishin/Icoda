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

$hero_section = get_field('hero_section');

$display_name = get_the_author_meta('display_name') ?: 'Icoda';
$acf_display_name_user_id = 'acf-fname--user_' . $curauth->ID;
do_action('wpml_register_single_string', 'Authors', $acf_display_name_user_id, $display_name);
$display_name = apply_filters('wpml_translate_single_string', $display_name, 'Authors', $acf_display_name_user_id);

$fname = get_the_author_meta('first_name');
$acf_fname_user_id = 'acf-fname--user_' . $curauth->ID;
do_action('wpml_register_single_string', 'Authors', $acf_fname_user_id, $fname);
$fname = apply_filters('wpml_translate_single_string', $fname, 'Authors', $acf_fname_user_id);

$lname = get_the_author_meta('last_name');
$acf_lname_user_id = 'acf-lname--user_' . $curauth->ID;
do_action('wpml_register_single_string', 'Authors', $acf_lname_user_id, $lname);
$lname = apply_filters('wpml_translate_single_string', $lname, 'Authors', $acf_lname_user_id);

$position = get_the_author_meta('position');
$acf_position_user_id = 'acf-position--user_' . $curauth->ID;
do_action('wpml_register_single_string', 'Authors', $acf_position_user_id, $position);
$position = apply_filters('wpml_translate_single_string', $position, 'Authors', $acf_position_user_id);

$front_page_id = get_option('page_on_front');
?>
<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>

<div class="page-author">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-2 mb-md-3">
                <?php the_breadcrumbs(); ?>
            </div>
        </div>
    </div>
    
    <section class="section section-cases-hero-new section-hero-author pb-4 mb-1">
        <div class="section-cases-hero-new__inner position-relative with-gradient with-gradient-pink with-gradient-blue">
            <div class="bg-hero bg-hero-desktop d-lg-block d-none" style="background-image: url('/wp-content/uploads/2025/02/bg-hero-cases-desktop.png');"></div>
            <div class="bg-hero bg-hero-mobile d-lg-none" style="background-image: url('/wp-content/uploads/2025/02/bg-hero-cases-mobile-no-gradient-1.png');"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <div class="author-avatar text-center">
                            <?php if (get_avatar($curauth->ID)) : ?>
                                <?php echo get_avatar($curauth->ID, '255'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">
                        <h1 class="author-name"><?php echo $display_name; ?></h1>
                        <?php if ($position) : ?>
                            <div class="position mt-3">
                                <p><?php echo $position; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if (have_rows('social', 'user_' . $curauth->ID)) : ?>
                                <div class="additional-field item-social-media">
                                    
                                        <?php
                                        echo '<ul class="nav gap-2 mt-4">';
                                        while (have_rows('social', 'user_' . $curauth->ID)) : the_row();
                                            $socialchannel = get_sub_field('icon', 'user_' . $curauth->ID);                                        
                                            $socialurl = get_sub_field('social_url', 'user_' . $curauth->ID);
                                            $isExternal = (strpos($socialurl, 'mailto:') === 0) ? 'aria-label="Email"' : ' target="_blank" rel="nofollow noopener noreferrer"';
                                            $icons = [
                                                'linkedin.com' => 'fab fa-linkedin-in',
                                                'facebook.com' => 'fab fa-facebook',
                                                'x.com'        => 'icon-ico-x',
                                                'twitter.com'  => 'icon-ico-x',
                                                't.me'         => 'fab fa-telegram',
                                                'telegram.me'  => 'fab fa-telegram',
                                                'telegram.org' => 'fab fa-telegram',
                                                'youtube.com'  => 'fab fa-youtube',
                                                'youtu.be'     => 'fab fa-youtube',
                                                'mailto:'      => 'fas fa-envelope',
                                            ];

                                            foreach ($icons as $needle => $icon) {
                                                if (strpos($socialurl, $needle) !== false) {
                                                    $socialchannel = $icon;
                                                    break;
                                                }
                                            }
                                            echo '<li class="nav-item">';
                                            echo '<a class="nav-link serv-box ' . $socialchannel . '" href="' . $socialurl . '"' . $isExternal .'>';
                                            echo '</a></li>';
                                        endwhile;
                                        echo '</ul>';
                                        ?>
                                    
                                </div>
                            <?php endif; ?>

                        <div class="additional-meta-items">
                            <?php
                            if (have_rows('conferences', 'user_' . $curauth->ID)) :
                                $i = 0;
                            ?>
                                <div class="additional-field item-conferences mt-4">
                                    <div class="item-name mb-2 pb-1"><?php _e('Speaking & Conferences', 'Authors'); ?></div>
                                    <div class="item-value">
                                        <?php
                                        echo '<ul class="nav gap-2">';
                                        while (have_rows('conferences', 'user_' . $curauth->ID)) : the_row();

                                            $conference_name = get_sub_field('name', 'user_' . $curauth->ID);
                                            $acf_user_id = 'acf-conference-name-' . $i . '-user_' . $curauth->ID;
                                            do_action('wpml_register_single_string', 'Authors', $acf_user_id, $conference_name);
                                            $conference_name = apply_filters('wpml_translate_single_string', $conference_name, 'Authors', $acf_user_id);

                                            echo '<li class="nav-item serv-box">';
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
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (get_the_author_meta('description')) : ?>
        <div class="container">
            <?php
            $description_value = get_field('description', 'user_' . $curauth->ID);
            $acf_user_id = 'acf-description-user_' . $curauth->ID;
            do_action('wpml_register_single_string', 'Authors', $acf_user_id, $description_value);
            $description_value = apply_filters('wpml_translate_single_string', $description_value, 'Authors', $acf_user_id);
            ?>
            <div class="additional-field item-description">
                <div class="item-value"><?php echo $description_value; ?></div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (have_rows('authors_video', 'user_' . $curauth->ID)) : ?>
        <section class="section-author-videos py-4 mt-3">
            <div class="container">
                <div class="row my-lg-3 pt-lg-3">
                    <div class="col-12">

                        <h2 class="articles-title mb-2">
                            <?php printf(__('Where %s shows up', 'Authors'), $fname); ?>
                        </h2>

                        <div class="articles-description mb-4">
                            <?php _e("Interviews, conference talks, and podcast appearances across the crypto and iGaming press.", 'icoda'); ?></p> 
                        </div>

                        <div class="row">

                            <?php
                            $i = 1;

                            while (have_rows('authors_video', 'user_' . $curauth->ID)) :
                                the_row();

                                $poster_acf = get_sub_field('poster', 'user_' . $curauth->ID);
                                $poster_alt = get_sub_field('poster_alt', 'user_' . $curauth->ID);
                                $icon_play = get_sub_field('icon_play', 'user_' . $curauth->ID);
                                $video_code = get_sub_field('video_code', 'user_' . $curauth->ID);
                                $video_title_acf = get_sub_field('video_title', 'user_' . $curauth->ID);
                                $poster = !empty($poster_acf['url'])
                                ? $poster_acf['url']
                                : "https://i.ytimg.com/vi/{$video_code}/maxresdefault.jpg";

                                $response = wp_remote_get(
                                    "https://www.youtube.com/oembed?url=https://www.youtube.com/watch?v={$video_code}&format=json"
                                );

                                if (!is_wp_error($response)) {
                                    $body = json_decode(wp_remote_retrieve_body($response), true);
                                    // $title = $body['title'] ?? '';
                                    $video_title = !empty($video_title_acf) ? $video_title_acf : ($body['title'] ?? '');
                                }
                            ?>
                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                    <div class="article-card">
                                        <div class="article-card-header section-author-videos__iframe video">
                                            <div id="player-<?php echo $i; ?>"></div>
                                            
                                            <div
                                                class="video-trigger"
                                                data-id="player-<?php echo $i; ?>"
                                                data-video="<?php echo esc_attr($video_code); ?>"
                                            >
                                                <div class="poster">                     
                                                    <div class="poster-img">
                                                        <img
                                                            src="<?php echo esc_url($poster); ?>"
                                                            alt="<?php echo esc_attr($poster_alt); ?>"
                                                            class="poster-image"
                                                            width="515"
                                                            height="314"
                                                        >
                                                    </div>
                                                    <?php if (!empty($icon_play['url'])) : ?>
                                                        <div class="play-icon">
                                                            <img
                                                                src="<?php echo esc_url($icon_play['url']); ?>"
                                                                alt="Play"
                                                            >
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="article-card-body">
                                            <p class="video-title"><?php echo esc_attr($video_title); ?></p>
                                        </div>
                                        
                                    </div>
                                    
                                </div>

                            <?php
                                $i++;
                            endwhile;
                            ?>

                        </div>

                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>


    <?php if (have_rows('external_articles', 'user_' . $curauth->ID)) : ?>
        <section class="external-articles py-4 my-3">
            <div class="container">
                <div class="row my-lg-3 py-lg-3">
                    <div class="col-12">
                        <h2 class="articles-title">
                            <?php printf(__('External Articles by %s', 'Authors'), $display_name); ?>
                        </h2>

                        <div class="external-articles-list">
                            <?php
                            $i = 0;

                            while (have_rows('external_articles', 'user_' . $curauth->ID)) :
                                the_row();

                                $external_articles_title = get_sub_field('title');
                                $acf_user_id = 'acf-external_articles_title-' . $i . '-user_' . $curauth->ID;

                                do_action(
                                    'wpml_register_single_string',
                                    'Authors',
                                    $acf_user_id,
                                    $external_articles_title
                                );

                                $external_articles_title = apply_filters(
                                    'wpml_translate_single_string',
                                    $external_articles_title,
                                    'Authors',
                                    $acf_user_id
                                );

                                $link = get_sub_field('link');
                                $year = get_sub_field('year'); // если есть такое поле
                            ?>

                                <a
                                    class="ext-article-row"
                                    href="<?php echo esc_url($link); ?>"
                                    target="_blank"
                                    rel="nofollow noopener noreferrer">

                                    <div class="ext-article-content">
                                        <span class="ext-article-dash">—</span>

                                        <span class="ext-article-title">
                                            <?php echo esc_html($external_articles_title); ?>
                                        </span>
                                    </div>

                                    <div class="ext-article-meta">
                                        <?php if (!empty($year)) : ?>
                                            <span class="ext-article-year">
                                                <?php echo esc_html($year); ?>
                                            </span>
                                        <?php endif; ?>

                                        <i class="fas fa-external-link-alt"></i>
                                        <!-- <i class="fa-solid fa-arrow-up-right-from-square"></i> -->
                                    </div>

                                </a>

                            <?php
                                $i++;
                            endwhile;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>


    <section class="section-author-articles py-4 my-3">
        <?php
        if (ICL_LANGUAGE_CODE != 'en') {
            $order_by_author_posts = ['ID' => 'ASC'];
        } else {
            $order_by_author_posts = ['date' => 'DESC'];
        }
        $order_by_author_posts = ['date' => 'DESC'];
        $args = [
            'posts_per_page' => 12,
            'post_status'    => 'publish',
            'author'         => $current_author_id,
            'orderby'        => $order_by_author_posts,
            'tax_query'      => [
                [
                    'taxonomy' => 'category',
                    'field'    => 'id',
                    'terms'    => [38, 1028],
                ]
            ],
        ];

        $author_query = new WP_Query($args);
        ?>
        
        <?php if ($author_query->have_posts()) : ?>
            <div class="container my-lg-3 py-lg-3">
                <h2 class="articles-title"><?php printf(__('Articles by %s', 'Authors'), $display_name); ?></h2>
                <div class="row">
                    <?php while ($author_query->have_posts()) : $author_query->the_post(); ?>
                        <?php get_template_part('template-parts/article-card'); ?>
                    <?php endwhile; ?>

                    <?php wp_reset_postdata(); ?>

                    <?php if ($author_query->max_num_pages > 1) : ?>
                        <div class="load-more-author m-auto"
                            data-author="<?php echo $current_author_id; ?>"
                            data-page="1"
                            data-max="<?php echo $author_query->max_num_pages; ?>"
                        >
                        
                            <a href="#" class="btn btn-default">
                                <?php _e('Load more', 'icoda'); ?>
                                <!-- <i class="fas fa-arrow-down"></i> -->
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php else : ?>
            <p><?php _e('Not found articles.', 'icoda'); ?></p>
        <?php endif; ?>
    </section>

    <?php get_template_part('template-parts/sections/contact-us', '', ['need_post_id' => $front_page_id]); ?>
    
</div>

<?php
get_footer();
