<?php if (false && !empty($_GET['show_new_blocks'])) : ?>

    <?php
    $portfolio_cases = new WP_Query([
        'post_type' => 'portfolio-case',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'fields' => 'ids'
    ]);
    ?>

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
                            <?php foreach ($portfolio_cases->posts as $portfolio_case_id) : ?>
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
                                    <a href="<?php echo get_the_permalink($portfolio_case_id); ?>" target="_blank"><?php echo $portfolio_case_name; ?><sup><?php echo empty($portfolio_year) ? '2022' : $portfolio_year; ?></sup></a>
                                    <?php if (!empty($portfolio_services)) : ?>
                                        <p><?php echo strtolower($portfolio_services); ?></p>
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
                            <?php foreach ($portfolio_cases->posts as $portfolio_case_id) : ?>
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
                                    <a href="<?php echo get_the_permalink($portfolio_case_id); ?>" target="_blank" class="case-img">
                                        <img src="<?php echo $portfolio_image_on_home; ?>" alt="<?php echo $portfolio_case_name; ?>" />
                                    </a>
                                    <a class="case-title" href="#" target="_blank"><?php echo $portfolio_case_name; ?><sup><?php echo empty($portfolio_year) ? '2022' : $portfolio_year; ?></sup></a>
                                    <?php if (!empty($portfolio_services)) : ?>
                                        <p><?php echo strtolower($portfolio_services); ?></p>
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