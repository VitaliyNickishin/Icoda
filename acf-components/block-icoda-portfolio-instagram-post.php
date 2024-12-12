<?php
$i_images = get_field('pbip_post_images');
?>
<section class="section-instagram-post indent">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content-title">
                    <p class="title"><?php the_field('pbip_title'); ?></p>
                </div>
            </div>
        </div>
        <div class="row d-none d-lg-flex px-lg-2">

            <?php foreach ($i_images as $i_image_url) : ?>
                <div class="col-lg-2 p-0">
                    <div class="img-wrap p-2">
                        <img src="<?php echo $i_image_url; ?>" alt="instagram-image">
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="row d-block d-lg-none">
            <div class="wr-slider pl-2">
                <div class="slider-post-templates custom-slider col">

                    <?php foreach ($i_images as $i_image_url) : ?>
                        <div class="img-wrap px-2">
                            <img src="<?php echo $i_image_url; ?>" class="skip_lazy" alt="">
                        </div>
                    <?php endforeach; ?>

                </div>
                <div class="wr-control wr-control-post-templates"></div>

            </div>

        </div>
    </div>
</section>