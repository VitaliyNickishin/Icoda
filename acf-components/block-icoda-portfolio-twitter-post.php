<?php
$tw_images = get_field('pbtp_images');
?>
<section class="section-twitter-post indent">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content-title">
                    <p class="title short"><?php the_field('pbtp_title'); ?></p>
                </div>
            </div>
        </div>
        <div class="row">

            <?php foreach ($tw_images as $tw_image_url) : ?>
                <div class="col-12">
                    <div class="img-wrap">
                        <img src="<?php echo $tw_image_url; ?>" alt="">
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>