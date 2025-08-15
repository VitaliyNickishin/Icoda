<?php
global $post;

get_header();

?>
<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>

<?php
$post_v3 = get_field('post_v3');
if (!empty($post_v3)) :
?>

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

            <div class="container">
                <div class="row">
                    <div class="d-none d-lg-block col-lg-2 single-post__list-social">
                        <?php get_template_part('template-parts/article-share'); ?>
                    </div>
                    <div class="col-12 col-lg-7 pr-lg-5">
                        <?php
                        get_template_part('template-parts/article-new-blocks');
                        ?>
                    </div>
                    <div class="col-12 d-lg-none">
                        <?php get_template_part('template-parts/article-share'); ?>
                    </div>
                    <div class="col-12 col-lg-3 single-post__sidebar">
                        <?php get_sidebar('single'); ?>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>

        <?php if (
            has_category('blog', $post)
            || has_category('blog-ru', $post)
            || has_category('blog-de', $post)
            || has_category('blog-zh-hans', $post)
            || has_category('blog-es', $post)
        ) : ?>
        <?php
         $args = array(
            'posts_per_page' => 3,
            'author__in'     => $post->post_author,
            'orderby' => 'date',
            'order' => 'DESC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => array('38'),
                )
            ),
            'post__not_in' => array(get_the_ID()),
        );
        $related_wp_query = new WP_Query($args);

        $fname = get_the_author_meta('first_name');
        $lname = get_the_author_meta('last_name');

        if ($related_wp_query->have_posts()) :
        ?>
            <div class="related-articles">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mu-md-4">
                            <h2 class="recent-articles">
                                <?php printf(__('Other articles by %s', 'Authors'), '<a href="' . get_author_posts_url($post->post_author) . '">' . $fname . ' ' . $lname . '</a>'); ?>
                            </h2>
                            <div class="articles-list">
                                <?php
                                    while ($related_wp_query->have_posts()) {
                                        $related_wp_query->the_post();
                                ?>
                                        <div class="author-article col-4">
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
                                                    <div class="article-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></div>
                                                    <?php /* ?><div class="article-except"><?php the_excerpt(); ?></div><?php */ ?>
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
            </div>
        <?php endif; ?>
        <?php endif; ?>

        <?php if (has_category('cases') || has_category('cases-zh-hans')) : ?>
            <style>
                .article-page .section.section-form {
                    padding-bottom: 80px;
                    padding-top: 50px;
                }

                .section-form .l-box .text-vert {
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-direction: column;
                    flex-direction: column;
                    margin-top: auto;
                    margin-bottom: auto;
                }

                .section-form .l-box .h4 {
                    max-width: 233px;
                    padding-bottom: 25px;
                }

                .section-form .wr-form {
                    padding-left: 50px;
                }

                .section-form .row-vert {
                    -ms-flex-align: center;
                    align-items: center;
                }

                @media (max-width: 767.98px) {

                    .section-form .l-box,
                    .section-form .wr-form {
                        padding-left: 0;
                    }

                    .section-form .l-box {
                        min-height: auto;
                        padding-bottom: 40px;
                    }
                }
            </style>
            <?php echo do_shortcode('[contact-form-new]'); ?>

        <?php endif; ?>

        <?php if (get_field('section_contact_us_show') == true) : ?>
            <?php get_template_part('template-parts/sections/contact-us'); ?>
        <?php endif; ?>

    <?php endif; ?>




<?php else : ?>





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

            <?php get_template_part('template-parts/article-date'); ?>

            <?php
            the_content();
            ?>


        <?php endwhile; ?>

        <?php get_template_part('template-parts/sections/post-rate') ?>

        <?php if (
            has_category('blog')
            || has_category('blog-ru')
            || has_category('blog-de')
            || has_category('blog-zh-hans')
            || has_category('blog-es')
        ) : ?>
            <div class="container speak-to-an-expert-banner">
                <div class="row">
                    <div class="post-author-meta col-xl-6 col-lg-6 col-md-6 col-sm-12 mu-md-4">
                        <div class="profile-avatar">
                            <a href="<?php echo get_author_posts_url($post->post_author); ?>">
                                <?php echo get_avatar($post->post_author, '65'); ?>
                            </a>
                        </div>
                        <div class="author-meta">
                            <?php                    
                                $fname = get_the_author_meta('first_name');
                                $acf_fname_user_id = 'acf-fname--user_' . $post->post_author;
                                do_action('wpml_register_single_string', 'Authors', $acf_fname_user_id, $fname);
                                $fname = apply_filters('wpml_translate_single_string', $fname, 'Authors', $acf_fname_user_id);

                                $lname = get_the_author_meta('last_name');
                                $acf_lname_user_id = 'acf-lname--user_' . $post->post_author;
                                do_action('wpml_register_single_string', 'Authors', $acf_lname_user_id, $lname);
                                $lname = apply_filters('wpml_translate_single_string', $lname, 'Authors', $acf_lname_user_id);
                                
                                $position = get_the_author_meta('position');
                                $acf_position_user_id = 'acf-position--user_' . $post->post_author;
                                do_action('wpml_register_single_string', 'Authors', $acf_position_user_id, $position);
                                $position = apply_filters('wpml_translate_single_string', $position, 'Authors', $acf_position_user_id);
                            ?>
                            <p class="author-name h6"><a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php echo $fname . ' ' . $lname; ?></a></p>
                            <p class="position"><?php echo $position; ?></p>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mu-md-4">
                        <div class="speak-to-an-expert">
                            <div class="speak-to-an-expert__title"><?php _e('Have a question?', 'icoda'); ?></div>
                            <a class="arrow-speak open-modal" data-modal="#callback" href="#">
                                <i class="icon-ico-media-4"></i><?php _e('Speak to an expert', 'icoda'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $args = array(
                'posts_per_page' => 3,
                'author__in'     => $post->post_author,
                'orderby' => 'date',
                'order' => 'DESC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'id',
                        'terms' => array('38'),
                    )
                ),
                'post__not_in' => array(get_the_ID()),
            );
            $related_wp_query = new WP_Query($args);

            if ($related_wp_query->have_posts()) :
            ?>
                <div class="related-articles">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 mu-md-4">
                                <h2 class="recent-articles">
                                    <?php printf(__('Other articles by %s', 'Authors'), '<a href="' . get_author_posts_url($post->post_author) . '">' . $fname . ' ' . $lname . '</a>'); ?>
                                </h2>
                                <div class="articles-list">
                                    <?php
                                        while ($related_wp_query->have_posts()) {
                                            $related_wp_query->the_post();
                                    ?>
                                            <div class="author-article col-4">
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
                                                        <div class="article-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></div>
                                                        <?php /* ?><div class="article-except"><?php the_excerpt(); ?></div><?php */ ?>
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
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (has_category('cases') || has_category('cases-zh-hans')) : ?>
            <style>
                .article-page .section.section-form {
                    padding-bottom: 80px;
                    padding-top: 50px;
                }

                .section-form .l-box .text-vert {
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-direction: column;
                    flex-direction: column;
                    margin-top: auto;
                    margin-bottom: auto;
                }

                .section-form .l-box .h4 {
                    max-width: 233px;
                    padding-bottom: 25px;
                }

                .section-form .wr-form {
                    padding-left: 50px;
                }

                .section-form .row-vert {
                    -ms-flex-align: center;
                    align-items: center;
                }

                @media (max-width: 767.98px) {

                    .section-form .l-box,
                    .section-form .wr-form {
                        padding-left: 0;
                    }

                    .section-form .l-box {
                        min-height: auto;
                        padding-bottom: 40px;
                    }
                }
            </style>
            <?php echo do_shortcode('[contact-form-new]'); ?>

        <?php endif; ?>

        <?php if (has_category('services') || has_category('services-es') || has_category('services-zh-hans') || has_category('services-ru')) :

            if (get_field('load_new_styles') === true) {
                echo do_shortcode('[contact-form-new]');
            } else { ?>
                <div class="callback-form mb-3 mb-md-5" id="contact-with-us">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8 col-xl-8">
                                <form class="form-default request-send__form form-default-desctop" method="post">
                                    <div class="form-default-header">
                                        <p class="ttl"><?php _e('Send request', 'icoda'); ?></p>
                                        <p><?php _e('to scale your business to the next level', 'icoda'); ?></p>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6">
                                            <input type="text" name="name" class="form-control req" placeholder="<?php _e('Your name', 'icoda'); ?>" required>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" name="telegram" class="form-control req" placeholder="<?php _e('WhatsApp / Telegram', 'icoda'); ?>" required>
                                        </div>
                                        <div class="col-12">
                                            <input type="email" name="email" class="form-control req" placeholder="<?php _e('Email', 'icoda'); ?>" required>
                                        </div>
                                        <div class="col-12">
                                            <textarea name="message" class="form-control" rows="5" placeholder="<?php _e('Text message', 'icoda'); ?>"></textarea>
                                        </div>
                                        <?php
                                        do_action('anr_captcha_form_field');
                                        ?>
                                        <div class="col-12">
                                            <div class="wr-btn text-right">
                                                <button type="submit" class="btn btn-blue"><?php _e('Apply Now', 'icoda'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

        <?php endif; ?>

    <?php endif; ?>

<?php endif; ?>

<?php
get_footer();
