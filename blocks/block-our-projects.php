<?php
if ( !block_rows( 'slider' ) ) {
    return;
}
?>

<section class="section section-our-projects">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <h2 class="section-title"><?php block_field('title'); ?></h2>
                <div class="section-content"><?php block_field('text'); ?></div>
                <div class="wr-btn">
                    <a href="#" class="btn btn-default btn-show-el">Show more</a>
                </div>
            </div>
            <div class="col-md-7 our-projects-list-wrap">
                <div class="our-projects-list">
                    <?php while ( block_rows( 'slider' ) ) :
                        block_row( 'slider' ); ?>

                        <div class="project-item">
                            <div class="slider-default-item-header">
                            	<div class="slider-logo-box">
                                    <img src="<?php block_sub_field('logotype'); ?>" class="project-logo" alt="<?php echo get_post_meta(block_sub_field('logotype', false), '_wp_attachment_image_alt', true); ?>">
                                </div>
                                <div class="slider-flag-box">
                                    <img src="<?php block_sub_field('flag'); ?>" class="project-flag" alt="<?php echo get_post_meta(block_sub_field('flag', false), '_wp_attachment_image_alt', true); ?>">

                                </div>
                            </div>

                            <div class="content-default-item">
                            	<div class="content_inner">
                            		<p><?php block_sub_field('description'); ?></p>
                            	</div>
                            </div>
                        </div>

                    <?php endwhile;

                    reset_block_rows( 'slider' );?>
                </div>
                <div class="wr-control-projects"></div>

            </div>

        </div>
    </div>
</section>