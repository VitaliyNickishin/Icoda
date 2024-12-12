<?php
$recent_cases = get_field('recent_cases_cases', $args['post_id']);
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h3 class="section-title"><?php the_field('recent_cases_title', $args['post_id']); ?></h3>
        </div>
    </div>

    <?php
    $last_recent_cases_query = new WP_Query(
        [
            'post_type' => 'post',
            'category_name' => 'cases',
            'orderby' => 'DATE',
            'order' => 'DESC',
            'posts_per_page' => 3
        ]
    );
    ?>
    <div class="wr-slider">
        <div class="cases-slider custom-slider">
            <?php if ($last_recent_cases_query->have_posts()) : ?>
                <?php while ($last_recent_cases_query->have_posts()) : ?>
                    <?php $last_recent_cases_query->the_post(); ?>
                    <div class="col-item">
                        <div class="service-card-wrap">
                            <a href="<?php echo get_the_permalink(); ?>" class="service-card">
                                <div class="blog-img">
                                    <img src="<?php echo !empty(get_field('case_front_image', get_the_ID())) ? get_field('case_front_image', get_the_ID()) : get_the_post_thumbnail_url(); ?>" alt="" width="255" height="170">
                                </div>
                                <div class="cases-content">
                                    <p class="h5 text-center"><?php echo get_the_title(); ?></p>
                                    <?php if (!empty(get_field('case_post_logo', get_the_ID()))) : ?>
                                        <div class="cases-logo">
                                            <img class="" src="<?php echo get_field('case_post_logo', get_the_ID()); ?>" alt="logo" width="150" height="35">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php elseif (!empty($recent_cases)) : ?>
                <?php foreach ($recent_cases as $recent_case_item) : ?>
                    <div class="col-item">
                        <div class="service-card-wrap">
                            <a href="<?php echo get_the_permalink($recent_case_item['case_post']); ?>" class="service-card">
                                <div class="img">
                                    <img src="<?php echo $recent_case_item['top_image']; ?>" alt="abcc">
                                </div>
                                <p class="h5 text-center"><?php echo $recent_case_item['title']; ?></p>
                                <div class="footer">
                                    <img class="" src="<?php echo $recent_case_item['bottom_logo']; ?>" alt="abcc-logo">
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="slider-control wr-control-cases"></div>
    </div>

    <div class="row justify-content-center">
        <div class="wr-btn mt-5">
            <a href="<?php echo home_url('/cases/'); ?>" class="btn btn-blue btn-show-el"><?php echo __('Show all cases', 'icoda'); ?></a>
        </div>
    </div>

</div>