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
                    <div class="mt-4 pt-lg-3">
                        <p class="fw-semibold mb-1 cases-category-title"><?php the_field('post_case_hero_category_title'); ?></p>
                        <ul class="cases-category-list d-flex">
                            <?php
                            if (have_rows('post_case_hero_category_items')):
                                while (have_rows('post_case_hero_category_items')) : the_row();
                            ?>
                                    <li class="cases-category-item">
                                        <a href="<?php echo get_sub_field('link'); ?>">
                                            <?php echo get_sub_field('title'); ?>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- @todo  end-->

                    <!-- @todo  add block article-date -->

                        <?php/* get_template_part('template-parts/article-date'); */?>
                        <!-- Published: March 5, 2025 - Updated: March 12, 2025 -->
                        <!-- 8 minutes to read -->
                
                    <!-- end -->
                </div>

                <div class="col-12 col-lg-5 col-xl-4 offset-xl-1 mt-4 pt-4 mt-lg-0 pt-lg-0">
                    <!-- @todo  add condition to hide this block when fields empty -->
                    <div class="cases-box">
                        <?php
                        if (have_rows('post_case_hero_info_items')):
                            while (have_rows('post_case_hero_info_items')) : the_row();
                        ?>
                                <div class="serv-box">
                                    <span class="number"><?php echo get_sub_field('title'); ?></span>
                                    <p><?php echo get_sub_field('text'); ?></p>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <!-- @todo  end-->
                    
                    <!-- @todo  add block article-author with condition -->

                </div>

            </div>
        </div>

    </div>

</section>