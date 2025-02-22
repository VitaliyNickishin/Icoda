<?php $title = block_value('title'); ?>
<?php $button_url = empty(block_value('link')) ? '/' : block_value('link'); ?>
<?php $button_label = empty(block_value('button_text')) ? __('Home', 'icoda') : block_value('button_text'); ?>

<section class="section section-banner section-blog-post-banner">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="banner-box bg-color-light-blue">
                    <p class="h4"><?php echo implode(' <span class="br"></span>', $title); ?></p>
                    <a href="<?php echo $button_url; ?>" class="btn btn-blue"><?php echo $button_label; ?></a>
                </div>
            </div>
        </div>
    </div>
</section>