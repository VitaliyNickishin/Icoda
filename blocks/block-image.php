<div class="section section-block-image" >
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <img src="<?php block_field('img'); ?>" alt="<?php echo get_post_meta(block_field('img', false), '_wp_attachment_image_alt', true); ?>">
            </div>
        </div>
    </div>
</div>