<?php
$desk_images = get_field('pbdesk_images');
$mob_images = get_field('pbmob_images');
?>
<section class="section-title-img-desk-mob section-has-gallery indent">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content-title">
                    <p class="title"><?php the_field('pbtp_title'); ?></p>
                </div>
            </div>
        </div>
        <div class="row d-none d-lg-block">

            <?php foreach ($desk_images as $desk_image_url) : ?>
                <div class="col-12 col-img">
                    <div class="img-wrap text-center">
                        <img src="<?php echo $desk_image_url; ?>" alt="desk-img">
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="row d-block d-lg-none">

            <?php foreach ($mob_images as $mob_image_url) : ?>
                <div class="col-12 col-img">
                    <div class="img-wrap text-center">
                        <img src="<?php echo $mob_image_url; ?>" alt="mob-img">
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>