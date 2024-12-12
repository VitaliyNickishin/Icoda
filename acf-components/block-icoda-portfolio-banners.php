<?php
$banner_images = get_field('pbban_images');
?>
<section class="section-banners indent">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content-title">
                    <p class="title short"><?php the_field('pbban_title'); ?></p>
                </div>
            </div>
        </div>
        <div class="row">

            <?php foreach ($banner_images as $banner_image_url) : ?>
                <div class="col-12">
                    <div class="img-wrap">
                        <img src="<?php echo $banner_image_url; ?>" alt="">
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>