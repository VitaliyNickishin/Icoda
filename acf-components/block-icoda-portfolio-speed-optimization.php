<?php
$pbspeed_images = get_field('pbspeed_images');
?>
<section class="section-speed-optimization indent">
    <div class="container">
        <div class="content-title">
            <div class="row">
                <div class="col-12 col-lg-2">
                    <p class="title"><?php the_field('pbspeed_title'); ?></p>
                </div>
                <div class="col-12 col-lg-10">
                    <div class="content pl-lg-5">
                        <?php the_field('pbspeed_description'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 mt-lg-5 pt-lg-5">
            <div class="col-12">
                <?php foreach ($pbspeed_images as $key => $pbspeed_images_item) : ?>
                    <div class="img-wrap mb-4 mb-lg-5 pb-lg-5">
                        <img src="<?php echo $pbspeed_images_item['image']; ?>" alt="speed-optimization">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>