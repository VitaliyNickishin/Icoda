<?php
    $desk_images = get_field('pbtes_image');
    $extra_text = get_field('pbextra_text');
    $extra_images = get_field('pbextra_image');
?>
<section class="section-testing section-has-gallery indent">
    <div class="container">
        <div class="row">
            <div class="col-12 col-60 ml-lg-0">
                <div class="content-title">
                    <p class="title"><?php the_field('pbtes_title'); ?></p>
                    <?php the_field('pbtes_description'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($desk_images as $desk_image_url) : ?>
                <div class="col-12 col-img">
                    <div class="img-wrap text-center">
                        <img src="<?php echo $desk_image_url; ?>" alt="desk-img">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($extra_text)) : ?>
            <div class="row mt-4 mt-lg-5 pt-lg-5">
                <div class="col-12 col-60 ml-lg-0">
                    <div class="content-title mb-0">
                        <?php echo $extra_text; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($extra_images)) : ?>
            <div class="row mt-4 mt-lg-5 pt-lg-5">
                <?php foreach ($extra_images as $extra_images_url) : ?>
                    <div class="col-12 col-img">
                        <div class="img-wrap text-center">
                            <img src="<?php echo $extra_images_url; ?>" alt="extra-desk-img">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
    </div>
</section>