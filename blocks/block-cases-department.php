<div class="section section-cases-department">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wr-slider">
                    <div class="slider-default" data-slick='{"dots": "false"}'>

                        <?php if ( block_rows( 'items' ) ) : ?>

                            <?php while ( block_rows( 'items' ) ) : block_row( 'items' );
                                $item = block_sub_field('item', false); ?>

                                <div class="col-12 col-md-5">
                                    <a href="<?php the_permalink($item); ?>" class="service-card cases-card hot">

                                        <?php if ( has_post_thumbnail($item)) : ?>
                                            <?php $featured_img_url = get_the_post_thumbnail_url($item); ?>

                                            <div class="cases-block-img">
                                                <img class="skip_lazy" src="<?php echo $featured_img_url; ?>" alt="<?php echo get_the_title($item); ?>">
                                            </div>

                                        <?php endif; ?>

                                        <div class="cases-card-content">
                                            <div class="h6"><?php echo get_the_title($item); ?></div>
                                            <div class="sub-text">
                                                <span class="p"><?php echo get_the_excerpt($item); ?></span>
                                            </div>
                                            <div class="service-card-footer">
                                                <span class="link-arrow"><?php echo __('Learn more', 'icoda'); ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            <?php endwhile;
                            reset_block_rows( 'items' ); ?>
                        <?php endif;?>

                    </div>
                    <div class="wr-control"></div>
                </div>
            </div>
        </div>
    </div>
</div>