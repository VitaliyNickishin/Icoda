<?php
if (!block_rows('projects')) {
    return;
}
?>
<section class="section section-5 section-img-cards">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="text">
                    <p class="h3"><?php block_field('title'); ?></p>
                    <p class="sub-text"><?php block_field('description'); ?></p>
                </div>
            </div>

            <?php $i = 1; ?>
            <?php while (block_rows('projects')) :
                block_row('projects'); ?>

                <div class="col-sm-6 col-lg-4">

                    <?php if ($i > 6) : ?>
                        <div class="collapse multi-collapse-project-card">
                        <?php endif; ?>

                        <div class="project-card project-card-image">
                            <div class="front face">
                                <img src="<?php block_sub_field('face-image'); ?>" alt="pic">
                            </div>
                            <div class="back face">
                                <div class="project-card-header">
                                    <div class="project-card-logo">
                                        <img src="<?php block_sub_field('logo'); ?>" alt="logo-project">
                                    </div>
                                    <div class="project-card-flag" style="background: url('<?php block_sub_field('flag'); ?>') center no-repeat"></div>
                                </div>
                                <div class="project-card-body">
                                    <p><span><?php block_sub_field('name'); ?></span> <?php block_sub_field('description'); ?></p>
                                </div>
                            </div>
                        </div>

                        <?php if ($i > 6) : ?>
                        </div>
                    <?php endif; ?>

                </div>
                <?php $i++; ?>
            <?php endwhile;
            reset_block_rows('projects'); ?>

            <?php if ($i > 6) : ?>
                <div class="col-12">
                    <div class="text-center">
                        <a data-toggle="collapse" href="#" class="btn btn-blue" role="button" data-target=".multi-collapse-project-card" aria-expanded="false" aria-controls="multi-collapse-project-card"><?php _e('Show all brands', 'icoda'); ?></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>