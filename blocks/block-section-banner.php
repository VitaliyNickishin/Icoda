<?php $title = block_value('title'); ?>
<?php $title = explode("\n", $title); ?>
<?php $button_url = empty(block_value('banner_button_url')) ? '#contact-with-us' : block_value('banner_button_url'); ?>
<?php $button_label = empty(block_value('banner_button_name')) ? __('Contact Us', 'icoda') : block_value('banner_button_name'); ?>

<?php if (empty(block_value('new-version'))) : ?>

    <section class="section section-banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="banner-box bg-color-light-blue">
                        <p class="h4"><?php echo implode(' <span class="br"></span>', $title); ?></p>
                        <?php if ($button_url == '#contact-with-us') : ?>
                            <a href="#" data-modal="#callback" class="btn btn-blue open-modal"><?php echo $button_label; ?></a>
                        <?php else : ?>
                            <a href="<?php echo $button_url; ?>" class="btn btn-blue"><?php echo $button_label; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php else : ?>


    <section class="section section-banner">
        <div class="container">
            <div class="banner bg-color-light-blue">
                <div class="row align-items-center">
                    <div class="col-12 col-md-4 col-lg-3 col-xl-4 p-xl-0 text-center text-md-left">
                        <div class="banner-img">
                            <img src="<?php echo block_field('image'); ?>" alt="">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4 col-xl-4 pl-xl-0">
                        <p class="h4 h4 pl-lg-4 pl-xl-0 mt-4 mt-md-0 text-center text-md-left"><?php echo implode(' <span class="br"></span>', $title); ?></p>
                    </div>
                    <div class="col-12 col-md-4 col-lg-5 col-xl-4 d-flex justify-content-center justify-content-md-end pr-md-0">
                        <?php if ($button_url == '#contact-with-us') : ?>
                            <a href="#" data-modal="#callback" class="ml-0 btn btn-blue open-modal"><?php echo $button_label; ?></a>
                        <?php else : ?>
                            <a href="<?php echo $button_url; ?>" class="ml-0 btn btn-blue"><?php echo $button_label; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>