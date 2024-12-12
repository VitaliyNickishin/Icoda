<section class="section-logotypes section-logotypes-banxe indent">
    <div class="container">
        <div class="content-title mb-3 mb-lg-5 pb-5">
            <div class="row">
                <div class="col-12 col-40">
                    <p class="title"><?php the_field('pblogotype_title'); ?></p>
                    <div class="img-wrap img-wrap-main d-block d-lg-none">
                        <img src="<?php the_field('pblogotype_image'); ?>" alt="logotype">
                    </div>
                </div>
                <div class="col-12 col-60">
                    <div class="content pl-lg-1 pt-4 pt-lg-0">
                        <?php the_field('pblogotype_description'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-lg-5">
            <div class="col-12 px-0 px-md-3">
                <div class="img-wrap img-wrap-main d-none d-lg-block">
                    <img src="<?php the_field('pblogotype_image'); ?>" alt="logotype">
                </div>
            </div>
        </div>

        <div class="row py-4 py-lg-5 mt-lg-5">
            <div class="col-12 col-40">
                <div class="img-wrap">
                    <img src="<?php the_field('pblogotype_image_left'); ?>" alt="logotype-left">
                </div>
            </div>
            <div class="col-12 col-60 pr-lg-0 d-none d-lg-block">
                <div class="img-wrap text-lg-right">
                    <img src="<?php the_field('pblogotype_image_right'); ?>" alt="logotype-right">
                </div>
            </div>
        </div>

        <div class="row py-4 py-lg-5 mt-lg-5">
            <div class="col-6 col-40">
                <div class="img-wrap">
                    <img src="<?php the_field('pblogotype_image_left_second'); ?>" alt="logotype-left-second">
                </div>
            </div>
            <div class="col-6 col-60 pr-lg-0">
                <div class="img-wrap text-lg-right">
                    <img src="<?php the_field('pblogotype_image_right_second'); ?>" alt="logotype-right-second">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-block d-lg-none pt-4">
                <div class="img-wrap text-lg-right">
                    <img src="<?php the_field('pblogotype_image_right'); ?>" alt="logotype-right">
                </div>
            </div>
        </div>
    </div>
</section>