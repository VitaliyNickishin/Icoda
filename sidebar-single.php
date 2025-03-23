<?php
$current_tags = get_the_terms(get_the_ID(), 'post_tag');
$blog_url = get_post_type_archive_link('post');
?>
<div data-sticky-single="sidebar" class="sidebar-single">
    <?php if (
        has_category('blog')
        || has_category('blog-ru')
        || has_category('blog-de')
        || has_category('blog-zh-hans')
        || has_category('blog-es')
    ) : ?>
        <div class="speak-to-an-expert-banner">
            <div class="row flex-column align-items-center align-items-lg-start">
                <div class="post-author-meta d-flex mb-4">
                    <div class="profile-avatar mr-3">
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
                        <p class="author-name"><a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php echo $fname . ' ' . $lname; ?></a></p>
                        <p class="position"><?php echo $position; ?></p>
                    </div>
                </div>

                <div class="speak-to-an-expert">
                    <div class="speak-to-an-expert__title mb-4 text-uppercase text-lg-left text-center"><?php _e('Have a question?', 'icoda'); ?></div>
                    <a class="pl-0 arrow-speak open-modal" data-modal="#callback" href="#">
                        <i class="icon-ico-media-4"></i><?php _e('Speak to an expert', 'icoda'); ?>
                    </a>
                </div>

            </div>
        </div>
    <?php endif; ?>

    <?php if( is_singular( 'post' ) && empty( get_field( 'icoda_disable_sidebar_navigation', get_the_ID() ) ) ) : ?>
    <?php
        $overwrite_table_of_content = get_field('overwrite_table_of_content', get_the_ID());
    ?>
    <div class="sidebar-single__table table-of-content border d-none d-lg-block" style="display: none;">
        <p class="text-uppercase mb-4 text-black"><?php _e('Table of Content', 'icoda'); ?></p>
        <?php if($overwrite_table_of_content) : ?>
            <?php
                $custom_table_of_content = get_field('custom_table_of_content', get_the_ID());
            ?>
            <ol class="list-table is-overwritten">
                <?php foreach($custom_table_of_content as $item_data): ?>
                    <li><a href="#<?php echo $item_data['anchor']; ?>"><?php echo $item_data['title']; ?></a></li>
                <?php endforeach; ?>
            </ol>
        <?php else : ?>
            <ol class="list-table">
            </ol>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($current_tags)) : ?>
        <div class="sidebar-single__tags">
            <p class="text-uppercase mb-3 text-black"><?php _e('Tags', 'icoda'); ?></p>
            <ul class="tag-list d-flex flex-wrap">
                <?php foreach ($current_tags as $current_tag) : ?>
                    <li>
                        <a href="<?php echo add_query_arg('tags', $current_tag->term_id, $blog_url); ?>">
                            <?php echo $current_tag->name; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!(has_category('services') || has_category('services-es') || has_category('services-zh-hans') || has_category('services-ru'))) : ?>
        <div class="sidebar-single__rate">
            <?php get_template_part('template-parts/article-rate'); ?>
        </div>
    <?php endif; ?>



    <?php
    $args = array(
        'posts_per_page' => 2,
        'orderby' => 'date',
        'order' => 'desc',
        // 'tax_query' => array(
        //     array(
        //         'taxonomy' => 'post_tag',
        //         'field' => 'id',
        //         'terms' => wp_list_pluck($current_tags, 'term_id'),
        //     )
        // ),
        'post__not_in' => array(get_the_ID()),
    );
    $retaled_posts_query = new WP_Query($args);
    ?>

    <?php if ($retaled_posts_query->have_posts()) : ?>
        <div class="sidebar-single__editors-pick d-none d-lg-block">

            <div class="editors-pick-articles">

                <p class="mb-3 text-uppercase text-black">
                    <?php _e('Related Articles', 'icoda'); ?>
                </p>
                <div class="articles-list">

                    <?php
                    while ($retaled_posts_query->have_posts()) :
                        $retaled_posts_query->the_post();
                    ?>
                        <div class="author-article">
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
                                </div>
                                <div class="article-date">
                                    <p><?php echo get_the_date('d F, Y', get_the_ID()); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>



</div>