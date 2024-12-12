<style>
	.bg-service {
		background-image: url(<?php block_field('image'); ?>);
	}
</style>
<section class="section section-1 section-department-header">
	<div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="text">
                    <h1 class="section-title"><?php block_field('title'); ?></h1>
                    <div class="sub-text">
                        <?php block_field('content'); ?>
                    </div>
                    <a href="<?php block_field('button-url'); ?>" class="btn btn-blue"><?php block_field('button_name'); ?></a>
                </div>
            </div>
            <div class="d-none display-image d-md-block col-md-7">
            	<div class="anim-box d-flex">
            		<div class="bg-service"></div>
            	</div>
            </div>
        </div>
    </div>
</section>