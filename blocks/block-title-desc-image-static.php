<section class="section section-1">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-4">
                <div class="text">
                    <div class="wr-logo mb-2">
                        <img src="<?php block_field('img'); ?>" alt="<?php echo get_post_meta(block_field('img', false), '_wp_attachment_image_alt', true); ?>">
                    </div>
                    <?php if(block_value('title')): ?> <<?php block_field('title-tag'); ?> class="section-title"> <?php block_field('title'); ?> </<?php block_field('title-tag'); ?>> <?php endif; ?>
                    <div class="sub-text">
                        <?php block_field('description'); ?>
                    </div>
                    <?php if( ! empty( block_value('link') ) ) : ?>
                    <div class="wr-link">
                        <p><?php _e( 'Website', 'icoda' ); ?></p>
                        <a href="<?php block_field('link'); ?>" target="_blank" class="link">
                            <?= str_replace('htpps://', '', block_value('link')); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="d-none d-md-block col-md-7 col-lg-8">
                <div class="wr-img">
                    <div class="bg-case">
                        <?php if ( has_post_thumbnail()) : ?>
                            <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>

                            <img src="<?php echo $featured_img_url; ?>" alt="<?php echo get_the_title(get_the_ID()); ?>">

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>