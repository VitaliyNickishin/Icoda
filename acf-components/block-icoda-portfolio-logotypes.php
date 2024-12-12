<?php
$logotype_images = get_field('pblt_images');
?>
<section class="section-logotypes indent">
    <div class="container">
        <div class="content-title">
            <div class="row">
                <div class="col-12 col-40">
                    <p class="title short"><?php the_field('pblt_title'); ?></p>
                </div>
                <div class="col-12 col-60">
                    <div class="content pl-lg-1">
                        <?php the_field('pblt_description'); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php foreach ($logotype_images as $image_url) : ?>
            <div class="row my-4 my-sm-4 my-lg-5 pt-4">
                <div class="col-12">
                    <div class="img-wrap">
                        <img src="<?php echo $image_url; ?>" alt="logo-img">
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</section>