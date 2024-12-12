<?php
$fb_images = get_field('pbfp_post_images');
?>
<section class="section-facebook-post indent">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content-title">
                    <p class="title short"><?php the_field('pbfp_title'); ?></p>
                </div>
            </div>
        </div>
        <div class="row d-none d-lg-flex">

            <?php foreach ($fb_images as $fb_image_url) : ?>
                <div class="col-lg-4">
                    <div class="img-wrap">
                        <img src="<?php echo $fb_image_url; ?>" alt="">
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="row d-block d-lg-none">
            <div class="wr-slider pt-3 pl-2">
                <div class="slider-post-templates custom-slider col">

                    <?php foreach ($fb_images as $fb_image_url) : ?>
                        <div class="img-wrap">
                            <img src="<?php echo $fb_image_url; ?>" class="skip_lazy" alt="">
                        </div>
                    <?php endforeach; ?>

                </div>
                <div class="wr-control wr-control-post-templates"></div>

            </div>

        </div>
    </div>
</section>