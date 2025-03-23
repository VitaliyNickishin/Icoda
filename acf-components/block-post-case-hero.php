<?php
global $post;
$is_blog_post = is_page_template('template-posts/new-blog-post.php');
?>
<section class="section section-cases-hero-new mt-3">
    <div class="section-cases-hero-new__inner position-relative with-gradient with-gradient-pink">
        <div class="bg-hero bg-hero-desktop d-lg-block d-none" style="background-image: url(<?php the_field('post_case_hero_desktop_background'); ?>);"></div>
        <div class="bg-hero bg-hero-mobile d-lg-none" style="background-image: url(<?php the_field('post_case_hero_mobile_background'); ?>);"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7 pr-lg-3 pr-xl-5">
                    <h1 class="h1 mb-4 title">
                        <?php the_field('post_case_hero_title'); ?>
                    </h1>
                    <p class="subtitle pr-lg-5 mr-lg-5">
                        <?php the_field('post_case_hero_subtitle'); ?>
                    </p>
                    <!-- @todo  add condition to hide this block when fields empty-->
                    <?php if (have_rows('post_case_hero_category_items')): ?>
                        <div class="mt-4 pt-lg-3">
                            <p class="fw-semibold mb-1 cases-category-title"><?php the_field('post_case_hero_category_title'); ?></p>
                            <ul class="cases-category-list d-flex">
                                <?php
                                while (have_rows('post_case_hero_category_items')) : the_row();
                                ?>
                                    <li class="cases-category-item">
                                        <a href="<?php echo get_sub_field('link'); ?>">
                                            <?php echo get_sub_field('title'); ?>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <!-- @todo end-->

                    <!-- @todo  add block article-date -->
                    <?php if ($is_blog_post) : ?>
                        <?php get_template_part('template-parts/article-date'); ?>
                    <?php endif; ?>
                    <!-- @todo end -->
                </div>

                <div class="col-12 col-lg-5 col-xl-4 offset-xl-1 mt-4 pt-4 mt-lg-0 pt-lg-0">
                    <!-- @todo  add condition to hide this block when fields empty -->
                    <?php if (have_rows('post_case_hero_info_items')): ?>
                        <div class="cases-box">
                            <?php
                            while (have_rows('post_case_hero_info_items')) : the_row();
                            ?>
                                <div class="serv-box">
                                    <span class="number"><?php echo get_sub_field('title'); ?></span>
                                    <p><?php echo get_sub_field('text'); ?></p>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                    <!-- @todo  end-->

                    <!-- @todo  add block article-author with condition -->
                    <?php if ($is_blog_post) : ?>
                        <div class="article-author">
                            <div class="box">
                                <div class="d-flex">
                                    <div class="avatar">
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
                                        <p class="name"><a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php echo $fname . ' ' . $lname; ?></a></p>
                                        <p class="position mt-1"><?php echo $position; ?></p>
                                    </div>
                                </div>

                                <?php
                                $tags = get_the_terms($post, 'post_tag');
                                if (!empty($tags)):
                                ?>
                                    <div class="mt-3 pt-lg-1">
                                        <p class="fw-semibold mb-1 cases-category-title"><?php _e('Tags', 'icoda'); ?>:</p>
                                        <ul class="cases-category-list d-flex">
                                            <?php foreach ($tags as $tag_term): ?>
                                                <li class="cases-category-item">
                                                    <a href="<?php echo get_term_link($tag_term, 'post_tag'); ?>">
                                                        <?php echo $tag_term->name; ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endif; ?>


                </div>

            </div>
        </div>

    </div>

</section>