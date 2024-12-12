<?php
$slider_images = get_field('pbs_slider');
?>
<section class="section-solution indent">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content-title">
                    <p class="title"><?php the_field('pbs_title'); ?></p>
                    <?php the_field('pbs_description'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="wr-slider mt-4 mt-lg-5 pt-lg-5">
        <div class="solution-slider custom-slider">
            <?php foreach ($slider_images as $slider_image_url) : ?>
                <div class="img-wrap">
                    <img src="<?php echo $slider_image_url; ?>" class="skip_lazy" alt="">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="wr-control wr-control-solution-slider"></div>
    </div>

</section>