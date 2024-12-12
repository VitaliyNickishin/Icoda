<?php
$desk_images = get_field('pbdesk_img');
$desk_images_under_text = get_field('pbdesk_img_under_text');
?>
<section class="section-large-desing-system section-has-gallery indent">
    <div class="container">
        <div class="content-title mb-4 mb-lg-5 pb-lg-2">
            <div class="row">
                <div class="col-12 col-20">
                    <p class="title"><?php the_field('pblds_title'); ?></p>
                </div>
                <div class="col-12 col-80">
                    <div class="description pl-lg-2">
                        <?php the_field('pblds_description'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pb-lg-5">
            <?php foreach ($desk_images as $desk_image_url) : ?>
                <div class="col-12 col-img">
                    <div class="img-wrap text-center">
                        <img src="<?php echo $desk_image_url; ?>" alt="desk-img">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row my-3 mt-lg-5 py-lg-5">
            <div class="col-12 col-lg-6">
                <div class="description">
                    <?php the_field('pblds_text_left'); ?>
                </div>
            </div>
        </div>

        <div class="row pb-lg-5">
            <div class="col-12 col-40 pl-lg-0 ml-auto">
                <div class="description">
                    <?php the_field('pblds_text_right'); ?>
                </div>
            </div>
        </div>

        <div class="row my-3 mt-lg-5 py-lg-5">
            <?php foreach ($desk_images_under_text as $desk_image_under_text_url) : ?>
                <div class="col-12 col-img">
                    <div class="img-wrap text-center">
                        <img src="<?php echo $desk_image_under_text_url; ?>" alt="desk-img">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row mt-lg-5 py-lg-5">
            <div class="col-12 col-60 ml-lg-0 pr-lg-5">
                <div class="description pr-lg-5 mr-lg-5">
                    <?php the_field('pblds_text_sec_left'); ?>
                </div>
            </div>
            <div class="col-12 col-40 pl-lg-0 mt-3 mt-lg-0 pr-lg-5">
                <div class="description pr-lg-5 mr-lg-5">
                    <?php the_field('pblds_text_sec_right'); ?>
                </div>
            </div>
        </div>

    </div>
</section>