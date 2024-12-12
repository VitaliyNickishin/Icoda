<?php
$slider_images = get_field('pbresdes_slider_images');
?>
<section class="section-responsive-design indent">
    <div class="container">
        <div class="row align-items-lg-center">
            <div class="col-12 col-lg-4">
                <div class="content-title pb-4 mb-2 pb-lg-0 mb-lg-0">
                    <p class="title"><?php the_field('pbresdes_title'); ?></p>
                    <?php the_field('pbresdes_description'); ?>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="responsive-design-desk d-none d-lg-block text-right">
                    <div class="img-wrap">
                        <img src="<?php the_field('pbresdes_desktop_image'); ?>" alt="">
                    </div>
                </div>
                <div class="wr-slider d-block d-lg-none">
                    <div class="slider-responsive-design custom-slider">
                        <?php foreach ($slider_images as $slider_image_url) : ?>
                            <div class="img-wrap">
                                <img src="<?php echo $slider_image_url; ?>" class="skip_lazy" alt="">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="wr-control wr-control-responsive-design"></div>

                </div>
            </div>
        </div>
    </div>
</section>