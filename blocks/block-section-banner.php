<?php $title = block_value('title'); ?>
<?php $title = explode("\n", $title); ?>
<?php $content = block_value('content'); ?>
<?php $button_url = empty(block_value('banner_button_url')) ? '#contact-with-us' : block_value('banner_button_url'); ?>
<?php $button_label = empty(block_value('banner_button_name')) ? __('Contact Us', 'icoda') : block_value('banner_button_name'); ?>

<?php
    global $post;
    $post_v3 = get_field('post_v3');
    $addistional_class = '';
    $addistional_btn_class = '';
    if(is_singular('post') && !empty($post_v3)) {
        $addistional_class = 'section-banner--blog-post';
        $addistional_btn_class = 'text-white';
    }
?>

<?php if (empty(block_value('new-version'))) : ?>

    <section class="section section-banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="banner-box bg-color-light-blue">
                        <p class="h4"><?php echo implode(' <span class="br"></span>', $title); ?></p>
                        <?php if ($button_url == '#contact-with-us') : ?>
                            <a href="#" data-modal="#callback" class="btn btn-blue open-modal <?php echo $addistional_btn_class; ?>"><?php echo $button_label; ?></a>
                        <?php else : ?>
                            <a href="<?php echo $button_url; ?>" <?php echo $post->ID == '28804' ? ' target="_blank" ' : ''; ?> class="btn btn-blue text-white"><?php echo $button_label; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php else : ?>


    <section class="section section-banner <?php echo $addistional_class; ?>">
        <div class="banner bg-color-light-blue">
            <div class="text-center">
                <p class="title pl-lg-4 pl-xl-0 mt-4 mt-md-0"><?php echo implode(' <span class="br"></span>', $title); ?>
                </p>
                <div class="discription">
                    <?php if( !empty($content) ) : ?>
                        <?php echo $content ?>
                    <?php endif; ?>
                </div>
            
            
                <?php if ($button_url == '#contact-with-us') : ?>
                    <a href="#" data-modal="#callback" class="mt-3 ml-0 btn btn-blue open-modal text-white"><?php echo $button_label; ?></a>
                <?php else : ?>
                    <a href="<?php echo $button_url; ?>" <?php echo $post->ID == '28804' ? ' target="_blank" ' : ''; ?> class="mt-3 ml-0 btn btn-blue text-white <?php echo $addistional_btn_class; ?>"><?php echo $button_label; ?></a>
                <?php endif; ?>
                
                
            </div>
        </div>
    </section>

<?php endif; ?>