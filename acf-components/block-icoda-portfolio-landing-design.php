<?php
$pblandes_images = get_field('pblandes_images');
?>
<section class="section-landing-design indent">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content-title mb-lg-3">
                    <p class="title"><?php the_field('pblandes_title'); ?></p>
                </div>

                <?php foreach ($pblandes_images as $key => $pblandes_images_item) : ?>

                    <div class="<?php echo $key == 0 ? 'img-wrap first-img mb-4 mb-lg-5' : 'img-wrap pt-lg-5'; ?>">
                        <img src="<?php echo $pblandes_images_item['image']; ?>" alt="">
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
</section>