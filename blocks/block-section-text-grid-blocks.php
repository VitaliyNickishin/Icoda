<?php
if (!block_rows('grid_items')) {
    return;
}
?>
<section class="section section-masonry-gray">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text">
                    <p class="h3"><?php block_field('title'); ?></p>
                </div>
            </div>
        </div>
        <div id="id2" class="row grid-masonry">
            <div class="col-sm-6 grid-sizer"></div>

            <?php $i = 1; ?>
            <?php while (block_rows('grid_items')) : ?>

                <?php block_row('grid_items'); ?>

                <div class="<?php if ($i === 2) {
                                echo 'col-second';
                            }; ?> col-sm-6 grid-item">
                    <div class="service-card">
                        <?php
                        $icon = block_sub_value('icon');
                        $icon = wp_get_attachment_image_url( $icon );
                        $link = block_sub_value('link');
                        if(! empty( $link )) :
                        ?>
                        <div class="title-wrap d-flex align-items-center">
                            <?php if( ! empty( $icon ) ) : ?>
                                <div class="icon-wrap mr-3">
                                    <img src="<?php echo $icon ?>" alt="icon">
                                </div>
                            <?php endif; ?>
                            <a href="<?php echo $link; ?>" class="title h6" target="_blank">
                                <?php block_sub_field('title'); ?>
                            </a>
                        </div>
                        <?php else: ?>
                        <div class="title-wrap d-flex align-items-center">
                            <?php if( ! empty( $icon ) ) : ?>
                                <div class="icon-wrap mr-3">
                                    <img src="<?php echo $icon ?>" alt="icon">
                                </div>
                            <?php endif; ?>
                            <span class="title h6"><?php block_sub_field('title'); ?></span>
                        </div>
                        <?php endif; ?>
                        <span class="sub-text">
                            <span class="p"><?php block_sub_field('content'); ?></span>
                        </span>
                    </div>
                </div>

                <?php $i++; ?>
            <?php endwhile; ?>
            <?php reset_block_rows('grid_items'); ?>

        </div>
    </div>
</section>