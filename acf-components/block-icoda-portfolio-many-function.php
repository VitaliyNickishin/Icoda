<?php
$pbmf_column_1_data = get_field('pbmf_column_1_data');
$pbmf_column_2_data = get_field('pbmf_column_2_data');
?>

<section class="section-many-function indent">
    <div class="container">
        <div class="content-title">
            <div class="row">
                <div class="col-12 col-lg-2">
                    <p class="title"><?php the_field('pbmf_title'); ?></p>
                </div>
                <div class="col-12 col-lg-9 pr-lg-5">
                    <div class="content pl-lg-5 pr-lg-5">
                        <?php the_field('pbmf_description'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-lg-5 pb-lg-5">

            <div class="col-12 offset-lg-2 col-lg-4">
                <div class="img-wrap d-lg-block d-none text-right">
                    <img src="<?php echo $pbmf_column_1_data['desktop_image']; ?>" alt="">
                </div>
                <div class="wr-slider mt-4 pt-2 d-lg-none d-block">
                    <div class="slider-many-function custom-slider">
                        <?php foreach ($pbmf_column_1_data['slider_images'] as $pbmf_column_1_slider_image_url) : ?>
                            <div class="img-wrap">
                                <img src="<?php echo $pbmf_column_1_slider_image_url; ?>" class="skip_lazy" alt="">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="wr-control wr-control-many-function"></div>

                </div>
                <div class="content-title mt-5 pl-lg-5 d-lg-block d-none">
                    <?php echo $pbmf_column_1_data['content']; ?>
                </div>
            </div>

            <div class="col-12 offset-lg-2 col-lg-4 mt-5 pt-5 pt-lg-0">
                <div class="content-title mb-5 pl-lg-5">
                    <?php echo $pbmf_column_2_data['content']; ?>
                </div>
                <div class="img-wrap d-lg-block d-none text-right">
                    <img src="<?php echo $pbmf_column_2_data['image']; ?>" alt="">
                </div>
            </div>

        </div>

        <?php $pbmf_bottom_image = get_field('pbmf_bottom_image'); ?>
        <?php if ($pbmf_bottom_image) : ?>
            <div class="row mt-lg-5 pt-5">
                <div class="img-wrap m-auto">
                    <img src="<?php echo $pbmf_bottom_image; ?>" alt="">
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>