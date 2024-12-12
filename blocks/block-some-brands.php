<?php
$some_brands = get_field('icoda_gb_some_brands', 'option');
if (!empty($some_brands['projects'])) :
    $title = !empty($some_brands['title']) ? $some_brands['title'] : block_value('title');
    if (!empty(block_value('title'))) {
        $title = block_value('title');
    }
    $title_tag = !empty($some_brands['title-tag']) ? $some_brands['title-tag'] : block_value('title-tag', false);
    if (!empty(block_value('title-tag'))) {
        $title_tag = block_value('title-tag', false);
    }
    $description = !empty($some_brands['description']) ? $some_brands['description'] : block_value('description');
    if (!empty(block_value('description'))) {
        $description = block_value('description');
    }
    if (empty(block_value('description'))) {
        $description = '';
    }
    $show_all = !empty($some_brands['show-all']) ? $some_brands['show-all'] : block_value('show-all');
    if (!empty(block_value('show-all'))) {
        $show_all = block_value('show-all');
    }

    $projects = block_value('projects');
    $count_projects = count( $projects );
    if($count_projects == 0 && !empty($some_brands['projects'])) {
        $count_projects = count( $some_brands['projects'] );
    }
?>
    <section class="section section-5 <?php if (empty($show_all)) {
                                            echo ' show-part';
                                        } ?>">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="text">
                        <?php if (!empty($title_tag) && $title_tag !== 'Default' &&  $title_tag !== 'default') : ?>
                            <<?php echo $title_tag; ?>><?php echo $title; ?></<?php echo $title_tag; ?>>
                        <?php else : ?>
                            <p class="h3"><?php echo $title; ?></p>
                        <?php endif; ?>
                        <p class="sub-text"><?php echo $description; ?></p>

                        <?php if( $count_projects > 8 ) : ?>
                            <a data-toggle="collapse" href="#" class="link-arrow d-none d-lg-block" role="button" data-target=".multi-collapse-project-card" aria-expanded="false"><?php echo __('Show all brands', 'icoda'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>

                <?php $i = 1; ?>


                <?php if (block_rows('projects')) : ?>

                    <?php while (block_rows('projects')) :
                        block_row('projects'); ?>

                        <?php
                        $logo_caption = block_sub_value('image_caption');
                        ?>
                        <div class="col-sm-6 col-lg-4 col-card">

                            <?php if (empty($show_all) && $i > 8) : ?>
                                <div class="collapse multi-collapse-project-card">
                                <?php endif; ?>

                                <div class="project-card">
                                    <div class="project-card-header">
                                        <?php if (empty(block_sub_value('link'))) : ?>
                                            <div class="project-card-logo">
                                            <?php else : ?>
                                                <a href="<?php echo block_sub_value('link'); ?>" class="project-card-logo" target="_blank" rel="nofollow">
                                                <?php endif; ?>
                                                <img src="<?php block_sub_field('logo'); ?>" alt="logo-project" data-skip-lazy <?php if (!empty(block_sub_value('img_width'))) : ?>style="<?php echo block_sub_value('img_width'); ?>" <?php endif; ?>>

                                                <?php if (!empty($logo_caption)) : ?>
                                                    <p class="wp-caption-text"><?php echo $logo_caption; ?></p>
                                                <?php endif; ?>

                                                <?php if (empty(block_sub_value('link'))) : ?>
                                            </div>
                                        <?php else : ?>
                                            </a>
                                        <?php endif; ?>
                                        <div class="project-card-flag" <?php if (!empty(block_sub_value('flag'))) : ?>style="background: url('<?php block_sub_field('flag'); ?>') center no-repeat" <?php endif; ?>></div>
                                    </div>
                                    <div class="project-card-body">
                                        <?php if(!empty(block_sub_value('name'))) : ?>
                                            <h3><?php block_sub_field('name'); ?></h3>
                                        <?php endif; ?>
                                        <p>
                                            <?php block_sub_field('description'); ?>
                                        </p>
                                    </div>
                                </div>

                                <?php if (empty($show_all) && $i > 8) : ?>
                                </div>
                            <?php endif; ?>

                        </div>
                        <?php $i++; ?>
                    <?php endwhile;
                    reset_block_rows('projects'); ?>

                <?php elseif (!empty($some_brands['projects'])) : ?>

                    <?php foreach ($some_brands['projects'] as $project_item) : ?>

                        <div class="col-sm-6 col-lg-4">

                            <?php if (empty($show_all) && $i > 8) : ?>
                                <div class="collapse multi-collapse-project-card">
                                <?php endif; ?>

                                <div class="project-card">
                                    <div class="project-card-header">
                                        <?php if (empty($project_item['link'])) : ?>
                                            <div class="project-card-logo">
                                            <?php else : ?>
                                                <a href="<?php echo $project_item['link']; ?>" class="project-card-logo" target="_blank" rel="nofollow">
                                                <?php endif; ?>

                                                <img src="<?php echo $project_item['logo']; ?>" alt="logo-project" data-skip-lazy <?php if (!empty($project_item['img_width'])) : ?>style="<?php echo $project_item['img_width']; ?>" <?php endif; ?>>

                                                <?php if (!empty($project_item['image_caption'])) : ?>
                                                    <p class="wp-caption-text"><?php echo $project_item['image_caption']; ?></p>
                                                <?php endif; ?>

                                                <?php if (empty($project_item['link'])) : ?>
                                            </div>
                                        <?php else : ?>
                                            </a>
                                        <?php endif; ?>
                                        <div class="project-card-flag" <?php if (!empty($project_item['flag'])) : ?>style="background: url('<?php echo $project_item['flag']; ?>') center no-repeat" <?php endif; ?>></div>
                                    </div>
                                    <div class="project-card-body">
                                        <?php if(!empty($project_item['name'])) : ?>
                                            <h3><?php echo $project_item['name']; ?></h3>
                                        <?php endif; ?>
                                        <p>
                                            <?php echo $project_item['description']; ?>
                                        </p>
                                    </div>
                                </div>

                                <?php if (empty($show_all) && $i > 8) : ?>
                                </div>
                            <?php endif; ?>

                        </div>
                        <?php $i++; ?>

                    <?php endforeach; ?>

                <?php endif; ?>

                <?php if (empty($show_all) && $i > 8) : ?>
                    <div class="col-12">
                        <div class="text-center">
                            <a data-toggle="collapse" href="#" class="btn btn-blue" role="button" data-target=".multi-collapse-project-card" aria-expanded="false" aria-controls="multi-collapse-project-card"><?php _e('Show all brands', 'icoda'); ?></a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>