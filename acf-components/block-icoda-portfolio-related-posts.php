<?php
$title = get_field('pbrp_title');
$related_posts = get_field('pbrp_related_posts');
global $post;

if (empty($related_posts)) {
    $related_posts_q = new WP_Query(
        [
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 2,
            'orderby' => 'DATE',
            'fields' => 'ids',
            'category__in' => [38, 37, 36, 35, 113]
        ]
    );
    $related_posts = $related_posts_q->posts;
}

?>
<?php if (!empty($related_posts)) : ?>
    <section class="related-portfolio pt-3 pb-5 py-lg-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="h4 pb-lg-2 mb-4"><?php echo !empty($title) ? $title : __('You may also like...', 'icoda'); ?></h3>
                </div>
            </div>


            <?php $group_index = 0; ?>
            <?php $read_more_text = __('Read more about how we made it happen.', 'icoda'); ?>
            <?php $discover_text = __('Discover', 'icoda'); ?>
            <?php foreach ($related_posts as $post) : ?>
                <?php setup_postdata($post); ?>
                <?php $post_thumbnail_url = get_the_post_thumbnail_url(); ?>
                <?php if ($group_index == 0) : ?>
                    <div class="row">
                    <?php endif; ?>
                    <?php $group_index++; ?>
                    <?php if ($group_index == 1) : ?>
                        <div class="col-12 col-lg-6">
                            <div class="portolio-block">
                                <?php if (!empty($post_thumbnail_url)) : ?>
                                    <a href="<?php echo get_the_permalink(); ?>" class="portolio-block__img">
                                        <img src="<?php echo $post_thumbnail_url; ?>" alt="">
                                    </a>
                                <?php endif; ?>
                                <div class="portolio-block__body mt-4 pt-lg-2">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <h4 class="h4 mb-2 pb-1">
                                            <?php echo get_the_title(); ?>
                                        </h4>
                                    </a>
                                    <p class="mb-2 pb-1"><?php echo $read_more_text; ?></p>
                                    <a class="btn-discover" href="<?php echo get_the_permalink(); ?>">
                                        <span><?php echo $discover_text; ?></span>
                                        <svg width="10" height="9" viewBox="0 0 10 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.562113 3.65029L0.546504 3.65398L7.23805 3.65398L5.13447 1.36961C5.03146 1.25808 4.97496 1.107 4.97496 0.948426C4.97496 0.789856 5.03146 0.639831 5.13447 0.528039L5.46179 0.173194C5.56471 0.0616665 5.70187 3.75755e-07 5.84813 3.62968e-07C5.99447 3.50175e-07 6.13171 0.0612261 6.23463 0.172754L9.84057 4.07966C9.9439 4.19163 10.0004 4.34077 10 4.49943C10.0004 4.65897 9.9439 4.8082 9.84057 4.91999L6.23463 8.82725C6.13171 8.93869 5.99455 9 5.84813 9C5.70187 9 5.56472 8.9386 5.46179 8.82725L5.13447 8.4724C5.03146 8.36105 4.97496 8.21235 4.97496 8.05378C4.97496 7.89529 5.03146 7.75443 5.13447 7.64299L7.26179 5.34584L0.554634 5.34584C0.253252 5.34584 4.42742e-07 5.06438 4.14208e-07 4.73799L3.70333e-07 4.23611C3.41799e-07 3.90972 0.260731 3.65029 0.562113 3.65029Z" fill="currentColor" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($group_index == 2) : ?>
                        <div class="col-12 col-lg-6 pt-lg-0 pt-5">
                            <div class="portolio-block">
                                <?php if (!empty($post_thumbnail_url)) : ?>
                                    <a href="<?php echo get_the_permalink(); ?>" class="portolio-block__img">
                                        <img src="<?php echo $post_thumbnail_url; ?>" alt="">
                                    </a>
                                <?php endif; ?>
                                <div class="portolio-block__body mt-4 pt-lg-2">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <h4 class="h4 mb-2 pb-1">
                                            <?php echo get_the_title(); ?>
                                        </h4>
                                    </a>
                                    <p class="mb-2 pb-1"><?php echo $read_more_text; ?></p>
                                    <a class="btn-discover" href="<?php echo get_the_permalink(); ?>">
                                        <span><?php echo $discover_text; ?></span>
                                        <svg width="10" height="9" viewBox="0 0 10 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.562113 3.65029L0.546504 3.65398L7.23805 3.65398L5.13447 1.36961C5.03146 1.25808 4.97496 1.107 4.97496 0.948426C4.97496 0.789856 5.03146 0.639831 5.13447 0.528039L5.46179 0.173194C5.56471 0.0616665 5.70187 3.75755e-07 5.84813 3.62968e-07C5.99447 3.50175e-07 6.13171 0.0612261 6.23463 0.172754L9.84057 4.07966C9.9439 4.19163 10.0004 4.34077 10 4.49943C10.0004 4.65897 9.9439 4.8082 9.84057 4.91999L6.23463 8.82725C6.13171 8.93869 5.99455 9 5.84813 9C5.70187 9 5.56472 8.9386 5.46179 8.82725L5.13447 8.4724C5.03146 8.36105 4.97496 8.21235 4.97496 8.05378C4.97496 7.89529 5.03146 7.75443 5.13447 7.64299L7.26179 5.34584L0.554634 5.34584C0.253252 5.34584 4.42742e-07 5.06438 4.14208e-07 4.73799L3.70333e-07 4.23611C3.41799e-07 3.90972 0.260731 3.65029 0.562113 3.65029Z" fill="currentColor" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($group_index >= 2) : ?>
                        <?php $group_index = 0; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </section>
<?php endif; ?>