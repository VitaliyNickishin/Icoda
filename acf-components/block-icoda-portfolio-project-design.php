<section class="section-project-design indent">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content-title mb-4 pb-1 mb-lg-5 pb-lg-5">
                    <p class="title"><?php the_field('pbprojdes_title'); ?></p>
                    <?php the_field('pbprojdes_description'); ?>
                </div>
                <div class="img-wrap position-relative text-center">
                    <img src="<?php the_field('pbprojdes_image'); ?>" alt="maket">
                </div>
                <!-- <?php// $second_image = the_field('pbprojdes_image_second'); ?>
                <?php// if (!empty($second_image)) : ?>
                    <div class="second-img-wrap text-center">
                        <img src="<?php// the_field('pbprojdes_image_second'); ?>" alt="maket-2">
                    </div>
                <?php// endif; ?> -->
                
                    <div class="second-img-wrap text-center">
                        <img src="<?php the_field('pbprojdes_image_second'); ?>" alt="maket-2">
                    </div>
                
                
            </div>
        </div>
    </div>
</section>