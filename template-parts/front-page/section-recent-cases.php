<?php
$show = get_field('recent_cases_show');
// $show = false;

// $show = !empty($_GET['show_new_blocks']);

?>
<?php if ($show) : ?>
    <?php
    $cases_posts = get_field('recent_cases_cases_for_new_block');
    ?>
    <?php if (!empty($cases_posts)) : ?>
        <section class="section cases-new">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="section-title"><?php the_field('recent_cases_title'); ?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="cases-new-descktop">
                            <ul class="case-list">
                                <?php foreach ($cases_posts as $portfolio_case_id) : ?>
                                    <?php
                                    $portfolio_case_name = get_field('portfolio_short_name', $portfolio_case_id);
                                    $portfolio_services = get_field('portfolio_services_list', $portfolio_case_id);
                                    if (!empty($portfolio_services)) {
                                        $portfolio_services = explode("\n", $portfolio_services);
                                        $portfolio_services = array_map('trim', $portfolio_services);
                                        $portfolio_services = implode(", ", $portfolio_services) . '.';
                                    }
                                    $portfolio_year = get_field('portfolio_year', $portfolio_case_id);
                                    $portfolio_image_on_home = get_field('portfolio_image_on_home', $portfolio_case_id);
                                    if (empty($portfolio_image_on_home)) {
                                        $portfolio_image_on_home = get_the_post_thumbnail_url($portfolio_case_id);
                                    }
                                    if (empty($portfolio_case_name)) {
                                        $portfolio_case_name = get_the_title($portfolio_case_id);
                                    }
                                    ?>
                                    <li class="layer card-wrapper">
                                        <a href="<?php echo get_the_permalink($portfolio_case_id); ?>"><?php echo $portfolio_case_name; ?><?php /* ?><sup><?php echo empty($portfolio_year) ? '2022' : $portfolio_year; ?></sup><?php */ ?></a>
                                        <?php if (!empty($portfolio_services)) : ?>
                                            <p><?php echo $portfolio_services; ?></p>
                                        <?php endif; ?>
                                        <div class="case-img case-img-banxe card">
                                            <img src="<?php echo $portfolio_image_on_home; ?>" alt="<?php echo $portfolio_case_name; ?>" />
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="cases-new-mobile">
                            <ul class="case-list case-new-slider custom-slider">
                                <?php foreach ($cases_posts as $portfolio_case_id) : ?>
                                    <?php
                                    $portfolio_case_name = get_field('portfolio_short_name', $portfolio_case_id);
                                    $portfolio_services = get_field('portfolio_services_list', $portfolio_case_id);
                                    if (!empty($portfolio_services)) {
                                        $portfolio_services = explode("\n", $portfolio_services);
                                        $portfolio_services = array_map('trim', $portfolio_services);
                                        $portfolio_services = implode(", ", $portfolio_services) . '.';
                                    }
                                    $portfolio_year = get_field('portfolio_year', $portfolio_case_id);
                                    $portfolio_image_on_home = get_field('portfolio_image_on_home', $portfolio_case_id);
                                    if (empty($portfolio_image_on_home)) {
                                        $portfolio_image_on_home = get_the_post_thumbnail_url($portfolio_case_id);
                                    }
                                    if (empty($portfolio_case_name)) {
                                        $portfolio_case_name = get_the_title($portfolio_case_id);
                                    }
                                    ?>
                                    <li>
                                        <a href="<?php echo get_the_permalink($portfolio_case_id); ?>" class="case-img">
                                            <img src="<?php echo $portfolio_image_on_home; ?>" alt="<?php echo $portfolio_case_name; ?>" />
                                        </a>
                                        <a class="case-title" href="#"><?php echo $portfolio_case_name; ?><?php /* ?><sup><?php echo empty($portfolio_year) ? '2022' : $portfolio_year; ?></sup><?php */ ?></a>
                                        <?php if (!empty($portfolio_services)) : ?>
                                            <p><?php echo $portfolio_services; ?></p>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>