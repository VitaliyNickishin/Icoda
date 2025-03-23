<?php $title = block_value('title'); ?>
<?php $description = block_value('description'); ?>
<?php $image_alt = empty(block_value('image_alt')) ? __('Stars', 'icoda') : block_value('image_alt'); ?>
<?php $button_url = empty(block_value('banner_button_url')) ? '#' : block_value('banner_button_url'); ?>
<?php $button_label = empty(block_value('banner_button_name')) ? __('Reach Out Now', 'icoda') : block_value('banner_button_name'); ?>

<div class="section section-banner section-banner-review has-bg-gradient my-4" style="background: center right / cover no-repeat url(<?php echo block_field('banner_bg_gradient'); ?>)">
    <p class="title mb-2"><?php echo $title; ?></p>
    <p class="description mb-0"><?php echo $description; ?></p>
    <div class="banner-img">
        <img src="<?php echo block_field('image'); ?>" alt="<?php echo $image_alt; ?>">
    </div>

    <a href="<?php echo $button_url; ?>" data-modal="#callback" class="btn btn-blue open-modal text-white"><?php echo $button_label; ?></a>

</div>