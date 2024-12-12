<section class="section-adaptive-layout indent">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="content-title pb-4 mb-2 pb-lg-0 mb-lg-0">
                    <p class="title"><?php the_field('pbadaptlay_title'); ?></p>
                    <?php the_field('pbadaptlay_description'); ?>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="adaptive-layout-desk d-none d-sm-block">
                    <div class="img-wrap text-center">
                        <img src="<?php the_field('pbadaptlay_desktop_image'); ?>" alt="desktop-layout">
                    </div>
                </div>
                <div class="adaptive-layout-mob d-block d-sm-none">
                    <div class="img-wrap">
                        <img src="<?php the_field('pbadaptlay_mobile_image'); ?>" alt="mobile-layout">
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>