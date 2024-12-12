<?php
$title = get_sub_field('title');
$content = get_sub_field('content');
$image = get_sub_field('image');
?>
<section class="section-five pt-lg-5">
    <div class="container">
        <div class="row mt-5 mb-5 mb-lg-4 pt-lg-4 pb-lg-5">
            <div class="col-12 col-lg-6"></div>

            <div class="col-12 col-lg-6">
                <h2 class="h4 mb-2 mb-lg-4"><?php echo $title; ?></h2>
                <div class="description mb-lg-4">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
        <?php if (!empty($image)) : ?>
            <div class="row">
                <div class="col-12">
                    <div class="img-wrap">
                        <img src="<?php echo $image; ?>" alt="single-5">
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>