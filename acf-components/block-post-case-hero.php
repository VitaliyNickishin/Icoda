<?php
global $post;
$is_blog_post = is_page_template('template-posts/new-blog-post.php');
$is_new_case = is_page_template('template-posts/new-case.php');
$hero_subtitle = get_field('post_case_hero_subtitle');
$str_word_count = str_word_count($hero_subtitle);
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
                    <p class="subtitle pr-lg-5 mr-lg-5 mb-4 undertitle-wrap">
                        <!-- <?php the_field('post_case_hero_subtitle'); ?> -->
                        <span class="undertitle undertitle-short">
                            <?php echo wp_trim_words($hero_subtitle, 15); ?>
                        </span>
                        <?php if ($str_word_count > 15) : ?>
                            
                            <input type="checkbox" id="read-more-subtitle" class="read-more" style="display: none" name='read-more'>
                    
                            <span class="undertitle undertitle-full">
                                <?php echo $hero_subtitle; ?>
                            </span>
                            
                            <label for="read-more-subtitle">
                                <span>+<?php _e('Read more', 'icoda'); ?></span>
                                <span>-<?php _e('Read less', 'icoda'); ?></span>
                            </label>
                        <?php endif; ?>
                    </p>
                    
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
                    
                    <?php if ($is_blog_post) : ?>
                        <?php get_template_part('template-parts/article-date'); ?>
                    <?php endif; ?>
                </div>

                <div class="col-12 col-lg-5 col-xl-4 offset-xl-1 mt-4 pt-4 mt-lg-0 pt-lg-0">
                    <?php if (have_rows('post_case_hero_info_items')): ?>
                        <div class="cases-box mt-lg-2 pt-lg-1">
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

                    <?php if ($is_blog_post) : ?>
                        <div class="d-none d-lg-block">
                            <?php get_template_part('template-parts/article-author'); ?>
                        </div>
                    <?php endif; ?>


                </div>

            </div>
        </div>

    </div>

</section>