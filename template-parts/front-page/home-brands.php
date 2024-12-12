<?php
$section_5_gb_data = get_field('section_5_gb_data', $args['post_id']);
$block_title = get_field('section_8_title-en', $args['post_id']);
$block_sub_text = get_field('section_8_subtitle-en', $args['post_id']);
if ($section_5_gb_data) {
    $some_brands = get_field('icoda_gb_some_brands', 'option');
    if(!empty($some_brands['title'])) {
        $block_title = $some_brands['title'];
    }
    if(!empty($some_brands['description'])) {
        $block_sub_text = $some_brands['description'];
    }
}

?>

<div class="container">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="text">
                <h3 class="section-title"><?php echo $block_title; ?></h3>
                <p class="sub-text"><?php echo $block_sub_text; ?></p>
                <a data-toggle="collapse" href="#" class="link-arrow d-none d-lg-block" role="button" data-target=".multi-collapse-project-card" aria-expanded="false"><?php echo __('Show all brands', 'icoda'); ?></a>
            </div>
        </div>
        <?php $count = 0; ?>

        <?php if ($section_5_gb_data && !empty($some_brands['projects'])) : ?>
            <?php foreach ($some_brands['projects'] as $project_item) : $count++; ?>
                <?php
                    $style = '';
                    if($project_item['img_width']) {
                        $style =  ' style="' . $project_item['img_width'] . '" ';
                    }
                ?>
                <div class="col-sm-6 col-lg-4 d-none d-lg-block col-card">
                    <?php if ($count > 8) : ?>
                        <div class="collapse multi-collapse-project-card">
                        <?php endif; ?>
                        <div class="project-card">
                            <div class="project-card-header">
                                <div class="project-card-logo">
                                    <img <?php echo $style; ?> src="<?php echo $project_item['logo']['url']; ?>" alt="<?php echo !empty($project_item['logo']['alt']) ? $project_item['logo']['alt'] : ''; ?>">
                                </div>
                                <div class="project-card-flag" data-bg="<?php echo $project_item['flag']; ?>" style="background: url(<?php echo $project_item['flag']; ?>) center no-repeat;"></div>
                            </div>
                            <div class="project-card-body">
                                <p><span><?php echo $project_item['name']; ?></span> <?php echo $project_item['description']; ?></p>
                            </div>
                        </div>
                        <?php if ($count > 8) : ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <?php while (has_sub_field('our_clients_repeat', $args['post_id'])) : $count++; ?>
                <?php
                    $style = '';
                    if(get_sub_field('img_width')) {
                        $style =  ' style="' . $project_item['img_width'] . '" ';
                    }
                ?>
                <div class="col-sm-6 col-lg-4 d-none d-lg-block col-card">
                    <?php if ($count > 8) : ?>
                        <div class="collapse multi-collapse-project-card">
                        <?php endif; ?>
                        <div class="project-card">
                            <div class="project-card-header">
                                <div class="project-card-logo">
                                    <img <?php echo $style; ?> data-src="<?php the_sub_field('our_clients_logo'); ?>" src="<?php the_sub_field('our_clients_logo'); ?>" alt="logo-project">
                                </div>
                                <div class="project-card-flag" data-bg="<?php the_sub_field('country'); ?>" style="background: url() center no-repeat;"></div>
                            </div>
                            <div class="project-card-body">
                                <p><?php the_sub_field('our_clients_desc'); ?></p>
                            </div>
                        </div>
                        <?php if ($count > 8) : ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <div class="mobile-project-card">
        <div class="project-card-slider custom-slider">
            <?php if ($section_5_gb_data && !empty($some_brands['projects'])) : ?>
                <?php foreach ($some_brands['projects'] as $project_item) : $count++; ?>
                    <?php
                    $style = '';
                    if($project_item['img_width']) {
                        $style =  ' style="' . $project_item['img_width'] . '" ';
                    }
                    ?>
                    <div class="project-card-slider-inner">
                        <div class="col-sm-12 col-lg-4">
                            <div class="project-card">
                                <div class="project-card-header">
                                    <div class="project-card-logo">
                                        <img <?php echo $style; ?> data-src="<?php echo $project_item['logo']['url']; ?>" src="<?php echo $project_item['logo']['url']; ?>" alt="<?php echo !empty($project_item['logo']['alt']) ? $project_item['logo']['alt'] : ''; ?>">
                                    </div>
                                    <div class="project-card-flag" data-bg="<?php echo $project_item['flag']; ?>" style="background: url(<?php echo $project_item['flag']; ?>) center no-repeat;"></div>
                                </div>
                                <div class="project-card-body">
                                    <p><span><?php echo $project_item['name']; ?></span> <?php echo $project_item['description']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <?php while (has_sub_field('our_clients_repeat', $args['post_id'])) : $count++; ?>
                    <?php
                    $style = '';
                    if(get_sub_field('img_width')) {
                        $style =  ' style="' . $project_item['img_width'] . '" ';
                    }
                    ?>
                    <div class="project-card-slider-inner">
                        <div class="col-sm-12 col-lg-4">
                            <div class="project-card">
                                <div class="project-card-header">
                                    <div class="project-card-logo">
                                        <img <?php echo $style; ?> data-src="<?php the_sub_field('our_clients_logo'); ?>" src="<?php the_sub_field('our_clients_logo'); ?>" alt="logo-project">
                                    </div>
                                    <div class="project-card-flag" data-bg="<?php the_sub_field('country'); ?>" style="background: url() center no-repeat;"></div>
                                </div>
                                <div class="project-card-body">
                                    <p><?php the_sub_field('our_clients_desc'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <div class="wr-btn">
            <a href="<?php echo home_url('/cases/'); ?>" class="btn btn-blue btn-show-el"><?php echo __('Show all cases', 'icoda'); ?></a>
        </div>
    </div>
</div>